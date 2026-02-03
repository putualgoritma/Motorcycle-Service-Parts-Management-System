<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="salary"; ?>
<? $page_active="salary/slip"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/slip-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/slip.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<? include ("files/js.php"); ?>