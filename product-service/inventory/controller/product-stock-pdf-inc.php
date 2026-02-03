<?
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

//warehouse
$warehouse_code_qry="";
$warehouse_code_value="";
if (isset($_REQUEST['warehouse_code']) && $_REQUEST['warehouse_code']!=''){
$warehouse_code_qry="warehouse_code = '".$_REQUEST['warehouse_code']."'";
$warehouse_code_value=$_REQUEST['warehouse_code'];
}

//min stock
$min_stock_qry=" AND product.product_stock > 0";
$min_stock_value="low";
if (isset($_REQUEST['min_stock']) && $_REQUEST['min_stock']=='out'){
$min_stock_qry=" AND product.product_stock < product.product_min_stock";
$min_stock_value=$_REQUEST['min_stock'];
}
else if (isset($_REQUEST['min_stock']) && $_REQUEST['min_stock']==''){
$min_stock_qry="";
$min_stock_value="";
}

if($warehouse_code_value!=""){
	//query
	$search_field_arr=array("product.product_code","product.product_astra_code","product.product_name","unit.unit_code","category.category_code");
	$def_arr=array(
	'pageset'=>$pageset_value,
	'per_page'=>$per_page_value,
	'keyword'=>$search_value,
	'sort'=>$sort_value,
	'join_match'=>$min_stock_qry,
	'join_id'=>"",
	'join_tbl'=>array("warehouse_product","unit","category"),
	'join_type'=>array("LEFT JOIN","LEFT JOIN","LEFT JOIN"),
	'join_key'=>array("product_code","unit_code","category_code"),
	'join_tbl_field'=>array("product_code,warehouse_product_quantity","unit_name,unit_code","category_code"),
	'join_tbl_group'=>array(0,0,1),
	'join_tbl_id'=>array($warehouse_code_qry,"",""),
	);
	$product_search_list=$global->tbl_searchjoin_list("product","product.*,unit.unit_name,unit.unit_code,IFNULL(product.product_stock,0) AS product_stock,IFNULL(warehouse_product.warehouse_product_quantity,0) AS warehouse_product_quantity",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
	}else{
	//query
	$search_field_arr=array("product.product_code","product.product_astra_code","product.product_name","unit.unit_code","category.category_code");
	$def_arr=array(
	'pageset'=>$pageset_value,
	'per_page'=>$per_page_value,
	'keyword'=>$search_value,
	'sort'=>$sort_value,
	'join_match'=>$min_stock_qry,
	'join_id'=>"",
	'join_tbl'=>array("warehouse_product","unit","category"),
	'join_type'=>array("LEFT JOIN","LEFT JOIN","LEFT JOIN"),
	'join_key'=>array("product_code","unit_code","category_code"),
	'join_tbl_field'=>array("product_code,warehouse_product_quantity","unit_name,unit_code","category_code"),
	'join_tbl_group'=>array(0,0,1),
	'join_tbl_id'=>array($warehouse_code_qry,"",""),
	);
	$product_search_list=$global->tbl_searchjoin_list("product","product.*,unit.unit_name,unit.unit_code,IFNULL(product.product_stock,0) AS product_stock,IFNULL(warehouse_product.warehouse_product_quantity,0) AS warehouse_product_quantity",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
	}

//next prev
if($per_page_value<=0){
$total_page=1;
$current_page=1;
}else{
$total_page=ceil($select_num/$per_page_value);
$current_page=($pageset_value/$per_page_value)+1;
}
$pageset_prev=$pageset_value-$per_page_value;
$pageset_next=$pageset_value+$per_page_value;
$pageset_last=($total_page-1) * $per_page_value;

//additional init
$inc=1+$pageset_value;
//echo $qry_str_sort;
?>