<?
if (isset($_REQUEST['ledger_id'])){
$ledger_id=$_REQUEST['ledger_id'];
}else{
$ledger_id=0;
}
$ledger_row=$global->db_row("ledger","*","ledger_id = '".$ledger_id."'");
$ledger_description=$ledger_row['ledger_description'];
$ledger_code=$ledger_row['ledger_code'];
$ledger_total_debit=$global->book->ledger_total_dk($ledger_id,"D");
$ledger_total_credit=$global->book->ledger_total_dk($ledger_id,"K");
$dk_amount=$ledger_total_debit+$ledger_total_credit;
$ledger_total_debit_format=$global->num_format2($ledger_total_debit);
$ledger_total_credit_format=$global->num_format2($ledger_total_credit);
$register_exp = explode('/', $ledger_row['ledger_register']);
$ledger_register=$register_exp[0]."/".$register_exp[1]."/".$register_exp[2];
//cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: ledger-general.php");
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

//check balance
$total_debit=0;
$total_kredit=0;
//loop list
	if(isset($_POST['taxonomi_scode_hidden'])){
	foreach($_POST['taxonomi_scode_hidden'] as $key => $taxonomi_scode_hidden_val ) {
		$ledgerdetails_amount=$_POST['ledgerdetails_amount_hidden'];
		$ledgerdetails_type=$_POST['ledgerdetails_type_hidden'];
		$taxonomi_code_arr=explode(" - ",$taxonomi_scode_hidden_val);
		$taxonomi_id=$global->db_fldrow("taxonomi","taxonomi_id","taxonomi_code='".$taxonomi_code_arr[0]."'");
		if($taxonomi_id!=""){
			if($ledgerdetails_type[$key]=="D"){
				$total_debit +=$ledgerdetails_amount[$key];
				}else{
				$total_kredit +=$ledgerdetails_amount[$key];
				}
		}}
	}
	//end loop
$balance=$total_debit-$total_kredit;
if($balance !=0)
	{
	$global->error_message($global->book->book_lang['msgform_book_lang']['req_ledger_balance']);
	}else{

//form handling
$ledger_description=mysqli_real_escape_string($global->db_con,$_POST['ledger_description']);
$ledger_code=mysqli_real_escape_string($global->db_con,$_POST['ledger_code']);
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}

//create ledger
$update_arr = array(
'ledger_description'=>	$ledger_description,
'ledger_code'=>	$ledger_code,
'ledger_status'=>	'pmn',
'ledger_register'=>	$valid_date['date_register'],
'ledger_registernum'=>	$valid_date['date_registernum'],
'ledger_uneditable'=>	0,
);
$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");

//clear old list
$global->db_delete("ledgerdetails","ledger_id='".$ledger_id."'");

//loop details expense
//loop list
	if(isset($_POST['taxonomi_scode_hidden'])){
	foreach($_POST['taxonomi_scode_hidden'] as $key => $taxonomi_scode_hidden_val ) {
		$ledgerdetails_amount=$_POST['ledgerdetails_amount_hidden'];
		$ledgerdetails_type=$_POST['ledgerdetails_type_hidden'];
		$taxonomi_code_arr=explode(" - ",$taxonomi_scode_hidden_val);
		$taxonomi_id=$global->db_fldrow("taxonomi","taxonomi_id","taxonomi_code='".$taxonomi_code_arr[0]."'");
		if($taxonomi_id!=""){
		//update product_order details
		$insert_arr = array(
		'ledger_id'=>	$ledger_id,
		'taxonomi_id'=>	$taxonomi_id,
		'ledgerdetails_type'=>	$ledgerdetails_type[$key],
		'ledgerdetails_amount'=>	$ledgerdetails_amount[$key],
		'ledgerdetails_register'=>	$valid_date['date_register'],
		'ledgerdetails_registernum'=>	$valid_date['date_registernum'],
		'ledgerdetails_status'=>	'pmn',
		);
		$global->db_insert("ledgerdetails",$insert_arr);
		}}
	}
	//end loop
$global->book->subsidiary_update($ledger_id);

//redirect
Header("location: ledger-general.php?confirm=".$form_header_lang['edit_button']);
exit;
}}
?>