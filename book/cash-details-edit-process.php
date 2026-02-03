<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? $parent_active="cassa"; ?>
<? $page_active="cassa/cash"; ?>
<? include ("../controller/login-sessi.php"); ?>
<?
//form handling
//get taxonomi id
$taxonomi_code_arr=explode(" - ",$_REQUEST['taxonomi_code']);
$taxonomi_id=$global->book->db_fldrow("taxonomi","taxonomi_id","taxonomi_code='".$taxonomi_code_arr[0]."'");
if($taxonomi_id>0){
$taxonomi_id=$taxonomi_id;
$ledgerdetails_id=$_REQUEST['ledgerdetails_id'];
$ledger_id=$_REQUEST['ledger_id'];
$ledgerdetails_type=$_REQUEST['ledgerdetails_type'];
$ledgerdetails_amount=$_REQUEST['ledgerdetails_amount'];
//end form handling

//insert items

$update_arr = array(
'taxonomi_id'=>	$taxonomi_id,
'ledgerdetails_type'=>	$ledgerdetails_type,
'ledgerdetails_amount'=>	$ledgerdetails_amount,
);
$global->book->db_update("ledgerdetails",$update_arr,"ledgerdetails_id='".$ledgerdetails_id."'");
$ledgerdetails_row=$global->book->db_row_join("ledgerdetails,taxonomi","ledgerdetails.*,taxonomi.taxonomi_code,taxonomi.taxonomi_name","ledgerdetails_id='".$ledgerdetails_id."' AND ledgerdetails.taxonomi_id = taxonomi.taxonomi_id");
//get balance
$total_debit=$global->book->db_row("ledgerdetails","SUM(ledgerdetails_amount) AS ledgerdetails_amount","ledger_id='".$ledger_id."' AND ledgerdetails_type ='D' GROUP BY ledger_id");
$total_credit=$global->book->db_row("ledgerdetails","SUM(ledgerdetails_amount) AS ledgerdetails_amount","ledger_id='".$ledger_id."' AND ledgerdetails_type ='K' GROUP BY ledger_id");

echo $ledgerdetails_row['ledgerdetails_id'].";".$ledgerdetails_row['taxonomi_name'].";".$ledgerdetails_row['taxonomi_code'].";".$ledgerdetails_row['ledgerdetails_type'].";".$site_lang['currency'].$global->book->num_format($ledgerdetails_row['ledgerdetails_amount']).";".$site_lang['currency'].$global->book->num_format($total_debit['ledgerdetails_amount']).";".$site_lang['currency'].$global->book->num_format($total_credit['ledgerdetails_amount']).";".$ledgerdetails_row['ledgerdetails_amount'].";".$ledger_id;
}
?>