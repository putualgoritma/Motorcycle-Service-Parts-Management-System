<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/product-stock-pdf-inc.php"); ?>
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
    <td align=\"center\"><span style=\"color: #F00\"><strong>DAFTAR NILAI STOK</strong></span></td>
  </tr>
  <tr>
    <td align=\"center\"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\" class=\"garis garis2\">
  <tr>
	<td width=\"13%\" height=\"13\"><strong>Kode</strong></td>
    <td width=\"20%\"><strong>Nama</strong></td>
    <td width=\"7%\"><strong>Satuan</strong></td>
    <td width=\"7%\"><strong>Harga Beli</strong></td>
    <td width=\"7%\"><strong>Harga Jual</strong></td>
    <td width=\"5%\"><strong>Stok</strong></td>
    <td width=\"20%\"><strong>Nilai Stok (Harga Beli)</strong></td>
    <td width=\"20%\"><strong>Nilai Stok (Harga Jual)</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\" class=\"\">
  ";
$stock_amount_buy=0;
$stock_amount_sale=0;		
  for($i=0;$i<count($product_search_list);$i++){
			$stock_in=$product_search_list[$i]['amount_in']+$product_search_list[$i]['amount_trs_in'];
			$stock_out=$product_search_list[$i]['amount_out']+$product_search_list[$i]['amount_trs_out'];
            $stock_amount_buy+=$product_search_list[$i]['product_bprice']*$product_search_list[$i]['product_stock'];
                $stock_amount_sale+=$product_search_list[$i]['product_sprice']*$product_search_list[$i]['product_stock'];
  $html .= "
  <tr>
	<td width=\"13%\" height=\"13\" valign=\"top\">".$product_search_list[$i]['product_code']."</td>
    <td width=\"20%\" valign=\"top\">".$product_search_list[$i]['product_name']."</td>
    <td width=\"7%\" valign=\"top\">".$product_search_list[$i]['unit_code']."</td>
    <td width=\"7%\" valign=\"top\">".$global->num_format2($product_search_list[$i]['product_bprice'])."</td>
    <td width=\"7%\" valign=\"top\">".$global->num_format2($product_search_list[$i]['product_sprice'])."</td>
    <td width=\"5%\" valign=\"top\">".$product_search_list[$i]['product_stock']."</td>
    <td width=\"20%\" valign=\"top\">".$global->num_format2($product_search_list[$i]['product_stock']*$product_search_list[$i]['product_bprice'])."</td>
    <td width=\"20%\" valign=\"top\">".$global->num_format2($product_search_list[$i]['product_stock']*$product_search_list[$i]['product_sprice'])."</td>
 
  </tr>
  ";
		}
        $html .= "
  <tr>
	<td width=\"13%\" height=\"13\" valign=\"top\">&nbsp;</td>
    <td width=\"20%\" valign=\"top\">&nbsp;</td>
    <td width=\"7%\" valign=\"top\">&nbsp;</td>
    <td width=\"7%\" valign=\"top\">&nbsp;</td>
    <td width=\"7%\" valign=\"top\">&nbsp;</td>
    <td width=\"5%\" valign=\"top\"><strong>Total:</strong></td>
    <td width=\"20%\" valign=\"top\"><strong>".$global->num_format2($stock_amount_buy)."</strong></td>
    <td width=\"20%\" valign=\"top\"><strong>".$global->num_format2($stock_amount_sale)."</strong></td>
 
  </tr>
  ";
	$html .= "
</table>
</body>
</html>
";

//echo $html;
//*
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
//*/

?>