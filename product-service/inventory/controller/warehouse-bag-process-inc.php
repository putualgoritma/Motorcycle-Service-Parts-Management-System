<?
if (isset($_REQUEST['warehouse_stock_id'])){
$warehouse_stock_id=$_REQUEST['warehouse_stock_id'];
}else{
$warehouse_stock_id=0;
}
$warehouse_stock_row=$global->db_row_join("warehouse_stock,warehouse","warehouse_stock.*,warehouse.warehouse_name,warehouse.warehouse_code","warehouse_stock_id = '".$warehouse_stock_id."' AND warehouse_stock.warehouse_code=warehouse.warehouse_code");
$author_row=$global->db_row("contact","contact_code,contact_name","contact_id='".$warehouse_stock_row['contact_code']."' AND contact_type = 'author'");
//cancel
if(isset($_REQUEST['Submitcancell']))
{
Header("location: warehouse-bag.php");
exit;
}
//process
if(isset($_POST['Submit']))
{
//form handling
$warehouse_stock_id=$_POST['warehouse_stock_id'];
$warehouse_stock_row=$global->db_row_join("warehouse_stock,warehouse","warehouse_stock.*,warehouse.warehouse_name,warehouse.warehouse_code","warehouse_stock_id = '".$warehouse_stock_id."' AND warehouse_stock.warehouse_code=warehouse.warehouse_code");
//get warehouse id
$warehouse_code=$warehouse_stock_row['warehouse_code'];
if(isset($_POST['warehouse_code'])){
	$warehouse_code=$_POST['warehouse_code'];
	}
$contact_code=$contact_glob['contact_code'];
$warehouse_stock_category=$warehouse_stock_row['warehouse_stock_category'];
$warehouse_stock_code=$warehouse_stock_row['warehouse_stock_code'];
$warehouse_stock_type=$warehouse_stock_row['warehouse_stock_type'];
//validate form
if($warehouse_code=="" || $contact_code==""){
	$global->error_message($msgform_lang['data_invalid']);
	}
if($warehouse_code!=""){

$warehouse_stock_description=$_POST['warehouse_stock_description'];
//init
$product_bcode_hidden="";
$warehouse_stock_details_quantity_hidden="";
$warehouse_stock_time=date("H:i:s");
//end form handling
//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
	//insert product_order
	$update_arr = array(
	'warehouse_stock_description'=>	$warehouse_stock_description,
	'warehouse_stock_code'=>	$warehouse_stock_code,
	'warehouse_code'=>	$warehouse_code,
	'warehouse_stock_type'=>	$warehouse_stock_type,
	'warehouse_stock_status'=>	'pmn',
	'warehouse_stock_register'=>	$valid_date['date_register'],
	'warehouse_stock_registernum'=>	$valid_date['date_registernum'],
	'contact_code'=>	$contact_code,
	'warehouse_stock_category'=>	$warehouse_stock_category,
	'warehouse_stock_time'=>	$warehouse_stock_time,
	);
	//insert
	if(!$global->product_order->update_warehouse_stock($update_arr,$warehouse_stock_id)){
		$global->product_order->error_message($global->product_order->err_msg);
		}else{
	//clear old list
	$global->db_delete("warehouse_stock_details","warehouse_stock_code='".$warehouse_stock_row['warehouse_stock_code']."'");
	//loop list
	if(isset($_POST['product_bcode_hidden'])){
	$warehouse_stock_details_quantity_hidden=$_POST['warehouse_stock_details_quantity_hidden'];
	$product_bprice_total=0;
	foreach($_POST['product_bcode_hidden'] as $key => $product_bcode_hidden_val ) {
		$product_code_arr=explode(" - ",$product_bcode_hidden_val);
		$product_row=$global->product_order->db_row("product","product_code,product_stock,product_bprice","product_code='".$product_code_arr[0]."'");
		$product_code=$product_row['product_code'];
		$product_bprice=$product_row['product_bprice'];
		$product_bprice_total +=$product_bprice*$warehouse_stock_details_quantity_hidden[$key];
		if($product_code!=""){
		//update product_order details
		$insert_arr = array(
		'warehouse_stock_code'=>	$warehouse_stock_code,
		'warehouse_stock_details_quantity'=>	$warehouse_stock_details_quantity_hidden[$key],
		'product_code'=>	$product_code,
		);
		$global->db_insert("warehouse_stock_details",$insert_arr);
		}}//end loop
	}//end if isset
	}}
	//redirect
	Header("location: warehouse-bag.php?confirm=".$form_header_lang['add_new_button']);
	exit;
}
?>

