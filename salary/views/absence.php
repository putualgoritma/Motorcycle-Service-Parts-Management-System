            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->salary->salary_lang['form_header_salary_lang']['absence']; ?></h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Penggajian</a></li>
                        <li class="active"><? echo $global->salary->salary_lang['form_header_salary_lang']['absence']; ?></li>
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
                                <input class="selectbox datepicker" type="text" name="date_range1" value="<? echo $_SESSION['absence_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox datepicker" type="text" name="date_range2" value="<? echo $_SESSION['absence_drange2_sessi']; ?>" />
                                
                                <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                                <div class="page">/ page</div>
                                <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-info"><i class="fa fa-search"></i> <? echo $form_header_lang['search_kop']; ?></button></div></form>
                                
                                
                  </div>
                  
                  </div>
                  <div class="clear">&nbsp;</div>
                  </div>
                <div class="clear">&nbsp;</div>
<form method="post" id="delform" name="delform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info"  onclick="location.href='absence-new.php'" type="button" id="btn_new"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?> (F3)</button><? }?>&nbsp;&nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.delform,'<? echo $link_list; ?>?delete=true&amp;search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=<? echo $sort_value; ?>&amp;pageset=<? echo $pageset_value; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?><? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?>&nbsp;&nbsp;<button class="btn btn-warning"  onclick="location.href='absence-recap.php'" type="button" id="btn_show"> <? echo $global->salary->salary_lang['form_header_salary_lang']['absence_recap']; ?></button><? }?>
                <div class="clear">&nbsp;</div>
                                    <table class="table table-bordered table-hover dataTable gridView" id="table1">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                                <th align="center">&nbsp;</th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=absence_date <? if($sort_value=="absence_date ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_date']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=staff_code <? if($sort_value=="staff_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['staff_code']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=staff_name <? if($sort_value=="staff_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['staff_name']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=position_name <? if($sort_value=="position_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['position_name']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_work <? if($sort_value=="absence_work ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_work']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_permission <? if($sort_value=="absence_permission ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_permission']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_sick <? if($sort_value=="absence_sick ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_sick']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_alfa <? if($sort_value=="absence_alfa ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_alfa']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_holiday <? if($sort_value=="absence_holiday ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_holiday']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_work_mlate1 <? if($sort_value=="absence_work_mlate1 ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_work_mlate1']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_work_mlate2 <? if($sort_value=="absence_work_mlate2 ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_work_mlate2']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_work_mlate3 <? if($sort_value=="absence_work_mlate3 ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_work_mlate3']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_work_mlate4 <? if($sort_value=="absence_work_mlate4 ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_work_mlate4']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=absence_break_mlate1 <? if($sort_value=="absence_break_mlate1 ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_break_mlate1']; ?></a></strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($absence_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				$row_class_status="";
				if($absence_search_list[$i]['absence_status']=="none"){
				$row_class_status="red";
				}
				$view_link="";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="absence-edit.php?staff_code=".$absence_search_list[$i]['staff_code']."&absence_date=".date('d/m/Y',strtotime($absence_search_list[$i]['absence_date']));
				}
			?>
                                      <tr class="clickable-row <? echo $row_class_status; ?>" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $absence_search_list[$i]['staff_code'].";".date('d/m/Y',strtotime($absence_search_list[$i]['absence_date'])); ?>" /></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo date('d/m/Y',strtotime($absence_search_list[$i]['absence_date'])); ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="staff_code"><? echo $absence_search_list[$i]['staff_code']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="staff_name"><? echo $absence_search_list[$i]['staff_name']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="position_name"><? echo $absence_search_list[$i]['position_name']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_work"><? echo $absence_search_list[$i]['absence_work']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_permission"><? echo $absence_search_list[$i]['absence_permission']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_sick"><? echo $absence_search_list[$i]['absence_sick']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_alfa"><? echo $absence_search_list[$i]['absence_alfa']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_holiday"><? echo $absence_search_list[$i]['absence_holiday']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_work_mlate1"><? echo $absence_search_list[$i]['absence_work_mlate1']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_work_mlate2"><? echo $absence_search_list[$i]['absence_work_mlate2']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_work_mlate3"><? echo $absence_search_list[$i]['absence_work_mlate3']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_work_mlate4"><? echo $absence_search_list[$i]['absence_work_mlate4']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="absence_break_mlate1"><? echo $absence_search_list[$i]['absence_break_mlate1']; ?></td>
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