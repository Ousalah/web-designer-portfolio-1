<?php if(empty($_SESSION)) session_start(); ?>
<?php /**
* 
*/
// include_once '../modules/utils.class.php';
include dirname(__FILE__).'/../modules/utils.class.php';
class Excel extends Utils
{

	public static function saveAsCSV($xmlName, $xml_id){

		if (Utils::get_count("survey") > 0) {		
			
			$cnx=Utils::connecter_db();
			$pr=$cnx->prepare("select * from survey");
		    $pr->execute();

			$filelocation = '../excel/';

			// exemple : filename.xml
			$csvName = explode(".", $xmlName);
			$filename     = $csvName[0].'--saved-'.date("Y-m-d-H-i-s").'.csv';
			$file_export  =  $filelocation . $filename;


		    $data = fopen($file_export, 'w');

		    $csv_fields = array();

		    $columns = Utils::showColumns();

			//start  get columns of the tabel	     
		    foreach ($columns as $column) {
				
				$csv_fields[] = $column->Field;	    

		    }

			//end  get columns of the tabel

			fputcsv($data, $csv_fields);

		    while ($row = $pr->fetch(PDO::FETCH_ASSOC)) {
		        fputcsv($data, $row);
		    }



		    // insert information in Excel Table
		    $excelData = array(
				'delegue_id' => $_SESSION["id_delegue"],
				'xml_id'	=> $xml_id,
				'link'	=>	$filename
			 );

			Utils::ajouter("excel", $excelData);

			Excel::set_val_session("notice", "Survey saved <strong>successfully</strong>.");


		}else {

			Excel::set_val_session("error", "Can not save an <strong>Empty</strong> survey.");
		}	
		
	}


	public static function tableHTML_ToCSV($delegue_id, $xml_id)
	{

		require_once '../modules/simple_html_dom.php';

		// start Get HTML Table
		$table = '<table><tr>';

  		$sqlTable = "excel";
		$data = array(
			'delegue_id' => $delegue_id,
			'xml_id'	=> $xml_id
		);
		$excels = Utils::get_by($sqlTable, $data);
		$excel = $excels[0];
		// get csv file
		$file = file("../excel/".$excel->link);
		foreach ($file as $k) {
			// convert csv to Array()
			$csv[] = explode(",", $k);
		}
     

     	// show Header Title
      	foreach ($csv[0] as $column) :
      		$table .= '<th>';
      		$table .= $column;
      		$table .= '</th>';
        endforeach;

        $table .= '</tr>';


        // Get Table Body Data
        $columnNumber = count($csv[0]);
         
        foreach ($excels as $ex) {
        	// reset table of data befor have new values 
        	$csvFile = "";

        	$allFiles = file("../excel/".$ex->link);
        	foreach ($allFiles as $k) {
				// convert csv to Array()
				$csvFile[] = explode(",", $k);
			}
        

        	foreach (array_slice($csvFile, 1) as $row) :

	        	$table .= '<tr>';
		            for ($i=0; $i < $columnNumber; $i++) {

		            	$table .= '<td>';
						$table .= str_replace('"', '', $row[$i]);
						$table .= '</td>';

		            }
		        $table .= '</tr>'; 
		    endforeach;
		}
		
		$table .= '</table>';
		// end Get HTML Table

 
		$html = str_get_html($table);

		header('Content-type: application/ms-excel');

		// Start Set New name To exported CSV
		$sqlTable = "xml";
		$data = array(
			'delegue_id' => $delegue_id
		);
		$xmls = Utils::get_by($sqlTable, $data);
		$xml = $xmls[0];

		$oldXML_Name = explode(".", $xml->link);
		header('Content-Disposition: attachment; filename='.$oldXML_Name[0].'--exported-'.date("Y-m-d-H-i-s").'.csv');
		// End Set New name To exported CSV


		$fp = fopen("php://output", "w");

		foreach($html->find('tr') as $element)
		{
		    $td = array();
		    foreach( $element->find('th') as $row)  
		    {
		        $td [] = trim(str_replace('"', '', $row->plaintext));
		    }
		    if (!empty($td)) {
		    	fputcsv($fp, $td);
			}

		    $td = array();
		    foreach( $element->find('td') as $row)  
		    {
		        $td [] = trim(str_replace('"', '', $row->plaintext));
		    }
		    if (!empty($td)) {
		    	fputcsv($fp, $td); 
			}
		}

		fclose($fp);

	}


	
} ?>