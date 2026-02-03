<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? $parent_active="asset-fixed"; ?>
<? $page_active="asset-fixed/asset-fixed"; ?>
<? include ("../controller/login-sessi.php"); ?>
<?
if(isset($_POST['asset_fixed_name']))
{
//form handling
$users_code="";
$payment_type=$_POST['payment_type'];
if($payment_type=="credit"){
//get users id
$users_code_arr=explode(" - ",$_POST['users_code']);
$users_code=$global->asset_fixed->db_fldrow("users","users_code","users_code='".$users_code_arr[0]."'");
if($users_code==""){
	$global->error_message($global->asset_fixed->asset_fixed_lang['err_asset_fixed_lang']['user_empty']);
	}}
$asset_fixed_name=mysqli_real_escape_string($global->db_con,$_POST['asset_fixed_name']);
$asset_fixed_quantity=$_POST['asset_fixed_quantity'];
$asset_fixed_amount=$_POST['asset_fixed_amount'];
$asset_fixed_depreciation_period=$_POST['asset_fixed_depreciation_period'];
$asset_fixed_depreciation_type=$_POST['asset_fixed_depreciation_type'];
$asset_fixed_code=mysqli_real_escape_string($global->db_con,$_POST['asset_fixed_code']);
$asset_fixed_accountcredit=$_POST['asset_fixed_accountcredit'];
$asset_fixed_type=$_POST['asset_fixed_type'];
if($asset_fixed_type=="building_inventory"){
	$asset_fixed_accountdebit=$global->asset_fixed->book->account_special_get("building_inventory");
	}else if($asset_fixed_type=="car_inventory"){
	$asset_fixed_accountdebit=$global->asset_fixed->book->account_special_get("car_inventory");
	}else{
	$asset_fixed_accountdebit=$global->asset_fixed->book->account_special_get("asset_inventory");
	}
$asset_fixed_description=mysqli_real_escape_string($global->db_con,$_POST['asset_fixed_description']);
//end form handling

//date validate
$valid_date=$global->valid_date($_POST['date_register']);
if(!$valid_date['is_valid']){
	$global->error_message($msgform_lang['date_invalid']);
	}


//insert items
$create_arr = array(
'asset_fixed_register'=>	$valid_date['date_register'],
'asset_fixed_registernum'=>	$valid_date['date_registernum'],
'asset_fixed_name'=>	$asset_fixed_name,
'asset_fixed_quantity'=>	$asset_fixed_quantity,
'asset_fixed_amount'=>	$asset_fixed_amount,
'asset_fixed_depreciation_period'=>	$asset_fixed_depreciation_period,
'asset_fixed_depreciation_type'=>	$asset_fixed_depreciation_type,
'asset_fixed_code'=>	$asset_fixed_code,
'users_code'=>	$users_code,
'asset_fixed_accountcredit'=>	$asset_fixed_accountcredit,
'asset_fixed_accountdebit'=>	$asset_fixed_accountdebit,
'asset_fixed_type'=>	$asset_fixed_type,
'payment_type'=>	$payment_type,
'asset_fixed_description'=>	$asset_fixed_description,
);
//create asset fixed
if(!$global->asset_fixed->create_asset_fixed($create_arr)){
	$global->asset_fixed->error_message($global->asset_fixed->err_msg);
	}
	
//redirect
//Header("location: asset-fixed.php");
Header("location: ../confirm.php?redirect=asset-fixed/asset-fixed.php&confirm=".$form_header_lang['add_new_button']);
exit;
}
?>