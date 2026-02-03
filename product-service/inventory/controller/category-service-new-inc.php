<?
//cek popup
if(isset($popup)){
$link_list="category-service-popup.php";
$link_new="category-service-popup-new.php";
}else{
$link_list="category-service.php";
$link_new="category-service-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$category_code=$_POST['category_code'];
$category_name=$_POST['category_name'];
//end form handling

//insert items
$create_arr = array(
'category_code'=>	$category_code,
'category_name'=>	$category_name,
'category_type '=>	1,
);
//create category
if(!$global->product_order->create_category($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: category-service.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>