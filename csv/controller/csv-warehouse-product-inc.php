<?
/**
* Operation csv import
*/
if(isset($_POST['btn_import']))
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
'warehouse_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_code'],
'product_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_code'],
'product_stock_opname'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_stock_opname'],
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
		//insert warehouse_product
		$product_code=str_replace("-","",$data['product_code']);
		$product_code=str_replace(" ","",$product_code);
		$create_arr = array(
		'product_code'=>	$product_code,
		'warehouse_code'=>	$data['warehouse_code'],
		'warehouse_product_quantity'=>	$data['product_stock_opname'],
		);
		//update product
		$global->db_insert('warehouse_product',$create_arr);
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
Header("location: ../".$_POST['redirect_import']);
exit;
}else{
/**
* Operation csv generate
*/
$file_name="stok-gudang.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="product_code ASC";
$pageset_value=0;
$per_page_value=0;

//query
$month_year="/".$month_value."/".$year_value;
$search_field_arr=array("product_code","warehouse_code");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>""
);
$warehouse_product_search_list=$global->tbl_search_list("warehouse_product","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust
for($i=0;$i<count($product_search_list);$i++){
$warehouse_product_search_list[$i]['product_stock_opname']=$warehouse_product_search_list[$i]['warehouse_product_quantity'];
}
//print_r($product_search_list);


//fields_arr
$fields_arr = array(
'warehouse_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_code'],
'product_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_code'],
'product_stock_opname'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_stock_opname'],
);
//print_r($fields_arr);

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