<?
if(isset($_REQUEST['service_order_register'])){
$service_order_register_start=$_REQUEST['service_order_register_start'];
$service_order_register=$_REQUEST['service_order_register'];
} else if(isset($_POST['service_order_register'])){
$service_order_register_start=$_POST['service_order_register_start'];
$service_order_register=$_POST['service_order_register'];
}else{
$service_order_register_start=date("d/m/Y");
$service_order_register=date("d/m/Y");
}
//get datenum
$valid_date_start=$global->valid_date($service_order_register_start);
$valid_date_end=$global->valid_date($service_order_register);
//sum service_orderdetails on service_order case cash or credit group by service_order_id
$service_orderdetails_onservice_row=$global->db_qry_data("SELECT service_order.service_order_code,service_order.service_order_register,
SUM(CASE WHEN service_orderdetails.kpb_yesno ='1' THEN service_orderdetails.service_orderdetails_total ELSE 0 End) as sales_amount_kpb,
SUM(CASE WHEN service_orderdetails.kpb_yesno ='0' THEN service_orderdetails.service_orderdetails_total ELSE 0 End) as sales_amount_non_kpb
FROM service_order
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order.service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY service_order.service_order_id
ORDER BY service_order.service_order_id ASC");
//sum product_orderdetails on service_order case cash or credit group by service_order_id
$product_orderdetails_onservice_row=$global->db_qry_data("SELECT service_order.service_order_code,service_order.service_order_register,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='1' THEN product_orderdetails.product_orderdetails_total ELSE 0 End) as psales_amount_kpb,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='0' THEN product_orderdetails.product_orderdetails_total ELSE 0 End) as psales_amount_non_kpb
FROM service_order
LEFT JOIN product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order.service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY service_order.service_order_id
ORDER BY service_order.service_order_id ASC");
//adjust
$service_order_arr=array();
for($i=0;$i<count($service_orderdetails_onservice_row['select_data']);$i++){
	$service_order_arr[$i]['service_order_code']=$service_orderdetails_onservice_row['select_data'][$i]['service_order_code'];
	$service_order_arr[$i]['service_order_register']=$service_orderdetails_onservice_row['select_data'][$i]['service_order_register'];
	$service_order_arr[$i]['sales_amount_kpb']=$service_orderdetails_onservice_row['select_data'][$i]['sales_amount_kpb'];
	$service_order_arr[$i]['sales_amount_non_kpb']=$service_orderdetails_onservice_row['select_data'][$i]['sales_amount_non_kpb'];
	$service_order_arr[$i]['psales_amount_kpb']=$product_orderdetails_onservice_row['select_data'][$i]['psales_amount_kpb'];
	$service_order_arr[$i]['psales_amount_non_kpb']=$product_orderdetails_onservice_row['select_data'][$i]['psales_amount_non_kpb'];
	}
//print_r($service_order_arr);
//sum product_orderdetails on product_order case cash or credit group by product_order_id
$product_orderdetails_onproduct_row=$global->db_qry_data("SELECT product_order.product_order_code,product_order.product_order_register,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='1' THEN product_orderdetails.product_orderdetails_total ELSE 0 End) as psales_amount_kpb,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='0' THEN product_orderdetails.product_orderdetails_total ELSE 0 End) as psales_amount_non_kpb
FROM product_order
LEFT JOIN product_orderdetails ON product_order.product_order_id = product_orderdetails.product_order_id
WHERE product_order.product_order_status='pmn' AND product_order.product_order_type='si' AND product_order.product_order_registernum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY product_order.product_order_id
ORDER BY product_order.product_order_id ASC");
?>
