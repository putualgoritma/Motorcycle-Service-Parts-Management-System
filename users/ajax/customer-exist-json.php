<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['customer_code_val']))
	{
	$result=array();
	//tbl
	if(isset($_REQUEST['users_type'])){
		$users_type="(users_type ='member' || users_type ='candidate')";
		}else{
		$users_type="users_type ='customer'";
		}
	$users_row=$global->db_row("users","*","users_code='".$_REQUEST['customer_code_val']."' AND ".$users_type);
	if($users_row['users_id']>0){
		$users_row['village_name']=$global->db_fldrow("village","village_name","village_code='".$users_row['village_code']."'");
		$result=$users_row;
		}else{
		if(isset($_REQUEST['users_type'])){
			$result['users_code']=$global->koperasi->generator_users_code();
			}else{
			$result['users_code']=$global->users->generator_customer();
			}
		$result['users_id']=0;
		}
	$result = array_map('utf8_encode', $result);
	echo json_encode($result);
	}
?>