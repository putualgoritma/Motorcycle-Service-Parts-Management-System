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
'service_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_code'],
'service_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_name'],
'category_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['category_code'],
'categorysub_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['categorysub_code'],
'service_time_est'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_time_est'],
'service_time_type'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_time_type'],
'service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_sprice'],
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
		'service_code'=>	$data['service_code'],
		'service_name'=>	$data['service_name'],
		'service_sprice'=>	$data['service_sprice'],
		'service_time_est'=>	$data['service_time_est'],
		'service_time_type'=>	$data['service_time_type'],
		'category_code'=>	$data['category_code'],
		'categorysub_code'=>	$data['categorysub_code'],
		);
		$global->db_insert_update('service',$insert_arr,'service_code');
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
$file_name="jasa.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$sort_value="service.service_code ASC";
$pageset_value=0;
$per_page_value=0;

//query
$search_field_arr=array("service.service_code","service.service_name","service.service_unit");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>"",
'join_tbl'=>array("category","categorysub"),
'join_type'=>array("LEFT JOIN","LEFT JOIN"),
'join_key'=>array("category_code","categorysub_code"),
'join_tbl_field'=>array("category_name,category_code","categorysub_name,categorysub_code"),
'join_tbl_group'=>array(0,0),
'join_tbl_id'=>array("",""),
);
$service_search_list=$global->tbl_searchjoin_list("service","service.*,category.category_name,category.category_code,categorysub.categorysub_name,categorysub.categorysub_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust

//fields_arr
$fields_arr = array(
'service_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_code'],
'service_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_name'],
'category_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['category_code'],
'categorysub_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['categorysub_code'],
'service_time_est'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_time_est'],
'service_time_type'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_time_type'],
'service_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['service_sprice'],
);

//get out
$out=$global->csv_generate($fields_arr,$service_search_list);

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