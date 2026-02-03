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
//end form handling

//insert items
$update_arr = array(
'contact_code'=>	$contact_code,
'contact_name'=>	$contact_name,
);
//update author
if(!$global->users->update_contact($update_arr,$_POST['contact_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: author.php");
Header("location: author.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>