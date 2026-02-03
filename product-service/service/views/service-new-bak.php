            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_sale_new']; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                         <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Servis</a></li>
                        <li><a href="service.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_sale']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_sale_new']; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row"><form action="service-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
                        <div class="col-xs-12">
                        
                        <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                                
                                
<p class="title-header"><strong><u>Data Kendaraan</u></strong></p>
<div class="row clearfix">
<div class="col-md-6">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_code']; ?>:</strong></div>
<div class="col-md-8 typehead_motorcycle"><input name="service_order_id" type="hidden" id="service_order_id" value="0" /><input name="users_code_hidden" type="hidden" id="users_code_hidden" value="0" /><input name="users2_code_hidden" type="hidden" id="users2_code_hidden" value="0" /><input name="motorcycle_code" type="text" class="textbox masktxtup firstin" id="motorcycle_code" required="required" rel="motorcycle_type_code">&nbsp;<a href="javascript:;" id="motorcycle_view_alink"> <i class="fa fa-edit fa-lg"></i> </a></div>
</div>

<div class="row clearfix append_div_motorcycle_type">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name']; ?>:</strong></div>
  <div class="col-md-8 typehead_motorcycle_type"><input name="motorcycle_type_code" type="text" class="textbox" id="motorcycle_type_code" required="required" rel="motorcycle_machine_no"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_machine_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_machine_no" type="text" class="textbox" id="motorcycle_machine_no"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_buy_register']; ?>:</strong></div>
  <div class="col-md-8"><input type="text" id="motorcycle_buy_register" name="motorcycle_buy_register" class="datepicker nxt_tab mdate" value="" placeholder="dd/mm/yyyy"><span id="motorcycle_numdays" class="red">&nbsp;</span></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_book_service_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_book_service_no" type="text" class="textbox" id="motorcycle_book_service_no"></div>
</div>


<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_frame_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_frame_no" type="text" class="textbox" id="motorcycle_frame_no"></div>
</div>

</div>

<div class="col-md-6">

  <div class="row clearfix append_div_color">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['color_name']; ?>:</strong></div>
  <div class="col-md-8"><select name="color_code" class="textbox selectbox" id="color_code" rel="motorcycle_manufacture">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("color","*","","color_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['color_code']; ?>"><? echo $select_list[$i_list]['color_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_manufacture']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_manufacture" type="text" class="textbox" id="motorcycle_manufacture"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_description']; ?>:</strong></div>
<div class="col-md-8">
  <textarea name="motorcycle_description" cols="30" rows="7" class="textbox" id="motorcycle_description"></textarea>
</div>
</div>
</div>
<div class="col-md-12"><a class="btn btn-info btn_history" id="btn_history"><i class="fa fa-edit"></i><span> History Kendaraan</span></a></div>
</div>

<hr>
<p class="title-header"><strong><u>Data Pemilik</u></strong></p>

<div class="row clearfix">
<div class="col-md-6">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_owner_name']; ?>:</strong></div>
<div class="col-md-8 typehead_customer"><input name="users_code" type="text" class="textbox" id="users_code" required="required" rel="users_name" placeholder="Ketik Kode/Nama">&nbsp;<a href="javascript:;" id="customer_view_alink"> <i class="fa fa-edit fa-lg"></i> </a></div>
</div>


<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?>:</strong></div>
  <div class="col-md-8"><input name="users_name" type="text" class="textbox users_edit" id="users_name" required="required"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_phone']; ?>:</strong></div>
  <div class="col-md-8"><input name="users_phone" type="text" class="textbox users_edit" id="users_phone" required="required"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?>:</strong></div>
  <div class="col-md-8"><textarea name="users_address" cols="30" rows="4" class="textbox users_edit" id="users_address" required="required"></textarea></div>
</div>
<div class="row clearfix append_div_area">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['area_name']; ?>:</strong></div>
<div class="col-md-8"><select name="area_code" class="textbox selectbox" id="area_code" required="required">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("area","*","","area_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['area_code']; ?>"><? echo $select_list[$i_list]['area_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>

</div>
<div class="col-md-6">
  
  
  <div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?>:</strong></div>
  <div class="col-md-8"><select name="users_status" class="textbox users_edit" id="users_status">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['users_status']);$list_inc++){?>
    <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['users_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_status'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>

  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_email']; ?>:</strong></div>
  <div class="col-md-8"><input name="users_email" type="text" class="textbox users_edit" id="users_email"></div>
</div>

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_idnumber']; ?>:</strong></div>
  <div class="col-md-8"><input name="users_idnumber" type="text" class="textbox users_edit" id="users_idnumber"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['religion_name']; ?>:</strong></div>
<div class="col-md-8"><select name="religion_code" class="textbox selectbox" id="religion_code">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("religion","*","","religion_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['religion_code']; ?>"><? echo $select_list[$i_list]['religion_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['city_name']; ?>:</strong></div>
<div class="col-md-8"><select name="city_code" class="textbox selectbox" id="city_code">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("city","*","","city_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['city_code']; ?>"><? echo $select_list[$i_list]['city_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
</div>
</div>

<hr>
<p class="title-header"><strong><u>Data Pembawa</u></strong></p>

<div class="row clearfix">
<div class="col-md-12">
  <input name="users_clone" type="checkbox" id="users_clone" checked="checked" /> <span class="red">Pembawa Sama Dengan Pemilik.</span>
</div>
<div class="col-md-12">&nbsp;</div>
<div class="clone_area" style="display:none">
<div class="col-md-6">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_users']; ?>:</strong></div>
<div class="col-md-8 typehead_customer"><input name="users2_code" type="text" class="textbox" id="users2_code" required="required" rel="users2_name" placeholder="Ketik Kode/Nama">&nbsp;<a href="javascript:;" id="customer2_view_alink"> <i class="fa fa-edit fa-lg"></i> </a></div>
</div>


<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?>:</strong></div>
  <div class="col-md-8"><input name="users2_name" type="text" class="textbox" id="users2_name" required="required"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_phone']; ?>:</strong></div>
  <div class="col-md-8"><input name="users2_phone" type="text" class="textbox" id="users2_phone" required="required"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?>:</strong></div>
  <div class="col-md-8"><textarea name="users2_address" cols="30" rows="4" class="textbox" id="users2_address" required="required"></textarea></div>
</div>

<div class="row clearfix append_div_area">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['area_name']; ?>:</strong></div>
<div class="col-md-8"><select name="area2_code" class="textbox selectbox" id="area2_code" required="required">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("area","*","","area_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['area_code']; ?>"><? echo $select_list[$i_list]['area_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>

</div>
<div class="col-md-6">
  
  
  <div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?>:</strong></div>
  <div class="col-md-8"><select name="users2_status" class="textbox" id="users2_status">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['users_status']);$list_inc++){?>
    <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['users_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_status'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>

  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_email']; ?>:</strong></div>
  <div class="col-md-8"><input name="users2_email" type="text" class="textbox" id="users2_email"></div>
</div>

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_idnumber']; ?>:</strong></div>
  <div class="col-md-8"><input name="users2_idnumber" type="text" class="textbox" id="users2_idnumber"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['religion_name']; ?>:</strong></div>
<div class="col-md-8"><select name="religion2_code" class="textbox selectbox" id="religion2_code">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("religion","*","","religion_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['religion_code']; ?>"><? echo $select_list[$i_list]['religion_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['city_name']; ?>:</strong></div>
<div class="col-md-8"><select name="city2_code" class="textbox selectbox" id="city2_code">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("city","*","","city_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['city_code']; ?>"><? echo $select_list[$i_list]['city_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
</div>
</div>
</div>
<div class="clear">&nbsp;</div>
<hr>


  <p class="title-header"><strong><u>Data Service</u></strong></p>                     

<div class="row clearfix">
<div class="col-md-6">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-8"><input type="text" id="date_register" name="date_register" value="<? echo $date_def; ?>" class="nxt_tab datepicker" required="required"></div>
</div>


<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_code']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_code" type="text" class="textbox" id="service_order_code" value="<? echo $service_order_sale_code_generation;?>" required="required" readonly="readonly"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_queue']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_queue" type="text" class="textbox" id="service_order_queue" value="<? echo $service_order_queue_generation;?>" size="5" required="required" readonly="readonly"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_description']; ?>:</strong></div>
<div class="col-md-8"><textarea name="service_order_description" cols="30" rows="5" class="textbox" id="service_order_description"></textarea></div>
</div>
</div>
<div class="col-md-6">

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_reason']; ?>:</strong></div>
<div class="col-md-8">
  <select name="service_order_reason" id="service_order_reason">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['service_order_reason']);$list_inc++){?>
    <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['service_order_reason'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['service_order_reason'][$list_inc][1]; ?></option>
    <? }?>
  </select>
</div>
</div>

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_usersowner_rel']; ?>:</strong></div>
<div class="col-md-8">
  <select name="service_order_usersowner_rel" id="service_order_usersowner_rel">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['service_order_usersowner_rel']);$list_inc++){?>
    <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['service_order_usersowner_rel'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['service_order_usersowner_rel'][$list_inc][1]; ?></option>
    <? }?>
  </select>
</div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_km_now']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_km_now" type="text" class="textbox" id="service_order_km_now" size="5" placeholder="0" required="required"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_km_next']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_km_next" type="text" class="textbox" id="service_order_km_next" placeholder="0" size="5" required="required"></div>
</div>
</div>
</div>



<div class="clear">&nbsp;</div>
                        </div><!-- /.box-body -->
                          </div>
                        
                        
                        
                            <div class="clear">&nbsp;</div>
                            <div class="box box-danger">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_service_list']; ?></u></strong></p>
                                  <div class="clear">&nbsp;</div>                                
                                
    
<div class="table-responsive">
<table class="table table-bordered service_order_sale">
  <thead>
  <tr>
    <th height="25" align="center">#</th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_code']; ?> - <? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_name']; ?>
    </th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_sprice']; ?>
    </th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_quantity']; ?>
    </th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_discount']; ?></th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_discount_val']; ?></th>
    <th class="td_hide"><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_tax']; ?></th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_subtotal']; ?>
      </th>
    <th class="td_hide"><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_shtquantity']; ?></th>
    <th class="td_hide"><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_spoquantity']; ?></th>
    <th class="td_hide"><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_quantity']; ?></th>
    <th class="td_hide"><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_bpoquantity']; ?></th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td class="typehead_service">
    <input name="service_scode" type="text" class="textbox" id="service_scode" rel="service_orderdetails_quantity" />&nbsp;<a href="javascript:;" id="service_view_alink"> <i class="fa fa-edit fa-lg"></i> </a>
    </td>
    <td>
      <input name="service_orderdetails_price" type="text" class="textbox service_order_sale masknumber" id="service_orderdetails_price" value="" size="10" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" />
      <input name="service_orderdetails_bprice_hidden" id="service_orderdetails_bprice_hidden" type="hidden" value="" /><input name="kpb_service_yesno_hidden" id="kpb_service_yesno_hidden" type="hidden" value="0" />
    </td>
    <td>
      <input name="service_orderdetails_quantity" type="text" class="textbox service_order_sale" id="service_orderdetails_quantity" value="" size="5" />
    </td>
    <td><input name="service_orderdetails_discount" type="text" class="textbox service_order_sale" id="service_orderdetails_discount" value="" size="5" /></td>
    <td><input name="service_orderdetails_discount_val" type="text" class="textbox service_order_sale masknumber lastinlist" id="service_orderdetails_discount_val" value="" size="10" /></td>
    <td class="td_hide"><input name="service_orderdetails_tax" type="text" class="textbox service_order_sale" id="service_orderdetails_tax" value="" size="5" /></td>
    <td>
      <input name="service_orderdetails_subtotal" type="text" class="textbox" id="service_orderdetails_subtotal" value="" size="15" readonly="readonly" />
      </td>
    <td class="td_hide"><input name="service_shtquantity_hidden" id="service_shtquantity_hidden" type="hidden" value="" /><span class="service_shtquantity"></span></td>
    <td class="td_hide"><input name="service_spoquantity_hidden" id="service_spoquantity_hidden" type="hidden" value="" /><span class="service_spoquantity"></span></td>
    <td class="td_hide"><input name="service_quantity_hidden" id="service_quantity_hidden" type="hidden" value="" /><span class="service_quantity"></span></td>
    <td class="td_hide"><input name="service_bpoquantity_hidden" id="service_bpoquantity_hidden" type="hidden" value="" /><span class="service_bpoquantity"></span></td>
    <td><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="service_order_sale();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></td>
  </tr>
  <tbody class="dyn_service_order_sale">
        </tbody>
               </table>
        <div id="service_ov_flw">
        <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
        <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
        <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
        <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
        <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
		</div>
                                 </div>   
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                            <div class="clear">&nbsp;</div>
                            <div class="box box-danger">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_product_list']; ?></u></strong></p>
                                  <div class="clear">&nbsp;</div>                                
                                
    
<div class="table-responsive">
<table class="table table-bordered product_order_sale">
  <thead>
  <tr>
    <th height="25" align="center">#</th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?> - <? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_name']; ?>
    </th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_sprice']; ?>
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
    <input name="product_scode" type="text" class="textbox hotkey" id="product_scode" rel="product_orderdetails_quantity" />&nbsp;<a href="javascript:;" id="product_view_alink"> <i class="fa fa-edit fa-lg"></i> </a>
    </td>
    <td>
      <input name="product_orderdetails_price" type="text" class="textbox product_order_sale masknumber" id="product_orderdetails_price" value="" size="10" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" />
      <input name="product_orderdetails_bprice_hidden" id="product_orderdetails_bprice_hidden" type="hidden" value="" /><input name="kpb_product_yesno_hidden" id="kpb_product_yesno_hidden" type="hidden" value="0" />
    </td>
    <td>
      <input name="product_orderdetails_quantity" type="text" class="textbox product_order_sale" id="product_orderdetails_quantity" value="" size="5" />
    </td>
    <td><input name="product_orderdetails_discount" type="text" class="textbox product_order_sale" id="product_orderdetails_discount" value="" size="5" /></td>
    <td><input name="product_orderdetails_discount_val" type="text" class="textbox product_order_sale masknumber lastinlist" id="product_orderdetails_discount_val" value="" size="10" /></td>
    <td class="td_hide"><input name="product_orderdetails_tax" type="text" class="textbox product_order_sale" id="product_orderdetails_tax" value="" size="5" /></td>
    <td>
      <input name="product_orderdetails_subtotal" type="text" class="textbox" id="product_orderdetails_subtotal" value="" size="15" readonly="readonly" />
      </td>
    <td><input name="product_shtquantity_hidden" id="product_shtquantity_hidden" type="hidden" value="" /><span class="product_shtquantity"></span></td>
    <td><input name="product_spoquantity_hidden" id="product_spoquantity_hidden" type="hidden" value="" /><span class="product_spoquantity"></span></td>
    <td><input name="product_quantity_hidden" id="product_quantity_hidden" type="hidden" value="" /><span class="product_quantity"></span></td>
    <td><input name="product_bpoquantity_hidden" id="product_bpoquantity_hidden" type="hidden" value="" /><span class="product_bpoquantity"></span></td>
    <td><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="product_order_sale();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></td>
  </tr>
  <tbody class="dyn_product_order_sale">
        </tbody>
               </table>
               <div id="product_ov_flw">
                <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
                <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
                <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
                <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
                <div class="clear hidden-xs hidden-sm hidden-md hidden-lg">&nbsp;</div>
                </div>
                                 </div>   
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            
<div class="clear">&nbsp;</div>   

<div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
                                
  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_desc']; ?></u></strong></p>                     

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_express']; ?>:</strong></div>
<div class="col-md-8">
  <select name="service_order_express" id="service_order_express">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['service_order_express']);$list_inc++){?>
    <option<? if($service_order_row['service_order_express']==$form_selectlist_lang['service_order_express'][$list_inc][0]){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['service_order_express'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['service_order_express'][$list_inc][1]; ?></option>
    <? }?>
  </select>
</div>
</div>

<div class="col-md-6">
  <div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['author_name']; ?>:</strong></div>
<div class="col-md-8 typehead_author"><input name="author_code" type="text" class="textbox" id="author_code"></div>
</div>
  
</div>

<div class="col-md-6">

<div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_discount']; ?>:</strong></div>
<div class="col-md-8 typehead_supplier"><input name="service_order_discount" type="text" class="textbox service_order_sale_total" id="service_order_discount" value="0" size="5">% <input name="service_order_discount_val" type="text" class="textbox masknumber" id="service_order_discount_val">
<input name="service_order_discount_val_hidden" type="hidden" id="service_order_discount_val_hidden" value="" />
</div>
</div>

  <div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_subtotal']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="service_orderdetails_total" type="text" class="textbox" id="service_orderdetails_total">
  <input name="service_orderdetails_total_hidden" type="hidden" id="service_orderdetails_total_hidden" value="" />
</div>
</div>

  <div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_tax']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="service_order_tax" type="text" class="textbox" id="service_order_tax">
  <input name="service_order_tax_hidden" type="hidden" id="service_order_tax_hidden" value="" />
</div>
</div>

  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_kpb_service']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="service_order_kpb_service" type="text" class="textbox masknumber" id="service_order_kpb_service" value="0"><input name="service_order_kpb_service_hidden" type="hidden" id="service_order_kpb_service_hidden" value="0" />
</div>
</div>

  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_kpb_product']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="service_order_kpb_product" type="text" class="textbox masknumber" id="service_order_kpb_product" value="0"><input name="service_order_kpb_product_hidden" type="hidden" id="service_order_kpb_product_hidden" value="0" />
<input name="service_order_discount_kpb" type="hidden" id="service_order_discount_kpb" value="0" />
<input name="service_order_tax_kpb" type="hidden" id="service_order_tax_kpb" value="0" />
<input name="income_trade_kpb" type="hidden" id="income_trade_kpb" value="0" />
<input name="stock_trade_kpb" type="hidden" id="stock_trade_kpb" value="0" />
<input name="income_service_kpb" type="hidden" id="income_service_kpb" value="0" />
</div>
</div>


  <div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_cost']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_cost" type="text" class="textbox service_order_sale_total masknumber" id="service_order_cost" value="0">
</div>
</div>

  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_total']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="service_order_total" type="text" class="textbox" id="service_order_total">
  <input name="service_order_total_hidden" type="hidden" id="service_order_total_hidden" value="" /><input name="income_trade_hidden" type="hidden" id="income_trade_hidden" value="" /><input name="stock_trade_hidden" type="hidden" id="stock_trade_hidden" value="" /><input name="income_service_hidden" type="hidden" id="income_service_hidden" value="" />
</div>
</div>

</div>

<div class="clear">&nbsp;</div>
            </div><!-- /.box-body -->
                          </div><!-- /.box -->    
                          
<div class="clear">&nbsp;</div>

<div class="box box-info" style="display:none">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
                                
  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_pay']; ?></u></strong></p>                     

<div class="row clearfix">
  <div class="col-md-12">
  <div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_pay']; ?>:</strong></div>
<div class="col-md-10">
    <label>
      <input name="service_order_buy_pay" type="radio" id="service_order_buy_pay1_0" value="cash" checked="checked" />
      Tunai</label>
     <label>
      <input type="radio" name="service_order_buy_pay" value="credit" id="service_order_buy_pay1_2" />
      Kredit</label>
</div>
</div>
<div class="row clearfix" id="service_order_buy_pay_cash">
<div class="col-md-2"><strong>Tunai/Cash:</strong></div>
<div class="col-md-10"><input readonly="readonly" name="service_order_total_cash" type="text" class="textbox" id="service_order_total_cash" placeholder="0">
  &nbsp;&nbsp;Rekening:&nbsp; 
    <select name="service_order_accountpay_cash" class="textbox" id="service_order_accountpay_cash">
              <?
			$global->product_order->book->account_special_create(array("cash"),0);
			?>
              </select>&nbsp;<a href="#calc_modal" data-toggle="modal" data-target="#calc_modal"> <i class="fa fa-calculator" aria-hidden="true"></i>
 </a>
</div>
</div>

<div class="row clearfix" id="service_order_buy_pay_bank" style="display:none">
<div class="col-md-2"><strong>Transfer Bank:</strong></div>
<div class="col-md-10"><input readonly="readonly" name="service_order_total_bank" type="text" class="textbox" id="service_order_total_bank" placeholder="0">
  &nbsp;&nbsp;Nama Bank:&nbsp;
  <select name="bank_code" class="textbox" id="bank_code">
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
    <select name="service_order_accountpay_bank" class="textbox" id="service_order_accountpay_bank">
              <?
			$global->product_order->book->account_special_create(array("bank"),0);
			?>
              </select>
</div>
</div>

<div class="row clearfix" id="service_order_buy_pay_credit" style="display:none">
<div class="col-md-2"><strong>Kredit:</strong></div>
<div class="col-md-10"><input readonly="readonly" name="service_order_total_credit" type="text" class="textbox" id="service_order_total_credit" placeholder="0">
  &nbsp;&nbsp;Rekening:&nbsp; 
    <select name="service_order_accountpay_credit" class="textbox" id="service_order_accountpay_credit">
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
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['save_button']; ?>  (F5)</button>&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='service-new.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
</div>
<div>&nbsp;</div>
                                </div><!-- /.box-header --><!-- /.box-body -->
                            </div>                        
                        
                        </div>
                    </form></div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->


<div class="modal fade" id="myModalservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="form" id="form_service_order"><input name="service_order_id" type="hidden" id="service_order_id" value="0" /><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" />
<input name="service_orderdetails_bprice_hidden" id="service_orderdetails_bprice_hidden" type="hidden" value="" /><input name="service_shtquantity_hidden" id="service_shtquantity_hidden" type="hidden" value="" />
<input name="service_spoquantity_hidden" id="service_spoquantity_hidden" type="hidden" value="" />
<input name="service_quantity_hidden" id="service_quantity_hidden" type="hidden" value="" />
<input name="service_bpoquantity_hidden" id="service_bpoquantity_hidden" type="hidden" value="" />
<input name="kpb_service_yesno_hidden" id="kpb_service_yesno_hidden" type="hidden" value="0" />
  
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_edit']; ?></u></strong></p>
<div>&nbsp;</div>
   </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_code']; ?>:</strong></div>
<div class="col-md-8"><input name="service_scode" type="text" class="textbox" id="service_scode" required="required" disabled="disabled">
  <span id="service_scode_label">&nbsp;</span></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_sprice']; ?>:</strong></div>
<div class="col-md-8">
              <input name="service_orderdetails_price" type="text" class="textbox firstin masknumber" id="service_orderdetails_price" value="" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_quantity']; ?>:</strong></div>
<div class="col-md-8">
              <input name="service_orderdetails_quantity" type="text" class="textbox" id="service_orderdetails_quantity" value="" required="required"></div>
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
<div class="col-md-8"><button name="Submit" class="btn btn-primary service_order_sale_edit_details2" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>                               
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="form_product_order" id="form_product_order"><input name="service_order_id" type="hidden" id="service_order_id" value="0" /><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" />
<input name="product_orderdetails_bprice_hidden" id="product_orderdetails_bprice_hidden" type="hidden" value="" /><input name="product_shtquantity_hidden" id="product_shtquantity_hidden" type="hidden" value="" />
<input name="product_spoquantity_hidden" id="product_spoquantity_hidden" type="hidden" value="" />
<input name="product_quantity_hidden" id="product_quantity_hidden" type="hidden" value="" />
<input name="product_bpoquantity_hidden" id="product_bpoquantity_hidden" type="hidden" value="" />
<input name="kpb_product_yesno_hidden" id="kpb_product_yesno_hidden" type="hidden" value="0" />
  
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_edit']; ?></u></strong></p>
<div>&nbsp;</div>
   </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?>:</strong></div>
<div class="col-md-8"><input name="product_scode" type="text" class="textbox" id="product_scode" required="required" disabled="disabled">
  <span id="product_scode_label">&nbsp;</span></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_sprice']; ?>:</strong></div>
<div class="col-md-8">
              <input name="product_orderdetails_price" type="text" class="textbox firstin masknumber" id="product_orderdetails_price" value="" required="required"></div>
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

<div class="modal fade" id="myModalkpb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="form_kpb" id="form_kpb"><input name="kpb_online_num" type="hidden" id="kpb_online_num" value="0" />
  
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_kpb']; ?></u></strong></p>
<div>&nbsp;</div>
   </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_machine_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_machine_no" type="text" class="textbox firstin" id="motorcycle_machine_no" value="" required="required"></div>
</div>
<div class="row clearfix append_div">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name']; ?>:</strong></div>
  <div class="col-md-8 typehead_motorcycle_type"><input name="motorcycle_type_code" type="text" class="textbox" id="motorcycle_type_code_kpb" value="" required="required" rel="motorcycle_buy_register"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_buy_register']; ?>:</strong></div>
  <div class="col-md-8"><input type="text" id="motorcycle_buy_register" name="motorcycle_buy_register" value="" class="nxt_tab datepicker"  required="required"><span id="motorcycle_numdays" class="red">&nbsp;</span></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_book_service_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_book_service_no" type="text" class="textbox" id="motorcycle_book_service_no" value="" required="required"></div>
</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="btn_kpb_edit" class="btn btn-primary btn_kpb_edit" id="btn_kpb_edit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div> 
</form> 
                              
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
<? $modal=true; $popup=true; //include ("../../users/views/customer-new.php"); ?>
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

<div class="modal fade" id="motorcycle_new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="motorcycle_new_modal_form" id="motorcycle_new_modal_form">
  
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; $checkbox=true;  include ("../inventory/views/motorcycle-new.php"); ?>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="motorcycle_new_modal_btn_new" class="btn btn-primary motorcycle_new_modal_btn_new" id="motorcycle_new_modal_btn_new"><? echo $form_header_lang['add_new_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>  
</form> 
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="customer_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="customer_edit_modal_form" id="customer_edit_modal_form">
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; $popup_edit=true; //include ("../../users/views/customer-new.php"); ?>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="customer_edit_modal_btn_edit" class="btn btn-primary customer_edit_modal_btn_edit" id="customer_edit_modal_btn_edit"><? echo $form_header_lang['edit_popup_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>  
</form>
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="customer_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ("../../users/views/customer-popup.php"); ?>
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="customer2_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ("../../users/views/customer-popup.php"); ?>
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="motorcycle_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="motorcycle_edit_modal_form" id="motorcycle_edit_modal_form">
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; $checkbox=false; $popup_edit=true; include ("../inventory/views/motorcycle-new.php"); ?>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="motorcycle_edit_modal_btn_edit" class="btn btn-primary motorcycle_edit_modal_btn_edit" id="motorcycle_edit_modal_btn_edit"><? echo $form_header_lang['edit_popup_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>  
</form>
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="motorcycle_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ("../inventory/views/motorcycle-popup.php"); ?>
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="calc_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="form_calc" id="form_calc">
  
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_calc']; ?></u></strong></p>
<div>&nbsp;</div>
   </div><!-- /.box-header -->

     <div class="clear">&nbsp;</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_calc_bill']; ?>:</strong></div>
  <div class="col-md-8"><input name="product_order_calc_bill" type="text" class="textbox firstin" id="product_order_calc_bill" value="" required="required" readonly="readonly"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_calc_pay']; ?>:</strong></div>
  <div class="col-md-8"><input name="product_order_calc_pay" type="text" class="textbox firstin" id="product_order_calc_pay" value="" required="required"></div>
</div>
<div class="row clearfix append_div">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_calc_balance']; ?>:</strong></div>
  <div class="col-md-8"><input name="product_order_calc_balance" type="text" class="textbox" id="product_order_calc_balance" value="" required="required" readonly="readonly"></div>
</div>
</form> 
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary btn_calc" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>                               
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="service_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ("../inventory/views/service-popup.php"); ?>
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