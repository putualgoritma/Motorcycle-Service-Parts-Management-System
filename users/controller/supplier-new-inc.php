<?
//cek popup
if(isset($popup)){
$link_list="supplier-popup.php";
$link_new="supplier-popup-new.php";
}else{
$link_list="supplier.php";
$link_new="supplier-new.php";
}
//submit
$users_code_generation=$global->users->generator_supplier();
if(isset($_REQUEST['Submitcancell']))
{
Header("location: ".$link_list."");
exit;
}
if(isset($_POST['Submit']) && isset($_POST['users_code']))
{
//form handling
$users_code=mysqli_real_escape_string($global->db_con,$_POST['users_code']);
$users_status=$_POST['users_status'];
$users_idnumber=$_POST['users_idnumber'];
$users_name=mysqli_real_escape_string($global->db_con,$_POST['users_name']);
$users_address=mysqli_real_escape_string($global->db_con,$_POST['users_address']);
$users_phone=$_POST['users_phone'];
$users_email=$_POST['users_email'];
//end form handling

//cari tanggal
$dt=date("YmdHis");
$tanggal=date("d");
$month=date("m");
$year=date("Y");
$users_register=date("d/m/Y");
$tbt=$year.$month.$tanggal;

//regenerate
$users_code=$global->users->generator_supplier();

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
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: supplier.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
//exit;
}
?>