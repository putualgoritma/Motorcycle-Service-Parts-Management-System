<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/mechanic-service-comission-pdf-inc.php"); ?>
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
.col-md-5 {
    width: 45%;
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
    <td align=\"center\"><span class=\"textred\">MECHANIC COMISSION</span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$service_order_register_start." sd ".$service_order_register."</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>I. LAPORAN KOMISI MEKANIK</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\" class=\"tableborder2\" style=\"font-size: 9pt;\">
  <tr>
    <td width=\"13%\" rowspan=\"2\" align=\"center\" valign=\"middle\"><strong>MEKANIK</strong></td>
    <td colspan=\"8\" align=\"center\"><strong>ASS/KPB</strong></td>
    <td width=\"6%\" colspan=\"2\" rowspan=\"2\" align=\"center\"><p><strong>CLAIM<br />
      C2</strong></p></td>
    <td colspan=\"8\" align=\"center\"><strong>QUICK SERVICE</strong></td>
    <td width=\"5%\" colspan=\"2\" rowspan=\"2\" align=\"center\"><strong>HR</strong></td>
    <td width=\"5%\" colspan=\"2\" rowspan=\"2\" align=\"center\"><strong>OTHER</strong></td>
    <td width=\"5%\" colspan=\"2\" rowspan=\"2\" align=\"center\"><strong>JR</strong></td>
    <td width=\"6%\" colspan=\"2\" rowspan=\"2\" align=\"center\"><strong>TOTAL<br />
      JOB</strong></td>
    <td width=\"7%\" rowspan=\"2\" align=\"center\"><strong>UNIT<br />
    ENTRY</strong></td>
  </tr>
  <tr>
    <td width=\"5%\" colspan=\"2\" align=\"center\"><strong>1</strong></td>
    <td width=\"5%\" colspan=\"2\" align=\"center\"><strong>2</strong></td>
    <td width=\"5%\" colspan=\"2\" align=\"center\"><strong>3</strong></td>
    <td width=\"5%\" colspan=\"2\" align=\"center\"><strong>4</strong></td>
    <td width=\"5%\" colspan=\"2\" align=\"center\"><strong>CS</strong></td>
    <td width=\"5%\" colspan=\"2\" align=\"center\"><strong>LS</strong></td>
    <td width=\"5%\" colspan=\"2\" align=\"center\"><strong>OR+</strong></td>
    <td width=\"5%\" colspan=\"2\" align=\"center\"><strong>LR</strong></td>
  </tr>
  ";
		$total_amount=0;
		for($i=0;$i<count($service_in_service_order_staff_arr);$i++){
		$html .= "
  <tr>
    <td>".$service_in_service_order_staff_arr[$i]['staff_name']."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['ASS1'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['ASS1'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['ASS2'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['ASS2'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['ASS3'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['ASS3'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['ASS4'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['ASS4'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['CLAIMC2'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['CLAIMC2'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['CS'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['CS'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['LS'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['LS'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['OR+'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['OR+'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['LR'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['LR'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['HR'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['HR'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['OTHER'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['OTHER'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['JR'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['JR'],0)."</td>
    <td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['total_jobs'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['price']['total_jobs'],0)."</td>
	<td align=\"center\" nowrap>".$global->num_format2($service_in_service_order_staff_arr[$i]['unit_entry'],0)."</td>
  </tr>
  ";
	}
	$total_amount+=$servicetot_arr['TOTAL'];
	$html .= "
  <tr>
    <td><strong>TOTAL</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['ASS1'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['ASS1'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['ASS2'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['ASS2'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['ASS3'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['ASS3'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['ASS4'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['ASS4'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['CLAIMC2'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['CLAIMC2'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['CS'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['CS'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['LS'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['LS'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['OR+'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['OR+'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['LR'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['LR'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['HR'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['HR'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['OTHER'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['OTHER'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['JR'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['JR'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['total_jobs'],0)."</strong></td>
	<td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['price_total']['total_jobs'],0)."</strong></td>
    <td align=\"center\" nowrap><strong>".$global->num_format2($service_in_service_total_staff_arr['total']['unit_entry'],0)."</strong></td>
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
    'default_font_size' => $company['company_font_size'],'default_font' => $company['company_font'],'format' => $company['company_paper'],'orientation' => 'L'
]);


//$mpdf = new \Mpdf\Mpdf();
//$mpdf = new \Mpdf\Mpdf(['format' => 'Letter', 'default_font' => 'Garuda-Bold']);
//$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
//$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [240, 140]]);
//$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$mpdf->WriteHTML($html);
$mpdf->Output();


?>