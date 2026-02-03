            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['module_sub_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pengaturan & Peralatan</a></li>
                        <li><a href="module-sub.php"><? echo $global->users->users_lang['form_header_users_lang']['module_sub']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['module_sub_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="module-sub-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['module_sub_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_code']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_id" type="hidden" id="module_sub_id" value="<? echo $module_sub_row['module_sub_id']; ?>"/><select name="module_code" class="textbox firstin" id="module_code">
                <?
				$module_list=$global->tbl_list("module","*","","module_id",1);
				for($i=0;$i<count($module_list);$i++){
				?>
                <option value="<? echo $module_list[$i]['module_code']; ?>"<? if($module_sub_row['module_code']==$module_list[$i]['module_code']){?> selected="selected"<? }?>><? echo $module_list[$i]['module_code']; ?>&nbsp;-&nbsp;<? echo $module_list[$i]['module_name']; ?></option>
                <?
					}
				?>
            </select></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_code']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_code" type="text" class="textbox" id="module_sub_code" value="<? echo $module_sub_row['module_sub_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_name']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_name" type="text" class="textbox" id="module_sub_name" value="<? echo $module_sub_row['module_sub_name']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_link']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_link" type="text" class="textbox" id="module_sub_link" value="<? echo $module_sub_row['module_sub_link']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_bg_color']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_bg_color" type="text" class="textbox" id="module_sub_bg_color" value="<? echo $module_sub_row['module_sub_bg_color']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_fa_icon']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_fa_icon" type="text" class="textbox" id="module_sub_fa_icon" value="<? echo $module_sub_row['module_sub_fa_icon']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_rank']; ?>:</strong></div>
<div class="col-md-10"><select name="module_sub_rank" class="textbox selectbox" id="module_sub_rank">
                      <option value="100"<? if(100==$module_sub_row['module_sub_rank']){?> selected="selected"<? }?>>None</option>
					  <?
						$module_sub_list=$global->tbl_list("module_sub","*","module_code='".$module_sub_row['module_code']."'","",1);
						for($i_list=1;$i_list<=count($module_sub_list);$i_list++){
						?>
					  <option value="<? echo $i_list; ?>"<? if($i_list==$module_sub_row['module_sub_rank']){?> selected="selected"<? }?>><? echo $i_list; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_lock']; ?>:</strong></div>
<div class="col-md-10">
  <input name="module_sub_lock" type="checkbox" id="module_sub_lock"<? if($module_sub_row['module_sub_lock']=="1"){?> checked="checked"<? }?> class="lastinedit" />
</div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

