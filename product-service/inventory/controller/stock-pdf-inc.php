<?
//register
if(isset($_REQUEST['warehouse_stock_register'])){
$warehouse_stock_register_start=$_REQUEST['warehouse_stock_register_start'];
$warehouse_stock_register=$_REQUEST['warehouse_stock_register'];
} else if(isset($_POST['warehouse_stock_register'])){
$warehouse_stock_register_start=$_POST['warehouse_stock_register_start'];
$warehouse_stock_register=$_POST['warehouse_stock_register'];
}else{
$warehouse_stock_register_start=date("d/m/Y");
$warehouse_stock_register=date("d/m/Y");
}
//part
$product_code_qry="";
if(isset($_REQUEST['product_code'])){
$product_code_arr=explode(" - ",$_REQUEST['product_code']);
$product_code=$product_code_arr[0];
if($product_code!=""){
	$product_code_qry=" AND warehouse_stock_details.product_code = '".$product_code."'";
	}
} else if(isset($_POST['product_code'])){
$product_code_arr=explode(" - ",$_POST['product_code']);
$product_code=$product_code_arr[0];
if($product_code!=""){
	$product_code_qry=" AND warehouse_stock_details.product_code = '".$product_code."'";
	}
}else{
$product_code_qry="";
}
//get datenum
$valid_date_start=$global->valid_date($warehouse_stock_register_start);
$valid_date_end=$global->valid_date($warehouse_stock_register);
//echo $product_code_qry;

//stock details
$balance_first_arr=array();
$warehouse_stock_group_by=" warehouse_stock_details.product_code";
if($product_code_qry!=""){
	$warehouse_stock_group_by=" warehouse_stock.warehouse_stock_register";
	}
$warehouse_stock_row=$global->db_qry_data("SELECT warehouse_stock.warehouse_stock_register,warehouse_stock.warehouse_stock_code,warehouse_stock_details.product_code,product.product_name,
product.unit_code,product.product_bprice,
SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='in' OR warehouse_stock.warehouse_stock_type='opname') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_in,
SUM(CASE WHEN warehouse_stock.warehouse_stock_type='out' THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_out,
SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='trs' AND warehouse_stock.warehouse_stock_category='transfer_in') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_trs_in,
SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='trs' AND warehouse_stock.warehouse_stock_category='transfer_out') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_trs_out
FROM warehouse_stock_details
JOIN warehouse_stock ON warehouse_stock.warehouse_stock_code = warehouse_stock_details.warehouse_stock_code 
JOIN product ON warehouse_stock_details.product_code = product.product_code
WHERE (warehouse_stock_details.warehouse_stock_details_status='pmn' AND warehouse_stock.warehouse_stock_registernum BETWEEN ".$valid_date_start['date_registernum']." AND ".$valid_date_end['date_registernum'].")".$product_code_qry."
GROUP BY".$warehouse_stock_group_by."
ORDER BY warehouse_stock_details.product_code ASC");
//print_r($warehouse_stock_row);
//adjust
for($i=0;$i<count($warehouse_stock_row['select_data']);$i++){
	$stock_balance=$warehouse_stock_row['select_data'][$i]['amount_in']+$warehouse_stock_row['select_data'][$i]['amount_trs_in']-$warehouse_stock_row['select_data'][$i]['amount_out']-$warehouse_stock_row['select_data'][$i]['amount_trs_out'];
	$balance_first_arr_index=$warehouse_stock_row['select_data'][$i]['product_code'];
	if(!isset($balance_first_arr[$balance_first_arr_index])){
		//get last PO
		$product_code_qry=" AND warehouse_stock_details.product_code = '".$balance_first_arr_index."'";
		$balance_first_def=0;
		$wsd_opname_id_qry = "";
		$stock_balance_first=0;
		//get stock balance first
		$balance_first_stock_qry="SELECT warehouse_stock_details.product_code,
		SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='in' OR warehouse_stock.warehouse_stock_type='opname') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_in,
SUM(CASE WHEN warehouse_stock.warehouse_stock_type='out' THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_out,
SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='trs' AND warehouse_stock.warehouse_stock_category='transfer_in') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_trs_in,
SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='trs' AND warehouse_stock.warehouse_stock_category='transfer_out') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_trs_out
		FROM warehouse_stock_details
		JOIN warehouse_stock ON warehouse_stock.warehouse_stock_code = warehouse_stock_details.warehouse_stock_code 
		JOIN product ON warehouse_stock_details.product_code = product.product_code
		WHERE (warehouse_stock_details.warehouse_stock_details_status='pmn' AND warehouse_stock.warehouse_stock_registernum < ".$valid_date_start['date_registernum'].")".$product_code_qry.$wsd_opname_id_qry."
		GROUP BY warehouse_stock_details.product_code
		ORDER BY warehouse_stock_details.product_code ASC";
		//echo $balance_first_stock_qry;
		//echo "<br>";
		$balance_first_stock_row=$global->db_qry_data($balance_first_stock_qry);
		if(count($balance_first_stock_row['select_data'])>0){
			$stock_balance_first +=$balance_first_stock_row['select_data'][0]['amount_in']+$balance_first_stock_row['select_data'][0]['amount_trs_in']-$balance_first_stock_row['select_data'][0]['amount_out']-$balance_first_stock_row['select_data'][0]['amount_trs_out'];
			}
		//echo $stock_balance_first;
		//echo "<br>";
		}else{
		$stock_balance_first=$balance_first_arr[$balance_first_arr_index];
		}
	$stock_balance_last=$stock_balance_first+$stock_balance;
	$balance_first_arr[$balance_first_arr_index]=$stock_balance_last;
	
	$warehouse_stock_row['select_data'][$i]['stock_first']=$stock_balance_first;
	$warehouse_stock_row['select_data'][$i]['stock_first_amount']=$warehouse_stock_row['select_data'][$i]['stock_first']*$warehouse_stock_row['select_data'][$i]['product_bprice'];
	$warehouse_stock_row['select_data'][$i]['stock_in_amount']=$warehouse_stock_row['select_data'][$i]['amount_in']*$warehouse_stock_row['select_data'][$i]['product_bprice']+$warehouse_stock_row['select_data'][$i]['amount_trs_in']*$warehouse_stock_row['select_data'][$i]['product_bprice'];
	$warehouse_stock_row['select_data'][$i]['stock_out_amount']=$warehouse_stock_row['select_data'][$i]['amount_out']*$warehouse_stock_row['select_data'][$i]['product_bprice']+$warehouse_stock_row['select_data'][$i]['amount_trs_out']*$warehouse_stock_row['select_data'][$i]['product_bprice'];
	$warehouse_stock_row['select_data'][$i]['stock_last']=$stock_balance_last;
	$warehouse_stock_row['select_data'][$i]['stock_last_amount']=$stock_balance_last*$warehouse_stock_row['select_data'][$i]['product_bprice'];
	}
//print_r($warehouse_stock_row['select_data']);
?>
