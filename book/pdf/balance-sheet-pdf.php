<? 

session_start();



require_once '../../vendor/autoload.php';



//get sessi

$var_pdf=$_SESSION['var_pdf_sessi'];

$label_pdf=$_SESSION['label_pdf_sessi'];

$list_pdf=$_SESSION['list_pdf_sessi'];

$list_pdf2=$_SESSION['list_pdf_sessi'];



//var

$year=$var_pdf['year'];

$month=$var_pdf['month'];

$month_year=$var_pdf['month_year'];

$days_num=$var_pdf['days_num'];

$balance_sheet_1d=$var_pdf['balance_sheet_1d'];

$balance_sheet_2k=$var_pdf['balance_sheet_2k'];

$balance_sheet_3k=$var_pdf['balance_sheet_3k'];

$balance_activa=$var_pdf['balance_activa'];

$balance_payable=$var_pdf['balance_payable'];

$dividen=$var_pdf['dividen'];

$dividen_net=$var_pdf['dividen_net'];

$saldo_passiva=$var_pdf['saldo_passiva'];



//label

$label_app_name=$label_pdf['app_name'];

$company_name=$label_pdf['company_name'];
$company_address=$label_pdf['company_address'];
$company_phone=$label_pdf['company_phone'];

$label_book_balance_sheet=$label_pdf['book_balance_sheet'];

$label_period=$label_pdf['period'];

$label_taxonomi_asset=$label_pdf['taxonomi_asset'];

$label_balance=$label_pdf['balance'];

$label_currency=$label_pdf['currency'];

$label_amount=$label_pdf['amount'];

$label_taxonomi_passiva=$label_pdf['taxonomi_passiva'];

$label_dividen=$label_pdf['dividen'];

$label_current_period=$label_pdf['current_period'];

$label_ledgerdetails_total=$label_pdf['ledgerdetails_total'];

$label_taxonomi_asset=$label_pdf['taxonomi_asset'];

$label_ledgerdetails_total=$label_pdf['ledgerdetails_total'];



$html = "

<html>

<head>

<meta charset=\"UTF-8\">

<title>$app_name</title>

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

<style>
body{
	color:#333333;
}
.text-center{
	text-align: center;
}
.text-right{
	text-align: right;
}
h1,h2,h3,h4{
	margin: 0px;
	padding: 0px;
}
.alamat{
	margin-top: 20px;
	margin-bottom: 10px;
}
.garis{
	border-top: double #333;
}
.garis2{
	border-bottom: 1px dashed #333;
}
.ttd{
}
.clear{
	clear: both;
}
.right {
    float: right;
}

table.gridtable {
	border-width: 1px;
	border-color: #666666;
	border-style: solid;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
}
table.gridtable td.line {
	border-top-width: 1px;
	padding: 0px;
	border-style: solid;
	border-color: #666666;
}
table.gridtable td {
	padding: 8px;
	border-style: solid;
	border-right: 1px #666666;
}
</style>

</head>

<body>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
	<td align=\"center\">
<div class=\"text-center\"><h1>$company_name</h1></div>
<div class=\"text-center\"><h3>$company_address</h3></div>
<div class=\"text-center\">No. Telp/HP : $company_phone</div>
</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<div class=\"garis\">&nbsp;</div>
<div>&nbsp;</div>
<h2 class=\"text-center\">NERACA KEUANGAN</h2>
<h3 class=\"text-center\">Periode: 01/01/$year -$days_num/$month/$year</h3>
<div>&nbsp;</div>

<div class=\"clear\">
<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\" class=\"gridtable\">

  <tr>

<th width=\"62%\" align=\"center\"><strong>$label_taxonomi_asset</strong></th>

<th width=\"38%\" align=\"center\"><strong>$label_balance<br />

  ($label_currency)</strong></th>

  </tr>

  $balance_sheet_1d

  <tr>

<th align=\"center\"><strong><u>$label_ledgerdetails_total $label_taxonomi_asset</u></strong></th>

<th align=\"center\"><strong><u>$balance_activa</u></strong></th>

  </tr>

</table>

<table width=\"100%\">
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>

<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\" class=\"gridtable\">

  <tr>

<th width=\"62%\" align=\"center\"><strong>$label_taxonomi_passiva</strong></th>

<th width=\"38%\" align=\"center\"><strong>$label_balance<br />

  ($label_currency)</strong></th>

  </tr>

  $balance_sheet_2k

  <tr>

<td bgcolor=\"#FFFFFF\">&nbsp;</td>

<td align=\"center\" bgcolor=\"#FFFFFF\">&nbsp;</td>

  </tr>

  $balance_sheet_3k

  <tr>

<td bgcolor=\"#FFFFFF\"><strong><u>$label_dividen $label_current_period</u></strong></td>

<td align=\"center\" bgcolor=\"#FFFFFF\">&nbsp;</td>

  </tr>

  <tr>

<td bgcolor=\"#FFFFFF\">1. $label_dividen</td>

<td align=\"center\" bgcolor=\"#FFFFFF\">$dividen</td>

  </tr>

  <tr>

<td align=\"center\" bgcolor=\"#FFFFFF\">&nbsp;</td>

<td align=\"center\" bgcolor=\"#FFFFFF\">&nbsp;</td>

  </tr>

  <tr>

<td align=\"center\" bgcolor=\"#FFFFFF\"><strong>$label_amount</strong></td>

<td align=\"center\" bgcolor=\"#FFFFFF\">$dividen_net</td>

  </tr>

  <tr>

<td align=\"center\" bgcolor=\"#FFFFFF\">&nbsp;</td>

<td align=\"center\" bgcolor=\"#FFFFFF\">&nbsp;</td>

  </tr>

  <tr>

<th align=\"center\"><strong><u>$label_ledgerdetails_total $label_taxonomi_passiva</u></strong></th>

<th align=\"center\"><strong><u>$saldo_passiva</u></strong></th>

  </tr>

</table>

  </div>

</div>

</div>

</div>



</section>

</body>

</html>

";



/*echo $html;*/
/**/
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$fontData_custome=$global->pdf_fonts();

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => $fontDirs,
    'fontdata' => $fontData + $fontData_custome,
    'default_font_size' => $company['company_font_size'],'default_font' => $company['company_font'],'format' => $company['company_paper']
]);


//$mpdf = new \Mpdf\Mpdf();
//$mpdf = new \Mpdf\Mpdf(['format' => 'Letter', 'default_font' => 'Garuda-Bold']);
//$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
//$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [240, 140]]);
//$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$mpdf->WriteHTML($html);
$mpdf->Output();


?>