<?
if (isset($_REQUEST['module_id'])){
$module_id=$_REQUEST['module_id'];
}else{
$module_id=0;
}
$module_row=$global->users->db_row("module","*","module_id='".$module_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$module_id=$_POST['module_id'];
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
$update_arr = array(
'module_code'=>	$module_code,
'module_name'=>	$module_name,
'module_link'=>	$module_link,
'module_lock'=>	$module_lock,
'module_rank'=>	$module_rank,
'module_bg_color'=>	$module_bg_color,
'module_fa_icon'=>	$module_fa_icon,
);
//update module
if(!$global->users->update_module($update_arr,$_POST['module_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: module.php");
Header("location: module.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>