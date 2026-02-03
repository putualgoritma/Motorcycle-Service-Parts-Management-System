<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="users"; ?>
<? $page_active="users/users"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<?
if(isset($_POST['users_code']))
{
//form handling
$users_id=$_POST['users_id'];
$users_code=mysqli_real_escape_string($global->db_con,$_POST['users_code']);
$users_type=$_POST['users_type'];
$users_status=$_POST['users_status'];
$users_idnumber=$_POST['users_idnumber'];
$users_name=mysqli_real_escape_string($global->db_con,$_POST['users_name']);
$users_address=mysqli_real_escape_string($global->db_con,$_POST['users_address']);
$users_phone=$_POST['users_phone'];
$users_email=$_POST['users_email'];
//end form handling

//insert items
$update_arr = array(
'users_code'=>	$users_code,
'users_type'=>	$users_type,
'users_status'=>	$users_status,
'users_idnumber'=>	$users_idnumber,
'users_name'=>	$users_name,
'users_address'=>	$users_address,
'users_phone'=>	$users_phone,
'users_email'=>	$users_email,
);
//create asset fixed
if(!$global->users->update_users($update_arr,$users_id)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: users.php");
Header("location: users.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>