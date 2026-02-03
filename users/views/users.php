            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Kontak</h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="users.php">Kontak</a></li>
                        <li class="active">Kontak</li>
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
                                <form action="users.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>" size="20" />
                                <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                                <div class="page">/ page</div>
                                <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-primary"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></div></form>
                                
                                
                  </div>
                  
                  </div>
                  </div>
                <div class="clear">&nbsp;</div>
<form onSubmit="return confirmSubmit('<? echo $msgform_lang['cfrm_remove']; ?>')" method="post" name="myform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.myform,'users.php?delete=true&amp;search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=<? echo $sort_value; ?>&amp;pageset=<? echo $pageset_value; ?>')" name="Submitdel" value="view"><i class="fa fa-times"></i> <? echo $form_header_lang['delete_kop']; ?></button><? }?>
&nbsp;<a class="btn btn-info" role="button" href="#" data-toggle="modal" data-target="#myModalnew"><? echo $form_header_lang['add_new_kop']; ?></a>
                                    <table id="table1" class="table table-bordered table-hover dataTable gridView">
                                        <thead>
                                            <tr>
                                                <th align="center" width="3%">#</th>
                                                <th align="center" width="3%">&nbsp;</th>
                                                <th align="center" width="9%"><strong><a href="users.php?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=users_code <? if($sort_value=="users_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_code']; ?></a></strong></th>
                                                <th align="center" width="12%"><strong><a href="users.php?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_registernum <? if($sort_value=="users_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_register']; ?></a></strong></th>
                                                <th align="center" width="22%"><strong><a href="users.php?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_name <? if($sort_value=="users_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?></a></strong></th>
                                                <th align="center" width="18%"><strong><a href="users.php?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_type <? if($sort_value=="users_type ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_type']; ?></a></strong></th>
                                                <th align="center" width="13%"><strong><a href="users.php?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_status <? if($sort_value=="users_status ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?></a></strong></th>
                                                <th align="center" width="13%"><strong><a href="users.php?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_idnumber <? if($sort_value=="users_idnumber ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_idnumber']; ?></a></strong></th>
                                                <th align="center" width="33%"><strong><a href="users.php?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=users_address <? if($sort_value=="users_address ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?></a></strong></th>
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
				$view_link="users_edit_off";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="users_edit";
				}
			?>
                                      <tr>
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $users_search_list[$i]['users_id']; ?>" /></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_code"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_code']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_register"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_register']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_name"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_name']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_type"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $global->users->get_selectlist($form_selectlist_lang['users_type'],$users_search_list[$i]['users_type']); ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_status"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $global->users->get_selectlist($form_selectlist_lang['users_status'],$users_search_list[$i]['users_status']); ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_idnumber"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_idnumber']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_address"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_address']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_email"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_email']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_id_hidden td_hide"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_id']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_type_hidden td_hide"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_type']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_status_hidden td_hide"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_status']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="users_phone_hidden td_hide"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $users_search_list[$i]['users_phone']; ?></a></td>
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
                            <a href="users.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="users.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>
                            <? }?></td>
                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>
                        <td><? if($current_page<$total_page) { ?>
                            <a href="users.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="users.php?search=<? echo"$search_value"; ?>&amp;year=<? echo"$year_value"; ?>&amp;month=<? echo"$month_value"; ?>&amp;date=<? echo $date_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;project_id=<? echo $project_id_value; ?>&amp;sort=<? echo"$sort_value"; ?>&amp;pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>
                            <? }?></td>
                      </tr>
                  </table>
                                   <div>&nbsp;</div>
                                    
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
<form action="users-new-process.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->users->users_lang['form_header_users_lang']['users_new']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_code']; ?>:</strong></div>
<div class="col-md-8"><input name="users_code" type="text" class="textbox firstin" id="users_code" value="<? echo $users_code_generation;?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_type']; ?>:</strong></div>
<div class="col-md-8"><select name="users_type" class="textbox" id="users_type">
              <? for($list_inc=2;$list_inc<count($form_selectlist_lang['users_type']);$list_inc++){?>
              <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['users_type'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_type'][$list_inc][1]; ?></option>
              <? }?>
              </select></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?>:</strong></div>
<div class="col-md-8"><select name="users_status" class="textbox" id="users_status">
              <? for($list_inc=0;$list_inc<count($form_selectlist_lang['users_status']);$list_inc++){?>
              <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['users_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_status'][$list_inc][1]; ?></option>
              <? }?>
            </select></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?>:</strong></div>
<div class="col-md-8"><input name="users_name" type="text" class="textbox" id="users_name"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?>:</strong></div>
<div class="col-md-8"><textarea name="users_address" cols="40" rows="4" class="textbox" id="users_address"></textarea></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_phone']; ?>:</strong></div>
<div class="col-md-8"><input name="users_email" type="text" class="textbox" id="users_phone"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_email']; ?>:</strong></div>
<div class="col-md-8"><input name="users_phone" type="text" class="textbox" id="users_email"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_idnumber']; ?>:</strong></div>
<div class="col-md-8"><input name="users_idnumber" type="text" class="textbox lastinnew" id="users_idnumber"></div>
</div>



<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submitnew"><? echo $form_header_lang['add_new_button']; ?></button></div>
</div> 
</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>
            
            
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->users->users_lang['form_header_users_lang']['users_edit']; ?>: </u></strong></p>                      
<div>&nbsp;</div>
     </div><!-- /.box-header -->
<form action="users-edit-process.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_code']; ?>:</strong></div>
<div class="col-md-8"><input name="users_id" type="hidden" id="users_id"/><input name="users_code" type="text" class="textbox firstin" id="users_code"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_type']; ?>:</strong></div>
<div class="col-md-8"><select name="users_type" class="textbox" id="users_type">
              <? for($list_inc=2;$list_inc<count($form_selectlist_lang['users_type']);$list_inc++){?>
              <option value="<? echo $form_selectlist_lang['users_type'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_type'][$list_inc][1]; ?></option>
              <? }?>
              </select></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?>:</strong></div>
<div class="col-md-8"><select name="users_status" class="textbox" id="users_status">
              <? for($list_inc=0;$list_inc<count($form_selectlist_lang['users_status']);$list_inc++){?>
              <option value="<? echo $form_selectlist_lang['users_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_status'][$list_inc][1]; ?></option>
              <? }?>
            </select></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?>:</strong></div>
<div class="col-md-8"><input name="users_name" type="text" class="textbox" id="users_name"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?>:</strong></div>
<div class="col-md-8"><textarea name="users_address" cols="40" rows="4" class="textbox" id="users_address"></textarea></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_phone']; ?>:</strong></div>
<div class="col-md-8"><input name="users_phone" type="text" class="textbox" id="users_phone"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_email']; ?>:</strong></div>
<div class="col-md-8"><input name="users_email" type="text" class="textbox" id="users_email"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_idnumber']; ?>:</strong></div>
<div class="col-md-8"><input name="users_idnumber" type="text" class="textbox lastinedit" id="users_idnumber"></div>
</div>


<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button></div>
</div> 
</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>