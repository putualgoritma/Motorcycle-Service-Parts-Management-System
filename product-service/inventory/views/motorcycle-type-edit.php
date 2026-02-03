            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_type_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="motorcycle-type.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_type']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_type_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="motorcycle-type-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_type_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_code']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_id" type="hidden" id="motorcycle_type_id" value="<? echo $motorcycle_type_row['motorcycle_type_id']; ?>"/><input name="motorcycle_type_code" type="text" class="textbox firstin" id="motorcycle_type_code" value="<? echo $motorcycle_type_row['motorcycle_type_code']; ?>" required="required"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_engine_code']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_engine_code" type="text" class="textbox" id="motorcycle_type_engine_code" value="<? echo $motorcycle_type_row['motorcycle_type_engine_code']; ?>" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_name" type="text" class="textbox" id="motorcycle_type_name" value="<? echo $motorcycle_type_row['motorcycle_type_name']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_cc']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_cc" type="text" class="textbox" id="motorcycle_type_cc" value="<? echo $motorcycle_type_row['motorcycle_type_cc']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_model']; ?>:</strong></div>
  <div class="col-md-10"><select name="motorcycle_type_model" class="textbox" id="motorcycle_type_model">
        <?
				$motorcycle_model_list=$global->tbl_list("motorcycle_model","*","","motorcycle_model_name",1);
				for($i=0;$i<count($motorcycle_model_list);$i++){
				?>
      <option value="<? echo $motorcycle_model_list[$i]['motorcycle_model_code']; ?>"<? if($motorcycle_type_row['motorcycle_type_model']==$motorcycle_model_list[$i]['motorcycle_model_code']){?> selected="selected"<? }?>><? echo $motorcycle_model_list[$i]['motorcycle_model_name']; ?></option>
      <?
					}
				?>
    </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_level']; ?>:</strong></div>
  <div class="col-md-10"><select name="motorcycle_type_level" class="textbox" id="motorcycle_type_level">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['motorcycle_type_level']);$list_inc++){?>
    <option<? if($motorcycle_type_row['motorcycle_type_level']==$form_selectlist_lang['motorcycle_type_level'][$list_inc][0]){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['motorcycle_type_level'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['motorcycle_type_level'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_machine_code']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_machine_code" type="text" class="textbox" id="motorcycle_type_machine_code" value="<? echo $motorcycle_type_row['motorcycle_type_machine_code']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_model_oil']; ?>:</strong></div>
<div class="col-md-10 typehead_product"><input name="product_code" type="text" class="textbox" id="product_code" value="<? echo $motorcycle_type_row['product_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_model_oil_service_sprice']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_oil_service_sprice" type="text" class="textbox" id="motorcycle_type_oil_service_sprice" value="<? echo $motorcycle_type_row['motorcycle_type_oil_service_sprice']; ?>"></div>
</div>


<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb_service_sprice']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_kpb_service_sprice" type="text" class="textbox" id="motorcycle_type_kpb_service_sprice" value="<? echo $motorcycle_type_row['motorcycle_type_kpb_service_sprice']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb2_service_sprice']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_kpb2_service_sprice" type="text" class="textbox" id="motorcycle_type_kpb2_service_sprice" value="<? echo $motorcycle_type_row['motorcycle_type_kpb2_service_sprice']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb3_service_sprice']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_kpb3_service_sprice" type="text" class="textbox" id="motorcycle_type_kpb3_service_sprice" value="<? echo $motorcycle_type_row['motorcycle_type_kpb3_service_sprice']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_kpb4_service_sprice']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_type_kpb4_service_sprice" type="text" class="textbox lastinedit" id="motorcycle_type_kpb4_service_sprice" value="<? echo $motorcycle_type_row['motorcycle_type_kpb4_service_sprice']; ?>"></div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

