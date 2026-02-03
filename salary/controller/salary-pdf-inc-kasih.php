<?
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
$staff_name=$global->db_fldrow("staff","staff_name","staff_code='".$_REQUEST['staff_code']."'");
?>
