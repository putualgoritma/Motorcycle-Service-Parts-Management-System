<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? $parent_active="book"; ?>
<? $page_active="book/ledger-general"; ?>
<? include ("../controller/login-sessi.php"); ?>
<? include ("controller/ledger-general-unbalance-inc.php"); ?>
<? include ("../templates/default/top-frame.php"); ?>
<? include ("../templates/default/separator.php"); ?>
<? include ("views/ledger-general-unbalance.php"); ?>
<? include ("../templates/default/footer.php"); ?>
<? include ("../templates/default/bottom-frame-noauto.php"); ?>
<script>
<? include ("../plugins/autocomplete.js"); ?>
</script>