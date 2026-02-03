<?php
require_once(SITE_ROOT."payreceivable/models/payreceivable/payreceivable.class.php");
require_once(SITE_ROOT."book/models/book/book.class.php");
class product_order extends global_class 
{
public $err_msg;
public $product_order_lang;
function __construct()
	{
	include(SITE_ROOT."config/global.php");
	include(SITE_ROOT."product-service/lang/".$glob_config['db_config']['lang']."/lang.php");
	parent::__construct();
	$this->book = new book();
	$this->payreceivable = new payreceivable();
	$this->product_order_lang = $product_order_lang;
	}

//service vendor
function insert_service_vendor($service_order_arr,$service_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create service_order
	if($result){
		//before update
		if($service_order_arr['service_order_status']=="pmn"){
		//get amount
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['service_vendor_new']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['service_vendor_new']." - ".$service_order_arr['service_order_code'];
		$payreceivable_type=0;
		//if cash or not
		if($service_order_arr['service_order_pay_method']=="credit"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['service_order_payable']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_register'];
			//insert items
			$create_arr = array(
			'users_code'=>	$service_order_arr['users_code'],
			'payreceivable_register'=>	$service_order_arr['service_order_register'],
			'payreceivable_registernum'=>	$service_order_arr['service_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$service_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$service_order_arr['service_order_accountdebit'],
			'payreceivable_accountcredit'=>	$service_order_arr['service_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			if($this->payreceivable->create_payable($create_arr)){
				$service_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}	
			}else{
			//post ledger
			$set_rekening=array($service_order_arr['service_order_accountdebit'],"D",$service_order_amount,$service_order_arr['service_order_accountcredit'],"K",$service_order_amount);
			$ledger_id=$this->book->ledger_post($service_order_arr['service_order_register'],1,$ledger_description,$set_rekening,$service_order_arr['service_order_registernum'],0);
			//insert service_order payment
			$service_order_arr['ledger_id']=$ledger_id;
			}}
		//update
		$this->db_insert("service_order",$service_order_arr);
		}
  	return $result;
	}
	
function update_service_vendor($service_order_arr,$service_order_id,$service_order_amount)
	{
	$result = true;
	$service_order_pay_method_unmatch=false;
	//validate
	//if not redundant
	//create service_order
	if($result){
		//before update
		//if pmn paid
		if($service_order_arr['service_order_status']=="pmn"){
		//get amount
		$service_order_row=$this->db_row("service_order","ledger_id,payreceivable_id,service_order_pay_method","service_order_id='".$service_order_id."'");
		//delete old payment if not match
		if($service_order_row['service_order_pay_method']!=$service_order_arr['service_order_pay_method']){
			$service_order_pay_method_unmatch=true;
			//if old cash/bank
			if($service_order_row['service_order_pay_method']!="credit"){
				//delete ledger
				$this->db_delete("ledgerdetails","ledger_id='".$service_order_row['ledger_id']."'");
				$this->db_delete("ledger","ledger_id='".$service_order_row['ledger_id']."'");
				//clear ledger id 0
				$update_arr = array(
				'ledger_id'=>	0,
				);
				$this->db_update("service_order",$update_arr,"service_order_id='".$service_order_id."'");
				}
			//if old credit
			if($service_order_row['service_order_pay_method']=="credit"){
				//delete payreceivable
				$this->payreceivable->delete_payable($service_order_row['payreceivable_id'],1);
				//clear payreceivable id 0
				$update_arr = array(
				'payreceivable_id'=>	0,
				);
				$this->db_update("service_order",$update_arr,"service_order_id='".$service_order_id."'");
				}
			}
		//if buy
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['service_vendor_new']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['service_vendor_new']." - ".$service_order_arr['service_order_code'];
		$payreceivable_type=0;
		//if cash or not
		if($service_order_arr['service_order_pay_method']=="credit"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['service_order_payable']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_register'];
			//insert items
			$update_arr = array(
			'users_code'=>	$service_order_arr['users_code'],
			'payreceivable_register'=>	$service_order_arr['service_order_register'],
			'payreceivable_registernum'=>	$service_order_arr['service_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$service_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$service_order_arr['service_order_accountdebit'],
			'payreceivable_accountcredit'=>	$service_order_arr['service_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			//if unmatch
			if($service_order_pay_method_unmatch){
				//create
				if($this->payreceivable->create_payable($update_arr)){
				$service_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}else{
				//update
				$service_order_arr['payreceivable_id']=$service_order_row['payreceivable_id'];
				if($this->payreceivable->update_payable($update_arr,$service_order_row['payreceivable_id'])){
				}}
			//if cash
			}else{
			//post ledger
			$set_rekening=array($service_order_arr['service_order_accountdebit'],"D",$service_order_amount,$service_order_arr['service_order_accountcredit'],"K",$service_order_amount);
			//if unmatch
			if($service_order_pay_method_unmatch){
				//post ledger
				$ledger_id=$this->book->ledger_post($service_order_arr['service_order_register'],1,$ledger_description,$set_rekening,	$service_order_arr['service_order_registernum'],0);
				$service_order_arr['ledger_id']=$ledger_id;
				}else{
				//update ledger
				$this->book->ledgerdesc_update($service_order_row['ledger_id'],$ledger_description,$service_order_arr['users_trs_register'],$service_order_arr['users_trs_registernum'],0,$service_order_arr['users_code']);
				$this->book->ledgerdetails_update($service_order_row['ledger_id'],$service_order_arr['users_trs_register'],$set_rekening);
				$service_order_arr['ledger_id']=$service_order_row['ledger_id'];
				}
			}}
		//update
		$this->db_update("service_order",$service_order_arr,"service_order_id='".$service_order_id."'");
		}
  	return $result;
	}

//warehouse_stock_ledger
function stock_opname_ledger($warehouse_stock_code,$date_register,$date_registernum)
	{
	$product_bprice_total=0;
	$db_select = $this->db_select("warehouse_stock_details","product_code,warehouse_stock_details_quantity","warehouse_stock_code='".$warehouse_stock_code."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$product_bprice=$this->db_fldrow("product","product_bprice","product_code='".$select_data[$i]['product_code']."'");
		$product_bprice_total +=$product_bprice*$select_data[$i]['warehouse_stock_details_quantity'];
		}
	//create ledger & update $warehouse_stock_id
	$expense_opname_acc=$this->book->account_special_get('expense_opname');
	$income_opname_acc=$this->book->account_special_get('income_opname');
	$stock_trade_acc=$this->book->account_special_get('stock_trade');
	$ledger_description="Jurnal Penyesuaian Persediaan Barang";
	//stok real -
	if($product_bprice_total>=0){
		$adjust_amount=$product_bprice_total*1;
		$set_rekening=array($stock_trade_acc,"D",$adjust_amount,$income_opname_acc,"K",$adjust_amount);
		}
	//stok real +
	if($product_bprice_total<0){
		$adjust_amount=$product_bprice_total*-1;
		$set_rekening=array($stock_trade_acc,"K",$adjust_amount,$expense_opname_acc,"D",$adjust_amount);
		}
	$ledger_id=$this->book->ledger_post($date_register,1,$ledger_description,$set_rekening,$date_registernum,0);
	$update_arr = array(
	'ledger_id'=>	$ledger_id,
	);
	$this->db_update("warehouse_stock",$update_arr,"warehouse_stock_code='".$warehouse_stock_code."'");
	}

function stock_init_ledger($warehouse_stock_code,$date_register,$date_registernum)
	{
	$product_bprice_total=0;
	$db_select = $this->db_select("warehouse_stock_details","product_code,warehouse_stock_details_quantity","warehouse_stock_code='".$warehouse_stock_code."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$product_bprice=$this->db_fldrow("product","product_bprice","product_code='".$select_data[$i]['product_code']."'");
		$product_bprice_total +=$product_bprice*$select_data[$i]['warehouse_stock_details_quantity'];
		}
	//create ledger & update $warehouse_stock_id
	$expense_opname_acc=$this->book->account_special_get('capital_acc');
	$income_opname_acc=$this->book->account_special_get('capital_acc');
	$stock_trade_acc=$this->book->account_special_get('stock_trade');
	$ledger_description="Jurnal Penyesuaian Persediaan Barang";
	//stok real -
	if($product_bprice_total>=0){
		$adjust_amount=$product_bprice_total*1;
		$set_rekening=array($stock_trade_acc,"D",$adjust_amount,$income_opname_acc,"K",$adjust_amount);
		}
	//stok real +
	if($product_bprice_total<0){
		$adjust_amount=$product_bprice_total*-1;
		$set_rekening=array($stock_trade_acc,"K",$adjust_amount,$expense_opname_acc,"D",$adjust_amount);
		}
	$ledger_id=$this->book->ledger_post($date_register,1,$ledger_description,$set_rekening,$date_registernum,0);
	$update_arr = array(
	'ledger_id'=>	$ledger_id,
	);
	$this->db_update("warehouse_stock",$update_arr,"warehouse_stock_code='".$warehouse_stock_code."'");
	}

//warehouse_stock
function delete_warehouse_stock($warehouse_stock_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$warehouse_stock_code=$this->db_fldrow("warehouse_stock","warehouse_stock_code","warehouse_stock_id='".$warehouse_stock_id."'");
	//delete warehouse_stock
	if($result){
		$warehouse_stock_row=$this->db_row("warehouse_stock","ledger_id","warehouse_stock_id='".$warehouse_stock_id."'");
		$this->db_delete("ledgerdetails","ledger_id='".$warehouse_stock_row['ledger_id']."'");
		$this->db_delete("ledger","ledger_id='".$warehouse_stock_row['ledger_id']."'");
		$this->db_delete("warehouse_stock_details","warehouse_stock_code='".$warehouse_stock_code."'");
		$this->db_delete("warehouse_stock","warehouse_stock_id='".$warehouse_stock_id."'");
		//on delete
		}
  	return $result;
	}

function create_warehouse_stock($warehouse_stock_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($warehouse_stock_arr['warehouse_stock_code'])!="" && $this->tbldata_exist("warehouse_stock","warehouse_stock_id","warehouse_stock_code='".trim($warehouse_stock_arr['warehouse_stock_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['warehouse_stock_code'];
		$result = false;
		}
	//create warehouse_stock
	if($result){
		$this->db_insert("warehouse_stock",$warehouse_stock_arr);
		//on create
		}
  	return $result;
	}
	
function update_warehouse_stock($warehouse_stock_arr,$warehouse_stock_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($warehouse_stock_arr['warehouse_stock_code'])!="" && $this->tbldata_exist("warehouse_stock","warehouse_stock_id","warehouse_stock_code='".trim($warehouse_stock_arr['warehouse_stock_code'])."' AND warehouse_stock_id!='".$warehouse_stock_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['warehouse_stock_code'];
		$result = false;
		}
	//update warehouse_stock
	if($result){
		$this->db_update("warehouse_stock",$warehouse_stock_arr,"warehouse_stock_id='".$warehouse_stock_id."'");
		//on update
		}
  	return $result;
	}

//warehouse
function delete_warehouse($warehouse_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$warehouse_row=$this->db_row("warehouse","*","warehouse_id='".$warehouse_id."'");
	$warehouse_code=$warehouse_row['warehouse_code'];
	if($this->tbldata_exist("warehouse_product","warehouse_product_id","warehouse_code='".$warehouse_code."'") || $warehouse_row['warehouse_default']==1){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['warehouse_used'];
		$result = false;
		}
	//delete warehouse
	if($result){
		$taxonomi_id=$warehouse_row['taxonomi_id'];
		$taxonomi_row=$this->db_row("taxonomi","taxonomi_code,taxonomy_special_type","taxonomi_id='".$taxonomi_id."'");
		if(!($this->tbldata_exist("ledgerdetails","*","taxonomi_id='".$taxonomi_id."'")) && ($taxonomi_row['taxonomy_special_type']=='0') && !($this->tbldata_exist("taxonomi","*","taxonomi_parent='".$taxonomi_row['taxonomi_code']."'")))
			{
			$this->db_delete("taxonomi","taxonomi_id='".$taxonomi_id."'");
			}
		$this->db_delete("warehouse","warehouse_id='".$warehouse_id."'");
		//on delete
		}
  	return $result;
	}

function create_warehouse($warehouse_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($warehouse_arr['warehouse_code'])!="" && $this->tbldata_exist("warehouse","warehouse_id","warehouse_code='".trim($warehouse_arr['warehouse_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['warehouse_code'];
		$result = false;
		}
	//create warehouse
	if($result){
		$this->db_insert("warehouse",$warehouse_arr);
		//on create
		}
  	return $result;
	}
	
function update_warehouse($warehouse_arr,$warehouse_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($warehouse_arr['warehouse_code'])!="" && $this->tbldata_exist("warehouse","warehouse_id","warehouse_code='".trim($warehouse_arr['warehouse_code'])."' AND warehouse_id!='".$warehouse_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['warehouse_code'];
		$result = false;
		}
	//update warehouse
	if($result){
		$this->db_update("warehouse",$warehouse_arr,"warehouse_id='".$warehouse_id."'");
		//on update
		}
  	return $result;
	}


//motorcycle_model
function delete_motorcycle_model($motorcycle_model_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	if($this->tbldata_exist("motorcycle_type","motorcycle_type_id","motorcycle_model_id='".$motorcycle_model_id."'")){
		$this->err_msg=$this->motorcycle_model_order_lang['msgform_product_order_lang']['motorcycle_model_used'];
		$result = false;
		}
	//delete motorcycle_model
	if($result){
		$this->db_delete("motorcycle_model","motorcycle_model_id='".$motorcycle_model_id."'");
		//on delete
		}
  	return $result;
	}

function create_motorcycle_model($motorcycle_model_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($motorcycle_model_arr['motorcycle_model_code'])!="" && $this->tbldata_exist("motorcycle_model","motorcycle_model_id","motorcycle_model_code='".trim($motorcycle_model_arr['motorcycle_model_code'])."'")){
		//$this->err_msg=$this->motorcycle_model_order_lang['msgform_motorcycle_model_order_lang']['motorcycle_model_code'];
		//$result = false;
		}
	//create motorcycle_model
	if($result){
		$this->db_insert("motorcycle_model",$motorcycle_model_arr);
		//on create
		}
  	return $result;
	}
	
function update_motorcycle_model($motorcycle_model_arr,$motorcycle_model_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($motorcycle_model_arr['motorcycle_model_code'])!="" && $this->tbldata_exist("motorcycle_model","motorcycle_model_id","motorcycle_model_code='".trim($motorcycle_model_arr['motorcycle_model_code'])."' AND motorcycle_model_id!='".$motorcycle_model_id."'")){
		//$this->err_msg=$this->motorcycle_model_order_lang['msgform_motorcycle_model_order_lang']['motorcycle_model_code'];
		//$result = false;
		}
	//update motorcycle_model
	if($result){
		$this->db_update("motorcycle_model",$motorcycle_model_arr,"motorcycle_model_id='".$motorcycle_model_id."'");
		//on update
		}
  	return $result;
	}

//service_order
function cancel_service_order($service_order_id,$contact_code,$service_order_cancel_note)
	{
	$result = true;
	//validate
	//if not related to others trs
	//$this->err_msg=$users_code;
	//delete users
	if($result){
		//update status service order
		$update_arr = array(
		'service_order_status'=>	"cancel",
		'contact_code'=>	$contact_code,
		'service_order_cancel_note'=>	$service_order_cancel_note,
		);
		$this->db_update("service_order",$update_arr,"service_order_id='".$service_order_id."'");
		//update service_orderdetails
		$update_arr = array(
		'service_orderdetails_status'=>	"tmp",
		);
		$this->db_update("service_orderdetails",$update_arr,"service_order_id='".$service_order_id."'");
		//update product_orderdetails
		$update_arr = array(
		'product_orderdetails_status'=>	"tmp",
		);
		$this->db_update("product_orderdetails",$update_arr,"service_order_id='".$service_order_id."'");
		}
  	return $result;
	}

//service_order
function delete_service_order($service_order_id,$ext=0)
	{
	$result = true;
	//validate
	//if not related to others trs
	//$this->err_msg=$users_code;
	//delete users
	if($result){
		//if service_order in used
		$service_order_row=$this->db_row("service_order","ledger_id,payreceivable_id,payreceivable_kpb_id","service_order_id='".$service_order_id."'");
		$this->db_delete("ledgerdetails","ledger_id='".$service_order_row['ledger_id']."'");
		$this->db_delete("ledger","ledger_id='".$service_order_row['ledger_id']."'");
		$this->payreceivable->delete_receivable($service_order_row['payreceivable_id'],1);
		$this->payreceivable->delete_receivable($service_order_row['payreceivable_kpb_id'],1);
		$this->db_delete("service_orderdetails","service_order_id='".$service_order_id."'");
		$this->db_delete("product_orderdetails","service_order_id='".$service_order_id."'");
		$this->db_delete("kpb_online","service_order_id='".$service_order_id."'");
		$this->db_delete("service_order","service_order_id='".$service_order_id."'");
		//on delete
		}
  	return $result;
	}

//save prodect order sale
function save_service_order_sale($service_order_arr)
	{
	$result = true;
	//validate
	//if not redundant
	//create service_order
	if($result){
		//update
		$this->db_insert("service_order",$service_order_arr);
		}
  	return $result;
	}
	
function complate_service_order_sale($service_order_arr,$service_order_id,$service_order_amount)
	{
	$result = true;
	$service_order_pay_method_unmatch=false;
	//validate
	//if not redundant
	//create service_order
	if($result){
		//before update
		if($service_order_arr['service_order_status']=="pmn"){
		$service_order_row=$this->db_row("service_order","ledger_id,payreceivable_id,payreceivable_kpb_id","service_order_id='".$service_order_id."'");
		//reset old
		$this->db_delete("ledgerdetails","ledger_id='".$service_order_row['ledger_id']."'");
		$this->db_delete("ledger","ledger_id='".$service_order_row['ledger_id']."'");
		$this->payreceivable->delete_receivable($service_order_row['payreceivable_id'],1);
		$this->payreceivable->delete_receivable($service_order_row['payreceivable_kpb_id'],1);
		//acc general
		$trade_expanse_total=0;
		$stock_trade_account=$this->book->account_special_get("stock_trade");
		$sale_tax_account=$this->book->account_special_get("sale_tax");
		$expense_trade_account=$this->book->account_special_get("expense_trade");
		$income_service_account=$this->book->account_special_get("income_service");
		$hpp_account=$this->book->account_special_get("hpp");
		//if KPB
		if($service_order_arr['service_order_kpb_service']>0){
			//acc KPB
			$trade_account=$this->book->account_special_get("trade");
			$service_kpb_account=$this->book->account_special_get("service_kpb");
			$sales_kpb_account=$this->book->account_special_get("sales_kpb");
			//get company row
			$company_row=$this->db_row("company","*","");
			$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['service_order_invoice']." - ".$service_order_arr['service_order_code'];
			$payreceivable_type=1;
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['service_order_receivable']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_payregister'];
			//get kpb amount
			$service_order_kpb_amount=$service_order_arr['service_order_kpb_service']+$service_order_arr['service_order_kpb_product'];
			//insert items
			$create_arr = array(
			'users_code'=>	$company_row['astra_code'],
			'payreceivable_register'=>	$service_order_arr['service_order_payregister'],
			'payreceivable_registernum'=>	$service_order_arr['service_order_payregisternum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$service_order_kpb_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$trade_account,
			'payreceivable_accountcredit'=>	$sales_kpb_account,
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			//kpb set rekening
			$penjualan_dagang_kpb=$service_order_arr['stock_trade_kpb']+$service_order_arr['income_trade_kpb'];
			$set_rekening=array($trade_account,"D",$service_order_kpb_amount,$sales_kpb_account,"K",$penjualan_dagang_kpb,$hpp_account,"D",$service_order_arr['stock_trade_kpb'],$stock_trade_account,"K",$service_order_arr['stock_trade_kpb'],$sale_tax_account,"K",$service_order_arr['service_order_tax_kpb'],$service_kpb_account,"K",$service_order_arr['income_service_kpb']);
			if($this->payreceivable->create_receivable($create_arr,0,$set_rekening)){
				$service_order_arr['payreceivable_kpb_id']=$this->db_lastid("payreceivable","payreceivable_id");
				//update non kpb
				$service_order_arr['service_order_stock_trade']=$service_order_arr['service_order_stock_trade']-$service_order_arr['stock_trade_kpb'];
				$service_order_arr['service_order_income_trade']=$service_order_arr['service_order_income_trade']-$service_order_arr['income_trade_kpb'];
				$service_order_arr['service_order_tax_val']=$service_order_arr['service_order_tax_val']-$service_order_arr['service_order_tax_kpb'];
				$service_order_arr['service_order_income_service']=$service_order_arr['service_order_income_service']-$service_order_arr['income_service_kpb'];
				}
			}
		//get amount
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['service_order_invoice']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_payregister'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['service_order_invoice']." - ".$service_order_arr['service_order_code'];
		$payreceivable_type=1;
		$taxonomy_special_type=$this->book->taxonomi_get($service_order_arr['service_order_accountdebit']);
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['service_order_receivable']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_payregister'];
			//insert items
			$create_arr = array(
			'users_code'=>	$service_order_arr['users_code'],
			'payreceivable_register'=>	$service_order_arr['service_order_payregister'],
			'payreceivable_registernum'=>	$service_order_arr['service_order_payregisternum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$service_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$service_order_arr['service_order_accountdebit'],
			'payreceivable_accountcredit'=>	$service_order_arr['service_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			//post ledger
			$penjualan_dagang=$service_order_arr['service_order_stock_trade']+$service_order_arr['service_order_income_trade'];
			$set_rekening=array($service_order_arr['service_order_accountdebit'],"D",$service_order_amount,$service_order_arr['service_order_accountcredit'],"K",$penjualan_dagang,$hpp_account,"D",$service_order_arr['service_order_stock_trade'],$stock_trade_account,"K",$service_order_arr['service_order_stock_trade'],$sale_tax_account,"K",$service_order_arr['service_order_tax_val'],$expense_trade_account,"K",$service_order_arr['service_order_cost'],$income_service_account,"K",$service_order_arr['service_order_income_service']);
			if($this->payreceivable->create_receivable($create_arr,0,$set_rekening)){
				$service_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}	
			}else{
			//post ledger
			$penjualan_dagang=$service_order_arr['service_order_stock_trade']+$service_order_arr['service_order_income_trade'];
			$set_rekening=array($service_order_arr['service_order_accountdebit'],"D",$service_order_amount,$service_order_arr['service_order_accountcredit'],"K",$penjualan_dagang,$hpp_account,"D",$service_order_arr['service_order_stock_trade'],$stock_trade_account,"K",$service_order_arr['service_order_stock_trade'],$sale_tax_account,"K",$service_order_arr['service_order_tax_val'],$expense_trade_account,"K",$service_order_arr['service_order_cost'],$income_service_account,"K",$service_order_arr['service_order_income_service']);
			$ledger_id=$this->book->ledger_post($service_order_arr['service_order_payregister'],1,$ledger_description,$set_rekening,$service_order_arr['service_order_payregisternum'],0);
			//insert service_order payment
			$service_order_arr['ledger_id']=$ledger_id;
			}
			//revert kpb
			if($service_order_arr['service_order_kpb_service']>0){
				$service_order_arr['service_order_stock_trade']=$service_order_arr['service_order_stock_trade']+$service_order_arr['stock_trade_kpb'];
				$service_order_arr['service_order_income_trade']=$service_order_arr['service_order_income_trade']+$service_order_arr['income_trade_kpb'];
				$service_order_arr['service_order_tax_val']=$service_order_arr['service_order_tax_val']+$service_order_arr['service_order_tax_kpb'];
				$service_order_arr['service_order_income_service']=$service_order_arr['service_order_income_service']+$service_order_arr['income_service_kpb'];
				}
			}//end if pmn
		//update
		$this->db_update("service_order",$service_order_arr,"service_order_id='".$service_order_id."'");
		}
  	return $result;
	}
	
//prodect order sale
function insert_service_order_sale($service_order_arr,$service_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create service_order
	if($result){
		//before update
		if($service_order_arr['service_order_status']=="pmn"){
		//get amount
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['service_order_invoice']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['service_order_invoice']." - ".$service_order_arr['service_order_code'];
		$payreceivable_type=1;
		$taxonomy_special_type=$this->book->taxonomi_get($service_order_arr['service_order_accountdebit']);
		//get trade expanse
		$trade_expanse_total=0;
		$stock_trade_account=$this->book->account_special_get("stock_trade");
		$sale_tax_account=$this->book->account_special_get("sale_tax");
		$expense_trade_account=$this->book->account_special_get("expense_trade");
		$income_service_account=$this->book->account_special_get("income_service");
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['service_order_receivable']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_register'];
			//insert items
			$create_arr = array(
			'users_code'=>	$service_order_arr['users_code'],
			'payreceivable_register'=>	$service_order_arr['service_order_register'],
			'payreceivable_registernum'=>	$service_order_arr['service_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$service_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$service_order_arr['service_order_accountdebit'],
			'payreceivable_accountcredit'=>	$service_order_arr['service_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			//post ledger
			$set_rekening=array($service_order_arr['service_order_accountdebit'],"D",$service_order_amount,$service_order_arr['service_order_accountcredit'],"K",$service_order_arr['service_order_income_trade'],$stock_trade_account,"K",$service_order_arr['service_order_stock_trade'],$sale_tax_account,"K",$service_order_arr['service_order_tax_val'],$expense_trade_account,"K",$service_order_arr['service_order_cost'],$income_service_account,"K",$service_order_arr['service_order_income_service']);
			if($this->payreceivable->create_receivable($create_arr,0,$set_rekening)){
				$service_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}	
			}else{
			//post ledger
			$set_rekening=array($service_order_arr['service_order_accountdebit'],"D",$service_order_amount,$service_order_arr['service_order_accountcredit'],"K",$service_order_arr['service_order_income_trade'],$stock_trade_account,"K",$service_order_arr['service_order_stock_trade'],$sale_tax_account,"K",$service_order_arr['service_order_tax_val'],$expense_trade_account,"K",$service_order_arr['service_order_cost'],$income_service_account,"K",$service_order_arr['service_order_income_service']);
			$ledger_id=$this->book->ledger_post($service_order_arr['service_order_register'],1,$ledger_description,$set_rekening,$service_order_arr['service_order_registernum'],0);
			//insert service_order payment
			$service_order_arr['ledger_id']=$ledger_id;
			}}
		//update
		$this->db_insert("service_order",$service_order_arr);
		}
  	return $result;
	}
	
function update_service_order_sale($service_order_arr,$service_order_id,$service_order_amount)
	{
	$result = true;
	$service_order_pay_method_unmatch=false;
	//validate
	//if not redundant
	//create service_order
	if($result){
		//before update
		if($service_order_arr['service_order_status']=="pmn"){
		//get amount
		$service_order_row=$this->db_row("service_order","ledger_id,payreceivable_id,service_order_pay_method","service_order_id='".$service_order_id."'");
		//delete old payment if not match
		if($service_order_row['service_order_pay_method']!=$service_order_arr['service_order_pay_method']){
			$service_order_pay_method_unmatch=true;
			//if old cash/bank
			if($service_order_row['service_order_pay_method']!="credit"){
				//delete ledger
				$this->db_delete("ledgerdetails","ledger_id='".$service_order_row['ledger_id']."'");
				$this->db_delete("ledger","ledger_id='".$service_order_row['ledger_id']."'");
				//clear ledger id 0
				$update_arr = array(
				'ledger_id'=>	0,
				);
				$this->db_update("service_order",$update_arr,"service_order_id='".$service_order_id."'");
				}
			//if old credit
			if($service_order_row['service_order_pay_method']=="credit"){
				//delete payreceivable
				$this->payreceivable->delete_receivable($service_order_row['payreceivable_id'],1);
				//clear payreceivable id 0
				$update_arr = array(
				'payreceivable_id'=>	0,
				);
				$this->db_update("service_order",$update_arr,"service_order_id='".$service_order_id."'");
				}
			}
		//if sale
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['service_order_invoice']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['service_order_invoice']." - ".$service_order_arr['service_order_code'];
		$payreceivable_type=1;
		$taxonomy_special_type=$this->book->taxonomi_get($service_order_arr['service_order_accountdebit']);
		//get trade expanse
		$trade_expanse_total=0;
		$stock_trade_account=$this->book->account_special_get("stock_trade");
		$sale_tax_account=$this->book->account_special_get("sale_tax");
		$expense_trade_account=$this->book->account_special_get("expense_trade");
		$income_service_account=$this->book->account_special_get("income_service");
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['service_order_receivable']." - ".$service_order_arr['service_order_code']." - ".$service_order_arr['service_order_register'];
			//insert items
			$update_arr = array(
			'users_code'=>	$service_order_arr['users_code'],
			'payreceivable_register'=>	$service_order_arr['service_order_register'],
			'payreceivable_registernum'=>	$service_order_arr['service_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$service_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$service_order_arr['service_order_accountdebit'],
			'payreceivable_accountcredit'=>	$service_order_arr['service_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			//post ledger
			$set_rekening=array($service_order_arr['service_order_accountdebit'],"D",$service_order_amount,$service_order_arr['service_order_accountcredit'],"K",$service_order_arr['service_order_income_trade'],$stock_trade_account,"K",$service_order_arr['service_order_stock_trade'],$sale_tax_account,"K",$service_order_arr['service_order_tax_val'],$expense_trade_account,"K",$service_order_arr['service_order_cost'],$income_service_account,"K",$service_order_arr['service_order_income_service']);
			//if unmatch
			if($service_order_pay_method_unmatch){
				//create
				if($this->payreceivable->create_receivable($update_arr,0,$set_rekening)){
				$service_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}else{
				//update
				$service_order_arr['payreceivable_id']=$service_order_row['payreceivable_id'];
				if($this->payreceivable->update_receivable($update_arr,$service_order_row['payreceivable_id'],$set_rekening)){
				}}
			//if cash
			}else{
			//post ledger
				$set_rekening=array($service_order_arr['service_order_accountdebit'],"D",$service_order_amount,$service_order_arr['service_order_accountcredit'],"K",$service_order_arr['service_order_income_trade'],$stock_trade_account,"K",$service_order_arr['service_order_stock_trade'],$sale_tax_account,"K",$service_order_arr['service_order_tax_val'],$expense_trade_account,"K",$service_order_arr['service_order_cost'],$income_service_account,"K",$service_order_arr['service_order_income_service']);
			//if unmatch
			if($service_order_pay_method_unmatch){
				//post ledger
				$ledger_id=$this->book->ledger_post($service_order_arr['service_order_register'],1,$ledger_description,$set_rekening,	$service_order_arr['service_order_registernum'],0);
				$service_order_arr['ledger_id']=$ledger_id;
				}else{
				//update ledger
				$this->book->ledgerdesc_update($service_order_row['ledger_id'],$ledger_description,$service_order_arr['users_trs_register'],$service_order_arr['users_trs_registernum'],0,$service_order_arr['users_code']);
				$this->book->ledgerdetails_update($service_order_row['ledger_id'],$service_order_arr['users_trs_register'],$set_rekening);
				$service_order_arr['ledger_id']=$service_order_row['ledger_id'];
				}
			}}
		//update
		$this->db_update("service_order",$service_order_arr,"service_order_id='".$service_order_id."'");
		}
  	return $result;
	}

//KPB Online
function create_kpb_online($create_arr)
	{
	//cek if service_orderdetails contain typ
	$category_row=$this->db_row_qry("SELECT category.category_code,service.service_code FROM category INNER JOIN (SELECT service.*,service_orderdetails.service_order_id FROM service,service_orderdetails WHERE service_orderdetails.service_order_id='".$create_arr['service_order_id']."' AND service.service_code = service_orderdetails.service_code) service ON service.category_code = category.category_code WHERE (category.category_code='ASS1' OR category.category_code='ASS2' OR category.category_code='ASS3' OR category.category_code='ASS4') LIMIT 0,1");
	if(count($category_row)>0){
		$kpb_online_num=str_replace("ASS","",$category_row['category_code']);
		//insert kpb online
		$create_arr['kpb_online_num']=$kpb_online_num;
		$this->db_insert("kpb_online",$create_arr);
		}
	}

//motorcycle
function delete_motorcycle($motorcycle_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$motorcycle_code=$this->db_fldrow("motorcycle","motorcycle_code","motorcycle_id='".$motorcycle_id."'");
	if($this->tbldata_exist("service_order","service_order_id","motorcycle_code='".$motorcycle_code."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['motorcycle_used'];
		$result = false;
		}
	//delete motorcycle
	if($result){
		$this->db_delete("motorcycle","motorcycle_id='".$motorcycle_id."'");
		//on delete
		}
  	return $result;
	}

function create_motorcycle($motorcycle_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($motorcycle_arr['motorcycle_code'])!="" && $this->tbldata_exist("motorcycle","motorcycle_id","motorcycle_code='".trim($motorcycle_arr['motorcycle_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['motorcycle_code'];
		$result = false;
		}
	//create motorcycle
	if($result){
		$this->db_insert("motorcycle",$motorcycle_arr);
		//on create
		}
  	return $result;
	}
	
function update_motorcycle($motorcycle_arr,$motorcycle_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($motorcycle_arr['motorcycle_code'])!="" && $this->tbldata_exist("motorcycle","motorcycle_id","motorcycle_code='".trim($motorcycle_arr['motorcycle_code'])."' AND motorcycle_id!='".$motorcycle_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['motorcycle_code'];
		$result = false;
		}
	//update motorcycle
	if($result){
		$this->db_update("motorcycle",$motorcycle_arr,"motorcycle_id='".$motorcycle_id."'");
		//on update
		}
  	return $result;
	}
	

//motorcycle_type
function delete_motorcycle_type($motorcycle_type_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$motorcycle_type_code=$this->db_fldrow("motorcycle_type","motorcycle_type_code","motorcycle_type_id='".$motorcycle_type_id."'");
	if($this->tbldata_exist("motorcycle","motorcycle_id","motorcycle_type_code='".$motorcycle_type_code."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['motorcycle_type_used'];
		$result = false;
		}
	//delete motorcycle_type
	if($result){
		$this->db_delete("motorcycle_type","motorcycle_type_id='".$motorcycle_type_id."'");
		//on delete
		}
  	return $result;
	}

function create_motorcycle_type($motorcycle_type_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($motorcycle_type_arr['motorcycle_type_code'])!="" && $this->tbldata_exist("motorcycle_type","motorcycle_type_id","motorcycle_type_code='".trim($motorcycle_type_arr['motorcycle_type_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['motorcycle_type_code'];
		$result = false;
		}
	//create motorcycle_type
	if($result){
		$this->db_insert("motorcycle_type",$motorcycle_type_arr);
		//on create
		}
  	return $result;
	}
	
function update_motorcycle_type($motorcycle_type_arr,$motorcycle_type_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($motorcycle_type_arr['motorcycle_type_code'])!="" && $this->tbldata_exist("motorcycle_type","motorcycle_type_id","motorcycle_type_code='".trim($motorcycle_type_arr['motorcycle_type_code'])."' AND motorcycle_type_id!='".$motorcycle_type_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['motorcycle_type_code'];
		$result = false;
		}
	//update motorcycle_type
	if($result){
		$this->db_update("motorcycle_type",$motorcycle_type_arr,"motorcycle_type_id='".$motorcycle_type_id."'");
		//on update
		}
  	return $result;
	}
	
//color
function delete_color($color_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$color_code=$this->db_fldrow("color","color_code","color_id='".$color_id."'");
	if($this->tbldata_exist("motorcycle","motorcycle_id","color_code='".$color_code."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['color_used'];
		$result = false;
		}
	//delete color
	if($result){
		$this->db_delete("color","color_id='".$color_id."'");
		//on delete
		}
  	return $result;
	}

function create_color($color_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($color_arr['color_code'])!="" && $this->tbldata_exist("color","color_id","color_code='".trim($color_arr['color_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['color_code'];
		$result = false;
		}
	//create color
	if($result){
		$this->db_insert("color",$color_arr);
		//on create
		}
  	return $result;
	}
	
function update_color($color_arr,$color_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($color_arr['color_code'])!="" && $this->tbldata_exist("color","color_id","color_code='".trim($color_arr['color_code'])."' AND color_id!='".$color_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['color_code'];
		$result = false;
		}
	//update color
	if($result){
		$this->db_update("color",$color_arr,"color_id='".$color_id."'");
		//on update
		}
  	return $result;
	}


//product_sprice_level
function delete_product_sprice_level($product_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	//delete product_sprice_level
	if($result){
		$this->db_delete("product_sprice_level","product_id='".$product_id."'");
		//on delete
		}
  	return $result;
	}

function create_product_sprice_level($product_sprice_level_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	//create product_sprice_level
	if($result){
		$this->db_insert("product_sprice_level",$product_sprice_level_arr);
		//on create
		}
  	return $result;
	}
	
function update_product_sprice_level($product_sprice_level_arr,$product_sprice_level_id)
	{
	$result = true;
	//validate
	//if not redundant code
	//update product_sprice_level
	if($result){
		$this->db_update("product_sprice_level",$product_sprice_level_arr,"product_sprice_level_id='".$product_sprice_level_id."'");
		//on update
		}
  	return $result;
	}

//product_sprice_range
function delete_product_sprice_range($product_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	//delete product_sprice_range
	if($result){
		$this->db_delete("product_sprice_range","product_id='".$product_id."'");
		//on delete
		}
  	return $result;
	}

function create_product_sprice_range($product_sprice_range_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	//create product_sprice_range
	if($result){
		$this->db_insert("product_sprice_range",$product_sprice_range_arr);
		//on create
		}
  	return $result;
	}
	
function update_product_sprice_range($product_sprice_range_arr,$product_sprice_range_id)
	{
	$result = true;
	//validate
	//if not redundant code
	//update product_sprice_range
	if($result){
		$this->db_update("product_sprice_range",$product_sprice_range_arr,"product_sprice_range_id='".$product_sprice_range_id."'");
		//on update
		}
  	return $result;
	}

//rack
function delete_rack($rack_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$rack_code=$this->db_fldrow("rack","rack_code","rack_id='".$rack_id."'");
	if($this->tbldata_exist("product","product_id","rack_code='".$rack_code."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['rack_used'];
		$result = false;
		}
	//delete rack
	if($result){
		$this->db_delete("rack","rack_id='".$rack_id."'");
		//on delete
		}
  	return $result;
	}

function create_rack($rack_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($rack_arr['rack_code'])!="" && $this->tbldata_exist("rack","rack_id","rack_code='".trim($rack_arr['rack_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['rack_code'];
		$result = false;
		}
	//create rack
	if($result){
		$this->db_insert("rack",$rack_arr);
		//on create
		}
  	return $result;
	}
	
function update_rack($rack_arr,$rack_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($rack_arr['rack_code'])!="" && $this->tbldata_exist("rack","rack_id","rack_code='".trim($rack_arr['rack_code'])."' AND rack_id!='".$rack_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['rack_code'];
		$result = false;
		}
	//update rack
	if($result){
		$this->db_update("rack",$rack_arr,"rack_id='".$rack_id."'");
		//on update
		}
  	return $result;
	}

//unit
function delete_unit($unit_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$unit_code=$this->db_fldrow("unit","unit_code","unit_id='".$unit_id."'");
	if($this->tbldata_exist("product","product_id","unit_code='".$unit_code."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['unit_used'];
		$result = false;
		}
	//delete unit
	if($result){
		$this->db_delete("unit","unit_id='".$unit_id."'");
		//on delete
		}
  	return $result;
	}

function create_unit($unit_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($unit_arr['unit_code'])!="" && $this->tbldata_exist("unit","unit_id","unit_code='".trim($unit_arr['unit_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['unit_code'];
		$result = false;
		}
	//create unit
	if($result){
		$this->db_insert("unit",$unit_arr);
		//on create
		}
  	return $result;
	}
	
function update_unit($unit_arr,$unit_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($unit_arr['unit_code'])!="" && $this->tbldata_exist("unit","unit_id","unit_code='".trim($unit_arr['unit_code'])."' AND unit_id!='".$unit_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['unit_code'];
		$result = false;
		}
	//update unit
	if($result){
		$this->db_update("unit",$unit_arr,"unit_id='".$unit_id."'");
		//on update
		}
  	return $result;
	}

//categorysub
function delete_categorysub($categorysub_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$categorysub_code=$this->db_fldrow("categorysub","categorysub_code","categorysub_id='".$categorysub_id."'");
	if($this->tbldata_exist("product","product_id","categorysub_code='".$categorysub_code."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['categorysub_used'];
		$result = false;
		}
	//delete categorysub
	if($result){
		$this->db_delete("categorysub","categorysub_id='".$categorysub_id."'");
		//on delete
		}
  	return $result;
	}

function create_categorysub($categorysub_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($categorysub_arr['categorysub_code'])!="" && $this->tbldata_exist("categorysub","categorysub_id","categorysub_code='".trim($categorysub_arr['categorysub_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['categorysub_code'];
		$result = false;
		}
	//create categorysub
	if($result){
		$this->db_insert("categorysub",$categorysub_arr);
		//on create
		}
  	return $result;
	}
	
function update_categorysub($categorysub_arr,$categorysub_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($categorysub_arr['categorysub_code'])!="" && $this->tbldata_exist("categorysub","categorysub_id","categorysub_code='".trim($categorysub_arr['categorysub_code'])."' AND categorysub_id!='".$categorysub_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['categorysub_code'];
		$result = false;
		}
	//update categorysub
	if($result){
		$this->db_update("categorysub",$categorysub_arr,"categorysub_id='".$categorysub_id."'");
		//on update
		}
  	return $result;
	}	
	
//category
function delete_category($category_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$category_code=$this->db_fldrow("category","category_code","category_id='".$category_id."'");
	if($this->tbldata_exist("product","product_id","category_code='".$category_code."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['category_used'];
		$result = false;
		}
	//delete category
	if($result){
		$this->db_delete("category","category_id='".$category_id."'");
		//on delete
		}
  	return $result;
	}

function create_category($category_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($category_arr['category_code'])!="" && $this->tbldata_exist("category","category_id","category_code='".trim($category_arr['category_code'])."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['category_code'];
		$result = false;
		}
	//create category
	if($result){
		$this->db_insert("category",$category_arr);
		//on create
		}
  	return $result;
	}
	
function update_category($category_arr,$category_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($category_arr['category_code'])!="" && $this->tbldata_exist("category","category_id","category_code='".trim($category_arr['category_code'])."' AND category_id!='".$category_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['category_code'];
		$result = false;
		}
	//update category
	if($result){
		$this->db_update("category",$category_arr,"category_id='".$category_id."'");
		//on update
		}
  	return $result;
	}	
	
//product
function delete_product($product_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$product_code=$this->db_fldrow("product","product_code","product_id='".$product_id."'");
	if($this->tbldata_exist("product_orderdetails","product_orderdetails_id","product_code='".$product_code."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['product_used'];
		$result = false;
		}
	//delete product
	if($result){
		$this->delete_product_sprice_range($product_id);
		$this->delete_product_sprice_level($product_id);
		//unset thumbnail
		$product_thumbnail=$this->db_fldrow("product","product_thumbnail","product_id='".$product_id."'");
		$product_thumbnail_unlink=SITE_ROOT.$product_thumbnail;
		unlink($product_thumbnail_unlink);
		$this->db_delete("product","product_id='".$product_id."'");
		//on delete
		}
  	return $result;
	}

function create_product($product_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($product_arr['product_code'])!="" && $this->tbldata_exist("product","product_id","product_code='".trim($product_arr['product_code'])."'")){
		//$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['product_code'];
		//$result = false;
		}
	//create product
	if($result){
		$this->db_insert("product",$product_arr);
		//on create
		}
  	return $result;
	}
	
function update_product($product_arr,$product_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(isset($product_arr['product_code'])){
	if(trim($product_arr['product_code'])!="" && $this->tbldata_exist("product","product_id","product_code='".trim($product_arr['product_code'])."' AND product_id!='".$product_id."'")){
		//$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['product_code'];
		//$result = false;
		}}
	//update product
	if($result){
		$this->db_update("product",$product_arr,"product_id='".$product_id."'");
		//on update
		}
  	return $result;
	}

//product_order expired
function product_order_expired($tbt_expired)
	{
	$db_select = $this->db_select("product_order","*","product_order_registernum<='".$tbt_expired."' AND product_order_status='tmp'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$product_order_id=$select_data[$i]['product_order_id'];
		//delete product_order details
		$db_select2 = $this->db_select("product_orderdetails","*","product_order_id='".$product_order_id."'","",0,0);
		$select_data2=$db_select2['select_data'];
		for($j=0;$j<$db_select2['select_num'];$j++){
			$product_orderdetails_id=$select_data2[$j]['product_orderdetails_id'];
			$this->db_delete("product_orderdetails","product_orderdetails_id='".$product_orderdetails_id."'");
			}
		$this->db_delete("product_order","product_order_id='".$product_order_id."'");
		}
	//clean expired product_orderdetails tmp
	$this->db_delete("product_orderdetails","product_orderdetails_registernum<='".$tbt_expired."' AND product_orderdetails_status='tmp'");
	}

//product_order
function delete_product_order($product_order_id,$ext=0)
	{
	$result = true;
	//validate
	//if not related to others trs
	//$this->err_msg=$users_code;
	//delete users
	if($result){
		//if product_order in used
		$product_order_row=$this->db_row("product_order","*","product_order_id='".$product_order_id."'");
		//revert ht
		if($product_order_row['ht_order_id']>0){
			$update_arr = array(
			'product_order_status'=>	"pmn",
			);
			$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_row['ht_order_id']."'");
			$update_arr2 = array(
			'product_orderdetails_status'=>	"pmn",
			);
			$this->db_update("product_orderdetails",$update_arr2,"product_order_id='".$product_order_row['ht_order_id']."'");
			}
		//revert po
		if($product_order_row['po_order_id']>0){
			$update_arr = array(
			'product_order_status'=>	"pmn",
			);
			$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_row['po_order_id']."'");
			$update_arr2 = array(
			'product_orderdetails_status'=>	"pmn",
			);
			$this->db_update("product_orderdetails",$update_arr2,"product_order_id='".$product_order_row['po_order_id']."'");
			}
		//del rest
		$this->db_delete("ledgerdetails","ledger_id='".$product_order_row['ledger_id']."'");
		$this->db_delete("ledger","ledger_id='".$product_order_row['ledger_id']."'");
		$this->payreceivable->delete_receivable($product_order_row['payreceivable_id'],1);
		$this->db_delete("product_orderdetails","product_order_id='".$product_order_id."'");
		$this->db_delete("product_order","product_order_id='".$product_order_id."'");
		//on delete
		}
  	return $result;
	}

function insert_product_order($product_order_arr,$product_order_id)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		//get amount
		$product_orderdetails_row=$this->db_row("product_orderdetails","SUM(product_orderdetails_price*product_orderdetails_quantity) AS product_orderdetails_total","product_order_id='".$product_order_id."' AND product_orderdetails_status = 'pmn' GROUP BY product_order_id");
		$product_order_amount=$product_orderdetails_row['product_orderdetails_total'];
		//if buy or sale
		if($product_order_arr['product_order_type']=="si"){
			//if sale
			$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_minus']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_minus']." - ".$product_order_arr['product_order_code'];
			$payreceivable_type=1;
			$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountdebit']);
			//get trade expanse
			$trade_expanse_total=0;
			$trade_expanse_accountcredit=$this->book->account_special_get("stock_trade");
			$trade_expanse_accountdebit=$this->book->account_special_get("expense_trade");
			$db_select = $this->db_select("product_orderdetails","product_orderdetails_quantity,product_code","product_order_id='".$product_order_id."' AND product_orderdetails_status = 'pmn'","",0,0);
			$select_data=$db_select['select_data'];
			for($i=0;$i<$db_select['select_num'];$i++)
				{
				//$product_orderdetails_price=$this->db_lastidfilter("product_orderdetails","product_orderdetails_price","product_code='".$select_data[$i]['product_code']."' AND product_orderdetails_type='buy'","product_orderdetails_id");
				//average
				$bprice_row=$this->db_row_join("product,product_orderdetails","SUM(case when product_orderdetails.product_orderdetails_type = 'pi' then product_orderdetails.product_orderdetails_quantity end) AS product_bquantity,SUM(case when product_orderdetails.product_orderdetails_type = 'pi' then (product_orderdetails.product_orderdetails_quantity*product_orderdetails.product_orderdetails_price) end) AS product_bprice_total","product.product_code='".$select_data[$i]['product_code']."' AND product_orderdetails.product_orderdetails_status = 'pmn' AND product.product_code=product_orderdetails.product_code GROUP BY product.product_code");
				$product_orderdetails_price=($bprice_row['product_bprice_total']/ $bprice_row['product_bquantity']);
				$trade_expanse_total+=$product_orderdetails_price*$select_data[$i]['product_orderdetails_quantity'];
				}
			$trade_profit=$product_order_amount-$trade_expanse_total;
			}if($product_order_arr['product_order_type']=="pi"){
			//if buy
			$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_plus']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_plus']." - ".$product_order_arr['product_order_code'];
			$payreceivable_type=0;
			$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountcredit']);
			}
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			//insert items
			$create_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$product_order_arr['product_order_description'],
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			if($product_order_arr['product_order_type']=="si"){
			//post ledger
			$set_rekening=array($product_order_arr['product_order_accountcredit'],"D",$trade_expanse_total,$trade_expanse_accountcredit,"K",$trade_expanse_total);
			$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,$product_order_arr['product_order_registernum'],0);
			$product_order_arr['ledger_id']=$ledger_id;
			if($this->payreceivable->create_receivable($create_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}if($product_order_arr['product_order_type']=="pi"){
			if($this->payreceivable->create_payable($create_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}	
			}else{
			if($product_order_arr['product_order_type']=="si"){
				//post ledger
				$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$product_order_amount,$product_order_arr['product_order_accountcredit'],"D",$trade_expanse_total,$trade_expanse_accountcredit,"K",$trade_expanse_total);
				$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,$product_order_arr['product_order_registernum'],0);
			}if($product_order_arr['product_order_type']=="pi"){
				//post ledger
				$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$product_order_amount);
				$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,$product_order_arr['product_order_registernum'],0);
				}
			//insert product_order payment
			$product_order_arr['ledger_id']=$ledger_id;
			}
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
	
function update_product_order($product_order_arr,$product_order_id)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		//get amount
		$product_orderdetails_row=$this->db_row("product_orderdetails","SUM(product_orderdetails_price*product_orderdetails_quantity) AS product_orderdetails_total","product_order_id='".$product_order_id."' AND product_orderdetails_status = 'pmn' GROUP BY product_order_id");
		$product_order_amount=$product_orderdetails_row['product_orderdetails_total'];
		$product_order_row=$this->db_row("product_order","ledger_id,payreceivable_id","product_order_id='".$product_order_id."'");
		//if buy or sale
		if($product_order_arr['product_order_type']=="si"){
			//if sale
			$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_minus']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_minus']." - ".$product_order_arr['product_order_code'];
			$payreceivable_type=1;
			$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountdebit']);
			//get trade expanse
			$trade_expanse_total=0;
			$trade_expanse_accountcredit=$this->book->account_special_get("stock_trade");
			$trade_expanse_accountdebit=$this->book->account_special_get("expense_trade");
			$db_select = $this->db_select("product_orderdetails","product_orderdetails_quantity,product_code","product_order_id='".$product_order_id."' AND product_orderdetails_status = 'pmn'","",0,0);
			$select_data=$db_select['select_data'];
			for($i=0;$i<$db_select['select_num'];$i++)
				{
				//$product_orderdetails_price=$this->db_lastidfilter("product_orderdetails","product_orderdetails_price","product_code='".$select_data[$i]['product_code']."' AND product_orderdetails_type='buy'","product_orderdetails_id");
				//average
				$bprice_row=$this->db_row_join("product,product_orderdetails","SUM(case when product_orderdetails.product_orderdetails_type = 'pi' then product_orderdetails.product_orderdetails_quantity end) AS product_bquantity,SUM(case when product_orderdetails.product_orderdetails_type = 'pi' then (product_orderdetails.product_orderdetails_quantity*product_orderdetails.product_orderdetails_price) end) AS product_bprice_total","product.product_code='".$select_data[$i]['product_code']."' AND product_orderdetails.product_orderdetails_status = 'pmn' AND product.product_code=product_orderdetails.product_code GROUP BY product.product_code");
				$product_orderdetails_price=($bprice_row['product_bprice_total']/ $bprice_row['product_bquantity']);
				$trade_expanse_total+=$product_orderdetails_price*$select_data[$i]['product_orderdetails_quantity'];
				}
			$trade_profit=$product_order_amount-$trade_expanse_total;
			}if($product_order_arr['product_order_type']=="pi"){
			//if buy
			$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_plus']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_plus']." - ".$product_order_arr['product_order_code'];
			$payreceivable_type=0;
			$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountcredit']);
			}
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			//insert items
			$create_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$product_order_arr['product_order_description'],
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			if($product_order_arr['product_order_type']=="si"){
			//post ledger
			if($this->payreceivable->update_receivable($update_arr,$product_order_row['payreceivable_id'])){
				}}if($product_order_arr['product_order_type']=="pi"){
			if($this->payreceivable->update_payable($update_arr,$product_order_row['payreceivable_id'])){
				}}	
			//if cash
			}else{
			if($product_order_arr['product_order_type']=="si"){
				//post ledger
				$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$product_order_amount,$product_order_arr['product_order_accountcredit'],"D",$trade_expanse_total,$trade_expanse_accountcredit,"K",$trade_expanse_total);
				//update ledger
				$this->book->ledgerdesc_update($product_order_row['ledger_id'],$ledger_description,$product_order_arr['users_trs_register'],$product_order_arr['users_trs_registernum'],0,$product_order_arr['users_code']);
				$this->book->ledgerdetails_update($product_order_row['ledger_id'],$product_order_arr['users_trs_register'],$set_rekening);
			}if($product_order_arr['product_order_type']=="pi"){
				//post ledger
				$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$product_order_amount);
				//update ledger
				$this->book->ledgerdesc_update($product_order_row['ledger_id'],$ledger_description,$product_order_arr['users_trs_register'],$product_order_arr['users_trs_registernum'],0,$product_order_arr['users_code']);
				$this->book->ledgerdetails_update($product_order_row['ledger_id'],$product_order_arr['users_trs_register'],$set_rekening);
				}
			//insert product_order payment
			$product_order_arr['payreceivable_id']=$product_order_row['payreceivable_id'];
			$product_order_arr['ledger_id']=$product_order_row['ledger_id'];
			}
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}

//product order buy
function insert_product_order_buy($product_order_arr,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		if($product_order_arr['product_order_type']!="po" && $product_order_arr['product_order_status']=="pmn"){
		//get amount
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_plus']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_plus']." - ".$product_order_arr['product_order_code'];
		$payreceivable_type=0;
		$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountcredit']);
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_payable']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			//insert items
			$create_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			if($this->payreceivable->create_payable($create_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}	
			}else{
			//post ledger
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$product_order_amount);
			$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,$product_order_arr['product_order_registernum'],0);
			//insert product_order payment
			$product_order_arr['ledger_id']=$ledger_id;
			}}
		//update
		$this->db_insert("product_order",$product_order_arr);
		}
  	return $result;
	}
	
function update_product_order_buy($product_order_arr,$product_order_id,$product_order_amount)
	{
	$result = true;
	$product_order_pay_method_unmatch=false;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		//if pmn paid
		if($product_order_arr['product_order_type']!="po" && $product_order_arr['product_order_status']=="pmn"){
		//get amount
		$product_order_row=$this->db_row("product_order","*","product_order_id='".$product_order_id."'");
		//delete old payment if not match
		if(($product_order_row['product_order_pay_method']!=$product_order_arr['product_order_pay_method']) || $product_order_row['product_order_status']=='tmp'){
			$product_order_pay_method_unmatch=true;
			//if old cash/bank
			if($product_order_row['product_order_pay_method']!="credit"){
				//delete ledger
				$this->db_delete("ledgerdetails","ledger_id='".$product_order_row['ledger_id']."'");
				$this->db_delete("ledger","ledger_id='".$product_order_row['ledger_id']."'");
				//clear ledger id 0
				$update_arr = array(
				'ledger_id'=>	0,
				);
				$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_id."'");
				}
			//if old credit
			if($product_order_row['product_order_pay_method']=="credit"){
				//delete payreceivable
				$this->payreceivable->delete_payable($product_order_row['payreceivable_id'],1);
				//clear payreceivable id 0
				$update_arr = array(
				'payreceivable_id'=>	0,
				);
				$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_id."'");
				}
			}
		//if buy
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_plus']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_plus']." - ".$product_order_arr['product_order_code'];
		$payreceivable_type=0;
		$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountcredit']);
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_payable']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			//insert items
			$update_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			//if unmatch
			if($product_order_pay_method_unmatch){
				//create
				if($this->payreceivable->create_payable($update_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}else{
				//update
				$product_order_arr['payreceivable_id']=$product_order_row['payreceivable_id'];
				if($this->payreceivable->update_payable($update_arr,$product_order_row['payreceivable_id'])){
				}}
			//if cash
			}else{
			//post ledger
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$product_order_amount);
			//if unmatch
			if($product_order_pay_method_unmatch){
				//post ledger
				$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,	$product_order_arr['product_order_registernum'],0);
				$product_order_arr['ledger_id']=$ledger_id;
				}else{
				//update ledger
				$this->book->ledgerdesc_update($product_order_row['ledger_id'],$ledger_description,$product_order_arr['users_trs_register'],$product_order_arr['users_trs_registernum'],0,$product_order_arr['users_code']);
				$this->book->ledgerdetails_update($product_order_row['ledger_id'],$product_order_arr['users_trs_register'],$set_rekening);
				$product_order_arr['ledger_id']=$product_order_row['ledger_id'];
				}
			}}
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
	
//prodect order buy
function save_product_order_buy($product_order_arr,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		$product_order_arr['product_order_status']='tmp';
		//update
		$this->db_insert("product_order",$product_order_arr);
		}
  	return $result;
	}
	
//prodect order buy
function saveupdate_product_order_buy($product_order_arr,$product_order_id,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		$product_order_arr['product_order_status']='tmp';
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
	
//product order buy retur
function insert_product_order_buy_retur($product_order_arr,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		if($product_order_arr['product_order_status']=="pmn"){
		//get amount
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_buy_retur']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_buy_retur']." - ".$product_order_arr['product_order_code'];
		$payreceivable_type=1;
		$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountcredit']);
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_retur_receivable']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			//insert items
			$create_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			if($this->payreceivable->create_receivable($create_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}	
			}else{
			//post ledger
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"K",$product_order_amount,$product_order_arr['product_order_accountcredit'],"D",$product_order_amount);
			$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,$product_order_arr['product_order_registernum'],0);
			//insert product_order payment
			$product_order_arr['ledger_id']=$ledger_id;
			}}
		//update
		$this->db_insert("product_order",$product_order_arr);
		}
  	return $result;
	}
	
//update product order buy retur
function update_product_order_buy_retur($product_order_arr,$product_order_id,$product_order_amount)
	{
	$result = true;
	$product_order_pay_method_unmatch=false;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		//if pmn paid
		if($product_order_arr['product_order_status']=="pmn"){
		//get amount
		$product_order_row=$this->db_row("product_order","*","product_order_id='".$product_order_id."'");
		//delete old payment if not match
		if(($product_order_row['product_order_pay_method']!=$product_order_arr['product_order_pay_method']) || $product_order_row['product_order_status']=='tmp'){
			$product_order_pay_method_unmatch=true;
			//if old cash/bank
			if($product_order_row['product_order_pay_method']!="credit"){
				//delete ledger
				$this->db_delete("ledgerdetails","ledger_id='".$product_order_row['ledger_id']."'");
				$this->db_delete("ledger","ledger_id='".$product_order_row['ledger_id']."'");
				//clear ledger id 0
				$update_arr = array(
				'ledger_id'=>	0,
				);
				$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_id."'");
				}
			//if old credit
			if($product_order_row['product_order_pay_method']=="credit"){
				//delete payreceivable
				$this->payreceivable->delete_receivable($product_order_row['payreceivable_id'],1);
				//clear payreceivable id 0
				$update_arr = array(
				'payreceivable_id'=>	0,
				);
				$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_id."'");
				}
			}
		//if buy
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_buy_retur']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_buy_retur']." - ".$product_order_arr['product_order_code'];
		$payreceivable_type=1;
		$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountcredit']);
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_retur_receivable']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			//insert items
			$update_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			//if unmatch
			if($product_order_pay_method_unmatch){
				//create
				if($this->payreceivable->create_receivable($update_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}else{
				//update
				$product_order_arr['payreceivable_id']=$product_order_row['payreceivable_id'];
				if($this->payreceivable->update_receivable($update_arr,$product_order_row['payreceivable_id'])){
				}}
			//if cash
			}else{
			//post ledger
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"K",$product_order_amount,$product_order_arr['product_order_accountcredit'],"D",$product_order_amount);
			//if unmatch
			if($product_order_pay_method_unmatch){
				//post ledger
				$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,	$product_order_arr['product_order_registernum'],0);
				$product_order_arr['ledger_id']=$ledger_id;
				}else{
				//update ledger
				$this->book->ledgerdesc_update($product_order_row['ledger_id'],$ledger_description,$product_order_arr['users_trs_register'],$product_order_arr['users_trs_registernum'],0,$product_order_arr['users_code']);
				$this->book->ledgerdetails_update($product_order_row['ledger_id'],$product_order_arr['users_trs_register'],$set_rekening);
				$product_order_arr['ledger_id']=$product_order_row['ledger_id'];
				}
			}}
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
	
//prodect order buy
function save_product_order_buy_retur($product_order_arr,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		$product_order_arr['product_order_status']='tmp';
		//update
		$this->db_insert("product_order",$product_order_arr);
		}
  	return $result;
	}
	
//prodect order buy
function saveupdate_product_order_buy_retur($product_order_arr,$product_order_id,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		$product_order_arr['product_order_status']='tmp';
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
	
//auto update product_bprice/sprice
function auto_update_product_price($update_arr,$product_code,$product_orderdetails_registernum)
	{
	//cek if it's a latest list
	if(!$this->tbldata_exist("product_orderdetails","*","product_code='".$product_code."' AND product_orderdetails_registernum >'".$product_orderdetails_registernum."'")){
		//update
		$this->db_update("product",$update_arr,"product_code='".$product_code."'");
		}
	}
	
//prodect order sale
function insert_product_order_sale($product_order_arr,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		//acc general
		$trade_expanse_total=0;
		$stock_trade_account=$this->book->account_special_get("stock_trade");
		$sale_tax_account=$this->book->account_special_get("sale_tax");
		$expense_trade_account=$this->book->account_special_get("expense_trade");
		$sales_deposit=$this->book->account_special_get("sales_deposit");
		$hpp_account=$this->book->account_special_get("hpp");
		if(($product_order_arr['product_order_type']!="ht" && $product_order_arr['product_order_type']!="so") && $product_order_arr['product_order_status']=="pmn"){
		//get amount
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_minus']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_minus']." - ".$product_order_arr['product_order_code'];
		$payreceivable_type=1;
		$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountdebit']);
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_receivable']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			//insert items
			$create_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			//post ledger
			$penjualan_dagang=$product_order_arr['product_order_stock_trade']+$product_order_arr['product_order_income_trade'];
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$penjualan_dagang,$hpp_account,"D",$product_order_arr['product_order_stock_trade'],$stock_trade_account,"K",$product_order_arr['product_order_stock_trade'],$sale_tax_account,"K",$product_order_arr['product_order_tax_val'],$expense_trade_account,"K",$product_order_arr['product_order_cost']);
			//cek if ht_order_id>0 push arr
			if($product_order_arr['ht_order_id']>0){
				$product_order_deposit=$this->db_fldrow("product_order","product_order_deposit","product_order_id='".$product_order_arr['ht_order_id']."'");
				if($product_order_deposit>0){
				array_push($set_rekening,$sales_deposit,"D",$product_order_deposit);
				}}
			if($this->payreceivable->create_receivable($create_arr,0,$set_rekening)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}	
			}else{
			//post ledger
			$penjualan_dagang=$product_order_arr['product_order_stock_trade']+$product_order_arr['product_order_income_trade'];
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$penjualan_dagang,$hpp_account,"D",$product_order_arr['product_order_stock_trade'],$stock_trade_account,"K",$product_order_arr['product_order_stock_trade'],$sale_tax_account,"K",$product_order_arr['product_order_tax_val'],$expense_trade_account,"K",$product_order_arr['product_order_cost']);
			//cek if ht_order_id>0 push arr
			if($product_order_arr['ht_order_id']>0){
				$product_order_deposit=$this->db_fldrow("product_order","product_order_deposit","product_order_id='".$product_order_arr['ht_order_id']."'");
				if($product_order_deposit>0){
				array_push($set_rekening,$sales_deposit,"D",$product_order_deposit);
				}}
			$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,$product_order_arr['product_order_registernum'],0);
			//insert product_order payment
			$product_order_arr['ledger_id']=$ledger_id;
			}}
		if($product_order_arr['product_order_type']=="ht" && $product_order_arr['product_order_deposit']>0){
		$payreceivable_code="HTDP".$product_order_arr['users_code'].$product_order_arr['product_order_register'];
		$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_sale_deposit']." - ".$product_order_arr['product_order_register'];
		//insert payable
			$create_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_arr['product_order_deposit'],
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			if($this->payreceivable->create_payable($create_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}
			//unset
			//unset($product_order_arr['product_order_deposit_debit_acc']);
			}
		//update
		$this->db_insert("product_order",$product_order_arr);
		}
  	return $result;
	}
	
function update_product_order_sale($product_order_arr,$product_order_id,$product_order_amount)
	{
	$result = true;
	$product_order_pay_method_unmatch=false;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		if(($product_order_arr['product_order_type']!="ht" && $product_order_arr['product_order_type']!="so") && $product_order_arr['product_order_status']=="pmn"){
		//get amount
		$product_order_row=$this->db_row("product_order","*","product_order_id='".$product_order_id."'");
		//delete old payment if not match
		if(($product_order_row['product_order_pay_method']!=$product_order_arr['product_order_pay_method']) || $product_order_row['product_order_status']=='tmp'){
			$product_order_pay_method_unmatch=true;
			//if old cash/bank
			if($product_order_row['product_order_pay_method']!="credit"){
				//delete ledger
				$this->db_delete("ledgerdetails","ledger_id='".$product_order_row['ledger_id']."'");
				$this->db_delete("ledger","ledger_id='".$product_order_row['ledger_id']."'");
				//clear ledger id 0
				$update_arr = array(
				'ledger_id'=>	0,
				);
				$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_id."'");
				}
			//if old credit
			if($product_order_row['product_order_pay_method']=="credit"){
				//delete payreceivable
				$this->payreceivable->delete_receivable($product_order_row['payreceivable_id'],1);
				//clear payreceivable id 0
				$update_arr = array(
				'payreceivable_id'=>	0,
				);
				$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_id."'");
				}
			}
		//if sale
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_minus']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_minus']." - ".$product_order_arr['product_order_code'];
		$payreceivable_type=1;
		$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountdebit']);
		//get trade expanse
		$trade_expanse_total=0;
		$stock_trade_account=$this->book->account_special_get("stock_trade");
		$sale_tax_account=$this->book->account_special_get("sale_tax");
		$expense_trade_account=$this->book->account_special_get("expense_trade");
		$sales_deposit=$this->book->account_special_get("sales_deposit");
		$hpp_account=$this->book->account_special_get("hpp");
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_receivable']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			//insert items
			$update_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			//post ledger
			$penjualan_dagang=$product_order_arr['product_order_stock_trade']+$product_order_arr['product_order_income_trade'];
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$penjualan_dagang,$hpp_account,"D",$product_order_arr['product_order_stock_trade'],$stock_trade_account,"K",$product_order_arr['product_order_stock_trade'],$sale_tax_account,"K",$product_order_arr['product_order_tax_val'],$expense_trade_account,"K",$product_order_arr['product_order_cost']);
			//cek if ht_order_id>0 push arr
			if($product_order_row['ht_order_id']>0){
				$product_order_deposit=$this->db_fldrow("product_order","product_order_deposit","product_order_id='".$product_order_row['ht_order_id']."'");
				if($product_order_deposit>0){
				array_push($set_rekening,$sales_deposit,"D",$product_order_deposit);
				}}
			//if unmatch
			if($product_order_pay_method_unmatch){
				//create
				if($this->payreceivable->create_receivable($update_arr,0,$set_rekening)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}else{
				//update
				$product_order_arr['payreceivable_id']=$product_order_row['payreceivable_id'];
				if($this->payreceivable->update_receivable($update_arr,$product_order_row['payreceivable_id'],$set_rekening)){
				}}
			//if cash
			}else{
			//post ledger
			$penjualan_dagang=$product_order_arr['product_order_stock_trade']+$product_order_arr['product_order_income_trade'];
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"D",$product_order_amount,$product_order_arr['product_order_accountcredit'],"K",$penjualan_dagang,$hpp_account,"D",$product_order_arr['product_order_stock_trade'],$stock_trade_account,"K",$product_order_arr['product_order_stock_trade'],$sale_tax_account,"K",$product_order_arr['product_order_tax_val'],$expense_trade_account,"K",$product_order_arr['product_order_cost']);
			//cek if ht_order_id>0 push arr
			if($product_order_row['ht_order_id']>0){
				$product_order_deposit=$this->db_fldrow("product_order","product_order_deposit","product_order_id='".$product_order_row['ht_order_id']."'");
				if($product_order_deposit>0){
				array_push($set_rekening,$sales_deposit,"D",$product_order_deposit);
				}}
			//if unmatch
			if($product_order_pay_method_unmatch){
				//post ledger
				$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,	$product_order_arr['product_order_registernum'],0);
				$product_order_arr['ledger_id']=$ledger_id;
				}else{
				//update ledger
				$this->book->ledgerdesc_update($product_order_row['ledger_id'],$ledger_description,$product_order_arr['users_trs_register'],$product_order_arr['users_trs_registernum'],0,$product_order_arr['users_code']);
				$this->book->ledgerdetails_update($product_order_row['ledger_id'],$product_order_arr['users_trs_register'],$set_rekening);
				$product_order_arr['ledger_id']=$product_order_row['ledger_id'];
				}
			}}
		if($product_order_arr['product_order_type']=="ht" && $product_order_arr['product_order_deposit']>0){
		$product_order_row=$this->db_row("product_order","ledger_id,payreceivable_id,product_order_pay_method","product_order_id='".$product_order_id."'");
		$payreceivable_code="HTDP".$product_order_arr['users_code'].$product_order_arr['product_order_register'];
		$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_sale_deposit']." - ".$product_order_arr['product_order_register'];
		//insert payable
			$update_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_arr['product_order_deposit'],
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			if($product_order_row['payreceivable_id']>0){
			$product_order_arr['payreceivable_id']=$product_order_row['payreceivable_id'];
			if($this->payreceivable->update_payable($update_arr,$product_order_row['payreceivable_id'])){
				}
			}else{
			if($this->payreceivable->create_payable($update_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}
			//unset
			//unset($product_order_arr['product_order_deposit_debit_acc']);
			}
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
	
//prodect order sale
function save_product_order_sale($product_order_arr,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		$product_order_arr['product_order_status']='tmp';
		//update
		$this->db_insert("product_order",$product_order_arr);
		}
  	return $result;
	}
	
//prodect order sale
function saveupdate_product_order_sale($product_order_arr,$product_order_id,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		$product_order_arr['product_order_status']='tmp';
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
	
//prodect order sale
function insert_product_order_sale_retur($product_order_arr,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		//acc general
		$trade_expanse_total=0;
		$stock_trade_account=$this->book->account_special_get("stock_trade");
		$sale_tax_account=$this->book->account_special_get("sale_tax");
		$expense_trade_account=$this->book->account_special_get("expense_trade");
		$sales_deposit=$this->book->account_special_get("sales_deposit");
		$hpp_account=$this->book->account_special_get("hpp");
		if($product_order_arr['product_order_status']=="pmn"){
		//get amount
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_sale_retur']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_sale_retur']." - ".$product_order_arr['product_order_code'];
		$payreceivable_type=0;
		$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountdebit']);
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_retur_payable']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			//insert items
			$create_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			//post ledger
			$penjualan_dagang=$product_order_arr['product_order_stock_trade']+$product_order_arr['product_order_income_trade'];
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"K",$product_order_amount,$product_order_arr['product_order_accountcredit'],"D",$penjualan_dagang,$hpp_account,"K",$product_order_arr['product_order_stock_trade'],$stock_trade_account,"D",$product_order_arr['product_order_stock_trade'],$sale_tax_account,"D",$product_order_arr['product_order_tax_val'],$expense_trade_account,"D",$product_order_arr['product_order_cost']);
			//cek if ht_order_id>0 push arr
			if($product_order_arr['ht_order_id']>0){
				$product_order_deposit=$this->db_fldrow("product_order","product_order_deposit","product_order_id='".$product_order_arr['ht_order_id']."'");
				if($product_order_deposit>0){
				array_push($set_rekening,$sales_deposit,"D",$product_order_deposit);
				}}
			if($this->payreceivable->create_payable($create_arr,0,$set_rekening)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}	
			}else{
			//post ledger
			$penjualan_dagang=$product_order_arr['product_order_stock_trade']+$product_order_arr['product_order_income_trade'];
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"K",$product_order_amount,$product_order_arr['product_order_accountcredit'],"D",$penjualan_dagang,$hpp_account,"K",$product_order_arr['product_order_stock_trade'],$stock_trade_account,"D",$product_order_arr['product_order_stock_trade'],$sale_tax_account,"D",$product_order_arr['product_order_tax_val'],$expense_trade_account,"D",$product_order_arr['product_order_cost']);
			//cek if ht_order_id>0 push arr
			if($product_order_arr['ht_order_id']>0){
				$product_order_deposit=$this->db_fldrow("product_order","product_order_deposit","product_order_id='".$product_order_arr['ht_order_id']."'");
				if($product_order_deposit>0){
				array_push($set_rekening,$sales_deposit,"D",$product_order_deposit);
				}}
			$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,$product_order_arr['product_order_registernum'],0);
			//insert product_order payment
			$product_order_arr['ledger_id']=$ledger_id;
			}}
		if($product_order_arr['product_order_type']=="ht" && $product_order_arr['product_order_deposit']>0){
		$payreceivable_code="HTDP".$product_order_arr['users_code'].$product_order_arr['product_order_register'];
		$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_sale_deposit']." - ".$product_order_arr['product_order_register'];
		//insert payable
			$create_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_arr['product_order_deposit'],
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			if($this->payreceivable->create_payable($create_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}
			//unset
			//unset($product_order_arr['product_order_deposit_debit_acc']);
			}
		//update
		$this->db_insert("product_order",$product_order_arr);
		}
  	return $result;
	}
	
function update_product_order_sale_retur($product_order_arr,$product_order_id,$product_order_amount)
	{
	$result = true;
	$product_order_pay_method_unmatch=false;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		if($product_order_arr['product_order_status']=="pmn"){
		//get amount
		$product_order_row=$this->db_row("product_order","*","product_order_id='".$product_order_id."'");
		//delete old payment if not match
		if(($product_order_row['product_order_pay_method']!=$product_order_arr['product_order_pay_method']) || $product_order_row['product_order_status']=='tmp'){
			$product_order_pay_method_unmatch=true;
			//if old cash/bank
			if($product_order_row['product_order_pay_method']!="credit"){
				//delete ledger
				$this->db_delete("ledgerdetails","ledger_id='".$product_order_row['ledger_id']."'");
				$this->db_delete("ledger","ledger_id='".$product_order_row['ledger_id']."'");
				//clear ledger id 0
				$update_arr = array(
				'ledger_id'=>	0,
				);
				$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_id."'");
				}
			//if old credit
			if($product_order_row['product_order_pay_method']=="credit"){
				//delete payreceivable
				$this->payreceivable->delete_receivable($product_order_row['payreceivable_id'],1);
				//clear payreceivable id 0
				$update_arr = array(
				'payreceivable_id'=>	0,
				);
				$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_id."'");
				}
			}
		//if sale
		$ledger_description=$this->product_order_lang['form_header_product_order_lang']['product_order_sale_retur']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
		$payreceivable_code=$this->product_order_lang['form_header_product_order_lang']['product_order_sale_retur']." - ".$product_order_arr['product_order_code'];
		$payreceivable_type=0;
		$taxonomy_special_type=$this->book->taxonomi_get($product_order_arr['product_order_accountdebit']);
		//get trade expanse
		$trade_expanse_total=0;
		$stock_trade_account=$this->book->account_special_get("stock_trade");
		$sale_tax_account=$this->book->account_special_get("sale_tax");
		$expense_trade_account=$this->book->account_special_get("expense_trade");
		$sales_deposit=$this->book->account_special_get("sales_deposit");
		$hpp_account=$this->book->account_special_get("hpp");
		//if cash or not
		if($taxonomy_special_type['taxonomy_special_type']=="trade_payable" || $taxonomy_special_type['taxonomy_special_type']=="trade"){
			$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_retur_payable']." - ".$product_order_arr['product_order_code']." - ".$product_order_arr['product_order_register'];
			//insert items
			$update_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_amount,
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			//post ledger
			$penjualan_dagang=$product_order_arr['product_order_stock_trade']+$product_order_arr['product_order_income_trade'];
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"K",$product_order_amount,$product_order_arr['product_order_accountcredit'],"D",$penjualan_dagang,$hpp_account,"K",$product_order_arr['product_order_stock_trade'],$stock_trade_account,"D",$product_order_arr['product_order_stock_trade'],$sale_tax_account,"D",$product_order_arr['product_order_tax_val'],$expense_trade_account,"D",$product_order_arr['product_order_cost']);
			//if unmatch
			if($product_order_pay_method_unmatch){
				//create
				if($this->payreceivable->create_payable($update_arr,0,$set_rekening)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}else{
				//update
				$product_order_arr['payreceivable_id']=$product_order_row['payreceivable_id'];
				if($this->payreceivable->update_payable($update_arr,$product_order_row['payreceivable_id'],$set_rekening)){
				}}
			//if cash
			}else{
			//post ledger
			$penjualan_dagang=$product_order_arr['product_order_stock_trade']+$product_order_arr['product_order_income_trade'];
			$set_rekening=array($product_order_arr['product_order_accountdebit'],"K",$product_order_amount,$product_order_arr['product_order_accountcredit'],"D",$penjualan_dagang,$hpp_account,"K",$product_order_arr['product_order_stock_trade'],$stock_trade_account,"D",$product_order_arr['product_order_stock_trade'],$sale_tax_account,"D",$product_order_arr['product_order_tax_val'],$expense_trade_account,"D",$product_order_arr['product_order_cost']);
			//if unmatch
			if($product_order_pay_method_unmatch){
				//post ledger
				$ledger_id=$this->book->ledger_post($product_order_arr['product_order_register'],1,$ledger_description,$set_rekening,	$product_order_arr['product_order_registernum'],0);
				$product_order_arr['ledger_id']=$ledger_id;
				}else{
				//update ledger
				$this->book->ledgerdesc_update($product_order_row['ledger_id'],$ledger_description,$product_order_arr['users_trs_register'],$product_order_arr['users_trs_registernum'],0,$product_order_arr['users_code']);
				$this->book->ledgerdetails_update($product_order_row['ledger_id'],$product_order_arr['users_trs_register'],$set_rekening);
				$product_order_arr['ledger_id']=$product_order_row['ledger_id'];
				}
			}}
		if($product_order_arr['product_order_type']=="ht" && $product_order_arr['product_order_deposit']>0){
		$product_order_row=$this->db_row("product_order","ledger_id,payreceivable_id,product_order_pay_method","product_order_id='".$product_order_id."'");
		$payreceivable_code="HTDP".$product_order_arr['users_code'].$product_order_arr['product_order_register'];
		$payreceivable_description=$this->product_order_lang['form_header_product_order_lang']['product_order_sale_deposit']." - ".$product_order_arr['product_order_register'];
		//insert payable
			$update_arr = array(
			'users_code'=>	$product_order_arr['users_code'],
			'payreceivable_register'=>	$product_order_arr['product_order_register'],
			'payreceivable_registernum'=>	$product_order_arr['product_order_registernum'],
			'payreceivable_code'=>	$payreceivable_code,
			'payreceivable_description'=>	$payreceivable_description,
			'payreceivable_amount'=>	$product_order_arr['product_order_deposit'],
			'payreceivable_uneditable'=>	1,
			'payreceivable_accountdebit'=>	$product_order_arr['product_order_accountdebit'],
			'payreceivable_accountcredit'=>	$product_order_arr['product_order_accountcredit'],
			'payreceivable_type'=>	$payreceivable_type?$payreceivable_type:0,
			'payreceivable_status'=>	0,
			);
			
			if($product_order_row['payreceivable_id']>0){
			$product_order_arr['payreceivable_id']=$product_order_row['payreceivable_id'];
			if($this->payreceivable->update_payable($update_arr,$product_order_row['payreceivable_id'])){
				}
			}else{
			if($this->payreceivable->create_payable($update_arr)){
				$product_order_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}}
			//unset
			//unset($product_order_arr['product_order_deposit_debit_acc']);
			}
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
	
//prodect order sale
function save_product_order_sale_retur($product_order_arr,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		$product_order_arr['product_order_status']='tmp';
		//update
		$this->db_insert("product_order",$product_order_arr);
		}
  	return $result;
	}
	
//prodect order sale
function saveupdate_product_order_sale_retur($product_order_arr,$product_order_id,$product_order_amount)
	{
	$result = true;
	//validate
	//if not redundant
	//create product_order
	if($result){
		//before update
		$product_order_arr['product_order_status']='tmp';
		//update
		$this->db_update("product_order",$product_order_arr,"product_order_id='".$product_order_id."'");
		}
  	return $result;
	}
		
//product_order expired
function product_orderdetails_list($product_order_id)
	{
	$result = "";
	$db_select = $this->db_select("product_orderdetails","product_orderdetails_id,product_orderdetails_quantity,product_orderdetails_price,product_code","product_order_id='".$product_order_id."' AND product_orderdetails_status='pmn'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$result.="XXX".$select_data[$i]['product_orderdetails_id'].",".$select_data[$i]['product_orderdetails_quantity'].",".$select_data[$i]['product_orderdetails_price'].",".$select_data[$i]['product_code'];
		}
	return $result;
	}
	
//service
function delete_service($service_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	/*
		if($this->tbldata_exist("service_orderdetails","service_orderdetails_id","service_id='".$service_id."'")){
		$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['service_used'];
		$result = false;
		}
		*/
	//delete service
	if($result){
		$this->db_delete("service","service_id='".$service_id."'");
		//on delete
		}
  	return $result;
	}

function create_service($service_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($service_arr['service_code'])!="" && $this->tbldata_exist("service","service_id","service_code='".trim($service_arr['service_code'])."'")){
		//$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['service_code'];
		//$result = false;
		}
	//create service
	if($result){
		$this->db_insert("service",$service_arr);
		//on create
		}
  	return $result;
	}
	
function update_service($service_arr,$service_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($service_arr['service_code'])!="" && $this->tbldata_exist("service","service_id","service_code='".trim($service_arr['service_code'])."' AND service_id!='".$service_id."'")){
		//$this->err_msg=$this->product_order_lang['msgform_product_order_lang']['service_code'];
		//$result = false;
		}
	//update service
	if($result){
		$this->db_update("service",$service_arr,"service_id='".$service_id."'");
		//on update
		}
  	return $result;
	}

//product_stock_opname
function product_stock_opname($product_code,$adjust_opname)
	{
	//get current_real_stock (beli-jual+current_opname)
	$product_orderdetails_row=$this->db_row("product_orderdetails","(SUM(case when product_orderdetails_type = 'pi' AND product_orderdetails_status = 'pmn' then product_orderdetails_quantity end)-SUM(case when product_orderdetails_type = 'si' AND product_orderdetails_status = 'pmn' then product_orderdetails_quantity end)) AS product_quantity","product_code='".$product_code."' GROUP BY product_code");
	if(!isset($product_orderdetails_row['product_orderdetails_id'])){
		$product_quantity=$product_orderdetails_row['product_quantity'];
		}else{
		$product_quantity=0;
		}
	$current_opname=$this->db_fldrow("product","product_stock_opname","product_code='".$product_code."'");
	$current_real_stock=$product_quantity+$current_opname;
	//get selisih/new_opname (adjust_opname-current_real_stock)
	//$new_opname=$adjust_opname-$current_real_stock;
	$new_opname=$current_opname+($adjust_opname-$current_real_stock);
	//return new_opname
	return $new_opname;
	}
	
//product_stock_opname_rev
function product_stock_opname_rev($product_code)
	{
	//get current_real_stock (beli-jual+current_opname)
	$product_orderdetails_row=$this->db_row("product_orderdetails","(SUM(case when product_orderdetails_type = 'pi' AND product_orderdetails_status = 'pmn' then product_orderdetails_quantity end)-SUM(case when product_orderdetails_type = 'si' AND product_orderdetails_status = 'pmn' then product_orderdetails_quantity end)) AS product_quantity","product_code='".$product_code."' GROUP BY product_code");
	if(!isset($product_orderdetails_row['product_orderdetails_id'])){
		$product_quantity=$product_orderdetails_row['product_quantity'];
		}else{
		$product_quantity=0;
		}
	$current_opname=$this->db_fldrow("product","product_stock_opname","product_code='".$product_code."'");
	$current_real_stock=$product_quantity+$current_opname;
	//return current_real_stock
	return $current_real_stock;
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
	
//code generator2
function generator_code2($str_code,$str_add_def)
	{
	$str = substr($str_code, 13);
	
	if($str==""){
		$str = 1;
		}else{
		$str = ltrim($str, '0')+1;
		}
	$str_add=3-strlen($str);
	$str2 = str_pad($str,(strlen($str) + $str_add),"0",STR_PAD_LEFT);
	return $str_add_def.$str2;
	}
	
//service vendor code generator
function generator_service_vendor_code($service_order_status="pmn",$service_order_registernum="")
	{
	if($service_order_registernum==""){
		$service_order_registernum=intval(date("Y").date("m"));
		}
	if($service_order_status=="pmn"){
	$initial="FV.";
	$service_order_status_qry=" AND service_order_type='pi'";
	}
	$db_select = $this->db_select("service_order","service_order_code","service_order_registernum LIKE'".$service_order_registernum."%' AND service_order_code LIKE '".$initial."%' AND LENGTH(service_order_code) = 15".$service_order_status_qry,"service_order_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$service_order_code=$select_data[0]['service_order_code'];
	$str_add_def=$initial.$service_order_registernum.".";
	return $this->generator_code($service_order_code,$str_add_def);
	}
	
//vendor code generator
function generator_service_vendor_queue($service_order_registernum="")
	{
	if($service_order_registernum==""){
		$service_order_registernum=intval(date("Y").date("m"));
		}
	$db_select = $this->db_select("service_order","service_order_queue","service_order_type='pi' AND service_order_registernum LIKE'".$service_order_registernum."%' AND service_order_code LIKE 'FV.%' AND LENGTH(service_order_code) = 15","service_order_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$service_order_queue =$select_data[0]['service_order_queue']+1;
	return $service_order_queue;
	}

//product order buy code generator
function generator_product_order_buy_code($product_order_type="po",$product_order_registernum="")
	{
	if($product_order_registernum==""){
		$product_order_registernum=intval(date("Y").date("m"));
		}
	if($product_order_type=="pmn"){
	$initial="FB.";
	$product_order_type_qry=" AND (product_order_type='pi')";
	}else{
	$initial="PO.";
	$product_order_type_qry=" AND product_order_type='po'";
	}
	$db_select = $this->db_select("product_order","product_order_code","product_order_registernum LIKE'".$product_order_registernum."%' AND product_order_code LIKE '".$initial."%' AND LENGTH(product_order_code) = 15".$product_order_type_qry,"product_order_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$product_order_code=$select_data[0]['product_order_code'];
	$str_add_def=$initial.$product_order_registernum.".";
	return $this->generator_code($product_order_code,$str_add_def);
	}
	
//product order buy code generator
function generator_product_order_buy_retur_code($product_order_registernum="")
	{
	if($product_order_registernum==""){
		$product_order_registernum=intval(date("Y").date("m"));
		}
	$initial="RB.";
	$product_order_type_qry=" AND (product_order_type='pr')";
	$db_select = $this->db_select("product_order","product_order_code","product_order_registernum LIKE'".$product_order_registernum."%' AND product_order_code LIKE '".$initial."%' AND LENGTH(product_order_code) = 15".$product_order_type_qry,"product_order_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$product_order_code=$select_data[0]['product_order_code'];
	$str_add_def=$initial.$product_order_registernum.".";
	return $this->generator_code($product_order_code,$str_add_def);
	}
	
//product order sale code generator
function generator_product_order_sale_code($product_order_type="ht",$product_order_registernum="")
	{
	if($product_order_registernum==""){
		$product_order_registernum=intval(date("Y").date("m"));
		}
	if($product_order_type=="pmn"){
	$initial="FJ.";
	$product_order_type_qry=" AND (product_order_type='si')";
	}else{
	$initial="HT.";
	$product_order_type_qry=" AND product_order_type='ht'";
	}
	$db_select = $this->db_select("product_order","product_order_code","product_order_registernum LIKE'".$product_order_registernum."%' AND product_order_code LIKE '".$initial."%' AND LENGTH(product_order_code) = 15".$product_order_type_qry,"product_order_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$product_order_code=$select_data[0]['product_order_code'];
	$str_add_def=$initial.$product_order_registernum.".";
	return $this->generator_code($product_order_code,$str_add_def);
	}
	
//product order sale retur code generator
function generator_product_order_sale_retur_code($product_order_registernum="")
	{
	if($product_order_registernum==""){
		$product_order_registernum=intval(date("Y").date("m"));
		}
	$initial="RJ.";
	$product_order_type_qry=" AND (product_order_type='sr')";
	$db_select = $this->db_select("product_order","product_order_code","product_order_registernum LIKE'".$product_order_registernum."%' AND product_order_code LIKE '".$initial."%' AND LENGTH(product_order_code) = 15".$product_order_type_qry,"product_order_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$product_order_code=$select_data[0]['product_order_code'];
	$str_add_def=$initial.$product_order_registernum.".";
	return $this->generator_code($product_order_code,$str_add_def);
	}
	
//product order sale code generator
function generator_service_order_sale_code($service_order_registernum="")
	{
	if($service_order_registernum==""){
		$service_order_registernum=intval(date("Y").date("m").date("d"));
		}
	$db_select = $this->db_select("service_order","service_order_code","service_order_type='si' AND service_order_registernum='".$service_order_registernum."' AND service_order_code LIKE 'PKB.%' AND LENGTH(service_order_code) = 16","service_order_queue DESC",0,1);
	$select_data=$db_select['select_data'];
	$service_order_code=$select_data[0]['service_order_code'];
	$str_add_def="PKB.".$service_order_registernum.".";
	return $this->generator_code($service_order_code,$str_add_def,13,3);
	}
	
//product order sale code generator
function generator_service_order_sale_queue($service_order_registernum="")
	{
	if($service_order_registernum==""){
		$service_order_registernum=intval(date("Y").date("m").date("d"));
		}
	$db_select = $this->db_select("service_order","service_order_queue","service_order_type='si' AND service_order_registernum='".$service_order_registernum."' AND service_order_code LIKE 'PKB.%' AND LENGTH(service_order_code) = 16","service_order_queue DESC",0,1);
	$select_data=$db_select['select_data'];
	$service_order_queue =$select_data[0]['service_order_queue']+1;
	return $service_order_queue;
	}
	
//warehouse stock in generator
function generator_warehouse_stock_edit_code($warehouse_stock_type="in",$warehouse_stock_registernum="")
	{
	if($warehouse_stock_registernum==""){
		$warehouse_stock_registernum=intval(date("Y").date("m"));
		}
	if($warehouse_stock_type=="trs"){
	$initial="ST.";
	$warehouse_stock_type_qry=" AND warehouse_stock_type='trs'";
	}else if($warehouse_stock_type=="opname"){
	$initial="SO.";
	$warehouse_stock_type_qry=" AND warehouse_stock_type='opname'";
	}else if($warehouse_stock_type=="out"){
	$initial="SK.";
	$warehouse_stock_type_qry=" AND warehouse_stock_type='out'";
	}else{
	$initial="SM.";
	$warehouse_stock_type_qry=" AND warehouse_stock_type='in'";
	}
	$db_select = $this->db_select("warehouse_stock","warehouse_stock_code","warehouse_stock_registernum LIKE'".$warehouse_stock_registernum."%' AND warehouse_stock_code LIKE '".$initial."%' AND LENGTH(warehouse_stock_code) = 15".$warehouse_stock_type_qry,"warehouse_stock_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$warehouse_stock_code=$select_data[0]['warehouse_stock_code'];
	$str_add_def=$initial.$warehouse_stock_registernum.".";
	return $this->generator_code($warehouse_stock_code,$str_add_def);
	}
	
//warehouse stock in generator
function generator_warehouse_stock_init_code($warehouse_stock_type="init",$warehouse_stock_registernum="")
	{
	if($warehouse_stock_registernum==""){
		$warehouse_stock_registernum=intval(date("Y").date("m"));
		}
	if($warehouse_stock_type=="init"){
	$initial="SI.";
	$warehouse_stock_type_qry=" AND warehouse_stock_type='in'";
	}
	$db_select = $this->db_select("warehouse_stock","warehouse_stock_code","warehouse_stock_registernum LIKE'".$warehouse_stock_registernum."%' AND warehouse_stock_code LIKE '".$initial."%' AND LENGTH(warehouse_stock_code) = 15".$warehouse_stock_type_qry,"warehouse_stock_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$warehouse_stock_code=$select_data[0]['warehouse_stock_code'];
	$str_add_def=$initial.$warehouse_stock_registernum.".";
	return $this->generator_code($warehouse_stock_code,$str_add_def);
	}
	
//po realization update expired
function po_realization_expired_status()
	{
	//loop active PO
	$product_order_row=$this->db_qry_data("SELECT *
	FROM product_order
	WHERE product_order_type='po' AND product_order_po_status!='closed'
	ORDER BY product_order_id ASC");
	for($i=0;$i<count($product_order_row['select_data']);$i++){
		//cek expired
		$set_date=$this->date_stridtonum($product_order_row['select_data'][$i]['product_order_register']);
		$start_date = new DateTime($set_date);
		$today = date('Y-m-d');
		$since_start = $start_date->diff(new DateTime($today));
		//echo $product_order_row['select_data'][$i]['product_order_code']."-".$since_start->days;
		//echo "<br>";
		if($since_start->days>30){
		//loop details
		$db_select = $this->db_select("product_orderdetails","*","product_order_id='".$product_order_row['select_data'][$i]['product_order_id']."' AND product_orderdetails_po_status!='closed'","",0,0);
		$select_data=$db_select['select_data'];
		for($j=0;$j<$db_select['select_num'];$j++){
			$po_qty= $select_data[$j]['product_orderdetails_quantity'];
			$sum_row=$this->db_qry_data("SELECT 
			IFNULL(SUM(product_orderdetails_po_real.product_orderdetails_po_qty), 0) AS sum_po_qty
			FROM product_orderdetails_po_real
			WHERE product_orderdetails_po_real.product_orderdetails_id='".$select_data[$j]['product_orderdetails_id']."'
			GROUP BY product_orderdetails_po_real.product_orderdetails_id
			ORDER BY product_orderdetails_po_real.product_orderdetails_id ASC");
			$realize_po_qty=0;
			if($sum_row['select_num']>0){
				$realize_po_qty=$sum_row['select_data'][0]['sum_po_qty'];
				}
			$residu_po_qty=$po_qty-$realize_po_qty;
			
			//update status to closed
			$update_arr = array(
			'product_orderdetails_po_status'=>	"closed",
			);
			$this->db_update("product_orderdetails",$update_arr,"product_orderdetails_id='".$select_data[$j]['product_orderdetails_id']."'");
			//update product_stock_po
			$product_stock_po=$this->db_fldrow("product","product_stock_po","product_code='".$select_data[$j]['product_code']."'");
			$product_stock_po_last=$product_stock_po-$residu_po_qty;
			if($product_stock_po_last<0){
				$product_stock_po_last=0;
				}
			$update_arr = array(
			'product_stock_po'=>	$product_stock_po_last,
			);
			$this->db_update("product",$update_arr,"product_code='".$select_data[$j]['product_code']."'");
			}
		//update items
		$update_arr = array(
		'product_order_po_status'=>	"closed",
		);
		$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_row['select_data'][$i]['product_order_id']."'");
		}}
	}

//po realization update status
function po_realization_update_status($product_order_id=0)
	{
	$product_order_qry="product_order.product_order_type='po' AND product_order.product_order_po_status!='closed'";
	if($product_order_id>0){
		$product_order_qry="product_order.product_order_id='".$product_order_id."'";
		}
	//loop active PO
	$product_order_row=$this->db_qry_data("SELECT product_order.product_order_id,product_order.product_order_code,COUNT(DISTINCT product_orderdetails.product_orderdetails_id) AS unit_list,
	SUM(CASE WHEN (product_orderdetails.product_orderdetails_po_status='closed') THEN 1 ELSE 0 END) status_in
	FROM product_orderdetails
	JOIN product_order ON product_order.product_order_id = product_orderdetails.product_order_id 
	WHERE ".$product_order_qry."
	GROUP BY product_order.product_order_id
	ORDER BY product_order.product_order_id ASC");
	//print_r($product_order_row);
	for($i=0;$i<count($product_order_row['select_data']);$i++){
		//status pending
		if($product_order_row['select_data'][$i]['unit_list']>$product_order_row['select_data'][$i]['status_in'] && $product_order_row['select_data'][$i]['status_in']>0){
		$product_order_po_status="pending";
		}
		//status closed
		else if($product_order_row['select_data'][$i]['unit_list']==$product_order_row['select_data'][$i]['status_in'] && $product_order_row['select_data'][$i]['unit_list']>0){
		$product_order_po_status="closed";
		}
		//status closed
		else{
		$product_order_po_status="active";
		}
		//update items
		$update_arr = array(
		'product_order_po_status'=>	$product_order_po_status,
		);
		//print_r($update_arr);
		$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_row['select_data'][$i]['product_order_id']."'");
		}
	}

//po realization
function po_realization($product_order_id)
	{
	$product_order_row=$this->db_row("product_order","users_code,product_order_registernum,product_order_status","product_order_id='".$product_order_id."'");
	if($product_order_row['product_order_status']=='pmn'){
	$users_code=$product_order_row['users_code'];
	$product_order_registernum=$product_order_row['product_order_registernum'];
	//loop product_orderdetails FB
	$db_select = $this->db_select("product_orderdetails","*","product_order_id='".$product_order_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$product_orderdetails_quantity=$select_data[$i]['product_orderdetails_quantity'];
		$db_select2 = $this->db_select("product_order,product_orderdetails","product_orderdetails.*","product_order.product_order_po_status!='closed' AND product_order.product_order_registernum<=".$product_order_registernum." AND product_order.product_order_type='po' AND product_orderdetails.product_orderdetails_po_status!='closed' AND product_orderdetails.product_code='".$select_data[$i]['product_code']."' AND product_order.users_code='".$users_code."' AND product_order.product_order_id=product_orderdetails.product_order_id","product_order.product_order_registernum ASC",0,0);
		//print_r($db_select2);
		$select_data2=$db_select2['select_data'];
		//print_r($db_select2);
		for($j=0;$j<$db_select2['select_num'];$j++){
			if($product_orderdetails_quantity>0){
				//create product_orderdetails_po_real
				$product_orderdetails_po_quantity=$select_data2[$j]['product_orderdetails_quantity'];
				$product_orderdetails_po_qty=$product_orderdetails_po_quantity;
				if($product_orderdetails_po_quantity>$product_orderdetails_quantity){
					$product_orderdetails_po_qty=$product_orderdetails_quantity;
					}
				$product_orderdetails_quantity -=$product_orderdetails_po_qty;
				//insert items
				$create_arr = array(
				'product_orderdetails_id'=>	$select_data2[$j]['product_orderdetails_id'],
				'product_orderdetails_faktur_id'=>	$select_data[$i]['product_orderdetails_id'],
				'product_orderdetails_po_qty'=>	$product_orderdetails_po_qty,
				);
				//print_r($create_arr);
				$this->db_insert("product_orderdetails_po_real",$create_arr);
				}
			}
		}}
	}
	
//reset_realization
function reset_realization($product_order_id)
	{
	$db_select = $this->db_select("product_orderdetails","*","product_order_id='".$product_order_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$product_order_row=$this->db_qry_data("SELECT product_order.product_order_id
		FROM product_orderdetails_po_real
		JOIN product_orderdetails ON product_orderdetails_po_real.product_orderdetails_id = product_orderdetails.product_orderdetails_id
		JOIN product_order ON product_order.product_order_id = product_orderdetails.product_order_id 
		WHERE product_orderdetails_faktur_id='".$select_data[$i]['product_orderdetails_id']."'
		GROUP BY product_order.product_order_id
		ORDER BY product_order.product_order_id ASC");
		$this->db_delete("product_orderdetails_po_real","product_orderdetails_faktur_id='".$select_data[$i]['product_orderdetails_id']."'");
		for($j=0;$j<count($product_order_row['select_data']);$j++){
			$this->po_realization_update_status($product_order_row['select_data'][$j]['product_order_id']);
			}
		}
	}
	
//ht realization update status
function ht_realization_update_status($product_order_id=0)
	{
	$product_order_qry="product_order.product_order_type='ht' AND product_order.product_order_ht_status!='closed'";
	if($product_order_id>0){
		$product_order_qry="product_order.product_order_id='".$product_order_id."'";
		}
	//loop active ht
	$product_order_row=$this->db_qry_data("SELECT product_order.product_order_id,product_order.product_order_code,COUNT(DISTINCT product_orderdetails.product_orderdetails_id) AS unit_list,
	SUM(CASE WHEN (product_orderdetails.product_orderdetails_ht_status='closed') THEN 1 ELSE 0 END) status_in
	FROM product_orderdetails
	JOIN product_order ON product_order.product_order_id = product_orderdetails.product_order_id 
	WHERE ".$product_order_qry."
	GROUP BY product_order.product_order_id
	ORDER BY product_order.product_order_id ASC");
	//print_r($product_order_row);
	for($i=0;$i<count($product_order_row['select_data']);$i++){
		//status pending
		if($product_order_row['select_data'][$i]['unit_list']>$product_order_row['select_data'][$i]['status_in'] && $product_order_row['select_data'][$i]['status_in']>0){
		$product_order_ht_status="pending";
		}
		//status closed
		else if($product_order_row['select_data'][$i]['unit_list']==$product_order_row['select_data'][$i]['status_in'] && $product_order_row['select_data'][$i]['unit_list']>0){
		$product_order_ht_status="closed";
		}
		//status closed
		else{
		$product_order_ht_status="active";
		}
		//update items
		$update_arr = array(
		'product_order_ht_status'=>	$product_order_ht_status,
		);
		//print_r($update_arr);
		$this->db_update("product_order",$update_arr,"product_order_id='".$product_order_row['select_data'][$i]['product_order_id']."'");
		}
	}

//ht realization
function ht_realization($product_order_id,$ht_order_id)
	{
	$product_order_row=$this->db_row("product_order","users_code,product_order_registernum,product_order_status","product_order_id='".$product_order_id."'");
	if($product_order_row['product_order_status']=='pmn'){
	$users_code=$product_order_row['users_code'];
	$product_order_registernum=$product_order_row['product_order_registernum'];
	//loop product_orderdetails FB
	$db_select = $this->db_select("product_orderdetails","*","product_order_id='".$product_order_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$product_orderdetails_quantity=$select_data[$i]['product_orderdetails_quantity'];
		$db_select2 = $this->db_select("product_order,product_orderdetails","product_orderdetails.*","product_order.product_order_ht_status!='closed' AND product_order.product_order_id='".$ht_order_id."' AND product_order.product_order_type='ht' AND product_orderdetails.product_orderdetails_ht_status!='closed' AND product_orderdetails.product_code='".$select_data[$i]['product_code']."' AND product_order.users_code='".$users_code."' AND product_order.product_order_id=product_orderdetails.product_order_id","product_order.product_order_registernum ASC",0,0);
		//print_r($db_select2);
		$select_data2=$db_select2['select_data'];
		//print_r($db_select2);
		for($j=0;$j<$db_select2['select_num'];$j++){
			if($product_orderdetails_quantity>0){
				//create product_orderdetails_ht_real
				$product_orderdetails_ht_quantity=$select_data2[$j]['product_orderdetails_quantity'];
				$product_orderdetails_ht_qty=$product_orderdetails_ht_quantity;
				if($product_orderdetails_ht_quantity>$product_orderdetails_quantity){
					$product_orderdetails_ht_qty=$product_orderdetails_quantity;
					}
				$product_orderdetails_quantity -=$product_orderdetails_ht_qty;
				//insert items
				$create_arr = array(
				'product_orderdetails_id'=>	$select_data2[$j]['product_orderdetails_id'],
				'product_orderdetails_faktur_id'=>	$select_data[$i]['product_orderdetails_id'],
				'product_orderdetails_ht_qty'=>	$product_orderdetails_ht_qty,
				);
				//print_r($create_arr);
				$this->db_insert("product_orderdetails_ht_real",$create_arr);
				}
			}

		}}
	}
	
//reset_realization
function ht_reset_realization($product_order_id)
	{
	$db_select = $this->db_select("product_orderdetails","*","product_order_id='".$product_order_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$product_order_row=$this->db_qry_data("SELECT product_order.product_order_id
		FROM product_orderdetails_ht_real
		JOIN product_orderdetails ON product_orderdetails_ht_real.product_orderdetails_id = product_orderdetails.product_orderdetails_id
		JOIN product_order ON product_order.product_order_id = product_orderdetails.product_order_id 
		WHERE product_orderdetails_faktur_id='".$select_data[$i]['product_orderdetails_id']."'
		GROUP BY product_order.product_order_id
		ORDER BY product_order.product_order_id ASC");
		$this->db_delete("product_orderdetails_ht_real","product_orderdetails_faktur_id='".$select_data[$i]['product_orderdetails_id']."'");
		for($j=0;$j<count($product_order_row['select_data']);$j++){
			$this->ht_realization_update_status($product_order_row['select_data'][$j]['product_order_id']);
			}
		}
	}
	
}
?>
