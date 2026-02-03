<?
//cek popup
if(isset($popup)){
$link_list="motorcycle-popup.php";
$link_new="motorcycle-popup-new.php";
}else{
$link_list="motorcycle.php";
$link_new="motorcycle-new.php";
}
//cancel
if(isset($_REQUEST['Submitcancell']))
{
Header("location: ".$link_list."");
exit;
}
if(isset($_POST['Submit']))
{
//form handling
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
//get color
$color_code_arr=explode(" - ",$_REQUEST['color_code']);
$color_code=$color_code_arr[0];
$color_code=$global->product_order->db_fldrow("color","color_code","color_code='".$color_code_arr[0]."'");
//date validate
$valid_date=$global->valid_date($_POST['motorcycle_buy_register']);
if(!$valid_date['is_valid']){
	//$global->error_message($msgform_lang['date_invalid']);
	$motorcycle_buy_register="";
	$motorcycle_buy_registernum="";
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
if(!$global->product_order->create_motorcycle($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>