<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['district_code_val']))
	{
	$result=array();
	//tbl
	$district_row=$global->db_row("district","*","district_code='".$_REQUEST['district_code_val']."' AND district_type ='district'");
	if($district_row['district_id']>0){
		$result=$district_row;
		}else{
		$result['district_code']=$global->users->generator_district();
		$result['district_id']=0;
		}
	$result = array_map('utf8_encode', $result);
	echo json_encode($result);
	}
?>