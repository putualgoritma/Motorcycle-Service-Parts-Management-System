            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->salary->salary_lang['form_header_salary_lang']['slip_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="slip.php"><? echo $global->salary->salary_lang['form_header_salary_lang']['slip']; ?></a></li>
                        <li class="active"><? echo $global->salary->salary_lang['form_header_salary_lang']['slip_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="slip-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->salary->salary_lang['form_header_salary_lang']['slip_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_month']; ?>:</strong></div>
<div class="col-md-10"><input name="salary_slip_id" type="hidden" id="salary_slip_id" value="<? echo $salary_slip_row['salary_slip_id']; ?>"/><input name="salary_slip_month" type="text" class="textbox" id="salary_slip_month" value="<? echo $_REQUEST['salary_slip_month']; ?>" readonly="readonly"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_name']; ?>:</strong></div>
<div class="col-md-10"><input name="staff_code" type="text" class="textbox" id="staff_code" value="<? echo $_REQUEST['staff_code']; ?>" readonly="readonly">&nbsp;<? echo $staff_name; ?></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_code']; ?>:</strong></div>
<div class="col-md-10"><input name="salary_slip_id" type="hidden" id="salary_slip_id" value="<? echo $salary_slip_row['salary_slip_id']; ?>"/><input name="salary_slip_code" type="text" class="textbox" id="salary_slip_code" value="<? echo $salary_slip_code_generation; ?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_date']; ?>:</strong></div>
<div class="col-md-10"><input name="salary_slip_date" type="text" class="textbox datepicker" id="salary_slip_date" value="<? echo $salary_slip_date; ?>"></div>
</div>

<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_header_salary_lang']['work_effective']; ?>:</strong></div>
<div class="col-md-10"><input name="work_effective" type="text" class="textbox" id="work_effective" value="<? echo $get_efective_work; ?>" readonly="readonly"></div>
</div>

<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_header_salary_lang']['work_staff']; ?>:</strong></div>
<div class="col-md-10"><input name="work_staff" type="text" class="textbox" id="work_staff" value="<? echo $num_work; ?>" readonly="readonly"></div>
</div>

<hr>
<div class="row clearfix">
<div class="col-md-6">
<div class="row clearfix">                                
  <div class="col-md-4">&nbsp;</div>
  <div class="col-md-8"><strong>Pendapatan</strong></div>
</div>
    <div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_basic']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_basic" type="text" class="textbox firstin slip_edit masknumber" id="salary_slip_basic" value="<? echo $salary_slip_basic; ?>">
    <input type="hidden" name="salary_slip_basic_hidden" id="salary_slip_basic_hidden" value="<? echo $salary_slip_basic_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_position']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_position" type="text" class="textbox slip_edit masknumber" id="salary_slip_position" value="<? echo $salary_slip_position; ?>">
    <input type="hidden" name="salary_slip_position_hidden" id="salary_slip_position_hidden" value="<? echo $salary_slip_position_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_transport']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_transport" type="text" class="textbox slip_edit masknumber" id="salary_slip_transport" value="<? echo $salary_slip_transport; ?>">
    <input type="hidden" name="salary_slip_transport_hidden" id="salary_slip_transport_hidden" value="<? echo $salary_slip_transport_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_food']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_food" type="text" class="textbox slip_edit masknumber" id="salary_slip_food" value="<? echo $salary_slip_food; ?>">
    <input type="hidden" name="salary_slip_food_hidden" id="salary_slip_food_hidden" value="<? echo $salary_slip_food_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->users->users_lang['form_label_users_lang']['staff_salary_insurance']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_insurance" type="text" class="textbox slip_edit masknumber" id="salary_slip_insurance" value="<? echo $salary_slip_insurance; ?>">
    <input type="hidden" name="salary_slip_insurance_hidden" id="salary_slip_insurance_hidden" value="<? echo $salary_slip_insurance_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_insentif_daily']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_insentif_daily" type="text" class="textbox slip_edit masknumber" id="salary_slip_insentif_daily" value="<? echo $salary_slip_insentif_daily; ?>">
    <input type="hidden" name="salary_slip_insentif_daily_hidden" id="salary_slip_insentif_daily_hidden" value="<? echo $salary_slip_insentif_daily_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_commission_part_service']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_commission_part_service" type="text" class="textbox slip_edit masknumber" id="salary_slip_commission_part_service" value="<? echo $salary_slip_commission_part_service; ?>">
    <input type="hidden" name="salary_slip_commission_part_service_hidden" id="salary_slip_commission_part_service_hidden" value="<? echo $salary_slip_commission_part_service_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_insentif_unit_entry']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_insentif_unit_entry" type="text" class="textbox slip_edit masknumber" id="salary_slip_insentif_unit_entry" value="<? echo $salary_slip_insentif_unit_entry; ?>">
    <input type="hidden" name="salary_slip_insentif_unit_entry_hidden" id="salary_slip_insentif_unit_entry_hidden" value="<? echo $salary_slip_insentif_unit_entry_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_insentif_product']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_insentif_product" type="text" class="textbox slip_edit masknumber" id="salary_slip_insentif_product" value="<? echo $salary_slip_insentif_product; ?>">
    <input type="hidden" name="salary_slip_insentif_product_hidden" id="salary_slip_insentif_product_hidden" value="<? echo $salary_slip_insentif_product_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_insentif_service']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_insentif_service" type="text" class="textbox slip_edit masknumber" id="salary_slip_insentif_service" value="<? echo $salary_slip_insentif_service; ?>">
    <input type="hidden" name="salary_slip_insentif_service_hidden" id="salary_slip_insentif_service_hidden" value="<? echo $salary_slip_insentif_service_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_insentif_bonus']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_insentif_bonus" type="text" class="textbox slip_edit masknumber" id="salary_slip_insentif_bonus" value="<? echo $salary_slip_insentif_bonus; ?>">
    <input type="hidden" name="salary_slip_insentif_bonus_hidden" id="salary_slip_insentif_bonus_hidden" value="<? echo $salary_slip_insentif_bonus_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_insentif_no_alfa']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_insentif_no_alfa" type="text" class="textbox slip_edit masknumber" id="salary_slip_insentif_no_alfa" value="<? echo $salary_slip_insentif_no_alfa; ?>">
    <input type="hidden" name="salary_slip_insentif_no_alfa_hidden" id="salary_slip_insentif_no_alfa_hidden" value="<? echo $salary_slip_insentif_no_alfa_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_fee_picket']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_fee_picket" type="text" class="textbox slip_edit masknumber" id="salary_slip_fee_picket" value="<? echo $salary_slip_fee_picket; ?>">
    <input type="hidden" name="salary_slip_fee_picket_hidden" id="salary_slip_fee_picket_hidden" value="<? echo $salary_slip_fee_picket_hidden; ?>" />
  </div>
</div>
</div>
<div class="col-md-6">
<div class="row clearfix">                                
  <div class="col-md-4">&nbsp;</div>
  <div class="col-md-8"><strong>Potongan</strong></div>
</div>
  <div class="row clearfix">                                
    <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_cut_late']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_cut_late" type="text" class="textbox slip_edit masknumber" id="salary_slip_cut_late" value="<? echo $salary_slip_cut_late; ?>">
    <input type="hidden" name="salary_slip_cut_late_hidden" id="salary_slip_cut_late_hidden" value="<? echo $salary_slip_cut_late_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_cut_alfa']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_cut_alfa" type="text" class="textbox slip_edit masknumber" id="salary_slip_cut_alfa" value="<? echo $salary_slip_cut_alfa; ?>">
    <input type="hidden" name="salary_slip_cut_alfa_hidden" id="salary_slip_cut_alfa_hidden" value="<? echo $salary_slip_cut_alfa_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_cut_cashbon']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_cut_cashbon" type="text" class="textbox slip_edit masknumber" id="salary_slip_cut_cashbon" value="<? echo $salary_slip_cut_cashbon; ?>">
    <input type="hidden" name="salary_slip_cut_cashbon_hidden" id="salary_slip_cut_cashbon_hidden" value="<? echo $salary_slip_cut_cashbon_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_cut_payable']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_cut_payable" type="text" class="textbox slip_edit masknumber" id="salary_slip_cut_payable" value="<? echo $salary_slip_cut_payable; ?>">
    <input type="hidden" name="salary_slip_cut_payable_hidden" id="salary_slip_cut_payable_hidden" value="<? echo $salary_slip_cut_payable_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_cut_insurance']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_cut_insurance" type="text" class="textbox slip_edit masknumber" id="salary_slip_cut_insurance" value="<? echo $salary_slip_cut_insurance; ?>">
    <input type="hidden" name="salary_slip_cut_insurance_hidden" id="salary_slip_cut_insurance_hidden" value="<? echo $salary_slip_cut_insurance_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_cut_other1']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_cut_other1" type="text" class="textbox slip_edit masknumber" id="salary_slip_cut_other1" value="<? echo $salary_slip_cut_other1; ?>">
    <input type="hidden" name="salary_slip_cut_other1_hidden" id="salary_slip_cut_other1_hidden" value="<? echo $salary_slip_cut_other1_hidden; ?>" />
  </div>
</div>
<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->salary->salary_lang['form_label_salary_lang']['salary_slip_cut_other2']; ?>:</strong></div>
  <div class="col-md-8"><input name="salary_slip_cut_other2" type="text" class="textbox slip_edit masknumber" id="salary_slip_cut_other2" value="<? echo $salary_slip_cut_other2; ?>">
    <input type="hidden" name="salary_slip_cut_other2_hidden" id="salary_slip_cut_other2_hidden" value="<? echo $salary_slip_cut_other2_hidden; ?>" />
  </div>
</div>
</div>
</div>
<hr>
<div class="row clearfix">
<div class="col-md-2"><strong>Total Pendapatan:</strong></div>
<div class="col-md-10"><input name="income_total" type="text" class="textbox" id="income_total" value="0" readonly="readonly"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong>Total Potongan:</strong></div>
<div class="col-md-10"><input name="cut_total" type="text" class="textbox" id="cut_total" value="0" readonly="readonly"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong>Gaji Bersih:</strong></div>
<div class="col-md-10"><input name="salary_total" type="text" class="textbox" id="salary_total" value="0" readonly="readonly"></div>
</div>

<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><a class="btn btn-danger" id="Submitreset" onclick="salary_reset();">Reset</a>&nbsp;<button name="Submit" class="btn btn-primary" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button>&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='slip-edit.php?Submitcancell=true'" id="Submitcancell"><? echo $form_header_lang['cancell_button']; ?></a></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

