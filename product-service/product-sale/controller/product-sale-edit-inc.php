<?
if (isset($_REQUEST['product_order_id'])){
$product_order_id=$_REQUEST['product_order_id'];
}else{
$product_order_id=0;
}
$product_order_row=$global->db_row_join("product_order,users","product_order.*,users.users_name,users.users_code","product_order_id = '".$product_order_id."' AND product_order.users_code=users.users_code");
$product_orderdetails_row=$global->db_row("product_orderdetails","SUM(product_orderdetails_total) AS product_orderdetails_total","product_order_id='".$product_order_id."' AND product_orderdetails_status = 'tmp' GROUP BY product_order_id");
$product_orderdetails_total=$product_orderdetails_row['product_orderdetails_total'];
$author_row=$global->db_row("contact","contact_code,contact_name","contact_id='".$product_order_row['contact_code']."' AND contact_type = 'author'");
//get deposit
$product_order_deposit=0;
if($product_order_row['ht_order_id']>0){
	$product_order_deposit=$global->db_fldrow("product_order","product_order_deposit","product_order_id='".$product_order_row['ht_order_id']."'");
	}
$product_order_amount=$product_orderdetails_total+$product_order_row['product_order_tax_val']+$product_order_row['product_order_cost']-$product_order_deposit;
//format
$product_order_tax_val_format=$global->num_format2($product_order_row['product_order_tax_val']);
$product_orderdetails_total_format=$global->num_format2($product_orderdetails_total);
$product_order_amount_format=$global->num_format2($product_order_amount);
//cancel
if(isset($_REQUEST['Submitcancell']))
{
Header("location: product-sale.php");
exit;
}
//process
if(isset($_POST['Submit']))
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
$product_order_id=$_POST['product_order_id'];
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
//init
$product_scode_hidden="";
$product_orderdetails_price_hidden="";
$product_orderdetails_quantity_hidden="";
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//if exist regenerate
$product_order_row=$global->db_row("product_order","product_order_registernum,ht_order_id","product_order_id='".$product_order_id."'");
if($global->tbldata_exist("product_order","product_order_id","product_order_code='".$product_order_code."' AND product_order_id!='".$product_order_id."'") || $valid_date['date_registernum']!=$product_order_row['product_order_registernum']){
	$product_order_code=$global->product_order->generator_product_order_sale_code("pmn",$valid_date['date_monthnum']);
	}
	//insert product_order
	$update_arr = array(
	'product_order_description'=>	$product_order_description,
	'product_order_code'=>	$product_order_code,
	'users_code'=>	$users_code,
	'product_order_accountdebit'=>	$product_order_accountdebit,
	'product_order_accountcredit'=>	$product_order_accountcredit,
	'product_order_type'=>	'si',
	'product_order_status'=>	'tmp',
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
	'product_order_register_hour'=>	date('H:i:s'),
);
	//insert
	if(!$global->product_order->saveupdate_product_order_sale($update_arr,$product_order_id,$product_order_total_hidden)){
		$global->product_order->error_message($global->product_order->err_msg);
		}else{

	//clear old list
	$global->product_order->ht_reset_realization($product_order_id);
	$global->db_delete("product_orderdetails","product_order_id='".$product_order_id."'");
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
		'product_orderdetails_status'=>	'tmp',
		'product_orderdetails_discount'=>	$product_orderdetails_discount_hidden[$key],
		'product_orderdetails_tax'=>	$product_orderdetails_tax_hidden[$key],
		'product_orderdetails_disc_final'=>	$product_order_discount,
		'product_orderdetails_total'=>	$product_orderdetails_total,
		'product_orderdetails_type'=>	'si',
		'product_orderdetails_cost_addon'=>	$product_orderdetails_cost_addon,
		);
		$global->db_insert("product_orderdetails",$insert_arr);
		}}
	}
	//end loop
	if($product_order_row['ht_order_id']>0){
		$global->product_order->ht_realization($product_order_id,$product_order_row['ht_order_id']);
		$global->product_order->ht_realization_update_status($product_order_row['ht_order_id']);
		}
	}}
	//redirect
	Header("location: product-sale.php?confirm=".$form_header_lang['add_new_button']);
	exit;
}
?>
