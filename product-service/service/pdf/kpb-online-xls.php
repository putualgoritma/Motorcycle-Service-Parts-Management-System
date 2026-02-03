<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/kpb-online-pdf-inc.php"); ?>
<? 
$html = "
<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"tableborder2\">
  <tr>
    <td width=\"5%\"><strong>No.</strong></td>
    <td width=\"12%\"><strong>Kode Dealer</strong></td>
    <td width=\"12%\"><strong>Kode AHASS</strong></td>
    <td width=\"17%\"><strong>No. Mesin</strong></td>
    <td width=\"10%\"><strong>No. Buku</strong></td>
    <td width=\"12%\"><strong>Tgl. Beli</strong></td>
    <td width=\"10%\"><strong>KPB</strong></td>
    <td width=\"10%\"><strong>Km</strong></td>
    <td width=\"12%\"><strong>Tgl. Service</strong></td>
  </tr>
  ";
		//service_orderdetails_onservice_row
		$j=1;
		for($i=0;$i<count($service_order_row['select_data']);$i++){
		$html .= "
  <tr>
    <td>".$j."</td>
    <td>".$company['main_dealer_code']."</td>
    <td>".$company['dealer_code']."</td>
    <td>".$service_order_row['select_data'][$i]['motorcycle_machine_no']."</td>
    <td>".$service_order_row['select_data'][$i]['motorcycle_book_service_no']."</td>
    <td>".$global->date_to_usform($service_order_row['select_data'][$i]['motorcycle_buy_register'])."</td>
    <td>".substr($service_order_row['select_data'][$i]['category_code'], 3)."</td>
	<td>".$service_order_row['select_data'][$i]['service_order_km_now']."</td>
	<td>".$global->date_to_usform($service_order_row['select_data'][$i]['service_order_register'])."</td>
  </tr>
  ";
		$j++;}
		$html .= "
  
</table>
";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=kpb-online.xls");

echo $html;

?>