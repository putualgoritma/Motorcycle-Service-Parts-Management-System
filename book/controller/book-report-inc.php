<?
if(isset($_POST['Submit']))
{
$year=$_POST['year'];
$month=$_POST['month'];
$keuangan=$_POST['keuangan'];
if($keuangan=="rl")
	{
	Header("location: profit-loss.php?year=$year&month=$month");
	exit;
	}
else if($keuangan=="nr")
	{
	Header("location: balance-sheet.php?year=$year&month=$month");
	exit;
	}
else if($keuangan=="rt")
	{
	Header("location: ratio.php?year=$year&month=$month");
	exit;
	}

}
?>
<?
$year_value=date("Y");
$month_value=date("m");
?>