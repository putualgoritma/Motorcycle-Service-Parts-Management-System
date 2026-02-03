<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(isset($_POST['motorcycle_code']))
{
//form handling
$motorcycle_id=$_REQUEST['motorcycle_id'];
$motorcycle_code=$_POST['motorcycle_code'];
$motorcycle_manufacture=$_POST['motorcycle_manufacture'];
$motorcycle_frame_no=$_POST['motorcycle_frame_no'];
$motorcycle_machine_no=$_POST['motorcycle_machine_no'];
$motorcycle_buy_register=$_POST['motorcycle_buy_register'];
$motorcycle_book_service_no=$_POST['motorcycle_book_service_no'];
$motorcycle_description=$_POST['motorcycle_description'];
//get motorcycle_type
$motorcycle_type_code_arr=explode(" - ",$_REQUEST['motorcycle_type_code']);
$motorcycle_type_code=$motorcycle_type_code_arr[0];
$motorcycle_type_code=$global->product_order->db_fldrow("motorcycle_type","motorcycle_type_code","motorcycle_type_code='".$motorcycle_type_code_arr[0]."'");
//get users code
$users_code_arr=explode(" - ",$_REQUEST['users_code']);
$users_code=$users_code_arr[0];
if($users_code==""){
	//create new
	$users_code=$global->users->generator_customer();
	$users_register=date("d/m/Y");
	$users_registernum=$year.$month.$tanggal;
	$insert_arr = array(
	'users_code'=>	$users_code,
	'users_name'=>	$_REQUEST['users_code'],
	'users_register'=>	$users_register,
	'users_registernum'=>	$users_registernum,
	'users_type'=>	'customer',
	'users_status'=>	$_REQUEST['users_code'],
	'users_phone'=>	$_REQUEST['users_phone'],
	);
	$global->db_insert("users",$insert_arr);
	}
//get color
$color_code_arr=explode(" - ",$_REQUEST['color_code']);
$color_code=$color_code_arr[0];
$color_code=$global->product_order->db_fldrow("color","color_code","color_code='".$color_code_arr[0]."'");

//date validate
$valid_date=$global->valid_date($_POST['motorcycle_buy_register']);
if(!$valid_date['is_valid']){
	$motorcycle_buy_register="";
	$motorcycle_buy_registernum=0;
	}else{
	$motorcycle_buy_register=$valid_date['date_register'];
	$motorcycle_buy_registernum=$valid_date['date_registernum'];
	}
	
//end form handling
//insert items
$create_arr = array(
'motorcycle_code'=>	$motorcycle_code,
'motorcycle_type_code'=>	$motorcycle_type_code,
'users_code'=>	$users_code,
'color_code'=>	$color_code,
'motorcycle_manufacture'=>	$motorcycle_manufacture,
'motorcycle_frame_no'=>	$motorcycle_frame_no,
'motorcycle_machine_no'=>	$motorcycle_machine_no,
'motorcycle_buy_register'=>	$motorcycle_buy_register,
'motorcycle_buy_registernum'=>	$motorcycle_buy_registernum,
'motorcycle_book_service_no'=>	$motorcycle_book_service_no,
'motorcycle_description'=>	$motorcycle_description,
);
//create motorcycle
$global->product_order->update_motorcycle($create_arr,$motorcycle_id);
//KPB daterange get
	$motorcycle_numdays=" ";
	if(isset($_REQUEST['date_service']) && $motorcycle_buy_registernum>0){
	$date_diff_get_arr=$global->date_diff_get($_POST['motorcycle_buy_register'],$_REQUEST['date_service']);
	$motorcycle_numdays=" ".$date_diff_get_arr['days']." hari (".$date_diff_get_arr['months']." bulan)";
	}
//type & color
	$motorcycle_type_row=$global->db_row("motorcycle_type","motorcycle_type_code,motorcycle_type_name","motorcycle_type_code='".$motorcycle_type_code."'");
	$motorcycle_type_name=$motorcycle_type_row['motorcycle_type_name'];
	$motorcycle_type_code=$motorcycle_type_row['motorcycle_type_code'];
	$color_name=$global->db_fldrow("color","color_name","color_code='".$color_code."'");
	$users_row=$global->db_row("users","users_name,users_code","users_code='".$users_code."'");
	$users_name=$users_row['users_name'];
	$users_code=$users_row['users_code'];
	
echo $users_name.";".$motorcycle_frame_no.";".$motorcycle_machine_no.";".$motorcycle_type_name.";".$color_name.";".$motorcycle_manufacture.";".$motorcycle_buy_register.";".$motorcycle_book_service_no.";".$motorcycle_numdays.";".$motorcycle_type_code.";".$motorcycle_code.";".$users_code;
}
?>