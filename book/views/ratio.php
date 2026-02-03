            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                    <h1>Rasio Keuangan</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="#"><i class="fa fa-print"></i> <? echo $form_header_lang['print']; ?></a></li>
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
                             <h2><? echo $global->book->book_lang['form_header_book_lang']['ratio']; ?></h2>
                             <h3><? echo $company['company_name']; ?></h3>
                             <h4><? echo $form_header_lang['period']; ?>: 01/01/<? echo"$year"; ?> -<? echo"$days_num"; ?>/<? echo"$month"; ?>/<? echo"$year"; ?></h4>
                             </div>
                             
                             <div><strong>PERMODALAN :</strong></div>
                             <ol>
                               <li><div>Rasio Modal Sendiri thd Total Assets</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>Modal Sendiri</strong></div>
                                       <div align="center"><strong>Total Assets</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($balance_capital); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_activa); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($capital_to_asset); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                               <li><div>Rasio Modal Sendiri thd Pinjaman diberikan yang Beresiko</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>Modal Sendiri</strong></div>
                                       <div align="center"><strong>Pinjaman diberikan yang Beresiko</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($balance_capital); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_loan_risk); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($capital_to_loan_risk); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                               <li><div>Rasio Kecukupan Modal Sendiri (CAR)</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>Modal Sendiri</strong></div>
                                       <div align="center"><strong>ATMR</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($balance_capital); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($amtr); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($capital_to_amtr); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                             </ol>
                             
                             <div><strong>LIKUIDITAS :</strong></div>
                             <ol>
                               <li><div>Rasio Kas</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>Kas + Bank</strong></div>
                                       <div align="center"><strong>Kewajiban Lancar</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($balance_cash_bank); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_payable); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($cashbank_to_payable); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                               <li><div>Rasio Pinjaman Yg Diberikan thd dana yg diterima</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>Pinjaman Yg Diberikan</strong></div>
                                       <div align="center"><strong>Dana Yang Diterima</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($balance_loan_total); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_equity); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($loan_to_equity); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                             </ol>
                             
                             <div><strong>RENTABILITAS / PROFITABILITAS  :</strong></div>
                             <ol>
                               <li><div>Rentabilitas Assets (ROI)</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>SHU</strong></div>
                                       <div align="center"><strong>Total Assets</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($dividen_net); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_activa); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($dividen_to_asset); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                               <li><div>Rentabilitas Modal Sendiri</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>SHU Bagian Anggota</strong></div>
                                       <div align="center"><strong>Total Modal Sendiri</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($dividen_member); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_capital); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($dividen_member_to_capital); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                               <li><div>Profit Margin</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>SHU</strong></div>
                                       <div align="center"><strong>Total Pendapatan</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($dividen_net); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_profit); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($dividen_to_profit); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                             </ol>
                             
                             <div><strong>PERTUMBUHAN :</strong></div>
                             <ol>
                               <li><div>Assets</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>Assets Th ini - Assets Th Lalu</strong></div>
                                       <div align="center"><strong>Assets Th Lalu</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($balance_activa); ?> - <? echo $global->num_format($balance_activa_prev); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_activa_prev); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($asset_to_asset_prev); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                               <li><div>Pendapatan</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>Pend.Th.ini - Pend. Th. Lalu</strong></div>
                                       <div align="center"><strong>Pend. Th. Lalu</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($balance_profit); ?> - <? echo $global->num_format($balance_profit_prev); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($balance_profit_prev); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($profit_to_profit_prev); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                               <li><div>Selisih Hasil Usaha</div>
                               <div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong>SHU Th.ini - SHU Th. Lalu</strong></div>
                                       <div align="center"><strong>SHU Th. lalu</strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-4">
                                       <div style="border-bottom:1px solid #CCC; width:100%;" align="center"><strong><? echo $global->num_format($dividen_net); ?> - <? echo $global->num_format($dividen_net_prev); ?></strong></div>
                                       <div align="center"><strong><? echo $global->num_format($dividen_net_prev); ?></strong></div>
                                   </div>
                                   <div class="col-md-1"><strong>x 100</strong></div>
                                   <div class="col-md-2"><strong>= <? echo $global->num_format($dividen_to_dividen_prev); ?> %</strong></div>
                               </div>
                               <div class="clear">&nbsp;</div>
                               </li>
                               
                             </ol>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>

            </section><!-- /.content -->          
            </aside><!-- /.right-side -->