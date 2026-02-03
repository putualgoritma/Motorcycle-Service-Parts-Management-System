<? $path=""; ?>
<? include ("controller/config-inc.php"); ?>
<?
//auto inventaris
if(!isset($_SESSION['sessi_auto'])){
Header("Location: auto/auto.php");
exit;
}
Header("Location: index.php");
exit;
?>