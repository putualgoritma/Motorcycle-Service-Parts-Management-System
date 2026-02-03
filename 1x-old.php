<?
$path="";
include ("controller/config-inc.php");

/* Reset all SO */
$product_order_row=$global->db_qry_data("SELECT *
FROM product
WHERE product_stock_so<0
ORDER BY product_id ASC");
for($i=0;$i<count($product_order_row['select_data']);$i++){
	$update_arr = array(
	'product_stock_so'=>	0,
	);
	//print_r($update_arr);
	$global->db_update("product",$update_arr,"product_code='".$product_order_row['select_data'][$i]['product_code']."'");
	}
	
/* Reset all PO */
$product_order_row=$global->db_qry_data("SELECT *
FROM product
WHERE product_stock_po<0
ORDER BY product_id ASC");
for($i=0;$i<count($product_order_row['select_data']);$i++){
	$update_arr = array(
	'product_stock_po'=>	0,
	);
	//print_r($update_arr);
	$global->db_update("product",$update_arr,"product_code='".$product_order_row['select_data'][$i]['product_code']."'");
	}

/* Reset active SO */
$product_orderdetails_row=$global->db_qry_data("SELECT product_code,product_orderdetails_type,product_orderdetails_status,
SUM(product_orderdetails_quantity) amount_in
FROM product_orderdetails
WHERE product_orderdetails.product_orderdetails_status='tmp' AND (product_orderdetails.product_orderdetails_type ='sale' OR product_orderdetails.product_orderdetails_type ='buy_retur')
GROUP BY product_orderdetails.product_code
ORDER BY product_orderdetails.product_orderdetails_id ASC");
	for($i=0;$i<count($product_orderdetails_row['select_data']);$i++){
	$product_stock_so=$product_orderdetails_row['select_data'][$i]['amount_in'];
	if($product_stock_so<0){
		$product_stock_so=0;
		}
	//update items
	$update_arr = array(
	'product_stock_so'=>	$product_stock_so,
	);
	//print_r($update_arr);
	$global->db_update("product",$update_arr,"product_code='".$product_orderdetails_row['select_data'][$i]['product_code']."'");
	}
	
/* Reset active PO */
$product_orderdetails_row=$global->db_qry_data("SELECT product_orderdetails_id,product_code,product_orderdetails_type,product_orderdetails_status,product_orderdetails_po_status,
product_orderdetails_quantity
FROM product_orderdetails
WHERE (product_orderdetails_po_status!='closed' AND product_orderdetails.product_orderdetails_status='po') OR (product_orderdetails.product_orderdetails_status='tmp' AND (product_orderdetails.product_orderdetails_type ='buy' OR product_orderdetails.product_orderdetails_type ='sale_retur'))
ORDER BY product_orderdetails.product_code ASC");
	//init set
	$product_code_old="";
	$product_stock_po_old=0;
	for($i=0;$i<count($product_orderdetails_row['select_data']);$i++){
	//get current PO
	$product_stock_po_amount=$product_orderdetails_row['select_data'][$i]['product_orderdetails_quantity'];
	$sum_po_real_row=$global->db_qry_data("SELECT 
	IFNULL(SUM(product_orderdetails_po_real.product_orderdetails_po_qty), 0) AS sum_po_qty
	FROM product_orderdetails_po_real
	WHERE product_orderdetails_po_real.product_orderdetails_id='".$product_orderdetails_row['select_data'][$i]['product_orderdetails_id']."'
	GROUP BY product_orderdetails_po_real.product_orderdetails_id
	ORDER BY product_orderdetails_po_real.product_orderdetails_id ASC");
	if($sum_po_real_row['select_num']>0){
		$product_stock_po_amount -=$sum_po_real_row['select_data'][0]['sum_po_qty'];
		}
	if($product_code_old!="" && $product_code_old!=$product_orderdetails_row['select_data'][$i]['product_code']){
		//update items
		$update_arr = array(
		'product_stock_po'=>	$product_stock_po_old,
		);
		//print_r($update_arr);
		$global->db_update("product",$update_arr,"product_code='".$product_code_old."'");
		//reset
		$product_stock_po_old=$product_stock_po_amount;
		}else{
		$product_stock_po_old +=$product_stock_po_amount;
		}
	$product_code_old=$product_orderdetails_row['select_data'][$i]['product_code'];
	}
	

/* 1x init stock */
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
	//echo $balance_stock_qry;
	$balance_stock_row=$global->db_qry_data($balance_stock_qry);
	if(count($balance_stock_row['select_data'])>0){
		$balance_amount=$balance_stock_row['select_data'][0]['amount_in']+$balance_stock_row['select_data'][0]['amount_trs_in']-$balance_stock_row['select_data'][0]['amount_out']-$balance_stock_row['select_data'][0]['amount_trs_out'];
		}
	//if $product_stock != $balance_amount
	if($product_stock != $balance_amount){
		$product_stock_init=$product_stock-$balance_amount;
		$warehouse_stock_register="01/01/2018";
		$warehouse_stock_registernum="20180101";
		$warehouse_stock_monthnum="201801";
		
		$warehouse_stock_code=$global->product_order->generator_warehouse_stock_init_code("init",$warehouse_stock_monthnum);
		//insert product_order
		$insert_arr = array(
		'warehouse_stock_description'=>	"Stock Init",
		'warehouse_stock_code'=>	$warehouse_stock_code,
		'warehouse_code'=>	$warehouse_code,
		'warehouse_stock_type'=>	'in',
		'warehouse_stock_status'=>	'pmn',
		'warehouse_stock_register'=>	$warehouse_stock_register,
		'warehouse_stock_registernum'=>	$warehouse_stock_registernum,
		'warehouse_stock_category'=>	'trs_in',
		);
		//print_r($insert_arr);
		
		//insert
		if(!$global->product_order->create_warehouse_stock($insert_arr)){
			$global->product_order->error_message($global->product_order->err_msg);
			}else{
			$warehouse_stock_id=$global->db_lastid("warehouse_stock","warehouse_stock_id");
			//insert product_order details
			
			$insert_arr = array(
			'warehouse_stock_code'=>	$warehouse_stock_code,
			'warehouse_stock_details_quantity'=>	$product_stock_init,
			'product_code'=>	$product_code,
			);
			//print_r($insert_arr);
			
			$global->db_insert("warehouse_stock_details",$insert_arr);
			
			//update product
			$update_arr = array(
			'product_stock'=>	$product_stock,
			);
			//print_r($update_arr);
			
			$global->db_update("product",$update_arr,"product_code='".$product_code."'");
			}
			
		}
	}
/* 1x payreceivable_details 
$payreceivable_details_row=$global->db_qry_data("SELECT *
FROM payreceivable_details");
	for($i=0;$i<count($payreceivable_details_row['select_data']);$i++){
		$payreceivable_rel_id=$payreceivable_details_row['select_data'][$i]['payreceivable_id'];
		$payreceivable_code=$payreceivable_details_row['select_data'][$i]['payreceivable_code'];
		$payreceivable_id=$global->db_fldrow("payreceivable","payreceivable_id","payreceivable_code='".$payreceivable_code."'","");
		//update status to closed
		$update_arr = array(
		'payreceivable_id'=>	$payreceivable_id,
		'payreceivable_rel_id'=>	$payreceivable_rel_id,
		);
		$global->db_update("payreceivable_details",$update_arr,"payreceivable_details_id='".$payreceivable_details_row['select_data'][$i]['payreceivable_details_id']."'");
	}
*/
?>