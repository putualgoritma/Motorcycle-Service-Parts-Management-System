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
//qry service in service_order group by category
$service_in_service_order_row=$global->db_qry_data("SELECT GROUP_CONCAT(service_order.service_order_id),motorcycle_type.motorcycle_type_code,motorcycle_type.motorcycle_type_name,category.category_code,
SUM(service_orderdetails_quantity) AS quantity,
SUM(service_orderdetails_total) AS price
FROM service_order
LEFT JOIN motorcycle ON service_order.motorcycle_code = motorcycle.motorcycle_code
LEFT JOIN motorcycle_type ON motorcycle.motorcycle_type_code = motorcycle_type.motorcycle_type_code
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN service ON service_orderdetails.service_code = service.service_code
LEFT JOIN category ON service.category_code = category.category_code
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY category.category_code,motorcycle_type.motorcycle_type_code,service_order.service_order_id
ORDER BY motorcycle_type.motorcycle_type_code ASC,service_order.service_order_id ASC");
//print_r($service_in_service_order_row['select_data']);
//WHERE service_order.service_order_status='pmn' AND service_order_register LIKE '".$service_order_register."'
//adjust
$service_in_service_order_arr=array();
$service_in_service_total_arr=array();
$motorcycle_type_code_set="";
$service_order_id_set=0;
$j=-1;
$ue_tot=0;
$tj_tot=0;
for($i=0;$i<count($service_in_service_order_row['select_data']);$i++){
//if motorcycle_type change
if($i==0 || $motorcycle_type_code_set!=$service_in_service_order_row['select_data'][$i]['motorcycle_type_code']){
	$motorcycle_type_code_set=$service_in_service_order_row['select_data'][$i]['motorcycle_type_code'];
	$ue=0;
	$tj=0;
	$j++;
	if($i==0){
		$ue=1;
		$service_order_id_set=$service_in_service_order_row['select_data'][$i]['service_order_id'];
		$ue_tot++;
		}
	}
//if service_order change
if($service_order_id_set!=$service_in_service_order_row['select_data'][$i]['service_order_id']){
	$service_order_id_set=$service_in_service_order_row['select_data'][$i]['service_order_id'];
	$ue++;
	$ue_tot++;
	}
$service_in_service_order_arr[$j]['motorcycle_type_name']=$service_in_service_order_row['select_data'][$i]['motorcycle_type_name'];
$category_code=$service_in_service_order_row['select_data'][$i]['category_code'];
if(isset($service_in_service_order_arr[$j][$category_code])){
	$service_in_service_order_arr[$j][$category_code]+=$service_in_service_order_row['select_data'][$i]['quantity'];
	}else{
	$service_in_service_order_arr[$j][$category_code]=$service_in_service_order_row['select_data'][$i]['quantity'];
	}
if(isset($service_in_service_total_arr['total'][$category_code])){
	$service_in_service_total_arr['total'][$category_code]+=$service_in_service_order_row['select_data'][$i]['quantity'];
	}else{
	$service_in_service_total_arr['total'][$category_code]=$service_in_service_order_row['select_data'][$i]['quantity'];
	}
$tj+=$service_in_service_order_row['select_data'][$i]['quantity'];
$tj_tot +=$service_in_service_order_row['select_data'][$i]['quantity'];
$service_in_service_order_arr[$j]['unit_entry']=$ue;
$service_in_service_order_arr[$j]['total_jobs']=$tj;
}
$service_in_service_total_arr['total']['unit_entry']=$ue_tot;
$service_in_service_total_arr['total']['total_jobs']=$tj_tot;
//print_r($service_in_service_order_arr);
//print_r($service_in_service_total_arr);
//qry product in service_order group by category
$product_in_service_order_row=$global->db_qry_data("SELECT GROUP_CONCAT(service_order.service_order_id),category.category_name,
SUM(product_orderdetails_total) AS price
FROM service_order
LEFT JOIN product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id
LEFT JOIN product ON product_orderdetails.product_code = product.product_code
LEFT JOIN category ON product.category_code = category.category_code
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY category.category_code
ORDER BY category.category_name ASC");
//print_r($product_in_service_order_row['select_data']);
//qry product in service_order group by category
$product_in_product_order_row=$global->db_qry_data("SELECT GROUP_CONCAT(product_order.product_order_id),category.category_name,
SUM(product_orderdetails_total) AS price
FROM product_order
LEFT JOIN product_orderdetails ON product_order.product_order_id = product_orderdetails.product_order_id
LEFT JOIN product ON product_orderdetails.product_code = product.product_code
LEFT JOIN category ON product.category_code = category.category_code
WHERE product_order.product_order_status='pmn' AND product_orderdetails.product_orderdetails_type='si' AND product_order_registernum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY category.category_code
ORDER BY category.category_name ASC");
//print_r($product_in_product_order_row['select_data']);
//qry service total in service_order group by category
$servicetot_in_service_order_row=$global->db_qry_data("SELECT GROUP_CONCAT(service_order.service_order_id),category.category_code,
SUM(service_orderdetails_total) AS price
FROM service_order
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN service ON service_orderdetails.service_code = service.service_code
LEFT JOIN category ON service.category_code = category.category_code
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY category.category_code
ORDER BY category.category_name ASC");
//print_r($servicetot_in_service_order_row['select_data']);
//adjust
$servicetot_arr=array();
$servicetot_arr['OTHER']=0;
$servicetot_arr['CLAIMC2']=0;
$servicetot_arr['ASS']=0;
$servicetot_arr['TOTAL']=0;
for($i=0;$i<count($servicetot_in_service_order_row['select_data']);$i++){
$servicetot_category_code=$servicetot_in_service_order_row['select_data'][$i]['category_code'];
if($servicetot_category_code=="ASS1" || $servicetot_category_code=="ASS2" || $servicetot_category_code=="ASS3" || $servicetot_category_code=="ASS4"){
	$servicetot_arr['ASS'] +=$servicetot_in_service_order_row['select_data'][$i]['price'];
	}
if($servicetot_category_code=="CLAIMC2"){
	$servicetot_arr['CLAIMC2'] +=$servicetot_in_service_order_row['select_data'][$i]['price'];
	}
if($servicetot_category_code=="OTHER"){
	$servicetot_arr['OTHER'] +=$servicetot_in_service_order_row['select_data'][$i]['price'];
	}
$servicetot_arr['TOTAL'] +=$servicetot_in_service_order_row['select_data'][$i]['price'];
}
$servicetot_arr['OK'] =$servicetot_arr['TOTAL']-($servicetot_arr['OTHER']+$servicetot_arr['CLAIMC2']+$servicetot_arr['ASS']);
//print_r($servicetot_arr);


//qry service in service_order group by category
$service_in_service_order_staff_row=$global->db_qry_data("SELECT GROUP_CONCAT(service_order.service_order_id) AS service_order_id,staff.staff_code,staff.staff_name,category.category_code,
SUM(service_orderdetails_quantity) AS quantity,
SUM(service_orderdetails_total) AS price
FROM service_order
LEFT JOIN staff ON service_order.staff_code = staff.staff_code
LEFT JOIN motorcycle ON service_order.motorcycle_code = motorcycle.motorcycle_code
LEFT JOIN motorcycle_type ON motorcycle.motorcycle_type_code = motorcycle_type.motorcycle_type_code
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN service ON service_orderdetails.service_code = service.service_code
LEFT JOIN category ON service.category_code = category.category_code
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY category.category_code,staff.staff_code,service_order.service_order_id
ORDER BY staff.staff_name ASC,service_order.service_order_id ASC");
//print_r($service_in_service_order_staff_row['select_data']);
//WHERE service_order.service_order_status='pmn' AND service_order_register LIKE '".$service_order_register."'
//adjust
$service_in_service_order_staff_arr=array();
$service_in_service_total_staff_arr=array();
$staff_code_set="";
$service_order_id_set=0;
$j=-1;
$ue_tot=0;
$tj_tot=0;
$tpj_tot=0;
for($i=0;$i<count($service_in_service_order_staff_row['select_data']);$i++){
//if staff change
if($i==0 || $staff_code_set!=$service_in_service_order_staff_row['select_data'][$i]['staff_code']){
	$staff_code_set=$service_in_service_order_staff_row['select_data'][$i]['staff_code'];
	$ue=0;
	$tj=0;
	$tpj=0;
	$j++;
	if($i==0){
		$ue=1;
		$service_order_id_set=$service_in_service_order_staff_row['select_data'][$i]['service_order_id'];
		$ue_tot++;
		}
	}
//if service_order change
if($service_order_id_set!=$service_in_service_order_staff_row['select_data'][$i]['service_order_id']){
	$service_order_id_set=$service_in_service_order_staff_row['select_data'][$i]['service_order_id'];
	$ue++;
	$ue_tot++;
	}
$service_in_service_order_staff_arr[$j]['staff_name']=$service_in_service_order_staff_row['select_data'][$i]['staff_name'];
$category_code=$service_in_service_order_staff_row['select_data'][$i]['category_code'];
if(isset($service_in_service_order_staff_arr[$j][$category_code])){
	$service_in_service_order_staff_arr[$j][$category_code]+=$service_in_service_order_staff_row['select_data'][$i]['quantity'];
	$service_in_service_order_staff_arr[$j]['price'][$category_code]+=$service_in_service_order_staff_row['select_data'][$i]['price'];
	}else{
	$service_in_service_order_staff_arr[$j][$category_code]=$service_in_service_order_staff_row['select_data'][$i]['quantity'];
	$service_in_service_order_staff_arr[$j]['price'][$category_code]=$service_in_service_order_staff_row['select_data'][$i]['price'];
	}
if(isset($service_in_service_total_staff_arr['total'][$category_code])){
	$service_in_service_total_staff_arr['total'][$category_code]+=$service_in_service_order_staff_row['select_data'][$i]['quantity'];
	$service_in_service_total_staff_arr['price_total'][$category_code]+=$service_in_service_order_staff_row['select_data'][$i]['price'];
	}else{
	$service_in_service_total_staff_arr['total'][$category_code]=$service_in_service_order_staff_row['select_data'][$i]['quantity'];
	$service_in_service_total_staff_arr['price_total'][$category_code]=$service_in_service_order_staff_row['select_data'][$i]['price'];
	}
$tj+=$service_in_service_order_staff_row['select_data'][$i]['quantity'];
$tpj+=$service_in_service_order_staff_row['select_data'][$i]['price'];
$tj_tot +=$service_in_service_order_staff_row['select_data'][$i]['quantity'];
$tpj_tot +=$service_in_service_order_staff_row['select_data'][$i]['price'];
$service_in_service_order_staff_arr[$j]['unit_entry']=$ue;
$service_in_service_order_staff_arr[$j]['total_jobs']=$tj;
$service_in_service_order_staff_arr[$j]['price']['total_jobs']=$tpj;
}
$service_in_service_total_staff_arr['total']['unit_entry']=$ue_tot;
$service_in_service_total_staff_arr['total']['total_jobs']=$tj_tot;
$service_in_service_total_staff_arr['price_total']['total_jobs']=$tpj_tot;
//print_r($service_in_service_order_staff_arr);
//print_r($service_in_service_total_staff_arr);
//efective work
$service_order_monthlynum=$global->month_strtonum($service_order_monthly);
$get_efective_work=$global->salary->get_efective_work($service_order_monthlynum);
$ue_average=$service_in_service_total_arr['total']['unit_entry']/$get_efective_work;
?>
