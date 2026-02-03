<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['village_code_val']))
	{
	$result=array();
	//tbl
	$village_row=$global->db_row("village","*","village_code='".$_REQUEST['village_code_val']."'");
	if($village_row['village_id']>0){
		$result=$village_row;
		}else{
		$result['village_code']=$global->users->generator_village();
		$result['village_id']=0;
		}
	$result = array_map('utf8_encode', $result);
	echo json_encode($result);
	}
?>