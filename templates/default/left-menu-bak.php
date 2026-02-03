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

                            <p>Hello, Admin</p>



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

                        
                        <? if($_SESSION['admin_password_sessi']=="super"){?>
                        <li class="treeview<? if($parent_active=="product-service/service"){?> active<? }?>">

                            <a href="#" class="alink_excp">

                                <i class="fa fa-motorcycle"></i> <span>Servis</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">
                                <li<? if($page_active=="product-service/service/service"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/service/service.php"><i class="fa fa-angle-double-right"></i>Pendaftaran Service</a></li>
                                <li<? if($page_active=="product-service/service/service"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/service/service-onl.php"><i class="fa fa-angle-double-right"></i>Pendaftaran Online</a></li>
                                <li<? if($page_active=="product-service/service/service-vendor"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/service/service-vendor.php"><i class="fa fa-angle-double-right"></i>Service Vendor</a></li>




                            </ul>

                    </li>
                    <? }?>
                        <? if($_SESSION['admin_password_sessi']=="super"){?>

                        
                        <li class="treeview<? if($parent_active=="product-service/product-sale"){?> active<? }?>">
                           <a href="#" class="alink_excp">
                                <i class="fa fa-shopping-cart"></i> <span>Penjualan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li<? if($page_active=="product-service/product-sale/product-sale-pend"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-sale/product-sale-pend.php"><i class="fa fa-angle-double-right"></i>Hotline Order</a></li>
                                <li<? if($page_active=="product-service/product-sale/product-sale"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-sale/product-sale.php"><i class="fa fa-angle-double-right"></i>Faktur Penjualan</a></li>
                                <li<? if($page_active=="product-service/product-sale/product-sale-receivable"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-sale/product-sale-receivable.php"><i class="fa fa-angle-double-right"></i>Piutang Penjualan</a></li>
                                <li<? if($page_active=="product-service/product-sale/product-sale-retur"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-sale/product-sale-retur.php"><i class="fa fa-angle-double-right"></i>Retur Penjualan</a></li>
                                <li<? if($page_active=="product-service/product-sale/product-sale-payable"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-sale/product-sale-payable.php"><i class="fa fa-angle-double-right"></i>Utang Retur Penjualan</a></li>
                            </ul>
                        </li>
                        

                        <li class="treeview<? if($parent_active=="product-service/product-buy"){?> active<? }?>">

                           <a href="#" class="alink_excp">

                                <i class="fa fa-cart-arrow-down"></i> <span>Pembelian</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <li<? if($page_active=="product-service/product-buy/product-buy-pend"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-buy/product-buy-pend.php"><i class="fa fa-angle-double-right"></i>Order Pembelian</a></li>
                                <li<? if($page_active=="product-service/product-buy/product-buy"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-buy/product-buy.php"><i class="fa fa-angle-double-right"></i>Faktur Pembelian</a></li>
                                <li<? if($page_active=="product-service/product-buy/product-buy-payable"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-buy/product-buy-payable.php"><i class="fa fa-angle-double-right"></i>Utang Pembelian</a></li>
                                <li<? if($page_active=="product-service/product-buy/product-buy-retur"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-buy/product-buy-retur.php"><i class="fa fa-angle-double-right"></i>Retur Pembelian</a></li>
                                <li<? if($page_active=="product-service/product-buy/product-buy-receivable"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/product-buy/product-buy-receivable.php"><i class="fa fa-angle-double-right"></i>Piutang Retur Pembelian</a></li>


                            </ul>

                        </li>
                        <? }?>
                        <? if($_SESSION['admin_password_sessi']=="super"){?>

                        

                        <li class="treeview<? if($parent_active=="warehouse-stock"){?> active<? }?>">

                            <a href="#" class="alink_excp">

                                <i class="fa fa-cubes"></i> <span>Stock/Persediaan</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">
                            <li<? if($page_active=="warehouse-stock/warehouse-stock"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/warehouse-stock.php"><i class="fa fa-angle-double-right"></i>Stok Masuk (Hibah)</a></li>
                            <li<? if($page_active=="warehouse-stock/warehouse-stock-min"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/warehouse-stock-min.php"><i class="fa fa-angle-double-right"></i>Stok Keluar (Hibah)</a></li>
                            <li<? if($page_active=="warehouse-stock/warehouse-stock-trs"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/warehouse-stock-trs.php"><i class="fa fa-angle-double-right"></i>Stok Transfer</a></li>
                            <li<? if($page_active=="warehouse-stock/stock-opname"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/stock-opname.php"><i class="fa fa-angle-double-right"></i>Stock Opname</a></li>
                            </ul>

                        </li>
                        <? }?>
                        <? if($_SESSION['admin_password_sessi']=="super"){?>

                        <li class="treeview<? if($parent_active=="salary"){?> active<? }?>">

                            <a href="#" class="alink_excp">

                                <i class="fa fa-calendar-check-o"></i> <span>Penggajian</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <li<? if($page_active=="salary/absence"){?> class="active"<? }?>><a href="<? echo $path; ?>salary/absence.php"><i class="fa fa-angle-double-right"></i>Absensi Kerja</a></li>
                                <li<? if($page_active=="salary/insentif"){?> class="active"<? }?>><a href="<? echo $path; ?>salary/insentif.php"><i class="fa fa-angle-double-right"></i>Pencapaian Mekanik</a></li>
                                <li<? if($page_active=="salary/receivable-staff"){?> class="active"<? }?>><a href="<? echo $path; ?>payreceivable/receivable-staff.php"><i class="fa fa-angle-double-right"></i>Piutang Karyawan</a></li>
                                <li<? if($page_active=="salary/slip"){?> class="active"<? }?>><a href="<? echo $path; ?>salary/slip.php"><i class="fa fa-angle-double-right"></i>Pembayaran Gaji</a></li>
                                <li<? if($page_active=="salary/settings"){?> class="active"<? }?>><a href="<? echo $path; ?>salary/settings.php"><i class="fa fa-angle-double-right"></i>Pengaturan</a></li>
                            </ul>

                        </li>
                        <? }?>
                        <? if($_SESSION['admin_password_sessi']=="super" || $_SESSION['admin_password_sessi']=="visitor"){?>

                        <li class="treeview<? if($parent_active=="book"){?> active<? }?>">

                            <a href="#" class="alink_excp">

                                <i class="fa fa-balance-scale"></i> <span>Keuangan</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <? if($_SESSION['admin_password_sessi']=="super"){?>
                                <li<? if($page_active=="book/cash"){?> class="active"<? }?>><a href="<? echo $path; ?>book/cash.php"><i class="fa fa-angle-double-right"></i>Buku Kas Masuk</a></li>
                                
                                <li<? if($page_active=="book/cash-credit"){?> class="active"<? }?>><a href="<? echo $path; ?>book/cash-credit.php"><i class="fa fa-angle-double-right"></i>Buku Kas Keluar</a></li>
                                
                                <li<? if($page_active=="book/payable"){?> class="active"<? }?>><a href="<? echo $path; ?>payreceivable/payable.php"><i class="fa fa-angle-double-right"></i>Buku Utang</a></li>
                                
                                <li<? if($page_active=="book/receivable"){?> class="active"<? }?>><a href="<? echo $path; ?>payreceivable/receivable.php"><i class="fa fa-angle-double-right"></i>Buku Piutang</a></li>
                                
                                <li<? if($page_active=="book/ledger-general"){?> class="active"<? }?>><a href="<? echo $path; ?>book/ledger-general.php"><i class="fa fa-angle-double-right"></i>Jurnal Umum</a></li>

                                <li<? if($page_active=="book/balance-account"){?> class="active"<? }?>><a href="<? echo $path; ?>book/balance-account.php"><i class="fa fa-angle-double-right"></i>Buku Besar</a></li>

                                <li<? if($page_active=="book/balance-trial"){?> class="active"<? }?>><a href="<? echo $path; ?>book/balance-trial.php"><i class="fa fa-angle-double-right"></i>Neraca Saldo</a></li>

								<li<? if($page_active=="asset-fixed/asset-fixed"){?> class="active"<? }?>><a href="<? echo $path; ?>asset-fixed/asset-fixed.php"><i class="fa fa-angle-double-right"></i>Daftar Inventaris</a></li>

                                <li<? if($page_active=="book/account-list"){?> class="active"<? }?>><a href="<? echo $path; ?>book/account-list.php"><i class="fa fa-angle-double-right"></i>Daftar Rekening</a></li>
                                
                                <li<? if($page_active=="book/book-close"){?> class="active"<? }?>><a href="<? echo $path; ?>book/book-close.php"><i class="fa fa-angle-double-right"></i>Tutup Buku</a></li>

                                <? }?>
								<? if($_SESSION['admin_password_sessi']=="super" || $_SESSION['admin_password_sessi']=="visitor"){?>
                                <li<? if($page_active=="book/book-report"){?> class="active"<? }?>><a href="<? echo $path; ?>book/book-report.php"><i class="fa fa-angle-double-right"></i>Laporan Keuangan</a></li>
                                <? }?>

                            </ul>

                        </li>
                        <? }?>
                        <? if($_SESSION['admin_password_sessi']=="super"){?>

                        <li class="treeview<? if($parent_active=="product-service/inventory"){?> active<? }?>">

                            <a href="#" class="alink_excp">

                                <i class="fa fa-building"></i> <span>Master Data</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <li<? if($page_active=="product-service/inventory/product"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/product.php"><i class="fa fa-angle-double-right"></i>Barang</a></li>
                                <li<? if($page_active=="product-service/inventory/category"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/category.php"><i class="fa fa-angle-double-right"></i>Group</a></li>
                                <li<? if($page_active=="product-service/inventory/categorysub"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/categorysub.php"><i class="fa fa-angle-double-right"></i>Sub Group</a></li>
                                <li<? if($page_active=="product-service/inventory/unit"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/unit.php"><i class="fa fa-angle-double-right"></i>Satuan</a></li>
								<li<? if($page_active=="product-service/inventory/rack"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/rack.php"><i class="fa fa-angle-double-right"></i>Rak</a></li>
                                <li<? if($page_active=="product-service/inventory/warehouse"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/warehouse.php"><i class="fa fa-angle-double-right"></i>Gudang</a></li>
                                <li<? if($page_active=="users/supplier"){?> class="active"<? }?>><a href="<? echo $path; ?>users/supplier.php"><i class="fa fa-angle-double-right"></i>Supplier</a></li>
                                <li<? if($page_active=="users/vendor"){?> class="active"<? }?>><a href="<? echo $path; ?>users/vendor.php"><i class="fa fa-angle-double-right"></i>Vendor</a></li>
                                <li<? if($page_active=="product-service/inventory/service"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/service.php"><i class="fa fa-angle-double-right"></i>Jasa</a></li>
                                <li<? if($page_active=="product-service/inventory/category-service"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/category-service.php"><i class="fa fa-angle-double-right"></i>Group Jasa</a></li>
                                <li<? if($page_active=="product-service/inventory/categorysub-service"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/categorysub-service.php"><i class="fa fa-angle-double-right"></i>Sub Group Jasa</a></li>
                                
                                <li<? if($page_active=="users/staff"){?> class="active"<? }?>><a href="<? echo $path; ?>users/staff.php"><i class="fa fa-angle-double-right"></i>Karyawan</a></li>
                                <li<? if($page_active=="users/education"){?> class="active"<? }?>><a href="<? echo $path; ?>users/education.php"><i class="fa fa-angle-double-right"></i>Pendidikan</a></li>
                                <li<? if($page_active=="users/position"){?> class="active"<? }?>><a href="<? echo $path; ?>users/position.php"><i class="fa fa-angle-double-right"></i>Jabatan</a></li>
                                
                                <li<? if($page_active=="users/customer"){?> class="active"<? }?>><a href="<? echo $path; ?>users/customer.php"><i class="fa fa-angle-double-right"></i>Customer</a></li>
                                <li<? if($page_active=="users/users-group"){?> class="active"<? }?>><a href="<? echo $path; ?>users/users-group.php"><i class="fa fa-angle-double-right"></i>Customer Group</a></li>
                                <li<? if($page_active=="product-service/inventory/motorcycle"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/motorcycle.php"><i class="fa fa-angle-double-right"></i>Kendaraan</a></li>
                                <li<? if($page_active=="product-service/inventory/motorcycle-type"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/motorcycle-type.php"><i class="fa fa-angle-double-right"></i>Tipe Kendaraan</a></li>
                                <li<? if($page_active=="product-service/inventory/motorcycle-model"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/motorcycle-model.php"><i class="fa fa-angle-double-right"></i>Model Kendaraan</a></li>
                                <li<? if($page_active=="product-service/inventory/color"){?> class="active"<? }?>><a href="<? echo $path; ?>product-service/inventory/color.php"><i class="fa fa-angle-double-right"></i>Warna</a></li>
                                <li<? if($page_active=="users/religion"){?> class="active"<? }?>><a href="<? echo $path; ?>users/religion.php"><i class="fa fa-angle-double-right"></i>Agama</a></li>
                                <li<? if($page_active=="users/city"){?> class="active"<? }?>><a href="<? echo $path; ?>users/city.php"><i class="fa fa-angle-double-right"></i>Kota</a></li>
<li<? if($page_active=="users/area"){?> class="active"<? }?>><a href="<? echo $path; ?>users/area.php"><i class="fa fa-angle-double-right"></i>Area</a></li>
                                <li<? if($page_active=="users/bank"){?> class="active"<? }?>><a href="<? echo $path; ?>users/bank.php"><i class="fa fa-angle-double-right"></i>Bank</a></li>
<li<? if($page_active=="users/author"){?> class="active"<? }?>><a href="<? echo $path; ?>users/author.php"><i class="fa fa-angle-double-right"></i>Otorisasi</a></li>                            </ul>

                        </li>
                        <? }?>
                        <? if($_SESSION['admin_password_sessi']=="super"){?>

                        <li class="treeview<? if($parent_active=="settings"){?> active<? }?>">

                            <a href="#" class="alink_excp">

                                <i class="fa fa-wrench"></i> <span>Pengaturan/Peralatan</span>

                                <i class="fa fa-angle-left pull-right"></i>

                            </a>

                            <ul class="treeview-menu">

                                <li<? if($page_active=="settings/company"){?> class="active"<? }?>><a href="<? echo $path; ?>salary/company-edit.php"><i class="fa fa-angle-double-right"></i>Info Perusahaan</a></li>
                                <li<? if($page_active=="settings/module"){?> class="active"<? }?>><a href="<? echo $path; ?>users/module.php"><i class="fa fa-angle-double-right"></i>Modul</a></li>
                                <li<? if($page_active=="settings/module-sub"){?> class="active"<? }?>><a href="<? echo $path; ?>users/module-sub.php"><i class="fa fa-angle-double-right"></i>Sub Modul</a></li>
                                <li<? if($page_active=="settings/users-level"){?> class="active"<? }?>><a href="<? echo $path; ?>users/users-level.php"><i class="fa fa-angle-double-right"></i>Users Level</a></li>
                                <li<? if($page_active=="settings/contact"){?> class="active"<? }?>><a href="<? echo $path; ?>users/contact.php"><i class="fa fa-angle-double-right"></i>Data User</a></li>

                            </ul>

                        </li>
                        <? }?>

                        

                    </ul>

                </section>

                <!-- /.sidebar -->

            </aside>