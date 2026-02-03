<?php
$site_lang = array(
/*
Site configuration
*/
'app_name'=>	'MAS PRO 1.0',
'site_name'=>	'PT. Chandra Nuansa Mandiri',
'currency'=>	'Rp. '
);

$err_lang = array(
/*
Error messages
*/
'err_msg1'=>	'Could not db_conect to the MySQL Server. Please check your db_conection setings.',
'err_msg2'=>	'There was a problem db_conecting to the selected database. Please check your db_conection setings.',
'err_msg3'=>	'The product table specified was not found in the selected database. Please check your setings.',
'err_msg4'=>	'There was a query error'
);

$msgform_lang = array(
/*
form messages
*/
'req_passwordold_useradmin'=>	'Please fill your Current admin_password',
'req_passwordnew_useradmin'=>	'Please fill your New admin_password',
'req_password_useradmin'=>	'Sorry, wrong username or password!',
'redundant_useradmin'=>	'Redundant User admin_password.',
'req_numeric'=>	'Please type a number only!',
'cfrm_remove'=>	'Anda sungguh-sungguh mau menghapus data dari Database?',
'cfrm_process'=>	'Anda sungguh-sungguh mau melanjutkan proses transaksi ini?',
'blocked_remove'=>	'Transaksi ini tidak bisa di ganti. Gantilah dalam Modul yang terkait.',
'date_invalid'=>	'Format tanggal salah.',
'data_invalid'=>	'Data belum lengkap!.'
);

$menu_lang = array(
/*
menu
*/
'home'=>	'Home',
'dashboard'=>	'Menu Utama',
'book'=>	'Akutansi',
'asset_fixed'=>	'Inventaris',
'payreceivable'=>	'Utang & Piutang',
'goods_service'=>	'Barang & Jasa',
'users'=>	'Kontak',
'project'=> 'Proyek',
'koperasi'=> 'Koperasi',
'trade'=> 'Dagang',
'product_order'=> 'Dagang',  
'cash'=> 'Kas & Bank',  
'settings'=> 'Settings',
'counters'=> 'Counters',
);

$form_header_lang = array(
/*
form header
*/
'login'=>	'Administration Login',
'logout'=>	'Administration Logout',
'login_btn'=>	'Login',
'logout_btn'=>	'Logout',
'logout_kop'=>	'Logout',
'return_kop'=>	'Kembali',
'add_new_kop'=>	'Tambah',
'edit_kop'=>	'Ganti',
'search_kop'=>	'Cari',
'confirm_kop'=>	'Konfirmasi',
'delete_kop'=>	'Hapus',
'return_state'=>	'Tekan tombol &quot;Kembali&quot; di bawah ini, untuk kembali ke halaman sebelumnya.',
'confirm_state1'=>	'Anda telah sukses ',
'confirm_state2'=>	' di Database.',
'add_new_button'=>	'Tambah Data',
'delete_button'=>	'Hapus Data',
'edit_button'=>	'Edit Data',
'edit_popup_button'=>	'Edit & Pakai',
'cancell_button'=>	'Batal Proses',
'process_button'=>	'Proses Data',
'save_button'=>	'Simpan Data',
'book_close_button'=>	'Tutup Buku',
'pageset_of'=>	'Dari',
'period'=>	'Periode',
'print'=>	'Cetak',
'close'=>	'Tutup',
'month'=>	'bulan',
'details'=>	'Rincian',
'amount'=>	'Jumlah',
'briefing'=>	'Uraian',
'balance'=>	'Saldo',
'unit'=>	'Satuan',
'date_input'=>	'Tanggal',
'date_input_start'=>	'Dari Tanggal',
'date_input_end'=>	'Sampai Tanggal',
'trs_btn'=>	'Transaksi',
'rsc_btn'=>	'Reschedule',
'taxonomy_trs_pay'=>	'Rekening Pembayaran',
'csv'=>	'Export CSV',
'profit_balance'=>	'Total Laba',
'notice'=>	'Perhatian!',
'balance_first'=>	'Saldo Awal',
'action'=>	'Perintah',
'company_edit'=>	'Info Perusahaan',
);

$form_label_lang = array(
/*
form label
*/
'admin_username'=>	'Username',
'admin_password'=>	'Password',
'company_name'=>	'Nama Perusahaan',
'company_phone'=>	'Tlf. Perusahaan',
'company_address'=>	'Alamat',
'main_dealer_code'=>	'Kode Dealer',
'dealer_code'=>	'Kode AHASS',
'ex_main_dealer_code'=>	'Kode Ex. Dealer',
'company_pit'=>	'Jumlah PIT',
'company_work_in'=>	'Jam Kerja',
'company_work_out'=>	'Jam Pulang',
'company_break_in'=>	'Jam Istirahat',
'company_break_out'=>	'Selesai Istirahat',
'company_alfa_pinalty'=>	'Denda Alfa',
'company_target_unit_entry'=>	'Target UE',
'company_target_service'=>	'Target Penjualan Jasa',
'company_target_product'=>	'Target Penjualan Part',
'company_insentif_no_alfa'=>	'Insentif Tidak Alfa',
'company_insentif_bonus'=>	'Bonus Pencapaian',
'company_city'=>	'Kabupaten',
'company_stock_process'=>	'Manual Stok Proses',
'company_stock_block'=>	'Auto Stok Blok',
'company_font'=>	'Font Style',
'company_font_size'=>	'Font Size',
'company_paper'=>	'Jenis Kertas',
'product_fee_percent'=>	'Komisi Part (%)',
'service_fee_percent'=>	'Komisi Jasa (%)',
'company_bank'=>	'Nama Bank',
'company_bank_no'=>	'No. Rekening Bank',
'company_bank_id'=>	'Nama Rekening Bank',
'company_bank2'=>	'Nama Bank 2',
'company_bank2_no'=>	'No. Rekening Bank 2',
'company_bank2_id'=>	'Nama Rekening Bank 2',
);

$form_selectlist_lang = array(
/*
form selectlist
*/
'bolean'=>	array(
				array("0","Ya"),
				array("1","Tidak")
				),
'province'=>	array(
				array("Bali","Bali"),
				),
'salary_target_type'=>	array(
				array("ue","Unit Entry"),
				array("product","Part"),
				array("service","Jasa"),
				),
'warehouse_type'=>	array(
				array("pos","Default"),
				array("main","Induk"),
				array("branch","POS/Cabang"),
				),
'warehouse_stock_status'=>	array(
				array("tmp","Pending"),
				array("approved","Approved"),
				array("pmn","Diproses"),
				),
'warehouse_stock_category'=>	array(
				array("buy","Pembelian"),
				array("sale","Penjualan"),
				array("buy_retur","Retur Pembelian"),
				array("sale_retur","Retur Penjualan"),
				array("sale_svc","Service"),
				array("trs_in","Transfer Masuk"),
				array("trs_out","Transfer Keluar"),
				array("trs","Stock Transfer"),
				array("opname","Stock Opname"),
				),
'service_order_express'=>	array(
				array("0","Regular"),
				array("1","Express"),
				array("2","Reminder"),
				array("3","Visit"),
				array("4","Event"),
				),
'service_order_reason'=>	array(
				array("remember","Ingat Sendiri"),
				array("reminder","Reminder SMS"),
				),
'service_order_usersowner_rel'=>	array(
				array("owner","Pemilik"),
				array("family","Saudara"),
				array("staff","Karyawan"),
				),
'absence_status'=>	array(
				array("work","Masuk"),
				array("permission","Izin"),
				array("sick","Sakit"),
				array("alfa","Alfa"),
				array("holiday","Libur"),
				),
'area_range'=>	array(
				array("1","1"),
				array("2","2"),
				array("3","3"),
				array("4","4"),
				),
'service_order_status'=>	array(
				array("sa","SA"),
				array("tmp","MENUNGGU"),
				array("process","PROSES"),
				array("pause","PAUSE"),
				array("unpaid","SELESAI"),
				array("pmn","BAYAR"),
				array("cancel","BATAL"),
				),
'staff_status'=>	array(
				array("tetap","Tetap"),
				array("kontrak","Kontrak"),
				),
'gender'=>	array(
				array("laki","Laki"),
				array("perempuan","Perempuan"),
				),
'motorcycle_type_model'=>	array(
				array("MATIC","Matic"),
				array("CUB","CUB"),
				array("SPORT","Sport"),
				),
'motorcycle_type_level'=>	array(
				array("MID","MID"),
				),
'service_time_type'=>	array(
				array("MENIT","Menit"),
				array("JAM","Jam"),
				array("HARI","Hari"),
				array("BULAN","Bulan"),
				),
'users_type'=>	array(
				array("member","Tetap"),
				array("candidate","Calon"),
				array("customer","Pelanggan"),
				array("supplier","Suplier/Mitra"),
				array("employee","Pegawai"),
				array("debitur","Debitur"),
				array("vendor","Vendor"),
				),
'users_status'=>	array(
				array("male","Laki"),
				array("female","Perempuan"),
				array("company","Instansi/Perusahaan")
				),
'users_trs_type'=>	array(
				array("principal","Simpanan Pokok"),
				array("closed","Tutup Anggota"),
				array("obligator","Simpanan Wajib"),
				array("voluntary","Simpanan Sukarela"),
				),
'taxonomy_special_type'=>	array(
				array("cash","Kas"),
				array("bank","Piutang Bank"),
				array("loan","Piutang Pinjaman"),
				array("trade","Piutang Dagang"),
				array("receivable","Piutang Umum"),
				array("good","Piutang Barang"),
				array("loan_payable","Utang Pinjaman"),
				array("trade_payable","Utang Dagang"),
				array("savings_payable","Utang Tabungan"),
				array("deposit_payable","Utang Deposito"),
				array("bank_payable","Utang Bank"),
				array("payable","Utang Umum"),
				array("expense_payable","Utang Biaya"),
				array("principal","Simpanan Pokok"),
				array("obligator","Simpanan Wajib"),
				array("voluntary","Simpanan Sukarela"),
				array("income_admin","Pendapatan Administrasi"),
				array("income_provicy","Pendapatan Provisi"),
				array("income_other","Pendapatan Lain Pinjaman"),
				array("income_loan_interest","Pendapatan Bunga Pinjaman"),
				array("income_loan_pinalty","Pendapatan Pinalti"),
				array("income_trade","Pendapatan Penjualan"),
				array("expense_trade","Biaya Pembelian"),
				array("stock_trade","Persediaan Barang Dagangan"),
				array("asset_inventory","Inventaris"),
				array("expense_depreciation","Biaya Penyusutan Inventaris"),
				array("accom_depreciation","Akumulasi Penyusutan Inventaris"),
				array("expense_admin","Biaya Administrasi"),
				array("expense_operational","Biaya Operasional"),
				array("expense_meeting","Biaya Rapat"),
				array("expense_salary","Biaya Gaji"),
				array("expense_other","Biaya Lain-Lain"),
				array("dividen_capital","Jasa Simpanan"),
				array("dividen_loan","Jasa Usaha Pinjaman"),
				array("dividen_loan_bank","Jasa Usaha Pinjaman Bank"),
				array("dividen_sale","Jasa Usaha Dagang"),
				),
'loan_interest_type'=>	array(
				array("flat","Tetap"),
				array("efectif","Menurun"),
				),
'loan_trs_type'=>	array(
				array("disbursement","Pencairan"),
				array("installment","Angsuran"),
				array("closed","Tutup"),
				array("compen","Kompen"),
				),
'loan_status'=>	array(
				array("all","none","Semua Status"),
				array(0,"active","Aktif"),
				array(30,"attention","Perhatian"),
				array(90,"problem","Bermasalah"),
				array("unl","bad","Macet"),
				),
'loan_product_risk'=>	array(
				array("0","Tidak"),
				array("1","Ya")
				),
'asset_fixed_depreciation_type'=>	array(
				array("Straightline","Garis Lurus"),
				),
'savings_product_ratetype'=>	array(
				array("min_balance","Saldo Terendah"),
				),
'savings_product_contract'=>	array(
				array("0","Biasa"),
				array("1","Berjangka"),
				),
'savings_trs_type'=>	array(
				array(11,"Setoran Tunai","D"),
				array(51,"Penarikan Tunai","K"),
				array(14,"Bunga Tabungan","D"),
				array(57,"Biaya-Biaya","K"),
				array(12,"Setoran Transfer","D"),
				array(22,"Saldo Pindahan","D"),
				array(33,"Saldo Awal","D"),
				),
'asset_fixed_type'=>	array(
				array("asset_inventory","Inventaris Kantor"),
				array("building_inventory","Inventaris Bangunan"),
				array("car_inventory","Inventaris Kendaraan"),
				),
);

$glob_lang = array(
'site_lang'=> $site_lang,
'err_lang'=> $err_lang,
'msgform_lang'=> $msgform_lang,
'menu_lang'=> $menu_lang,
'form_header_lang'=> $form_header_lang,
'form_label_lang'=> $form_label_lang,
'form_selectlist_lang'=> $form_selectlist_lang
);
?>