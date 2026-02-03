<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['mcode']))
	{
	$result=array();
	$motorcycle_code_arr=explode(" - ",$_REQUEST['mcode']);
	$motorcycle_row=$global->db_row("motorcycle","*","motorcycle_code = '".$motorcycle_code_arr[0]."'");
	
	if($motorcycle_row['motorcycle_id']>0){
		$result=$motorcycle_row;
		}else{
		$result['motorcycle_id']=0;
		}
	
	$result = array_map('utf8_encode', $result);
	echo json_encode($result);
	}
?>