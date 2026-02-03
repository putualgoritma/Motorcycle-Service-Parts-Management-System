<?
if (isset($_REQUEST['users_group_id'])){
$users_group_id=$_REQUEST['users_group_id'];
}else{
$users_group_id=0;
}
$users_group_row=$global->users->db_row("users_group","*","users_group_id='".$users_group_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$users_group_id=$_POST['users_group_id'];
$users_group_code=$_POST['users_group_code'];
$users_group_name=$_POST['users_group_name'];
$users_group_disc_product=$_POST['users_group_disc_product'];
$users_group_disc_service=$_POST['users_group_disc_service'];
$users_group_disc_final=$_POST['users_group_disc_final'];

//end form handling

//insert items
$update_arr = array(
'users_group_code'=>	$users_group_code,
'users_group_name'=>	$users_group_name,
'users_group_disc_product'=>	$users_group_disc_product,
'users_group_disc_service'=>	$users_group_disc_service,
'users_group_disc_final'=>	$users_group_disc_final,
);
//update users_group
if(!$global->users->update_users_group($update_arr,$_POST['users_group_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: users-group.php");
Header("location: users-group.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>