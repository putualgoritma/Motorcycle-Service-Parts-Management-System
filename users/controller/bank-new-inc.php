<?
if(isset($_POST['Submit']))
{
//form handling
$bank_code=$_POST['bank_code'];
$bank_name=$_POST['bank_name'];
//end form handling

//insert items
$create_arr = array(
'bank_code'=>	$bank_code,
'bank_name'=>	$bank_name,
);
//create bank
if(!$global->users->create_bank($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: bank.php");
Header("location: bank.php?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>