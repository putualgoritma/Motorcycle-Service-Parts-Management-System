<?
//cek popup
if(isset($popup)){
$link_list="village-popup.php";
$link_new="village-popup-new.php";
}else{
$link_list="village.php";
$link_new="village-new.php";
}
//submit
$village_code_generation=$global->users->generator_village();
if(isset($_POST['Submit']))
{
//form handling
$village_code=$_POST['village_code'];
$village_name=$_POST['village_name'];
$district_code=$_POST['district_code'];
//end form handling

//insert items
$create_arr = array(
'village_code'=>	$village_code,
'village_name'=>	$village_name,
'district_code'=>	$district_code,
);
//create village
if(!$global->users->create_village($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: village.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>