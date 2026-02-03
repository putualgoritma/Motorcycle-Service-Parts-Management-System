            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Daftar Rekening</h1>
                    <ol class="breadcrumb">
                        <li><a href=".."><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>">Keuangan</a></li>
                        <li class="active">Daftar Rekening</li>
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
                                <div>&nbsp;</div>
                                    <form onSubmit="return confirmSubmit('<? echo $msgform_lang['cfrm_remove']; ?>')" method="post" name="myform" enctype="multipart/form-data" action="">
                                    <? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.myform,'account-list.php?delete=true')" name="Submitdel" value="view"><i class="fa fa-times"></i> <? echo $form_header_lang['delete_kop']; ?></button><? }?>
                                    &nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><a class="btn btn-info" role="button" href="#" data-toggle="modal" data-target="#myModalnew"><? echo $form_header_lang['add_new_kop']; ?></a><? }?>
                                  <table id="table1" class="table table-bordered table-hover gridView">
                                        <thead>
                                            <tr>
                                                <th width="4%">#</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="25%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_code']; ?></strong></th>
                                                <th width="15%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_type']; ?></strong></th>
                                                <th width="36%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?></strong></th>
                                                <th width="15%"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_postable']; ?></strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?
			$global->book->taxonomi(0,0);
			?>
                                        </tbody> 
                                    </table>
                                    
                                  
                                  <div class="clear">&nbsp;</div>
                                  
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
<form action="account-list-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->book->book_lang['form_header_book_lang']['account_list_new']; ?></u></strong>   
</p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->           
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_parent']; ?>:</strong></div>
<div class="col-md-8"><select name="taxonomi_parent" class="textbox firstin" id="taxonomi_parent">
                <?
			$global->book->taxonomi_createsmp(0,0,0);
			?>
            </select></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_postable']; ?>:</strong></div>
<div class="col-md-8"><select name="taxonomi_postable" class="textbox" id="taxonomi_postable">
                <option value="0" selected="selected">Yes</option>
                <option value="1">No</option>
            </select></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_cash_flow']; ?>:</strong></div>
<div class="col-md-8"><select name="taxonomi_cash_flow" class="textbox" id="taxonomi_cash_flow">
                <option value="">Tidak Termasuk</option>
                <option value="operational" selected="selected">Operational</option>
                <option value="invest">Investasi</option>
                <option value="capital">Pendanaan</option>
            </select></div>
</div>

<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?>:</strong></div>
<div class="col-md-8"><input name="taxonomi_name" type="text" class="textbox lastinnew" id="taxonomi_name"></div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['add_new_button']; ?></button></div>
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
<form action="account-list-edit.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="taxonomi_id" type="hidden" id="taxonomi_id" value="" />
<p><strong><u><? echo $global->book->book_lang['form_header_book_lang']['account_list_new']; ?></u></strong></p>          
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_parent']; ?>:</strong></div>
<div class="col-md-8"><select name="taxonomi_parent" class="textbox firstin" id="taxonomi_parent">
                <?
			$global->book->taxonomi_createsmp(0,0,0);
			?>
            </select></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_postable']; ?>:</strong></div>
<div class="col-md-8"><select name="taxonomi_postable" class="textbox" id="taxonomi_postable">
                <option value="0">Yes</option>
                <option value="1">No</option>
            </select></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_cash_flow']; ?>:</strong></div>
<div class="col-md-8"><select name="taxonomi_cash_flow" class="textbox" id="taxonomi_cash_flow">
                <option value="">Tidak Termasuk</option>
                <option value="operational">Operational</option>
                <option value="invest">Investasi</option>
                <option value="capital">Pendanaan</option>
            </select></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_hidden']; ?>:</strong></div>
<div class="col-md-8"><input name="taxonomi_hidden" type="checkbox" id="taxonomi_hidden" />
</div>
</div>

<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?>:</strong></div>
<div class="col-md-8"><input name="taxonomi_name" type="text" class="textbox lastinedit" id="taxonomi_name"></div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['edit_button']; ?></button></div>
</div> 
</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>