<?php
include '../model/AdminModel.php';
extract($_GET);
extract($_POST);

switch ($a) {
	
	
	case 'login':
		$data = array(
			"email" => $email,
			"password" => $password
			);
		$login = Admin::get_by($t, $data, 1);
		$login_info = $login[0];
		if(isset($login_info) && !empty($login_info) && !empty($login_info->id)){

			session_start();
			unset($_SESSION["id_delegue"]);
			unset($_SESSION["firstname_delegue"]);
			unset($_SESSION["lastname_delegue"]);
			unset($_SESSION["email_delegue"]);
			unset($_SESSION["password_delegue"]);

			Admin::set_val_session('id_admin', $login_info->id);
			Admin::set_val_session('email_admin', $login_info->email);
			Admin::set_val_session('password_admin', $login_info->password);
			header("location:../index.php");
		}else
		{
			Admin::set_val_session("notice", "email or password is <strong>wrong</strong>.");

			header("location:../signin.php");
		}
		break;

	case 'logout':
		session_start();
		unset($_SESSION["id_admin"]);
		unset($_SESSION["email_admin"]);
		unset($_SESSION["password_admin"]);

		header("location:../signin.php");
		break;

			
	default:
		header("location:../index.php");
		break;
}

?>