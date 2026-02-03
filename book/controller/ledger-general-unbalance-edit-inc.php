<?
if(isset($_REQUEST['delete']))
{
$redirect="ledger-general-new.php";
if(isset($_REQUEST['search']))
	{
	$redirect="ledger-general-edit.php";
	}

if(isset($_REQUEST['ledgerdetails_id']))
	{
	$ledgerdetails_id=$_REQUEST['ledgerdetails_id'];
	$global->db_delete("ledgerdetails","ledgerdetails_id='".$ledgerdetails_id."'");
	}
Header("location: $redirect");
exit;
}
?>
<?
if(isset($_POST['Submit']))
{
$redirect="ledger-general-new.php";
if(isset($_REQUEST['search']))
	{
	$redirect="ledger-general-edit.php";
	}

//form handling
$ledger_id=$_POST['ledger_id'];
$taxonomi_id=$_POST['taxonomi_id'];
$ledgerdetails_type=$_POST['ledgerdetails_type'];
$ledgerdetails_amount=$_POST['ledgerdetails_amount'];
//end form handling

//insert items
$ledger_row=$global->db_row("ledger","*","ledger_id = '".$ledger_id."'");
$ledgerdetails_register=$ledger_row['ledger_register'];
$ledgerdetails_registernum=$ledger_row['ledger_registernum'];
$insert_arr = array(
'ledger_id'=>	$ledger_id,
'taxonomi_id'=>	$taxonomi_id,
'ledgerdetails_type'=>	$ledgerdetails_type,
'ledgerdetails_amount'=>	$ledgerdetails_amount,
'ledgerdetails_register'=>	$ledgerdetails_register,
'ledgerdetails_registernum'=>	$ledgerdetails_registernum,
);
$global->db_insert("ledgerdetails",$insert_arr);
//redirect
Header("location: $redirect");
exit;
}
?>
<?
if(isset($_POST['Submitprocess']))
{
//form handling
$ledger_id=$_POST['ledger_id'];
$ledger_description=mysqli_real_escape_string($global->db_con,$_POST['ledger_description']);
$ledger_code=mysqli_real_escape_string($global->db_con,$_POST['ledger_code']);
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}

//check balance
$total_debit=$global->book->ledger_total_dk($ledger_id,"D");
$total_kredit=$global->book->ledger_total_dk($ledger_id,"K");

$balance=$total_debit-$total_kredit;
if($balance !=0)
	{
	$global->error_message($global->book->book_lang['msgform_book_lang']['req_ledger_balance']);
	}
else if($balance_value >0 && $total_debit!=$balance_value)
	{
	$global->error_message($global->book->book_lang['msgform_book_lang']['req_ledger_balance']);
	}
else
	{
	//update ledger & detail
	$update_arr = array(
	'ledger_description'=>	$ledger_description,
	'ledger_code'=>	$ledger_code,
	'ledger_register'=>	$valid_date['date_register'],
	'ledger_registernum'=>	$valid_date['date_registernum'],
	);
	$global->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");
	
	//update ledger details
	$update_arr = array(
	'ledgerdetails_register'=>	$valid_date['date_register'],
	'ledgerdetails_registernum'=>	$valid_date['date_registernum'],
	);
	$global->db_update("ledgerdetails",$update_arr,"ledger_id='".$ledger_id."'");
	$global->book->subsidiary_update($ledger_id);
	
	//clear session
	unset($_SESSION['sessi_ledger_edit_id']);
	
	//redirect
	if($ledger_redirect=="")
		{
		Header("location: ../confirm.php?redirect=book/ledger-general.php&confirm=".$form_header_lang['edit_button']);
		exit;
		}
	else
		{
		Header("location: $ledger_redirect");
		exit;
		}
	}
}
?>
<?
if(isset($_REQUEST['ledger_id']))
{
$balance_val=false;
$unlock_val=0;
if(isset($_REQUEST['balance']))
	{
	$balance_val=$_REQUEST['balance'];
	}
if(isset($_REQUEST['unlock']))
	{
	$unlock_val=$_REQUEST['unlock'];
	}
$ledger_id=$_REQUEST['ledger_id'];
$ledger_row=$global->db_row("ledger","*","ledger_id = '".$ledger_id."'");
	//create session
	unset($_SESSION['sessi_ledger_edit_id']);
	$sessiedit_id=  $ledger_row['sessi_id'];
	$_SESSION['sessi_ledger_edit_id']=$sessiedit_id;
	
	$ledger_description=$ledger_row['ledger_description'];
	$ledger_code=$ledger_row['ledger_code'];
	$register_exp = explode('/', $ledger_row['ledger_register']);
	$ledger_register=$register_exp[0]."/".$register_exp[1]."/".$register_exp[2];
}
else
{
$sessiedit_id=$_SESSION['sessi_ledger_edit_id'];
$ledger_row=$global->db_row("ledger","*","sessi_id = '".$sessiedit_id."'");
$ledger_id=$ledger_row['ledger_id'];
$ledger_description=$ledger_row['ledger_description'];
$ledger_code=$ledger_row['ledger_code'];
$register_exp = explode('/', $ledger_row['ledger_register']);
$ledger_register=$register_exp[0]."/".$register_exp[1]."/".$register_exp[2];
}
//additional init
$inc=1;
$total_debit=0;
$total_kredit=0;
?>