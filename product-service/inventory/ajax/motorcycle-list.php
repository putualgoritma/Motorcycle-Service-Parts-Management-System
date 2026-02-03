<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
//default view
$search_value="";
$sort_value="motorcycle_id DESC";
$pageset_value=0;
$per_page_value=10;

//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
//query
$search_field_arr=array("motorcycle_code","users_name");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>"",
'join_tbl'=>array("users"),
'join_type'=>array("LEFT JOIN"),
'join_key'=>array("users_code"),
'join_tbl_field'=>array("users_name,users_code,users_address"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);
$motorcycle_search_list=$global->tbl_searchjoin_list("motorcycle","motorcycle.*,users.users_name,users.users_code,users.users_address",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

$toReturn = array_map('encode_all_strings', $motorcycle_search_list);
function encode_all_strings($arr) {
    foreach($arr as $key => $value) {
        $arr[$key] = utf8_encode($value);
    }
    return $arr;
}
echo json_encode($toReturn);
?>