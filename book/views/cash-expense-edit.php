            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <? echo $global->book->book_lang['form_header_book_lang']['cash_expense']; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="cash-expense.php"><? echo $global->book->book_lang['form_header_book_lang']['cash_expense']; ?></a></li>
                        <li class="active"><? echo $global->book->book_lang['menu_book_lang']['cash_expense_edit']; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row"><form action="cash-expense-edit.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="ledger_id" type="hidden" id="ledger_id" value="<? echo"$ledger_id";?>" />
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
                                

<p><strong><u><? echo $global->book->book_lang['form_header_book_lang']['cash_expense_edit']; ?></u></strong></p>                     
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-10"><input type="text" id="datepicker" name="date_register" value="<? echo $ledger_register; ?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->book->book_lang['form_label_book_lang']['cash_taxonomi']; ?>:</strong></div>
<div class="col-md-10"><select name="cash_taxonomi" class="textbox hotkey" id="cash_taxonomi">
              <?
			$global->book->account_parent_special_create(array("cash_bank"),$cash_taxonomi);
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
                                   
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
<div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  <div class="clear">&nbsp;</div>                                
                                
    
<div class="table-responsive">
<table class="table table-bordered product_order_sale">
  <thead>
  <tr>
    <th height="25" align="center">#</th>
    <th><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?>
    </th>
    <th><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_debit']; ?>
    </th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td nowrap="nowrap" class="typehead_texpense">
    <input name="taxonomi_code" type="text" class="textbox" id="taxonomi_code" rel="ledgerdetails_amount" />&nbsp;<a href="javascript:;" id="taxonomi_view_alink"> <i class="fa fa-edit fa-lg"></i> </a>
    </td>
    <td>
      <input name="ledgerdetails_amount" type="text" class="textbox masknumber lastinlist" id="ledgerdetails_amount" value="" size="10" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" />
    </td>
    <td><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="texpense_proc();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></td>
  </tr>
  <tbody class="dyn_texpense">
  <? 
			$ledgerdetails_list=$global->tbl_list("ledgerdetails,taxonomi","ledgerdetails.*,taxonomi.taxonomi_code,taxonomi.taxonomi_name","ledger_id='".$ledger_id."' AND ledgerdetails.taxonomi_id = taxonomi.taxonomi_id AND ledgerdetails.ledgerdetails_subsidiary =''","",1);
			for($i=0;$i<count($ledgerdetails_list);$i++){
			//total saldo debit or kredit
			$taxonomi_scode=$ledgerdetails_list[$i]['taxonomi_code']." - ".$ledgerdetails_list[$i]['taxonomi_name'];
			?>	
  <tr id="inner<? echo $j; ?>">
  <td class="listnum_texpense"><? echo $j; ?></td>
  <td><a href="#" class="link_table texpense_edit"><div class="taxonomi_scode"><? echo $taxonomi_scode; ?></div><input name="taxonomi_scode_hidden[]" type="hidden" value="<? echo $taxonomi_scode; ?>"/></a></td>
  <td><a href="#" class="link_table texpense_edit"><div class="ledgerdetails_amount"><? echo $global->num_format2($ledgerdetails_list[$i]['ledgerdetails_amount']); ?></div><input name="ledgerdetails_amount_hidden[]" type="hidden" value="<? echo $ledgerdetails_list[$i]['ledgerdetails_amount']; ?>"/></a></td>
  <td><a href="javascript:;" class="btn btn-danger" onclick="texpense_remove(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>
  </tr>
  <?
		}
  ?>
  </tbody>
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td align="right" nowrap="nowrap">Saldo:&nbsp;</td>
    <td><span id="texpense_total"><? echo $cash_amount_format; ?></span></td>
    <td><input type="hidden" name="texpense_total_hidden" id="texpense_total_hidden" value="<? echo $cash_amount; ?>" />&nbsp;</td>
  </tr>
               </table>
                                 </div>   
                              </div><!-- /.box-body -->
                            </div>
                            
                            
<div class="box box-danger">
            <div class="box-header"> 
            <div>&nbsp;</div>
                                <div class="row clearfix">
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='cash-expense-edit.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
</div>
<div>&nbsp;</div>
                                </div><!-- /.box-header --><!-- /.box-body -->
                            </div>
                            
<div class="clear">&nbsp;</div>   

                        </div></form> 
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" enctype="multipart/form-data" name="form_ledger_edit" id="form_ledger_edit"><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->book->book_lang['form_header_book_lang']['ledger_general_new']; ?>: </u></strong></p>  
<div>&nbsp;</div>
     </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
     <div class="row clearfix append_div">
  <div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_code']; ?>:</strong></div>
<div class="col-md-8 typehead_texpense"><input name="taxonomi_code" type="text" class="textbox firstin" id="taxonomi_code"></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="ledgerdetails_amount" type="text" class="textbox lastinedit" id="ledgerdetails_amount" value=""></div>
</div>
</form> 
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary texpense_edit_modal" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="../templates/default/img/loading2.gif" width="41" height="31" /></div>
</div> 
                             
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="taxonomi_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ("views/taxonomi-popup.php"); ?>
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>
