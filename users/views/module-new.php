            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['module_new']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pengaturan & Peralatan</a></li>
                        <li><a href="module.php"><? echo $global->users->users_lang['form_header_users_lang']['module']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['module_new']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="module-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['module_new']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_code']; ?>:</strong></div>
<div class="col-md-10"><input name="module_code" type="text" class="textbox firstin" id="module_code" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_name']; ?>:</strong></div>
<div class="col-md-10"><input name="module_name" type="text" class="textbox" id="module_name" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_link']; ?>:</strong></div>
<div class="col-md-10"><input name="module_link" type="text" class="textbox" id="module_link" required="required"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_bg_color']; ?>:</strong></div>
<div class="col-md-10"><input name="module_bg_color" type="text" class="textbox" id="module_bg_color" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_fa_icon']; ?>:</strong></div>
<div class="col-md-10"><input name="module_fa_icon" type="text" class="textbox" id="module_fa_icon" required="required"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_rank']; ?>:</strong></div>
<div class="col-md-10"><select name="module_rank" class="textbox selectbox" id="module_rank">
                      <option value="100">None</option>
					  <?
						$module_list=$global->tbl_list("module","*","","",1);
						for($i_list=1;$i_list<=count($module_list);$i_list++){
						?>
					  <option value="<? echo $i_list; ?>"><? echo $i_list; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['module_lock']; ?>:</strong></div>
<div class="col-md-10">
  <input type="checkbox" name="module_lock" id="module_lock" class="lastinnew" />
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

