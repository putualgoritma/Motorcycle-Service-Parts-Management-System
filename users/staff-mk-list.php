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
//set search array 
$search_field_arr=array("staff_code","staff_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"",
'join_match'=>"",
'join_id'=>"",
'join_tbl'=>array("position"),
'join_type'=>array("INNER JOIN"),
'join_key'=>array("position_code"),
'join_tbl_field'=>array("position_name,position_code"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array("position.position_code = 'MK'"),
);
$staff_search_list=$global->tbl_searchjoin_list("staff","staff.*,position.position_name,position.position_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);


for($i=0;$i<count($staff_search_list);$i++){
$result[$i]=$staff_search_list[$i]['staff_code']." - ".$staff_search_list[$i]['staff_name'];
//$result[$i]=$staff_search_list[$i]['staff_id']." - ".$staff_search_list[$i]['staff_id'];
}
//echo $qry_str_sort;
//print_r($result);
$result = array_map('utf8_encode', $result);
echo json_encode($result);
?>