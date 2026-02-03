<?
if (isset($_REQUEST['service_order_id'])){
$service_order_id=$_REQUEST['service_order_id'];
}else{
$service_order_id=0;
}
$service_order_row=$global->db_row_join("service_order,users","service_order.*,users.users_name,users.users_code","service_order_id = '".$service_order_id."' AND service_order.users_code=users.users_code");
$service_orderdetails_row=$global->db_row("service_orderdetails","SUM(service_orderdetails_total) AS service_orderdetails_total","service_order_id='".$service_order_id."' AND service_orderdetails_status = 'pmn' GROUP BY service_order_id");
$service_orderdetails_total=$service_orderdetails_row['service_orderdetails_total'];
$author_row=$global->db_row("contact","contact_code,contact_name","contact_id='".$service_order_row['contact_code']."' AND contact_type = 'author'");
$service_order_amount=$service_orderdetails_total+$service_order_row['service_order_tax_val']+$service_order_row['service_order_cost'];
//format
$service_order_tax_val_format=$global->num_format2($service_order_row['service_order_tax_val']);
$service_orderdetails_total_format=$global->num_format2($service_orderdetails_total);
$service_order_amount_format=$global->num_format2($service_order_amount);
//cancel
if(isset($_REQUEST['Submitcancell']))
{
Header("location: service-vendor.php");
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
$author_code=$_POST['author_code'];
$author_code_arr=explode(" - ",$_POST['author_code']);
$contact_code=$global->product_order->db_fldrow("contact","contact_id","contact_code='".$author_code_arr[0]."' AND contact_type='author'");

//validate form
if($users_code=="" || $contact_code==""){
	$global->error_message($msgform_lang['data_invalid']);
	}

if($users_code!=""){
$service_order_id=$_POST['service_order_id'];
$users_code=$users_code;
$service_order_description=$_POST['service_order_description'];
$service_order_code=$_POST['service_order_code'];
$service_order_accountdebit=$global->product_order->book->account_special_get("service_vendor");

//additional
$service_order_discount=$_POST['service_order_discount'];//additional disc final untuk list
$service_order_cost=str_replace(",","",$_POST['service_order_cost']);;//additional cost
$service_order_total_hidden=$_POST['service_order_total_hidden'];//grand total
$service_order_tax_val=$_POST['service_order_tax_hidden'];
$service_order_queue=$_POST['service_order_queue'];

//payment
$bank_code="";
$bank_no=0;
$service_order_pay_method=$_POST['service_vendor_pay'];
$service_orderdetails_sub_total=$_POST['service_orderdetails_total_hidden'];
//cek service_order_pay_method
if($service_order_pay_method=="cash"){
$service_order_accountcredit=$_POST['service_order_accountpay_cash'];
}else if($service_order_pay_method=="bank"){
$bank_code=$_POST['bank_code'];
$bank_no=$_POST['bank_no'];
$service_order_accountcredit=$_POST['service_order_accountpay_bank'];
}else{
$service_order_accountcredit=$_POST['service_order_accountpay_credit'];
}
//init
$service_bcode_hidden="";
$service_orderdetails_price_hidden="";
$service_orderdetails_quantity_hidden="";
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//if exist regenerate
$service_order_row=$global->db_row("service_order","service_order_registernum","service_order_id='".$service_order_id."'");
if($global->tbldata_exist("service_order","service_order_id","service_order_code='".$service_order_code."' AND service_order_id!='".$service_order_id."'") || $valid_date['date_registernum']!=$service_order_row['service_order_registernum']){
	$service_order_code=$global->product_order->generator_service_vendor_code("pmn",$valid_date['date_monthnum']);
	$service_order_queue=$global->product_order->generator_service_vendor_queue($valid_date['date_monthnum']);
	}
	//insert service_order
	$update_arr = array(
	'service_order_description'=>	$service_order_description,
	'service_order_code'=>	$service_order_code,
	'users_code'=>	$users_code,
	'service_order_accountdebit'=>	$service_order_accountdebit,
	'service_order_accountcredit'=>	$service_order_accountcredit,
	'service_order_type'=>	'pi',
	'service_order_status'=>	'pmn',
	'service_order_register'=>	$valid_date['date_register'],
	'service_order_registernum'=>	$valid_date['date_registernum'],
	'contact_code'=>	$contact_code,
	'service_order_discount'=>	$service_order_discount,
	'service_order_cost'=>	$service_order_cost,
	'service_order_tax_val'=>	$service_order_tax_val,
	'bank_code'=>	$bank_code,
	'bank_no'=>	$bank_no,
	'service_order_pay_method'=>	$service_order_pay_method,
	'service_order_queue'=>	$service_order_queue,

	);
	//insert
	if(!$global->product_order->update_service_vendor($update_arr,$service_order_id,$service_order_total_hidden)){
		$global->product_order->error_message($global->product_order->err_msg);
		}else{

	//clear old list
	$global->db_delete("service_orderdetails","service_order_id='".$service_order_id."'");
	//loop list
	if(isset($_POST['service_bcode_hidden'])){
	$service_orderdetails_price_hidden=$_POST['service_orderdetails_price_hidden'];
	$service_orderdetails_quantity_hidden=$_POST['service_orderdetails_quantity_hidden'];
	$service_orderdetails_discount_hidden=$_POST['service_orderdetails_discount_hidden'];
	$service_orderdetails_tax_hidden=$_POST['service_orderdetails_tax_hidden'];
	foreach($_POST['service_bcode_hidden'] as $key => $service_bcode_hidden_val ) {
		$service_code_arr=explode(" - ",$service_bcode_hidden_val);
		$service_code=$global->product_order->db_fldrow("service","service_code","service_code='".$service_code_arr[0]."'");
		if($service_code!=""){
		//get disc item & final val
		$service_orderdetails_price_adisc2=$service_orderdetails_price_hidden[$key]*(1-(($service_orderdetails_discount_hidden[$key]+$service_order_discount)/100)+(($service_orderdetails_discount_hidden[$key]*$service_order_discount)/10000));
		$service_orderdetails_total=$service_orderdetails_price_adisc2*$service_orderdetails_quantity_hidden[$key];
		$service_orderdetails_cost_addon=($service_orderdetails_total/$service_orderdetails_sub_total)*$service_order_cost;
		//update service_order details
		$insert_arr = array(
		'service_order_id'=>	$service_order_id,
		'service_orderdetails_quantity'=>	$service_orderdetails_quantity_hidden[$key],
		'service_orderdetails_price'=>	$service_orderdetails_price_hidden[$key],
		'service_code'=>	$service_code,
		'service_orderdetails_register'=>	$valid_date['date_register'],
		'service_orderdetails_registernum'=>	$valid_date['date_registernum'],
		'service_orderdetails_status'=>	'pmn',
		'service_orderdetails_discount'=>	$service_orderdetails_discount_hidden[$key],
		'service_orderdetails_tax'=>	$service_orderdetails_tax_hidden[$key],
		'service_orderdetails_disc_final'=>	$service_order_discount,
		'service_orderdetails_total'=>	$service_orderdetails_total,
		'service_orderdetails_type'=>	'pi',
		'service_orderdetails_cost_addon'=>	$service_orderdetails_cost_addon,

		);
		$global->db_insert("service_orderdetails",$insert_arr);
		}
		}//end loop
	}
	}}
	//redirect
	Header("location: service-vendor.php?confirm=".$form_header_lang['add_new_button']);
	exit;
}
?>
