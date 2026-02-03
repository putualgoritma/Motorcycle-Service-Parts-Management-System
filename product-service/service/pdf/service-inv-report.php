<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<? include ("../controller/service-inv-report-inc.php"); ?>

<?
//var
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

$_SESSION['var_pdf_sessi']=$var_pdf;
$_SESSION['label_pdf_sessi']=$label_pdf;
$_SESSION['list_pdf_sessi']=$service_orderdetails_list_pdf;
$_SESSION['list_pdf2_sessi']=$product_orderdetails_list_pdf;

//print_r($var_pdf);
Header("location: service-inv-pdf.php");
exit;
?>