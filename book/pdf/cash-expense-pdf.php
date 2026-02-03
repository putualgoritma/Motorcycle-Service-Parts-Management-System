<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/cash-expense-pdf-all-inc.php"); ?>
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
    <td align=\"center\"><span class=\"textred\">Biaya-Biaya</span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$date_range1." sd ".$date_range2."</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td><strong>Registrasi</strong></td>
    <td><strong>Keterangan</strong></td>
    <td><strong>Kode Rekening</strong></td>
    <td><strong>Nama Rekening</strong></td>
    <td><strong>Debit</strong></td>
    <td><strong>Kredit</strong></td>
  </tr>
  ";
		$amount_debit=0;
	 	$amount_credit=0;
		for($i=0;$i<count($ledger_search_list);$i++){
		$amount_credit+=$ledger_search_list[$i]['ledgerdetails_amount_credit'];
		$amount_debit+=$ledger_search_list[$i]['ledgerdetails_amount_debit'];
		$html .= "
  <tr>
          <td bgcolor=\"#FFFFFF\">".$ledger_search_list[$i]['ledger_register']."</td>
          <td bgcolor=\"#FFFFFF\">".$ledger_search_list[$i]['ledger_code']." - ".$ledger_search_list[$i]['ledger_description']."</td>
          <td bgcolor=\"#FFFFFF\">".$ledger_search_list[$i]['taxonomi_code']."</td>
          <td bgcolor=\"#FFFFFF\">".$ledger_search_list[$i]['taxonomi_name']."</td>
          <td bgcolor=\"#FFFFFF\">".$ledger_search_list[$i]['ledgerdetails_amount_debit']."</td>
		  <td bgcolor=\"#FFFFFF\">".$ledger_search_list[$i]['ledgerdetails_amount_credit']."</td>
        </tr>
  ";
	 }
	$amount_debit=number_format($amount_debit, 2, ',', '.');
	$amount_credit=number_format($amount_credit, 2, ',', '.');
	$html .= "
      <tr>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\"><strong>".$label_amount."</strong></td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-3\"><strong>".$currency.$amount_debit."</strong></span></td>
		  <td bgcolor=\"#FFFFFF\"><span class=\"col-md-3\"><strong>".$currency.$amount_credit."</strong></span></td>
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