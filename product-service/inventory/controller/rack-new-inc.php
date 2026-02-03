<?
//cek popup
if(isset($popup)){
$link_list="rack-popup.php";
$link_new="rack-popup-new.php";
}else{
$link_list="rack.php";
$link_new="rack-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$rack_code=$_POST['rack_code'];
$rack_description=$_POST['rack_description'];
//end form handling

//insert items
$create_arr = array(
'rack_code'=>	$rack_code,
'rack_description'=>	$rack_description,
);
//create rack
if(!$global->product_order->create_rack($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: rack.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>