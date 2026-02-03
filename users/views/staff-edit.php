            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['staff_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="staff.php"><? echo $global->users->users_lang['form_header_users_lang']['staff']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['staff_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="staff-edit.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="staff_id" type="hidden" id="staff_id" value="<? echo $staff_row['staff_id']; ?>"/>
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['staff_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_code']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_code" type="text" class="textbox" id="staff_code" value="<? echo $staff_row['staff_code']; ?>" required="required" readonly="readonly"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_name']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_name" type="text" class="textbox firstin" id="staff_name" value="<? echo $staff_row['staff_name']; ?>" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_gender']; ?>:</strong></div>
  <div class="col-md-10"><select name="staff_gender" class="textbox" id="staff_gender">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['gender']);$list_inc++){?>
    <option<? if($form_selectlist_lang['gender'][$list_inc][0]==$staff_row['staff_gender']){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['gender'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['gender'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_place_born']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_place_born" type="text" class="textbox" id="staff_place_born" value="<? echo $staff_row['staff_place_born']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_date_born']; ?>:</strong></div>
<div class="col-md-10"><input type="text" id="staff_date_born" name="staff_date_born" class="nxt_tab datepicker" value="<? echo $staff_row['staff_date_born']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['religion_name']; ?>:</strong></div>
<div class="col-md-10"><select name="religion_code" class="textbox selectbox" id="religion_code">
                      <option value=""<? if($staff_row['religion_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("religion","*","","religion_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['religion_code']; ?>"<? if($staff_row['religion_code']==$select_list[$i_list]['religion_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['religion_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['education_name']; ?>:</strong></div>
<div class="col-md-10"><select name="education_code" class="textbox selectbox" id="education_code">
                      <option value=""<? if($staff_row['education_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("education","*","","education_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['education_code']; ?>"<? if($staff_row['education_code']==$select_list[$i_list]['education_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['education_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>

<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_address']; ?>:</strong></div>
  <div class="col-md-10"><textarea name="staff_address" cols="40" rows="4" class="textbox" id="staff_address"><? echo $staff_row['staff_address']; ?></textarea></div>
</div>

<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_phone']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_phone" type="text" class="textbox" id="staff_phone" value="<? echo $staff_row['staff_phone']; ?>"></div>
</div>

<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_email']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_email" type="text" class="textbox" id="staff_email" value="<? echo $staff_row['staff_email']; ?>"></div>
</div>

<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_id_nom']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_id_nom" type="text" class="textbox" id="staff_id_nom" value="<? echo $staff_row['staff_id_nom']; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_description']; ?>:</strong></div>
  <div class="col-md-10"><textarea name="staff_description" cols="40" rows="4" class="textbox" id="staff_description"><? echo $staff_row['staff_description']; ?></textarea></div>
</div>
<div class="clear">&nbsp;</div>
<section id="profile-tabs">
                               
                                    <div>
                                    <ul class="nav nav-tab">
                                    <li class="active"><a class="atab" href="#staff_position" aria-controls="staff_position" role="tab" data-toggle="tab">Posisi</a></li>
                                    <li><a class="atab" href="#staff_salary" aria-controls="staff_salary" role="tab" data-toggle="tab">Gaji</a></li>
                                    </ul>
                                    </div><!-- /.tab-pane -->
                            
                </section>

<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="staff_position">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
  <div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_date_start_work']; ?>:</strong></div>
<div class="col-md-10"><input type="text" id="staff_date_start_work" name="staff_date_start_work" class="nxt_tab datepicker" value="<? echo $staff_row['staff_date_start_work']; ?>"></div>
</div>
    <div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_date_end_work']; ?>:</strong></div>
<div class="col-md-10"><input type="text" id="staff_date_end_work" name="staff_date_end_work" class="nxt_tab datepicker" value="<? echo $staff_row['staff_date_end_work']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_status']; ?>:</strong></div>
  <div class="col-md-10"><select name="staff_status" class="textbox" id="staff_status">
    <? for($list_inc=0;$list_inc<count($form_selectlist_lang['staff_status']);$list_inc++){?>
    <option<? if($form_selectlist_lang['staff_status'][$list_inc][0]==$staff_row['staff_status']){?> selected="selected"<? }?> value="<? echo $form_selectlist_lang['staff_status'][$list_inc][0]; ?>"><? echo $form_selectlist_lang['staff_status'][$list_inc][1]; ?></option>
    <? }?>
    </select></div>
</div>
  <div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_date_start_contract']; ?>:</strong></div>
<div class="col-md-10"><input type="text" id="staff_date_start_contract" name="staff_date_start_contract" class="nxt_tab datepicker" value="<? echo $staff_row['staff_date_start_contract']; ?>"></div>
</div>
    <div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_date_end_contract']; ?>:</strong></div>
<div class="col-md-10"><input type="text" id="staff_date_end_contract" name="staff_date_end_contract" class="nxt_tab datepicker" value="<? echo $staff_row['staff_date_end_contract']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_contract_num']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_contract_num" type="text" class="textbox" id="staff_contract_num" value="<? echo $staff_row['staff_contract_num']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['position_name']; ?>:</strong></div>
<div class="col-md-10"><select name="position_code" class="textbox selectbox" id="position_code">
                      <option value=""<? if($staff_row['position_code']==""){?> selected="selected"<? }?>>None</option>
					  <?
						$select_list=$global->tbl_list("position","*","","position_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['position_code']; ?>"<? if($staff_row['position_code']==$select_list[$i_list]['position_code']){?> selected="selected"<? }?>><? echo $select_list[$i_list]['position_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_pit_status']; ?>:</strong></div>
<div class="col-md-10">
    <label>
      <input name="staff_pit_status" type="radio" id="staff_pit_status_0" value="pit"<? if($staff_row['staff_pit_status']=="pit"){?> checked="checked"<? }?> />
      Pit</label>
    <label>
      <input type="radio" name="staff_pit_status" value="nonpit" id="staff_pit_status_1"<? if($staff_row['staff_pit_status']=="nonpit"){?> checked="checked"<? }?> />
      Non Pit</label>
</div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_pmt1']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_pmt1" type="text" class="textbox" id="staff_pmt1" value="<? echo $staff_row['staff_pmt1']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_pmt2']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_pmt2" type="text" class="textbox" id="staff_pmt2" value="<? echo $staff_row['staff_pmt2']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_pmt3']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_pmt3" type="text" class="textbox" id="staff_pmt3" value="<? echo $staff_row['staff_pmt3']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_sa']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_sa" type="text" class="textbox" id="staff_sa" value="<? echo $staff_row['staff_sa']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_paa']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_paa" type="text" class="textbox" id="staff_paa" value="<? echo $staff_row['staff_paa']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_csm']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_csm" type="text" class="textbox" id="staff_csm" value="<? echo $staff_row['staff_csm']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_css']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_css" type="text" class="textbox" id="staff_css" value="<? echo $staff_row['staff_css']; ?>"></div>
</div>

  </div>
</div>
                                    
</div>
</div>

<div role="tabpanel" class="tab-pane" id="staff_fee">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
  <div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_fee_status']; ?>:</strong></div>
  <div class="col-md-10">
    <input name="staff_fee_status" type="checkbox" id="staff_fee_status"<? if($staff_row['staff_fee_status']=="1"){?> checked="checked"<? }?> />
  </div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_fee_system']; ?>:</strong></div>
<div class="col-md-10">
    <label>
      <input name="staff_fee_system" type="radio" id="staff_fee_system_0" value="item"<? if($staff_row['staff_fee_system']=="item"){?> checked="checked"<? }?> />
      Per Item</label>
    <label>
      <input type="radio" name="staff_fee_system" value="invoice" id="staff_fee_system_1"<? if($staff_row['staff_fee_system']=="invoice"){?> checked="checked"<? }?> />
      Per Faktur</label>
    <label>
      <input type="radio" name="staff_fee_system" value="custome" id="staff_fee_system_2"<? if($staff_row['staff_fee_system']=="custome"){?> checked="checked"<? }?> />
      Sesuai Setting </label>
</div>
</div>
  <div class="row clearfix">
<div class="col-md-2"><strong>Diberikan Dengan:</strong></div>
<div class="col-md-10">
    <label>
      <input name="staff_fee_system_type" type="radio" id="staff_fee_system_type_0" value="percent"<? if($staff_row['staff_fee_system_type']=="percent"){?> checked="checked"<? }?> />
      Prosentase</label>
    <label>
      <input type="radio" name="staff_fee_system_type" value="nominal" id="staff_fee_system_type_1"<? if($staff_row['staff_fee_system_type']=="nominal"){?> checked="checked"<? }?> />
      Nominal</label>
</div>
</div>
<div class="row clearfix" id="staff_fee_system_percent"<? if($staff_row['staff_fee_system_type']=="nominal"){?> style="display:none"<? }?>>
<div class="col-md-2"><strong>Prosentase:</strong></div>
<div class="col-md-10"><input name="staff_fee_system_percent_val" type="text" class="textbox" id="staff_fee_system_percent_val" size="3" placeholder="0" value="<? echo $staff_row['staff_fee_system_percent_val']; ?>">
  % dari 
    <select name="staff_fee_system_percent_type" class="textbox" id="staff_fee_system_percent_type">
      <option value="total">Jumlah</option>
    </select>
</div>
</div>
<div class="row clearfix" id="staff_fee_system_nominal"<? if($staff_row['staff_fee_system_type']=="percent"){?> style="display:none"<? }?>>
<div class="col-md-2"><strong>Nominal:</strong></div>
<div class="col-md-10"><input name="staff_fee_system_nominal_val" type="text" class="textbox" id="staff_fee_system_nominal_val" placeholder="0" value="<? echo $staff_row['staff_fee_system_nominal_val']; ?>">
</div>
</div>
  </div>
</div>
                                    
</div>
</div>
<div role="tabpanel" class="tab-pane" id="staff_salary">
<div class="box-body table-responsive">
                                
    
<div class="row clearfix">
  <div class="col-md-12">
    <div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_basic']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_salary_basic" type="text" class="textbox" id="staff_salary_basic" value="<? echo $staff_row['staff_salary_basic']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_position']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_salary_position" type="text" class="textbox" id="staff_salary_position" value="<? echo $staff_row['staff_salary_position']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_transport']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_salary_transport" type="text" class="textbox" id="staff_salary_transport" value="<? echo $staff_row['staff_salary_transport']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_food']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_salary_food" type="text" class="textbox" id="staff_salary_food" value="<? echo $staff_row['staff_salary_food']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_insurance']; ?>:</strong></div>
  <div class="col-md-10"><input name="staff_salary_insurance" type="text" class="textbox" id="staff_salary_insurance" value="<? echo $staff_row['staff_salary_insurance']; ?>"></div>
</div>
  </div>
</div>
                                    
</div>
</div>
</div>

<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;&nbsp;<button name="Submitcancell" class="btn btn-warning" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?>  (F6)</button></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

