<?
//cek popup
if(isset($popup)){
$link_list="area-popup.php";
$link_new="area-popup-new.php";
}else{
$link_list="area.php";
$link_new="area-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$area_code=$_POST['area_code'];
$area_name=$_POST['area_name'];
$area_range=$_POST['area_range'];
//end form handling

//insert items
$create_arr = array(
'area_code'=>	$area_code,
'area_name'=>	$area_name,
'area_range'=>	$area_range,
);
//create area
if(!$global->users->create_area($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: area.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>