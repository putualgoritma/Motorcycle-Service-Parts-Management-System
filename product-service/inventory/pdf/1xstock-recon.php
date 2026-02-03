<? $path="../../../"; ?>
<? include ($path."controller/config-inc.php"); ?>
<?
$balance_stock_arr=array();
/*
$product_row=$global->db_qry_data("SELECT product_code,product_stock
FROM product
ORDER BY product_code ASC");
*/
$product_row=$global->db_qry_data("SELECT DISTINCT product_code FROM warehouse_stock_details ORDER BY product_code ASC");
//adjust
$warehouse_code=$global->product_order->db_fldrow("warehouse","warehouse_code","warehouse_default='1'");
for($i=0;$i<count($product_row['select_data']);$i++){
	$product_code=$product_row['select_data'][$i]['product_code'];
	$product_stock=$global->product_order->db_fldrow("product","product_stock","product_code='".$product_code."'");
	//get stock balance
	$balance_amount=0;
	$balance_stock_qry="SELECT warehouse_stock_details.product_code,
		SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='in' OR warehouse_stock.warehouse_stock_type='opname') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_in,
SUM(CASE WHEN warehouse_stock.warehouse_stock_type='out' THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_out,
SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='trs' AND warehouse_stock.warehouse_stock_category='transfer_in') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_trs_in,
SUM(CASE WHEN (warehouse_stock.warehouse_stock_type='trs' AND warehouse_stock.warehouse_stock_category='transfer_out') THEN warehouse_stock_details.warehouse_stock_details_quantity ELSE 0 END) amount_trs_out
		FROM warehouse_stock_details
		JOIN warehouse_stock ON warehouse_stock.warehouse_stock_code = warehouse_stock_details.warehouse_stock_code 
		JOIN product ON warehouse_stock_details.product_code = product.product_code
		WHERE warehouse_stock_details.warehouse_stock_details_status='pmn' AND product.product_code='".$product_code."'
		GROUP BY warehouse_stock_details.product_code
		ORDER BY warehouse_stock_details.product_code ASC";
	$balance_stock_row=$global->db_qry_data($balance_stock_qry);
	if(count($balance_stock_row['select_data'])>0){
		$balance_amount=$balance_stock_row['select_data'][0]['amount_in']+$balance_stock_row['select_data'][0]['amount_trs_in']-$balance_stock_row['select_data'][0]['amount_out']-$balance_stock_row['select_data'][0]['amount_trs_out'];
		}
	//if $product_stock != $balance_amount
	if($product_stock != $balance_amount){
			//update product
			$update_arr = array(
			'product_stock'=>	$balance_amount,
			);
			$global->db_update("product",$update_arr,"product_code='".$product_code."'");
		}
	}
?>
