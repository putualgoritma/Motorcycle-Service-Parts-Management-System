            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['categorysub_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="categorysub-service.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['categorysub']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['categorysub_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="categorysub-service-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['categorysub_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['categorysub_code']; ?>:</strong></div>
<div class="col-md-10"><input name="categorysub_id" type="hidden" id="categorysub_id" value="<? echo $categorysub_row['categorysub_id']; ?>"/><input name="categorysub_code" type="text" class="textbox firstin" id="categorysub_code" value="<? echo $categorysub_row['categorysub_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['categorysub_name']; ?>:</strong></div>
<div class="col-md-10"><input name="categorysub_name" type="text" class="textbox lastinedit" id="categorysub_name" value="<? echo $categorysub_row['categorysub_name']; ?>"></div>
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

