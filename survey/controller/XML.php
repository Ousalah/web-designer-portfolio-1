<?php
include_once '../model/XMLModel.php';

extract($_GET);
extract($_POST);

switch ($a) {

	case 'add':
	

		// Firt of All it Should create a source file,  To Load it after
		$sourceFile = "../aformulaire.php";
		file_put_contents($sourceFile, $_POST['d']);    

		// Start get Name of Delegue
		$table = "delegue";
		$data = array('id' => $delegue_id);
		$delegues = Utils::get_by($table, $data);
		$delegue = $delegues[0];
		// End get Name of Delegue


		// Start Insert in Table xml ($t)
		$attachedLink = str_replace(' ', '-', $link);
		$xmlName = $attachedLink."-".$delegue->firstname."-".$delegue->lastname."-".date('Y-m-d-H-i-s').".xml";
		$data = array(
			'delegue_id' => $delegue_id,
			'link' => $xmlName 
		);
		XML::ajouter($t, $data);
		// End Insert in Table xml ($t)



		// start Create XML File
		require_once '../modules/simple_html_dom.php';

		$html = new simple_html_dom();
		$html->load_file($sourceFile);

		//start get all need tags to generate XML file


		    //create New XML file
		    #file Name
		    $xmlFile = "../xml/".$xmlName;

		    #initial data of the XML file
		    $initData = '<?xml version="1.0" encoding="UTF-8"?>
		<config>
		    
		</config>';

		    #create and put the initial data in the XML file
		    file_put_contents($xmlFile, $initData);

		    #load XML file
		    $config = simplexml_load_file($xmlFile);

		    foreach ($html->find('#form-zone .form-group') as $k => $form) {
		    // foreach ($html->find('#source .form-group') as $k => $form) {

		        $tag = $form->getAttribute("data-tag");
		        $label = $form->find('label', 0)->plaintext;
		        $type = $form->find('div', 0)->getAttribute('data-type');

		        #create child("champ") of the root("config")
		        $champ = $config->addChild("champ");
		        

		        if ($type == "text" || $type == "textarea") {

		            $name = $form->find('div',0)->first_child()->getAttribute('name');
		            $id = $form->find('div',0)->first_child()->getAttribute('id');
		            $dbType = $form->find('div',0)->first_child()->getAttribute('data-dbtype');

		            $champ->addChild("tag", $tag);
		            $champ->addChild("label", $label);
		            $champ->addChild("type", $type);
		            $champ->addChild("name", $name);
		            $champ->addChild("id", $id);
		            $champ->addChild("dbType", $dbType);

		        }elseif ($type == "select") {

		            $name = $form->find('div',0)->first_child()->getAttribute('name');
		            $id = $form->find('div',0)->first_child()->getAttribute('id');
		            $dbType = $form->find('div',0)->first_child()->getAttribute('data-dbtype');

		            $champ->addChild("tag", $tag);
		            $champ->addChild("label", $label);
		            $champ->addChild("type", $type);
		            $champ->addChild("name", $name);
		            $champ->addChild("id", $id);
		            $champ->addChild("dbType", $dbType);
		            #create child("options") of the parent("champ")
		            $options = $champ->addChild("options");

		            foreach ($form->find('div',0)->first_child()->find('option') as $k =>$item) {
		                $opName = $item->plaintext;
		                $opValue = $item->getAttribute('value');

		                #create child("option") of the parent("options")
		                $option = $options->addChild("option");

		                $option->addChild("name", $opName);
		                $option->addChild("value", $opValue);
		            }

		        } elseif ($type == "radio" || $type == "checkbox") {
		             
		            $name = $form->find('div', 0)->getAttribute('name');
		            $id = $form->find('div', 0)->getAttribute('id');
		            $dbType = $form->find('div', 0)->getAttribute('data-dbtype');

		            $champ->addChild("tag", $tag);
		            $champ->addChild("label", $label);
		            $champ->addChild("type", $type);
		            $champ->addChild("name", $name);
		            $champ->addChild("id", $id);
		            $champ->addChild("dbType", $dbType);
		            #create child("options") of the parent("champ")
		            $options = $champ->addChild("options");

		            foreach ($form->find('div div label') as $k =>$item) {
		                $opName = $item->plaintext;
		                $opValue = $item->find('input', 0)->getAttribute('value');
		                $opID = $item->find('input', 0)->getAttribute('id');

		                #create child("option") of the parent("options")
		                $option = $options->addChild("option");

		                $option->addChild("name", $opName);
		                $option->addChild("value", $opValue);
		                $option->addChild("id", $opID);

		            }

		        }
		         
		    }

		    #save XML file
		    file_put_contents($xmlFile, $config->asXML());
		//end get all need tags to generate XML file

		// end Create XML File

		XML::set_val_session("notice", "Your Form was Created <strong>successfully</strong>.");
		header("location:../creation.php");
		break;

			
	default:
		header("location:../index.php");
		break;
}

?>