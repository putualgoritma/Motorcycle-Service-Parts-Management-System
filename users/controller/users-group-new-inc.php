<?
if(isset($_POST['Submit']))
{
//form handling
$users_group_code=$_POST['users_group_code'];
$users_group_name=$_POST['users_group_name'];
$users_group_disc_product=$_POST['users_group_disc_product'];
$users_group_disc_service=$_POST['users_group_disc_service'];
$users_group_disc_final=$_POST['users_group_disc_final'];
//end form handling

//insert items
$create_arr = array(
'users_group_code'=>	$users_group_code,
'users_group_name'=>	$users_group_name,
'users_group_disc_product'=>	$users_group_disc_product,
'users_group_disc_service'=>	$users_group_disc_service,
'users_group_disc_final'=>	$users_group_disc_final,
);
//create users_group
if(!$global->users->create_users_group($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: users-group.php");
Header("location: users-group.php?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>