<?
//session init
if(!isset($_SESSION['baccount_search_sessi'])){
$_SESSION['baccount_search_sessi']=$global->book->account_special_get("cash");
}
if(!isset($_SESSION['baccount_drange1_sessi'])){
$_SESSION['baccount_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['baccount_drange2_sessi'])){
$_SESSION['baccount_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['baccount_sort_sessi'])){
$_SESSION['baccount_sort_sessi']="ledgerdetails_registernum ASC,ledgerdetails_id ASC";
}
//default view
$search_value=$_SESSION['baccount_search_sessi'];
$sort_value=$_SESSION['baccount_sort_sessi'];
$date_range1_value=$global->date_strtonum($_SESSION['baccount_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['baccount_drange2_sessi']);
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
$_SESSION['baccount_search_sessi']=$_REQUEST['search'];
}
//
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['baccount_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['baccount_drange2_sessi']=$_REQUEST['date_range2'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
$_SESSION['baccount_sort_sessi']=$_REQUEST['sort'];
}

//array set
$search_field_arr=array();
//date range match
$date_range_match="(ledger.ledger_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

$def_arr=array(
'pageset'=>0,
'per_page'=>0,
'keyword'=>"",
'sort'=>$sort_value,
'join_match'=>"taxonomi.taxonomi_id = '$search_value'  AND ledger.ledger_status = 'pmn'  AND ".$date_range_match,
'join_id'=>" AND ledgerdetails.taxonomi_id = taxonomi.taxonomi_id AND ledgerdetails.ledger_id = ledger.ledger_id"
);
$ledgerdetails_search_list=$global->tbl_search_list("ledgerdetails,taxonomi,ledger","ledgerdetails.*,taxonomi.*,ledger.*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//init
$inc=1;
$total_debit=0;
$total_kredit=0;

//echo $qry_str_sort;
?>