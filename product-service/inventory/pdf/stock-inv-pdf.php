<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/stock-inv-pdf-inc.php"); ?>
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
.right {
    float: right;
}

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

p{ margin: 0; padding: 0;}
.col-md-33 {
    width: 33%;
	float: left; 
	margin-bottom: 0pt;
}
</style>
</head>

<body>
<div class=\"col-md-33\">
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
<div class=\"col-md-33\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"center\"><h3> ".$warehouse_stock_type_txt."</h3></td>
  </tr>
</table>
</div>
<div class=\"col-md-33\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"20%\">&nbsp;</td>
		<td width=\"20%\">Nomer</td>
        <td width=\"60%\">: ".str_replace("PKB", "SRV", $warehouse_stock_row['warehouse_stock_code'])."</td>            
      </tr>
  <tr>
        <td>&nbsp;</td>
		<td>Tanggal</td>
        <td>: ".$warehouse_stock_row['warehouse_stock_register']."&nbsp;&nbsp;&nbsp;</td>          
  </tr>
</table>
</div>
<div class=\"clear\">&nbsp;</div>

<div class=\"garis2\">&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td>Gudang : ".$warehouse_stock_row['warehouse_name']."</td>
      </tr>
</table>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"6%\">No</td>
        <td width=\"22%\">Kode Part</td>
        <td width=\"37%\">Nama Part</td>
        <td width=\"7%\">Qty</td>
        <td width=\"13%\">Harga Pokok</td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\">Jumlah</td>
      </tr>
</table>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      "; 
	 $inc=1;
	 for($i=0;$i<count($warehouse_stock_details_row['select_data']);$i++){
		$warehouse_stock_details_subtotal=$warehouse_stock_details_row['select_data'][$i]['warehouse_stock_details_quantity']*$warehouse_stock_details_row['select_data'][$i]['product_bprice'];
	$html .= "
	  <tr>
        <td width=\"6%\">".$inc."</td>
        <td width=\"22%\">".$warehouse_stock_details_row['select_data'][$i]['product_code']."</td>
        <td width=\"37%\">".$warehouse_stock_details_row['select_data'][$i]['product_name']."</td>
        <td width=\"7%\">".$warehouse_stock_details_row['select_data'][$i]['warehouse_stock_details_quantity']."</td>
        <td width=\"13%\">".$global->num_format2($warehouse_stock_details_row['select_data'][$i]['product_bprice'])."</td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\">".$global->num_format2($warehouse_stock_details_subtotal)."</td>
  </tr>
  ";
		$inc++;
	}
	$html .= "
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td>&nbsp;</td>
        </tr>
    </table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td width=\"4%\" align=\"center\">&nbsp;</td>
          <td width=\"19%\" align=\"center\">Disiapkan Oleh,</td>
          <td width=\"4%\" align=\"center\">&nbsp;</td>
          <td width=\"19%\" align=\"center\">Diterima Oleh,</td>
          <td width=\"4%\" align=\"center\">&nbsp;</td>
          <td width=\"19%\" align=\"center\">Disetujui Oleh,</td>
          <td width=\"3%\">&nbsp;</td>
          <td width=\"13%\">&nbsp;</td>
          <td width=\"1%\">&nbsp;</td>
          <td width=\"14%\" align=\"right\">$disc_total_format</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align=\"right\">&nbsp;</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align=\"right\">&nbsp;</td>
        </tr>
		<tr>
          <td align=\"center\">&nbsp;</td>
          <td class=\"garis2\" align=\"center\">Administator</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\" class=\"garis2\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\" class=\"garis2\">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align=\"right\">&nbsp;</td>
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