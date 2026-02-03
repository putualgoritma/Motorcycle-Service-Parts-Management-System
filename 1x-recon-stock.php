<?
$path = "";
include "controller/config-inc.php";

//query product_orderdetails 'pmn'
$product_orderdetails_row = $global->db_qry_data("SELECT product_orderdetails.*,product_order.product_order_code
FROM product_orderdetails 
INNER JOIN product_order ON product_orderdetails.product_order_id=product_order.product_order_id
WHERE product_orderdetails.product_orderdetails_status='pmn' AND product_order.product_order_status='pmn'
ORDER BY product_orderdetails.product_orderdetails_id ASC");
for ($i = 0; $i < count($product_orderdetails_row['select_data']); $i++) {
//if not exist in warehouse_stock_details => echo
    if (! $global->tbldata_exist("warehouse_stock_details", "warehouse_stock_details_id", "warehouse_stock_code='" . $product_orderdetails_row['select_data'][$i]['product_order_code'] . "' AND product_code='" . $product_orderdetails_row['select_data'][$i]['product_code'] . "' AND warehouse_stock_details_status='pmn'")) {
        echo "not exist in warehouse_stock_details : " . $product_orderdetails_row['select_data'][$i]['product_order_code'] . " :: " . $product_orderdetails_row['select_data'][$i]['product_code'];
        echo "</br>";
    }
//if not exist in  warehouse_stock => echo
    if (! $global->tbldata_exist("warehouse_stock", "warehouse_stock_id", "warehouse_stock_code='" . $product_orderdetails_row['select_data'][$i]['product_order_code'] . "' AND warehouse_stock_status='pmn'")) {
        echo "not exist in  warehouse_stock : " . $product_orderdetails_row['select_data'][$i]['product_order_code'];
        echo "</br>";
    }
}
