<?
/**
* Operation csv import
*/
if(isset($_FILES['file_source']))
{
//upload csv
$namacsv="csv/".$_FILES['file_source']['name'];
if(!($_FILES['file_source']['size']==0))
	{
	if(is_uploaded_file($_FILES['file_source']['tmp_name']))
		{
		$destination=$namacsv;
		move_uploaded_file($_FILES['file_source']['tmp_name'], $destination);
		}
	else 
		{
		$error=$global->csv->csv_lang['msgform_csv_lang']['csv_up_err'];
		echo "<script>alert(\"$error \");history.go(-1)</script>";
		exit;
		}
	}

//fields_arr
$fields_arr = array(
'motorcycle_type_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_code'],
'motorcycle_type_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name'],
'motorcycle_type_cc'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_cc'],
'motorcycle_type_engine_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_engine_code'],
'motorcycle_type_model'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_model'],
'product_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_code'],
'motorcycle_type_oil_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_oil_service_sprice'],
'motorcycle_type_kpb_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb_service_sprice'],
'motorcycle_type_kpb2_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb2_service_sprice'],
'motorcycle_type_kpb3_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb3_service_sprice'],
'motorcycle_type_kpb4_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb4_service_sprice'],
);

//loop data
$i=0;
$error=$global->csv->csv_lang['msgform_csv_lang']['csv_header_err'];
$handle = fopen($namacsv, "r");
while (($data_csv = fgetcsv($handle, 0, ",",'"')) !== FALSE)
	{
	//convert
	$ic=0;
	foreach($fields_arr as $key => $value)
		{
		$data_csv_val=str_replace("-coma-",",",@$data_csv[$ic]);
		$data_csv_val=str_replace("'","+a-a+",$data_csv_val);
		$data[$key]=$data_csv_val;
		$ic++;
		}
	//if header csv
	if($i==0)
		{
		$penanda=0;
		$eclo="";
		foreach($fields_arr as $key => $value)
			{
			if($value!=$data[$key])
				{
				$penanda=1;
				}
			}
		if($penanda==1)
			{
			break;
			}
		}
	else
		{
		//insert items
		$insert_arr = array(
		'motorcycle_type_code'=>	$data['motorcycle_type_code'],
		'motorcycle_type_name'=>	$data['motorcycle_type_name'],
		'motorcycle_type_cc'=>	$data['motorcycle_type_cc'],
		'motorcycle_type_engine_code'=>	$data['motorcycle_type_engine_code'],
		'motorcycle_type_model'=>	$data['motorcycle_type_model'],
		'motorcycle_type_kpb_service_sprice'=>	$data['motorcycle_type_kpb_service_sprice'],
		'product_code'=>	$data['product_code'],
		'motorcycle_type_oil_service_sprice'=>	$data['motorcycle_type_oil_service_sprice'],
		'motorcycle_type_kpb2_service_sprice'=>	$data['motorcycle_type_kpb2_service_sprice'],
		'motorcycle_type_kpb3_service_sprice'=>	$data['motorcycle_type_kpb3_service_sprice'],
		'motorcycle_type_kpb4_service_sprice'=>	$data['motorcycle_type_kpb4_service_sprice'],
		);
		$global->db_insert_update('motorcycle_type',$insert_arr,'motorcycle_type_code');
		}
	$i++;
	}
//check if break
if($penanda=="1")
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}

//redirect to confirm
Header("location: index.php");
exit;
}else{
/**
* Operation csv generate
*/
$file_name="tipe-kendaraan.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="motorcycle_type_code ASC";
$pageset_value=0;
$per_page_value=0;

//query
$month_year="/".$month_value."/".$year_value;
$search_field_arr=array("motorcycle_type_code","motorcycle_type_name");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>""
);
$motorcycle_type_search_list=$global->tbl_search_list("motorcycle_type","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust

//fields_arr
$fields_arr = array(
'motorcycle_type_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_code'],
'motorcycle_type_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name'],
'motorcycle_type_cc'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_cc'],
'motorcycle_type_engine_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_engine_code'],
'motorcycle_type_model'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_model'],
'product_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_code'],
'motorcycle_type_oil_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_oil_service_sprice'],
'motorcycle_type_kpb_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb_service_sprice'],
'motorcycle_type_kpb2_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb2_service_sprice'],
'motorcycle_type_kpb3_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb3_service_sprice'],
'motorcycle_type_kpb4_service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb4_service_sprice'],
);

//get out
$out=$global->csv_generate($fields_arr,$motorcycle_type_search_list);

//print_r($loan_search_list);
//echo $qry_str_sort;

//unlink if exist csv
unlink($csv_source);
// Open file export.csv.
$f = fopen ($csv_source,'w+');

// Put all values from $out to export.csv. 
fputs($f, $out);
fclose($f);

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="'.$file_name.'"');
readfile($csv_source);
}
?>