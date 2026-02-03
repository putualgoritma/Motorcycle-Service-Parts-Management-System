            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['village_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="village.php"><? echo $global->users->users_lang['form_header_users_lang']['village']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['village_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="village-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['village_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['village_code']; ?>:</strong></div>
<div class="col-md-10"><input name="village_id" type="hidden" id="village_id" value="<? echo $village_row['village_id']; ?>"/><input name="village_code" type="text" class="textbox firstin" id="village_code" value="<? echo $village_row['village_code']; ?>" readonly="readonly"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['village_name']; ?>:</strong></div>
<div class="col-md-10"><input name="village_name" type="text" class="textbox" id="village_name" value="<? echo $village_row['village_name']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['district_code']; ?>:</strong></div>
<div class="col-md-10"><select name="district_code" class="textbox selectbox" id="district_code" required="required">
                      <option value=""<? if($village_row['district_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("district","*","","district_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['district_code']; ?>"<? if($village_row['district_code']==$select_list[$i_list]['district_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['district_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
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

