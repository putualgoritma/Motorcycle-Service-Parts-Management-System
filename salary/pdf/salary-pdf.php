<? $path="../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/salary-pdf-inc.php"); ?>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\"><strong>SLIP GAJI KARYAWAN</strong></td>
  </tr>
  <tr>
    <td align=\"center\">Periode: ".$_REQUEST['salary_slip_month']." </td>
  </tr>
</table>

<div class=\"garis2\">&nbsp;</div>
<div>&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tablepadding\">
  <tr>
    <td width=\"21%\"><strong>Nama:</strong></td>
    <td width=\"16%\">".$_REQUEST['staff_code']."</td>
    <td width=\"21%\">".$staff_name."</td>
    <td width=\"42%\">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>No. Slip:</strong></td>
    <td>".$salary_slip_row['salary_slip_id']."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Tgl. Gajian:</strong></td>
    <td>".$salary_slip_date."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Hari Kerja Efektif:</strong></td>
    <td>".$get_efective_work."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Jumlah Kerja:</strong></td>
    <td>".$num_work."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<div class=\"garis2\">&nbsp;</div>
<div>&nbsp;</div>


<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tablepadding\">
  <tr>
    <td width=\"21%\">&nbsp;</td>
    <td width=\"17%\"><strong><u>PENDAPATAN</u></strong></td>
    <td width=\"20%\">&nbsp;</td>
    <td width=\"19%\">&nbsp;</td>
    <td width=\"23%\"><strong><u>POTONGAN</u></strong></td>
  </tr>
  <tr>
    <td><strong>Gaji Pokok:</strong></td>
    <td>".$salary_slip_basic."</td>
    <td>&nbsp;</td>
    <td><strong>Potongan Terlambat:</strong></td>
    <td>".$salary_slip_cut_late."</td>
  </tr>
  <tr>
    <td><strong>T. Jabatan:</strong></td>
    <td>".$salary_slip_position."</td>
    <td>&nbsp;</td>
    <td><strong>Potongan Alfa:</strong></td>
    <td>".$salary_slip_cut_alfa."</td>
  </tr>
  <tr>
    <td><strong>Transport:</strong></td>
    <td>".$salary_slip_transport."</td>
    <td>&nbsp;</td>
    <td><strong>Potongan Cashbon:</strong></td>
    <td>".$salary_slip_cut_cashbon."</td>
  </tr>
  <tr>
    <td><strong>Uang Makan:</strong></td>
    <td>".$salary_slip_food."</td>
    <td>&nbsp;</td>
    <td><strong>Potongan Utang:</strong></td>
    <td>".$salary_slip_cut_payable."</td>
  </tr>
  <tr>
    <td><strong>BPJS:</strong></td>
    <td>".$salary_slip_insurance."</td>
    <td>&nbsp;</td>
    <td><strong>Potongan Asuransi:</strong></td>
    <td>".$salary_slip_cut_insurance."</td>
  </tr>
  <tr>
    <td><strong>Insentif Harian:</strong></td>
    <td>".$salary_slip_insentif_daily."</td>
    <td>&nbsp;</td>
    <td><strong>Potongan Lain 1:</strong></td>
    <td>".$salary_slip_cut_other1."</td>
  </tr>
  <tr>
    <td><strong>Komisi Part & Service:</strong></td>
    <td>".$salary_slip_commission_part_service."</td>
    <td>&nbsp;</td>
    <td><strong>Potongan Lain 2:</strong></td>
    <td>".$salary_slip_cut_other2."</td>
  </tr>
  <tr>
    <td><strong>Insentif UE:</strong></td>
    <td>".$salary_slip_insentif_unit_entry."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Insentif Part:</strong></td>
    <td>".$salary_slip_insentif_product."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Insentif Jasa:</strong></td>
    <td>".$salary_slip_insentif_service."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Bonus Pencapaian:</strong></td>
    <td>".$salary_slip_insentif_bonus."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Insentif Full Kerja:</strong></td>
    <td>".$salary_slip_insentif_no_alfa."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Fee Piket:</strong></td>
    <td>".$salary_slip_fee_picket."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
  
<div class=\"garis2\">&nbsp;</div>
<div>&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tablepadding\">
  <tr>
    <td width=\"21%\"><strong>Total Pendapatan:</strong></td>
    <td width=\"17%\">".$global->num_format2($income_amount)."</td>
    <td width=\"62%\">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Total Potongan:</strong></td>
    <td>".$global->num_format2($cut_amount)."</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Gaji Bersih:</strong></td>
    <td><strong><u>".$global->num_format2($salary_amount)."</u></strong></td>
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