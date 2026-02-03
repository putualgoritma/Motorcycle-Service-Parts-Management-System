<?
//delete
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $payreceivable_id) 
		{ 
		if(!$global->payreceivable->delete_payable($payreceivable_id)){
			$global->payreceivable->error_message($global->payreceivable->err_msg);
			}
		}
	}	
Header("location: payable.php");
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
	$users_code_old="";
	$payreceivable_accountcredit_old="";
	$users_code_unmatch=true;
	$payreceivable_accountcredit_unmatch=true;
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
		$users_code=$payreceivable_row['users_code'];
		if($users_code_old!="" && ($users_code_old!=$users_code)){
			$users_code_unmatch=false;
			}
		$users_code_old=$users_code;
		//payreceivable_accountcredit match
		$payreceivable_accountcredit=$payreceivable_row['payreceivable_accountcredit'];
		if($payreceivable_accountcredit_old!="" && ($payreceivable_accountcredit_old!=$payreceivable_accountcredit)){
			$payreceivable_accountcredit_unmatch=false;
			}
		$payreceivable_accountcredit_old=$payreceivable_accountcredit;
		$payreceivable_id_old=$payreceivable_id;
		//payreceivable_type & payreceivable_status match
		$payreceivable_type=$payreceivable_row['payreceivable_type'];
		$payreceivable_status=$payreceivable_row['payreceivable_status'];
		if($payreceivable_type!=0 || $payreceivable_status!=0){
			$payreceivable_type_status_unmatch=false;
			}
		//echo $payreceivable_type."-".$payreceivable_status;
		$amount_set +=$payreceivable_amount;
		$id_set .=$addstr_set.$payreceivable_id;
		$i_set++;
		}
	}	
if(!$users_code_unmatch){
	$global->product_order->error_message($global->product_order->product_order_lang['msgform_product_order_lang']['users_unmatch']);
}else if(!$payreceivable_accountcredit_unmatch){
	$global->product_order->error_message($global->product_order->product_order_lang['msgform_product_order_lang']['account_unmatch']);
}else if(!$payreceivable_type_status_unmatch){
	$global->product_order->error_message($global->payreceivable->payreceivable_lang['msgform_payreceivable_lang']['type_status_unmatch']);
	}else{
Header("location: ".$path."payreceivable/payable-min-new.php?amount_set=".$amount_set."&id_set=".$id_set."&payreceivable_id=".$payreceivable_id);
exit;
	}
}
?>
<?
//session init
if(!isset($_SESSION['payable_search_sessi'])){
$_SESSION['payable_search_sessi']="";
}
if(!isset($_SESSION['payable_drange1_sessi'])){
$_SESSION['payable_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['payable_drange2_sessi'])){
$_SESSION['payable_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['payable_sort_sessi'])){
$_SESSION['payable_sort_sessi']="payreceivable.payreceivable_registernum DESC, payreceivable.payreceivable_id DESC";
}
if(!isset($_SESSION['payable_pageset_sessi'])){
$_SESSION['payable_pageset_sessi']=0;
}
if(!isset($_SESSION['payable_per_page_sessi'])){
$_SESSION['payable_per_page_sessi']=50;
}
if(!isset($_SESSION['payable_account_sessi'])){
$_SESSION['payable_account_sessi']=0;
}
if(!isset($_SESSION['payable_users_sessi'])){
$_SESSION['payable_users_sessi']="";
}
//default view
$search_value=$_SESSION['payable_search_sessi'];
$date_range1_value=$global->date_strtonum($_SESSION['payable_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['payable_drange2_sessi']);
$pageset_value=$_SESSION['payable_pageset_sessi'];
$per_page_value=$_SESSION['payable_per_page_sessi'];
$sort_value=$_SESSION['payable_sort_sessi'];
$payreceivable_account_value=$_SESSION['payable_account_sessi'];
$users_code_value=$_SESSION['payable_users_sessi'];
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
$_SESSION['payable_search_sessi']=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
$_SESSION['payable_per_page_sessi']=$_REQUEST['per_page'];
}
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['payable_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['payable_drange2_sessi']=$_REQUEST['date_range2'];
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
//account
if (isset($_REQUEST['payreceivable_account']) && $_REQUEST['payreceivable_account']!=""){
$payreceivable_account_value=$_REQUEST['payreceivable_account'];
$_SESSION['payable_account_sessi']=$_REQUEST['payreceivable_account'];
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
$users_code_match=" AND users.users_code = '".$users_code_value."'";
}
//account
$payreceivable_account_match="";
if($payreceivable_account_value!="0"){
$payreceivable_account_match=" AND (payreceivable.payreceivable_accountcredit = ".$payreceivable_account_value." OR payreceivable.payreceivable_accountcredit = ".$payreceivable_account_value.")";
}
//date range match
$date_range_match="(payreceivable.payreceivable_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND ".$date_range_match." AND payreceivable.payreceivable_type = '0'".$users_code_match.$payreceivable_account_match,
'join_id'=>"",
'join_tbl'=>array("users"),
'join_type'=>array("LEFT JOIN"),
'join_key'=>array("users_code"),
'join_tbl_field'=>array("users_code,users_name"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);
$payable_search_list=$global->tbl_searchjoin_list("payreceivable","payreceivable.*,users.users_name,users.users_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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
$payreceivable_balance=$global->payreceivable->payreceivable_balance($payable_search_list);
$saldo=$payreceivable_balance['balance'];
$payreceivable_account_arr=$payreceivable_balance['account'];

//echo $qry_str_sort;
?>