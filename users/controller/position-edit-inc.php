<?
if (isset($_REQUEST['position_id'])){
$position_id=$_REQUEST['position_id'];
}else{
$position_id=0;
}
$position_row=$global->users->db_row("position","*","position_id='".$position_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$position_id=$_POST['position_id'];
$position_code=$_POST['position_code'];
$position_name=$_POST['position_name'];
//end form handling

//insert items
$update_arr = array(
'position_code'=>	$position_code,
'position_name'=>	$position_name,
);
//update position
if(!$global->users->update_position($update_arr,$_POST['position_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: position.php");
Header("location: position.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>