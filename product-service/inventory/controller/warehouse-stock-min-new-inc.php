<?
//default
$warehouse_stock_code_generation=$global->product_order->generator_warehouse_stock_edit_code("out");
//cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: warehouse-stock-min.php");
exit;
}
if(isset($_POST['Submit']))
{
//form handling
//get warehouse id
$warehouse_code_arr=explode(" - ",$_POST['warehouse_code']);
$warehouse_code=$global->product_order->db_fldrow("warehouse","warehouse_code","warehouse_code='".$warehouse_code_arr[0]."'");
//get author id
$author_code=$_POST['author_code'];
$author_code_arr=explode(" - ",$_POST['author_code']);
$contact_code=$global->product_order->db_fldrow("contact","contact_id","contact_code='".$author_code_arr[0]."' AND contact_type='author'");
//validate form
if($warehouse_code=="" || $contact_code==""){
	$global->error_message($msgform_lang['data_invalid']);
	}
if($warehouse_code!=""){
$warehouse_code=$warehouse_code;
$warehouse_stock_description=$_POST['warehouse_stock_description'];
$warehouse_stock_code=$_POST['warehouse_stock_code'];
//init
$product_bcode_hidden="";
$warehouse_stock_details_quantity_hidden="";
//end form handling
//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//if exist regenerate
$date_nownum=intval(date("Y").date("m"));
if($global->tbldata_exist("warehouse_stock","warehouse_stock_id","warehouse_stock_code='".$warehouse_stock_code."'") || $valid_date['date_monthnum']!=$date_nownum){
	$warehouse_stock_code=$global->product_order->generator_warehouse_stock_edit_code("out",$valid_date['date_monthnum']);
	}
	//insert product_order
	$insert_arr = array(
	'warehouse_stock_description'=>	$warehouse_stock_description,
	'warehouse_stock_code'=>	$warehouse_stock_code,
	'warehouse_code'=>	$warehouse_code,
	'warehouse_stock_type'=>	'out',
	'warehouse_stock_status'=>	'pmn',
	'warehouse_stock_register'=>	$valid_date['date_register'],
	'warehouse_stock_registernum'=>	$valid_date['date_registernum'],
	'contact_code'=>	$contact_code,
	'warehouse_stock_category'=>	'trs_out',
	);
	//insert
	if(!$global->product_order->create_warehouse_stock($insert_arr)){
		$global->product_order->error_message($global->product_order->err_msg);
		}else{
	$warehouse_stock_id=$global->db_lastid("warehouse_stock","warehouse_stock_id");
	//loop list
	if(isset($_POST['product_bcode_hidden'])){
	$warehouse_stock_details_quantity_hidden=$_POST['warehouse_stock_details_quantity_hidden'];
	$product_bcode_hidden=$_POST['product_bcode_hidden'];
	$num_list=count($_POST['product_bcode_hidden']);
	//echo $num_list;
	//foreach($_POST['warehouse_stock_details_subtotal_hidden'] as $key ) {
	$product_bprice_total=0;
	for($key=0;$key<$num_list;$key++){
		$product_bcode_hidden_val=$product_bcode_hidden[$key];
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
		//print_r($insert_arr);
		$global->db_insert("warehouse_stock_details",$insert_arr);
		}}//end loop
	}//end if isset
	//create ledger & update $warehouse_stock_id
	$expense_grant_acc=$global->book->account_special_get('expense_grant');
	$income_grant_acc=$global->book->account_special_get('income_grant');
	$stock_trade_acc=$global->book->account_special_get('stock_trade');
	$ledger_description="Jurnal Persediaan Barang Hibah";
	$adjust_amount=$product_bprice_total;
	$set_rekening=array($stock_trade_acc,"K",$adjust_amount,$expense_grant_acc,"D",$adjust_amount);
	$ledger_id=$global->book->ledger_post($valid_date['date_register'],1,$ledger_description,$set_rekening,$valid_date['date_registernum'],0);
	$update_arr = array(
	'ledger_id'=>	$ledger_id,
	);
	$global->db_update("warehouse_stock",$update_arr,"warehouse_stock_id='".$warehouse_stock_id."'");
	}}
	//redirect
	Header("location: warehouse-stock-min.php?confirm=".$form_header_lang['add_new_button']);
	exit;
}
?>

