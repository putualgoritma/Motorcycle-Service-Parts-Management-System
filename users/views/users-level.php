            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['users_level']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pengaturan & Peralatan</a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['users_level']; ?></li>
                    </ol>
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
                                <form action="users-level.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>" size="20" placeholder="Kata Kunci" />
                                <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                                <div class="page">/ page</div>
                                <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-info"><i class="fa fa-search"></i> <? echo $form_header_lang['search_kop']; ?></button></div></form>
                                
                                
                  </div>
                  
                  </div>
                  </div>
                <div class="clear">&nbsp;</div>
<form method="post" id="delform" name="delform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info"  onclick="location.href='users-level-new.php'" type="button" id="btn_new"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?> (F3)</button><? }?>
&nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.delform,'users-level.php?delete=true&amp;search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=<? echo $sort_value; ?>&amp;pageset=<? echo $pageset_value; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?>
                <div class="clear">&nbsp;</div>
                                    <table id="example1" class="table table-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                                <th align="center">&nbsp;</th>
                                                <th align="center"><a href="users-level.php?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=users_level_code <? if($sort_value=="users_level_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="users_level_code ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->users->users_lang['form_label_users_lang']['users_level_code']; ?></strong></a></th>
                                                <th align="center"><a href="users-level.php?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=users_level_name <? if($sort_value=="users_level_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="users_level_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->users->users_lang['form_label_users_lang']['users_level_name']; ?></strong></a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($users_level_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				$view_link="";
				if(($users_level_search_list[$i]['users_level_code']!="MASTER ADMIN" && $ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1) || $_SESSION['users_level_code_sessi']=="MASTER ADMIN"){
				$view_link="users-level-edit.php?users_level_id=".$users_level_search_list[$i]['users_level_id'];
				}
			?>
                                      <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><? if($users_level_search_list[$i]['users_level_code']!="MASTER ADMIN" || $_SESSION['users_level_code_sessi']=="MASTER ADMIN"){?><input name="id[]" type="checkbox" id="id[]" value="<? echo $users_level_search_list[$i]['users_level_id']; ?>" /><? } ?></td>
                                            <td class="users_level_code" bgcolor="<? echo $bg_color; ?>"><? echo $users_level_search_list[$i]['users_level_code']; ?></td>
                                            <td class="users_level_name" bgcolor="<? echo $bg_color; ?>"><? echo $users_level_search_list[$i]['users_level_name']; ?></td>
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
                            <a href="users-level.php?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="users-level.php?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>
                            <? }?></td>
                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>
                        <td><? if($current_page<$total_page) { ?>
                            <a href="users-level.php?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="users-level.php?search=<? echo"$search_value"; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>
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
            
