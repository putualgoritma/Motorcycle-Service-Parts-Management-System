<?
$year=$_REQUEST['year'];
$month=$_REQUEST['month'];
if($month=="%")
	{
	$month="12";
	}
$month_year="%/".$month."/".$year;
$days_num = cal_days_in_month(CAL_GREGORIAN, (int)$month, $year) ;
//activa
$balance_activa=$global->book->balance_trial_total(1,$month_year,"D");
//cash bank
$balance_cash_bank=$global->book->balance_trial_total_special("cash_bank",$month_year,"D");
//loan
$balance_loan=$global->book->balance_trial_special("loan",$month_year,"D");
$balance_loan_risk=$global->book->balance_trial_special("loan_risk",$month_year,"D");
$balance_loan_total=$balance_loan+$balance_loan_risk;
//payable
$balance_payable=$global->book->balance_trial_total(2,$month_year,"K");
//equity
$balance_capital=$global->book->balance_trial_total_special("capital",$month_year,"K");
$balance_capital_loan=$global->book->balance_trial_total_special("capital_loan",$month_year,"K");
$balance_equity=$balance_capital+$balance_capital_loan;
//hitung SHU
$balance_profit=$global->book->balance_trial_total(4,$month_year,"K");
$balance_loss=$global->book->balance_trial_total(5,$month_year,"D");
$dividen_net=$balance_profit-$balance_loss;
//get allocation
$db_select =$global->db_select("taxonomi,dividen_percen","taxonomi.taxonomi_id,taxonomi.taxonomy_special_type,dividen_percen.dividen_percen_percen","taxonomi.taxonomi_id=dividen_percen.taxonomi_id","",0,0);
$select_data=$db_select['select_data'];
for($i=0;$i<$db_select['select_num'];$i++){
	if($select_data[$i]['taxonomy_special_type']=="dividen_capital"){
	 	$dividen_capital=($select_data[$i]['dividen_percen_percen']/100)*$dividen_net;
		}
	if($select_data[$i]['taxonomy_special_type']=="dividen_loan"){
	 	$dividen_loan=($select_data[$i]['dividen_percen_percen']/100)*$dividen_net;
		}
	}
$dividen_member=$dividen_capital+$dividen_loan;
//capital ratio
$capital_to_asset=($balance_capital/$balance_activa)*100;
$capital_to_loan_risk=($balance_capital/$balance_loan_risk)*100;
$amtr_loan=$balance_loan*0.7;
$amtr_loan_risk=$balance_loan_risk*1;
$amtr=$amtr_loan+$amtr_loan_risk;
$capital_to_amtr=($balance_capital/$amtr)*100;
//liquid
$cashbank_to_payable=($balance_cash_bank/$balance_payable)*100;
$loan_to_equity=($balance_loan_total/$balance_equity)*100;
//profitabilitas
$dividen_to_asset=($dividen_net/$balance_activa)*100;
$dividen_member_to_capital=($dividen_member/$balance_capital)*100;
$dividen_to_profit=($dividen_net/$balance_profit)*100;
//previous
$year_prev=$year-1;
$month_year_prev="%/".$month."/".$year_prev;
//activa previous
$balance_activa_prev=$global->book->balance_trial_total(1,$month_year_prev,"D");
$asset_to_asset_prev=100;
if($balance_activa_prev>0){
$asset_to_asset_prev=(($balance_activa-$balance_activa_prev)/$balance_activa_prev)*100;
}
//profit previous
$balance_profit_prev=$global->book->balance_trial_total(4,$month_year_prev,"K");
$profit_to_profit_prev=100;
if($balance_profit_prev>0){
$profit_to_profit_prev=(($balance_profit-$balance_profit_prev)/$balance_profit_prev)*100;
}
//dividen previous
$balance_loss_prev=$global->book->balance_trial_total(5,$month_year_prev,"D");
$dividen_net_prev=$balance_profit_prev-$balance_loss_prev;
$dividen_to_dividen_prev=100;
if($dividen_net_prev>0){
$dividen_to_dividen_prev=(($dividen_net-$dividen_net_prev)/$dividen_net_prev)*100;
}
?>