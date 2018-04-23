<?php
include_once '../model/FormModel.php';
extract($_GET);
extract($_POST);

switch ($a) {
	
	case 'add':
		Form::ajouter($t, $_POST);
		Form::set_val_session("notice", "The addition was <strong>successfully</strong> completed.");
		header("location:../survey.php?xml=".$xml."&sid=".$sid);
		break;

			
	default:
		header("location:../survey.php");
		break;
}

?>