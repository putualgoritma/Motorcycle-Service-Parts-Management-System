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
    <td align=\"center\"><strong>SLIP GAJI KARYAWAN (SERVICE)</strong></td>
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
    <td width=\"20%\">&nbsp;</td>
    <td width=\"40%\"><strong><u>Pendapatan Service Harian</u></strong></td>
    <td width=\"40%\"><strong><u></u></strong></td>
  </tr>
  ";
$month = date('m');
$year = date('Y');
if(isset($_REQUEST['salary_slip_month'])){
[$month, $year] = explode('/', $_REQUEST['salary_slip_month']);
}
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$salary_slip_month=$_REQUEST['salary_slip_month'];
$staff_code=$_REQUEST['staff_code'];
for ($day = 1; $day <= $daysInMonth; $day++): 
$day_formatted = str_pad($day, 2, '0', STR_PAD_LEFT);
$start_date=$global->date_strtonum($day_formatted."/".$salary_slip_month);
$end_date=$global->date_strtonum($day_formatted."/".$salary_slip_month);
$staff_pit_status=$global->db_fldrow("staff","staff_pit_status","staff_code='".$staff_code."'");
if($staff_pit_status=="pit"){
  $product_fee=$global->salary->get_product_fee($staff_code,$start_date,$end_date);
  $service_fee=$global->salary->get_service_fee($staff_code,$start_date,$end_date);
  }else{
  $product_fee=$global->salary->get_product_fee_nonpit($staff_code,$start_date,$end_date);
  $service_fee=$global->salary->get_service_fee_nonpit($staff_code,$start_date,$end_date);
  }
$html .= "
  <tr>
    <td width=\"20%\">Pendapatan Tgl. ".$day_formatted." :</td>
    <td width=\"40%\">".$global->num_format2($service_fee)."</td>
    <td width=\"40%\"></td>
  </tr>
  ";
  endfor;
  $html .= "
  </table>
<div class=\"garis2\">&nbsp;</div>
<div>&nbsp;</div>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tablepadding\">
  <tr>
    <td width=\"20%\">&nbsp;</td>
    <td width=\"40%\"><strong><u>REKAP PENDAPATAN</u></strong></td>
    <td width=\"20%\">&nbsp;</td>
    <td width=\"20%\"><strong><u>REKAP POTONGAN</u></strong></td>
  </tr>  
  ";
  $html .= "
  <tr>
    <td><strong>Pendapatan Service:</strong></td>
    <td>Rp. ".$global->num_format2($salary_slip_commission_service)."</td>
    <td><strong></strong></td>
    <td></td>
  </tr>  
  ";
    $income_total = $salary_slip_commission_service;
    $grand_total = $income_total - $cut_amount;
  $html .= "
  </table>
  
<div class=\"garis2\">&nbsp;</div>
<div>&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tablepadding\">
  <tr>
    <td width=\"20%\"><strong>Total Pendapatan:</strong></td>
    <td width=\"40%\">Rp. ".$global->num_format2($income_total)."</td>
    <td width=\"40%\">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Total Potongan:</strong></td>
    <td>Rp. ".$global->num_format2($cut_amount)."</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Gaji Bersih:</strong></td>
    <td><strong><u><strong>Rp. ".$global->num_format2($grand_total)."</strong></u></strong></td>
    <td>&nbsp;</td>
  </tr>
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