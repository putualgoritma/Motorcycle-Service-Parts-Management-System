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
$search_field_arr=array("education_code","education_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"education_code ASC",
'join_match'=>"",
'join_id'=>""
);
$education_search_list=$global->tbl_search_list("education","education_code,education_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($education_search_list);$i++){
$result[$i]=$education_search_list[$i]['education_code']." - ".$education_search_list[$i]['education_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>