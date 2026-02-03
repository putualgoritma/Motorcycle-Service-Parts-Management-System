<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="users"; ?>
<? $page_active="users/users"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/users-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/users.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript" src="files/js.js"></script>