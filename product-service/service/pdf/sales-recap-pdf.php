<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/sales-recap-pdf-inc.php"); ?>
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
    <td align=\"center\"><span class=\"textred\">REKAP PENJUALAN</span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$service_order_register_start." sd ".$service_order_register."</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td width=\"12%\"><strong>Tanggal</strong></td>
    <td width=\"23%\"><strong>UE</strong></td>
    <td width=\"13%\"><strong>Jasa</strong></td>
    <td width=\"13%\"><strong>Part</strong></td>
    <td width=\"13%\"><strong>Bayar</strong></td>
    <td width=\"13%\"><strong>Gratis</strong></td>
  </tr>
  ";
		$ue_total=0;
		$sales_total=0;
		$psales_total=0;
		$non_kpb_total=0;
		$kpb_total=0;
		//service_orderdetails_onservice_row
		foreach($sales_recap_arr as $sales_recap_key => $sales_recap_val) {
		//echo $sales_recap_arr[$sales_recap_key]['unit_entry'];
		$sales_amount=$sales_recap_arr[$sales_recap_key]['sales_amount'];
		$psales_amount=$sales_recap_arr[$sales_recap_key]['psales_amount'];
		$non_kpb_amount=$sales_recap_arr[$sales_recap_key]['non_kpb_amount'];
		$kpb_amount=$sales_recap_arr[$sales_recap_key]['kpb_amount'];
		$ue_total +=$sales_recap_arr[$sales_recap_key]['unit_entry'];
		$sales_total +=$sales_amount;
		$psales_total +=$psales_amount;
		$non_kpb_total +=$non_kpb_amount;
		$kpb_total +=$kpb_amount;
		$html .= "
  <tr>
    <td>".$sales_recap_arr[$sales_recap_key]['service_order_payregister']."</td>
    <td>".$sales_recap_arr[$sales_recap_key]['unit_entry']."</td>
    <td>".$global->num_format2($sales_amount)."</td>
    <td>".$global->num_format2($psales_amount)."</td>
    <td>".$global->num_format2($non_kpb_amount)."</td>
    <td>".$global->num_format2($kpb_amount)."</td>
  </tr>
  ";
		}
	$html .= "
  <tr>
    <td><strong>Total</strong></td>
    <td>".$ue_total."</td>
    <td>".$global->num_format2($sales_total)."</td>
    <td>".$global->num_format2($psales_total)."</td>
    <td>".$global->num_format2($non_kpb_total)."</td>
    <td>".$global->num_format2($kpb_total)."</td>
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