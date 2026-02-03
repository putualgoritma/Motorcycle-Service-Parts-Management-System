<?
$year=$_REQUEST['year'];
$month=$_REQUEST['month'];
if($month=="%")
	{
	$month="12";
	}
$month_year="%/".$month."/".$year;
$days_num = cal_days_in_month(CAL_GREGORIAN, (int)$month, $year) ;
?>