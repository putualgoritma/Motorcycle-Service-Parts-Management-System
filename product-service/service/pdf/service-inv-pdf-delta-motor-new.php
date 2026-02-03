<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/service-inv-report-inc.php"); ?>
<? require_once $path.'vendor/autoload.php'; ?>
<? 
//var
$var_pdf['service_order_description']=str_replace("PKB","",$service_order_row['service_order_description']);
$var_pdf['service_order_memo']=str_replace("PKB","",$service_order_row['service_order_memo']);
$var_pdf['service_order_code']=str_replace("PKB","",$service_order_row['service_order_code']);
$var_pdf['service_order_register']=$service_order_row['service_order_register'];
$var_pdf['users_name']=$users_row['users_name'];
$var_pdf['users_phone']=$users_row['users_phone'];
$var_pdf['motorcycle_code']=$motorcycle_row['motorcycle_code'];
$var_pdf['service_order_km_now']=$service_order_row['service_order_km_now'];
$var_pdf['service_order_km_next']=$service_order_row['service_order_km_next'];
$var_pdf['motorcycle_owner_name']=$users_name;
$var_pdf['motorcycle_frame_no']=$motorcycle_frame_no;
$var_pdf['motorcycle_type_name']=$motorcycle_type_name;
$var_pdf['service_order_kpb_service']=$service_order_row['service_order_kpb_service'];
$var_pdf['service_order_kpb_product']=$service_order_row['service_order_kpb_product'];
$var_pdf['service_order_amount']=$service_order_amount_format;
$var_pdf['staff_code']=$staff_code;
$var_pdf['service_order_payregister']=$service_order_row['service_order_payregister'];
$var_pdf['service_order_payregister_hour']=$service_order_row['service_order_payregister_hour'];
$var_pdf['service_order_cash']=$global->num_format2($service_order_row['service_order_cash']);
$var_pdf['service_order_balance']=$global->num_format2($service_order_row['service_order_balance']);

//label
$label_pdf['company_name']=strtoupper($company['company_name']);
$label_pdf['dealer_code']=$company['dealer_code'];
$label_pdf['company_address']=strtoupper($company['company_address']);
$label_pdf['company_phone']=strtoupper($company['company_phone']);
$label_pdf['motorcycle_code']=$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_code'];
$label_pdf['service_order_code']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_order_code'];
$label_pdf['service_order_queue']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_order_queue'];
$label_pdf['service_order_km_now']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_order_km_now'];
$label_pdf['service_order_km_next']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_order_km_next'];
$label_pdf['motorcycle_owner_name']=$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_owner_name'];
$label_pdf['motorcycle_frame_no']=$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_frame_no'];
$label_pdf['motorcycle_machine_no']=$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_machine_no'];
$label_pdf['motorcycle_type_name']=$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name'];
$label_pdf['color_name']=$global->product_order->product_order_lang['form_label_product_order_lang']['color_name'];
$label_pdf['motorcycle_manufacture']=$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_manufacture'];
$label_pdf['service_code']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_code'];
$label_pdf['service_name']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_name'];
$label_pdf['service_orderdetails_sprice']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_sprice'];
$label_pdf['service_orderdetails_subtotal']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_subtotal'];
$label_pdf['product_code']=$global->product_order->product_order_lang['form_label_product_order_lang']['product_code'];
$label_pdf['product_name']=$global->product_order->product_order_lang['form_label_product_order_lang']['product_name'];
$label_pdf['product_orderdetails_sprice']=$global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_sprice'];
$label_pdf['product_orderdetails_subtotal']=$global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_subtotal'];
$label_pdf['staff_mechanic']=$global->product_order->product_order_lang['form_label_product_order_lang']['staff_mechanic'];
$label_pdf['service_order_kpb_service']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_order_kpb_service'];
$label_pdf['service_order_kpb_product']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_order_kpb_product'];
$label_pdf['service_order_total']=$global->product_order->product_order_lang['form_label_product_order_lang']['service_order_total'];

//list service
$service_orderdetails_discount_val_tot=0;
$service_orderdetails_list=$global->tbl_list("service_orderdetails","*","service_order_id='".$service_order_row['service_order_id']."'","",1);
$service_orderdetails_list_pdf=array();
$service_orderdetails_total=0;
$gross_total=0;
$disc_total=0;
for($i=0;$i<count($service_orderdetails_list);$i++){
$j=$i+1;
//if kpb
$kpb_yesno=$service_orderdetails_list[$i]['kpb_yesno'];
if($kpb_yesno==1){
$service_orderdetails_list[$i]['service_orderdetails_price']=0;
}
//get bcode
$service_row=$global->product_order->db_row("service","*","service_code='".$service_orderdetails_list[$i]['service_code']."'");
//get sub total
$service_orderdetails_price_adisc2=$service_orderdetails_list[$i]['service_orderdetails_price']*(1-(($service_orderdetails_list[$i]['service_orderdetails_discount']+$service_orderdetails_list[$i]['service_orderdetails_disc_final'])/100)+(($service_orderdetails_list[$i]['service_orderdetails_discount']*$service_orderdetails_list[$i]['service_orderdetails_disc_final'])/10000));
$service_orderdetails_subtotal=$service_orderdetails_list[$i]['service_orderdetails_price']*$service_orderdetails_list[$i]['service_orderdetails_quantity'];
$service_orderdetails_price_format=$global->num_format2($service_orderdetails_list[$i]['service_orderdetails_price']);
$service_orderdetails_subtotal_format=$global->num_format2($service_orderdetails_subtotal);
$service_orderdetails_total +=$service_orderdetails_subtotal;
$adisc2=$service_orderdetails_list[$i]['service_orderdetails_price']-$service_orderdetails_price_adisc2;
$adisc2_subtotal=$adisc2*$service_orderdetails_list[$i]['service_orderdetails_quantity'];
$adisc2_subtotal_format=$global->num_format2($adisc2_subtotal);
$gross_total +=$service_orderdetails_list[$i]['service_orderdetails_price']*$service_orderdetails_list[$i]['service_orderdetails_quantity'];
$disc_total +=$adisc2_subtotal;
//list pdf
$service_orderdetails_list_pdf[$i]['service_scode']=$service_row['service_code'];
$service_orderdetails_list_pdf[$i]['service_name']=$service_row['service_name'];
$service_orderdetails_list_pdf[$i]['service_orderdetails_quantity']=$service_orderdetails_list[$i]['service_orderdetails_quantity'];
$service_orderdetails_list_pdf[$i]['service_orderdetails_price']=$service_orderdetails_price_format;
$service_orderdetails_list_pdf[$i]['service_orderdetails_subtotal']=$service_orderdetails_subtotal_format;
}
$service_orderdetails_total_format=$global->num_format2($service_orderdetails_total);
$var_pdf['service_orderdetails_total_format']=$service_orderdetails_total_format;


//list product
$product_orderdetails_discount_val_tot=0;
$product_orderdetails_list=$global->tbl_list("product_orderdetails","*","service_order_id='".$service_order_row['service_order_id']."'","",1);
$product_orderdetails_list_pdf=array();
$product_orderdetails_total=0;
for($i=0;$i<count($product_orderdetails_list);$i++){
$j=$i+1;
//if kpb
$kpb_yesno=$product_orderdetails_list[$i]['kpb_yesno'];
if($kpb_yesno==1){
$product_orderdetails_list[$i]['product_orderdetails_price']=0;
}
//get bcode
$product_row=$global->product_order->db_row("product","*","product_code='".$product_orderdetails_list[$i]['product_code']."'");
//get sub total
$product_orderdetails_price_adisc2=$product_orderdetails_list[$i]['product_orderdetails_price']*(1-(($product_orderdetails_list[$i]['product_orderdetails_discount']+$product_orderdetails_list[$i]['product_orderdetails_disc_final'])/100)+(($product_orderdetails_list[$i]['product_orderdetails_discount']*$product_orderdetails_list[$i]['product_orderdetails_disc_final'])/10000));
$product_orderdetails_subtotal=$product_orderdetails_list[$i]['product_orderdetails_price']*$product_orderdetails_list[$i]['product_orderdetails_quantity'];
$product_orderdetails_price_format=$global->num_format2($product_orderdetails_list[$i]['product_orderdetails_price']);
$product_orderdetails_subtotal_format=$global->num_format2($product_orderdetails_subtotal);
$product_orderdetails_total +=$product_orderdetails_subtotal;
$adisc2=$product_orderdetails_list[$i]['product_orderdetails_price']-$product_orderdetails_price_adisc2;
$adisc2_subtotal=$adisc2*$product_orderdetails_list[$i]['product_orderdetails_quantity'];
$adisc2_subtotal_format=$global->num_format2($adisc2_subtotal);
$gross_total +=$product_orderdetails_list[$i]['product_orderdetails_price']*$product_orderdetails_list[$i]['product_orderdetails_quantity'];
$disc_total +=$adisc2_subtotal;
//list pdf
$product_orderdetails_list_pdf[$i]['product_scode']=$product_row['product_code'];
$product_orderdetails_list_pdf[$i]['product_name']=$product_row['product_name'];
$product_orderdetails_list_pdf[$i]['product_orderdetails_quantity']=$product_orderdetails_list[$i]['product_orderdetails_quantity'];
$product_orderdetails_list_pdf[$i]['product_orderdetails_price']=$product_orderdetails_price_format;
$product_orderdetails_list_pdf[$i]['product_orderdetails_subtotal']=$product_orderdetails_subtotal_format;
}
$product_orderdetails_total_format=$global->num_format2($product_orderdetails_total);
$var_pdf['product_orderdetails_total_format']=$product_orderdetails_total_format;
$gross_total_format=$global->num_format2($gross_total);
$var_pdf['gross_total_format']=$gross_total_format;
$disc_total_format=$global->num_format2($disc_total);
$var_pdf['disc_total_format']=$disc_total_format;

?>
<? 
//session_start();



//get sessi

//var
$service_order_description = $var_pdf['service_order_description'];
$service_order_memo = $var_pdf['service_order_memo'];
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
.col-md-4 {
    width: 40%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-2 {
    width: 20%;
	float: left; 
	margin-bottom: 0pt;
}
.col-md-8 {
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
</style>
</head>

<body>
<div class=\"col-md-50\">
<div class=\"col-md-2\"><img src=\"".$path."templates/default/img/honda-logo.png\" width=\"150\" height=\"96\"></div>
<div class=\"col-md-8\">
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
</div>
<div class=\"col-md-50r\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"right\"><h3> NOTA SERVICE</h3></td>
  </tr>
</table>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	  <tr>
		<td align=\"right\">Nomor : SRV".$service_order_code."</td>
      </tr>
  <tr>
		<td align=\"right\">Tanggal : ".$service_order_payregister."&nbsp;&nbsp;&nbsp;".$service_order_payregister_hour."</td>
  </tr>
</table>
</div>
<div class=\"clear garis2\">&nbsp;</div>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"10%\" valign=\"top\">No. Polisi</td>
        <td width=\"1%\" align=\"center\" valign=\"top\"> : </td>
        <td width=\"17%\" valign=\"top\">$motorcycle_code</td>
        <td width=\"17%\" valign=\"top\">No. Telp/Hp		</td>
        <td width=\"1%\" align=\"center\" valign=\"top\"> : </td>
        <td width=\"31%\" valign=\"top\">$users_phone</td>
        <td width=\"1%\" valign=\"top\">&nbsp;</td>
        <td width=\"13%\" valign=\"top\">Km</td>
        <td width=\"1%\" align=\"center\" valign=\"top\"> : </td>
        <td width=\"8%\" align=\"right\" valign=\"top\">$service_order_km_now</td>
      </tr>
      <tr>
        <td valign=\"top\">Pemilik</td>
        <td align=\"center\" valign=\"top\">: </td>
        <td valign=\"top\">$users_name</td>
        <td valign=\"top\">Type/Warna/Thn	</td>
        <td align=\"center\" valign=\"top\">: </td>
        <td valign=\"top\">$motorcycle_type_name</td>
        <td valign=\"top\">&nbsp;</td>
        <td valign=\"top\">Km Kembali		</td>
        <td align=\"center\" valign=\"top\">: </td>
        <td align=\"right\" valign=\"top\">$service_order_km_next</td>
      </tr>
</table>
<div class=\"clear\">&nbsp;</div>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"6%\"><strong>No</strong></td>
        <td width=\"22%\"><strong>Kode Jasa</strong></td>
        <td width=\"37%\"><strong>Nama Jasa</strong></td>
        <td width=\"7%\"><strong>Qty</strong></td>
        <td width=\"13%\"><strong>Harga</strong></td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\"><strong>Jumlah</strong></td>
      </tr>
</table>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      "; 
	 $inc=1;
   $svc_total = 0;
	 for($i=0;$i<count($service_orderdetails_list_pdf);$i++){
		$service_code=$service_orderdetails_list_pdf[$i]['service_scode'];
		$service_name=$service_orderdetails_list_pdf[$i]['service_name'];
		$service_orderdetails_quantity=$service_orderdetails_list_pdf[$i]['service_orderdetails_quantity'];
		$service_orderdetails_price=$service_orderdetails_list_pdf[$i]['service_orderdetails_price'];
		$service_orderdetails_subtotal=$service_orderdetails_list_pdf[$i]['service_orderdetails_subtotal'];	
    $svc_total += $service_orderdetails_subtotal;
		$inc++;
	}
  if(count($service_orderdetails_list_pdf) >0){
	$html .= "
	  <tr>
        <td width=\"6%\">1</td>
        <td width=\"22%\">SVC0001</td>
        <td width=\"37%\">Jasa</td>
        <td width=\"7%\">1</td>
        <td width=\"13%\"> $service_orderdetails_total_format</td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\">$service_orderdetails_total_format</td>
  </tr>
  ";
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
<div class=\"clear\">&nbsp;</div>
<div class=\"garis\"></div>
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"6%\"><strong>No</strong></td>
        <td width=\"22%\"><strong>Kode Part</strong></td>
        <td width=\"37%\"><strong>Nama Part</strong></td>
        <td width=\"7%\"><strong>Qty</strong></td>
        <td width=\"13%\"><strong>Harga</strong></td>
        <td width=\"1%\">&nbsp;</td>
        <td width=\"14%\" align=\"right\"><strong>Jumlah</strong></td>
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
          <td width=\"50%\">Mekanik : $staff_code</td>
          <td width=\"50%\">No. PKB : PKB$service_order_code</td>
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
          <td width=\"13%\">Total Discount</td>
          <td width=\"1%\">:</td>
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
          <td>Total Bayar</td>
          <td>:</td>
          <td align=\"right\">$service_order_amount_format</td>
        </tr>
        <tr>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td>&nbsp;</td>
          <td>Tunai</td>
          <td>:</td>
          <td align=\"right\">$service_order_cash</td>
        </tr>
		<tr>
          <td align=\"center\">&nbsp;</td>
          <td class=\"garis2\" align=\"center\">Administator</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\" class=\"garis2\">&nbsp;</td>
          <td align=\"center\">&nbsp;</td>
          <td align=\"center\" class=\"garis2\">&nbsp;</td>
          <td>&nbsp;</td>
          <td>Kembalian</td>
          <td>:</td>
          <td align=\"right\">$service_order_balance</td>
        </tr>
    </table>
  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
          <td width=\"5%\" align=\"center\">&nbsp;</td>
          <td width=\"90%\" align=\"center\">&nbsp;</td>
       </tr>
       <tr>
          <td width=\"5%\" align=\"center\">&nbsp;</td>
          <td width=\"90%\" align=\"center\">&nbsp;</td>
       </tr>
       <tr>
          <td width=\"5%\" align=\"center\">&nbsp;</td>
          <td width=\"90%\" align=\"center\">&nbsp;</td>
       </tr>
       <tr>
          <td width=\"5%\" align=\"center\">&nbsp;</td>
          <td width=\"90%\" align=\"center\">&nbsp;</td>
       </tr>
        <tr>
          <td width=\"5%\" align=\"left\">Catatan:</td>
          <td width=\"90%\" align=\"left\">$service_order_memo</td>
       </tr>
    </table>   
</body>
</html>
";


/*echo $html;*/

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