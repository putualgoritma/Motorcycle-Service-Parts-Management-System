            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_new']; ?></h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="service.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_new']; ?></li>
                    </ol>
                    <? }?>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="<? echo $link_new; ?>" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_new']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-6">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_code']; ?>:</strong></div>
<div class="col-md-8"><input name="service_code" type="text" class="textbox firstin" id="service_code" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_name']; ?>:</strong></div>
<div class="col-md-8"><input name="service_name" type="text" class="textbox" id="service_name" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['category_name']; ?>:</strong></div>
<div class="col-md-8"><select name="category_code" class="textbox selectbox" id="category_code" required="required">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("category","*","category_type='1'","category_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['category_code']; ?>"><? echo $select_list[$i_list]['category_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['categorysub_name']; ?>:</strong></div>
<div class="col-md-8"><select name="categorysub_code" class="textbox selectbox" id="categorysub_code">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("categorysub","*","categorysub_type='1'","categorysub_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['categorysub_code']; ?>"><? echo $select_list[$i_list]['categorysub_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
</div>

<div class="col-md-6">
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_time_est']; ?>:</strong></div>
<div class="col-md-8"><input name="service_time_est" type="text" class="textbox" id="service_time_est" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_time_type']; ?>:</strong></div>
<div class="col-md-8"><select name="service_time_type" class="textbox" id="service_time_type">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['service_time_type']);$list_inc++){?>
    <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['service_time_type'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['service_time_type'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_bprice']; ?>:</strong></div>
<div class="col-md-8"><input name="service_bprice" type="text" class="textbox masknumber" id="service_bprice" required="required"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_sprice']; ?>:</strong></div>
<div class="col-md-8"><input name="service_sprice" type="text" class="textbox masknumber" id="service_sprice" required="required"></div>
</div>
</div>
</div>


<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<section id="profile-tabs">
                               
                                    <div>
                                    <ul class="nav nav-tab">
                                    <li class="active"><a class="atab" href="#service_sprice_note" aria-controls="service_sprice_range" role="tab" data-toggle="tab"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_sprice_note']; ?></a></li>
                                    <li><a class="atab" href="#service_sprice_fee" aria-controls="service_sprice_range" role="tab" data-toggle="tab"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_sprice_fee']; ?></a></li>
                                    </ul>
                                    </div><!-- /.tab-pane -->
                            
                </section>

<div class="tab-content">
<div role="tabpanel" class="tab-pane" id="service_sprice_fee">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
  <div class="row clearfix">
<div class="col-md-2"><strong>Diberikan Dengan:</strong></div>
<div class="col-md-10">
    <label>
      <input name="service_commission_type" type="radio" id="service_commission_type1_0" value="percent" checked="checked" />
      Prosentase</label>
    <label>
      <input type="radio" name="service_commission_type" value="nominal" id="service_commission_type1_1" />
      Nominal</label>
</div>
</div>
<div class="row clearfix" id="service_commission_type_percent">
<div class="col-md-2"><strong>Prosentase:</strong></div>
<div class="col-md-10"><input name="service_commission_percent" type="text" class="textbox" id="service_commission_percent" size="3" placeholder="0">
  % dari 
    <select name="service_commission_percent_type" class="textbox" id="service_commission_percent_type">
      <option value="total">Jumlah</option>
    </select>
</div>
</div>
<div class="row clearfix" id="service_commission_type_nominal" style="display:none">
<div class="col-md-2"><strong>Nominal:</strong></div>
<div class="col-md-10"><input name="service_commission_nominal" type="text" class="textbox" id="service_commission_nominal" placeholder="0">
</div>
</div>
  </div>
</div>
                                    
</div>
</div>
<div role="tabpanel" class="tab-pane active" id="service_sprice_note">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
    <div class="row clearfix">
      <div class="col-md-2"><strong>Catatan/Info Lain:</strong></div>
<div class="col-md-10">
  <textarea name="service_description" cols="50" rows="5" class="textbox" id="service_description"></textarea>
</div>
</div>
  </div>
</div>
                                    
</div>
</div>
</div>

<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='<? echo $link_new; ?>?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

