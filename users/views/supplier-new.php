            <? $col_md1="col-md-4"; $col_md2="col-md-8";if(!isset($modal)){ $col_md1="col-md-2"; $col_md2="col-md-10";?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['supplier_new']; ?></h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="<? echo $link_list; ?>"><? echo $global->users->users_lang['form_header_users_lang']['supplier']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['supplier_new']; ?></li>
                    </ol>
                    <? }?>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="<? echo $link_new; ?>" method="post" enctype="multipart/form-data" name="form" id="form">
<? }?>
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['supplier_new']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div>
 
<div class="row clearfix">
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_code']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><input name="users_code" type="text" class="textbox firstin" id="users_code" value="<? echo $users_code_generation;?>"></div>
</div>

<div class="row clearfix">                                
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><select name="users_status" class="textbox" id="users_status">
              <? for($list_inc=0;$list_inc<count($form_selectlist_lang['users_status']);$list_inc++){?>
              <option<? if($list_inc==0){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['users_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_status'][$list_inc][1]; ?></option>
              <? }?>
            </select></div>
</div>
<div class="row clearfix">                                
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><input name="users_name" type="text" class="textbox" id="users_name"></div>
</div>
<div class="row clearfix">
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><textarea name="users_address" cols="40" rows="4" class="textbox" id="users_address"></textarea></div>
</div>

<div class="row clearfix">
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_phone']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><input name="users_phone" type="text" class="textbox" id="users_phone"></div>
</div>

<div class="row clearfix">
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_email']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><input name="users_email" type="text" class="textbox" id="users_email"></div>
</div>

<div class="row clearfix">
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_idnumber']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><input name="users_idnumber" type="text" class="textbox lastinnew" id="users_idnumber"></div>
</div>


<? if(!isset($modal)){?>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='<? echo $link_new; ?>?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
</div> 

</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->
<? }?>

