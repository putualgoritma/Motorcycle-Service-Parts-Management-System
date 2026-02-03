            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $form_header_lang['company_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
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
            <form action="company-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $form_header_lang['company_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_label_lang['main_dealer_code']; ?>:</strong></div>
<div class="col-md-10"><input name="company_id" type="hidden" id="company_id" value="<? echo $company_row['company_id']; ?>"/><input name="main_dealer_code" type="text" class="textbox firstin" id="main_dealer_code" value="<? echo $company_row['main_dealer_code']; ?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_label_lang['ex_main_dealer_code']; ?>:</strong></div>
<div class="col-md-10"><input name="ex_main_dealer_code" type="text" class="textbox" id="ex_main_dealer_code" value="<? echo $company_row['ex_main_dealer_code']; ?>"></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_label_lang['dealer_code']; ?>:</strong></div>
<div class="col-md-10"><input name="dealer_code" type="text" class="textbox" id="dealer_code" value="<? echo $company_row['dealer_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_name']; ?>:</strong></div>
<div class="col-md-10"><input name="company_name" type="text" class="textbox" id="company_name" value="<? echo $company_row['company_name']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_pit']; ?>:</strong></div>
<div class="col-md-10"><input name="company_pit" type="text" class="textbox" id="company_pit" value="<? echo $company_row['company_pit']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_phone']; ?>:</strong></div>
<div class="col-md-10"><input name="company_phone" type="text" class="textbox" id="company_phone" value="<? echo $company_row['company_phone']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_city']; ?>:</strong></div>
<div class="col-md-10"><input name="company_city" type="text" class="textbox" id="company_city" value="<? echo $company_row['company_city']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_font']; ?>:</strong></div>
<div class="col-md-10"><input name="company_font" type="text" class="textbox" id="company_font" value="<? echo $company_row['company_font']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_font_size']; ?>:</strong></div>
<div class="col-md-10"><input name="company_font_size" type="text" class="textbox" id="company_font_size" value="<? echo $company_row['company_font_size']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_paper']; ?>:</strong></div>
<div class="col-md-10"><input name="company_paper" type="text" class="textbox" id="company_paper" value="<? echo $company_row['company_paper']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_stock_process']; ?>:</strong></div>
<div class="col-md-10"><input name="company_stock_process" type="checkbox" id="company_stock_process"<? if($company_row['company_stock_process']==1){?> checked="checked"<? }?> />
</div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_stock_block']; ?>:</strong></div>
<div class="col-md-10"><input name="company_stock_block" type="checkbox" id="company_stock_block"<? if($company_row['company_stock_block']==1){?> checked="checked"<? }?> />
</div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_address']; ?>:</strong></div>
<div class="col-md-10">
  <textarea name="company_address" cols="40" rows="5" class="textbox lastinedit" id="company_address"><? echo $company_row['company_address']; ?></textarea>
</div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_bank']; ?>:</strong></div>
<div class="col-md-10"><input name="company_bank" type="text" class="textbox" id="company_bank" value="<? echo $company_row['company_bank']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_bank_no']; ?>:</strong></div>
<div class="col-md-10"><input name="company_bank_no" type="text" class="textbox" id="company_bank_no" value="<? echo $company_row['company_bank_no']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $form_label_lang['company_bank_id']; ?>:</strong></div>
<div class="col-md-10"><input name="company_bank_id" type="text" class="textbox" id="company_bank_id" value="<? echo $company_row['company_bank_id']; ?>"></div>
</div>

<!-- <div class="row clearfix">                                
  <div class="col-md-2"><strong><? //echo $form_label_lang['company_bank2']; ?>:</strong></div>
<div class="col-md-10"><input name="company_bank2" type="text" class="textbox" id="company_bank2" value="<? //echo $company_row['company_bank2']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? //echo $form_label_lang['company_bank2_no']; ?>:</strong></div>
<div class="col-md-10"><input name="company_bank2_no" type="text" class="textbox" id="company_bank2_no" value="<? //echo $company_row['company_bank2_no']; ?>"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? //echo $form_label_lang['company_bank2_id']; ?>:</strong></div>
<div class="col-md-10"><input name="company_bank2_id" type="text" class="textbox" id="company_bank2_id" value="<? //echo $company_row['company_bank2_id']; ?>"></div>
</div> -->

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

