<?
if(isset($_POST['Submit']))
{
//form handling
$contact_code=$_POST['contact_code'];
$contact_name=$_POST['contact_name'];
$users_level_code=$_POST['users_level_code'];
$contact_username=$_POST['contact_username'];
$contact_password=$_POST['contact_password'];
//end form handling

//insert items
$create_arr = array(
'contact_code'=>	$contact_code,
'contact_name'=>	$contact_name,
'users_level_code'=>	$users_level_code,
'contact_username'=>	$contact_username,
'contact_password'=>	$contact_password,
);
//create contact
if(!$global->users->create_contact($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: contact.php");
Header("location: contact.php?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>