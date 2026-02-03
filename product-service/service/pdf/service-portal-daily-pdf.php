<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/service-portal-daily-pdf-inc.php"); ?>
<? require_once $path.'vendor/autoload.php'; ?>
<? 
$html = "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>Untitled Document</title>
<style>
@page {
    margin-left: 0.5cm;
    margin-right: 0.5cm;
	margin-top: 0.5cm;
    margin-bottom: 0.5cm;
}

body{
	color:#000000;
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
h2{
	font-size:60px;
}
.alamat{
	margin-top: 20px;
	margin-bottom: 10px;
}
.garis{
	border-top: 1px solid #333;
}
.garis2{
	border-bottom: 1px solid #333;
}
.ttd{
}
.clear{
	clear: both;
}
.tiny_space{
	height:5px;
}
.right {
    float: right;
}
.tr{ height:5px;}
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
table.gridtable td {
	padding: 8px;
	border-style: solid;
	border-right: 1px #666666;
}
.col-md-3 {
    width: 30%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-7 {
    width: 66%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-2 {
    width: 4%;
	float: left; 
	margin-bottom: 0pt;
}
.line3 {background-image:url(line.png); background-position:top; background-repeat: repeat-x; margin-top: 10px;}
.line2 {background-image:url(line.png); background-position:bottom; background-repeat: repeat-x; padding-bottom: 10px;}
.tableborder{ border: 1px solid #333; border-collapse:collapse;}
.tableborder2{ border: 1px solid #333; border-collapse:collapse}
.borderbottom{ border-bottom: 1px solid #333;}
.textred{color: #F00;}
</style>
</head>

<body>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"65%\" valign=\"top\"><h3> ".strtoupper($company['company_name'])." ".$company['dealer_code']."</h3></td>                
      </tr>
<tr>
      <td>".strtoupper($company['company_address'])."</td>       
  </tr>
  <tr>
      <td>Telp: ".strtoupper($company['company_phone'])."</td>       
  </tr>
      <tr>
      <td>&nbsp;</td>
      </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"center\"><span class=\"textred\">REKAPITULASI HARIAN BENGKEL</span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$service_order_register_start." sd ".$service_order_register."</td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td width=\"30%\">Jumlah Mekanik</td>
    <td width=\"70%\">: ".$mechanic_num."</td>
  </tr>
  <tr>
    <td>Jumlah PIT</td>
    <td>: ".$company['company_pit']."</td>
  </tr>
  <tr>
    <td>Total Entry</td>
    <td>: ".$service_in_service_total_arr['total']['unit_entry']."</td>
  </tr>
  <tr>
    <td>Total Pendapatan Jasa</td>
    <td>: ".$global->num_format2($servicetot_arr['TOTAL'])."</td>
  </tr>
  <tr>
    <td>Total Pendapatan Part</td>
    <td>: ".$global->num_format2($product_in_service_total)."</td>
  </tr>
  <tr>
    <td>Total Penjualan Oli</td>
    <td>: ".$global->num_format2($product_in_service_oli)."</td>
  </tr>
  <tr>
    <td>Grand Total Pendapatan</td>
    <td>: ".$global->num_format2($grand_total_income)."</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td><strong>Pekerjaan</strong></td>
    <td><strong>Unit</strong></td>
    <td><strong>Pendapatan</strong></td>
  </tr>
  <tr>
    <td width=\"40%\">KPB 1</td>
    <td width=\"30%\">".$service_in_service_total_arr['total']['ASS1']."</td>
    <td width=\"30%\">".$global->num_format2($service_in_service_total_arr['total_price']['ASS1'])."</td>
  </tr>
  <tr>
    <td>KPB 2</td>
    <td>".$service_in_service_total_arr['total']['ASS2']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['ASS2'])."</td>
  </tr>
  <tr>
    <td>KPB 3</td>
    <td>".$service_in_service_total_arr['total']['ASS3']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['ASS3'])."</td>
  </tr>
  <tr>
    <td>KPB 4</td>
    <td>".$service_in_service_total_arr['total']['ASS4']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['ASS4'])."</td>
  </tr>
  <tr>
    <td>CLAIM</td>
    <td>".$service_in_service_total_arr['total']['CLAIMC2']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['CLAIMC2'])."</td>
  </tr>
  <tr>
    <td>SERVICE LENGKAP</td>
    <td>".$service_in_service_total_arr['total']['CS']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['CS'])."</td>
  </tr>
  <tr>
    <td>SERVICE RINGAN</td>
    <td>".$service_in_service_total_arr['total']['LS']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['LS'])."</td>
  </tr>
  <tr>
    <td>GANTI OLI</td>
    <td>".$service_in_service_total_arr['total']['OR+']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['OR+'])."</td>
  </tr>
  <tr>
    <td>LR</td>
    <td>".$service_in_service_total_arr['total']['LR']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['LR'])."</td>
  </tr>
  <tr>
    <td>HR</td>
    <td>".$service_in_service_total_arr['total']['HR']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['HR'])."</td>
  </tr>
  <tr>
    <td>OTHER JOB</td>
    <td>".$service_in_service_total_arr['total']['OTHER']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['OTHER'])."</td>
  </tr>
  <tr>
    <td>JOB RETURN</td>
    <td>".$service_in_service_total_arr['total']['JR']."</td>
    <td>".$global->num_format2($service_in_service_total_arr['total_price']['JR'])."</td>
  </tr>
  
</table>
<div class=\"clear\">&nbsp;</div>
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