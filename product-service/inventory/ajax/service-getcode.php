<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['scode']))
	{
		$service_code_arr=explode(" - ",$_REQUEST['scode']);
		$service_row=$global->db_row_join("service,category","service.*,category.category_code","service_code='".$service_code_arr[0]."' AND service.category_code=category.category_code");
		
		$result = array_map('utf8_encode', $service_row);
		echo json_encode($result);
	}
?>