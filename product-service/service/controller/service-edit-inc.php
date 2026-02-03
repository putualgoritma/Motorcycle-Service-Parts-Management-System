<?
//service_order_id
if (isset($_REQUEST['service_order_id']) && $_REQUEST['service_order_id']>0){
$service_order_id=$_REQUEST['service_order_id'];
}else{
$service_order_id=0;
Header("location: service.php");
exit;
}
//service_order_status
if (isset($_REQUEST['service_order_status'])){
$service_order_status=$_REQUEST['service_order_status'];
}else{
$service_order_status="";
}
//btn_status
if (isset($_REQUEST['btn_status']) && $_REQUEST['btn_status']!="btn_edit"){
$btn_status=$_REQUEST['btn_status'];
}else{
$btn_status="";
}
//row edit
$service_order_row=$global->db_row_join("service_order,users","service_order.*,users.users_name,users.users_code","service_order_id = '".$service_order_id."' AND service_order.users_code=users.users_code");
$service_orderdetails_row=$global->db_row("service_orderdetails","SUM(service_orderdetails_total) AS service_orderdetails_total","service_order_id='".$service_order_id."' GROUP BY service_order_id");
$product_orderdetails_row=$global->db_row("product_orderdetails","SUM(product_orderdetails_total) AS product_orderdetails_total","service_order_id='".$service_order_id."' GROUP BY service_order_id");
$service_orderdetails_total=$service_orderdetails_row['service_orderdetails_total']+$product_orderdetails_row['product_orderdetails_total'];
$service_order_amount=($service_orderdetails_total+$service_order_row['service_order_tax_val']+$service_order_row['service_order_cost'])-($service_order_row['service_order_kpb_service']+$service_order_row['service_order_kpb_product']);
//author code
$author_row=$global->db_row("contact","contact_code,contact_name","contact_id='".$service_order_row['contact_code']."' AND contact_type = 'author'");
$author_code="";
if($author_row['contact_code']!=""){
	$author_code=$author_row['contact_code']." - ".$author_row['contact_name'];
	}
//staff code
$staff_row=$global->db_row("staff","staff_code,staff_name","staff_code='".$service_order_row['staff_code']."'");
$staff_code="";
if($staff_row['staff_code']!=""){
	$staff_code=$staff_row['staff_code'];
	}
//motorcycle code
$motorcycle_row=$global->db_row("motorcycle","*","motorcycle_code = '".$service_order_row['motorcycle_code']."'");
$users_row=$global->db_row("users","users_name,users_code","users_code = '".$motorcycle_row['users_code']."'");
$users_name=$users_row['users_name'];
$motorcycle_code="";
if($motorcycle_row['motorcycle_code']!=""){
	$motorcycle_code=$motorcycle_row['motorcycle_code'];
	}
$users_code=$motorcycle_row['users_code'];

//motorcycle
$motorcycle_frame_no=$motorcycle_row['motorcycle_frame_no']."/".$motorcycle_row['motorcycle_machine_no'];
$color_name=$global->product_order->db_fldrow("color","color_name","color_code='".$motorcycle_row['color_code']."'");
$motorcycle_type_row=$global->product_order->db_row("motorcycle_type","*","motorcycle_type_code='".$motorcycle_row['motorcycle_type_code']."'");
$motorcycle_type_name=$motorcycle_type_row['motorcycle_type_name'];
$motorcycle_type_name=$motorcycle_type_name."/".$color_name."/".$motorcycle_row['motorcycle_manufacture'];
$motorcycle_type_code=$motorcycle_type_row['motorcycle_type_code']." - ".$motorcycle_type_row['motorcycle_type_name'];
//format
$service_order_tax_val_format=$global->num_format2($service_order_row['service_order_tax_val']);
$service_orderdetails_total_format=$global->num_format2($service_orderdetails_total);
$service_order_amount_format=$global->num_format2($service_order_amount);
//user code pembawa
$users_row=$global->product_order->db_row("users","*","users_code='".$service_order_row['users_code']."'");
$users2_code="";
if($users_row['users_code']!=""){
	$users2_code=$users_row['users_code'];
	}
//if online set default
if($service_order_row['service_order_code']==""){
$service_order_row['service_order_code']=$global->product_order->generator_service_order_sale_code();
}
if($service_order_row['service_order_queue']==0){
$service_order_row['service_order_queue']=$global->product_order->generator_service_order_sale_queue();
}
//if pemilik = pembawa => users_clone checked
$users_clone_check=0;
if($users_code==$users2_code){
$users_clone_check=1;
}
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
	//get current so relate to service_order_id
	$product_orderdetails_qty_old=$global->db_fldrow("product_orderdetails","product_orderdetails_quantity","service_order_id='".$service_order_id."' AND product_code='".$product_code_arr[0]."'");
	$product_code_row=$global->db_row("product","*","product_code='".$product_code_arr[0]."'");
	$ready_stock=$product_code_row['product_stock']-$product_code_row['product_stock_so']-($product_orderdetails_qty-$product_orderdetails_qty_old);
	if($ready_stock<0){
		$ready_stock_status=true;
		$product_ot_of_stock=$product_code_row['product_code']."-".$product_code_row['product_name']." ";
		}
	}}
	
//get staff
$staff_code=$global->typehead_cvt($_POST['staff_code']);;
$staff_code=$global->product_order->db_fldrow("staff","staff_code","staff_code='".$staff_code."'");
	
//validate form
if($validate_form==false || $motorcycle_code==""){
	$validate_err .=$msgform_lang['data_invalid'];
	$global->error_message($validate_err);
	}
else if($_POST['service_order_status']!="" && $staff_code==""){
	$global->error_message($msgform_lang['data_invalid']);
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
//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//if exist regenerate
$service_order_row=$global->db_row("service_order","service_order_registernum,service_order_check_in,service_order_check_d,service_order_check_h,service_order_check_m","service_order_id='".$service_order_id."'");
if($global->tbldata_exist("service_order","service_order_id","service_order_code='".$service_order_code."' AND service_order_id!='".$service_order_id."'") || $valid_date['date_registernum']!=$service_order_row['service_order_registernum']){
$service_order_code=$global->product_order->generator_service_order_sale_code($valid_date['date_registernum']);
$service_order_queue=$global->product_order->generator_service_order_sale_queue($valid_date['date_registernum']);
}
//payment
$service_order_pay_method=$_POST['service_order_buy_pay'];
$service_orderdetails_sub_total=$_POST['service_orderdetails_total_hidden'];
//cek service_order_pay_method
if($service_order_pay_method=="cash"){
$service_order_accountdebit=$_POST['service_order_accountpay_cash'];
$service_order_accountcredit=$global->product_order->book->account_special_get("income_trade");
}else if($service_order_pay_method=="bank"){
$service_order_accountdebit=$_POST['service_order_accountpay_bank'];
$service_order_accountcredit=$global->product_order->book->account_special_get("income_trade");
}else{
$service_order_accountdebit=$_POST['service_order_accountpay_credit'];
$service_order_accountcredit=$global->product_order->book->account_special_get("income_credit_trade");
}
//init duration
$service_order_check_in=$service_order_row['service_order_check_in'];
$service_order_check_out=$service_order_row['service_order_check_out'];
$service_order_check_d=$service_order_row['service_order_check_d']?$service_order_row['service_order_check_d']:0;
$service_order_check_h=$service_order_row['service_order_check_h']?$service_order_row['service_order_check_h']:0;
$service_order_check_m=$service_order_row['service_order_check_m']?$service_order_row['service_order_check_m']:0;
$service_order_payregister=$valid_date['date_register'];
$service_order_payregisternum=$valid_date['date_registernum'];
$service_order_payregister_hour=date('H:i:s');
//status
$service_order_status=$global->product_order->db_fldrow("service_order","service_order_status","service_order_id='".$service_order_id."'");
$service_orderdetails_status=$global->product_order->db_fldrow("service_orderdetails","service_orderdetails_status","service_order_id='".$service_order_id."'");
$product_orderdetails_type="so";
$product_orderdetails_status="pmn";
if(isset($_POST['service_order_status'])){
	if($_POST['service_order_status']==""){
	$service_order_status="tmp";
	$service_orderdetails_status="tmp";
	$product_orderdetails_type="so";
	$product_orderdetails_status="tmp";
	}
	if($_POST['service_order_status']=="tmp" && $_POST['btn_status']=="btn_proc"){
	$service_order_status="process";
	$service_orderdetails_status="tmp";
	//set check in
	$service_order_check_in = date('Y-m-d G:i:s');
	}
	if($_POST['service_order_status']=="process" && $_POST['btn_status']=="btn_unpaid"){
	$service_order_status="unpaid";
	$service_orderdetails_status="tmp";
	}
	if($_POST['service_order_status']=="unpaid" && $_POST['btn_status']=="btn_pmn"){
	$service_order_status="pmn";
	$service_orderdetails_status="pmn";
	$product_orderdetails_type="si";
	//complate duration
	$service_order_check_out = date('Y-m-d G:i:s');
	$start_date = new DateTime($service_order_check_in);
	$service_order_duration = $start_date->diff(new DateTime($service_order_check_out));
	$service_order_check_d +=$service_order_duration->days;
	$service_order_check_h +=$service_order_duration->h;
	$service_order_check_m +=$service_order_duration->i;
	$valid_date3=$global->valid_date($_POST['date_payregister']);
	if(!$valid_date3['is_valid']){
		$global->error_message($msgform_lang['date_invalid']);
		}
	$service_order_payregister=$valid_date3['date_register'];
	$service_order_payregisternum=$valid_date3['date_registernum'];
	$service_order_payregister_hour=date('H:i:s');
	}
}
//init
$service_scode_hidden="";
$service_orderdetails_price_hidden="";
$service_orderdetails_quantity_hidden="";
//cash
$service_order_cash=str_replace(",","",$_POST['service_order_cash']);
if($service_order_cash<=0){
	$service_order_cash=$service_order_total_hidden;
	}
$service_order_balance=$service_order_cash-$service_order_total_hidden;
//end form handling

//insert service_order
	$insert_arr = array(
	'service_order_description'=>	$service_order_description,
	'service_order_code'=>	$service_order_code,
	'users_code'=>	$users2_code,
	'staff_code'=>	$staff_code,
	'motorcycle_code'=>	$motorcycle_code,
	'service_order_accountdebit'=>	$service_order_accountdebit,
	'service_order_accountcredit'=>	$service_order_accountcredit,
	'service_order_type'=>	'si',
	'service_order_status'=>	$service_order_status,
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
	'service_order_check_in'=>	$service_order_check_in,
	'service_order_check_out'=>	$service_order_check_out,
	'service_order_check_d'=>	$service_order_check_d,
	'service_order_check_h'=>	$service_order_check_h,
	'service_order_check_m'=>	$service_order_check_m,
	'service_order_reason'=>	$service_order_reason,
	'service_order_usersowner_rel'=>	$service_order_usersowner_rel,
	'service_order_payregister'=>	$service_order_payregister,
	'service_order_payregisternum'=>	$service_order_payregisternum,
	'service_order_payregister_hour'=>	$service_order_payregister_hour,
	'service_order_cash'=>	$service_order_cash,
	'service_order_balance'=>	$service_order_balance,
	'service_order_memo'=>	$_POST['service_order_memo']?$_POST['service_order_memo']:'',
	);
	//insert
	if(!$global->product_order->complate_service_order_sale($insert_arr,$service_order_id,$service_order_total_hidden)){
		$global->product_order->error_message($global->product_order->err_msg);
		}else{

	//clear old list
	$global->db_delete("service_orderdetails","service_order_id='".$service_order_id."'");
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
		$service_orderdetails_cost_addon=($service_orderdetails_total/$service_orderdetails_sub_total)*$service_order_cost;
		//update service_order details
		$insert_arr = array(
		'service_order_id'=>	$service_order_id,
		'service_orderdetails_quantity'=>	$service_orderdetails_quantity_hidden[$key],
		'service_orderdetails_price'=>	$service_orderdetails_price_hidden[$key],
		'service_orderdetails_bprice'=>	$service_orderdetails_bprice_hidden[$key],
		'service_code'=>	$service_code,
		'service_orderdetails_register'=>	$service_order_payregister,
		'service_orderdetails_registernum'=>	$service_order_payregisternum,
		'service_orderdetails_status'=>	$service_orderdetails_status,
		'service_orderdetails_discount'=>	$service_orderdetails_discount_hidden[$key],
		'service_orderdetails_tax'=>	$service_orderdetails_tax_hidden[$key],
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
	//cek KPB online
	//if pmn
	if($service_order_status=="pmn"){
	//reset old
	$global->db_delete("kpb_online","service_order_id='".$service_order_id."'");
	$create_kpb_arr = array(
		'service_order_id'=>	$service_order_id,
		'kpb_register'=>	$valid_date['date_register'],
		'kpb_registernum'=>	$valid_date['date_registernum'],
		'kpb_online_km'=>	$service_order_km_now,
		);
	$global->product_order->create_kpb_online($create_kpb_arr);
	}
	//clear old list
	$global->db_delete("product_orderdetails","service_order_id='".$service_order_id."'");
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
		$product_orderdetails_cost_addon=($product_orderdetails_total/$service_orderdetails_sub_total)*$service_order_cost;
		//update product_order details
		$insert_arr = array(
		'service_order_id'=>	$service_order_id,
		'product_order_id'=>	0,
		'product_orderdetails_quantity'=>	$product_orderdetails_quantity_hidden[$key],
		'product_orderdetails_price'=>	$product_orderdetails_price_hidden[$key],
		'product_orderdetails_bprice'=>	$product_orderdetails_bprice_hidden[$key],
		'product_code'=>	$product_code,
		'product_orderdetails_register'=>	$service_order_payregister,
		'product_orderdetails_registernum'=>	$service_order_payregisternum,
		'product_orderdetails_status'=>	$product_orderdetails_status,
		'product_orderdetails_discount'=>	$product_orderdetails_discount_hidden[$key],
		'product_orderdetails_tax'=>	$product_orderdetails_tax_hidden[$key],
		'product_orderdetails_disc_final'=>	$service_order_discount,
		'product_orderdetails_total'=>	$product_orderdetails_total,
		'product_orderdetails_type'=>	$product_orderdetails_type,
		'product_orderdetails_cost_addon'=>	$product_orderdetails_cost_addon,
		'kpb_yesno'=>	$kpb_product_yesno_hidden[$key],
		);
		$global->db_insert("product_orderdetails",$insert_arr);
		}}
	}
	//end loop 2
	}}
	//redirect
	Header("location: service.php?confirm=".$form_header_lang['edit_button']."&service_order_status=".$service_order_status."&service_order_id=".$service_order_id);
	exit;
}}
?>
