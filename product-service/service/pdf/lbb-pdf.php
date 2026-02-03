<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/lbb-pdf-inc.php"); ?>
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
    <td align=\"center\"><span class=\"textred\">LBB BENGKEL</span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$_REQUEST['service_order_monthly']."</td>
  </tr>
  <tr>
    <td><strong>I. UNIT ENTRY & JOB</strong></td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td width=\"13%\" rowspan=\"2\" align=\"center\" valign=\"middle\"><strong>TIPE</strong></td>
    <td colspan=\"4\" align=\"center\"><strong>ASS/KPB</strong></td>
    <td width=\"6%\" rowspan=\"2\" align=\"center\"><p><strong>CLAIM<br />
      C2</strong></p></td>
    <td colspan=\"4\" align=\"center\"><strong>QUICK SERVICE</strong></td>
    <td width=\"5%\" rowspan=\"2\" align=\"center\"><strong>HR</strong></td>
    <td width=\"5%\" rowspan=\"2\" align=\"center\"><strong>OTHER</strong></td>
    <td width=\"5%\" rowspan=\"2\" align=\"center\"><strong>JR</strong></td>
    <td width=\"6%\" rowspan=\"2\" align=\"center\"><strong>TOTAL<br />
      JOB</strong></td>
    <td width=\"7%\" rowspan=\"2\" align=\"center\"><strong>UNIT<br />
    ENTRY</strong></td>
  </tr>
  <tr>
    <td width=\"5%\" align=\"center\"><strong>1</strong></td>
    <td width=\"5%\" align=\"center\"><strong>2</strong></td>
    <td width=\"5%\" align=\"center\"><strong>3</strong></td>
    <td width=\"5%\" align=\"center\"><strong>4</strong></td>
    <td width=\"5%\" align=\"center\"><strong>CS</strong></td>
    <td width=\"5%\" align=\"center\"><strong>LS</strong></td>
    <td width=\"5%\" align=\"center\"><strong>OR+</strong></td>
    <td width=\"5%\" align=\"center\"><strong>LR</strong></td>
  </tr>
  ";
		$total_amount=0;
		for($i=0;$i<count($service_in_service_order_arr);$i++){
		$html .= "
  <tr>
    <td>".$service_in_service_order_arr[$i]['motorcycle_type_name']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['ASS1']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['ASS2']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['ASS3']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['ASS4']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['CLAIMC2']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['CS']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['LS']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['OR+']."</td>
    <td width=\"7%\" align=\"center\">".$service_in_service_order_arr[$i]['LR']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['HR']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['OTHER']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['JR']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['total_jobs']."</td>
    <td align=\"center\">".$service_in_service_order_arr[$i]['unit_entry']."</td>
  </tr>
  ";
	}
	$total_amount+=$servicetot_arr['TOTAL'];
	$html .= "
  <tr>
    <td><strong>TOTAL</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['ASS1']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['ASS2']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['ASS3']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['ASS4']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['CLAIMC2']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['CS']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['LS']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['OR+']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['LR']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['HR']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['OTHER']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['JR']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['total_jobs']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_arr['total']['unit_entry']."</strong></td>
  </tr>
  
</table>
<div class=\"clear\">&nbsp;</div>

<div class=\"col-md-4\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><strong>II. PENJUALAN JASA</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"4%\">&nbsp;</td>
      <td width=\"59%\">a. Jas/Ongkos Kerja</td>
      <td width=\"4%\">:</td>
      <td width=\"33%\" align=\"right\">".$global->num_format2($servicetot_arr['OK'])."</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>b. ASS/KPB </td>
      <td>:</td>
      <td align=\"right\">".$global->num_format2($servicetot_arr['ASS'])."</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>c. Claim C2</td>
      <td>:</td>
      <td align=\"right\">".$global->num_format2($servicetot_arr['CLAIMC2'])."</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>d. Other/Lain-lain</td>
      <td>:</td>
      <td align=\"right\">".$global->num_format2($servicetot_arr['OTHER'])."</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td align=\"right\" class=\"borderbottom\">&nbsp;</td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td><strong>Total</strong></td>
      <td>:</td>
      <td align=\"right\"><strong>".$global->num_format2($servicetot_arr['TOTAL'])."</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align=\"right\">&nbsp;</td>
    </tr>
  </table>
</div>
<div class=\"col-md-1\">&nbsp;</div>
<div class=\"col-md-4\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><strong>III. PENJUALAN SUKU CADANG LANGSUNG</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    ";
	$product_in_total=0;
	for($i=0;$i<count($product_in_product_order_row['select_data']);$i++){
	$j=$i+1;
	$product_in_total+=$product_in_product_order_row['select_data'][$i]['price'];
	$html .= "
	<tr>
      <td width=\"4%\">&nbsp;</td>
      <td width=\"59%\">".$j.". ".$product_in_product_order_row['select_data'][$i]['category_name']."</td>
      <td width=\"4%\">:</td>
      <td width=\"33%\">".$global->num_format2($product_in_product_order_row['select_data'][$i]['price'])."</td>
    </tr>
    ";
	}
	$total_amount+=$product_in_total;
	for($i=0;$i<count($product_in_service_order_row['select_data']);$i++){
	$j=$i+1;
	$total_amount+=$product_in_service_order_row['select_data'][$i]['price'];
	}
	$html .= "
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td class=\"borderbottom\">&nbsp;</td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td><strong>Total</strong></td>
      <td>:</td>
      <td><strong>".$global->num_format2($product_in_total)."</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div class=\"clear tiny_space\"></div>
<div class=\"col-md-5\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><strong>IV. PENJUALAN SUKU CADANG SERVICE</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  ";
	$product_in_service_total=0;
	for($i=0;$i<count($product_in_service_order_row['select_data']);$i++){
	$j=$i+1;
	$product_in_service_total+=$product_in_service_order_row['select_data'][$i]['price'];
	$html .= "
  <tr>
    <td width=\"4%\">&nbsp;</td>
    <td width=\"59%\">".$j.". ".$product_in_service_order_row['select_data'][$i]['category_name']."</td>
    <td width=\"4%\">:</td>
    <td width=\"33%\">".$global->num_format2($product_in_service_order_row['select_data'][$i]['price'])."</td>
  </tr>
  ";
	}
	$html .= "
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
      <td class=\"borderbottom\">&nbsp;</td>
    </tr>
	<tr>
      <td>&nbsp;</td>
	  <td><strong>Total</strong></td>
      <td>:</td>
      <td><strong>".$global->num_format2($product_in_service_total)."</strong></td>
    </tr>
</table>
</div>
<div class=\"col-md-2\">&nbsp;</div>
<div class=\"col-md-5\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><strong>V. PENGHASILAN BENGKEL</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr>
    <td width=\"4%\">&nbsp;</td>
    <td width=\"59%\">Total</td>
    <td width=\"4%\">:</td>
    <td width=\"33%\"><strong><u>".$global->num_format2($total_amount)."</u></td>
    </tr>
</table>
</div>
<div class=\"clear tiny_space\"></div>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>VI. LAPORAN PRESTASI MEKANIK</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td width=\"13%\" rowspan=\"2\" align=\"center\" valign=\"middle\"><strong>MEKANIK</strong></td>
    <td colspan=\"4\" align=\"center\"><strong>ASS/KPB</strong></td>
    <td width=\"6%\" rowspan=\"2\" align=\"center\"><p><strong>CLAIM<br />
      C2</strong></p></td>
    <td colspan=\"4\" align=\"center\"><strong>QUICK SERVICE</strong></td>
    <td width=\"5%\" rowspan=\"2\" align=\"center\"><strong>HR</strong></td>
    <td width=\"5%\" rowspan=\"2\" align=\"center\"><strong>OTHER</strong></td>
    <td width=\"5%\" rowspan=\"2\" align=\"center\"><strong>JR</strong></td>
    <td width=\"6%\" rowspan=\"2\" align=\"center\"><strong>TOTAL<br />
      JOB</strong></td>
    <td width=\"7%\" rowspan=\"2\" align=\"center\"><strong>UNIT<br />
    ENTRY</strong></td>
  </tr>
  <tr>
    <td width=\"5%\" align=\"center\"><strong>1</strong></td>
    <td width=\"5%\" align=\"center\"><strong>2</strong></td>
    <td width=\"5%\" align=\"center\"><strong>3</strong></td>
    <td width=\"5%\" align=\"center\"><strong>4</strong></td>
    <td width=\"5%\" align=\"center\"><strong>CS</strong></td>
    <td width=\"5%\" align=\"center\"><strong>LS</strong></td>
    <td width=\"5%\" align=\"center\"><strong>OR+</strong></td>
    <td width=\"5%\" align=\"center\"><strong>LR</strong></td>
  </tr>
  ";
		$total_amount=0;
		for($i=0;$i<count($service_in_service_order_staff_arr);$i++){
		$html .= "
  <tr>
    <td>".$service_in_service_order_staff_arr[$i]['staff_name']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['ASS1']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['ASS2']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['ASS3']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['ASS4']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['CLAIMC2']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['CS']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['LS']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['OR+']."</td>
    <td width=\"7%\" align=\"center\">".$service_in_service_order_staff_arr[$i]['LR']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['HR']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['OTHER']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['JR']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['total_jobs']."</td>
    <td align=\"center\">".$service_in_service_order_staff_arr[$i]['unit_entry']."</td>
  </tr>
  ";
	}
	$total_amount+=$servicetot_arr['TOTAL'];
	$html .= "
  <tr>
    <td><strong>TOTAL</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['ASS1']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['ASS2']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['ASS3']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['ASS4']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['CLAIMC2']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['CS']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['LS']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['OR+']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['LR']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['HR']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['OTHER']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['JR']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['total_jobs']."</strong></td>
    <td align=\"center\"><strong>".$service_in_service_total_staff_arr['total']['unit_entry']."</strong></td>
  </tr>
  
</table>
<div class=\"clear\">&nbsp;</div>

<div class=\"col-md-5\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><strong>VII. JUMLAH HARI KERJA DALAM BULAN INI</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"4%\">&nbsp;</td>
      <td width=\"59%\">Jumlah Hari</td>
      <td width=\"4%\">:</td>
      <td width=\"33%\">".$get_efective_work." Hari</td>
    </tr>
  </table>
</div>
<div class=\"col-md-2\">&nbsp;</div>
<div class=\"col-md-5\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><strong>VIII. RATA-RATA UNIT ENTRY</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"4%\">&nbsp;</td>
      <td width=\"59%\">Rata-Rata</td>
      <td width=\"4%\">:</td>
      <td width=\"33%\">".$ue_average." Unit</td>
    </tr>
  </table>
</div>

<div class=\"col-md-2\">&nbsp;</div>
<div class=\"col-md-5\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><strong>IX. BIAYA-BIAYA</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    ";
	$taxonomi_expense_total=0;
	$j=1;
	for($i=0;$i<count($taxonomi_expense_row['select_data']);$i++){
	$ledgerdetails_amount_debit=$taxonomi_expense_row['select_data'][$i]['ledgerdetails_amount_debit'];
	$ledgerdetails_amount_credit=$taxonomi_expense_row['select_data'][$i]['ledgerdetails_amount_credit'];
	$ledgerdetails_amount_balance=$ledgerdetails_amount_debit-$ledgerdetails_amount_credit;
	$taxonomi_expense_total+=$ledgerdetails_amount_balance;
	$html .= "
	<tr>
      <td width=\"4%\">&nbsp;</td>
      <td width=\"59%\">".$j.". ".$taxonomi_expense_row['select_data'][$i]['taxonomi_name']."</td>
      <td width=\"4%\">:</td>
      <td width=\"33%\" align=\"right\">".$global->num_format2($ledgerdetails_amount_balance)."</td>
    </tr>
	";
	$j++;
	}
	$total_net=$total_amount-$taxonomi_expense_total;
	$html .= "
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td align=\"right\" class=\"borderbottom\">&nbsp;</td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td><strong>Total</strong></td>
      <td>:</td>
      <td align=\"right\"><strong>".$global->num_format2($taxonomi_expense_total)."</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align=\"right\">&nbsp;</td>
    </tr>
  </table>
</div>
<div class=\"clear tiny_space\"></div>

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