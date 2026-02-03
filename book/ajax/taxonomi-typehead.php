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

//echo $qry_str_sort;
$toReturn = array();
foreach($taxonomi_search_list as $key => $value) {
$toReturn[$key] = $taxonomi_search_list[$key]['taxonomi_code']." - ".$taxonomi_search_list[$key]['taxonomi_name'];
}
echo json_encode($toReturn);
?>