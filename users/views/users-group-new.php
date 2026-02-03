            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['users_group_new']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="users-group.php"><? echo $global->users->users_lang['form_header_users_lang']['users_group']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['users_group_new']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="users-group-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['users_group_new']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_group_code']; ?>:</strong></div>
<div class="col-md-10"><input name="users_group_code" type="text" class="textbox firstin" id="users_group_code" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_group_name']; ?>:</strong></div>
<div class="col-md-10"><input name="users_group_name" type="text" class="textbox" id="users_group_name" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_group_disc_product']; ?>:</strong></div>
<div class="col-md-10"><input name="users_group_disc_product" type="text" class="textbox" id="users_group_disc_product" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_group_disc_service']; ?>:</strong></div>
<div class="col-md-10"><input name="users_group_disc_service" type="text" class="textbox" id="users_group_disc_service" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_group_disc_final']; ?>:</strong></div>
<div class="col-md-10"><input name="users_group_disc_final" type="text" class="textbox lastinnew" id="users_group_disc_final" required="required"></div>
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

