<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['scode']))
	{
	$result=array();
	//tbl
	$taxonomi_code_arr=explode(" - ",$_REQUEST['scode']);
	$taxonomi_row=$global->db_row("taxonomi","*","taxonomi_code='".$taxonomi_code_arr[0]."'");
	if($taxonomi_row['taxonomi_id']>0){
		$result=$taxonomi_row;
		}else{
		$result['taxonomi_id']=0;
		}
	$result = array_map('utf8_encode', $result);
	echo json_encode($result);
	}
?>