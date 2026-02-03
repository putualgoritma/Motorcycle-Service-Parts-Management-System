<?
if (isset($_REQUEST['warehouse_stock_id'])){
$warehouse_stock_id=$_REQUEST['warehouse_stock_id'];
}else{
$warehouse_stock_id=0;
}
$warehouse_stock_row=$global->db_row_join("warehouse_stock,warehouse","warehouse_stock.*,warehouse.warehouse_name,warehouse.warehouse_code","warehouse_stock_id = '".$warehouse_stock_id."' AND warehouse_stock.warehouse_code=warehouse.warehouse_code");

$warehouse_code_from =$warehouse_stock_row['warehouse_code_from']." - ";
$warehouse_code_from .=$global->product_order->db_fldrow("warehouse","warehouse_name","warehouse_code='".$warehouse_stock_row['warehouse_code_from']."'");


$author_row=$global->db_row("contact","contact_code,contact_name","contact_id='".$warehouse_stock_row['contact_code']."' AND contact_type = 'author'");
//cancel
if(isset($_REQUEST['Submitcancell']))
{
Header("location: warehouse-stock-trs.php");
exit;
}
//process
if(isset($_POST['Submit']))
{
//form handling
//get warehouse id
$warehouse_code_arr=explode(" - ",$_POST['warehouse_code']);
$warehouse_row=$global->product_order->db_row("warehouse","*","warehouse_code='".$warehouse_code_arr[0]."'");
$warehouse_code=$warehouse_row['warehouse_code'];
$warehouse_type=$warehouse_row['warehouse_type'];
//get warehouse id from
$warehouse_code_from_arr=explode(" - ",$_POST['warehouse_code_from']);
$warehouse_from_row=$global->product_order->db_row("warehouse","*","warehouse_code='".$warehouse_code_from_arr[0]."'");
$warehouse_code_from=$warehouse_from_row['warehouse_code'];
$warehouse_type_from=$warehouse_from_row['warehouse_type'];
//get author id
$contact_code=$contact_glob['contact_code'];
//validate form
if($warehouse_code=="" || $warehouse_code_from=="" || $contact_code==""){
	$global->error_message($msgform_lang['data_invalid']);
	}
else if(($warehouse_type=="branch" || $warehouse_type=="main") && ($warehouse_type_from=="branch" || $warehouse_type_from=="main")){
	$global->error_message($warehouse_type."Salah Satu Gudang Harus Gudang Internal/POS!".$warehouse_type_from);
	}
else{
$warehouse_stock_id=$_POST['warehouse_stock_id'];
$warehouse_code=$warehouse_code;
$warehouse_stock_description=$_POST['warehouse_stock_description'];
$warehouse_stock_code=$_POST['warehouse_stock_code'];
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
//if exist regenerate
$warehouse_stock_row=$global->db_row("warehouse_stock","*","warehouse_stock_id='".$warehouse_stock_id."'");
if($global->tbldata_exist("warehouse_stock","warehouse_stock_id","warehouse_stock_code='".$warehouse_stock_code."' AND warehouse_stock_id!='".$warehouse_stock_id."'") || $valid_date['date_registernum']!=$warehouse_stock_row['warehouse_stock_registernum']){
	$warehouse_stock_code=$global->product_order->generator_warehouse_stock_code("trs",$valid_date['date_monthnum']);
	}
//get warehouse_stock_category
$warehouse_stock_category="trs";
if(($warehouse_type_from=='branch' || $warehouse_type_from=='main') && ($warehouse_type=='' || $warehouse_type=='pos')){
	$warehouse_stock_category="transfer_in";
	}
if(($warehouse_type_from=='' || $warehouse_type_from=='pos') && ($warehouse_type=='branch' || $warehouse_type=='main')){
	$warehouse_stock_category="transfer_out";
	}

	//insert product_order
	$update_arr = array(
	'warehouse_stock_description'=>	$warehouse_stock_description,
	'warehouse_stock_code'=>	$warehouse_stock_code,
	'warehouse_code'=>	$warehouse_code,
	'warehouse_code_from'=>	$warehouse_code_from,
	'warehouse_stock_type'=>	'trs',
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
	//clear old ledger
	$global->db_delete("ledgerdetails","ledger_id='".$warehouse_stock_row['ledger_id']."'");
	$global->db_delete("ledger","ledger_id='".$warehouse_stock_row['ledger_id']."'");
	//create ledger & update $warehouse_stock_id
	//from ledger
	if($warehouse_type_from =='branch' OR $warehouse_type_from =='main'){
		//create ledger & update $warehouse_stock_id
		$from_acc=$warehouse_from_row['taxonomi_id'];
		$stock_trade_acc=$global->book->account_special_get('stock_trade');
		$ledger_description="Jurnal Stock Transfer dari ".$warehouse_from_row['warehouse_name']." ke ".$warehouse_row['warehouse_name'];
		$adjust_amount=$product_bprice_total;
		$set_rekening=array($stock_trade_acc,"D",$adjust_amount,$from_acc,"K",$adjust_amount);
		$ledger_id=$global->book->ledger_post($valid_date['date_register'],1,$ledger_description,$set_rekening,$valid_date['date_registernum'],0);
		$update_arr = array(
		'ledger_id'=>	$ledger_id,
		);
		$global->db_update("warehouse_stock",$update_arr,"warehouse_stock_id='".$warehouse_stock_id."'");
	}//end destination ledger
	
	//destination ledger
	if($warehouse_type =='branch' OR $warehouse_type =='main'){
		//create ledger & update $warehouse_stock_id
		$dest_acc=$warehouse_row['taxonomi_id'];
		$stock_trade_acc=$global->book->account_special_get('stock_trade');
		$ledger_description="Jurnal Stock Transfer dari ".$warehouse_from_row['warehouse_name']." ke ".$warehouse_row['warehouse_name'];
		$adjust_amount=$product_bprice_total;
		$set_rekening=array($dest_acc,"D",$adjust_amount,$stock_trade_acc,"K",$adjust_amount);
		$ledger_id=$global->book->ledger_post($valid_date['date_register'],1,$ledger_description,$set_rekening,$valid_date['date_registernum'],0);
		$update_arr = array(
		'ledger_id'=>	$ledger_id,
		);
		$global->db_update("warehouse_stock",$update_arr,"warehouse_stock_id='".$warehouse_stock_id."'");
	}//end destination ledger
	}}
	//redirect
	Header("location: warehouse-stock-trs.php?confirm=".$form_header_lang['add_new_button']);
	exit;
}
?>

