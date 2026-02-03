<script>
$(function(){
	//alert('sms test');
	var s1=$('#sms_reminder1').val();
	$('#long_r1').html('karakter : '+s1.length);
	
	$('#sms_reminder1').on('keyup',function(){
	var s1=$('#sms_reminder1').val();
	$('#long_r1').html('karakter : '+s1.length);		
	})
	
	var s2=$('#sms_reminder2').val();
	$('#long_r2').html('karakter : '+s2.length);
	
	$('#sms_reminder2').on('keyup',function(){
	var s2=$('#sms_reminder2').val();
	$('#long_r2').html('karakter : '+s2.length);		
	})
	
	var s3=$('#sms_reminder3').val();
	$('#long_r3').html('karakter : '+s3.length);
	
	$('#sms_reminder3').on('keyup',function(){
	var s3=$('#sms_reminder3').val();
	$('#long_r3').html('karakter : '+s3.length);		
	})
	
	var s4=$('#sms_reminder4').val();
	$('#long_r4').html('karakter : '+s4.length);
	
	$('#sms_reminder4').on('keyup',function(){
	var s4=$('#sms_reminder4').val();
	$('#long_r4').html('karakter : '+s4.length);		
	})
	
	
	
	var s5=$('#pesan_sms').val();
	$('#long_pesan').html('karakter : '+s5.length);
	$('#pesan_sms').on('keyup',function(){
	var s5=$('#pesan_sms').val();
	$('#long_pesan').html('karakter : '+s5.length);		
	})
	
	
	
	$('#sendsms').on('click',function(){
	  var pesan = $('#pesan_sms').val();
	  var tujuan = $('#tujuan_sms').val();
	  var server=$('#server').val();	  
      
	  if(tujuan != '' && tujuan.length > 10)
	  {
		  if(pesan != '' && pesan.length > 10)
		 {
		     sendSMS(pesan,tujuan,server);
		 }else
		 {
		  alert('Mohon isi pesan SMS anda (min 10 karakter), 1 SMS tidak lebih dari 160 karakter!');
		 }
		  
	  }else
	  {
		  alert('Mohon isi alamat tujuan yang benar!');
	  }
	  
     	  
		
	})
	
})


function sendSMS(pesan,tujuan,server)
{
	
	
		var server=server;	
		var dataString="tujuan="+tujuan+"&pesan="+pesan;
		
		$.ajax({
		type: "POST",
		url:server + "sendSMS.php?callback=?",
		timeout:50000,
		data: dataString,
		crossDomain: true,
		cache: false,
		beforeSend: function(){
			
		$('#loading_pesan').html('SMS sedang diproses');
					
		},
		success: function(data){
		
	     if(data.status == "ok")
		  {		          
			$('#loading_pesan').html('');
              alert(data.pesan);			
		  }else
		  {			
			$('#loading_pesan').html('');
			alert(data.pesan);
		  }	  
		  
		},
		error : function(err)
		{
		 $('#loading_pesan').html('error');
		},
		dataType:"jsonp"
		});
}


</script>