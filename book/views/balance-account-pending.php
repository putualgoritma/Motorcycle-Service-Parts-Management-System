            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Buku Besar</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="ledger-general.php">Jurnal umum</a></li>
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
                                <div class="col-md-12">
                                 <form method="post" name="form" action="balance-account.php" enctype="multipart/form-data">
                                 <div class="page">From: </div>
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['baccount_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['baccount_drange2_sessi']; ?>" />
                                 <select name="search" class="textbox selectbox" id="search">
<? $global->book->taxonomi_createba(0,0,$search_value); ?>
                      </select><button name="Submit" id="Submit" class="btn btn-primary margin-right"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></form>
                  </div>
                  <div class="col-md-3 last">&nbsp;</div>
                  </div>
                  </div>
                <div>&nbsp;</div>
<table id="table1" class="table table-bordered gridView">
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
                      <td bgcolor="<? echo"$bg_color"; ?>">
                      <?
					  $ledgerdetails_list=$global->tbl_list("ledgerdetails,taxonomi","ledgerdetails.*,taxonomi.taxonomi_code,taxonomi.taxonomi_name","ledger_id='".$ledgerdetails_search_list[$i]['ledger_id']."' AND ledgerdetails.taxonomi_id = taxonomi.taxonomi_id","",1);
					  for($j=0;$j<count($ledgerdetails_list);$j++){
						  echo $ledgerdetails_list[$j]['taxonomi_name']."(".$ledgerdetails_list[$j]['ledgerdetails_type'].")";
						  echo "<br>";
					  }
					 ?>
                      </td> 
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
			$month_first=$month_first_exp[0]."/".$month_first_exp[1];
			//$month_first=(int)$month_first_exp[1];
			//if($month_first>1){
			if($month_first!="01/01"){
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
            </aside><!-- /.right-side -->