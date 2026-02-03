<?
//warehouse_stock_id
if (isset($_REQUEST['warehouse_stock_id'])){
$warehouse_stock_id=$_REQUEST['warehouse_stock_id'];
}else{
$warehouse_stock_id=0;
}
//row edit
$warehouse_stock_row=$global->db_row_join("warehouse_stock,warehouse","warehouse_stock.*,warehouse.warehouse_name","warehouse_stock_id = '".$warehouse_stock_id."' AND warehouse_stock.warehouse_code=warehouse.warehouse_code");
$warehouse_stock_code=$warehouse_stock_row['warehouse_stock_code'];
$warehouse_stock_details_row=$global->db_qry_data("SELECT warehouse_stock_details.*,product.product_name,product.product_code,product.product_bprice
FROM warehouse_stock_details
JOIN product ON warehouse_stock_details.product_code=product.product_code 
WHERE warehouse_stock_details.warehouse_stock_code = '".$warehouse_stock_code."'
ORDER BY warehouse_stock_details.product_code ASC");
//get in or out txt
$warehouse_stock_type_txt="STOCK MASUK";
if($warehouse_stock_row['warehouse_stock_type']=="out"){
	$warehouse_stock_type_txt="STOCK KELUAR";
	}
if($warehouse_stock_row['warehouse_stock_type']=="trs"){
	$warehouse_stock_type_txt="STOCK TRANSFER";
	}
if($warehouse_stock_row['warehouse_stock_type']=="opname"){
	$warehouse_stock_type_txt="STOCK OPNAME";
	}
//print_r($warehouse_stock_details_row);
?>
