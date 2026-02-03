<?
//cek popup
if(isset($popup)){
$link_list="staff-popup.php";
$link_new="staff-popup-new.php";
}else{
$link_list="staff.php";
$link_new="staff-new.php";
}
//submit
$staff_code_generation=$global->users->generator_staff();
if(isset($_POST['Submitcancell']))
{
Header("location: ".$link_list."");
exit;
}
if(isset($_POST['Submit']) && isset($_POST['staff_code']))
{
//form handling
$staff_code=$_POST['staff_code'];
$staff_gender=$_POST['staff_gender'];
$staff_name=$_POST['staff_name'];
$staff_place_born=$_POST['staff_place_born'];
$staff_address=$_POST['staff_address'];
$staff_phone=$_POST['staff_phone'];
$staff_email=$_POST['staff_email'];
$staff_id_nom=$_POST['staff_id_nom'];
$staff_place_from=$_POST['staff_place_from'];
$staff_married_status=$_POST['staff_married_status'];
$staff_description=$_POST['staff_description'];
$staff_status=$_POST['staff_status'];
$staff_contract_num=$_POST['staff_contract_num'];
$staff_pit_status=$_POST['staff_pit_status'];
$staff_pmt1=$_POST['staff_pmt1'];
$staff_pmt2=$_POST['staff_pmt2'];
$staff_pmt3=$_POST['staff_pmt3'];
$staff_sa=$_POST['staff_sa'];
$staff_paa=$_POST['staff_paa'];
$staff_csm=$_POST['staff_csm'];
$staff_css=$_POST['staff_css'];
$staff_fee_system=$_POST['staff_fee_system'];
$staff_fee_system_type=$_POST['staff_fee_system_type'];
$staff_fee_system_percent_type=$_POST['staff_fee_system_percent_type'];
$staff_fee_system_percent_val=$_POST['staff_fee_system_percent_val'];
$staff_fee_system_nominal_val=$_POST['staff_fee_system_nominal_val'];
$staff_salary_basic=$_POST['staff_salary_basic'];
$staff_salary_position=$_POST['staff_salary_position'];
$staff_salary_transport=$_POST['staff_salary_transport'];
$staff_salary_food=$_POST['staff_salary_food'];
$staff_salary_insurance=$_POST['staff_salary_insurance'];
//get religion
$religion_code_arr=explode(" - ",$_REQUEST['religion_code']);
$religion_code=$religion_code_arr[0];
$religion_code=$global->users->db_fldrow("religion","religion_code","religion_code='".$religion_code_arr[0]."'");
//get education
$education_code_arr=explode(" - ",$_REQUEST['education_code']);
$education_code=$education_code_arr[0];
$education_code=$global->users->db_fldrow("education","education_code","education_code='".$education_code_arr[0]."'");
//get position
$position_code_arr=explode(" - ",$_REQUEST['position_code']);
$position_code=$position_code_arr[0];
$position_code=$global->users->db_fldrow("position","position_code","position_code='".$position_code_arr[0]."'");
//if isset
$staff_fee_status=0;
if(isset($_POST['staff_fee_status'])){
	$staff_fee_status=1;
	}
//end form handling
//staff_date_born
$staff_date_born_vdate=$global->valid_date($_POST['staff_date_born']);
if(!$staff_date_born_vdate['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//staff_date_start_work
$staff_date_start_work_vdate=$global->valid_date($_POST['staff_date_start_work']);
if(!$staff_date_start_work_vdate['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//staff_date_end_work
$staff_date_end_work_vdate=$global->valid_date($_POST['staff_date_end_work']);
if(!$staff_date_end_work_vdate['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//staff_date_start_contract
$staff_date_start_contract_vdate=$global->valid_date($_POST['staff_date_start_contract']);
if(!$staff_date_start_contract_vdate['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}
//staff_date_end_contract
$staff_date_end_contract_vdate=$global->valid_date($_POST['staff_date_end_contract']);
if(!$staff_date_end_contract_vdate['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}	
	
//regenerate
$staff_code=$global->users->generator_staff();

//insert items
$insert_arr = array(
'staff_code'=>	$staff_code,
'staff_gender'=>	$staff_gender,
'staff_name'=>	$staff_name,
'staff_date_born'=>	$staff_date_born_vdate['date_register'],
'staff_place_born'=>	$staff_place_born,
'religion_code'=>	$religion_code,
'education_code'=>	$education_code,
'staff_address'=>	$staff_address,
'staff_phone'=>	$staff_phone,
'staff_email'=>	$staff_email,
'staff_id_nom'=>	$staff_id_nom,
'staff_place_from'=>	$staff_place_from,
'staff_married_status'=>	$staff_married_status,
'staff_description'=>	$staff_description,
'staff_date_start_work'=>	$staff_date_start_work_vdate['date_register'],
'staff_datenum_start_work'=>	$staff_date_start_work_vdate['date_registernum'],
'staff_date_end_work'=>	$staff_date_end_work_vdate['date_register'],
'staff_datenum_end_work'=>	$staff_date_end_work_vdate['date_registernum'],
'staff_status'=>	$staff_status,
'staff_date_start_contract'=>	$staff_date_start_contract_vdate['date_register'],
'staff_datenum_start_contract'=>	$staff_date_start_contract_vdate['date_registernum'],
'staff_date_end_contract'=>	$staff_date_end_contract_vdate['date_register'],
'staff_datenum_end_contract'=>	$staff_date_end_contract_vdate['date_registernum'],
'staff_contract_num'=>	$staff_contract_num,
'position_code'=>	$position_code,
'staff_pit_status'=>	$staff_pit_status,
'staff_pmt1'=>	$staff_pmt1,
'staff_pmt2'=>	$staff_pmt2,
'staff_pmt3'=>	$staff_pmt3,
'staff_sa'=>	$staff_sa,
'staff_paa'=>	$staff_paa,
'staff_csm'=>	$staff_csm,
'staff_css'=>	$staff_css,
'staff_fee_status'=>	$staff_fee_status,
'staff_fee_system'=>	$staff_fee_system,
'staff_fee_system_type'=>	$staff_fee_system_type,
'staff_fee_system_percent_type'=>	$staff_fee_system_percent_type,
'staff_fee_system_percent_val'=>	$staff_fee_system_percent_val,
'staff_fee_system_nominal_val'=>	$staff_fee_system_nominal_val,
'staff_salary_basic'=>	$staff_salary_basic,
'staff_salary_position'=>	$staff_salary_position,
'staff_salary_transport'=>	$staff_salary_transport,
'staff_salary_food'=>	$staff_salary_food,
'staff_salary_insurance'=>	$staff_salary_insurance,
);
//create asset fixed
if(!$global->users->create_staff($insert_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: supplier.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
//exit;
}
?>