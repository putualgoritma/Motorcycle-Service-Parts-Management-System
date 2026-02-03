<?
if (isset($_REQUEST['ledger_id'])){
$ledger_id=$_REQUEST['ledger_id'];
}else{
$ledger_id=0;
}
$ledger_row=$global->db_row("ledger","*","ledger_id = '".$ledger_id."'");
$ledger_description=$ledger_row['ledger_description'];
$ledger_code=$ledger_row['ledger_code'];
$cash_taxonomi=$global->db_fldrow("ledgerdetails","taxonomi_id","ledger_id='".$ledger_id."' AND ledgerdetails_type='D'");
$register_exp = explode('/', $ledger_row['ledger_register']);
$ledger_register=$register_exp[0]."/".$register_exp[1]."/".$register_exp[2];
$cash_amount=$global->book->ledger_total_dk($ledger_id,"K");
$cash_amount_format=$global->num_format2($cash_amount);
//cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: cash.php");
exit;
}
?>
<?
if(isset($_POST['Submit']))
{
//details cash
$cash_amount=$_POST['texpense_total_hidden'];
$ledger_id=$_POST['ledger_id'];
if($cash_amount ==0)
	{
	$global->error_message($global->book->book_lang['msgform_book_lang']['req_empty']);
	}

//form handling
$ledger_description=mysqli_real_escape_string($global->db_con,$_POST['ledger_description']);
$ledger_code=mysqli_real_escape_string($global->db_con,$_POST['ledger_code']);
$cash_taxonomi=$_POST['cash_taxonomi'];
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}

//create ledger
//create new temporary record
$update_arr = array(
'ledger_description'=>	$ledger_description,
'ledger_code'=>	$ledger_code,
'ledger_status'=>	'pmn',
'ledger_register'=>	$valid_date['date_register'],
'ledger_registernum'=>	$valid_date['date_registernum'],
'ledger_subsidiary'=>	'cash-debit',
'ledger_uneditable'=>	0,
);
$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");

//clear old list
$global->db_delete("ledgerdetails","ledger_id='".$ledger_id."'");

//insert details cash
$insert_arr = array(
'ledger_id'=>	$ledger_id,
'taxonomi_id'=>	$cash_taxonomi,
'ledgerdetails_type'=>	'D',
'ledgerdetails_amount'=>	$cash_amount,
'ledgerdetails_register'=>	$valid_date['date_register'],
'ledgerdetails_registernum'=>	$valid_date['date_registernum'],
'ledgerdetails_subsidiary'=>	'cash-debit',
'ledgerdetails_status'=>	'pmn',
);
$global->db_insert("ledgerdetails",$insert_arr);

//loop details expense
//loop list
	if(isset($_POST['taxonomi_scode_hidden'])){
	foreach($_POST['taxonomi_scode_hidden'] as $key => $taxonomi_scode_hidden_val ) {
		$ledgerdetails_amount=$_POST['ledgerdetails_amount_hidden'];
		$taxonomi_code_arr=explode(" - ",$taxonomi_scode_hidden_val);
		$taxonomi_id=$global->db_fldrow("taxonomi","taxonomi_id","taxonomi_code='".$taxonomi_code_arr[0]."'");
		if($taxonomi_id!=""){
		//update product_order details
		$insert_arr = array(
		'ledger_id'=>	$ledger_id,
		'taxonomi_id'=>	$taxonomi_id,
		'ledgerdetails_type'=>	'K',
		'ledgerdetails_amount'=>	$ledgerdetails_amount[$key],
		'ledgerdetails_register'=>	$valid_date['date_register'],
		'ledgerdetails_registernum'=>	$valid_date['date_registernum'],
		'ledgerdetails_status'=>	'pmn',
		);
		$global->db_insert("ledgerdetails",$insert_arr);
		}}
	}
	//end loop

//redirect
Header("location: cash.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>