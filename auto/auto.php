<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? include ("../controller/login-sessi.php"); ?>
<?
//looping asset_fixed
$mk_today = mktime(0,0,0,date("m"),(int)date("d"),date("Y"));
$dmy_today = date("d/m/Y");
$global->asset_fixed->auto_depreciation($mk_today,$global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['depreciation_expanse_amount']);
$global->product_order->po_realization_expired_status();
$_SESSION['sessi_auto']=1;
Header("Location: ../auto.php");
exit;
?>