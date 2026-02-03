<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/inventory"; ?>
<? $page_active="product-service/inventory/product-buy"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<?
$product_orderdetails_id=$_REQUEST['id'];
$product_order_id=$global->product_order->db_fldrow("product_orderdetails","product_order_id","product_orderdetails_id='".$product_orderdetails_id."'");
$global->product_order->db_delete("product_orderdetails","product_orderdetails_id='".$product_orderdetails_id."'");
if($global->tbldata_exist("product_orderdetails","product_orderdetails_id","product_order_id='".$product_order_id."'")){
$total=$global->product_order->db_row("product_orderdetails","SUM(product_orderdetails_price*product_orderdetails_quantity) AS product_orderdetails_total","product_order_id='".$product_order_id."' GROUP BY product_order_id");
echo $site_lang['currency'].$global->product_order->num_format($total['product_orderdetails_total']);
}else{
echo $site_lang['currency']."0,00";
}
?>