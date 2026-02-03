<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
$product_orderdetails_id=$_REQUEST['id'];
$delmin_val=$_REQUEST['delmin_val'];
$orderdetails_id_active=$_REQUEST['orderdetails_id_active'];

//product_order total
$product_order_id=$global->product_order->db_fldrow("product_orderdetails","product_order_id","product_orderdetails_id='".$product_orderdetails_id."'");
//loop active to get total
$product_orderdetails_total=0;
$product_orderdetails_del=0;

$product_orderdetails_set_arr=explode("XXX",$orderdetails_id_active);
for($i_psetdetails=1;$i_psetdetails<count($product_orderdetails_set_arr);$i_psetdetails++){
	$product_orderdetails_id_arr=explode(",",$product_orderdetails_set_arr[$i_psetdetails]);
	if(count($product_orderdetails_id_arr)>0){
	$product_orderdetails_total+=($product_orderdetails_id_arr[1]*$product_orderdetails_id_arr[2]);
	if($product_orderdetails_id_arr[0]==$product_orderdetails_id){
		$product_orderdetails_del=($product_orderdetails_id_arr[1]*$product_orderdetails_id_arr[2]);
		}
	}}

//product_orderdetails total
$total_tmp=$product_orderdetails_total-$delmin_val-$product_orderdetails_del;
$total_tmp=$site_lang['currency'].$global->product_order->num_format($total_tmp);
$delmin_val_tmp=$delmin_val+$product_orderdetails_del;
echo $delmin_val_tmp.";".$total_tmp;
?>