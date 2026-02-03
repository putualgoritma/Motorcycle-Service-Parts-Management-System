<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? $parent_active="book"; ?>
<? $page_active="book/account-list"; ?>
<? include ("../controller/login-sessi.php"); ?>
<? include ("controller/account-list-edit-inc.php"); ?>
<? include ("../templates/default/top-frame.php"); ?>
<? include ("../templates/default/separator.php"); ?>
<? include ("views/account-list-edit.php"); ?>
<? include ("../templates/default/footer.php"); ?>
<? include ("../templates/default/bottom-frame-noauto.php"); ?>
<script>
<? include ("../plugins/autocomplete.js"); ?>
</script>