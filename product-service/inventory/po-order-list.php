<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
$search_value="";
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
//default view
$pageset_value=0;
$per_page_value=0;
$sort_value="product_order.product_order_registernum DESC, product_order.product_order_id DESC";
$users_code_value="";

//array set
$search_field_arr=array("product_order.product_order_description","product_order.product_order_code","users.users_name");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND product_order.product_order_type = 'po' GROUP BY product_order.product_order_id",
'join_id'=>"",
'join_tbl'=>array("users"),
'join_type'=>array("LEFT JOIN"),
'join_key'=>array("users_code"),
'join_tbl_field'=>array("users_code,users_name"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);
$product_order_search_list=$global->tbl_searchjoin_list("product_order","product_order.*,users.users_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($product_order_search_list);$i++){
$result[$i]=$product_order_search_list[$i]['product_order_code']." - ".$product_order_search_list[$i]['users_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>