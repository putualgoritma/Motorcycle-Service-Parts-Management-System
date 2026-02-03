<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
//default view
$search_value="";
$sort_value="product.product_id DESC";
$pageset_value=0;
$per_page_value=0;

//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}

if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
}

//slect order by
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
}

//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
}

//query
$search_field_arr=array("product.product_code","product.product_name","product.product_unit");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND product.product_stock < product.product_min_stock",
'join_id'=>"",
'join_tbl'=>array("unit","product_orderdetails"),
'join_type'=>array("INNER JOIN","LEFT JOIN"),
'join_key'=>array("unit_code","product_code"),
'join_tbl_field'=>array("unit_name,unit_code","product_code"),
'join_tbl_group'=>array(0,1),
'join_tbl_id'=>array("",""),
);
$product_search_list=$global->tbl_searchjoin_list("product","product.*,unit.unit_name,unit.unit_code,(product.product_stock) AS product_estquantity",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

$result="";
$j=0;
for($i=0;$i<100;$i++){
//qty stock
$product_shtquantity=$product_search_list[$i]['product_stock_ht'];
$product_spoquantity=$product_search_list[$i]['product_stock_so'];
$product_quantity=$product_search_list[$i]['product_stock'];
$product_bpoquantity=$product_search_list[$i]['product_stock_po'];
//if min stock
if($product_search_list[$i]['product_min_stock']>=$product_search_list[$i]['product_estquantity']){
//get qty
$rqt_qty=$product_search_list[$i]['product_max_stock']-$product_search_list[$i]['product_estquantity'];
if($rqt_qty>0){
//get price after disc
//get sub total
//addon str
$str_addon="";
if($j>0){
	$str_addon=";";
	}else{
	$result.="xx - xx - 0 - 0 - 0 - 0 - 0 - 0 - 0".";";
	}
$product_name=str_replace(" - ","-",$product_search_list[$i]['product_name']);
$result.=$str_addon.$product_search_list[$i]['product_code']." - ".$product_name." - ".$product_search_list[$i]['product_sprice']." - ".$product_search_list[$i]['product_disc']." - ".$rqt_qty." - ".$product_shtquantity." - ".$product_spoquantity." - ".$product_quantity." - ".$product_bpoquantity;
$j++;
}}}
echo $result;

//echo json_encode($result);
//echo "lol";
?>