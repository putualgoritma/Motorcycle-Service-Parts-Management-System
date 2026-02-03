<?
if(isset($_POST['Submit']))
{
//form handling
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
$create_arr = array(
'module_code'=>	$module_code,
'module_sub_code'=>	$module_sub_code,
'module_sub_name'=>	$module_sub_name,
'module_sub_link'=>	$module_sub_link,
'module_sub_lock'=>	$module_sub_lock,
'module_sub_rank'=>	$module_sub_rank,
'module_sub_bg_color'=>	$module_sub_bg_color,
'module_sub_fa_icon'=>	$module_sub_fa_icon,
);
//create module
if(!$global->users->create_module_sub($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: module-sub.php");
Header("location: module-sub.php?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>