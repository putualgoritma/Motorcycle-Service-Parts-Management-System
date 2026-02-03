<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
//query
$search_field_arr=array("motorcycle_model_code","motorcycle_model_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>"",
'sort'=>"motorcycle_model_code ASC",
'join_match'=>"",
'join_id'=>""
);
$motorcycle_model_search_list=$global->tbl_search_list("motorcycle_model","motorcycle_model_code,motorcycle_model_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($motorcycle_model_search_list);$i++){
$result[$i]=$motorcycle_model_search_list[$i]['motorcycle_model_code']." - ".$motorcycle_model_search_list[$i]['motorcycle_model_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>