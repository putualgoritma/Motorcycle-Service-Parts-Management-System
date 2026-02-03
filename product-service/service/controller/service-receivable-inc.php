<?
//paid
if(isset($_REQUEST['paid']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	$i_set=0;
	$amount_set=0;
	$id_set="";
	$users_code_old="";
	$users_code_unmatch=true;
	$payreceivable_id_old="";
	foreach ($_POST["id"] as $payreceivable_id) 
		{ 
		$addstr_set="";
		if($i_set>0){
			$addstr_set=",";
			}
		//set id and amount
		$payreceivable_row=$global->payreceivable->db_row("payreceivable","payreceivable_amount,users_code","payreceivable_id='".$payreceivable_id."'");
		$payreceivable_amount=$payreceivable_row['payreceivable_amount'];
		$users_code=$payreceivable_row['users_code'];
		if($users_code_old!="" && ($users_code_old!=$users_code)){
			$users_code_unmatch=false;
			}
		$users_code_old=$users_code;
		$payreceivable_id_old=$payreceivable_id;
		$amount_set +=$payreceivable_amount;
		$id_set .=$addstr_set.$payreceivable_id;
		$i_set++;
		}
	}	
if(!$users_code_unmatch){
	$global->product_order->error_message($global->product_order->product_order_lang['msgform_product_order_lang']['users_unmatch']);
	}else{
Header("location: ".$path."payreceivable/receivable-min-new.php?amount_set=".$amount_set."&id_set=".$id_set."&payreceivable_id=".$payreceivable_id);
exit;
	}
}
?>
<?
if(!isset($_SESSION['service_receivable_drange1_sessi'])){
$_SESSION['service_receivable_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['service_receivable_drange2_sessi'])){
$_SESSION['service_receivable_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}

//default view
$search_value="";
$pageset_value=0;
$per_page_value=0;
$sort_value="service_order.service_order_registernum DESC, service_order.service_order_id DESC";
$users_code_value="";
$date_range1_value=$global->date_strtonum($_SESSION['service_receivable_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['service_receivable_drange2_sessi']);

//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
}
//users
if (isset($_REQUEST['users_code'])){
$users_code_value=$_REQUEST['users_code'];
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
$_SESSION['service_receivable_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['service_receivable_drange2_sessi']=$_REQUEST['date_range2'];
}
//array set
$search_field_arr=array("service_order.service_order_description","service_order.service_order_code","users.users_name");
//date range match
$date_range_match="AND (service_order.service_order_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";
//users
$users_code_match="";
if($users_code_value!=""){
$users_code_match=" AND users.users_code = '".$users_code_value."'";
}
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>$date_range_match." AND service_order.service_order_type='si' AND service_order.service_order_status = 'pmn' AND service_order.service_order_pay_method = 'credit'".$users_code_match." GROUP BY service_order.service_order_id",
'join_id'=>"",
'join_tbl'=>array("payreceivable","users","service_orderdetails","payreceivable_details"),
'join_type'=>array("INNER JOIN","LEFT JOIN","LEFT JOIN","LEFT JOIN"),
'join_key'=>array("payreceivable_id","users_code","service_order_id","payreceivable_id"),
'join_tbl_field'=>array("payreceivable_id,payreceivable_paid_status","users_code,users_name","service_order_id","payreceivable_id,IFNULL(SUM(payreceivable_details_amount), '0') AS payreceivable_details_amount_total"),
'join_tbl_group'=>array(0,0,1,1),
'join_tbl_id'=>array("payreceivable.payreceivable_paid_status = '0'","","service_orderdetails.service_orderdetails_status = 'pmn'",""),
);
$service_order_search_list=$global->tbl_searchjoin_list("service_order","service_order.*,users.users_name,service_order.service_order_cash AS service_orderdetails_price_total,(service_order.service_order_cash-IFNULL(payreceivable_details.payreceivable_details_amount_total, '0')) AS amount_residu",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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