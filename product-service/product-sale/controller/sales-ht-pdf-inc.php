<?
//product_order_id
if (isset($_REQUEST['product_order_id'])){
$product_order_id=$_REQUEST['product_order_id'];
}else{
$product_order_id="";
}
//row edit
$product_order_row=$global->db_row_join("product_order,users","product_order.*,users.users_name,users.users_code","product_order_id = '".$product_order_id."' AND product_order.users_code=users.users_code");

$product_orderdetails_row=$global->db_qry_data("SELECT product_orderdetails.*,product.product_name,product.unit_code
FROM product_order
LEFT JOIN product_orderdetails ON product_order.product_order_id = product_orderdetails.product_order_id
LEFT JOIN product ON product_orderdetails.product_code = product.product_code
WHERE product_order.product_order_id='".$product_order_id."'
ORDER BY product_orderdetails.product_orderdetails_id ASC");
//print_r($product_orderdetails_row['select_data']);
//user code
$users_row=$global->product_order->db_row("users","*","users_code='".$product_order_row['users_code']."'");
?>
