                                <div class="box-body table-responsive">
                                <div id="header-top">
                                <div class="row clearfix">
                                <div class="col-md-9">
<input name="search" type="text" class="selectbox firstin" id="search" size="20" placeholder="Kata Kunci" />
                                <div class="pull-left"><button name="btn_search" id="btn_search" class="btn btn-info"><i class="fa fa-search"></i> <? echo $form_header_lang['search_kop']; ?></button></div>
                                
                                
                  </div>
                  
                  </div>
                  </div>
                  <hr>
                <div class="clear">&nbsp;</div>
<button class="btn btn-info" data-dismiss="modal" id="btn_new" type="button"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?></button>
&nbsp;<button class="btn btn-danger" value="view" id="btn_del"><i class="fa fa-times"></i> Hapus</button>
<div class="clear">&nbsp;</div>
                                  <form method="post" id="form_del" name="form_del" enctype="multipart/form-data" action=""><table id="table1" class="table table-bordered table-hover dataTable gridView">
                                      <thead>
                                          <tr>
                                              <th align="center" width="3%">#</th>
                                              <th align="center" width="3%">&nbsp;</th>
                                              <th align="center" width="9%"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_code']; ?></strong></th>
                                              <th align="center" width="22%"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?></strong></th>
                                              <th align="center" width="13%"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_phone']; ?></strong></th>
                                              <th align="center" width="33%"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?></strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                              <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                          </tr>
                                      </thead>
                                      <tbody class="dyn_list">
                                      </tbody> 
                                  </table></form>

                                </div><!-- /.box-body -->
