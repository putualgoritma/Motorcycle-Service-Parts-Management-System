            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="product.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="product-edit.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="product_id" type="hidden" id="product_id" value="<? echo $product_row['product_id']; ?>"/>
<div>
    <p><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-6">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?>:</strong></div>
<div class="col-md-8"><input name="product_code" type="text" class="textbox firstin" id="product_code" value="<? echo $product_row['product_code']; ?>" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_name']; ?>:</strong></div>
<div class="col-md-8"><input name="product_name" type="text" class="textbox" id="product_name" value="<? echo $product_row['product_name']; ?>" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['category_name']; ?>:</strong></div>
<div class="col-md-8"><select name="category_code" class="textbox selectbox" id="category_code" required="required">
                      <option value=""<? if($product_row['category_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("category","*","category_type='0'","category_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['category_code']; ?>"<? if($product_row['category_code']==$select_list[$i_list]['category_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['category_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix"<? if($app_type!="ahass"){ ?> style="display:none"<? } ?>>                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['categorysub_name']; ?>:</strong></div>
<div class="col-md-8"><select name="categorysub_code" class="textbox selectbox" id="categorysub_code">
                      <option value=""<? if($product_row['categorysub_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("categorysub","*","categorysub_type='0'","categorysub_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['categorysub_code']; ?>"<? if($product_row['categorysub_code']==$select_list[$i_list]['categorysub_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['categorysub_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_min_stock']; ?>:</strong></div>
<div class="col-md-8"><input name="product_min_stock" type="text" class="textbox" id="product_min_stock" value="<? echo $product_row['product_min_stock']; ?>" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_max_stock']; ?>:</strong></div>
<div class="col-md-8"><input name="product_max_stock" type="text" class="textbox" id="product_max_stock" value="<? echo $product_row['product_max_stock']; ?>" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_fast_moving']; ?>:</strong></div>
<div class="col-md-8">
  <input name="product_fast_moving" type="checkbox" id="product_fast_moving"<? if($product_row['product_fast_moving']=="1"){?> checked="checked"<? }?> />
</div>
</div>
<div class="row clearfix"<? if($app_type!="ahass"){ ?> style="display:none"<? } ?>>                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_sim_part']; ?>:</strong></div>
<div class="col-md-8">
  <input name="product_sim_part" type="checkbox" id="product_sim_part"<? if($product_row['product_sim_part']=="1"){?> checked="checked"<? }?> />
</div>
</div>
</div>

<div class="col-md-6">
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['unit_name']; ?>:</strong></div>
<div class="col-md-8"><select name="unit_code" class="textbox selectbox" id="unit_code" required="required">
                      <option value=""<? if($product_row['unit_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("unit","*","","unit_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['unit_code']; ?>"<? if($product_row['unit_code']==$select_list[$i_list]['unit_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['unit_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['rack_description']; ?>:</strong></div>
<div class="col-md-8"><select name="rack_code" class="textbox selectbox" id="rack_code">
                      <option value=""<? if($product_row['rack_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("rack","*","","rack_description",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['rack_code']; ?>"<? if($product_row['rack_code']==$select_list[$i_list]['rack_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['rack_code']; ?> - <? echo $select_list[$i_list]['rack_description']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_sprice']; ?>:</strong></div>
<div class="col-md-8"><input name="product_sprice" type="text" class="textbox masknumber bprice_change" id="product_sprice" value="<? echo $product_row['product_sprice']; ?>" required="required"></div>
</div>
<div class="row clearfix"<? if($app_type!="ahass"){ ?> style="display:none"<? } ?>>
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_disc']; ?>:</strong></div>
<div class="col-md-8"><input name="product_disc" type="text" class="textbox masknumber bprice_change" id="product_disc" value="<? echo $product_row['product_disc']; ?>" required="required"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_bprice']; ?>:</strong></div>
<div class="col-md-8"><input name="product_bprice" type="text" class="textbox masknumber" id="product_bprice" value="<? echo $product_row['product_bprice']; ?>" required="required"></div>
</div>

<div class="row clearfix"<? if($app_type!="ahass"){ ?> style="display:none"<? } ?>>
<div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_kpb_disc']; ?>:</strong></div>
<div class="col-md-8"><input name="product_kpb_disc" type="text" class="textbox masknumber" id="product_kpb_disc" value="<? echo $product_row['product_kpb_disc']?$product_row['product_kpb_disc']:0; ?>" required="required"></div>
</div>
</div>
</div>


<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<section id="profile-tabs">
                               
                                    <div>
                                    <ul class="nav nav-tab">
                                    <li class="active"><a class="atab" href="#product_sprice_note" aria-controls="product_sprice_range" role="tab" data-toggle="tab"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_sprice_note']; ?></a></li>
                                    <? //if($app_type=="ahass"){ ?><li><a class="atab" href="#product_sprice_fee" aria-controls="product_sprice_range" role="tab" data-toggle="tab"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_sprice_fee']; ?></a></li><? //} ?>
                                    <? if($company['company_price_level']==1){?><li><a class="atab" href="#product_sprice_level" aria-controls="product_sprice_range" role="tab" data-toggle="tab"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_sprice_level']; ?></a></li><? }?>
                                    </ul>
                                    </div><!-- /.tab-pane -->
                            
                </section>

<div class="tab-content">
<div role="tabpanel" class="tab-pane" id="product_sprice_range">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-8">

<div class="table-responsive">
<table class="table table-bordered">
        <thead>
            <tr>
              <th class="text-center">#</th>
              <th><input name="product_sprice_range_min" type="text" class="textbox" id="product_sprice_range_min" value="" placeholder="Jumlah > =" /></th>
              <th><input name="product_sprice_range_price" type="text" class="textbox lastinlist" id="product_sprice_range_price" value="" placeholder="Harga Jual" /></th>
              <th class="text-center"><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="product_sprice_range();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></th>
            </tr>
        </thead>
        <tbody class="dyn_product_sprice_range">
        <?
				$product_sprice_range_list=$global->tbl_list("product_sprice_range","*","product_id='".$product_row['product_id']."'","",1);
				for($i=0;$i<count($product_sprice_range_list);$i++){
				?>
        <tr>
        <td class="text-center">#</td>
        <td><? echo $product_sprice_range_list[$i]['product_sprice_range_min']; ?><input name="product_sprice_range_min_hidden[]" type="hidden" value="<? echo $product_sprice_range_list[$i]['product_sprice_range_min']; ?>"/></td>
        <td><? echo $product_sprice_range_list[$i]['product_sprice_range_price']; ?><input name="product_sprice_range_price_hidden[]" type="hidden" value="<? echo $product_sprice_range_list[$i]['product_sprice_range_price']; ?>"/></td>
        <td class="text-center"><a href="javascript:;" class="btn btn-danger" onclick="remove_product_sprice_range(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>
        </tr>
         <?
					}
				?>
        </tbody>
    </table>
    </div>
    </div>
    <div class="col-md-4">Penentuan harga jual berdasarkan kuantitas jual.<br />
Contoh:<br />
* Qty lebih besar sama dengan 5 harga jual = 10.000<br />
* Qty lebih besar sama dengan 10 harga jual = 8.000<br />
* Dst
  </div>
</div>
                                    
</div>
</div>

<div role="tabpanel" class="tab-pane" id="product_sprice_level">
<div class="box-body table-responsive">
<div class="row clearfix">
  <div class="col-md-8">
<div class="table-responsive">
<table class="table table-bordered">
        <thead>
            <tr>
              <th class="text-center">#</th>
              <th><select name="customer_level_code" class="textbox" id="customer_level_code">
<option value="">Level Harga</option>
<?php
$customer_level_list=$global->tbl_list("customer_level","*","","",1);
for($i_list1=0;$i_list1<count($customer_level_list);$i_list1++){
?>
<option value="<? echo $customer_level_list[$i_list1]['customer_level_code']; ?>;<? echo $customer_level_list[$i_list1]['customer_level_name']; ?>"><? echo $customer_level_list[$i_list1]['customer_level_name']; ?></option>
<?php
}
?>
</select></th>
              <th><input name="product_sprice_level_price" type="text" class="textbox lastinlist" id="product_sprice_level_price" value="" placeholder="Harga Jual" /></th>
              <th class="text-center"><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="product_sprice_level();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></th>
            </tr>
        </thead>
        <tbody class="dyn_product_sprice_level">
        <?
				$product_sprice_level_list=$global->tbl_list("product_sprice_level","*","product_code='".$product_row['product_code']."'","",1);
				for($i=0;$i<count($product_sprice_level_list);$i++){
				$customer_level_name=$global->product_order->db_fldrow("customer_level","customer_level_name","customer_level_code='".$product_sprice_level_list[$i]['customer_level_code']."'");
				?>
        <tr>
        <td class="text-center">#</td>
        <td><? echo $customer_level_name; ?><input name="customer_level_code_hidden[]" type="hidden" value="<? echo $product_sprice_level_list[$i]['customer_level_code']; ?>"/></td>
        <td><? echo $product_sprice_level_list[$i]['product_sprice_level_price']; ?><input name="product_sprice_level_price_hidden[]" type="hidden" value="<? echo $product_sprice_level_list[$i]['product_sprice_level_price']; ?>"/></td>
        <td class="text-center"><a href="javascript:;" class="btn btn-danger" onclick="remove_product_sprice_level(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>
        </tr>
         <?
					}
				?>
        </tbody>
    </table>
    </div>
    </div>
    <div class="col-md-4">Penentuan harga jual untuk customer tertentu.<br />
      Contoh:<br />
      * Level 1 : Customer A harga jual = 10.000<br />
      * Level 2 : Customer B harga jual = 8.000<br />
      * Dst</div>
</div>
                                    
</div>
</div>
<div role="tabpanel" class="tab-pane" id="product_sprice_fee">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
  <div class="row clearfix">
<div class="col-md-2"><strong>Diberikan Dengan:</strong></div>
<div class="col-md-10">
    <label>
      <input name="product_commission_type" type="radio" id="product_commission_type1_0" value="percent"<? if($product_row['product_commission_type']=="percent"){?> checked="checked"<? }?> />
      Prosentase</label>
    <label>
      <input type="radio" name="product_commission_type" value="nominal" id="product_commission_type1_1"<? if($product_row['product_commission_type']=="nominal"){?> checked="checked"<? }?> />
      Nominal</label>
</div>
</div>
<div class="row clearfix" id="product_commission_type_percent"<? if($product_row['product_commission_type']=="nominal"){?> style="display:none"<? }?>>
<div class="col-md-2"><strong>Prosentase:</strong></div>
<div class="col-md-10"><input name="product_commission_percent" type="text" class="textbox" id="product_commission_percent" size="3" placeholder="0" value="<? echo $product_row['product_commission_percent']; ?>">
  % dari 
    <select name="product_commission_percent_type" class="textbox" id="product_commission_percent_type">
      <option value="total">Jumlah</option>
    </select>
</div>
</div>
<div class="row clearfix" id="product_commission_type_nominal"<? if($product_row['product_commission_type']=="percent"){?> style="display:none"<? }?>>
<div class="col-md-2"><strong>Nominal:</strong></div>
<div class="col-md-10"><input name="product_commission_nominal" type="text" class="textbox" id="product_commission_nominal" placeholder="0" value="<? echo $product_row['product_commission_nominal']; ?>">
</div>
</div>
  </div>
</div>
                                    
</div>
</div>
<div role="tabpanel" class="tab-pane active" id="product_sprice_note">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
  <div class="row clearfix">
  <div class="col-md-2"><strong>Gambar/Foto:</strong></div>
<div class="col-md-10"><img src="<? echo $path; ?><?php echo $product_row['product_thumbnail']; ?>" alt="" width="150" height="150" /><input name="product_thumbnail" type="file" class="textbox" id="product_thumbnail" size="36">
</div>
</div>
    <div class="row clearfix">
  <div class="col-md-2"><strong>Catatan/Info Lain:</strong></div>
<div class="col-md-10">
  <textarea name="product_description" cols="50" rows="5" class="textbox" id="product_description"><? echo $product_row['product_description']; ?></textarea>
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
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='product-edit.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

