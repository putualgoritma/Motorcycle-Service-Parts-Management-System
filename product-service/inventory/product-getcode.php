<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['scode']))
	{
		$qry_add="";
		if(isset($_REQUEST['product_order_id']))
			{
			$qry_add=" AND product_order_id!='".$_REQUEST['product_order_id']."'";
			}
		if(isset($_REQUEST['service_order_id']))
			{
			$qry_add=" AND service_order_id!='".$_REQUEST['service_order_id']."'";
			}
		$product_code_arr=explode(" - ",$_REQUEST['scode']);
		$product_row=$global->product_order->db_row("product","*","product_code='".$product_code_arr[0]."'");
		
		$product_shtquantity=$product_row['product_stock_ht'];
		$product_spoquantity=$product_row['product_stock_so'];
		$product_quantity=$product_row['product_stock'];
		$product_bpoquantity=$product_row['product_stock_po'];

		
		$product_code=$product_row['product_code'];
		$product_name=$product_row['product_name'];
		$product_sprice=$product_row['product_sprice'];
		$product_bprice=$product_row['product_bprice'];
		$product_disc=$product_row['product_disc'];
		// Output the saved barcode to show in response
		if($product_name==""){
		echo 1;
		}else if($product_name!="" && count($product_code_arr)==1){
		echo $product_name.";".$product_sprice.";".$product_bprice.";".$product_disc.";".$product_shtquantity.";".$product_spoquantity.";".$product_quantity.";".$product_bpoquantity.";".$product_code;
		}else{
		echo $product_name.";".$product_sprice.";".$product_bprice.";".$product_disc.";".$product_shtquantity.";".$product_spoquantity.";".$product_quantity.";".$product_bpoquantity.";".$product_code;
		}
	}
?>