            <? $col_md1="col-md-4"; $col_md2="col-md-8";if(!isset($modal)){ $col_md1="col-md-2"; $col_md2="col-md-10";?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['village_new']; ?></h1>
                    <? if(!isset($popup)){?>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="village.php"><? echo $global->users->users_lang['form_header_users_lang']['village']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['village_new']; ?></li>
                    </ol>
                    <? }?>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="<? echo $link_new; ?>" method="post" enctype="multipart/form-data" name="form" id="form">
<? }?>
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['village_new']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['village_code']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><input name="village_code" type="text" class="textbox firstin" id="village_code" required="required" value="<? echo $village_code_generation;?>"></div>
</div>
<div class="row clearfix">                                
  <div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['village_name']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><input name="village_name" type="text" class="textbox" id="village_name" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="<? echo $col_md1; ?>"><strong><? echo $global->users->users_lang['form_label_users_lang']['district_code']; ?>:</strong></div>
<div class="<? echo $col_md2; ?>"><select name="district_code" class="textbox selectbox" id="district_code" required="required">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("district","*","","district_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['district_code']; ?>"><? echo $select_list[$i_list]['district_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>
<div class="clear">&nbsp;</div>
<? if(!isset($modal)){?>
<div class="row clearfix">
<div class="<? echo $col_md1; ?>">&nbsp;</div>
<div class="<? echo $col_md2; ?>"><button name="Submit" class="btn btn-primary" id="Submitnew"><? echo $form_header_lang['add_new_button']; ?></button></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->
<? }?>

