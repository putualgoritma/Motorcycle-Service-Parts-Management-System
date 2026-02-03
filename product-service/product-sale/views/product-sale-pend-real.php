            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_sale_pend_trs']; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Penjualan</a></li>
                        <li><a href="product-sale-pend.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_sale_pend']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_sale_pend_trs']; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row"><form action="product-sale-pend-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
                        <div class="col-xs-12">
                        
                        <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                                
                                
  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_sale_new_tran']; ?></u></strong></p>                     
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-10"><input name="product_order_id" type="hidden" id="product_order_id" value="<? echo $product_order_row['product_order_id']; ?>" /><input type="text" id="datepicker" name="date_register" value="<? echo $product_order_row['product_order_register']; ?>" class="nxt_tab" required="required" disabled="disabled"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['users_name_sale']; ?>:</strong></div>
<div class="col-md-10 typehead_customer"><input name="users_code" type="text" class="textbox firstin" id="users_code" value="<? echo $product_order_row['users_code']; ?> - <? echo $product_order_row['users_name']; ?>" required="required" rel="product_order_code" readonly="readonly"></div>
</div>

<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_code']; ?>:</strong></div>
<div class="col-md-10"><input name="product_order_code" type="text" class="textbox" id="product_order_code" value="<? echo $product_order_row['product_order_code']; ?>" required="required" readonly="readonly"></div>
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
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_quantity']; ?>
    </th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_real']; ?></th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_real_balance']; ?></th>
    </tr>
  </thead>
  <tbody class="dyn_product_order_sale">
    <?

  $product_orderdetails_list=$global->tbl_list("product_orderdetails","*","product_order_id='".$product_order_row['product_order_id']."'","",1);

  for($i=0;$i<count($product_orderdetails_list);$i++){

  $j=$i+1;

  //get bcode

  $product_row=$global->product_order->db_row("product","*","product_code='".$product_orderdetails_list[$i]['product_code']."'");
  $product_scode=$product_row['product_code']." - ".$product_row['product_name'];
	$sum_row=$global->db_qry_data("SELECT 
	IFNULL(SUM(product_orderdetails_ht_real.product_orderdetails_ht_qty), 0) AS sum_ht_qty
	FROM product_orderdetails_ht_real
	WHERE product_orderdetails_ht_real.product_orderdetails_id='".$product_orderdetails_list[$i]['product_orderdetails_id']."'
	GROUP BY product_orderdetails_ht_real.product_orderdetails_id
	ORDER BY product_orderdetails_ht_real.product_orderdetails_id ASC");
	$realize_ht_qty=0;
	if($sum_row['select_num']>0){
	$realize_ht_qty=$sum_row['select_data'][0]['sum_ht_qty'];
	}
	$residu_ht_qty=$product_orderdetails_list[$i]['product_orderdetails_quantity']-$realize_ht_qty;

  ?>	
    <tr id="inner<? echo $j; ?>">
      <td class="listnum_product_order_sale"><? echo $j; ?></td>
      <td><div class="product_scode"><? echo $product_scode; ?></div></td>
      <td><div class="product_orderdetails_quantity"><? echo $product_orderdetails_list[$i]['product_orderdetails_quantity']; ?></div></td>
      <td><div class="product_orderdetails_discount"><? echo $realize_ht_qty; ?></div></td>
      <td><div class="product_orderdetails_discount_val"><? echo $residu_ht_qty; ?></div></td>
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
                                
                                
  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_sale_new_tran']; ?></u></strong></p>                     

<div class="col-md-6">
  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['author_name']; ?>:</strong></div>
<div class="col-md-8"><select name="author_code" class="textbox selectbox hotkey" id="author_code" required="required" disabled="disabled">
                      <option value="<? echo $contact_glob['contact_code']; ?>" selected="selected"><? echo $contact_glob['contact_name']; ?></option>
                      </select></div>
</div>
  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_description']; ?>:</strong></div>
<div class="col-md-8"><textarea name="product_order_description" cols="40" rows="5" class="textbox" id="product_order_description" readonly="readonly"><? echo $product_order_row['product_order_description']; ?></textarea></div>
</div>
</div>

<div class="col-md-6">

<div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_discount']; ?>:</strong></div>
<div class="col-md-8"><input name="product_order_discount" type="text" class="textbox product_order_sale_total" id="product_order_discount" value="<? echo $product_order_row['product_order_discount']; ?>" size="5">% <input name="product_order_discount_val" type="text" class="textbox masknumber" id="product_order_discount_val" value="<? echo $product_orderdetails_discount_val_tot; ?>">
<input name="product_order_discount_val_hidden" type="hidden" id="product_order_discount_val_hidden" value="<? echo $product_orderdetails_discount_val_tot; ?>" />
</div>
</div>

  <div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_subtotal']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="product_orderdetails_total" type="text" class="textbox" id="product_orderdetails_total" value="<? echo $product_orderdetails_total_format; ?>">
  <input name="product_orderdetails_total_hidden" type="hidden" id="product_orderdetails_total_hidden" value="<? echo $product_orderdetails_total; ?>" />
</div>
</div>

  <div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_tax']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="product_order_tax" type="text" class="textbox" id="product_order_tax" value="<? echo $product_order_tax_val_format; ?>">
  <input name="product_order_tax_hidden" type="hidden" id="product_order_tax_hidden" value="<? echo $product_order_row['product_order_tax_val']; ?>" />
</div>
</div>

  <div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_cost']; ?>:</strong></div>
<div class="col-md-8"><input name="product_order_cost" type="text" class="textbox product_order_sale_total masknumber" id="product_order_cost" value="<? echo $product_order_row['product_order_cost']; ?>"><input name="product_order_sale_deposit" type="hidden" class="textbox product_order_sale_deposit" id="product_order_sale_deposit" value="0">
</div>
</div>

  <div class="row clearfix hide">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_total']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="product_order_total" type="text" class="textbox" id="product_order_total" value="<? echo $product_order_amount_format; ?>">
  <input name="product_order_total_hidden" type="hidden" id="product_order_total_hidden" value="<? echo $product_order_amount; ?>" /><input name="income_trade_hidden" type="hidden" id="income_trade_hidden" value="<? echo $product_order_row['product_order_income_trade']; ?>" /><input name="stock_trade_hidden" type="hidden" id="stock_trade_hidden" value="<? echo $product_order_row['product_order_stock_trade']; ?>" />
</div>
</div>

</div>

<div class="clear">&nbsp;</div>
            </div><!-- /.box-body -->
                          </div><!-- /.box -->                         

<div class="clear">&nbsp;</div>
<!-- /.box -->                        

                        </div>
                    </form></div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="form" id="form_product_order"><input name="product_order_id" type="hidden" id="product_order_id" value="<? echo $product_order_row['product_order_id']; ?>" /><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" />
  <input name="product_orderdetails_bprice_hidden" id="product_orderdetails_bprice_hidden" type="hidden" value="" /><input name="product_shtquantity_hidden" id="product_shtquantity_hidden" type="hidden" value="" />
<input name="product_spoquantity_hidden" id="product_spoquantity_hidden" type="hidden" value="" />
<input name="product_quantity_hidden" id="product_quantity_hidden" type="hidden" value="" />
<input name="product_bpoquantity_hidden" id="product_bpoquantity_hidden" type="hidden" value="" />
<input name="ht_type" id="ht_type" type="hidden" value="1" />
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_sale_new']; ?></u></strong></p>
<div>&nbsp;</div>
   </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
<div class="row clearfix append_div">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?>:</strong></div>
<div class="col-md-8 typehead_product"><input name="product_code" type="text" class="textbox firstin auto_foc" id="product_scode" required="required" rel="product_orderdetails_quantity" disabled="disabled">
  <span id="product_scode_label">&nbsp;</span></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_bprice']; ?>:</strong></div>
<div class="col-md-8">
              <input name="product_orderdetails_price" type="text" class="textbox auto_foc_trg masknumber" id="product_orderdetails_price" value="" required="required">
</div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_quantity']; ?>:</strong></div>
<div class="col-md-8">
              <input name="product_orderdetails_quantity" type="text" class="textbox" id="product_orderdetails_quantity" value="" required="required"></div>
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
<div class="col-md-8"><button name="Submit" class="btn btn-primary product_order_sale_edit_details2" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>                               
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="customer_new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="customer_new_modal_form" id="customer_new_modal_form">
  
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ($path."users/views/customer-new.php"); ?>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="customer_new_modal_btn_new" class="btn btn-primary customer_new_modal_btn_new" id="customer_new_modal_btn_new"><? echo $form_header_lang['add_new_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
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