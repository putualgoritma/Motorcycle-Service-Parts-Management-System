            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_model']; ?></h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_model']; ?></li>
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
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info"  onclick="location.href='<? echo $link_new; ?>'" type="button" id="btn_new"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?> (F3)</button><? }?>
&nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.delform,'<? echo $link_list; ?>?delete=true&amp;search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=<? echo $sort_value; ?>&amp;pageset=<? echo $pageset_value; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?>
                <div class="clear">&nbsp;</div>
                                    <table id="example1" class="table table-bordered table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                                <th align="center">&nbsp;</th>
                                                <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=motorcycle_model_code <? if($sort_value=="motorcycle_model_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="motorcycle_model_code ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_model_code']; ?></strong></a></th>
                                                <th align="center"><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=motorcycle_model_name <? if($sort_value=="motorcycle_model_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? if($sort_value=="motorcycle_model_name ASC"){?><i class="fa fa-sort-alpha-asc"></i><? }else{?><i class="fa fa-sort-alpha-desc"></i><? }?>&nbsp;&nbsp;<strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_model_name']; ?></strong></a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($motorcycle_model_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				$view_link="";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link="motorcycle-model-edit.php?motorcycle_model_id=".$motorcycle_model_search_list[$i]['motorcycle_model_id'];
				}
			?>
                                      <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $motorcycle_model_search_list[$i]['motorcycle_model_id']; ?>" /></td>
                                            <td class="motorcycle_model_code" bgcolor="<? echo $bg_color; ?>"><? echo $motorcycle_model_search_list[$i]['motorcycle_model_code']; ?></td>
                                            <td class="motorcycle_model_name" bgcolor="<? echo $bg_color; ?>"><? echo $motorcycle_model_search_list[$i]['motorcycle_model_name']; ?></td>
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
                            
                            <div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                          <div class="box-body table-responsive">
<form action="<? echo $path; ?>csv/csv-motorcycle-model.php" method="post" enctype="multipart/form-data" name="form_csv" id="form_csv">
  <div class="pull-left"><input name="file_source" type="file" class="textbox" id="file_source" />
                <input type="hidden" name="redirect_import" id="redirect_import" value="product-service/inventory/motorcycle-model.php?confirm=import CSV" />
                <input type="hidden" name="redirect_path" id="redirect_path" value="<? echo $path; ?>" />
              </div>
              <div class="pull-left">&nbsp;<button name="btn_import" class="btn btn-primary" id="btn_import"><i class="fa fa-upload"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button>&nbsp;&nbsp;<a href="<? echo $path; ?>csv/csv-motorcycle-model.php" class="btn btn-success link_import" target="_blank"><i class="fa fa-download"></i> <? echo $global->csv->csv_lang['form_header_csv_lang']['export_button']; ?></a></div></form>
              <div class="clear">&nbsp;</div>
          </div><!-- /.box-body -->
                          </div>
                            
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
