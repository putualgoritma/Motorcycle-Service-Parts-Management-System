<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(isset($_REQUEST['product_code']))
{
//form handling
$product_code=$_REQUEST['product_code'];
$product_sprice=$_REQUEST['product_orderdetails_price'];
//echo $product_code."-".$product_sprice;
//update items
$update_arr = array(
'product_sprice'=>	$product_sprice,
);
$global->db_update("product",$update_arr,"product_code='".$product_code."'");
}
?>