            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                    <h1> 	Neraca Keuangan</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="pdf/balance-sheet-report.php?year=<? echo"$year"; ?>&amp;month=<? echo"$month"; ?>" target="_new"><i class="fa fa-print"></i> <? echo $form_header_lang['print']; ?></a></li>
                    </ol>
                </section>
                
                <? if(isset($_REQUEST['confirm'])){?><div>&nbsp;</div><div class="alert alert-info alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-warning"></i> <? echo $form_header_lang['notice']; ?></h4>
      <p><strong><? echo $form_header_lang['confirm_state1']; ?><? echo $_REQUEST['confirm']; ?><? echo $form_header_lang['confirm_state2']; ?></strong></p>
    </div><? }?>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-danger">
                            <div class="box-header">                                                                      
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                             <div class="page-keuangan">
                             <h2><? echo $global->book->book_lang['form_header_book_lang']['book_balance_sheet']; ?></h2>
                             <h3><? echo $company['company_name']; ?></h3>
                             <h4><? echo $form_header_lang['period']; ?>: 01/01/<? echo"$year"; ?> -<? echo"$days_num"; ?>/<? echo"$month"; ?>/<? echo"$year"; ?></h4>
                             </div>
                                <table width="100%" cellpadding="0" cellspacing="0" class="">
                                <thead>
                                    <tr>
                                        <td width="32%" align="center"></td>
                                      <td width="36%" align="center"></td>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    <tr>
                                      <td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" class="table-bordered">
                                        <tr>
                                          <td width="62%" align="center"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_asset']; ?></strong></td>
                                          <td width="38%" align="center"><strong><? echo $form_header_lang['balance']; ?><br>
(<? echo $site_lang['currency']; ?>)</strong></td>
                                        </tr>
                                        <?
	$global->book->balance_sheet(1,$month_year,"D");
	$balance_activa=$global->book->balance_trial_total(1,$month_year,"D");
	?>
                                      </table></td>
                                      <td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" class="table-bordered">
<tr>
<td width="73%" align="center"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_passiva']; ?></strong></td>
<td width="27%" align="center"><strong><? echo $form_header_lang['balance']; ?><br>
(<? echo $site_lang['currency']; ?>)</strong></td>
</tr>
<?
	$global->book->balance_sheet(2,$month_year,"K");
	$balance_payable=$global->book->balance_trial_total(2,$month_year,"K");
	?>
<tr>
  <td bgcolor="#FFFFFF">&nbsp;</td>
  <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<?
	$global->book->balance_sheet(3,$month_year,"K");
	$balance_equity=$global->book->balance_trial_total(3,$month_year,"K");
	//hitung SHU
	$balance_profit=$global->book->balance_trial_total(4,$month_year,"K");
	$balance_loss=$global->book->balance_trial_total(5,$month_year,"D");
	$dividen_net=$balance_profit-$balance_loss;
	$dividen=$dividen_net;
	//Passiva
	$saldo_passiva=$balance_equity + $balance_payable + $dividen_net;
	?>
<tr>
  <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
  <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><strong><u><? echo $global->book->book_lang['form_label_book_lang']['dividen']; ?> <? echo $global->book->book_lang['form_label_book_lang']['current_period']; ?></u></strong></td>
<td align="center" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<tr>
  <td bgcolor="#FFFFFF">1. <? echo $global->book->book_lang['form_label_book_lang']['dividen']; ?></td>
  <td align="center" bgcolor="#FFFFFF"><? echo $global->num_format($dividen); ?></td>
</tr>
<tr>
<td align="center" bgcolor="#FFFFFF">&nbsp;</td>
<td align="center" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<tr>
<td align="center" bgcolor="#FFFFFF"><strong><? echo $form_header_lang['profit_balance']; ?></strong></td>
<td align="center" bgcolor="#FFFFFF"><? echo $global->num_format($dividen_net); ?></td>
</tr>
</table></td>
                                    </tr>
                                    <tr>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="3" class="table-bordered">
                                        <tr>
                                          <td width="62%" align="center"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledgerdetails_total']; ?> <? echo $global->book->book_lang['form_label_book_lang']['taxonomi_asset']; ?></strong></td>
                                          <td width="38%" align="center"><strong><? echo $global->num_format($balance_activa); ?></strong></td>
                                        </tr>
                                      </table></td>
                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="3" class="table-bordered">
                                        <tr>
                                          <td width="73%" align="center"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledgerdetails_total']; ?> <? echo $global->book->book_lang['form_label_book_lang']['taxonomi_passiva']; ?></strong></td>
                                          <td width="27%" align="center"><strong><? echo $global->num_format($saldo_passiva); ?></strong></td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                  </tbody>
                            </table>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>

            </section><!-- /.content -->          
            </aside><!-- /.right-side -->