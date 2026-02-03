<?
if (isset($_REQUEST['unit_id'])){
$unit_id=$_REQUEST['unit_id'];
}else{
$unit_id=0;
}
$unit_row=$global->product_order->db_row("unit","*","unit_id='".$unit_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$unit_id=$_POST['unit_id'];
$unit_code=$_POST['unit_code'];
$unit_name=$_POST['unit_name'];
//end form handling

//insert items
$update_arr = array(
'unit_code'=>	$unit_code,
'unit_name'=>	$unit_name,
);
//update unit
if(!$global->product_order->update_unit($update_arr,$_POST['unit_id'])){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: unit.php");
Header("location: unit.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>