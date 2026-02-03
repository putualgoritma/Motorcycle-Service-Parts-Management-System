<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['motorcycle_code_val']))
	{
	//tbl
	$motorcycle_row=$global->db_row("motorcycle","*","motorcycle_code='".$_REQUEST['motorcycle_code_val']."'");
	if($motorcycle_row['motorcycle_code']!=""){
		//get type
		$motorcycle_type_row=$global->db_row("motorcycle_type","*","motorcycle_type_code='".$motorcycle_row['motorcycle_type_code']."'");
		$motorcycle_type_code=$motorcycle_type_row['motorcycle_type_code']." - ".$motorcycle_type_row['motorcycle_type_name'];
		echo "1;".$motorcycle_row['motorcycle_code'].";".$motorcycle_row['motorcycle_machine_no'].";".$motorcycle_type_code.";".$motorcycle_row['motorcycle_buy_register'].";".$motorcycle_row['motorcycle_book_service_no'];
		}else{
		echo "0";
		}
	}
?>