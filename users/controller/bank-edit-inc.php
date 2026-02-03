<?
if (isset($_REQUEST['bank_id'])){
$bank_id=$_REQUEST['bank_id'];
}else{
$bank_id=0;
}
$bank_row=$global->users->db_row("bank","*","bank_id='".$bank_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$bank_id=$_POST['bank_id'];
$bank_code=$_POST['bank_code'];
$bank_name=$_POST['bank_name'];
//end form handling

//insert items
$update_arr = array(
'bank_code'=>	$bank_code,
'bank_name'=>	$bank_name,
);
//update bank
if(!$global->users->update_bank($update_arr,$_POST['bank_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: bank.php");
Header("location: bank.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>