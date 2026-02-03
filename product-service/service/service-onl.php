<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/service"; ?>
<? $page_active="product-service/service/service-onl"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/service-onl-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<?
if(isset($_REQUEST['service_order_status']) && $_REQUEST['service_order_status']=="pmn"){
$service_order_id_pop=$_REQUEST['service_order_id'];
?>
<script type="text/javascript">
$(document).ready(function() {
    var url="pdf/service-inv-pdf.php?service_order_id=<? echo $service_order_id_pop ;?>";
	window.open(url,'popuppage','width=640,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');
});
</script>
<?
}
?>
<? include ("views/service-onl.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript" src="files/js.js"></script>