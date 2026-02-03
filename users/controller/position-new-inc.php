<?
//cek popup
if(isset($popup)){
$link_list="position-popup.php";
$link_new="position-popup-new.php";
}else{
$link_list="position.php";
$link_new="position-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$position_code=$_POST['position_code'];
$position_name=$_POST['position_name'];
//end form handling

//insert items
$create_arr = array(
'position_code'=>	$position_code,
'position_name'=>	$position_name,
);
//create position
if(!$global->users->create_position($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: position.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>