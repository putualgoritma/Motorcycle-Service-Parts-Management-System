            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Laporan Keuangan
                        </h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>">Keuangan</a></li>
                        <li class="active">Laporan Keuangan</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header">                                                                      
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
<form action="book-report.php" method="post" enctype="multipart/form-data" name="form" id="form">
<p><strong><u><? echo $global->book->book_lang['menu_book_lang']['book_report']; ?>: </u></strong></p>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_header_lang['period']; ?>:</strong></div>
<div class="col-md-10">
  <select name="month" class="textbox selectbox" id="month">
                  <option value="%" <? if($month_value=="%"){?>selected<? }?>>Bulan</option>
                  <option value="01" <? if($month_value=="01"){?>selected<? }?>>January</option>
                  <option value="02" <? if($month_value=="02"){?>selected<? }?>>February</option>
                  <option value="03" <? if($month_value=="03"){?>selected<? }?>>March</option>
                  <option value="04" <? if($month_value=="04"){?>selected<? }?>>April</option>
                  <option value="05" <? if($month_value=="05"){?>selected<? }?>>May</option>
                  <option value="06" <? if($month_value=="06"){?>selected<? }?>>June</option>
                  <option value="07" <? if($month_value=="07"){?>selected<? }?>>July</option>
                  <option value="08" <? if($month_value=="08"){?>selected<? }?>>August</option>
                  <option value="09" <? if($month_value=="09"){?>selected<? }?>>September</option>
                  <option value="10" <? if($month_value=="10"){?>selected<? }?>>October</option>
                  <option value="11" <? if($month_value=="11"){?>selected<? }?>>November</option>
                  <option value="12" <? if($month_value=="12"){?>selected<? }?>>December</option>
                  </select>
  <select name="year" class="textbox firstin" id="year">
    <?
					$akhir_periode=$company['company_birthday'] + $company['company_period'];
					for($iy=$company['company_birthday'];$iy<$akhir_periode;$iy++)
					{
					?>
    <option value="<? echo"$iy"; ?>" <? if($year_value==$iy){?>selected<? }?>><? echo"$iy"; ?></option>
                <?
					}
					?>
            </select></div>
</div>

<div class="row clearfix">                                
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><div class="form-group">
        <div class="radio">
          <label>
            <input name="keuangan" type="radio" value="rl" />
            <? echo $global->book->book_lang['form_label_book_lang']['profit_loss']; ?>
            </label>
          </div>
        <div class="radio">
          <label>
            <input name="keuangan" type="radio" value="nr" />
            <? echo $global->book->book_lang['form_label_book_lang']['balance_sheet']; ?>
            </label>
          </div> 
        <div class="radio">
          <label>
            <input name="keuangan" type="radio" value="rt" />
            <? echo $global->book->book_lang['form_header_book_lang']['ratio']; ?>
            </label>
          </div>
        </div></div>
</div>

<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['process_button']; ?></button></div>
</div> 
</form>                                
                                

                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
