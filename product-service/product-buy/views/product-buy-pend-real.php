            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">                

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1>

                        <? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_pend_trs']; ?>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pembelian</a></li>

                        <li><a href="product-buy-pend.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_pend']; ?></a></li>

                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_pend_trs']; ?></li>

                    </ol>

                </section>



                <!-- Main content -->

                <section class="content">

                    <div class="row"><form action="product-buy-pend-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">

                        <div class="col-xs-12">

                        

                        <div class="box box-info">

                                <div class="box-header"> 

                                </div><!-- /.box-header -->

                          <div class="box-body table-responsive">

                                

                                

  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_new_tran']; ?></u></strong></p>                     

<div class="row clearfix">

<div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>

<div class="col-md-10"><input name="product_order_id" type="hidden" id="product_order_id" value="<? echo $product_order_row['product_order_id']; ?>" /><input type="text" id="datepicker" name="date_register" value="<? echo $product_order_row['product_order_register']; ?>" class="nxt_tab" disabled="disabled"></div>

</div>

<div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['users_name_buy']; ?>:</strong></div>

<div class="col-md-10 typehead_supplier"><input name="users_code" type="text" class="textbox firstin" id="users_code" value="<? echo $product_order_row['users_code']; ?> - <? echo $product_order_row['users_name']; ?>" required="required" rel="product_order_code" readonly="readonly"></div>

</div>



<div class="row clearfix">

<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_code']; ?>:</strong></div>

<div class="col-md-10"><input name="product_order_code" type="text" class="textbox" id="product_order_code" value="<? echo $product_order_row['product_order_code']; ?>" readonly="readonly"></div>

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

<table class="table table-bordered product_order_buy">

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

  <tbody class="dyn_product_order_buy">
    
    <?

  $product_orderdetails_list=$global->tbl_list("product_orderdetails","*","product_order_id='".$product_order_row['product_order_id']."'","",1);

  for($i=0;$i<count($product_orderdetails_list);$i++){

  $j=$i+1;

  //get bcode

  $product_row=$global->product_order->db_row("product","*","product_code='".$product_orderdetails_list[$i]['product_code']."'");
  $product_bcode=$product_row['product_code']." - ".$product_row['product_name'];
	$sum_row=$global->db_qry_data("SELECT 
	IFNULL(SUM(product_orderdetails_po_real.product_orderdetails_po_qty), 0) AS sum_po_qty
	FROM product_orderdetails_po_real
	WHERE product_orderdetails_po_real.product_orderdetails_id='".$product_orderdetails_list[$i]['product_orderdetails_id']."'
	GROUP BY product_orderdetails_po_real.product_orderdetails_id
	ORDER BY product_orderdetails_po_real.product_orderdetails_id ASC");
	$realize_po_qty=0;
	if($sum_row['select_num']>0){
	$realize_po_qty=$sum_row['select_data'][0]['sum_po_qty'];
	}
	$residu_po_qty=$product_orderdetails_list[$i]['product_orderdetails_quantity']-$realize_po_qty;

  ?>	
    
    <tr id="inner<? echo $j; ?>">
      
      <td class="listnum_product_order_buy"><? echo $j; ?></td>
      
      <td><div class="product_bcode"><? echo $product_bcode; ?></div></td>
      
      <td><div class="product_orderdetails_quantity"><? echo $product_orderdetails_list[$i]['product_orderdetails_quantity']; ?></div></td>
      
      <td><div class="product_orderdetails_discount"><? echo $realize_po_qty; ?></div></td>
      <td><div class="product_orderdetails_discount"><? echo $residu_po_qty; ?></div></td>
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

                                

                                

  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_new_tran']; ?></u></strong></p>                     



<div class="col-md-6">

  <div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['author_name']; ?>:</strong></div>

<div class="col-md-8"><select name="author_code" class="textbox selectbox hotkey" id="author_code" required="required">
                      <option value=""<? if($author_row['contact_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("contact","*","contact_type='author'","contact_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['contact_code']; ?>"<? if($author_row['contact_code']==$select_list[$i_list]['contact_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['contact_name']; ?></option>
					  <?
							}
						?>
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

<div class="col-md-8"><input name="product_order_discount" type="text" class="textbox product_order_buy_total" id="product_order_discount" value="<? echo $product_order_row['product_order_discount']; ?>" size="5">% <input name="product_order_discount_val" type="text" class="textbox masknumber" id="product_order_discount_val" value="<? echo $product_orderdetails_discount_val_tot; ?>">

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

<div class="col-md-8"><input name="product_order_cost" type="text" class="textbox product_order_buy_total masknumber" id="product_order_cost" value="<? echo $product_order_row['product_order_cost']; ?>">

</div>

</div>



  <div class="row clearfix">

  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_total']; ?>:</strong></div>

<div class="col-md-8"><input readonly="readonly" name="product_order_total" type="text" class="textbox" id="product_order_total" value="<? echo $product_order_amount_format; ?>">

  <input name="product_order_total_hidden" type="hidden" id="product_order_total_hidden" value="<? echo $product_order_amount; ?>" />

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

                                

<div>&nbsp;</div>

                                </div><!-- /.box-header --><!-- /.box-body -->

                            </div>                        

                        

                        </div>

                    </form></div>



                </section><!-- /.content -->

            </aside><!-- /.right-side -->
