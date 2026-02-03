<? $path="../../"; ?>
<? include ("../../controller/config-inc.php"); ?>
<? include ("../controller/profit-loss-inc.php"); ?>
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

$label_pdf['profit_loss']=$global->book->book_lang['form_label_book_lang']['profit_loss'];

$label_pdf['period']=$form_header_lang['period'];

$label_pdf['briefing']=$form_header_lang['briefing'];

$label_pdf['amount']=$form_header_lang['amount'];

$label_pdf['dividen']=$global->book->book_lang['form_label_book_lang']['dividen'];



//list

$var_pdf['profit']=$global->book->profit_loss_acc(4,$month_year,"K");

$array_month=array("01","02","03","04","05","06","07","08","09","10","11","12");

for($i=0;$i<12;$i++){

$balance_sheet_profit[$i]=0;

}

for($i=0;$i<(int)$month;$i++){

$month_year1="%/".$array_month[$i]."/".$year;

$balance_sheet_profit[$i]=$global->book->balance_total(4,$month_year1,"K");

}

$balance_profit_total=$global->book->balance_trial_total(4,$month_year,"K");

$var_pdf['balance_profit_total']=number_format($balance_profit_total,2,'.',',');



$var_pdf['loss']=$global->book->profit_loss_acc(5,$month_year,"D");

$array_month=array("01","02","03","04","05","06","07","08","09","10","11","12");

for($i=0;$i<12;$i++){

$balance_sheet_loss[$i]=0;

}

for($i=0;$i<(int)$month;$i++){

$month_year1="%/".$array_month[$i]."/".$year;

$balance_sheet_loss[$i]=$global->book->balance_total(5,$month_year1,"D");

}

$balance_loss_total=$global->book->balance_trial_total(5,$month_year,"D");

$var_pdf['balance_loss_total']=number_format($balance_loss_total,2,'.',',');



$var_pdf['dividen_balance_total']=number_format(($balance_profit_total-$balance_loss_total),2,'.',',');



$_SESSION['var_pdf_sessi']=$var_pdf;

$_SESSION['label_pdf_sessi']=$label_pdf;

$_SESSION['list_pdf_sessi']=$balance_sheet_profit;

$_SESSION['list_pdf2_sessi']=$balance_sheet_loss;



Header("location: profit-loss-pdf.php");

exit;

?>