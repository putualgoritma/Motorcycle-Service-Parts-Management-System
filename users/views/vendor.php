            <? $col_md1="col-md-4"; $col_md2="col-md-8";if(!isset($modal)){ $col_md1="col-md-2"; $col_md2="col-md-10";?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['vendor']; ?></h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['vendor']; ?></li>
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
                                <? }?>
                                <div class="box-body table-responsive">
                                <div id="header-top">
                                <div class="row clearfix">
                                <div class="col-md-9">
                                <form action="<? echo $link_list; ?>" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>" size="20" placeholder="Kata Kunci" />
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
                                    <table id="table1" class="table table-bordered table-hover dataTable gridView">
                                        <thead>
                                            <tr>
                                                <th align="center" width="3%">#</th>
                                                <th align="center" width="3%">&nbsp;</th>
                                                <th align="center" width="9%"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=users_code <? if($sort_value=="users_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_code']; ?></a></strong></th>
                                                <th align="center" width="12%"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_registernum <? if($sort_value=="users_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_register']; ?></a></strong></th>
                                                <th align="center" width="22%"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_name <? if($sort_value=="users_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?></a></strong></th>
                                                <th align="center" width="18%"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_type <? if($sort_value=="users_type ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_type']; ?></a></strong></th>
                                                <th align="center" width="13%"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_status <? if($sort_value=="users_status ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?></a></strong></th>
                                                <th align="center" width="13%"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_idnumber <? if($sort_value=="users_idnumber ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_idnumber']; ?></a></strong></th>
                                                <th align="center" width="33%"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_address <? if($sort_value=="users_address ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?></a></strong></th>
                                                <th align="center" width="13%"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_email']; ?></strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($users_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				$view_link="";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="vendor-edit.php?users_id=".$users_search_list[$i]['users_id'];
				}
			?>
                                      <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $users_search_list[$i]['users_id']; ?>" /></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_code"><? echo $users_search_list[$i]['users_code']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_register"><? echo $users_search_list[$i]['users_register']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_name"><? echo $users_search_list[$i]['users_name']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_type"><? echo $global->users->get_selectlist($form_selectlist_lang['users_type'],$users_search_list[$i]['users_type']); ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_status"><? echo $global->users->get_selectlist($form_selectlist_lang['users_status'],$users_search_list[$i]['users_status']); ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_idnumber"><? echo $users_search_list[$i]['users_idnumber']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_address"><? echo $users_search_list[$i]['users_address']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_email"><? echo $users_search_list[$i]['users_email']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_id_hidden td_hide"><? echo $users_search_list[$i]['users_id']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_type_hidden td_hide"><? echo $users_search_list[$i]['users_type']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_status_hidden td_hide"><? echo $users_search_list[$i]['users_status']; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_phone_hidden td_hide"><? echo $users_search_list[$i]['users_phone']; ?></td>
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
<? if(!isset($modal)){?>
                            </div><!-- /.box -->
                            
                            
                            
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<? }?>