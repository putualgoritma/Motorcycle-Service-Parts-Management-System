<?
if (isset($_REQUEST['rack_id'])){
$rack_id=$_REQUEST['rack_id'];
}else{
$rack_id=0;
}
$rack_row=$global->product_order->db_row("rack","*","rack_id='".$rack_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$rack_id=$_POST['rack_id'];
$rack_code=$_POST['rack_code'];
$rack_description=$_POST['rack_description'];
//end form handling

//insert items
$update_arr = array(
'rack_code'=>	$rack_code,
'rack_description'=>	$rack_description,
);
//update rack
if(!$global->product_order->update_rack($update_arr,$_POST['rack_id'])){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: rack.php");
Header("location: rack.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>