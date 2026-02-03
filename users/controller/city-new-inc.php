<?
//cek popup
if(isset($popup)){
$link_list="city-popup.php";
$link_new="city-popup-new.php";
}else{
$link_list="city.php";
$link_new="city-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$city_code=$_POST['city_code'];
$city_name=$_POST['city_name'];
$city_province=$_POST['city_province'];
//end form handling

//insert items
$create_arr = array(
'city_code'=>	$city_code,
'city_name'=>	$city_name,
'city_province'=>	$city_province,
);
//create city
if(!$global->users->create_city($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: city.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>