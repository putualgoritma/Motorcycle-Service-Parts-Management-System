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
$search_field_arr=array("rack_code","rack_description");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"rack_code ASC",
'join_match'=>"",
'join_id'=>""
);
$rack_search_list=$global->tbl_search_list("rack","rack_code,rack_description",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($rack_search_list);$i++){
$result[$i]=$rack_search_list[$i]['rack_code']." - ".$rack_search_list[$i]['rack_description'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>