<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active= "settings"; ?>
<? $page_active="settings/module"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/module-new-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/module-new.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript" src="files/js.js"></script>