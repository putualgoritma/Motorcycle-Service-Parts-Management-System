<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/inventory"; ?>
<? $page_active="product-service/inventory/product"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<?
if(isset($_POST['Submit']))
{
//form handling
$product_code=$_POST['product_code'];
$product_name=$_POST['product_name'];
$product_unit=$_POST['product_unit'];
$product_sprice=$_POST['product_sprice'];
//end form handling

//insert items
$create_arr = array(
'product_code'=>	$product_code,
'product_name'=>	$product_name,
'product_unit'=>	$product_unit,
'product_sprice'=>	$product_sprice,
);
//create product
if(!$global->product_order->create_product($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
Header("location: product.php");
exit;
//exit;
}
?>