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
'users_type'=>	'supplier',
'users_status'=>	$users_status,
'users_idnumber'=>	$users_idnumber,
'users_name'=>	$users_name,
'users_address'=>	$users_address,
'users_phone'=>	$users_phone,
'users_email'=>	$users_email,
);
//create asset fixed
if(!$global->users->create_users($insert_arr)){
	//$global->users->error_message($global->users->err_msg);
	}
}
?>