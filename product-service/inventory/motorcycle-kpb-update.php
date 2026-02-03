<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['motorcycle_code']))
	{
	//get motorcycle_code
	$motorcycle_code_exp=explode(" - ",$_REQUEST['motorcycle_code']);
	$motorcycle_code=$global->db_fldrow("motorcycle","motorcycle_code","motorcycle_code='".$motorcycle_code_exp[0]."'");
	//get motorcycle_type_code
	$motorcycle_type_code=str_replace("+"," ",$_POST['motorcycle_type_code']);
	$motorcycle_type_code=str_replace("%20"," ",$motorcycle_type_code);
	$motorcycle_type_code_exp=explode(" - ",$motorcycle_type_code);
	//motorcycle_type_row
	$motorcycle_type_row=$global->db_row("motorcycle_type","*","motorcycle_type_code='".$motorcycle_type_code_exp[0]."'");
	$motorcycle_type_code=$motorcycle_type_row['motorcycle_type_code'];
	//print_r($motorcycle_type_code_exp);
	//motorcycle_model row
	$motorcycle_model_row=$global->db_row("motorcycle_model","*","motorcycle_model_code='".$motorcycle_type_row['motorcycle_type_model']."'");
	//date validate
	$valid_date=$global->valid_date($_POST['motorcycle_buy_register']);
	if(!$valid_date['is_valid']){
		$global->error_message($msgform_lang['date_invalid']);
		}
	$motorcycle_arr = array(
	'motorcycle_machine_no'=>	$_POST['motorcycle_machine_no'],
	'motorcycle_type_code'=>	$motorcycle_type_code,
	'motorcycle_buy_register'=>	$valid_date['date_register'],
	'motorcycle_buy_registernum'=>	$valid_date['date_registernum'],
	'motorcycle_book_service_no'=>	$_POST['motorcycle_book_service_no'],
	);
	$global->db_update("motorcycle",$motorcycle_arr,"motorcycle_code='".$motorcycle_code."'");
	//cek if KPB 1 and get oli code
	if($_REQUEST['kpb_online_num']==1){
		if($motorcycle_type_row['product_code']!=""){
			$product_code=$motorcycle_type_row['product_code'];
			$motorcycle_model_oil_service_sprice=$motorcycle_type_row['motorcycle_type_oil_service_sprice'];
			}else{
			$product_code=$motorcycle_model_row['product_code'];
			$motorcycle_model_oil_service_sprice=$motorcycle_model_row['motorcycle_model_oil_service_sprice'];
			}
		$product_row=$global->product_order->db_row("product","*","product_code='".$product_code."'");
		$product_code=$product_row['product_code']." - ".$product_row['product_name'];
		$motorcycle_type_oil_service_bprice=$product_row['product_bprice'];
		$motorcycle_type_kpb_service_sprice=$motorcycle_type_row['motorcycle_type_kpb_service_sprice'];
		echo $product_code.";".$motorcycle_type_oil_service_bprice.";".$motorcycle_model_oil_service_sprice.";".$motorcycle_type_kpb_service_sprice.";".$motorcycle_type_code;
	}else if($_REQUEST['kpb_online_num']==2){
		$motorcycle_type_kpb_service_sprice=$motorcycle_type_row['motorcycle_type_kpb2_service_sprice'];
		echo "0;0;0;".$motorcycle_type_kpb_service_sprice.";".$motorcycle_type_code;
	}else if($_REQUEST['kpb_online_num']==3){
		$motorcycle_type_kpb_service_sprice=$motorcycle_type_row['motorcycle_type_kpb3_service_sprice'];
		echo "0;0;0;".$motorcycle_type_kpb_service_sprice.";".$motorcycle_type_code;
	}else if($_REQUEST['kpb_online_num']==4){
		$motorcycle_type_kpb_service_sprice=$motorcycle_type_row['motorcycle_type_kpb4_service_sprice'];
		echo "0;0;0;".$motorcycle_type_kpb_service_sprice.";".$motorcycle_type_code;
		}else{
		echo "0;0;0;0;0";
		}
	}
?>