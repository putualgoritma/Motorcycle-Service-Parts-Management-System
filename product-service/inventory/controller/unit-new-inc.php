<?
//cek popup
if(isset($popup)){
$link_list="unit-popup.php";
$link_new="unit-popup-new.php";
}else{
$link_list="unit.php";
$link_new="unit-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$unit_code=$_POST['unit_code'];
$unit_name=$_POST['unit_name'];
//end form handling

//insert items
$create_arr = array(
'unit_code'=>	$unit_code,
'unit_name'=>	$unit_name,
);
//create unit
if(!$global->product_order->create_unit($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: unit.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>