<?
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $ledger_id) 
		{
		//check if taxonomi in used
		$ledger_row=$global->db_row("ledger","ledger_uneditable,ledger_module","ledger_id='".$ledger_id."'");
		if($ledger_row['ledger_uneditable']!=1 && $ledger_row['ledger_module'] =="")
			{
			$global->db_delete("ledgerdetails","ledger_id='".$ledger_id."'");
			$global->db_delete("ledger","ledger_id='".$ledger_id."'");
			}
		}
	}	
Header("location: cash-credit.php");
exit;
}
?>
<?
//session init
if(!isset($_SESSION['ccredit_search_sessi'])){
$_SESSION['ccredit_search_sessi']="";
}
if(!isset($_SESSION['ccredit_drange1_sessi'])){
$_SESSION['ccredit_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['ccredit_drange2_sessi'])){
$_SESSION['ccredit_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['ccredit_account_sessi'])){
$_SESSION['ccredit_account_sessi']=0;
}
if(!isset($_SESSION['ccredit_sort_sessi'])){
$_SESSION['ccredit_sort_sessi']="ledger_registernum DESC, ledger_id DESC";
}
if(!isset($_SESSION['ccredit_pageset_sessi'])){
$_SESSION['ccredit_pageset_sessi']=0;
}
if(!isset($_SESSION['ccredit_per_page_sessi'])){
$_SESSION['ccredit_per_page_sessi']=50;
}
//default view
$search_value=$_SESSION['ccredit_search_sessi'];
$pageset_value=$_SESSION['ccredit_pageset_sessi'];
$per_page_value=$_SESSION['ccredit_per_page_sessi'];
$sort_value=$_SESSION['ccredit_sort_sessi'];
$cash_account_value=$_SESSION['ccredit_account_sessi'];
$date_range1_value=$global->date_strtonum($_SESSION['ccredit_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['ccredit_drange2_sessi']);
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
$_SESSION['ccredit_search_sessi']=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
$_SESSION['ccredit_per_page_sessi']=$_REQUEST['per_page'];
}
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['ccredit_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['ccredit_drange2_sessi']=$_REQUEST['date_range2'];
}
//account
if (isset($_REQUEST['cash_account']) && $_REQUEST['cash_account']!=""){
$cash_account_value=$_REQUEST['cash_account'];
$_SESSION['ccredit_account_sessi']=$_REQUEST['cash_account'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
$_SESSION['ccredit_sort_sessi']=$_REQUEST['sort'];
}
//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
$_SESSION['ccredit_pageset_sessi']=$_REQUEST['pageset'];
}
//array set
$search_field_arr=array("ledger_register","ledger_description","ledger_code");
//account match
$cash_account_match="ledgerdetails.ledgerdetails_subsidiary = 'cash-credit'";
if($cash_account_value!="0"){
$cash_account_match="ledgerdetails.ledgerdetails_subsidiary = 'cash-credit' AND ledgerdetails.taxonomi_id = '".$cash_account_value."'";
}
//date range match
$date_range_match="AND (ledger.ledger_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";
//ledger id
$ledger_id_qry="";
if (isset($_REQUEST['ledger_id'])){
$ledger_id_qry=" AND ledger.ledger_id ='".$_REQUEST['ledger_id']."'";
$date_range_match=" ";
}

$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>$date_range_match." AND ledger.ledger_status = 'pmn' AND ledger.ledger_subsidiary = 'cash-credit'".$ledger_id_qry,
'join_id'=>"",
'join_tbl'=>array("ledgerdetails"),
'join_type'=>array("INNER JOIN"),
'join_key'=>array("ledger_id"),
'join_tbl_field'=>array("ledger_id,ledgerdetails_type,taxonomi_id"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array($cash_account_match),
);
$ledger_search_list=$global->tbl_searchjoin_list("ledger","ledger.*,ledgerdetails.ledgerdetails_type",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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