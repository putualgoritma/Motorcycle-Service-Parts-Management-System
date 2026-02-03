<?
//session init
if(!isset($_SESSION['payable_recap_search_sessi'])){
$_SESSION['payable_recap_search_sessi']="";
}
if(!isset($_SESSION['payable_recap_month_sessi'])){
$_SESSION['payable_recap_month_sessi']=date('m');
}
if(!isset($_SESSION['payable_recap_year_sessi'])){
$_SESSION['payable_recap_year_sessi']=date('Y');
}
if(!isset($_SESSION['payable_sort_sessi'])){
$_SESSION['payable_sort_sessi']="payreceivable.payreceivable_registernum DESC, payreceivable.payreceivable_id DESC";
}
if(!isset($_SESSION['payable_pageset_sessi'])){
$_SESSION['payable_pageset_sessi']=0;
}
if(!isset($_SESSION['payable_per_page_sessi'])){
$_SESSION['payable_per_page_sessi']=0;
}
if(!isset($_SESSION['payable_users_sessi'])){
$_SESSION['payable_users_sessi']="";
}
//default view
$search_value=$_SESSION['payable_recap_search_sessi'];
$month_value=$_SESSION['payable_recap_month_sessi'];
$year_value=$_SESSION['payable_recap_year_sessi'];
$pageset_value=$_SESSION['payable_pageset_sessi'];
$per_page_value=$_SESSION['payable_per_page_sessi'];
$sort_value=$_SESSION['payable_sort_sessi'];
$users_code_value=$_SESSION['payable_users_sessi'];
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
$_SESSION['payable_recap_search_sessi']=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
$_SESSION['payable_per_page_sessi']=$_REQUEST['per_page'];
}
if (isset($_REQUEST['month'])){
$valid_date1=$_REQUEST['month'];
$valid_date1_arr=$global->valid_date($valid_date1);
$month_value=$valid_date1_arr['date_registernum'];
$_SESSION['payable_recap_month_sessi']=$_REQUEST['month'];
}
if (isset($_REQUEST['year'])){
$valid_date2=$_REQUEST['year'];
$valid_date2_arr=$global->valid_date($valid_date2);
$year_value=$valid_date2_arr['date_registernum'];
$_SESSION['payable_recap_year_sessi']=$_REQUEST['year'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
$_SESSION['payable_sort_sessi']=$_REQUEST['sort'];
}
//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
$_SESSION['payable_pageset_sessi']=$_REQUEST['pageset'];
}
//users
if (isset($_REQUEST['users_code'])){
$users_code_value=$_REQUEST['users_code'];
$_SESSION['payable_users_sessi']=$_REQUEST['users_code'];
}
//array set
$search_field_arr=array("payreceivable.payreceivable_description","payreceivable.payreceivable_code","users.users_name","users.users_code");
//users
$users_code_match="";
if($users_code_value!=""){
$users_code_match=" AND users.users_code = ".$users_code_value;
}
//date range match
$date_range_match="(payreceivable.payreceivable_registernum BETWEEN '".$month_value."' AND '".$year_value."')";

$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND ".$date_range_match." AND payreceivable.payreceivable_type = '0'".$users_code_match,
'join_id'=>"",
'join_tbl'=>array("users"),
'join_type'=>array("LEFT JOIN"),
'join_key'=>array("users_code"),
'join_tbl_field'=>array("users_code,users_name"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);
$payable_recap_search_list=$global->tbl_searchjoin_list("payreceivable","payreceivable.*,users.users_name,users.users_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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
//get saldo
$payreceivable_balance=$global->payreceivable->payreceivable_balance($payable_recap_search_list);
$saldo=$payreceivable_balance['balance'];
$payreceivable_account_arr=$payreceivable_balance['account'];
//echo $qry_str_sort;
?>