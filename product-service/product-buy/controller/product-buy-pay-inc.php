<?

if (isset($_REQUEST['product_order_id'])){

$product_order_id=$_REQUEST['product_order_id'];

}else{

$product_order_id=0;

}

$product_order_row=$global->db_row_join("product_order,users","product_order.*,users.users_name,users.users_code","product_order_id = '".$product_order_id."' AND product_order.users_code=users.users_code");

$product_orderdetails_row=$global->db_row("product_orderdetails","SUM(product_orderdetails_total) AS product_orderdetails_total","product_order_id='".$product_order_id."' AND product_orderdetails_status = '".$product_order_row['product_order_status']."' GROUP BY product_order_id");

$product_orderdetails_total=$product_orderdetails_row['product_orderdetails_total'];

$author_row=$global->db_row("contact","contact_code,contact_name","contact_id='".$product_order_row['contact_code']."' AND contact_type = 'author'");

$product_order_amount=$product_orderdetails_total+$product_order_row['product_order_tax_val']+$product_order_row['product_order_cost'];

//format

$product_order_tax_val_format=$global->num_format2($product_order_row['product_order_tax_val']);

$product_orderdetails_total_format=$global->num_format2($product_orderdetails_total);

$product_order_amount_format=$global->num_format2($product_order_amount);

//cancel

if(isset($_REQUEST['Submitcancell']))

{

Header("location: product-buy.php");

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

$product_order_accountdebit=$global->product_order->book->account_special_get("stock_trade");



//additional

$product_order_discount=$_POST['product_order_discount'];//additional disc final untuk list

$product_order_cost=str_replace(",","",$_POST['product_order_cost']);;//additional cost

$product_order_total_hidden=$_POST['product_order_total_hidden'];//grand total

$product_order_tax_val=$_POST['product_order_tax_hidden'];

//if isset product_order_kpb

$product_order_kpb=0;

if(isset($_POST['product_order_kpb'])){

	$product_order_kpb=1;

	}

//payment

$bank_code=$_POST['bank_code'];

$bank_no=$_POST['bank_no'];

$product_order_pay_method=$_POST['product_order_buy_pay'];

$product_orderdetails_sub_total=$_POST['product_orderdetails_total_hidden'];

//cek product_order_pay_method
$product_order_due_register=$date_def;
if($product_order_pay_method=="cash"){

$product_order_accountcredit=$_POST['product_order_accountpay_cash'];

}else if($product_order_pay_method=="bank"){

$product_order_accountcredit=$_POST['product_order_accountpay_bank'];

}else{

$product_order_accountcredit=$_POST['product_order_accountpay_credit'];
$product_order_due_register=$_POST['product_order_due_register'];
}

//init

$product_bcode_hidden="";

$product_orderdetails_price_hidden="";

$product_orderdetails_quantity_hidden="";

//end form handling



//date validate

$valid_date=$global->valid_date($_POST['date_register']);

if(!$valid_date['is_valid']){

	$global->error_message($msgform_lang['date_invalid']);

	}
//if exist regenerate
$product_order_row=$global->db_row("product_order","product_order_registernum","product_order_id='".$product_order_id."'");
if($global->tbldata_exist("product_order","product_order_id","product_order_code='".$product_order_code."' AND product_order_id!='".$product_order_id."'") || $valid_date['date_registernum']!=$product_order_row['product_order_registernum']){
	$product_order_code=$global->product_order->generator_product_order_buy_code("pmn",$valid_date['date_monthnum']);
	}

	//insert product_order

	$update_arr = array(

	'product_order_description'=>	$product_order_description,

	'product_order_code'=>	$product_order_code,

	'users_code'=>	$users_code,

	'product_order_accountdebit'=>	$product_order_accountdebit,

	'product_order_accountcredit'=>	$product_order_accountcredit,

	'product_order_type'=>	'pi',

	'product_order_status'=>	'pmn',

	'product_order_register'=>	$valid_date['date_register'],

	'product_order_registernum'=>	$valid_date['date_registernum'],

	'contact_code'=>	$contact_code,

	'product_order_discount'=>	$product_order_discount,

	'product_order_cost'=>	$product_order_cost,

	'product_order_tax_val'=>	$product_order_tax_val,

	'bank_code'=>	$bank_code,

	'bank_no'=>	$bank_no,

	'product_order_pay_method'=>	$product_order_pay_method,

	'product_order_kpb'=>	$product_order_kpb,
	'product_order_due_register'=>	$product_order_due_register,
	'product_order_register_hour'=>	date('H:i:s'),

	);

	//insert

	if(!$global->product_order->update_product_order_buy($update_arr,$product_order_id,$product_order_total_hidden)){

		$global->product_order->error_message($global->product_order->err_msg);

		}else{



	//clear old list

	$global->product_order->reset_realization($product_order_id);
	$global->db_delete("product_orderdetails","product_order_id='".$product_order_id."'");

	//loop list

	if(isset($_POST['product_bcode_hidden'])){

	$product_orderdetails_price_hidden=$_POST['product_orderdetails_price_hidden'];

	$product_orderdetails_quantity_hidden=$_POST['product_orderdetails_quantity_hidden'];

	$product_orderdetails_discount_hidden=$_POST['product_orderdetails_discount_hidden'];

	$product_orderdetails_tax_hidden=$_POST['product_orderdetails_tax_hidden'];

	foreach($_POST['product_bcode_hidden'] as $key => $product_bcode_hidden_val ) {

		$product_code_arr=explode(" - ",$product_bcode_hidden_val);

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

		'product_code'=>	$product_code,

		'product_orderdetails_register'=>	$valid_date['date_register'],

		'product_orderdetails_registernum'=>	$valid_date['date_registernum'],

		'product_orderdetails_status'=>	'pmn',

		'product_orderdetails_discount'=>	$product_orderdetails_discount_hidden[$key],

		'product_orderdetails_tax'=>	$product_orderdetails_tax_hidden[$key],

		'product_orderdetails_disc_final'=>	$product_order_discount,

		'product_orderdetails_total'=>	$product_orderdetails_total,

		'product_orderdetails_type'=>	'pi',

		'product_orderdetails_cost_addon'=>	$product_orderdetails_cost_addon,

		'product_orderdetails_kpb'=>	$product_order_kpb,

		);

		$global->db_insert("product_orderdetails",$insert_arr);

		}

		//auto update product_bprice & product_sprice create class

		$update_arr2 = array(

		'product_bprice'=>	$product_orderdetails_price_adisc2,

		'product_sprice'=>	$product_orderdetails_price_hidden[$key],

		);

		//check if hidden product_orderdetails_price_change = 1

		}//end loop

	}
	$global->product_order->po_realization_expired_status();
	$global->product_order->po_realization_update_status();
	$global->product_order->po_realization($product_order_id);
	$global->product_order->po_realization_update_status();

	}}

	//redirect

	Header("location: product-buy.php?confirm=".$form_header_lang['add_new_button']);

	exit;

}

?>

