<?php

$hsl=$global->query_run("SELECT * FROM sms_letter");
if($hsl)
	if(mysqli_num_rows($hsl) > 0)
	{
	   while($bar=mysqli_fetch_array($hsl))
	   {
		   if($bar['sms_key'] == "reminder1")
		   {
			   $reminder1=trim($bar['sms_content']);
			  // $label1 = $bar['sms_label'];
		   }
		   else if($bar['sms_key'] == "reminder2")
		   {
			   $reminder2=trim($bar['sms_content']);
			   //$label2 = $bar['sms_label'];
		   }
		   else if($bar['sms_key'] == "reminder3")
		   {
			   $reminder3=trim($bar['sms_content']);
			   //$label3 = $bar['sms_label'];
		   }else if($bar['sms_key'] == "reminder4")
		   {
			   $reminder4=trim($bar['sms_content']);
			   //$label3 = $bar['sms_label'];
		   }
	   }
	}
	

//cek logs sms entry
$log=$global->query_run("SELECT * FROM sms_entry");
$arrtype=array("reminder1"=>"SMS booking sebelum 2 jam kedatangan","reminder2"=>"SMS Ucapan Terima kasih setelah 3 jam selesai servis","reminder3"=>"SMS Pengingat Servis setelah 44 hari dari waktu terakhir kedatangan","reminder4"=>"SMS Pengingat Servis setelah 60 hari dari waktu terakhir kedatangan");
$arrlog=array();
if($log)
	if(mysqli_num_rows($log) > 0)
	{
		while($bar=mysqli_fetch_array($log))
	    {
		  $put=	"No Polisi :".$bar['platno'].",Kode Pelanggan :".$bar['users_code'].",status :".$bar['sms_status'].",Keterangan :".$arrtype[$bar['sms_key']].",Tanggal :".$bar['postdate']."\n --------------------";
		  $arrlog[]= $put;		  
		  
	    }

	}
	
	$logs=implode("\n",$arrlog);
	
//lihat quota
$quota=0;

//nusa quota
$nusa=new nusasms("santirahayu_api","MGEX31f");
$arrquota=$nusa->cekKredit();
$quota = $arrquota['quota'].", sampai ".$arrquota['kadaluarsa'];
	
	
//cek status	
$arrstatus=array();

$st=$global->query_run("SELECT * FROM sms_key");	
if($st)
  if(mysqli_num_rows($st) > 0)
	{
		$a=1;
		while($bar=mysqli_fetch_array($st))
	    {
		  $arrstatus[$bar['name']] = $bar['status']; 
		  $a++;
		  
	    }

	}


	
	
	
//get keyword ahass1 dan ahass2
$info1=$global->query_run("SELECT name FROM sms_config WHERE id = 'ahass1'");
$info2=$global->query_run("SELECT name FROM sms_config WHERE id = 'ahass2'");
$info3=$global->query_run("SELECT name FROM sms_config WHERE id = 'user_email'");
$info4=$global->query_run("SELECT name FROM sms_config WHERE id = 'email_header'");
$info5=$global->query_run("SELECT name FROM sms_config WHERE id = 'server'");
$ahass1 = mysqli_fetch_row($info1)[0];
$ahass2 = mysqli_fetch_row($info2)[0];
$user_email = mysqli_fetch_row($info3)[0];
$email_header = mysqli_fetch_row($info4)[0];
$server = mysqli_fetch_row($info5)[0];

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")
	$server=str_replace("http","https",$server);
//cek log
$jumlogs=0;
$arr_daftarlogs=array();
$arr_daftarlogs_60=array();
$daftarlogs=$global->query_run("SELECT * FROM sms_log WHERE sms_key='reminder3' OR sms_key='reminder4'");
if($daftarlogs)
  if(mysqli_num_rows($daftarlogs) > 0)
	{
		$jumlogs = mysqli_num_rows($daftarlogs);
		while($bar=mysqli_fetch_array($daftarlogs))
	    {
		if($bar['sms_key'] == "reminder3")
		  $arr_daftarlogs[]=$bar;//cusid,platno,postdate
	    else if($bar['sms_key'] == "reminder4")
		  $arr_daftarlogs_60[]=$bar; 	
		  
	    }
		
	}


$jumsms_terkirim=0;
$arr_sms_terkirim=array();
$arrsms=$global->query_run("SELECT * FROM sms_log ORDER BY postdate DESC");	
$arrkey=array("reminder1"=>"2 jam sebelum servis","reminder2"=>"3 jam setelah servis","reminder3"=>"reminder 44 hari","reminder4"=>"reminder 60 hari");
if($arrsms)
  if(mysqli_num_rows($arrsms) > 0)
	{
		$jumsms_terkirim = mysqli_num_rows($arrsms);
		while($bar=mysqli_fetch_array($arrsms))
	    {
		   //id, sms_key, cusid, platno, postdate
		   $bar['sms_key'] = $arrkey[$bar['sms_key']];
		   $arr_sms_terkirim[]=$bar;
		  
	    }
		
	}	
	
//if Submit edit

if(isset($_POST['Submit']))
{

$reminder1=trim($_POST['sms_reminder1']);
$reminder2=trim($_POST['sms_reminder2']);
$reminder3=trim($_POST['sms_reminder3']);
$reminder4=trim($_POST['sms_reminder4']);

if(isset($_POST['status_r1']))
 $st_r1="on";
else
 $st_r1="off";	

if(isset($_POST['status_r2']))
 $st_r2="on";
else
 $st_r2="off";

if(isset($_POST['status_r3']))
 $st_r3="on";
else
 $st_r3="off";

if(isset($_POST['status_r4']))
 $st_r4="on";
else
 $st_r4="off";

$ahass1=$_POST['ahass1'];
$ahass2=$_POST['ahass2'];
$user_email=$_POST['user_email'];
$email_header=$_POST['email_header'];

$proses="no";
if(!empty($reminder1) && !empty($reminder2) && !empty($reminder3))
{
$tbl="sms_letter";
$tbl2="sms_key";
$tbl3="sms_config";
$global->db_update($tbl,array("sms_content"=>$reminder1),"sms_key = 'reminder1'");
$global->db_update($tbl,array("sms_content"=>$reminder2),"sms_key = 'reminder2'");
$global->db_update($tbl,array("sms_content"=>$reminder3),"sms_key = 'reminder3'");
$global->db_update($tbl,array("sms_content"=>$reminder4),"sms_key = 'reminder4'");

$global->db_update($tbl2,array("status"=>$st_r1),"name = 'reminder1'");
$global->db_update($tbl2,array("status"=>$st_r2),"name = 'reminder2'");
$global->db_update($tbl2,array("status"=>$st_r3),"name = 'reminder3'");
$global->db_update($tbl2,array("status"=>$st_r4),"name = 'reminder4'");

$global->db_update($tbl3,array("name"=>$ahass1),"id = 'ahass1'");
$global->db_update($tbl3,array("name"=>$ahass2),"id = 'ahass2'");
$global->db_update($tbl3,array("name"=>$user_email),"id = 'user_email'");
$global->db_update($tbl3,array("name"=>$email_header),"id = 'email_header'");

$proses="ok";
}
Header("location: sms.php?confirm=$proses&type=edit");

exit;

}


if(isset($_POST['download_r']))
{
//write excel and download after that
$phpExcel = new PHPExcel();
$phpExcel->setActiveSheetIndex(0);

$phpExcel->getActiveSheet()->setCellValue("A1","no");
$phpExcel->getActiveSheet()->setCellValue("B1","Plat No");
$phpExcel->getActiveSheet()->setCellValue("C1","Kode User");
$phpExcel->getActiveSheet()->setCellValue("D1","Tanggal");
$i=1;
if(count($arr_daftarlogs) > 0)
	foreach($arr_daftarlogs as $key=>$dat)
	{
		//cusid,platno,postdate
		$j=$i+1;
		$phpExcel->getActiveSheet()->setCellValue("A".$j,$i);
		$phpExcel->getActiveSheet()->setCellValue("B".$j,$dat['platno']);
		$phpExcel->getActiveSheet()->setCellValue("C".$j,$dat['cusid']);
		$phpExcel->getActiveSheet()->setCellValue("D".$j,$dat['postdate']);		
		
		$i++;
	}

$excelName="user_reminder_44_report_".date("d-m-y-H-i-s");
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $excelName . '.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');

exit;	
}

if(isset($_POST['download_r_60']))
{
//write excel and download after that
$phpExcel = new PHPExcel();
$phpExcel->setActiveSheetIndex(0);

$phpExcel->getActiveSheet()->setCellValue("A1","no");
$phpExcel->getActiveSheet()->setCellValue("B1","Plat No");
$phpExcel->getActiveSheet()->setCellValue("C1","Kode User");
$phpExcel->getActiveSheet()->setCellValue("D1","Tanggal");
$i=1;
if(count($arr_daftarlogs_60) > 0)
	foreach($arr_daftarlogs_60 as $key=>$dat)
	{
		//cusid,platno,postdate
		$j=$i+1;
		$phpExcel->getActiveSheet()->setCellValue("A".$j,$i);
		$phpExcel->getActiveSheet()->setCellValue("B".$j,$dat['platno']);
		$phpExcel->getActiveSheet()->setCellValue("C".$j,$dat['cusid']);
		$phpExcel->getActiveSheet()->setCellValue("D".$j,$dat['postdate']);		
		
		$i++;
	}

$excelName="user_reminder_60_report_".date("d-m-y-H-i-s");
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $excelName . '.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');

exit;	
}

if(isset($_POST['download_all_sms']))
{
		//write excel and download after that
		$phpExcel = new PHPExcel();
		$phpExcel->setActiveSheetIndex(0);
		//id, sms_key, cusid, platno, postdate
		$phpExcel->getActiveSheet()->setCellValue("A1","no");
		$phpExcel->getActiveSheet()->setCellValue("B1","Subject");
		$phpExcel->getActiveSheet()->setCellValue("C1","Plat No");
		$phpExcel->getActiveSheet()->setCellValue("D1","Kode User");
		$phpExcel->getActiveSheet()->setCellValue("E1","Tanggal");
		$i=1;
		if(count($arr_sms_terkirim) > 0)
			foreach($arr_sms_terkirim as $key=>$dat)
			{
				//cusid,platno,postdate
				$j=$i+1;
				$phpExcel->getActiveSheet()->setCellValue("A".$j,$i);
				$phpExcel->getActiveSheet()->setCellValue("B".$j,$dat['sms_key']);
				$phpExcel->getActiveSheet()->setCellValue("C".$j,$dat['platno']);
				$phpExcel->getActiveSheet()->setCellValue("D".$j,$dat['cusid']);
				$phpExcel->getActiveSheet()->setCellValue("E".$j,$dat['postdate']);				
				
				$i++;
			}

		$excelName="user_semua_sms_terkirim_report_".date("d-m-y-H-i-s");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $excelName . '.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
		ob_end_clean();
		$objWriter->save('php://output');	
exit;	
}	


if(isset($_POST['delete_r']))
{

if($global->db_delete("sms_log","1"))
{
	$proses="ok";
}else
{
	$proses="no";
}	
	
Header("location: sms.php?confirm=$proses&type=delete");
exit;	
}

?>