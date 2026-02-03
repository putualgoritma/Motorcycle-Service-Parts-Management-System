<? 
session_start();

require_once '../../vendor/autoload.php';

//get sessi
$var_pdf=$_SESSION['var_pdf_sessi'];
$label_pdf=$_SESSION['label_pdf_sessi'];
$ledger_search_list=$_SESSION['list_pdf_sessi'];
$ledgerdetails_list=$_SESSION['list_pdf_sessi2'];

//var
$month=$var_pdf['month'];
$year=$var_pdf['year'];
$currency=$var_pdf['currency'];
$date_range1_value=$var_pdf['date_range1_value'];
$date_range2_value=$var_pdf['date_range2_value'];

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
$label_ledger_type=$label_pdf['label_ledger_type'];
$label_credit_ledger=$label_pdf['label_credit_ledger'];

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
table.gridtable td.line {
	border-top-width: 1px;
	padding: 0px;
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
    <td align=\"right\"><img src=\"../../templates/default/img/logo_koperasi.jpg\" width=\"100\" height=\"96\"></td>
	<td align=\"center\">
<div class=\"text-center\"><h1>$company_name</h1></div>
<div class=\"text-center\"><h2>$company_license</h2></div>
<div class=\"text-center\"><h3>$company_address</h3></div>
<div class=\"text-center\">No. Telp/HP : $company_phone</div>
</td>
    <td><img src=\"../../templates/default/img/logo_mjs.jpg\" width=\"100\" height=\"100\"></td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<div class=\"garis\">&nbsp;</div>
<div>&nbsp;</div>
<h2 class=\"text-center\">HISTORY JURNAL</h2>
<h3 class=\"text-center\">Periode: $date_range1_value - $date_range2_value</h3>
<div>&nbsp;</div>

<div class=\"clear\"><table width=\"100%\" border=\"0\" class=\"gridtable\">
        <thead>
		<tr>
          <th width=\"7%\" bgcolor=\"#FFFFFF\"><strong>$label_ledger_register</strong></th>
          <th width=\"7%\" bgcolor=\"#FFFFFF\"><strong>$label_taxonomi_code</strong></th>
          <th width=\"27%\" bgcolor=\"#FFFFFF\"><strong>$label_taxonomi_name</strong></th>
          <th width=\"33%\" bgcolor=\"#FFFFFF\"><strong>$label_ledger_description</strong></th>
          <th width=\"13%\" bgcolor=\"#FFFFFF\"><strong>$label_ledger_type</strong></th>
		  <th width=\"13%\" bgcolor=\"#FFFFFF\"><strong>$label_credit_ledger</strong></th>
        </tr>
		</thead>
		";
		$amount_debit=0;
	 $amount_credit=0;
	 for($i=0;$i<count($ledger_search_list);$i++){
		 $ledger_register=$ledger_search_list[$i]['ledger_register'];
		 $ledger_description=$ledger_search_list[$i]['ledger_description'];
		 $html .= "
        <tr>
          <td bgcolor=\"#FFFFFF\">$ledger_register</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\">$ledger_description</td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
		  <td bgcolor=\"#FFFFFF\">&nbsp;</td>
        </tr>
        "; 
	 $inc=1;
	 for($j=0;$j<count($ledgerdetails_list[$i]);$j++){
		$taxonomi_name=$ledgerdetails_list[$i][$j]['taxonomi_name'];
		$taxonomi_code=$ledgerdetails_list[$i][$j]['taxonomi_code'];
		$ledgerdetails_amount=$ledgerdetails_list[$i][$j]['ledgerdetails_amount'];
		$ledgerdetails_amount_org=$ledgerdetails_list[$i][$j]['ledgerdetails_amount_org'];
		$ledgerdetails_type=$ledgerdetails_list[$i][$j]['ledgerdetails_type'];
		if($ledgerdetails_type=="D"){
			$amount_debit+=$ledgerdetails_amount_org;
			$ledgerdetails_amount_debit=$ledgerdetails_amount;
			$ledgerdetails_amount_credit="-";
			}else{
			$amount_credit+=$ledgerdetails_amount_org;
			$ledgerdetails_amount_debit="-";
			$ledgerdetails_amount_credit=$ledgerdetails_amount;
			}
	$html .= "
		<tr>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-2\">$taxonomi_code</span></td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-6\">$taxonomi_name</span></td>
          <td bgcolor=\"#FFFFFF\">&nbsp;</td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-3\">$ledgerdetails_amount_debit</span></td>
		  <td bgcolor=\"#FFFFFF\"><span class=\"col-md-3\">$ledgerdetails_amount_credit</span></td>
          </tr>
		";
		$inc++;
	}
	$html .= "
	<tr>
          <td class=\"line\">&nbsp;</td>
          <td class=\"line\">&nbsp;</td>
          <td class=\"line\">&nbsp;</td>
          <td class=\"line\">&nbsp;</td>
          <td class=\"line\">&nbsp;</td>
          <td class=\"line\">&nbsp;</td>
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
          <td bgcolor=\"#FFFFFF\"><strong>$label_amount</strong></td>
          <td bgcolor=\"#FFFFFF\"><span class=\"col-md-3\"><strong>$currency$amount_debit</strong></span></td>
		  <td bgcolor=\"#FFFFFF\"><span class=\"col-md-3\"><strong>$currency$amount_credit</strong></span></td>
        </tr>
	  </table>
</div>
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