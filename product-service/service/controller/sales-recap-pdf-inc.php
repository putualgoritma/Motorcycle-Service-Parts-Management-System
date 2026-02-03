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
//sum service_orderdetails on service_order case cash or credit group by service_order_registernum
$service_orderdetails_onservice_row=$global->db_qry_data("SELECT COUNT(DISTINCT GROUP_CONCAT(service_order.service_order_id)) AS unit_entry,service_order.service_order_id,GROUP_CONCAT(service_order.service_order_register),service_order.service_order_payregister,service_order.service_order_payregisternum,
SUM(service_orderdetails.service_orderdetails_total) as sales_amount,
SUM(CASE WHEN service_orderdetails.kpb_yesno ='1' THEN service_orderdetails.service_orderdetails_total ELSE 0 End) as sales_amount_kpb,
SUM(CASE WHEN service_orderdetails.kpb_yesno ='0' THEN service_orderdetails.service_orderdetails_total ELSE 0 End) as sales_amount_non_kpb
FROM service_order
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order.service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY service_order.service_order_payregister
ORDER BY service_order.service_order_payregisternum ASC");
//sum product_orderdetails on service_order case cash or credit group by service_order_registernum
$product_orderdetails_onservice_row=$global->db_qry_data("SELECT GROUP_CONCAT(service_order.service_order_id),GROUP_CONCAT(service_order.service_order_register),
SUM(product_orderdetails.product_orderdetails_total) as psales_amount,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='1' THEN product_orderdetails.product_orderdetails_total ELSE 0 End) as psales_amount_kpb,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='0' THEN product_orderdetails.product_orderdetails_total ELSE 0 End) as psales_amount_non_kpb
FROM service_order
LEFT JOIN product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order_type='si' AND service_order.service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY service_order.service_order_payregister
ORDER BY service_order.service_order_payregisternum ASC");
//adjust
$sales_recap_arr=array();
for($i=0;$i<count($service_orderdetails_onservice_row['select_data']);$i++){
	$arr_index=$service_orderdetails_onservice_row['select_data'][$i]['service_order_payregisternum'];
	$sales_recap_arr[$arr_index]['service_order_payregister']=$service_orderdetails_onservice_row['select_data'][$i]['service_order_payregister'];
	$sales_recap_arr[$arr_index]['unit_entry']=$service_orderdetails_onservice_row['select_data'][$i]['unit_entry'];
	$sales_recap_arr[$arr_index]['sales_amount']=$service_orderdetails_onservice_row['select_data'][$i]['sales_amount'];
		$sales_recap_arr[$arr_index]['psales_amount']=$product_orderdetails_onservice_row['select_data'][$i]['psales_amount'];
		$sales_recap_arr[$arr_index]['non_kpb_amount']=$service_orderdetails_onservice_row['select_data'][$i]['sales_amount_non_kpb']+$product_orderdetails_onservice_row['select_data'][$i]['psales_amount_non_kpb'];
		$sales_recap_arr[$arr_index]['kpb_amount']=$service_orderdetails_onservice_row['select_data'][$i]['sales_amount_kpb']+$product_orderdetails_onservice_row['select_data'][$i]['psales_amount_kpb'];
	}
//print_r($sales_recap_arr);
//sum product_orderdetails on product_order case cash or credit group by product_order_registernum
$product_orderdetails_onproduct_row=$global->db_qry_data("SELECT GROUP_CONCAT(product_order.product_order_id),product_order.product_order_register,product_order.product_order_registernum,
SUM(product_orderdetails.product_orderdetails_total) as psales_amount,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='1' THEN product_orderdetails.product_orderdetails_total ELSE 0 End) as psales_amount_kpb,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='0' THEN product_orderdetails.product_orderdetails_total ELSE 0 End) as psales_amount_non_kpb
FROM product_order
LEFT JOIN product_orderdetails ON product_order.product_order_id = product_orderdetails.product_order_id
WHERE product_order.product_order_status='pmn' AND product_order.product_order_type='si' AND product_order.product_order_registernum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY product_order.product_order_register
ORDER BY product_order.product_order_registernum ASC");
//adjust
for($i=0;$i<count($product_orderdetails_onproduct_row['select_data']);$i++){
	$arr_index=$product_orderdetails_onproduct_row['select_data'][$i]['product_order_registernum'];
	if (array_key_exists($arr_index, $sales_recap_arr)) {
			$sales_recap_arr[$arr_index]['psales_amount'] +=$product_orderdetails_onproduct_row['select_data'][$i]['psales_amount'];
			$sales_recap_arr[$arr_index]['non_kpb_amount'] +=$product_orderdetails_onproduct_row['select_data'][$i]['psales_amount_non_kpb'];
			$sales_recap_arr[$arr_index]['kpb_amount'] +=$product_orderdetails_onproduct_row['select_data'][$i]['psales_amount_kpb'];
		}else{
			$sales_recap_arr[$arr_index]['service_order_payregister']=$product_orderdetails_onproduct_row['select_data'][$i]['product_order_register'];
			$sales_recap_arr[$arr_index]['unit_entry']=0;
			$sales_recap_arr[$arr_index]['sales_amount']=0;
			$sales_recap_arr[$arr_index]['psales_amount']=$product_orderdetails_onproduct_row['select_data'][$i]['psales_amount'];
			$sales_recap_arr[$arr_index]['non_kpb_amount']=$product_orderdetails_onproduct_row['select_data'][$i]['psales_amount_non_kpb'];
			$sales_recap_arr[$arr_index]['kpb_amount']=$product_orderdetails_onproduct_row['select_data'][$i]['psales_amount_kpb'];
		}
	}
/*
foreach($sales_recap_arr as $sales_recap_key => $sales_recap_val) {
	echo $sales_recap_arr[$sales_recap_key]['unit_entry'];
}*/
//print_r($sales_recap_arr);
?>
