<? $path=""; ?>
<? include ("controller/config-inc.php"); ?>
<? include ("controller/login-sessi.php"); ?>
<? include ("controller/confirm-inc.php"); ?>
<?
Header("Location: $confirm_redirect?confirm=$confirm");
exit;
?>