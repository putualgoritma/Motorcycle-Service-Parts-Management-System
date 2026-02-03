<?
if (isset($_REQUEST['category_id'])){
$category_id=$_REQUEST['category_id'];
}else{
$category_id=0;
}
$category_row=$global->product_order->db_row("category","*","category_id='".$category_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$category_id=$_POST['category_id'];
$category_code=$_POST['category_code'];
$category_name=$_POST['category_name'];
$category_rank=$_POST['category_rank'];
//end form handling

//insert items
$update_arr = array(
'category_code'=>	$category_code,
'category_name'=>	$category_name,
'category_rank'=>	$category_rank,
'category_type '=>	1,
);
//update category
if(!$global->product_order->update_category($update_arr,$_POST['category_id'])){
	$global->product_order->error_message($global->product_order->err_msg);
	}
//redirect
//Header("location: category-service.php");
Header("location: category-service.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>