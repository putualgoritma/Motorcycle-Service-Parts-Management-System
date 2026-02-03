<? $path="../../"; ?>
<? include ("../../controller/config-inc.php"); ?>
<? include ("../controller/cash-inc.php"); ?>
<?
//var
$var_pdf['month']=date("m");
$var_pdf['year']=date("Y");
$var_pdf['currency']=$site_lang['currency'];
$var_pdf['date_range1_value']=$_SESSION['cash_drange1_sessi'];;
$var_pdf['date_range2_value']=$_SESSION['cash_drange2_sessi'];;

//label
$label_pdf['app_name']=$site_lang['app_name'];
$label_pdf['company_name']=strtoupper($company['company_name']);
$label_pdf['company_address']=$company['company_address'];
$label_pdf['company_phone']=$company['company_phone'];
$label_pdf['company_license']=$company['company_license'];
$label_pdf['period']=$form_header_lang['period'];
$label_pdf['label_ledger_register']=$global->book->book_lang['form_label_book_lang']['ledger_register'];
$label_pdf['label_ledger_code']=$global->book->book_lang['form_label_book_lang']['ledger_code'];
$label_pdf['label_ledger_description']=$global->book->book_lang['form_label_book_lang']['ledger_description'];
$label_pdf['label_taxonomi_name']=$global->book->book_lang['form_label_book_lang']['taxonomi_name'];
$label_pdf['label_taxonomi_code']=$global->book->book_lang['form_label_book_lang']['taxonomi_code'];
$label_pdf['label_amount']=$form_header_lang['amount'];
$label_pdf['label_ledger_type']=$global->book->book_lang['form_label_book_lang']['ledger_type'];
$label_pdf['label_credit_ledger']=$global->book->book_lang['form_label_book_lang']['credit_ledger'];

//list
for($i=0;$i<count($ledger_search_list);$i++){
$ledgerdetails_list[$i]=$global->tbl_list("ledgerdetails,taxonomi","ledgerdetails.*,taxonomi.taxonomi_code,taxonomi.taxonomi_name","ledger_id='".$ledger_search_list[$i]['ledger_id']."' AND ledgerdetails.taxonomi_id = taxonomi.taxonomi_id","",1);
for($j=0;$j<count($ledgerdetails_list[$i]);$j++){
$ledgerdetails_list[$i][$j]['ledgerdetails_amount_org']=$ledgerdetails_list[$i][$j]['ledgerdetails_amount'];
$ledgerdetails_list[$i][$j]['ledgerdetails_amount']=$site_lang['currency'].$global->book->num_format($ledgerdetails_list[$i][$j]['ledgerdetails_amount']);
}}

$_SESSION['var_pdf_sessi']=$var_pdf;
$_SESSION['label_pdf_sessi']=$label_pdf;
$_SESSION['list_pdf_sessi']=$ledger_search_list;
$_SESSION['list_pdf_sessi2']=$ledgerdetails_list;

//print_r($ledger_search_list);
Header("location: cash-pdf-all.php");
exit;
?>