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
                    <div class="row"><form action="payable-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
                        <div class="col-xs-12">
                        <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
<p><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['payable'];?></u></strong></p>                     
<div class="clear">&nbsp;</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
  <div class="col-md-10"><input type="text" id="datepicker" name="date_register" value="<? echo $_SESSION['payable_drange2_sessi']; ?>" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_code']; ?>:</strong></div>
  <div class="col-md-10"><input name="payreceivable_code" type="text" class="textbox firstin" id="payreceivable_code" required="required" value="<? echo $payreceivable_code_generation; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['users_name']; ?>:</strong></div>
  <div class="col-md-10 typehead_users"><input name="users_code" type="text" class="textbox" id="users_code" required="required"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountcredit']; ?>:</strong></div>
  <div class="col-md-10"><select name="payreceivable_accountcredit" class="textbox" id="payreceivable_accountcredit">
    <?
			$global->payreceivable->book->account_parent_special_create(array("payable_liquid","payable_fixed"),0);
			?>
    </select></div>
</div>

<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_description']; ?>:</strong></div>
  <div class="col-md-10">
    <textarea name="payreceivable_description" cols="40" rows="5" class="textbox" id="payreceivable_description" required="required"></textarea>
  </div>
</div>

                              </div><!-- /.box-body -->
                          </div>
                            <div class="box box-danger">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                  <div class="clear">&nbsp;</div>                                
                                
    
<div class="table-responsive">
<table class="table table-bordered product_order_buy">
  <thead>
  <tr>
    <th height="25" align="center">#</th>
    <th class="typehead_account">
    <input name="payreceivable_accountdebit" type="text" class="textbox" id="payreceivable_accountdebit" size="50" placeholder="<? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>" />&nbsp;<a href="javascript:;" id="taxonomi_view_alink"> <i class="fa fa-edit fa-lg"></i> </a>
    </th>
    <th>
      <input name="payreceivable_amount" type="text" class="textbox product_order_buy masknumber lastinlist" id="payreceivable_amount" value="" placeholder="<? echo $form_header_lang['amount']; ?>" />
    </th>
    <th><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="payable_get();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></th>
  </tr>
  </thead>
  <tbody class="dyn_payable_get">
  </tbody>
    <tr>
  <td>&nbsp;</td>
  <td align="right"><strong><? echo $form_header_lang['balance']; ?>:</strong></td>
  <td><span id="payreceivable_amount_total"></span><input name="payreceivable_amount_total_hidden" id="payreceivable_amount_total_hidden" type="hidden" value="" /></td>
  <td>&nbsp;</td>
  </tr>

               </table>
                                 </div>   
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
<form method="post" enctype="multipart/form-data" name="form_payable_new" id="form_payable_new"><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['payable'];?></u></strong></p>  
<div>&nbsp;</div>
     </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
     <div class="row clearfix append_div">
  <div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountcredit']; ?>:</strong></div>
<div class="col-md-8 typehead_account"><input name="payreceivable_accountdebit" type="text" class="textbox firstin" id="payreceivable_accountdebit" required="required"></div>
</div>
     <div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_amount" type="text" class="textbox lastinedit auto_foc_trg masknumber" id="payreceivable_amount" value="" required="required"></div>
</div>
</form>  
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary payable_details_edit" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="../templates/default/img/loading2.gif" width="41" height="31" /></div>
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
<? $modal=true; $popup=true; include ("../book/views/taxonomi-popup.php"); ?>
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>
