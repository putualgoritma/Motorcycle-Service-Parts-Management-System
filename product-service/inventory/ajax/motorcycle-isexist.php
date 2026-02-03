<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['motorcycle_code_val']))
	{
		$motorcycle_code_arr=explode(" - ",$_REQUEST['motorcycle_code_val']);
		$motorcycle_row=$global->db_row("motorcycle","*","motorcycle_code='".$motorcycle_code_arr[0]."'");
		
		$result = array_map('utf8_encode', $motorcycle_row);
		echo json_encode($result);
	}
?>