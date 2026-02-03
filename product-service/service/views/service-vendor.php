                        <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">                

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor']; ?></h1>

                    <ol class="breadcrumb">

                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li><a href="<? echo $path; ?>service-vendor.php"> Pembelian</a></li>

                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor']; ?></li>

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

                                <form action="service-vendor.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">

                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>"size="20" />

                                <div class="page">From: </div>

                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['service_vendor_drange1_sessi']; ?>" />

                                <div class="page">to</div>

                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['service_vendor_drange2_sessi']; ?>" />

                      <select name="users_code" class="textbox selectbox" id="users_code">

                      <option value="" <? if($users_code_value==""){?>selected<? }?>>Semua User</option>

					  <?

						$users_list=$global->tbl_list("users","*","users_type='vendor'","users_name",1);

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

<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info"  onclick="location.href='service-vendor-new.php'" type="button" id="btn_new"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?> (F3)</button><? }?>

&nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.delform,'service-vendor.php?delete=true&amp;search=<? echo$search_value; ?>&amp;sort=<? echo"$sort_value"; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?>

<div class="clear">&nbsp;</div>

                                    <table width="100%" class="table table-bordered table-hover table-fixed gridView" id="example1">

                                        <thead>

                                            <tr>

                                                <td align="center" width="2%">#</td>

                                                <td align="center" width="2%">&nbsp;</td>

                                                <td align="center" width="15%"><strong><a href="service-vendor.php?search=<? echo $search_value; ?>&amp;sort=service_order.service_order_registernum <? if($sort_value=="service_order.service_order_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="service_order.service_order_registernum ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_register']; ?></a></strong></td>

                                                <td align="center" width="21%"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_account']; ?></strong></td>

												<td align="center" width="11%"><strong><a href="service-vendor.php?search=<? echo $search_value; ?>&amp;sort=service_order.service_order_code <? if($sort_value=="service_order.service_order_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="service_order.service_order_code ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_vendor_code']; ?></a></strong></td>

                                                <td align="center" width="17%"><strong><a href="service-vendor.php?search=<? echo $search_value; ?>&amp;sort=users.users_name <? if($sort_value=="users.users_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="users.users_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['users_name']; ?></a></strong></td>

                                                <td align="center" width="17%"><strong><a href="service-vendor.php?search=<? echo $search_value; ?>&amp;sort=service_order.service_order_description <? if($sort_value=="service_order.service_order_description ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="service_order.service_order_description ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_vendor_description']; ?></a></strong></td>

                                                <td align="center" width="15%"><strong><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_vendor_trs_amount']; ?></strong></td>

                                            </tr>

                                        </thead>

                                        <tbody>

                                        <? 

				$service_order_amount_buy=0;

				for($i=0;$i<count($service_order_search_list);$i++){

			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);

				$service_order_amount_buy+=$service_order_search_list[$i]['service_orderdetails_price_total'];
				$view_link="";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="service-vendor-edit.php?service_order_id=".$service_order_search_list[$i]['service_order_id'];
				}

			?>

                                        <tr class="clickable-row" data-href="<? echo $view_link; ?>">

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $service_order_search_list[$i]['service_order_id']; ?>" /></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $service_order_search_list[$i]['service_order_register']; ?></td>

											<td bgcolor="<? echo"$bg_color"; ?>"><? $taxonomi_get=$global->product_order->book->taxonomi_get($service_order_search_list[$i]['service_order_accountpay']); echo $taxonomi_get['taxonomi_name']; ?></td>

											<td bgcolor="<? echo"$bg_color"; ?>"><? echo $service_order_search_list[$i]['service_order_code']; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $service_order_search_list[$i]['users_name']; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo $service_order_search_list[$i]['service_order_description']; ?></td>

                                            <td bgcolor="<? echo"$bg_color"; ?>"><? if($service_order_search_list[$i]['service_order_type']=='pi'){ echo $site_lang['currency'].$global->num_format($service_order_search_list[$i]['service_orderdetails_price_total']); }else{echo "-";} ?></td>

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

                                          <td><strong><? echo $site_lang['currency'].$global->num_format($service_order_amount_buy); ?></strong></td>

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

                            <a href="service-vendor.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="service-vendor.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>

                            <? }?></td>

                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>

                        <td><? if($current_page<$total_page) { ?>

                            <a href="service-vendor.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="service-vendor.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>

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

