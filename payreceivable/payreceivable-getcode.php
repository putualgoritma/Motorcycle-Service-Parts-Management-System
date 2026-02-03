<? $path="../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['scode']))
	{
	$payreceivable_code_arr=explode(" - ",$_REQUEST['scode']);
	$payreceivable_row=$global->db_row("payreceivable","*","payreceivable_code = '".$payreceivable_code_arr[0]."'");
	
	if($payreceivable_row['users_code']==""){
		echo 1;
		}else{
		echo $payreceivable_row['users_code'].";".$payreceivable_row['payreceivable_accountdebit'].";".$payreceivable_row['payreceivable_amount'].";".$payreceivable_row['payreceivable_tenor'];
		}
	}
?>