            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->salary->salary_lang['form_header_salary_lang']['settings']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Penggajian</a></li>
                        <li class="active"><? echo $global->salary->salary_lang['form_header_salary_lang']['settings']; ?></li>
                    </ol>
                </section>
                
                <? if(isset($_REQUEST['confirm'])){?><div>&nbsp;</div><div class="alert alert-info alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-warning"></i> <? echo $form_header_lang['notice']; ?></h4>
      <p><strong><? echo $form_header_lang['confirm_state1']; ?><? echo $_REQUEST['confirm']; ?><? echo $form_header_lang['confirm_state2']; ?></strong></p>
    </div><? }?>
                
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="settings.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->salary->salary_lang['form_header_salary_lang']['settings']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_work_in']; ?>:</strong></div>
<div class="col-md-10"><input name="company_id" type="hidden" id="company_id" value="<? echo $company_row['company_id']; ?>"/><input name="company_work_in" type="text" class="textbox time firstin" id="company_work_in" value="<? echo $company_row['company_work_in']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_work_out']; ?>:</strong></div>
<div class="col-md-10"><input name="company_work_out" type="text" class="textbox time" id="company_work_out" value="<? echo $company_row['company_work_out']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_break_in']; ?>:</strong></div>
<div class="col-md-10"><input name="company_break_in" type="text" class="textbox time" id="company_break_in" value="<? echo $company_row['company_break_in']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_break_out']; ?>:</strong></div>
<div class="col-md-10"><input name="company_break_out" type="text" class="textbox time" id="company_break_out" value="<? echo $company_row['company_break_out']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_alfa_pinalty']; ?>:</strong></div>
  <div class="col-md-10"><input name="company_alfa_pinalty" type="text" class="textbox" id="company_alfa_pinalty" value="<? echo $company_row['company_alfa_pinalty']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_insentif_no_alfa']; ?>:</strong></div>
  <div class="col-md-10"><input name="company_insentif_no_alfa" type="text" class="textbox" id="company_insentif_no_alfa" value="<? echo $company_row['company_insentif_no_alfa']; ?>"></div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button></div>
</div> 
</form>
</div>
</div>

<div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="settings.php" method="post" enctype="multipart/form-data" name="form2" id="form2">
<div>
    <p><strong><u><? echo $global->salary->salary_lang['form_header_salary_lang']['absence_penalty']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
<?
$absence_penalty_list=$global->tbl_list("absence_penalty","*","","absence_penalty_id ASC",1);
for($i=0;$i<count($absence_penalty_list);$i++){
$j="ke-".($i+1);
$absence_penalty_type_str=" Kerja";
if($absence_penalty_list[$i]['absence_penalty_type']=="break"){
$j="";
$absence_penalty_type_str=" Istirahat";
}
?>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->salary->salary_lang['form_header_salary_lang']['absence_penalty'].$absence_penalty_type_str; ?> <? echo $j; ?>:</strong></div>
  <div class="col-md-10"><input name="absence_penalty_id[]" type="hidden" id="absence_penalty_id[]" value="<? echo $absence_penalty_list[$i]['absence_penalty_id']; ?>"/><input name="absence_penalty_mlate[]" type="text" class="textbox" id="absence_penalty_mlate[]" value="<? echo $absence_penalty_list[$i]['absence_penalty_mlate']; ?>" size="5" placeholder="<= menit">&nbsp;menit&nbsp;&nbsp;&nbsp;<input name="absence_penalty_amount[]" type="text" class="textbox" id="absence_penalty_amount[]" value="<? echo $absence_penalty_list[$i]['absence_penalty_amount']; ?>" placeholder="Denda"></div>
</div>
<? }?>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit2" class="btn btn-primary" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button></div>
</div> 
</form>
</div>
</div>

<div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="settings.php" method="post" enctype="multipart/form-data" name="form4" id="form4">
<div>
    <p><strong><u><? echo $global->salary->salary_lang['form_header_salary_lang']['salary_daily_target']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
     
<div class="row clearfix">                                
  <div class="col-md-2"></div>
  <div class="col-md-3"><strong>Range Min.</strong></div>
  <div class="col-md-3"><strong>Range Max.</strong></div>
  <div class="col-md-4"><strong>Jumlah Insentif</strong></div>
</div>
<?
$salary_daily_target_list=$global->tbl_list("salary_daily_target","*","","salary_daily_target_id ASC",1);
for($i=0;$i<count($salary_daily_target_list);$i++){
$j=$i+1;
?>
<div class="row clearfix">                                
  <div class="col-md-2"><strong>Target ke-<? echo $j; ?>:</strong></div>
  <div class="col-md-3"><input name="salary_daily_target_id[]" type="hidden" id="salary_daily_target_id[]" value="<? echo $salary_daily_target_list[$i]['salary_daily_target_id']; ?>"/><input name="salary_daily_target_min[]" type="text" class="textbox" id="salary_daily_target_min[]" value="<? echo $salary_daily_target_list[$i]['salary_daily_target_min']; ?>" placeholder=">="></div>
  <div class="col-md-3"><input name="salary_daily_target_max[]" type="text" class="textbox" id="salary_daily_target_max[]" value="<? echo $salary_daily_target_list[$i]['salary_daily_target_max']; ?>" placeholder="< menit"></div>
  <div class="col-md-4"><input name="salary_daily_target_amount[]" type="text" class="textbox" id="salary_daily_target_amount[]" value="<? echo $salary_daily_target_list[$i]['salary_daily_target_amount']; ?>" placeholder="Insentif"></div>
</div>
<? }?>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit4" class="btn btn-primary" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button></div>
</div> 
</form>
</div>
</div>

<div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="settings.php" method="post" enctype="multipart/form-data" name="form3" id="form3">
<div>
    <p><strong><u><? echo $global->salary->salary_lang['form_header_salary_lang']['salary_target']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
     <div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_target_unit_entry']; ?>:</strong></div>
  <div class="col-md-10"><input name="company_id" type="hidden" id="company_id" value="<? echo $company_row['company_id']; ?>"/><input name="company_target_unit_entry" type="text" class="textbox" id="company_target_unit_entry" value="<? echo $company_row['company_target_unit_entry']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_target_service']; ?>:</strong></div>
  <div class="col-md-10"><input name="company_target_service" type="text" class="textbox" id="company_target_service" value="<? echo $company_row['company_target_service']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_target_product']; ?>:</strong></div>
  <div class="col-md-10"><input name="company_target_product" type="text" class="textbox" id="company_target_product" value="<? echo $company_row['company_target_product']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_insentif_bonus']; ?>:</strong></div>
  <div class="col-md-10"><input name="company_insentif_bonus" type="text" class="textbox" id="company_insentif_bonus" value="<? echo $company_row['company_insentif_bonus']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['product_fee_percent']; ?>:</strong></div>
  <div class="col-md-10"><input name="product_fee_percent" type="text" class="textbox" id="product_fee_percent" value="<? echo $company_row['product_fee_percent']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['service_fee_percent']; ?>:</strong></div>
  <div class="col-md-10"><input name="service_fee_percent" type="text" class="textbox" id="service_fee_percent" value="<? echo $company_row['service_fee_percent']; ?>"></div>
</div>
<div class="row clearfix">&nbsp;</div>
<div class="row clearfix">                                
  <div class="col-md-2"></div>
  <div class="col-md-3"><strong>75% - 84.9%</strong></div>
  <div class="col-md-3"><strong>85% - 99.9%</strong></div>
  <div class="col-md-4"><strong>100%</strong></div>
</div>
<?
$salary_target_list=$global->tbl_list("salary_target","*","","salary_target_id ASC",1);
for($i=0;$i<(count($salary_target_list)/3);$i++){
$j=$i*3;
?>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->get_selectlist($form_selectlist_lang['salary_target_type'],$salary_target_list[$j]['salary_target_type']); ?> :</strong></div>
  <div class="col-md-3"><input name="salary_target_id[]" type="hidden" id="salary_target_id[]" value="<? echo $salary_target_list[$j]['salary_target_id']; ?>"/><input name="salary_target_amount[]" type="text" class="textbox" id="salary_target_amount[]" value="<? echo $salary_target_list[$j]['salary_target_amount']; ?>" placeholder="Insentif"></div>
  <div class="col-md-3"><input name="salary_target_id[]" type="hidden" id="salary_target_id[]" value="<? echo $salary_target_list[$j+1]['salary_target_id']; ?>"/><input name="salary_target_amount[]" type="text" class="textbox" id="salary_target_amount[]" value="<? echo $salary_target_list[$j+1]['salary_target_amount']; ?>" placeholder="Insentif"></div>
<div class="col-md-4"><input name="salary_target_id[]" type="hidden" id="salary_target_id[]" value="<? echo $salary_target_list[$j+2]['salary_target_id']; ?>"/><input name="salary_target_amount[]" type="text" class="textbox" id="salary_target_amount[]" value="<? echo $salary_target_list[$j+2]['salary_target_amount']; ?>" placeholder="Insentif"></div>
</div>
<? }?>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-3"><button name="Submit3" class="btn btn-primary" id="Submitedit"><? echo $form_header_lang['edit_button']; ?></button></div>
<div class="col-md-3">&nbsp;</div>
<div class="col-md-4">&nbsp;</div>
</div> 
</form>
</div>
</div>



</div>
</div>
</section>
</aside><!-- /.right-side -->

