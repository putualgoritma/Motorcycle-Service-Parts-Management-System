            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['payable'];?></h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"><? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['payable'];?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row"><form action="payable-min-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
                        <div class="col-xs-12">
                        <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
<p><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['payable'];?></u></strong></p>                     
<div class="clear">&nbsp;</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
  <div class="col-md-10"><input type="text" id="datepicker" name="date_register" value="<? echo $payreceivable_row['payreceivable_register']; ?>" required="required"><input name="payreceivable_id" type="hidden" id="payreceivable_id" value="<? echo $payreceivable_id; ?>" /><input name="payreceivable_accountdebit" type="hidden" id="payreceivable_accountdebit" value="<? echo $payreceivable_row['payreceivable_accountdebit']; ?>" /></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_code']; ?>:</strong></div>
  <div class="col-md-10"><input name="payreceivable_code" type="text" class="textbox firstin" id="payreceivable_code" required="required" value="<? echo $payreceivable_row['payreceivable_code']; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['users_name']; ?>:</strong></div>
  <div class="col-md-10 typehead_users"><input name="users_code" type="text" class="textbox" id="users_code" required="required" value="<? echo $payreceivable_row['users_code']; ?> - <? echo $payreceivable_row['users_name']; ?>" readonly="readonly"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>:</strong></div>
  <div class="col-md-10"><select name="payreceivable_accountcredit" class="textbox" id="payreceivable_accountcredit">
    <?
			$global->payreceivable->book->account_parent_special_create(array("cash_bank"),$payreceivable_row['payreceivable_accountcredit']);
			?>
    </select></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>:</strong></div>
  <div class="col-md-10"><select name="payreceivable_accountdebit2" class="textbox" id="payreceivable_accountdebit2" disabled="disabled">
    <?
			$global->payreceivable->book->account_parent_special_create(array("payable_liquid","payable_fixed"),$payreceivable_row['payreceivable_accountdebit']);
			?>
    </select></div>
</div>

<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-10"><? echo $site_lang['currency']; ?>
              <input name="payreceivable_amount" type="text" class="textbox" id="payreceivable_amount" value="<? echo $payreceivable_row['payreceivable_amount']; ?>" required="required" readonly="readonly"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_description']; ?>:</strong></div>
  <div class="col-md-10">
    <textarea name="payreceivable_description" cols="40" rows="5" class="textbox lastinedit" id="payreceivable_description" required="required"><? echo $payreceivable_row['payreceivable_description']; ?></textarea>
  </div>
</div>

                              </div><!-- /.box-body -->
                          </div><!-- /.box -->
                          
                          
                          <div class="box box-danger">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  <div class="clear">&nbsp;</div>                                
                                
    
<div class="table-responsive">
<table class="table table-bordered product_order_buy">
  <tbody class="dyn_receivable_get">
    <?
  	//loop
	$j=0;
	$payreceivable_details_list=$global->tbl_list("payreceivable_details","*","payreceivable_rel_id='".$payreceivable_id."'","",1);
	for($i=0;$i<count($payreceivable_details_list);$i++){
	$j++;
  	?>
    <tr id="inner<? echo $j; ?>">
      <td class="listnum_receivable_get">#</td>
      <td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_accountcredit"><? echo $payreceivable_details_list[$i]['payreceivable_code']; ?> - <? echo $payreceivable_row['users_name']; ?></div><input class="payreceivable_accountcredit_hidden" name="payreceivable_accountcredit_hidden[]" type="hidden" value="<? echo $payreceivable_details_list[$i]['payreceivable_code']; ?> - <? echo $payreceivable_row['users_name']; ?>"/></a></td>
      <td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_amount"><? echo $payreceivable_details_list[$i]['payreceivable_details_amount']; ?></div><input class="payreceivable_amount_hidden" name="payreceivable_amount_hidden[]" type="hidden" value="<? echo $payreceivable_details_list[$i]['payreceivable_details_amount']; ?>"/></a></td>
      <td>&nbsp;</td>
      </tr>
    <?
    }
	?>
  </tbody>
    <tr>
  <td>&nbsp;</td>
  <td align="right"><strong><? echo $form_header_lang['balance']; ?>:</strong></td>
  <td><span id="payreceivable_amount_total"><? echo $payreceivable_row['payreceivable_amount']; ?></span><input name="payreceivable_amount_total_hidden" id="payreceivable_amount_total_hidden" type="hidden" value="<? echo $payreceivable_row['payreceivable_amount']; ?>" /></td>
  <td>&nbsp;</td>
  </tr>

               </table>
                                 </div>   
                              </div><!-- /.box-body -->
                            </div>
                          
<div class="box box-danger">
            <div class="box-header"> 
            <div>&nbsp;</div>
                                <div class="row clearfix">
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;<button name="Submitcancell" class="btn btn-warning" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</button></div>
</div>
<div>&nbsp;</div>
                                </div><!-- /.box-header --><!-- /.box-body -->
                            </div>
                        </div>
                    </form></div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" enctype="multipart/form-data" name="form_receivable_new" id="form_receivable_new"><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['payable'];?></u></strong></p>  
<div>&nbsp;</div>
     </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
     <div class="row clearfix append_div">
  <div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountcredit']; ?>:</strong></div>
<div class="col-md-8 typehead_account"><input name="payreceivable_accountcredit" type="text" class="textbox firstin" id="payreceivable_accountcredit" required="required"></div>
</div>
     <div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_amount" type="text" class="textbox lastinedit auto_foc_trg masknumber" id="payreceivable_amount" value="" required="required"></div>
</div>
</form>  
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary receivable_details_edit" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="../templates/default/img/loading2.gif" width="41" height="31" /></div>
</div> 
                             
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>