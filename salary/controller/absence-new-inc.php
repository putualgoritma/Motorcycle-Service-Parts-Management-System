<?
$absence_id=0;
$absence_work_in=$company['company_work_in'];
$absence_work_out=$company['company_work_out'];
$absence_break_in=$company['company_break_in'];
$absence_break_out=$company['company_break_out'];
$absence_status="work";
$absence_description="";
$staff_name="";
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$absence_id=$_POST['absence_id'];
$staff_code_arr=explode(" - ",$_POST['staff_code']);
$staff_code=$staff_code_arr[0];
$absence_date=$global->date_stridtonum($_POST['absence_date']);
$absence_work_in=$absence_date." ".$_POST['absence_work_in'].":00";
$absence_work_out=$absence_date." ".$_POST['absence_work_out'].":00";
$absence_break_in=$absence_date." ".$_POST['absence_break_in'].":00";
$absence_break_out=$absence_date." ".$_POST['absence_break_out'].":00";
$absence_status=$_POST['absence_status'];
$absence_description=$_POST['absence_description'];
//end form handling

//insert items
$update_arr = array(
'staff_code'=>	$staff_code,
'absence_date'=>	$absence_date,
'absence_work_in'=>	$absence_work_in,
'absence_work_out'=>	$absence_work_out,
'absence_break_in'=>	$absence_break_in,
'absence_break_out'=>	$absence_break_out,
'absence_status'=>	$absence_status,
'absence_description'=>	$absence_description,
);
//print_r($update_arr);
//cek if exist
if($global->tbldata_exist("absence","absence_id","staff_code='".$staff_code."' AND absence_date='".$absence_date."'",$result_row)){
	$absence_id=$result_row['absence_id'];
	}
if($absence_id>0){
//update absence
if(!$global->salary->update_absence($update_arr,$absence_id)){
	$global->salary->error_message($global->salary->err_msg);
	}}else{
//create absence
if(!$global->salary->create_absence($update_arr)){
	$global->salary->error_message($global->salary->err_msg);
	}}
//redirect
Header("location: absence.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>