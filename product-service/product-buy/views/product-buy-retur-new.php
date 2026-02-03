            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">                

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1>

                        <? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_retur_new']; ?>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pembelian</a></li>

                        <li><a href="product-buy-retur.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_retur']; ?></a></li>

                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_retur_new']; ?></li>

                    </ol>

                </section>



                <!-- Main content -->

                <section class="content">

                    <div class="row"><form action="product-buy-retur-new.php" method="post" enctype="multipart/form-data" name="form" id="form">

                        <div class="col-xs-12">

                        

                        <div class="box box-info">

                                <div class="box-header"> 

                                </div><!-- /.box-header -->

                          <div class="box-body table-responsive">

                                

                                

  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_new_tran']; ?></u></strong></p>                     

<div class="row clearfix">

<div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>

<div class="col-md-10"><input name="product_order_id" type="hidden" id="product_order_id" value="0" /><input type="text" id="datepicker" name="date_register" value="<? echo $date_def; ?>" class="nxt_tab"></div>

</div>

<div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['users_name_buy']; ?>:</strong></div>

<div class="col-md-10 typehead_supplier"><input name="users_code" type="text" class="textbox firstin" id="users_code" required="required" rel="product_order_code"></div>

</div>

<div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_code']; ?>:</strong></div>

<div class="col-md-10"><input name="product_order_code" type="text" class="textbox" id="product_order_code" value="<? echo $product_order_buy_code_generation;?>"></div>

</div>

<div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_kpb']; ?>:</strong></div>

<div class="col-md-10">

  <input type="checkbox" name="product_order_kpb" id="product_order_kpb" />

</div>

</div>

<div class="row clearfix" style="display:none">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_pend']; ?>:</strong></div>

<div class="col-md-10 typehead_po"><input name="po_code" type="text" class="textbox" id="po_code">&nbsp;<a href="javascript:;" id="PO_Reload"> <i class="fa fa-download fa-lg" aria-hidden="true"></i>

 </a></div>

</div>

<div class="clear">&nbsp;</div>

                          </div><!-- /.box-body -->

                          </div>

                        

                            <div class="clear">&nbsp;</div>

                            <div class="box box-danger">

                                <div class="box-header"> 

                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">

                                  <div class="clear">&nbsp;</div>                                

                                

    

<div class="table-responsive">

<table class="table table-bordered">

<thead>

  <tr>

    <th height="25" align="center">#</th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?> - <? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_name']; ?>

    </th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_bprice']; ?>

    </th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_quantity']; ?>

    </th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_discount']; ?></th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_discount_val']; ?></th>

    <th class="td_hide"><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_tax']; ?></th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_subtotal']; ?>

      </th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_shtquantity']; ?></th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_spoquantity']; ?></th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_quantity']; ?></th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_bpoquantity']; ?></th>

    <th>&nbsp;</th>

  </tr>

  </thead>

  <tr>

    <td height="25" align="center">&nbsp;</td>

    <td nowrap="nowrap" class="typehead_product">

    <input name="product_bcode" type="text" class="textbox" id="product_bcode" rel="product_orderdetails_quantity" />&nbsp;<a href="javascript:;" id="product_view_alink"> <i class="fa fa-edit fa-lg"></i> </a>

    </td>

    <td>

      <input name="product_orderdetails_price" type="text" class="textbox product_order_buy masknumber" id="product_orderdetails_price" value="" size="10" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" />

    </td>

    <td>

      <input name="product_orderdetails_quantity" type="text" class="textbox product_order_buy" id="product_orderdetails_quantity" value="" size="5" />

    </td>

    <td><input name="product_orderdetails_discount" type="text" class="textbox product_order_buy" id="product_orderdetails_discount" value="" size="5" /></td>

    <td><input name="product_orderdetails_discount_val" type="text" class="textbox masknumber lastinlist" id="product_orderdetails_discount_val" value="" size="10" /></td>

    <td class="td_hide"><input name="product_orderdetails_tax" type="text" class="textbox product_order_buy" id="product_orderdetails_tax" value="" size="5" /></td>

    <td>

      <input name="product_orderdetails_subtotal" type="text" class="textbox" id="product_orderdetails_subtotal" value="" size="15" readonly="readonly" />

      </td>

    <td><input name="product_shtquantity_hidden" id="product_shtquantity_hidden" type="hidden" value="" /><span class="product_shtquantity"></span></td>

    <td><input name="product_spoquantity_hidden" id="product_spoquantity_hidden" type="hidden" value="" /><span class="product_spoquantity"></span></td>

    <td><input name="product_quantity_hidden" id="product_quantity_hidden" type="hidden" value="" /><span class="product_quantity"></span></td>

    <td><input name="product_bpoquantity_hidden" id="product_bpoquantity_hidden" type="hidden" value="" /><span class="product_bpoquantity"></span></td>

    <td><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="product_order_buy();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></td>

  </tr>

  <tbody class="dyn_product_order_buy">

        </tbody>

               </table>

                                 </div>   

                              </div><!-- /.box-body -->

                            </div><!-- /.box -->

                            

<div class="clear">&nbsp;</div>   



<div class="box box-info">

                                <div class="box-header"> 

                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">

                                

                                

  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_new_tran']; ?></u></strong></p>                     



<div class="col-md-6">

  <div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['author_name']; ?>:</strong></div>

<div class="col-md-8"><select name="author_code" class="textbox selectbox hotkey" id="author_code" required="required" disabled="disabled">
                      <option value="<? echo $contact_glob['contact_code']; ?>" selected="selected"><? echo $contact_glob['contact_name']; ?></option>
                      </select></div>

</div>

  <div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_description']; ?>:</strong></div>

<div class="col-md-8"><textarea name="product_order_description" cols="40" rows="5" class="textbox" id="product_order_description"></textarea></div>

</div>

</div>



<div class="col-md-6">



<div class="row clearfix" style="display:none">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_discount']; ?>:</strong></div>

<div class="col-md-8"><input name="product_order_discount" type="text" class="textbox product_order_buy_total" id="product_order_discount" value="0" size="5">% <input name="product_order_discount_val" type="text" class="textbox masknumber" id="product_order_discount_val">

<input name="product_order_discount_val_hidden" type="hidden" id="product_order_discount_val_hidden" value="" />

</div>

</div>



  <div class="row clearfix" style="display:none">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_subtotal']; ?>:</strong></div>

<div class="col-md-8"><input readonly="readonly" name="product_orderdetails_total" type="text" class="textbox" id="product_orderdetails_total">

  <input name="product_orderdetails_total_hidden" type="hidden" id="product_orderdetails_total_hidden" value="" />

</div>

</div>



  <div class="row clearfix" style="display:none">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_tax']; ?>:</strong></div>

<div class="col-md-8"><input readonly="readonly" name="product_order_tax" type="text" class="textbox" id="product_order_tax">

  <input name="product_order_tax_hidden" type="hidden" id="product_order_tax_hidden" value="" />

</div>

</div>



  <div class="row clearfix" style="display:none">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_cost']; ?>:</strong></div>

<div class="col-md-8"><input name="product_order_cost" type="text" class="textbox product_order_buy_total masknumber" id="product_order_cost" value="0">

</div>

</div>



  <div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_total']; ?>:</strong></div>

<div class="col-md-8"><input readonly="readonly" name="product_order_total" type="text" class="textbox" id="product_order_total">

  <input name="product_order_total_hidden" type="hidden" id="product_order_total_hidden" value="" />

</div>

</div>



</div>



<div class="clear">&nbsp;</div>

            </div><!-- /.box-body -->

                          </div><!-- /.box --> 

                          

<div class="clear">&nbsp;</div>   



<div class="box box-info">

                                <div class="box-header"> 

                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">

                                

                                

  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_pay_tran']; ?></u></strong></p>                     



<div class="row clearfix">

  <div class="col-md-12">

  <div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_pay_tran']; ?>:</strong></div>

<div class="col-md-10">

    <label>

      <input name="product_order_buy_pay" type="radio" id="product_order_buy_pay1_0" value="cash" checked="checked" />

      Tunai</label>

     <label>

      <input type="radio" name="product_order_buy_pay" value="credit" id="product_order_buy_pay1_2" />

      Kredit</label>

</div>

</div>

<div class="row clearfix" id="product_order_buy_pay_cash">

<div class="col-md-2"><strong>Tunai/Cash:</strong></div>

<div class="col-md-10"><input readonly="readonly" name="product_order_total_cash" type="text" class="textbox" id="product_order_total_cash" placeholder="0">

  &nbsp;&nbsp;Rekening:&nbsp; 

    <select name="product_order_accountpay_cash" class="textbox" id="product_order_accountpay_cash">

              <?

			$global->product_order->book->account_special_create(array("cash"),0);

			?>

              </select>

</div>

</div>



<div class="row clearfix" id="product_order_buy_pay_bank" style="display:none">

<div class="col-md-2"><strong>Transfer Bank:</strong></div>

<div class="col-md-10"><input readonly="readonly" name="product_order_total_bank" type="text" class="textbox" id="product_order_total_bank" placeholder="0">

  &nbsp;&nbsp;Nama Bank:&nbsp;

  <select name="bank_code" class="textbox firstin" id="bank_code">

      <?

				$bank_list=$global->tbl_list("bank","*","","bank_name",1);

				for($i=0;$i<count($bank_list);$i++){

				?>

      <option value="<? echo $bank_list[$i]['bank_code']; ?>"><? echo $bank_list[$i]['bank_name']; ?></option>

      <?

					}

				?>

    </select>

  &nbsp;&nbsp;No:&nbsp; 

  <input name="bank_no" type="text" class="textbox" id="bank_no" placeholder="0">

  &nbsp;&nbsp;Rekening:&nbsp;

    <select name="product_order_accountpay_bank" class="textbox" id="product_order_accountpay_bank">

              <?

			$global->product_order->book->account_special_create(array("bank"),0);

			?>

              </select>

</div>

</div>



<div class="row clearfix" id="product_order_buy_pay_credit" style="display:none">

<div class="col-md-2"><strong>Kredit:</strong></div>

<div class="col-md-10"><input readonly="readonly" name="product_order_total_credit" type="text" class="textbox" id="product_order_total_credit" placeholder="0">

  &nbsp;&nbsp;Rekening:&nbsp; 

    <select name="product_order_accountpay_credit" class="textbox" id="product_order_accountpay_credit">

              <?

			$global->product_order->book->account_special_create(array("trade"),0);

			?>

              </select>

</div>

</div>



  </div>

</div>



<div class="clear">&nbsp;</div>

            </div><!-- /.box-body -->

                          </div><!-- /.box -->                        



<div class="clear">&nbsp;</div>

<div class="box box-danger">

            <div class="box-header"> 

            <div>&nbsp;</div>

                                <div class="row clearfix">

<div class="col-md-12 text-center"><button name="Save" class="btn btn-info" id="Save"><? echo $form_header_lang['save_button']; ?></button>&nbsp;<button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='product-buy-retur-new.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>

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

<form action="product-buy-retur-new.php" method="post" enctype="multipart/form-data" name="form" id="form_product_order"><input name="product_order_id" type="hidden" id="product_order_id" value="0" /><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" /><input name="product_shtquantity_hidden" id="product_shtquantity_hidden" type="hidden" value="" />

<input name="product_spoquantity_hidden" id="product_spoquantity_hidden" type="hidden" value="" />

<input name="product_quantity_hidden" id="product_quantity_hidden" type="hidden" value="" />

<input name="product_bpoquantity_hidden" id="product_bpoquantity_hidden" type="hidden" value="" />

<div class="box-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

<p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_new']; ?></u></strong></p>

<div>&nbsp;</div>

     </div><!-- /.box-header -->



     <div class="clear">&nbsp;</div>

<div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?>:</strong></div>

<div class="col-md-8"><input name="product_code" type="text" class="textbox auto_foc" id="product_bcode" disabled="disabled">

  <span id="product_bcode_label">&nbsp;</span></div>

</div>

<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_bprice']; ?>:</strong></div>

<div class="col-md-8">

              <input name="product_orderdetails_price" type="text" class="textbox auto_foc_trg firstin masknumber" id="product_orderdetails_price" value=""></div>

</div>

<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_quantity']; ?>:</strong></div>

<div class="col-md-8">

              <input name="product_orderdetails_quantity" type="text" class="textbox" id="product_orderdetails_quantity" value=""></div>

</div>



<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_discount']; ?>:</strong></div>

<div class="col-md-8">

              <input name="product_orderdetails_discount" type="text" class="textbox" id="product_orderdetails_discount" value=""></div>

</div>

<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_discount_val']; ?>:</strong></div>

<div class="col-md-8">

              <input name="product_orderdetails_discount_val" type="text" class="textbox masknumber lastinedit" id="product_orderdetails_discount_val" value=""></div>

</div>

<div class="row clearfix" style="display:none">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_tax']; ?>:</strong></div>

<div class="col-md-8">

              <input name="product_orderdetails_tax" type="text" class="textbox" id="product_orderdetails_tax" value=""></div>

</div>



</form> 

<div class="row clearfix">

<div class="col-md-4">&nbsp;</div>

<div class="col-md-8"><button name="Submit" class="btn btn-primary product_order_buy_edit_details2" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>

</div>                               

</div>

</div>

        </div> <!-- /.modal-content -->

    </div> <!-- /.modal-dialog -->

</div>



<div class="modal fade" id="supplier_new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

        <div class="box modal-dialog">

<div class="box-body table-responsive">

<form action="#" method="post" enctype="multipart/form-data" name="supplier_new_modal_form" id="supplier_new_modal_form">

  

<div class="box-header">

  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

   </div><!-- /.box-header -->

<? $modal=true; $popup=true; include ($path."users/views/supplier-new.php"); ?>

<div class="row clearfix">

<div class="col-md-4">&nbsp;</div>

<div class="col-md-8"><button name="supplier_new_modal_btn_new" class="btn btn-primary supplier_new_modal_btn_new" id="supplier_new_modal_btn_new"><? echo $form_header_lang['add_new_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>

</div>  

</form> 

</div>

</div>

        </div> <!-- /.modal-content -->

    </div> <!-- /.modal-dialog -->

</div>

<div class="modal fade" id="product_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ("../inventory/views/product-popup.php"); ?>
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>