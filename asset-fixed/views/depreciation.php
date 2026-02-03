            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Penyusutan</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Inventaris</li>
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
                                <div class="col-md-10">
								<form method="post" name="form" action="depreciation.php" enctype="multipart/form-data">
                                <div class="page">From: </div>
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['depreciation_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['depreciation_drange2_sessi']; ?>" />
								  <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-primary"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></div></form>
                  <input type="hidden" name="search" id="search" value="<? echo"$search_value"; ?>" />
                  </div>
                  
                  </div>
                  </div>
                <div class="clear">&nbsp;</div>
<form onSubmit="return confirmSubmit('<? echo $msgform_lang['cfrm_remove']; ?>')" method="post" name="myform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.myform,'depreciation.php?delete=true')" name="Submitdel" value="view"><i class="fa fa-times"></i> <? echo $form_header_lang['delete_kop']; ?></button><? }?>
                                    <table id="table1" class="table table-bordered table-striped gridView">
                                        <thead>
                                            <tr>
                                                <th width="3%">#</th>
                                                <th width="3%">&nbsp;</th>
                                                <th width="9%"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_code']; ?></th>
                                                <th width="12%"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_name']; ?></th>
                                                <th width="42%"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['depreciation_register']; ?></th>
                                                <th width="18%"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['depreciation_no']; ?></th>
                                                <th width="13%"><? echo $form_header_lang['amount']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($depreciation_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			?>
                                        <tr>
                                          <td bgcolor="<? echo $bg_color; ?>"><? echo"$inc"; ?></td>
                                          <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $depreciation_search_list[$i]['depreciation_id']; ?>" /></td>
                                          <td bgcolor="<? echo $bg_color; ?>"><? echo $depreciation_search_list[$i]['asset_fixed_code']; ?></td>
                                          <td bgcolor="<? echo $bg_color; ?>"><? echo $depreciation_search_list[$i]['asset_fixed_name']; ?></td>
                                          <td bgcolor="<? echo $bg_color; ?>"><? echo $depreciation_search_list[$i]['depreciation_register']; ?></td>
                                          <td bgcolor="<? echo $bg_color; ?>"><? echo $depreciation_search_list[$i]['depreciation_no']; ?></td>
                                          <td bgcolor="<? echo $bg_color; ?>"><? echo $site_lang['currency'].$global->num_format($depreciation_search_list[$i]['depreciation_amount']); ?></td>
                                          </tr>
                                        <?
				$inc++;
				}
			?>
                                        </tbody> 
                                    </table>
  <div>&nbsp;</div>               

                               </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->