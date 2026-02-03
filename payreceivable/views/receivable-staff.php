            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['receivable'];?></h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"><? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['receivable'];?></li>
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
                                <div class="col-md-12">
                                <form action="receivable-staff.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>"size="20" />
                                <div class="page">From: </div>
                                <input class="selectbox" type="text" id="datepicker01" name="date_range1" value="<? echo $_SESSION['receivable_drange1_sessi']; ?>" />
                                <div class="page">to</div>
                                <input class="selectbox" type="text" id="datepicker02" name="date_range2" value="<? echo $_SESSION['receivable_drange2_sessi']; ?>" />
                                <select name="staff_code" class="textbox selectbox" id="staff_code">
                      <option value="" <? echo $staff_code_value; if($staff_code_value==""){?>selected<? }?>>Semua Karyawan</option>
					  <?
						$staff_list=$global->tbl_list("staff","*","","staff_name",1);
						for($i=0;$i<count($staff_list);$i++){
						?>
					  <option value="<? echo $staff_list[$i]['staff_code']; ?>"<? if($staff_code_value==$staff_list[$i]['staff_code']){?> selected="selected"<? }?>><? echo $staff_list[$i]['staff_name']; ?></option>
					  <?
							}
						?>
                      </select>
                      
                      <select name="payreceivable_account" class="textbox selectbox" id="payreceivable_account">
						  <option value="0" <? if($payreceivable_account_value=="0"){?>selected<? }?>>Semua Account Piutang</option>
						  <?
                        $global->payreceivable->book->account_parent_special_create(array("recievable"),$payreceivable_account_value);
                        ?>
                        </select>
                      
                      <input name="per_page" type="text" class="textbox selectbox2" id="per_page" value="<? echo"$per_page_value"; ?>"size="5" />
                      <div class="page">/ page</div>
                      <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-primary"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></div></form>
                      
                      
                  </div>
                  </div>
                  <div class="clear">&nbsp;</div>
                  
                  </div>
                <div class="clear">&nbsp;</div>
                <form onSubmit="return confirmSubmit('<? echo $msgform_lang['cfrm_remove']; ?>')" method="post" id="list_form" name="list_form" enctype="multipart/form-data" action="">
                <? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info"  onclick="location.href='receivable-staff-new.php'" type="button" id="btn_new2"><i class="fa fa-plus"></i> <? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus']; ?> (F2)</button><? }?>
                &nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_add']==1){?><button class="btn btn-info"  onclick="setCount(0,document.list_form,'receivable-staff.php?paid=true&amp;search=<? echo$search_value; ?>&amp;sort=<? echo"$sort_value"; ?>')" name="Submitpaid"><i class="fa fa-minus"></i> <? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus']; ?> (F3)</button><? }?>
                &nbsp;<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.list_form,'receivable-staff.php?delete=true&amp;search=<? echo$search_value; ?>&amp;sort=<? echo"$sort_value"; ?>')" name="Submitdel" value="view" id="Submitdel"><i class="fa fa-times"></i> Hapus (F4)</button><? }?>
                                    <table class="table table-bordered table-hover table-striped gridView" id="table1">
                                        <thead>
                                            <tr>
                                                <td align="center" width="3%">#</td>
                                                <td align="center" width="5%">&nbsp;</td>
                                                <td align="center" width="19%"><strong><a href="receivable-staff.php?sort=payreceivable.payreceivable_registernum <? if($sort_value=="payreceivable.payreceivable_registernum ASC"){?>DESC<? }else{?>ASC<? }?>" class="link_table_title"><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_register']; ?></a></strong></td>
                                                <td align="center" width="10%"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_account']; ?></strong></td>
												<td align="center" width="10%"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_code']; ?></strong></td>
                                                <td align="center" width="17%"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_name']; ?></strong></td>
                                                <td align="center" width="14%"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_description']; ?></strong></td>
                                                <td align="center" width="16%"><strong><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus']; ?></strong></td>
                                                <td align="center" width="16%"><strong><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus']; ?></strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <? 
				for($i=0;$i<count($receivable_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
				if($receivable_search_list[$i]['payreceivable_uneditable']==1 || $receivable_search_list[$i]['payreceivable_paid_status']==1){
					$edit_link="#";
				}else{
				if($receivable_search_list[$i]['payreceivable_status']==0){
					$edit_link="receivable-staff-edit.php?payreceivable_id=".$receivable_search_list[$i]['payreceivable_id'];
					}else{
					$edit_link="receivable-staff-min-edit.php?payreceivable_id=".$receivable_search_list[$i]['payreceivable_id'];
					}}
				$view_link="";
				if($ulm_arr[$parent_active][$page_active]['users_level_module_access_edit']==1){
				$view_link=$edit_link;
				}
			?>
                                        <tr class="clickable-row" data-href="<? echo $view_link; ?>">
                                            <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>"><? if($receivable_search_list[$i]['payreceivable_uneditable']!=1 && $receivable_search_list[$i]['payreceivable_paid_status']!=1){?><input name="id[]" type="checkbox" id="id[]" value="<? echo $receivable_search_list[$i]['payreceivable_id']; ?>" /><? }?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>" class="payreceivable_register"><? echo $receivable_search_list[$i]['payreceivable_register']; ?></td>
											<td bgcolor="<? echo"$bg_color"; ?>" class="taxonomi_name"><? echo $payreceivable_account_arr[$i]['taxonomi_name']; ?></td>
											<td bgcolor="<? echo"$bg_color"; ?>" class="payreceivable_code"><? echo $receivable_search_list[$i]['payreceivable_code']; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>" class="staff_name"><? echo $receivable_search_list[$i]['staff_code']; ?> - <? echo $receivable_search_list[$i]['staff_name']; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>" class="payreceivable_description"><? echo $receivable_search_list[$i]['payreceivable_description']; ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>" class="payreceivable_amount"><? if($receivable_search_list[$i]['payreceivable_status']==0){ echo $site_lang['currency'].$global->num_format($receivable_search_list[$i]['payreceivable_amount']); }else{echo "-";} ?></td>
                                            <td bgcolor="<? echo"$bg_color"; ?>" class="payreceivable_amount"><? if($receivable_search_list[$i]['payreceivable_status']==1){ echo $site_lang['currency'].$global->num_format($receivable_search_list[$i]['payreceivable_amount']); }else{echo "-";} ?></td>
                                          </tr>
										  <?
				$inc++;
				}
			?>
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
										  <td>&nbsp;</td>
                                          <td align="right"><strong><? echo $form_header_lang['balance']; ?>:</strong></td>
                                          <td><strong><? echo $site_lang['currency'].$global->num_format($saldo); ?></strong></td>
                                          <td>&nbsp;</td>
                                          <td class="td_hide">&nbsp;</td>
                                          <td class="td_hide">&nbsp;</td>
                                          <td class="td_hide">&nbsp;</td>
                                          <td class="td_hide">&nbsp;</td>
                                          <td class="td_hide">&nbsp;</td>
                                        </tr>
                                          
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
                            <a href="receivable-staff.php?pageset=0"><i class="fa fa-angle-double-left"></i></a> <a href="receivable-staff.php?pageset=<? echo"$pageset_prev"; ?>"><i class="fa fa-angle-left"></i></a>
                            <? }?></td>
                        <td align="center" class="text_body"><strong><? echo"$current_page"; ?> <? echo $form_header_lang['pageset_of']; ?> <? echo"$total_page"; ?></strong></td>
                        <td><? if($current_page<$total_page) { ?>
                            <a href="receivable-staff.php?pageset=<? echo"$pageset_next"; ?>"><i class="fa fa-angle-right"></i></a> <a href="receivable-staff.php?pageset=<? echo"$pageset_last"; ?>"><i class="fa fa-angle-double-right"></i></a>
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

<form action="receivable-staff-new-process.php" method="post" enctype="multipart/form-data" name="form" id="form"> <input name="payreceivable_status" type="hidden" id="payreceivable_status" value="0" /> 
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['receivable'];?></u></strong></p>                          
<div>&nbsp;</div>
     </div><!-- /.box-header -->
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-8"><input type="text" id="datepicker" name="date_register" value="<? echo $_SESSION['receivable_drange2_sessi']; ?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['staff_name']; ?>:</strong></div>
<div class="col-md-8 typehead_staff"><input name="staff_code" type="text" class="textbox firstin" id="staff_code"></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_code']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_code" type="text" class="textbox" id="payreceivable_code"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_description']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_description" type="text" class="textbox" id="payreceivable_description"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="payreceivable_amount" type="text" class="textbox" id="payreceivable_amount"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>:</strong></div>
<div class="col-md-8"><select name="payreceivable_accountdebit" class="textbox" id="payreceivable_accountdebit">
              <?
			$global->payreceivable->book->account_parent_special_create(array("recievable"),0);
			?>
              </select></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountcredit']; ?>:</strong></div>
<div class="col-md-8 typehead_account"><input name="payreceivable_accountcredit" type="text" class="textbox lastinnew" id="payreceivable_accountcredit" placeholder="Kode Rekening"></div>
</div>

<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submitnew">Proses Data</button></div>
</div> 
</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModalnew2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">

<form action="receivable-staff-new-process.php" method="post" enctype="multipart/form-data" name="form" id="form"> <input name="payreceivable_status" type="hidden" id="payreceivable_status" value="1" /> 
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['receivable'];?></u></strong></p>                          
<div>&nbsp;</div>
     </div><!-- /.box-header -->
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-8"><input type="text" id="datepicker2" name="date_register" value="<? echo $_SESSION['receivable_drange2_sessi']; ?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['staff_name']; ?>:</strong></div>
<div class="col-md-8 typehead_staff"><input name="staff_code" type="text" class="textbox firstin" id="staff_code"></div>
</div>
<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_code']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_code" type="text" class="textbox" id="payreceivable_code"></div>
</div>
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_description']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_description" type="text" class="textbox" id="payreceivable_description"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="payreceivable_amount" type="text" class="textbox" id="payreceivable_amount"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>:</strong></div>
<div class="col-md-8 typehead_account"><input name="payreceivable_accountdebit" type="text" class="textbox" id="payreceivable_accountdebit" placeholder="Kode Rekening"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountcredit']; ?>:</strong></div>
<div class="col-md-8"><select name="payreceivable_accountcredit" class="textbox lastinnew2" id="payreceivable_accountcredit">
              
			<?
			$global->payreceivable->book->account_parent_special_create(array("recievable"),0);
			?>
            </select></div>
</div>

<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submitnew2">Proses Data</button></div>
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
    <p class="title-header"><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['receivable_edit']; ?></u></strong></p>                          
<div>&nbsp;</div>
     </div><!-- /.box-header -->
<form action="receivable-staff-edit-process.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="payreceivable_id" type="hidden" id="payreceivable_id" /><input name="payreceivable_status" type="hidden" id="payreceivable_status" /> 
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-8"><input type="text" id="datepicker3" name="date_register"></div>
</div>
<div class="row clearfix append_div">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['staff_name']; ?>:</strong></div>
<div class="col-md-8 typehead_staff"><input name="staff_code" type="text" class="textbox firstin auto_foc" id="staff_code"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_code']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_code" type="text" class="textbox auto_foc_trg" id="payreceivable_code"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_description']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_description" type="text" class="textbox" id="payreceivable_description"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="payreceivable_amount" type="text" class="textbox" id="payreceivable_amount"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>:</strong></div>
<div class="col-md-8"><select name="payreceivable_accountdebit" class="textbox" id="payreceivable_accountdebit">
             <?
			$global->payreceivable->book->account_parent_special_create(array("recievable"),0);
			?> 
            </select></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountcredit']; ?>:</strong></div>
<div class="col-md-8 typehead_account"><input name="payreceivable_accountcredit" type="text" class="textbox lastinedit2" id="payreceivable_accountcredit" placeholder="Kode Rekening"></div>
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

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['receivable_edit']; ?></u></strong></p>                          
<div>&nbsp;</div>
     </div><!-- /.box-header -->
<form action="receivable-staff-edit-process.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="payreceivable_id" type="hidden" id="payreceivable_id" /><input name="payreceivable_status" type="hidden" id="payreceivable_status" /> 
<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['date_input']; ?>:</strong></div>
<div class="col-md-8"><input type="text" id="datepicker4" name="date_register"></div>
</div>
<div class="row clearfix append_div">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['staff_name']; ?>:</strong></div>
<div class="col-md-8 typehead_staff"><input name="staff_code" type="text" class="textbox firstin auto_foc" id="staff_code"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_code']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_code" type="text" class="textbox auto_foc_trg" id="payreceivable_code"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_description']; ?>:</strong></div>
<div class="col-md-8"><input name="payreceivable_description" type="text" class="textbox" id="payreceivable_description"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_header_lang['amount']; ?>:</strong></div>
<div class="col-md-8"><? echo $site_lang['currency']; ?>
              <input name="payreceivable_amount" type="text" class="textbox" id="payreceivable_amount"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountdebit']; ?>:</strong></div>
<div class="col-md-8 typehead_account"><input name="payreceivable_accountdebit" type="text" class="textbox" id="payreceivable_accountdebit" placeholder="Kode Rekening"></div>
</div>

<div class="row clearfix">                                
<div class="col-md-4"><strong><? echo $global->payreceivable->payreceivable_lang['form_label_payreceivable_lang']['payreceivable_accountcredit']; ?>:</strong></div>
<div class="col-md-8"><select name="payreceivable_accountcredit" class="textbox lastinedit2" id="payreceivable_accountcredit">
              
			<?
			$global->payreceivable->book->account_parent_special_create(array("recievable"),0);
			?>
            </select></div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submitedit2"><? echo $form_header_lang['edit_button']; ?></button></div>
</div> 
</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>