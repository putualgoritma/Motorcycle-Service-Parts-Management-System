         <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side"> 
            <!-- Content Header (Page header) -->
             <section class="content-header">
                    <h1>Rugi Laba</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="pdf/profit-loss-report.php?year=<? echo"$year"; ?>&amp;month=<? echo"$month"; ?>" target="_new"><i class="fa fa-print"></i> <? echo $form_header_lang['print']; ?></a></li>
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
                             <h2><? echo $global->book->book_lang['form_label_book_lang']['profit_loss']; ?></h2>
                             <h3><? echo $company['company_name']; ?></h3>
                             <h4><? echo $form_header_lang['period']; ?>: 01/01/<? echo"$year"; ?> -<? echo"$days_num"; ?>/<? echo"$month"; ?>/<? echo"$year"; ?></h4>
                             </div>
                                <table class="table table-striped table-bordered gridView" id="table1">
                                <thead>
                                    <tr>
                                        <td width="7%" align="center"><strong><? echo $form_header_lang['briefing']; ?></strong></td>
                                        <td width="5%" align="center" nowrap="nowrap">Jan<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="7%" align="center" nowrap="nowrap">Feb<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="8%" align="center" nowrap="nowrap">Mar<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="6%" align="center" nowrap="nowrap">Apr<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="7%" align="center" nowrap="nowrap">May<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="8%" align="center" nowrap="nowrap">Jun<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="6%" align="center" nowrap="nowrap">Jul<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="7%" align="center" nowrap="nowrap">Aug<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="7%" align="center" nowrap="nowrap">Sep<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="8%" align="center" nowrap="nowrap">Oct<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="6%" align="center" nowrap="nowrap">Nov<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="6%" align="center" nowrap="nowrap">Dec<br>
(<? echo $site_lang['currency']; ?>)</td>
                                        <td width="12%" align="center"><strong><? echo $form_header_lang['amount']; ?></strong></td>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                <?
$global->book->profit_loss(4,$month_year,"K");
$array_month=array("01","02","03","04","05","06","07","08","09","10","11","12");
for($i=0;$i<12;$i++)
{
$balance_sheet_profit[$i]=0;
}
for($i=0;$i<(int)$month;$i++)
{
$month_year1="%/".$array_month[$i]."/".$year;
$balance_sheet_profit[$i]=$global->book->balance_total(4,$month_year1,"K");
}
$balance_profit_total=$global->book->balance_trial_total(4,$month_year,"K");
?>
                                    <tr>
                                        <td align="center"><strong><? echo $form_header_lang['amount']; ?></strong></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[0]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[1]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[2]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[3]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[4]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[5]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[6]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[7]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[8]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[9]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[10]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_sheet_profit[11]); ?></td>
                                        <td align="center"><? echo $global->num_format($balance_profit_total); ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <?
$global->book->profit_loss(5,$month_year,"D");
$array_month=array("01","02","03","04","05","06","07","08","09","10","11","12");
for($i=0;$i<12;$i++)
{
$balance_sheet_loss[$i]=0;
}
for($i=0;$i<(int)$month;$i++)
{
$month_year1="%/".$array_month[$i]."/".$year;
$balance_sheet_loss[$i]=$global->book->balance_total(5,$month_year1,"D");
}
$balance_loss_total=$global->book->balance_trial_total(5,$month_year,"D");
?>
                                    <tr>
                                      <td align="center"><? echo $form_header_lang['amount']; ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[0]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[1]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[2]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[3]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[4]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[5]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[6]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[7]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[8]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[9]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[10]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_sheet_loss[11]); ?></td>
                                      <td align="center"><? echo $global->num_format($balance_loss_total); ?></td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                    <?
for($i=0;$i<12;$i++)
{
$dividen_balance_sheet[$i]=$balance_sheet_profit[$i]-$balance_sheet_loss[$i];
}
$dividen_balance_total=$balance_profit_total-$balance_loss_total;
?>
                                    <tr>
                                      <td><strong><? echo $global->book->book_lang['form_label_book_lang']['dividen']; ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[0]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[1]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[2]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[3]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[4]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[5]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[6]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[7]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[8]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[9]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[10]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_sheet[11]); ?></strong></td>
                                      <td align="center"><strong><? echo $global->num_format($dividen_balance_total); ?></strong></td>

                                    </tr>
                                </tbody>
                            </table>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>

            </section><!-- /.content -->          
            </aside><!-- /.right-side -->