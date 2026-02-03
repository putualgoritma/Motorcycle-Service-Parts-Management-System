<?
if (isset($_REQUEST['motorcycle_type_id'])){
$motorcycle_type_id=$_REQUEST['motorcycle_type_id'];
}else{
$motorcycle_type_id=0;
}
$motorcycle_type_row=$global->product_order->db_row("motorcycle_type","*","motorcycle_type_id='".$motorcycle_type_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$motorcycle_type_id=$_POST['motorcycle_type_id'];
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
$update_arr = array(
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
//update motorcycle_type
if(!$global->product_order->update_motorcycle_type($update_arr,$_POST['motorcycle_type_id'])){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: motorcycle-type.php");
Header("location: motorcycle-type.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>