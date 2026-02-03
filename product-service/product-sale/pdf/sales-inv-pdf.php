<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/sales-inv-pdf-inc.php"); ?>
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
.col-md-8 {
    width: 81%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-4 {
    width: 18%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-33 {
    width: 33%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-40 {
    width: 40%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-20 {
    width: 20%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-80 {
	width: 80%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-50 {
	width: 50%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-50r {
	width: 50%;
	float: right; 
	margin-bottom: 0pt;
}
.col-md-12 {
	width: 100%;
	float: left; 
}
.line3 {background-image:url(line.png); background-position:top; background-repeat: repeat-x; margin-top: 10px;}
.line2 {background-image:url(line.png); background-position:bottom; background-repeat: repeat-x; padding-bottom: 10px;}
.tableborder{ border: 1px solid #333; border-collapse:collapse;}
.borderbottom{ border-bottom: 1px solid #333;}
</style>
</head>

<body>
<div class=\"col-md-50\">
<div class=\"col-md-20\"><img src=\"".$path."templates/default/img/honda-logo.png\" width=\"150\" height=\"96\"></div>
<div class=\"col-md-80\">
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
</div>
</div>
<div class=\"col-md-50r\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"right\"><h3> FAKTUR PENJUALAN</h3></td>
  </tr>
</table>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	  <tr>
		<td align=\"right\">Nomor : ".$product_order_row['product_order_code']."</td>
      </tr>
  <tr>
		<td align=\"right\">Tanggal : ".$product_order_row['product_order_register']."&nbsp;&nbsp;&nbsp;".date("h:i:s A")."</td>
  </tr>
</table>
</div>
<div class=\"clear garis2\">&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"4%\">Kepada</td>
    <td width=\"37%\">: ".$users_row['users_name']."</td>
    <td width=\"21%\">&nbsp;</td>
    <td width=\"38%\" align=\"right\">";if(!empty($company['company_bank'])){ $html .= " Rekening Transfer: ".$company['company_bank'];}$html .= "</td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>: ".$users_row['users_address']."</td>
    <td>&nbsp;</td>
    <td align=\"right\">";if(!empty($company['company_bank'])){ $html .= "No: ".$company['company_bank_no'];}$html .= "</td>
  </tr>
  <tr>
  <td>Telp</td>
  <td>: ".$users_row['users_phone']."</td>
  <td>&nbsp;</td>
  <td align=\"right\">";if(!empty($company['company_bank'])){ $html .= "a/n: ".$company['company_bank_id'];}$html .= "</td>
   </tr>
   <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
   </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"garis garis2\">
  <tr>
    <td width=\"5%\">No.</td>
    <td width=\"13%\">Kode</td>
    <td width=\"35%\">Nama</td>
    <td width=\"3%\" align=\"right\">Qty</td>
    <td width=\"10%\">Satuan</td>
    <td width=\"15%\" align=\"right\">Harga</td>
    <td width=\"15%\" align=\"right\">Jumlah</td>
  </tr>
</table>
<div style=\"height: 3px;\">&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"garis garis2\">
  ";
		$j=1;
		$gross_total=0;
		$disc_total=0;
		$grand_total=0;
		$qty_total=0;
		for($i=0;$i<count($product_orderdetails_row['select_data']);$i++){
		$product_orderdetails_subtotal=$product_orderdetails_row['select_data'][$i]['product_orderdetails_quantity']*$product_orderdetails_row['select_data'][$i]['product_orderdetails_price'];
		$product_orderdetails_disc=$product_orderdetails_row['select_data'][$i]['product_orderdetails_quantity']*($product_orderdetails_row['select_data'][$i]['product_orderdetails_price']*($product_orderdetails_row['select_data'][$i]['product_orderdetails_discount']/100));
		$html .= "
  <tr>
    <td width=\"5%\">".$j."</td>
    <td width=\"13%\">".$product_orderdetails_row['select_data'][$i]['product_code']."</td>
    <td width=\"35%\">".$product_orderdetails_row['select_data'][$i]['product_name']."</td>
    <td width=\"3%\" align=\"right\">".$product_orderdetails_row['select_data'][$i]['product_orderdetails_quantity']."</td>
    <td width=\"10%\">".$product_orderdetails_row['select_data'][$i]['unit_code']."</td>
    <td width=\"15%\" align=\"right\">".$global->num_format2($product_orderdetails_row['select_data'][$i]['product_orderdetails_price'])."</td>
    <td width=\"15%\" align=\"right\">".$global->num_format2($product_orderdetails_subtotal)."</td>
  </tr>
  ";
	$j++;
	$gross_total+=$product_orderdetails_subtotal;
	$disc_total+=$product_orderdetails_disc;
	$qty_total+=$product_orderdetails_row['select_data'][$i]['product_orderdetails_quantity'];
	}
	$grand_total=$gross_total-$disc_total;
	$html .= "
</table>

<div class=\"col-md-8\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"66%\" align=\"right\">Total Qty :</td>
    <td width=\"5%\" align=\"right\">".$qty_total."</td>
    <td width=\"28%\">&nbsp;</td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"5%\">&nbsp;</td>
    <td width=\"1%\">&nbsp;</td>
    <td width=\"90%\">&nbsp;</td>
  </tr>
</table>
<div>&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"26%\" align=\"center\">Diterima Oleh,</td>
    <td width=\"7%\">&nbsp;</td>
    <td width=\"26%\" align=\"center\">Hormat kami</td>
    <td width=\"7%\">&nbsp;</td>
    <td width=\"34%\" align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class=\"borderbottom\" align=\"center\">&nbsp;</td>
    <td>&nbsp;</td>
    <td class=\"borderbottom\" align=\"center\">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
</div>
<div class=\"col-md-4\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td>Sub</td>
    <td>:</td>
    <td align=\"right\">".$global->num_format2($gross_total)."</td>
  </tr>
  <tr>
    <td>Disc</td>
    <td>:</td>
    <td align=\"right\">".$global->num_format2($disc_total)."</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align=\"right\">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align=\"right\">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align=\"right\">&nbsp;</td>
  </tr>
  <tr>
    <td>Total</td>
    <td>:</td>
    <td align=\"right\">".$global->num_format2($grand_total)."</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align=\"right\">&nbsp;</td>
  </tr>
  <tr>
    <td>Bayar</td>
    <td>:</td>
    <td align=\"right\">".$global->num_format2($grand_total)."</td>
  </tr>
</table>
</div>
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