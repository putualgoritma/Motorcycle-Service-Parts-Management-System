            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['contact_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pengaturan & Peralatan</a></li>
                        <li><a href="contact.php"><? echo $global->users->users_lang['form_header_users_lang']['contact']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['contact_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="contact-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['contact_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['contact_code']; ?>:</strong></div>
<div class="col-md-10"><input name="contact_id" type="hidden" id="contact_id" value="<? echo $contact_row['contact_id']; ?>"/><input name="contact_code" type="text" class="textbox firstin" id="contact_code" value="<? echo $contact_row['contact_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['contact_name']; ?>:</strong></div>
<div class="col-md-10"><input name="contact_name" type="text" class="textbox" id="contact_name" value="<? echo $contact_row['contact_name']; ?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_level_code']; ?>:</strong></div>
<div class="col-md-10"><select name="users_level_code" class="textbox firstin" id="users_level_code">
                <?
				$qry_users_level_filter="";
				if($_SESSION['users_level_code_sessi']!="MASTER ADMIN"){
					$qry_users_level_filter="users_level_code!='MASTER ADMIN'";
					}
				$users_level_list=$global->tbl_list("users_level","*",$qry_users_level_filter,"users_level_id",1);
				for($i=0;$i<count($users_level_list);$i++){
				?>
                <option value="<? echo $users_level_list[$i]['users_level_code']; ?>"<? if($contact_row['users_level_code']==$users_level_list[$i]['users_level_code']){?> selected="selected"<? }?>><? echo $users_level_list[$i]['users_level_code']; ?>&nbsp;-&nbsp;<? echo $users_level_list[$i]['users_level_name']; ?></option>
                <?
					}
				?>
            </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['contact_username']; ?>:</strong></div>
<div class="col-md-10"><input name="contact_username" type="text" class="textbox" id="contact_username" required="required" value="<? echo $contact_row['contact_username']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['contact_password']; ?>:</strong></div>
<div class="col-md-10"><input name="contact_password" type="text" class="textbox lastinedit" id="contact_password" required="required" value="<? echo $contact_row['contact_password']; ?>"></div>
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

