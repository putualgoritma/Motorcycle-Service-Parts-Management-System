<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
//default view
$search_value="";
$sort_value="users_id DESC";
$pageset_value=0;
$per_page_value=10;

//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
//query
$search_field_arr=array("users_code","users_name","users_address","users_phone");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND users_type ='customer'",
'join_id'=>""
);
$users_search_list=$global->tbl_search_list("users","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

$toReturn = array_map('encode_all_strings', $users_search_list);
function encode_all_strings($arr) {
    foreach($arr as $key => $value) {
        $arr[$key] = utf8_encode($value);
    }
    return $arr;
}
echo json_encode($toReturn);
?>