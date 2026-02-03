<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
//query
$search_field_arr=array("product_code","product_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>"",
'sort'=>"product_code ASC",
'join_match'=>"",
'join_id'=>""
);
$product_search_list=$global->tbl_search_list("product","product_code,product_name,product_sprice",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($product_search_list);$i++){
$result[$i]=$product_search_list[$i]['product_code']." - ".$product_search_list[$i]['product_name']." - ".$product_search_list[$i]['product_sprice'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>