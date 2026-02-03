$(document).ready(function(){
$("#product_id").change(function(){
	var id=$(this).val();
	var dataString = 'id='+ id;
	$.ajax({
		type: "POST",
		url: "../ajax/ajax_product.php",
		data: dataString,
		cache: false,
		success: function(html){
		$("#product_qtyunit_id").html(html);
		} 
		});
	});
});

$(document).ready(function(){
$("#product_qtyunit_id").change(function(){
	var id=$(this).val();
	var dataString = 'id='+ id;
	
	$.ajax({
		type: "POST",
		url: "../ajax/ajax_product_qtyunit.php",
		data: dataString,
		cache: false,
		success: function(html){
		$('#product_orderdetails_price').val(html);
		} 
		});
	});
});