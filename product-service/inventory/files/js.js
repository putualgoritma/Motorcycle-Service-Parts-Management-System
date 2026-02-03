$("input[type='text']").on('typeahead:selected', function (e, datum) {
    var kp=$(this).attr("rel");
	$("#"+kp+"").focus();
})

//**product_sprice_range
function product_sprice_range() {
	//get input val
	var product_sprice_range_min =$('#product_sprice_range_min').val();
	var product_sprice_range_price =$('#product_sprice_range_price').val();
	var list = $('.dyn_product_sprice_range');
	var html = '<tr>';
	html +='<td class="text-center">#</td>';
    html +='<td>'+product_sprice_range_min+'<input name="product_sprice_range_min_hidden[]" type="hidden" value="'+product_sprice_range_min+'"/></td>';
    html +='<td>'+product_sprice_range_price+'<input name="product_sprice_range_price_hidden[]" type="hidden" value="'+product_sprice_range_price+'"/></td>';
    html +='<td class="text-center"><a href="javascript:;" class="btn btn-danger" onclick="remove_product_sprice_range(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	html +='</tr>';
	list.append($(html));
	$(".dyn_product_sprice_range").append($());
	//clear input
	$('#product_sprice_range_min').val("");
	$('#product_sprice_range_price').val("");
	$("#product_sprice_range_min").focus();
};

function remove_product_sprice_range(el) {
	   //$('#inner_product_sprice_range'+rid).remove();
	   $(el).closest('tr').remove();
	   $("#product_sprice_range_min").focus();
   }
   
//**product_sprice_level
function product_sprice_level() {
	//get input val
	var customer_level_code =$('#customer_level_code').val();
	var customer_level_code_arr=customer_level_code.split(";");
	var customer_level_code_val=customer_level_code_arr[0];
	var customer_level_name_val=customer_level_code_arr[1];
	var product_sprice_level_price =$('#product_sprice_level_price').val();
	var list = $('.dyn_product_sprice_level');
	var html = '<tr>';
	html +='<td class="text-center">#</td>';
    html +='<td>'+customer_level_name_val+'<input name="customer_level_code_hidden[]" type="hidden" value="'+customer_level_code_val+'"/></td>';
    html +='<td>'+product_sprice_level_price+'<input name="product_sprice_level_price_hidden[]" type="hidden" value="'+product_sprice_level_price+'"/></td>';
    html +='<td class="text-center"><a href="javascript:;" class="btn btn-danger" onclick="remove_product_sprice_level(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	html +='</tr>';
	list.append($(html));
	$(".dyn_product_sprice_level").append($());
	//clear input
	$('#customer_level_code').val("");
	$('#product_sprice_level_price').val("");
	$("#customer_level_code").focus();
};

function remove_product_sprice_level(el) {
	   //$('#inner_product_sprice_level'+rid).remove();
	   $(el).closest('tr').remove();
	   $("#customer_level_code").focus();
   }
   
//**show hide commission type 
$('input[name=product_commission_type]').click(function () {
    if (this.id == "product_commission_type1_0") {
        $("#product_commission_type_percent").show();
		$("#product_commission_type_nominal").hide();
    } else {
        $("#product_commission_type_percent").hide();
		$("#product_commission_type_nominal").show();
    }
});

//**show hide product_order_buy_pay 
$('input[name=product_order_buy_pay]').click(function () {
    if (this.id == "product_order_buy_pay1_0") {
        $("#product_order_buy_pay_cash").show();
		$("#product_order_buy_pay_bank").hide();
		$("#product_order_buy_pay_credit").hide();
	} else if (this.id == "product_order_buy_pay1_1") {
        $("#product_order_buy_pay_cash").hide();
		$("#product_order_buy_pay_bank").show();
		$("#product_order_buy_pay_credit").hide();
	} else {
        $("#product_order_buy_pay_cash").hide();
		$("#product_order_buy_pay_bank").hide();
		$("#product_order_buy_pay_credit").show();
    }
});

//**show hide commission type 
$('input[name=service_commission_type]').click(function () {
    if (this.id == "service_commission_type1_0") {
        $("#service_commission_type_percent").show();
		$("#service_commission_type_nominal").hide();
    } else {
        $("#service_commission_type_percent").hide();
		$("#service_commission_type_nominal").show();
    }
});

//**on change stock_type
$("#stock_type").change(function() {
var n = $(this).val();
var path = $('#redirect_path').val();
switch(n)
 {
 case 'part':
   $('#form_stock').attr('action', path+'csv/csv-product.php');
   $('a.link_import').attr("href", path+'csv/csv-product.php');
   break;
 case 'opname':
   $('#form_stock').attr('action', path+'csv/csv-product-stock.php');
   $('a.link_import').attr("href", path+'csv/csv-product-stock.php');
   break;
 case 'fm':
   $('#form_stock').attr('action', path+'csv/csv-product-fm.php');
   $('a.link_import').attr("href", path+'csv/csv-product-fm.php');
   break;
 }
});

/* product list insert */
function warehouse_stock() {
	//get input val
	var product_bcode =$('#product_bcode').val();
	var warehouse_stock_details_quantity =$('#warehouse_stock_details_quantity').val();
	var value2=warehouse_stock_details_quantity.replace(/,/g, "");
	if(!product_on_list_exist(product_bcode,warehouse_stock_details_quantity)){
	var list = $('.dyn_warehouse_stock');
	var html = '<tr>';
    html +='<td class="listnum_warehouse_stock">#</td>';
	html +='<td><a href="#" class="link_table warehouse_stock_edit"><div class="product_bcode">'+product_bcode+'</div><input name="product_bcode_hidden[]" type="hidden" value="'+product_bcode+'"/></a></td>';
    html +='<td><a href="#" class="link_table warehouse_stock_edit"><div class="warehouse_stock_details_quantity">'+warehouse_stock_details_quantity+'</div><input name="warehouse_stock_details_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_warehouse_stock(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_warehouse_stock").append($());
	}
	calc_warehouse_stock();
	//clear input
	$('.typehead_product #product_bcode').typeahead('val', '');
	$('#warehouse_stock_details_quantity').val("");
	$("#product_bcode").focus();
};



/* product list remove */
function remove_warehouse_stock(el) {
	   $(el).closest('tr').remove();
	   $("#product_bcode").focus();
	   calc_warehouse_stock();
   }
   
/* product list calc */
function calc_warehouse_stock() {
    	$('.listnum_warehouse_stock').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_warehouse_stock').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		})
   }
   

/* product list edit modal */
$(function () {
$('.dyn_warehouse_stock').on('click', 'a.warehouse_stock_edit', function () {
    var myModal = $('#myModal');
    // now get the values from the table
	var product_id = $(this).closest('tr').find("input[name='product_bcode_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var warehouse_stock_details_quantity = $(this).closest('tr').find("div.warehouse_stock_details_quantity").html();
	$('#warehouse_stock_details_quantity', myModal).val(warehouse_stock_details_quantity);
	$('#inner_id_hidden', myModal).val(inner_id);
	var randnum = Math.floor((Math.random() * 100) + 1);
	$('#product_bcode', myModal).closest('div').remove();
	var list = $('.append_div', myModal);
	html ='<div class="col-md-8"><input name="product_code" type="text" class="textbox firstin auto_foc" id="product_bcode"> <span id="product_bcode_label">&nbsp;</span></div>';
	list.append($(html));
	$('#product_bcode', myModal).closest('div').addClass('typehead_product'+randnum);
	$('#product_bcode', myModal).val(product_id);
	//product
	var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
	var randomUniqueId = randLetter + Date.now();
	var countries = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		limit: 10,
		remote: {
		ttl: 1,
		url: '../inventory/product-list.php?search=%QUERY',
		wildcard: "%QUERY",
		filter: function(list) {
		return $.map(list, function(country) { return { name: country }; });
		}}
		});
	countries.initialize();
	$('.typehead_product'+randnum+' #product_bcode').typeahead(null, {
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
	// and finally show the modal
    myModal.modal({ show: true });
    return false;
});
});



/* product list edit submit modal */
$(function () {
var myModal = $('#myModal');
$('.warehouse_stock_edit_details2', myModal).click(function () {
$('.ajax_loader', myModal).show();
var product_bcode = $('#product_bcode', myModal).val();
var warehouse_stock_details_quantity = $('#warehouse_stock_details_quantity', myModal).val();
var value2=warehouse_stock_details_quantity.replace(/,/g, "");
var inner_id = $('#inner_id_hidden', myModal).val();
	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	var html ='<td class="listnum_warehouse_stock">#</td>';
    html +='<td><a href="#" class="link_table warehouse_stock_edit"><div class="product_bcode">'+product_bcode+'</div><input name="product_bcode_hidden[]" type="hidden" value="'+product_bcode+'"/></a></td>';
    html +='<td><a href="#" class="link_table warehouse_stock_edit"><div class="warehouse_stock_details_quantity">'+warehouse_stock_details_quantity+'</div><input name="warehouse_stock_details_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_warehouse_stock(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_warehouse_stock();
	$('#myModal').modal('hide');
	});
});

/* product list edit submit modal */
$(function () {
var myModal = $('#myModal');
$('.warehouse_bag_edit_details', myModal).click(function () {
$('.ajax_loader', myModal).show();
var product_bcode = $('#product_bcode', myModal).val();
var warehouse_stock_details_quantity = $('#warehouse_stock_details_quantity', myModal).val();
var value2=warehouse_stock_details_quantity.replace(/,/g, "");
var product_orderdetails_quantity = $('#product_orderdetails_quantity', myModal).val();
var value3=product_orderdetails_quantity.replace(/,/g, "");
var inner_id = $('#inner_id_hidden', myModal).val();
	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	var html ='<td class="listnum_warehouse_stock">#</td>';
    html +='<td><a href="#" class="link_table warehouse_bag_edit"><div class="product_bcode">'+product_bcode+'</div><input name="product_bcode_hidden[]" type="hidden" value="'+product_bcode+'"/></a></td>';
    html +='<td><a href="#" class="link_table warehouse_bag_edit"><div class="product_orderdetails_quantity">'+product_orderdetails_quantity+'</div><input name="product_orderdetails_quantity_hidden[]" type="hidden" value="'+value3+'"/></a></td>';
	html +='<td><a href="#" class="link_table warehouse_bag_edit"><div class="warehouse_stock_details_quantity">'+warehouse_stock_details_quantity+'</div><input name="warehouse_stock_details_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
    html +='<td>&nbsp;</td>';
	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_warehouse_stock();
	$('#myModal').modal('hide');
	});
});

/* product list edit modal */
$(function () {
$('.dyn_warehouse_stock').on('click', 'a.warehouse_bag_edit', function () {
    var myModal = $('#myModal');
    // now get the values from the table
	var product_id = $(this).closest('tr').find("input[name='product_bcode_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var warehouse_stock_details_quantity = $(this).closest('tr').find("div.warehouse_stock_details_quantity").html();
	$('#warehouse_stock_details_quantity', myModal).val(warehouse_stock_details_quantity);
	var product_orderdetails_quantity = $(this).closest('tr').find("div.product_orderdetails_quantity").html();
	$('#product_orderdetails_quantity', myModal).val(product_orderdetails_quantity);
	$('#inner_id_hidden', myModal).val(inner_id);
	$('#product_bcode', myModal).val(product_id);
	// and finally show the modal
    myModal.modal({ show: true });
    return false;
});
});

/* on payreceivable_accountcredit enter */
$('.typehead_product #product_bcode').on('change', function (e) {
	var scode = $(this).val();
	product_bcode_onchange(scode);
});

/* on product_scode exec */
function product_bcode_onchange(scode) {
	$('#myloading').fadeIn(500);		
	$.post(
	"../inventory/product-getcode.php?scode="+scode, // Use the action from HTML form
	function(data){ // When the form submission is complete, run this function
	if(data == 1){
	alert("Kode Salah");
	$('.typehead_product #product_bcode').typeahead('val', '');
	$('.typehead_product #product_bcode').focus();
	$('#myloading').fadeOut(500);
	}else{
	var data_arr=data.split(";");
	var product_name=data_arr[0];
	var product_scode=data_arr[8]+' - '+product_name;
	$('.typehead_product #product_bcode').typeahead('val', product_scode);
	$("#warehouse_stock_details_quantity").val(1);
	$("#warehouse_stock_details_quantity").focus();
	}
	$('#myloading').fadeOut(500);
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* cek if already on list product */
function product_on_list_exist(product_code,add_qty) {
	var return_val=false;
	var product_code_arr=product_code.split(" - ");
	var product_code_val = product_code_arr[0];
	$('.listnum_warehouse_stock').each(function (index, element) {
	var product_bcode_hidden = $(this).closest('tr').find("input[name='product_bcode_hidden[]']").val();
	var product_bcode_hidden_arr=product_bcode_hidden.split(" - ");
	var product_code_hidden_val = product_bcode_hidden_arr[0];
	if(product_code_hidden_val==product_code_val){
		var inner_id = $(this).closest('tr').attr("id");
		var old_qty=parseInt($(this).closest('tr').find("input[name='warehouse_stock_details_quantity_hidden[]']").val());
		var warehouse_stock_details_quantity = old_qty+parseInt(add_qty);
		var html ='<td class="listnum_warehouse_stock">#</td>';
		html +='<td><a href="#" class="link_table warehouse_stock_edit"><div class="product_bcode">'+product_code+'</div><input name="product_bcode_hidden[]" type="hidden" value="'+product_code+'"/></a></td>';
		html +='<td><a href="#" class="link_table warehouse_stock_edit"><div class="warehouse_stock_details_quantity">'+warehouse_stock_details_quantity+'</div><input name="warehouse_stock_details_quantity_hidden[]" type="hidden" value="'+warehouse_stock_details_quantity+'"/></a></td>';
		html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_warehouse_stock(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
		$('#'+inner_id).html($(html));
		return_val=true;
		}
	});
return return_val;
}


/* on payreceivable_accountcredit enter */
$('.typehead_product_opname #product_bcode').on('change', function (e) {
	var scode = $(this).val();
	product_bcode_opname_onchange(scode);
});

/* on product_scode exec */
function product_bcode_opname_onchange(scode) {
	$('#myloading').fadeIn(500);		
	$.post(
	"../inventory/product-getcode.php?scode="+scode, // Use the action from HTML form
	function(data){ // When the form submission is complete, run this function
	if(data == 1){
	alert("Kode Salah");
	$('.typehead_product_opname #product_bcode').typeahead('val', '');
	$('.typehead_product_opname #product_bcode').focus();
	$('#myloading').fadeOut(500);
	}else{
	var data_arr=data.split(";");
	var product_name=data_arr[0];
	var product_scode=data_arr[8]+' - '+product_name;
	var qty_bln=data_arr[6]-1;
	$('.typehead_product_opname #product_bcode').typeahead('val', product_scode);
	$("#warehouse_stock_details_quantity").val(1);
	$("#warehouse_stock_details_quantity_sys").val(data_arr[6]);
	$("#warehouse_stock_details_quantity_bln").val(qty_bln);
	$("#warehouse_stock_details_quantity").focus();
	}
	$('#myloading').fadeOut(500);
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* product list insert */
function warehouse_stock_opname() {
	//get input val
	var product_bcode =$('#product_bcode').val();
	var warehouse_stock_details_quantity =$('#warehouse_stock_details_quantity').val();
	var warehouse_stock_details_quantity_sys =$('#warehouse_stock_details_quantity_sys').val();
	var warehouse_stock_details_quantity_bln =$('#warehouse_stock_details_quantity_bln').val();
	var value2=warehouse_stock_details_quantity.replace(/,/g, "");
	if(!product_opname_on_list_exist(product_bcode,warehouse_stock_details_quantity)){
	var list = $('.dyn_warehouse_stock_opname');
	var html = '<tr>';
    html +='<td class="listnum_warehouse_stock">#</td>';
	html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="product_bcode">'+product_bcode+'</div><input name="product_bcode_hidden[]" type="hidden" value="'+product_bcode+'"/></a></td>';
    html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity">'+warehouse_stock_details_quantity+'</div><input name="warehouse_stock_details_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
	html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity_sys">'+warehouse_stock_details_quantity_sys+'</div></a></td>';
	html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity_bln">'+warehouse_stock_details_quantity_bln+'</div></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_warehouse_stock_opname(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_warehouse_stock_opname").append($());
	}
	calc_warehouse_stock_opname();
	//clear input
	$('.typehead_product_opname #product_bcode').typeahead('val', '');
	$('#warehouse_stock_details_quantity').val("");
	$('#warehouse_stock_details_quantity_sys').val("");
	$('#warehouse_stock_details_quantity_bln').val("");
	$("#product_bcode").focus();
};



/* product list remove */
function remove_warehouse_stock_opname(el) {
	   $(el).closest('tr').remove();
	   $("#product_bcode").focus();
	   calc_warehouse_stock_opname();
   }
   
/* product list calc */
function calc_warehouse_stock_opname() {
    	$('.listnum_warehouse_stock').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_warehouse_stock').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		})
   }
   
/* on product_order_sale keyup */
$(function () {
	$('.warehouse_stock_opname').on('keyup', function () {
        var value = $("#warehouse_stock_details_quantity").val();
        var value2 = $("#warehouse_stock_details_quantity_sys").val();
		var balance_value = value2-value;
        $("#warehouse_stock_details_quantity_bln").val(balance_value);
	})
})

/* product list edit modal */
$(function () {
$('.dyn_warehouse_stock_opname').on('click', 'a.warehouse_stock_opname_edit', function () {
    var myModal = $('#myModal');
    // now get the values from the table
	var product_id = $(this).closest('tr').find("input[name='product_bcode_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var warehouse_stock_details_quantity = $(this).closest('tr').find("div.warehouse_stock_details_quantity").html();
	var warehouse_stock_details_quantity_sys = $(this).closest('tr').find("div.warehouse_stock_details_quantity_sys").html();
	var warehouse_stock_details_quantity_bln = $(this).closest('tr').find("div.warehouse_stock_details_quantity_bln").html();
	$('#product_bcode', myModal).val(product_id);
	$('#warehouse_stock_details_quantity', myModal).val(warehouse_stock_details_quantity);
	$('#warehouse_stock_details_quantity_sys', myModal).val(warehouse_stock_details_quantity_sys);
	$('#warehouse_stock_details_quantity_bln', myModal).val(warehouse_stock_details_quantity_bln);
	$('#inner_id_hidden', myModal).val(inner_id);

	$('#warehouse_stock_details_quantity', myModal).on('keyup', function () {
		var value = $("#warehouse_stock_details_quantity", myModal).val();
		var value2 = $("#warehouse_stock_details_quantity_sys", myModal).val();
		var balance_value = value2-value;
		$("#warehouse_stock_details_quantity_bln", myModal).val(balance_value);
	})
	
	// and finally show the modal
    myModal.modal({ show: true });
    return false;
});
});



/* product list edit submit modal */
$(function () {
var myModal = $('#myModal');
$('.warehouse_stock_opname_edit_details2', myModal).click(function () {
$('.ajax_loader', myModal).show();
var product_bcode = $('#product_bcode', myModal).val();
var warehouse_stock_details_quantity = $('#warehouse_stock_details_quantity', myModal).val();
var warehouse_stock_details_quantity_sys =$('#warehouse_stock_details_quantity_sys', myModal).val();
var warehouse_stock_details_quantity_bln =$('#warehouse_stock_details_quantity_bln', myModal).val();
var value2=warehouse_stock_details_quantity.replace(/,/g, "");
var inner_id = $('#inner_id_hidden', myModal).val();
	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	var html ='<td class="listnum_warehouse_stock">#</td>';
    html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="product_bcode">'+product_bcode+'</div><input name="product_bcode_hidden[]" type="hidden" value="'+product_bcode+'"/></a></td>';
    html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity">'+warehouse_stock_details_quantity+'</div><input name="warehouse_stock_details_quantity_hidden[]" type="hidden" value="'+value2+'"/></a></td>';
    html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity_sys">'+warehouse_stock_details_quantity_sys+'</div></a></td>';
	html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity_bln">'+warehouse_stock_details_quantity_bln+'</div></a></td>';
	html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_warehouse_stock(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_warehouse_stock();
	$('#myModal').modal('hide');
	});
});

/* cek if already on list product */
function product_opname_on_list_exist(product_code,add_qty) {
	var return_val=false;
	var product_code_arr=product_code.split(" - ");
	var product_code_val = product_code_arr[0];
	$('.listnum_warehouse_stock').each(function (index, element) {
	var product_bcode_hidden = $(this).closest('tr').find("input[name='product_bcode_hidden[]']").val();
	var product_bcode_hidden_arr=product_bcode_hidden.split(" - ");
	var product_code_hidden_val = product_bcode_hidden_arr[0];
	if(product_code_hidden_val==product_code_val){
		var inner_id = $(this).closest('tr').attr("id");
		var old_qty=parseInt($(this).closest('tr').find("input[name='warehouse_stock_details_quantity_hidden[]']").val());
		var warehouse_stock_details_quantity = old_qty+parseInt(add_qty);
		var warehouse_stock_details_quantity_sys = parseInt($(this).closest('tr').find("div.warehouse_stock_details_quantity_sys").html());
		var old_qty_bln = parseInt($(this).closest('tr').find("div.warehouse_stock_details_quantity_bln").html());
		var warehouse_stock_details_quantity_bln = old_qty_bln-parseInt(add_qty);
		var html ='<td class="listnum_warehouse_stock">#</td>';
		html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="product_bcode">'+product_code+'</div><input name="product_bcode_hidden[]" type="hidden" value="'+product_code+'"/></a></td>';
		html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity">'+warehouse_stock_details_quantity+'</div><input name="warehouse_stock_details_quantity_hidden[]" type="hidden" value="'+warehouse_stock_details_quantity+'"/></a></td>';
		html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity_sys">'+warehouse_stock_details_quantity_sys+'</div></a></td>';
	html +='<td><a href="#" class="link_table warehouse_stock_opname_edit"><div class="warehouse_stock_details_quantity_bln">'+warehouse_stock_details_quantity_bln+'</div></a></td>';
		html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_warehouse_stock(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
		$('#'+inner_id).html($(html));
		return_val=true;
		}
	});
return return_val;
}

/* reset product_view_modal */
function reset_product_list(myModal) {
   		$(".dyn_list",myModal).empty();
   }
   
/* func generate customer list */
function gen_product_list(keyword,myModal) {
    $.post(
	"../inventory/ajax/product-list.php?search="+keyword, // Use the action from HTML form
	function(data){
	var data_arr=data.split(";");
			var list = $('.dyn_list',myModal);
			var data_sub_arr="";
			var html = "";
			for (i = 0; i < data_arr.length; i++) { 
			var j =i+1;
			data_sub_arr=data_arr[i].split(" - ");
			
			
			html = '<tr>';
			html +='<td bgcolor="#FFFFFF">'+j+'</td>';
			html +='<td bgcolor="#FFFFFF"><input class="id_set" name="id[]" type="checkbox" id="id[]" value="'+data_sub_arr[0]+'" /></td>';
			html +='<td bgcolor="#FFFFFF" class="product_code"><a href="#" class="link_table product_edit">'+data_sub_arr[1]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_name"><a href="#" class="link_table product_edit">'+data_sub_arr[2]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_sprice"><a href="#" class="link_table product_edit">'+data_sub_arr[3]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_stock"><a href="#" class="link_table product_edit">'+data_sub_arr[4]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_id_hidden td_hide"><a href="#" class="link_table product_edit">'+data_sub_arr[0]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_code_hidden td_hide"><a href="#" class="link_table product_edit">'+data_sub_arr[1]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_name_hidden td_hide"><a href="#" class="link_table product_edit">'+data_sub_arr[2]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_sprice_hidden td_hide"><a href="#" class="link_table product_edit">'+data_sub_arr[3]+'</a></td>';
			html +='</tr>';
			list.append($(html));
			}
	$('#myloading').fadeOut(500);
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
	product_bcode_onchange(product_scode);

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

/* reset product_view_modal */
function reset_product_list2(myModal) {
   		$(".dyn_list",myModal).empty();
   }
   
/* func generate customer list */
function gen_product_list2(keyword,myModal) {
    $.post(
	"../inventory/ajax/product-list.php?search="+keyword, // Use the action from HTML form
	function(data){
	var data_arr=data.split(";");
			var list = $('.dyn_list',myModal);
			var data_sub_arr="";
			var html = "";
			for (i = 0; i < data_arr.length; i++) { 
			var j =i+1;
			data_sub_arr=data_arr[i].split(" - ");
			
			
			html = '<tr>';
			html +='<td bgcolor="#FFFFFF">'+j+'</td>';
			html +='<td bgcolor="#FFFFFF"><input class="id_set" name="id[]" type="checkbox" id="id[]" value="'+data_sub_arr[0]+'" /></td>';
			html +='<td bgcolor="#FFFFFF" class="product_code"><a href="#" class="link_table product_edit2">'+data_sub_arr[1]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_name"><a href="#" class="link_table product_edit2">'+data_sub_arr[2]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_sprice"><a href="#" class="link_table product_edit2">'+data_sub_arr[3]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_stock"><a href="#" class="link_table product_edit2">'+data_sub_arr[4]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_id_hidden td_hide"><a href="#" class="link_table product_edit2">'+data_sub_arr[0]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_code_hidden td_hide"><a href="#" class="link_table product_edit2">'+data_sub_arr[1]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_name_hidden td_hide"><a href="#" class="link_table product_edit2">'+data_sub_arr[2]+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="product_sprice_hidden td_hide"><a href="#" class="link_table product_edit2">'+data_sub_arr[3]+'</a></td>';
			html +='</tr>';
			list.append($(html));
			}
	$('#myloading').fadeOut(500);
	});
   }

/* product_edit open modal */
$(function () {
$('.dyn_list').on('click', 'a.product_edit2', function () {
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
	$('.typehead_product_opname #product_scode').typeahead('val', product_scode);
	product_bcode_opname_onchange(product_scode);

    return false;
});
});

/* on search modal enter */
$(function () {
var myModal = $('#product_view_modal2');
$('#search', myModal).on('keydown', function (e) {
if(e.which == 13) {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_product_list2(myModal);
	gen_product_list2(keyword,myModal);

    return false;
	}
	})
})

/* btn_search modal click */
$(function () {
var myModal = $('#product_view_modal2');
$('#btn_search', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_product_list2(myModal);
	gen_product_list2(keyword,myModal);

    return false;
	})
})


/* product_view_modal show */
$(function () {
$('#product_view_alink2').on('click', function () {
    $('#myloading').fadeIn(500);
	var myModal = $('#product_view_modal2');
	//get list view
	reset_product_list2(myModal);
	gen_product_list2('',myModal);
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
	})
})

/* warehouse_stock_edit_modal */
$('a.warehouse_stock_edit_modal').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var warehouse_stock_id = $(this).closest('tr').find('td.warehouse_stock_id_hidden').html();
	warehouse_stock_id = $(warehouse_stock_id).text();
	//cek status
	var edit_link = "location.href='warehouse-stock-edit.php?warehouse_stock_id="+warehouse_stock_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var pdf_url="pdf/stock-inv-pdf.php?warehouse_stock_id="+warehouse_stock_id;
	var pdf_link = "window.open('"+pdf_url+"', '_blank');return false;";
	$('button#btn_pdf', myModal).attr('onclick',pdf_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* warehouse_stock_min_edit_modal */
$('a.warehouse_stock_min_edit_modal').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var warehouse_stock_id = $(this).closest('tr').find('td.warehouse_stock_id_hidden').html();
	warehouse_stock_id = $(warehouse_stock_id).text();
	//cek status
	var edit_link = "location.href='warehouse-stock-min-edit.php?warehouse_stock_id="+warehouse_stock_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var pdf_url="pdf/stock-inv-pdf.php?warehouse_stock_id="+warehouse_stock_id;
	var pdf_link = "window.open('"+pdf_url+"', '_blank');return false;";
	$('button#btn_pdf', myModal).attr('onclick',pdf_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* warehouse_stock_edit_modal */
$('a.warehouse_bag_edit_modal').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var warehouse_stock_id = $(this).closest('tr').find('td.warehouse_stock_id_hidden').html();
	warehouse_stock_id = $(warehouse_stock_id).text();
	var company_stock_process = $(this).closest('tr').find('td.company_stock_process_hidden').html();
	company_stock_process = $(company_stock_process).text();
	var warehouse_stock_status = $(this).closest('tr').find('td.warehouse_stock_status_hidden').html();
	warehouse_stock_status = $(warehouse_stock_status).text();
	//cek status
	var edit_link = "location.href='warehouse-bag-edit.php?warehouse_stock_id="+warehouse_stock_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	$("#btn_process", myModal).hide();
	if(company_stock_process==1){
		$("#btn_process", myModal).show();
		$("span.btn_process", myModal).html('Proses');
		if(warehouse_stock_status=="pmn"){
			$("span.btn_process", myModal).html('Edit Proses');
			}
		var process_link = "location.href='warehouse-bag-process.php?warehouse_stock_id="+warehouse_stock_id+"'";
		$('button#btn_process', myModal).attr('onclick',process_link);
		}
	var pdf_url="pdf/stock-inv-pdf.php?warehouse_stock_id="+warehouse_stock_id;
	var pdf_link = "window.open('"+pdf_url+"', '_blank');return false;";
	$('button#btn_pdf', myModal).attr('onclick',pdf_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* warehouse_stock_trs_edit_modal */
$('a.warehouse_stock_trs_edit_modal').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var warehouse_stock_id = $(this).closest('tr').find('td.warehouse_stock_id_hidden').html();
	warehouse_stock_id = $(warehouse_stock_id).text();
	//cek status
	var edit_link = "location.href='warehouse-stock-trs-edit.php?warehouse_stock_id="+warehouse_stock_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var pdf_url="pdf/stock-inv-pdf.php?warehouse_stock_id="+warehouse_stock_id;
	var pdf_link = "window.open('"+pdf_url+"', '_blank');return false;";
	$('button#btn_pdf', myModal).attr('onclick',pdf_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* warehouse_stock_opname_edit_modal */
$('a.warehouse_stock_opname_edit_modal').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var warehouse_stock_id = $(this).closest('tr').find('td.warehouse_stock_id_hidden').html();
	warehouse_stock_id = $(warehouse_stock_id).text();
	//cek status
	var edit_link = "location.href='stock-opname-edit.php?warehouse_stock_id="+warehouse_stock_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var pdf_url="pdf/stock-inv-pdf.php?warehouse_stock_id="+warehouse_stock_id;
	var pdf_link = "window.open('"+pdf_url+"', '_blank');return false;";
	$('button#btn_pdf', myModal).attr('onclick',pdf_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});

/* on product_order_sale keyup */
$(function () {
	$('.bprice_change').on('keyup', function () {
        var value = $("#product_sprice").val();
		var disc_value = $("#product_disc").val();
		value=value.replace(/,/g, "");
		disc_value=disc_value.replace(/,/g, "");
        var bprice = value-(value*(disc_value/100));
        $("#product_bprice").val(bprice.toLocaleString('en-US', {minimumFractionDigits: 2}));
	})
})


//input mask
$(document).ready(function() {
	$('#product_orderdetails_delhidden').val("");
	$('#product_orderdetails_delmin').val(0);
});
