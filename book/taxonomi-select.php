<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? $parent_active="book"; ?>
<? $page_active="book/account-list"; ?>
<? include ("../controller/login-sessi.php"); ?>
<?php
//query
$svalue = $_REQUEST['svalue'];
$svalue_arr = explode(",", $svalue);
$selected=0;
if(isset($_REQUEST['selected'])){
$selected=$_REQUEST['selected'];
}
//$selectvalue = $_REQUEST['svalue'];
$result=$global->book->account_parent_special_create($svalue_arr,$selected);
//echo json_encode($svalue);
?>