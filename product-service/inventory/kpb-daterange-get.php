<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$date_service=$_REQUEST['date_service'];
$motorcycle_buy_register=$_REQUEST['motorcycle_buy_register'];
$valid_date=$global->valid_date($motorcycle_buy_register);
if($valid_date['is_valid']){
$date_diff_get_arr=$global->date_diff_get($motorcycle_buy_register,$date_service);
$motorcycle_numdays=" ".$date_diff_get_arr['days']." hari (".$date_diff_get_arr['months']." bulan)";
//echo $motorcycle_numdays;
echo json_encode($motorcycle_numdays);
}
?>