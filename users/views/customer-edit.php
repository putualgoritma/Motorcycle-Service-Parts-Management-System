            <? $col_md1="col-md-4"; $col_md2="col-md-8";if(!isset($modal)){ $col_md1="col-md-2"; $col_md2="col-md-10";?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['customer_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="customer.php"><? echo $global->users->users_lang['form_header_users_lang']['customer']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['customer_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="customer-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<? }?>
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['customer_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_code']; ?>:</strong></div>
  <div class="col-md-10"><input name="users_id" type="hidden" id="users_id" value="<? echo $users_id; ?>"/><input name="users_code" type="text" class="textbox" id="users_code" value="<? echo $users_row['users_code']; ?>" required="required" readonly="readonly"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_status']; ?>:</strong></div>
  <div class="col-md-10"><select name="users_status" class="textbox firstin" id="users_status">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['users_status']);$list_inc++){?>
    <option<? if($users_row['users_status']==$form_selectlist_lang['users_status'][$list_inc][0]){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['users_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['users_status'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_name']; ?>:</strong></div>
  <div class="col-md-10"><input name="users_name" type="text" class="textbox" id="users_name" required="required" value="<? echo $users_row['users_name']; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_address']; ?>:</strong></div>
  <div class="col-md-10"><textarea name="users_address" cols="40" rows="4" class="textbox" id="users_address"><? echo $users_row['users_address']; ?></textarea></div>
</div>

<div class="row clearfix">                                
  <div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_level_code']; ?>:</strong></div>
  <div class="<? echo $col_md2; ?>"><select name="customer_level_code" class="textbox firstin" id="customer_level_code">
    <option value=""<? if($users_row['customer_level_code']==""){?> selected="selected"<? }?>>None</option>
	<?php
$customer_level_list=$global->tbl_list("customer_level","*","","",1);
for($i_list1=0;$i_list1<count($customer_level_list);$i_list1++){
?>
<option value="<? echo $customer_level_list[$i_list1]['customer_level_code']; ?>"<? if($users_row['customer_level_code']==$customer_level_list[$i_list1]['customer_level_code']){?> selected="selected"<? }?>><? echo $customer_level_list[$i_list1]['customer_level_code']; ?> - <? echo $customer_level_list[$i_list1]['customer_level_name']; ?></option>
<?php
}
?>
    </select></div>
</div>

<div class="row clearfix"<? if($app_type!="ahass"){ ?> style="display:none"<? } ?>>                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['area_name']; ?>:</strong></div>
<div class="col-md-10"><select name="area_code" class="textbox selectbox" id="area_code"<? if($app_type=="ahass"){ ?> required="required"<? } ?>>
                      <option value=""<? if($users_row['area_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("area","*","","area_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['area_code']; ?>"<? if($users_row['area_code']==$select_list[$i_list]['area_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['area_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>


<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_phone']; ?>:</strong></div>
  <div class="col-md-10"><input name="users_phone" type="text" class="textbox" id="users_phone" value="<? echo $users_row['users_phone']; ?>" required="required"></div>
</div>

<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_email']; ?>:</strong></div>
  <div class="col-md-10"><input name="users_email" type="text" class="textbox" id="users_email" value="<? echo $users_row['users_email']; ?>"></div>
</div>

<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_idnumber']; ?>:</strong></div>
  <div class="col-md-10"><input name="users_idnumber" type="text" class="textbox" id="users_idnumber" value="<? echo $users_row['users_idnumber']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_birthday']; ?>:</strong></div>
<div class="col-md-10"><input type="text" id="datepicker" name="users_birthday" value="<? echo $users_row['users_birthday']; ?>" class="nxt_tab"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['religion_name']; ?>:</strong></div>
<div class="col-md-10"><select name="religion_code" class="textbox selectbox" id="religion_code">
                      <option value=""<? if($users_row['religion_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("religion","*","","religion_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['religion_code']; ?>"<? if($users_row['religion_code']==$select_list[$i_list]['religion_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['religion_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['village_name']; ?>:</strong></div>
<div class="<? echo $col_md2; ?> typehead_village"><input name="village_code" type="text" class="textbox" id="village_code" value="<? echo $village_code; ?>"></div>
</div>

<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<section id="profile-tabs">
                               
                                    <div>
                                    <ul class="nav nav-tab">
                                    <li class="active"><a class="atab" href="#customer_sales" aria-controls="customer_sales" role="tab" data-toggle="tab"><? echo $global->users->users_lang['form_header_users_lang']['customer_sales']; ?></a></li>
                                    <li><a class="atab" href="#customer_contact" aria-controls="customer_contact" role="tab" data-toggle="tab"><? echo $global->users->users_lang['form_header_users_lang']['customer_contact']; ?></a></li>
                                    <li><a class="atab" href="#customer_notes" aria-controls="customer_notes" role="tab" data-toggle="tab"><? echo $global->users->users_lang['form_header_users_lang']['customer_notes']; ?></a></li>
                                    </ul>
                                    </div><!-- /.tab-pane -->
                            
                </section>

<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="customer_sales">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
  <div class="row clearfix">
  <div class="col-md-2"><strong>Batas Hari Kredit:</strong></div>
<div class="col-md-10">
  <input name="users_credit_max_days" type="text" class="textbox" id="users_credit_max_days" size="3" value="<? echo $users_row['users_credit_max_days']; ?>" />
</div>
</div>
    <div class="row clearfix">
  <div class="col-md-2"><strong>Batas Jumlah Kredit:</strong></div>
<div class="col-md-10">
  <input name="users_credit_max_amount" type="text" class="textbox" id="users_credit_max_amount" value="<? echo $users_row['users_credit_max_amount']; ?>" />
</div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong>Group Customer:</strong></div>
<div class="col-md-10">
  <select name="users_group_code" class="textbox" id="users_group_code">
    <?php
$users_group_list=$global->tbl_list("users_group","*","","",1);
for($i_list1=0;$i_list1<count($users_group_list);$i_list1++){
?>
<option value="<? echo $users_group_list[$i_list1]['users_group_code']; ?>"<? if($users_row['users_group_code']==$users_group_list[$i_list1]['users_group_code']){?> selected="selected"<? }?>><? echo $users_group_list[$i_list1]['users_group_name']; ?></option>
<?php
}
?>
  </select>
</div>
</div>
  </div>
</div>
                                    
</div>
</div>

<div role="tabpanel" class="tab-pane" id="customer_contact">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
  <div><strong>Kontak Person 1:</strong></div>
  <div>&nbsp;</div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Nama:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_name" type="text" class="textbox" id="users_contact_name" value="<? echo $users_row['users_contact_name']; ?>" />
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Tlp/HP:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_phone" type="text" class="textbox" id="users_contact_phone" value="<? echo $users_row['users_contact_phone']; ?>" />
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Jabatan:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_position" type="text" class="textbox" id="users_contact_position" value="<? echo $users_row['users_contact_position']; ?>" />
      </div>
    </div>
      <div><strong>Kontak Person 2:</strong></div>
  <div>&nbsp;</div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Nama:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_name2" type="text" class="textbox" id="users_contact_name2" value="<? echo $users_row['users_contact_name2']; ?>" />
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Tlp/HP:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_phone2" type="text" class="textbox" id="users_contact_phone2" value="<? echo $users_row['users_contact_phone2']; ?>" />
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Jabatan:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_position2" type="text" class="textbox" id="users_contact_position2" value="<? echo $users_row['users_contact_position2']; ?>" />
      </div>
    </div>

  <div><strong>Kontak Person 3:</strong></div>
  <div>&nbsp;</div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Nama:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_name3" type="text" class="textbox" id="users_contact_name3" value="<? echo $users_row['users_contact_name3']; ?>" />
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Tlp/HP:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_phone3" type="text" class="textbox" id="users_contact_phone3" value="<? echo $users_row['users_contact_phone3']; ?>" />
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-2"><strong>Jabatan:</strong></div>
      <div class="col-md-10">
        <input name="users_contact_position3" type="text" class="textbox" id="users_contact_position3" value="<? echo $users_row['users_contact_position3']; ?>" />
      </div>
    </div>

  </div>
</div>
                                    
</div>
</div>
<div role="tabpanel" class="tab-pane" id="customer_notes">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
    <div class="row clearfix">
      <div class="col-md-2"><strong>Catatan/Info Lain:</strong></div>
<div class="col-md-10">
  <textarea name="users_note" cols="50" rows="5" class="textbox" id="users_note"><? echo $users_row['users_note']; ?></textarea>
</div>
</div>
  </div>
</div>
                                    
</div>
</div>
</div>
<? if(!isset($modal)){?>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='customer-edit.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->
<? }?>

<div class="modal fade" id="village_new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="#" method="post" enctype="multipart/form-data" name="village_new_modal_form" id="village_new_modal_form">
  
<div class="box-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
   </div><!-- /.box-header -->
<? $modal=true; $popup=true; include ("views/village-new.php"); ?>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="village_new_modal_btn_new" class="btn btn-primary village_new_modal_btn_new" id="village_new_modal_btn_new"><? echo $form_header_lang['add_new_button']; ?></button><img class="ajax_loader" src="<? echo $path; ?>templates/default/img/loading2.gif" width="41" height="31" /></div>
</div>  
</form> 
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>
