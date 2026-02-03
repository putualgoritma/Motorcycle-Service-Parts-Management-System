<?
//default
$payreceivable_code_generation=$global->payreceivable->generator_receivable();

//cancell
if(isset($_POST['Submitcancell']))
{
Header("location: receivable-new.php");
exit;
}

if(isset($_POST['Submit']))
{
//form handling
//get users id
$users_code_arr=explode(" - ",$_POST['users_code']);
$users_code=$global->payreceivable->db_fldrow("users","users_code","users_code='".$users_code_arr[0]."'");
if($users_code!=""){
$users_code=$users_code;
$payreceivable_accountdebit=$_POST['payreceivable_accountdebit'];
$payreceivable_description=$_POST['payreceivable_description'];
$payreceivable_code=$_POST['payreceivable_code'];
$payreceivable_amount=$_POST['payreceivable_amount_total_hidden'];
$payreceivable_tenor=$_POST['payreceivable_tenor'];
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
	//loop list
	if(isset($_POST['payreceivable_accountcredit_hidden'])){
	$payreceivable_amount_hidden=$_POST['payreceivable_amount_hidden'];
	$set_rekening=array($payreceivable_accountdebit,"D",$payreceivable_amount);
	foreach($_POST['payreceivable_accountcredit_hidden'] as $key => $payreceivable_accountcredit_list ) {
		$taxonomi_code_arr=explode(" - ",$payreceivable_accountcredit_list);
		$taxonomi_id=$global->payreceivable->db_fldrow("taxonomi","taxonomi_id","taxonomi_code='".$taxonomi_code_arr[0]."'");
		if($taxonomi_id>0){
		$payreceivable_amount_list=$payreceivable_amount_hidden[$key];
		array_push($set_rekening,$taxonomi_id,"K",$payreceivable_amount_list);
		}}
	}
	//end loop
	//print_r($set_rekening);

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
	'payreceivable_type'=>	1,
	'payreceivable_status'=>	0,
	'payreceivable_tenor'=>	$payreceivable_tenor,
	);
	//create receivable payment
	if(!$global->payreceivable->create_receivable($create_arr,0,$set_rekening)){
		$global->payreceivable->error_message($global->payreceivable->err_msg);
		}}
	//redirect
	Header("location: ../confirm.php?redirect=payreceivable/receivable.php&confirm=".$form_header_lang['add_new_button']);
	exit;
}
?>
