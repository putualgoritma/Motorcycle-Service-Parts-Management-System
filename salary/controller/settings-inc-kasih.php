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
$company_work_in=$_POST['company_work_in'].":00";
$company_work_out=$_POST['company_work_out'].":00";
$company_break_in=$_POST['company_break_in'].":00";
$company_break_out=$_POST['company_break_out'].":00";
$company_alfa_pinalty=$_POST['company_alfa_pinalty'];
$company_insentif_no_alfa=$_POST['company_insentif_no_alfa'];
$company_part_def_percent=$_POST['company_part_def_percent'];
$company_part_target_percent=$_POST['company_part_target_percent'];
$company_part_target=$_POST['company_part_target'];
$company_service_def_percent=$_POST['company_service_def_percent'];
$company_service_target_percent=$_POST['company_service_target_percent'];
$company_service_target=$_POST['company_service_target'];
//end form handling

//insert items
$update_arr = array(
'company_work_in'=>	$company_work_in,
'company_work_out'=>	$company_work_out,
'company_break_in'=>	$company_break_in,
'company_break_out'=>	$company_break_out,
'company_alfa_pinalty'=>	$company_alfa_pinalty,
'company_insentif_no_alfa'=>	$company_insentif_no_alfa,
'company_part_def_percent'=>	$company_part_def_percent,
'company_part_target_percent'=>	$company_part_target_percent,
'company_part_target'=>	$company_part_target,
'company_service_def_percent'=>	$company_service_def_percent,
'company_service_target_percent'=>	$company_service_target_percent,
'company_service_target'=>	$company_service_target,
);
//update company
if(!$global->salary->update_company($update_arr,$_POST['company_id'])){
	$global->salary->error_message($global->users->err_msg);
	}
//redirect
//Header("location: company.php");
Header("location: settings.php?confirm=".$form_header_lang['edit_button']);
exit;
}
//if Submit edit2
if(isset($_POST['Submit2']))
{
//form handling
$absence_penalty_id=$_POST['absence_penalty_id'];
$absence_penalty_mlate=$_POST['absence_penalty_mlate'];
$absence_penalty_amount=$_POST['absence_penalty_amount'];
//end form handling

foreach($absence_penalty_id as $key => $n) {
	//insert items
	$update_arr = array(
	'absence_penalty_mlate'=>	$absence_penalty_mlate[$key],
	'absence_penalty_amount'=>	$absence_penalty_amount[$key],
	);
	//update company
	if(!$global->salary->update_absence_penalty($update_arr,$absence_penalty_id[$key])){
		$global->salary->error_message($global->users->err_msg);
		}
	}
//redirect
//Header("location: company.php");
Header("location: settings.php?confirm=".$form_header_lang['edit_button']);
exit;
}

//if Submit edit3
if(isset($_POST['Submit3']))
{
//form handling
$company_id=$_POST['company_id'];
$company_target_unit_entry=$_POST['company_target_unit_entry'];
$company_target_service=$_POST['company_target_service'];
$company_target_product=$_POST['company_target_product'];
$company_insentif_bonus=$_POST['company_insentif_bonus'];
$product_fee_percent=$_POST['product_fee_percent'];
$service_fee_percent=$_POST['service_fee_percent'];
//end form handling

//insert items
$update_arr = array(
'company_target_unit_entry'=>	$company_target_unit_entry,
'company_target_service'=>	$company_target_service,
'company_target_product'=>	$company_target_product,
'company_insentif_bonus'=>	$company_insentif_bonus,
'product_fee_percent'=>	$product_fee_percent,
'service_fee_percent'=>	$service_fee_percent,
);
//update company
if(!$global->salary->update_company($update_arr,$_POST['company_id'])){
	$global->salary->error_message($global->users->err_msg);
	}
//form handling
$salary_target_id=$_POST['salary_target_id'];
$salary_target_amount=$_POST['salary_target_amount'];
//end form handling

foreach($salary_target_id as $key => $n) {
	//insert items
	$update_arr = array(
	'salary_target_amount'=>	$salary_target_amount[$key],
	);
	//update company
	if(!$global->salary->update_salary_target($update_arr,$salary_target_id[$key])){
		$global->salary->error_message($global->users->err_msg);
		}
	}
//redirect
//Header("location: company.php");
Header("location: settings.php?confirm=".$form_header_lang['edit_button']);
exit;
}

//if Submit edit4
if(isset($_POST['Submit4']))
{
//form handling
$salary_daily_target_id=$_POST['salary_daily_target_id'];
$salary_daily_target_min=$_POST['salary_daily_target_min'];
$salary_daily_target_max=$_POST['salary_daily_target_max'];
$salary_daily_target_amount=$_POST['salary_daily_target_amount'];
//end form handling

foreach($salary_daily_target_id as $key => $n) {
	//insert items
	$update_arr = array(
	'salary_daily_target_min'=>	$salary_daily_target_min[$key],
	'salary_daily_target_max'=>	$salary_daily_target_max[$key],
	'salary_daily_target_amount'=>	$salary_daily_target_amount[$key],
	);
	//update company
	if(!$global->salary->update_salary_daily_target($update_arr,$salary_daily_target_id[$key])){
		$global->salary->error_message($global->users->err_msg);
		}
	}
//redirect
//Header("location: company.php");
Header("location: settings.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>