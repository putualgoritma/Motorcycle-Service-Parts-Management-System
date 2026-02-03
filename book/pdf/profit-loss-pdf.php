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

$profit=$var_pdf['profit'];

$balance_profit_total=$var_pdf['balance_profit_total'];

$loss=$var_pdf['loss'];

$balance_loss_total=$var_pdf['balance_loss_total'];

$dividen_balance_total=$var_pdf['dividen_balance_total'];



//label

$app_name=$label_pdf['app_name'];

$company_name=$label_pdf['company_name'];
$company_address=$label_pdf['company_address'];
$company_phone=$label_pdf['company_phone'];

$profit_loss=$label_pdf['profit_loss'];

$period=$label_pdf['period'];

$briefing=$label_pdf['briefing'];

$amount=$label_pdf['amount'];

$dividen=$label_pdf['dividen'];



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
<h2 class=\"text-center\">$profit_loss</h2>
<h3 class=\"text-center\">Periode: 01/01/$year -$days_num/$month/$year</h3>
<div>&nbsp;</div>

<div class=\"clear\">
<table width=\"100%\" class=\"gridtable\">

<thead>

<tr>

<th width=\"78%\" align=\"center\"><strong>$briefing</strong></th>

<th width=\"22%\" align=\"center\" nowrap=\"nowrap\"><strong>$amount</strong></th>

</tr>

</thead>

<tbody>

$profit

<tr>

<td align=\"center\"><strong>Total Pendapatan</strong></td>

<td align=\"center\">$balance_profit_total</td>

</tr>

<tr>

<td>&nbsp;</td>

<td align=\"center\">&nbsp;</td>

</tr>

$loss

<tr>

<td align=\"center\"><strong>Total Biaya</strong></td>

<td align=\"center\">$balance_loss_total</td>

</tr>

<tr>

<td>&nbsp;</td>

<td align=\"center\">&nbsp;</td>

</tr>



<tr>

<th><strong>$dividen</strong></th>

<th align=\"center\"><strong>$dividen_balance_total</strong></th>

</tr>



</tbody>

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