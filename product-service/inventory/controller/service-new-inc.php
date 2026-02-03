<?
//cek popup
if(isset($popup)){
$link_list="service-popup.php";
$link_new="service-popup-new.php";
}else{
$link_list="service.php";
$link_new="service-new.php";
}
//submit
if(isset($_REQUEST['Submitcancell']))
{
Header("location: ".$link_list."");
exit;
}
if(isset($_POST['Submit']))
{
//form handling
$service_code=$_POST['service_code'];
$service_name=$_POST['service_name'];
$service_bprice=str_replace(",","",$_POST['service_bprice']);
$service_sprice=str_replace(",","",$_POST['service_sprice']);
$service_commission_type=$_POST['service_commission_type'];
$service_commission_percent=$_POST['service_commission_percent'];
$service_commission_percent_type=$_POST['service_commission_percent_type'];
$service_commission_nominal=$_POST['service_commission_nominal'];
$service_description=$_POST['service_description'];
$service_time_est=$_POST['service_time_est'];
$service_time_type=$_POST['service_time_type'];
//get category code
$category_code_arr=explode(" - ",$_REQUEST['category_code']);
$category_code=$category_code_arr[0];
//get categorysub code
$categorysub_code_arr=explode(" - ",$_REQUEST['categorysub_code']);
$categorysub_code=$categorysub_code_arr[0];
//end form handling
//insert items
$create_arr = array(
'service_code'=>	$service_code,
'service_name'=>	$service_name,
'service_bprice'=>	$service_bprice,
'service_sprice'=>	$service_sprice,
'category_code'=>	$category_code,
'categorysub_code'=>	$categorysub_code,
'service_commission_type'=>	$service_commission_type,
'service_commission_percent'=>	$service_commission_percent,
'service_commission_percent_type'=>	$service_commission_percent_type,
'service_commission_nominal'=>	$service_commission_nominal,
'service_description'=>	$service_description,
'service_time_est'=>	$service_time_est,
'service_time_type'=>	$service_time_type,
);
//create service
if(!$global->product_order->create_service($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>