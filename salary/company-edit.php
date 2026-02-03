<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active= "settings"; ?>
<? $page_active="settings/company"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/company-edit-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/company-edit.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>