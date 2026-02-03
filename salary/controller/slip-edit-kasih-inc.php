<?
//cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: slip.php");
exit;
}
if($global->tbldata_exist("salary_slip","*","staff_code='".$_REQUEST['staff_code']."' AND salary_slip_month='".$_REQUEST['salary_slip_month']."'",$salary_slip_row)){
$salary_slip_id=$salary_slip_row['salary_slip_id'];
$salary_slip_monthnum=$global->month_strtonum($_REQUEST['salary_slip_month']);
$salary_slip_monthstrip=$global->month_strtostrip($_REQUEST['salary_slip_month']);
$salary_slip_code_generation=$salary_slip_row['salary_slip_code'];
$salary_slip_date=date('d/m/Y',strtotime($salary_slip_row['salary_slip_date']));
$staff_row=$global->db_row("staff","*","staff_code='".$_REQUEST['staff_code']."'");
$staff_pit_status=$global->db_fldrow("staff","staff_pit_status","staff_code='".$_REQUEST['staff_code']."'");
if($staff_pit_status=="pit"){
	$get_insentif_row=$global->salary->get_insentif($_REQUEST['staff_code'],$salary_slip_monthnum);
	}else{
	$get_insentif_row=$global->salary->get_insentif_nonpit($_REQUEST['staff_code'],$salary_slip_monthnum);
	}
$get_efective_work=$global->salary->get_efective_work($salary_slip_monthnum);
$num_work=$get_insentif_row['num_work'];
$get_absence_row=$global->salary->get_absence($_REQUEST['staff_code'],$salary_slip_monthstrip);
$salary_slip_datenum=date("t", strtotime($salary_slip_monthstrip."-01"));
$salary_slip_monthdatenum=$salary_slip_monthnum.$salary_slip_datenum;
$get_receivable_balance=$global->payreceivable->get_receivable_balance($salary_slip_monthdatenum,$_REQUEST['staff_code']);
//print_r($get_receivable_balance);
//edit val
$salary_slip_basic=$salary_slip_row['salary_slip_basic'];
$salary_slip_position=$salary_slip_row['salary_slip_position'];
$salary_slip_insurance=$salary_slip_row['salary_slip_insurance'];
$salary_slip_transport=$salary_slip_row['salary_slip_transport'];
$salary_slip_food=$salary_slip_row['salary_slip_food'];
$salary_slip_insentif_daily=$salary_slip_row['salary_slip_insentif_daily'];
$salary_slip_commission_part_service=$salary_slip_row['salary_slip_commission_part_service'];
$salary_slip_commission_part=$salary_slip_row['salary_slip_commission_part'];
$salary_slip_commission_service=$salary_slip_row['salary_slip_commission_service'];
$salary_slip_insentif_unit_entry=$salary_slip_row['salary_slip_insentif_unit_entry'];
$salary_slip_insentif_product=$salary_slip_row['salary_slip_insentif_product'];
$salary_slip_insentif_service=$salary_slip_row['salary_slip_insentif_service'];
$salary_slip_insentif_bonus=$salary_slip_row['salary_slip_insentif_bonus'];
$salary_slip_insentif_no_alfa=$salary_slip_row['salary_slip_insentif_no_alfa'];
$salary_slip_fee_picket=$salary_slip_row['salary_slip_fee_picket'];
$salary_slip_cut_late=$salary_slip_row['salary_slip_cut_late'];
$salary_slip_cut_alfa=$salary_slip_row['salary_slip_cut_alfa'];
$salary_slip_cut_cashbon=$salary_slip_row['salary_slip_cut_cashbon'];//
$salary_slip_cut_payable=$salary_slip_row['salary_slip_cut_payable'];
$salary_slip_cut_insurance=$salary_slip_row['salary_slip_cut_insurance'];
$salary_slip_cut_other1=$salary_slip_row['salary_slip_cut_other1'];
$salary_slip_cut_other2=$salary_slip_row['salary_slip_cut_other2'];
//hidden val
$salary_slip_basic_hidden=$staff_row['staff_salary_basic'];
$salary_slip_position_hidden=$staff_row['staff_salary_position'];
$salary_slip_insurance_hidden=$staff_row['staff_salary_insurance'];
$salary_slip_transport_hidden=$staff_row['staff_salary_transport']*$num_work;
$salary_slip_food_hidden=$staff_row['staff_salary_food']*$num_work;
$salary_slip_insentif_daily_hidden=0;
if(!is_null($get_insentif_row['salary_daily_target_amount'])){
	$salary_slip_insentif_daily_hidden=$get_insentif_row['salary_daily_target_amount'];
	}
$salary_slip_commission_part_service_hidden=number_format(($get_insentif_row['product_fee']+$get_insentif_row['service_fee']), 2,".","");
$salary_slip_commission_part_hidden=number_format(($get_insentif_row['product_fee']), 2,".","");
$salary_slip_commission_service_hidden=number_format(($get_insentif_row['service_fee']), 2,".","");
$salary_slip_insentif_unit_entry_hidden=$get_insentif_row['salary_slip_insentif_unit_entry'];
$salary_slip_insentif_product_hidden=$get_insentif_row['salary_slip_insentif_product'];
$salary_slip_insentif_service_hidden=$get_insentif_row['salary_slip_insentif_service'];
$salary_slip_insentif_bonus_hidden=$get_insentif_row['salary_slip_insentif_bonus'];
$salary_slip_insentif_no_alfa_hidden=$get_absence_row['salary_slip_insentif_no_alfa'];
if($num_work<=0){
	$salary_slip_insentif_no_alfa_hidden=0;
	}
$salary_slip_fee_picket_hidden=0;
$salary_slip_cut_late_hidden=$get_absence_row['salary_slip_cut_late'];
$salary_slip_cut_alfa_hidden=$get_absence_row['salary_slip_cut_alfa'];
$salary_slip_cut_cashbon_hidden=$get_receivable_balance['receivable_balance_cashbon'];//
$salary_slip_cut_payable_hidden=number_format($get_receivable_balance['receivable_balance_tenor'], 2,".","");
$salary_slip_cut_insurance_hidden=$staff_row['staff_salary_insurance'];
$salary_slip_cut_other1_hidden=0;
$salary_slip_cut_other2_hidden=0;
//if new
}else{
$salary_slip_id=0;
$salary_slip_monthnum=$global->month_strtonum($_REQUEST['salary_slip_month']);
$salary_slip_monthstrip=$global->month_strtostrip($_REQUEST['salary_slip_month']);
$salary_slip_code_generation=$global->salary->generator_salary_slip_code($salary_slip_monthnum);
$staff_row=$global->db_row("staff","*","staff_code='".$_REQUEST['staff_code']."'");
$salary_slip_datenum=date("t", strtotime($salary_slip_monthstrip."-01"));
$salary_slip_date=$salary_slip_datenum."/".$_REQUEST['salary_slip_month'];
$staff_pit_status=$global->db_fldrow("staff","staff_pit_status","staff_code='".$_REQUEST['staff_code']."'");
if($staff_pit_status=="pit"){
	$get_insentif_row=$global->salary->get_insentif($_REQUEST['staff_code'],$salary_slip_monthnum);
	}else{
	$get_insentif_row=$global->salary->get_insentif_nonpit($_REQUEST['staff_code'],$salary_slip_monthnum);
	}
$get_efective_work=$global->salary->get_efective_work($salary_slip_monthnum);
$num_work=$get_insentif_row['num_work'];
$get_absence_row=$global->salary->get_absence($_REQUEST['staff_code'],$salary_slip_monthstrip);
$salary_slip_monthdatenum=$salary_slip_monthnum.$salary_slip_datenum;
$get_receivable_balance=$global->payreceivable->get_receivable_balance($salary_slip_monthdatenum,$_REQUEST['staff_code']);
//edit val
$salary_slip_basic=$staff_row['staff_salary_basic'];
$salary_slip_position=$staff_row['staff_salary_position'];
$salary_slip_insurance=$staff_row['staff_salary_insurance'];
$salary_slip_transport=$staff_row['staff_salary_transport']*$num_work;
$salary_slip_food=$staff_row['staff_salary_food']*$num_work;
$salary_slip_insentif_daily=0;
if(!is_null($get_insentif_row['salary_daily_target_amount'])){
	$salary_slip_insentif_daily=$get_insentif_row['salary_daily_target_amount'];
	}

$salary_slip_commission_part_service=number_format(($get_insentif_row['product_fee']+$get_insentif_row['service_fee']), 2,".","");
$salary_slip_commission_part=number_format(($get_insentif_row['product_fee']), 2,".","");
$salary_slip_commission_service=number_format(($get_insentif_row['service_fee']), 2,".","");
$salary_slip_insentif_unit_entry=$get_insentif_row['salary_slip_insentif_unit_entry'];
$salary_slip_insentif_product=$get_insentif_row['salary_slip_insentif_product'];
$salary_slip_insentif_service=$get_insentif_row['salary_slip_insentif_service'];
$salary_slip_insentif_bonus=$get_insentif_row['salary_slip_insentif_bonus'];
$salary_slip_insentif_no_alfa=$get_absence_row['salary_slip_insentif_no_alfa'];
if($num_work<=0){
	$salary_slip_insentif_no_alfa=0;
	}
$salary_slip_fee_picket=0;
$salary_slip_cut_late=$get_absence_row['salary_slip_cut_late'];
$salary_slip_cut_alfa=$get_absence_row['salary_slip_cut_alfa'];
$salary_slip_cut_cashbon=$get_receivable_balance['receivable_balance_cashbon'];//
$salary_slip_cut_payable=number_format($get_receivable_balance['receivable_balance_tenor'], 2,".","");
$salary_slip_cut_insurance=$staff_row['staff_salary_insurance'];
$salary_slip_cut_other1=0;
$salary_slip_cut_other2=0;
//hidden val
$salary_slip_basic_hidden=$salary_slip_basic;
$salary_slip_position_hidden=$salary_slip_position;
$salary_slip_insurance_hidden=$salary_slip_insurance;
$salary_slip_transport_hidden=$salary_slip_transport;
$salary_slip_food_hidden=$salary_slip_food;
$salary_slip_insentif_daily_hidden=$salary_slip_insentif_daily;
$salary_slip_commission_part_service_hidden=$salary_slip_commission_part_service;
$salary_slip_commission_part_hidden=$salary_slip_commission_part;
$salary_slip_commission_service_hidden=$salary_slip_commission_service;
$salary_slip_insentif_unit_entry_hidden=$salary_slip_insentif_unit_entry;
$salary_slip_insentif_product_hidden=$salary_slip_insentif_product;
$salary_slip_insentif_service_hidden=$salary_slip_insentif_service;
$salary_slip_insentif_bonus_hidden=$salary_slip_insentif_bonus;
$salary_slip_insentif_no_alfa_hidden=$salary_slip_insentif_no_alfa;
$salary_slip_fee_picket_hidden=$salary_slip_fee_picket;
$salary_slip_cut_late_hidden=$salary_slip_cut_late;
$salary_slip_cut_alfa_hidden=$salary_slip_cut_alfa;
$salary_slip_cut_cashbon_hidden=$salary_slip_cut_cashbon;//
$salary_slip_cut_payable_hidden=$salary_slip_cut_payable;
$salary_slip_cut_insurance_hidden=$salary_slip_cut_insurance;
$salary_slip_cut_other1_hidden=$salary_slip_cut_other1;
$salary_slip_cut_other2_hidden=$salary_slip_cut_other2;
}
$staff_name=$global->db_fldrow("staff","staff_name","staff_code='".$_REQUEST['staff_code']."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$salary_slip_id=$_POST['salary_slip_id'];
$salary_slip_code=$_POST['salary_slip_code'];
$staff_code=$_POST['staff_code'];
$salary_slip_date=$global->date_stridtonum($_POST['salary_slip_date']);
$salary_slip_month=$_POST['salary_slip_month'];
$salary_slip_monthnum=$global->month_strtonum($_POST['salary_slip_month']);
$salary_slip_basic=str_replace(",","",$_POST['salary_slip_basic']);
$salary_slip_position=str_replace(",","",$_POST['salary_slip_position']);
$salary_slip_transport=str_replace(",","",$_POST['salary_slip_transport']);
$salary_slip_food=str_replace(",","",$_POST['salary_slip_food']);
$salary_slip_insurance=str_replace(",","",$_POST['salary_slip_insurance']);
$salary_slip_insentif_daily=str_replace(",","",$_POST['salary_slip_insentif_daily']);
$salary_slip_commission_part_service=str_replace(",","",$_POST['salary_slip_commission_part']+$_POST['salary_slip_commission_service']);
$salary_slip_commission_part=str_replace(",","",$_POST['salary_slip_commission_part']);
$salary_slip_commission_service=str_replace(",","",$_POST['salary_slip_commission_service']);
$salary_slip_insentif_unit_entry=str_replace(",","",$_POST['salary_slip_insentif_unit_entry']);
$salary_slip_insentif_product=str_replace(",","",$_POST['salary_slip_insentif_product']);
$salary_slip_insentif_service=str_replace(",","",$_POST['salary_slip_insentif_service']);
$salary_slip_insentif_bonus=str_replace(",","",$_POST['salary_slip_insentif_bonus']);
$salary_slip_insentif_no_alfa=str_replace(",","",$_POST['salary_slip_insentif_no_alfa']);
$salary_slip_fee_picket=str_replace(",","",$_POST['salary_slip_fee_picket']);
$salary_slip_cut_late=str_replace(",","",$_POST['salary_slip_cut_late']);
$salary_slip_cut_alfa=str_replace(",","",$_POST['salary_slip_cut_alfa']);
$salary_slip_cut_cashbon=str_replace(",","",$_POST['salary_slip_cut_cashbon']);
$salary_slip_cut_payable=str_replace(",","",$_POST['salary_slip_cut_payable']);
$salary_slip_cut_insurance=str_replace(",","",$_POST['salary_slip_cut_insurance']);
$salary_slip_cut_other1=str_replace(",","",$_POST['salary_slip_cut_other1']);
$salary_slip_cut_other2=str_replace(",","",$_POST['salary_slip_cut_other2']);
$salary_total=str_replace(",","",$_POST['salary_total']);
//end form handling

//insert items
$update_arr = array(
'staff_code'=>	$staff_code,
'salary_slip_code'=>	$salary_slip_code,
'salary_slip_date'=>	$salary_slip_date,
'salary_slip_month'=>	$salary_slip_month,
'salary_slip_monthnum'=>	$salary_slip_monthnum,
'salary_slip_basic'=>	$salary_slip_basic,
'salary_slip_position'=>	$salary_slip_position,
'salary_slip_transport'=>	$salary_slip_transport,
'salary_slip_food'=>	$salary_slip_food,
'salary_slip_insurance'=>	$salary_slip_insurance,
'salary_slip_insentif_daily'=>	$salary_slip_insentif_daily,
'salary_slip_commission_part_service'=>	$salary_slip_commission_part_service,
'salary_slip_insentif_unit_entry'=>	$salary_slip_insentif_unit_entry,
'salary_slip_insentif_product'=>	$salary_slip_insentif_product,
'salary_slip_insentif_service'=>	$salary_slip_insentif_service,
'salary_slip_insentif_bonus'=>	$salary_slip_insentif_bonus,
'salary_slip_insentif_no_alfa'=>	$salary_slip_insentif_no_alfa,
'salary_slip_fee_picket'=>	$salary_slip_fee_picket,
'salary_slip_cut_late'=>	$salary_slip_cut_late,
'salary_slip_cut_alfa'=>	$salary_slip_cut_alfa,
'salary_slip_cut_cashbon'=>	$salary_slip_cut_cashbon,
'salary_slip_cut_payable'=>	$salary_slip_cut_payable,
'salary_slip_cut_insurance'=>	$salary_slip_cut_insurance,
'salary_slip_cut_other1'=>	$salary_slip_cut_other1,
'salary_slip_cut_other2'=>	$salary_slip_cut_other2,
'salary_total'=>	$salary_total,
);
if($salary_slip_id>0){
//update slip
if(!$global->salary->update_salary_slip($update_arr,$salary_slip_id)){
	$global->salary->error_message($global->salary->err_msg);
	}}else{
//create slip
if(!$global->salary->create_salary_slip($update_arr)){
	$global->salary->error_message($global->salary->err_msg);
	}}
//redirect
Header("location: slip.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>