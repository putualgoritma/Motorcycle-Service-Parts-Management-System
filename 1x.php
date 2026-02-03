<?
$path="";
include ("controller/config-inc.php");

/* 1x product_order_type */
//loop product_order
$product_order_row=$global->db_qry_data("SELECT *
FROM product_order
ORDER BY product_order_id ASC");
	for($i=0;$i<count($product_order_row['select_data']);$i++){
	$product_order_type=$product_order_row['select_data'][$i]['product_order_type'];
	$product_order_status=$product_order_row['select_data'][$i]['product_order_status'];
	$product_order_status_val="tmp";
	if($product_order_status!="tmp"){
		$product_order_status_val="pmn";
		}
	$product_order_type_val=$product_order_status;
	if($product_order_type==2){
		$product_order_type_val="pr";
		}
	if($product_order_type==3){
		$product_order_type_val="sr";
		}
	if(($product_order_status=="tmp" || $product_order_status=="pmn")){
		if($product_order_type==1){
		$product_order_type_val="si";
		}
		if($product_order_type==0){
		$product_order_type_val="pi";
		}}
	//loop product_orderdetails
		$db_select = $global->db_select("product_orderdetails","*","product_order_id='".$product_order_row['select_data'][$i]['product_order_id']."'","",0,0);
		$select_data=$db_select['select_data'];
		for($j=0;$j<$db_select['select_num'];$j++){
		//update status & type
		$update_arr = array(
		'product_orderdetails_status'=>	$product_order_status_val,
		'product_orderdetails_type'=>	$product_order_type_val,
		);
		$global->db_update("product_orderdetails",$update_arr,"product_orderdetails_id='".$select_data[$j]['product_orderdetails_id']."'");
		}
	//update status & type
	$update_arr = array(
	'product_order_status'=>	$product_order_status_val,
	'product_order_type'=>	$product_order_type_val,
	);
	$global->db_update("product_order",$update_arr,"product_order_id='".$product_order_row['select_data'][$i]['product_order_id']."'");
	}
//loop service_order
$service_order_row=$global->db_qry_data("SELECT *
FROM service_order
ORDER BY service_order_id ASC");
	for($i=0;$i<count($service_order_row['select_data']);$i++){
	$service_order_type=$service_order_row['select_data'][$i]['service_order_type'];
	$service_order_status=$service_order_row['select_data'][$i]['service_order_status'];
	$service_order_status_val="pmn";
	$service_order_type_val="si";
	if($service_order_type!=1){
		$service_order_type_val="pi";
		}
	if($service_order_status!="pmn"){
		$service_order_status_val="tmp";
		}
	//loop service_orderdetails
		$db_select = $global->db_select("service_orderdetails","*","service_order_id='".$service_order_row['select_data'][$i]['service_order_id']."'","",0,0);
		$select_data=$db_select['select_data'];
		for($j=0;$j<$db_select['select_num'];$j++){
		//update status & type
		$update_arr = array(
		'service_orderdetails_type'=>	$service_order_type_val,
		);
		$global->db_update("service_orderdetails",$update_arr,"service_orderdetails_id='".$select_data[$j]['service_orderdetails_id']."'");
		}
	//loop product_orderdetails
		$db_select = $global->db_select("product_orderdetails","*","service_order_id='".$service_order_row['select_data'][$i]['service_order_id']."'","",0,0);
		$select_data=$db_select['select_data'];
		for($j=0;$j<$db_select['select_num'];$j++){
		//update status & type
		$update_arr = array(
		'product_orderdetails_status'=>	$service_order_status_val,
		'product_orderdetails_type'=>	$service_order_type_val,
		);
		$global->db_update("product_orderdetails",$update_arr,"product_orderdetails_id='".$select_data[$j]['product_orderdetails_id']."'");
		}
	//update status & type
	$update_arr = array(
	'service_order_type'=>	$service_order_type_val,
	);
	$global->db_update("service_order",$update_arr,"service_order_id='".$service_order_row['select_data'][$i]['service_order_id']."'");
	}
?>