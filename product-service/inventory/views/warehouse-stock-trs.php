                        <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['warehouse_stock_trs']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Stock/Persediaan</a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['warehouse_stock_trs']; ?></li>
                    </ol>
                </section>
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
                                <div class="col-md-12">
                                <form action="warehouse-stock-trs.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>"size="20" />
                                <div class="page">From: </div>
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['warehouse_stock_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['warehouse_stock_drange2_sessi']; ?>" />
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
                      <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                      <div class="page">/ page</div>
                      <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-info"><i class="fa fa-search"></i> <? echo $form_header_lang['search_kop']; ?></button></div></form>
                                </div>
                  </div>
                  <div class="clear">&nbsp;</div>
                  </div>
                <div class="clear">&nbsp;</div>
                <form method="post" id="delform" name="delform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info"  onclick="location.href='warehouse-stock-trs-new.php'" type="button" id="btn_new"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?> (F3)</button><? }?>
&nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.delform,'warehouse-stock-trs.php?delete=true&amp;search=<? echo$search_value; ?>&amp;sort=<? echo"$sort_value"; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?>
<div class="clear">&nbsp;</div>
                                    <table width="100%" class="table table-bordered table-hover table-fixed gridView" id="example1">
                                        <thead>
                                            <tr>
                                                <td align="center" width="2%">#</td>
                                                <td align="center" width="2%">&nbsp;</td>
                                                <td align="center" width="15%"><strong><a href="warehouse-stock-trs.php?search=<? echo $search_value; ?>&amp;sort=warehouse_stock.warehouse_stock_registernum <? if($sort_value=="warehouse_stock.warehouse_stock_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="warehouse_stock.warehouse_stock_registernum ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_stock_register']; ?></a></strong></td>
                                                <td align="center" width="11%"><strong><a href="warehouse-stock-trs.php?search=<? echo $search_value; ?>&amp;sort=warehouse_stock.warehouse_stock_code <? if($sort_value=="warehouse_stock.warehouse_stock_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="warehouse_stock.warehouse_stock_code ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_stock_code']; ?></a></strong></td>
                                                <td align="center" width="17%"><strong><a href="warehouse-stock-trs.php?search=<? echo $search_value; ?>&amp;sort=warehouse.warehouse_name <? if($sort_value=="warehouse.warehouse_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="warehouse.warehouse_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_name']; ?></a></strong></td>
                                                <td align="center" width="17%"><strong><a href="warehouse-stock-trs.php?search=<? echo $search_value; ?>&amp;sort=warehouse_stock.warehouse_stock_category <? if($sort_value=="warehouse_stock.warehouse_stock_category ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="warehouse_stock.warehouse_stock_category ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['warehouse_stock_category']; ?></a></strong></td>
                                                <td align="center" class="td_hide"><strong>&nbsp;</strong></td>
                                                <td align="center" class="td_hide"><strong>&nbsp;</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
				for($i=0;$i<count($warehouse_stock_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				$link_edit="warehouse-stock-trs-edit.php?warehouse_stock_id=".$warehouse_stock_search_list[$i]['warehouse_stock_id'];
				$view_link="warehouse_stock_trs_edit_modal_off";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="warehouse_stock_trs_edit_modal";
				}
			?>
                                        <tr>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $warehouse_stock_search_list[$i]['warehouse_stock_id']; ?>" /></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $warehouse_stock_search_list[$i]['warehouse_stock_register']; ?></a></td>
											<td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $warehouse_stock_search_list[$i]['warehouse_stock_code']; ?></a></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $warehouse_stock_search_list[$i]['warehouse_name']; ?></a></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $global->get_selectlist($form_selectlist_lang['warehouse_stock_category'],$warehouse_stock_search_list[$i]['warehouse_stock_category']); ?></a></td>
                                            <td class="warehouse_stock_id_hidden td_hide"><a href="#" class="link_table"><? echo $warehouse_stock_search_list[$i]['warehouse_stock_id']; ?></a></td>
                                            <td class="po_code_hidden td_hide"><a href="#" class="link_table"><? echo $warehouse_stock_search_list[$i]['warehouse_stock_code']; ?> - <? echo $warehouse_stock_search_list[$i]['warehouse_name']; ?></a></td>
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
                                          <td align="right">&nbsp;</td>
                                          <td align="center" class="td_hide"><strong>&nbsp;</strong></td>
                                                <td align="center" class="td_hide"><strong>&nbsp;</strong></td>
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
                            <a href="warehouse-stock-trs.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="warehouse-stock-trs.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>
                            <? }?></td>
                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>
                        <td><? if($current_page<$total_page) { ?>
                            <a href="warehouse-stock-trs.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="warehouse-stock-trs.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>
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
            
<div class="modal fade" id="myModalnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
		<div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" name="delpopform" id="delpopform" enctype="multipart/form-data" action="">
<div class="box-header text-center">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="clear">&nbsp;<input name="product_order_id" id="product_order_id" type="hidden" value="" /></div>
    <button class="btn btn-info" id="btn_edit" onclick="location.href=''" type="button"><i class="fa fa-play-circle"></i> GANTI</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-warning" id="btn_pdf" onclick="location.href=''" type="button"><i class="fa fa-file-pdf-o"></i> PDF</button>
<div>&nbsp;</div>
     </div><!-- /.box-header -->

</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>