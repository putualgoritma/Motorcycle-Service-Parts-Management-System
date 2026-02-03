<? $path=""; ?>
<? include ("controller/config-inc.php"); ?>
<? include ("controller/login-sessi.php"); ?>
<? include ("templates/default/top-frame.php"); ?>
<? include ("views/reports.php"); ?>
<? include ("templates/default/footer.php"); ?>
<? include ("templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript">
$(document).ready(function() {
$('a.report_daily').on('click', function() {
    var myModal = $('#Modal_Daily');
    var action_rel=$(this).attr("rel");
	$('#form_daily', myModal).attr('action',action_rel);
	
    myModal.modal({ show: true });
    return false;
	})
$('a.report_monthly').on('click', function() {
    var myModal = $('#Modal_Monthly');
    var action_rel=$(this).attr("rel");
	$('#form_monthly', myModal).attr('action',action_rel);
	
    myModal.modal({ show: true });
    return false;
	})
$('a.report_daily_stock').on('click', function() {
    var myModal = $('#Modal_Daily_Stock');
    var action_rel=$(this).attr("rel");
	$('#form_daily', myModal).attr('action',action_rel);
	
    myModal.modal({ show: true });
    return false;
	})
$('a.report_form_daily').on('click', function() {
    var myModal = $('#Modal_Form_Daily');
    var action_rel=$(this).attr("rel");
	$('#form_form_daily', myModal).attr('action',action_rel);
	
    myModal.modal({ show: true });
    return false;
	})
})
</script>