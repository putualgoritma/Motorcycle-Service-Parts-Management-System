<?
//cek popup
if(isset($popup)){
$link_list="color-popup.php";
$link_new="color-popup-new.php";
}else{
$link_list="color.php";
$link_new="color-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$color_code=$_POST['color_code'];
$color_name=$_POST['color_name'];
//end form handling

//insert items
$create_arr = array(
'color_code'=>	$color_code,
'color_name'=>	$color_name,
);
//create color
if(!$global->product_order->create_color($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: color.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>