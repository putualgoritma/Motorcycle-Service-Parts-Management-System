<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? $parent_active="book"; ?>
<? $page_active="book/book-report"; ?>
<? include ("../controller/login-sessi.php"); ?>
<? include ("controller/balance-sheet-inc.php"); ?>
<? include ("../templates/default/top-frame.php"); ?>
<? include ("../templates/default/separator.php"); ?>
<? include ("views/balance-sheet.php"); ?>
<? include ("../templates/default/footer.php"); ?>
<? include ("../templates/default/bottom-frame-noauto.php"); ?>
<script>
<? include ("../plugins/autocomplete.js"); ?>
</script>