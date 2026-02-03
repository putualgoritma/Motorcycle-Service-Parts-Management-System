<? $ic=0;
$ulm_arr=$global->users_role($_SESSION['users_level_code_sessi']);
$module_row=$global->db_row("module","*","module_code='".$_REQUEST['module_code']."'");
?>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <? echo $module_row['module_name']; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"><? echo $module_row['module_name']; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                    <? 
					$key1=$module_row['module_code'];
					$module_list=$global->tbl_list("module_sub","*","module_code='".$key1."'","module_sub_rank ASC,module_sub_id ASC",1);
					for($i=0;$i<count($module_list);$i++){
					$key2=$module_list[$i]['module_sub_code'];
					if($ulm_arr[$key1][$key2]['users_level_module_access_view']==1){
					?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="<? echo $module_list[$i]['module_sub_link'];?>" class="load_link"><div class="small-box <? echo $module_list[$i]['module_sub_bg_color']; ?>">
                                <div class="inner">
                                    <h3>
                                        <? $ic++; echo $ic;?>.
                                    </h3>
                                    <p><? echo $module_list[$i]['module_sub_name'];?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa <? echo $module_list[$i]['module_sub_fa_icon']; ?>"></i>
                                </div>
                                <div class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                            </a>
                        </div>
                        <? 
					}}
						?>
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                          
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

 
                </section><!-- /.content -->
            </aside>