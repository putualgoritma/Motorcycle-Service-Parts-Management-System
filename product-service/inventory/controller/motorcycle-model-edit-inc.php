<?
if (isset($_REQUEST['motorcycle_model_id'])){
$motorcycle_model_id=$_REQUEST['motorcycle_model_id'];
}else{
$motorcycle_model_id=0;
}
$motorcycle_model_row=$global->product_order->db_row("motorcycle_model","*","motorcycle_model_id='".$motorcycle_model_id."'");
//product code
$product_row=$global->product_order->db_row("product","*","product_code='".$motorcycle_model_row['product_code']."'");
$product_code=$product_row['product_code']." - ".$product_row['product_name'];
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$motorcycle_model_id=$_POST['motorcycle_model_id'];
$motorcycle_model_code=$_POST['motorcycle_model_code'];
$motorcycle_model_name=$_POST['motorcycle_model_name'];
$motorcycle_model_oil_service_sprice=$_POST['motorcycle_model_oil_service_sprice'];
//echo $motorcycle_model_id;
//end form handling

//get product kpb
$product_code_arr=explode(" - ",$_REQUEST['product_code']);
$product_code=$product_code_arr[0];
$product_code=$global->product_order->db_fldrow("product","product_code","product_code='".$product_code_arr[0]."'");

//insert items
$update_arr = array(
'motorcycle_model_code'=>	$motorcycle_model_code,
'motorcycle_model_name'=>	$motorcycle_model_name,
'motorcycle_model_oil_service_sprice'=>	$motorcycle_model_oil_service_sprice,
'product_code'=>	$product_code,
);
//update motorcycle_model
if(!$global->product_order->update_motorcycle_model($update_arr,$_POST['motorcycle_model_id'])){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: motorcycle-model.php");
Header("location: motorcycle-model.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>