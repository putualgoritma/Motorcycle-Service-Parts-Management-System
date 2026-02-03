<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/service-inv-report-inc.php"); ?>
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
	font-size:30px;
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
.col-md-5 {
    width: 49%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-2 {
    width: 1%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-33 {
    width: 33%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-40 {
    width: 40%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-20 {
    width: 20%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-80 {
	width: 80%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-50 {
	width: 50%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-50r {
	width: 50%;
	float: right; 
	margin-bottom: 0pt;
}
.line3 {background-image:url(line.png); background-position:top; background-repeat: repeat-x; margin-top: 10px;}
.line2 {background-image:url(line.png); background-position:bottom; background-repeat: repeat-x; padding-bottom: 10px;}
.tableborder{ border: 1px solid #333; border-collapse:collapse;}
.borderbottom{ border-bottom: 1px solid #333;}
</style>
</head>

<body>
<div class=\"col-md-50\">
<div class=\"col-md-20\"><img src=\"".$path."templates/default/img/honda-logo.png\" width=\"150\" height=\"96\"></div>
<div class=\"col-md-80\">
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
</div>
<div class=\"col-md-50r\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"right\"><h3> PERINTAH KERJA BENGKEL</h3></td>
  </tr>
</table>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	  <tr>
		<td align=\"right\">Nomor : ".$service_order_row['service_order_code']."</td>
      </tr>
  <tr>
		<td align=\"right\">Tanggal : ".$service_order_row['service_order_register']."&nbsp;&nbsp;&nbsp;".$check_in_h."</td>
  </tr>
</table>
</div>
<div class=\"clear garis2\">&nbsp;</div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"9%\">No. Polisi</td>
        <td width=\"19%\">: ".$motorcycle_row['motorcycle_code']."</td>
        <td width=\"22%\">No. Telp/Hp		</td>
        <td width=\"37%\">:		".$users_row['users_phone']."</td>
        <td width=\"6%\">Km</td>
        <td width=\"1%\"> : </td>
        <td width=\"6%\" align=\"right\">".$service_order_row['service_order_km_now']."</td>
      </tr>
      <tr>
        <td>Pemilik</td>
        <td>: ".$users_row['users_name']."</td>
        <td>No Rangka/Mesin</td>
        <td>: ".$motorcycle_row['motorcycle_frame_no']."/".$motorcycle_row['motorcycle_machine_no']."</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align=\"right\">&nbsp;</td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>: ".$users_row['users_address']."</td>
        <td>Type/Warna/Thp </td>
        <td>: ".$motorcycle_type_name."</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align=\"right\">&nbsp;</td>
      </tr>
      <tr>
        <td>Keluhan</td>
        <td>: ".$service_order_row['service_order_description']."</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>No. Antri</td>
        <td>:</td>
        <td align=\"right\"><h2>".$service_order_row['service_order_queue']."</h2></td>
      </tr>
</table>

<div class=\"col-md-5\">
<div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class=\"tableborder\">
      <tr>
        <td width=\"10%\" class=\"borderbottom\"><strong>No</strong></td>
        <td width=\"65%\" class=\"borderbottom\"><strong>Nama Jasa</strong></td>
        <td width=\"25%\" class=\"borderbottom\"><strong>Waktu</strong></td>
      </tr>
	  "; 
	 //list service
	$service_orderdetails_discount_val_tot=0;
	$service_orderdetails_list=$global->tbl_list("service_orderdetails","*","service_order_id='".$service_order_row['service_order_id']."'","",1);
	$service_orderdetails_total=0;
	$service_time_est_day=0;
	$service_time_est_hour=0;
	$service_time_est_mnt=0;
	for($i=0;$i<count($service_orderdetails_list);$i++){
	$inc=$i+1;
	//if kpb
	$kpb_yesno=$service_orderdetails_list[$i]['kpb_yesno'];
	if($kpb_yesno==1){
	$service_orderdetails_list[$i]['service_orderdetails_price']=0;
	}
	//get bcode
	$service_row=$global->product_order->db_row("service","*","service_code='".$service_orderdetails_list[$i]['service_code']."'");
	//get sub total
	$service_orderdetails_price_adisc2=$service_orderdetails_list[$i]['service_orderdetails_price']*(1-(($service_orderdetails_list[$i]['service_orderdetails_discount']+$service_orderdetails_list[$i]['service_orderdetails_disc_final'])/100)+(($service_orderdetails_list[$i]['service_orderdetails_discount']*$service_orderdetails_list[$i]['service_orderdetails_disc_final'])/10000));
	$service_orderdetails_subtotal=$service_orderdetails_price_adisc2*$service_orderdetails_list[$i]['service_orderdetails_quantity'];
	$service_orderdetails_price_format=$global->num_format2($service_orderdetails_list[$i]['service_orderdetails_price']);
	$service_orderdetails_subtotal_format=$global->num_format2($service_orderdetails_subtotal);
	$service_orderdetails_total +=$service_orderdetails_subtotal;
	//list pdf
	$service_scode=$service_row['service_code'];
	$service_name=$service_row['service_name'];
	$service_orderdetails_quantity=$service_orderdetails_list[$i]['service_orderdetails_quantity'];
	$service_orderdetails_price=$service_orderdetails_price_format;
	$service_orderdetails_subtotal=$service_orderdetails_subtotal_format;
	//estimate time
	//if hari
	if($service_row['service_time_type']=="HARI"){
		$service_time_est_day +=$service_row['service_time_est'];
		}
	//if jam
	if($service_row['service_time_type']=="JAM"){
		$service_time_est_hour +=$service_row['service_time_est'];
		}
	//if mnt
	if($service_row['service_time_type']=="MENIT"){
		$service_time_est_mnt +=$service_row['service_time_est'];
		}
	//time type format
	$service_time_type=ucfirst(strtolower($service_row['service_time_type']));
	$html .= "
      <tr>
        <td>".$inc."</td>
        <td>".$service_name."</td>
        <td>".$service_row['service_time_est']." ".$service_time_type."</td>
      </tr>
	 ";
	}
	$service_orderdetails_total_format=$global->num_format2($service_orderdetails_total);
	//estimate time total
	$service_time_est_tot ="";
	if($service_time_est_day>0){
		$service_time_est_tot .=$service_time_est_day."hari&nbsp;";
		}
	if($service_time_est_hour>0){
		$service_time_est_tot .=$service_time_est_hour."jam&nbsp;";
		}
	if($service_time_est_mnt>0){
		$service_time_est_tot .=$service_time_est_mnt."menit";
		}
	$html .= "
    </table>
</div>
<div class=\"tiny_space\"></div>
<div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class=\"tableborder\">
    <tr>
    <td colspan=\"2\" class=\"borderbottom\">Tambahan Jasa</td>
    <td width=\"25%\" class=\"borderbottom\">Waktu</td>
  </tr>
  <tr>
    <td width=\"10%\">&nbsp;</td>
    <td width=\"65%\">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>    
</div>

<div class=\"col-md-2\">&nbsp;</div>

<div class=\"col-md-5\">
<div class=\"clear\">&nbsp;</div>
<div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class=\"tableborder\">
      <tr>
        <td width=\"10%\" class=\"borderbottom\"><strong>No</strong></td>
        <td width=\"61%\" class=\"borderbottom\"><strong>Nama Part</strong></td>
        <td width=\"8%\" class=\"borderbottom\"><strong>Qty</strong></td>
        <td width=\"21%\" class=\"borderbottom\"><strong>Satuan</strong></td>
      </tr>
	  	";
		$product_orderdetails_discount_val_tot=0;
		$product_orderdetails_list=$global->tbl_list("product_orderdetails","*","service_order_id='".$service_order_row['service_order_id']."'","",1);
		$product_orderdetails_total=0;
		for($i=0;$i<count($product_orderdetails_list);$i++){
		$inc=$i+1;
		//if kpb
		$kpb_yesno=$product_orderdetails_list[$i]['kpb_yesno'];
		if($kpb_yesno==1){
		$product_orderdetails_list[$i]['product_orderdetails_price']=0;
		}
		//get bcode
		$product_row=$global->db_row_join("product,unit","product.*,unit.unit_name","product_code='".$product_orderdetails_list[$i]['product_code']."' AND product.unit_code=unit.unit_code");
		//get sub total
		$product_orderdetails_price_adisc2=$product_orderdetails_list[$i]['product_orderdetails_price']*(1-(($product_orderdetails_list[$i]['product_orderdetails_discount']+$product_orderdetails_list[$i]['product_orderdetails_disc_final'])/100)+(($product_orderdetails_list[$i]['product_orderdetails_discount']*$product_orderdetails_list[$i]['product_orderdetails_disc_final'])/10000));
		$product_orderdetails_subtotal=$product_orderdetails_price_adisc2*$product_orderdetails_list[$i]['product_orderdetails_quantity'];
		$product_orderdetails_price_format=$global->num_format2($product_orderdetails_list[$i]['product_orderdetails_price']);
		$product_orderdetails_subtotal_format=$global->num_format2($product_orderdetails_subtotal);
		$product_orderdetails_total +=$product_orderdetails_subtotal;
		//list pdf
		$product_scode=$product_row['product_code'];
		$product_name=$product_row['product_name'];
		$product_orderdetails_quantity=$product_orderdetails_list[$i]['product_orderdetails_quantity'];
		$product_orderdetails_price=$product_orderdetails_price_format;
		$product_orderdetails_subtotal=$product_orderdetails_subtotal_format;
		$html .= "
      <tr>
        <td>".$inc."</td>
        <td>".$product_name."</td>
        <td>".$product_orderdetails_quantity."</td>
        <td>".$product_row['unit_name']."</td>
      </tr>
	  ";
	}
	$product_orderdetails_total_format=$global->num_format2($product_orderdetails_total);
	$html .= "
    </table>
</div>
<div class=\"tiny_space\"></div>
<div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class=\"tableborder\">
      <tr>
        <td colspan=\"2\" class=\"borderbottom\">Tambahan Part</td>
        <td width=\"8%\" class=\"borderbottom\">Qty</td>
        <td width=\"21%\" class=\"borderbottom\">Satuan</td>
    </tr>
      <tr>
        <td width=\"10%\">&nbsp;</td>
        <td width=\"61%\">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  </table>
</div>
</div>
<div class=\"clear tiny_space\"></div>
<div class=\"clear\">&nbsp;</div>

<div class=\"col-md-5\">
<div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"17%\">Mekanik</td>
    <td width=\"3%\">:</td>
    <td width=\"80%\">".$staff_code."</td>
  </tr>
  <tr>
    <td>Catatan</td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
</table></div>
<div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td>SYARAT DAN KETENTUAN:</td>
      </tr>
      <tr>
        <td>- PKB ini merupakan SURAT KUASA dari Pelanggan kepada BENGKEL<br />
        a. mengerjakan pekerjaan seperti apa tertulis pada PKB ini<br />
b. Ijin mencoba kendaraan di luar BENGKEL<br />
Distribusi : Asli => Frontdesk, Copy => Pelanggan</td>
      </tr>
    </table></div>
</div>
<div class=\"col-md-2\">&nbsp;</div>
<div class=\"col-md-5\">
<div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"77%\" align=\"right\">Estimasi Waktu Kerja</td>
        <td width=\"3%\" align=\"right\">:</td>
        <td width=\"20%\" align=\"right\">".$service_time_est_tot."</td>
      </tr>
      <tr>
        <td align=\"right\">Estimasi Biaya</td>
        <td align=\"right\">:</td>
        <td align=\"right\">".$service_order_amount_format."</td>
      </tr>
      <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    </table></div>
<div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"33%\" align=\"center\">Pemilik/Pembawa</td>
    <td width=\"0%\">&nbsp;</td>
    <td width=\"33%\" align=\"center\">Service Advisor</td>
    <td width=\"0%\">&nbsp;</td>
    <td width=\"33%\" align=\"center\">Final Inspector</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class=\"borderbottom\" align=\"center\">&nbsp;</td>
    <td>&nbsp;</td>
    <td class=\"borderbottom\" align=\"center\">&nbsp;</td>
    <td>&nbsp;</td>
    <td class=\"borderbottom\" align=\"center\">&nbsp;</td>
  </tr>
  
</table></div>
</div>
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