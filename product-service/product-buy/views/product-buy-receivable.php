                        <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">                

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_retur_receivable']; ?></h1>

                    <ol class="breadcrumb">

                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> <? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_buy']; ?></a></li>

                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_retur_receivable']; ?></li>

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

                                <form action="product-buy-receivable.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">

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

<div class="clear">&nbsp;</div>

                                    <form method="post" id="paidform" name="paidform" enctype="multipart/form-data" action=""><? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info" onclick="setCount(0,document.paidform,'product-buy-receivable.php?paid=true&amp;search=<? echo$search_value; ?>&amp;sort=<? echo"$sort_value"; ?>')" name="Submitpaid" value="view" id="btn_new"><i class="fa fa-times"></i> Bayar (F3)</button><? }?><table width="100%" class="table table-bordered table-hover table-fixed gridView" id="example1">

                                        <thead>

                                            <tr>

                                                <td align="center" width="2%">#</td>

                                                <td width="2%" align="center">&nbsp;</td>

                                                <td align="center" width="15%"><strong><a href="product-buy-receivable.php?search=<? echo $search_value; ?>&amp;sort=product_order.product_order_registernum <? if($sort_value=="product_order.product_order_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_order.product_order_registernum ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_register']; ?></a></strong></td>

                                                <td align="center" width="21%"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_account']; ?></strong></td>

												<td align="center" width="11%"><strong><a href="product-buy-receivable.php?search=<? echo $search_value; ?>&amp;sort=product_order.product_order_code <? if($sort_value=="product_order.product_order_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_order.product_order_code ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_code']; ?></a></strong></td>

                                                <td align="center" width="17%"><strong><a href="product-buy-receivable.php?search=<? echo $search_value; ?>&amp;sort=users.users_name <? if($sort_value=="users.users_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="users.users_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['users_name']; ?></a></strong></td>

                                                <td align="center" width="17%"><strong><a href="product-buy-receivable.php?search=<? echo $search_value; ?>&amp;sort=product_order.product_order_description <? if($sort_value=="product_order.product_order_description ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="product_order.product_order_description ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_order_description']; ?></a></strong></td>

                                                <td align="center" width="15%"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['product_order_plus']; ?></strong></td>

                                            </tr>

                                        </thead>

                                        <tbody>

                                        <? 

				$product_order_amount_buy=0;

				for($i=0;$i<count($product_order_search_list);$i++){

			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);

				$product_order_amount_buy+=$product_order_search_list[$i]['product_orderdetails_price_total'];

			?>

                                        <tr>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $product_order_search_list[$i]['payreceivable_id']; ?>" /></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $product_order_search_list[$i]['product_order_register']; ?></td>

											<td bgcolor="<? echo"$bg_color"; ?>"><? $taxonomi_get=$global->product_order->book->taxonomi_get($product_order_search_list[$i]['product_order_accountcredit']); echo $taxonomi_get['taxonomi_name']; ?></td>

											<td bgcolor="<? echo"$bg_color"; ?>"><? echo $product_order_search_list[$i]['product_order_code']; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $product_order_search_list[$i]['users_name']; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $product_order_search_list[$i]['product_order_description']; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? if($product_order_search_list[$i]['product_order_type']=='pr'){ echo $site_lang['currency'].$global->num_format($product_order_search_list[$i]['product_orderdetails_price_total']); }else{echo "-";} ?></td>

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

                                          <td align="right"><strong><? echo $form_header_lang['balance']; ?>:</strong></td>

                                          <td><strong><? echo $site_lang['currency'].$global->num_format($product_order_amount_buy); ?></strong></td>

                                        </tr>

                                          

                                        </tbody> 

                                    </table></form>

                  

                  <table width="360" border="0" align="center" cellpadding="0" cellspacing="0" id="nexprev">

                      <tr>

                        <td width="80">&nbsp;</td>

                        <td width="60" align="center">&nbsp;</td>

                        <td width="80">&nbsp;</td>

                      </tr>

                      <tr>

                        <td align="right"><? if($current_page>1) { ?>

                            <a href="product-buy-receivable.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="product-buy-receivable.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>

                            <? }?></td>

                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>

                        <td><? if($current_page<$total_page) { ?>

                            <a href="product-buy-receivable.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="product-buy-receivable.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>

                            <? }?></td>

                      </tr>

                  </table>

                                </div><!-- /.box-body -->

                            </div><!-- /.box -->

                        </div>

                    </div>



                </section><!-- /.content -->

            </aside><!-- /.right-side -->

