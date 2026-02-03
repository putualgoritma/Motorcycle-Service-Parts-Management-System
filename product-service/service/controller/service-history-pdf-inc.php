<?
if(isset($_REQUEST['motorcycle_code'])){
$motorcycle_code=$_REQUEST['motorcycle_code'];
} else if(isset($_POST['motorcycle_code'])){
$motorcycle_code=$_POST['motorcycle_code'];
}else{
$motorcycle_code="";
}
//qry motorcycle
$motorcycle_row=$global->db_qry_data("SELECT motorcycle.*,motorcycle_type.motorcycle_type_name,users.users_name,users.users_address,users.users_phone
FROM motorcycle
LEFT JOIN motorcycle_type ON motorcycle.motorcycle_type_code = motorcycle_type.motorcycle_type_code
LEFT JOIN users ON motorcycle.users_code = users.users_code
WHERE motorcycle.motorcycle_code = '".$motorcycle_code."'
ORDER BY motorcycle.motorcycle_id ASC");
//print_r($motorcycle_row['select_data']);
//qry service
$service_order_row=$global->db_qry_data("SELECT service_order.*,staff.staff_name
FROM service_order
LEFT JOIN staff ON service_order.staff_code = staff.staff_code
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order.motorcycle_code = '".$motorcycle_code."'
ORDER BY service_order.service_order_registernum DESC, service_order.service_order_id ASC");
//print_r($service_order_row['select_data']);
//echo $service_order_row['qry_str_sort'];
//adjust
$service_in_service_order_arr=array();
$service_in_service_total_arr=array();
for($i=0;$i<count($service_order_row['select_data']);$i++){
	$service_order_id=$service_order_row['select_data'][$i]['service_order_id'];
	//qry service in service_order group by category
	$service_in_service_order_row[$i]=$global->db_qry_data("SELECT service.service_code,service.service_name
	FROM service_order
	LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
	LEFT JOIN service ON service_orderdetails.service_code = service.service_code
	LEFT JOIN category ON service.category_code = category.category_code
	WHERE service_order.service_order_id = '".$service_order_id."'
	ORDER BY service_orderdetails.service_orderdetails_id ASC");
	//print_r($service_in_service_order_row[$i]['select_data']);
	//qry product in service_order group by category
	$product_in_service_order_row[$i]=$global->db_qry_data("SELECT product.product_code,product.product_name,product_orderdetails.product_orderdetails_quantity,unit.unit_name
	FROM service_order
	LEFT JOIN product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id
	LEFT JOIN product ON product_orderdetails.product_code = product.product_code
	LEFT JOIN unit ON unit.unit_code = product.unit_code
	LEFT JOIN category ON product.category_code = category.category_code
	WHERE service_order.service_order_id = '".$service_order_id."'
	ORDER BY product_orderdetails.product_orderdetails_id ASC");
	//print_r($product_in_service_order_row[$i]['select_data']);
}
?>
