            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><? echo $global->csv->csv_lang['form_header_csv_lang']['csv']; ?></h1>
                    <ol class="breadcrumb">
                        <li><a href=".."><i class="fa fa-home"></i> <? echo $menu_lang['home']; ?></a></li>
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
    <div class="box-header"> 
     </div><!-- /.box-header -->
    <div class="box-body table-responsive">
<p><strong><u><? echo $global->csv->csv_lang['form_header_csv_lang']['csv']; ?>: </u></strong></p>

<div class="clear">barang&nbsp;</div>
<form action="csv-product.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->csv->csv_lang['form_label_csv_lang']['csv_product']; ?>:</strong></div>
  <div class="col-md-10"><span class="text">
    <input name="file_source" type="file" class="textbox" id="file_source" />
  </span>
  </div>
</div>
<div class="row clearfix">
  <div class="col-md-2">&nbsp;</div>
  <div class="col-md-10"><a href="csv-product.php">&nbsp;Export to CSV </a></div>
</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submitproduct" class="btn btn-primary" id="Submitproduct"><? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button></div>
</div>
</form>

<div class="clear">barang stok&nbsp;</div>
<form action="csv-product-stock.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->csv->csv_lang['form_label_csv_lang']['csv_product_stock']; ?>:</strong></div>
  <div class="col-md-10"><span class="text">
    <input name="file_source" type="file" class="textbox" id="file_source" />
  </span>
  </div>
</div>
<div class="row clearfix">
  <div class="col-md-2">&nbsp;</div>
  <div class="col-md-10"><a href="csv-product-stock.php">&nbsp;Export to CSV </a></div>
</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submitproduct_stock" class="btn btn-primary" id="Submitproduct_stock"><? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button></div>
</div>
</form>

<div class="clear">barang fm&nbsp;</div>
<form action="csv-product-fm.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->csv->csv_lang['form_label_csv_lang']['csv_product_fm']; ?>:</strong></div>
  <div class="col-md-10"><span class="text">
    <input name="file_source" type="file" class="textbox" id="file_source" />
  </span>
  </div>
</div>
<div class="row clearfix">
  <div class="col-md-2">&nbsp;</div>
  <div class="col-md-10"><a href="csv-product-fm.php">&nbsp;Export to CSV </a></div>
</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submitproduct_fm" class="btn btn-primary" id="Submitproduct_fm"><? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button></div>
</div>
</form>

<div class="clear">jasa&nbsp;</div>
<form action="csv-service.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->csv->csv_lang['form_label_csv_lang']['csv_service']; ?>:</strong></div>
  <div class="col-md-10"><span class="text">
    <input name="file_source" type="file" class="textbox" id="file_source" />
  </span>
  </div>
</div>
<div class="row clearfix">
  <div class="col-md-2">&nbsp;</div>
  <div class="col-md-10"><a href="csv-service.php">&nbsp;Export to CSV </a></div>
</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submitservice" class="btn btn-primary" id="Submitservice"><? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button></div>
</div>
</form>


<div class="clear">kendaraan tipe&nbsp;</div>
<form action="csv-motorcycle-type.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->csv->csv_lang['form_label_csv_lang']['csv_motorcycle_type']; ?>:</strong></div>
  <div class="col-md-10"><span class="text">
    <input name="file_source" type="file" class="textbox" id="file_source" />
  </span>
  </div>
</div>
<div class="row clearfix">
  <div class="col-md-2">&nbsp;</div>
  <div class="col-md-10"><a href="csv-motorcycle-type.php">&nbsp;Export to CSV </a></div>
</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submitmotorcycle_type" class="btn btn-primary" id="Submitmotorcycle_type"><? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button></div>
</div>
</form>

<div class="clear">kendaraan&nbsp;</div>
<form action="csv-motorcycle.php" method="post" enctype="multipart/form-data" name="form" id="form">
<div class="row clearfix">
  <div class="col-md-2"><strong><? echo $global->csv->csv_lang['form_label_csv_lang']['csv_motorcycle']; ?>:</strong></div>
  <div class="col-md-10"><span class="text">
    <input name="file_source" type="file" class="textbox" id="file_source" />
  </span>
  </div>
</div>
<div class="row clearfix">
  <div class="col-md-2">&nbsp;</div>
  <div class="col-md-10"><a href="csv-motorcycle.php">&nbsp;Export to CSV </a></div>
</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submitmotorcycle" class="btn btn-primary" id="Submitmotorcycle"><? echo $global->csv->csv_lang['form_header_csv_lang']['import_button']; ?></button></div>
</div>
</form>
</div> 							
                                   
            <!-- /.box-body -->
                          </div><!-- /.box -->                         
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->