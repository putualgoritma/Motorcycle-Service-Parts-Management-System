<?
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $warehouse_stock_id) 
		{ 
		if(!$global->product_order->delete_warehouse_stock($warehouse_stock_id)){
			$global->product_order->error_message($global->product_order->err_msg);
			}
		}
	}	
Header("location: warehouse-stock.php");
exit;
}
?>
<?
if(!isset($_SESSION['warehouse_stock_drange1_sessi'])){
$_SESSION['warehouse_stock_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['warehouse_stock_drange2_sessi'])){
$_SESSION['warehouse_stock_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
//default view
$search_value="";
$pageset_value=0;
$per_page_value=0;
$sort_value="warehouse_stock.warehouse_stock_registernum DESC, warehouse_stock.warehouse_stock_id DESC";
$warehouse_code_value="";
$date_range1_value=$global->date_strtonum($_SESSION['warehouse_stock_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['warehouse_stock_drange2_sessi']);
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
}
//warehouse
if (isset($_REQUEST['warehouse_code'])){
$warehouse_code_value=$_REQUEST['warehouse_code'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
}
//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
}
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['warehouse_stock_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['warehouse_stock_drange2_sessi']=$_REQUEST['date_range2'];
}
//array set
$search_field_arr=array("warehouse_stock.warehouse_stock_description","warehouse_stock.warehouse_stock_code","warehouse.warehouse_name");
//date range match
$date_range_match="AND (warehouse_stock.warehouse_stock_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";
//warehouse
$warehouse_code_match="";
if($warehouse_code_value!=""){
$warehouse_code_match=" AND warehouse.warehouse_code = '".$warehouse_code_value."'";
}
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>$date_range_match." AND (warehouse_stock.warehouse_stock_type='in' OR  warehouse_stock.warehouse_stock_type='out') AND warehouse_stock.warehouse_stock_status = 'pmn' AND warehouse_stock.ledger_id>0".$warehouse_code_match,
'join_id'=>"",
'join_tbl'=>array("warehouse"),
'join_type'=>array("LEFT JOIN"),
'join_key'=>array("warehouse_code"),
'join_tbl_field'=>array("warehouse_code,warehouse_name"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);

$warehouse_stock_search_list=$global->tbl_searchjoin_list("warehouse_stock","warehouse_stock.*,warehouse.warehouse_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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
$total_debit=0;
$total_kredit=0;
//echo $qry_str_sort;
?>