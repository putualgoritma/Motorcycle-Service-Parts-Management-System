            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Inventaris</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>">Keuangan</a></li>
                        <li class="active">Inventaris</li>
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
                                <div class="col-md-10">
								<form action="asset-fixed.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>"size="20" />
                                <div class="page">From: </div>
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['afixed_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['afixed_drange2_sessi']; ?>" />
                                <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />                   <div class="page">/ page</div>                 
                   <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-primary"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></div></form>
                   
                   
                  </div>
                  
                  </div>
                  </div>
                <div class="clear">&nbsp;</div>
<form onSubmit="return confirmSubmit('<? echo $msgform_lang['cfrm_remove']; ?>')" method="post" name="myform" enctype="multipart/form-data" action="">
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.myform,'asset-fixed.php?delete=true')" name="Submitdel"><i class="fa fa-times"></i> <? echo $form_header_lang['delete_kop']; ?></button><? }?>
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><a class="btn btn-info" role="button" href="#" data-toggle="modal" data-target="#myModalnew"><i class="fa fa-plus"></i> <? echo $form_header_lang['add_new_kop']; ?></a><? }?>
                                    <table id="table1" class="table table-bordered table-striped gridView">
                                        <thead>
                                            <tr>
                                                <th width="3%">#</th>
                                                <th width="3%">&nbsp;</th>
                                                <th width="9%"><a href="asset-fixed.php?sort=asset_fixed_code <? if($sort_value=="asset_fixed_code ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_code']; ?></a></th>
                                                <th width="12%"><a href="asset-fixed.php?sort=asset_fixed_registernum <? if($sort_value=="asset_fixed_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_register']; ?></a></th>
                                                <th width="42%"><a href="asset-fixed.php?sort=product_name <? if($sort_value=="product_name ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_name']; ?></a></th>
                                                <th width="18%"><a href="asset-fixed.php?sort=asset_fixed_quantity <? if($sort_value=="asset_fixed_quantity ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $form_header_lang['amount']; ?></a></th>
                                                <th width="13%"><a href="asset-fixed.php?sort=asset_fixed_amount <? if($sort_value=="asset_fixed_amount ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_amount']; ?></a></th>
                                                <th width="13%"><a href="asset-fixed.php?sort=asset_fixed_depreciation_period <? if($sort_value=="asset_fixed_depreciation_period ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_period']; ?></a></th>
                                                <th width="13%"><a href="asset-fixed.php?sort=asset_fixed_depreciation_type <? if($sort_value=="asset_fixed_depreciation_type ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_type']; ?></a></th>
                                                <th width="13%"><? echo $form_header_lang['details']; ?></th>
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
                                        <tbody>
                                        <? 
			 for($i=0;$i<count($asset_fixed_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				if($global->tbldata_exist("depreciation","*","asset_fixed_id='".$asset_fixed_search_list[$i]['asset_fixed_id']."'")){
					$modal_class="asset_fixed_edit2";
					}else{
					$modal_class="asset_fixed_edit";
					}
			?>
                                        <tr>
                                          <td bgcolor="<? echo $bg_color; ?>"><? echo $inc; ?></td>
                                          <td bgcolor="<? echo $bg_color; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $asset_fixed_search_list[$i]['asset_fixed_id']; ?>" /></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_code"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_code']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_register"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_register']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_name"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_name']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_quantity"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_quantity']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_amount"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $site_lang['currency'].$global->num_format($asset_fixed_search_list[$i]['asset_fixed_amount']); ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_depreciation_period"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_depreciation_period']; ?> <? echo $form_header_lang['month']; ?>.</a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_depreciation_type"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $global->asset_fixed->get_selectlist($form_selectlist_lang['asset_fixed_depreciation_type'],$asset_fixed_search_list[$i]['asset_fixed_depreciation_type']); ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>"><a href="depreciation.php?search=<? echo $asset_fixed_search_list[$i]['asset_fixed_id']; ?>"><small class="label btn btn-info"><i class="fa fa-edit"></i> <? echo $form_header_lang['trs_btn']; ?></small></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_id_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_id']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_type_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_type']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_amount_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_amount']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_depreciation_type_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_depreciation_type']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="payment_type_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['payment_type']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="users_code_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['users_code']; ?> - <? echo $asset_fixed_search_list[$i]['users_name']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_accountcredit_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_accountcredit']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_description_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_description']; ?></a></td>
                                          <td bgcolor="<? echo $bg_color; ?>" class="asset_fixed_depreciation_period_hidden td_hide"><a href="#" class="link_table <? echo $modal_class; ?>"><? echo $asset_fixed_search_list[$i]['asset_fixed_depreciation_period']; ?></a></td>
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
                            <a href="asset-fixed.php?pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="asset-fixed.php?pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>
                            <? }?></td>
                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>
                        <td><? if($current_page<$total_page) { ?>
                            <a href="asset-fixed.php?pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="asset-fixed.php?pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>
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
<form action="asset-fixed-new-process.php" method="post" enctype="multipart/form-data" name="form" id="form"> 
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->asset_fixed->asset_fixed_lang['form_header_asset_fixed_lang']['asset_fixed_new']; ?>: </u></strong></p>  
<div>&nbsp;</div>
     </div><!-- /.box-header -->

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-8"><input type="text" id="datepicker" name="date_register" value="<? echo $_SESSION['afixed_drange2_sessi']; ?>"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_type']; ?>:</strong></div>
<div class="col-md-8"><select name="asset_fixed_type" class="textbox firstin" id="asset_fixed_type">
              <? for($list_inc=0;$list_inc<count($form_selectlist_lang['asset_fixed_type']);$list_inc++){?>
                  <option value="<? echo $form_selectlist_lang['asset_fixed_type'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['asset_fixed_type'][$list_inc][1]; ?></option>
                  <? }?>
            </select></div>
</div>



<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_code']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_code" type="text" class="textbox" id="asset_fixed_code" value="<? echo $asset_fixed_code_generation;?>"></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_name']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_name" type="text" class="textbox" id="asset_fixed_name"></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_description']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_description" type="text" class="textbox" id="asset_fixed_description"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_quantity']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_quantity" type="text" class="textbox" id="asset_fixed_quantity" value="1"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="asset_fixed_amount" type="text" class="textbox" id="asset_fixed_amount"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_period']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_depreciation_period" type="text" class="textbox" id="asset_fixed_depreciation_period"size="10" />
              <? echo $form_header_lang['month']; ?>.</div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_type']; ?>:</strong></div>
<div class="col-md-8"><select name="asset_fixed_depreciation_type" class="textbox" id="asset_fixed_depreciation_type">
              <? for($list_inc=0;$list_inc<count($form_selectlist_lang['asset_fixed_depreciation_type']);$list_inc++){?>
                  <option value="<? echo $form_selectlist_lang['asset_fixed_depreciation_type'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['asset_fixed_depreciation_type'][$list_inc][1]; ?></option>
                  <? }?>
            </select></div>
</div>

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['payment_type']; ?>:</strong></div>
  <div class="col-md-8 typehead_supplier">
  		<label class="radio-inline">
        <input name="payment_type" type="radio" id="payment_type_0" value="cash" checked="checked" />
        Tunai</label>
        <label class="radio-inline">
        <input type="radio" name="payment_type" value="credit" id="payment_type_1" />
        Kredit</label>
  </div>
</div>

<div class="row clearfix payment_type credit">
  <div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['users_name']; ?>:</strong></div>
  <div class="col-md-8 typehead_supplier"><input name="users_code" type="text" class="textbox" id="users_code"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $form_header_lang['taxonomy_trs_pay']; ?>:</strong></div>
<div class="col-md-8"><select name="asset_fixed_accountcredit" class="textbox lastinnew" id="asset_fixed_accountcredit">
<? $global->asset_fixed->book->account_parent_special_create(array("cash_bank"),0); ?>
</select></div>
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
<form action="asset-fixed-edit-process.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="asset_fixed_id" type="hidden" id="asset_fixed_id" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->asset_fixed->asset_fixed_lang['form_header_asset_fixed_lang']['asset_fixed_new']; ?>: </u></strong></p>  
<div>&nbsp;</div>
     </div><!-- /.box-header -->

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-8"><input type="text" id="datepicker2" name="date_register" value="<? echo $date_def; ?>"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_type']; ?>:</strong></div>
<div class="col-md-8"><select name="asset_fixed_type" class="textbox firstin" id="asset_fixed_type">
              <? for($list_inc=0;$list_inc<count($form_selectlist_lang['asset_fixed_type']);$list_inc++){?>
                  <option value="<? echo $form_selectlist_lang['asset_fixed_type'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['asset_fixed_type'][$list_inc][1]; ?></option>
                  <? }?>
            </select></div>
</div>



<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_code']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_code" type="text" class="textbox" id="asset_fixed_code"></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_name']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_name" type="text" class="textbox" id="asset_fixed_name"></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_description']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_description" type="text" class="textbox" id="asset_fixed_description"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_quantity']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_quantity" type="text" class="textbox" id="asset_fixed_quantity" value="1"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="asset_fixed_amount" type="text" class="textbox" id="asset_fixed_amount"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_period']; ?>:</strong></div>
<div class="col-md-8"><input name="asset_fixed_depreciation_period" type="text" class="textbox" id="asset_fixed_depreciation_period"size="10" />
              <? echo $form_header_lang['month']; ?>.</div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['asset_fixed_depreciation_type']; ?>:</strong></div>
<div class="col-md-8"><select name="asset_fixed_depreciation_type" class="textbox" id="asset_fixed_depreciation_type">
              <? for($list_inc=0;$list_inc<count($form_selectlist_lang['asset_fixed_depreciation_type']);$list_inc++){?>
                  <option value="<? echo $form_selectlist_lang['asset_fixed_depreciation_type'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['asset_fixed_depreciation_type'][$list_inc][1]; ?></option>
                  <? }?>
            </select></div>
</div>

<div class="row clearfix">
  <div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['payment_type']; ?>:</strong></div>
  <div class="col-md-8 typehead_supplier">
  		<label class="radio-inline">
        <input name="payment_type" type="radio" id="cash" value="cash" checked="checked" />
        Tunai</label>
        <label class="radio-inline">
        <input type="radio" name="payment_type" value="credit" id="credit" />
        Kredit</label>
  </div>
</div>

<div class="row clearfix append_div payment_type credit">
  <div class="col-md-4"><strong><? echo $global->asset_fixed->asset_fixed_lang['form_label_asset_fixed_lang']['users_name']; ?>:</strong></div>
  <div class="col-md-8 typehead_users"><input name="users_code" type="text" class="textbox" id="users_code2"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $form_header_lang['taxonomy_trs_pay']; ?>:</strong></div>
<div class="col-md-8"><select name="asset_fixed_accountcredit" class="textbox lastinedit" id="asset_fixed_accountcredit">
<? $global->asset_fixed->book->account_parent_special_create(array("cash_bank"),0); ?>
</select></div>
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