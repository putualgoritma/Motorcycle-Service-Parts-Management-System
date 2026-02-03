            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['category_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="category-service.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['category']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['category_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="category-service-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['category_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['category_code']; ?>:</strong></div>
<div class="col-md-10"><input name="category_id" type="hidden" id="category_id" value="<? echo $category_row['category_id']; ?>"/><input name="category_code" type="text" class="textbox firstin" id="category_code" value="<? echo $category_row['category_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['category_name']; ?>:</strong></div>
<div class="col-md-10"><input name="category_name" type="text" class="textbox" id="category_name" value="<? echo $category_row['category_name']; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['category_rank']; ?>:</strong></div>
<div class="col-md-10">
  <select name="category_rank" id="category_rank" class="lastinedit">
    <? $category_list=$global->tbl_list("category","*","category_type='1'","",1);
	for($i=1;$i<=count($category_list);$i++){?>
    <option<? if($i==$category_row['category_rank']){?> selected="selected"<? }?> value="<? echo $i; ?>"><? echo $i; ?></option>
    <? }?>
  </select>
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

