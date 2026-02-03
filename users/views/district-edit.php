            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['district_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="district.php"><? echo $global->users->users_lang['form_header_users_lang']['district']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['district_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="district-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['district_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['district_code']; ?>:</strong></div>
<div class="col-md-10"><input name="district_id" type="hidden" id="district_id" value="<? echo $district_row['district_id']; ?>"/><input name="district_code" type="text" class="textbox firstin" id="district_code" value="<? echo $district_row['district_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['district_name']; ?>:</strong></div>
<div class="col-md-10"><input name="district_name" type="text" class="textbox" id="district_name" value="<? echo $district_row['district_name']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['city_code']; ?>:</strong></div>
<div class="col-md-10"><select name="city_code" class="textbox selectbox" id="city_code" required="required">
                      <option value=""<? if($district_row['city_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("city","*","","city_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['city_code']; ?>"<? if($district_row['city_code']==$select_list[$i_list]['city_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['city_name']; ?></option>
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

