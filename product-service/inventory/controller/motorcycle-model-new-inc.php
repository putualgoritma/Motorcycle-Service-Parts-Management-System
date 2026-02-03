<?
//cek popup
if(isset($popup)){
$link_list="motorcycle-model-popup.php";
$link_new="motorcycle-model-popup-new.php";
}else{
$link_list="motorcycle-model.php";
$link_new="motorcycle-model-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$motorcycle_model_code=$_POST['motorcycle_model_code'];
$motorcycle_model_name=$_POST['motorcycle_model_name'];
$motorcycle_model_oil_service_sprice=$_POST['motorcycle_model_oil_service_sprice'];
//end form handling

//get product kpb
$product_code_arr=explode(" - ",$_REQUEST['product_code']);
$product_code=$product_code_arr[0];
$product_code=$global->product_order->db_fldrow("product","product_code","product_code='".$product_code_arr[0]."'");

//insert items
$create_arr = array(
'motorcycle_model_code'=>	$motorcycle_model_code,
'motorcycle_model_name'=>	$motorcycle_model_name,
'motorcycle_model_oil_service_sprice'=>	$motorcycle_model_oil_service_sprice,
'product_code'=>	$product_code,
);
//create motorcycle_model
if(!$global->product_order->create_motorcycle_model($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: motorcycle-model.php");
Header("location: motorcycle-model.php?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>