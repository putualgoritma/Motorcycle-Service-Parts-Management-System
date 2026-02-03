<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(isset($_REQUEST['village_code']))
{
//form handling
$village_code=mysqli_real_escape_string($global->db_con,$_REQUEST['village_code']);
$village_name=mysqli_real_escape_string($global->db_con,$_REQUEST['village_name']);
//end form handling

//get district
$district_code_arr=explode(" - ",$_REQUEST['district_code']);
$district_code=$district_code_arr[0];
$district_code=$global->users->db_fldrow("district","district_code","district_code='".$district_code_arr[0]."'");

//insert items
$insert_arr = array(
'village_code'=>	$village_code,
'village_name'=>	$village_name,
'district_code'=>	$district_code,
);
//create asset fixed
if(!$global->users->create_village($insert_arr)){
	//$global->users->error_message($global->users->err_msg);
	}
}
?>