<?
//cek popup
if(isset($popup)){
$link_list="motorcycle-popup.php";
$link_edit="motorcycle-popup-edit.php";
}else{
$link_list="motorcycle.php";
$link_edit="motorcycle-edit.php";
}
if (isset($_REQUEST['motorcycle_id'])){
$motorcycle_id=$_REQUEST['motorcycle_id'];
}else{
$motorcycle_id=0;
}
$motorcycle_row=$global->product_order->db_row("motorcycle","*","motorcycle_id='".$motorcycle_id."'");
$motorcycle_type_row=$global->product_order->db_row("motorcycle_type","*","motorcycle_type_code='".$motorcycle_row['motorcycle_type_code']."'");
$motorcycle_type_code=$motorcycle_type_row['motorcycle_type_code']." - ".$motorcycle_type_row['motorcycle_type_name'];
$users_row=$global->product_order->db_row("users","*","users_code='".$motorcycle_row['users_code']."'");
$users_code=$users_row['users_code']." - ".$users_row['users_name'];
$color_row=$global->product_order->db_row("color","*","color_code='".$motorcycle_row['color_code']."'");
$color_code=$color_row['color_code']." - ".$color_row['color_name'];
//if cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: ".$link_list."");
exit;
}
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$motorcycle_id=$_POST['motorcycle_id'];
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
//update motorcycle
if(!$global->product_order->update_motorcycle($create_arr,$motorcycle_id)){
	$global->product_order->error_message($global->product_order->err_msg);
	}

Header("location: ".$link_list."?confirm=".$form_header_lang['edit_button']);
exit;
}
?>