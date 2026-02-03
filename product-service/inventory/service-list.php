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
$search_field_arr=array("service_code","service_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"service_code ASC",
'join_match'=>"",
'join_id'=>""
);
$service_search_list=$global->tbl_search_list("service","service_code,service_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($service_search_list);$i++){
$result[$i]=$service_search_list[$i]['service_code']." - ".$service_search_list[$i]['service_name'];
}
//echo $qry_str_sort;
//print_r($result);
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>