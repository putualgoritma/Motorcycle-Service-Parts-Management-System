            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->users->users_lang['form_header_users_lang']['users_level_new']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Pengaturan & Peralatan</a></li>
                        <li><a href="users-level.php"><? echo $global->users->users_lang['form_header_users_lang']['users_level']; ?></a></li>
                        <li class="active"><? echo $global->users->users_lang['form_header_users_lang']['users_level_new']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="users-level-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->users->users_lang['form_header_users_lang']['users_level_new']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_level_code']; ?>:</strong></div>
<div class="col-md-10"><input name="users_level_code" type="text" class="textbox firstin" id="users_level_code" required="required"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->users->users_lang['form_label_users_lang']['users_level_name']; ?>:</strong></div>
<div class="col-md-10"><input name="users_level_name" type="text" class="textbox" id="users_level_name" required="required"></div>
</div>

<table class="table table-bordered service_order_sale">
  <thead>
  <tr>
    <th height="25" align="center">No.</th>
    <th>Module</th>
    <th>View</th>
    <th>Add</th>
    <th>Edit</th>
    <th>Delete</th>
    <th>CSV</th>
    </tr>
  </thead>
  	<?
	$qry_module_filter="";
	$qry_module_sub_filter="";
	if($_SESSION['users_level_code_sessi']!="MASTER ADMIN"){
		$qry_module_filter="module_lock='0'";
		$qry_module_sub_filter="module_sub_lock='0' AND";
		}
	$module_list=$global->tbl_list("module","*",$qry_module_filter,"module_rank ASC,module_id ASC",1);
	for($i=0;$i<count($module_list);$i++){
		$j=$i+1;
	?>
  <tr>
    <td height="25"><? echo $j; ?>.</td>
    <td><? echo $module_list[$i]['module_name']; ?></td>
    <td><input name="module_code[<? echo $i; ?>]" type="hidden" id="module_code[<? echo $i; ?>]" value="<? echo $module_list[$i]['module_code']; ?>" /><input name="checkbox_view[<? echo $i; ?>]" type="checkbox" id="checkbox_view[<? echo $i; ?>]" checked="checked" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?
	$module_sub_list=$global->tbl_list("module_sub","*",$qry_module_sub_filter." module_code='".$module_list[$i]['module_code']."'","module_sub_rank ASC,module_sub_id ASC",1);
	for($k=0;$k<count($module_sub_list);$k++){
		$l=$k+1;
	?>
  <tr>
    <td height="25"><? echo $j; ?>.<? echo $l; ?></td>
    <td><? echo $module_sub_list[$k]['module_sub_name']; ?></td>
    <td><input name="module_sub_code[<? echo $i; ?>][<? echo $k; ?>]" type="hidden" id="module_sub_code[<? echo $i; ?>][<? echo $k; ?>]" value="<? echo $module_sub_list[$k]['module_sub_code']; ?>" /><input name="checkbox_view_sub[<? echo $i; ?>][<? echo $k; ?>]" type="checkbox" id="checkbox_view_sub[<? echo $i; ?>][<? echo $k; ?>]" checked="checked" /></td>
    <td><input name="checkbox_add[<? echo $i; ?>][<? echo $k; ?>]" type="checkbox" id="checkbox_add[<? echo $i; ?>][<? echo $k; ?>]" checked="checked" /></td>
    <td><input name="checkbox_edit[<? echo $i; ?>][<? echo $k; ?>]" type="checkbox" id="checkbox_edit[<? echo $i; ?>][<? echo $k; ?>]" checked="checked" /></td>
    <td><input name="checkbox_delete[<? echo $i; ?>][<? echo $k; ?>]" type="checkbox" id="checkbox_delete[<? echo $i; ?>][<? echo $k; ?>]" checked="checked" /></td>
    <td><input name="checkbox_csv[<? echo $i; ?>][<? echo $k; ?>]" type="checkbox" id="checkbox_csv[<? echo $i; ?>][<? echo $k; ?>]" checked="checked" /></td>
  </tr>
  	<?
	}}
	?>
  <tbody class="dyn_service_order_sale">
  </tbody>
              </table>
<span class="td_hide"><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['product_shtquantity']; ?></span>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submitnew"><? echo $form_header_lang['add_new_button']; ?></button></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

