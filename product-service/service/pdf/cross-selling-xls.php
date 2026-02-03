<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/cross-selling-pdf-inc.php"); ?>
<? require_once $path.'vendor/autoload.php'; ?>
<? 
$html = "
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
    <td align=\"center\"><span class=\"textred\">DATA CROSS SELLING</span></td>
  </tr>
  <tr>
    <td align=\"center\">Periode : ".$service_order_register_start." sd ".$service_order_register."</td>
  </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td><strong>Tanggal</strong></td>
    <td><strong>No. Pol</strong></td>
    <td><strong>Type</strong></td>
    <td><strong>CC</strong></td>
    <td><strong>Warna</strong></td>
    <td><strong>No. Ran</strong></td>
    <td><strong>No. Me</strong></td>
    <td><strong>Thn Rkt</strong></td>
    <td><strong>Nama</strong></td>
    <td><strong>Alamat</strong></td>
    <td><strong>Kel.</strong></td>
    <td><strong>Kec.</strong></td>
    <td><strong>Kota</strong></td>
    <td><strong>No. Tlf</strong></td>
    <td><strong>No. HP</strong></td>
    <td><strong>J. Ser</strong></td>
    <td><strong>No. Dealer</strong></td>
    <td><strong>Alasan Ser</strong></td>
    <td><strong>Hubungan</strong></td>
  </tr>
  ";
		for($i=0;$i<count($service_orderdetails_onservice_row['select_data']);$i++){
		$html .= "
  <tr>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['service_order_register']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_code']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_type_name']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_type_cc']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['color_code']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_frame_no']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_machine_no']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_manufacture']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['users_name']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['users_address']."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['users_phone']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['category_code']."</td>
    <td>".$company['dealer_code']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['service_order_reason']."</td>
    <td>".$service_orderdetails_onservice_row['select_data'][$i]['service_order_usersowner_rel']."</td>
  </tr>
  ";
	}
	$html .= "
</table>
";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=cross-selling.xls");

echo $html;
?>