<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/service"; ?>
<? $page_active="product-service/service/service-paid"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/service-paid-edit-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<script type="text/javascript">
$(document).ready(function() {
	var mcode = $('#motorcycle_code').val();
	var btn_status = "<? echo $_REQUEST['btn_status']; ?>";
	if(btn_status=="btn_proc"){
	mcode_onchange(mcode,"staff_code");
	users2_code_exist("staff_code");
	}else if(btn_status=="btn_pmn"){
	mcode_onchange(mcode,"service_order_total_cash");
	users2_code_exist("service_order_total_cash");
	}else{
	mcode_onchange(mcode,"motorcycle_code");
	users2_code_exist("motorcycle_code");
	}
});
</script>
<? include ("views/service-paid-edit.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript" src="files/autocomplete.js"></script>
<script type="text/javascript" src="files/js.js"></script>
<script type="text/javascript" src="files/modals.js"></script>