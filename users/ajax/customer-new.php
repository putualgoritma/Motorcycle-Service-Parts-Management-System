<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(isset($_REQUEST['users_code']))
{
//form handling
$users_code=mysqli_real_escape_string($global->db_con,$_REQUEST['users_code']);
$users_status=$_REQUEST['users_status'];
$users_idnumber=$_REQUEST['users_idnumber'];
$users_name=mysqli_real_escape_string($global->db_con,$_REQUEST['users_name']);
$users_address=mysqli_real_escape_string($global->db_con,$_REQUEST['users_address']);
$users_phone=$_REQUEST['users_phone'];
$users_email=$_REQUEST['users_email'];
//end form handling

if(isset($_REQUEST['users_type'])){
	$users_type=$_REQUEST['users_type'];
	}else{
	$users_type='customer';
	}

//get religion
$religion_code_arr=explode(" - ",$_REQUEST['religion_code']);
$religion_code=$religion_code_arr[0];
$religion_code=$global->users->db_fldrow("religion","religion_code","religion_code='".$religion_code_arr[0]."'");
//get city
$city_code="";
if(isset($_REQUEST['city_code'])){
	$city_code_arr=explode(" - ",$_REQUEST['city_code']);
	$city_code=$city_code_arr[0];
	$city_code=$global->users->db_fldrow("city","city_code","city_code='".$city_code_arr[0]."'");
	}
//get area
$area_code="";
if(isset($_REQUEST['area_code'])){
	$area_code_arr=explode(" - ",$_REQUEST['area_code']);
	$area_code=$area_code_arr[0];
	$area_code=$global->users->db_fldrow("area","area_code","area_code='".$area_code_arr[0]."'");
	}
//end form handling

//date validate2
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
$insert_arr = array(
'users_register'=>	$users_register,
'users_registernum'=>	$tbt,
'users_code'=>	$users_code,
'users_type'=>	$users_type,
'users_status'=>	$users_status,
'users_idnumber'=>	$users_idnumber,
'users_name'=>	$users_name,
'users_address'=>	$users_address,
'users_phone'=>	$users_phone,
'users_email'=>	$users_email,
'users_birthday'=>	$users_birthday,
'users_birthdaynum'=>	$users_birthdaynum,
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