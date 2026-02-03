<?
if (isset($_REQUEST['categorysub_id'])){
$categorysub_id=$_REQUEST['categorysub_id'];
}else{
$categorysub_id=0;
}
$categorysub_row=$global->product_order->db_row("categorysub","*","categorysub_id='".$categorysub_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$categorysub_id=$_POST['categorysub_id'];
$categorysub_code=$_POST['categorysub_code'];
$categorysub_name=$_POST['categorysub_name'];
//end form handling

//insert items
$update_arr = array(
'categorysub_code'=>	$categorysub_code,
'categorysub_name'=>	$categorysub_name,
'categorysub_type '=>	1,
);
//update categorysub
if(!$global->product_order->update_categorysub($update_arr,$_POST['categorysub_id'])){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: categorysub-service.php");
Header("location: categorysub-service.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>