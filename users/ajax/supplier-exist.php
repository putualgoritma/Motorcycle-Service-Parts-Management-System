<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['supplier_code_val']))
	{
	$result=array();
	//tbl
	$users_row=$global->db_row("users","*","users_code='".$_REQUEST['supplier_code_val']."' AND users_type ='supplier'");
	if($users_row['users_id']>0){
		$result=$users_row;
		}else{
		$result['users_code']=$global->users->generator_supplier();
		$result['users_id']=0;
		}
	$result = array_map('utf8_encode', $result);
	echo json_encode($result);
	}
?>