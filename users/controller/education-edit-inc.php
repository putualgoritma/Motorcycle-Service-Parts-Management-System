<?
if (isset($_REQUEST['education_id'])){
$education_id=$_REQUEST['education_id'];
}else{
$education_id=0;
}
$education_row=$global->users->db_row("education","*","education_id='".$education_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$education_id=$_POST['education_id'];
$education_code=$_POST['education_code'];
$education_name=$_POST['education_name'];
//end form handling

//insert items
$update_arr = array(
'education_code'=>	$education_code,
'education_name'=>	$education_name,
);
//update education
if(!$global->users->update_education($update_arr,$_POST['education_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: education.php");
Header("location: education.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>