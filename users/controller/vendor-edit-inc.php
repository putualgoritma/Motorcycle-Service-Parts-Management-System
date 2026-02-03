<?
if (isset($_REQUEST['users_id'])){
$users_id=$_REQUEST['users_id'];
}else{
$users_id=0;
}
$users_row=$global->users->db_row("users","*","users_id='".$users_id."'");
if(isset($_REQUEST['Submitcancell']))
{
Header("location: vendor.php");
exit;
}
if(isset($_POST['Submit']) && isset($_POST['users_code']))
{
//form handling
$users_id=$_POST['users_id'];
$users_code=mysqli_real_escape_string($global->db_con,$_POST['users_code']);
$users_status=$_POST['users_status'];
$users_name=mysqli_real_escape_string($global->db_con,$_POST['users_name']);
$users_address=mysqli_real_escape_string($global->db_con,$_POST['users_address']);
$users_phone=$_POST['users_phone'];
//end form handling
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
'users_type'=>	'vendor',
'users_status'=>	$users_status,
'users_name'=>	$users_name,
'users_address'=>	$users_address,
'users_phone'=>	$users_phone,
);
//create asset fixed
if(!$global->users->update_users($update_arr,$users_id)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: supplier.php");
Header("location: vendor.php?confirm=".$form_header_lang['add_new_button']);
exit;
//exit;
}
?>