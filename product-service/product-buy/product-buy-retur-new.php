<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/product-buy"; ?>
<? $page_active="product-service/product-buy/product-buy-retur"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/product-buy-retur-new-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/product-buy-retur-new.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript" src="files/autocomplete.js"></script>
<script type="text/javascript" src="files/js.js"></script><?
if (isset($_REQUEST['po_code'])){
$po_code=$_REQUEST['po_code'];
?>
<script>
//input mask
$(document).ready(function() {
	$('.typehead_po #po_code').typeahead('val', '<? echo $po_code;?>');
	$("#PO_Reload").trigger("click");
});
</script>
<?
}
?>