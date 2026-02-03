/** product list **/
/* product list insert */
function product_order_sale() {
	var confirm_show=false;
	var confirm_txt="";
	//if product_sprice change
	var product_orderdetails_price =$('#product_orderdetails_price').val();
	var product_orderdetails_sprice_hidden =parseFloat($('#product_orderdetails_sprice_hidden').val());
	var product_orderdetails_bprice_hidden =parseFloat($('#product_orderdetails_bprice_hidden').val());
	product_orderdetails_price=parseFloat(product_orderdetails_price.replace(/,/g, ""));
	//confirm(product_orderdetails_price+"-"+product_orderdetails_sprice_hidden+"-"+product_orderdetails_bprice_hidden)
	var kpb_product_yesno_hidden =$('#kpb_product_yesno_hidden').val();
	if(product_orderdetails_price < product_orderdetails_bprice_hidden && kpb_product_yesno_hidden==0){
		confirm_txt="Harga jual lebih kecil dari harga beli. Lanjutkan proses?";
		confirm_show=true;
		update_master=0;
		}
	else if(product_orderdetails_price!=product_orderdetails_sprice_hidden && kpb_product_yesno_hidden==0){
		confirm_txt="Harga jual berubah, Update Harga di Master Data?";
		confirm_show=true;
		update_master=1;
		}
	if(confirm_show){
		if(confirm(confirm_txt)){
		gen_product_order_sale_list(update_master);
		}else{
			if(update_master==1){
			gen_product_order_sale_list();
			}else{
			return false;
			}
		  }
	}else{
		gen_product_order_sale_list();
	  }
};

/* product list insert */
function gen_product_order_sale_list(update_master) {
	if (update_master === undefined) {
        update_master = 0;
    	}
	//get input val
	var product_scode =$('#product_scode').val();
	var product_orderdetails_price =$('#product_orderdetails_price').val();
	var product_orderdetails_bprice_hidden =$('#product_orderdetails_bprice_hidden').val();
	var product_orderdetails_quantity =$('#product_orderdetails_quantity').val();
	var product_orderdetails_subtotal =$('#product_orderdetails_subtotal').val();
	var value=product_orderdetails_price.replace(/,/g, "");
	var value2=product_orderdetails_quantity.replace(/,/g, "");
	var product_orderdetails_subtotal_val=product_orderdetails_subtotal.replace(/,/g, "");
	
	var product_orderdetails_discount =$('#product_orderdetails_discount').val();
	var product_orderdetails_discount_val =$('#product_orderdetails_discount_val').val();
	var product_orderdetails_tax =$('#product_orderdetails_tax').val();
	var product_orderdetails_discount_unf=product_orderdetails_discount.replace(/,/g, "");
	var product_orderdetails_discount_val_unf=product_orderdetails_discount_val.replace(/,/g, "");
	var product_orderdetails_tax_unf=product_orderdetails_tax.replace(/,/g, "");
	
	var product_shtquantity_hidden =$('#product_shtquantity_hidden').val();
	var product_spoquantity_hidden =$('#product_spoquantity_hidden').val();
	var product_quantity_hidden =$('#product_quantity_hidden').val();
	var product_bpoquantity_hidden =$('#product_bpoquantity_hidden').val();
	var kpb_product_yesno_hidden =$('#kpb_product_yesno_hidden').val();
	
	var list = $('.dyn_product_order_sale');
	
	var html = '<tr>';
    html +='<td class="listnum_product_order_sale">#</td>';
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_scode">'+product_scode+'</div><input name="product_scode_hidden[]" type="hidden" value="'+product_scode+'"/><input name="kpb_product_yesno_hidden[]" type="hidden" value="'+kpb_product_yesno_hidden+'"/></a></td>';
    html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_price">'+product_orderdetails_price+'</div><input name="product_orderdetails_price_hidden[]" type="hidden" value="'+value+'"/><input name="product_orderdetails_bprice_hidden[]" type="hidden" value="'+product_orderdetails_bprice_hidden+'"/></a></td>';
    html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_quantity">'+product_orderdetails_quantity+'</div><input name="product_orderdetails_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
    
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount">'+product_orderdetails_discount+'</div><input name="product_orderdetails_discount_hidden[]" type="hidden" value="'+product_orderdetails_discount_unf+'"/></a></td>';
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount_val">'+product_orderdetails_discount_val+'</div><input name="product_orderdetails_discount_val_hidden[]" type="hidden" value="'+product_orderdetails_discount_val_unf+'"/></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_tax">'+product_orderdetails_tax+'</div><input name="product_orderdetails_tax_hidden[]" type="hidden" value="'+product_orderdetails_tax_unf+'"/></a></td>';
	
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_subtotal">'+product_orderdetails_subtotal+'</div><input class="subtotal_hidden" name="product_orderdetails_subtotal_hidden[]" type="hidden" value="'+product_orderdetails_subtotal_val+'"/></a></td>';
	
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_shtquantity">'+product_shtquantity_hidden+'</div></a></td>';
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_spoquantity">'+product_spoquantity_hidden+'</div></a></td>';
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_quantity">'+product_quantity_hidden+'</div></a></td>';
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_bpoquantity">'+product_bpoquantity_hidden+'</div></a></td>';

	
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_product_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_product_order_sale").append($());
	calc_service_order_sale();
	//clear input
	$('.typehead_product #product_scode').typeahead('val', '');
	$('#product_orderdetails_price').val("");
	$('#product_orderdetails_bprice_hidden').val("");
	$('#product_orderdetails_quantity').val("");
	$('#product_orderdetails_subtotal').val("");
	$('#product_orderdetails_discount').val("");
	$('#product_orderdetails_discount_val').val("");
	$('#product_orderdetails_tax').val("");
	
	$("span.product_shtquantity").html('');
	$("span.product_spoquantity").html('');
	$("span.product_quantity").html('');
	$("span.product_bpoquantity").html('');
	
	$("#product_scode").focus();
	
	//master data update or not
	var product_scode_arr=product_scode.split(" - ");
	var product_code = product_scode_arr[0];
	if(update_master==1){
			$.ajax({
			type:"POST",
			url:"../inventory/ajax/product-master-edit.php?product_code="+product_code+"&product_orderdetails_price="+value,
			success: function(response){
			}
			});
		}
};

/* on product_order_sale keyup */
$(function () {
	$('.product_order_sale').on('change', function () {
        var value = $("#product_orderdetails_price").val();
        var value2 = $("#product_orderdetails_quantity").val();
		var disc_value = $("#product_orderdetails_discount_val").val();
		value=value.replace(/,/g, "");
		value2=value2.replace(/,/g, "");
		disc_value=disc_value.replace(/,/g, "");
        var total = (value-disc_value) * value2;
        $("#product_orderdetails_subtotal").val(total.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

$(function () {
	$('.product_order_sale').on('keyup', function () {
        var pdisc = $("#product_orderdetails_discount").val();
        var pprice = $("#product_orderdetails_price").val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#product_orderdetails_discount_val").val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

/* on product_orderdetails_discount_val keyup */
$(function () {
	$('#product_orderdetails_discount_val').on('keyup', function () {
		var pdisc_val = $("#product_orderdetails_discount_val").val();
        var pprice = $("#product_orderdetails_price").val();
		pdisc_val=pdisc_val.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_percent = (pdisc_val/pprice)*100;
        $("#product_orderdetails_discount").val(disc_percent.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

/* on product_order_sale_total keyup */
$(function () {
	$('.product_order_sale_total').on('keyup', function () {
        calc_service_order_sale();
	})
})

/* product_order_sale_cal */
function product_order_sale_cal() {
    var grandTotal = 0;
    $(this).closest('table').find('tr').each(function() {
        var row = $(this);
        var value = $( "#product_orderdetails_price", row ).val();
        var value2 = $( "#product_orderdetails_quantity", row ).val();
        var total = value * value2;
        grandTotal += total;
        $( "#product_orderdetails_subtotal", row ).val( '$' + total.toFixed(2) );
		//$("#product_orderdetails_total").html( '<strong>' + value + '</strong>');
    });
}

/* product list remove */
function remove_product_order_sale(el) {
	   var deletable=$(el).closest('tr').find("input[name='kpb_product_yesno_hidden[]']").val();
	   if(deletable==1){
	   alert("Tidak Bisa Dihapus, Part Terkait KPB 1");
	   }else{
	   $(el).closest('tr').remove();
	   $("#product_scode").focus();
	   calc_service_order_sale();
	   }
   }
   
/* on service_scode enter */
$('#product_scode').on('change', function (e) {
	var scode = $(this).val();
	$('#product_ov_flw').find('div.clear').attr('class', 'clear hidden-xs hidden-sm hidden-md hidden-lg');
	pscode_onchange(scode);
});

/* on product_scode exec */
function pscode_onchange(scode) {
	var service_order_id = $('#service_order_id').val();
	$('#myloading').fadeIn(500);
	$.ajax({
	type: "POST",        
	url: "../inventory/ajax/product-getcode.php?scode="+scode,
	cache: false,
	async : true,
	dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
	success: function(data){
	if(data['product_id'] == 0){
		alert("Kode Salah");
		$('#myloading').fadeOut(500);
		$('.typehead_product #product_scode').typeahead('val', '');
		$("#product_scode").focus();
	}else{
		var product_name=data['product_name'];
		var product_sprice=data['product_sprice'];
		var product_bprice=data['product_bprice'];
		var product_shtquantity=data['product_stock_ht'];
		var product_spoquantity=data['product_stock_so'];
		var product_quantity=data['product_stock'];
		var product_bpoquantity=data['product_stock_po'];
		var product_scode=data['product_code']+' - '+product_name;
		//cek if already on list
		if(product_on_list_exist(scode)){
			alert("Maaf Item Sudah Masuk List");
			$('#myloading').fadeOut(500);
			$('.typehead_product #product_scode').typeahead('val', '');
			$("#product_scode").focus();
			}else{
			//ready stock cek
			var ready_stock=product_quantity-product_spoquantity;
			if(ready_stock < 1 && data['company_stock_block']==1){
			alert("Maaf Stok Tidak Mencukupi");
			$('#myloading').fadeOut(500);
			$('.typehead_product #product_scode').typeahead('val', '');
			$("#product_scode").focus();
			}else{
			$('.typehead_product #product_scode').typeahead('val', product_scode);
			$("#product_orderdetails_price").val(product_sprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
			$("#product_orderdetails_sprice_hidden").val(product_sprice);
			$("#product_orderdetails_bprice_hidden").val(product_bprice);
			$("#product_shtquantity_hidden").val(product_shtquantity);
			$("span.product_shtquantity").html(product_shtquantity);
			$("#product_spoquantity_hidden").val(product_spoquantity);
			$("span.product_spoquantity").html(product_spoquantity);
			$("#product_quantity_hidden").val(product_quantity);
			$("span.product_quantity").html(product_quantity);
			$("#product_bpoquantity_hidden").val(product_bpoquantity);
			$("span.product_bpoquantity").html(product_bpoquantity);
			//$("#product_orderdetails_quantity").focus();
			$("#product_orderdetails_quantity").val(1);
			$("#product_orderdetails_discount").val(0);
			$("#product_orderdetails_discount_val").val(0.00);
			$("#kpb_product_yesno_hidden").val(0);
			$("#product_orderdetails_subtotal").val(product_sprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
			$("#product_orderdetails_quantity").focus();
			var e1 = jQuery.Event("keydown");
			e1.which = 13; // # Some key code value
			//$("input#product_orderdetails_discount_val").trigger(e1);
		}}}
	$('#myloading').fadeOut(500);
	}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* on product_scode keyup */
$('#product_scode').on('keyup', function (e) {
	var input = $.trim( $(this).val() );
     if( input == "" ) {
        $('#product_ov_flw').find('div.clear').attr('class', 'clear hidden-xs hidden-sm hidden-md hidden-lg');
     }else{
		$('#product_ov_flw').find('div.clear').attr('class', 'clear hidden-sm hidden-md hidden-lg');
	 }
});

/* product list edit modal */
$(function () {
var myModal = $('#myModal');
$('.product_order_sale_edit_details2', myModal).click(function () {
$('.ajax_loader', myModal).show();
	var confirm_show=false;
	var confirm_txt="";
	//if product_sprice change
	var product_orderdetails_price =$('#product_orderdetails_price', myModal).val();
	var product_orderdetails_sprice_hidden =$('#product_orderdetails_sprice_hidden', myModal).val();
	var product_orderdetails_bprice_hidden =$('#product_orderdetails_bprice_hidden', myModal).val();
	product_orderdetails_price=parseFloat(product_orderdetails_price.replace(/,/g, ""));
	product_orderdetails_sprice_hidden=parseFloat(product_orderdetails_sprice_hidden.replace(/,/g, ""));
	product_orderdetails_bprice_hidden=parseFloat(product_orderdetails_bprice_hidden.replace(/,/g, ""));
	//confirm(product_orderdetails_price+"-"+product_orderdetails_sprice_hidden+"-"+product_orderdetails_bprice_hidden)
	var kpb_product_yesno_hidden =$('#kpb_product_yesno_hidden', myModal).val();
	if(product_orderdetails_price < product_orderdetails_bprice_hidden && kpb_product_yesno_hidden==0){
		confirm_txt="Harga jual lebih kecil dari harga beli. Lanjutkan proses?";
		confirm_show=true;
		update_master=0;
		}
	else if(product_orderdetails_price!=product_orderdetails_sprice_hidden && kpb_product_yesno_hidden==0){
		confirm_txt="Harga jual berubah, Update Harga di Master Data?";
		confirm_show=true;
		update_master=1;
		}
	if(confirm_show){
		if(confirm(confirm_txt)){
		gen_product_order_sale_editlist(update_master);
		}else{
			if(update_master==1){
			gen_product_order_sale_editlist();
			}else{
			return false;
			}
		  }
	}else{
		gen_product_order_sale_editlist();
	  }
});	
});


/* product list edit */
function gen_product_order_sale_editlist(update_master) {
	if (update_master === undefined) {
        update_master = 0;
    	}
	var myModal = $('#myModal');
	var product_scode = $('#product_scode', myModal).val();
	var product_orderdetails_price = $('#product_orderdetails_price', myModal).val();
	var product_orderdetails_sprice_hidden = $('#product_orderdetails_sprice_hidden', myModal).val();
	var product_orderdetails_bprice_hidden = $('#product_orderdetails_bprice_hidden', myModal).val();
	var product_orderdetails_quantity = $('#product_orderdetails_quantity', myModal).val();
	
	var product_orderdetails_discount =$('#product_orderdetails_discount', myModal).val();
	var product_orderdetails_discount_val =$('#product_orderdetails_discount_val', myModal).val();
	var product_orderdetails_tax =$('#product_orderdetails_tax', myModal).val();
	var product_orderdetails_discount_unf=product_orderdetails_discount.replace(/,/g, "");
	var product_orderdetails_discount_val_unf=product_orderdetails_discount_val.replace(/,/g, "");
	var product_orderdetails_tax_unf=product_orderdetails_tax.replace(/,/g, "");
	
	var value=product_orderdetails_price.replace(/,/g, "");
	var value2=product_orderdetails_quantity.replace(/,/g, "");
	var product_orderdetails_subtotal_val = (value-product_orderdetails_discount_unf) * value2;
	var product_orderdetails_subtotal=product_orderdetails_subtotal_val.toLocaleString('en-US', {minimumFractionDigits: 2});
	var inner_id = $('#inner_id_hidden', myModal).val();
	
	var product_shtquantity_hidden =$('#product_shtquantity_hidden', myModal).val();
	var product_spoquantity_hidden =$('#product_spoquantity_hidden', myModal).val();
	var product_quantity_hidden =$('#product_quantity_hidden', myModal).val();
	var product_bpoquantity_hidden =$('#product_bpoquantity_hidden', myModal).val();
	var service_order_id =$('#service_order_id', myModal).val();
	var product_orderdetails_quantityold_hidden =0;
	if(service_order_id>0){
	product_orderdetails_quantityold_hidden = $('#product_orderdetails_quantityold_hidden', myModal).val();
	}
	var kpb_product_yesno_hidden =$('#kpb_product_yesno_hidden', myModal).val();
	
	//ready stock cek
	var ready_stock=product_quantity_hidden-product_spoquantity_hidden-(product_orderdetails_quantity-product_orderdetails_quantityold_hidden);
	if(ready_stock < 0 && company_stock_block==1){
	alert("Maaf Stok Tidak Mencukupi");
	$('.ajax_loader', myModal).hide();
	$('#myModal').modal('hide');
	}else{
	
		
		// Add the new barcode entry to the list of barcodes
		var list = $('#'+inner_id);
		
		var html ='<td class="listnum_product_order_sale">#</td>';
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_scode">'+product_scode+'</div><input name="product_scode_hidden[]" type="hidden" value="'+product_scode+'"/><input name="kpb_product_yesno_hidden[]" type="hidden" value="'+kpb_product_yesno_hidden+'"/></a></td>';
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_price">'+product_orderdetails_price+'</div><input name="product_orderdetails_price_hidden[]" type="hidden" value="'+value+'"/><input name="product_orderdetails_bprice_hidden[]" type="hidden" value="'+product_orderdetails_bprice_hidden+'"/></a></td>';
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_quantity">'+product_orderdetails_quantity+'</div><input name="product_orderdetails_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
		
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount">'+product_orderdetails_discount+'</div><input name="product_orderdetails_discount_hidden[]" type="hidden" value="'+product_orderdetails_discount_unf+'"/></a></td>';
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount_val">'+product_orderdetails_discount_val+'</div><input name="product_orderdetails_discount_val_hidden[]" type="hidden" value="'+product_orderdetails_discount_val_unf+'"/></a></td>';
		html +='<td class="td_hide"><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_tax">'+product_orderdetails_tax+'</div><input name="product_orderdetails_tax_hidden[]" type="hidden" value="'+product_orderdetails_tax_unf+'"/></a></td>';
		
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_subtotal">'+product_orderdetails_subtotal+'</div><input class="subtotal_hidden" name="product_orderdetails_subtotal_hidden[]" type="hidden" value="'+product_orderdetails_subtotal_val+'"/></a></td>';
		
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_shtquantity">'+product_shtquantity_hidden+'</div></a></td>';
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_spoquantity">'+product_spoquantity_hidden+'</div></a></td>';
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_quantity">'+product_quantity_hidden+'</div></a></td>';
		html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_bpoquantity">'+product_bpoquantity_hidden+'</div></a></td>';
	
		
		html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_product_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
		
		//clear old
		//create new
		$('#'+inner_id).first().html($(html));
		$('.ajax_loader', myModal).hide();
		calc_service_order_sale();
		
		$('#myModal').modal('hide');
	
		//master data update or not
		var product_scode_arr=product_scode.split(" - ");
		var product_code = product_scode_arr[0];
		if(update_master==1){
				$.ajax({
				type:"POST",
				url:"../inventory/ajax/product-master-edit.php?product_code="+product_code+"&product_orderdetails_price="+value,
				success: function(response){
				}
				});
			}
		}
};

/* product list edit submit modal */
$(function () {
$('.dyn_product_order_sale').on('click', 'a.product_order_sale_edit', function () {
    var myModal = $('#myModal');

    // now get the values from the table
	var product_id = $(this).closest('tr').find("input[name='product_scode_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var product_orderdetails_price = $(this).closest('tr').find("div.product_orderdetails_price").html();
	var product_orderdetails_bprice_hidden = $(this).closest('tr').find("input[name='product_orderdetails_bprice_hidden[]']").val();
	var product_orderdetails_quantity = $(this).closest('tr').find("div.product_orderdetails_quantity").html();
	var product_orderdetails_discount = $(this).closest('tr').find("div.product_orderdetails_discount").html();
	var product_orderdetails_discount_val = $(this).closest('tr').find("div.product_orderdetails_discount_val").html();
	var product_orderdetails_tax = $(this).closest('tr').find("div.product_orderdetails_tax").html();
	
	var product_shtquantity = $(this).closest('tr').find("div.product_shtquantity").html();
	var product_spoquantity = $(this).closest('tr').find("div.product_spoquantity").html();
	var product_quantity = $(this).closest('tr').find("div.product_quantity").html();
	var product_bpoquantity = $(this).closest('tr').find("div.product_bpoquantity").html();
	var product_orderdetails_quantityold_hidden = product_orderdetails_quantity;
	var kpb_product_yesno_hidden = $(this).closest('tr').find("input[name='kpb_product_yesno_hidden[]']").val();

    // and set them in the modal:
	$('#product_scode', myModal).val(product_id);
	$('#product_orderdetails_price', myModal).val(product_orderdetails_price);
	$('#product_orderdetails_sprice_hidden', myModal).val(product_orderdetails_price);
	$('#product_orderdetails_bprice_hidden', myModal).val(product_orderdetails_bprice_hidden);
	$('#product_orderdetails_quantity', myModal).val(product_orderdetails_quantity);
	$('#product_orderdetails_discount', myModal).val(product_orderdetails_discount);
	$('#product_orderdetails_discount_val', myModal).val(product_orderdetails_discount_val);
	$('#product_orderdetails_tax', myModal).val(product_orderdetails_tax);
	$('#inner_id_hidden', myModal).val(inner_id);
	$('#product_shtquantity_hidden', myModal).val(product_shtquantity);
	$('#product_spoquantity_hidden', myModal).val(product_spoquantity);
	$('#product_quantity_hidden', myModal).val(product_quantity);
	$('#product_bpoquantity_hidden', myModal).val(product_bpoquantity);
	$('#product_orderdetails_quantityold_hidden', myModal).val(product_orderdetails_quantityold_hidden);
	$('#kpb_product_yesno_hidden', myModal).val(kpb_product_yesno_hidden);
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$(".auto_foc").keydown(function(event) {
    if(event.which == 13) { //Enter
    event.preventDefault();
	$(".auto_foc_trg").focus();
		return false;
		}
	});
	
	$('#product_orderdetails_price', myModal).on('keyup', function () {
        var pdisc = $("#product_orderdetails_discount", myModal).val();
        var pprice = $("#product_orderdetails_price", myModal).val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#product_orderdetails_discount_val", myModal).val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
	
	$('#product_orderdetails_discount', myModal).on('keyup', function () {
        var pdisc = $("#product_orderdetails_discount", myModal).val();
        var pprice = $("#product_orderdetails_price", myModal).val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#product_orderdetails_discount_val", myModal).val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
	
	$('#product_orderdetails_discount_val', myModal).on('keyup', function () {
        var pdisc_val = $("#product_orderdetails_discount_val", myModal).val();
        var pprice = $("#product_orderdetails_price", myModal).val();
		pdisc_val=pdisc_val.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_percent = (pdisc_val/pprice)*100;
        $("#product_orderdetails_discount", myModal).val(disc_percent.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
	
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
});
});

/** service list **/
/* service list insert */
function service_order_sale() {
	//get input val
	var service_scode =$('#service_scode').val();
	var service_orderdetails_price =$('#service_orderdetails_price').val();
	var service_orderdetails_bprice_hidden =$('#service_orderdetails_bprice_hidden').val();
	var service_orderdetails_quantity =$('#service_orderdetails_quantity').val();
	var service_orderdetails_subtotal =$('#service_orderdetails_subtotal').val();
	var value=service_orderdetails_price.replace(/,/g, "");
	var value2=service_orderdetails_quantity.replace(/,/g, "");
	var service_orderdetails_subtotal_val=service_orderdetails_subtotal.replace(/,/g, "");
	
	var service_orderdetails_discount =$('#service_orderdetails_discount').val();
	var service_orderdetails_discount_val =$('#service_orderdetails_discount_val').val();
	var service_orderdetails_tax =$('#service_orderdetails_tax').val();
	var service_orderdetails_discount_unf=service_orderdetails_discount.replace(/,/g, "");
	var service_orderdetails_discount_val_unf=service_orderdetails_discount_val.replace(/,/g, "");
	var service_orderdetails_tax_unf=service_orderdetails_tax.replace(/,/g, "");
	
	var service_shtquantity_hidden =$('#service_shtquantity_hidden').val();
	var service_spoquantity_hidden =$('#service_spoquantity_hidden').val();
	var service_quantity_hidden =$('#service_quantity_hidden').val();
	var service_bpoquantity_hidden =$('#service_bpoquantity_hidden').val();
	var kpb_service_yesno_hidden =$('#kpb_service_yesno_hidden').val();
	
	var list = $('.dyn_service_order_sale');
	
	var html = '<tr>';
    html +='<td class="listnum_service_order_sale">#</td>';
	html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_scode">'+service_scode+'</div><input name="service_scode_hidden[]" type="hidden" value="'+service_scode+'"/><input name="kpb_service_yesno_hidden[]" type="hidden" value="'+kpb_service_yesno_hidden+'"/></a></td>';
    html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_price">'+service_orderdetails_price+'</div><input name="service_orderdetails_price_hidden[]" type="hidden" value="'+value+'"/><input name="service_orderdetails_bprice_hidden[]" type="hidden" value="'+service_orderdetails_bprice_hidden+'"/></a></td>';
    html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_quantity">'+service_orderdetails_quantity+'</div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
    
	html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount">'+service_orderdetails_discount+'</div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="'+service_orderdetails_discount_unf+'"/></a></td>';
	html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount_val">'+service_orderdetails_discount_val+'</div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="'+service_orderdetails_discount_val_unf+'"/></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_tax">'+service_orderdetails_tax+'</div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="'+service_orderdetails_tax_unf+'"/></a></td>';
	
	html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_subtotal">'+service_orderdetails_subtotal+'</div><input class="service_subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="'+service_orderdetails_subtotal_val+'"/></a></td>';
	
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_shtquantity">'+service_shtquantity_hidden+'</div></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_spoquantity">'+service_spoquantity_hidden+'</div></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_quantity">'+service_quantity_hidden+'</div></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_bpoquantity">'+service_bpoquantity_hidden+'</div></a></td>';

	
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_service_order_sale").append($());
	calc_service_order_sale();
	//clear input
	$('.typehead_service #service_scode').typeahead('val', '');
	$('#service_orderdetails_price').val("");
	$('#service_orderdetails_bprice_hidden').val("");
	$('#service_orderdetails_quantity').val("");
	$('#service_orderdetails_subtotal').val("");
	$('#service_orderdetails_discount').val("");
	$('#service_orderdetails_discount_val').val("");
	$('#service_orderdetails_tax').val("");
	
	$("span.service_shtquantity").html('');
	$("span.service_spoquantity").html('');
	$("span.service_quantity").html('');
	$("span.service_bpoquantity").html('');
	
	$("#service_scode").focus();
};

/* on service_order_sale keyup */
$(function () {
	$('.service_order_sale').on('keyup', function () {
        var value = $("#service_orderdetails_price").val();
        var value2 = $("#service_orderdetails_quantity").val();
		var disc_value = $("#service_orderdetails_discount_val").val();
		value=value.replace(/,/g, "");
		value2=value2.replace(/,/g, "");
		disc_value=disc_value.replace(/,/g, "");
        var total = (value-disc_value) * value2;
        $("#service_orderdetails_subtotal").val(total.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

/* on service_order_sale_total keyup */
$(function () {
	$('.service_order_sale_total').on('keyup', function () {
        calc_service_order_sale();
	})
})

/* on service_orderdetails_discount keyup */
$(function () {
	$('#service_orderdetails_discount').on('keyup', function () {
        var pdisc = $("#service_orderdetails_discount").val();
        var pprice = $("#service_orderdetails_price").val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#service_orderdetails_discount_val").val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

/* on service_orderdetails_discount_val keyup */
$(function () {
	$('#service_orderdetails_discount_val').on('keyup', function () {
        var pdisc_val = $("#service_orderdetails_discount_val").val();
        var pprice = $("#service_orderdetails_price").val();
		pdisc_val=pdisc_val.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_percent = (pdisc_val/pprice)*100;
        $("#service_orderdetails_discount").val(disc_percent.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

/* on service_order_discount_val keyup */
$(function () {
	$('#service_order_discount_val').on('keyup', function () {
        var pdisc = $("#service_order_discount").val();
		pdisc = parseFloat(pdisc) || 0;
		//if ( pdisc == '' ) pdisc = 0;
		var pdisc_val = $("#service_order_discount_val").val();
		pdisc_val=pdisc_val.replace(/,/g, "");
        var pdisc_val_hidden = $("#service_order_discount_val_hidden").val();
		pdisc_val_hidden = parseFloat(pdisc_val_hidden) || 0;
		//if ( pdisc_val_hidden == '' ) pdisc_val_hidden = 0;
		var service_orderdetails_total = (pdisc_val_hidden/pdisc)*100;
		if(pdisc_val_hidden==0){
		service_orderdetails_total=$("#service_orderdetails_total_hidden").val();
		}
		var pdisc_new = (pdisc_val/service_orderdetails_total)*100;
		pdisc_new = parseFloat(pdisc_new) || 0;
        $("#service_order_discount").val(pdisc_new.toLocaleString('en-US', {minimumFractionDigits: 2}));
		calc_service_order_sale(1);
	})
})     

/* service_order_sale_cal */
function service_order_sale_cal() {
    var grandTotal = 0;
    $(this).closest('table').find('tr').each(function() {
        var row = $(this);
        var value = $( "#service_orderdetails_price", row ).val();
        var value2 = $( "#service_orderdetails_quantity", row ).val();
        var total = value * value2;
        grandTotal += total;
        $( "#service_orderdetails_subtotal", row ).val( '$' + total.toFixed(2) );
		//$("#service_orderdetails_total").html( '<strong>' + value + '</strong>');
    });
}

/* service list remove */
function remove_service_order_sale(el) {
	   var main_deletable=$(el).closest('tr').find("input[name='kpb_service_yesno_hidden[]']").val();
	   if(main_deletable==1){
	   //loop & remove oli kpb
	   $('.subtotal_hidden').each(function (index, element) {
		   var deletable=$(this).closest('tr').find("input[name='kpb_product_yesno_hidden[]']").val();
	   	   if(deletable==1){
		   $(this).closest('tr').remove();
		   }
		   })
	   }
	   $(el).closest('tr').remove();
	   $("#service_scode").focus();
	   calc_service_order_sale();
   }

/* on service_scode enter */
$('#service_scode').on('change', function (e) {
	var scode = $(this).val();
	$('#service_ov_flw').find('div.clear').attr('class', 'clear hidden-xs hidden-sm hidden-md hidden-lg');
	service_scode_onchange(scode);
});

/* on service_scode exec */
function service_scode_onchange(scode) {
	var service_order_id = $('#service_order_id').val();
	$('#myloading').fadeIn(500);		
	
	$.ajax({
	type: "POST",        
	url: "../inventory/ajax/service-getcode.php?scode="+scode,
	cache: false,
	async : true,
	dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
	success: function(data){
	if(data['service_id'] == 0){
	alert("Kode Salah");
	$('#myloading').fadeOut(500);
	$('.typehead_service #service_scode').typeahead('val', '');
	}else{
	var service_name=data['service_name'];
	var service_sprice=data['service_sprice'];
	var service_bprice=data['service_bprice'];
	var service_shtquantity=0;
	var service_spoquantity=0;
	var service_quantity=0;
	var service_bpoquantity=0;
	var category_code=data['category_code'];
	//cek if already on list
	if(service_on_list_exist(scode)){
		alert("Maaf Item Sudah Masuk List");
		$('#myloading').fadeOut(500);
		$('.typehead_service #service_scode').typeahead('val', '');
		$("#service_scode").focus();
		}else{
	$("#service_orderdetails_price").val(service_sprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
	$("#service_orderdetails_bprice_hidden").val(service_bprice);
	$("#service_shtquantity_hidden").val(service_shtquantity);
	$("span.service_shtquantity").html(service_shtquantity);
	$("#service_spoquantity_hidden").val(service_spoquantity);
	$("span.service_spoquantity").html(service_spoquantity);
	$("#service_quantity_hidden").val(service_quantity);
	$("span.service_quantity").html(service_quantity);
	$("#service_bpoquantity_hidden").val(service_bpoquantity);
	$("span.service_bpoquantity").html(service_bpoquantity);
	//$("#service_orderdetails_quantity").focus();
	$("#service_orderdetails_quantity").val(1);
	$("#service_orderdetails_discount").val(0);
	$("#service_orderdetails_discount_val").val(0.00);
	$("#kpb_service_yesno_hidden").val(0);
	if(category_code === 'ASS1' || category_code === 'ASS2' || category_code === 'ASS3' || category_code === 'ASS4'){
	$("#kpb_service_yesno_hidden").val(1);
	//check if motorcycle_code not empty
	var motorcycle_code = $('#motorcycle_code').val();
	if(motorcycle_code === undefined || motorcycle_code === null || motorcycle_code === ''){
	alert("No. Polisi Kososng");
	$("#motorcycle_code").focus();
	$('#myloading').fadeOut(500);
	$('.typehead_service #service_scode').typeahead('val', '');
	}else{
	//myModalkpb show
	var myModal = $('#myModalkpb');
	//set var hidden service ke-
	var kpb_online_num = category_code.replace("ASS", "");
	$('#kpb_online_num', myModal).val(kpb_online_num);
	//call ajax and populate modal
	var motorcycle_code_arr=motorcycle_code.split(" - ");
	var motorcycle_code_val = motorcycle_code_arr[0];
	$.ajax({
	type: "POST",        
	url: "../inventory/ajax/motorcycle-isexist.php?motorcycle_code_val="+motorcycle_code_val,
	cache: false,
	async : true,
	dataType: 'json',
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
	success: function(data2){
		if(0 == 0){
			if($.trim($('#motorcycle_type_code').val()) == '' || $.trim($('#motorcycle_machine_no').val()) == '' || $.trim($('#motorcycle_buy_register').val()) == '' || $.trim($('#motorcycle_book_service_no').val()) == ''){
				$('.typehead_service #service_scode').typeahead('val', '');
				$("#service_orderdetails_price").val('');
				$("#service_orderdetails_quantity").val('');
				$("#service_orderdetails_discount").val('');
				$("#service_orderdetails_discount_val").val('');
				alert('Data KPB belum lengkap.');
				$("#motorcycle_type_code").focus();
				}else{
				var motorcycle_type_code = $('#motorcycle_type_code').val();
				var motorcycle_code = $('#motorcycle_code').val();
				$.ajax({ 
				type: "POST", 
				url: "../inventory/motorcycle-kpb-get.php?motorcycle_type_code="+motorcycle_type_code+"&kpb_online_num="+kpb_online_num, 
				cache: false,
				async : true,
				dataType: 'json',
				error: function(xhr){
				alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
				$('#myloading').fadeOut(500);
				},
				success: function (data3) { 
					if(data3['motorcycle_type_code'] == 0){
						$('.typehead_service #service_scode').typeahead('val', '');
						$("#service_orderdetails_price").val('');
						$("#service_orderdetails_quantity").val('');
						$("#service_orderdetails_discount").val('');
						$("#service_orderdetails_discount_val").val('');
						alert('Data Type Kendaraan Salah.');
						$("#motorcycle_type_code").focus();
					}else{
						var product_code=data3['product_code'];
						var motorcycle_type_oil_service_bprice=data3['motorcycle_type_oil_service_bprice'];
						var motorcycle_model_oil_service_sprice=data3['motorcycle_model_oil_service_sprice'];
						var motorcycle_type_kpb_service_sprice=data3['motorcycle_type_kpb_service_sprice'];
						//if KPB 1 create list product related
						if(kpb_online_num ==1){
							$("#product_scode").val(product_code);
							$("#product_orderdetails_price").val(motorcycle_model_oil_service_sprice);
							$("#product_orderdetails_bprice_hidden").val(motorcycle_type_oil_service_bprice);
							$("#product_orderdetails_quantity").val(1);
							$("#product_orderdetails_discount").val(0);
							$("#product_orderdetails_discount_val").val(0);
							$("#kpb_product_yesno_hidden").val(1);
							var e1 = jQuery.Event("keydown");
							e1.which = 13; // # Some key code value
							$("input#product_orderdetails_discount_val").trigger(e1);
							}
						//create list service
						$("#service_orderdetails_price").val(motorcycle_type_kpb_service_sprice);
						service_order_sale();
						}
					$('#myloading').fadeOut(500);
				}
				});
				// Return false to prevent the browser from processing the enter keypress
				return false;
				}
			}
		$('#myloading').fadeOut(500);
		}
		});
	}
	}else{
	//var e0 = jQuery.Event("keyup");
	var e1 = jQuery.Event("keydown");
	e1.which = 13; // # Some key code value
	//$("input#service_orderdetails_discount").trigger(e0);
	$("input#service_orderdetails_discount_val").trigger(e1);
	//$("#service_orderdetails_price").val(10);
	}
	$('#myloading').fadeOut(500);
	}}}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* on service_scode keyup */
$('#service_scode').on('keyup', function (e) {
	var input = $.trim( $(this).val() );
     if( input == "" ) {
        $('#service_ov_flw').find('div.clear').attr('class', 'clear hidden-xs hidden-sm hidden-md hidden-lg');
     }else{
		$('#service_ov_flw').find('div.clear').attr('class', 'clear hidden-sm hidden-md hidden-lg');
	 }
});

/* kpb_online edit modal */
$(function () {
var myModal = $('#myModalkpb');
//$('.btn_kpb_edit', myModal).click(function () {
$('#form_kpb', myModal).submit(function (e) {
	e.preventDefault();
	$('.ajax_loader', myModal).show();
	var e1 = jQuery.Event("keydown");
	e1.which = 13; // # Some key code value
	//get input
	var motorcycle_code = $('#motorcycle_code').val();
	var form=$("#form_kpb");
	var kpb_online_num= $('#kpb_online_num', myModal).val();
	var motorcycle_type_code = $('#motorcycle_type_code_kpb', myModal).val();
	//call ajax update data & return data
	$.ajax({
        type:"POST",
        url:"../inventory/motorcycle-kpb-update.php?motorcycle_code="+motorcycle_code,
        data:form.serialize(),
        success: function(response){
            console.log(response);
			var data_arr=response.split(";");
			//get oli code
			if(data_arr[4]!=""){
			var product_code=data_arr[0];
			var motorcycle_type_oil_service_bprice=data_arr[1];
			var motorcycle_type_oil_service_sprice=data_arr[2];
			var motorcycle_type_kpb_service_sprice=data_arr[3];
			//if KPB 1 create list product related
			if(kpb_online_num ==1){
				$("#product_scode").val(product_code);
				$("#product_orderdetails_price").val(motorcycle_type_oil_service_sprice);
				$("#product_orderdetails_bprice_hidden").val(motorcycle_type_oil_service_bprice);
				$("#product_orderdetails_quantity").val(1);
				$("#product_orderdetails_discount").val(0);
				$("#product_orderdetails_discount_val").val(0);
				$("#kpb_product_yesno_hidden").val(1);
				$("input#product_orderdetails_discount_val").trigger(e1);
				}
			//create list service
			$("#service_orderdetails_price").val(motorcycle_type_kpb_service_sprice);
			service_order_sale();		
			$('.ajax_loader', myModal).hide();
			$('#myModalkpb').modal('hide');
			}else{
				alert("Tipe Kendaraan Salah.");
				$("#motorcycle_type_code_kpb", myModal).focus();
				$('.ajax_loader', myModal).hide();
				} 
        }
    });
	});
});

/* on motorcycle_buy_register change */
$(function () {
$('#motorcycle_buy_register').change(function () {
	var motorcycle_buy_register = $(this).val();
	motorcycle_buy_register_onchange(motorcycle_buy_register);
	// Return false to prevent the browser from processing the enter keypress
	return false;
	});
});

/* on service_scode exec */
function motorcycle_buy_register_onchange(motorcycle_buy_register) {
	var date_service = $('#date_register').val();
	$('#myloading').fadeIn(500);		
	$.ajax({
	type: "POST",        
	url: "../inventory/kpb-daterange-get.php?date_service="+date_service+"&motorcycle_buy_register="+motorcycle_buy_register,
	cache: false,
	async : true,
	dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
	success: function(data){
	$("span#motorcycle_numdays").html(data);
	$('#myloading').fadeOut(500);
	}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* on motorcycle_buy_register change modal */
$(function () {
var myModal = $('#myModalkpb');
$('#motorcycle_buy_register', myModal).change(function () {
	var date_service = $('#date_register').val();
	var motorcycle_buy_register = $(this).val();
	$('#myloading').fadeIn(500);	
	$.ajax({
	type: "POST",        
	url: "../inventory/kpb-daterange-get.php?date_service="+date_service+"&motorcycle_buy_register="+motorcycle_buy_register,
	cache: false,
	async : true,
	dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
	success: function(data){
	$("span#motorcycle_numdays", myModal).html(data);
	$('#myloading').fadeOut(500);
	}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
	});
});
   
/* service list edit modal */
$(function () {
var myModal = $('#myModalservice');
$('.service_order_sale_edit_details2', myModal).click(function () {
$('.ajax_loader', myModal).show();
var service_scode = $('#service_scode', myModal).val();
var service_orderdetails_price = $('#service_orderdetails_price', myModal).val();
var service_orderdetails_bprice_hidden = $('#service_orderdetails_bprice_hidden', myModal).val();
var service_orderdetails_quantity = $('#service_orderdetails_quantity', myModal).val();

var service_orderdetails_discount =$('#service_orderdetails_discount', myModal).val();
var service_orderdetails_discount_val =$('#service_orderdetails_discount_val', myModal).val();
var service_orderdetails_tax =$('#service_orderdetails_tax', myModal).val();
var service_orderdetails_discount_unf=service_orderdetails_discount.replace(/,/g, "");
var service_orderdetails_discount_val_unf=service_orderdetails_discount_val.replace(/,/g, "");
var service_orderdetails_tax_unf=service_orderdetails_tax.replace(/,/g, "");

var value=service_orderdetails_price.replace(/,/g, "");
var value2=service_orderdetails_quantity.replace(/,/g, "");
var service_orderdetails_subtotal_val = (value-service_orderdetails_discount_unf) * value2;
var service_orderdetails_subtotal=service_orderdetails_subtotal_val.toLocaleString('en-US', {minimumFractionDigits: 2});
var inner_id = $('#inner_id_hidden', myModal).val();

var service_shtquantity_hidden =$('#service_shtquantity_hidden', myModal).val();
var service_spoquantity_hidden =$('#service_spoquantity_hidden', myModal).val();
var service_quantity_hidden =$('#service_quantity_hidden', myModal).val();
var service_bpoquantity_hidden =$('#service_bpoquantity_hidden', myModal).val();
var kpb_service_yesno_hidden =$('#kpb_service_yesno_hidden', myModal).val();
	
	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	
	var html ='<td class="listnum_service_order_sale">#</td>';
    html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_scode">'+service_scode+'</div><input name="service_scode_hidden[]" type="hidden" value="'+service_scode+'"/><input name="kpb_service_yesno_hidden[]" type="hidden" value="'+kpb_service_yesno_hidden+'"/></a></td>';
    html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_price">'+service_orderdetails_price+'</div><input name="service_orderdetails_price_hidden[]" type="hidden" value="'+value+'"/><input name="service_orderdetails_bprice_hidden[]" type="hidden" value="'+service_orderdetails_bprice_hidden+'"/></a></td>';
    html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_quantity">'+service_orderdetails_quantity+'</div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
    
	html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount">'+service_orderdetails_discount+'</div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="'+service_orderdetails_discount_unf+'"/></a></td>';
	html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount_val">'+service_orderdetails_discount_val+'</div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="'+service_orderdetails_discount_val_unf+'"/></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_tax">'+service_orderdetails_tax+'</div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="'+service_orderdetails_tax_unf+'"/></a></td>';
	
	html +='<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_subtotal">'+service_orderdetails_subtotal+'</div><input class="service_subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="'+service_orderdetails_subtotal_val+'"/></a></td>';
	
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_shtquantity">'+service_shtquantity_hidden+'</div></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_spoquantity">'+service_spoquantity_hidden+'</div></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_quantity">'+service_quantity_hidden+'</div></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_bpoquantity">'+service_bpoquantity_hidden+'</div></a></td>';

	
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	
	//clear old
	//create new
	$('#'+inner_id).first().html($(html));
	$('.ajax_loader', myModal).hide();
	calc_service_order_sale();
	$('#myModalservice').modal('hide');
	});
	
});

/* service list edit submit modal */
$(function () {
$('.dyn_service_order_sale').on('click', 'a.service_order_sale_edit', function () {
    var myModal = $('#myModalservice');

    // now get the values from the table
	var service_id = $(this).closest('tr').find("input[name='service_scode_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var service_orderdetails_price = $(this).closest('tr').find("div.service_orderdetails_price").html();
	var service_orderdetails_bprice_hidden = $(this).closest('tr').find("input[name='service_orderdetails_bprice_hidden[]']").val();
	var service_orderdetails_quantity = $(this).closest('tr').find("div.service_orderdetails_quantity").html();
	var service_orderdetails_discount = $(this).closest('tr').find("div.service_orderdetails_discount").html();
	var service_orderdetails_discount_val = $(this).closest('tr').find("div.service_orderdetails_discount_val").html();
	var service_orderdetails_tax = $(this).closest('tr').find("div.service_orderdetails_tax").html();
	
	var service_shtquantity = $(this).closest('tr').find("div.service_shtquantity").html();
	var service_spoquantity = $(this).closest('tr').find("div.service_spoquantity").html();
	var service_quantity = $(this).closest('tr').find("div.service_quantity").html();
	var service_bpoquantity = $(this).closest('tr').find("div.service_bpoquantity").html();
	var kpb_service_yesno_hidden = $(this).closest('tr').find("input[name='kpb_service_yesno_hidden[]']").val();

    // and set them in the modal:
	$('#service_scode', myModal).val(service_id);
	$('#service_orderdetails_price', myModal).val(service_orderdetails_price);
	$('#service_orderdetails_bprice_hidden', myModal).val(service_orderdetails_bprice_hidden);
	$('#service_orderdetails_quantity', myModal).val(service_orderdetails_quantity);
	$('#service_orderdetails_discount', myModal).val(service_orderdetails_discount);
	$('#service_orderdetails_discount_val', myModal).val(service_orderdetails_discount_val);
	$('#service_orderdetails_tax', myModal).val(service_orderdetails_tax);
	$('#inner_id_hidden', myModal).val(inner_id);
	$('#service_shtquantity_hidden', myModal).val(service_shtquantity);
	$('#service_spoquantity_hidden', myModal).val(service_spoquantity);
	$('#service_quantity_hidden', myModal).val(service_quantity);
	$('#service_bpoquantity_hidden', myModal).val(service_bpoquantity);
	$('#kpb_service_yesno_hidden', myModal).val(kpb_service_yesno_hidden);
	
	$(".auto_foc").keydown(function(event) {
    if(event.which == 13) { //Enter
    event.preventDefault();
	$(".auto_foc_trg").focus();
		return false;
		}
	});
	
	$('#service_orderdetails_price', myModal).on('keyup', function () {
        var pdisc = $("#service_orderdetails_discount", myModal).val();
        var pprice = $("#service_orderdetails_price", myModal).val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#service_orderdetails_discount_val", myModal).val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
	
	$('#service_orderdetails_discount', myModal).on('keyup', function () {
        var pdisc = $("#service_orderdetails_discount", myModal).val();
        var pprice = $("#service_orderdetails_price", myModal).val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#service_orderdetails_discount_val", myModal).val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
	
	$('#service_orderdetails_discount_val', myModal).on('keyup', function () {
        var pdisc_val = $("#service_orderdetails_discount_val", myModal).val();
        var pprice = $("#service_orderdetails_price", myModal).val();
		pdisc_val=pdisc_val.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_percent = (pdisc_val/pprice)*100;
        $("#service_orderdetails_discount", myModal).val(disc_percent.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
	
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
});
});

/** service order **/
/* service order calculator */
function calc_service_order_sale(vnon) {
	   	if (vnon == undefined) vnon=0;
		var grandtotal = 0;
		var tax_total = 0;
		var disc_final_total = 0;
		var profittotal = 0;
		var stock_trade = 0;
		var profittotal_product = 0;
		var profittotal_service = 0;
		var kpb_service_tot = 0;
		var kpb_product_tot = 0;
		var service_order_discount_kpb = 0;
		var service_order_tax_kpb = 0;
		var income_trade_kpb = 0;
		var stock_trade_kpb = 0;
		var income_service_kpb = 0;
		
    	//list num 1
		$('.service_subtotal_hidden').each(function (index, element) {
			var num_list=index+1;
			$(this).closest('tr').find('td.listnum_service_order_sale').html(num_list+".");
			$(this).closest('tr').attr("id","service_inner"+num_list);
			//get disc final
			var disc_final = $("#service_order_discount").val();
			//get tax
			var ptax = $(this).closest('tr').find("input[name='service_orderdetails_tax_hidden[]']").val();
			//get current sub total
			var value = $(this).closest('tr').find("input[name='service_orderdetails_price_hidden[]']").val();
			var value2 = $(this).closest('tr').find("input[name='service_orderdetails_quantity_hidden[]']").val();
			var disc_value = $(this).closest('tr').find("input[name='service_orderdetails_discount_val_hidden[]']").val();
			//get profit
			var service_orderdetails_bprice = $(this).closest('tr').find("input[name='service_orderdetails_bprice_hidden[]']").val();
			var service_orderdetails_btotal = service_orderdetails_bprice*value2;
			//sub total
			var subtotal_hidden = (value-disc_value) * value2;
			var service_orderdetails_subtotal= subtotal_hidden - (subtotal_hidden*(disc_final/100));
			var service_orderdetails_subtotal_format=service_orderdetails_subtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
			//sub profit
			var subprofit= service_orderdetails_subtotal - service_orderdetails_btotal;
			//get KPB
			var kpb_service_yesno_hidden = $(this).closest('tr').find("input[name='kpb_service_yesno_hidden[]']").val();
			if(kpb_service_yesno_hidden==1){
				kpb_service_tot += service_orderdetails_subtotal;
				service_order_discount_kpb += (subtotal_hidden*(disc_final/100));
				service_order_tax_kpb += (service_orderdetails_subtotal*(ptax/100));
				income_service_kpb += service_orderdetails_subtotal;
				}
			//update sub total
			$(this).closest('tr').find('div.service_orderdetails_subtotal').html(service_orderdetails_subtotal_format);
			$(this).closest('tr').find("input[name='service_orderdetails_subtotal_hidden[]']").val(service_orderdetails_subtotal);
			//grand disc final
			disc_final_total += (subtotal_hidden*(disc_final/100));
			//grand tax
			tax_total += (service_orderdetails_subtotal*(ptax/100));
			//grand total
			grandtotal += service_orderdetails_subtotal;
			//stock trade & profit total
			profittotal += subprofit;
			stock_trade += service_orderdetails_btotal;
			profittotal_service += service_orderdetails_subtotal;
			});
		//end list num 1
		//list num 2
		$('.subtotal_hidden').each(function (index, element) {
			var num_list=index+1;
			$(this).closest('tr').find('td.listnum_product_order_sale').html(num_list+".");
			$(this).closest('tr').attr("id","product_inner"+num_list);
			//get disc final
			var disc_final = $("#service_order_discount").val();
			//get tax
			var ptax = $(this).closest('tr').find("input[name='product_orderdetails_tax_hidden[]']").val();
			//get current sub total
			var value = $(this).closest('tr').find("input[name='product_orderdetails_price_hidden[]']").val();
			var value2 = $(this).closest('tr').find("input[name='product_orderdetails_quantity_hidden[]']").val();
			var disc_value = $(this).closest('tr').find("input[name='product_orderdetails_discount_val_hidden[]']").val();
			//get profit
			var product_orderdetails_bprice = $(this).closest('tr').find("input[name='product_orderdetails_bprice_hidden[]']").val();
			var product_orderdetails_btotal = product_orderdetails_bprice*value2;
			//sub total
			var subtotal_hidden = (value-disc_value) * value2;
			var product_orderdetails_subtotal= subtotal_hidden - (subtotal_hidden*(disc_final/100));
			var product_orderdetails_subtotal_format=product_orderdetails_subtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
			//sub profit
			var subprofit= product_orderdetails_subtotal - product_orderdetails_btotal;
			//get KPB
			var kpb_product_yesno_hidden = $(this).closest('tr').find("input[name='kpb_product_yesno_hidden[]']").val();
			if(kpb_product_yesno_hidden==1){
				kpb_product_tot += product_orderdetails_subtotal;
				service_order_discount_kpb += (subtotal_hidden*(disc_final/100));
				service_order_tax_kpb += (product_orderdetails_subtotal*(ptax/100));
				income_trade_kpb += subprofit;
				stock_trade_kpb += product_orderdetails_btotal;
				}
			//update sub total
			$(this).closest('tr').find('div.product_orderdetails_subtotal').html(product_orderdetails_subtotal_format);
			$(this).closest('tr').find("input[name='product_orderdetails_subtotal_hidden[]']").val(product_orderdetails_subtotal);
			//grand disc final
			disc_final_total += (subtotal_hidden*(disc_final/100));
			//grand tax
			tax_total += (product_orderdetails_subtotal*(ptax/100));
			//grand total
			grandtotal += product_orderdetails_subtotal;
			//stock trade & profit total
			profittotal += subprofit;
			stock_trade += product_orderdetails_btotal;
			profittotal_product += subprofit;
			});
		//end list num 2
		
		//calculate total
		grandtotal = grandtotal-(kpb_product_tot+kpb_service_tot);
		var service_order_cost = $("#service_order_cost").val();
		service_order_cost=service_order_cost.replace(/,/g, "");
		service_order_cost=parseFloat(service_order_cost);
		var service_order_total = grandtotal + tax_total + service_order_cost;
		//display
		var grandtotal_format=grandtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#service_orderdetails_total").val(grandtotal_format);
		$("#service_orderdetails_total_hidden").val(grandtotal);
		var tax_total_format=tax_total.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#service_order_tax").val(tax_total_format);
		$("#service_order_tax_hidden").val(tax_total);
		var service_order_total_format=service_order_total.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#service_order_total").val(service_order_total_format);
		$("#service_order_total_cash").val(service_order_total_format);
		$("span.amount_total").html(service_order_total_format);
		$("#service_order_total_bank").val(service_order_total_format);
		$("#service_order_total_credit").val(service_order_total_format);
		$("#service_order_total_hidden").val(service_order_total);
		if(vnon==0){
		$("#service_order_discount_val").val(disc_final_total.toLocaleString('en-US', {minimumFractionDigits: 2}));
		}
		$("#service_order_discount_val_hidden").val(disc_final_total);
		//KPB
		var kpb_service_tot_format=kpb_service_tot.toLocaleString('en-US', {minimumFractionDigits: 2});
		var kpb_product_tot_format=kpb_product_tot.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#service_order_kpb_service").val(kpb_service_tot_format);
		$("#service_order_kpb_product").val(kpb_product_tot_format);
		$("#service_order_kpb_service_hidden").val(kpb_service_tot);
		$("#service_order_kpb_product_hidden").val(kpb_product_tot);
		$("#service_order_discount_kpb").val(service_order_discount_kpb);
		$("#service_order_tax_kpb").val(service_order_tax_kpb);
		$("#income_trade_kpb").val(income_trade_kpb);
		$("#stock_trade_kpb").val(stock_trade_kpb);
		$("#income_service_kpb").val(income_service_kpb);
		//set stock trade & profit total hidden
		$("#income_trade_hidden").val(profittotal_product);
		$("#stock_trade_hidden").val(stock_trade);
		$("#income_service_hidden").val(profittotal_service);
}
   
/* cek if already on list service */
function service_on_list_exist(service_code) {
	var return_val=false;
	var service_code_arr=service_code.split(" - ");
	var service_code_val = service_code_arr[0];
	$('.service_subtotal_hidden').each(function (index, element) {
	var service_scode_hidden = $(this).closest('tr').find("input[name='service_scode_hidden[]']").val();
	var service_scode_hidden_arr=service_scode_hidden.split(" - ");
	var service_code_hidden_val = service_scode_hidden_arr[0];
	if(service_code_hidden_val==service_code_val){
		return_val=true;
		}
	});
return return_val;
}

/* cek if already on list product */
function product_on_list_exist(product_code) {
	var return_val=false;
	var product_code_arr=product_code.split(" - ");
	var product_code_val = product_code_arr[0];
	$('.subtotal_hidden').each(function (index, element) {
	var product_scode_hidden = $(this).closest('tr').find("input[name='product_scode_hidden[]']").val();
	var product_scode_hidden_arr=product_scode_hidden.split(" - ");
	var product_code_hidden_val = product_scode_hidden_arr[0];
	if(product_code_hidden_val==product_code_val){
		return_val=true;
		}
	});
return return_val;
}

/* on users_code enter */
$('#users_code').on('change', function (e) {
	var mcode = $(this).val();
	if($.trim(mcode) == ''){
	$("#users_code").focus();
	alert("Kode Kosong");
	}else{
	users_code_exist();
	}
});

/* on users_code reset */
function users_code_reset() {
	$('#users_status').val('');
	$('#users_idnumber').val('');
	$('#users_name').val('');
	$('#users_address').val('');
	$('#users_phone').val('');
	$('#users_email').val('');
	$('#religion_code').val('');
	//$('#city_code').val('');
	$('#village_code').val('');
	$('#area_code').val('');
	$('#users_code_hidden').val(0);
}

/* on users_code reset */
function users_code_set() {
	$('#users_code_hidden').val(1);
}

/* function if users_code exist */
function users_code_exist(set_focus) {
	if (set_focus == undefined) set_focus="";
	$('#myloading').fadeIn(500);
	var users_name=$('#users_code').val();
	var users_code_arr=users_name.split(" - ");
	var customer_code_val = users_code_arr[0];
	$.ajax({ 
    type: "POST", 
    url: "../../users/ajax/customer-exist-json.php?customer_code_val="+customer_code_val, 
    data: { get_param: 'value' }, 
    dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
    success: function (data) { 
		if(data['users_id'] == 0){
			//reset
			$('.typehead_customer #users_code').typeahead('val', data['users_code']);
			users_code_reset();
			$("#users_name").val(customer_code_val);
			$("#users_name").focus();
			if($("#users_clone").is(':checked')){
				users2_clone();
				}
		}else{
			//fill in form as edit data
			var users_code=data['users_code'];
			var users_status=data['users_status'];
			var users_idnumber=data['users_idnumber'];
			var users_name=data['users_name'];
			var users_address=data['users_address'];
			var users_phone=data['users_phone'];
			var users_email=data['users_email'];
			var users_birthday=data['users_birthday'];
			var religion_code=data['religion_code'];
			//var city_code=data['city_code'];
			var village_code=data['village_code']+" - "+data['village_name'];
			var area_code=data['area_code'];
			
			// and set them in the modal:
			$('.typehead_customer #users_code').typeahead('val', users_code);
			$('#users_status').val(users_status);
			$('#users_idnumber').val(users_idnumber);
			$('#users_name').val(users_name);
			$('#users_address').val(users_address);
			$('#users_phone').val(users_phone);
			$('#users_email').val(users_email);
			$('#religion_code').val(religion_code);
			//$('#city_code').val(city_code);
			$('.typehead_village #village_code').typeahead('val', village_code);
			$('#area_code').val(area_code);
			users_code_set();
			if(set_focus==""){
				$("#users_name").focus();
				}else{
				//$("#"+set_focus).focus();
				}
			if($("#users_clone").is(':checked')){
				users2_clone();
				}
			}
        $('#myloading').fadeOut(500);
    }
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

$('.users_edit').change(function(){
    if($("#users_clone").is(':checked')){
		users2_clone();
		}
});

$('#users_clone').change(function(){
    if($(this).is(":checked")){
    users2_clone();
	$('.clone_area').hide();
	}else{
    users2_reset();
	$('.clone_area').show();
	}
});

/* users2_clone */
function users2_clone() {
	//fill in form as edit data
	var users_code=$('#users_code').val();
	var users_status=$('#users_status').val();
	var users_idnumber=$('#users_idnumber').val();
	var users_name=$('#users_name').val();
	var users_address=$('#users_address').val();
	var users_phone=$('#users_phone').val();
	var users_email=$('#users_email').val();
	var users_birthday=$('#users_birthday').val();
	var religion_code=$('#religion_code').val();
	//var city_code=$('#city_code').val();
	var village_code=$('#village_code').val();
	var area_code=$('#area_code').val();
	
	// and set them in the modal:
	$('.typehead_customer #users2_code').typeahead('val', users_code);
	$('#users2_status').val(users_status);
	$('#users2_idnumber').val(users_idnumber);
	$('#users2_name').val(users_name);
	$('#users2_address').val(users_address);
	$('#users2_phone').val(users_phone);
	$('#users2_email').val(users_email);
	$('#religion2_code').val(religion_code);
	//$('#city2_code').val(city_code);
	$('.typehead_village #village2_code').typeahead('val', village_code);
	$('#area2_code').val(area_code);
}

/* users2_reset */
function users2_reset() {
	//fill in form as edit data
	// and set them in the modal:
	$('.typehead_customer #users2_code').typeahead('val', '');
	users2_code_reset();
}

/* on users2_code enter */
$('#users2_code').on('change', function (e) {
	var mcode = $(this).val();
	if($.trim(mcode) == ''){
	$("#users2_code").focus();
	alert("Kode Kosong");
	}else{
	users2_code_exist();
	}
});

/* on users2_code reset */
function users2_code_reset() {
	$('#users2_status').val('');
	$('#users2_idnumber').val('');
	$('#users2_name').val('');
	$('#users2_address').val('');
	$('#users2_phone').val('');
	$('#users2_email').val('');
	$('#religion2_code').val('');
	//$('#city2_code').val('');
	$('#village2_code').val('');
	$('#area2_code').val('');
	$('#users2_code_hidden').val(0);
}

/* on users_code reset */
function users2_code_set() {
	$('#users2_code_hidden').val(1);
}

/* function if users2_code exist */
function users2_code_exist(set_focus) {
	if (set_focus == undefined) set_focus="";
	$('#myloading').fadeIn(500);
	var users2_name=$('#users2_code').val();
	var users2_code_arr=users2_name.split(" - ");
	var customer_code_val = users2_code_arr[0];
	$.ajax({ 
    type: "POST", 
    url: "../../users/ajax/customer-exist-json.php?customer_code_val="+customer_code_val, 
    data: { get_param: 'value' }, 
    dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
    success: function (data) { 
		if(data['users_id'] == 0){
			//fill in form as new data
			$('.typehead_customer #users2_code').typeahead('val', data['users_code']);
			users2_code_reset();
			$("#users2_name").val(customer_code_val);
			$("#users2_name").focus();
		}else{
			//fill in form as edit data
			var users2_code=data['users_code'];
			var users2_status=data['users_status'];
			var users2_idnumber=data['users_idnumber'];
			var users2_name=data['users_name'];
			var users2_address=data['users_address'];
			var users2_phone=data['users_phone'];
			var users2_email=data['users_email'];
			var users2_birthday=data['users_birthday'];
			var religion2_code=data['religion_code'];
			//var city2_code=data['city_code'];
			var village2_code=data['village_code']+" - "+data['village_name'];
			var area2_code=data['area_code'];
			
			// and set them in the modal:
			$('.typehead_customer #users2_code').typeahead('val', users2_code);
			$('#users2_status').val(users2_status);
			$('#users2_idnumber').val(users2_idnumber);
			$('#users2_name').val(users2_name);
			$('#users2_address').val(users2_address);
			$('#users2_phone').val(users2_phone);
			$('#users2_email').val(users2_email);
			$('#religion2_code').val(religion2_code);
			//$('#city2_code').val(city2_code);
			$('.typehead_village #village2_code').typeahead('val', village2_code);
			$('#area2_code').val(area2_code);
			users2_code_set();
			if(set_focus==""){
				$("#users2_name").focus();
				}else{
				//$("#"+set_focus).focus();
				}
			}
        $('#myloading').fadeOut(500);
    }
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* customer_new_modal submit modal */
$(function () {
var myModal = $('#customer_new_modal');
$('#customer_new_modal_form', myModal).submit(function (e) {
	e.preventDefault();
	var form=$("#customer_new_modal_form");
	$('.ajax_loader', myModal).show();
	//get input
	var users_code = $('#users_code', myModal).val();
	var users_name = $('#users_name', myModal).val();
	//call ajax update data & return data
	$.ajax({
        type:"POST",
        url:"../../users/ajax/customer-new.php",
        data:form.serialize(),
        success: function(response){
            console.log(response);
		//set users_code with new code & name
		$('.typehead_customer #users_code').typeahead('val', users_code+" - "+users_name);
		$("#motorcycle_code").focus();
		$('.ajax_loader', myModal).hide();
		myModal.modal('hide');
		}
	});
	});
});

/* on users_check change */
$('#users_check').change(function(){
    if($(this).is(":checked"))
    users_check_checked();
    else
    users_check_unchecked();
    });
	
/* on users_check checked exec */
function users_check_checked() {
var myModal = $('#motorcycle_new_modal');
var users_code=$("#users_code").val();
$('.typehead_customer #users_code', myModal).typeahead('val', users_code);
var users_code_arr=users_code.split(" - ");
var customer_code_val = users_code_arr[0];
$('#users_code', myModal).prop('readonly',true);
//get user detail
$('#myloading').fadeIn(500);

$.ajax({
	type: "POST",        
	url: "../../users/ajax/customer-exist-json.php?customer_code_val="+customer_code_val,
	cache: false,
	async : true,
	dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
	success: function(data){
	var users_code=data['users_code'];
	if(data['users_id'] == 0){
		//open alert user not exist
		alert("Kode Pembawa kosong.");
		$("#users_code").focus();
		myModal.modal('hide');
		}else{
		$('#users_status', myModal).val(data['users_status']);
		$('#users_phone', myModal).val(data['users_phone']);
		$('#users_status', myModal).prop('disabled',true);
		$('#users_phone', myModal).prop('disabled',true);
		}
	$('#myloading').fadeOut(500);
	}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* on users_check checked exec */
function users_check_unchecked() {
var myModal = $('#motorcycle_new_modal');
$('.typehead_customer #users_code', myModal).typeahead('val', '');
$('#users_code', myModal).prop('readonly',false);
$('#users_code', myModal).focus();
$('#users_status', myModal).val('male');
$('#users_phone', myModal).val('');
$('#users_status', myModal).prop('disabled',false);
$('#users_phone', myModal).prop('disabled',false);
}

/* on motorcycle_code enter */
$('#motorcycle_code').on('change', function (e) {
	var mcode = $(this).val();
	if($.trim(mcode) == ''){
	$("#motorcycle_code").focus();
	alert("Kode Kosong");
	}else{
	mcode_onchange(mcode);
	}
});

/* on motorcycle_code exec */
function mcode_onchange(mcode,set_focus) {
	if (set_focus == undefined) set_focus="";
	var mcode_arr=mcode.split(" - ");
	mcode = mcode_arr[0];
	var date_service = $('#date_register').val();
	$('#myloading').fadeIn(500);		
	
	$.ajax({ 
    type: "POST", 
    url: "../inventory/motorcycle-getcode.php?mcode="+mcode+"&date_service="+date_service, 
    cache: false,
	async : true, 
    dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
    success: function (data) { 
		if(data['motorcycle_id'] == 0){
			//fill in form as new data
			$('.typehead_motorcycle #motorcycle_code').typeahead('val', mcode);
			$('.typehead_motorcycle_type #motorcycle_type_code').typeahead('val', '');
			$('#color_code').val('');
			$('#motorcycle_manufacture').val('');
			$('#motorcycle_frame_no').val('');
			$('#motorcycle_machine_no').val('');
			$('#motorcycle_buy_register').val('');
			$('#motorcycle_book_service_no').val('');
			$('#motorcycle_description').val('');
			$("#motorcycle_type_name").focus();
		}else{
			//fill in form as edit data
			var motorcycle_machine_no=data['motorcycle_machine_no'];
			var color_code=data['color_code'];
			var motorcycle_manufacture=data['motorcycle_manufacture'];
			var motorcycle_frame_no=data['motorcycle_frame_no'];
			var motorcycle_buy_register=data['motorcycle_buy_register'];
			var motorcycle_book_service_no=data['motorcycle_book_service_no'];
			var motorcycle_type_code=data['motorcycle_type_code'];
			var users_code=data['users_code'];
			var motorcycle_code=data['motorcycle_code'];
			var motorcycle_description=data['motorcycle_description'];
			var users_code=data['users_code'];
			
			// and set them in the modal:
			$('.typehead_motorcycle #motorcycle_code').typeahead('val', motorcycle_code);
			$('.typehead_motorcycle_type #motorcycle_type_code').typeahead('val', motorcycle_type_code);
			$('#color_code').val(color_code);
			$('#motorcycle_manufacture').val(motorcycle_manufacture);
			$('#motorcycle_frame_no').val(motorcycle_frame_no);
			$('#motorcycle_machine_no').val(motorcycle_machine_no);
			$('#motorcycle_buy_register').val(motorcycle_buy_register);
			$('#motorcycle_book_service_no').val(motorcycle_book_service_no);
			$('#motorcycle_description').val(motorcycle_description);
			if(motorcycle_buy_register!=""){
				motorcycle_buy_register_onchange(motorcycle_buy_register);
				}
			//owner autofill
			$('.typehead_customer #users_code').typeahead('val', users_code);
			users_code_exist("motorcycle_type_code");
			if(set_focus==""){
				$("#motorcycle_type_code").focus();
				}else{
				$("#"+set_focus).focus();
				}
			}
        $('#myloading').fadeOut(500);
    }
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* motorcycle_new_modal submit modal */
$(function () {
var myModal = $('#motorcycle_new_modal');
$('#motorcycle_new_modal_form', myModal).submit(function (e) {
	e.preventDefault();
	var form=$("#motorcycle_new_modal_form");
	var date_service = $('#date_register').val();
	$('.ajax_loader', myModal).show();
	$.ajax({
        type:"POST",
        url:"../inventory/ajax/motorcycle-new.php?date_service="+date_service,
        data:form.serialize(),
        success: function(response){
            console.log(response);
			var data_arr=response.split(";");
			$('.typehead_motorcycle #motorcycle_code').typeahead('val', data_arr[10]+" - "+data_arr[0]);
			var motorcycle_frame_no=data_arr[1];
			var motorcycle_machine_no=data_arr[2];
			var motorcycle_type_name=data_arr[3];
			var color_name=data_arr[4];
			var motorcycle_manufacture=data_arr[5];
			var motorcycle_numdays=data_arr[8];
			var motorcycle_type_code=data_arr[9]+" - "+data_arr[3];
			$("span#users_name").html(data_arr[0]);
			$("span#motorcycle_frame_no").html(motorcycle_frame_no+"/"+motorcycle_machine_no);
			$("span#motorcycle_type_name").html(motorcycle_type_name+"/"+color_name+"/"+motorcycle_manufacture);
			$("#service_order_code").focus();
			//update kpb info
			var myModalkpb = $('#myModalkpb');
			$("span#motorcycle_numdays", myModalkpb).html(motorcycle_numdays);
			$('.ajax_loader', myModal).hide();
			myModal.modal('hide');  
        }
    });
	});
});

/* calc_modal show */
$(function () {
$(".calc_modal").on("click", function() {
    var myModal = $('#calc_modal');
	var product_order_calc_bill = $('#service_order_total_cash').val();
	$('#product_order_calc_bill', myModal).val(product_order_calc_bill);
	$('#product_order_calc_pay', myModal).focus();
	
	//on product_order_calc_pay keyup
	$('#product_order_calc_pay', myModal).on('keyup', function () {
        //var myModal = $('#calc_modal');
		var value = $(this).val();
		var product_order_calc_bill = $('#product_order_calc_bill', myModal).val();
		value=value.replace(/,/g, "");
		product_order_calc_bill=product_order_calc_bill.replace(/,/g, "");
        var balance = value-product_order_calc_bill;
        $("#product_order_calc_balance", myModal).val(balance.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
	
    myModal.modal({ show: true });
});
});

/* calc_modal submit */
$(function () {
var myModal = $('#calc_modal');
$('.btn_calc', myModal).click(function () {
	//myModal.modal('hide');
	var service_order_cash = $('#product_order_calc_pay', myModal).val();
	$('#service_order_cash').val(service_order_cash);
	$('.ajax_loader', myModal).show();
	$('.modal').modal('hide');
	//$("button[name='Submit']").click();
	$('#Submit').click();
	});
});

/* modal typehead */
function typehead_modal(typ_name,in_name,in_id,url_list,code_old,myModal,append_div) {
var randnum = Math.floor((Math.random() * 100) + 1);
//$('#'+in_id+'', myModal).closest('div').remove();
//var list = $('.'+append_div+'', myModal);
//html ='<div class="col-md-8"><input name="'+in_name+'" type="text" class="textbox" id="'+in_id+'"></div>';
//list.append($(html));
//$('#'+in_id+'', myModal).closest('div').addClass(typ_name+randnum);
//$('#'+in_id+'', myModal).val(code_old);
$('#'+in_id+'', myModal).closest('div').attr('class', "col-md-8 "+typ_name);
var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
var randomUniqueId = randLetter + Date.now();
var countries = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	limit: 10,
	remote: {
	ttl: 1,
	url: url_list,
	wildcard: "%QUERY",
	filter: function(list) {
	return $.map(list, function(country) { return { name: country }; });
	}}
	});
countries.initialize();
$('.'+typ_name+' #'+in_id+'', myModal).typeahead(null, {
	//name: 'countries',
	name: ''+typ_name+'' + randomUniqueId,
	displayKey: 'name',
	source: countries.ttAdapter()
	});
}

/* typeahead:selected */
$("input[type='text']").on('typeahead:selected', function (e, datum) {
    var kp=$(this).attr("rel");
	var tval=$(this).val();
	$(this).typeahead('val', tval);
	$("#"+kp+"").focus();
})

/* on service_order_km_now keyup */
$('input[name=service_order_km_now]').on('keyup', function () {
        var km_now = parseFloat($(this).val());
		var km_next = 0;
		if(km_now>0){
		km_next = km_now + 2000;
		}
        $('input[name=service_order_km_next]').val(km_next);
})

/* on service_order_buy_pay radio check */
$('input[name=service_order_buy_pay]').click(function () {
    if (this.id == "service_order_buy_pay1_0") {
        $("#service_order_buy_pay_cash").show();
		$("#service_order_buy_pay_bank").hide();
		$("#service_order_buy_pay_credit").hide();
		$("#Submit").hide();
		$("#Submitpay").show();
	} else if (this.id == "service_order_buy_pay1_1") {
        $("#service_order_buy_pay_cash").hide();
		$("#service_order_buy_pay_bank").show();
		$("#service_order_buy_pay_credit").hide();
	} else {
        $("#service_order_buy_pay_cash").hide();
		$("#service_order_buy_pay_bank").hide();
		$("#service_order_buy_pay_credit").show();
		$("#Submit").show();
		$("#Submitpay").hide();
    }
});


/* on service_order edit */
$('a.service_order_edit').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var service_order_id = $(this).closest('tr').find('td.service_order_id_hidden').html();
	service_order_id = $(service_order_id).text();
    var service_order_status = $(this).closest('tr').find('td.service_order_status_hidden').html();
	service_order_status = $(service_order_status).text();
    // and set them in the modal:
	$('#service_order_id', myModal).val(service_order_id);
	//cek status
	if(service_order_status=='sa'){
		$('button#btn_edit', myModal).show();
		$('button#btn_proc', myModal).prop('disabled', true);
		$('button#btn_pause', myModal).prop('disabled', true);
		$('button#btn_unpaid', myModal).prop('disabled', true);
		$('button#btn_pmn', myModal).prop('disabled', true);
		$('button#btn_cancel', myModal).prop('disabled', false);
		$('button#btn_print', myModal).prop('disabled', true);
		edit_to_proc(myModal);
		play_to_pause(myModal,service_order_id);
		var print_url="pdf/service-pkb-pdf.php?service_order_id="+service_order_id;
		}
	if(service_order_status=='tmp'){
		$('button#btn_edit', myModal).show();
		$('button#btn_proc', myModal).prop('disabled', false);
		$('button#btn_pause', myModal).prop('disabled', true);
		$('button#btn_unpaid', myModal).prop('disabled', true);
		$('button#btn_pmn', myModal).prop('disabled', true);
		$('button#btn_cancel', myModal).prop('disabled', false);
		$('button#btn_print', myModal).prop('disabled', false);
		edit_to_proc(myModal);
		play_to_pause(myModal,service_order_id);
		var print_url="pdf/service-pkb-pdf.php?service_order_id="+service_order_id;
		}
	if(service_order_status=='process'){
		$('button#btn_edit', myModal).hide();
		$('button#btn_proc', myModal).prop('disabled', false);
		$('button#btn_pause', myModal).prop('disabled', false);
		$('button#btn_unpaid', myModal).prop('disabled', false);
		$('button#btn_pmn', myModal).prop('disabled', true);
		$('button#btn_cancel', myModal).prop('disabled', false);
		$('button#btn_print', myModal).prop('disabled', false);
		proc_to_edit(myModal);
		play_to_pause(myModal,service_order_id);
		var print_url="pdf/service-pkb-pdf.php?service_order_id="+service_order_id;
		}
	if(service_order_status=='pause'){
		$('button#btn_edit', myModal).hide();
		$('button#btn_proc', myModal).prop('disabled', true);
		$('button#btn_pause', myModal).prop('disabled', false);
		$('button#btn_unpaid', myModal).prop('disabled', true);
		$('button#btn_pmn', myModal).prop('disabled', true);
		$('button#btn_cancel', myModal).prop('disabled', true);
		$('button#btn_print', myModal).prop('disabled', false);
		proc_to_edit(myModal);
		pause_to_play(myModal,service_order_id);
		var print_url="pdf/service-pkb-pdf.php?service_order_id="+service_order_id;
		}
	if(service_order_status=='unpaid'){
		$('button#btn_edit', myModal).hide();
		$('button#btn_proc', myModal).prop('disabled', true);
		$('button#btn_pause', myModal).prop('disabled', true);
		$('button#btn_unpaid', myModal).prop('disabled', true);
		$('button#btn_pmn', myModal).prop('disabled', false);
		$('button#btn_cancel', myModal).prop('disabled', false);
		$('button#btn_print', myModal).prop('disabled', false);
		proc_to_edit(myModal);
		play_to_pause(myModal,service_order_id);
		var print_url="pdf/service-pkb-pdf.php?service_order_id="+service_order_id;
		}
	if(service_order_status=='pmn'){
		$('button#btn_edit', myModal).hide();
		$('button#btn_proc', myModal).prop('disabled', true);
		$('button#btn_pause', myModal).prop('disabled', true);
		$('button#btn_unpaid', myModal).prop('disabled', true);
		$('button#btn_pmn', myModal).prop('disabled', true);
		$('button#btn_cancel', myModal).prop('disabled', true);
		$('button#btn_print', myModal).prop('disabled', false);
		proc_to_edit(myModal);
		play_to_pause(myModal,service_order_id);
		var print_url="pdf/service-inv-pdf.php?service_order_id="+service_order_id;
		}
	if(service_order_status=='cancel'){
		$('button#btn_edit', myModal).hide();
		$('button#btn_proc', myModal).prop('disabled', true);
		$('button#btn_pause', myModal).prop('disabled', true);
		$('button#btn_unpaid', myModal).prop('disabled', true);
		$('button#btn_pmn', myModal).prop('disabled', true);
		$('button#btn_cancel', myModal).prop('disabled', true);
		$('button#btn_print', myModal).prop('disabled', true);
		edit_to_proc(myModal);
		play_to_pause(myModal,service_order_id);
		var print_url="pdf/service-inv-pdf.php?service_order_id="+service_order_id;
		}
	var edit_link = "location.href='service-edit.php?service_order_id="+service_order_id+"&btn_status=btn_edit'";
	if(service_order_status=='sa'){
		var edit_link = "location.href='service-edit.php?service_order_id="+service_order_id+"'";
		}
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var proc_link = "location.href='service-edit.php?service_order_id="+service_order_id+"&service_order_status="+service_order_status+"&btn_status=btn_proc'";
	$('button#btn_proc', myModal).attr('onclick',proc_link);
	var unpaid_link = "location.href='service-unpaid.php?service_order_id="+service_order_id+"'";
	$('button#btn_unpaid', myModal).attr('onclick',unpaid_link);
	
	var service_order_status_paid=service_order_status;
	if(service_order_status=="pmn"){
		service_order_status_paid="unpaid";
		}
	
	var pmn_link = "location.href='service-edit.php?service_order_id="+service_order_id+"&service_order_status="+service_order_status_paid+"&btn_status=btn_pmn'";
	$('button#btn_pmn', myModal).attr('onclick',pmn_link);
	var cancel_link = "service-cancel.php?service_order_id="+service_order_id;
	$('form#delpopform', myModal).attr('action',cancel_link);
	//var print_link = "window.open('"+print_url+"','printout','width=640,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100'); return false;";
	var print_link = "window.open('"+print_url+"', '_blank');return false;";
	$('button#btn_print', myModal).attr('onclick',print_link);
	
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* service_order edit to proc */
function edit_to_proc(myModal) {
//change edit to proc
$("#btn_proc span", myModal).text("PROSES");
$("#btn_proc i", myModal).attr('class', 'fa fa-play-circle');
}

/* service_order proc to edit */
function proc_to_edit(myModal) {
//change proc to edit
$("#btn_proc span", myModal).text("EDIT");
$("#btn_proc i", myModal).attr('class', 'fa fa-edit');
}

/* service_order pause to play */
function pause_to_play(myModal,service_order_id) {
//change pause to play
$("#btn_pause span", myModal).text("PLAY");
$("#btn_pause i", myModal).attr('class', 'fa fa-play-circle');
var pause_link = "location.href='service-pause.php?service_order_id="+service_order_id+"&play=1'";
$('button#btn_pause', myModal).attr('onclick',pause_link);
}

/* service_order play to pause */
function play_to_pause(myModal,service_order_id) {
//change play to pause
$("#btn_pause span", myModal).text("PAUSE");
$("#btn_pause i", myModal).attr('class', 'fa fa-pause-circle');
var pause_link = "location.href='service-pause.php?service_order_id="+service_order_id+"&play=0'";
$('button#btn_pause', myModal).attr('onclick',pause_link);
}

/* on service_order edit */
$('a.service_order_paid').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var service_order_id = $(this).closest('tr').find('td.service_order_id_hidden').html();
	service_order_id = $(service_order_id).text();
    var service_order_status = $(this).closest('tr').find('td.service_order_status_hidden').html();
	service_order_status = $(service_order_status).text();
    // and set them in the modal:
	$('#service_order_id', myModal).val(service_order_id);
	if(service_order_status=='pmn'){
		$('button#btn_pmn', myModal).prop('disabled', false);
		$('button#btn_print', myModal).prop('disabled', false);
		var print_url="pdf/service-inv-pdf.php?service_order_id="+service_order_id;
		}
	var service_order_status_paid=service_order_status;
	if(service_order_status=="pmn"){
		service_order_status_paid="unpaid";
		}
	var pmn_link = "location.href='service-paid-edit.php?service_order_id="+service_order_id+"&service_order_status="+service_order_status_paid+"&btn_status=btn_pmn'";
	$('button#btn_pmn', myModal).attr('onclick',pmn_link);
	var print_link = "window.open('"+print_url+"', '_blank');return false;";
	$('button#btn_print', myModal).attr('onclick',print_link);
	
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* on service_order_onl_edit edit */
$('a.service_order_onl_edit').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var service_order_id = $(this).closest('tr').find('td.service_order_id_hidden').html();
	service_order_id = $(service_order_id).text();
    // and set them in the modal:
	$('#service_order_id', myModal).val(service_order_id);
	var proc_link = "location.href='service-edit.php?service_order_id="+service_order_id+"&service_order_status=&btn_status='";
	$('button#btn_proc', myModal).attr('onclick',proc_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* on service_order_onl_edit edit */
$('a.btn_history').on('click', function() {
    var motorcycle_code=$('#motorcycle_code').val();
	if($.trim(motorcycle_code)!=""){
	var url="pdf/service-history-pdf.php?motorcycle_code="+motorcycle_code;
	window.open(url,'popuppage','width=640,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');
	//window.open(url, '_blank');
	}
});


/** service vendor **/
/* on service_bcode change */
$('#service_bcode').on('change', function (e) {
	var bcode = $(this).val();
	$('#service_ov_flw').find('div.clear').attr('class', 'clear hidden-xs hidden-sm hidden-md hidden-lg');
	sbcode_onchange(bcode);
});

/* on service_bcode keyup */
$('#service_bcode').on('keyup', function (e) {
	var input = $.trim( $(this).val() );
     if( input == "" ) {
        $('#service_ov_flw').find('div.clear').attr('class', 'clear hidden-xs hidden-sm hidden-md hidden-lg');
     }else{
		$('#service_ov_flw').find('div.clear').attr('class', 'clear hidden-sm hidden-md hidden-lg');
	 }
});

/* sbcode_onchange */
function sbcode_onchange(bcode) {
	var service_order_id = $('#service_order_id').val();
	$('#myloading').fadeIn(500);		
	$.ajax({
	type: "POST",
	url: "../inventory/ajax/service-getcode.php?scode="+bcode,
	cache: false,
	async : true,
	dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
	success: function(data){
	if(data['service_id'] == 0){
	alert("Kode Salah");
	$('#myloading').fadeOut(500);
	}else{
	var service_name=data['service_name'];
	var service_sprice=data['service_sprice'];
	var service_bcode=data['service_code']+' - '+service_name;
	$('.typehead_service #service_bcode').typeahead('val', service_bcode);
	$("#service_orderdetails_price").val(service_sprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
	$("#service_orderdetails_quantity").focus();
	//$("#service_orderdetails_price", myModal).val(data);
	$('#myloading').fadeOut(500);
	}}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* service list insert */
function service_vendor() {
	//get input val
	var service_bcode =$('#service_bcode').val();
	var service_orderdetails_price =$('#service_orderdetails_price').val();
	var service_orderdetails_quantity =$('#service_orderdetails_quantity').val();
	var service_orderdetails_subtotal =$('#service_orderdetails_subtotal').val();
	var value=service_orderdetails_price.replace(/,/g, "");
	var value2=service_orderdetails_quantity.replace(/,/g, "");
	var service_orderdetails_subtotal_val=service_orderdetails_subtotal.replace(/,/g, "");

	var service_orderdetails_discount =$('#service_orderdetails_discount').val();
	var service_orderdetails_discount_val =$('#service_orderdetails_discount_val').val();
	var service_orderdetails_tax =$('#service_orderdetails_tax').val();
	var service_orderdetails_discount_unf=service_orderdetails_discount.replace(/,/g, "");
	var service_orderdetails_discount_val_unf=service_orderdetails_discount_val.replace(/,/g, "");
	var service_orderdetails_tax_unf=service_orderdetails_tax.replace(/,/g, "");

	var list = $('.dyn_service_vendor');

	var html = '<tr>';
    html +='<td class="listnum_service_vendor">#</td>';
	html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_bcode">'+service_bcode+'</div><input name="service_bcode_hidden[]" type="hidden" value="'+service_bcode+'"/></a></td>';
    html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_price">'+service_orderdetails_price+'</div><input name="service_orderdetails_price_hidden[]" type="hidden" value="'+value+'"/></a></td>';
    html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_quantity">'+service_orderdetails_quantity+'</div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';

	html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount">'+service_orderdetails_discount+'</div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="'+service_orderdetails_discount_unf+'"/></a></td>';
	html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount_val">'+service_orderdetails_discount_val+'</div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="'+service_orderdetails_discount_val_unf+'"/></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_tax">'+service_orderdetails_tax+'</div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="'+service_orderdetails_tax_unf+'"/></a></td>';

	html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_subtotal">'+service_orderdetails_subtotal+'</div><input class="subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="'+service_orderdetails_subtotal_val+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_vendor(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_service_vendor").append($());
	calc_service_vendor();
	//clear input
	$('.typehead_service #service_bcode').typeahead('val', '');
	$('#service_orderdetails_price').val("");
	$('#service_orderdetails_quantity').val("");
	$('#service_orderdetails_subtotal').val("");
	$('#service_orderdetails_discount').val("");
	$('#service_orderdetails_discount_val').val("");
	$('#service_orderdetails_tax').val("");
	$("#service_bcode").focus();
};

/* service list remove */
function remove_service_vendor(el) {
	   $(el).closest('tr').remove();
	   $("#service_bcode").focus();
	   calc_service_vendor();
   }

/* service list calc */
function calc_service_vendor(vnon) {
	   	if (vnon == undefined) vnon=0;
		var grandtotal = 0;
		var tax_total = 0;
		var disc_final_total = 0;
    	$('.subtotal_hidden').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_service_vendor').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		//get disc final
		var disc_final = $("#service_order_discount").val();
		//get tax
		var ptax = $(this).closest('tr').find("input[name='service_orderdetails_tax_hidden[]']").val();
		//get current sub total
		var value = $(this).closest('tr').find("input[name='service_orderdetails_price_hidden[]']").val();
        var value2 = $(this).closest('tr').find("input[name='service_orderdetails_quantity_hidden[]']").val();
		var disc_value = $(this).closest('tr').find("input[name='service_orderdetails_discount_val_hidden[]']").val();
        var subtotal_hidden = (value-disc_value) * value2;
		var service_orderdetails_subtotal= subtotal_hidden - (subtotal_hidden*(disc_final/100));
		var service_orderdetails_subtotal_format=service_orderdetails_subtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		//update sub total
		$(this).closest('tr').find('div.service_orderdetails_subtotal').html(service_orderdetails_subtotal_format);
		$(this).closest('tr').find("input[name='service_orderdetails_subtotal_hidden[]']").val(service_orderdetails_subtotal);
		//grand disc final
		disc_final_total = disc_final_total + (subtotal_hidden*(disc_final/100));
		//grand tax
		tax_total = tax_total + (service_orderdetails_subtotal*(ptax/100));
		//grand total
		grandtotal = grandtotal + service_orderdetails_subtotal;
    	});
		//calculate total
		var service_order_cost = $("#service_order_cost").val();
		service_order_cost=service_order_cost.replace(/,/g, "");
		service_order_cost=parseFloat(service_order_cost);
		var service_order_total = grandtotal + tax_total + service_order_cost;
		//display
		var grandtotal_format=grandtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#service_orderdetails_total").val(grandtotal_format);
		$("#service_orderdetails_total_hidden").val(grandtotal);
		var tax_total_format=tax_total.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#service_order_tax").val(tax_total_format);
		$("#service_order_tax_hidden").val(tax_total);
		var service_order_total_format=service_order_total.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#service_order_total").val(service_order_total_format);
		$("#service_order_total_cash").val(service_order_total_format);
		$("#service_order_total_bank").val(service_order_total_format);
		$("#service_order_total_credit").val(service_order_total_format);
		$("#service_order_total_hidden").val(service_order_total);
		if(vnon==0){		
		$("#service_order_discount_val").val(disc_final_total.toLocaleString('en-US', {minimumFractionDigits: 2}));
		}
		$("#service_order_discount_val_hidden").val(disc_final_total);
   }


/* service list edit modal */
$(function () {
$('.dyn_service_vendor').on('click', 'a.service_vendor_edit', function () {
    var myModal = $('#myModal');

    // now get the values from the table
	var service_id = $(this).closest('tr').find("input[name='service_bcode_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var service_orderdetails_price = $(this).closest('tr').find("div.service_orderdetails_price").html();
	var service_orderdetails_quantity = $(this).closest('tr').find("div.service_orderdetails_quantity").html();
	var service_orderdetails_discount = $(this).closest('tr').find("div.service_orderdetails_discount").html();
	var service_orderdetails_discount_val = $(this).closest('tr').find("div.service_orderdetails_discount_val").html();
	var service_orderdetails_tax = $(this).closest('tr').find("div.service_orderdetails_tax").html();

    // and set them in the modal:
	$('#service_orderdetails_price', myModal).val(service_orderdetails_price);
	$('#service_orderdetails_quantity', myModal).val(service_orderdetails_quantity);
	$('#service_orderdetails_discount', myModal).val(service_orderdetails_discount);
	$('#service_orderdetails_discount_val', myModal).val(service_orderdetails_discount_val);
	$('#service_orderdetails_tax', myModal).val(service_orderdetails_tax);
	$('#inner_id_hidden', myModal).val(inner_id);

	var randnum = Math.floor((Math.random() * 100) + 1);

	$('#service_bcode', myModal).closest('div').remove();
	var list = $('.append_div', myModal);
	html ='<div class="col-md-8"><input name="service_code" type="text" class="textbox firstin auto_foc" id="service_bcode"> <span id="service_bcode_label">&nbsp;</span></div>';
	list.append($(html));
	$('#service_bcode', myModal).closest('div').addClass('typehead_service'+randnum);
	$('#service_bcode', myModal).val(service_id);

	//service
	var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
	var randomUniqueId = randLetter + Date.now();
	var countries = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		limit: 10,
		remote: {
		ttl: 1,
		url: '../inventory/service-list.php?search=%QUERY',
		wildcard: "%QUERY",
		filter: function(list) {
		return $.map(list, function(country) { return { name: country }; });
		}}
		});

	countries.initialize();

	$('.typehead_service'+randnum+' #service_bcode').typeahead(null, {
		//name: 'countries',
		name: 'typehead_account_' + randomUniqueId,
		displayKey: 'name',
		source: countries.ttAdapter()
		});

	$(".auto_foc").keydown(function(event) {
    if(event.which == 13) { //Enter
    event.preventDefault();
	$(".auto_foc_trg").focus();
		return false;
		}
	});

	$('#service_bcode', myModal).on('keydown', function (e) {
	// If the keycode of the key pressed is 13 (enter)
	if(e.which == 13999) {
		var myForm = $('#form_service_order', myModal); 
		var scode = $(this).val();
		$('#myloading').fadeIn(500);		
		$.post(
		"../inventory/service-getcode.php?scode="+scode, // Use the action from HTML form
		myForm.serialize(), // Use the data from the HTML form
		function(data){ // When the form submission is complete, run this function
		if(data == 1){
		alert("Kode Salah");
		$('#myloading').fadeOut(500);
		}else{
		var data_arr=data.split(";");
		var service_name=data_arr[0];
		var service_sprice=data_arr[1];
		var service_bprice=data_arr[2];
		$("#service_orderdetails_price", myModal).val(service_sprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
		$("#service_orderdetails_quantity", myModal).focus();
		//$("#service_orderdetails_price", myModal).val(data);
		$('#myloading').fadeOut(500);
		}
		});
		// Return false to prevent the browser from processing the enter keypress
		return false;
	}
	});

	//on service code keyup
	$('.typehead_service'+randnum+' #service_bcode', myModal).on('typeahead:selected', function (e, datum) {
		var myForm = $('#form_service_order', myModal); 
		var scode = $(this).val();
		var service_order_id = $('#service_order_id', myModal).val();
		$('#myloading').fadeIn(500);		
		$.post(
		"../inventory/service-getcode.php?scode="+scode+"&service_order_id"+service_order_id, // Use the action from HTML form
		myForm.serialize(), // Use the data from the HTML form
		function(data){ // When the form submission is complete, run this function
		if(data == 1){
		alert("Kode Salah");
		$('#myloading').fadeOut(500);
		}else{
		var data_arr=data.split(";");
		var service_name=data_arr[0];
		var service_sprice=data_arr[1];
		var service_bprice=data_arr[2];
		$("#service_orderdetails_price", myModal).val(service_sprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
		$("#service_orderdetails_quantity", myModal).focus();
		//$("#service_orderdetails_price", myModal).val(data);
		$('#myloading').fadeOut(500);
		}
		});
		// Return false to prevent the browser from processing the enter keypress
		return false;
	});

	$('#service_orderdetails_price', myModal).on('keyup', function () {
        var pdisc = $("#service_orderdetails_discount", myModal).val();
        var pprice = $("#service_orderdetails_price", myModal).val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#service_orderdetails_discount_val", myModal).val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})

	$('#service_orderdetails_discount', myModal).on('keyup', function () {
        var pdisc = $("#service_orderdetails_discount", myModal).val();
        var pprice = $("#service_orderdetails_price", myModal).val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#service_orderdetails_discount_val", myModal).val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})

	$('#service_orderdetails_discount_val', myModal).on('keyup', function () {
        var pdisc_val = $("#service_orderdetails_discount_val", myModal).val();
        var pprice = $("#service_orderdetails_price", myModal).val();
		pdisc_val=pdisc_val.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_percent = (pdisc_val/pprice)*100;
        $("#service_orderdetails_discount", myModal).val(disc_percent.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})

	// and finally show the modal
    myModal.modal({ show: true });

    return false;
});
});

/* service list edit submit modal */
$(function () {
var myModal = $('#myModal');
$('.service_vendor_edit_details2', myModal).click(function () {
$('.ajax_loader', myModal).show();
var service_bcode = $('#service_bcode', myModal).val();
var service_orderdetails_price = $('#service_orderdetails_price', myModal).val();
var service_orderdetails_quantity = $('#service_orderdetails_quantity', myModal).val();

var service_orderdetails_discount =$('#service_orderdetails_discount', myModal).val();
var service_orderdetails_discount_val =$('#service_orderdetails_discount_val', myModal).val();
var service_orderdetails_tax =$('#service_orderdetails_tax', myModal).val();
var service_orderdetails_discount_unf=service_orderdetails_discount.replace(/,/g, "");
var service_orderdetails_discount_val_unf=service_orderdetails_discount_val.replace(/,/g, "");
var service_orderdetails_tax_unf=service_orderdetails_tax.replace(/,/g, "");

var value=service_orderdetails_price.replace(/,/g, "");
var value2=service_orderdetails_quantity.replace(/,/g, "");
var service_orderdetails_subtotal_val = (value-service_orderdetails_discount_unf) * value2;
var service_orderdetails_subtotal=service_orderdetails_subtotal_val.toLocaleString('en-US', {minimumFractionDigits: 2});
var inner_id = $('#inner_id_hidden', myModal).val();

	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);

	var html ='<td class="listnum_service_vendor">#</td>';
    html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_bcode">'+service_bcode+'</div><input name="service_bcode_hidden[]" type="hidden" value="'+service_bcode+'"/></a></td>';
    html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_price">'+service_orderdetails_price+'</div><input name="service_orderdetails_price_hidden[]" type="hidden" value="'+value+'"/></a></td>';
    html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_quantity">'+service_orderdetails_quantity+'</div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';

	html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount">'+service_orderdetails_discount+'</div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="'+service_orderdetails_discount_unf+'"/></a></td>';
	html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount_val">'+service_orderdetails_discount_val+'</div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="'+service_orderdetails_discount_val_unf+'"/></a></td>';
	html +='<td class="td_hide"><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_tax">'+service_orderdetails_tax+'</div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="'+service_orderdetails_tax_unf+'"/></a></td>';

	html +='<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_subtotal">'+service_orderdetails_subtotal+'</div><input class="subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="'+service_orderdetails_subtotal_val+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_vendor(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';

	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_service_vendor();
	$('#myModal').modal('hide');
	});
});


/** total **/
/* service_vendor on keyup */
$(function () {
	$('.service_vendor').on('keyup', function () {
        var value = $("#service_orderdetails_price").val();
        var value2 = $("#service_orderdetails_quantity").val();
		var disc_value = $("#service_orderdetails_discount_val").val();
		value=value.replace(/,/g, "");
		value2=value2.replace(/,/g, "");
		disc_value=disc_value.replace(/,/g, "");
        var total = (value-disc_value) * value2;
        $("#service_orderdetails_subtotal").val(total.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

/* service_vendor_total on keyup */
$(function () {
	$('.service_vendor_total').on('keyup', function () {
        calc_service_vendor();
	})
})

/* service_orderdetails_discount on keyup */
$(function () {
	$('#service_orderdetails_discount').on('keyup', function () {
        var pdisc = $("#service_orderdetails_discount").val();
        var pprice = $("#service_orderdetails_price").val();
		pdisc=pdisc.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_value = (pdisc/100)*pprice;
        $("#service_orderdetails_discount_val").val(disc_value.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

/* service_orderdetails_discount_val on keyup */
$(function () {
	$('#service_orderdetails_discount_val').on('keyup', function () {
        var pdisc_val = $("#service_orderdetails_discount_val").val();
        var pprice = $("#service_orderdetails_price").val();
		pdisc_val=pdisc_val.replace(/,/g, "");
		pprice=pprice.replace(/,/g, "");
		var disc_percent = (pdisc_val/pprice)*100;
        $("#service_orderdetails_discount").val(disc_percent.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})

/* service_order_discount_val on keyup */
$(function () {
	$('#service_order_discount_val').on('keyup', function () {
        var pdisc = $("#service_order_discount").val();
		pdisc = parseFloat(pdisc) || 0;
		//if ( pdisc == '' ) pdisc = 0;
		var pdisc_val = $("#service_order_discount_val").val();
		pdisc_val=pdisc_val.replace(/,/g, "");
        var pdisc_val_hidden = $("#service_order_discount_val_hidden").val();
		pdisc_val_hidden = parseFloat(pdisc_val_hidden) || 0;
		//if ( pdisc_val_hidden == '' ) pdisc_val_hidden = 0;
		var service_orderdetails_total = (pdisc_val_hidden/pdisc)*100;
		if(pdisc_val_hidden==0){
		service_orderdetails_total=$("#service_orderdetails_total_hidden").val();
		}

		var pdisc_new = (pdisc_val/service_orderdetails_total)*100;
		pdisc_new = parseFloat(pdisc_new) || 0;
        $("#service_order_discount").val(pdisc_new.toLocaleString('en-US', {minimumFractionDigits: 2}));
		calc_service_vendor(1);
	})
})

/** show hide service_vendor_pay **/
$('input[name=service_vendor_pay]').click(function () {
    if (this.id == "service_vendor_pay1_0") {
        $("#service_vendor_pay_cash").show();
		$("#service_vendor_pay_bank").hide();
		$("#service_vendor_pay_credit").hide();
	} else if (this.id == "service_vendor_pay1_1") {
        $("#service_vendor_pay_cash").hide();
		$("#service_vendor_pay_bank").show();
		$("#service_vendor_pay_credit").hide();
	} else {
        $("#service_vendor_pay_cash").hide();
		$("#service_vendor_pay_bank").hide();
		$("#service_vendor_pay_credit").show();
    }
});

/* on village_code change */
$('#village_code').on('change', function (e) {
	village_code_exist();
});

/* function if village_code exist */
function village_code_exist() {
	$('#myloading').fadeIn(500);
	var village_name=$('#village_code').val();
	var village_code_arr=village_name.split(" - ");
	var village_code_val = village_code_arr[0];
	//village check if exist
	$.ajax({ 
    type: "POST", 
    url: "../../users/ajax/village-exist-json.php?village_code_val="+village_code_val, 
    data: { get_param: 'value' }, 
    dataType: 'json',
	complete: function () {
        $('#myloading').fadeOut(500);
		},
	error: function(xhr){
        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
		$('#myloading').fadeOut(500);
        },
    success: function (data) { 
		var village_code=data['village_code'];
		if(data['village_id'] == 0){
		//open village_new_modal
		var myModal = $('#village_new_modal');
		$('#village_name', myModal).val(village_name);
		
		//$('#village_code', myModal).val(village_code);
		//typehead
		typehead_modal('typehead_village','village_code','village_code','../../users/village-list.php?search=%QUERY','',myModal,'append_div_area');
		$('.typehead_village #village_code', myModal).typeahead('val', village_code);
		myModal.modal('show');
		}else{
		//do update if cfinal = 0
		}
	$('#myloading').fadeOut(500);
	}
	});
}

/* village_new_modal submit modal */
$(function () {
var myModal = $('#village_new_modal');
$('#village_new_modal_form', myModal).submit(function (e) {
	e.preventDefault();
	var form=$("#village_new_modal_form");
	//get input
	var village_code = $('#village_code', myModal).val();
	var village_name = $('#village_name', myModal).val();
	$('.ajax_loader', myModal).show();
	$.ajax({
        type:"POST",
        url:"../../users/ajax/village-new.php",
        data:form.serialize(),
        success: function(response){
            console.log(response);
			//set village_code with new code & name
			$('.typehead_village #village_code').typeahead('val', village_code+" - "+village_name);
			$("#product_order_code").focus();
			$('.ajax_loader', myModal).hide();
			myModal.modal('hide');  
        }
    });
	});
});

