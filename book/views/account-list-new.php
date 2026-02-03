            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Tambah Daftar Rekening
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="ledger-general.php">Jurnal umum</a></li>
                        <li class="active">Daftar Rekening</li>
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
                                
                                
<form action="account-list-new.php" method="post" enctype="multipart/form-data" name="form" id="form">
<strong><u><? echo $global->book->book_lang['form_header_book_lang']['account_list_new']; ?></u></strong>   
<div>&nbsp;</div>            
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_parent']; ?>:</strong></div>
<div class="col-md-10"><select name="taxonomi_parent" class="textbox firstin" id="taxonomi_parent">
                <?
			$global->book->taxonomi_createsmp(0,0,0);
			?>
            </select></div>
</div>
<div class="row clearfix">
<div class="col-md-2"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_postable']; ?>:</strong></div>
<div class="col-md-10"><select name="taxonomi_postable" class="textbox" id="taxonomi_postable">
                <option value="0" selected="selected">Yes</option>
                <option value="1">No</option>
            </select></div>
</div>
<div class="row clearfix">                                
<div class="col-md-2"><strong><? echo $global->book->book_lang['form_label_book_lang']['taxonomi_name']; ?>:</strong></div>
<div class="col-md-10"><input name="taxonomi_name" type="text" class="textbox lastin" id="taxonomi_name"></div>
</div>
<div class="clear">&nbsp;</div>
<div class="row clearfix">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-10"><button name="Submit" class="btn btn-primary" id="Submit"><? echo $form_header_lang['add_new_button']; ?></button></div>
</div> 
</form>                                
                                
                                
    
                                
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            

                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->