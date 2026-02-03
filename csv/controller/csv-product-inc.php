<?
/**
* Operation csv import
*/
if(isset($_FILES['file_source']) && $_FILES['file_source']['size'] < 6000485)
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
'product_astra_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_astra_code'],
'product_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_name'],
'category_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['category_code'],
'categorysub_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['categorysub_code'],
'unit_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['unit_code'],
'rack_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['rack_code'],
'product_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_sprice'],
'product_het_price'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_het_price'],
'product_disc'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_disc'],
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
		$product_code=str_replace("-","",$data['product_astra_code']);
		$product_code=str_replace(" ","",$product_code);
		
		$product_row=$global->product_order->db_row("product","product_id,product_bprice","product_code='".$product_code."'");
		if($product_row['product_id']>0 && $product_row['product_bprice']>0){
			$product_bprice=$product_row['product_bprice'];
			}else{
			$product_bprice =$data['product_sprice']-(($data['product_disc']/100)*$data['product_sprice']);
			}

		//insert items
		$insert_arr = array(
		'product_code'=>	$product_code,
		'product_astra_code'=>	$data['product_astra_code'],
		'product_name'=>	$data['product_name'],
		'product_sprice'=>	$data['product_sprice'],
		'product_bprice'=>	$product_bprice,
		'category_code'=>	$data['category_code'],
		'categorysub_code'=>	$data['categorysub_code'],
		'unit_code'=>	$data['unit_code'],
		'rack_code'=>	$data['rack_code'],
		'product_disc'=>	$data['product_disc'],
		'product_het_price'=>	$data['product_het_price'],
		);
		$global->db_insert_update('product',$insert_arr,'product_code');
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
}else if(isset($_FILES['file_source']) && $_FILES['file_source']['size'] >= 6000485){
$global->error_message("File CSV terlalu besar");
}else{
/**
* Operation csv generate
*/
$file_name="barang.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$sort_value="product.product_code ASC";
$pageset_value=0;
$per_page_value=0;

//query
$search_field_arr=array("product_astra_code","product_name","product_unit");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>""
);
$product_search_list=$global->tbl_search_list("product","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
//adjust

//fields_arr
$fields_arr = array(
'product_astra_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_astra_code'],
'product_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_name'],
'category_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['category_code'],
'categorysub_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['categorysub_code'],
'unit_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['unit_code'],
'rack_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['rack_code'],
'product_sprice'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_sprice'],
'product_het_price'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_het_price'],
'product_disc'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_disc'],
);

//get out
$out=$global->csv_generate($fields_arr,$product_search_list);

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