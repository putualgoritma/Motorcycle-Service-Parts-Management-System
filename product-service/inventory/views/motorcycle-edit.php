            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_edit']; ?></h1>
                    <?if (!isset($popup)) {?>
                    <ol class="breadcrumb">
                        <li><a href="<?echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?echo $path; ?>index-sub.php?module_code=<?echo $parent_active; ?>"> Master Data</a></li>
                        <li><a href="motorcycle.php"><?echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle']; ?></a></li>
                        <li class="active"><?echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_edit']; ?></li>
                    </ol>
                    <?}?>
                </section>
            <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                            <div class="box-body table-responsive">
            <form action="<?echo $link_edit; ?>" method="post" enctype="multipart/form-data" name="form" id="form"><input name="motorcycle_id" type="hidden" id="motorcycle_id" value="<?echo $motorcycle_row['motorcycle_id']; ?>"/>
<div>
    <p><strong><u><?echo $global->product_order->product_order_lang['form_header_product_order_lang']['motorcycle_edit']; ?>: </u></strong></p>
    <div>&nbsp;</div>
     </div><!-- /.box-header -->

<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_code']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_code" type="text" class="textbox firstin" id="motorcycle_code" value="<?echo $motorcycle_row['motorcycle_code']; ?>" required="required"></div>
</div>

<div class="row clearfix">
<div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_owner_name']; ?>:</strong></div>
<div class="col-md-8 typehead_customer"><input name="users_code" type="text" class="textbox" id="users_code" value="<?echo $users_code; ?>" required="required"></div>
</div>

<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_name']; ?>:</strong></div>
  <div class="col-md-8"><select name="motorcycle_type_code" class="textbox selectbox" id="motorcycle_type_code" required="required">
                      <option value=""<?if ($motorcycle_row['motorcycle_type_code'] == "") {?> selected="selected"<?}?>>None</option>
					  <?
$select_list = $global->tbl_list("motorcycle_type", "*", "", "motorcycle_type_name", 1);
for ($i_list = 0; $i_list < count($select_list); $i_list++) {
    ?>
					  <option value="<?echo $select_list[$i_list]['motorcycle_type_code']; ?>"<?if ($motorcycle_row['motorcycle_type_code'] == $select_list[$i_list]['motorcycle_type_code']) {?> selected="selected"<?}?>><?echo $select_list[$i_list]['motorcycle_type_name']; ?></option>
					  <?
}
?>
                      </select></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['color_name']; ?>:</strong></div>
  <div class="col-md-8"><select name="color_code" class="textbox selectbox" id="color_code">
                      <option value=""<?if ($motorcycle_row['color_code'] == "") {?> selected="selected"<?}?>>None</option>
					  <?
$select_list = $global->tbl_list("color", "*", "", "color_name", 1);
for ($i_list = 0; $i_list < count($select_list); $i_list++) {
    ?>
					  <option value="<?echo $select_list[$i_list]['color_code']; ?>"<?if ($motorcycle_row['color_code'] == $select_list[$i_list]['color_code']) {?> selected="selected"<?}?>><?echo $select_list[$i_list]['color_name']; ?></option>
					  <?
}
?>
                      </select></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_manufacture']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_manufacture" type="text" class="textbox" id="motorcycle_manufacture" value="<?echo $motorcycle_row['motorcycle_manufacture']; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_frame_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_frame_no" type="text" class="textbox" id="motorcycle_frame_no" value="<?echo $motorcycle_row['motorcycle_frame_no']; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_machine_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_machine_no" type="text" class="textbox" id="motorcycle_machine_no" value="<?echo $motorcycle_row['motorcycle_machine_no']; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_buy_register']; ?>:</strong></div>
  <div class="col-md-8"><input type="text" id="datepicker" name="motorcycle_buy_register" value="<?echo $motorcycle_row['motorcycle_buy_register']; ?>" class="nxt_tab"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_book_service_no']; ?>:</strong></div>
  <div class="col-md-8"><input name="motorcycle_book_service_no" type="text" class="textbox" id="motorcycle_book_service_no" value="<?echo $motorcycle_row['motorcycle_book_service_no']; ?>"></div>
</div>
<div class="row clearfix">
  <div class="col-md-4"><strong><?echo $global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_description']; ?>:</strong></div>
  <div class="col-md-8">
    <textarea name="motorcycle_description" cols="40" rows="7" class="textbox lastinedit" id="motorcycle_description"><?echo $motorcycle_row['motorcycle_description']; ?></textarea>
    </div>
</div>



<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-12 text-center"><button name="Submit" class="btn btn-primary" id="Submit"><?echo $form_header_lang['process_button']; ?>  (F5)</button>&nbsp;&nbsp;<a class="btn btn-warning" onclick="javascript:location.href='<?echo $link_edit; ?>?Submitcancell=true'" id="Submitcancell"><?echo $form_header_lang['cancell_button']; ?>  (F6)</a></div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
</aside><!-- /.right-side -->

