            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->salary->salary_lang['form_header_salary_lang']['insentif']; ?></h1>
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
                                
                                <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                                <div class="page">/ page</div>
                                <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-info"><i class="fa fa-search"></i> <? echo $form_header_lang['search_kop']; ?></button></div></form>
                                
                                
                  </div>
                  
                  </div>
                  <div class="clear">&nbsp;</div>
                  </div>
                <div class="clear">&nbsp;</div>
<form method="post" id="delform" name="delform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.delform,'<? echo $link_list; ?>?delete=true&amp;search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=<? echo $sort_value; ?>&amp;pageset=<? echo $pageset_value; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?>
                <div class="clear">&nbsp;</div>
                                    <table class="table table-bordered table-hover dataTable gridView" id="table1">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                                <th align="center">&nbsp;</th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=staff_code <? if($sort_value=="staff_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['staff_code']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=staff_name <? if($sort_value=="staff_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['staff_name']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=unit_entry <? if($sort_value=="unit_entry ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['unit_entry']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=unit_entry_ratio <? if($sort_value=="unit_entry_ratio ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['unit_entry_ratio']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=amount_service <? if($sort_value=="amount_service ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['amount_service']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=amount_service_ratio <? if($sort_value=="amount_service_ratio ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['amount_service_ratio']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=amount_product <? if($sort_value=="amount_product ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['amount_product']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=amount_product_ratio <? if($sort_value=="amount_product_ratio ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['amount_product_ratio']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=target_bonus <? if($sort_value=="target_bonus ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['target_bonus']; ?></a></strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($insentif_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			?>
                                      <tr>
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $insentif_search_list[$i]['staff_id']; ?>" /></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="staff_code"><? echo $insentif_search_list[$i]['staff_code']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="staff_name"><? echo $insentif_search_list[$i]['staff_name']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="unit_entry"><? echo $insentif_search_list[$i]['unit_entry']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="unit_entry_ratio"><? echo $global->num_format2($insentif_search_list[$i]['unit_entry_ratio']); ?> %</td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="amount_service"><? echo $site_lang['currency'].$global->num_format($insentif_search_list[$i]['amount_service']); ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="unit_entry_ratio"><? echo $global->num_format2($insentif_search_list[$i]['amount_service_ratio']); ?> %</td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="amount_product"><? echo $site_lang['currency'].$global->num_format($insentif_search_list[$i]['amount_product']); ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="unit_entry_ratio"><? echo $global->num_format2($insentif_search_list[$i]['amount_product_ratio']); ?> %</td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="unit_entry_ratio"><? echo $insentif_search_list[$i]['target_bonus']; ?></td>
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