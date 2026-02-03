            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Jurnal Umum</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>">Keuangan</a></li>
                        <li class="active">Jurnal Umum</li>
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
                                <form action="ledger-general.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>"size="20" />
                                <div class="page">From: </div>
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['ledger_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['ledger_drange2_sessi']; ?>" />
                                <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />                  <div class="page">/ page</div>
                  <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-primary"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></div></form>
                  
                  </div>
                  
                  </div>
                  </div>
                <div>&nbsp;</div>
              <form onSubmit="return confirmSubmit('<? echo $msgform_lang['cfrm_remove']; ?>')" method="post" name="myform" enctype="multipart/form-data" action="">
              <? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.myform,'ledger-general.php?delete=true')" name="Submitdel" value="view"><i class="fa fa-times"></i> <? echo $form_header_lang['delete_kop']; ?></button><? }?>
              &nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><a class="btn btn-info" role="button" href="ledger-general-new.php"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?></a><? }?>
                                    <table width="100%" class="table table-bordered table-hover gridView" id="table1">
                                        <thead>
                                            <tr>
                                                <th width="3%">#</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="10%"><strong><a href="ledger-general.php?sort=ledger_registernum <? if($sort_value=="ledger_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->book->book_lang['form_label_book_lang']['ledger_register']; ?></a></strong></th>
                                                <th width="10%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_code']; ?></strong></th>
                                                <th width="31%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_description']; ?> &amp; <? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?></strong></th>
                                                <th width="10%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_code']; ?></strong></th>
                                                <th width="15%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_type']; ?></strong></th>
                                                <th width="16%"><strong><? echo $global->book->book_lang['form_label_book_lang']['credit_ledger']; ?></strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($ledger_search_list);$i++){
			 $bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			 $view_link="";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="ledger-general-edit.php?ledger_id=".$ledger_search_list[$i]['ledger_id'];
				}
			?>
                                        <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $ledger_search_list[$i]['ledger_id']; ?>" /></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledger_search_list[$i]['ledger_register']; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledger_search_list[$i]['ledger_code']; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledger_search_list[$i]['ledger_description']; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>">&nbsp;</td>
                                            <td bgcolor="<? echo"$bg_color"; ?>">&nbsp;</td>
                                            <td bgcolor="<? echo"$bg_color"; ?>">&nbsp;</td>
                                        </tr>
                                         <? 
				 $ledgerdetails_list=$global->tbl_list("ledgerdetails,taxonomi","ledgerdetails.*,taxonomi.taxonomi_code,taxonomi.taxonomi_name","ledger_id='".$ledger_search_list[$i]['ledger_id']."' AND ledgerdetails.taxonomi_id = taxonomi.taxonomi_id","",1);
				 for($j=0;$j<count($ledgerdetails_list);$j++){
					//total saldo debit or kredit
					if($ledgerdetails_list[$j]['ledgerdetails_type']=="D")	{
					$total_debit+=$ledgerdetails_list[$j]['ledgerdetails_amount'];
					}else{
					$total_kredit+=$ledgerdetails_list[$j]['ledgerdetails_amount'];
					}

			?>
                                        <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                          <td bgcolor="<? echo"$bg_color"; ?>">&nbsp;</td>
                                          <td bgcolor="<? echo"$bg_color"; ?>">&nbsp;</td>
                                          <td bgcolor="<? echo"$bg_color"; ?>">&nbsp;</td>
                                          <td bgcolor="<? echo"$bg_color"; ?>">&nbsp;</td>
                                          <td bgcolor="<? echo"$bg_color"; ?>" class="padding_left10"><? echo $ledgerdetails_list[$j]['taxonomi_name']; ?></td>
                                          <td bgcolor="<? echo"$bg_color"; ?>"><? echo $ledgerdetails_list[$j]['taxonomi_code']; ?></td>
                                          <td bgcolor="<? echo"$bg_color"; ?>"><? if($ledgerdetails_list[$j]['ledgerdetails_type']=="D"){?>
                    <? echo $site_lang['currency'].$global->num_format($ledgerdetails_list[$j]['ledgerdetails_amount']); ?>
                  <? } else {?>
                  -
                  <? }?></td>
                                          <td bgcolor="<? echo"$bg_color"; ?>"><? if($ledgerdetails_list[$j]['ledgerdetails_type']=="K"){?>
                    <? echo $site_lang['currency'].$global->num_format($ledgerdetails_list[$j]['ledgerdetails_amount']); ?>
                  <? } else {?>
                  -
                  <? }?></td>
                                        </tr>
										<?
					}
				$inc++;
				}
			?>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td align="right"><strong><? echo $form_header_lang['amount']; ?>:</strong></td>
                                          <td><strong><? echo $site_lang['currency'].$global->num_format($total_debit); ?></strong></td>
                                          <td><strong><? echo $site_lang['currency'].$global->num_format($total_kredit); ?></strong></td>
                                        </tr>
										
                                        </tbody> 
                                    </table>
                                    
                                    
                                    <table width="360" border="0" align="center" cellpadding="0" cellspacing="0" id="nexprev">
                      <tr>
                        <td width="80">&nbsp;</td>
                        <td width="60" align="center">&nbsp;</td>
                        <td width="80">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right"><? if($current_page>1) { ?>
                            <a href="ledger-general.php?pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="ledger-general.php?pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>
                            <? }?></td>
                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>
                        <td><? if($current_page<$total_page) { ?>
                            <a href="ledger-general.php?pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="ledger-general.php?pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>
                            <? }?></td>
                      </tr>
                  </table>
                                  
                                  <div class="clear">&nbsp;</div>
                                  
                                  </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->