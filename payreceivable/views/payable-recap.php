            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Rekap Utang</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="payable-recap.php">Utang &amp; Piutang</a></li>
                        <li class="active">Rekap Utang</li>
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
                                <div id="header-top">
                                <div class="row clearfix">
                                <div class="col-md-12">
                                <form action="payable-recap.php" method="post" enctype="multipart/form-data" name="formsearch" id="formsearch">
                                <input name="search" type="text" class="selectbox firstin" id="search" value="<? echo"$search_value"; ?>"size="20" />
                                <div class="page">Month: </div>
                                <select name="month" class="textbox" id="month">
                                <option value="%" <? if($_SESSION['payable_recap_month_sessi']=="%"){?>selected<? }?>>Bulan</option>
                                <option value="01" <? if($_SESSION['payable_recap_month_sessi']=="01"){?>selected<? }?>>January</option>
                                  <option value="02" <? if($_SESSION['payable_recap_month_sessi']=="02"){?>selected<? }?>>February</option>
                                  <option value="03" <? if($_SESSION['payable_recap_month_sessi']=="03"){?>selected<? }?>>March</option>
                                  <option value="04" <? if($_SESSION['payable_recap_month_sessi']=="04"){?>selected<? }?>>April</option>
                                  <option value="05" <? if($_SESSION['payable_recap_month_sessi']=="05"){?>selected<? }?>>May</option>
                                  <option value="06" <? if($_SESSION['payable_recap_month_sessi']=="06"){?>selected<? }?>>June</option>
                                  <option value="07" <? if($_SESSION['payable_recap_month_sessi']=="07"){?>selected<? }?>>July</option>
                                  <option value="08" <? if($_SESSION['payable_recap_month_sessi']=="08"){?>selected<? }?>>August</option>
                                  <option value="09" <? if($_SESSION['payable_recap_month_sessi']=="09"){?>selected<? }?>>September</option>
                                  <option value="10" <? if($_SESSION['payable_recap_month_sessi']=="10"){?>selected<? }?>>October</option>
                                  <option value="11" <? if($_SESSION['payable_recap_month_sessi']=="11"){?>selected<? }?>>November</option>
                                  <option value="12" <? if($_SESSION['payable_recap_month_sessi']=="12"){?>selected<? }?>>December</option>
                              	</select>
                                <div class="page">Year:</div>
                                <select name="year" class="textbox" id="year">
                                    <option value="%" <? if($_SESSION['payable_recap_year_sessi']=="%"){?>selected<? }?>>Tahun</option>
                                    <?
                                    $akhir_periode=$company['company_birthday'] + $company['company_period'];
                                    for($iy=$company['company_birthday'];$iy<$akhir_periode;$iy++)
                                    {
                                    ?>
                                    <option value="<? echo"$iy"; ?>" <? if($_SESSION['payable_recap_year_sessi']==$iy){?>selected<? }?>><? echo"$iy"; ?></option>
                                    <?
                                    }
                                    ?>
                              </select>
                                
                                <select name="users_code" class="textbox selectbox" id="users_code">
                      <option value="0" <? if($users_code_value=="0"){?>selected<? }?>>Semua User</option>
					  <?
						$users_list=$global->tbl_list("users","*","","users_name",1);
						for($i=0;$i<count($users_list);$i++){
						?>
					  <option value="<? echo $users_list[$i]['users_code']; ?>"<? if($users_code_value==$users_list[$i]['users_code']){?> selected="selected"<? }?>><? echo $users_list[$i]['users_name']; ?></option>
					  <?
							}
						?>
                      </select>
                      <div class="pull-left"><button name="Submit" id="Submit" class="btn btn-primary"><i class="fa fa-search"></i><? echo $form_header_lang['search_kop']; ?></button></div></form>
                      
                      
                  </div>
                  </div>
                  <div class="clear">&nbsp;</div>
                  
				  
                  </div>
                  <? 
				for($i=0;$i<count($payable_recap_search_list);$i++){
			 	$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			?>
                <div class="clear">&nbsp;</div>
                <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="#" data-toggle="modal" data-target="#myModalnew"><div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        1.
                                    </h3>
                                    <p><? echo $menu_lang['cash']; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-table"></i>
                                </div>
                                <div class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?
				$inc++;
				}
			?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
            <div class="modal fade" id="myModalnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="payable-new-process.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="payreceivable_status" type="hidden" id="payreceivable_status" value="0" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_plus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['payable'];?></u></strong></p>                          
<div>&nbsp;</div>
     </div><!-- /.box-header -->

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_label_payreceivable_recap_lang['paid_unpaid']; ?>:</strong></div>
<div class="col-md-8"><label class="radio-inline">
        <input name="payreceivable_recap_status" type="radio" id="payreceivable_recap_status_0" value="1" checked="checked" />
        Paid</label>
        <label class="radio-inline">
        <input type="radio" name="payreceivable_recap_status" value="0" id="payreceivable_recap_status_1" class="lastinnew" />
        Unpaid</label></div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submitnew">Proses Data</button></div>
</div> 
</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="myModalnew2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-refresh="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="box modal-dialog">
<div class="box-body table-responsive">
<form action="payable-new-process.php" method="post" enctype="multipart/form-data" name="form" id="form"><input name="payreceivable_status" type="hidden" id="payreceivable_status" value="1" />
<div class="box-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <p class="title-header"><strong><u><? echo $global->payreceivable->payreceivable_lang['form_header_payreceivable_lang']['payreceivable_minus'];?> <? echo $global->payreceivable->payreceivable_lang['menu_payreceivable_lang']['payable'];?></u></strong></p>                          
<div>&nbsp;</div>
     </div><!-- /.box-header -->

<div class="row clearfix">
<div class="col-md-4"><strong><? echo $form_label_payreceivable_recap_lang['paid_unpaid']; ?>:</strong></div>
<div class="col-md-8"><label class="radio-inline">
        <input name="payreceivable_recap_status" type="radio" id="payreceivable_recap_status_0" value="1" checked="checked" />
        Paid</label>
        <label class="radio-inline">
        <input type="radio" name="payreceivable_recap_status" value="0" id="payreceivable_recap_status_1" class="lastinedit" />
        Unpaid</label></div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submitnew2">Proses Data</button></div>
</div> 
</form>                                
</div>
</div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div>
