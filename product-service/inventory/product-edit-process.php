<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/inventory"; ?>
<? $page_active="product-service/inventory/product"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<?
if(isset($_POST['Submit']))
{
//form handling
$product_id=$_POST['product_id'];
$product_code=$_POST['product_code'];
$product_name=$_POST['product_name'];
$product_unit=$_POST['product_unit'];
$product_sprice=$_POST['product_sprice'];
//end form handling

//insert items
$update_arr = array(
'product_code'=>	$product_code,
'product_name'=>	$product_name,
'product_unit'=>	$product_unit,
'product_sprice'=>	$product_sprice,
);
//update product
if(!$global->product_order->update_product($update_arr,$_POST['product_id'])){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
Header("location: product.php");
exit;
}
?>