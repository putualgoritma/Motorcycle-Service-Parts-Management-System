<?
if (isset($_REQUEST['village_id'])){
$village_id=$_REQUEST['village_id'];
}else{
$village_id=0;
}
$village_row=$global->users->db_row("village","*","village_id='".$village_id."'");
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$village_id=$_POST['village_id'];
$village_code=$_POST['village_code'];
$village_name=$_POST['village_name'];
$district_code=$_POST['district_code'];
//end form handling

//insert items
$update_arr = array(
'village_code'=>	$village_code,
'village_name'=>	$village_name,
'district_code'=>	$district_code,
);
//update village
if(!$global->users->update_village($update_arr,$_POST['village_id'])){
	$global->users->error_message($global->users->err_msg);
	}
//redirect
//Header("location: village.php");
Header("location: village.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>