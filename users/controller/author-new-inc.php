<?
if(isset($_POST['Submit']))
{
//form handling
$contact_code=$_POST['contact_code'];
$contact_name=$_POST['contact_name'];
//end form handling

//insert items
$create_arr = array(
'contact_code'=>	$contact_code,
'contact_name'=>	$contact_name,
'contact_type'=>	"author",
);
//create author
if(!$global->users->create_contact($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: author.php");
Header("location: author.php?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>