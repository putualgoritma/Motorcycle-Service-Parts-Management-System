<?
//default view
$search_value="";
$pageset_value=0;
$per_page_value=0;
$sort_value="ledger.ledger_registernum ASC, ledger.ledger_id ASC";
$cash_account_value=0;
$date_range1="01/".date('m')."/".date('Y');
$date_range2=date('d')."/".date('m')."/".date('Y');
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
}
if (isset($_REQUEST['date_range1'])){
$date_range1=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$date_range2=$_REQUEST['date_range2'];
}
if(isset($_REQUEST['service_order_register'])){
$date_range1=$_REQUEST['service_order_register_start'];
$date_range2=$_REQUEST['service_order_register'];
}
//account
if (isset($_REQUEST['cash_account']) && $_REQUEST['cash_account']!=""){
$cash_account_value=$_REQUEST['cash_account'];
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
//array set
$search_field_arr=array("ledger_register","ledger_description","ledger_code");
//account match
$cash_account_match="";
if($cash_account_value>0){
$cash_account_match="ledgerdetails.taxonomi_id = '".$cash_account_value."'";
}
//date range match
$valid_date1_arr=$global->valid_date($date_range1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$valid_date2_arr=$global->valid_date($date_range2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$date_range_match="AND (ledger.ledger_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";
//ledger id
$ledger_id_qry="";
if (isset($_REQUEST['ledger_id'])){
$ledger_id_qry=" AND ledger.ledger_id ='".$_REQUEST['ledger_id']."'";
$date_range_match=" ";
}

//echo $sort_value;
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>$date_range_match." AND ledger.ledger_status = 'pmn' AND (taxonomi.taxonomy_special_type = 'cash' OR taxonomi.taxonomy_special_type = 'bank')".$ledger_id_qry,
'join_id'=>"",
'join_tbl'=>array("ledgerdetails","taxonomi"),
'join_type'=>array("INNER JOIN","LEFT JOIN"),
'join_key'=>array("ledger_id","taxonomi_id"),
'join_tbl_field'=>array("ledger_id,ledgerdetails_type,ledgerdetails_amount,taxonomi_id","*"),
'join_tbl_group'=>array(0,0),
'join_tbl_id'=>array($cash_account_match),
);
$ledger_search_list=$global->tbl_searchjoin_multi_list("ledger","ledger.ledger_register,ledger.ledger_code,ledger.ledger_description,(CASE WHEN ledgerdetails.ledgerdetails_type ='D' THEN ledgerdetails.ledgerdetails_amount ELSE 0 End) as ledgerdetails_amount_debit,(CASE WHEN ledgerdetails.ledgerdetails_type ='K' THEN ledgerdetails.ledgerdetails_amount ELSE 0 End) as ledgerdetails_amount_credit,taxonomi.taxonomi_code,taxonomi.taxonomi_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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