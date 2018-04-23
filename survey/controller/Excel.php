<?php
include '../model/ExcelModel.php';
extract($_GET);
extract($_POST);

switch ($a) {
	
	
	case 'save':

		Excel::saveAsCSV($xml, $sid);
		// Excel::set_val_session("notice", "Survey saved <strong>successfully</strong>.");
		// header("location:../survey.php?xml=".$xml."&sid=".$sid);

		header("location:../index.php");
		break;

	case 'export':
			Excel::tableHTML_ToCSV($did, $xid);
			// Excel::set_val_session("notice", "Your data was exported <strong>successfully</strong>.");

			// header("location:../show-all-excel.php?did=".$did."&xid=".$xid);
			break;	

	default:
		header("location:../index.php");
		break;
}

?>