<? $path="../../"; ?>
<? include ("../../controller/config-inc.php"); ?>
<? include ("../controller/cash-inc.php"); ?>
<?
//var
$var_pdf['month']=date("m");
$var_pdf['year']=date("Y");
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
//list
for($i=0;$i<count($ledger_search_list);$i++){
$var_pdf['ledger_code']=$ledger_search_list[$i]['ledger_code'];
$var_pdf['ledger_description']=$ledger_search_list[$i]['ledger_description'];
$var_pdf['ledger_register']=$ledger_search_list[$i]['ledger_register'];
$ledgerdetails_list=$global->tbl_list("ledgerdetails,taxonomi","ledgerdetails.*,taxonomi.taxonomi_code,taxonomi.taxonomi_name","ledger_id='".$ledger_search_list[$i]['ledger_id']."' AND ledgerdetails.taxonomi_id = taxonomi.taxonomi_id","",1);
for($j=0;$j<count($ledgerdetails_list);$j++){
$ledgerdetails_list[$j]['ledgerdetails_amount']=$site_lang['currency'].$global->book->num_format($ledgerdetails_list[$j]['ledgerdetails_amount']);
}}

$_SESSION['var_pdf_sessi']=$var_pdf;
$_SESSION['label_pdf_sessi']=$label_pdf;
$_SESSION['list_pdf_sessi']=$ledgerdetails_list;

//print_r($ledgerdetails_list);
Header("location: cash-pdf.php");
exit;
?>