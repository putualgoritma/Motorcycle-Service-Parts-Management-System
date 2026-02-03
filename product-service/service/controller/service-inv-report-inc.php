<?
//service_order_id
if (isset($_REQUEST['service_order_id'])){
$service_order_id=$_REQUEST['service_order_id'];
}else{
$service_order_id=0;
}
//row edit
$log_name = $contact_glob['contact_name'];

$service_order_row=$global->db_row_join("service_order,users","service_order.*,users.users_name,users.users_code","service_order_id = '".$service_order_id."' AND service_order.users_code=users.users_code");
$service_orderdetails_row=$global->db_row("service_orderdetails","SUM(service_orderdetails_total) AS service_orderdetails_total","service_order_id='".$service_order_id."' GROUP BY service_order_id");
$product_orderdetails_row=$global->db_row("product_orderdetails","SUM(product_orderdetails_total) AS product_orderdetails_total","service_order_id='".$service_order_id."' GROUP BY service_order_id");
$service_orderdetails_total=$service_orderdetails_row['service_orderdetails_total']+$product_orderdetails_row['product_orderdetails_total'];
$service_order_amount=($service_orderdetails_total+$service_order_row['service_order_tax_val']+$service_order_row['service_order_cost'])-($service_order_row['service_order_kpb_service']+$service_order_row['service_order_kpb_product']);

//contact code
$contact_row=$global->db_row("contact","contact_code,contact_name","contact_code='".$service_order_row['contact_code']."'");
$contact_code="";
if($contact_row['contact_code']!=""){
	$contact_code=$contact_row['contact_name'];
	}
	
//author code
$author_row=$global->db_row("contact","contact_code,contact_name","contact_id='".$service_order_row['contact_code']."' AND contact_type = 'author'");
$author_code="";
if($author_row['contact_code']!=""){
	$author_code=$author_row['contact_code']." - ".$author_row['contact_name'];
	}
//staff code
$staff_row=$global->db_row("staff","staff_code,staff_name","staff_code='".$service_order_row['staff_code']."'");
$staff_code="";
if($staff_row['staff_code']!=""){
	$staff_code=$staff_row['staff_name'];
	}
//motorcycle code
$motorcycle_row=$global->db_row("motorcycle","*","motorcycle_code = '".$service_order_row['motorcycle_code']."'");
$users_row=$global->db_row("users","users_name,users_code","users_code = '".$motorcycle_row['users_code']."'");
$users_name=$users_row['users_name'];
$motorcycle_code="";
if($motorcycle_row['motorcycle_code']!=""){
	$motorcycle_code=$motorcycle_row['motorcycle_code']." - ".$users_name;
	}
//motorcycle
$motorcycle_frame_no=$motorcycle_row['motorcycle_frame_no']."/".$motorcycle_row['motorcycle_machine_no'];
$color_name=$global->product_order->db_fldrow("color","color_name","color_code='".$motorcycle_row['color_code']."'");
$motorcycle_type_row=$global->product_order->db_row("motorcycle_type","*","motorcycle_type_code='".$motorcycle_row['motorcycle_type_code']."'");
$motorcycle_type_name=$motorcycle_type_row['motorcycle_type_name']?$motorcycle_type_row['motorcycle_type_name']:$motorcycle_row['motorcycle_type_code'];//$motorcycle_type_row['motorcycle_type_name']
$motorcycle_type_name=$motorcycle_type_name."/".$color_name."/".$motorcycle_row['motorcycle_manufacture'];
$motorcycle_type_code=$motorcycle_type_row['motorcycle_type_code']." - ".$motorcycle_type_row['motorcycle_type_name'];
//format
$service_order_tax_val_format=$global->num_format2($service_order_row['service_order_tax_val']);
$service_orderdetails_total_format=$global->num_format2($service_orderdetails_total);
$service_order_amount_format=$global->num_format2($service_order_amount);
//user code
$users_row=$global->product_order->db_row("users","*","users_code='".$service_order_row['users_code']."'");
$users_code="";
if($users_row['users_code']!=""){
	$users_code=$users_row['users_code']." - ".$users_row['users_name'];
	}
//get check in hours
if($service_order_row['service_order_check_in']!=""){
$date_time_obj = new DateTime($service_order_row['service_order_check_in']);
$check_in_h=$date_time_obj->format('G').":".$date_time_obj->format('i');
}else{
$date_time_obj = new DateTime(date('Y-m-d G:i:s'));
$check_in_h=$date_time_obj->format('G').":".$date_time_obj->format('i');
}
?>
