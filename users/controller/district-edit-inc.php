<?
if (isset($_REQUEST['district_id'])){
$district_id=$_REQUEST['district_id'];
}else{
$district_id=0;
}
$district_row=$global->users->db_row("district","*","district_id='".$district_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$district_id=$_POST['district_id'];
$district_code=$_POST['district_code'];
$district_name=$_POST['district_name'];
$city_code=$_POST['city_code'];
//end form handling

//insert items
$update_arr = array(
'district_code'=>	$district_code,
'district_name'=>	$district_name,
'city_code'=>	$city_code,
);
//update district
if(!$global->users->update_district($update_arr,$_POST['district_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: district.php");
Header("location: district.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>