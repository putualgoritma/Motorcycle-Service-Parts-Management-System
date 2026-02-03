            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Daftar Stok Barang</h1>
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
                      <!-- <select name="min_stock" class="textbox selectbox" id="min_stock">
                      <option value="" <? if($min_stock_value==""){?>selected<? }?>>Semua Stok</option>
                      <option value="low" <? if($min_stock_value=="low"){?>selected<? }?>>Stok Ada</option>
                      <option value="out" <? if($min_stock_value=="out"){?>selected<? }?>>Stok dibawah Minimum</option>
                      </select> -->

                      <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                                <div class="page">/ page</div>
                                <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-info"><i class="fa fa-search"></i> <? echo $form_header_lang['search_kop']; ?></button>&nbsp;&nbsp;&nbsp;<a
  href="pdf/product-stock-pdf.php"
  target="_blank"
  class="btn btn-warning"
>
  <i class="fa fa-file-pdf-o"></i> PDF
</a>
</div></form>
                                
                                
                  </div>
                  
                  </div>
                  </div>
                <div class="clear">&nbsp;</div>
<form method="post" id="delform" name="delform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><? }?>
                <div class="clear">&nbsp;</div>
                                    <table id="example1" class="table table-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                              <th align="center">&nbsp;</th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_code <? if($sort_value=="product_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_code ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_code']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_name <? if($sort_value=="product_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_name']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_bprice <? if($sort_value=="product_bprice ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_bprice ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_bprice']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_sprice <? if($sort_value=="product_sprice ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_sprice ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_sprice']; ?></strong></a></th>
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_het_price <? if($sort_value=="product_het_price ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_het_price ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_het_price']; ?></strong></a></th>
                                              
                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_stock <? if($sort_value=="product_stock ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_stock ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_quantity']; ?></strong></a></th>

                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=product_min_stock <? if($sort_value=="product_min_stock ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_min_stock ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_min_stock']; ?></strong></a></th>

                                              <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=unit_name <? if($sort_value=="unit_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="unit_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['unit_name']; ?></strong></a></th>

                                              <th align="center"><strong>Nilai Stok (Harga Beli)</strong></th>

                                              <th align="center"><strong>Nilai Stok (Harga Jual)</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 $stock_amount_buy=0;
             $stock_amount_sale=0;
             for($i=0;$i<count($product_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				$view_link="";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="product-edit.php?product_id=".$product_search_list[$i]['product_id'];
				}
                $stock_amount_buy+=$product_search_list[$i]['product_bprice']*$product_search_list[$i]['product_stock'];
                $stock_amount_sale+=$product_search_list[$i]['product_sprice']*$product_search_list[$i]['product_stock'];
			?>
                                      <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $product_search_list[$i]['product_id']; ?>" /></td>
                                            <td class="product_code" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['product_code']; ?></td>
                                            <td class="product_name" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['product_name']; ?></td>
                                            <td class="product_bprice" bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($product_search_list[$i]['product_bprice']); ?></td>
                                            <td class="product_sprice" bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($product_search_list[$i]['product_sprice']); ?></td>
                                            <td class="product_het_price" bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($product_search_list[$i]['product_het_price']); ?></td>
                                            
                                            <td class="product_quantity" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['product_stock']; ?></td>

                                            <td class="product_quantity" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['product_min_stock']; ?></td>

                                            <td class="unit_name" bgcolor="<? echo $bg_color; ?>"><? echo $product_search_list[$i]['unit_name']; ?></td>

                                            <td class="product_cogs_price" bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($product_search_list[$i]['product_bprice']*$product_search_list[$i]['product_stock']); ?></td>

                                            <td class="product_sale_price" bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($product_search_list[$i]['product_sprice']*$product_search_list[$i]['product_stock']); ?></td>
                                        </tr>
                                        <?
				$inc++;
				}
			?>
                                    <tr>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
										  <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td></td>
                                          <td align="right"><strong>Total:</strong></td>
                                          <td><strong><? echo $site_lang['currency'].$global->num_format($stock_amount_buy); ?></strong></td>
                                          <td><strong><? echo $site_lang['currency'].$global->num_format($stock_amount_sale); ?></strong></td>
                                        </tr>    
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

                            
                            
                            
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->