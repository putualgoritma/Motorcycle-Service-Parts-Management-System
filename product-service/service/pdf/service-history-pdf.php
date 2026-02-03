<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/service-history-pdf-inc.php"); ?>
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
.garis3{
	border-top: 2px solid #333;
}
.garis-putus{
	border-bottom: dashed 1px #333;
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
.col-md-5 {
    width: 49%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-2 {
    width: 2%;
	float: left; 
	margin-bottom: 0pt;
}
.line3 {background-image:url(line.png); background-position:top; background-repeat: repeat-x; margin-top: 10px;}
.line2 {background-image:url(line.png); background-position:bottom; background-repeat: repeat-x; padding-bottom: 10px;}
.tableborder{ border: 1px solid #333; border-collapse:collapse;}
.borderbottom{ border-bottom: 1px solid #333;}
</style>
</head>

<body>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><h3> ".strtoupper($company['company_name'])." ".$company['dealer_code']."</h3></td>
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
  <tr>
    <td class=\"garis\">&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\"><span style=\"color: #F00\"><strong>HISTORY KENDARAAN</strong></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"garis2\">
  <tr>
    <td width=\"21%\"><strong>DARI TGL</strong> : -</td>
    <td width=\"75%\"><strong>SAMPAI TGL</strong> -</td>
    <td width=\"4%\">&nbsp;</td>
  </tr>
</table>

<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">
  <tr>
    <td width=\"10%\"><strong>No. Polisi</strong></td>
    <td width=\"1%\">:</td>
    <td width=\"29%\">".$motorcycle_code."</td>
    <td width=\"14%\"><strong>No.Telp/HP</strong></td>
    <td width=\"1%\">:</td>
    <td width=\"15%\">".$motorcycle_row['select_data'][0]['users_phone']."</td>
    <td width=\"10%\">/</td>
    <td width=\"6%\">&nbsp;</td>
    <td width=\"14%\">&nbsp;</td>
  </tr>
  <tr>
    <td width=\"10%\"><strong>Pemilik</strong></td>
    <td width=\"1%\">:</td>
    <td width=\"29%\">".$motorcycle_row['select_data'][0]['users_name']."</td>
    <td width=\"14%\"><strong>No.Rangka/Mesin</strong></td>
    <td width=\"1%\">:</td>
    <td width=\"15%\">".$motorcycle_row['select_data'][0]['motorcycle_frame_no']."</td>
    <td width=\"10%\">/ ".$motorcycle_row['select_data'][0]['motorcycle_machine_no']."</td>
    <td width=\"6%\">&nbsp;</td>
    <td width=\"14%\">&nbsp;</td>
  </tr>
  <tr>
    <td width=\"10%\" valign=\"top\"><strong>Alamat</strong></td>
    <td width=\"1%\" valign=\"top\">:</td>
    <td width=\"29%\" valign=\"top\">".$motorcycle_row['select_data'][0]['users_address']."</td>
    <td width=\"14%\" valign=\"top\"><strong>Type/Warna/Thn</strong></td>
    <td width=\"1%\" valign=\"top\">:</td>
    <td width=\"15%\" valign=\"top\">".$motorcycle_row['select_data'][0]['motorcycle_type_name']."</td>
    <td width=\"10%\" valign=\"top\">/ ".$motorcycle_row['select_data'][0]['color_code']."</td>
    <td width=\"6%\" valign=\"top\">/ ".$motorcycle_row['select_data'][0]['motorcycle_manufacture']."</td>
    <td width=\"14%\" valign=\"top\">&nbsp;</td>
  </tr>
</table>
";
		//service_orderdetails_onservice_row
		for($i=0;$i<count($service_order_row['select_data']);$i++){
		$ic=$i+1;
		$html .= "
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\" class=\"garis garis2\">
  <tr>
    <td width=\"10%\" height=\"13\"><strong>Tanggal</strong></td>
    <td width=\"15%\"><strong>No. Faktur</strong></td>
    <td width=\"15%\"><strong>No. PKB</strong></td>
    <td width=\"30%\"><strong>Keluhan</strong></td>
    <td width=\"16%\"><strong>Mekanik</strong></td>
    <td width=\"7%\"><strong>Km</strong></td>
    <td width=\"7%\"><strong>Km Next</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\" class=\"\">
  <tr>
    <td width=\"10%\" valign=\"top\">".$service_order_row['select_data'][$i]['service_order_register']."</td>
    <td width=\"15%\" valign=\"top\">".$service_order_row['select_data'][$i]['service_order_code']."</td>
    <td width=\"15%\" valign=\"top\">".$service_order_row['select_data'][$i]['service_order_code']."</td>
    <td width=\"30%\" valign=\"top\">".$service_order_row['select_data'][$i]['service_order_description']."</td>
    <td width=\"16%\" valign=\"top\"><strong>".$service_order_row['select_data'][$i]['staff_name']."</strong></td>
    <td width=\"7%\" valign=\"top\">".$service_order_row['select_data'][$i]['service_order_km_now']."</td>
    <td width=\"7%\" valign=\"top\">".$service_order_row['select_data'][$i]['service_order_km_next']."</td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">
  <tr>
    <td width=\"10%\"><strong><u>No.</u></strong></td>
    <td width=\"30%\"><strong><u>Kode Jasa</u></strong></td>
    <td width=\"30%\"><strong><u>Nama Jasa</u></strong></td>
    <td width=\"23%\">&nbsp;</td>
    <td width=\"7%\">&nbsp;</td>
  </tr>
  ";
		//service_orderdetails_onservice_row
		for($j=0;$j<count($service_in_service_order_row[$i]['select_data']);$j++){
		$k=$j+1;;
		$html .= "
  <tr>
    <td>".$k."</td>
    <td>".$service_in_service_order_row[$i]['select_data'][$j]['service_code']."</td>
    <td>".$service_in_service_order_row[$i]['select_data'][$j]['service_name']."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  ";
		}
		$html .= "
  <tr>
    <td><strong><u>No.</u></strong></td>
    <td><strong><u>Kode Part</u></strong></td>
    <td><strong><u>Nama Part</u></strong></td>
    <td><strong><u>Qty Satuan</u></strong></td>
    <td>&nbsp;</td>
  </tr>
  ";
		//product_orderdetails_onservice_row
		for($l=0;$l<count($product_in_service_order_row[$i]['select_data']);$l++){
		$m=$l+1;;
		$html .= "
  <tr>
    <td>".$m."</td>
    <td>".$product_in_service_order_row[$i]['select_data'][$l]['product_code']."</td>
    <td>".$product_in_service_order_row[$i]['select_data'][$l]['product_name']."</td>
    <td>".$product_in_service_order_row[$i]['select_data'][$l]['product_orderdetails_quantity']." ".$product_in_service_order_row[$i]['select_data'][$l]['unit_name']."</td>
    <td>&nbsp;</td>
  </tr>
  ";
		}
		$html .= "
</table>
";
		}
		$html .= "
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"garis3\">
  <tr>
    <td><strong>Jumlah Service No. Polisi ".$motorcycle_code." Adalah ".$ic." kali</strong></td>
  </tr>
</table>
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