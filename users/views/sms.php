            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">                

                <!-- Content Header (Page header) -->

                <section class="content-header">

                   <h1>Pengaturan SMS</h1>

                    <ol class="breadcrumb">

                        <li><a href="<? echo $path; ?>index.php"><i class="fa fa-home"></i> Home</a></li>

                    </ol>

                </section>

                

                <? if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == "ok" && $_REQUEST['type'] == "edit"){?><div>&nbsp;</div><div class="alert alert-info alert-dismissible fade in" role="alert">

      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-success"></i> Perhatian!</h4>

      <p><strong>Selamat,Data berhasil diperbaharui!</strong></p>

    </div><? } else if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == "no" && $_REQUEST['type'] == "edit"){?>
	
	<div>&nbsp;</div><div class="alert alert-warning alert-dismissible fade in" role="alert">

      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-warning"></i> Perhatian!</h4>

      <p><strong>Kesalahan,Data Gagal diperbaharui!</strong></p>

    </div>
	
	<? } else if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == "ok" && $_REQUEST['type'] == "download"){?>
	<div>&nbsp;</div><div class="alert alert-info alert-dismissible fade in" role="alert">

      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-success"></i> Perhatian!</h4>

      <p><strong>Selamat,Daftar reminder 44 hari siap didownload!</strong></p>

    </div>
	<? } else if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == "no" && $_REQUEST['type'] == "download"){?>
      <div>&nbsp;</div><div class="alert alert-warning alert-dismissible fade in" role="alert">

      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-warning"></i> Perhatian!</h4>

      <p><strong>Gagal, mendownload Daftar reminder</strong></p>

    </div>
	<? } else if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == "ok" && $_REQUEST['type'] == "delete"){?>
	<div>&nbsp;</div><div class="alert alert-info alert-dismissible fade in" role="alert">

      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-success"></i> Perhatian!</h4>

      <p><strong>Selamat,Daftar reminder 44 hari berhasil dihapus</strong></p>

    </div>
	<? } else if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == "no" && $_REQUEST['type'] == "delete"){?>
  <div>&nbsp;</div><div class="alert alert-warning alert-dismissible fade in" role="alert">

      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4><i class="icon fa fa-warning"></i> Perhatian!</h4>

      <p><strong>Kesalahan,gagal menghapus daftar!</strong></p>

    </div>
	<? }?>
            <!-- Main content -->

                <section class="content">

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="box box-danger">

                            <div class="box-body table-responsive">

            <form action="sms.php" method="post" enctype="multipart/form-data" name="form" id="form">

<div>

    <p><strong><u>PPengaturan SMS: </u></strong></p>

    <div>&nbsp;</div>                           

     </div><!-- /.box-header -->

 


<div class="row clearfix">   
   <div class="col-md-12"><strong>SMS KEY WORDS yang bisa dipakai :</strong></div>
  
</div>
<div class="row clearfix">   
   <div class="col-md-3"><strong>[PLATNO] :</strong></div>
   <div class="col-md-9">No Polisi Pelanggan</div> 
</div>
<div class="row clearfix">   
   <div class="col-md-3"><strong>[AHASS1] :</strong></div>
   <div class="col-md-9">'<?php if(isset($ahass1)) echo $ahass1;?>'</div> 
</div>
<div class="row clearfix">   
   <div class="col-md-3"><strong>[AHASS2] :</strong></div>
   <div class="col-md-9">'<?php if(isset($ahass2)) echo $ahass2;?>'</div> 
</div>

<div class="row clearfix">   
   <div class="col-md-3"><strong>[UCODE] :</strong></div>
   <div class="col-md-9">Kode Pelanggan</div> 
</div>
<div class="row clearfix">   
   <div class="col-md-3"><strong>[UNAME] :</strong></div>
   <div class="col-md-9">Nama Pelanggan</div> 
</div>
<div class="row clearfix">   
   <div class="col-md-3"><strong>[UMAIL] :</strong></div>
   <div class="col-md-9">Alamat Email Pelanggan</div> 
</div>
<div class="row clearfix">   
   <div class="col-md-3"><strong>[UPHONE] :</strong></div>
   <div class="col-md-9">Nomor Mobile Pelanggan</div> 
</div>
<div class="row clearfix">   
   <div class="col-md-3"><strong>[UADDR] :</strong></div>
   <div class="col-md-9">Alamat Domisili Pelanggan</div> 
</div>
<div class="row clearfix">   
   <div class="col-md-3"><strong>[UREG] :</strong></div>
   <div class="col-md-9">Tanggal/Waktu Pelanggan terdaftar</div> 
</div>

<br><br>
<div class="row clearfix"> 
<div class="col-md-4"><strong>AHASS1 keyword</strong></div>
<input type="text" name="ahass1" id="ahass1" maxlength="50" placeholder="Nama Panjang Perusahaan" maxlength="50" value="<?php if(isset($ahass1)) echo $ahass1;?>" style="width:250px">
</div>

<div class="row clearfix"> 
<div class="col-md-4"><strong>AHASS2 keyword</strong></div>
<input type="text" name="ahass2" id="ahass2" maxlength="50" placeholder="Nama Pendek Perusahaan" maxlength="30" value="<?php if(isset($ahass2)) echo $ahass2;?>" style="width:250px">
</div>

<div class="row clearfix"> 
<div class="col-md-4"><strong>Email Pengguna</strong></div>
<input type="text" name="user_email" id="user_email" maxlength="50" placeholder="Alamat Email" maxlength="50" value="<?php if(isset($user_email)) echo $user_email;?>" style="width:250px">
</div>

<div class="row clearfix"> 
<div class="col-md-4"><strong>Email Header</strong></div>
<input type="text" name="email_header" id="email_header" maxlength="50" placeholder="Judul Header Email" maxlength="255" value="<?php if(isset($email_header)) echo $email_header;?>" style="width:300px">
</div>

<div class="row clearfix"> 
<div class="col-md-4"><strong>Status : 2 jam sebelum servis</strong></div>
<div class="col-md-8">
<?php  if(isset($arrstatus['reminder1']) && $arrstatus['reminder1'] == "on") {?>
<input type="checkbox" name="status_r1" id="status_r1"  checked />
<?php }else{?>
<input type="checkbox" name="status_r1" id="status_r1"  />
<?php  }?>
</div>
</div>

<div class="row clearfix">                                

  <div class="col-md-4"><strong>Surat Pemberitahuan (2 jam sebelum booking):</strong></div>

<div class="col-md-8">
<span id="long_r1"></span><br>
  <textarea name="sms_reminder1" cols="40" rows="5" class="textbox lastinedit" id="sms_reminder1">
  <?php
  if(isset($reminder1))
	  echo $reminder1;
  ?>
  </textarea>

</div>

</div>

<div class="row clearfix"> 
<div class="col-md-4"><strong>Status: 3 jam setelah servis </strong></div>
<div class="col-md-8">
<?php  if(isset($arrstatus['reminder2']) && $arrstatus['reminder2'] == "on") {?>
<input type="checkbox" name="status_r2" id="status_r2"  checked />
<?php }else{?>
<input type="checkbox" name="status_r2" id="status_r2"  />
<?php  }?>
</div>
</div>
<div class="row clearfix">                                

  <div class="col-md-4"><strong>Surat Pemberitahuan (3 jam setelah servis)::</strong></div>

<div class="col-md-8">
<span id="long_r2"></span><br>
  <textarea name="sms_reminder2" cols="40" rows="5" class="textbox lastinedit" id="sms_reminder2">
   <?php
  if(isset($reminder2))
	  echo $reminder2;
  ?></textarea>

</div>

</div>
<div class="row clearfix"> 
<div class="col-md-4"><strong>Status: 44 hari setelah terakhir servis </strong></div>
<div class="col-md-8">
<?php  if(isset($arrstatus['reminder3']) && $arrstatus['reminder3'] == "on") {?>
<input type="checkbox" name="status_r3" id="status_r3"  checked />
<?php }else{?>
<input type="checkbox" name="status_r3" id="status_r3"  />
<?php  }?>
</div>
</div>
<div class="row clearfix">                                

  <div class="col-md-4"><strong>Surat Pemberitahuan (44 hari setelah servis terakhir):</strong></div>

<div class="col-md-8">
  <span id="long_r3"></span><br>
  <textarea name="sms_reminder3" cols="40" rows="5" class="textbox lastinedit" id="sms_reminder3">
   <?php
  if(isset($reminder3))
	  echo $reminder3;
  ?></textarea>

</div>

</div>

<div class="row clearfix"> 
<div class="col-md-4"><strong>Status: 60 hari setelah terakhir servis </strong></div>
<div class="col-md-8">
<?php  if(isset($arrstatus['reminder4']) && $arrstatus['reminder4'] == "on") {?>
<input type="checkbox" name="status_r4" id="status_r4"  checked />
<?php }else{?>
<input type="checkbox" name="status_r4" id="status_r4"  />
<?php  }?>
</div>
</div>

<div class="row clearfix">                                

  <div class="col-md-4"><strong><? echo "Surat Pemberitahuan (60 hari setelah servis terakhir)"; ?>:</strong></div>

<div class="col-md-8">
  <span id="long_r4"></span><br>
  <textarea name="sms_reminder4" cols="40" rows="5" class="textbox lastinedit" id="sms_reminder4">
   <?php
  if(isset($reminder4))
	  echo $reminder4;
  ?></textarea>

</div>

</div>


<div class="clear">&nbsp;</div>

<div class="row clearfix">

<div class="col-md-4">&nbsp;</div>

<div class="col-md-8"><button name="Submit" class="btn btn-primary" id="Submitedit">Simpan Perubahan Data</button></div>

</div> 

</form>



<br></br>
<div class="row clearfix">  
 <div class="col-md-12"><h2>Pengiriman Manual SMS</div>
</div>

<div class="row clearfix"> 
 <div class="col-md-4"><strong>Tujuan SMS:</strong></div>
 <div class="col-md-8">
 <span id=""></span>
 <input type="number" name="tujuan_sms" id="tujuan_sms" maxlength="50" placeholder="62813456786">
 <input type="hidden" name="server" id="server" value="<?php if(isset($server)) echo $server;?>">
 </div>
</div>
<div class="row clearfix">                                

<div class="col-md-4"><strong>Pesan SMS:</strong></div>
<div class="col-md-8">
  <span id="long_pesan"></span>&nbsp;&nbsp;<span id="loading_pesan" style="color:green"></span><br><br>
  <textarea name="pesan_sms" cols="40" rows="5" class="textbox lastinedit" id="pesan_sms" maxlength="160">
  </textarea>
</div>

</div>

<div class="row clearfix">

<div class="col-md-4">&nbsp;</div>

<div class="col-md-8"><button name="sendsms" class="btn btn-primary" id="sendsms">Kirim Pesan SMS Anda Sekarang</button></div>

</div> 

<br><br>

<div class="row clearfix"> 
<div class="col-md-12"><h2>Download Reminder </h2><strong>Anda Mempunyai <u style="font-size:bigger"><?php if(isset($jumlogs)) echo $jumlogs;?></u> daftar pengguna dalam Reminder History</strong></div>
</div>

<div class="row clearfix">
<div class="col-md-3">
<form action="sms.php" method="post" enctype="multipart/form-data" name="form" id="form">
<button name="download_r" class="btn btn-success" id="download_r">Download Reminder 44 hari</button>
</form>
</div>
<div class="col-md-3">
<form action="sms.php" method="post" enctype="multipart/form-data" name="form" id="form">
<button name="download_r_60" class="btn btn-success" id="download_r_60">Download Reminder 60 hari</button>
</form>
</div>
<div class="col-md-3">
<form action="sms.php" method="post" enctype="multipart/form-data" name="form" id="form">
<button name="download_all_sms" class="btn btn-success" id="download_all_sms">Download Semua SMS Terkirim</button>
</form>
</div>
<div class="col-md-3">
<form action="sms.php" method="post" enctype="multipart/form-data" name="form" id="form">
<button name="delete_r" class="btn btn-danger" id="delete_r">Hapus semua Reminder</button>
</form>
</div>
</div> 


<br><br>
<div class="row clearfix">   
   <div class="col-md-12"><h2>LOG Antrian SMS <br>Quota Token SMS : <span id="quota"><?php 
    if(isset($quota))
	  echo $quota;
   ?></h2><strong>Akan terhapus otomatis setelah 24 jam dari waktu pengiriman</strong></div>
  
</div>

<div class="row clearfix">   
   <div class="col-md-12">
   <textarea name="sms_logs" cols="100%" rows="8" class="textbox lastinedit" >
   <?php
  if(isset($logs))
	  echo $logs;
  ?>
  </textarea>
   
   </div>
  
</div>



</div>

</div>

</div>

</div>

</section>

</aside><!-- /.right-side -->



