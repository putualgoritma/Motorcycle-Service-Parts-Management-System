<? 
session_start();

include ("../../../plugins/MPDF57/mpdf.php");

//get sessi
$var_pdf=$_SESSION['var_pdf_sessi'];
$label_pdf=$_SESSION['label_pdf_sessi'];
$service_orderdetails_list_pdf=$_SESSION['list_pdf_sessi'];
$product_orderdetails_list_pdf=$_SESSION['list_pdf2_sessi'];

//var
$service_order_code=$var_pdf['service_order_code'];
$service_order_register=$var_pdf['service_order_register'];
$users_name=$var_pdf['users_name'];
$users_phone=$var_pdf['users_phone'];
$motorcycle_code=$var_pdf['motorcycle_code'];
$service_order_km_now=$var_pdf['service_order_km_now'];
$service_order_km_next=$var_pdf['service_order_km_next'];
$users_name=$var_pdf['motorcycle_owner_name'];
$motorcycle_frame_no=$var_pdf['motorcycle_frame_no'];
$motorcycle_type_name=$var_pdf['motorcycle_type_name'];
$service_order_kpb_service=$var_pdf['service_order_kpb_service'];
$service_order_kpb_product=$var_pdf['service_order_kpb_product'];
$service_order_amount_format=$var_pdf['service_order_amount'];
$staff_code=$var_pdf['staff_code'];
$service_orderdetails_total_format=$var_pdf['service_orderdetails_total_format'];
$product_orderdetails_total_format=$var_pdf['product_orderdetails_total_format'];
$service_order_payregister=$var_pdf['service_order_payregister'];
$service_order_payregister_hour=$var_pdf['service_order_payregister_hour'];
$service_order_cash=$var_pdf['service_order_cash'];
$service_order_balance=$var_pdf['service_order_balance'];

$gross_total_format=$var_pdf['gross_total_format'];
$disc_total_format=$var_pdf['disc_total_format'];

//label
$label_company_name=$label_pdf['company_name'];
$label_dealer_code=$label_pdf['dealer_code'];
$label_company_address=$label_pdf['company_address'];
$label_company_phone=$label_pdf['company_phone'];
$label_motorcycle_code=$label_pdf['motorcycle_code'];
$label_service_order_code=$label_pdf['service_order_code'];
$label_service_order_queue=$label_pdf['service_order_queue'];
$label_service_order_km_now=$label_pdf['service_order_km_now'];
$label_service_order_km_next=$label_pdf['service_order_km_next'];
$label_motorcycle_owner_name=$label_pdf['motorcycle_owner_name'];
$label_motorcycle_frame_no=$label_pdf['motorcycle_frame_no'];
$label_motorcycle_machine_no=$label_pdf['motorcycle_machine_no'];
$label_motorcycle_type_name=$label_pdf['motorcycle_type_name'];
$label_color_name=$label_pdf['color_name'];
$label_motorcycle_manufacture=$label_pdf['motorcycle_manufacture'];
$label_service_code=$label_pdf['service_code'];
$label_service_name=$label_pdf['service_name'];
$label_service_orderdetails_sprice=$label_pdf['service_orderdetails_sprice'];
$label_service_orderdetails_subtotal=$label_pdf['service_orderdetails_subtotal'];
$label_product_code=$label_pdf['product_code'];
$label_product_name=$label_pdf['product_name'];
$label_product_orderdetails_sprice=$label_pdf['product_orderdetails_sprice'];
$label_product_orderdetails_subtotal=$label_pdf['product_orderdetails_subtotal'];
$label_staff_mechanic=$label_pdf['staff_mechanic'];
$label_service_order_kpb_service=$label_pdf['service_order_kpb_service'];
$label_service_order_kpb_product=$label_pdf['service_order_kpb_product'];
$label_service_order_total=$label_pdf['service_order_total'];

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
        <td width=\"65%\" valign=\"top\"><h3> ".strtoupper($label_company_name)." ".$label_dealer_code."</h3></td>                
      </tr>
	<tr>
      <td>".strtoupper($label_company_address)."</td>       
  </tr>
  <tr>
      <td>Telp: ".strtoupper($label_company_phone)."</td>       
  </tr>
      <tr>
      <td>&nbsp;</td>
      </tr>
</table>
</div>
<div class=\"col-md-33\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"center\"><h3> NOTA SERVICE</h3></td>
  </tr>
</table>
</div>
<div class=\"col-md-33\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"20%\">&nbsp;</td>
		<td width=\"20%\">Nomer</td>
        <td width=\"60%\">: SRV".$service_order_code."</td>            
      </tr>
  <tr>
        <td>&nbsp;</td>
		<td>Tanggal</td>
        <td>: ".$service_order_payregister."&nbsp;&nbsp;&nbsp;".$service_order_payregister_hour."</td>          
  </tr>
</table>
</div>
<div class=\"clear\">&nbsp;</div>

<div class=\"garis2\">&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"9%\">No. Polisi</td>
        <td width=\"19%\">: $motorcycle_code</td>
        <td width=\"12%\">No. Telp/Hp		</td>
        <td width=\"32%\">:	$users_phone</td>
        <td width=\"13%\">Km</td>
        <td width=\"1%\"> : </td>
        <td width=\"14%\" align=\"right\">$service_order_km_now</td>
      </tr>
      <tr>
        <td>Pemilik</td>
        <td>: $users_name</td>
        <td>Type/Warna/Thp	</td>
        <td>: $motorcycle_type_name</td>
        <td>Km Kembali		</td>
        <td>: </td>
        <td align=\"right\">$service_order_km_next</td>
      </tr>
</table>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"6%\">No</td>
        <td width=\"22%\">Kode Jasa</td>
        <td width=\"37%\">Nama Jasa</td>
        <td width=\"7%\">Qty</td>
        <td width=\"13%\">Harga</td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\">Jumlah</td>
      </tr>
</table>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      "; 
	 $inc=1;
	 for($i=0;$i<count($service_orderdetails_list_pdf);$i++){
		$service_code=$service_orderdetails_list_pdf[$i]['service_scode'];
		$service_name=$service_orderdetails_list_pdf[$i]['service_name'];
		$service_orderdetails_quantity=$service_orderdetails_list_pdf[$i]['service_orderdetails_quantity'];
		$service_orderdetails_price=$service_orderdetails_list_pdf[$i]['service_orderdetails_price'];
		$service_orderdetails_subtotal=$service_orderdetails_list_pdf[$i]['service_orderdetails_subtotal'];
	$html .= "
	  <tr>
        <td width=\"6%\">$inc</td>
        <td width=\"22%\">$service_code</td>
        <td width=\"37%\">$service_name</td>
        <td width=\"7%\">$service_orderdetails_quantity</td>
        <td width=\"13%\"> $service_orderdetails_price</td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\">$service_orderdetails_subtotal</td>
  </tr>
  ";
		$inc++;
	}
	$html .= "
    </table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"6%\">&nbsp;</td>
        <td width=\"22%\">&nbsp;</td>
        <td width=\"44%\">&nbsp;</td>
        <td class=\"garis\" width=\"13%\">Jasa</td>
        <td class=garis width=\"1%\">: </td>
        <td class=\"garis\" width=\"14%\" align=\"right\">$service_orderdetails_total_format</td>
      </tr>
    </table>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"6%\">No</td>
        <td width=\"22%\">Kode Part</td>
        <td width=\"37%\">Nama Part</td>
        <td width=\"7%\">Qty</td>
        <td width=\"13%\">Harga</td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\">Jumlah</td>
      </tr>
</table>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      "; 
	 $inc=1;
	 for($i=0;$i<count($product_orderdetails_list_pdf);$i++){
		$product_code=$product_orderdetails_list_pdf[$i]['product_scode'];
		$product_name=$product_orderdetails_list_pdf[$i]['product_name'];
		$product_orderdetails_quantity=$product_orderdetails_list_pdf[$i]['product_orderdetails_quantity'];
		$product_orderdetails_price=$product_orderdetails_list_pdf[$i]['product_orderdetails_price'];
		$product_orderdetails_subtotal=$product_orderdetails_list_pdf[$i]['product_orderdetails_subtotal'];
	$html .= "
	  <tr>
        <td width=\"6%\">$inc</td>
        <td width=\"22%\">$product_code</td>
        <td width=\"37%\">$product_name</td>
        <td width=\"7%\">$product_orderdetails_quantity</td>
        <td width=\"13%\"> $product_orderdetails_price</td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\">$product_orderdetails_subtotal</td>
  </tr>
  ";
		$inc++;
	}
	$html .= "
</table>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"6%\">&nbsp;</td>
        <td width=\"22%\">&nbsp;</td>
        <td width=\"44%\">&nbsp;</td>
        <td class=\"garis\" width=\"13%\">Part</td>
        <td class=\"garis\" width=\"1%\">: </td>
        <td class=\"garis\" width=\"14%\" align=\"right\">$product_orderdetails_total_format</td>
      </tr>
</table>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td width=\"9%\">Mekanik</td>
          <td width=\"19%\">: $staff_code</td>
          <td width=\"12%\">No. PKB</td>
          <td width=\"60%\">: PKB$service_order_code</td>
        </tr>
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
          <td width=\"19%\" align=\"center\">Pemilik/Pembawa,</td>
          <td width=\"4%\" align=\"center\">&nbsp;</td>
          <td width=\"19%\" align=\"center\">Hormat Kami,</td>
          <td width=\"3%\">&nbsp;</td>
          <td width=\"13%\">Total Bruto</td>
          <td width=\"1%\">:</td>
          <td width=\"14%\" align=\"right\">$gross_total_format</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
          <td>Total Discount</td>
          <td>:</td>
          <td align=\"right\">$disc_total_format</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
          <td>Total Bayar</td>
          <td>:</td>
          <td align=\"right\">$service_order_amount_format</td>
        </tr>
		<tr>
          <td align=\"center\">&nbsp;</td>
          <td class=\"garis2\" align=\"center\">Administator</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\" class=\"garis2\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\" class=\"garis2\">&nbsp;</td>
          <td>&nbsp;</td>
          <td>Total Bayar</td>
          <td>:</td>
          <td align=\"right\">$service_order_amount_format</td>
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