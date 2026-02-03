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
//qry product_orderdetails
$product_orderdetails_row=$global->db_qry_data("SELECT product.product_code,product.product_name,GROUP_CONCAT(product_orderdetails.product_orderdetails_register),SUM(product_orderdetails.product_orderdetails_quantity) as product_qty,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='0' THEN product_orderdetails.product_orderdetails_total ELSE 0 End ) as product_amount,
SUM(CASE WHEN product_orderdetails.kpb_yesno ='1' THEN product_orderdetails.product_orderdetails_total ELSE 0 End ) as product_kpb_amount
FROM product
JOIN product_orderdetails ON product.product_code = product_orderdetails.product_code
WHERE product_orderdetails.product_orderdetails_status='pmn' AND product_orderdetails.product_orderdetails_type='si' AND product_orderdetails_registernum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY product.product_code
ORDER BY product_orderdetails.product_orderdetails_registernum ASC,product.product_code ASC");
//print_r($product_orderdetails_row['select_data']);
//qry service_orderdetails
$service_orderdetails_row=$global->db_qry_data("SELECT service.service_code,service.service_name,GROUP_CONCAT(service_orderdetails.service_orderdetails_register),SUM(service_orderdetails.service_orderdetails_quantity) as service_qty,
SUM(CASE WHEN service_orderdetails.kpb_yesno ='0' THEN service_orderdetails.service_orderdetails_total ELSE 0 End ) as service_amount,
SUM(CASE WHEN service_orderdetails.kpb_yesno ='1' THEN service_orderdetails.service_orderdetails_total ELSE 0 End ) as service_kpb_amount
FROM service
JOIN service_orderdetails ON service.service_code = service_orderdetails.service_code
WHERE service_orderdetails.service_orderdetails_status='pmn' AND service_orderdetails.service_orderdetails_type='si' AND service_orderdetails_registernum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY service.service_code
ORDER BY service_orderdetails.service_orderdetails_registernum ASC,service.service_code ASC");
//print_r($service_orderdetails_row['select_data']);
?>
