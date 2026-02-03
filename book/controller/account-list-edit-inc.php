<?
if(isset($_POST['Submit']))
{
//form handling
$taxonomi_parent=$_POST['taxonomi_parent'];
$taxonomi_name=mysqli_real_escape_string($global->db_con,$_POST['taxonomi_name']);
$taxonomi_id = $_POST['taxonomi_id'];
$taxonomi_postable = $_POST['taxonomi_postable'];
$taxonomi_cash_flow=$_POST['taxonomi_cash_flow'];
$taxonomi_hidden_val=0;
if(isset($_POST['taxonomi_hidden'])){
	$taxonomi_hidden_val=1;
	}
//end form handling

//cari type
$taxonomi_row=$global->db_row("taxonomi","*","taxonomi_code='".$taxonomi_parent."'");
$taxonomi_type=$taxonomi_row['taxonomi_type'];
$taxonomi_level=$taxonomi_row['taxonomi_level'];

//code generator
$code_generator=$global->book->taxonomi_code_gen($taxonomi_level,$taxonomi_parent);

$taxonomi_level_child=$taxonomi_level + 1;

//check old
$taxonomi_parent_old=$global->db_fldrow("taxonomi","taxonomi_parent","taxonomi_id='".$taxonomi_id."'");

//update items
if($global->tbldata_exist("ledgerdetails","*","taxonomi_id='".$taxonomi_id."'")){
$update_arr = array(
	'taxonomi_name'=>	$taxonomi_name,
	'taxonomi_cash_flow'=>	$taxonomi_cash_flow,
	);
	$global->db_update("taxonomi",$update_arr,"taxonomi_id='".$taxonomi_id."'");
}else{
if($taxonomi_parent_old != $taxonomi_parent)
	{
	$update_arr = array(
	'taxonomi_parent'=>	$taxonomi_parent,
	'taxonomi_name'=>	$taxonomi_name,
	'taxonomi_postable'=>	$taxonomi_postable,
	'taxonomi_type'=>	$taxonomi_type,
	'taxonomi_level'=>	$taxonomi_level_child,
	'taxonomi_code'=>	$code_generator,
	'taxonomi_hidden'=>	$taxonomi_hidden_val,
	'taxonomi_cash_flow'=>	$taxonomi_cash_flow,
	);
	$global->db_update("taxonomi",$update_arr,"taxonomi_id='".$taxonomi_id."'");
	}
else
	{
	$update_arr = array(
	'taxonomi_name'=>	$taxonomi_name,
	'taxonomi_postable'=>	$taxonomi_postable,
	'taxonomi_hidden'=>	$taxonomi_hidden_val,
	'taxonomi_cash_flow'=>	$taxonomi_cash_flow,
	);
	$global->db_update("taxonomi",$update_arr,"taxonomi_id='".$taxonomi_id."'");
	}
}

//redirect
Header("location: ../confirm.php?redirect=book/account-list.php?search=&year=&month=&sort=&pageset=&confirm=".$form_header_lang['edit_button']);
exit;
}
?>
<?
$taxonomi_id=$_REQUEST['taxonomi_id'];
//check if taxonomi in used
if($global->tbldata_exist("ledgerdetails","*","taxonomi_id='".$taxonomi_id."'")){
//$global->error_message($msgform_lang['blocked_remove']);
}
$taxonomi_row=$global->db_row("taxonomi","*","taxonomi_id='".$taxonomi_id."'");
$taxonomi_id=$taxonomi_row['taxonomi_id'];
$taxonomi_parent=$taxonomi_row['taxonomi_parent'];
$taxonomi_name=$taxonomi_row['taxonomi_name'];
$taxonomi_postable =$taxonomi_row['taxonomi_postable'];
$taxonomi_hidden =$taxonomi_row['taxonomi_hidden'];
//cari parent
$taxonomi_id_parent=$global->db_fldrow("taxonomi","taxonomi_id","taxonomi_code='".$taxonomi_parent."'");
//echo $taxonomi_name;
?>