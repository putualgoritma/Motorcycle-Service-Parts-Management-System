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
$service_order_row=$global->db_qry_data("SELECT service_order.service_order_id,service_order.service_order_km_now,service_order.service_order_register,motorcycle.motorcycle_machine_no,motorcycle.motorcycle_book_service_no,motorcycle.motorcycle_buy_register,GROUP_CONCAT(category.category_code)
FROM service_order
LEFT JOIN motorcycle ON service_order.motorcycle_code = motorcycle.motorcycle_code
LEFT JOIN motorcycle_type ON motorcycle.motorcycle_type_code = motorcycle_type.motorcycle_type_code
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN service ON service_orderdetails.service_code = service.service_code
LEFT JOIN category ON service.category_code = category.category_code
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND (category.category_code='ASS1' OR category.category_code='ASS2' OR category.category_code='ASS3' OR category.category_code='ASS4') AND service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY service_order.service_order_id
ORDER BY service_order.service_order_payregisternum ASC");
//print_r($service_order_row);
?>
