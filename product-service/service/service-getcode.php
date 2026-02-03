<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['scode']))
	{
		$qry_add="";
		if(isset($_REQUEST['service_order_id']))
			{
			$qry_add=" AND service_order_id!='".$_REQUEST['service_order_id']."'";
			}
		$service_code_arr=explode(" - ",$_REQUEST['scode']);
		
		$service_row=$global->db_row_join("service,category","service.*,category.category_code","service_code='".$service_code_arr[0]."' AND service.category_code=category.category_code");
		
		$service_shtquantity=0;
		$service_spoquantity=0;
		$service_quantity=0;
		$service_bpoquantity=0;
		$current_opname=0;
		$service_quantity=0;

		
		$service_name=$service_row['service_name'];
		$service_sprice=$service_row['service_sprice'];
		$service_bprice=$service_row['service_bprice'];
		$service_disc=$service_row['service_disc'];
		$category_code=$service_row['category_code'];
		// Output the saved barcode to show in response
		if($service_name==""){
		echo 1;
		}else if($service_name!="" && count($service_code_arr)==1){
		echo $service_name.";".$service_sprice.";".$service_bprice.";".$service_disc.";".$service_shtquantity.";".$service_spoquantity.";".$service_quantity.";".$service_bpoquantity.";".$category_code.";".$service_row['service_code'];
		}else{
		echo $service_name.";".$service_sprice.";".$service_bprice.";".$service_disc.";".$service_shtquantity.";".$service_spoquantity.";".$service_quantity.";".$service_bpoquantity.";".$category_code.";".$service_row['service_code'];
		}
	}else{
	echo 1;
	}
?>