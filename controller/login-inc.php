<?
if(isset($_POST['username'])){
if($global->admin_login($_POST['username'],$_POST['password'],$id_useradmin,$users_level_code)){
	$_SESSION['admin_useradmin_sessi']=$id_useradmin;
	$_SESSION['users_level_code_sessi']=$users_level_code;
	Header("Location: backupmysql/backup.php");
	exit;
	}else{
	$global->error_message($msgform_lang['req_password_useradmin']);
	}
}
?>
