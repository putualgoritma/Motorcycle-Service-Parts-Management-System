<?
if (isset($_REQUEST['area_id'])){
$area_id=$_REQUEST['area_id'];
}else{
$area_id=0;
}
$area_row=$global->users->db_row("area","*","area_id='".$area_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$area_id=$_POST['area_id'];
$area_code=$_POST['area_code'];
$area_name=$_POST['area_name'];
$area_range=$_POST['area_range'];
//end form handling

//insert items
$update_arr = array(
'area_code'=>	$area_code,
'area_name'=>	$area_name,
'area_range'=>	$area_range,
);
//update area
if(!$global->users->update_area($update_arr,$_POST['area_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: area.php");
Header("location: area.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>