<?
//cek popup
if(isset($popup)){
$link_list="religion-popup.php";
$link_new="religion-popup-new.php";
}else{
$link_list="religion.php";
$link_new="religion-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$religion_code=$_POST['religion_code'];
$religion_name=$_POST['religion_name'];
//end form handling

//insert items
$create_arr = array(
'religion_code'=>	$religion_code,
'religion_name'=>	$religion_name,
);
//create religion
if(!$global->users->create_religion($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: religion.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>