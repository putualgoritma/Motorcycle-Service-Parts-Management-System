            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Jasa Mekanik</h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Penggajian</a></li>
                        <li class="active"><? echo $global->salary->salary_lang['form_header_salary_lang']['insentif']; ?></li>
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
                                <div class="col-md-12">
                                <form action="<? echo $link_list; ?>" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch"><input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>" size="20" placeholder="Kata Kunci" /><div class="page">From: </div>
                                <input class="selectbox datepicker" type="text" name="date_range1" value="<? echo $_SESSION['insentif_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox datepicker" type="text" name="date_range2" value="<? echo $_SESSION['insentif_drange2_sessi']; ?>" />

                                <select name="service_code" class="textbox selectbox" id="service_code">
                                <option value="" <? echo $service_code_value; if($service_code_value==""){?>selected<? }?>>Semua Jasa</option>
                                <?
                                    $staff_list=$global->tbl_list("service","*","","service_name",1);
                                    for($i=0;$i<count($staff_list);$i++){
                                    ?>
                                <option value="<? echo $staff_list[$i]['service_code']; ?>"<? if($service_code_value==$staff_list[$i]['service_code']){?> selected="selected"<? }?>><? echo $staff_list[$i]['service_name']; ?> - <? echo $staff_list[$i]['service_code']; ?></option>
                                <?
                                        }
                                    ?>
                                </select>

                                <select name="staff_code" class="textbox selectbox" id="staff_code">
                                <option value="" <? echo $staff_code_value; if($staff_code_value==""){?>selected<? }?>>Semua Karyawan</option>
                                <?
                                    $staff_list=$global->tbl_list("staff","*","","staff_name",1);
                                    for($i=0;$i<count($staff_list);$i++){
                                    ?>
                                <option value="<? echo $staff_list[$i]['staff_code']; ?>"<? if($staff_code_value==$staff_list[$i]['staff_code']){?> selected="selected"<? }?>><? echo $staff_list[$i]['staff_name']; ?></option>
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

                <div class="clear">&nbsp;</div>
                                    <table class="table table-bordered table-hover dataTable gridView" id="table1">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                                <th align="center"><strong>Kode Order</strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=staff_code <? if($sort_value=="staff_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['staff_code']; ?> Karyawan</a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=staff_name <? if($sort_value=="staff_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['staff_name']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=service_code <? if($sort_value=="service_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title">Kode Jasa</a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=service_orderdetails_quantity <? if($sort_value=="service_orderdetails_quantity ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title">Quantity</a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=service_orderdetails_price <? if($sort_value=="service_orderdetails_price ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title">Jumlah</a></strong></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
                                        $total_service=0;
			 for($i=0;$i<count($insentif_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
                $total_service+=$insentif_search_list[$i]['service_orderdetails_price']*$insentif_search_list[$i]['service_orderdetails_quantity'];
			?>
                                      <tr>
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="service_order_code"><? echo $insentif_search_list[$i]['service_order_code']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="staff_code"><? echo $insentif_search_list[$i]['staff_code']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="staff_name"><? echo $insentif_search_list[$i]['staff_name']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="service_code"><? echo $insentif_search_list[$i]['service_code']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="service_orderdetails_quantity"><? echo $insentif_search_list[$i]['service_orderdetails_quantity']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="service_orderdetails_price"><? echo $global->num_format2($insentif_search_list[$i]['service_orderdetails_price']*$insentif_search_list[$i]['service_orderdetails_quantity']); ?></td>
                                            
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
                                          <td><strong><? echo $site_lang['currency'].$global->num_format($total_service); ?></strong></td>
                                          <td>&nbsp;</td>
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
                            <a href="<? echo $link_list; ?>?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="<? echo $link_list; ?>?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>
                            <? }?></td>
                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>
                        <td><? if($current_page<$total_page) { ?>
                            <a href="<? echo $link_list; ?>?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="<? echo $link_list; ?>?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>
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