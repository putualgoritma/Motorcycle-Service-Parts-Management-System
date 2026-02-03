<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/product-buy"; ?>
<? $page_active="product-service/product-buy/product-buy"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<?
//form handling
//get form
//get product id
$product_code_arr=explode(" - ",$_REQUEST['product_code']);
$product_code=$product_code_arr[0];
$product_code=$global->product_order->db_fldrow("product","product_code","product_code='".$product_code_arr[0]."'");
if($product_code=="" && trim($_REQUEST['product_code'])!="" && trim($_REQUEST['product_name'])!=""){
//create new product
$product_name=$_REQUEST['product_name'];
$product_sprice=$_REQUEST['product_orderdetails_price'];
//set create array
$create_arr = array(
'product_code'=>	$product_code,
'product_name'=>	$product_name,
'product_sprice'=>	$product_sprice,
);
;
//create product
if(!$global->product_order->create_product($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
$product_code=$global->product_order->db_lastid("product","product_code");
}
if($product_code!=""){
$product_order_id=$_REQUEST['product_order_id'];
$product_orderdetails_id=$_REQUEST['product_orderdetails_id'];
$product_orderdetails_type='pi';
$product_orderdetails_price=$_REQUEST['product_orderdetails_price'];
$product_orderdetails_quantity=$_REQUEST['product_orderdetails_quantity'];
$delmin_val=$_REQUEST['delmin_val'];
$orderdetails_id_active=$_REQUEST['orderdetails_id_active'];
//end form handling
//insert items
//date validate
$valid_date=$global->product_order->valid_date(date("d/m/Y"));
if(!$valid_date['is_valid']){
	$global->product_order->error_message($msgform_lang['date_invalid']);
	}
//cari tanggal
$product_orderdetails_register=$valid_date['date_register'];
$product_orderdetails_registernum=$valid_date['date_registernum'];
$product_row=$global->product_order->db_row("product","product_code,product_name,product_sprice","product_code='".$product_code."'");
//get balance
$product_orderdetails_subtotal=$product_orderdetails_quantity*$product_orderdetails_price;
//loop active to get total
$product_orderdetails_total=0;
$orderdetails_id_active_new="";
$product_orderdetails_set_arr=explode("XXX",$orderdetails_id_active);
for($i_psetdetails=1;$i_psetdetails<count($product_orderdetails_set_arr);$i_psetdetails++){
	$product_orderdetails_id_arr=explode(",",$product_orderdetails_set_arr[$i_psetdetails]);
	if(count($product_orderdetails_id_arr)>0){
	if((int)$product_orderdetails_id_arr[0]==(int)$product_orderdetails_id){
		$product_orderdetails_total+=($product_orderdetails_quantity*$product_orderdetails_price);
		$orderdetails_id_active_new.="XXX".$product_orderdetails_id.",".$product_orderdetails_quantity.",".$product_orderdetails_price.",".$product_code;
		}else{
		$product_orderdetails_total+=($product_orderdetails_id_arr[1]*$product_orderdetails_id_arr[2]);
		$orderdetails_id_active_new.="XXX".$product_orderdetails_id_arr[0].",".$product_orderdetails_id_arr[1].",".$product_orderdetails_id_arr[2].",".$product_orderdetails_id_arr[3];
		}
	}}
$product_orderdetails_total=$product_orderdetails_total-$delmin_val;
echo $product_orderdetails_id.";".$product_row['product_name'].";".$product_row['product_code'].";".$site_lang['currency'].$global->product_order->num_format($product_orderdetails_price).";".$product_orderdetails_quantity.";".$site_lang['currency'].$global->product_order->num_format($product_orderdetails_subtotal).";".$site_lang['currency'].$global->product_order->num_format($product_orderdetails_total).";".$product_orderdetails_price.";".$product_row['product_sprice'].";".$product_order_id.";".$orderdetails_id_active_new;
}
?>