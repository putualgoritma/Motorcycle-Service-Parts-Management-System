<?
if (isset($_REQUEST['city_id'])){
$city_id=$_REQUEST['city_id'];
}else{
$city_id=0;
}
$city_row=$global->users->db_row("city","*","city_id='".$city_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$city_id=$_POST['city_id'];
$city_code=$_POST['city_code'];
$city_name=$_POST['city_name'];
$city_province=$_POST['city_province'];
//end form handling

//insert items
$update_arr = array(
'city_code'=>	$city_code,
'city_name'=>	$city_name,
'city_province'=>	$city_province,
);
//update city
if(!$global->users->update_city($update_arr,$_POST['city_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: city.php");
Header("location: city.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>