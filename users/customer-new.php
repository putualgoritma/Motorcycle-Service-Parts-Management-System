<? $path="../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/inventory"; ?>
<? $page_active="users/customer"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/customer-new-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/customer-new.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript" src="files/autocomplete.js"></script>
<script type="text/javascript" src="files/js.js"></script>