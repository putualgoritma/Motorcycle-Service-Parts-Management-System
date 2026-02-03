<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(isset($_REQUEST['district_code']))
{
//form handling
$district_code=mysqli_real_escape_string($global->db_con,$_REQUEST['district_code']);
$district_status=$_REQUEST['district_status'];
$district_idnumber=$_REQUEST['district_idnumber'];
$district_name=mysqli_real_escape_string($global->db_con,$_REQUEST['district_name']);
$district_address=mysqli_real_escape_string($global->db_con,$_REQUEST['district_address']);
$district_phone=$_REQUEST['district_phone'];
$district_email=$_REQUEST['district_email'];
//end form handling

//get religion
$religion_code_arr=explode(" - ",$_REQUEST['religion_code']);
$religion_code=$religion_code_arr[0];
$religion_code=$global->users->db_fldrow("religion","religion_code","religion_code='".$religion_code_arr[0]."'");
//get city
$city_code_arr=explode(" - ",$_REQUEST['city_code']);
$city_code=$city_code_arr[0];
$city_code=$global->users->db_fldrow("city","city_code","city_code='".$city_code_arr[0]."'");
//get area
$area_code_arr=explode(" - ",$_REQUEST['area_code']);
$area_code=$area_code_arr[0];
$area_code=$global->users->db_fldrow("area","area_code","area_code='".$area_code_arr[0]."'");
//end form handling

//date validate2
$valid_date2=$global->valid_date($_REQUEST['district_birthday']);
if(!$valid_date2['is_valid']){
	$district_birthday="";
	$district_birthdaynum=0;
	}else{
	$district_birthday=$valid_date2['date_register'];
	$district_birthdaynum=$valid_date2['date_registernum'];
	}
	
//cari tanggal
$dt=date("YmdHis");
$tanggal=date("d");
$month=date("m");
$year=date("Y");
$district_register=date("d/m/Y");
$tbt=$year.$month.$tanggal;

//insert items
$insert_arr = array(
'district_register'=>	$district_register,
'district_registernum'=>	$tbt,
'district_code'=>	$district_code,
'district_type'=>	'customer',
'district_status'=>	$district_status,
'district_idnumber'=>	$district_idnumber,
'district_name'=>	$district_name,
'district_address'=>	$district_address,
'district_phone'=>	$district_phone,
'district_email'=>	$district_email,
'district_birthday'=>	$district_birthday,
'district_birthdaynum'=>	$district_birthdaynum,
'religion_code'=>	$religion_code,
'city_code'=>	$city_code,
'area_code'=>	$area_code,
);
//create asset fixed
if(!$global->users->create_users($insert_arr)){
	//$global->users->error_message($global->users->err_msg);
	}
}
?>