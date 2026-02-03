<?
//$ledger_search_list=$global->tbl_search_list("ledger","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
$ledger_search_list=array();
$j=0;
$db_select = $global->db_select("ledgerdetails","*","","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++)
{
$ledgerdetails_id=$select_data[$i]['ledgerdetails_id'];
$ledger_id=$select_data[$i]['ledger_id'];
$taxonomi_id=$select_data[$i]['taxonomi_id'];
if($global->tbldata_exist("taxonomi","taxonomi_id","taxonomi_id='".$taxonomi_id."'")){
	}else{
	$ledger_row=$global->book->db_row("ledger","*","ledger_id='".$ledger_id."'");
	$ledger_search_list[$j]['ledger_id']=$ledger_id;
	$ledger_search_list[$j]['ledger_register']=$ledger_row['ledger_register'];
	$ledger_search_list[$j]['ledger_code']=$ledger_row['ledger_code'];
	$ledger_search_list[$j]['ledger_description']=$ledger_row['ledger_description'];
	$j++;
	}
}


//next prev
if($per_page_value<=0){
$total_page=1;
$current_page=1;
}else{
$total_page=ceil($select_num/$per_page_value);
$current_page=($pageset_value/$per_page_value)+1;
}
$pageset_prev=$pageset_value-$per_page_value;
$pageset_next=$pageset_value+$per_page_value;
$pageset_last=($total_page-1) * $per_page_value;

//additional init
$inc=1+$pageset_value;
$total_debit=0;
$total_kredit=0;

?>