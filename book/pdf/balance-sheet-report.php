<? $path="../../"; ?>
<? include ("../../controller/config-inc.php"); ?>
<? include ("../controller/balance-sheet-inc.php"); ?>
<?

//var

$var_pdf['year']=$year;

$var_pdf['month']=$month;

$var_pdf['month_year']=$month_year;

$var_pdf['days_num']=$days_num;



//label

$label_pdf['app_name']=$site_lang['app_name'];

$label_pdf['company_name']=$company['company_name'];
$label_pdf['company_address']=$company['company_address'];
$label_pdf['company_phone']=$company['company_phone'];

$label_pdf['book_balance_sheet']=$global->book->book_lang['form_header_book_lang']['book_balance_sheet'];

$label_pdf['period']=$form_header_lang['period'];

$label_pdf['taxonomi_asset']=$global->book->book_lang['form_label_book_lang']['taxonomi_asset'];

$label_pdf['balance']=$form_header_lang['balance'];

$label_pdf['currency']=$site_lang['currency'];

$label_pdf['amount']=$form_header_lang['amount'];

$label_pdf['taxonomi_passiva']=$global->book->book_lang['form_label_book_lang']['taxonomi_passiva'];

$label_pdf['dividen']=$global->book->book_lang['form_label_book_lang']['dividen'];

$label_pdf['current_period']=$global->book->book_lang['form_label_book_lang']['current_period'];

$label_pdf['ledgerdetails_total']=$global->book->book_lang['form_label_book_lang']['ledgerdetails_total'];

$label_pdf['taxonomi_asset']=$global->book->book_lang['form_label_book_lang']['taxonomi_asset'];

$label_pdf['ledgerdetails_total']=$global->book->book_lang['form_label_book_lang']['ledgerdetails_total'];



//var

$var_pdf['balance_sheet_1d']=$global->book->balance_sheet_acc(1,$month_year,"D");

$balance_activa=$global->book->balance_trial_total(1,$month_year,"D");



$var_pdf['balance_sheet_2k']=$global->book->balance_sheet_acc(2,$month_year,"K");

$balance_payable=$global->book->balance_trial_total(2,$month_year,"K");



$var_pdf['balance_sheet_3k']=$global->book->balance_sheet_acc(3,$month_year,"K");

$balance_equity=$global->book->balance_trial_total(3,$month_year,"K");

//hitung SHU

$balance_profit=$global->book->balance_trial_total(4,$month_year,"K");

$balance_loss=$global->book->balance_trial_total(5,$month_year,"D");

$dividen_net=$balance_profit-$balance_loss;

$dividen=$dividen_net;

//Passiva

$saldo_passiva=$balance_equity + $balance_payable + $dividen_net;

$var_pdf['balance_activa']=$global->num_format($balance_activa);

$var_pdf['balance_payable']=$global->num_format($balance_payable);

$var_pdf['dividen']=$global->num_format($dividen);

$var_pdf['dividen_net']=$global->num_format($dividen_net);

$var_pdf['saldo_passiva']=$global->num_format($saldo_passiva);

	

$_SESSION['var_pdf_sessi']=$var_pdf;

$_SESSION['label_pdf_sessi']=$label_pdf;



Header("location: balance-sheet-pdf.php");

exit;

?>