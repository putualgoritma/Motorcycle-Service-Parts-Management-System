<?
/**
* Operation import csv
*/

//initiate date
$date_register_init="01"."/"."06"."/"."2015";
$year_init="2015";
$month_init="06";
$date_init="01";

//if get form.Submit
if(isset($_POST['Submittaxonomi']))
{
//upload csv
$namacsv="csv/".$_FILES['file_source']['name'];
if(!($_FILES['file_source']['size']==0))
	{
	if(is_uploaded_file($_FILES['file_source']['tmp_name']))
		{
		$destination=$namacsv;
		move_uploaded_file($_FILES['file_source']['tmp_name'], $destination);
		}
	else 
		{
		$error=$global->csv->csv_lang['msgform_csv_lang']['csv_up_err'];
		echo "<script>alert(\"$error \");history.go(-1)</script>";
		exit;
		}
	}

//fields_arr
$fields_arr = array(
'taxonomi_code'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_code'],
'taxonomi_type'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_type'],
'taxonomi_name'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_name'],
'taxonomi_balance_debit'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_balance_debit'],
'taxonomi_balance_credit'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_balance_credit'],
);

//post ledger saldo awal rekening
$dt=date("YmdHis");  
$tbt=$year_init.$month_init.$date_init;
$sessi_id=  $dt.uniqid();
$ledger_register=$date_register_init;
$ledger_description="Saldo Awal Rekening Periode Akutansi: ".$year_init;
$ledger_uneditable=0;
$insert_arr = array(
'ledger_register'=>	$ledger_register,
'ledger_description'=>	$ledger_description,
'ledger_uneditable'=>	$ledger_uneditable,
'sessi_id'=>	$sessi_id,
'ledger_status'=>	'pmn',
'ledger_registernum'=>	$tbt,
);
$global->db_insert("ledger",$insert_arr);
//cari last ID
$ledger_id=$global->db_lastid("ledger","ledger_id");

//loop data
$i=0;
$error=$global->csv->csv_lang['msgform_csv_lang']['csv_header_err'];
$handle = fopen($namacsv, "r");
while (($data_csv = fgetcsv($handle, 0, ",",'"')) !== FALSE)
	{
	//convert
	$ic=0;
	foreach($fields_arr as $key => $value)
		{
		$data_csv_val=str_replace("-coma-",",",@$data_csv[$ic]);
		$data_csv_val=str_replace("'","+a-a+",$data_csv_val);
		$data[$key]=$data_csv_val;
		$ic++;
		}
	//if header csv
	if($i==0)
		{
		$penanda=0;
		$eclo="";
		foreach($fields_arr as $key => $value)
			{
			if($value!=$data[$key])
				{
				$penanda=1;
				}
			}
		if($penanda==1)
			{
			break;
			}
		}
	else
		{
		//create recievable
		//set create array
		$id_taxonomi=$global->csv->db_fldrow("taxonomi","taxonomi_id","taxonomi_code='".$data['taxonomi_code']."'");
		if($data['taxonomi_balance_debit']>0)
			{
			$ledgerdetails_type="D";
			$saldo_taxonomi=$data['taxonomi_balance_debit'];
			}
		else
			{
			$ledgerdetails_type="K";
			$saldo_taxonomi=$data['taxonomi_balance_credit'];
			}
		if($saldo_taxonomi!=0){
		$global->csv->book->ledgerdetails_post($ledger_id,$id_taxonomi,$ledgerdetails_type,$saldo_taxonomi,$ledger_register);
		}}
	$i++;
	}
//check if break
if($penanda=="1")
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}

//redirect to confirm
Header("location: ../confirm.php?redirect=csv/index.php&confirm=".$form_header_lang['add_new_button']);
exit;
}

//if get form.Submit
if(isset($_POST['Submitreceivable']))
{
//upload csv
$namacsv="csv/".$_FILES['file_source']['name'];
if(!($_FILES['file_source']['size']==0))
	{
	if(is_uploaded_file($_FILES['file_source']['tmp_name']))
		{
		$destination=$namacsv;
		move_uploaded_file($_FILES['file_source']['tmp_name'], $destination);
		}
	else 
		{
		$error=$global->csv->csv_lang['msgform_csv_lang']['csv_up_err'];
		echo "<script>alert(\"$error \");history.go(-1)</script>";
		exit;
		}
	}

//fields_arr
$fields_arr = array(
'users_code'=>	$global->csv->users->users_lang['form_label_users_lang']['users_code'],
'users_name'=>	$global->csv->users->users_lang['form_label_users_lang']['users_name'],
'receivable_balance'=>	$global->csv->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['receivable_balance'],
);

$i=0;
$error=$global->csv->csv_lang['msgform_csv_lang']['csv_header_err'];
$handle = fopen($namacsv, "r");
while (($data_csv = fgetcsv($handle, 0, ",",'"')) !== FALSE)
	{
	//convert
	$ic=0;
	foreach($fields_arr as $key => $value)
		{
		$data_csv_val=str_replace("-coma-",",",@$data_csv[$ic]);
		$data_csv_val=str_replace("'","+a-a+",$data_csv_val);
		$data[$key]=$data_csv_val;
		$ic++;
		}
	//if header csv
	if($i==0)
		{
		$penanda=0;
		$eclo="";
		foreach($fields_arr as $key => $value)
			{
			if($value!=$data[$key])
				{
				$penanda=1;
				}
			}
		if($penanda==1)
			{
			break;
			}
		}
	else
		{
		//date validate
		$valid_date=$global->csv->valid_date($date_register_init);
		if($data['receivable_balance']>0){
		$users_code=$global->csv->db_fldrow("users","users_code","users_code='".$data['users_code']."'");
		if($users_code==""){
			//create users
			//set create array
			$create_arr = array(
			'users_register'=>	$valid_date['date_register'],
			'users_registernum'=>	$valid_date['date_registernum'],
			'users_code'=>	$data['users_code'],
			'users_type'=>	'employee',
			'users_name'=>	$data['users_name'],
			'users_member_status'=>	'active',
			);
			;
			//create users
			if(!$global->csv->users->create_users($create_arr)){
				$global->csv->error_message($global->csv->users->err_msg);
				}
			//get users id
			$users_code=$global->csv->db_lastid("users","users_code");
			}
		
		//create recievable
		//set create array
		$create_arr = array(
		'users_code'=>	$users_code,
		'payreceivable_register'=>	$valid_date['date_register'],
		'payreceivable_registernum'=>	$valid_date['date_registernum'],
		'payreceivable_code'=>	0,
		'payreceivable_description'=>	$global->csv->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['receivable_new']."-".$data['users_name']."-".$valid_date['date_register'],
		'payreceivable_amount'=>	$data['receivable_balance'],
		'payreceivable_uneditable'=>	1,
		'payreceivable_accountdebit'=>	$global->csv->book->account_special_get("receivable_staff"),
		'payreceivable_accountcredit'=>	$global->csv->book->account_special_get("cash"),
		'payreceivable_type'=>	0,
		'payreceivable_status'=>	0,
		);
		//create loan
		if(!$global->csv->payreceivable->create_receivable($create_arr,1)){
			$global->csv->error_message($global->csv->payreceivable->err_msg);
			}
		}}
	$i++;
	}
//check if break
if($penanda=="1")
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}

//redirect to confirm
Header("location: ../confirm.php?redirect=csv/index.php&confirm=".$form_header_lang['add_new_button']);
exit;
}


//if get form.Submit
if(isset($_POST['Submitpayable']))
{
//upload csv
$namacsv="csv/".$_FILES['file_source']['name'];
if(!($_FILES['file_source']['size']==0))
	{
	if(is_uploaded_file($_FILES['file_source']['tmp_name']))
		{
		$destination=$namacsv;
		move_uploaded_file($_FILES['file_source']['tmp_name'], $destination);
		}
	else 
		{
		$error=$global->csv->csv_lang['msgform_csv_lang']['csv_up_err'];
		echo "<script>alert(\"$error \");history.go(-1)</script>";
		exit;
		}
	}

//fields_arr
$fields_arr = array(
'users_code'=>	$global->csv->users->users_lang['form_label_users_lang']['users_code'],
'users_name'=>	$global->csv->users->users_lang['form_label_users_lang']['users_name'],
'payable_balance'=>	$global->csv->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payable_balance'],
);

$i=0;
$error=$global->csv->csv_lang['msgform_csv_lang']['csv_header_err'];
$handle = fopen($namacsv, "r");
while (($data_csv = fgetcsv($handle, 0, ",",'"')) !== FALSE)
	{
	//convert
	$ic=0;
	foreach($fields_arr as $key => $value)
		{
		$data_csv_val=str_replace("-coma-",",",@$data_csv[$ic]);
		$data_csv_val=str_replace("'","+a-a+",$data_csv_val);
		$data[$key]=$data_csv_val;
		$ic++;
		}
	//if header csv
	if($i==0)
		{
		$penanda=0;
		$eclo="";
		foreach($fields_arr as $key => $value)
			{
			if($value!=$data[$key])
				{
				$penanda=1;
				}
			}
		if($penanda==1)
			{
			break;
			}
		}
	else
		{
		//date validate
		$valid_date=$global->csv->valid_date($date_register_init);
		if($data['payable_balance']>0){
		$users_code=$global->csv->db_fldrow("users","users_code","users_code='".$data['users_code']."'");
		if($users_code==""){
			//create users
			//set create array
			$create_arr = array(
			'users_register'=>	$valid_date['date_register'],
			'users_registernum'=>	$valid_date['date_registernum'],
			'users_code'=>	$data['users_code'],
			'users_type'=>	'employee',
			'users_name'=>	$data['users_name'],
			'users_member_status'=>	'active',
			);
			;
			//create users
			if(!$global->csv->users->create_users($create_arr)){
				$global->csv->error_message($global->csv->users->err_msg);
				}
			//get users id
			$users_code=$global->csv->db_lastid("users","users_code");
			}
		
		//create recievable
		//set create array
		$create_arr = array(
		'users_code'=>	$users_code,
		'payreceivable_register'=>	$valid_date['date_register'],
		'payreceivable_registernum'=>	$valid_date['date_registernum'],
		'payreceivable_code'=>	0,
		'payreceivable_description'=>	$global->csv->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payable_new']."-".$data['users_name']."-".$valid_date['date_register'],
		'payreceivable_amount'=>	$data['payable_balance'],
		'payreceivable_uneditable'=>	1,
		'payreceivable_accountdebit'=>	$global->csv->book->account_special_get("cash"),
		'payreceivable_accountcredit'=>	$global->csv->book->account_special_get("payable_share"),
		'payreceivable_type'=>	0,
		'payreceivable_status'=>	0,
		);
		//create loan
		if(!$global->csv->payreceivable->create_payable($create_arr,1)){
			$global->csv->error_message($global->csv->payreceivable->err_msg);
			}
		}}
	$i++;
	}
//check if break
if($penanda=="1")
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}

//redirect to confirm
Header("location: ../confirm.php?redirect=csv/index.php&confirm=".$form_header_lang['add_new_button']);
exit;
}

//if get form.Submit
if(isset($_POST['Submitassetfixed']))
{
//upload csv
$namacsv="csv/".$_FILES['file_source']['name'];
if(!($_FILES['file_source']['size']==0))
	{
	if(is_uploaded_file($_FILES['file_source']['tmp_name']))
		{
		$destination=$namacsv;
		move_uploaded_file($_FILES['file_source']['tmp_name'], $destination);
		}
	else 
		{
		$error=$global->csv->csv_lang['msgform_csv_lang']['csv_up_err'];
		echo "<script>alert(\"$error \");history.go(-1)</script>";
		exit;
		}
	}

//fields_arr
$fields_arr = array(
'asset_fixed_code'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_code'],
'asset_fixed_type'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_type'],
'asset_fixed_register'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_register'],
'asset_fixed_name'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_name'],
'asset_fixed_description'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_description'],
'asset_fixed_quantity'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_quantity'],
'asset_fixed_depreciation_period'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_period'],
'asset_fixed_depreciation_type'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_type'],
'asset_fixed_amount'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_amount'],
);

$i=0;
$error=$global->csv->csv_lang['msgform_csv_lang']['csv_header_err'];
$handle = fopen($namacsv, "r");
while (($data_csv = fgetcsv($handle, 0, ",",'"')) !== FALSE)
	{
	//convert
	$ic=0;
	foreach($fields_arr as $key => $value)
		{
		$data_csv_val=str_replace("-coma-",",",@$data_csv[$ic]);
		$data_csv_val=str_replace("'","+a-a+",$data_csv_val);
		$data[$key]=$data_csv_val;
		$ic++;
		}
	//if header csv
	if($i==0)
		{
		$penanda=0;
		$eclo="";
		foreach($fields_arr as $key => $value)
			{
			if($value!=$data[$key])
				{
				$penanda=1;
				}
			}
		if($penanda==1)
			{
			break;
			}
		}
	else
		{
		//create recievable
		//valid date
		$valid_date=$global->csv->valid_date($data['asset_fixed_register']);
		//set create array
		$create_arr = array(
		'asset_fixed_register'=>	$valid_date['date_register'],
		'asset_fixed_registernum'=>	$valid_date['date_registernum'],
		'asset_fixed_name'=>	$data['asset_fixed_name'],
		'asset_fixed_quantity'=>	$data['asset_fixed_quantity'],
		'asset_fixed_amount'=>	$data['asset_fixed_amount'],
		'asset_fixed_depreciation_period'=>	$data['asset_fixed_depreciation_period'],
		'asset_fixed_depreciation_type'=>	$data['asset_fixed_depreciation_type'],
		'asset_fixed_code'=>	$data['asset_fixed_code'],
		'users_code'=>	"",
		'asset_fixed_accountcredit'=>	$global->csv->book->account_special_get("cash"),
		'asset_fixed_accountdebit'=>	$global->csv->book->account_special_get("asset_inventory"),
		'asset_fixed_type'=>	$data['asset_fixed_type'],
		'asset_fixed_description'=>	$data['asset_fixed_description'],

		);
		//create loan
		if(!$global->csv->asset_fixed->create_asset_fixed($create_arr,1)){
			$global->csv->error_message($global->csv->asset_fixed->err_msg);
			}
		}
	$i++;
	}
//check if break
if($penanda=="1")
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}

//redirect to confirm
Header("location: ../confirm.php?redirect=csv/index.php&confirm=".$form_header_lang['add_new_button']);
exit;
}
?>