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
'product_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_code'],
'product_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_name'],
'product_stock'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_stock'],
);

$contact_code=$contact_glob['contact_code'];
$warehouse_stock_time=date("H:i:s");
//date validate
$date_register=date("d/m/Y");
$date_registernum=date("Ymd");

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
			}else{
			$warehouse_stock_code=$global->product_order->generator_warehouse_stock_edit_code("opname");
			$warehouse_code=$global->product_order->db_fldrow("warehouse","warehouse_code","warehouse_default='1'");			
			//insert product_order
			$insert_arr = array(
			'warehouse_stock_description'=>	'',
			'warehouse_stock_code'=>	$warehouse_stock_code,
			'warehouse_code'=>	$warehouse_code,
			'warehouse_stock_type'=>	'opname',
			'warehouse_stock_status'=>	'pmn',
			'warehouse_stock_register'=>	$date_register,
			'warehouse_stock_registernum'=>	$date_registernum,
			'warehouse_stock_category'=>	'opname',
			'contact_code'=>	$contact_code,
			'warehouse_stock_time'=>	$warehouse_stock_time,
			);
			//insert
			$global->product_order->create_warehouse_stock($insert_arr);
			}
		}
	else
		{
		//update items
		$product_code=str_replace("","",$data['product_code']);
		$product_code=str_replace("","",$product_code);
		$product_row=$global->product_order->db_row("product","product_stock","product_code='".$product_code."'");
		$warehouse_stock_details_quantity=$data['product_stock']-$product_row['product_stock'];
		$insert_arr = array(
		'warehouse_stock_code'=>	$warehouse_stock_code,
		'warehouse_stock_details_quantity'=>	$warehouse_stock_details_quantity,
		'warehouse_stock_details_opname'=>	$data['product_stock'],
		'product_code'=>	$product_code,
		);
		$global->db_insert("warehouse_stock_details",$insert_arr);
		}
	$i++;
	}
//check if break
if($penanda=="1")
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}else{
	$global->product_order->stock_opname_ledger($warehouse_stock_code,$date_register,$date_registernum);
	}

//redirect to confirm
if(isset($_POST['redirect_import'])){
	Header("location: ../".$_POST['redirect_import']);
}else{
Header("location: index.php");
}
exit;
}else{
/**
* Operation csv generate
*/
$file_name="stok-barang.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="product_stock DESC";
$pageset_value=0;
$per_page_value=0;

//query
$month_year="/".$month_value."/".$year_value;
$search_field_arr=array("product_code","product_name");
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
for($i=0;$i<count($product_search_list);$i++){
$product_search_list[$i]['product_stock']=$product_search_list[$i]['product_stock'];
$product_search_list[$i]['product_shtquantity']=$product_search_list[$i]['product_stock_ht'];
$product_search_list[$i]['product_spoquantity']=$product_search_list[$i]['product_stock_so'];
$product_search_list[$i]['product_bpoquantity']=$product_search_list[$i]['product_stock_po'];
}
//print_r($product_search_list);


//fields_arr
$fields_arr = array(
'product_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_code'],
'product_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_name'],
'product_stock'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_stock'],
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