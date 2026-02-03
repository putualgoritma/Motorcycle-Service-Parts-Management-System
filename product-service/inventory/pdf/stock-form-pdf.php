<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/stock-form-pdf-inc.php"); ?>
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
    <td align=\"center\"><span style=\"color: #F00\"><strong>FORM STOK OPNAME</strong></span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$warehouse_stock_register_start." sd ".$warehouse_stock_register."</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\" class=\"garis garis2\">
  <tr>
    <td width=\"16%\" height=\"13\"><strong>Kode</strong></td>
    <td width=\"23%\"><strong>Nama</strong></td>
    <td width=\"15%\"><strong>Rak</strong></td>
    <td width=\"11%\"><strong>Satuan</strong></td>
    <td width=\"12%\"><strong>Stok</strong></td>
    <td width=\"11%\"><strong>Stok Fisik</strong></td>
    <td width=\"12%\"><strong>Selisih</strong></td>
  </tr>
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\" class=\"\">
  ";
		for($i=0;$i<count($product_stock_arr);$i++){
  $html .= "
  <tr>
    <td width=\"16%\" valign=\"top\">".$product_stock_arr[$i]['product_code']."</td>
    <td width=\"23%\" valign=\"top\">".$product_stock_arr[$i]['product_name']."</td>
    <td width=\"15%\" valign=\"top\">".$product_stock_arr[$i]['rack_code']."</td>
    <td width=\"11%\" valign=\"top\">".$product_stock_arr[$i]['unit_code']."</td>
    <td width=\"12%\" valign=\"top\">".$product_stock_arr[$i]['stock_last']."</td>
    <td width=\"11%\" class=\"garis2\" valign=\"top\">&nbsp;</td>
    <td width=\"12%\" class=\"garis2\" valign=\"top\">&nbsp;</td>
  </tr>
  ";
		}
	$html .= "
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width=\"4%\" align=\"center\">&nbsp;</td>
          <td width=\"19%\" align=\"center\">Dihitung Oleh,</td>
          <td width=\"4%\" align=\"center\">&nbsp;</td>
          <td width=\"19%\" align=\"center\">Dicatat Oleh,</td>
          <td width=\"4%\" align=\"center\">&nbsp;</td>
          <td width=\"19%\" align=\"center\">Disetujui Oleh,</td>
          <td width=\"3%\">&nbsp;</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td class=\"garis2\" align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\" class=\"garis2\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\" class=\"garis2\">&nbsp;</td>
          <td>&nbsp;</td>
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