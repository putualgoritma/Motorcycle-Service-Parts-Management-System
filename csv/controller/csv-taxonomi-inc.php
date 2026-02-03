<?
/**
* Operation csv generate
*/
$file_name="rekening.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$sort_value="taxonomi_type ASC";
$pageset_value=0;
$per_page_value=0;
$month_year="%/%/".date("Y");

//query
$search_field_arr=array("taxonomi_code","taxonomi_name");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND taxonomi_postable='0'",
'join_id'=>""
);
$taxonomi_search_list=$global->tbl_search_list("taxonomi","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust
for($i=0;$i<count($taxonomi_search_list);$i++){
$sub_total_debit=0;
$sub_total_kredit=0;
$ledgerdetails_list=$global->tbl_list("ledgerdetails","*","taxonomi_id='".$taxonomi_search_list[$i]['taxonomi_id']."' AND ledgerdetails_register LIKE '%$month_year'","",1);
for($j=0;$j<count($ledgerdetails_list);$j++){
	if($ledgerdetails_list[$j]['ledgerdetails_type']=="D"){
		$sub_total_debit+=$ledgerdetails_list[$j]['ledgerdetails_amount'];
		}
	else{
		$sub_total_kredit+=$ledgerdetails_list[$j]['ledgerdetails_amount'];
		}
	}
//chek D/K
$global->csv->book->ledgerdetails_balance_sheet_dk($balance_sheet_debit,$balance_sheet_kredit,$sub_total_debit,$sub_total_kredit);
$taxonomi_search_list[$i]['taxonomi_balance_debit']=$balance_sheet_debit;
$taxonomi_search_list[$i]['taxonomi_balance_credit']=$balance_sheet_kredit;
}

//fields_arr
$fields_arr = array(
'taxonomi_code'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_code'],
'taxonomi_type'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_type'],
'taxonomi_name'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_name'],
'taxonomi_balance_debit'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_balance_debit'],
'taxonomi_balance_credit'=>	$global->csv->book->book_lang['form_label_book_lang']['taxonomi_balance_credit'],
);

//get out
$out=$global->csv_generate($fields_arr,$taxonomi_search_list);

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