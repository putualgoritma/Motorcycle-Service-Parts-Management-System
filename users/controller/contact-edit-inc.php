<?
if (isset($_REQUEST['contact_id'])){
$contact_id=$_REQUEST['contact_id'];
}else{
$contact_id=0;
}
$contact_row=$global->users->db_row("contact","*","contact_id='".$contact_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$contact_id=$_POST['contact_id'];
$contact_code=$_POST['contact_code'];
$contact_name=$_POST['contact_name'];
$users_level_code=$_POST['users_level_code'];
$contact_username=$_POST['contact_username'];
$contact_password=$_POST['contact_password'];
//end form handling

//insert items
$update_arr = array(
'contact_code'=>	$contact_code,
'contact_name'=>	$contact_name,
'users_level_code'=>	$users_level_code,
'contact_username'=>	$contact_username,
'contact_password'=>	$contact_password,
);
//update contact
if(!$global->users->update_contact($update_arr,$_POST['contact_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: contact.php");
Header("location: contact.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>