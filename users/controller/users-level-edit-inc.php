<?
if (isset($_REQUEST['users_level_id'])){
$users_level_id=$_REQUEST['users_level_id'];
}else{
$users_level_id=0;
}
$users_level_row=$global->users->db_row("users_level","*","users_level_id='".$users_level_id."'");
//loop users_level_module
$ulm_arr2=$global->users_role($users_level_row['users_level_code']);
//print_r($ulm_arr);
//if Submit edit
if(isset($_POST['Submit']))
{
//print_r($_POST); 
//form handling
$users_level_id=$_POST['users_level_id'];
$users_level_code=$_POST['users_level_code'];
$users_level_name=$_POST['users_level_name'];
//end form handling

//old val
$users_level_code_old=$global->db_fldrow("users_level","users_level_code","users_level_id='".$users_level_id."'");

//insert items
$create_arr = array(
'users_level_code'=>	$users_level_code,
'users_level_name'=>	$users_level_name,
);
//create users_level
if(!$global->users->update_users_level($create_arr,$users_level_id)){
	$global->users->error_message($global->users->err_msg);
	}else{
//level access
//reset first
$global->db_delete("users_level_module","users_level_code='".$users_level_code_old."'");
//form handling
$module_code=$_POST['module_code'];
$module_sub_code=$_POST['module_sub_code'];
//loop module_id
foreach($module_code as $m_key => $m_n) {
	$checkbox_view=(isset($_POST['checkbox_view'][$m_key]) ? 1 : 0);
	$create_arr = array(
	'module_code'=>	$module_code[$m_key],
	'users_level_code'=>	$users_level_code,
	'users_level_module_access_view'=>	$checkbox_view,
	);
	//create users_level
	if(!$global->users->create_users_level_module($create_arr)){
		$global->users->error_message($global->users->err_msg);
		}
	//loop module_sub_id
	if(isset($module_sub_code[$m_key])){
	foreach($module_sub_code[$m_key] as $ms_key => $ms_n) {
		$checkbox_view_sub=(isset($_POST['checkbox_view_sub'][$m_key][$ms_key]) ? 1 : 0);
		$checkbox_add=(isset($_POST['checkbox_add'][$m_key][$ms_key]) ? 1 : 0);
		$checkbox_edit=(isset($_POST['checkbox_edit'][$m_key][$ms_key]) ? 1 : 0);
		$checkbox_delete=(isset($_POST['checkbox_delete'][$m_key][$ms_key]) ? 1 : 0);
		$checkbox_csv=(isset($_POST['checkbox_csv'][$m_key][$ms_key]) ? 1 : 0);
		$create_arr = array(
		'module_code'=>	$module_code[$m_key],
		'module_sub_code'=>	$module_sub_code[$m_key][$ms_key],
		'users_level_code'=>	$users_level_code,
		'users_level_module_access_view'=>	$checkbox_view_sub,
		'users_level_module_access_add'=>	$checkbox_add,
		'users_level_module_access_edit'=>	$checkbox_edit,
		'users_level_module_access_delete'=>	$checkbox_delete,
		'users_level_module_access_csv'=>	$checkbox_csv,
		);
		//create users_level
		if(!$global->users->create_users_level_module($create_arr)){
			$global->users->error_message($global->users->err_msg);
			}
		}}
	}}
//redirect
//Header("location: users-level.php");
Header("location: users-level.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>