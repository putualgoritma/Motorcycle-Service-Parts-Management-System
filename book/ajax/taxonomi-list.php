<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$search_value="";
$qry_type="";
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
//if search
if (isset($_REQUEST['stype'])){
$qry_type=" AND taxonomi_type='".$_REQUEST['stype']."'";
}
//query
$search_field_arr=array("taxonomi_code","taxonomi_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"taxonomi_code ASC",
'join_match'=>" AND taxonomi_postable='0'".$qry_type,
'join_id'=>""
);
$taxonomi_search_list=$global->tbl_search_list("taxonomi","taxonomi_code,taxonomi_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

$toReturn = array_map('encode_all_strings', $taxonomi_search_list);
function encode_all_strings($arr) {
    foreach($arr as $key => $value) {
        $arr[$key] = utf8_encode($value);
    }
    return $arr;
}
echo json_encode($toReturn);
?>