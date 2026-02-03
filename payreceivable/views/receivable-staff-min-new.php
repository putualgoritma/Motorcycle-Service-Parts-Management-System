            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['receivable'];?></h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"><? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['receivable'];?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row"><form action="receivable-staff-min-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
                        <div class="col-xs-12">
                        <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
<p><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['receivable'];?></u></strong></p>                     
<div class="clear">&nbsp;</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
  <div class="col-md-10"><input type="text" id="datepicker" name="date_register" value="<? echo $_SESSION['receivable_drange2_sessi']; ?>" required="required"><input name="payreceivable_accountcredit" type="hidden" id="payreceivable_accountcredit" value="<? echo $payreceivable_accountcredit; ?>" /></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_code']; ?>:</strong></div>
  <div class="col-md-10"><input name="payreceivable_code" type="text" class="textbox firstin" id="payreceivable_code" required="required" value="<? echo $payreceivable_code_generation; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_name']; ?>:</strong></div>
  <div class="col-md-10 typehead_staff"><input name="staff_code" type="text" class="textbox" id="staff_code" required="required" value="<? echo $staff_code; ?>"<? if($staff_code!=""){ ?> readonly="readonly"<? }?>></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>:</strong></div>
  <div class="col-md-10"><select name="payreceivable_accountdebit" class="textbox" id="payreceivable_accountdebit">
    <?
			$global->payreceivable->book->account_parent_special_create(array("cash_bank"),0);
			?>
    </select></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountcredit']; ?>:</strong></div>
  <div class="col-md-10"><select name="payreceivable_accountcredit2" class="textbox" id="payreceivable_accountcredit2" disabled="disabled">
    <?
			$global->payreceivable->book->account_special_create(array("receivable_staff"),$payreceivable_accountcredit);
			?>
    </select></div>
</div>

<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_description']; ?>:</strong></div>
  <div class="col-md-10">
    <textarea name="payreceivable_description" cols="40" rows="5" class="textbox lastinnew" id="payreceivable_description" required="required"></textarea>
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
  <tbody class="dyn_payable_get">
    <?
  	//loop
	$payreceivable_amount_total=0;
	if($id_set_value!=""){
	$payrecievable_set_id_arr=explode(",",$id_set_value);
	$j=0;
	foreach($payrecievable_set_id_arr as $key => $payrecievable_set_id_val ) {
	$j++;
	$payreceivable_list=$global->db_row_join("payreceivable,staff","payreceivable.*,staff.staff_name","payreceivable_id='".$payrecievable_set_id_val."' AND payreceivable.staff_code=staff.staff_code");
	$payreceivable_details_amount_row=$global->db_row_qry("SELECT SUM(payreceivable_details_amount) AS payreceivable_amount_paid FROM payreceivable_details WHERE payreceivable_code='".$payreceivable_list['payreceivable_code']."' GROUP BY payreceivable_code");
	$payreceivable_amount_residu=$payreceivable_list['payreceivable_amount']-$payreceivable_details_amount_row['payreceivable_amount_paid'];
	$payreceivable_amount_total+= $payreceivable_amount_residu;
  	?>
    <tr id="inner<? echo $j; ?>">
      <td class="listnum_payable_get">#</td>
      <td><a href="#" class="link_table payable_get_edit"><div class="payreceivable_accountdebit"><? echo $payreceivable_list['payreceivable_code']; ?> - <? echo $payreceivable_list['staff_name']; ?></div><input class="payreceivable_accountdebit_hidden" name="payreceivable_accountdebit_hidden[]" type="hidden" value="<? echo $payreceivable_list['payreceivable_code']; ?> - <? echo $payreceivable_list['staff_name']; ?>"/></a></td>
      <td><a href="#" class="link_table payable_get_edit"><div class="payreceivable_amount"><? echo $payreceivable_amount_residu; ?></div><input class="payreceivable_amount_hidden" name="payreceivable_amount_hidden[]" type="hidden" value="<? echo $payreceivable_amount_residu; ?>"/></a></td>
      <td><a href="javascript:;" class="btn btn-danger" onclick="remove_payable_min_get(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>
      </tr>
    <?
    }}
	?>
  </tbody>
    <tr>
  <td>&nbsp;</td>
  <td align="right"><strong><? echo $form_header_lang['balance']; ?>:</strong></td>
  <td><span id="payreceivable_amount_total"><? echo $payreceivable_amount_total; ?></span><input name="payreceivable_amount_total_hidden" id="payreceivable_amount_total_hidden" type="hidden" value="<? echo $payreceivable_amount_total; ?>" /></td>
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
                    <input type="hidden" name="payrecievable_set_id" id="payrecievable_set_id" value="<? echo $id_set_value; ?>" /></form></div>

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
  <div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>:</strong></div>
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