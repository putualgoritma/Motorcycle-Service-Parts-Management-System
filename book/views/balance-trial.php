            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Neraca Saldo</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>">Keuangan</a></li>
                        <li class="active">Neraca Saldo</li>
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
                                <form method="post" name="form" action="balance-trial.php" enctype="multipart/form-data">
                                <div class="page">From: </div>
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['btrial_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['btrial_drange2_sessi']; ?>" />
                                  <button name="Submit" id="Submit" class="btn btn-primary"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></form>
                  </div>
                  <div class="col-md-2 last">&nbsp;</div>
                  </div>
                  </div>
                <div>&nbsp;</div>
<table class="table table-bordered table-hover gridView" id="table1">
                  <thead>
                      <tr>
                          <th width="4%">#</th>
                          <th width="17%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_code']; ?></strong></th>
                          <th width="38%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?></strong></th>
                          <th width="20%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_type']; ?></strong></th>
                          <th width="21%"><strong><? echo $global->book->book_lang['form_label_book_lang']['credit_ledger']; ?></strong></th>
                      </tr>
                  </thead>
                  <tbody>
                    <? 
			for($i=0;$i<count($taxonomi_search_list);$i++){
			$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			//init
			$sub_total_debit=0;
			$sub_total_kredit=0;
			//date range match
			$date_range_match="(ledgerdetails_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";
			$ledgerdetails_list=$global->tbl_list("ledgerdetails","*","taxonomi_id='".$taxonomi_search_list[$i]['taxonomi_id']."' AND ".$date_range_match,"",1);
			for($j=0;$j<count($ledgerdetails_list);$j++){
				if($ledgerdetails_list[$j]['ledgerdetails_type']=="D"){
					$sub_total_debit+=$ledgerdetails_list[$j]['ledgerdetails_amount'];
					}
				else{
					$sub_total_kredit+=$ledgerdetails_list[$j]['ledgerdetails_amount'];
					}
				}
			//chek D/K
			$global->book->ledgerdetails_balance_sheet_dk($balance_sheet_debit,$balance_sheet_kredit,$sub_total_debit,$sub_total_kredit);
			//total
			$total_debit +=$balance_sheet_debit;
			$total_kredit +=$balance_sheet_kredit;
			?>
                    <tr>
                        <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>
                        <td bgcolor="<? echo"$bg_color"; ?>"><a href="balance-account.php?search=<? echo $taxonomi_search_list[$i]['taxonomi_id']; ?>" class="link_table"><? echo $taxonomi_search_list[$i]['taxonomi_code']; ?></a></td>
                        <td bgcolor="<? echo"$bg_color"; ?>"><a href="balance-account.php?search=<? echo $taxonomi_search_list[$i]['taxonomi_id']; ?>" class="link_table"><? echo $taxonomi_search_list[$i]['taxonomi_name']; ?></a></td>
                        <td bgcolor="<? echo"$bg_color"; ?>"><a href="balance-account.php?search=<? echo $taxonomi_search_list[$i]['taxonomi_id']; ?>" class="link_table"><? echo $site_lang['currency'].$global->num_format($balance_sheet_debit); ?></a></td>
                        <td bgcolor="<? echo"$bg_color"; ?>"><a href="balance-account.php?search=<? echo $taxonomi_search_list[$i]['taxonomi_id']; ?>" class="link_table"><? echo $site_lang['currency'].$global->num_format($balance_sheet_kredit); ?></a></td>
                    </tr>
					<?
				$inc++;
			}
			?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td align="right"><strong><? echo $form_header_lang['amount']; ?>:</strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_debit); ?></strong></td>
                      <td><strong><? echo $site_lang['currency'].$global->num_format($total_kredit); ?></strong></td>
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