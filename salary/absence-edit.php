<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="salary"; ?>
<? $page_active="salary/absence"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/absence-edit-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/absence-edit.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<? include ("files/js.php"); ?>