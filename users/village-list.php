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
$search_field_arr=array("village_code","village_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"village_code ASC",
'join_match'=>"",
'join_id'=>""
);
$village_search_list=$global->tbl_search_list("village","village_code,village_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($village_search_list);$i++){
$result[$i]=$village_search_list[$i]['village_code']." - ".$village_search_list[$i]['village_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>