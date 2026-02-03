<? $ic=0;
$ulm_arr=$global->users_role($_SESSION['users_level_code_sessi']);
?>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Home
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                    <? $module_list=$global->tbl_list("module","*","","module_rank ASC,module_id ASC",1);
					for($i=0;$i<count($module_list);$i++){
					$key1=$module_list[$i]['module_code'];
					if($ulm_arr[$key1]['users_level_module_access_view']==1){
					//$module_theme_row=$global->module_theme($module_list[$i]['module_code']);
					?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <a href="index-sub.php?module_code=<? echo $key1;?>" class="load_link"><div class="small-box <? echo $module_list[$i]['module_bg_color']; ?>">
                                <div class="inner">
                                    <h3>
                                        <? $ic++; echo $ic;?>.
                                    </h3>
                                    <p><? echo $module_list[$i]['module_name'];?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa <? echo $module_list[$i]['module_fa_icon']; ?>"></i>
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