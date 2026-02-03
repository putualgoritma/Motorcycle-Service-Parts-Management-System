<? $path="../"; ?>
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
$search_field_arr=array("staff_code","staff_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"staff_code ASC",
'join_match'=>"",
'join_id'=>""
);
$staff_search_list=$global->tbl_search_list("staff","staff_id,staff_code,staff_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($staff_search_list);$i++){
$result[$i]=$staff_search_list[$i]['staff_code']." - ".$staff_search_list[$i]['staff_name'];
//$result[$i]=$staff_search_list[$i]['staff_id']." - ".$staff_search_list[$i]['staff_id'];
}
//echo $qry_str_sort;
//print_r($result);
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>