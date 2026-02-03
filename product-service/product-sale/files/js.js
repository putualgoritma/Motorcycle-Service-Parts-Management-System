/** product list **/

/* on users_code change */
$('#users_code').on('change', function (e) {
	users_code_exist();
});

/* function if users_code exist */
function users_code_exist() {
	$('#myloading').fadeIn(500);
	var users_name=$('#users_code').val();
	var users_code_arr=users_name.split(" - ");
	var customer_code_val = users_code_arr[0];
	//customer check if exist
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
		var users_code=data['users_code'];
		if(data['users_id'] == 0){
		//open customer_new_modal
		var myModal = $('#customer_new_modal');
		$('#users_name', myModal).val(users_name);
		$('#users_code', myModal).val(users_code);
		//typehead
		//typehead_modal('typehead_area','area_code','area_code','../../users/area-list.php?search=%QUERY','',myModal,'append_div_area');
		myModal.modal('show');
		}else{
		//do update if cfinal = 0
		}
	$('#myloading').fadeOut(500);
	}
	});
}

/* customer_new_modal submit modal */
$(function () {
var myModal = $('#customer_new_modal');
$('#customer_new_modal_form', myModal).submit(function (e) {
	e.preventDefault();
	var form=$("#customer_new_modal_form");
	//get input
	var users_code = $('#users_code', myModal).val();
	var users_name = $('#users_name', myModal).val();
	$('.ajax_loader', myModal).show();
	$.ajax({
        type:"POST",
        url:"../../users/ajax/customer-new.php",
        data:form.serialize(),
        success: function(response){
            console.log(response);
			//set users_code with new code & name
			$('#users_code').val(users_code+" - "+users_name);
			$("#product_order_code").focus();
			$('.ajax_loader', myModal).hide();
			myModal.modal('hide');  
        }
    });
	});
});

/* on product_scode change */
$('#product_scode').on('change', function (e) {
	var bcode = $(this).val();
	$('#product_ov_flw').find('div.clear').attr('class', 'clear hidden-xs hidden-sm hidden-md hidden-lg');
	var users_code = $("#users_code").val();
	if($.trim(users_code) == ''){
	$("#users_code").focus();
	$('.typehead_product #product_scode').typeahead('val', '');
	alert("Kode Pembeli Kosong");
	}else{
	pbcode_onchange(bcode,users_code);
	}
});

/* on product_scode keyup */
$('#service_scode').on('keyup', function (e) {
	var input = $.trim( $(this).val() );
     if( input == "" ) {
        $('#product_ov_flw').find('div.clear').attr('class', 'clear hidden-xs hidden-sm hidden-md hidden-lg');
     }else{
		$('#product_ov_flw').find('div.clear').attr('class', 'clear hidden-sm hidden-md hidden-lg');
	 }
});

/* pbcode_onchange */
function pbcode_onchange(bcode,ucode) {
	if (ucode === undefined) {
        ucode = 0;
    	}
	var product_order_id = $('#product_order_id').val();
	$('#myloading').fadeIn(500);		
	$.ajax({
	type: "POST",        
	url: "../inventory/ajax/product-getcode.php?scode="+bcode+"&ucode="+ucode,
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
	}else{
	var product_name=data['product_name'];
	var product_sprice=data['product_sprice'];
	var product_bprice=data['product_bprice'];
	var product_shtquantity=data['product_stock_ht'];
	var product_spoquantity=data['product_stock_so'];
	var product_quantity=data['product_stock'];
	var product_bpoquantity=data['product_stock_po'];
	var product_scode=data['product_code']+' - '+product_name;
	$('.typehead_product #product_scode').typeahead('val', product_scode);
	$("#product_orderdetails_price").val(product_sprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
	$("#product_orderdetails_bprice_hidden").val(product_bprice);
	$("#product_shtquantity_hidden").val(product_shtquantity);
	$("span.product_shtquantity").html(product_shtquantity);
	$("#product_spoquantity_hidden").val(product_spoquantity);
	$("span.product_spoquantity").html(product_spoquantity);
	$("#product_quantity_hidden").val(product_quantity);
	$("span.product_quantity").html(product_quantity);
	$("#product_bpoquantity_hidden").val(product_bpoquantity);
	$("span.product_bpoquantity").html(product_bpoquantity);
	$("#product_orderdetails_quantity").val(1);
	$("#product_orderdetails_discount").val(0);
	$("#product_orderdetails_discount_val").val(0.00);
	$("#product_orderdetails_subtotal").val(product_sprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
	$("#product_orderdetails_quantity").focus();
	//$("#product_orderdetails_price").val(10);
	}
	$('#myloading').fadeOut(500);
	}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* product list insert */
function product_order_sale(ht_type) {
	if (ht_type == undefined) ht_type=0;
	//get input val
	var product_scode =$('#product_scode').val();
	var product_orderdetails_price =$('#product_orderdetails_price').val();
	var product_orderdetails_bprice_hidden = $('#product_orderdetails_bprice_hidden').val();
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
	
	var ready_stock=product_quantity_hidden-product_spoquantity_hidden-product_orderdetails_quantity;
	//cek if already on list
	if(product_on_list_exist(product_scode)){
		alert("Maaf Item Sudah Masuk List");
		$('.typehead_product #product_scode').typeahead('val', '');
		$("#product_scode").focus();
		}
	else if(ready_stock < 0 && ht_type == 0 && company_stock_block==1){
		//ready stock cek
		alert("Maaf Stok Tidak Mencukupi");
		$('.typehead_product #product_scode').typeahead('val', '');
		$("#product_scode").focus();
		}
	else{
	
	var list = $('.dyn_product_order_sale');
	
	var html = '<tr>';
    html +='<td class="listnum_product_order_sale">#</td>';
	html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_scode">'+product_scode+'</div><input name="product_scode_hidden[]" type="hidden" value="'+product_scode+'"/></a></td>';
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
	calc_product_order_sale();
	//clear input
	$('.typehead_product #product_scode').typeahead('val', '');
	$('#product_orderdetails_price').val("");
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
	}
};

/* product list remove */
function remove_product_order_sale(el) {
	   $(el).closest('tr').remove();
	   $("#product_scode").focus();
	   calc_product_order_sale();
   }
   
/* product list calc */
function calc_product_order_sale(vnon=0) {
	   	var grandtotal = 0;
		var tax_total = 0;
		var disc_final_total = 0;
		var profittotal = 0;
		var stock_trade = 0;
    	$('.subtotal_hidden').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_product_order_sale').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		//get disc final
		var disc_final = $("#product_order_discount").val();
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
		//update sub total
		$(this).closest('tr').find('div.product_orderdetails_subtotal').html(product_orderdetails_subtotal_format);
		$(this).closest('tr').find("input[name='product_orderdetails_subtotal_hidden[]']").val(product_orderdetails_subtotal);
		//grand disc final
		disc_final_total = disc_final_total + (subtotal_hidden*(disc_final/100));
		//grand tax
		tax_total = tax_total + (product_orderdetails_subtotal*(ptax/100));
		//grand total
		grandtotal = grandtotal + product_orderdetails_subtotal;
		//stock trade & profit total
		profittotal = profittotal + subprofit;
		stock_trade = stock_trade + product_orderdetails_btotal;
    	});
		//calculate total
		var product_order_cost = $("#product_order_cost").val();
		var product_order_sale_deposit = $("#product_order_sale_deposit").val();
		product_order_cost=product_order_cost.replace(/,/g, "");
		product_order_cost=parseFloat(product_order_cost);
		var product_order_total = (grandtotal + tax_total + product_order_cost)-product_order_sale_deposit;
		//display
		var grandtotal_format=grandtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#product_orderdetails_total").val(grandtotal_format);
		$("#product_orderdetails_total_hidden").val(grandtotal);
		var tax_total_format=tax_total.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#product_order_tax").val(tax_total_format);
		$("#product_order_tax_hidden").val(tax_total);
		var product_order_total_format=product_order_total.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#product_order_total").val(product_order_total_format);
		$("#product_order_total_cash").val(product_order_total_format);
		$("span.amount_total").html(product_order_total_format);
		$("#product_order_total_bank").val(product_order_total_format);
		$("#product_order_total_credit").val(product_order_total_format);
		$("#product_order_total_hidden").val(product_order_total);
		if(vnon==0){		
		$("#product_order_discount_val").val(disc_final_total.toLocaleString('en-US', {minimumFractionDigits: 2}));
		}
		$("#product_order_discount_val_hidden").val(disc_final_total);
		//set stock trade & profit total hidden
		$("#income_trade_hidden").val(profittotal);
		$("#stock_trade_hidden").val(stock_trade);
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

/* product list edit modal */
$(function () {
$('.dyn_product_order_sale').on('click', 'a.product_order_sale_edit', function () {
    var myModal = $('#myModal');

    // now get the values from the table
	var product_id = $(this).closest('tr').find("input[name='product_scode_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var product_orderdetails_price = $(this).closest('tr').find("div.product_orderdetails_price").html();
	var product_orderdetails_quantity = $(this).closest('tr').find("div.product_orderdetails_quantity").html();
	var product_orderdetails_discount = $(this).closest('tr').find("div.product_orderdetails_discount").html();
	var product_orderdetails_discount_val = $(this).closest('tr').find("div.product_orderdetails_discount_val").html();
	var product_orderdetails_tax = $(this).closest('tr').find("div.product_orderdetails_tax").html();
	
	var product_shtquantity = $(this).closest('tr').find("div.product_shtquantity").html();
	var product_spoquantity = $(this).closest('tr').find("div.product_spoquantity").html();
	var product_quantity = $(this).closest('tr').find("div.product_quantity").html();
	var product_bpoquantity = $(this).closest('tr').find("div.product_bpoquantity").html();
	var product_orderdetails_quantityold_hidden = product_orderdetails_quantity;
	
	var product_orderdetails_bprice_hidden = $(this).closest('tr').find("input[name='product_orderdetails_bprice_hidden[]']").val();

    // and set them in the modal:
	$('#product_scode', myModal).val(product_id);
	$('#product_orderdetails_price', myModal).val(product_orderdetails_price);
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
	$('#product_orderdetails_bprice_hidden', myModal).val(product_orderdetails_bprice_hidden);
	
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

/* product list edit submit modal */
$(function () {
var myModal = $('#myModal');
$('.product_order_sale_edit_details2', myModal).click(function () {
$('.ajax_loader', myModal).show();
var product_scode = $('#product_scode', myModal).val();
var product_orderdetails_price = $('#product_orderdetails_price', myModal).val();
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
var product_order_id =$('#product_order_id', myModal).val();
var product_orderdetails_quantityold_hidden =0;
if(product_order_id>0){
product_orderdetails_quantityold_hidden = $('#product_orderdetails_quantityold_hidden', myModal).val();
}

//ready stock cek
var ready_stock=product_quantity_hidden-product_spoquantity_hidden-(product_orderdetails_quantity-product_orderdetails_quantityold_hidden);
if(ready_stock < 0 && $("#ht_type").length == 0 && company_stock_block==1){
alert("Maaf Stok Tidak Mencukupi");
$('.ajax_loader', myModal).hide();
$('#myModal').modal('hide');
}else{

	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	
	var html ='<td class="listnum_product_order_sale">#</td>';
    html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_scode">'+product_scode+'</div><input name="product_scode_hidden[]" type="hidden" value="'+product_scode+'"/></a></td>';
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
	
	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_product_order_sale();
	$('#myModal').modal('hide');
	}
	});
});


/** total **/
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


/* product_order_sale_total on keyup */
$(function () {
	$('.product_order_sale_total').on('keyup', function () {
        calc_product_order_sale();
	})
})

/* product_order_discount_val on keyup */
$(function () {
	$('#product_order_discount_val').on('keyup', function () {
        var pdisc = $("#product_order_discount").val();
		pdisc = parseFloat(pdisc) || 0;
		//if ( pdisc == '' ) pdisc = 0;
		var pdisc_val = $("#product_order_discount_val").val();
		pdisc_val=pdisc_val.replace(/,/g, "");
        var pdisc_val_hidden = $("#product_order_discount_val_hidden").val();
		pdisc_val_hidden = parseFloat(pdisc_val_hidden) || 0;
		//if ( pdisc_val_hidden == '' ) pdisc_val_hidden = 0;
		var product_orderdetails_total = (pdisc_val_hidden/pdisc)*100;
		if(pdisc_val_hidden==0){
		product_orderdetails_total=$("#product_orderdetails_total_hidden").val();
		}
		var pdisc_new = (pdisc_val/product_orderdetails_total)*100;
		pdisc_new = parseFloat(pdisc_new) || 0;
        $("#product_order_discount").val(pdisc_new.toLocaleString('en-US', {minimumFractionDigits: 2}));
		calc_product_order_sale(1);
	})
})  

/* HT_Reload click */
$(function () {
	$('#HT_Reload').on('click', function() {
		$('#myloading').fadeIn(500);
		reset_list_sale();	
		var po_code = $("#po_code").val();	
		var po_code_arr=po_code.split(" - ");
		if(po_code_arr.length==2){
		var product_order_code=po_code_arr[0];
		$.ajax({
		type: "POST",        
		url: "../inventory/hotline-reload-list.php?product_order_code="+product_order_code,
		cache: false,
		async : true,
		complete: function () {
			$('#myloading').fadeOut(500);
			},
		error: function(xhr){
			alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
			$('#myloading').fadeOut(500);
			},
		success: function(data){
		var data_arr=data.split(";");
			var list = $('.dyn_product_order_sale');
			var data_sub_arr="";
			var product_scode="";
			var product_orderdetails_price="";
			var product_orderdetails_discount="";
			var product_orderdetails_discount_val="";
			var product_orderdetails_quantity ="";
			var product_orderdetails_subtotal ="";
			var value="";
			var value2="";
			var product_orderdetails_subtotal_val="";
			var product_orderdetails_tax =0;
			var product_orderdetails_discount_unf="";
			var product_orderdetails_discount_val_fmt="";
			var product_orderdetails_tax_unf="";
			
			var product_shtquantity_hidden =0;
			var product_spoquantity_hidden =0;
			var product_quantity_hidden =0;
			var product_bpoquantity_hidden =0;
			
			var users_code ="";
			var product_orderdetails_bprice_hidden =0;
			
			var html = "";
			for (i = 0; i < data_arr.length; i++) { 
			data_sub_arr=data_arr[i].split(" - ");
			
			product_scode=data_sub_arr[0]+" - "+data_sub_arr[1];
			product_orderdetails_price=data_sub_arr[2];
			product_orderdetails_discount=data_sub_arr[3];
			product_orderdetails_discount_val=data_sub_arr[5];
			product_orderdetails_quantity =data_sub_arr[4];
			product_orderdetails_subtotal =(product_orderdetails_price-product_orderdetails_discount_val)*product_orderdetails_quantity;
			value=product_orderdetails_price;
			value2=product_orderdetails_quantity;
			product_orderdetails_subtotal_val=product_orderdetails_subtotal;
			product_orderdetails_tax =0;
			product_orderdetails_discount_unf=product_orderdetails_discount;
			product_orderdetails_discount_val_fmt=product_orderdetails_discount_val.toLocaleString('en-US', {minimumFractionDigits: 2});
			product_orderdetails_tax_unf=product_orderdetails_tax;
			
			product_shtquantity_hidden =data_sub_arr[6];
			product_spoquantity_hidden =data_sub_arr[7];
			product_quantity_hidden =data_sub_arr[8];
			product_bpoquantity_hidden =data_sub_arr[9];
			
			users_code =data_sub_arr[10]+" - "+data_sub_arr[11];
			product_orderdetails_bprice_hidden =data_sub_arr[12];

			html = '<tr>';
			html +='<td class="listnum_product_order_sale">#</td>';
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_scode">'+product_scode+'</div><input name="product_scode_hidden[]" type="hidden" value="'+product_scode+'"/></a></td>';
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_price">'+product_orderdetails_price+'</div><input name="product_orderdetails_price_hidden[]" type="hidden" value="'+value+'"/><input name="product_orderdetails_bprice_hidden[]" type="hidden" value="'+product_orderdetails_bprice_hidden+'"/></a></td>';
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_quantity">'+product_orderdetails_quantity+'</div><input name="product_orderdetails_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
			
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount">'+product_orderdetails_discount+'</div><input name="product_orderdetails_discount_hidden[]" type="hidden" value="'+product_orderdetails_discount+'"/></a></td>';
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount_val">'+product_orderdetails_discount_val_fmt+'</div><input name="product_orderdetails_discount_val_hidden[]" type="hidden" value="'+product_orderdetails_discount_val+'"/></a></td>';
			html +='<td class="td_hide"><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_tax">'+product_orderdetails_tax+'</div><input name="product_orderdetails_tax_hidden[]" type="hidden" value="'+product_orderdetails_tax_unf+'"/></a></td>';
			
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_subtotal">'+product_orderdetails_subtotal+'</div><input class="subtotal_hidden" name="product_orderdetails_subtotal_hidden[]" type="hidden" value="'+product_orderdetails_subtotal_val+'"/></a></td>';
			
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div>'+product_shtquantity_hidden+'</div></a></td>';
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div>'+product_spoquantity_hidden+'</div></a></td>';
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div>'+product_quantity_hidden+'</div></a></td>';
			html +='<td><a href="#" class="link_table product_order_sale_edit"><div>'+product_bpoquantity_hidden+'</div></a></td>';
			
			html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_product_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
			html +='</tr>';
			list.append($(html));
			calc_product_order_sale();
			//$(".dyn_product_order_sale").append($());
			//end loop
			}
		//inner 1 append
		$('tr#inner1').remove();
	   	calc_product_order_sale();
	   	//clear input
		$('.typehead_customer #users_code').typeahead('val', users_code);
		$('.typehead_product #product_scode').typeahead('val', '');
		$('#product_orderdetails_price').val("");
		$('#product_orderdetails_quantity').val("");
		$('#product_orderdetails_subtotal').val("");
		$('#product_orderdetails_discount').val("");
		$('#product_orderdetails_discount_val').val("");
		$('#product_orderdetails_tax').val("");
		$("#product_scode").focus();
		$('#myloading').fadeOut(500);
		}
		});
		// Return false to prevent the browser from processing the enter keypress
		return false;
		}else{
		$("#po_code").focus();
		$('#myloading').fadeOut(500);
		}
	});
})

/* reset list */
function reset_list_sale() {
    	$('.subtotal_hidden').each(function (index, element) {
		//list num
		$(this).closest('tr').remove();
		})
   }

/* HT popup */
$('a.product_order_sale_pend_edit').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var product_order_id = $(this).closest('tr').find('td.product_order_id_hidden').html();
	product_order_id = $(product_order_id).text();
	var po_code = $(this).closest('tr').find('td.po_code_hidden').html();
	po_code = $(po_code).text();
    // and set them in the modal:
	$('#product_order_id', myModal).val(product_order_id);
	//cek status
	var edit_link = "location.href='product-sale-pend-edit.php?product_order_id="+product_order_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var invoice_link = "location.href='product-sale-new.php?po_code="+po_code+"'";
	$('button#btn_invoice', myModal).attr('onclick',invoice_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/** show hide product_order_sale_pay **/
$('input[name=product_order_sale_pay]').click(function () {
    if (this.id == "product_order_sale_pay1_0") {
        $("#product_order_sale_pay_cash").show();
		$("#product_order_sale_pay_bank").hide();
		$("#product_order_sale_pay_credit").hide();
		$("#Submit").hide();
		$("#Submitpay").show();
	} else if (this.id == "product_order_sale_pay1_1") {
        $("#product_order_sale_pay_cash").hide();
		$("#product_order_sale_pay_bank").show();
		$("#product_order_sale_pay_credit").hide();
	} else {
        $("#product_order_sale_pay_cash").hide();
		$("#product_order_sale_pay_bank").hide();
		$("#product_order_sale_pay_credit").show();
		$("#Submit").show();
		$("#Submitpay").hide();
    }
});

/* calc_modal show */
$(function () {
$(".calc_modal").on("click", function() {
    var myModal = $('#calc_modal');
	var product_order_calc_bill = $('#product_order_total_cash').val();
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
	$('.ajax_loader', myModal).show();
	$('.modal').modal('hide');
	//$("button[name='Submit']").click();
	$('#Submit').click();
	});
});

/** product_order_sale view **/
$('a.product_order_sale_pend_edit').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var product_order_id = $(this).closest('tr').find('td.product_order_id_hidden').html();
	product_order_id = $(product_order_id).text();
	var po_code = $(this).closest('tr').find('td.po_code_hidden').html();
	po_code = $(po_code).text();
    // and set them in the modal:
	$('#product_order_id', myModal).val(product_order_id);
	//cek status
	var edit_link = "location.href='product-sale-pend-edit.php?product_order_id="+product_order_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var invoice_link = "location.href='product-sale-new.php?po_code="+po_code+"'";
	$('button#btn_invoice', myModal).attr('onclick',invoice_link);
	var print_url="pdf/sales-ht-pdf.php?product_order_id="+product_order_id;
	var print_link = "window.open('"+print_url+"', '_blank');return false;";
	$('button#btn_print', myModal).attr('onclick',print_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* sales Edit popup */
$('a.product_order_sale_pend_real_modal').on('click', function() {
    var myModal = $('#myModalreal');
    // now get the values from the table
	var product_order_id = $(this).closest('tr').find('td.product_order_id_hidden').html();
	product_order_id = $(product_order_id).text();
    // and set them in the modal:
	$('#product_order_id', myModal).val(product_order_id);
	//cek status
	var edit_link = "location.href='product-sale-pend-real.php?product_order_id="+product_order_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
    myModal.modal({ show: true });
    return false;
});

/* Sales Edit popup */
$('a.product_order_sale_edit_modal').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var product_order_id = $(this).closest('tr').find('td.product_order_id_hidden').html();
	product_order_id = $(product_order_id).text();
	var product_order_status = $(this).closest('tr').find('td.product_order_status_hidden').html();
	product_order_status = $(product_order_status).text();
    // and set them in the modal:
	$('#product_order_id', myModal).val(product_order_id);
	//cek status
	var edit_link = "location.href='product-sale-edit.php?product_order_id="+product_order_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var pay_link = "location.href='product-sale-pay.php?product_order_id="+product_order_id+"'";
	$('button#btn_pay', myModal).attr('onclick',pay_link);
	var print_url="pdf/sales-inv-pdf.php?product_order_id="+product_order_id;
	var print_link = "window.open('"+print_url+"', '_blank');return false;";
	$('button#btn_print', myModal).attr('onclick',print_link);
	//show hide
	$('button#btn_edit', myModal).hide();
	if(product_order_status=="tmp"){
		$('button#btn_edit', myModal).show();
		}
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* Sales Edit popup */
$('a.product_order_sale_retur_edit_modal').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var product_order_id = $(this).closest('tr').find('td.product_order_id_hidden').html();
	product_order_id = $(product_order_id).text();
	var product_order_status = $(this).closest('tr').find('td.product_order_status_hidden').html();
	product_order_status = $(product_order_status).text();
    // and set them in the modal:
	$('#product_order_id', myModal).val(product_order_id);
	//cek status
	var edit_link = "location.href='product-sale-retur-edit.php?product_order_id="+product_order_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var pay_link = "location.href='product-sale-retur-pay.php?product_order_id="+product_order_id+"'";
	$('button#btn_pay', myModal).attr('onclick',pay_link);
	var print_url="pdf/sales-rtn-pdf.php?product_order_id="+product_order_id;
	var print_link = "window.open('"+print_url+"', '_blank');return false;";
	$('button#btn_print', myModal).attr('onclick',print_link);
	//show hide
	$('button#btn_edit', myModal).hide();
	if(product_order_status=="tmp"){
		$('button#btn_edit', myModal).show();
		}
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
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

/** typeahead:selected **/
$("input[type='text']").on('typeahead:selected', function (e, datum) {
    var kp=$(this).attr("rel");
	var tval=$(this).val();
	$(this).typeahead('val', tval);
	$("#"+kp+"").focus();
})

/* reset product_view_modal */
function reset_product_list(myModal) {
   		$(".dyn_list",myModal).empty();
   }
   
/* func generate customer list */
function gen_product_list(keyword,myModal) {
    $.ajax({
	type: "POST",        
	url: "../inventory/ajax/product-sale-list.php?search="+keyword,
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
		var product_code=data['product_code'];
		var list = $('.dyn_list',myModal);
			var html = "";
			for (i = 0; i < data.length; i++) { 
			var j =i+1;
			
			
			html = '<tr>';
			html +='<td bgcolor="#FFFFFF">'+j+'</td>';
			html +='<td bgcolor="#FFFFFF"><input class="id_set" name="id[]" type="checkbox" id="id[]" value="'+data[i]['product_id']+'" /></td>';
			html +='<td bgcolor="#FFFFFF" class="product_code"><a href="#" class="link_table product_edit">'+data[i]['product_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_name"><a href="#" class="link_table product_edit">'+data[i]['product_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_sprice"><a href="#" class="link_table product_edit">'+data[i]['product_sprice']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_stock"><a href="#" class="link_table product_edit">'+data[i]['product_stock']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_id_hidden td_hide"><a href="#" class="link_table product_edit">'+data[i]['product_id']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_code_hidden td_hide"><a href="#" class="link_table product_edit">'+data[i]['product_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_name_hidden td_hide"><a href="#" class="link_table product_edit">'+data[i]['product_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_sprice_hidden td_hide"><a href="#" class="link_table product_edit">'+data[i]['product_sprice']+'</a></td>';
			html +='</tr>';
			list.append($(html));
		}
	$('#myloading').fadeOut(500);
	}
	});
   }

/* product_edit open modal */
$(function () {
$('.dyn_list').on('click', 'a.product_edit', function () {
    $('.modal').modal('hide');

    // now get the values from the table
	var product_id = $(this).closest('tr').find('td.product_id_hidden').html();
	product_id = $(product_id).text();
    var product_code = $(this).closest('tr').find('td.product_code').html();
	product_code = $(product_code).text();
    var product_name = $(this).closest('tr').find('td.product_name').html();
	product_name = $(product_name).text();
	var product_sprice = $(this).closest('tr').find('td.product_sprice').html();
	product_sprice = $(product_sprice).text();
	var product_scode=product_code+" - "+product_name;

	// and set them in the modal:
	$('.typehead_product #product_scode').typeahead('val', product_scode);
	var users_code = $("#users_code").val();
	if($.trim(users_code) == ''){
	$("#users_code").focus();
	$('.typehead_product #product_scode').typeahead('val', '');
	alert("Kode Pembeli Kosong");
	}else{
	pbcode_onchange(product_scode,users_code);
	}

    return false;
});
});

/* on search modal enter */
$(function () {
var myModal = $('#product_view_modal');
$('#search', myModal).on('keydown', function (e) {
if(e.which == 13) {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_product_list(myModal);
	gen_product_list(keyword,myModal);

    return false;
	}
	})
})

/* btn_search modal click */
$(function () {
var myModal = $('#product_view_modal');
$('#btn_search', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_product_list(myModal);
	gen_product_list(keyword,myModal);

    return false;
	})
})


/* product_view_modal show */
$(function () {
$('#product_view_alink').on('click', function () {
    $('#myloading').fadeIn(500);
	var myModal = $('#product_view_modal');
	//get list view
	reset_product_list(myModal);
	gen_product_list('',myModal);
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
	})
})
   
