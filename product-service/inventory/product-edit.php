<?
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
?>
<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? $parent_active="product-service/inventory"; ?>
<? $page_active="product-service/inventory/product"; ?>
<? include ($path."controller/login-sessi.php"); ?>
<? include ("controller/product-edit-inc.php"); ?>
<? include ($path."templates/default/top-frame.php"); ?>
<? include ($path."templates/default/separator.php"); ?>
<? include ("views/product-edit.php"); ?>
<? include ($path."templates/default/footer.php"); ?>
<? include ($path."templates/default/bottom-frame-noauto.php"); ?>
<script type="text/javascript" src="files/autocomplete.js"></script>
<script type="text/javascript" src="files/js.js"></script>