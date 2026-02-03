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
//query
$search_field_arr=array("product_code","product_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"product_code ASC",
'join_match'=>"",
'join_id'=>""
);
$product_search_list=$global->tbl_search_list("product","product_code,product_name,product_stock",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($product_search_list);$i++){
$result[$i]=$product_search_list[$i]['product_code']." - ".$product_search_list[$i]['product_name']." - (".intval($product_search_list[$i]['product_stock']).")";
}
//echo $qry_str_sort;
//print_r($result);
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>