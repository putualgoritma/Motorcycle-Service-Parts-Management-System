            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <? echo $global->book->book_lang['form_header_book_lang']['cash_debit']; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="cash.php"><? echo $global->book->book_lang['menu_book_lang']['cash_debit']; ?></a></li>
                        <li class="active"><? echo $global->book->book_lang['menu_book_lang']['cash_debit_new']; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
                                
<form action="cash-new.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="ledger_id" type="hidden" id="ledger_id" value="<? echo"$ledger_id";?>" />
<p><strong><u><? echo $global->book->book_lang['form_header_book_lang']['ledger_general_new_tran']; ?></u></strong></p>                     
<div class="clear">&nbsp;</div>
                                
    
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
  <tbody class="ajax_container">
  <tr>
    <th width="2%" height="25" align="center">#</td>
    <th width="44%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?></strong></th>
    <th width="27%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_credit']; ?></strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    </tr>
    
  
  <? 
			$ledgerdetails_list=$global->tbl_list("ledgerdetails,taxonomi","ledgerdetails.*,taxonomi.taxonomi_code,taxonomi.taxonomi_name","ledger_id='".$ledger_id."' AND ledgerdetails.taxonomi_id = taxonomi.taxonomi_id","",1);
			for($i=0;$i<count($ledgerdetails_list);$i++){
			$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			//total saldo debit or kredit
			if($ledgerdetails_list[$i]['ledgerdetails_type']=="K")	{
			$total_kredit=$total_kredit + $ledgerdetails_list[$i]['ledgerdetails_amount'];
			}
			?>
  <tr id="inner<? echo $ledgerdetails_list[$i]['ledgerdetails_id']; ?>">
    <td bgcolor="<? echo"$bg_color"; ?>"><a href="#" class="ledger_general_del" rel="<? echo $ledgerdetails_list[$i]['ledgerdetails_id']; ?>"><i class="fa fa-times-circle"></i></a></td>
    <td bgcolor="<? echo"$bg_color"; ?>"><a href="#" class="link_table ledger_new_edit"><? echo $ledgerdetails_list[$i]['taxonomi_name']; ?></a></td>
    <td bgcolor="<? echo"$bg_color"; ?>"><? if($ledgerdetails_list[$i]['ledgerdetails_type']=="K"){?>
      <? echo $site_lang['currency'].$global->num_format($ledgerdetails_list[$i]['ledgerdetails_amount']); ?>
      <? } else {?>
      -
      <? }?></td>
    <td bgcolor="<? echo $bg_color; ?>" class="ledgerdetails_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit"><? echo $ledgerdetails_list[$i]['ledgerdetails_id']; ?></a></td>
    <td bgcolor="<? echo $bg_color; ?>" class="taxonomi_name_hidden td_hide"><a href="#" class="link_table ledger_new_edit"><? echo $ledgerdetails_list[$i]['taxonomi_code']; ?> - <? echo $ledgerdetails_list[$i]['taxonomi_name']; ?></a></td>
    <td bgcolor="<? echo $bg_color; ?>" class="ledgerdetails_type_hidden td_hide"><a href="#" class="link_table ledger_new_edit"><? echo $ledgerdetails_list[$i]['ledgerdetails_type']; ?></a></td>
    <td bgcolor="<? echo $bg_color; ?>" class="ledgerdetails_amount_hidden td_hide"><a href="#" class="link_table ledger_new_edit"><? echo $ledgerdetails_list[$i]['ledgerdetails_amount']; ?></a></td>
    <td bgcolor="<? echo $bg_color; ?>" class="ledger_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit"><? echo $ledger_id; ?></a></td>
    </tr>
    <?
				$inc++;
			}
			?>
  </tbody>

  <tr>
    <td>&nbsp;</td>
    <td><strong><? echo $form_header_lang['balance']; ?>:</strong></td>
    <td><span id="total_credit"><strong><? echo $site_lang['currency'].$global->num_format($total_kredit); ?></strong></span></td>
    </tr>
        <tr>
    <th width="2%" height="25" align="center">&nbsp;</td>
    <th width="44%">&nbsp;</th>
    <th width="27%"><a class="btn btn-info" role="button" href="#" data-toggle="modal" data-target="#myModalnew"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?></a></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
    </tr>

                                </table>

<div class="clear">&nbsp;</div> 
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-10"><input type="text" id="datepicker" name="date_register" value="<? echo $_SESSION['cash_drange2_sessi']; ?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->book->book_lang['form_label_book_lang']['cash_taxonomi']; ?>:</strong></div>
<div class="col-md-10"><select name="cash_taxonomi" class="textbox hotkey" id="cash_taxonomi">
              <?
			$global->book->account_parent_special_create(array("cash_bank"),0);
			?>
              </select>
</div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_code']; ?>:</strong></div>
<div class="col-md-10"><input name="ledger_code" type="text" class="textbox firstin" id="ledger_code" value="<? echo"$ledger_code";?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_description']; ?>:</strong></div>
<div class="col-md-10"><textarea name="ledger_description" cols="100" rows="10" class="textbox" id="ledger_description"><? echo"$ledger_description";?></textarea></div>
</div>

<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submitprocess" class="btn btn-primary" id="Submitprocess"><? echo $form_header_lang['process_button']; ?></button>&nbsp;<button name="Submitbatal" class="btn btn-primary" id="Submitbatal"><? echo $form_header_lang['cancell_button']; ?></button></div>
</div> 
</form>
                                   
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
<div class="clear">&nbsp;</div>   

                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
            <div class="modal fade" id="myModalnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" enctype="multipart/form-data" name="form" id="form_ledger_new"><input name="ledger_id" type="hidden" id="ledger_id" value="<? echo"$ledger_id";?>" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->book->book_lang['form_header_book_lang']['ledger_general_new']; ?>: </u></strong></p>  
<div>&nbsp;</div>
     </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_code']; ?>:</strong></div>
<div class="col-md-8 typehead_account"><input name="taxonomi_code" type="text" class="textbox firstin" id="taxonomi_code"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledgerdetails_type']; ?>:</strong></div>
<div class="col-md-8"><select name="ledgerdetails_type" class="textbox" id="ledgerdetails_type">
                <option value="K" selected="selected">Kredit</option>
            </select></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="ledgerdetails_amount" type="text" class="textbox lastin" id="ledgerdetails_amount" value=""></div>
</div>
</form> 
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary cash_details_new" id="Submit"><? echo $form_header_lang['add_new_button']; ?></button><img class="ajax_loader" src="../templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>                               
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" enctype="multipart/form-data" name="form_ledger_edit" id="form_ledger_edit"><input name="ledger_id" type="hidden" id="ledger_id" /><input name="ledgerdetails_id" type="hidden" id="ledgerdetails_id" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->book->book_lang['form_header_book_lang']['ledger_general_new']; ?>: </u></strong></p>  
<div>&nbsp;</div>
     </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
     <div class="row clearfix append_div">
  <div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_code']; ?>:</strong></div>
<div class="col-md-8 typehead_account"><input name="taxonomi_code" type="text" class="textbox firstin" id="taxonomi_code"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledgerdetails_type']; ?>:</strong></div>
<div class="col-md-8"><select name="ledgerdetails_type" class="textbox" id="ledgerdetails_type">
                <option value="K" selected="selected">Kredit</option>
            </select></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="ledgerdetails_amount" type="text" class="textbox lastinedit" id="ledgerdetails_amount" value=""></div>
</div>
</form>  
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary cash_details_edit" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="../templates/default/img/loading2.gif" width="41" height="31" /></div>
</div> 
                             
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>
