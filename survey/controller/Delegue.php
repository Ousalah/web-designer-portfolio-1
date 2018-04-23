<?php
include_once '../model/DelegueModel.php';

extract($_GET);
extract($_POST);

switch ($a) {
	
	case 'add':
		if ($img) {
			#preparation des donnees de chargement sous format array a transferer à la function upload()
			$image = array(
				"dossier" => "../uploads/",
				"name" => $_FILES['image']['name'],
				"tmp_name" => $_FILES['image']['tmp_name'],
				"size" => $_FILES['image']['size']
			);
		}
		Delegue::ajouter($t, $_POST, $image);
		Delegue::set_val_session("notice", "Delegue added <strong>successfully</strong>.");
		header("location:../add-delegue.php");
		break;

	case 'login':
		$data = array(
			"email" => $email,
			"password" => $password
			);
		$login = Delegue::get_by($t, $data, 1);
		$login_info = $login[0];
		if(isset($login_info) && !empty($login_info) && !empty($login_info->id)){

			session_start();
			unset($_SESSION["id_admin"]);
			unset($_SESSION["email_admin"]);
			unset($_SESSION["password_admin"]);

			Delegue::set_val_session('id_delegue', $login_info->id);
			Delegue::set_val_session('firstname_delegue', $login_info->firstname);
			Delegue::set_val_session('lastname_delegue', $login_info->lastname);
			Delegue::set_val_session('email_delegue', $login_info->email);
			Delegue::set_val_session('password_delegue', $login_info->password);
			header("location:../index.php");
		}else
		{
			Delegue::set_val_session("notice", "email or password is <strong>wrong</strong>.");

			header("location:../login.php");
		}
		break;

	case 'logout':
		session_start();
		unset($_SESSION["id_delegue"]);
		unset($_SESSION["firstname_delegue"]);
		unset($_SESSION["lastname_delegue"]);
		unset($_SESSION["email_delegue"]);
		unset($_SESSION["password_delegue"]);

		header("location:../login.php");
		break;	

			
	default:
		header("location:../index.php");
		break;
}

?>