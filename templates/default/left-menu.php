<? 
//$ulm_arr=$global->users_role($_SESSION['users_level_code_sessi']);
?>
            <!-- Left side column. contains the logo and sidebar -->

            <aside class="left-side sidebar-offcanvas">                

                <!-- sidebar: style can be found in sidebar.less -->

                <section class="sidebar scroll">

                    <!-- Sidebar user panel -->

                    <div class="user-panel">

                        <div class="pull-left image">

                            <img src="<? echo $path; ?>templates/default/img/avatar3.png" class="img-circle" alt="User Image" />

                        </div>

                        <div class="pull-left info">

                            <p><? echo $contact_glob['contact_name']; ?></p>



                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

                        </div>

                    </div>

                   

                    <!-- sidebar menu: : style can be found in sidebar.less -->

                    <ul class="sidebar-menu">

                        <li<? if($parent_active=="home"){?> class="active"<? }?>>

                            <a href="<? echo $path; ?>index.php">

                                <i class="fa fa-home"></i> <span>Home</span>

                            </a>

                        </li>

                        
                        <? $module_list=$global->tbl_list("module","*","","module_rank ASC,module_id ASC",1);
						for($i=0;$i<count($module_list);$i++){
						$key1=$module_list[$i]['module_code'];
						if($ulm_arr[$key1]['users_level_module_access_view']==1){
						//$module_theme_row=$global->module_theme($module_list[$i]['module_code']);
						?>
                        <li class="treeview<? if($parent_active==$module_list[$i]['module_code']){?> active<? }?>">
                            <a href="#" class="alink_excp">
                                <i class="fa <? echo $module_list[$i]['module_fa_icon']; ?>"></i> <span><? echo $module_list[$i]['module_name'];?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            <?
	$module_sub_list=$global->tbl_list("module_sub","*","module_code='".$module_list[$i]['module_code']."'","module_sub_rank ASC,module_sub_id ASC",1);
	for($k=0;$k<count($module_sub_list);$k++){
		$l=$k+1;
		$key2=$module_sub_list[$k]['module_sub_code'];
		if($ulm_arr[$key1][$key2]['users_level_module_access_view']==1){
	?>
                                <li<? if($page_active==$module_sub_list[$k]['module_sub_code']){?> class="active"<? }?>><a href="<? echo $path; ?><? echo $module_sub_list[$k]['module_sub_link']; ?>"><i class="fa fa-angle-double-right"></i><? echo $module_sub_list[$k]['module_sub_name']; ?></a></li>
                                <? 
					}}
					?>
                            </ul>
                    </li>
                    <? 
					}}
					?>
                    </ul>

                </section>

                <!-- /.sidebar -->

            </aside>