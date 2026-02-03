<? $path="../"; ?>
<? include ("../controller/config-lite-inc.php"); ?>
<? //include ("../controller/login-sessi.php"); ?>
<?php
$search_value="";
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
//query
$search_field_arr=array("taxonomi_code","taxonomi_name");
$def_arr=array(
'pageset'=>0,
'per_page'=>10,
'keyword'=>$search_value,
'sort'=>"taxonomi_code ASC",
'join_match'=>" AND taxonomi_postable='0'",
'join_id'=>""
);
$taxonomi_search_list=$global->tbl_search_list("taxonomi","taxonomi_code,taxonomi_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
for($i=0;$i<count($taxonomi_search_list);$i++){
$result[$i]=$taxonomi_search_list[$i]['taxonomi_code']." - ".$taxonomi_search_list[$i]['taxonomi_name'];
}
echo json_encode($result);
?>