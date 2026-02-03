<? 
session_start();

require_once '../../vendor/autoload.php';

//get sessi
$var_pdf=$_SESSION['var_pdf_sessi'];
$label_pdf=$_SESSION['label_pdf_sessi'];
$ledgerdetails_list=$_SESSION['list_pdf_sessi'];

//var
$month=$var_pdf['month'];
$year=$var_pdf['year'];
$ledger_description=$var_pdf['ledger_description'];
$ledger_code=$var_pdf['ledger_code'];
$ledger_register=$var_pdf['ledger_register'];

//label
$app_name=$label_pdf['app_name'];
$company_name=$label_pdf['company_name'];
$company_address=$label_pdf['company_address'];
$company_phone=$label_pdf['company_phone'];
$company_license=$label_pdf['company_license'];
$period=$label_pdf['period'];

$label_ledger_register=$label_pdf['label_ledger_register'];
$label_ledger_code=$label_pdf['label_ledger_code'];
$label_ledger_description=$label_pdf['label_ledger_description'];
$label_taxonomi_name=$label_pdf['label_taxonomi_name'];
$label_taxonomi_code=$label_pdf['label_taxonomi_code'];
$label_amount=$label_pdf['label_amount'];

$html = "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>Untitled Document</title>

<style>
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
.alamat{
	margin-top: 20px;
	margin-bottom: 10px;
}
.garis{
	border-top: double #333;
}
.garis2{
	border-bottom: 1px dashed #333;
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
</style>
</head>

<body>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
	<td align=\"center\">
<div class=\"text-center\"><h1>$company_name</h1></div>
<div class=\"text-center\"><h3>$company_address</h3></div>
<div class=\"text-center\">No. Telp/HP : $company_phone</div>
</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<div class=\"garis\">&nbsp;</div>
<div>&nbsp;</div>
<h2 class=\"text-center\">BUKTI KAS MASUK</h2>
<div>&nbsp;</div>
<div><strong>No. BKM$ledger_code</strong></div>

<div class=\"clear\"><table width=\"100%\" border=\"0\" class=\"gridtable\">
        <thead>
		<tr>
          <th width=\"9%\" bgcolor=\"#FFFFFF\"><strong>$label_ledger_register</strong></th>
          <th width=\"9%\" bgcolor=\"#FFFFFF\"><strong>$label_taxonomi_code</strong></th>
          <th width=\"35%\" bgcolor=\"#FFFFFF\"><strong>$label_taxonomi_name</strong></th>
          <th width=\"39%\" bgcolor=\"#FFFFFF\"><strong>$label_ledger_description</strong></th>
          <th width=\"17%\" bgcolor=\"#FFFFFF\"><strong>$label_amount</strong></th>
        </tr>
		</thead>
        <tr>
          <td bgcolor=\"#FFFFFF\">$ledger_register</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\">$ledger_description</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
        </tr>
        "; 
	 $inc=1;
	 $amount_debit=0;
	 for($i=0;$i<count($ledgerdetails_list);$i++){
		$taxonomi_name=$ledgerdetails_list[$i]['taxonomi_name'];
		$taxonomi_code=$ledgerdetails_list[$i]['taxonomi_code'];
		$ledgerdetails_amount=$ledgerdetails_list[$i]['ledgerdetails_amount'];
		$ledgerdetails_type=$ledgerdetails_list[$i]['ledgerdetails_type'];
		if($ledgerdetails_type=="D"){
			$amount_debit=$ledgerdetails_amount;
			}
		if($ledgerdetails_type=="K"){
	$html .= "
		<tr>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-2\">$taxonomi_code</span></td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-6\">$taxonomi_name</span></td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-3\">$ledgerdetails_amount</span></td>
          </tr>
		";
		}
		$inc++;
	}
	$html .= "
        <tr>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\"><strong>$label_amount</strong></td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-3\"><strong>$amount_debit</strong></span></td>
        </tr>
      </table>
</div>

<div>&nbsp;</div>

<div>&nbsp;</div>

<div>&nbsp;</div>
<div>&nbsp;</div>



<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td width=\"33%\" align=\"center\">Mengetahui,</td>
      <td width=\"34%\" align=\"center\">Kasir,</td>
      <td width=\"33%\" align=\"center\">Penyetor,</td>
    </tr>
  </table>
<div>&nbsp;</div>

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