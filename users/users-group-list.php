<? $path="../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
//query
$search_field_arr=array("users_group_code","users_group_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>"",
'sort'=>"users_group_code ASC",
'join_match'=>"",
'join_id'=>""
);
$users_group_search_list=$global->tbl_search_list("users_group","users_group_code,users_group_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($users_group_search_list);$i++){
$result[$i]=$users_group_search_list[$i]['users_group_code']." - ".$users_group_search_list[$i]['users_group_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>