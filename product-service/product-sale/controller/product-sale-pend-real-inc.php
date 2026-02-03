<?
if (isset($_REQUEST['product_order_id'])){
$product_order_id=$_REQUEST['product_order_id'];
}else{
$product_order_id=0;
}
$product_order_row=$global->db_row_join("product_order,users","product_order.*,users.users_name,users.users_code","product_order_id = '".$product_order_id."' AND product_order.users_code=users.users_code");
$product_orderdetails_row=$global->db_row("product_orderdetails","SUM(product_orderdetails_total) AS product_orderdetails_total","product_order_id='".$product_order_id."' AND product_orderdetails_status = 'pmn' GROUP BY product_order_id");
$product_orderdetails_total=$product_orderdetails_row['product_orderdetails_total'];
$author_row=$global->db_row("contact","contact_code,contact_name","contact_id='".$product_order_row['contact_code']."' AND contact_type = 'author'");
$product_order_amount=$product_orderdetails_total+$product_order_row['product_order_tax_val']+$product_order_row['product_order_cost'];
//format
$product_order_tax_val_format=$global->num_format2($product_order_row['product_order_tax_val']);
$product_orderdetails_total_format=$global->num_format2($product_orderdetails_total);
$product_order_amount_format=$global->num_format2($product_order_amount);
?>
