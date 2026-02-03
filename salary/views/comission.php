            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Komisi Harian</h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Komisi</a></li>
                        <li class="active"><? echo $global->salary->salary_lang['form_header_salary_lang']['slip']; ?></li>
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
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['comission_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['comission_drange2_sessi']; ?>" /><input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                                <div class="page">/ page</div>
                                <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-info"><i class="fa fa-search"></i> <? echo $form_header_lang['search_kop']; ?></button></div></form>
                                
                                
                  </div>
                  
                  </div>
                  <div class="clear">&nbsp;</div>
                  </div>
                <div class="clear">&nbsp;</div>
<form method="post" id="delform" name="delform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><? }?>
                <div class="clear">&nbsp;</div>
                                    <table class="table table-bordered table-hover dataTable gridView" id="table1">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                                <th align="center">&nbsp;</th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;per_page=<? echo $per_page_value; ?>&amp;sort=staff_code <? if($sort_value=="staff_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['staff_code']; ?></a></strong></th>
                                                <th align="center"><strong><a href="<? echo $link_list; ?>?search=<? echo $search_value; ?>&amp;year=<? echo $year_value; ?>&amp;month=<? echo $month_value; ?>&amp;sort=staff_name <? if($sort_value=="staff_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->users->users_lang['form_label_users_lang']['staff_name']; ?></a></strong></th>
                                                <th align="center"><strong>Komisi Part</strong></th>
                                                <th align="center"><strong>Komisi Service</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                                <th align="center" class="td_hide"><strong>&nbsp;</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($slip_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				$view_link='';//"salary_slip_edit_off";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link='';//"salary_slip_edit";
				}
                $staff_pit_status=$global->db_fldrow("staff","staff_pit_status","staff_code='".$slip_search_list[$i]['staff_code']."'");                
                $start_date=$global->date_strtonum($_SESSION['comission_drange1_sessi']);
                $end_date=$global->date_strtonum($_SESSION['comission_drange2_sessi']);
                if($staff_pit_status=="pit"){
                $get_insentif_row=$global->salary->get_comission($slip_search_list[$i]['staff_code'],$start_date,$end_date);
                }else{
                $get_insentif_row=$global->salary->get_comission_nonpit($slip_search_list[$i]['staff_code'],$start_date,$end_date);
                }
                $salary_slip_commission_part=number_format(($get_insentif_row['product_fee']), 2,".","");
                $salary_slip_commission_service=number_format(($get_insentif_row['service_fee']), 2,".","");                
			?>
                                      <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                            <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $slip_search_list[$i]['staff_code'].";".$_SESSION['comission_drange1_sessi']; ?>" /></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="staff_code"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $slip_search_list[$i]['staff_code']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="staff_name"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $slip_search_list[$i]['staff_name']; ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="position_name"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $site_lang['currency'].$global->num_format($salary_slip_commission_part); ?></a></td>
                                            <td bgcolor="<? echo $bg_color; ?>" class="position_name"><a href="javascript:;" class="link_table <? echo $view_link; ?>"><? echo $site_lang['currency'].$global->num_format($salary_slip_commission_service); ?></a></td>
                                            <td class="staff_code_hidden td_hide"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $slip_search_list[$i]['staff_code']; ?></a></td>
                                            <td class="salary_slip_month_hidden td_hide"><a href="#" class="link_table <? echo $view_link; ?>"><? echo $_SESSION['comission_drange1_sessi']; ?></a></td>
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
            
<div class="modal fade" id="myModalnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
		<div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" name="delpopform" id="delpopform" enctype="multipart/form-data" action="">
<div class="box-header text-center">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="clear">&nbsp;<input name="product_order_id" id="product_order_id" type="hidden" value="" /></div>
    <button class="btn btn-info" id="btn_edit" onclick="location.href=''" type="button"><i class="fa fa-play-circle"></i> GANTI</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-warning" id="btn_print" onclick="location.href=''" type="button"><i class="fa fa-print"></i> PRINT</button>
<div>&nbsp;</div>
     </div><!-- /.box-header -->

</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>