            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Tutup Buku</h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<? echo $path; ?>index-sub.php?module_code=<? echo $parent_active; ?>">Keuangan</a></li>
                        <li class="active">Tutup Buku</li>
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
                                
                                
<form action="book-close.php" method="post" enctype="multipart/form-data" name="form" id="form">
<p><strong><u><? echo $global->book->book_lang['menu_book_lang']['book_close']; ?>:</u></strong></p>                      
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $form_header_lang['period']; ?>:</strong></div>
<div class="col-md-10"><select name="year" class="textbox firstin" id="year">
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

<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['book_close_button']; ?></button></div>
</div> 
</form>                                
 <div>&nbsp;</div>                                    
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
<div class="clear">&nbsp;</div>   

<div class="box box-info">
                                <div class="box-header"> 
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
<form onSubmit="return confirmSubmit('<? echo $msgform_lang['cfrm_remove']; ?>')" method="post" name="myform" enctype="multipart/form-data" action="">
<p><strong><u><? echo $global->book->book_lang['form_header_book_lang']['book_close_history']; ?></u></strong></p>
<? if($ulm_arr[$parent_active][$page_active]['users_level_module_access_delete']==1){?><button class="btn btn-danger" onclick="setCount(0,document.myform,'book-close.php?delete=true')" name="Submitdel" value="view"><i class="fa fa-times"></i> <? echo $form_header_lang['delete_kop']; ?></button><? }?>
<div>&nbsp;</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-striped">
  <tr>
    <th width="3%" align="center">#</td>
    <th width="4%">&nbsp;</td>
    <th width="54%"><strong><? echo $global->book->book_lang['form_label_book_lang']['ledger_register']; ?></strong></td>
    <th width="39%"><strong><? echo $form_header_lang['period']; ?></strong></td>   
    </tr>
    <? 
			 $book_close_list=$global->tbl_list("book_close","*","","",1);
			 for($i=0;$i<count($book_close_list);$i++){
				$bg_color=$global->get_bg("#F9F9F9","#FFFFFF",$inc);
			?>
  <tr>
    <td bgcolor="<? echo"$bg_color"; ?>"><? echo"$inc"; ?></td>
    <td bgcolor="<? echo"$bg_color"; ?>"><input name="id[]" type="checkbox" id="id[]" value="<? echo $book_close_list[$i]['book_close_id']; ?>" /></td>
    <td bgcolor="<? echo"$bg_color"; ?>"><? echo $book_close_list[$i]['book_close_register']; ?></td>
    <td bgcolor="<? echo"$bg_color"; ?>"><? echo $book_close_list[$i]['book_close_period']; ?></td>
    </tr>
    <?
				$inc++;
				}
			?>
</table>
<div>&nbsp;</div>

</form>
            </div><!-- /.box-body -->
                          </div><!-- /.box -->                         
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->