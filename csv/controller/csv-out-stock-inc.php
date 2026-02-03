<?

/**
* Operation csv generate
*/
$file_name="out-stock.csv";
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
'join_match'=>" AND product_stock < product_min_stock",
'join_id'=>""
);
$product_search_list=$global->tbl_search_list("product","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
//adjust

//fields_arr
$fields_arr = array(
'product_astra_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_astra_code'],
'product_name'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_name'],
'product_stock'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_stock'],
'product_min_stock'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['product_min_stock'],
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
?>