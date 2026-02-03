<? $path="../"; 
//echo "settings/sms";
?>
<? include ($path."controller/config-inc.php"); ?>
<? include($path."integrasi/libs/Classes/PHPExcel.php");?>
<? include($path."integrasi/libs/nusasms.class.php");?>
<? $parent_active= "settings"; ?>

<? $page_active="settings/sms"; ?>

<? include ($path."controller/login-sessi.php"); ?>

<? include ("controller/sms-inc.php"); ?>

<? include ($path."templates/default/top-frame.php"); ?>

<? include ($path."templates/default/separator.php"); ?>

<? include ("views/sms.php"); ?>

<? include ($path."templates/default/footer.php"); ?>

<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<? include ($path."templates/default/sms-js.php"); ?>