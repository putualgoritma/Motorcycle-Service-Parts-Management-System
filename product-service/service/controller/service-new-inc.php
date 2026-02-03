<?
//default
$service_order_sale_code_generation=$global->product_order->generator_service_order_sale_code();
$service_order_queue_generation=$global->product_order->generator_service_order_sale_queue();

//cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: service.php");
exit;
}

if(isset($_POST['Submit']))
{
//form handling
$validate_form=true;
$validate_err="";
//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$validate_form=false;
	$validate_err .=$global->error_message($msgform_lang['date_invalid'])."<br>";
	}

//validate users 1
//cek not exist
if($_POST['users_code_hidden']==0){
	//create new generate code
	$users_code=$global->users->generator_customer();
	//insert users
	$insert_arr = array(
	'users_register'=>	$valid_date['date_register'],
	'users_registernum'=>	$valid_date['date_registernum'],
	'users_code'=>	$users_code,
	'users_type'=>	'customer',
	'users_status'=>	$_POST['users_status'],
	'users_idnumber'=>	$_POST['users_idnumber'],
	'users_name'=>	$_POST['users_name'],
	'users_address'=>	$_POST['users_address'],
	'users_phone'=>	$_POST['users_phone'],
	'users_email'=>	$_POST['users_email'],
	'religion_code'=>	$global->typehead_cvt($_POST['religion_code']),
	'village_code'=>	$global->typehead_cvt($_POST['village_code']),
	'area_code'=>	$global->typehead_cvt($_POST['area_code']),
	'users_group_code'=>	$_POST['users_group_code'],
	);
	//create asset fixed
	if(!$global->users->create_users($insert_arr)){
		$validate_form=false;
		$validate_err .=$global->users->error_message($global->users->err_msg)."<br>";
		}
	}else{
	//get users id
	$users_code=$global->typehead_cvt($_POST['users_code']);
	$users_id=$global->db_fldrow("users","users_id","users_code='".$users_code."'");
	//update users
	$update_arr = array(
	'users_code'=>	$users_code,
	'users_type'=>	'customer',
	'users_status'=>	$_POST['users_status'],
	'users_idnumber'=>	$_POST['users_idnumber'],
	'users_name'=>	$_POST['users_name'],
	'users_address'=>	$_POST['users_address'],
	'users_phone'=>	$_POST['users_phone'],
	'users_email'=>	$_POST['users_email'],
	'religion_code'=>	$global->typehead_cvt($_POST['religion_code']),
	'village_code'=>	$global->typehead_cvt($_POST['village_code']),
	'area_code'=>	$global->typehead_cvt($_POST['area_code']),
	'users_group_code'=>	$_POST['users_group_code'],
	);
	//create asset fixed
	if(!$global->users->update_users($update_arr,$users_id)){
		$validate_form=false;
		$validate_err .=$global->users->error_message($global->users->err_msg)."<br>";
		}
	}
//validate users 2
//if users_clone is checked
if(isset($_POST['users_clone'])){
	//set pembawa = pemilik (get users_code)
	$users2_code=$users_code;
	}else{
	if($_POST['users2_code_hidden']==0){
		//create new generate code
		$users2_code=$global->users->generator_customer();
		//insert users
		$insert_arr = array(
		'users_register'=>	$valid_date['date_register'],
		'users_registernum'=>	$valid_date['date_registernum'],
		'users_code'=>	$users2_code,
		'users_type'=>	'customer',
		'users_status'=>	$_POST['users2_status'],
		'users_idnumber'=>	$_POST['users2_idnumber'],
		'users_name'=>	$_POST['users2_name'],
		'users_address'=>	$_POST['users2_address'],
		'users_phone'=>	$_POST['users2_phone'],
		'users_email'=>	$_POST['users2_email'],
		'religion_code'=>	$global->typehead_cvt($_POST['religion2_code']),
		'village_code'=>	$global->typehead_cvt($_POST['village2_code']),
		'area_code'=>	$global->typehead_cvt($_POST['area2_code']),
		);
		//create asset fixed
		if(!$global->users->create_users($insert_arr)){
			$validate_form=false;
			$validate_err .=$global->users->error_message($global->users->err_msg)."<br>";
			}
		}else{
		//get users id
		$users2_code=$global->typehead_cvt($_POST['users2_code']);
		$users2_id=$global->db_fldrow("users","users_id","users_code='".$users2_code."'");
		//update users
		$update_arr = array(
		'users_code'=>	$users2_code,
		'users_type'=>	'customer',
		'users_status'=>	$_POST['users2_status'],
		'users_idnumber'=>	$_POST['users2_idnumber'],
		'users_name'=>	$_POST['users2_name'],
		'users_address'=>	$_POST['users2_address'],
		'users_phone'=>	$_POST['users2_phone'],
		'users_email'=>	$_POST['users2_email'],
		'religion_code'=>	$global->typehead_cvt($_POST['religion2_code']),
		'village_code'=>	$global->typehead_cvt($_POST['village2_code']),
		'area_code'=>	$global->typehead_cvt($_POST['area2_code']),
		);
		//create asset fixed
		if(!$global->users->update_users($update_arr,$users2_id)){
			$validate_form=false;
			$validate_err .=$global->users->error_message($global->users->err_msg)."<br>";
			}
		}
	}

//update or insert motorcycle
//date validate
$valid_date2=$global->valid_date($_POST['motorcycle_buy_register']);
if(!$valid_date2['is_valid']){
	//$global->error_message($msgform_lang['date_invalid']);
	$motorcycle_buy_register="";
	$motorcycle_buy_registernum="";
	}else{
	$motorcycle_buy_register=$valid_date2['date_register'];
	$motorcycle_buy_registernum=$valid_date2['date_registernum'];
	}
$motorcycle_code=$global->typehead_cvt($_POST['motorcycle_code']);
$insert_arr = array(
'motorcycle_code'=>	$motorcycle_code,
'motorcycle_type_code'=>	$global->typehead_cvt($_POST['motorcycle_type_code']),
'users_code'=>	$users_code,
'color_code'=>	$global->typehead_cvt($_POST['color_code']),
'motorcycle_manufacture'=>	$_POST['motorcycle_manufacture'],
'motorcycle_frame_no'=>	$_POST['motorcycle_frame_no'],
'motorcycle_machine_no'=>	$_POST['motorcycle_machine_no'],
'motorcycle_buy_register'=>	$motorcycle_buy_register,
'motorcycle_buy_registernum'=>	$motorcycle_buy_registernum?$motorcycle_buy_registernum:0,
'motorcycle_book_service_no'=>	$_POST['motorcycle_book_service_no'],
'motorcycle_description'=>	$_POST['motorcycle_description'],
);
$global->db_insert_update('motorcycle',$insert_arr,'motorcycle_code');

//cek if ready stock
$ready_stock_status=false;
$product_ot_of_stock="";
if(isset($_POST['product_scode_hidden']) && $company['company_stock_block']==1){
foreach($_POST['product_scode_hidden'] as $key => $product_scode_hidden_val ) {
	$product_orderdetails_qty=$_POST['product_orderdetails_quantity_hidden'][$key];
	$product_code_arr=explode(" - ",$product_scode_hidden_val);
	$product_code_row=$global->db_row("product","*","product_code='".$product_code_arr[0]."'");
	$ready_stock=$product_code_row['product_stock']-$product_code_row['product_stock_so']-$product_orderdetails_qty;
	if($ready_stock<0){
		$ready_stock_status=true;
		$product_ot_of_stock=$product_code_row['product_code']."-".$product_code_row['product_name']." ";
		}
	}}
	
//validate form
if($validate_form==false || $motorcycle_code==""){
	$validate_err .=$msgform_lang['data_invalid'];
	$global->error_message($validate_err);
	}
else if($ready_stock_status){
	$global->error_message($product_ot_of_stock.$global->product_order->product_order_lang['msgform_product_order_lang']['out_of_stock']);
	}
else{
//if valid
if($motorcycle_code!=""){
$motorcycle_code=$motorcycle_code;
$service_order_description=$_POST['service_order_description'];
$service_order_code=$_POST['service_order_code'];
$service_order_accountcredit=$global->product_order->book->account_special_get("income_trade");

//get author id
$contact_code=$contact_glob['contact_code'];
//additional
$service_order_discount=$_POST['service_order_discount'];//additional disc final untuk list
$service_order_cost=str_replace(",","",$_POST['service_order_cost']);;//additional cost
$service_order_total_hidden=$_POST['service_order_total_hidden'];//grand total
$service_order_tax_val=$_POST['service_order_tax_hidden'];
$income_trade=$_POST['income_trade_hidden'];//profit total
$stock_trade=$_POST['stock_trade_hidden'];//profit total
$service_order_queue=$_POST['service_order_queue'];
$income_service=$_POST['income_service_hidden'];//profit total
$service_order_km_now=$_POST['service_order_km_now'];
$service_order_km_next=$_POST['service_order_km_next'];
$service_order_reason=$_POST['service_order_reason'];
$service_order_usersowner_rel=$_POST['service_order_usersowner_rel'];
//express
$service_order_express=$_POST['service_order_express'];
//kpb
$service_order_kpb_service=$_POST['service_order_kpb_service_hidden'];
$service_order_kpb_product=$_POST['service_order_kpb_product_hidden'];
$service_order_discount_kpb=$_POST['service_order_discount_kpb'];
$service_order_tax_kpb=$_POST['service_order_tax_kpb'];
$income_trade_kpb=$_POST['income_trade_kpb'];
$stock_trade_kpb=$_POST['stock_trade_kpb'];
$income_service_kpb=$_POST['income_service_kpb'];
//if exist regenerate
$date_nownum=intval(date("Y").date("m").date("d"));
if($global->tbldata_exist("service_order","service_order_id","service_order_code='".$service_order_code."'") || $valid_date['date_registernum']!=$date_nownum){
$service_order_code=$global->product_order->generator_service_order_sale_code($valid_date['date_registernum']);
$service_order_queue=$global->product_order->generator_service_order_sale_queue($valid_date['date_registernum']);
}
//payment
$service_order_pay_method=$_POST['service_order_buy_pay'];
$service_orderdetails_sub_total=$_POST['service_orderdetails_total_hidden'];
//cek service_order_pay_method
if($service_order_pay_method=="cash"){
$service_order_accountdebit=$_POST['service_order_accountpay_cash'];
}else if($service_order_pay_method=="bank"){
$service_order_accountdebit=$_POST['service_order_accountpay_bank'];
}else{
$service_order_accountdebit=$_POST['service_order_accountpay_credit'];
}
//init
$service_scode_hidden="";
$service_orderdetails_price_hidden="";
$service_orderdetails_quantity_hidden="";
//end form handling

//insert service_order
	$insert_arr = array(
	'service_order_description'=>	$service_order_description,
	'service_order_code'=>	$service_order_code,
	'users_code'=>	$users2_code,
	'motorcycle_code'=>	$motorcycle_code,
	'service_order_accountdebit'=>	$service_order_accountdebit,
	'service_order_accountcredit'=>	$service_order_accountcredit,
	'service_order_type'=>	'si',
	'service_order_status'=>	'tmp',
	'service_order_register'=>	$valid_date['date_register'],
	'service_order_registernum'=>	$valid_date['date_registernum'],
	'contact_code'=>	$contact_code,
	'service_order_discount'=>	$service_order_discount,
	'service_order_cost'=>	$service_order_cost,
	'service_order_tax_val'=>	$service_order_tax_val,
	'service_order_income_trade'=>	$income_trade,
	'service_order_stock_trade'=>	$stock_trade,
	'service_order_pay_method'=>	$service_order_pay_method,
	'service_order_queue'=>	$service_order_queue,
	'service_order_income_service'=>	$income_service,
	'service_order_km_now'=>	$service_order_km_now,
	'service_order_km_next'=>	$service_order_km_next,
	'service_order_kpb_service'=>	$service_order_kpb_service,
	'service_order_kpb_product'=>	$service_order_kpb_product,
	'service_order_discount_kpb'=>	$service_order_discount_kpb,
	'service_order_tax_kpb'=>	$service_order_tax_kpb,
	'income_trade_kpb'=>	$income_trade_kpb,
	'stock_trade_kpb'=>	$stock_trade_kpb,
	'income_service_kpb'=>	$income_service_kpb,
	'service_order_express'=>	$service_order_express,
	'service_order_register_hour'=>	date('H:i:s'),
	'service_order_reason'=>	$service_order_reason,
	'service_order_usersowner_rel'=>	$service_order_usersowner_rel,
	'service_order_memo'=>	$_POST['service_order_memo']?$_POST['service_order_memo']:'',
	);
	//insert
	if(!$global->product_order->save_service_order_sale($insert_arr)){
		$global->product_order->error_message($global->product_order->err_msg);
		}else{
	$service_order_id=$global->db_lastid("service_order","service_order_id");

	//loop list 1
	if(isset($_POST['service_scode_hidden'])){
	$service_orderdetails_price_hidden=$_POST['service_orderdetails_price_hidden'];
	$service_orderdetails_bprice_hidden=$_POST['service_orderdetails_bprice_hidden'];
	$service_orderdetails_quantity_hidden=$_POST['service_orderdetails_quantity_hidden'];
	$service_orderdetails_discount_hidden=$_POST['service_orderdetails_discount_hidden'];
	$service_orderdetails_tax_hidden=$_POST['service_orderdetails_tax_hidden'];
	$kpb_service_yesno_hidden=$_POST['kpb_service_yesno_hidden'];
	foreach($_POST['service_scode_hidden'] as $key => $service_scode_hidden_val ) {
		$service_code_arr=explode(" - ",$service_scode_hidden_val);
		$service_code=$global->product_order->db_fldrow("service","service_code","service_code='".$service_code_arr[0]."'");
		if($service_code!=""){
		//get disc item & final val
		$service_orderdetails_price_adisc2=$service_orderdetails_price_hidden[$key]*(1-(($service_orderdetails_discount_hidden[$key]+$service_order_discount)/100)+(($service_orderdetails_discount_hidden[$key]*$service_order_discount)/10000));
		$service_orderdetails_total=$service_orderdetails_price_adisc2*$service_orderdetails_quantity_hidden[$key];
		if($service_orderdetails_sub_total>0){
		$service_orderdetails_cost_addon=($service_orderdetails_total/$service_orderdetails_sub_total)*$service_order_cost;
		}else{
		$service_orderdetails_cost_addon=0;
		}
		//update service_order details
		$insert_arr = array(
		'service_order_id'=>	$service_order_id,
		'service_orderdetails_quantity'=>	$service_orderdetails_quantity_hidden[$key],
		'service_orderdetails_price'=>	$service_orderdetails_price_hidden[$key],
		'service_orderdetails_bprice'=>	$service_orderdetails_bprice_hidden[$key],
		'service_code'=>	$service_code,
		'service_orderdetails_register'=>	$valid_date['date_register'],
		'service_orderdetails_registernum'=>	$valid_date['date_registernum'],
		'service_orderdetails_status'=>	'tmp',
		'service_orderdetails_discount'=>	$service_orderdetails_discount_hidden[$key],
		'service_orderdetails_tax'=>	$service_orderdetails_tax_hidden[$key]?$service_orderdetails_tax_hidden[$key]:0,
		'service_orderdetails_disc_final'=>	$service_order_discount,
		'service_orderdetails_total'=>	$service_orderdetails_total,
		'service_orderdetails_type'=>	'si',
		'service_orderdetails_cost_addon'=>	$service_orderdetails_cost_addon,
		'kpb_yesno'=>	$kpb_service_yesno_hidden[$key],
		);
		$global->db_insert("service_orderdetails",$insert_arr);
		}}
	}
	//end loop 1
	//loop list 2
	if(isset($_POST['product_scode_hidden'])){
	$product_orderdetails_price_hidden=$_POST['product_orderdetails_price_hidden'];
	$product_orderdetails_bprice_hidden=$_POST['product_orderdetails_bprice_hidden'];
	$product_orderdetails_quantity_hidden=$_POST['product_orderdetails_quantity_hidden'];
	$product_orderdetails_discount_hidden=$_POST['product_orderdetails_discount_hidden'];
	$product_orderdetails_tax_hidden=$_POST['product_orderdetails_tax_hidden'];
	$kpb_product_yesno_hidden=$_POST['kpb_product_yesno_hidden'];
	foreach($_POST['product_scode_hidden'] as $key => $product_scode_hidden_val ) {
		$product_code_arr=explode(" - ",$product_scode_hidden_val);
		$product_code=$global->product_order->db_fldrow("product","product_code","product_code='".$product_code_arr[0]."'");
		if($product_code!=""){
		//get disc item & final val
		$product_orderdetails_price_adisc2=$product_orderdetails_price_hidden[$key]*(1-(($product_orderdetails_discount_hidden[$key]+$service_order_discount)/100)+(($product_orderdetails_discount_hidden[$key]*$service_order_discount)/10000));
		$product_orderdetails_total=$product_orderdetails_price_adisc2*$product_orderdetails_quantity_hidden[$key];
		if($service_orderdetails_sub_total>0){
		$product_orderdetails_cost_addon=($product_orderdetails_total/$service_orderdetails_sub_total)*$service_order_cost;
		}else{
		$product_orderdetails_cost_addon=0;
		}
		//update product_order details
		$insert_arr = array(
		'service_order_id'=>	$service_order_id,
		'product_order_id'=>	0,
		'product_orderdetails_quantity'=>	$product_orderdetails_quantity_hidden[$key],
		'product_orderdetails_price'=>	$product_orderdetails_price_hidden[$key],
		'product_orderdetails_bprice'=>	$product_orderdetails_bprice_hidden[$key],
		'product_code'=>	$product_code,
		'product_orderdetails_register'=>	$valid_date['date_register'],
		'product_orderdetails_registernum'=>	$valid_date['date_registernum'],
		'product_orderdetails_status'=>	'tmp',
		'product_orderdetails_discount'=>	$product_orderdetails_discount_hidden[$key],
		'product_orderdetails_tax'=>	$product_orderdetails_tax_hidden[$key]?$product_orderdetails_tax_hidden[$key]:0,
		'product_orderdetails_disc_final'=>	$service_order_discount,
		'product_orderdetails_total'=>	$product_orderdetails_total,
		'product_orderdetails_type'=>	'so',
		'product_orderdetails_cost_addon'=>	$product_orderdetails_cost_addon,
		'kpb_yesno'=>	$kpb_product_yesno_hidden[$key],
		);
		$global->db_insert("product_orderdetails",$insert_arr);
		}}
	}
	//end loop 2
	}}
	//redirect
	Header("location: service.php?confirm=".$form_header_lang['add_new_button']."&service_order_status=tmp&service_order_id=".$service_order_id);
	exit;
}}
?>
