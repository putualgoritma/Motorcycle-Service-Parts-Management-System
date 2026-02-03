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
$category_type=$_REQUEST['category_type'];
$search_field_arr=array("category_code","category_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"category_code ASC",
'join_match'=>" AND category_type='".$category_type."'",
'join_id'=>""
);
$category_search_list=$global->tbl_search_list("category","category_code,category_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($category_search_list);$i++){
$result[$i]=$category_search_list[$i]['category_code']." - ".$category_search_list[$i]['category_name'];
}
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>