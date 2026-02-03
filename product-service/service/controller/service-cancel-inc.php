<?
//service_order_id
if (isset($_REQUEST['service_order_id'])){
$service_order_id=$_REQUEST['service_order_id'];
}else{
$service_order_id=0;
}
if(isset($_REQUEST['del_stat']))
{
$service_order_id=$_REQUEST['service_order_id'];
$service_order_cancel_note=$_REQUEST['service_order_cancel_note'];
//get author id
$author_code=$_REQUEST['author_code'];
$author_code_arr=explode(" - ",$_POST['author_code']);
$contact_code=$global->product_order->db_fldrow("contact","contact_id","contact_code='".$author_code_arr[0]."' AND contact_type='author'");
if(!$global->product_order->cancel_service_order($service_order_id,$contact_code,$service_order_cancel_note)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
Header("location: service.php?confirm=".$form_header_lang['cancell_button']);
exit;
}
?>