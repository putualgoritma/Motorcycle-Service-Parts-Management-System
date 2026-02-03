<?
//del
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $payreceivable_id) 
		{ 
		if(!$global->payreceivable->delete_receivable($payreceivable_id)){
			$global->payreceivable->error_message($global->payreceivable->err_msg);
			}
		}
	}	
Header("location: receivable-staff.php");
exit;
}
//paid
if(isset($_REQUEST['paid']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{
	$i_set=0;
	$amount_set=0;
	$id_set="";
	$staff_code_old="";
	$payreceivable_accountdebit_old="";
	$staff_code_unmatch=true;
	$payreceivable_accountdebit_unmatch=true;
	$payreceivable_id_old="";
	$payreceivable_type_status_unmatch=true;
	foreach ($_POST["id"] as $payreceivable_id) 
		{ 
		$addstr_set="";
		if($i_set>0){
			$addstr_set=",";
			}
		//set id and amount
		$payreceivable_row=$global->payreceivable->db_row("payreceivable","*","payreceivable_id='".$payreceivable_id."'");
		$payreceivable_amount=$payreceivable_row['payreceivable_amount'];
		//users match
		$staff_code=$payreceivable_row['staff_code'];
		if($staff_code_old!="" && ($staff_code_old!=$staff_code)){
			$staff_code_unmatch=false;
			}
		$staff_code_old=$staff_code;
		//payreceivable_accountdebit match
		$payreceivable_accountdebit=$payreceivable_row['payreceivable_accountdebit'];
		if($payreceivable_accountdebit_old!="" && ($payreceivable_accountdebit_old!=$payreceivable_accountdebit)){
			$payreceivable_accountdebit_unmatch=false;
			}
		$payreceivable_accountdebit_old=$payreceivable_accountdebit;
		$payreceivable_id_old=$payreceivable_id;
		//payreceivable_type & payreceivable_status match
		$payreceivable_type=$payreceivable_row['payreceivable_type'];
		$payreceivable_status=$payreceivable_row['payreceivable_status'];
		if($payreceivable_type!=1 || $payreceivable_status!=0){
			$payreceivable_type_status_unmatch=false;
			}
		//echo $payreceivable_type."-".$payreceivable_status;
		$amount_set +=$payreceivable_amount;
		$id_set .=$addstr_set.$payreceivable_id;
		$i_set++;
		}
	}	
if(!$staff_code_unmatch){
	$global->product_order->error_message($global->product_order->product_order_lang['msgform_product_order_lang']['users_unmatch']);
}else if(!$payreceivable_accountdebit_unmatch){
	$global->product_order->error_message($global->product_order->product_order_lang['msgform_product_order_lang']['account_unmatch']);
}else if(!$payreceivable_type_status_unmatch){
	$global->product_order->error_message($global->payreceivable->payreceivable_lang['msgform_payreceivable_lang']['type_status_unmatch']);
	}else{
Header("location: ".$path."payreceivable/receivable-staff-min-new.php?amount_set=".$amount_set."&id_set=".$id_set."&payreceivable_id=".$payreceivable_id);
exit;
	}
}
?>
<?
//session init
if(!isset($_SESSION['receivable_search_sessi'])){
$_SESSION['receivable_search_sessi']="";
}
if(!isset($_SESSION['receivable_drange1_sessi'])){
$_SESSION['receivable_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['receivable_drange2_sessi'])){
$_SESSION['receivable_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['receivable_sort_sessi'])){
$_SESSION['receivable_sort_sessi']="payreceivable.payreceivable_registernum DESC, payreceivable.payreceivable_id DESC";
}
if(!isset($_SESSION['receivable_pageset_sessi'])){
$_SESSION['receivable_pageset_sessi']=0;
}
if(!isset($_SESSION['receivable_per_page_sessi'])){
$_SESSION['receivable_per_page_sessi']=50;
}
if(!isset($_SESSION['receivable_account_sessi'])){
$_SESSION['receivable_account_sessi']=0;
}
if(!isset($_SESSION['receivable_staff_sessi'])){
$_SESSION['receivable_staff_sessi']="";
}
//default view
$search_value=$_SESSION['receivable_search_sessi'];
$date_range1_value=$global->date_strtonum($_SESSION['receivable_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['receivable_drange2_sessi']);
$pageset_value=$_SESSION['receivable_pageset_sessi'];
$per_page_value=$_SESSION['receivable_per_page_sessi'];
$sort_value=$_SESSION['receivable_sort_sessi'];
$payreceivable_account_value=$_SESSION['receivable_account_sessi'];
$staff_code_value=$_SESSION['receivable_staff_sessi'];
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
$_SESSION['receivable_search_sessi']=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
$_SESSION['receivable_per_page_sessi']=$_REQUEST['per_page'];
}
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['receivable_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['receivable_drange2_sessi']=$_REQUEST['date_range2'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
$_SESSION['receivable_sort_sessi']=$_REQUEST['sort'];
}
//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
$_SESSION['receivable_pageset_sessi']=$_REQUEST['pageset'];
}
//account
if (isset($_REQUEST['payreceivable_account']) && $_REQUEST['payreceivable_account']!=""){
$payreceivable_account_value=$_REQUEST['payreceivable_account'];
$_SESSION['receivable_account_sessi']=$_REQUEST['payreceivable_account'];
}
//staff
if (isset($_REQUEST['staff_code'])){
$staff_code_value=$_REQUEST['staff_code'];
$_SESSION['receivable_staff_sessi']=$_REQUEST['staff_code'];
}
//array set
$search_field_arr=array("payreceivable.payreceivable_description","payreceivable.payreceivable_code","staff.staff_name","staff.staff_code");
//staff
$staff_code_match="";
if($staff_code_value!=""){
$staff_code_match=" AND staff.staff_code = '".$staff_code_value."'";
}
//account
$payreceivable_account_match="";
if($payreceivable_account_value!="0"){
$payreceivable_account_match=" AND (payreceivable.payreceivable_accountdebit = ".$payreceivable_account_value." OR payreceivable.payreceivable_accountcredit = ".$payreceivable_account_value.")";
}
//date range match
$date_range_match="(payreceivable.payreceivable_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND ".$date_range_match." AND payreceivable.payreceivable_type = '1'".$staff_code_match.$payreceivable_account_match,
'join_id'=>"",
'join_tbl'=>array("staff"),
'join_type'=>array("INNER JOIN"),
'join_key'=>array("staff_code"),
'join_tbl_field'=>array("staff_code,staff_name"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);
$receivable_search_list=$global->tbl_searchjoin_list("payreceivable","payreceivable.*,staff.staff_name,staff.staff_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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
$payreceivable_balance=$global->payreceivable->payreceivable_balance($receivable_search_list);
$saldo=$payreceivable_balance['balance'];
$payreceivable_account_arr=$payreceivable_balance['account'];

//echo $qry_str_sort;
?>