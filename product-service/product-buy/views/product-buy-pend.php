                        <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">                

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_pend']; ?></h1>

                    <ol class="breadcrumb">

                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pembelian</a></li>

                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy_pend']; ?></li>

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

                                <form action="product-buy-pend.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">

                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>"size="20" />

                                <div class="page">From: </div>

                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['product_order_buy_drange1_sessi']; ?>" />

                                <div class="page">to</div>

                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['product_order_buy_drange2_sessi']; ?>" />

                      <select name="users_code" class="textbox selectbox" id="users_code">

                      <option value="" <? if($users_code_value==""){?>selected<? }?>>Semua User</option>

					  <?

						$users_list=$global->tbl_list("users","*","users_type='supplier'","users_name",1);

						for($i=0;$i<count($users_list);$i++){

						?>

					  <option value="<? echo $users_list[$i]['users_code']; ?>"<? if($users_code_value==$users_list[$i]['users_code']){?> selected="selected"<? }?>><? echo $users_list[$i]['users_name']; ?></option>

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

<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info"  onclick="location.href='product-buy-pend-new.php'" type="button" id="btn_new"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?> (F3)</button><? }?>

&nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.delform,'product-buy-pend.php?delete=true&amp;search=<? echo$search_value; ?>&amp;sort=<? echo"$sort_value"; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?>

<div class="clear">&nbsp;</div>

                                    <table width="100%" class="table table-bordered table-hover table-fixed gridView" id="example1">

                                        <thead>

                                            <tr>

                                                <td align="center" width="2%">#</td>

                                                <td align="center" width="2%">&nbsp;</td>

                                                <td align="center" width="15%"><strong><a href="product-buy-pend.php?search=<? echo $search_value; ?>&amp;sort=product_order.product_order_registernum <? if($sort_value=="product_order.product_order_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_order.product_order_registernum ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_register']; ?></a></strong></td>

                                                <td align="center" width="11%"><strong><a href="product-buy-pend.php?search=<? echo $search_value; ?>&amp;sort=product_order.product_order_code <? if($sort_value=="product_order.product_order_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_order.product_order_code ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_code']; ?></a></strong></td>

                                                <td align="center" width="17%"><strong><a href="product-buy-pend.php?search=<? echo $search_value; ?>&amp;sort=users.users_name <? if($sort_value=="users.users_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="users.users_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['users_name']; ?></a></strong></td>

                                                <td align="center" width="17%"><strong><a href="product-buy-pend.php?search=<? echo $search_value; ?>&amp;sort=product_order.product_order_description <? if($sort_value=="product_order.product_order_description ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_order.product_order_description ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_description']; ?></a></strong></td>

                                                <td align="center" width="15%"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_plus']; ?></strong></td>

                                                <td align="center" class="td_hide"><strong>&nbsp;</strong></td>

                                                <td align="center" class="td_hide"><strong>&nbsp;</strong></td>

                                            </tr>

                                        </thead>

                                        <tbody>

                                        <? 

				$product_order_amount_buy=0;

				for($i=0;$i<count($product_order_search_list);$i++){

			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);

				$product_order_amount_buy+=$product_order_search_list[$i]['product_orderdetails_price_total'];
				$view_link="product_order_buy_pend_edit_modal_off";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1 && $product_order_search_list[$i]['product_order_po_status']=='active'){
				$view_link="product_order_buy_pend_edit_modal";
				}
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1 && $product_order_search_list[$i]['product_order_po_status']!='active'){
				$view_link="product_order_buy_pend_real_modal";
				}

			?>

                                        <tr>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? if($product_order_search_list[$i]['product_order_po_status']=='active'){?><input name="id[]" type="checkbox" id="id[]" value="<? echo $product_order_search_list[$i]['product_order_id']; ?>" /><? }?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $product_order_search_list[$i]['product_order_register']; ?></a></td>

											<td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $product_order_search_list[$i]['product_order_code']; ?></a></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $product_order_search_list[$i]['users_name']; ?></a></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $product_order_search_list[$i]['product_order_description']; ?></a></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? if($product_order_search_list[$i]['product_order_type']=='po'){ echo $site_lang['currency'].$global->num_format($product_order_search_list[$i]['product_orderdetails_price_total']); }else{echo "-";} ?></a></td>

                                            <td class="product_order_id_hidden td_hide"><a href="#" class="link_table product_order_sale_pend_edit"><? echo $product_order_search_list[$i]['product_order_id']; ?></a></td>

                                            <td class="po_code_hidden td_hide"><a href="#" class="link_table product_order_sale_pend_edit"><? echo $product_order_search_list[$i]['product_order_code']; ?> - <? echo $product_order_search_list[$i]['users_name']; ?></a></td>

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

                                          <td align="right"><strong><? echo $form_header_lang['balance']; ?>:</strong></td>

                                          <td><strong><? echo $site_lang['currency'].$global->num_format($product_order_amount_buy); ?></strong></td>

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

                            <a href="product-buy-pend.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="product-buy-pend.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>

                            <? }?></td>

                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>

                        <td><? if($current_page<$total_page) { ?>

                            <a href="product-buy-pend.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="product-buy-pend.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>

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
    <button class="btn btn-info" id="btn_edit" onclick="location.href=''" type="button"><i class="fa fa-play-circle"></i> GANTI</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-warning" id="btn_print" onclick="location.href=''" type="button"><i class="fa fa-print"></i> PRINT</button>
<div>&nbsp;</div>
     </div><!-- /.box-header -->

</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myModalreal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
		<div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" name="realform" id="realform" enctype="multipart/form-data" action="">
<div class="box-header text-center">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="clear">&nbsp;<input name="product_order_id" id="product_order_id" type="hidden" value="" /></div>
    <button class="btn btn-info" id="btn_edit" onclick="location.href=''" type="button"><i class="fa fa-play-circle"></i> VIEW REALISASI</button>
<div>&nbsp;</div>
     </div><!-- /.box-header -->

</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>