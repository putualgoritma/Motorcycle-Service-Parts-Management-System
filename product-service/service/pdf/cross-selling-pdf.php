<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/cross-selling-pdf-inc.php"); ?>
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
    <td align=\"center\"><span class=\"textred\">DATA CROSS SELLING</span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$service_order_register_start." sd ".$service_order_register."</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td><strong>Tanggal</strong></td>
    <td><strong>No. Pol</strong></td>
    <td><strong>Type</strong></td>
    <td><strong>CC</strong></td>
    <td><strong>Warna</strong></td>
    <td><strong>No. Ran</strong></td>
    <td><strong>No. Me</strong></td>
    <td><strong>Thn Rkt</strong></td>
    <td><strong>Nama</strong></td>
    <td><strong>Alamat</strong></td>
    <td><strong>Kel.</strong></td>
    <td><strong>Kec.</strong></td>
    <td><strong>Kota</strong></td>
    <td><strong>No. Tlf</strong></td>
    <td><strong>No. HP</strong></td>
    <td><strong>J. Ser</strong></td>
    <td><strong>No. Dealer</strong></td>
    <td><strong>Alasan Ser</strong></td>
    <td><strong>Hubungan</strong></td>
  </tr>
  ";
		for($i=0;$i<count($service_orderdetails_onservice_row['select_data']);$i++){
		$html .= "
  <tr>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['service_order_register']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_code']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_type_name']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_type_cc']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['color_code']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_frame_no']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_machine_no']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_manufacture']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['users_name']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['users_address']."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['users_phone']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['category_code']."</td>
    <td>".$company['dealer_code']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['service_order_reason']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['service_order_usersowner_rel']."</td>
  </tr>
  ";
	}
	$html .= "
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