<?
//login check
if(!$_SESSION['users_level_code_sessi'])
{
Header("Location: ".$path."login.php");
exit;
}else{
if(!$_SESSION['ulm_arr_sessi'])
	{
	$_SESSION['ulm_arr_sessi']=$global->users_role($_SESSION['users_level_code_sessi']);
	}
$ulm_arr=$_SESSION['ulm_arr_sessi'];
$users_level_glob=$global->db_row("users_level","*","users_level_code='".$_SESSION['users_level_code_sessi']."'");
$contact_glob=$global->db_row("contact","*","contact_code='".$_SESSION['admin_useradmin_sessi']."'");
}
?>