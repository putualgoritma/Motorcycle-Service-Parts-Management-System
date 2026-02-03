<?
if (isset($_REQUEST['users_id'])){
$users_id=$_REQUEST['users_id'];
}else{
$users_id=0;
}
$users_row=$global->users->db_row("users","*","users_id='".$users_id."'");
$religion_row=$global->users->db_row("religion","*","religion_code='".$users_row['religion_code']."'");
$religion_code=$religion_row['religion_code']." - ".$religion_row['religion_name'];
$village_row=$global->users->db_row("village","*","village_code='".$users_row['village_code']."'");
$village_code=$village_row['village_code']." - ".$village_row['village_name'];
$area_row=$global->users->db_row("area","*","area_code='".$users_row['area_code']."'");
$area_code=$area_row['area_code']." - ".$area_row['area_name'];
if(isset($_REQUEST['Submitcancell']))
{
Header("location: customer.php");
exit;
}
if(isset($_POST['Submit']) && isset($_POST['users_code']))
{
//form handling
$users_id=$_POST['users_id'];
$users_code=mysqli_real_escape_string($global->db_con,$_POST['users_code']);
$users_status=$_POST['users_status'];
$users_idnumber=$_POST['users_idnumber'];
$users_name=mysqli_real_escape_string($global->db_con,$_POST['users_name']);
$users_address=mysqli_real_escape_string($global->db_con,$_POST['users_address']);
$users_phone=$_POST['users_phone'];
$users_email=$_POST['users_email'];
$users_credit_max_days=$_POST['users_credit_max_days'];
$users_credit_max_amount=$_POST['users_credit_max_amount'];
$users_group_code=$_POST['users_group_code'];
$users_contact_name=$_POST['users_contact_name'];
$users_contact_phone=$_POST['users_contact_phone'];
$users_contact_position=$_POST['users_contact_position'];
$users_contact_name2=$_POST['users_contact_name2'];
$users_contact_phone2=$_POST['users_contact_phone2'];
$users_contact_position2=$_POST['users_contact_position2'];
$users_contact_name3=$_POST['users_contact_name3'];
$users_contact_phone3=$_POST['users_contact_phone3'];
$users_contact_position3=$_POST['users_contact_position3'];
$customer_level_code=$_POST['customer_level_code'];
$users_note=$_POST['users_note'];
//get religion
$religion_code_arr=explode(" - ",$_REQUEST['religion_code']);
$religion_code=$religion_code_arr[0];
$religion_code=$global->users->db_fldrow("religion","religion_code","religion_code='".$religion_code_arr[0]."'");
//get village
$village_code_arr=explode(" - ",$_REQUEST['village_code']);
$village_code=$village_code_arr[0];
$village_code=$global->users->db_fldrow("village","village_code","village_code='".$village_code_arr[0]."'");
//get area
$area_code_arr=explode(" - ",$_REQUEST['area_code']);
$area_code=$area_code_arr[0];
$area_code=$global->users->db_fldrow("area","area_code","area_code='".$area_code_arr[0]."'");
//end form handling

$valid_date2=$global->valid_date($_REQUEST['users_birthday']);
if(!$valid_date2['is_valid']){
	$users_birthday="";
	$users_birthdaynum=0;
	}else{
	$users_birthday=$valid_date2['date_register'];
	$users_birthdaynum=$valid_date2['date_registernum'];
	}

//cari tanggal
$dt=date("YmdHis");
$tanggal=date("d");
$month=date("m");
$year=date("Y");
$users_register=date("d/m/Y");
$tbt=$year.$month.$tanggal;

//insert items
$update_arr = array(
'users_register'=>	$users_register,
'users_registernum'=>	$tbt,
'users_code'=>	$users_code,
'users_type'=>	'customer',
'users_status'=>	$users_status,
'users_idnumber'=>	$users_idnumber,
'users_name'=>	$users_name,
'users_address'=>	$users_address,
'users_phone'=>	$users_phone,
'users_email'=>	$users_email,
'users_credit_max_days'=>	$users_credit_max_days,
'users_credit_max_amount'=>	$users_credit_max_amount,
'users_group_code'=>	$users_group_code,
'users_contact_name'=>	$users_contact_name,
'users_contact_phone'=>	$users_contact_phone,
'users_contact_position'=>	$users_contact_position,
'users_contact_name2'=>	$users_contact_name2,
'users_contact_phone2'=>	$users_contact_phone2,
'users_contact_position2'=>	$users_contact_position2,
'users_contact_name3'=>	$users_contact_name3,
'users_contact_phone3'=>	$users_contact_phone3,
'users_contact_position3'=>	$users_contact_position3,
'users_note'=>	$users_note,
'users_birthday'=>	$users_birthday,
'users_birthdaynum'=>	$users_birthdaynum,
'religion_code'=>	$religion_code,
'village_code'=>	$village_code,
'area_code'=>	$area_code,
'customer_level_code'=>	$customer_level_code,
);
//create asset fixed
if(!$global->users->update_users($update_arr,$users_id)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: supplier.php");
Header("location: customer.php?confirm=".$form_header_lang['add_new_button']);
exit;
//exit;
}
?>