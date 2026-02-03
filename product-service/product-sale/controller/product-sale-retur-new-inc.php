<?
$product_order_deposit=0;
if (isset($_REQUEST['po_code'])){
$po_code_arr=explode(" - ",$_REQUEST['po_code']);
$product_order_deposit=$global->db_fldrow("product_order","product_order_deposit","product_order_code='".$po_code_arr[0]."'");
}
//default
$product_order_sale_code_generation=$global->product_order->generator_product_order_sale_retur_code();

//cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: product-sale-retur.php");
exit;
}

if(isset($_POST['Submit']) || isset($_POST['Save']))
{
//form handling
//get users id
$users_code_arr=explode(" - ",$_POST['users_code']);
$users_code=$global->product_order->db_fldrow("users","users_code","users_code='".$users_code_arr[0]."'");

//get author id
$contact_code=$contact_glob['contact_code'];

//validate form
if($users_code=="" || $contact_code==""){
	$global->error_message($msgform_lang['data_invalid']);
	}
	
if($users_code!=""){
$users_code=$users_code;
$product_order_description=$_POST['product_order_description'];
$product_order_code=$_POST['product_order_code'];
$product_order_accountcredit=$global->product_order->book->account_special_get("income_trade");
if($_POST['product_order_sale_pay']=="credit"){
$product_order_accountcredit=$global->product_order->book->account_special_get("income_credit_trade");
}

//additional
$product_order_discount=$_POST['product_order_discount'];//additional disc final untuk list
$product_order_cost=str_replace(",","",$_POST['product_order_cost']);;//additional cost
$product_order_total_hidden=$_POST['product_order_total_hidden'];//grand total
$product_order_tax_val=$_POST['product_order_tax_hidden'];
$income_trade=$_POST['income_trade_hidden'];//profit total
$stock_trade=$_POST['stock_trade_hidden'];//profit total
//payment
$bank_code=$_POST['bank_code'];
$bank_no=$_POST['bank_no'];
$product_order_pay_method=$_POST['product_order_sale_pay'];
$product_orderdetails_sub_total=$_POST['product_orderdetails_total_hidden'];
//cek product_order_pay_method
if($product_order_pay_method=="cash"){
$product_order_accountdebit=$_POST['product_order_accountpay_cash'];
}else if($product_order_pay_method=="bank"){
$product_order_accountdebit=$_POST['product_order_accountpay_bank'];
}else{
$product_order_accountdebit=$_POST['product_order_accountpay_credit'];
}
//get ht id
$po_code=$_POST['po_code'];
$po_code_arr=explode(" - ",$_POST['po_code']);
$ht_order_id=$global->product_order->db_fldrow("product_order","product_order_id","product_order_code='".$po_code_arr[0]."'");
//init
$product_scode_hidden="";
$product_orderdetails_price_hidden="";
$product_orderdetails_quantity_hidden="";
$product_order_status='pmn';
if(isset($_POST['Save'])){
	$product_order_status='tmp';
	}
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//if exist regenerate
$date_nownum=intval(date("Y").date("m"));
if($global->tbldata_exist("product_order","product_order_id","product_order_code='".$product_order_code."'") || $valid_date['date_monthnum']!=$date_nownum){
	$product_order_code=$global->product_order->generator_product_order_sale_retur_code($valid_date['date_monthnum']);
	}
	//insert product_order
	$insert_arr = array(
	'product_order_description'=>	$product_order_description,
	'product_order_code'=>	$product_order_code,
	'users_code'=>	$users_code,
	'product_order_accountdebit'=>	$product_order_accountdebit,
	'product_order_accountcredit'=>	$product_order_accountcredit,
	'product_order_type'=>	'sr',
	'product_order_status'=>	$product_order_status,
	'product_order_register'=>	$valid_date['date_register'],
	'product_order_registernum'=>	$valid_date['date_registernum'],
	'contact_code'=>	$contact_code,
	'product_order_discount'=>	$product_order_discount,
	'product_order_cost'=>	$product_order_cost,
	'product_order_tax_val'=>	$product_order_tax_val,
	'product_order_income_trade'=>	$income_trade,
	'product_order_stock_trade'=>	$stock_trade,
	'bank_code'=>	$bank_code,
	'bank_no'=>	$bank_no,
	'product_order_pay_method'=>	$product_order_pay_method,
	'ht_order_id'=>	$ht_order_id,
	'product_order_register_hour'=>	date('H:i:s'),
	);
	//insert
	$insert_status=true;
	$insert_err="";
	if(isset($_POST['Save'])){
	if(!$global->product_order->save_product_order_sale_retur($insert_arr,$product_order_total_hidden)){
		$global->product_order->error_message($global->product_order->err_msg);
		$insert_status=false;
		$insert_err=$global->product_order->err_msg;
		}}
	if(isset($_POST['Submit'])){
	if(!$global->product_order->insert_product_order_sale_retur($insert_arr,$product_order_total_hidden)){
		$global->product_order->error_message($global->product_order->err_msg);
		$insert_status=false;
		$insert_err=$global->product_order->err_msg;
		}}
	
	
	if(!$insert_status){
	$global->product_order->error_message($insert_err);
	}else{
	$product_order_id=$global->db_lastid("product_order","product_order_id");

	//loop list
	if(isset($_POST['product_scode_hidden'])){
	$product_orderdetails_price_hidden=$_POST['product_orderdetails_price_hidden'];
	$product_orderdetails_bprice_hidden=$_POST['product_orderdetails_bprice_hidden'];
	$product_orderdetails_quantity_hidden=$_POST['product_orderdetails_quantity_hidden'];
	$product_orderdetails_discount_hidden=$_POST['product_orderdetails_discount_hidden'];
	$product_orderdetails_tax_hidden=$_POST['product_orderdetails_tax_hidden'];
	foreach($_POST['product_scode_hidden'] as $key => $product_scode_hidden_val ) {
		$product_code_arr=explode(" - ",$product_scode_hidden_val);
		$product_code=$global->product_order->db_fldrow("product","product_code","product_code='".$product_code_arr[0]."'");
		if($product_code!=""){
		//get disc item & final val
		$product_orderdetails_price_adisc2=$product_orderdetails_price_hidden[$key]*(1-(($product_orderdetails_discount_hidden[$key]+$product_order_discount)/100)+(($product_orderdetails_discount_hidden[$key]*$product_order_discount)/10000));
		$product_orderdetails_total=$product_orderdetails_price_adisc2*$product_orderdetails_quantity_hidden[$key];
		$product_orderdetails_cost_addon=($product_orderdetails_total/$product_orderdetails_sub_total)*$product_order_cost;
		//update product_order details
		$insert_arr = array(
		'product_order_id'=>	$product_order_id,
		'service_order_id'=>	0,
		'product_orderdetails_quantity'=>	$product_orderdetails_quantity_hidden[$key],
		'product_orderdetails_price'=>	$product_orderdetails_price_hidden[$key],
		'product_orderdetails_bprice'=>	$product_orderdetails_bprice_hidden[$key],
		'product_code'=>	$product_code,
		'product_orderdetails_register'=>	$valid_date['date_register'],
		'product_orderdetails_registernum'=>	$valid_date['date_registernum'],
		'product_orderdetails_status'=>	$product_order_status,
		'product_orderdetails_discount'=>	$product_orderdetails_discount_hidden[$key],
		'product_orderdetails_tax'=>	$product_orderdetails_tax_hidden[$key],
		'product_orderdetails_disc_final'=>	$product_order_discount,
		'product_orderdetails_total'=>	$product_orderdetails_total,
		'product_orderdetails_type'=>	'sr',
		'product_orderdetails_cost_addon'=>	$product_orderdetails_cost_addon,
		);
		$global->db_insert("product_orderdetails",$insert_arr);
		}}
	}
	//end loop
	}}
	//redirect
	Header("location: product-sale-retur.php?confirm=".$form_header_lang['add_new_button']);
	exit;
}
?>
