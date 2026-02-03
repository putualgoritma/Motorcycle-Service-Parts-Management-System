<?
//cek popup
if(isset($popup)){
$link_list="district-popup.php";
$link_new="district-popup-new.php";
}else{
$link_list="district.php";
$link_new="district-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$district_code=$_POST['district_code'];
$district_name=$_POST['district_name'];
$city_code=$_POST['city_code'];
//end form handling

//insert items
$create_arr = array(
'district_code'=>	$district_code,
'district_name'=>	$district_name,
'city_code'=>	$city_code,
);
//create district
if(!$global->users->create_district($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: district.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>