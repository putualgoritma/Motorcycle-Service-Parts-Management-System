<?php
require_once(SITE_ROOT."book/models/book/book.class.php");
class payreceivable extends global_class 
{
public $err_msg;
public $payreceivable_lang;
function __construct()
	{
	include(SITE_ROOT."config/global.php");
	include(SITE_ROOT."payreceivable/lang/".$glob_config['db_config']['lang']."/lang.php");
	parent::__construct();
	$this->book = new book();
	$this->payreceivable_lang = $payreceivable_lang;
	}	

//receivable
function delete_receivable($payreceivable_id,$ext=0)
	{
	$result = true;
	//validate
	//if not related to others trs
	//$this->err_msg=$users_code;
	//delete users
	if($result){
		//if utang in used
		$utang_row=$this->db_row("payreceivable","payreceivable_uneditable,ledger_id,payrecievable_set_id","payreceivable_id='".$payreceivable_id."'");
		if($utang_row['payreceivable_uneditable'] !=1 || $ext==1)
			{
			$this->db_delete("ledgerdetails","ledger_id='".$utang_row['ledger_id']."'");
			$this->db_delete("ledger","ledger_id='".$utang_row['ledger_id']."'");
			$this->db_delete("payreceivable_details","payreceivable_rel_id='".$payreceivable_id."'");
			$this->db_delete("payreceivable","payreceivable_id='".$payreceivable_id."'");
    		//loop reset set payreceivable_paid_status
			$payrecievable_set_id_arr=explode(",",$utang_row['payrecievable_set_id']);
			foreach($payrecievable_set_id_arr as $key => $payrecievable_set_id_val ) {
				//update items
				$update_arr = array(
				'payreceivable_paid_status '=>	0,
				);
				$this->db_update("payreceivable",$update_arr,"payreceivable_id='".$payrecievable_set_id_val."'");
				}
			}
		//on delete
		}
  	return $result;
	}

function create_receivable($payreceivable_arr,$ledger_status=0,$set_rekening="")
	{
	$result = true;
	//validate
	//if not redundant
	//create receivable
	if($result){
		//before create
		if($ledger_status==0){
		if($payreceivable_arr['payreceivable_status']==1){
			//if bayar
			//$ledger_description=$this->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus']." ".$this->payreceivable_lang['menu_payreceivable_lang']['receivable']." - ".$payreceivable_arr['payreceivable_code']." - ".$payreceivable_arr['payreceivable_register'];
			$ledger_description=$payreceivable_arr['payreceivable_description'];
			}else{
			//if tambah
			//$ledger_description=$this->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus']." ".$this->payreceivable_lang['menu_payreceivable_lang']['receivable']." - ".$payreceivable_arr['payreceivable_code']." - ".$payreceivable_arr['payreceivable_register'];
			$ledger_description=$payreceivable_arr['payreceivable_description'];
			}
		if($set_rekening==""){
			$set_rekening=array($payreceivable_arr['payreceivable_accountdebit'],"D",$payreceivable_arr['payreceivable_amount'],$payreceivable_arr['payreceivable_accountcredit'],"K",$payreceivable_arr['payreceivable_amount']);
			}
		//post ledger
		$ledger_id=$this->book->ledger_post($payreceivable_arr['payreceivable_register'],1,$ledger_description,$set_rekening,$payreceivable_arr['payreceivable_registernum'],0,"payreceivable");
		//insert payreceivable payment
		$payreceivable_arr['ledger_id']=$ledger_id;
		$this->book->subsidiary_update($ledger_id);
		}
		//before insert
		//regenerate
		$valid_date=$this->valid_date($payreceivable_arr['payreceivable_register']);
		$payreceivable_arr['payreceivable_code']=$this->generator_receivable($valid_date['date_monthnum'],$payreceivable_arr['payreceivable_status']);
		//insert
		$this->db_insert("payreceivable",$payreceivable_arr);
		}
  	return $result;
	}
	
function update_receivable($payreceivable_arr,$payreceivable_id,$set_rekening="")
	{
	$result = true;
	//validate
	//update users
	if($result){
		//before update
		//update ledger
		$utang_row=$this->db_row("payreceivable","*","payreceivable_id='".$payreceivable_id."'");
		if($utang_row['ledger_id']>0){
		if($payreceivable_arr['payreceivable_status']==1){
			//if bayar
			//$ledger_description=$this->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus']." ".$this->payreceivable_lang['menu_payreceivable_lang']['receivable']." - ".$payreceivable_arr['payreceivable_code']." - ".$payreceivable_arr['payreceivable_register'];
			$ledger_description=$payreceivable_arr['payreceivable_description'];
			}else{
			//if tambah
			//$ledger_description=$this->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus']." ".$this->payreceivable_lang['menu_payreceivable_lang']['receivable']." - ".$payreceivable_arr['payreceivable_code']." - ".$payreceivable_arr['payreceivable_register'];
			$ledger_description=$payreceivable_arr['payreceivable_description'];
			}
		if($set_rekening==""){
			$set_rekening=array($payreceivable_arr['payreceivable_accountdebit'],"D",$payreceivable_arr['payreceivable_amount'],$payreceivable_arr['payreceivable_accountcredit'],"K",$payreceivable_arr['payreceivable_amount']);
			}
		$this->book->ledgerdesc_update($utang_row['ledger_id'],$ledger_description,$payreceivable_arr['payreceivable_register'],$payreceivable_arr['payreceivable_registernum'],0);
		$this->book->ledgerdetails_update($utang_row['ledger_id'],$payreceivable_arr['payreceivable_register'],$set_rekening);
		$this->book->subsidiary_update($utang_row['ledger_id']);
		}
		//before update
		//if exist regenerate
		$payreceivable_arr['payreceivable_code']=$utang_row['payreceivable_code'];
		$valid_date=$this->valid_date($payreceivable_arr['payreceivable_register']);
		if($this->tbldata_exist("payreceivable","payreceivable_id","payreceivable_code='".$payreceivable_arr['payreceivable_code']."' AND payreceivable_id!='".$payreceivable_id."'") || $valid_date['date_registernum']!=$utang_row['payreceivable_registernum']){
			$payreceivable_arr['payreceivable_code']=$this->generator_receivable($valid_date['date_monthnum'],$payreceivable_arr['payreceivable_status']);
			}
		//update
		$this->db_update("payreceivable",$payreceivable_arr,"payreceivable_id='".$payreceivable_id."'");
		//on update
		}
  	return $result;
	}

//payable
function delete_payable($payreceivable_id,$ext=0)
	{
	$result = true;
	//validate
	//if not related to others trs
	//$this->err_msg=$users_code;
	//delete users
	if($result){
		//if utang in used
		$utang_row=$this->db_row("payreceivable","payreceivable_uneditable,ledger_id,payrecievable_set_id","payreceivable_id='".$payreceivable_id."'");
		if($utang_row['payreceivable_uneditable'] !=1 || $ext==1)
			{
			$this->db_delete("ledgerdetails","ledger_id='".$utang_row['ledger_id']."'");
			$this->db_delete("ledger","ledger_id='".$utang_row['ledger_id']."'");
			$this->db_delete("payreceivable_details","payreceivable_rel_id='".$payreceivable_id."'");
			$this->db_delete("payreceivable","payreceivable_id='".$payreceivable_id."'");
			//loop reset set payreceivable_paid_status
			$payrecievable_set_id_arr=explode(",",$utang_row['payrecievable_set_id']);
			foreach($payrecievable_set_id_arr as $key => $payrecievable_set_id_val ) {
				//update items
				$update_arr = array(
				'payreceivable_paid_status '=>	0,
				);
				$this->db_update("payreceivable",$update_arr,"payreceivable_id='".$payrecievable_set_id_val."'");
				}
			}
		//on delete
		}
  	return $result;
	}

function create_payable($payreceivable_arr,$ledger_status=0,$set_rekening="")
	{
	$result = true;
	//validate
	//if not redundant
	//create payable
	if($result){
		//before create
		if($ledger_status==0){
		if($payreceivable_arr['payreceivable_status']==1){
			//if bayar
			//$ledger_description=$this->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus']." ".$this->payreceivable_lang['menu_payreceivable_lang']['payable']." - ".$payreceivable_arr['payreceivable_code']." - ".$payreceivable_arr['payreceivable_register'];
			$ledger_description=$payreceivable_arr['payreceivable_description'];
			}else{
			//if tambah
			//$ledger_description=$this->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus']." ".$this->payreceivable_lang['menu_payreceivable_lang']['payable']." - ".$payreceivable_arr['payreceivable_code']." - ".$payreceivable_arr['payreceivable_register'];
			$ledger_description=$payreceivable_arr['payreceivable_description'];
			}
		if($set_rekening==""){
		$set_rekening=array($payreceivable_arr['payreceivable_accountdebit'],"D",$payreceivable_arr['payreceivable_amount'],$payreceivable_arr['payreceivable_accountcredit'],"K",$payreceivable_arr['payreceivable_amount']);
		}
		//post ledger
		$ledger_id=$this->book->ledger_post($payreceivable_arr['payreceivable_register'],1,$ledger_description,$set_rekening,$payreceivable_arr['payreceivable_registernum'],0,"payreceivable");
		//insert payreceivable payment
		$payreceivable_arr['ledger_id']=$ledger_id;
		$this->book->subsidiary_update($ledger_id);
		}
		//before insert
		//regenerate
		$valid_date=$this->valid_date($payreceivable_arr['payreceivable_register']);
		$payreceivable_arr['payreceivable_code']=$this->generator_payable($valid_date['date_monthnum'],$payreceivable_arr['payreceivable_status']);
		//insert
		//$result=$payreceivable_arr;
		$this->db_insert("payreceivable",$payreceivable_arr);
		}
  	return $result;
	}
	
function update_payable($payreceivable_arr,$payreceivable_id,$set_rekening="")
	{
	$result = true;
	//validate
	//update users
	if($result){
		//before update
		//update ledger
		$utang_row=$this->db_row("payreceivable","*","payreceivable_id='".$payreceivable_id."'");
		if($utang_row['ledger_id']>0){
		if($payreceivable_arr['payreceivable_status']==1){
			//if bayar
			//$ledger_description=$this->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus']." ".$this->payreceivable_lang['menu_payreceivable_lang']['payable']." - ".$payreceivable_arr['payreceivable_code']." - ".$payreceivable_arr['payreceivable_register'];
			$ledger_description=$payreceivable_arr['payreceivable_description'];
			}else{
			//if tambah
			//$ledger_description=$this->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus']." ".$this->payreceivable_lang['menu_payreceivable_lang']['payable']." - ".$payreceivable_arr['payreceivable_code']." - ".$payreceivable_arr['payreceivable_register'];
			$ledger_description=$payreceivable_arr['payreceivable_description'];
			}
		if($set_rekening==""){
		$set_rekening=array($payreceivable_arr['payreceivable_accountdebit'],"D",$payreceivable_arr['payreceivable_amount'],$payreceivable_arr['payreceivable_accountcredit'],"K",$payreceivable_arr['payreceivable_amount']);
		}
		$this->book->ledgerdesc_update($utang_row['ledger_id'],$ledger_description,$payreceivable_arr['payreceivable_register'],$payreceivable_arr['payreceivable_registernum'],0);
		$this->book->ledgerdetails_update($utang_row['ledger_id'],$payreceivable_arr['payreceivable_register'],$set_rekening);
		$this->book->subsidiary_update($utang_row['ledger_id']);
		}
		//before update
		//if exist regenerate
		$payreceivable_arr['payreceivable_code']=$utang_row['payreceivable_code'];
		$valid_date=$this->valid_date($payreceivable_arr['payreceivable_register']);
		if($this->tbldata_exist("payreceivable","payreceivable_id","payreceivable_code='".$payreceivable_arr['payreceivable_code']."' AND payreceivable_id!='".$payreceivable_id."'") || $valid_date['date_registernum']!=$utang_row['payreceivable_registernum']){
			$payreceivable_arr['payreceivable_code']=$this->generator_payable($valid_date['date_monthnum'],$payreceivable_arr['payreceivable_status']);
			}
		//update
		$this->db_update("payreceivable",$payreceivable_arr,"payreceivable_id='".$payreceivable_id."'");
		//on update
		}
  	return $result;
	}

function payreceivable_balance($qry_arr)
	{
	$return_arr=array();
	$balance=0;
	$account_arr=array();
	$payreceivable_add=0;
	$payreceivable_pay=0;
	for($i=0;$i<count($qry_arr);$i++){
		if(($qry_arr[$i]['payreceivable_type']==0 && $qry_arr[$i]['payreceivable_status']==0) || ($qry_arr[$i]['payreceivable_type']==1 && $qry_arr[$i]['payreceivable_status']==1)){
		if($qry_arr[$i]['payreceivable_type']==0){
		$payreceivable_add+=$qry_arr[$i]['payreceivable_amount'];
		}else{
		$payreceivable_pay+=$qry_arr[$i]['payreceivable_amount'];
		}
		//get taxonomy
		$account_arr[$i]=$this->book->taxonomi_get($qry_arr[$i]['payreceivable_accountcredit']);
		}else if(($qry_arr[$i]['payreceivable_type']==0 && $qry_arr[$i]['payreceivable_status']==1) || ($qry_arr[$i]['payreceivable_type']==1 && $qry_arr[$i]['payreceivable_status']==0)){
		if($qry_arr[$i]['payreceivable_type']==0){
		$payreceivable_pay+=$qry_arr[$i]['payreceivable_amount'];
		}else{
		$payreceivable_add+=$qry_arr[$i]['payreceivable_amount'];
		}
		//get taxonomy
		$account_arr[$i]=$this->book->taxonomi_get($qry_arr[$i]['payreceivable_accountdebit']);
		}
		}
	$balance=$payreceivable_add-$payreceivable_pay;
	$return_arr['balance']=$balance;
	$return_arr['account']=$account_arr;
	return $return_arr;
	}
	
function receivable_report_balance($taxonomi_id,$users_code,$current_date="%/%/%",$key=0)
	{
	$receivable_add=0;
	$receivable_pay=0;
	if($current_date=="%/%/%"){
		$month_year=date('d/m/Y');
		}else{
		$month_year=$current_date;
		}
	if($key==0){
		$month_year_prev=date("d/m/Y",$this->mktime_next($month_year,0,-1,0));
		$reg_min=$this->regnum($month_year_prev,3);
		$reg_max=$this->regnum($month_year_prev,4);
		$db_select = parent::db_select("payreceivable","*","(payreceivable_accountdebit = '".$taxonomi_id."' OR payreceivable_accountcredit = '".$taxonomi_id."') AND payreceivable_type = '1' AND users_code = '".$users_code."' AND (payreceivable_registernum BETWEEN $reg_min AND $reg_max) AND receivable_members_pay_id = '0'","",0,0);
		}
	if($key==1){
		$reg_min=$this->regnum($month_year,1);
		$reg_max=$this->regnum($month_year,4);
		$db_select = parent::db_select("payreceivable","*","(payreceivable_accountdebit = '".$taxonomi_id."' OR payreceivable_accountcredit = '".$taxonomi_id."') AND payreceivable_type = '1' AND users_code = '".$users_code."' AND (payreceivable_registernum BETWEEN $reg_min AND $reg_max)","",0,0);
		}
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		if($select_data[$i]['payreceivable_status']==0){
		$receivable_add+=$select_data[$i]['payreceivable_amount'];
		}else{
		$receivable_pay+=$select_data[$i]['payreceivable_amount'];
		}}
	$payreceivable_register_now=$this->month_year_next($month_year,0,0,0);
	$payreceivable_amount_paid=$this->db_fldrow("payreceivable","payreceivable_amount","payreceivable_accountcredit = '".$taxonomi_id."' AND payreceivable_register LIKE '%/".$payreceivable_register_now."' AND receivable_members_pay_id > '0'");
	$balance=$receivable_add-$receivable_pay;
	if($balance>0){
		$balance=$balance-$payreceivable_amount_paid;
		}
	return $balance;
	}
	
function receivable_report_balance_total($account_special,$users_code,$current_date="%/%/%",$key=0)
	{
	$users_receivable_total=0;
	$account_special_arr=$this->book->account_special_arr($account_special);
	for($i=0;$i<count($account_special_arr);$i++){
		$users_receivable_total+=$this->receivable_report_balance($account_special_arr[$i],$users_code,$current_date,$key);
		}
	return $users_receivable_total;
	}
	
function receivable_pay_balance_total($account_special,$users_code,$receivable_members_pay_id,$receivable_members_pay_arr,$period)
	{
	$users_row=$this->db_row("users","users_name,users_code","users_code='".$users_code."'");
	$account_special_arr=$this->book->account_special_arr($account_special);
	$month_year_period="10/".$period;
	for($i=0;$i<count($account_special_arr);$i++){
		$receivable_report_balance=$this->receivable_report_balance($account_special_arr[$i],$users_code,$month_year_period);
		if($receivable_report_balance>0){
		//insert items
		$create_arr = array(
		'users_code'=>	$users_code,
		'payreceivable_register'=>	$receivable_members_pay_arr['receivable_members_pay_register'],
		'payreceivable_registernum'=>	$receivable_members_pay_arr['receivable_members_pay_registernum'],
		'payreceivable_code'=>	$this->payreceivable_lang['form_header_payreceivable_lang']['receivable_minus_auto'],
		'payreceivable_description'=>	$this->payreceivable_lang['form_header_payreceivable_lang']['receivable_minus_auto']."-".$users_row['users_code']."-".$users_row['users_name'],
		'payreceivable_amount'=>	$receivable_report_balance,
		'payreceivable_uneditable'=>	1,
		'payreceivable_accountdebit'=>	$this->book->account_special_get("cash"),
		'payreceivable_accountcredit'=>	$account_special_arr[$i],
		'payreceivable_type'=>	1,
		'payreceivable_status'=>	1,
		'receivable_members_pay_id'=>	$receivable_members_pay_id,
		);
		//create receivable payment
		if(!$this->create_receivable($create_arr)){
			$this->error_message($this->err_msg);
			}
		}}
	}
	
function get_receivable_paid($payreceivable_code)
	{
	$return_val=array();
	$paid_amount=0;
	$db_select = $this->db_select("payreceivable_details","payreceivable_details_amount","payreceivable_code = '".$payreceivable_code."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$paid_amount+=$select_data[$i]['payreceivable_details_amount'];
		}
	return $paid_amount;
	}

function get_receivable_balance($date_registernum,$staff_code,$receivable_balance_cashbon=0,$receivable_balance_tenor_def=0)
	{
	$return_val=array();
	$receivable_balance_tenor=0;
	$db_select = $this->db_select("payreceivable","*","payreceivable_type='1' AND payreceivable_status='0' AND payreceivable_paid_status='0' AND staff_code='".$staff_code."' AND payreceivable_registernum <= '".$date_registernum."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		//if non tenor
		$paid_amount=$this->get_receivable_paid($select_data[$i]['payreceivable_code']);
		if($select_data[$i]['payreceivable_tenor']<=1){
			//get paid
			$receivable_balance_cashbon+=($select_data[$i]['payreceivable_amount']-$paid_amount);
			}else{
			$receivable_balance_tenor+=(($select_data[$i]['payreceivable_amount']-$paid_amount)/$select_data[$i]['payreceivable_tenor']);
			}
		}
	if($receivable_balance_tenor==0){
		$receivable_balance_tenor=$receivable_balance_tenor_def;
		}
	$return_val['receivable_balance_cashbon']=$receivable_balance_cashbon;
	$return_val['receivable_balance_tenor']=$receivable_balance_tenor;
	return $return_val;
	}
	
//code generator
function generator_code($str_code,$str_add_def,$substr_ind=10,$str_add_ind=5)
	{
	$str = substr($str_code, $substr_ind);
	
	if($str==""){
		$str = 1;
		}else{
		$str = ltrim($str, '0')+1;
		}
	$str_add=$str_add_ind-strlen($str);
	$str2 = str_pad($str,(strlen($str) + $str_add),"0",STR_PAD_LEFT);
	return $str_add_def.$str2;
	}
	
//receivable code generator
function generator_receivable_pay()
	{
	$db_select = $this->db_select("payreceivable_pay","payreceivable_pay_code","payreceivable_pay_type=1","payreceivable_pay_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$product_order_code=$select_data[0]['payreceivable_pay_code'];
	$str_add_def="BP.".date("Y").date("m").".";
	return $this->generator_code($product_order_code,$str_add_def);
	}
	
//receivable code generator
function generator_receivable($payreceivable_registernum="",$status=0)
	{
	if($payreceivable_registernum==""){
		$payreceivable_registernum=intval(date("Y").date("m"));
		}
	$add_str="TP.";
	if($status==1){
		$add_str="BP.";
		}
	$db_select = $this->db_select("payreceivable","payreceivable_code","payreceivable_type=1 AND payreceivable_registernum LIKE'".$payreceivable_registernum."%' AND payreceivable_status ='".$status."'","payreceivable_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$product_order_code=$select_data[0]['payreceivable_code'];
	$str_add_def=$add_str.$payreceivable_registernum.".";
	return $this->generator_code($product_order_code,$str_add_def);
	}
	
//receivable code generator
function generator_payable($payreceivable_registernum="",$status=0)
	{
	if($payreceivable_registernum==""){
		$payreceivable_registernum=intval(date("Y").date("m"));
		}
	$add_str="TU.";
	if($status==1){
		$add_str="BU.";
		}
	$db_select = $this->db_select("payreceivable","payreceivable_code","payreceivable_type=0 AND payreceivable_registernum LIKE'".$payreceivable_registernum."%' AND payreceivable_status ='".$status."'","payreceivable_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$product_order_code=$select_data[0]['payreceivable_code'];
	$str_add_def=$add_str.$payreceivable_registernum.".";
	return $this->generator_code($product_order_code,$str_add_def);
	}
	
	
}
?>
