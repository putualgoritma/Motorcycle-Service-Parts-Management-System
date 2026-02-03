<?
if(isset($_POST['Submit']))
{
//form handling
$taxonomi_parent=$_POST['taxonomi_parent'];
$taxonomi_postable=$_POST['taxonomi_postable'];
$taxonomi_cash_flow=$_POST['taxonomi_cash_flow'];
$taxonomi_name=mysqli_real_escape_string($global->db_con,$_POST['taxonomi_name']);
//end form handling

//cari type
$taxonomi_row=$global->db_row("taxonomi","*","taxonomi_code='".$taxonomi_parent."'");
$taxonomi_type=$taxonomi_row['taxonomi_type'];
$taxonomi_level=$taxonomi_row['taxonomi_level'];

$code_generator=$global->book->taxonomi_code_gen($taxonomi_level,$taxonomi_parent);

$taxonomi_level_child=$taxonomi_level + 1;
//insert items
$insert_arr = array(
'taxonomi_parent'=>	$taxonomi_parent,
'taxonomi_name'=>	$taxonomi_name,
'taxonomi_type'=>	$taxonomi_type,
'taxonomi_code'=>	$code_generator,
'taxonomi_level'=>	$taxonomi_level_child,
'taxonomi_postable'=>	$taxonomi_postable,
'taxonomi_cash_flow'=>	$taxonomi_cash_flow,
);
$global->db_insert("taxonomi",$insert_arr);

//redirect
Header("location: ../confirm.php?redirect=book/account-list.php&confirm=".$form_header_lang['add_new_button']);
exit;
}
?>