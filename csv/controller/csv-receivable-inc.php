<?
/**
* Operation csv generate
*/
$file_name="piutang.csv";
$csv_source="csv/".$file_name;

//init view
$db_select = $global->csv->db_select("users","*","users_type = 'member'","users_code ASC",0,0);
$users_search_list=$db_select['select_data'];

//adjust
for($i=0;$i<count($users_search_list);$i++){
$users_search_list[$i]['receivable_balance']=$global->csv->payreceivable->receivable_report_balance_total(array("receivable_staff"),$users_search_list[$i]['users_code'],"%/%/%",1);
}

//fields_arr
$fields_arr = array(
'users_code'=>	$global->csv->users->users_lang['form_label_users_lang']['users_code'],
'users_name'=>	$global->csv->users->users_lang['form_label_users_lang']['users_name'],
'receivable_balance'=>	$global->csv->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['receivable_balance'],
);

//get out
$out=$global->csv_generate($fields_arr,$users_search_list);

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