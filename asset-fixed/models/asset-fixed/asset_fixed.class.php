<?php
require_once(SITE_ROOT."payreceivable/models/payreceivable/payreceivable.class.php");
require_once(SITE_ROOT."book/models/book/book.class.php");
class asset_fixed extends global_class 
{
var $book;
public $err_msg;
public $asset_fixed_lang;
function __construct()
	{
	include(SITE_ROOT."config/global.php");
	include(SITE_ROOT."asset-fixed/lang/".$glob_config['db_config']['lang']."/lang.php");
	parent::__construct();
	$this->book = new book();
	$this->payreceivable = new payreceivable();
	$this->asset_fixed_lang = $asset_fixed_lang;
	}
	
//asset fixed
function delete_asset_fixed($asset_fixed_id)
	{
	$result = true;
	//validate
	//if not related
	if($this->tbldata_exist("depreciation","*","asset_fixed_id='".$asset_fixed_id."'")){
		$this->err_msg="";
		$result = false;
		}
	//delete asset_fixed
	if($result){
		$asset_fixed_row=$this->db_row("asset_fixed","payreceivable_id,ledger_id","asset_fixed_id='".$asset_fixed_id."'");
		$this->db_delete("ledgerdetails","ledger_id='".$asset_fixed_row['ledger_id']."'");
		$this->db_delete("ledger","ledger_id='".$asset_fixed_row['ledger_id']."'");
		$this->payreceivable->delete_receivable($asset_fixed_row['payreceivable_id'],1);
		$this->db_delete("asset_fixed","asset_fixed_id='".$asset_fixed_id."'");
		//on delete
		}
  	return $result;
	}
	
function create_asset_fixed($asset_fixed_arr,$ledger_status=0)
	{
	$result = true;
	//validate
	//if not redundant type
	//create users
	if($result){
		//before post
		//if cash or not
		if($ledger_status==0){
		$taxonomy_special_type=$this->book->taxonomi_get($asset_fixed_arr['asset_fixed_accountcredit']);
		if($taxonomy_special_type['taxonomy_special_type']=="payable"){
		//insert items
		$create_arr = array(
		'users_code'=>	$asset_fixed_arr['users_code'],
		'payreceivable_register'=>	$asset_fixed_arr['asset_fixed_register'],
		'payreceivable_registernum'=>	$asset_fixed_arr['asset_fixed_registernum'],
		'payreceivable_code'=>	$asset_fixed_arr['asset_fixed_code']."-".$asset_fixed_arr['asset_fixed_name'],
		'payreceivable_description'=>	$this->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_register'],
		'payreceivable_amount'=>	$asset_fixed_arr['asset_fixed_amount'],
		'payreceivable_uneditable'=>	1,
		'payreceivable_accountdebit'=>	$asset_fixed_arr['asset_fixed_accountdebit'],
		'payreceivable_accountcredit'=>	$asset_fixed_arr['asset_fixed_accountcredit'],
		'project_id'=>	0,
		'payreceivable_type'=>	0,
		'payreceivable_status'=>	0,
		);
		if($this->payreceivable->create_payable($create_arr)){
			$asset_fixed_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
			}
		}else{
		//general ledger
		$ledger_description=$this->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_register']." - ".$asset_fixed_arr['asset_fixed_code']." - ".$asset_fixed_arr['asset_fixed_name']." - ".$asset_fixed_arr['asset_fixed_register'];
		$set_rekening=array($asset_fixed_arr['asset_fixed_accountdebit'],"D",$asset_fixed_arr['asset_fixed_amount'],$asset_fixed_arr['asset_fixed_accountcredit'],"K",$asset_fixed_arr['asset_fixed_amount']);
		//post ledger
		$ledger_id=$this->book->ledger_post($asset_fixed_arr['asset_fixed_register'],1,$ledger_description,$set_rekening,$asset_fixed_arr['asset_fixed_registernum'],0,"asset_fixed");
		$asset_fixed_arr['ledger_id']=$ledger_id;
		$this->book->subsidiary_update($ledger_id);
		}}
		$this->db_insert("asset_fixed",$asset_fixed_arr);
		//on create
		//if piutang
		//post piutang
		}
  	return $result;
	}
	
function update_asset_fixed($asset_fixed_arr,$asset_fixed_id)
	{
	$result = true;
	//validate
	//if not redundant type
	//create users
	if($result){
		//before post
		$asset_fixed_row=$this->db_row("asset_fixed","payment_type,payreceivable_id,ledger_id","asset_fixed_id='".$asset_fixed_id."'");
		$payment_type_old=$asset_fixed_row['payment_type'];
		$payreceivable_id_old=$asset_fixed_row['payreceivable_id'];
		$ledger_id_old=$asset_fixed_row['ledger_id'];
		if($ledger_id_old>0){
		//if cash or not
		$taxonomy_special_type=$this->book->taxonomi_get($asset_fixed_arr['asset_fixed_accountcredit']);
		if($asset_fixed_arr['payment_type']=="credit"){
		//insert items
		$create_arr = array(
		'users_code'=>	$asset_fixed_arr['users_code'],
		'payreceivable_register'=>	$asset_fixed_arr['asset_fixed_register'],
		'payreceivable_registernum'=>	$asset_fixed_arr['asset_fixed_registernum'],
		'payreceivable_code'=>	$asset_fixed_arr['asset_fixed_code']."-".$asset_fixed_arr['asset_fixed_name'],
		'payreceivable_description'=>	$this->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_register'],
		'payreceivable_amount'=>	$asset_fixed_arr['asset_fixed_amount'],
		'payreceivable_uneditable'=>	1,
		'payreceivable_accountdebit'=>	$asset_fixed_arr['asset_fixed_accountdebit'],
		'payreceivable_accountcredit'=>	$asset_fixed_arr['asset_fixed_accountcredit'],
		'project_id'=>	0,
		'payreceivable_type'=>	0,
		'payreceivable_status'=>	0,
		);
		if($payment_type_old=="cash"){
			$this->db_delete("ledgerdetails","ledger_id='".$ledger_id_old."'");
			$this->db_delete("ledger","ledger_id='".$ledger_id_old."'");
			//echo "utang payment_type_old=cash";
			if($this->payreceivable->create_payable($create_arr)){
				$asset_fixed_arr['payreceivable_id']=$this->db_lastid("payreceivable","payreceivable_id");
				}
			}else{
			$asset_fixed_arr['payreceivable_id']=$payreceivable_id_old;
			//echo "utang payment_type_old=credit";
			if(!$this->payreceivable->update_payable($create_arr,$payreceivable_id_old)){
				$payreceivable->error_message($payreceivable->err_msg);
				}
			}
		}else{
		//general ledger
		$ledger_description=$this->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_register']." - ".$asset_fixed_arr['asset_fixed_code']." - ".$asset_fixed_arr['asset_fixed_name']." - ".$asset_fixed_arr['asset_fixed_register'];
		$set_rekening=array($asset_fixed_arr['asset_fixed_accountdebit'],"D",$asset_fixed_arr['asset_fixed_amount'],$asset_fixed_arr['asset_fixed_accountcredit'],"K",$asset_fixed_arr['asset_fixed_amount']);
		if($payment_type_old=="credit"){
			//post ledger
			//echo "kas payment_type_old=credit";
			$this->payreceivable->delete_payable($payreceivable_id_old,1);
			$ledger_id=$this->book->ledger_post($asset_fixed_arr['asset_fixed_register'],1,$ledger_description,$set_rekening,$asset_fixed_arr['asset_fixed_registernum']);
			}else{
			//echo "kas payment_type_old=cash";
			$ledger_id=$ledger_id_old;
			$this->book->ledgerdesc_update($ledger_id,$ledger_description,$asset_fixed_arr['asset_fixed_register'],$asset_fixed_arr['asset_fixed_registernum'],0);
			$this->book->ledgerdetails_update($ledger_id,$asset_fixed_arr['asset_fixed_register'],$set_rekening);
			}
		$asset_fixed_arr['ledger_id']=$ledger_id;
		$this->book->subsidiary_update($ledger_id);
		}}
		$this->db_update("asset_fixed",$asset_fixed_arr,"asset_fixed_id='".$asset_fixed_id."'");
		//on create
		//if piutang
		//post piutang
		}
  	return $result;
	}


function depreciation_amount($asset_fixed_id,$month_year)
	{
	$depreciation_amount=parent::db_fldrow("depreciation","depreciation_amount","asset_fixed_id='".$asset_fixed_id."' AND depreciation_register LIKE '%".$month_year."'");
	return $depreciation_amount;
	}

function auto_depreciation($mk_today,$depreciation_expanse_label)
	{
	$db_select = parent::db_select("asset_fixed","asset_fixed.*","","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$asset_fixed_id=$select_data[$i]['asset_fixed_id'];
		$asset_fixed_code=$select_data[$i]['asset_fixed_code'];
		$asset_fixed_register=$select_data[$i]['asset_fixed_register'];
		$asset_fixed_name=$select_data[$i]['asset_fixed_name'];
		$asset_fixed_amount=$select_data[$i]['asset_fixed_amount'];
		$asset_fixed_depreciation_period=$select_data[$i]['asset_fixed_depreciation_period'];
		$asset_fixed_depreciation_type=$select_data[$i]['asset_fixed_depreciation_type'];
		$asset_fixed_type=$select_data[$i]['asset_fixed_type'];
		if($asset_fixed_type=="building_inventory"){
			$asset_fixed_accom="building_accom_depreciation";
			$asset_fixed_expdep="expense_building_depreciation";
			}else if($asset_fixed_type=="car_inventory"){
			$asset_fixed_accom="car_accom_depreciation";
			$asset_fixed_expdep="expense_car_depreciation";
			}else{
			$asset_fixed_accom="accom_depreciation";
			$asset_fixed_expdep="expense_depreciation";
			}
		//explode registrasi
		$asset_fixed_register_array = explode("/",$asset_fixed_register);
		$tanggal_asset_fixed_register=$asset_fixed_register_array[0];
		$month_asset_fixed_register=$asset_fixed_register_array[1];
		$year_asset_fixed_register=$asset_fixed_register_array[2];
		//check sisa beban depreciation asset_fixed
		$total_depreciation=0;
		$db_select2 = parent::db_select("depreciation","*","asset_fixed_id='".$asset_fixed_id."'","",0,0);
		$select_data2=$db_select2['select_data'];
		for($j=0;$j<$db_select2['select_num'];$j++)
			{
			$depreciation_amount=$select_data2[$j]['depreciation_amount'];
			$total_depreciation=$total_depreciation+$depreciation_amount;
			}
		if($total_depreciation<$asset_fixed_amount)
			{
			//looping masa month
			for($k=1;$k<=$asset_fixed_depreciation_period;$k++)
				{
				//buat biaya depreciation if not exist
				$db_select3 = parent::db_select("depreciation","*","depreciation_no='".$k."' AND asset_fixed_id='".$asset_fixed_id."'","",0,0);
				$select_num3=$db_select3['select_num'];
				if($select_num3==0)
					{
					//metode depreciation
					if($asset_fixed_depreciation_type=="Straightline")
						{
						$depreciation_amount=$asset_fixed_amount/$asset_fixed_depreciation_period;
						}
					//insert ledger
					$tanggal_registrasiberikut_asset_fixed=1;
					$month_registrasiberikut_asset_fixed=$month_asset_fixed_register + $k;
					$year_registrasiberikut_asset_fixed=$year_asset_fixed_register;
					$mkt_registrasiberikut_asset_fixed = mktime(0,0,0,$month_registrasiberikut_asset_fixed,(int)$tanggal_registrasiberikut_asset_fixed,$year_registrasiberikut_asset_fixed);
					$registrasiberikut_asset_fixed=date("d/m/Y",$mkt_registrasiberikut_asset_fixed);
					$registrasiberikut_asset_fixed_array = explode("/",$registrasiberikut_asset_fixed);
					$year_depreciation=$registrasiberikut_asset_fixed_array[2];
					$depreciation_registernum=$registrasiberikut_asset_fixed_array[2].$registrasiberikut_asset_fixed_array[1].$registrasiberikut_asset_fixed_array[0];
					
					if($mkt_registrasiberikut_asset_fixed<=$mk_today)
						{
						//post ledger
						$ledger_description=$depreciation_expanse_label.": $asset_fixed_code - $asset_fixed_name $asset_fixed_register";
						$set_rekening=array($this->book->account_special_get($asset_fixed_expdep),"D",$depreciation_amount,$this->book->account_special_get($asset_fixed_accom),"K",$depreciation_amount);
						$ledger_id=$this->book->ledger_post($registrasiberikut_asset_fixed,1,$ledger_description,$set_rekening,0,0,"depreciation");
						//insert depreciation
						$insert_arr = array(
						'asset_fixed_id'=>	$asset_fixed_id,
						'depreciation_register'=>	$registrasiberikut_asset_fixed,
						'depreciation_registernum'=>	$depreciation_registernum,
						'depreciation_no'=>	$k,
						'depreciation_amount'=>	$depreciation_amount,
						'ledger_id'=>	$ledger_id,
						'depreciation_year'=>	$year_depreciation
						);
						parent::db_insert("depreciation",$insert_arr);
						}
					}
				}
			}
		}
	}

//code generator
function generator_code($str_code,$str_add_def)
	{
	$str = substr($str_code, 3);
	
	$str = ltrim($str, '0')+1;
	$str_add=3-strlen($str);
	$str2 = str_pad($str,(strlen($str) + $str_add),"0",STR_PAD_LEFT);
	return $str_add_def.$str2;
	}
		
//asset_fixed code generator
function generator_asset_fixed_code()
	{
	$db_select = $this->db_select("asset_fixed","asset_fixed_code","","asset_fixed_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$deposit_code=$select_data[0]['asset_fixed_code'];
	
	return $this->generator_code($deposit_code,"INV");
	}
}
?>
