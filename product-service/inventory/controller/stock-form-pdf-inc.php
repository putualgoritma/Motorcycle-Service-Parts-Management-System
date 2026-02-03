<?
//register
if(isset($_REQUEST['warehouse_stock_register'])){
$warehouse_stock_register=$_REQUEST['warehouse_stock_register'];
} else if(isset($_POST['warehouse_stock_register'])){
$warehouse_stock_register=$_POST['warehouse_stock_register'];
}else{
$warehouse_stock_register=date("d/m/Y");
}
//get datenum
$valid_date_end=$global->valid_date($warehouse_stock_register);

//qry group & rack
$qry_product_group="";
if(isset($_REQUEST['category_code']) && $_REQUEST['category_code']!=""){
$qry_product_group=" WHERE category_code='".$_REQUEST['category_code']."'";
}
$qry_product_rack="";
if(isset($_REQUEST['rack_code']) && $_REQUEST['rack_code']!=""){
	if($qry_product_group==""){
	$qry_product_rack=" WHERE rack_code='".$_REQUEST['rack_code']."'";
	}else{
	$qry_product_rack=" AND rack_code='".$_REQUEST['rack_code']."'";
	}
}

//def product_fast_moving
$qry_product_fm="";
if($qry_product_group=="" && $qry_product_rack==""){
$qry_product_fm=" WHERE product_fast_moving='1'";
}

//stock details
$balance_first_arr=array();
$product_stock_arr=array();
$warehouse_stock_group_by=" warehouse_stock_details.product_code";

//num range
$range_list=$_REQUEST['num_range'];
$range_a=$range_list*1000;
$range_b=(($range_list+1)*1000)-1;
$qry_product_limit=" LIMIT ".$range_a.", ".$range_b;

$product_row=$global->db_qry_data("SELECT product_code,product_name,unit_code,rack_code
FROM product".$qry_product_group.$qry_product_rack.$qry_product_fm."
ORDER BY product_code ASC".$qry_product_limit);

//adjust
for($i=0;$i<count($product_row['select_data']);$i++){
	$balance_first_arr_index=$product_row['select_data'][$i]['product_code'];
	$product_stock_arr[$i]['product_code']=$product_row['select_data'][$i]['product_code'];
	$product_stock_arr[$i]['product_name']=$product_row['select_data'][$i]['product_name'];
	$product_stock_arr[$i]['rack_code']=$product_row['select_data'][$i]['rack_code'];
	$product_stock_arr[$i]['unit_code']=$product_row['select_data'][$i]['unit_code'];
	$warehouse_stock_row=$global->db_qry_data("SELECT 
	SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='in' OR warehouse_stock.warehouse_stock_type='opname') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_in,
	SUM(CASE WHEN warehouse_stock.warehouse_stock_type='out' THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_out,
	SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='trs' AND warehouse_stock.warehouse_stock_category='transfer_in') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_trs_in,
	SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='trs' AND warehouse_stock.warehouse_stock_category='transfer_out') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_trs_out
	FROM warehouse_stock_details
	JOIN warehouse_stock ON warehouse_stock.warehouse_stock_code = warehouse_stock_details.warehouse_stock_code 
	JOIN product ON warehouse_stock_details.product_code = product.product_code
	WHERE (warehouse_stock_details.warehouse_stock_details_status='pmn' AND warehouse_stock.warehouse_stock_registernum BETWEEN ".$valid_date_end['date_registernum']." AND ".$valid_date_end['date_registernum'].") AND warehouse_stock_details.product_code = '".$balance_first_arr_index."'"."
	GROUP BY".$warehouse_stock_group_by."
	ORDER BY warehouse_stock_details.product_code ASC");
	//print_r($warehouse_stock_row);
	//adjust
		$stock_balance=$warehouse_stock_row['select_data'][$i]['amount_in']+$warehouse_stock_row['select_data'][$i]['amount_trs_in']-$warehouse_stock_row['select_data'][$i]['amount_out']-$warehouse_stock_row['select_data'][$i]['amount_trs_out'];
		if(!isset($balance_first_arr[$balance_first_arr_index])){
			//get last PO
			$product_code_qry=" AND warehouse_stock_details.product_code = '".$balance_first_arr_index."'";
			$balance_first_def=0;
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
			WHERE (warehouse_stock_details.warehouse_stock_details_status='pmn' AND warehouse_stock.warehouse_stock_registernum < ".$valid_date_end['date_registernum'].")".$product_code_qry."
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
		
		$product_stock_arr[$i]['stock_first']=$stock_balance_first;
		$product_stock_arr[$i]['stock_in']=$warehouse_stock_row['select_data'][$i]['amount_in']*+$warehouse_stock_row['select_data'][$i]['amount_trs_in'];
		$product_stock_arr[$i]['stock_out']=$warehouse_stock_row['select_data'][$i]['amount_out']+$warehouse_stock_row['select_data'][$i]['amount_trs_out'];
		$product_stock_arr[$i]['stock_last']=$stock_balance_last;
	}
	//print_r($product_stock_arr);
?>
