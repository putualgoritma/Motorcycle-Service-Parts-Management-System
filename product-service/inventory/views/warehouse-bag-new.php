            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <? echo $global->product_order->product_order_lang['form_header_product_order_lang']['warehouse_bag_new']; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Stock/Persediaan</a></li>
                        <li><a href="warehouse-bag.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['warehouse_bag']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['warehouse_bag_new']; ?></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row"><form action="warehouse-bag-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
                        <div class="col-xs-12">
                        <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['warehouse_bag_new']; ?></u></strong></p>                     
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-10"><input name="warehouse_stock_id" type="hidden" id="warehouse_stock_id" value="0" /><input type="text" id="datepicker" name="date_register" value="<? echo $date_def; ?>" class="nxt_tab"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_name']; ?>:</strong></div>
<div class="col-md-10"><select name="warehouse_code" class="textbox selectbox firstin" id="warehouse_code" required="required" rel="warehouse_stock_type">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("warehouse","*","","warehouse_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['warehouse_code']; ?>"><? echo $select_list[$i_list]['warehouse_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_stock_type']; ?>:</strong></div>
<div class="col-md-10"><select name="warehouse_stock_type" class="textbox selectbox" id="warehouse_stock_type" required="required" rel="product_bcode">
                      <option value="">None</option>
                      <option value="in">Stok Masuk</option>
                      <option value="out">Stok Keluar</option>
                      </select></div>
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
<table class="table table-bordered warehouse_stock">
<thead>
  <tr>
    <th height="25" align="center">#</th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?> - <? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_name']; ?>
    </th>
    <th><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_stock_details_quantity']; ?>
    </th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <tr>
    <td height="25" align="center">&nbsp;</td>
   <td class="typehead_product">
     <input name="product_bcode" type="text" class="textbox" id="product_bcode" rel="warehouse_stock_details_quantity" />&nbsp;<a href="javascript:;" id="product_view_alink"> <i class="fa fa-edit fa-lg"></i> </a>
   </td>
    <td>
      <input name="warehouse_stock_details_quantity" type="text" class="textbox warehouse_stock lastinlist" id="warehouse_stock_details_quantity" value="" size="5" />
    </td>
    <td><a href="javascript:;" class="btn btn-success" id="btn_add_list" onclick="warehouse_stock();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a></td>
  </tr>
  <tbody class="dyn_warehouse_stock">
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
  <p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['warehouse_bag_new']; ?></u></strong></p>                     
<div class="col-md-12">
  <div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['author_name']; ?>:</strong></div>
<div class="col-md-10"><select name="author_code" class="textbox selectbox hotkey" id="author_code" required="required">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("contact","*","contact_type='author'","contact_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['contact_code']; ?>"><? echo $select_list[$i_list]['contact_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
  <div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_stock_description']; ?>:</strong></div>
<div class="col-md-10"><textarea name="warehouse_stock_description" cols="40" rows="5" class="textbox" id="warehouse_stock_description"></textarea></div>
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
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='warehouse-bag-new.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
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
<form action="warehouse-bag-edit-process.php" method="post" enctype="multipart/form-data" name="form" id="form_product_order"><input name="warehouse_stock_id" type="hidden" id="warehouse_stock_id" value="0" /><input name="inner_id_hidden" type="hidden" id="inner_id_hidden" value="" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<p class="title-header"><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['warehouse_stock_new']; ?></u></strong></p>
<div>&nbsp;</div>
     </div><!-- /.box-header -->
     <div class="clear">&nbsp;</div>
<div class="row clearfix append_div">
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?>:</strong></div>
<div class="col-md-8 typehead_product"><input name="product_code" type="text" class="textbox firstin auto_foc" id="product_bcode">
  <span id="product_bcode_label">&nbsp;</span></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_stock_details_quantity']; ?>:</strong></div>
<div class="col-md-8">
              <input name="warehouse_stock_details_quantity" type="text" class="textbox lastinedit auto_foc_trg" id="warehouse_stock_details_quantity" value=""></div>
</div>
</form> 
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary warehouse_stock_edit_details2" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>                               
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