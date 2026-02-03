<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="salary"; ?>
<? $page_active="salary/insentif"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/insentif-service-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/insentif-service.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<? include ("files/js.php"); ?>