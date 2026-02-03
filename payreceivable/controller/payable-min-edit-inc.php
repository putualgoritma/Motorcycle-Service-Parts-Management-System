<?
if (isset($_REQUEST['payreceivable_id'])){
$payreceivable_id=$_REQUEST['payreceivable_id'];
}else{
$payreceivable_id=0;
}
$payreceivable_row=$global->db_row_join("payreceivable,users","payreceivable.*,users.users_name,users.users_code","payreceivable_id = '".$payreceivable_id."' AND payreceivable.users_code=users.users_code");
$payreceivable_amount_total=$global->num_format2($payreceivable_row['payreceivable_amount']);
//cancell
if(isset($_POST['Submitcancell']))
{
Header("location: payable-min-edit.php");
exit;
}

if(isset($_POST['Submit']))
{
//form handling
$payreceivable_id=$_POST['payreceivable_id'];
//get users id
$users_code_arr=explode(" - ",$_POST['users_code']);
$users_code=$global->payreceivable->db_fldrow("users","users_code","users_code='".$users_code_arr[0]."'");
if($users_code!=""){
$users_code=$users_code;
$payreceivable_accountdebit=$_POST['payreceivable_accountdebit'];
$payreceivable_accountcredit=$_POST['payreceivable_accountcredit'];
$payreceivable_description=$_POST['payreceivable_description'];
$payreceivable_code=$_POST['payreceivable_code'];
//get amount & id set
$payrecievable_set_id="";
$payreceivable_amount=0;
$iset=0;
$payreceivable_amount_hidden=$_POST['payreceivable_amount_hidden'];
foreach($_POST['payreceivable_accountcredit_hidden'] as $key => $payreceivable_accountcredit_hidden_val ) {
	$payreceivable_code_arr=explode(" - ",$payreceivable_accountcredit_hidden_val);
	$add_str="";
	if($iset>0){
		$add_str=",";
		}
	$payrecievable_set_id.=$add_str.$global->db_fldrow("payreceivable","payreceivable_id","payreceivable_code='".$payreceivable_code_arr[0]."'");
	$payreceivable_amount+=$payreceivable_amount_hidden[$key];
	$iset++;
	}
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}

	//insert payreceivable
	$create_arr = array(
	'users_code'=>	$users_code,
	'payreceivable_register'=>	$valid_date['date_register'],
	'payreceivable_registernum'=>	$valid_date['date_registernum'],
	'payreceivable_code'=>	$payreceivable_code,
	'payreceivable_description'=>	$payreceivable_description,
	'payreceivable_amount'=>	$payreceivable_amount,
	'payreceivable_uneditable'=>	0,
	'payreceivable_accountdebit'=>	$payreceivable_accountdebit,
	'payreceivable_accountcredit'=>	$payreceivable_accountcredit,
	'payreceivable_type'=>	0,
	'payreceivable_status'=>	1,
	);
	//create payable payment
	if(!$global->payreceivable->update_payable($create_arr,$payreceivable_id)){
		$global->payreceivable->error_message($global->payreceivable->err_msg);
		}else{

	//clear old list
	$global->db_delete("payreceivable_details","payreceivable_rel_id='".$payreceivable_id."'");
	//loop list
	foreach($_POST['payreceivable_accountcredit_hidden'] as $key => $payreceivable_accountcredit_hidden_val ) {
		$payreceivable_code_arr=explode(" - ",$payreceivable_accountcredit_hidden_val);
		$payreceivable_code=$payreceivable_code_arr[0];
		$payreceivable_id_parent=$global->db_fldrow("payreceivable","payreceivable_id","payreceivable_code='".$payreceivable_code."'");
		$payreceivable_details_amount =$payreceivable_amount_hidden[$key];
		//insert payreceivable_details
		$insert_arr = array(
		'payreceivable_id'=>	$payreceivable_id_parent,
		'payreceivable_code'=>	$payreceivable_code,
		'payreceivable_details_amount'=>	$payreceivable_details_amount,
		'payreceivable_rel_id'=>	$payreceivable_id,
		);
		$global->db_insert("payreceivable_details",$insert_arr);
		//update parent
		$payreceivable_amount_parent=$global->db_fldrow("payreceivable","payreceivable_amount","payreceivable_code='".$payreceivable_code."'");
		$payreceivable_details_amount_row=$global->db_row_qry("SELECT SUM(payreceivable_details_amount) AS payreceivable_amount_paid FROM payreceivable_details WHERE payreceivable_code='".$payreceivable_code."' GROUP BY payreceivable_code");
		$payreceivable_paid_status=0;
		if($payreceivable_details_amount_row['payreceivable_amount_paid'] >= $payreceivable_amount_parent){
			$payreceivable_paid_status=1;
			}
		$update_arr = array(
		'payreceivable_paid_status '=>	$payreceivable_paid_status,
		);
		$global->db_update("payreceivable",$update_arr,"payreceivable_code='".$payreceivable_code."'");
		}
	//end loop	
		}}
	//redirect
	Header("location: ../confirm.php?redirect=payreceivable/payable.php&confirm=".$form_header_lang['edit_button']);
	exit;
}
?>
