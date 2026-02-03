            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product']; ?></h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product']; ?></li>
                    </ol>
                    <? }?>
                </section>

<? if(isset($_REQUEST['confirm'])){?><div>&nbsp;</div><div class="alert alert-info alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-warning"></i> <? echo $form_header_lang['notice']; ?></h4>
      <p><strong><? echo $form_header_lang['confirm_state1']; ?><? echo $_REQUEST['confirm']; ?><? echo $form_header_lang['confirm_state2']; ?></strong></p>
    </div><? }?>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header">                                                                      
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <div id="header-top">
                                <div class="row clearfix">
                                <div class="col-md-9">
                                <form action="<? echo $link_list; ?>" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>" size="20" placeholder="Kata Kunci" />
                                <select name="warehouse_code" class="textbox selectbox" id="warehouse_code">
                      <option value="" <? if($warehouse_code_value==""){?>selected<? }?>>Semua Gudang</option>
					  <?
						$warehouse_list=$global->tbl_list("warehouse","*","","warehouse_name",1);
						for($i=0;$i<count($warehouse_list);$i++){
						?>
					  <option value="<? echo $warehouse_list[$i]['warehouse_code']; ?>"<? if($warehouse_code_value==$warehouse_list[$i]['warehouse_code']){?> selected="selected"<? }?>><? echo $warehouse_list[$i]['warehouse_name']; ?></option>
					  <?
							}
						?>
                      
                    </select>
                      <select name="min_stock" class="textbox selectbox" id="min_stock">
                      <option value="" <? if($min_stock_value==""){?>selected<? }?>>Semua Stok</option>
                      <option value="out" <? if($min_stock_value=="out"){?>selected<? }?>>Out of Stok</option>
                      </select>

                      <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                                <div class="page">/ page</div>
                                <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-info"><i class="fa fa-search"></i> <? echo $form_header_lang['search_kop']; ?></button></div></form>
                                
                                
                  </div>
                  
                  </div>
                  </div>
                <div class="clear">&nbsp;</div>
<form method="post" id="delform" name="delform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info" onclick="location.href='<? echo $link_new; ?>'" type="button" id="btn_new"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?> (F3)</button><? }?>
&nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.delform,'<? echo $link_list; ?>?delete=true&amp;search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=<? echo $sort_value; ?>&amp;pageset=<? echo $pageset_value; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?>
                <div class="clear">&nbsp;</div>
                                    <table id="example1" class="table table-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                              <th align="center">&nbsp;</th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_code <? if($sort_value=="product_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_code ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_name <? if($sort_value=="product_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_name']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_bprice <? if($sort_value=="product_bprice ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_bprice ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_bprice']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_het_price <? if($sort_value=="product_het_price ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_het_price ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_het_price']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_sprice <? if($sort_value=="product_sprice ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_sprice ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_sprice']; ?></strong></a></th>                                              
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_stock_ht <? if($sort_value=="product_stock_ht ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title">
                                                <? if($sort_value=="product_stock_ht ASC"){?>
                                                <i class="fa fa-sort-alpha-asc"></i>
                                                <? }else{?>
                                                <i class="fa fa-sort-alpha-desc"></i>
                                                <? }?>
                                                &nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_shtquantity']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_stock_so <? if($sort_value=="product_stock_so ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title">
                                                <? if($sort_value=="product_stock_so ASC"){?>
                                                <i class="fa fa-sort-alpha-asc"></i>
                                                <? }else{?>
                                                <i class="fa fa-sort-alpha-desc"></i>
                                                <? }?>
                                                &nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_spoquantity']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_stock <? if($sort_value=="product_stock ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_stock ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_quantity']; ?></strong></a></th>

                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_min_stock <? if($sort_value=="product_min_stock ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_min_stock ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_min_stock']; ?></strong></a></th>

                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_stock_po <? if($sort_value=="product_stock_po ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title">
                                                <? if($sort_value=="product_stock_po ASC"){?>
                                                <i class="fa fa-sort-alpha-asc"></i>
                                                <? }else{?>
                                                <i class="fa fa-sort-alpha-desc"></i>
                                                <? }?>
                                                &nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_bpoquantity']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=unit_name <? if($sort_value=="unit_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="unit_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['unit_name']; ?></strong></a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($product_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				$view_link="";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="product-edit.php?product_id=".$product_search_list[$i]['product_id'];
				}
			?>
                                      <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $product_search_list[$i]['product_id']; ?>" /></td>
                                            <td class="product_code" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['product_code']; ?></td>
                                            <td class="product_name" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['product_name']; ?></td>
                                            <td class="product_bprice" bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($product_search_list[$i]['product_bprice']); ?></td>
                                            <td class="product_het_price" bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($product_search_list[$i]['product_het_price']); ?></td>
                                            <td class="product_sprice" bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($product_search_list[$i]['product_sprice']); ?></td>                                            
                                            <td class="product_quantity" bgcolor="<? echo $bg_color; ?>">(-) <? echo $product_search_list[$i]['product_stock_ht']; ?></td>
                                            <td class="product_quantity" bgcolor="<? echo $bg_color; ?>">(-) <? echo $product_search_list[$i]['product_stock_so']; ?></td>
                                            <td class="product_quantity" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['product_stock']; ?></td>

                                            <td class="product_quantity" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['product_min_stock']; ?></td>

                                            <td class="product_quantity" bgcolor="<? echo $bg_color; ?>">(+) <? echo $product_search_list[$i]['product_stock_po']; ?></td>
                                            <td class="unit_name" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['unit_name']; ?></td>
                                        </tr>
                                        <?
				$inc++;
				}
			?>
                                        </tbody> 
                                    </table>
                                    
                                    <table width="360" border="0" align="center" cellpadding="0" cellspacing="0" id="nexprev">
                      <tr>
                        <td width="80">&nbsp;</td>
                        <td width="60" align="center">&nbsp;</td>
                        <td width="80">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right"><? if($current_page>1) { ?>
                            <a href="<? echo $link_list; ?>?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=0&amp;min_stock=<? echo"$min_stock_value"; ?>"><i class="fa fa-angle-double-left"></i></a> <a href="<? echo $link_list; ?>?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_prev"; ?>&amp;min_stock=<? echo"$min_stock_value"; ?>"><i class="fa fa-angle-left"></i></a>
                            <? }?></td>
                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>
                        <td><? if($current_page<$total_page) { ?>
                            <a href="<? echo $link_list; ?>?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_next"; ?>&amp;min_stock=<? echo"$min_stock_value"; ?>"><i class="fa fa-angle-right"></i></a> <a href="<? echo $link_list; ?>?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_last"; ?>&amp;min_stock=<? echo"$min_stock_value"; ?>"><i class="fa fa-angle-double-right"></i></a>
                            <? }?></td>
                      </tr>
                  </table>
                                    </form>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                          <div><strong>List Out of Stock</strong></div>
                          <div>&nbsp;</div>
  <div class="pull-left"></div>
              <div class="pull-left"><a href="<? echo $path; ?>csv/csv-out-stock.php" class="btn btn-success link_import" target="_blank"><i class="fa fa-download"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['export_button']; ?></a></div>
              <div class="clear">&nbsp;</div>
                            </div><!-- /.box-body -->
                          </div>
                            
                            <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                          <div><strong>Update Harga</strong></div>
                          <div>&nbsp;</div>
<form action="<? echo $path; ?>csv/csv-product-price.php" method="post" enctype="multipart/form-data" name="form_stock" id="form_stock">
  <div class="pull-left"><input name="file_source" type="file" class="textbox" id="file_source" />
                <input type="hidden" name="redirect_import" id="redirect_import" value="product-service/inventory/product.php?confirm=import CSV" />
                <input type="hidden" name="redirect_path" id="redirect_path" value="<? echo $path; ?>" />
              </div>
              <div class="pull-left">&nbsp;<button name="btn_import" class="btn btn-primary" id="btn_import"><i class="fa fa-upload"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button>&nbsp;&nbsp;<a href="<? echo $path; ?>csv/csv-product-price.php" class="btn btn-success link_import" target="_blank"><i class="fa fa-download"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['export_button']; ?></a></div></form>
              <div class="clear">&nbsp;</div>
                            </div><!-- /.box-body -->
                          </div>

                          <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                          <div><strong>Update Het Astra</strong></div>
                          <div>&nbsp;</div>
<form action="<? echo $path; ?>csv/csv-product-het-price.php" method="post" enctype="multipart/form-data" name="form_stock" id="form_stock">
  <div class="pull-left"><input name="file_source" type="file" class="textbox" id="file_source" />
                <input type="hidden" name="redirect_import" id="redirect_import" value="product-service/inventory/product.php?confirm=import CSV" />
                <input type="hidden" name="redirect_path" id="redirect_path" value="<? echo $path; ?>" />
              </div>
              <div class="pull-left">&nbsp;<button name="btn_import" class="btn btn-primary" id="btn_import"><i class="fa fa-upload"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button>&nbsp;&nbsp;<a href="<? echo $path; ?>csv/csv-product-het-price.php" class="btn btn-success link_import" target="_blank"><i class="fa fa-download"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['export_button']; ?></a></div></form>
              <div class="clear">&nbsp;</div>
                            </div><!-- /.box-body -->
                          </div>
                          
                          
                          <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                          <div><strong>Daftar Part</strong></div>
                          <div>&nbsp;</div>
<form action="<? echo $path; ?>csv/csv-product.php" method="post" enctype="multipart/form-data" name="form_stock" id="form_stock">
  <div class="pull-left"><input name="file_source" type="file" class="textbox" id="file_source" />
                <input type="hidden" name="redirect_import" id="redirect_import" value="product-service/inventory/product.php?confirm=import CSV" />
                <input type="hidden" name="redirect_path" id="redirect_path" value="<? echo $path; ?>" />
              </div>
              <div class="pull-left">&nbsp;<button name="btn_import" class="btn btn-primary" id="btn_import"><i class="fa fa-upload"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button>&nbsp;&nbsp;<a href="<? echo $path; ?>csv/csv-product.php" class="btn btn-success link_import" target="_blank"><i class="fa fa-download"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['export_button']; ?></a></div></form>
              <div class="clear">&nbsp;</div>
                            </div><!-- /.box-body -->
                          </div>
                          
                          
                          <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                          <div><strong>Fast Moving</strong></div>
                          <div>&nbsp;</div>
<form action="<? echo $path; ?>csv/csv-product-fm.php" method="post" enctype="multipart/form-data" name="form_stock" id="form_stock">
  <div class="pull-left"><input name="file_source" type="file" class="textbox" id="file_source" />
                <input type="hidden" name="redirect_import" id="redirect_import" value="product-service/inventory/product.php?confirm=import CSV" />
                <input type="hidden" name="redirect_path" id="redirect_path" value="<? echo $path; ?>" />
              </div>
              <div class="pull-left">&nbsp;<button name="btn_import" class="btn btn-primary" id="btn_import"><i class="fa fa-upload"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button>&nbsp;&nbsp;<a href="<? echo $path; ?>csv/csv-product-fm.php" class="btn btn-success link_import" target="_blank"><i class="fa fa-download"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['export_button']; ?></a></div></form>
              <div class="clear">&nbsp;</div>
                            </div><!-- /.box-body -->
                          </div>

                          <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                          <div><strong>Stok Barang</strong></div>
                          <div>&nbsp;</div>
<form action="<? echo $path; ?>csv/csv-product-stock.php" method="post" enctype="multipart/form-data" name="form_stock" id="form_stock">
  <div class="pull-left"><input name="file_source" type="file" class="textbox" id="file_source" />
                <input type="hidden" name="redirect_import" id="redirect_import" value="product-service/inventory/product.php?confirm=import CSV" />
                <input type="hidden" name="redirect_path" id="redirect_path" value="<? echo $path; ?>" />
              </div>
              <div class="pull-left">&nbsp;<button name="btn_import" class="btn btn-primary" id="btn_import"><i class="fa fa-upload"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button>&nbsp;&nbsp;<a href="<? echo $path; ?>csv/csv-product-stock.php" class="btn btn-success link_import" target="_blank"><i class="fa fa-download"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['export_button']; ?></a></div></form>
              <div class="clear">&nbsp;</div>
                            </div><!-- /.box-body -->
                          </div>
                          
                          <div class="box box-info" style="display:none">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
                          <div><strong>SIM Part</strong></div>
                          <div>&nbsp;</div>
<form action="<? echo $path; ?>csv/csv-product-sim.php" method="post" enctype="multipart/form-data" name="form_stock" id="form_stock">
  <div class="pull-left"><input name="file_source" type="file" class="textbox" id="file_source" />
                <input type="hidden" name="redirect_import" id="redirect_import" value="product-service/inventory/product.php?confirm=import CSV" />
                <input type="hidden" name="redirect_path" id="redirect_path" value="<? echo $path; ?>" />
              </div>
              <div class="pull-left">&nbsp;<button name="btn_import" class="btn btn-primary" id="btn_import"><i class="fa fa-upload"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button>&nbsp;&nbsp;<a href="<? echo $path; ?>csv/csv-product-sim.php" class="btn btn-success link_import" target="_blank"><i class="fa fa-download"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['export_button']; ?></a></div></form>
              <div class="clear">&nbsp;</div>
                            </div><!-- /.box-body -->
                          </div>
                            
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->