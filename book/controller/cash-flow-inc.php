<?
//session init
if(!isset($_SESSION['cash_flow_drange1_sessi'])){
$_SESSION['cash_flow_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['cash_flow_drange2_sessi'])){
$_SESSION['cash_flow_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['cash_flow_sort_sessi'])){
$_SESSION['cash_flow_sort_sessi']="taxonomi_type ASC, taxonomi_code ASC";
}
//default view
$date_range1_value=$global->date_strtonum($_SESSION['cash_flow_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['cash_flow_drange2_sessi']);
$sort_value=$_SESSION['cash_flow_sort_sessi'];
//
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['cash_flow_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['cash_flow_drange2_sessi']=$_REQUEST['date_range2'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
$_SESSION['cash_flow_sort_sessi']=$_REQUEST['sort'];
}

//date range
$date_range_match=" AND (ledger.ledger_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

//operational
//array set
$search_field_arr=array();
$def_arr=array(
'pageset'=>0,
'per_page'=>0,
'keyword'=>"",
'sort'=>"taxonomi_type ASC, taxonomi_code ASC",
'join_match'=>"taxonomi_cash_flow='operational'",
'join_id'=>""
);
$operational_list=$global->tbl_search_list("taxonomi","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//invest
//array set
$search_field_arr=array();
$def_arr=array(
'pageset'=>0,
'per_page'=>0,
'keyword'=>"",
'sort'=>"taxonomi_type ASC, taxonomi_code ASC",
'join_match'=>"taxonomi_cash_flow='invest'",
'join_id'=>""
);
$invest_list=$global->tbl_search_list("taxonomi","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//capital
//array set
$search_field_arr=array();
$def_arr=array(
'pageset'=>0,
'per_page'=>0,
'keyword'=>"",
'sort'=>"taxonomi_type ASC, taxonomi_code ASC",
'join_match'=>"taxonomi_cash_flow='capital'",
'join_id'=>""
);
$capital_list=$global->tbl_search_list("taxonomi","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//additional init
$inc=1;
?>