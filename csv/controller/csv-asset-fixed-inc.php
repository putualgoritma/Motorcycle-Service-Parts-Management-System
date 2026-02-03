<?
/**
* Operation csv generate
*/
$file_name="inventaris.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="asset_fixed_registernum DESC, asset_fixed_id DESC";
$pageset_value=0;
$per_page_value=0;

//query
$month_year="/".$month_value."/".$year_value;
$search_field_arr=array("asset_fixed_code","asset_fixed_amount","asset_fixed_name","asset_fixed_depreciation_period","asset_fixed_depreciation_type");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND asset_fixed_register LIKE '%".$month_year."'",
'join_id'=>""
);
$asset_fixed_search_list=$global->tbl_search_list("asset_fixed","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust

//fields_arr
$fields_arr = array(
'asset_fixed_code'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_code'],
'asset_fixed_type'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_type'],
'asset_fixed_register'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_register'],
'asset_fixed_name'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_name'],
'asset_fixed_description'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_description'],
'asset_fixed_quantity'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_quantity'],
'asset_fixed_depreciation_period'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_period'],
'asset_fixed_depreciation_type'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_type'],
'asset_fixed_amount'=>	$global->csv->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_amount'],
);

//get out
$out=$global->csv_generate($fields_arr,$asset_fixed_search_list);

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