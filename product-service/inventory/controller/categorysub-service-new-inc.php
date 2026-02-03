<?
//cek popup
if(isset($popup)){
$link_list="categorysub-service-popup.php";
$link_new="categorysub-service-popup-new.php";
}else{
$link_list="categorysub-service.php";
$link_new="categorysub-service-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$categorysub_code=$_POST['categorysub_code'];
$categorysub_name=$_POST['categorysub_name'];
//end form handling

//insert items
$create_arr = array(
'categorysub_code'=>	$categorysub_code,
'categorysub_name'=>	$categorysub_name,
'categorysub_type '=>	1,
);
//create categorysub
if(!$global->product_order->create_categorysub($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: categorysub-service.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>