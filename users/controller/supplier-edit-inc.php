<?
if (isset($_REQUEST['users_id'])){
$users_id=$_REQUEST['users_id'];
}else{
$users_id=0;
}
$users_row=$global->users->db_row("users","*","users_id='".$users_id."'");
if(isset($_REQUEST['Submitcancell']))
{
Header("location: supplier.php");
exit;
}
//if Submit edit
if(isset($_POST['Submit']) && isset($_POST['users_code']))
{
//form handling
$users_id=$_POST['users_id'];
$users_code=mysqli_real_escape_string($global->db_con,$_POST['users_code']);
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
'users_type'=>	'supplier',
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
//Header("location: supplier.php");
Header("location: supplier.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>