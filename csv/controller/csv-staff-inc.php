<?
/**
* Operation csv import
*/
if(isset($_POST['btn_import']))
{
//upload csv
$namacsv="csv/".$_FILES['file_source']['name'];
if(!($_FILES['file_source']['size']==0))
	{
	if(is_uploaded_file($_FILES['file_source']['tmp_name']))
		{
		$destination=$namacsv;
		move_uploaded_file($_FILES['file_source']['tmp_name'], $destination);
		}
	else 
		{
		$error=$global->csv->csv_lang['msgform_csv_lang']['csv_up_err'];
		echo "<script>alert(\"$error \");history.go(-1)</script>";
		exit;
		}
	}

//fields_arr
$fields_arr = array(
'staff_code'=>	$global->users->users_lang['form_label_users_lang']['staff_code'],
'staff_gender'=>	$global->users->users_lang['form_label_users_lang']['staff_gender'],
'staff_name'=>	$global->users->users_lang['form_label_users_lang']['staff_name'],
'staff_date_born'=>	$global->users->users_lang['form_label_users_lang']['staff_date_born'],
'staff_place_born'=>	$global->users->users_lang['form_label_users_lang']['staff_place_born'],
'religion_code'=>	$global->users->users_lang['form_label_users_lang']['religion_code'],
'education_code'=>	$global->users->users_lang['form_label_users_lang']['education_code'],
'staff_address'=>	$global->users->users_lang['form_label_users_lang']['staff_address'],
'staff_phone'=>	$global->users->users_lang['form_label_users_lang']['staff_phone'],
'staff_email'=>	$global->users->users_lang['form_label_users_lang']['staff_email'],
'staff_id_nom'=>	$global->users->users_lang['form_label_users_lang']['staff_id_nom'],
'staff_place_from'=>	$global->users->users_lang['form_label_users_lang']['staff_place_from'],
'staff_married_status'=>	$global->users->users_lang['form_label_users_lang']['staff_married_status'],
'staff_description'=>	$global->users->users_lang['form_label_users_lang']['staff_description'],
'staff_date_start_work'=>	$global->users->users_lang['form_label_users_lang']['staff_date_start_work'],
'staff_date_end_work'=>	$global->users->users_lang['form_label_users_lang']['staff_date_end_work'],
'staff_status'=>	$global->users->users_lang['form_label_users_lang']['staff_status'],
'staff_date_start_contract'=>	$global->users->users_lang['form_label_users_lang']['staff_date_start_contract'],
'staff_date_end_contract'=>	$global->users->users_lang['form_label_users_lang']['staff_date_end_contract'],
'staff_contract_num'=>	$global->users->users_lang['form_label_users_lang']['staff_contract_num'],
'position_code'=>	$global->users->users_lang['form_label_users_lang']['position_code'],
'staff_pit_status'=>	$global->users->users_lang['form_label_users_lang']['staff_pit_status'],
'staff_pmt1'=>	$global->users->users_lang['form_label_users_lang']['staff_pmt1'],
'staff_pmt2'=>	$global->users->users_lang['form_label_users_lang']['staff_pmt2'],
'staff_pmt3'=>	$global->users->users_lang['form_label_users_lang']['staff_pmt3'],
'staff_sa'=>	$global->users->users_lang['form_label_users_lang']['staff_sa'],
'staff_paa'=>	$global->users->users_lang['form_label_users_lang']['staff_paa'],
'staff_csm'=>	$global->users->users_lang['form_label_users_lang']['staff_csm'],
'staff_css'=>	$global->users->users_lang['form_label_users_lang']['staff_css'],
'staff_fee_status'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_status'],
'staff_fee_system'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system'],
'staff_fee_system_type'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system_type'],
'staff_fee_system_percent_type'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system_percent_type'],
'staff_fee_system_percent_val'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system_percent_val'],
'staff_fee_system_nominal_val'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system_nominal_val'],
'staff_salary_basic'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_basic'],
'staff_salary_position'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_position'],
'staff_salary_transport'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_transport'],
'staff_salary_food'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_food'],
'staff_salary_insurance'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_insurance'],
);

//loop data
$i=0;
$error=$global->csv->csv_lang['msgform_csv_lang']['csv_header_err'];
$handle = fopen($namacsv, "r");
while (($data_csv = fgetcsv($handle, 0, ",",'"')) !== FALSE)
	{
	//convert
	$ic=0;
	foreach($fields_arr as $key => $value)
		{
		$data_csv_val=str_replace("-coma-",",",@$data_csv[$ic]);
		$data_csv_val=str_replace("'","+a-a+",$data_csv_val);
		$data[$key]=$data_csv_val;
		$ic++;
		}
	//if header csv
	if($i==0)
		{
		$penanda=0;
		$eclo="";
		foreach($fields_arr as $key => $value)
			{
			if($value!=$data[$key])
				{
				$penanda=1;
				}
			}
		if($penanda==1)
			{
			break;
			}
		}
	else
		{
		//insert items
		//staff_date_born
		$staff_date_born_vdate=$global->valid_date($data['staff_date_born']);
		if(!$staff_date_born_vdate['is_valid']){
			//$global->error_message($msgform_lang['date_invalid']);
			}
		//staff_date_start_work
		$staff_date_start_work_vdate=$global->valid_date($data['staff_date_start_work']);
		if(!$staff_date_start_work_vdate['is_valid']){
			//$global->error_message($msgform_lang['date_invalid']);
			}
		//staff_date_end_work
		$staff_date_end_work_vdate=$global->valid_date($data['staff_date_end_work']);
		if(!$staff_date_end_work_vdate['is_valid']){
			//$global->error_message($msgform_lang['date_invalid']);
			}
		//staff_date_start_contract
		$staff_date_start_contract_vdate=$global->valid_date($data['staff_date_start_contract']);
		if(!$staff_date_start_contract_vdate['is_valid']){
			//$global->error_message($msgform_lang['date_invalid']);
			}
		//staff_date_end_contract
		$staff_date_end_contract_vdate=$global->valid_date($data['staff_date_end_contract']);
		if(!$staff_date_end_contract_vdate['is_valid']){
			//$global->error_message($msgform_lang['date_invalid']);
			}	
		$insert_arr = array(
		'staff_code'=>	$data['staff_code'],
		'staff_gender'=>	$data['staff_gender'],
		'staff_name'=>	$data['staff_name'],
		'staff_date_born'=>	$staff_date_born_vdate['date_register'],
		'staff_place_born'=>	$data['staff_place_born'],
		'religion_code'=>	$data['religion_code'],
		'education_code'=>	$data['education_code'],
		'staff_address'=>	$data['staff_address'],
		'staff_phone'=>	$data['staff_phone'],
		'staff_email'=>	$data['staff_email'],
		'staff_id_nom'=>	$data['staff_id_nom'],
		'staff_place_from'=>	$data['staff_place_from'],
		'staff_married_status'=>	$data['staff_married_status'],
		'staff_description'=>	$data['staff_description'],
		'staff_date_start_work'=>	$staff_date_start_work_vdate['date_register'],
		'staff_datenum_start_work'=>	$staff_date_start_work_vdate['date_registernum'],
		'staff_date_end_work'=>	$staff_date_end_work_vdate['date_register'],
		'staff_datenum_end_work'=>	$staff_date_end_work_vdate['date_registernum'],
		'staff_status'=>	$data['staff_status'],
		'staff_date_start_contract'=>	$staff_date_start_contract_vdate['date_register'],
		'staff_datenum_start_contract'=>	$staff_date_start_contract_vdate['date_registernum'],
		'staff_date_end_contract'=>	$staff_date_end_contract_vdate['date_register'],
		'staff_datenum_end_contract'=>	$staff_date_end_contract_vdate['date_registernum'],
		'staff_contract_num'=>	$data['staff_contract_num'],
		'position_code'=>	$data['position_code'],
		'staff_pit_status'=>	$data['staff_pit_status'],
		'staff_pmt1'=>	$data['staff_pmt1'],
		'staff_pmt2'=>	$data['staff_pmt2'],
		'staff_pmt3'=>	$data['staff_pmt3'],
		'staff_sa'=>	$data['staff_sa'],
		'staff_paa'=>	$data['staff_paa'],
		'staff_csm'=>	$data['staff_csm'],
		'staff_css'=>	$data['staff_css'],
		'staff_fee_status'=>	$data['staff_fee_status'],
		'staff_fee_system'=>	$data['staff_fee_system'],
		'staff_fee_system_type'=>	$data['staff_fee_system_type'],
		'staff_fee_system_percent_type'=>	$data['staff_fee_system_percent_type'],
		'staff_fee_system_percent_val'=>	$data['staff_fee_system_percent_val'],
		'staff_fee_system_nominal_val'=>	$data['staff_fee_system_nominal_val'],
		'staff_salary_basic'=>	$data['staff_salary_basic'],
		'staff_salary_position'=>	$data['staff_salary_position'],
		'staff_salary_transport'=>	$data['staff_salary_transport'],
		'staff_salary_food'=>	$data['staff_salary_food'],
		'staff_salary_insurance'=>	$data['staff_salary_insurance'],
		);
		$global->db_insert_update('staff',$insert_arr,'staff_code');
		}
	$i++;
	}
//check if break
if($penanda=="1")
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}

//redirect to confirm
Header("location: ../".$_POST['redirect_import']);
exit;
}else{
/**
* Operation csv generate
*/
$file_name="karyawan.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$sort_value="staff_code ASC";
$pageset_value=0;
$per_page_value=0;

//set search array 
$search_field_arr=array("staff_code","staff_name","staff_address");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>"",
'join_tbl'=>array("position","religion","education"),
'join_type'=>array("LEFT JOIN","LEFT JOIN","LEFT JOIN"),
'join_key'=>array("position_code","religion_code","education_code"),
'join_tbl_field'=>array("position_name,position_code","religion_name,religion_code","education_name,education_code"),
'join_tbl_group'=>array(0,0,0),
'join_tbl_id'=>array("","",""),
);
$staff_search_list=$global->tbl_searchjoin_list("staff","staff.*,position.position_name,position.position_code,religion.religion_name,religion.religion_code,education.education_name,education.education_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust

//fields_arr
$fields_arr = array(
'staff_code'=>	$global->users->users_lang['form_label_users_lang']['staff_code'],
'staff_gender'=>	$global->users->users_lang['form_label_users_lang']['staff_gender'],
'staff_name'=>	$global->users->users_lang['form_label_users_lang']['staff_name'],
'staff_date_born'=>	$global->users->users_lang['form_label_users_lang']['staff_date_born'],
'staff_place_born'=>	$global->users->users_lang['form_label_users_lang']['staff_place_born'],
'religion_code'=>	$global->users->users_lang['form_label_users_lang']['religion_code'],
'education_code'=>	$global->users->users_lang['form_label_users_lang']['education_code'],
'staff_address'=>	$global->users->users_lang['form_label_users_lang']['staff_address'],
'staff_phone'=>	$global->users->users_lang['form_label_users_lang']['staff_phone'],
'staff_email'=>	$global->users->users_lang['form_label_users_lang']['staff_email'],
'staff_id_nom'=>	$global->users->users_lang['form_label_users_lang']['staff_id_nom'],
'staff_place_from'=>	$global->users->users_lang['form_label_users_lang']['staff_place_from'],
'staff_married_status'=>	$global->users->users_lang['form_label_users_lang']['staff_married_status'],
'staff_description'=>	$global->users->users_lang['form_label_users_lang']['staff_description'],
'staff_date_start_work'=>	$global->users->users_lang['form_label_users_lang']['staff_date_start_work'],
'staff_date_end_work'=>	$global->users->users_lang['form_label_users_lang']['staff_date_end_work'],
'staff_status'=>	$global->users->users_lang['form_label_users_lang']['staff_status'],
'staff_date_start_contract'=>	$global->users->users_lang['form_label_users_lang']['staff_date_start_contract'],
'staff_date_end_contract'=>	$global->users->users_lang['form_label_users_lang']['staff_date_end_contract'],
'staff_contract_num'=>	$global->users->users_lang['form_label_users_lang']['staff_contract_num'],
'position_code'=>	$global->users->users_lang['form_label_users_lang']['position_code'],
'staff_pit_status'=>	$global->users->users_lang['form_label_users_lang']['staff_pit_status'],
'staff_pmt1'=>	$global->users->users_lang['form_label_users_lang']['staff_pmt1'],
'staff_pmt2'=>	$global->users->users_lang['form_label_users_lang']['staff_pmt2'],
'staff_pmt3'=>	$global->users->users_lang['form_label_users_lang']['staff_pmt3'],
'staff_sa'=>	$global->users->users_lang['form_label_users_lang']['staff_sa'],
'staff_paa'=>	$global->users->users_lang['form_label_users_lang']['staff_paa'],
'staff_csm'=>	$global->users->users_lang['form_label_users_lang']['staff_csm'],
'staff_css'=>	$global->users->users_lang['form_label_users_lang']['staff_css'],
'staff_fee_status'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_status'],
'staff_fee_system'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system'],
'staff_fee_system_type'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system_type'],
'staff_fee_system_percent_type'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system_percent_type'],
'staff_fee_system_percent_val'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system_percent_val'],
'staff_fee_system_nominal_val'=>	$global->users->users_lang['form_label_users_lang']['staff_fee_system_nominal_val'],
'staff_salary_basic'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_basic'],
'staff_salary_position'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_position'],
'staff_salary_transport'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_transport'],
'staff_salary_food'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_food'],
'staff_salary_insurance'=>	$global->users->users_lang['form_label_users_lang']['staff_salary_insurance'],
);

//get out
$out=$global->csv_generate($fields_arr,$staff_search_list);

//print_r($loan_search_list);
//echo $qry_str_sort;

//unlink if exist csv
unlink($csv_source);
// Open file export.csv.
$f = fopen ($csv_source,'w+');

// Put all values from $out to export.csv. 
fputs($f, $out);
fclose($f);

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="'.$file_name.'"');
readfile($csv_source);
}
?>