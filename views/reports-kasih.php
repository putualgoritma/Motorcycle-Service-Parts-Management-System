<? 
$ic=0;
$ulm_arr=$global->users_role($_SESSION['users_level_code_sessi']);
?>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Reports
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php" class="load_link"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Reports</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" id="service">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                      <div class="col-lg-12 col-xs-12">
                    <div id="accordion">
  <h3>Laporan-Laporan</h3>
  <div class="col-md-6">
    <p><strong><u>Umum</u></strong></p>
    <ul>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/service-daily-pdf.php"><i class="fa fa-check-square-o"></i> Harian Bengkel</a></li>
    <? if($_SESSION['users_level_code_sessi']!='FD' && $_SESSION['users_level_code_sessi']!='FRONT DESK'){
					?>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/mpp-pdf.php"><i class="fa fa-check-square-o"></i> Mechanic Performance Parameter</a></li>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/service-product-daily-pdf.php"><i class="fa fa-check-square-o"></i> Jasa & Part Terjual Harian</a></li>
    <?php
          }
            ?>
    
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/sales-daily-pdf.php"><i class="fa fa-check-square-o"></i> Penjualan Harian</a></li>
    <? if($_SESSION['users_level_code_sessi']!='FD' && $_SESSION['users_level_code_sessi']!='FRONT DESK'){
					?>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/sales-rate-daily-pdf.php"><i class="fa fa-check-square-o"></i> Penjualan Rate Harian</a></li>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/service-portal-daily-pdf.php"><i class="fa fa-check-square-o"></i> Portal Astra</a></li>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/cross-selling-xls.php"><i class="fa fa-check-square-o"></i> Cross Selling</a></li>
    <?php
          }
            ?>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/kpb-online-xls.php"><i class="fa fa-check-square-o"></i> KPB Online</a></li>
    <? if($_SESSION['users_level_code_sessi']!='FD' && $_SESSION['users_level_code_sessi']!='FRONT DESK'){
                        ?>
    <li><a href="javascript:;" class="report_monthly" rel="<? echo $path; ?>product-service/service/pdf/lbb-pdf.php"><i class="fa fa-check-square-o"></i> LBB Bengkel</a></li>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/sales-recap-pdf.php"><i class="fa fa-check-square-o"></i> Rekap Penjualan</a></li>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>product-service/service/pdf/service-product-top-pdf.php"><i class="fa fa-check-square-o"></i> Jasa & Part Terlaris</a></li>
    <li><a href="javascript:;" class="report_daily" rel="<? echo $path; ?>book/pdf/cash-flow-pdf-all.php"><i class="fa fa-check-square-o"></i> Mutasi Kas</a></li>
    <?php
          }
            ?>
    
    </ul>
  </div>
  <div class="col-md-6">
    <p><strong><u>Stock</u></strong></p>
    <ul>
        <? if($_SESSION['users_level_code_sessi']!='FD' && $_SESSION['users_level_code_sessi']!='FRONT DESK'){
					?>
    <li><a href="javascript:;" class="report_daily_stock" rel="<? echo $path; ?>product-service/inventory/pdf/stock-details-pdf.php"><i class="fa fa-check-square-o"></i> Rincian Mutasi Stok</a></li>
    <li><a href="javascript:;" class="report_daily_stock" rel="<? echo $path; ?>product-service/inventory/pdf/stock-pdf.php"><i class="fa fa-check-square-o"></i> Rekap Mutasi Stok</a></li>
    <li><a href="javascript:;" class="report_form_daily" rel="<? echo $path; ?>product-service/inventory/pdf/stock-form-pdf.php"><i class="fa fa-check-square-o"></i> Form Stok Opname</a></li>
    <?php
          }
            ?>
    </ul>
  </div>
</div>
                    </div>
                    </div><!-- /.row -->

<div>&nbsp;</div>
                </section><!-- /.content -->
            </aside>
            
<div class="modal fade" id="Modal_Daily" tabindex="-1" role="dialog" aria-labelledby="Modal_Daily" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
		<div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" name="form_daily" id="form_daily" enctype="multipart/form-data" action="" target="_blank">
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="clear">&nbsp;</div>
    <div class="row clearfix">
    <div class="col-md-4"><strong><? echo $form_header_lang['date_input_start']; ?>:</strong></div>
    <div class="col-md-8"><input type="text" id="service_order_register_start" name="service_order_register_start" value="<? echo $date_def; ?>" class="nxt_tab datepicker" required="required"></div>
    </div>
    <div class="row clearfix">
    <div class="col-md-4"><strong><? echo $form_header_lang['date_input_end']; ?>:</strong></div>
    <div class="col-md-8"><input type="text" id="service_order_register" name="service_order_register" value="<? echo $date_def; ?>" class="nxt_tab datepicker" required="required"></div>
    </div>
    <div class="row clearfix">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8"><button class="btn btn-info" id="btn_proc" type="submit"><i class="fa fa-file-pdf-o"></i><span> PROSES</span></button>
    </div>
    </div>
<div>&nbsp;</div>
     </div><!-- /.box-header -->

</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="Modal_Monthly" tabindex="-1" role="dialog" aria-labelledby="Modal_Daily" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
		<div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" name="form_monthly" id="form_monthly" enctype="multipart/form-data" action="" target="_blank">
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="clear">&nbsp;</div>
    <div class="row clearfix">
      <div class="col-md-4"><strong>Periode:</strong></div>
    <div class="col-md-8"><input class="selectbox monthpicker" type="text" name="service_order_monthly" value="<? echo date('m')."/".date('Y'); ?>" /></div>
  </div>
    <div class="row clearfix">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8"><button class="btn btn-info" id="btn_proc" type="submit"><i class="fa fa-file-pdf-o"></i><span> PROSES</span></button>
    </div>
    </div>
<div>&nbsp;</div>
     </div><!-- /.box-header -->

</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="Modal_Daily_Stock" tabindex="-1" role="dialog" aria-labelledby="Modal_Daily" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
		<div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" name="form_daily" id="form_daily" enctype="multipart/form-data" action="" target="_blank">
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="clear">&nbsp;</div>
    <div class="row clearfix">
    <div class="col-md-4"><strong><? echo $form_header_lang['date_input_start']; ?>:</strong></div>
    <div class="col-md-8"><input type="text" id="warehouse_stock_register_start" name="warehouse_stock_register_start" value="<? echo $date_def; ?>" class="nxt_tab datepicker" required="required"></div>
    </div>
    <div class="row clearfix">
    <div class="col-md-4"><strong><? echo $form_header_lang['date_input_end']; ?>:</strong></div>
    <div class="col-md-8"><input type="text" id="warehouse_stock_register" name="warehouse_stock_register" value="<? echo $date_def; ?>" class="nxt_tab datepicker" required="required"></div>
    </div>
    <div class="row clearfix">
    <div class="col-md-4"><strong>Kode Part:</strong></div>
    <div class="col-md-8 typehead_product"><input type="text" id="product_code" name="product_code" value="" class="nxt_tab" placeholder="Kode Part/Kosongkan"></div>
    </div>
    <div class="row clearfix">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8"><button class="btn btn-info" id="btn_proc" type="submit"><i class="fa fa-file-pdf-o"></i><span> PROSES</span></button>
    </div>
    </div>
<div>&nbsp;</div>
     </div><!-- /.box-header -->

</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="Modal_Form_Daily" tabindex="-1" role="dialog" aria-labelledby="Modal_Daily" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
		<div class="box modal-dialog">
<div class="box-body table-responsive">
<form method="post" name="form_form_daily" id="form_form_daily" enctype="multipart/form-data" action="" target="_blank">
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="clear">&nbsp;</div>
    <div class="row clearfix">
      <div class="col-md-4"><strong><? echo $form_header_lang['date_input_end']; ?>:</strong></div>
    <div class="col-md-8"><input type="text" id="warehouse_stock_register" name="warehouse_stock_register" value="<? echo $date_def; ?>" class="nxt_tab datepicker" required="required"></div>
  </div>
    <div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['category_name']; ?>:</strong></div>
<div class="col-md-8"><select name="category_code" class="textbox selectbox" id="category_code">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("category","*","category_type='0'","category_name",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['category_code']; ?>"><? echo $select_list[$i_list]['category_name']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong><? echo $global->product_order->product_order_lang['form_label_product_order_lang']['rack_description']; ?>:</strong></div>
<div class="col-md-8"><select name="rack_code" class="textbox selectbox" id="rack_code">
                      <option value="">None</option>
					  <?
						$select_list=$global->tbl_list("rack","*","","rack_description",1);
						for($i_list=0;$i_list<count($select_list);$i_list++){
						?>
					  <option value="<? echo $select_list[$i_list]['rack_code']; ?>"><? echo $select_list[$i_list]['rack_code']; ?> - <? echo $select_list[$i_list]['rack_description']; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>

<div class="row clearfix">                                
  <div class="col-md-4"><strong>Data Range:</strong></div>
<div class="col-md-8"><select name="num_range" class="textbox selectbox" id="num_range">
					  <?
						for($range_list=0;$range_list<41;$range_list++){
						$range_a=$range_list*1000;
						$range_b=(($range_list+1)*1000)-1;
						?>
					  <option value="<? echo $range_list; ?>"><? echo $range_a; ?> - <? echo $range_b; ?></option>
					  <?
							}
						?>
                      </select></div>
</div>

    <div class="row clearfix">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8"><button class="btn btn-info" id="btn_proc" type="submit"><i class="fa fa-file-pdf-o"></i><span> PROSES</span></button>
    </div>
    </div>
<div>&nbsp;</div>
     </div><!-- /.box-header -->

</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>