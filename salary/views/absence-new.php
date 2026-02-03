            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->salary->salary_lang['form_header_salary_lang']['absence_new']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="absence.php"><? echo $global->salary->salary_lang['form_header_salary_lang']['absence']; ?></a></li>
                        <li class="active"><? echo $global->salary->salary_lang['form_header_salary_lang']['absence_new']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="absence-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->salary->salary_lang['form_header_salary_lang']['absence_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_date']; ?>:</strong></div>
<div class="col-md-10"><input name="absence_id" type="hidden" id="absence_id" value="<? echo $absence_id; ?>"/><input name="absence_date" type="text" class="textbox datepicker" id="absence_date" value="<? echo $date_def; ?>" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_code']; ?>:</strong></div>
<div class="col-md-10 typehead_staff"><input name="staff_code" type="text" class="textbox" id="staff_code" value="" required="required">&nbsp;<? echo $staff_name; ?></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_status']; ?>:</strong></div>
<div class="col-md-10"><select name="absence_status" class="textbox firstin" id="absence_status">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['absence_status']);$list_inc++){?>
    <option<? if($form_selectlist_lang['absence_status'][$list_inc][0]==$absence_status){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['absence_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['absence_status'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_work_in']; ?>:</strong></div>
<div class="col-md-10"><input name="absence_work_in" type="text" class="textbox time" id="absence_work_in" value="<? echo $absence_work_in; ?>"<? if($absence_status!="work"){?> readonly="readonly"<? }?>></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_work_out']; ?>:</strong></div>
<div class="col-md-10"><input name="absence_work_out" type="text" class="textbox time" id="absence_work_out" value="<? echo $absence_work_out; ?>"<? if($absence_status!="work"){?> readonly="readonly"<? }?>></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_break_in']; ?>:</strong></div>
<div class="col-md-10"><input name="absence_break_in" type="text" class="textbox time" id="absence_break_in" value="<? echo $absence_break_in; ?>"<? if($absence_status!="work"){?> readonly="readonly"<? }?>></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_break_out']; ?>:</strong></div>
<div class="col-md-10"><input name="absence_break_out" type="text" class="textbox time" id="absence_break_out" value="<? echo $absence_break_out; ?>"<? if($absence_status!="work"){?> readonly="readonly"<? }?>></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['absence_description']; ?>:</strong></div>
<div class="col-md-10">
  <textarea name="absence_description" cols="40" rows="4" class="textbox lastinedit" id="absence_description"><? echo $absence_description; ?></textarea>
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

