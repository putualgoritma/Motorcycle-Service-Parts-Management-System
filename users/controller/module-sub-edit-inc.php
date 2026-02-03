<?
if (isset($_REQUEST['module_sub_id'])){
$module_sub_id=$_REQUEST['module_sub_id'];
}else{
$module_sub_id=0;
}
$module_sub_row=$global->users->db_row("module_sub","*","module_sub_id='".$module_sub_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$module_sub_id=$_POST['module_sub_id'];
$module_code=$_POST['module_code'];
$module_sub_code=$_POST['module_sub_code'];
$module_sub_name=$_POST['module_sub_name'];
$module_sub_link=$_POST['module_sub_link'];
$module_sub_rank=$_POST['module_sub_rank'];
$module_sub_bg_color=$_POST['module_sub_bg_color'];
$module_sub_fa_icon=$_POST['module_sub_fa_icon'];
$module_sub_lock=0;
if(isset($_POST['module_sub_lock'])){
	$module_sub_lock=1;
	}
//end form handling

//insert items
$update_arr = array(
'module_code'=>	$module_code,
'module_sub_code'=>	$module_sub_code,
'module_sub_name'=>	$module_sub_name,
'module_sub_link'=>	$module_sub_link,
'module_sub_lock'=>	$module_sub_lock,
'module_sub_rank'=>	$module_sub_rank,
'module_sub_bg_color'=>	$module_sub_bg_color,
'module_sub_fa_icon'=>	$module_sub_fa_icon,
);
//update module
if(!$global->users->update_module_sub($update_arr,$_POST['module_sub_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: module-sub.php");
Header("location: module-sub.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>