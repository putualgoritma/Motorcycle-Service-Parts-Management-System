<?
//cek popup
if(isset($popup)){
$link_list="education-popup.php";
$link_new="education-popup-new.php";
}else{
$link_list="education.php";
$link_new="education-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$education_code=$_POST['education_code'];
$education_name=$_POST['education_name'];
//end form handling

//insert items
$create_arr = array(
'education_code'=>	$education_code,
'education_name'=>	$education_name,
);
//create education
if(!$global->users->create_education($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: education.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>