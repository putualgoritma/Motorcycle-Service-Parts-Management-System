<?
if(isset($_REQUEST['service_order_register'])){
$service_order_register_start=$_REQUEST['service_order_register_start'];
$service_order_register=$_REQUEST['service_order_register'];
} else if(isset($_POST['service_order_register'])){
$service_order_register_start=$_POST['service_order_register_start'];
$service_order_register=$_POST['service_order_register'];
}else{
$service_order_register_start=date("d/m/Y");
$service_order_register=date("d/m/Y");
}
//get datenum
$valid_date_start=$global->valid_date($service_order_register_start);
$valid_date_end=$global->valid_date($service_order_register);

//default view
$search_value="";
$pageset_value=0;
$per_page_value=0;
$sort_value="ledger_registernum DESC, ledger_id DESC";
$cash_account_value=0;
$ledger_id_qry="";

//array set
$search_field_arr=array("ledger_register","ledger_description","ledger_code");
//account match
$cash_account_match="(ledgerdetails.ledgerdetails_subsidiary = 'cash-debit' OR ledgerdetails.ledgerdetails_subsidiary = 'cash-credit')";
//date range match
$date_range_match="AND (ledger.ledger_registernum BETWEEN '".$valid_date_start['date_registernum']."' AND '".$valid_date_end['date_registernum']."')";
//ledger id
if (isset($_REQUEST['ledger_id'])){
$ledger_id_qry=" AND ledger.ledger_id ='".$_REQUEST['ledger_id']."'";
$date_range_match=" ";
}


$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>$date_range_match." AND ledger.ledger_status = 'pmn' AND (ledger.ledger_subsidiary = 'cash-debit' OR ledger.ledger_subsidiary = 'cash-credit')".$ledger_id_qry,
'join_id'=>"",
'join_tbl'=>array("ledgerdetails"),
'join_type'=>array("INNER JOIN"),
'join_key'=>array("ledger_id"),
'join_tbl_field'=>array("ledger_id,ledgerdetails_type,taxonomi_id"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array($cash_account_match),
);
$ledger_search_list=$global->tbl_searchjoin_list("ledger","ledger.*,ledgerdetails.ledgerdetails_type",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
//echo $qry_str_sort;
?>