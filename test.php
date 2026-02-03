<?
// ini_set('display_errors', 1); 
// ini_set('display_startup_errors', 1); 
// error_reporting(E_ALL);
$path="";
include ("controller/config-inc.php");
$register_start=$_REQUEST['register_start'];
$register_end=$_REQUEST['register_end'];
$start_date=$global->date_strtonum("05/".date('m')."/".date('Y'));
$end_date=$global->date_strtonum("05/".date('m')."/".date('Y'));
//$get_insentif_row=$global->salary->get_comission_nonpit('KAR00001',$start_date,$end_date);
$get_insentif_row=$global->salary->get_service_fee_list('KAR00008',$start_date,$end_date);
print_r($get_insentif_row);
// print_r($global->salary->get_service_fee("KAR00010",$register_start,$register_end));
// $product_sprice_level_row=$global->db_row("product_sprice_level","*","product_code='83650K84900ZD' AND customer_level_code='Level 2'");
// print_r($product_sprice_level_row);
/*
$global->product_order->ht_realization(71,70);
/*
require_once $path.'vendor/autoload.php';
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$fontData_custome=array(
		'arial' => [
            'R' => 'arial.ttf'
		],
        'verdana' => [
            'R' => 'verdana.ttf'
		],
        'times' => [
            'R' => 'times.ttf'
        ]
		);
print_r($fontData_custome);
$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'arial' => [
            'R' => 'arial.ttf'
		],
        'verdana' => [
            'R' => 'verdana.ttf'
		],
        'times' => [
            'R' => 'times.ttf'
        ]
    ],
    'default_font_size' => 9,'default_font' => 'verdana','format' => 'Letter'
]);
/*

phpinfo();
/*
$product_row=$global->product_order->db_row("product","*","product_code='83650K84900ZD'");
$product_row['company_stock_block']=1;
print_r($product_row);
/*
//phpinfo();
echo $_SERVER['DOCUMENT_ROOT'];
echo "<br>";
define('ROOTPATH', __DIR__);
echo ROOTPATH;
/*

$absence_date="07/08/2018";
$set_date=$global->date_stridtonum($absence_date);
echo $set_date;
//echo date('d/m/Y',strtotime($set_date));
/*
//$global->product_order->po_realization_update_status(70);
//$global->product_order->po_realization_expired_status();
//$global->product_order->po_realization_update_status();
$global->product_order->po_realization(1014);
//$global->product_order->reset_realization(63);
/*
$product_order_row=$global->db_qry_data("SELECT product_order.product_order_code,COUNT(DISTINCT product_orderdetails.product_orderdetails_id) AS unit_entry,
SUM(CASE WHEN (product_orderdetails.product_orderdetails_po_status='closed') THEN 1 ELSE 0 END) status_in
FROM product_orderdetails
JOIN product_order ON product_order.product_order_id = product_orderdetails.product_order_id 
WHERE product_order.product_order_status='po' AND product_order.product_order_po_status='active'
GROUP BY product_order.product_order_id
ORDER BY product_order.product_order_id ASC");
for($i=0;$i<count($product_order_row['select_data']);$i++){
echo $product_order_row['select_data'][$i]['status_in'];
}
//print_r($product_order_row);
/*
$product_code="";
$db_select = $global->db_select("product_order,product_orderdetails","product_order.product_order_id,product_orderdetails.*","product_order.product_order_po_status='active' AND product_orderdetails.product_orderdetails_po_status='active' AND product_orderdetails.product_code='".$product_code."' AND product_order.product_order_id=product_orderdetails.product_order_id","",0,0);
echo $db_select['qry_str_sort'];
/*
$set_date=$global->date_stridtonum("10/09/2018");
$start_date = new DateTime($set_date);
$today = date('Y-m-d');
$since_start = $start_date->diff(new DateTime($today));
echo $since_start->days.' days total<br>';
/*
$get_receivable_balance=$global->payreceivable->get_receivable_balance("201809","KAR00001",$salary_slip_row['salary_slip_cut_cashbon'],$salary_slip_row['salary_slip_cut_payable']);
//print_r($get_receivable_balance);
/*
$users_row=$global->db_row("users,village","users.*,village.village_name","users_code='".$_REQUEST['customer_code_val']."' AND users_type ='customer' AND users.village_code = village.village_code");
print_r();
/*
$product_code_qry=" AND warehouse_stock_details.product_code = '082322MBK0LN1'";
//$product_code_qry="";
$qry_filter="warehouse_stock_code LIKE 'SO.%' AND LENGTH(warehouse_stock_code) = 15".$product_code_qry;
$warehouse_stock_details_id=$global->db_lastidfilter("warehouse_stock_details","warehouse_stock_details_id",$qry_filter,"warehouse_stock_details_id");
echo $warehouse_stock_details_id;
/*
$taxonomy_special_type_arr=array("cash_bank");
$date_in="06/08/2018";
echo $global->book->balance_first_get($date_in,$taxonomy_special_type_arr);
/*
$service_row=$global->db_row_join("service,category","service.service_sprice","category.category_code='ASS1' AND service.category_code=category.category_code");
echo $service_row['service_sprice'];
/*
$sales_recap_arr=array();
$sales_recap_arr['20180711']['tot']="lol";
if (array_key_exists('20180701', $sales_recap_arr)) {
echo "yes";
}else{
echo "no";
}
/*
$amt=29.98777;
echo number_format($amt, 2, '.', ',');
//echo $global->date_stridtonum("30/06/2018");
//$global->salary->pay_active_payable(70000000,"KAR00001","20180630");
//echo $global->date_numtostr("20180615");
//echo date("t", strtotime("2018-09-07"));
/*
print_r($global->salary->get_service_fee_nonpit("KAR00012","201806"));
print_r($global->salary->get_product_fee_nonpit("KAR00012","201806"));
/*
$date_db="2018-03-21 07:00:00";
echo date('d/m/Y',strtotime($date_db));
//$global->salary->generate_absence("06/2018");
//print_r($global->salary->get_product_fee_nonpit("KAR00011","201806"));
/*
//echo $global->salary->get_service_fee_nonpit("KAR00005","201806");
//print_r($global->salary->get_insentif_nonpit("KAR00005","201806"));
//echo $global->salary->get_product_fee_nonpit("KAR00005","201806");

//print_r($global->salary->get_product_fee_nonpit("KAR00005","201806"));
//echo $global->salary->get_product_fee_all("201806");
//print_r($global->salary->get_daily_insentif("KAR00001","201806"));
//echo $global->salary->get_daily_insentif("KAR00002","201806");

/*
$absence_date=$global->date_stridtonum("08/06/2018");
$absence_row=$global->db_row_join("absence,staff","count(absence.absence_id) as num_work","absence.absence_status='work' AND absence.absence_date='".$absence_date."' AND absence.staff_code=staff.staff_code");
print_r($absence_row);

//print_r($global->salary->get_daily_insentif_nonpit("KAR00002","201805"));
//echo "<br>";
//echo $global->salary->get_daily_insentif_nonpit("KAR00006","201805");
//print_r($global->salary->get_insentif("KAR00001","201806"));
//print_r($global->salary->get_insentif_nonpit("KAR00006","201806"));
//print_r($global->salary->get_insentif_nonpit("KAR00006","201805"));
/*
$set_date=$global->date_stridtonum("30/05/2018");
$start_date = new DateTime($set_date);
$today = date('Y-m-d');
$since_start = $start_date->diff(new DateTime($today));
echo $since_start->days.' days total<br>';
/*
$ckb_id=$_POST['ckb_id'];
$module_sub_code=$_POST['module_sub_code'];
foreach($module_sub_code as $m_key => $m_n) {
	$fu=(isset($_POST['ckb_id'][$m_key]) ? 1 : 0);
	echo "u".$fu;
}


/*
echo $global->book->account_special_get('expense_opname');
echo $global->book->account_special_get('income_opname');
echo $global->book->account_special_get('stock_trade');
//echo $global->product_order->generator_warehouse_stock_edit_code();
/*
$get_receivable_balance=$global->payreceivable->get_receivable_balance("20180401","KAR00002");
print_r($get_receivable_balance);
/*
//$get_absence_row=$global->salary->get_insentif("KAR00002","201803");
//print_r($get_absence_row);
$get_absence_row=$global->salary->get_absence("KAR00002","2018-03");
print_r($get_absence_row);
/*
$favcolor = 100;
switch ($favcolor) {
    case $favcolor >= 75 && $favcolor < 85:
        echo "Your favorite color is red!";
        break;
    case $favcolor >= 85 && $favcolor < 100:
        echo "Your favorite color is blue!";
        break;
    case $favcolor >= 100:
        echo "Your favorite color is green!";
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}
$date_db="19/12/2018";
echo $global->date_stridtonum($date_db);
/*
//$date_db="2018-03-20 8:52:23";
$date_db="2018-03-21 07:00:00";
//$date_db = str_replace('/', '-', $date_db);
$time = strtotime($date_db);

//$newformat = date('Y-m-d',$time);
$newformat = date('H:i:s',$time);

echo $newformat;
//$mysql_date = date('Y-m-d G:i:s',strtotime($_POST['Date'].' '.$_POST['Time'].' '.$_POST['ampm']));
/*
$users_code=$global->db_lastid("users","users_code");
echo $users_code;
$users_id=$global->db_lastid("users","users_id");
echo $users_id;
/*
$create_arr = array(
'tbl_test_code'=>	'a1',
'tbl_test_name'=>	'dublon a1',
'tbl2_test_code'=>	'dub_a1',
);
echo $global->db_insert_update('tbl_test',$create_arr,'tbl_test_code');
/*
$my_sql_date = "2011-07-26 20:05:00";
$date_time_obj = new DateTime($my_sql_date);
echo $date_time_obj->format('G').":".$date_time_obj->format('i');
/*
if($global->tbldata_exist("motorcycle","*","motorcycle_code='DK2122LZ'",$result_row)){
echo "sukses";
print_r($result_row);
}else{
echo "gagal";
print_r($result_row);
}
/*

/*
$to_time = strtotime("2008-02-05 10:42:00");
$from_time = strtotime("2008-02-04 10:21:00");
$total_time=round(abs($to_time - $from_time) / 60,2);
if($total_time<60){
echo $total_time. " minute";
}
if($total_time<=60 && $total_time<1440){
echo $total_time. " minute";
}
/*
$date_now=date('d')."/".date('m')."/".date('Y');
$mkt_date_next=$global->mktime_next($date_now,0,1,0);
echo date("d/m/Y",$mkt_date_next);
/*
if($global->tbldata_exist("motorcycle","*","motorcycle_code='B3904NZF99'")){
echo "sukses";
//print_r($row);
}else{
echo "gagal";
//print_r($row);
}
/*
$stack = array("orange", "banana");
$cok="klor";
array_push($stack, $cok, "apple", "raspberry");
print_r($stack);
/*
$H1=5000;
$D1=3;
$D2=10;
$H3=$H1*(1-(($D1+$D2)/100)+(($D1*$D2)/10000));
echo $H3;
/*
$str_code="FB.201709.00025";
$str_add_def="FB.".date("Y").date("m").".";
$str = substr($str_code, 10);
$str = ltrim($str, '0')+1;
$str_add=5-strlen($str);
$str2 = str_pad($str,(strlen($str) + $str_add),"0",STR_PAD_LEFT);
echo $str_add_def.$str2;
//echo date("d/m/Y",1498168800);
//echo mktime(0,0,0,6,23,2017);
/*
$balance_first_arr=$global->book->balance_first("01/04/2017","cash_bank");
print_r($balance_first_arr);
/*
//1x subsidiary_update
//array cash bank
$cash_bank_list=$global->book->account_parent_special_get("cash_bank");
//select leger
$db_select = $global->db_qry_data("SELECT ledger_id FROM ledger");
$select_data=$db_select['select_data'];
for($j=0;$j<$db_select['select_num'];$j++){
	//echo $select_data[$j]['ledger_id']."<br>";
	$db_select2 = $global->db_qry_data("SELECT ledgerdetails.*,taxonomi.taxonomi_name FROM ledgerdetails,taxonomi WHERE ledgerdetails.ledger_id='".$select_data[$j]['ledger_id']."' AND taxonomi.taxonomi_id IN (".implode(',',$cash_bank_list).") AND ledgerdetails.taxonomi_id=taxonomi.taxonomi_id");
	if($db_select2['select_num']>0){
		//echo $select_data[$j]['ledger_id']."<br>";
		$global->book->subsidiary_update($select_data[$j]['ledger_id']);
		}
	}

//$query=mysqli_query($conn, "SELECT name FROM users WHERE id IN ('".$array."')");
/*
$get_members_capital=$global->koperasi->get_members_capital("%/01/2016",150);
echo $get_members_capital['users_amount'];
//$global->koperasi->auto_savings_interest($dmy_today);
/*
$savings_id=1;
$savings_interest_register_mnt=$global->db_fldrow("savings_interest","savings_interest_register_mnt","savings_id='".$savings_id."'","savings_interest_register_mntnum DESC");
echo $savings_interest_register_mnt;
//potong 1
$sdate="30/02/2016";
$sdate2="02/03/2016";
$date_diff=$global->date_diff_get($sdate,$sdate2);
echo $date_diff['days']."<br>";
echo $date_diff['months'];
/*
$savings_id=1;
echo $global->koperasi->tbldata_exist("savings_trs","*","savings_id='".$savings_id."')");
/*
$mk_today = mktime(0,0,0,date("m"),(int)date("d"),date("Y"));
$savings_due=1529013600;
echo date('d/m/Y',$savings_due)
//$global->koperasi->auto_deposit_trs($mk_today);
/*
$counters_code="";
$str = substr($counters_code, 1);
	
	$str = ltrim($str, '0')+1;
	$str_add=3-strlen($str);
	$str2 = str_pad($str,(strlen($str) + $str_add),"0",STR_PAD_LEFT);
	echo "C".$str2;
/*
$mktimein=1475877600;
echo date("d/m/Y",$mktimein);
/*
$month_year="30/11/2015";
$month_year_exp=$global->month_year_exp($month_year);
$like_month_year=$month_year_exp['month']."/".$month_year_exp['year'];
$counters_id=4;
$db_select2 = $global->db_qry_data("SELECT SUM(counters_sells_selling-counters_sells_buying) as gross_profit FROM counters_sells WHERE counters_id='$counters_id' AND counters_sells_register LIKE '%/$like_month_year' GROUP BY counters_id");
$select_data2=$db_select2['select_data'];
echo (50/100)*$select_data2[0]['gross_profit'];

/*
//select payrecievable
$db_select = $global->db_select("payreceivable","*","","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++)
{
$payreceivable_description=$select_data[$i]['payreceivable_description'];
$ledger_id=$select_data[$i]['ledger_id'];
if($ledger_id>0){
	$update_arr = array(
	'ledger_description'=>	$payreceivable_description,
	);
	//update ledger
	$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");
	}
}

/*
$db_select = $global->db_select("ledgerdetails","*","","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++)
{
$ledgerdetails_id=$select_data[$i]['ledgerdetails_id'];
if($ledgerdetails_id>0){
	$update_arr = array(
	'ledgerdetails_status'=>	'pmn',
	);
	$global->db_update("ledgerdetails",$update_arr,"ledgerdetails_id='".$ledgerdetails_id."'");
	}
}

/*
$db_select = $global->db_select("asset_fixed","*","","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++)
{
$ledger_id=$select_data[$i]['ledger_id'];
if($ledger_id>0){
	$update_arr = array(
	'ledger_module'=>	'asset_fixed',
	);
	$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");
	}
}

$db_select = $global->db_select("depreciation","*","","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++)
{
$ledger_id=$select_data[$i]['ledger_id'];
if($ledger_id>0){
	$update_arr = array(
	'ledger_module'=>	'depreciation',
	);
	$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");
	}
}

$db_select = $global->db_select("counters_sells","*","","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++)
{
$ledger_id=$select_data[$i]['ledger_id'];
if($ledger_id>0){
	$update_arr = array(
	'ledger_module'=>	'counters_sells',
	);
	$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");
	}
}

$db_select = $global->db_select("vallas_opname","*","","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++)
{
$ledger_id=$select_data[$i]['ledger_id'];
if($ledger_id>0){
	$update_arr = array(
	'ledger_module'=>	'vallas_opname',
	);
	$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");
	}
}

$db_select = $global->db_select("payreceivable","*","","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++)
{
$ledger_id=$select_data[$i]['ledger_id'];
if($ledger_id>0){
	$update_arr = array(
	'ledger_module'=>	'payreceivable',
	);
	$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");
	}
}
/*
$date="5/19/2014";
echo date('d/m/Y', strtotime($date));
/*
$qry_arr=array(
"Id_Items int(11) NOT NULL AUTO_INCREMENT",
"Id_Parent int(11) NOT NULL",
"Rank_Items int(11) NOT NULL",
"Code_Items varchar(15) NOT NULL",
"Name_Items varchar(50) NOT NULL",
"Height_Items tinytext NOT NULL",
"Width_Items tinytext NOT NULL",
"Depth_Items tinytext NOT NULL",
"Xinfo_Items varchar(60) NOT NULL",
"Image_Path varchar(60) NOT NULL",
"Imagelarge_Path varchar(60) NOT NULL",
"Finishing_Shown varchar(75) NOT NULL",
"Related_Items tinytext NOT NULL",
"PRIMARY KEY (Id_Items)"
);
echo $global->db_create("Itemstmp",$qry_arr);
/*
$a=0;
if($a!='0'){
echo "ya";
}else{
echo "no";
}
if($global->tbldata_exist("loan,loan_trs_mnt","loan.loan_id","loan.loan_id='7' AND loan.loan_id=loan_trs_mnt.loan_id")){
	echo "ada";
}else{
echo "sing ada";
}
/*
$date_diff=$global->db_row_join("loan,loan_product","loan_product.loan_product_penalty,loan.loan_due_mntnum,loan.loan_amount","loan.loan_id='14' AND loan.loan_product_id=loan_product.loan_product_id");
echo $date_diff['loan_product_penalty'];
/*
$array1 = array(
'loan_trs_id'=>	1,
'loan_trs_mnt_amount'=>	2,);
$array2 = array(
'loan_trs_mnt_interest_amount'=>	3,
'loan_trs_mnt_xperiod'=>	4,);
$array3 = array(
'loan_trs_mnt_register'=>	5,
'loan_trs_mnt_registernum'=>	6,);
$f_arr[0]=$array1;
$f_arr[1]=$array2;
$f_arr[2]=$array3;
$select_data=array();
$tbl="sotong,gula,mon";
if(empty($select_data)){
$tbl_arr=explode(",",$tbl);
for($dt=0;$dt<count($tbl_arr);$dt++){
$select_data=array_merge($select_data, $f_arr[$dt]);
}}
print_r($select_data);
*/
//echo date("d/m/Y",1416524400);
/*
$sdate="20/09/2014";
$date_diff=$global->date_diff_get($sdate,date("d/m/Y"));
echo $date_diff['days']."<br>";
echo $date_diff['months'];
$i=5;
echo $global->month_year_next("01/".date("m/Y"),0,$i+1,0);
if(isset($_POST['Submit'])){
echo count($_POST['users_trs_mnt_amount']);
$users_trs_arr['users_trs_mnt_amount']=9;
$users_trs_arr['users_trs_mnt_register']=8;
unset($users_trs_arr['users_trs_mnt_amount']);
echo $users_trs_arr['users_trs_mnt_amount'];
}
?>
<form action="test.php" method="post" enctype="multipart/form-data" name="form" id="form">
<input name="users_trs_mnt_amount[0]" type="text" class="textbox" id="users_trs_mnt_amount[0]">
<input name="users_trs_mnt_amount[1]" type="text" class="textbox" id="users_trs_mnt_amount[1]">
<button name="Submit" class="btn btn-primary" id="Submit">Submit</button>
</form>
*/
?>