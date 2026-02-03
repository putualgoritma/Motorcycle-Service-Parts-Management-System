<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
//default view
$search_value="";
$sort_value="product_id DESC";
$pageset_value=0;
$per_page_value=10;

//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
//query
$search_field_arr=array("product_code","product_name");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>""
);
$product_search_list=$global->tbl_search_list("product","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

$result="";
for($i=0;$i<count($product_search_list);$i++){
$str_addon="";
if($i>0){
	$str_addon=";";
	}
$result.=$str_addon.$product_search_list[$i]['product_id']." - ".$product_search_list[$i]['product_code']." - ".$product_search_list[$i]['product_name']." - ".$product_search_list[$i]['product_sprice']." - ".$product_search_list[$i]['product_stock'];
}
echo $result;

//echo json_encode($result);
//echo "lol";
?>