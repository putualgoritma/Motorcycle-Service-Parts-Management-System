            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">                

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1>

                        <? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor_edit']; ?>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li><a href="<? echo $path; ?>service-vendor.php"> Pembelian</a></li>

                        <li><a href="service-vendor.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor']; ?></a></li>

                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor_edit']; ?></li>

                    </ol>

                </section>



                <!-- Main content -->

                <section class="content">

                    <div class="row"><form action="service-vendor-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">

                        <div class="col-xs-12">

                        

                        <div class="box box-info">

                                <div class="box-header"> 

                                </div><!-- /.box-header -->

                          <div class="box-body table-responsive">

                                

                                

  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor_new_trs']; ?></u></strong></p>                     

<div class="row clearfix">

<div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>

<div class="col-md-10"><input name="service_order_id" type="hidden" id="service_order_id" value="<? echo $service_order_row['service_order_id']; ?>" /><input name="service_order_queue" type="hidden" id="service_order_queue" value="<? echo $service_order_row['service_order_queue']; ?>" /><input type="text" id="datepicker" name="date_register" value="<? echo $service_order_row['service_order_register']; ?>" class="nxt_tab"></div>

</div>

<div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['users_name_buy']; ?>:</strong></div>

<div class="col-md-10 typehead_supplier"><input name="users_code" type="text" class="textbox firstin" id="users_code" value="<? echo $service_order_row['users_code']; ?> - <? echo $service_order_row['users_name']; ?>" required="required" rel="service_order_code"></div>

</div>



<div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_code']; ?>:</strong></div>

<div class="col-md-10"><input name="service_order_code" type="text" class="textbox" id="service_order_code" value="<? echo $service_order_row['service_order_code']; ?>" readonly="readonly"></div>

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

<table class="table table-bordered service_vendor">

<thead>

  <tr>

    <th height="25" align="center">#</th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_code']; ?> - <? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_name']; ?>

    </th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_bprice']; ?>

    </th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_quantity']; ?>

    </th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_discount']; ?></th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_discount_val']; ?></th>

    <th class="td_hide"><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_tax']; ?></th>

    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_subtotal']; ?>
      
    </th>

    <th>&nbsp;</th>

  </tr>

  </thead>

  

  <tr>

    <td height="25" align="center">&nbsp;</td>

    <td class="typehead_service">

    <input name="service_bcode" type="text" class="textbox" id="service_bcode" rel="service_orderdetails_quantity" /></td>

    <td>

      <input name="service_orderdetails_price" type="text" class="textbox service_vendor masknumber" id="service_orderdetails_price" value="" size="10" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" />

    </td>

    <td>

      <input name="service_orderdetails_quantity" type="text" class="textbox service_vendor" id="service_orderdetails_quantity" value="" size="5" />

    </td>

    <td><input name="service_orderdetails_discount" type="text" class="textbox service_vendor" id="service_orderdetails_discount" value="" size="5" /></td>

    <td><input name="service_orderdetails_discount_val" type="text" class="textbox service_vendor masknumber lastinlist" id="service_orderdetails_discount_val" value="" size="10" /></td>

    <td class="td_hide"><input name="service_orderdetails_tax" type="text" class="textbox service_vendor lastinlist" id="service_orderdetails_tax" value="" size="5" /></td>

    <td>
      
      <input name="service_orderdetails_subtotal" type="text" class="textbox" id="service_orderdetails_subtotal" value="" size="15" readonly="readonly" />
      
    </td>

    <td><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="service_vendor();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></td>

  </tr>

  <tbody class="dyn_service_vendor">

  <?

  $service_orderdetails_discount_val_tot=0;

  $service_orderdetails_list=$global->tbl_list("service_orderdetails","*","service_order_id='".$service_order_row['service_order_id']."'","",1);

  for($i=0;$i<count($service_orderdetails_list);$i++){

  $j=$i+1;

  //get bcode

  $service_row=$global->product_order->db_row("service","*","service_code='".$service_orderdetails_list[$i]['service_code']."'");
  $service_bcode=$service_row['service_code']." - ".$service_row['service_name'];

  //get sub total

  $service_orderdetails_price_adisc2=$service_orderdetails_list[$i]['service_orderdetails_price']*(1-(($service_orderdetails_list[$i]['service_orderdetails_discount']+$service_orderdetails_list[$i]['service_orderdetails_disc_final'])/100)+(($service_orderdetails_list[$i]['service_orderdetails_discount']*$service_orderdetails_list[$i]['service_orderdetails_disc_final'])/10000));

  $service_orderdetails_subtotal=$service_orderdetails_price_adisc2*$service_orderdetails_list[$i]['service_orderdetails_quantity'];

  $service_orderdetails_price_format=$global->num_format2($service_orderdetails_list[$i]['service_orderdetails_price']);

  $service_orderdetails_subtotal_format=$global->num_format2($service_orderdetails_subtotal);

  //get discount val

  $service_orderdetails_discount_val=$service_orderdetails_list[$i]['service_orderdetails_price']*($service_orderdetails_list[$i]['service_orderdetails_discount']/100);

  $service_orderdetails_discount_val_format=$global->num_format2($service_orderdetails_discount_val);

  $service_orderdetails_discount_val_tot +=(($service_orderdetails_list[$i]['service_orderdetails_price']-$service_orderdetails_discount_val)*($service_orderdetails_list[$i]['service_orderdetails_disc_final']/100))*$service_orderdetails_list[$i]['service_orderdetails_quantity'];

  ?>	

  <tr id="inner<? echo $j; ?>">

  <td class="listnum_service_vendor"><? echo $j; ?></td>

  <td><a href="#" class="link_table service_vendor_edit"><div class="service_bcode"><? echo $service_bcode; ?></div><input name="service_bcode_hidden[]" type="hidden" value="<? echo $service_bcode; ?>"/></a></td>

  <td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_price"><? echo $service_orderdetails_price_format; ?></div><input name="service_orderdetails_price_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_price']; ?>"/></a></td>

  <td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_quantity"><? echo $service_orderdetails_list[$i]['service_orderdetails_quantity']; ?></div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_quantity']; ?>"/></a></td>

  <td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount"><? echo $service_orderdetails_list[$i]['service_orderdetails_discount']; ?></div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_discount']; ?>"/></a></td>

  <td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount_val"><? echo $service_orderdetails_discount_val_format;?></div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="<? echo $service_orderdetails_discount_val;?>"/></a></td>

  <td class="td_hide"><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_tax"><? echo $service_orderdetails_list[$i]['service_orderdetails_tax']; ?></div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_tax']; ?>"/></a></td>

  <td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_subtotal"><? echo $service_orderdetails_subtotal_format; ?></div><input class="subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="<? echo $service_orderdetails_subtotal; ?>"/></a></td>

  

  <td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_vendor(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>

  </tr>

  <?

		}

  ?>

  

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

                                

                                

  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor_new_trs']; ?></u></strong></p>                     



<div class="col-md-6">

  <div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['author_name']; ?>:</strong></div>

<div class="col-md-8 typehead_author"><input name="author_code" type="text" class="textbox hotkey" id="author_code" value="<? echo $author_row['contact_code']; ?> - <? echo $author_row['contact_name']; ?>" required="required"></div>

</div>

  <div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_description']; ?>:</strong></div>

<div class="col-md-8"><textarea name="service_order_description" cols="40" rows="5" class="textbox" id="service_order_description"><? echo $service_order_row['service_order_description']; ?></textarea></div>

</div>

</div>



<div class="col-md-6">



<div class="row clearfix" style="display:none">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_discount']; ?>:</strong></div>

<div class="col-md-8"><input name="service_order_discount" type="text" class="textbox service_vendor_total" id="service_order_discount" value="<? echo $service_order_row['service_order_discount']; ?>" size="5">% <input name="service_order_discount_val" type="text" class="textbox masknumber" id="service_order_discount_val" value="<? echo $service_orderdetails_discount_val_tot; ?>">

<input name="service_order_discount_val_hidden" type="hidden" id="service_order_discount_val_hidden" value="<? echo $service_orderdetails_discount_val_tot; ?>" />

</div>

</div>



  <div class="row clearfix" style="display:none">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_subtotal']; ?>:</strong></div>

<div class="col-md-8"><input readonly="readonly" name="service_orderdetails_total" type="text" class="textbox" id="service_orderdetails_total" value="<? echo $service_orderdetails_total_format; ?>">

  <input name="service_orderdetails_total_hidden" type="hidden" id="service_orderdetails_total_hidden" value="<? echo $service_orderdetails_total; ?>" />

</div>

</div>



  <div class="row clearfix" style="display:none">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_tax']; ?>:</strong></div>

<div class="col-md-8"><input readonly="readonly" name="service_order_tax" type="text" class="textbox" id="service_order_tax" value="<? echo $service_order_tax_val_format; ?>">

  <input name="service_order_tax_hidden" type="hidden" id="service_order_tax_hidden" value="<? echo $service_order_row['service_order_tax_val']; ?>" />

</div>

</div>



  <div class="row clearfix" style="display:none">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_cost']; ?>:</strong></div>

<div class="col-md-8"><input name="service_order_cost" type="text" class="textbox service_vendor_total masknumber" id="service_order_cost" value="<? echo $service_order_row['service_order_cost']; ?>">

</div>

</div>



  <div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_total']; ?>:</strong></div>

<div class="col-md-8"><input readonly="readonly" name="service_order_total" type="text" class="textbox" id="service_order_total" value="<? echo $service_order_amount_format; ?>">

  <input name="service_order_total_hidden" type="hidden" id="service_order_total_hidden" value="<? echo $service_order_amount; ?>" />

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

                                

                                

  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor_pay_tran']; ?></u></strong></p>                     



<div class="row clearfix">

  <div class="col-md-12">

  <div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor_pay_tran']; ?>:</strong></div>

<div class="col-md-10">

    <label>

      <input name="service_vendor_pay" type="radio" id="service_vendor_pay1_0" value="cash"<? if($service_order_row['service_order_pay_method']=="cash"){ ?> checked="checked"<? }?> />

      Tunai</label>

      <input type="radio" name="service_vendor_pay" value="credit" id="service_vendor_pay1_2"<? if($service_order_row['service_order_pay_method']=="credit"){ ?> checked="checked"<? }?> />

      Kredit</label>

</div>

</div>

<div class="row clearfix" id="service_vendor_pay_cash"<? if($service_order_row['service_order_pay_method']!="cash"){ ?> style="display:none"<? }?>>

<div class="col-md-2"><strong>Tunai/Cash:</strong></div>

<div class="col-md-10"><input readonly="readonly" name="service_order_total_cash" type="text" class="textbox" id="service_order_total_cash" placeholder="0" value="<? echo $service_order_amount_format; ?>">

  &nbsp;&nbsp;Rekening:&nbsp; 

    <select name="service_order_accountpay_cash" class="textbox" id="service_order_accountpay_cash">

              <?

			$global->product_order->book->account_special_create(array("cash"),$service_order_row['service_order_accountcredit']);

			?>

              </select>

</div>

</div>



<div class="row clearfix" id="service_vendor_pay_bank"<? if($service_order_row['service_order_pay_method']!="bank"){ ?> style="display:none"<? }?>>

<div class="col-md-2"><strong>Transfer Bank:</strong></div>

<div class="col-md-10"><input readonly="readonly" name="service_order_total_bank" type="text" class="textbox" id="service_order_total_bank" placeholder="0" value="<? echo $service_order_amount_format; ?>">

  &nbsp;&nbsp;Nama Bank:&nbsp;

  <select name="bank_code" class="textbox firstin" id="bank_code">

      <?

				$bank_list=$global->tbl_list("bank","*","","bank_name",1);

				for($i=0;$i<count($bank_list);$i++){

				?>

      <option value="<? echo $bank_list[$i]['bank_code']; ?>"<? if($service_order_row['bank_code']==$bank_list[$i]['bank_code']){ ?> selected="selected"<? }?>><? echo $bank_list[$i]['bank_name']; ?></option>

      <?

					}

				?>

    </select>

  &nbsp;&nbsp;No:&nbsp; 

  <input name="bank_no" type="text" class="textbox" id="bank_no" placeholder="0" value="<? echo $service_order_row['bank_no']; ?>">

  &nbsp;&nbsp;Rekening:&nbsp;

    <select name="service_order_accountpay_bank" class="textbox" id="service_order_accountpay_bank">

              <?

			$global->product_order->book->account_special_create(array("bank"),$service_order_row['service_order_accountcredit']);

			?>

              </select>

</div>

</div>



<div class="row clearfix" id="service_vendor_pay_credit"<? if($service_order_row['service_order_pay_method']!="credit"){ ?> style="display:none"<? }?>>

<div class="col-md-2"><strong>Kredit:</strong></div>

<div class="col-md-10"><input readonly="readonly" name="service_order_total_credit" type="text" class="textbox" id="service_order_total_credit" placeholder="0" value="<? echo $service_order_amount_format; ?>">

  &nbsp;&nbsp;Rekening:&nbsp; 

    <select name="service_order_accountpay_credit" class="textbox" id="service_order_accountpay_credit">

              <?

			$global->product_order->book->account_special_create(array("trade_payable"),$service_order_row['service_order_accountcredit']);

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

<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='service-vendor-edit.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>

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

<form action="service-vendor-edit-process.php" method="post" enctype="multipart/form-data" name="form" id="form_service_order"><input name="service_order_id" type="hidden" id="service_order_id" value="<? echo $service_order_row['service_order_id']; ?>" /><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" /><input name="service_shtquantity_hidden" id="service_shtquantity_hidden" type="hidden" value="" />

<input name="service_spoquantity_hidden" id="service_spoquantity_hidden" type="hidden" value="" />

<input name="service_quantity_hidden" id="service_quantity_hidden" type="hidden" value="" />

<input name="service_bpoquantity_hidden" id="service_bpoquantity_hidden" type="hidden" value="" />

<div class="box-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

<p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor_new']; ?></u></strong></p>

<div>&nbsp;</div>

     </div><!-- /.box-header -->



     <div class="clear">&nbsp;</div>

<div class="row clearfix append_div">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_code']; ?>:</strong></div>

<div class="col-md-8 typehead_product"><input name="service_code" type="text" class="textbox firstin auto_foc" id="service_bcode">

  <span id="service_bcode_label">&nbsp;</span></div>

</div>

<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_bprice']; ?>:</strong></div>

<div class="col-md-8">

              <input name="service_orderdetails_price" type="text" class="textbox auto_foc_trg masknumber" id="service_orderdetails_price" value=""></div>

</div>

<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_quantity']; ?>:</strong></div>

<div class="col-md-8">

              <input name="service_orderdetails_quantity" type="text" class="textbox" id="service_orderdetails_quantity" value=""></div>

</div>



<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_discount']; ?>:</strong></div>

<div class="col-md-8">

              <input name="service_orderdetails_discount" type="text" class="textbox" id="service_orderdetails_discount" value=""></div>

</div>

<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_discount_val']; ?>:</strong></div>

<div class="col-md-8">

              <input name="service_orderdetails_discount_val" type="text" class="textbox masknumber lastinedit" id="service_orderdetails_discount_val" value=""></div>

</div>

<div class="row clearfix" style="display:none">                                

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_tax']; ?>:</strong></div>

<div class="col-md-8">

              <input name="service_orderdetails_tax" type="text" class="textbox" id="service_orderdetails_tax" value=""></div>

</div>



</form> 

<div class="row clearfix">

<div class="col-md-4">&nbsp;</div>

<div class="col-md-8"><button name="Submit" class="btn btn-primary service_vendor_edit_details2" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>

</div>                               

</div>

</div>

        </div> <!-- /.modal-content -->

    </div> <!-- /.modal-dialog -->

</div>