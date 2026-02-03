<?
//cek popup
if(isset($popup)){
$link_list="motorcycle-type-popup.php";
$link_new="motorcycle-type-popup-new.php";
}else{
$link_list="motorcycle-type.php";
$link_new="motorcycle-type-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$motorcycle_type_code=$_POST['motorcycle_type_code'];
$motorcycle_type_name=$_POST['motorcycle_type_name'];
$motorcycle_type_cc=$_POST['motorcycle_type_cc'];
$motorcycle_type_model=$_POST['motorcycle_type_model'];
$motorcycle_type_level=$_POST['motorcycle_type_level'];
$motorcycle_type_machine_code=$_POST['motorcycle_type_machine_code'];
$motorcycle_type_kpb_service_sprice=$_POST['motorcycle_type_kpb_service_sprice'];

$motorcycle_type_kpb2_service_sprice=$_POST['motorcycle_type_kpb2_service_sprice'];
$motorcycle_type_kpb3_service_sprice=$_POST['motorcycle_type_kpb3_service_sprice'];
$motorcycle_type_kpb4_service_sprice=$_POST['motorcycle_type_kpb4_service_sprice'];
$motorcycle_type_engine_code=$_POST['motorcycle_type_engine_code'];

$motorcycle_type_oil_service_sprice=$_POST['motorcycle_type_oil_service_sprice'];

//end form handling

//get product kpb
$product_code_arr=explode(" - ",$_REQUEST['product_code']);
$product_code=$product_code_arr[0];
$product_code=$global->product_order->db_fldrow("product","product_code","product_code='".$product_code_arr[0]."'");

//insert items
$create_arr = array(
'motorcycle_type_code'=>	$motorcycle_type_code,
'motorcycle_type_name'=>	$motorcycle_type_name,
'motorcycle_type_cc'=>	$motorcycle_type_cc,
'motorcycle_type_model'=>	$motorcycle_type_model,
'motorcycle_type_level'=>	$motorcycle_type_level,
'motorcycle_type_machine_code'=>	$motorcycle_type_machine_code,
'motorcycle_type_kpb_service_sprice'=>	$motorcycle_type_kpb_service_sprice,
'motorcycle_type_kpb2_service_sprice'=>	$motorcycle_type_kpb2_service_sprice,
'motorcycle_type_kpb3_service_sprice'=>	$motorcycle_type_kpb3_service_sprice,
'motorcycle_type_kpb4_service_sprice'=>	$motorcycle_type_kpb4_service_sprice,
'motorcycle_type_engine_code'=>	$motorcycle_type_engine_code,
'motorcycle_type_oil_service_sprice'=>	$motorcycle_type_oil_service_sprice,
'product_code'=>	$product_code,
);
//create motorcycle_type
if(!$global->product_order->create_motorcycle_type($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: motorcycle-type.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>