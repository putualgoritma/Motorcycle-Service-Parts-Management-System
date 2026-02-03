<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['customer_code_val']))
	{
	//tbl
	$users_row=$global->db_row("users","*","users_code='".$_REQUEST['customer_code_val']."' AND users_type ='customer'");
	if($users_row['users_id']>0){
		echo "1;".$users_row['users_code'].";".$users_row['users_status'].";".$users_row['users_phone'];
		}else{
		$users_code_generation=$global->users->generator_customer();
		echo "0;".$users_code_generation;
		}
	}
?>