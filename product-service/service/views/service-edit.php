            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
            
            <? if($btn_status=="btn_pmn"){ ?>
            <section data-spy="affix" data-offset-top="50" class="total content">
                    <div class="col-md-12"><strong>Total: Rp <span class="amount_total"><? echo $service_order_amount_format; ?></span></strong></div>
            </section>
            <? } ?>
                            
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
                    <div class="row"><form action="service-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
                        <div class="col-xs-12">
                        
                        <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                                
                                
<p class="title-header"><strong><u>Data Kendaraan</u></strong></p>
<div class="row clearfix">
<div class="col-md-6">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_code']; ?>:</strong><input name="service_order_id" type="hidden" id="service_order_id" value="<? echo $service_order_row['service_order_id']; ?>" /><input name="users_code_hidden" type="hidden" id="users_code_hidden" value="1" /><input name="users2_code_hidden" type="hidden" id="users2_code_hidden" value="1" /><input name="service_order_status" type="hidden" id="service_order_status" value="<? echo $service_order_status; ?>" /><input name="btn_status" type="hidden" id="btn_status" value="<? echo $btn_status; ?>" /></div>
<div class="col-md-8 typehead_motorcycle"><input name="motorcycle_code" type="text" class="textbox masktxtup firstin" id="motorcycle_code" required="required" value="<? echo $motorcycle_code; ?>" rel="motorcycle_type_code">&nbsp;<a href="javascript:;" id="motorcycle_view_alink"> <i class="fa fa-edit fa-lg"></i> </a></div>
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
<div class="col-md-8"><select name="area_code" class="textbox selectbox users_edit" id="area_code" required="required">
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
<div class="col-md-8"><select name="religion_code" class="textbox selectbox users_edit" id="religion_code">
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
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['village_name']; ?>:</strong></div>
<div class="col-md-8 typehead_village"><input name="village_code" type="text" class="textbox users_edit" id="village_code"></div>
</div>
</div>
</div>

<hr>
<p class="title-header"><strong><u>Data Pembawa</u></strong></p>

<div class="row clearfix">
<div class="col-md-12">
  <input name="users_clone" type="checkbox" id="users_clone"<? if($users_clone_check==1){?> checked="checked"<? }?> /> <span class="red">Pembawa Sama Dengan Pemilik.</span>
</div>
<div class="col-md-12">&nbsp;</div>
<div class="clone_area"<? if($users_clone_check==1){?> style="display:none"<? }?>>
<div class="col-md-6">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_users']; ?>:</strong></div>
<div class="col-md-8 typehead_customer"><input name="users2_code" type="text" class="textbox" id="users2_code" required="required" rel="users2_name" value="<? echo $users2_code; ?>" placeholder="Ketik Kode/Nama">&nbsp;<a href="javascript:;" id="customer2_view_alink"> <i class="fa fa-edit fa-lg"></i> </a></div>
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
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['village_name']; ?>:</strong></div>
<div class="col-md-8 typehead_village"><input name="village2_code" type="text" class="textbox" id="village2_code"></div>
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
<div class="col-md-8"><input type="text" id="date_register" name="date_register" value="<? echo $service_order_row['service_order_register']; ?>" class="nxt_tab datepicker" required="required"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_code']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_code" type="text" class="textbox" id="service_order_code" value="<? echo $service_order_row['service_order_code']; ?>" required="required" readonly="readonly"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_queue']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_queue" type="text" class="textbox" id="service_order_queue" value="<? echo $service_order_row['service_order_queue']; ?>" size="5" required="required" readonly="readonly"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_description']; ?>:</strong></div>
<div class="col-md-8"><textarea name="service_order_description" cols="30" rows="5" class="textbox" id="service_order_description"><? echo $service_order_row['service_order_description']; ?></textarea></div>
</div>
</div>
<div class="col-md-6">

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_reason']; ?>:</strong></div>
<div class="col-md-8">
  <select name="service_order_reason" id="service_order_reason">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['service_order_reason']);$list_inc++){?>
    <option<? if($service_order_row['service_order_reason']==$form_selectlist_lang['service_order_reason'][$list_inc][0]){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['service_order_reason'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['service_order_reason'][$list_inc][1]; ?></option>
    <? }?>
  </select>
</div>
</div>

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_usersowner_rel']; ?>:</strong></div>
<div class="col-md-8">
  <select name="service_order_usersowner_rel" id="service_order_usersowner_rel">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['service_order_usersowner_rel']);$list_inc++){?>
    <option<? if($service_order_row['service_order_usersowner_rel']==$form_selectlist_lang['service_order_usersowner_rel'][$list_inc][0]){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['service_order_usersowner_rel'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['service_order_usersowner_rel'][$list_inc][1]; ?></option>
    <? }?>
  </select>
</div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_km_now']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_km_now" type="text" class="textbox" id="service_order_km_now" size="5" required="required" value="<? echo $service_order_row['service_order_km_now']; ?>" placeholder="0"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_km_next']; ?>:</strong></div>
<div class="col-md-8"><input name="service_order_km_next" type="text" class="textbox" id="service_order_km_next" size="5" required="required" value="<? echo $service_order_row['service_order_km_next']; ?>" placeholder="0"></div>
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
    <input name="service_scode" type="text" class="textbox" id="service_scode" rel="service_orderdetails_price" />&nbsp;<a href="javascript:;" id="service_view_alink"> <i class="fa fa-edit fa-lg"></i> </a>
    </td>
    <td>
      <input name="service_orderdetails_bprice_hidden" id="service_orderdetails_bprice_hidden" type="hidden" value="" /><input name="kpb_service_yesno_hidden" id="kpb_service_yesno_hidden" type="hidden" value="0" /><input name="service_orderdetails_price" type="text" class="textbox service_order_sale masknumber" id="service_orderdetails_price" value="" size="10" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" />
      
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
  <?
  $service_orderdetails_discount_val_tot=0;
  $service_orderdetails_list=$global->tbl_list("service_orderdetails","*","service_order_id='".$service_order_row['service_order_id']."'","",1);
  for($i=0;$i<count($service_orderdetails_list);$i++){
  $j=$i+1;
  //get bcode
  $service_row=$global->product_order->db_row("service","*","service_code='".$service_orderdetails_list[$i]['service_code']."'");
  $service_scode=$service_row['service_code']." - ".$service_row['service_name'];
  //get sub total
  $service_orderdetails_price_adisc2=$service_orderdetails_list[$i]['service_orderdetails_price']*(1-(($service_orderdetails_list[$i]['service_orderdetails_discount']+$service_orderdetails_list[$i]['service_orderdetails_disc_final'])/100)+(($service_orderdetails_list[$i]['service_orderdetails_discount']*$service_orderdetails_list[$i]['service_orderdetails_disc_final'])/10000));
  $service_orderdetails_subtotal=$service_orderdetails_price_adisc2*$service_orderdetails_list[$i]['service_orderdetails_quantity'];
  $service_orderdetails_price_format=$global->num_format2($service_orderdetails_list[$i]['service_orderdetails_price']);
  $service_orderdetails_subtotal_format=$global->num_format2($service_orderdetails_subtotal);
  //get discount val
  $service_orderdetails_discount_val=$service_orderdetails_list[$i]['service_orderdetails_price']*($service_orderdetails_list[$i]['service_orderdetails_discount']/100);
  $service_orderdetails_discount_val_format=$global->num_format2($service_orderdetails_discount_val);
  $service_orderdetails_discount_val_tot +=(($service_orderdetails_list[$i]['service_orderdetails_price']-$service_orderdetails_discount_val)*($service_orderdetails_list[$i]['service_orderdetails_disc_final']/100))*$service_orderdetails_list[$i]['service_orderdetails_quantity'];
  //KPB YESNO
  $kpb_service_yesno=$service_orderdetails_list[$i]['kpb_yesno'];
  ?>	
  <tr id="service_inner<? echo $j; ?>">
  <td class="listnum_service_order_sale"><? echo $j; ?></td>
  <td><a href="#" class="link_table service_order_sale_edit"><div class="service_scode"><? echo $service_scode; ?></div><input name="service_scode_hidden[]" type="hidden" value="<? echo $service_scode; ?>"/><input name="kpb_service_yesno_hidden[]" type="hidden" value="<? echo $kpb_service_yesno; ?>"/></a></td>
  <td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_price"><? echo $service_orderdetails_price_format; ?></div><input name="service_orderdetails_price_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_price']; ?>"/><input name="service_orderdetails_bprice_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_bprice']; ?>"/></a></td>
  <td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_quantity"><? echo $service_orderdetails_list[$i]['service_orderdetails_quantity']; ?></div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_quantity']; ?>"/></a></td>
  <td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount"><? echo $service_orderdetails_list[$i]['service_orderdetails_discount']; ?></div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_discount']; ?>"/></a></td>
  <td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount_val"><? echo $service_orderdetails_discount_val_format;?></div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="<? echo $service_orderdetails_discount_val;?>"/></a></td>
  <td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_tax"><? echo $service_orderdetails_list[$i]['service_orderdetails_tax']; ?></div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="<? echo $service_orderdetails_list[$i]['service_orderdetails_tax']; ?>"/></a></td>
  <td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_subtotal"><? echo $service_orderdetails_subtotal_format; ?></div><input class="service_subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="<? echo $service_orderdetails_subtotal; ?>"/></a></td>
  
  <td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_shtquantity">0</div></a></td>
  <td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_spoquantity">0</div></a></td>
  <td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_quantity">0</div></a></td>
  <td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_bpoquantity">0</div></a></td>
  
  <td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>
  </tr>
  <?
		}
  ?>
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
<table class="table table-bordered">
  <thead>
  <tr>
    <th height="25" align="center">#</th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?> - <? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_name']; ?>
    </th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_het_price']; ?>
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
    <input name="product_scode" type="text" class="textbox hotkey" id="product_scode" rel="product_orderdetails_price" />&nbsp;<a href="javascript:;" id="product_view_alink"> <i class="fa fa-edit fa-lg"></i> </a>
    </td>
    <td>
      <input name="product_orderdetails_het_price" type="text" class="textbox product_order_sale masknumber" id="product_orderdetails_het_price" value="" size="10" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" />
      
    </td>
    <td>
      <input name="product_orderdetails_sprice_hidden" id="product_orderdetails_sprice_hidden" type="hidden" value="" /><input name="product_orderdetails_bprice_hidden" id="product_orderdetails_bprice_hidden" type="hidden" value="" /><input name="kpb_product_yesno_hidden" id="kpb_product_yesno_hidden" type="hidden" value="0" /><input name="product_orderdetails_price" type="text" class="textbox product_order_sale masknumber" id="product_orderdetails_price" value="" size="10" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" />
      
    </td>
    <td>
      <input name="product_orderdetails_quantity" type="text" class="textbox product_order_sale" id="product_orderdetails_quantity" value="" size="5" />
    </td>
    <td><input name="product_orderdetails_discount" type="text" class="textbox product_order_sale" id="product_orderdetails_discount" value="" size="5" /></td>
    <td><input name="product_orderdetails_discount_val" type="text" class="textbox masknumber lastinlist" id="product_orderdetails_discount_val" value="" size="10" /></td>
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
  <?
  $product_orderdetails_list=$global->tbl_list("product_orderdetails","*","service_order_id='".$service_order_row['service_order_id']."'","",1);
  for($i=0;$i<count($product_orderdetails_list);$i++){
  $j=$i+1;
  //get bcode
  $product_row=$global->product_order->db_row("product","*","product_code='".$product_orderdetails_list[$i]['product_code']."'");
  
  	$product_shtquantity=$product_row['product_stock_ht'];
	$product_spoquantity=$product_row['product_stock_so'];
	$product_quantity=$product_row['product_stock'];
	$product_bpoquantity=$product_row['product_stock_po'];
		$current_opname=$global->db_fldrow("product","product_stock_opname","product_code='".$product_row['product_code']."'");
		$product_quantity=$product_quantity+$current_opname;
  
  $product_scode=$product_row['product_code']." - ".$product_row['product_name'];
  //get sub total
  $product_orderdetails_price_adisc2=$product_orderdetails_list[$i]['product_orderdetails_price']*(1-(($product_orderdetails_list[$i]['product_orderdetails_discount']+$product_orderdetails_list[$i]['product_orderdetails_disc_final'])/100)+(($product_orderdetails_list[$i]['product_orderdetails_discount']*$product_orderdetails_list[$i]['product_orderdetails_disc_final'])/10000));
  $product_orderdetails_subtotal=$product_orderdetails_price_adisc2*$product_orderdetails_list[$i]['product_orderdetails_quantity'];
  $product_orderdetails_price_format=$global->num_format2($product_orderdetails_list[$i]['product_orderdetails_price']);
  $product_orderdetails_subtotal_format=$global->num_format2($product_orderdetails_subtotal);
  //get discount val
  $product_orderdetails_discount_val=$product_orderdetails_list[$i]['product_orderdetails_price']*($product_orderdetails_list[$i]['product_orderdetails_discount']/100);
  $product_orderdetails_discount_val_format=$global->num_format2($product_orderdetails_discount_val);
  $service_orderdetails_discount_val_tot +=(($product_orderdetails_list[$i]['product_orderdetails_price']-$product_orderdetails_discount_val)*($product_orderdetails_list[$i]['product_orderdetails_disc_final']/100))*$product_orderdetails_list[$i]['product_orderdetails_quantity'];
  //KPB YESNO
  $kpb_product_yesno=$product_orderdetails_list[$i]['kpb_yesno'];
  ?>	
  <tr id="product_inner<? echo $j; ?>">
  <td class="listnum_product_order_sale">#</td>
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_scode"><? echo $product_scode; ?></div><input name="product_scode_hidden[]" type="hidden" value="<? echo $product_scode; ?>"/><input name="kpb_product_yesno_hidden[]" type="hidden" value="<? echo $kpb_product_yesno; ?>"/></a></td>

  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_het_price"><? echo $product_orderdetails_price_format; ?></div></a></td>
  
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_price"><? echo $product_orderdetails_price_format; ?></div><input name="product_orderdetails_price_hidden[]" type="hidden" value="<? echo $product_orderdetails_list[$i]['product_orderdetails_price']; ?>"/><input name="product_orderdetails_bprice_hidden[]" type="hidden" value="<? echo $product_orderdetails_list[$i]['product_orderdetails_bprice']; ?>"/></a></td>
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_quantity"><? echo $product_orderdetails_list[$i]['product_orderdetails_quantity']; ?></div><input name="product_orderdetails_quantity_hidden[]" type="hidden" value="<? echo $product_orderdetails_list[$i]['product_orderdetails_quantity']; ?>"/></a></td>
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount"><? echo $product_orderdetails_list[$i]['product_orderdetails_discount']; ?></div><input name="product_orderdetails_discount_hidden[]" type="hidden" value="<? echo $product_orderdetails_list[$i]['product_orderdetails_discount']; ?>"/></a></td>
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount_val"><? echo $product_orderdetails_discount_val_format;?></div><input name="product_orderdetails_discount_val_hidden[]" type="hidden" value="<? echo $product_orderdetails_discount_val;?>"/></a></td>
  <td class="td_hide"><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_tax"><? echo $product_orderdetails_list[$i]['product_orderdetails_tax']; ?></div><input name="product_orderdetails_tax_hidden[]" type="hidden" value="<? echo $product_orderdetails_list[$i]['product_orderdetails_tax']; ?>"/></a></td>
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_subtotal"><? echo $product_orderdetails_subtotal_format; ?></div><input class="subtotal_hidden" name="product_orderdetails_subtotal_hidden[]" type="hidden" value="<? echo $product_orderdetails_subtotal; ?>"/></a></td>
  
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_shtquantity"><? echo $product_shtquantity; ?></div></a></td>
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_spoquantity"><? echo $product_spoquantity; ?></div></a></td>
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_quantity"><? echo $product_quantity; ?></div></a></td>
  <td><a href="#" class="link_table product_order_sale_edit"><div class="product_bpoquantity"><? echo $product_bpoquantity; ?></div></a></td>
  
  <td><a href="javascript:;" class="btn btn-danger" onclick="remove_product_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>
  </tr>
  <?
		}
  ?>
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

<div class="col-md-6">

<div class="row clearfix"<? if($btn_status==""){?> style="display:none"<? }?>>
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_mechanic']; ?>:</strong></div>
<div class="col-md-8"><a name="anc_staff_code" id="anc_staff_code"></a>
  <select name="staff_code" class="textbox selectbox<? if($btn_status=="btn_proc"){?> firstin<? }?>" id="staff_code"<? if($btn_status!=""){?> required="required"<? }?>>
                      <option value=""<? if($staff_code==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("staff,position","staff.*","staff.position_code=position.position_code AND position.position_code = 'MK'","staff.staff_code",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['staff_code']; ?>"<? if($staff_code==$select_list[$i_list]['staff_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['staff_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>

<div class="row clearfix"<? if($btn_status==""){?> style="display:none"<? }?>>
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_express']; ?>:</strong></div>
<div class="col-md-8">
  <select name="service_order_express" id="service_order_express">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['service_order_express']);$list_inc++){?>
    <option<? if($service_order_row['service_order_express']==$form_selectlist_lang['service_order_express'][$list_inc][0]){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['service_order_express'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['service_order_express'][$list_inc][1]; ?></option>
    <? }?>
  </select>
</div>
</div>

  <div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['author_name']; ?>:</strong></div>
<div class="col-md-8 typehead_author"><input name="author_code" type="text" class="textbox" id="author_code" value="<? echo $author_code; ?>"></div>
</div>
  
</div>

<div class="col-md-6">

<div class="row clearfix" style="display:none">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_discount']; ?>:</strong></div>
<div class="col-md-8 typehead_supplier"><input name="service_order_discount" type="text" class="textbox service_order_sale_total" id="service_order_discount" value="<? echo $service_order_row['service_order_discount']; ?>" size="5">% <input name="service_order_discount_val" type="text" class="textbox masknumber" id="service_order_discount_val" value="<? echo $service_orderdetails_discount_val_tot; ?>">
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
<div class="col-md-8"><input name="service_order_cost" type="text" class="textbox service_order_sale_total masknumber" id="service_order_cost" value="<? echo $service_order_row['service_order_cost']; ?>">
</div>
</div>

  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_kpb_service']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="service_order_kpb_service" type="text" class="textbox masknumber" id="service_order_kpb_service" value="<? echo $service_order_row['service_order_kpb_service']; ?>"><input name="service_order_kpb_service_hidden" type="hidden" id="service_order_kpb_service_hidden" value="<? echo $service_order_row['service_order_kpb_service']; ?>" />
</div>
</div>

  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_kpb_product']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="service_order_kpb_product" type="text" class="textbox masknumber" id="service_order_kpb_product" value="<? echo $service_order_row['service_order_kpb_product']; ?>"><input name="service_order_kpb_product_hidden" type="hidden" id="service_order_kpb_product_hidden" value="<? echo $service_order_row['service_order_kpb_product']; ?>" />
<input name="service_order_discount_kpb" type="hidden" id="service_order_discount_kpb" value="<? echo $service_order_row['service_order_discount_kpb']; ?>" />
<input name="service_order_tax_kpb" type="hidden" id="service_order_tax_kpb" value="<? echo $service_order_row['service_order_tax_kpb']; ?>" />
<input name="income_trade_kpb" type="hidden" id="income_trade_kpb" value="<? echo $service_order_row['income_trade_kpb']; ?>" />
<input name="stock_trade_kpb" type="hidden" id="stock_trade_kpb" value="<? echo $service_order_row['stock_trade_kpb']; ?>" />
<input name="income_service_kpb" type="hidden" id="income_service_kpb" value="<? echo $service_order_row['income_service_kpb']; ?>" />
</div>
</div>

  <div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_total']; ?>:</strong></div>
<div class="col-md-8"><input readonly="readonly" name="service_order_total" type="text" class="textbox" id="service_order_total" value="<? echo $service_order_amount_format; ?>">
  <input name="service_order_total_hidden" type="hidden" id="service_order_total_hidden" value="<? echo $service_order_amount; ?>" /><input name="income_trade_hidden" type="hidden" id="income_trade_hidden" value="<? echo $service_order_row['service_order_income_trade']; ?>" /><input name="stock_trade_hidden" type="hidden" id="stock_trade_hidden" value="<? echo $service_order_row['service_order_stock_trade']; ?>" /><input name="income_service_hidden" type="hidden" id="income_service_hidden" value="<? echo $service_order_row['service_order_income_service']; ?>" />
</div>
</div>

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_memo']; ?>:</strong></div>
<div class="col-md-8"><textarea name="service_order_memo" cols="30" rows="7" class="textbox" id="service_order_memo"><? echo $service_order_row['service_order_memo']; ?></textarea>  
</div>
</div>

</div>

<div class="clear">&nbsp;</div>
            </div><!-- /.box-body -->
                          </div><!-- /.box -->    
                          
<div class="clear">&nbsp;</div>

<div class="box box-info"<? if($service_order_status!="unpaid"){?> style="display:none"<? }?>>
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
                                
  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_pay']; ?></u></strong></p>                     

<div class="row clearfix">
  <div class="col-md-12">
  <div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?> Pembayaran:</strong></div>
<div class="col-md-10"><input type="text" id="date_payregister" name="date_payregister" value="<? echo $date_def; ?>" class="nxt_tab datepicker" required="required"></div>
</div>
  <div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_pay']; ?>:</strong></div>
<div class="col-md-10">
    <label>
      <input name="service_order_buy_pay" type="radio" id="service_order_buy_pay1_0" value="cash"<? if($service_order_row['service_order_pay_method']=="cash"){ ?> checked="checked"<? }?> />
      Tunai</label>
     <label>
      <input type="radio" name="service_order_buy_pay" value="credit" id="service_order_buy_pay1_2"<? if($service_order_row['service_order_pay_method']=="credit"){ ?> checked="checked"<? }?> />
      Kredit</label>
</div>
</div>
<div class="row clearfix" id="service_order_buy_pay_cash"<? if($service_order_row['service_order_pay_method']!="cash"){ ?> style="display:none"<? }?>>
<div class="col-md-2"><strong>Tunai/Cash:</strong></div>
<div class="col-md-10"><input readonly="readonly" name="service_order_total_cash" type="text" class="textbox<? if($btn_status=="btn_pmn"){?> firstin<? }?>" id="service_order_total_cash" placeholder="0" value="<? echo $service_order_amount_format; ?>">
  &nbsp;&nbsp;Rekening:&nbsp; 
    <select name="service_order_accountpay_cash" class="textbox" id="service_order_accountpay_cash">
              <?
			$global->product_order->book->account_special_create(array("cash"),$service_order_row['service_order_accountdebit']);
			?>
              </select>
 </a>
</div>
</div>

<div class="row clearfix" id="service_order_buy_pay_bank"<? if($service_order_row['service_order_pay_method']!="bank"){ ?> style="display:none"<? }?>>
<div class="col-md-2"><strong>Transfer Bank:</strong></div>
<div class="col-md-10"><input readonly="readonly" name="service_order_total_bank" type="text" class="textbox" id="service_order_total_bank" placeholder="0" value="<? echo $service_order_amount_format; ?>">
  &nbsp;&nbsp;Nama Bank:&nbsp;
  <select name="bank_code" class="textbox" id="bank_code">
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
			$global->product_order->book->account_special_create(array("bank"),$service_order_row['service_order_accountdebit']);
			?>
              </select>
</div>
</div>

<div class="row clearfix" id="service_order_buy_pay_credit"<? if($service_order_row['service_order_pay_method']!="credit"){ ?> style="display:none"<? }?>>
<div class="col-md-2"><strong>Kredit:</strong></div>
<div class="col-md-10"><input readonly="readonly" name="service_order_total_credit" type="text" class="textbox" id="service_order_total_credit" placeholder="0" value="<? echo $service_order_amount_format; ?>">
  &nbsp;&nbsp;Rekening:&nbsp; 
    <select name="service_order_accountpay_credit" class="textbox" id="service_order_accountpay_credit">
              <?
			$global->product_order->book->account_special_create(array("trade"),$service_order_row['service_order_accountdebit']);
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
<div class="col-md-12 text-center"><a class="btn btn-primary calc_modal" id="Submitpay"<? if($btn_status!="btn_pmn" || $service_order_row['service_order_pay_method']!="cash"){ ?> style="display:none"<? }?>><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['calculator']; ?>  (F7)</a><button name="Submit" class="btn btn-primary" id="Submit"<? if($btn_status=="btn_pmn" && $service_order_row['service_order_pay_method']=="cash"){ ?> style="display:none"<? }?>><? echo $form_header_lang['process_button']; ?>  (F6)</button>&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='service-edit.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
</div>
<div>&nbsp;<input type="hidden" name="service_order_cash" id="service_order_cash" value="<? echo $service_order_row['service_order_cash']; ?>" /></div>
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
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_orderdetails_het_price']; ?>:</strong></div>
<div class="col-md-8">
              <input name="service_orderdetails_het_price" type="text" class="textbox firstin masknumber" id="service_orderdetails_het_price" value="" required="required"></div>
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
<form action="#" method="post" enctype="multipart/form-data" name="form_product_order" id="form_product_order"><input name="service_order_id" type="hidden" id="service_order_id" value="<? echo $service_order_row['service_order_id']; ?>" /><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" />
<input name="product_orderdetails_sprice_hidden" id="product_orderdetails_sprice_hidden" type="hidden" value="" /><input name="product_orderdetails_bprice_hidden" id="product_orderdetails_bprice_hidden" type="hidden" value="" /><input name="product_shtquantity_hidden" id="product_shtquantity_hidden" type="hidden" value="" />
<input name="product_spoquantity_hidden" id="product_spoquantity_hidden" type="hidden" value="" />
<input name="product_quantity_hidden" id="product_quantity_hidden" type="hidden" value="" />
<input name="product_bpoquantity_hidden" id="product_bpoquantity_hidden" type="hidden" value="" />
<input name="kpb_product_yesno_hidden" id="kpb_product_yesno_hidden" type="hidden" value="0" />
<input name="product_orderdetails_quantityold_hidden" id="product_orderdetails_quantityold_hidden" type="hidden" value="" />
  
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
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_orderdetails_het_price']; ?>:</strong></div>
<div class="col-md-8">
              <input name="product_orderdetails_het_price" type="text" class="textbox firstin masknumber" id="product_orderdetails_het_price" value="" readonly></div>
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
  <div class="col-md-4"><strong>Update Master Data Harga:</strong></div>
<div class="col-md-8">
  <input type="checkbox" name="product_mcheck" id="product_mcheck" class="" /></div>
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
  <div class="col-md-8"><input name="motorcycle_machine_no" type="text" class="textbox firstin" id="motorcycle_machine_no" value="<? echo $motorcycle_row['motorcycle_machine_no']; ?>" required="required"></div>
</div>
<div class="row clearfix append_div">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_type_code" type="text" class="textbox" id="motorcycle_type_code_kpb" value="<? echo $motorcycle_type_code; ?>" required="required" rel="motorcycle_buy_register"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_buy_register']; ?>:</strong></div>
  <div class="col-md-8"><input type="text" id="motorcycle_buy_register" name="motorcycle_buy_register" value="<? echo $motorcycle_row['motorcycle_buy_register']; ?>" class="nxt_tab datepicker"><span id="motorcycle_numdays" class="red">&nbsp;</span></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_book_service_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_book_service_no" type="text" class="textbox" id="motorcycle_book_service_no" value="<? echo $motorcycle_row['motorcycle_book_service_no']; ?>" required="required"></div>
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
<? $modal=true; $popup=true; $checkbox=true; include ("../inventory/views/motorcycle-new.php"); ?>
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
  <div class="col-md-8"><input name="product_order_calc_bill" type="text" class="textbox" id="product_order_calc_bill" value="" required="required" readonly="readonly"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_calc_pay']; ?>:</strong></div>
  <div class="col-md-8"><input name="product_order_calc_pay" type="text" class="textbox firstin masknumber" id="product_order_calc_pay" value="" required="required"></div>
</div>
<div class="row clearfix append_div">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_calc_balance']; ?>:</strong></div>
  <div class="col-md-8"><input name="product_order_calc_balance" type="text" class="textbox" id="product_order_calc_balance" value="" required="required" readonly="readonly"></div>
</div>
</form> 
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary btn_calc" id="Submitedit"><? echo $form_header_lang['process_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
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

<div class="modal fade" id="village_new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="village_new_modal_form" id="village_new_modal_form">
  
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ($path."users/views/village-new.php"); ?>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="village_new_modal_btn_new" class="btn btn-primary village_new_modal_btn_new" id="village_new_modal_btn_new"><? echo $form_header_lang['add_new_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>  
</form> 
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>