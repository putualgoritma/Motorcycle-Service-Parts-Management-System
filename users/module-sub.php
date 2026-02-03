<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active= "settings"; ?>
<? $page_active="settings/module-sub"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/module-sub-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/module-sub.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript" src="files/js.js"></script>