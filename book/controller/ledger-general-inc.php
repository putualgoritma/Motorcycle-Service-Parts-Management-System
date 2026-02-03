<?
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $ledger_id) 
		{
		//check if taxonomi in used
		$ledger_row=$global->db_row("ledger","ledger_uneditable,ledger_module","ledger_id='".$ledger_id."'");
		$ledger_uneditable=$ledger_row['ledger_uneditable'];
		if($ledger_uneditable !=1 && $ledger_row['ledger_module'] =="")
			{ 
			$db_select = $global->db_select("ledgerdetails","*","ledger_id='".$ledger_id."'","",0,0);
			$select_data=$db_select['select_data'];
			for($i=0;$i<$db_select['select_num'];$i++)
				{
				$ledgerdetails_id=$select_data[$i]['ledgerdetails_id'];
				$global->db_delete("ledgerdetails","ledgerdetails_id='".$ledgerdetails_id."'");
				}
			$global->db_delete("ledger","ledger_id='".$ledger_id."'");
			}
		}
	}	
Header("location: ledger-general.php");
exit;
}
?>
<?
//session init
if(!isset($_SESSION['ledger_search_sessi'])){
$_SESSION['ledger_search_sessi']="";
}
if(!isset($_SESSION['ledger_drange1_sessi'])){
$_SESSION['ledger_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['ledger_drange2_sessi'])){
$_SESSION['ledger_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['ledger_sort_sessi'])){
$_SESSION['ledger_sort_sessi']="ledger_registernum DESC, ledger_id DESC";
}
if(!isset($_SESSION['ledger_pageset_sessi'])){
$_SESSION['ledger_pageset_sessi']=0;
}
if(!isset($_SESSION['ledger_per_page_sessi'])){
$_SESSION['ledger_per_page_sessi']=50;
}
//default view
$search_value=$_SESSION['ledger_search_sessi'];
$pageset_value=$_SESSION['ledger_pageset_sessi'];
$per_page_value=$_SESSION['ledger_per_page_sessi'];
$sort_value=$_SESSION['ledger_sort_sessi'];
$date_range1_value=$global->date_strtonum($_SESSION['ledger_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['ledger_drange2_sessi']);
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
$_SESSION['ledger_search_sessi']=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
$_SESSION['ledger_per_page_sessi']=$_REQUEST['per_page'];
}
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['ledger_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['ledger_drange2_sessi']=$_REQUEST['date_range2'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
$_SESSION['ledger_sort_sessi']=$_REQUEST['sort'];
}
//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
$_SESSION['ledger_pageset_sessi']=$_REQUEST['pageset'];
}
//array set
$search_field_arr=array("ledger_register","ledger_description","ledger_code");
//date range match
$date_range_match="(ledger.ledger_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND ".$date_range_match." AND ledger_status = 'pmn'",
'join_id'=>""
);
$ledger_search_list=$global->tbl_search_list("ledger","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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