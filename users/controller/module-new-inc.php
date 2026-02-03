<?
if(isset($_POST['Submit']))
{
//form handling
$module_code=$_POST['module_code'];
$module_name=$_POST['module_name'];
$module_link=$_POST['module_link'];
$module_rank=$_POST['module_rank'];
$module_bg_color=$_POST['module_bg_color'];
$module_fa_icon=$_POST['module_fa_icon'];
$module_lock=0;
if(isset($_POST['module_lock'])){
	$module_lock=1;
	}
//end form handling

//insert items
$create_arr = array(
'module_code'=>	$module_code,
'module_name'=>	$module_name,
'module_link'=>	$module_link,
'module_lock'=>	$module_lock,
'module_rank'=>	$module_rank,
'module_bg_color'=>	$module_bg_color,
'module_fa_icon'=>	$module_fa_icon,
);
//create module
if(!$global->users->create_module($create_arr)){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: module.php");
Header("location: module.php?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>