            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
<section class="content-header">
  <h1><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_sale_del']; ?></h1>
  <ol class="breadcrumb">
    <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>"> Servis</a></li>
    <li><a href="service.php"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_sale']; ?></a></li>
    <li class="active"><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_sale_del']; ?></li>
  </ol>
</section>
<!-- Main content -->
              <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="service-cancel.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div>
    <p><strong><u><? echo $global->product_order->product_order_lang['form_header_product_order_lang']['service_order_sale_del']; ?>: </u></strong></p>
    <div>&nbsp;</div>                           
     </div><!-- /.box-header -->
 
  <div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['author_name']; ?>:</strong></div>
<div class="col-md-10 typehead_author">
  <input type="hidden" name="service_order_id" id="service_order_id" value="<? echo $service_order_id; ?>" />
  <input type="hidden" name="del_stat" id="del_stat" />
  <input name="author_code" type="text" class="textbox firstin" id="author_code" required="required"></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-2"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['service_order_cancel_note']; ?>:</strong></div>
<div class="col-md-10">
  <textarea name="service_order_cancel_note" cols="40" rows="5" class="textbox" id="service_order_cancel_note"></textarea>
</div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submitnew"><? echo $form_header_lang['cancell_button']; ?></button></div>
</div> 
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

