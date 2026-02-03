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
$search_field_arr=array("district_code","district_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"district_code ASC",
'join_match'=>"",
'join_id'=>""
);
$district_search_list=$global->tbl_search_list("district","district_code,district_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($district_search_list);$i++){
$result[$i]=$district_search_list[$i]['district_code']." - ".$district_search_list[$i]['district_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>