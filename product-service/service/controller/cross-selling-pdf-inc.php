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
//sum service_orderdetails on service_order group by service_order_id
$service_orderdetails_qry="SELECT service_order.service_order_id,service_order.service_order_reason,service_order.service_order_usersowner_rel,service_order.service_order_register,motorcycle.motorcycle_code,motorcycle.color_code,motorcycle.motorcycle_frame_no,motorcycle.motorcycle_machine_no,motorcycle.motorcycle_manufacture,motorcycle_type.motorcycle_type_name,motorcycle_type.motorcycle_type_cc,users.users_name,users.users_address,users.users_phone,GROUP_CONCAT(category.category_rank),GROUP_CONCAT(category.category_code)
FROM service_order
LEFT JOIN users ON service_order.users_code = users.users_code
LEFT JOIN motorcycle ON service_order.motorcycle_code = motorcycle.motorcycle_code
LEFT JOIN motorcycle_type ON motorcycle.motorcycle_type_code = motorcycle_type.motorcycle_type_code
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN service ON service_orderdetails.service_code = service.service_code
LEFT JOIN category ON service.category_code = category.category_code
WHERE service_order.service_order_status='pmn' AND service_order.service_order_type='si' AND service_order_payregisternum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum']."
GROUP BY service_order.service_order_id
ORDER BY service_order.service_order_id ASC,GROUP_CONCAT(category.category_rank) ASC";
//echo $service_orderdetails_qry;
$service_orderdetails_onservice_row=$global->db_qry_data($service_orderdetails_qry);
//adjust
/*
$service_order_arr=array();
$j=0;
$id_tmp=0;
for($i=0;$i<count($service_orderdetails_onservice_row['select_data']);$i++){
	if($service_orderdetails_onservice_row['select_data'][$i]['service_order_id']!=$id_tmp){
		$service_order_arr[$j]['service_order_id']=$service_orderdetails_onservice_row['select_data'][$i]['service_order_id'];
		$service_order_arr[$j]['service_order_register']=$service_orderdetails_onservice_row['select_data'][$i]['service_order_register'];
		$service_order_arr[$j]['motorcycle_code']=$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_code'];
		$service_order_arr[$j]['color_code']=$service_orderdetails_onservice_row['select_data'][$i]['color_code'];
		$service_order_arr[$j]['motorcycle_frame_no']=$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_frame_no'];
		$service_order_arr[$j]['motorcycle_machine_no']=$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_machine_no'];
		$service_order_arr[$j]['motorcycle_manufacture']=$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_manufacture'];
		$service_order_arr[$j]['motorcycle_type_name']=$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_type_name'];
		$service_order_arr[$j]['motorcycle_type_cc']=$service_orderdetails_onservice_row['select_data'][$i]['motorcycle_type_cc'];
		$service_order_arr[$j]['users_name']=$service_orderdetails_onservice_row['select_data'][$i]['users_name'];
		$service_order_arr[$j]['users_address']=$service_orderdetails_onservice_row['select_data'][$i]['users_address'];
		$service_order_arr[$j]['users_phone']=$service_orderdetails_onservice_row['select_data'][$i]['users_phone'];
		$service_order_arr[$j]['category_rank']=$service_orderdetails_onservice_row['select_data'][$i]['category_rank'];
		$service_order_arr[$j]['category_code']=$service_orderdetails_onservice_row['select_data'][$i]['category_code'];
		$service_order_arr[$j]['service_order_reason']=$global->get_selectlist($form_selectlist_lang['service_order_reason'],$service_orderdetails_onservice_row['select_data'][$i]['service_order_reason']);
		$service_order_arr[$j]['service_order_usersowner_rel']=$global->get_selectlist($form_selectlist_lang['service_order_usersowner_rel'],$service_orderdetails_onservice_row['select_data'][$i]['service_order_usersowner_rel']);
		$id_tmp=$service_orderdetails_onservice_row['select_data'][$i]['service_order_id'];;
		$j++;
		}
	}
//print_r($service_order_arr);
*/
?>
