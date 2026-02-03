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
//set search array 
$search_field_arr=array("motorcycle.motorcycle_code","users.users_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"",
'join_match'=>"",
'join_id'=>"",
'join_tbl'=>array("users"),
'join_type'=>array("LEFT JOIN"),
'join_key'=>array("users_code"),
'join_tbl_field'=>array("users_name,users_code"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);
$motorcycle_search_list=$global->tbl_searchjoin_list("motorcycle","motorcycle.*,users.users_name,users.users_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($motorcycle_search_list);$i++){
$result[$i]=$motorcycle_search_list[$i]['motorcycle_code']." - ".$motorcycle_search_list[$i]['users_name'];
}
//echo $qry_str_sort;
//print_r($result);
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>