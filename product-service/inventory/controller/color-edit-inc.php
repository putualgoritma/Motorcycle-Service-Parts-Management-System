<?
if (isset($_REQUEST['color_id'])){
$color_id=$_REQUEST['color_id'];
}else{
$color_id=0;
}
$color_row=$global->product_order->db_row("color","*","color_id='".$color_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$color_id=$_POST['color_id'];
$color_code=$_POST['color_code'];
$color_name=$_POST['color_name'];
//end form handling

//insert items
$update_arr = array(
'color_code'=>	$color_code,
'color_name'=>	$color_name,
);
//update color
if(!$global->product_order->update_color($update_arr,$_POST['color_id'])){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: color.php");
Header("location: color.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>