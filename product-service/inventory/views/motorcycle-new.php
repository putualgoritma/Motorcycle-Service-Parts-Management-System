            <? $col_md1="col-md-4"; $col_md2="col-md-8";if(!isset($modal)){ $col_md1="col-md-2"; $col_md2="col-md-10";?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_new']; ?></h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="<? echo $link_list; ?>"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_new']; ?></li>
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
            <? }?>
              <div>
                <p><strong><u><? if(isset($popup_edit)){?><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_edit']; ?><? }else{?><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_new']; ?><? }?>: </u></strong></p>
    <div>&nbsp;</div>                           
   </div><!-- /.box-header -->
 
<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_code']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_id" type="hidden" id="motorcycle_id" /><input name="motorcycle_code" type="text" class="textbox firstin" id="motorcycle_code" required="required"<? if(isset($_REQUEST['motorcycle_code'])){?> value="<? echo $_REQUEST['motorcycle_code'];?>"<? }?>></div>
</div>

<? if(isset($popup) && $checkbox==true){?>
<div class="row clearfix">
  <div class="col-md-4">&nbsp;</div>
  <div class="col-md-8">
    <input name="users_check" type="checkbox" id="users_check" />
  Sama dengan Pembawa</div>
</div>
<? }?>
<div class="row clearfix append_div_customer">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_owner_name']; ?>:</strong></div>
<div class="col-md-8 typehead_customer"><input name="users_code" type="text" class="textbox" id="users_code" required="required"></div>
</div>
<? if(isset($popup) && $checkbox==true){?>
<div class="row clearfix">                                
  <div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?>:</strong></div>
  <div class="<? echo $col_md2; ?>"><select name="users_status" class="textbox" id="users_status">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['users_status']);$list_inc++){?>
    <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['users_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_status'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>
<div class="row clearfix">
  <div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_phone']; ?>:</strong></div>
  <div class="<? echo $col_md2; ?>"><input name="users_phone" type="text" class="textbox" id="users_phone" required="required"></div>
</div>
<? }?>
<div class="row clearfix append_div_motorcycle_type">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name']; ?>:</strong></div>
  <div class="col-md-8"><select name="motorcycle_type_code" class="textbox selectbox" id="motorcycle_type_code" required="required">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("motorcycle_type","*","","motorcycle_type_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['motorcycle_type_code']; ?>"><? echo $select_list[$i_list]['motorcycle_type_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>

<div class="row clearfix">
  <div class="col-md-4">&nbsp;</div>
  <div class="col-md-8">
    <input name="opt_check" type="checkbox" id="opt_check" class="opt_check" />
  Optional</div>
</div>

<div class="opt_area" style="display:none">
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
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_frame_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_frame_no" type="text" class="textbox" id="motorcycle_frame_no"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_machine_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_machine_no" type="text" class="textbox" id="motorcycle_machine_no"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_buy_register']; ?>:</strong></div>
  <div class="col-md-8"><input type="text" id="datepicker" name="motorcycle_buy_register" class="nxt_tab" value=""></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_book_service_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_book_service_no" type="text" class="textbox" id="motorcycle_book_service_no"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_description']; ?>:</strong></div>
<div class="col-md-8">
  <textarea name="motorcycle_description" cols="40" rows="7" class="textbox lastinedit" id="motorcycle_description"></textarea>
</div>
</div>
</div>

<? if(!isset($modal)){?>
<div class="clear">&nbsp;</div>
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
<? }?>

