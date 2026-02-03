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
'users_code'=>	$global->users->users_lang['form_label_users_lang']['users_code'],
'users_register'=>	$global->users->users_lang['form_label_users_lang']['users_register'],
'users_type'=>	$global->users->users_lang['form_label_users_lang']['users_type'],
'users_status'=>	$global->users->users_lang['form_label_users_lang']['users_status'],
'users_idnumber'=>	$global->users->users_lang['form_label_users_lang']['users_idnumber'],
'users_name'=>	$global->users->users_lang['form_label_users_lang']['users_name'],
'users_address'=>	$global->users->users_lang['form_label_users_lang']['users_address'],
'users_phone'=>	$global->users->users_lang['form_label_users_lang']['users_phone'],
'users_email'=>	$global->users->users_lang['form_label_users_lang']['users_email'],
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
		//register
		$register_vdate=$global->valid_date($data['users_register']);
		if(!$register_vdate['is_valid']){
			//$global->error_message($msgform_lang['date_invalid']);
			}
		//birthday
		$birthday_vdate=$global->valid_date($data['users_birthday']);
		if(!$birthday_vdate['is_valid']){
			//$global->error_message($msgform_lang['date_invalid']);
			}
		$insert_arr = array(
		'users_register'=>	$register_vdate['date_register'],
		'users_registernum'=>	$register_vdate['date_registernum'],
		'users_code'=>	$data['users_code'],
		'users_type'=>	$data['users_type'],
		'users_status'=>	$data['users_status'],
		'users_idnumber'=>	$data['users_idnumber'],
		'users_name'=>	$data['users_name'],
		'users_address'=>	$data['users_address'],
		'users_phone'=>	$data['users_phone'],
		'users_email'=>	$data['users_email'],
		);
		$global->db_insert_update('users',$insert_arr,'users_code');
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
$file_name="customer.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$sort_value="users_code ASC";
$pageset_value=0;
$per_page_value=0;

//set search array 
$search_field_arr=array("users_code","users_name","users_address");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND users_type ='customer'",
'join_id'=>"",
'join_tbl'=>array("users_group","religion","city","area"),
'join_type'=>array("LEFT JOIN","LEFT JOIN","LEFT JOIN","LEFT JOIN"),
'join_key'=>array("users_group_code","religion_code","city_code","area_code"),
'join_tbl_field'=>array("users_group_name,users_group_code","religion_name,religion_code","city_name,city_code","area_name,area_code"),
'join_tbl_group'=>array(0,0,0,0),
'join_tbl_id'=>array("","","",""),
);
$users_search_list=$global->tbl_searchjoin_list("users","users.*,users_group.users_group_name,users_group.users_group_code,religion.religion_name,religion.religion_code,city.city_name,city.city_code,area.area_name,area.area_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust

//fields_arr
$fields_arr = array(
'users_code'=>	$global->users->users_lang['form_label_users_lang']['users_code'],
'users_register'=>	$global->users->users_lang['form_label_users_lang']['users_register'],
'users_type'=>	$global->users->users_lang['form_label_users_lang']['users_type'],
'users_status'=>	$global->users->users_lang['form_label_users_lang']['users_status'],
'users_idnumber'=>	$global->users->users_lang['form_label_users_lang']['users_idnumber'],
'users_name'=>	$global->users->users_lang['form_label_users_lang']['users_name'],
'users_address'=>	$global->users->users_lang['form_label_users_lang']['users_address'],
'users_phone'=>	$global->users->users_lang['form_label_users_lang']['users_phone'],
'users_email'=>	$global->users->users_lang['form_label_users_lang']['users_email'],
);

//get out
$out=$global->csv_generate($fields_arr,$users_search_list);

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