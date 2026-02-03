            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_model_edit']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="motorcycle-model.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_model']; ?></a></li>
                        <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_model_edit']; ?></li>
                    </ol>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="motorcycle-model-edit.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_model_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_model_code']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_model_id" type="hidden" id="motorcycle_model_id" value="<? echo $motorcycle_model_row['motorcycle_model_id']; ?>"/><input name="motorcycle_model_code" type="text" class="textbox firstin" id="motorcycle_model_code" value="<? echo $motorcycle_model_row['motorcycle_model_code']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_model_name']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_model_name" type="text" class="textbox" id="motorcycle_model_name" value="<? echo $motorcycle_model_row['motorcycle_model_name']; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_model_oil']; ?>:</strong></div>
<div class="col-md-10 typehead_product"><input name="product_code" type="text" class="textbox" id="product_code" value="<? echo $product_code; ?>"></div>
</div>
<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_model_oil_service_sprice']; ?>:</strong></div>
<div class="col-md-10"><input name="motorcycle_model_oil_service_sprice" type="text lastinedit" class="textbox" id="motorcycle_model_oil_service_sprice" value="<? echo $motorcycle_model_row['motorcycle_model_oil_service_sprice']; ?>"></div>
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

