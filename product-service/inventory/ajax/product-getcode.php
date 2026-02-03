<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['scode']))
	{
		$product_code_arr=explode(" - ",$_REQUEST['scode']);
		$product_row=$global->db_row("product","*","product_code='".$product_code_arr[0]."'");
		$product_row['company_stock_block']=$company['company_stock_block'];
		if(!empty($_REQUEST['ucode'])){
			$ucode_arr=explode(" - ",$_REQUEST['ucode']);
			$customer_level_code=$global->db_fldrow("users","customer_level_code","users_code='".$ucode_arr[0]."'");
			if(trim($customer_level_code)!=""){
				$product_sprice_level_price=$global->db_fldrow("product_sprice_level","product_sprice_level_price","product_code='".$product_code_arr[0]."' AND customer_level_code='".$customer_level_code."'");
				$product_row['product_sprice']=$product_sprice_level_price;
				}
			}
		
		$result = array_map('utf8_encode', $product_row);
		echo json_encode($result);
	}
?>