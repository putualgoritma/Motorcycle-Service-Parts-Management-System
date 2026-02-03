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
$search_field_arr=array("motorcycle_type_code","motorcycle_type_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"motorcycle_type_code ASC",
'join_match'=>"",
'join_id'=>""
);
$motorcycle_type_search_list=$global->tbl_search_list("motorcycle_type","motorcycle_type_code,motorcycle_type_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($motorcycle_type_search_list);$i++){
$result[$i]=$motorcycle_type_search_list[$i]['motorcycle_type_code']." - ".$motorcycle_type_search_list[$i]['motorcycle_type_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>