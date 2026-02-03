            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['area_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="area.php"><? echo $global->users->users_lang['form_header_users_lang']['area']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['area_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="area-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['area_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['area_code']; ?>:</strong></div>
<div class="col-md-10"><input name="area_id" type="hidden" id="area_id" value="<? echo $area_row['area_id']; ?>"/><input name="area_code" type="text" class="textbox firstin" id="area_code" value="<? echo $area_row['area_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['area_range']; ?>:</strong></div>
<div class="col-md-10"><select name="area_range" class="textbox" id="area_range">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['area_range']);$list_inc++){?>
    <option<? if($area_row['area_range']==$form_selectlist_lang['area_range'][$list_inc][0]){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['area_range'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['area_range'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['area_name']; ?>:</strong></div>
<div class="col-md-10"><input name="area_name" type="text" class="textbox lastinedit" id="area_name" value="<? echo $area_row['area_name']; ?>"></div>
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

