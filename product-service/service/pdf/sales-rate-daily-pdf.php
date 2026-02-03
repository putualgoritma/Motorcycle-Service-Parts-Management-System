<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/sales-rate-daily-pdf-inc.php"); ?>
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
    <td align=\"center\"><span class=\"textred\">PENJUALAN RATE HARIAN</span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$service_order_register_start." sd ".$service_order_register."</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td width=\"14%\"><strong>Tanggal</strong></td>
    <td width=\"26%\"><strong>No. Transasksi</strong></td>
    <td width=\"15%\"><strong>Jasa Bayar</strong></td>
    <td width=\"15%\"><strong>Jasa Gratis</strong></td>
    <td width=\"15%\"><strong>Part Bayar</strong></td>
    <td width=\"15%\"><strong>Part Gratis</strong></td>
  </tr>
  ";
		$sales_amount_kpb_total=0;
		$sales_amount_non_kpb_total=0;
		$psales_amount_kpb_total=0;
		$psales_amount_non_kpb_total=0;
		//service_orderdetails_onservice_row
		for($i=0;$i<count($service_order_arr);$i++){
		$sales_amount_kpb_total+=$service_order_arr[$i]['sales_amount_kpb'];
		$sales_amount_non_kpb_total+=$service_order_arr[$i]['sales_amount_non_kpb'];
		$psales_amount_kpb_total+=$service_order_arr[$i]['psales_amount_kpb'];
		$psales_amount_non_kpb_total+=$service_order_arr[$i]['psales_amount_non_kpb'];
		$html .= "
  <tr>
    <td>".$service_order_arr[$i]['service_order_register']."</td>
    <td>".str_replace("PKB","SRV",$service_order_arr[$i]['service_order_code'])."</td>
    <td>".$global->num_format2($service_order_arr[$i]['sales_amount_non_kpb'])."</td>
    <td>".$global->num_format2($service_order_arr[$i]['sales_amount_kpb'])."</td>
    <td>".$global->num_format2($service_order_arr[$i]['psales_amount_non_kpb'])."</td>
    <td>".$global->num_format2($service_order_arr[$i]['psales_amount_kpb'])."</td>
  </tr>
  ";
		}
		//product_orderdetails_onproduct_row
		for($i=0;$i<count($product_orderdetails_onproduct_row['select_data']);$i++){
		$psales_amount_kpb_total+=$product_orderdetails_onproduct_row['select_data'][$i]['psales_amount_kpb'];
		$psales_amount_non_kpb_total+=$product_orderdetails_onproduct_row['select_data'][$i]['psales_amount_non_kpb'];
		$html .= "
  <tr>
    <td>".$product_orderdetails_onproduct_row['select_data'][$i]['product_order_register']."</td>
    <td>".$product_orderdetails_onproduct_row['select_data'][$i]['product_order_code']."</td>
    <td>".$global->num_format2(0)."</td>
    <td>".$global->num_format2(0)."</td>
    <td>".$global->num_format2($product_orderdetails_onproduct_row['select_data'][$i]['psales_amount_non_kpb'])."</td>
    <td>".$global->num_format2($product_orderdetails_onproduct_row['select_data'][$i]['psales_amount_kpb'])."</td>
  </tr>
  ";
		}
	$html .= "
  <tr>
    <td><strong>Total</strong></td>
    <td>&nbsp;</td>
    <td>".$global->num_format2($sales_amount_non_kpb_total)."</td>
    <td>".$global->num_format2($sales_amount_kpb_total)."</td>
    <td>".$global->num_format2($psales_amount_non_kpb_total)."</td>
    <td>".$global->num_format2($psales_amount_kpb_total)."</td>
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