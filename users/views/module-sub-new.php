            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['module_sub_new']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pengaturan & Peralatan</a></li>
                        <li><a href="module-sub.php"><? echo $global->users->users_lang['form_header_users_lang']['module_sub']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['module_sub_new']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="module-sub-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['module_sub_new']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_code']; ?>:</strong></div>
<div class="col-md-10"><select name="module_code" class="textbox firstin" id="module_code">
                <?
				$module_list=$global->tbl_list("module","*","","module_id",1);
				for($i=0;$i<count($module_list);$i++){
				?>
                <option value="<? echo $module_list[$i]['module_code']; ?>"<? if($i==0){?> selected="selected"<? }?>><? echo $module_list[$i]['module_code']; ?>&nbsp;-&nbsp;<? echo $module_list[$i]['module_name']; ?></option>
                <?
					}
				?>
            </select></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_code']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_code" type="text" class="textbox" id="module_sub_code" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_name']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_name" type="text" class="textbox" id="module_sub_name" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_link']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_link" type="text" class="textbox" id="module_sub_link" required="required"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_bg_color']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_bg_color" type="text" class="textbox" id="module_sub_bg_color" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_sub_fa_icon']; ?>:</strong></div>
<div class="col-md-10"><input name="module_sub_fa_icon" type="text" class="textbox" id="module_sub_fa_icon" required="required"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_lock']; ?>:</strong></div>
<div class="col-md-10">
  <input type="checkbox" name="module_sub_lock" id="module_sub_lock" class="lastinnew" />
</div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submitnew"><? echo $form_header_lang['add_new_button']; ?></button></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

