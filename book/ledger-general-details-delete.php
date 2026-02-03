<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? $parent_active="book"; ?>
<? $page_active="book/ledger-general"; ?>
<? include ("../controller/login-sessi.php"); ?>
<?
$ledgerdetails_id=$_REQUEST['id'];
$ledger_id=$global->book->db_fldrow("ledgerdetails","ledger_id","ledgerdetails_id='".$ledgerdetails_id."'");
$global->book->db_delete("ledgerdetails","ledgerdetails_id='".$ledgerdetails_id."'");
$total_debit=$global->book->db_row("ledgerdetails","SUM(ledgerdetails_amount) AS ledgerdetails_amount","ledger_id='".$ledger_id."' AND ledgerdetails_type ='D' GROUP BY ledger_id");
$total_credit=$global->book->db_row("ledgerdetails","SUM(ledgerdetails_amount) AS ledgerdetails_amount","ledger_id='".$ledger_id."' AND ledgerdetails_type ='K' GROUP BY ledger_id");
echo $site_lang['currency'].$global->book->num_format($total_debit['ledgerdetails_amount']).";".$site_lang['currency'].$global->book->num_format($total_credit['ledgerdetails_amount']);
?>