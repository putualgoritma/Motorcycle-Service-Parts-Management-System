<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?
if(!empty($_REQUEST['motorcycle_type_code']))
	{
	$result=array();
	//motorcycle_type_row
	$motorcycle_type_code=$global->typehead_cvt($_REQUEST['motorcycle_type_code']);
	$motorcycle_type_row=$global->db_row("motorcycle_type","*","motorcycle_type_code='".$motorcycle_type_code."'");
	$motorcycle_type_code=$motorcycle_type_row['motorcycle_type_code'];
	//motorcycle_model row
	$motorcycle_model_row=$global->db_row("motorcycle_model","*","motorcycle_model_code='".$motorcycle_type_row['motorcycle_type_model']."'");
	//cek if KPB 1 and get oli code
	if($_REQUEST['kpb_online_num']==1){
		//get def motorcycle_type_kpb_service_sprice
		$service_row=$global->db_row_join("service,category","service.service_sprice","category.category_code='ASS1' AND service.category_code=category.category_code");
		$motorcycle_type_kpb_service_sprice=$service_row['service_sprice'];
		if($motorcycle_type_row['motorcycle_type_kpb_service_sprice']>0){
			$motorcycle_type_kpb_service_sprice=$motorcycle_type_row['motorcycle_type_kpb_service_sprice'];
			}
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
		$result['product_code']=$product_code;
		$result['motorcycle_type_oil_service_bprice']=$motorcycle_model_oil_service_sprice;
		$result['motorcycle_model_oil_service_sprice']=$motorcycle_model_oil_service_sprice;
		$result['motorcycle_type_kpb_service_sprice']=$motorcycle_type_kpb_service_sprice;
		$result['motorcycle_type_code']=$motorcycle_type_code;
	}else if($_REQUEST['kpb_online_num']==2){
		//get def motorcycle_type_kpb_service_sprice
		$service_row=$global->db_row_join("service,category","service.service_sprice","category.category_code='ASS2' AND service.category_code=category.category_code");
		$motorcycle_type_kpb_service_sprice=$service_row['service_sprice'];
		if($motorcycle_type_row['motorcycle_type_kpb2_service_sprice']>0){
			$motorcycle_type_kpb_service_sprice=$motorcycle_type_row['motorcycle_type_kpb2_service_sprice'];
			}
		$result['product_code']=0;
		$result['motorcycle_type_oil_service_bprice']=0;
		$result['motorcycle_model_oil_service_sprice']=0;
		$result['motorcycle_type_kpb_service_sprice']=$motorcycle_type_kpb_service_sprice;
		$result['motorcycle_type_code']=$motorcycle_type_code;
	}else if($_REQUEST['kpb_online_num']==3){
		//get def motorcycle_type_kpb_service_sprice
		$service_row=$global->db_row_join("service,category","service.service_sprice","category.category_code='ASS3' AND service.category_code=category.category_code");
		$motorcycle_type_kpb_service_sprice=$service_row['service_sprice'];
		if($motorcycle_type_row['motorcycle_type_kpb3_service_sprice']>0){
			$motorcycle_type_kpb_service_sprice=$motorcycle_type_row['motorcycle_type_kpb3_service_sprice'];
			}
		$result['product_code']=0;
		$result['motorcycle_type_oil_service_bprice']=0;
		$result['motorcycle_model_oil_service_sprice']=0;
		$result['motorcycle_type_kpb_service_sprice']=$motorcycle_type_kpb_service_sprice;
		$result['motorcycle_type_code']=$motorcycle_type_code;
	}else if($_REQUEST['kpb_online_num']==4){
		//get def motorcycle_type_kpb_service_sprice
		$service_row=$global->db_row_join("service,category","service.service_sprice","category.category_code='ASS4' AND service.category_code=category.category_code");
		$motorcycle_type_kpb_service_sprice=$service_row['service_sprice'];
		if($motorcycle_type_row['motorcycle_type_kpb4_service_sprice']>0){
			$motorcycle_type_kpb_service_sprice=$motorcycle_type_row['motorcycle_type_kpb4_service_sprice'];
			}
		$result['product_code']=0;
		$result['motorcycle_type_oil_service_bprice']=0;
		$result['motorcycle_model_oil_service_sprice']=0;
		$result['motorcycle_type_kpb_service_sprice']=$motorcycle_type_kpb_service_sprice;
		$result['motorcycle_type_code']=$motorcycle_type_code;
		}else{
		$result['product_code']=0;
		$result['motorcycle_type_oil_service_bprice']=0;
		$result['motorcycle_model_oil_service_sprice']=0;
		$result['motorcycle_type_kpb_service_sprice']=0;
		$result['motorcycle_type_code']=0;
		}
	$result = array_map('utf8_encode', $result);
	echo json_encode($result);
	}
?>