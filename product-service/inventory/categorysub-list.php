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
$categorysub_type=$_REQUEST['categorysub_type'];
$search_field_arr=array("categorysub_code","categorysub_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"categorysub_code ASC",
'join_match'=>" AND categorysub_type='".$categorysub_type."'",
'join_id'=>""
);
$categorysub_search_list=$global->tbl_search_list("categorysub","categorysub_code,categorysub_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($categorysub_search_list);$i++){
$result[$i]=$categorysub_search_list[$i]['categorysub_code']." - ".$categorysub_search_list[$i]['categorysub_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>