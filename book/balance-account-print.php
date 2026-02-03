<? $path="../"; ?>
<? include ("../controller/config-inc.php"); ?>
<? $parent_active="book"; ?>
<? $page_active="book/balance-account"; ?>
<? include ("../controller/login-sessi.php"); ?>
<? include ("controller/balance-account-inc.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><? echo $site_lang['app_name']; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<? echo $path; ?>templates/default/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<? echo $path; ?>templates/default/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<? echo $path; ?>templates/default/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<? echo $path; ?>templates/default/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<? echo $path; ?>templates/default/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />        
        <!-- Theme style -->
        <link href="<? echo $path; ?>templates/default/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Style -->
        <link href="<? echo $path; ?>templates/default/css/style.css" rel="stylesheet" type="text/css">
        <!-- Style New-->
        <link href="<? echo $path; ?>templates/default/css/style-new.css" rel="stylesheet" type="text/css">
        <!-- Datepicker -->
        <link href="<? echo $path; ?>templates/default/css/datepicker/jquery-ui.css" rel="stylesheet" type="text/css">        
        <!-- Ui totop -->
		<link href="<? echo $path; ?>templates/default/css/uitotop/ui.totop.css" rel="stylesheet" type="text/css">
        
		<script type="text/javascript" src="<? echo $path; ?>plugins/form.js"></script>
        <!-- Ui totop -->
		
		

    </head>
    <body onload="window.print();">
    
<? include ("../templates/default/separator.php"); ?>

<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">                                                                      
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">                                
<table id="example1" class="table table-bordered">
                  <thead>
                      <tr>
                          <th width="7%">#</th>
                          <th width="10%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_register']; ?></strong></th>
                          <th width="10%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_code']; ?></strong></th>
                          <th width="10%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_code']; ?></strong></th>
                          <th width="18%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?></strong></th>
                          <th width="22%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_description']; ?></strong></th>
                          <th width="11%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_type']; ?></strong></th>
                          <th width="12%"><strong><? echo $global->book->book_lang['form_label_book_lang']['credit_ledger']; ?></strong></th>
                      </tr>
                  </thead>
                  <tbody>
                    <? 
			for($i=0;$i<count($ledgerdetails_search_list);$i++){
			$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			//total saldo debit or kredit
			if($ledgerdetails_search_list[$i]['ledgerdetails_type']=="D"){
				$total_debit+=$ledgerdetails_search_list[$i]['ledgerdetails_amount'];
				}else{
				$total_kredit+=$ledgerdetails_search_list[$i]['ledgerdetails_amount'];
				}
			?>
                    <tr>
                      <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>
                      <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledgerdetails_search_list[$i]['ledger_register']; ?></td>
                      <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledgerdetails_search_list[$i]['ledger_code']; ?></td>
                      <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledgerdetails_search_list[$i]['taxonomi_code']; ?></td>
                      <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledgerdetails_search_list[$i]['taxonomi_name']; ?></td>
                      <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledgerdetails_search_list[$i]['ledger_description']; ?></td>
                      <td bgcolor="<? echo"$bg_color"; ?>"><? if($ledgerdetails_search_list[$i]['ledgerdetails_type']=="D"){?>
                <? echo $site_lang['currency'].$global->num_format($ledgerdetails_search_list[$i]['ledgerdetails_amount']); ?>
                <? } else {?>
              -
              <? }?></td>
                      <td bgcolor="<? echo"$bg_color"; ?>"><? if($ledgerdetails_search_list[$i]['ledgerdetails_type']=="K"){?>
                <? echo $site_lang['currency'].$global->num_format($ledgerdetails_search_list[$i]['ledgerdetails_amount']); ?>
                <? } else {?>
              -
              <? }?></td>
                    </tr>
                    <?
				$inc++;
			}
			$global->book->ledgerdetails_balance_sheet_dk($saldo_kas_debit,$saldo_kas_kredit,$total_debit,$total_kredit);
			?>
            		<tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><strong><? echo $form_header_lang['amount']; ?>:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_debit); ?></strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_kredit); ?></strong></td>
                    </tr>
                    <? 
			$month_first_exp=explode("/",$_SESSION['baccount_drange1_sessi']);
			$month_first=(int)$month_first_exp[1];
			if($month_first>1){
			$dmy_first=$global->book->mktime_next($_SESSION['baccount_drange1_sessi'],-1,0,0);
			$dmy_first=date("d/m/Y",$dmy_first);
			//echo $dmy_first;
			$balance_first=$global->book->balance_trial($_SESSION['baccount_search_sessi'],$dmy_first,"D");
			if($balance_first>=0){
				$balance_first_debit=$balance_first;
				$balance_first_credit=0;
			}else{
				$balance_first_debit=0;
				$balance_first_credit=abs($balance_first);
				}
			if($balance_first_debit>$balance_first_credit){
				$balance_first_debit=$balance_first_debit-$balance_first_credit;
				$balance_first_credit=0;
			}else{
				$balance_first_credit=$balance_first_credit-$balance_first_debit;
				$balance_first_debit=0;
				}
			$saldo_kas_debit +=$balance_first_debit;
			$saldo_kas_kredit +=$balance_first_credit;
			if($saldo_kas_debit>$saldo_kas_kredit){
				$saldo_kas_debit=$saldo_kas_debit-$saldo_kas_kredit;
				$saldo_kas_kredit=0;
			}else{
				$saldo_kas_kredit=$saldo_kas_kredit-$saldo_kas_debit;
				$saldo_kas_debit=0;
				}
					 ?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><strong><? echo $form_header_lang['balance_first']; ?>:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($balance_first_debit); ?> (D)</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($balance_first_credit); ?> (K)</strong></td>
                    </tr>
                    <? }?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><strong><u><? echo $form_header_lang['balance']; ?>:</u></strong></td>
                      <td><strong><u><? echo $site_lang['currency'].$global->num_format($saldo_kas_debit); ?> (D)</u></strong></td>
                      <td><strong><u><? echo $site_lang['currency'].$global->num_format($saldo_kas_kredit); ?> (K)</u></strong></td>
                    </tr>
                  </tbody> 
                </table>
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
                
<? include ("../templates/default/bottom-frame-noauto.php"); ?>
<script>
<? include ("../plugins/autocomplete.js"); ?>
</script>