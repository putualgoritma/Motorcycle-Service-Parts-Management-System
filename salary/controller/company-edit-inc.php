<?
if (isset($_REQUEST['company_id'])){
$company_id=$_REQUEST['company_id'];
}else{
$company_id=$global->db_fldrow("company","company_id","","company_id ASC");
}
$company_row=$global->db_row("company","*","company_id='".$company_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$company_id=$_POST['company_id'];
$company_name=$_POST['company_name'];
$company_phone=$_POST['company_phone'];
$company_address=$_POST['company_address'];
$main_dealer_code=$_POST['main_dealer_code'];
$dealer_code=$_POST['dealer_code'];
$ex_main_dealer_code=$_POST['ex_main_dealer_code'];
$company_pit=$_POST['company_pit'];
$company_city=$_POST['company_city'];
$company_font=$_POST['company_font'];
$company_font_size=$_POST['company_font_size'];
$company_paper=$_POST['company_paper'];
$company_bank=$_POST['company_bank'];
$company_bank_no=$_POST['company_bank_no'];
$company_bank_id=$_POST['company_bank_id'];
// $company_bank2=$_POST['company_bank2'];
// $company_bank2_no=$_POST['company_bank2_no'];
// $company_bank2_id=$_POST['company_bank2_id'];
if(isset($_POST['company_stock_process'])){
	$company_stock_process=1;
}else{
	$company_stock_process=0;
	}
if(isset($_POST['company_stock_block'])){
	$company_stock_block=1;
}else{
	$company_stock_block=0;
	}
//end form handling

//insert items
$update_arr = array(
'company_name'=>	$company_name,
'company_phone'=>	$company_phone,
'company_address'=>	$company_address,
'main_dealer_code'=>	$main_dealer_code,
'dealer_code'=>	$dealer_code,
'ex_main_dealer_code'=>	$ex_main_dealer_code,
'company_pit'=>	$company_pit,
'company_city'=>	$company_city,
'company_stock_process'=>	$company_stock_process,
'company_stock_block'=>	$company_stock_block,
'company_font'=>	$company_font,
'company_font_size'=>	$company_font_size,
'company_paper'=>	$company_paper,
'company_bank'=>	$company_bank,
'company_bank_no'=>	$company_bank_no,
'company_bank_id'=>	$company_bank_id,
// 'company_bank2'=>	$company_bank2,
// 'company_bank2_no'=>	$company_bank2_no,
// 'company_bank2_id'=>	$company_bank2_id,
);
//update company
if(!$global->salary->update_company($update_arr,$_POST['company_id'])){
	$global->salary->error_message($global->users->err_msg);
	}
//redirect
//Header("location: company.php");
Header("location: company-edit.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>