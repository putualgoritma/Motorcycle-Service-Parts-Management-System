<?
//default
$warehouse_stock_code_generation=$global->product_order->generator_warehouse_stock_edit_code("opname");
//cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: stock-opname.php");
exit;
}
if(isset($_POST['Submit']))
{
//form handling
//get warehouse id
$warehouse_code_arr=explode(" - ",$_POST['warehouse_code']);
$warehouse_code=$global->product_order->db_fldrow("warehouse","warehouse_code","warehouse_code='".$warehouse_code_arr[0]."'");
//get author id
$contact_code=$contact_glob['contact_code'];
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
$warehouse_stock_time=date("H:i:s");
//end form handling
//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//if exist regenerate
$date_nownum=intval(date("Y").date("m"));
if($global->tbldata_exist("warehouse_stock","warehouse_stock_id","warehouse_stock_code='".$warehouse_stock_code."'") || $valid_date['date_monthnum']!=$date_nownum){
	$warehouse_stock_code=$global->product_order->generator_warehouse_stock_edit_code("opname",$valid_date['date_monthnum']);
	}
	//insert product_order
	$insert_arr = array(
	'warehouse_stock_description'=>	$warehouse_stock_description,
	'warehouse_stock_code'=>	$warehouse_stock_code,
	'warehouse_code'=>	$warehouse_code,
	'warehouse_stock_type'=>	'opname',
	'warehouse_stock_status'=>	'pmn',
	'warehouse_stock_register'=>	$valid_date['date_register'],
	'warehouse_stock_registernum'=>	$valid_date['date_registernum'],
	'contact_code'=>	$contact_code,
	'warehouse_stock_category'=>	'opname',
	'warehouse_stock_time'=>	$warehouse_stock_time,
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
	for($key=0;$key<$num_list;$key++){
		$product_bcode_hidden_val=$product_bcode_hidden[$key];
		$product_code_arr=explode(" - ",$product_bcode_hidden_val);
		$product_row=$global->product_order->db_row("product","product_code,product_stock","product_code='".$product_code_arr[0]."'");
		$product_code=$product_row['product_code'];
		$product_stock=$product_row['product_stock'];
		$warehouse_stock_details_quantity=$warehouse_stock_details_quantity_hidden[$key]-$product_stock;
		if($product_code!=""){
		//update product_order details
		$insert_arr = array(
		'warehouse_stock_code'=>	$warehouse_stock_code,
		'warehouse_stock_details_quantity'=>	$warehouse_stock_details_quantity,
		'warehouse_stock_details_opname'=>	$warehouse_stock_details_quantity_hidden[$key],
		'product_code'=>	$product_code,
		);
		//print_r($insert_arr);
		$global->db_insert("warehouse_stock_details",$insert_arr);
		}}//end loop
	}//end if isset
	$global->product_order->stock_opname_ledger($warehouse_stock_code,$valid_date['date_register'],$valid_date['date_registernum']);
	}}
	//redirect
	Header("location: stock-opname.php?confirm=".$form_header_lang['add_new_button']);
	exit;
}
?>

