            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Arus Kas</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="ledger-general.php">Jurnal umum</a></li>
                        <li class="active">Arus Kas</li>
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
                            <div class="box">
                                <div class="box-header">                                                                      
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <div id="header-top">
                                <div class="row clearfix">
                                <div class="col-md-10">
                                <form method="post" name="form" action="cash-flow.php" enctype="multipart/form-data">
                                <div class="page">From: </div>
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['cash_flow_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['cash_flow_drange2_sessi']; ?>" />
                                  <button name="Submit" id="Submit" class="btn btn-primary"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></form>
                  </div>
                  <div class="col-md-2 last">&nbsp;</div>
                  </div>
                  </div>
                <div>&nbsp;</div>
<table class="table" id="table1">
                      <tr>
                          <th width="59%"><strong>Keterangan</strong></th>
                          <th width="20%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_type']; ?></strong></th>
                          <th width="21%"><strong><? echo $global->book->book_lang['form_label_book_lang']['credit_ledger']; ?></strong></th>
                      </tr>
                  <tbody>
                  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                  <tr>
                        <td><strong>Arus Kas Operational</strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <? 
			//operational
			$total_debit_opt=0;
			$total_kredit_opt=0;
			for($i=0;$i<count($operational_list);$i++){
			$taxonomi_name=$operational_list[$i]['taxonomi_name'];
			$taxonomi_amount_d=0;
			$taxonomi_amount_k=0;
			
			//non cash in out compare couple
			if($operational_list[$i]['taxonomi_postable']==1){
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk_special($operational_list[$i]['taxonomi_code'],$date_range_match,$couple=1);
			}else{
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk($operational_list[$i]['taxonomi_id'],$date_range_match,$couple=1);
			}
			$taxonomi_amount_d +=$cash_flow_amount_dk_arr['taxonomi_amount_d'];
			$taxonomi_amount_k +=$cash_flow_amount_dk_arr['taxonomi_amount_k'];
			
			//cash in out tidak perlu filter
			if($operational_list[$i]['taxonomi_postable']==1){
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk_special($operational_list[$i]['taxonomi_code'],$date_range_match,$couple=0);
			}else{
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk($operational_list[$i]['taxonomi_id'],$date_range_match,$couple=0);
			}
			$taxonomi_amount_d +=$cash_flow_amount_dk_arr['taxonomi_amount_d'];
			$taxonomi_amount_k +=$cash_flow_amount_dk_arr['taxonomi_amount_k'];

			//total
			$total_debit_opt +=$taxonomi_amount_d;
			$total_kredit_opt +=$taxonomi_amount_k;
			$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			?>
                    <tr>
                        <td><? echo $operational_list[$i]['taxonomi_name']; ?></td>
                        <td><? echo $site_lang['currency'].$global->num_format($taxonomi_amount_d); ?></td>
                        <td><? echo $site_lang['currency'].$global->num_format($taxonomi_amount_k); ?></td>
                    </tr>
					<?
				$inc++;
	}
	$global->balance_zero($total_kredit_opt,$total_debit_opt);
			?>
                    <tr>
                      <td><strong>Saldo Kas Operational:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_debit_opt); ?></strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_kredit_opt); ?></strong></td>
                    </tr>
                    
                  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                  <tr>
                        <td><strong>Arus Kas Investasi</strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                  
                    <? 
			//invest
			$total_debit_ivt=0;
			$total_kredit_ivt=0;
			for($i=0;$i<count($invest_list);$i++){
			$taxonomi_name=$invest_list[$i]['taxonomi_name'];
			$taxonomi_amount_d=0;
			$taxonomi_amount_k=0;
			
			//non cash in out compare couple
			if($invest_list[$i]['taxonomi_postable']==1){
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk_special($invest_list[$i]['taxonomi_code'],$date_range_match,$couple=1);
			}else{
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk($invest_list[$i]['taxonomi_id'],$date_range_match,$couple=1);
			}
			$taxonomi_amount_d +=$cash_flow_amount_dk_arr['taxonomi_amount_d'];
			$taxonomi_amount_k +=$cash_flow_amount_dk_arr['taxonomi_amount_k'];
			
			//cash in out tidak perlu filter
			if($invest_list[$i]['taxonomi_postable']==1){
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk_special($invest_list[$i]['taxonomi_code'],$date_range_match,$couple=0);
			}else{
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk($invest_list[$i]['taxonomi_id'],$date_range_match,$couple=0);
			}
			$taxonomi_amount_d +=$cash_flow_amount_dk_arr['taxonomi_amount_d'];
			$taxonomi_amount_k +=$cash_flow_amount_dk_arr['taxonomi_amount_k'];

			//total
			$total_debit_ivt +=$taxonomi_amount_d;
			$total_kredit_ivt +=$taxonomi_amount_k;
			$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			?>
                    <tr>
                        <td><? echo $invest_list[$i]['taxonomi_name']; ?></td>
                        <td><? echo $site_lang['currency'].$global->num_format($taxonomi_amount_d); ?></td>
                        <td><? echo $site_lang['currency'].$global->num_format($taxonomi_amount_k); ?></td>
                    </tr>
					<?
				$inc++;
	}
	$global->balance_zero($total_kredit_ivt,$total_debit_ivt);
			?>
                    <tr>
                      <td><strong>Saldo Kas Investasi:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_debit_ivt); ?></strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_kredit_ivt); ?></strong></td>
                    </tr>
                
                  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                  <tr>
                        <td><strong>Arus Kas Pendanaan</strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <? 
			//capital
			$total_debit_cpt=0;
			$total_kredit_cpt=0;
			for($i=0;$i<count($capital_list);$i++){
			$taxonomi_name=$capital_list[$i]['taxonomi_name'];
			$taxonomi_amount_d=0;
			$taxonomi_amount_k=0;
			
			//non cash in out compare couple
			if($capital_list[$i]['taxonomi_postable']==1){
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk_special($capital_list[$i]['taxonomi_code'],$date_range_match,$couple=1);
			}else{
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk($capital_list[$i]['taxonomi_id'],$date_range_match,$couple=1);
			}
			$taxonomi_amount_d +=$cash_flow_amount_dk_arr['taxonomi_amount_d'];
			$taxonomi_amount_k +=$cash_flow_amount_dk_arr['taxonomi_amount_k'];
			
			//cash in out tidak perlu filter
			if($capital_list[$i]['taxonomi_postable']==1){
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk_special($capital_list[$i]['taxonomi_code'],$date_range_match,$couple=0);
			}else{
			$cash_flow_amount_dk_arr=$global->book->cash_flow_amount_dk($capital_list[$i]['taxonomi_id'],$date_range_match,$couple=0);
			}
			$taxonomi_amount_d +=$cash_flow_amount_dk_arr['taxonomi_amount_d'];
			$taxonomi_amount_k +=$cash_flow_amount_dk_arr['taxonomi_amount_k'];

			//total
			$total_debit_cpt +=$taxonomi_amount_d;
			$total_kredit_cpt +=$taxonomi_amount_k;
			$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			?>
                    <tr>
                        <td><? echo $capital_list[$i]['taxonomi_name']; ?></td>
                        <td><? echo $site_lang['currency'].$global->num_format($taxonomi_amount_d); ?></td>
                        <td><? echo $site_lang['currency'].$global->num_format($taxonomi_amount_k); ?></td>
                    </tr>
					<?
				$inc++;
	}
	$global->balance_zero($total_kredit_cpt,$total_debit_cpt);
			?>
                    <tr>
                      <td><strong>Saldo Kas Pendanaan:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_debit_cpt); ?></strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_kredit_cpt); ?></strong></td>
                    </tr>
                    
                  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?
					//total naik turun
					$total_kredit_cash=$total_kredit_opt+$total_kredit_ivt+$total_kredit_cpt;
					$total_debit_cash=$total_debit_opt+$total_debit_ivt+$total_debit_cpt;
					$global->balance_zero($total_kredit_cash,$total_debit_cash);
					//balance first
					$balance_first_arr=$global->book->balance_first($_SESSION['cash_flow_drange1_sessi'],"cash_bank");
					//echo $_SESSION['cash_flow_drange1_sessi'];
					$balance_first_debit=$balance_first_arr['balance_first_debit'];
					$balance_first_credit=$balance_first_arr['balance_first_credit'];
					if($balance_first_credit==0 && $balance_first_debit==0){
						//get first period
						$regextr_arr=$global->regextr($_SESSION['cash_flow_drange1_sessi']);
						$cash_first_period_arr=$global->book->cash_first_period_get($regextr_arr['year_registrasi']);
						$balance_first_debit=$cash_first_period_arr['taxonomi_amount_d'];
						$balance_first_credit=$cash_first_period_arr['taxonomi_amount_k'];
						}
					$global->balance_zero($balance_first_credit,$balance_first_debit);
					//total akhir periode
					$total_kredit_cash_end=$total_kredit_cash+$balance_first_credit;
					$total_debit_cash_end=$total_debit_cash+$balance_first_debit;
					$global->balance_zero($total_kredit_cash_end,$total_debit_cash_end);
					?>
                    <tr>
                      <td><strong>Kenaikan/Penurunan Kas & Bank:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_debit_cash); ?></strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_kredit_cash); ?></strong></td>
                    </tr>
                    <tr>
                      <td><strong>Kas & Bank Awal Periode:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($balance_first_debit); ?></strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($balance_first_credit); ?></strong></td>
                    </tr>
                    <tr>
                      <td><strong>Kas & Bank Akhir Periode:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_debit_cash_end); ?></strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_kredit_cash_end); ?></strong></td>
                    </tr>
                    
                  </tbody> 
                </table>
                                  
                                  
                               <div>&nbsp;</div>
                                  
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->