<?
if (isset($_REQUEST['religion_id'])){
$religion_id=$_REQUEST['religion_id'];
}else{
$religion_id=0;
}
$religion_row=$global->users->db_row("religion","*","religion_id='".$religion_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$religion_id=$_POST['religion_id'];
$religion_code=$_POST['religion_code'];
$religion_name=$_POST['religion_name'];
//end form handling

//insert items
$update_arr = array(
'religion_code'=>	$religion_code,
'religion_name'=>	$religion_name,
);
//update religion
if(!$global->users->update_religion($update_arr,$_POST['religion_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: religion.php");
Header("location: religion.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>