$(document).ready(function () {
var myModal = $('#myModalnew');
$('#myModalnew').on('shown.bs.modal', function (e) {
  $(".firstin", myModal).val("");
})
});

$(document).ready(function () {
$('.ledger_general_details').click(function () {
$('.ajax_loader').show();
var thisform = $('#form_ledger');
//get input
var ledgerdetails_type = $('#ledgerdetails_type').val();
//ajax
	$.post(
	"ledger-general-details-process.php", // Use the action from HTML form
	thisform.serialize(), // Use the data from the HTML form
	function(data){ // When the form submission is complete, run this function
							
	
	// Add the new barcode entry to the list of barcodes
	var list = $('.ajax_container');
	var data_arr=data.split(";");
	var ledgerdetails_id=data_arr[0];
	var taxonomi_name=data_arr[1];
	var taxonomi_code=data_arr[2];
	var ledgerdetails_type=data_arr[3];
	var ledgerdetails_amount=data_arr[4];
	var total_debit=data_arr[5];
	var total_credit=data_arr[6];
	var html = '<tr id="inner'+ledgerdetails_id+'">';
	html +='<td><a class="ledger_general_del" href="#" rel="'+ledgerdetails_id+'"><i class="fa fa-times-circle"></i></a></td>';
	html +='<td>'+taxonomi_name+'</td>';
	html +='<td>'+taxonomi_code+'</td>';
	if(ledgerdetails_type=='D'){
		html +='<td>'+ledgerdetails_amount+'</td>';
		html +='<td>-</td>';
	}else{
		html +='<td>-</td>';
		html +='<td>'+ledgerdetails_amount+'</td>';
		}
	html +='</tr>';
	list.append($(html));
	$(".ajax_container").append($());
	$('#total_debit').html('<strong>'+total_debit+'</strong>');
	$('#total_credit').html('<strong>'+total_credit+'</strong>');
	//$('#users_name_label').html(data);

	// Empty out the Barcode textbox to be ready for the next submission
	$("#taxonomi_code").val("");
	$("#ledgerdetails_amount").val("");
	$('.ajax_loader').hide();
	$("#taxonomi_code").focus();
	});
	});
});

$(function () {
	$('.ajax_container').on('click', 'a.ledger_general_del', function () {
	var thisform = $('#form_ledger');
	var element = $(this);
	var Id = element.attr("rel");
	var cell_selected = "inner"+Id;
	element.closest("tr").remove();
	
	$.post(
	"ledger-general-details-delete.php?id="+Id, // Use the action from HTML form
	thisform.serialize(), // Use the data from the HTML form
	function(data){ // When the form submission is complete, run this function
	//$('#users_name_label').html('gablor');						
	var data_arr=data.split(";");
	var total_debit=data_arr[0];
	var total_credit=data_arr[1];
	$('#total_debit').html('<strong>'+total_debit+'</strong>');
	$('#total_credit').html('<strong>'+total_credit+'</strong>');
	});
	
	return false;
	});
});

$(document).ready(function () {
$('.cash_details').click(function () {
$('.ajax_loader').show();
var thisform = $('#form_ledger');
//get input
var ledgerdetails_type = $('#ledgerdetails_type').val();
//ajax
	$.post(
	"cash-details-process.php", // Use the action from HTML form
	thisform.serialize(), // Use the data from the HTML form
	function(data){ // When the form submission is complete, run this function
							
	
	// Add the new barcode entry to the list of barcodes
	var list = $('.ajax_container');
	var data_arr=data.split(";");
	var ledgerdetails_id=data_arr[0];
	var taxonomi_name=data_arr[1];
	var taxonomi_code=data_arr[2];
	var ledgerdetails_type=data_arr[3];
	var ledgerdetails_amount=data_arr[4];
	var total_debit=data_arr[5];
	var total_credit=data_arr[6];
	var html = '<tr id="inner'+ledgerdetails_id+'">';
	html +='<td><a class="ledger_general_del" href="#" rel="'+ledgerdetails_id+'"><i class="fa fa-times-circle"></i></a></td>';
	html +='<td>'+taxonomi_name+'</td>';
	if(ledgerdetails_type=='D'){
		html +='<td>'+ledgerdetails_amount+'</td>';
	}else{
		html +='<td>'+ledgerdetails_amount+'</td>';
		}
	html +='</tr>';
	list.append($(html));
	$(".ajax_container").append($());
	$('#total_debit').html('<strong>'+total_debit+'</strong>');
	$('#total_credit').html('<strong>'+total_credit+'</strong>');
	//$('#users_name_label').html(data);

	// Empty out the Barcode textbox to be ready for the next submission
	$("#taxonomi_code").val("");
	$("#ledgerdetails_amount").val("");
	$('.ajax_loader').hide();
	$("#taxonomi_code").focus();
	});
	});
});

$(document).ready(function () {
var myModal = $('#myModalnew');
$('.cash_details_new', myModal).click(function () {
$('.ajax_loader', myModal).show();
var thisform = $('#form_ledger_new', myModal);
//get input
var ledgerdetails_type = $('#ledgerdetails_type', myModal).val();
//ajax
	$.post(
	"cash-details-process.php", // Use the action from HTML form
	thisform.serialize(), // Use the data from the HTML form
	function(data){ // When the form submission is complete, run this function
							
	
	// Add the new barcode entry to the list of barcodes
	var list = $('.ajax_container');
	var data_arr=data.split(";");
	var ledgerdetails_id=data_arr[0];
	ledgerdetails_id=ledgerdetails_id.trim();
	var taxonomi_name=data_arr[1];
	var taxonomi_code=data_arr[2];
	var ledgerdetails_type=data_arr[3];
	var ledgerdetails_amount=data_arr[4];
	var total_debit=data_arr[5];
	var total_credit=data_arr[6];
	var ledgerdetails_amount_org=data_arr[7];
	var ledger_id=data_arr[8];
	var html = '<tr id="inner'+ledgerdetails_id+'">';
	html +='<td><a class="ledger_general_del" href="#" rel="'+ledgerdetails_id+'"><i class="fa fa-times-circle"></i></a></td>';
	html +='<td><a href="#" class="link_table ledger_new_edit">'+taxonomi_name+'</a></td>';
	if(ledgerdetails_type=='D'){
		html +='<td>'+ledgerdetails_amount+'</td>';
	}else{
		html +='<td>'+ledgerdetails_amount+'</td>';
		}
	html +='<td class="ledgerdetails_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_id+'</a></td>';
    html +='<td class="taxonomi_name_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+taxonomi_code+' - '+taxonomi_name+'</a></td>';
    html +='<td class="ledgerdetails_type_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_type+'</a></td>';
    html +='<td class="ledgerdetails_amount_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_amount_org+'</a></td>';
	html +='<td class="ledger_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledger_id+'</a></td>';
	html +='</tr>';
	list.append($(html));
	$(".ajax_container").append($());
	$('#total_debit').html('<strong>'+total_debit+'</strong>');
	$('#total_credit').html('<strong>'+total_credit+'</strong>');
	//$('#users_name_label').html(data);

	// Empty out the Barcode textbox to be ready for the next submission
	$("#taxonomi_code", myModal).val("");
	$("#ledgerdetails_amount", myModal).val("");
	$('.ajax_loader', myModal).hide();
	$('#myModalnew').modal('hide');
	//$("#taxonomi_code", myModal).focus();
	});
	});
});

$(function () {
$('.ajax_container').on('click', 'a.ledger_new_edit', function () {
    var myModal = $('#myModal');

    // now get the values from the table
	var ledger_id = $(this).closest('tr').find('td.ledger_id_hidden').html();
	ledger_id = $(ledger_id).text();
	var ledgerdetails_id = $(this).closest('tr').find('td.ledgerdetails_id_hidden').html();
	ledgerdetails_id = $(ledgerdetails_id).text();
    var taxonomi_name_hidden = $(this).closest('tr').find('td.taxonomi_name_hidden').html();
	taxonomi_name = $(taxonomi_name_hidden).text();
	var ledgerdetails_type = $(this).closest('tr').find('td.ledgerdetails_type_hidden').html();
	ledgerdetails_type = $(ledgerdetails_type).text();
	var ledgerdetails_amount = $(this).closest('tr').find('td.ledgerdetails_amount_hidden').html();
	ledgerdetails_amount = $(ledgerdetails_amount).text();

    // and set them in the modal:
	$('#ledger_id', myModal).val(ledger_id);
	$('#ledgerdetails_id', myModal).val(ledgerdetails_id);
    $('#taxonomi_name', myModal).val(taxonomi_name);
	$('#ledgerdetails_type', myModal).val(ledgerdetails_type);
	$('#ledgerdetails_amount', myModal).val(ledgerdetails_amount);
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$('#taxonomi_code', myModal).closest('div').remove();
	var list = $('.append_div', myModal);
	html ='<div class="col-md-8"><input name="taxonomi_code" type="text" class="textbox firstin auto_foc" id="taxonomi_code"></div>';
	list.append($(html));
	$('#taxonomi_code', myModal).closest('div').addClass('typehead_account'+randnum);
	$('#taxonomi_code', myModal).val(taxonomi_name);
	
	//taxonomi
	var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
	var randomUniqueId = randLetter + Date.now();
	var countries = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		limit: 10,
		prefetch: {
		ttl: 1,
		url: '../book/taxonomi-list.php',
		filter: function(list) {
		return $.map(list, function(country) { return { name: country }; });
		}}
		});
		
	countries.initialize();
		
	$('.typehead_account'+randnum+' #taxonomi_code').typeahead(null, {
		//name: 'countries',
		name: 'typehead_account_' + randomUniqueId,
		displayKey: 'name',
		source: countries.ttAdapter()
		});

    // and finally show the modal
    myModal.modal({ show: true });

    return false;
});

});

$(document).ready(function () {
var myModal = $('#myModal');
$('.cash_details_edit', myModal).click(function () {
$('.ajax_loader', myModal).show();
var thisform = $('#form_ledger_edit', myModal);
//get input
var ledgerdetails_type = $('#ledgerdetails_type', myModal).val();
//ajax
	$.post(
	"cash-details-edit-process.php", // Use the action from HTML form
	thisform.serialize(), // Use the data from the HTML form
	function(data){ // When the form submission is complete, run this function
							
	
	// Add the new barcode entry to the list of barcodes
	//var list = $('.ajax_container');
	var data_arr=data.split(";");
	var ledgerdetails_id=data_arr[0];
	ledgerdetails_id=ledgerdetails_id.trim();
	var taxonomi_name=data_arr[1];
	var taxonomi_code=data_arr[2];
	var ledgerdetails_type=data_arr[3];
	var ledgerdetails_amount=data_arr[4];
	var total_debit=data_arr[5];
	var total_credit=data_arr[6];
	var ledgerdetails_amount_org=data_arr[7];
	var ledger_id=data_arr[8];
	//var html = '<tr id="inner'+ledgerdetails_id+'">';
	html ='<td><a class="ledger_general_del" href="#" rel="'+ledgerdetails_id+'"><i class="fa fa-times-circle"></i></a></td>';
	html +='<td><a href="#" class="link_table ledger_new_edit">'+taxonomi_name+'</a></td>';
	if(ledgerdetails_type=='D'){
		html +='<td>'+ledgerdetails_amount+'</td>';
	}else{
		html +='<td>'+ledgerdetails_amount+'</td>';
		}
	html +='<td class="ledgerdetails_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_id+'</a></td>';
    html +='<td class="taxonomi_name_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+taxonomi_code+' - '+taxonomi_name+'</a></td>';
    html +='<td class="ledgerdetails_type_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_type+'</a></td>';
    html +='<td class="ledgerdetails_amount_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_amount_org+'</a></td>';
	html +='<td class="ledger_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledger_id+'</a></td>';
	//html +='</tr>';
	$('#inner'+ledgerdetails_id).html($(html));
	//list.append($(html));
	//$(".ajax_container").append($());
	$('#total_debit').html('<strong>'+total_debit+'</strong>');
	$('#total_credit').html('<strong>'+total_credit+'</strong>');
	//$('#users_name_label').html(data);

	// Empty out the Barcode textbox to be ready for the next submission
	$("#taxonomi_code", myModal).val("");
	$("#ledgerdetails_amount", myModal).val("");
	$('.ajax_loader', myModal).hide();
	$('#myModal').modal('hide');
	//$("#taxonomi_code", myModal).focus();
	});
	});
});

$(document).ready(function () {
var myModal = $('#myModalnew');
$('.ledger_details_new', myModal).click(function () {
$('.ajax_loader', myModal).show();
var thisform = $('#form_ledger_new', myModal);
//get input
var ledgerdetails_type = $('#ledgerdetails_type', myModal).val();
//ajax
	$.post(
	"cash-details-process.php", // Use the action from HTML form
	thisform.serialize(), // Use the data from the HTML form
	function(data){ // When the form submission is complete, run this function
							
	
	// Add the new barcode entry to the list of barcodes
	var list = $('.ajax_container');
	var data_arr=data.split(";");
	var ledgerdetails_id=data_arr[0];
	ledgerdetails_id=ledgerdetails_id.trim();
	var taxonomi_name=data_arr[1];
	var taxonomi_code=data_arr[2];
	var ledgerdetails_type=data_arr[3];
	var ledgerdetails_amount=data_arr[4];
	var total_debit=data_arr[5];
	var total_credit=data_arr[6];
	var ledgerdetails_amount_org=data_arr[7];
	var ledger_id=data_arr[8];
	var html = '<tr id="inner'+ledgerdetails_id+'">';
	html +='<td><a class="ledger_general_del" href="#" rel="'+ledgerdetails_id+'"><i class="fa fa-times-circle"></i></a></td>';
	html +='<td><a href="#" class="link_table ledger_new_edit">'+taxonomi_name+'</a></td>';
	html +='<td><a href="#" class="link_table ledger_new_edit">'+taxonomi_code+'</a></td>';
	if(ledgerdetails_type=='D'){
		html +='<td>'+ledgerdetails_amount+'</td>';
	}else{
		html +='<td>-</td>';
		}
	if(ledgerdetails_type=='K'){
		html +='<td>'+ledgerdetails_amount+'</td>';
	}else{
		html +='<td>-</td>';
		}
	html +='<td class="ledgerdetails_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_id+'</a></td>';
    html +='<td class="taxonomi_name_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+taxonomi_code+' - '+taxonomi_name+'</a></td>';
    html +='<td class="ledgerdetails_type_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_type+'</a></td>';
    html +='<td class="ledgerdetails_amount_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_amount_org+'</a></td>';
	html +='<td class="ledger_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledger_id+'</a></td>';
	html +='</tr>';
	list.append($(html));
	$(".ajax_container").append($());
	$('#total_debit').html('<strong>'+total_debit+'</strong>');
	$('#total_credit').html('<strong>'+total_credit+'</strong>');
	//$('#users_name_label').html(data);

	// Empty out the Barcode textbox to be ready for the next submission
	$("#taxonomi_code", myModal).val("");
	$("#ledgerdetails_amount", myModal).val("");
	$('.ajax_loader', myModal).hide();
	$('#myModalnew').modal('hide');
	//$("#taxonomi_code", myModal).focus();
	});
	});
});

$(document).ready(function () {
var myModal = $('#myModal');
$('.ledger_details_edit', myModal).click(function () {
$('.ajax_loader', myModal).show();
var thisform = $('#form_ledger_edit', myModal);
//get input
var ledgerdetails_type = $('#ledgerdetails_type', myModal).val();
//ajax
	$.post(
	"cash-details-edit-process.php", // Use the action from HTML form
	thisform.serialize(), // Use the data from the HTML form
	function(data){ // When the form submission is complete, run this function
							
	
	// Add the new barcode entry to the list of barcodes
	//var list = $('.ajax_container');
	var data_arr=data.split(";");
	var ledgerdetails_id=data_arr[0];
	ledgerdetails_id=ledgerdetails_id.trim();
	var taxonomi_name=data_arr[1];
	var taxonomi_code=data_arr[2];
	var ledgerdetails_type=data_arr[3];
	var ledgerdetails_amount=data_arr[4];
	var total_debit=data_arr[5];
	var total_credit=data_arr[6];
	var ledgerdetails_amount_org=data_arr[7];
	var ledger_id=data_arr[8];
	//var html = '<tr id="inner'+ledgerdetails_id+'">';
	html ='<td><a class="ledger_general_del" href="#" rel="'+ledgerdetails_id+'"><i class="fa fa-times-circle"></i></a></td>';
	html +='<td><a href="#" class="link_table ledger_new_edit">'+taxonomi_name+'</a></td>';
	html +='<td><a href="#" class="link_table ledger_new_edit">'+taxonomi_code+'</a></td>';
	if(ledgerdetails_type=='D'){
		html +='<td>'+ledgerdetails_amount+'</td>';
	}else{
		html +='<td>-</td>';
		}
	if(ledgerdetails_type=='K'){
		html +='<td>'+ledgerdetails_amount+'</td>';
	}else{
		html +='<td>-</td>';
		}
	html +='<td class="ledgerdetails_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_id+'</a></td>';
    html +='<td class="taxonomi_name_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+taxonomi_code+' - '+taxonomi_name+'</a></td>';
    html +='<td class="ledgerdetails_type_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_type+'</a></td>';
    html +='<td class="ledgerdetails_amount_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledgerdetails_amount_org+'</a></td>';
	html +='<td class="ledger_id_hidden td_hide"><a href="#" class="link_table ledger_new_edit">'+ledger_id+'</a></td>';
	//html +='</tr>';
	$('#inner'+ledgerdetails_id).html($(html));
	//list.append($(html));
	//$(".ajax_container").append($());
	$('#total_debit').html('<strong>'+total_debit+'</strong>');
	$('#total_credit').html('<strong>'+total_credit+'</strong>');
	//$('#users_name_label').html(data);

	// Empty out the Barcode textbox to be ready for the next submission
	$("#taxonomi_code", myModal).val("");
	$("#ledgerdetails_amount", myModal).val("");
	$('.ajax_loader', myModal).hide();
	$('.ajax_loader', myModal).hide();
	$('#myModal').modal('hide');
	//$("#taxonomi_code", myModal).focus();
	});
	});
});

$(function () {
$('a.account_list_edit').on('click', function() {
    var myModal = $('#myModal');

    // now get the values from the table
	var taxonomi_id = $(this).closest('tr').find('td.taxonomi_id_hidden').html();
	taxonomi_id = $(taxonomi_id).text();
    var taxonomi_parent = $(this).closest('tr').find('td.taxonomi_parent_hidden').html();
	taxonomi_parent = $(taxonomi_parent).text();
    var taxonomi_name = $(this).closest('tr').find('td.taxonomi_name_hidden').html();
	taxonomi_name = $(taxonomi_name).text();
	var taxonomi_postable = $(this).closest('tr').find('td.taxonomi_postable_hidden').html();
	taxonomi_postable = $(taxonomi_postable).text();
	var taxonomi_hidden = $(this).closest('tr').find('td.taxonomi_hidden_hidden').html();
	taxonomi_hidden = $(taxonomi_hidden).text();
	var taxonomi_cash_flow = $(this).closest('tr').find('td.taxonomi_cash_flow_hidden').html();
	taxonomi_cash_flow = $(taxonomi_cash_flow).text();

    // and set them in the modal:
	$('#taxonomi_id', myModal).val(taxonomi_id);
    $('#taxonomi_parent', myModal).val(taxonomi_parent);
    $('#taxonomi_name', myModal).val(taxonomi_name);
	$('#taxonomi_postable', myModal).val(taxonomi_postable);
	$('#taxonomi_hidden', myModal).val(taxonomi_hidden);
	$('#taxonomi_cash_flow', myModal).val(taxonomi_cash_flow);

    // and finally show the modal
    myModal.modal({ show: true });

    return false;
});
});

/** typeahead:selected **/
$("input[type='text']").on('typeahead:selected', function (e, datum) {
    var kp=$(this).attr("rel");
	var tval=$(this).val();
	$(this).typeahead('val', tval);
	$("#"+kp+"").focus();
})

/* on product_scode change */
$('#taxonomi_code').on('change', function (e) {
	var scode = $(this).val();
	texpense_onchange(scode);
});

/* pbcode_onchange */
function texpense_onchange(scode) {
	$('#myloading').fadeIn(500);		
	$.ajax({
	type: "POST",        
	url: "ajax/taxonomi-exist.php?scode="+scode,
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
	if(data['taxonomi_id'] == 0){
	alert("Kode Salah");
	$('#myloading').fadeOut(500);
	}else{
	$("#ledgerdetails_amount").focus();
	}
	$('#myloading').fadeOut(500);
	}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

/* reset taxonomi_view_modal */
function reset_taxonomi_list(myModal) {
   		$(".dyn_list",myModal).empty();
   }
   
/* func generate customer list */
function gen_taxonomi_list(keyword,myModal) {
    $.ajax({
	type: "POST",        
	url: "ajax/taxonomi-list.php?search="+keyword,
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
		var taxonomi_code=data['taxonomi_code'];
		var list = $('.dyn_list',myModal);
			var html = "";
			for (i = 0; i < data.length; i++) { 
			var j =i+1;
			
			
			html = '<tr>';
			html +='<td bgcolor="#FFFFFF">'+j+'</td>';
			html +='<td bgcolor="#FFFFFF"><input class="id_set" name="id[]" type="checkbox" id="id[]" value="'+data[i]['taxonomi_id']+'" /></td>';
			html +='<td bgcolor="#FFFFFF" class="taxonomi_code"><a href="#" class="link_table taxonomi_edit">'+data[i]['taxonomi_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="taxonomi_name"><a href="#" class="link_table taxonomi_edit">'+data[i]['taxonomi_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="taxonomi_id_hidden td_hide"><a href="#" class="link_table taxonomi_edit">'+data[i]['taxonomi_id']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="taxonomi_code_hidden td_hide"><a href="#" class="link_table taxonomi_edit">'+data[i]['taxonomi_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="taxonomi_name_hidden td_hide"><a href="#" class="link_table taxonomi_edit">'+data[i]['taxonomi_name']+'</a></td>';
			html +='</tr>';
			list.append($(html));
		}
	$('#myloading').fadeOut(500);
	}
	});
   }

/* taxonomi_edit open modal */
$(function () {
$('.dyn_list').on('click', 'a.taxonomi_edit', function () {
    $('.modal').modal('hide');

    // now get the values from the table
	var taxonomi_id = $(this).closest('tr').find('td.taxonomi_id_hidden').html();
	taxonomi_id = $(taxonomi_id).text();
    var taxonomi_code = $(this).closest('tr').find('td.taxonomi_code').html();
	taxonomi_code = $(taxonomi_code).text();
    var taxonomi_name = $(this).closest('tr').find('td.taxonomi_name').html();
	taxonomi_name = $(taxonomi_name).text();
	var taxonomi_scode=taxonomi_code+" - "+taxonomi_name;

	// and set them in the modal:
	$('.typehead_texpense #taxonomi_code').typeahead('val', taxonomi_scode);
	$('.typehead_account #taxonomi_code').typeahead('val', taxonomi_scode);
	texpense_onchange(taxonomi_scode);

    return false;
});
});

/* on search modal enter */
$(function () {
var myModal = $('#taxonomi_view_modal');
$('#search', myModal).on('keydown', function (e) {
if(e.which == 13) {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_taxonomi_list(myModal);
	gen_taxonomi_list(keyword,myModal);

    return false;
	}
	})
})

/* btn_search modal click */
$(function () {
var myModal = $('#taxonomi_view_modal');
$('#btn_search', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_taxonomi_list(myModal);
	gen_taxonomi_list(keyword,myModal);

    return false;
	})
})


/* taxonomi_view_modal show */
$(function () {
$('#taxonomi_view_alink').on('click', function () {
    $('#myloading').fadeIn(500);
	var myModal = $('#taxonomi_view_modal');
	//get list view
	reset_taxonomi_list(myModal);
	gen_taxonomi_list('',myModal);
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
	})
})

/* texpense list insert */
function texpense_proc() {
	//get input val
	var taxonomi_scode =$('#taxonomi_code').val();
	var ledgerdetails_amount =$('#ledgerdetails_amount').val();
	var value=ledgerdetails_amount.replace(/,/g, "");
	var list = $('.dyn_texpense');
	
	var html = '<tr>';
    html +='<td class="listnum_texpense">#</td>';
	html +='<td><a href="#" class="link_table texpense_edit"><div class="taxonomi_scode">'+taxonomi_scode+'</div><input name="taxonomi_scode_hidden[]" type="hidden" value="'+taxonomi_scode+'"/></a></td>';
    html +='<td><a href="#" class="link_table texpense_edit"><div class="ledgerdetails_amount">'+ledgerdetails_amount+'</div><input name="ledgerdetails_amount_hidden[]" type="hidden" value="'+value+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="texpense_remove(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_texpense").append($());
	calc_texpense();
	//clear input
	$('.typehead_texpense #taxonomi_code').typeahead('val', '');
	$('.typehead_account #taxonomi_code').typeahead('val', '');
	$('#ledgerdetails_amount').val("");
	$("#taxonomi_code").focus();
}

/* product list remove */
function texpense_remove(el) {
	   $(el).closest('tr').remove();
	   $("#taxonomi_code").focus();
	   calc_texpense();
   }
   
/* product list calc */
function calc_texpense(isledger) {
	   	if (isledger === undefined) {
        isledger = 0;
   		}
		var grandtotal = 0;
		var total_debit = 0;
		var total_credit = 0;
		
    	$('.ledgerdetails_amount').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_texpense').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		//get tax
		var value = $(this).closest('tr').find("input[name='ledgerdetails_amount_hidden[]']").val();
		//grand total
		grandtotal = grandtotal + parseFloat(value);
		//display
		var grandtotal_format=grandtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("span#texpense_total").html(grandtotal_format);
		$("#texpense_total_hidden").val(grandtotal);
		//if isledger
		if(isledger==1){
		var value_debit = $(this).closest('tr').find("input[name='ledgerdetails_amount_debit_hidden[]']").val();
		var value_credit = $(this).closest('tr').find("input[name='ledgerdetails_amount_credit_hidden[]']").val();
		//grand total
		total_debit = total_debit + parseFloat(value_debit);
		total_credit = total_credit + parseFloat(value_credit);
		//display
		var total_debit_format=total_debit.toLocaleString('en-US', {minimumFractionDigits: 2});
		var total_credit_format=total_credit.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("span#tledger_total_debit").html(total_debit_format);
		$("span#tledger_total_credit").html(total_credit_format);
		}
		})
   }
   
/* product list edit modal */
$(function () {
$('.dyn_texpense').on('click', 'a.texpense_edit', function () {
    var myModal = $('#myModal');

    // now get the values from the table
	var taxonomi_scode = $(this).closest('tr').find("input[name='taxonomi_scode_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var ledgerdetails_amount = $(this).closest('tr').find("div.ledgerdetails_amount").html();

    // and set them in the modal:
	$('.typehead_texpense #taxonomi_code', myModal).typeahead('val', taxonomi_scode);
	$('.typehead_account #taxonomi_code', myModal).typeahead('val', taxonomi_scode);
	$('#ledgerdetails_amount', myModal).val(ledgerdetails_amount);
	$('#inner_id_hidden', myModal).val(inner_id);
	
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
$('.texpense_edit_modal', myModal).click(function () {
$('.ajax_loader', myModal).show();
var taxonomi_scode = $('#taxonomi_code', myModal).val();
var ledgerdetails_amount = $('#ledgerdetails_amount', myModal).val();
var value=ledgerdetails_amount.replace(/,/g, "");
var inner_id = $('#inner_id_hidden', myModal).val();
	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	
    var html ='<td class="listnum_texpense">#</td>';
	html +='<td><a href="#" class="link_table texpense_edit"><div class="taxonomi_scode">'+taxonomi_scode+'</div><input name="taxonomi_scode_hidden[]" type="hidden" value="'+taxonomi_scode+'"/></a></td>';
    html +='<td><a href="#" class="link_table texpense_edit"><div class="ledgerdetails_amount">'+ledgerdetails_amount+'</div><input name="ledgerdetails_amount_hidden[]" type="hidden" value="'+value+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="texpense_remove(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	
	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_texpense();
	$('#myModal').modal('hide');
	});
});

/* tledger list insert */
function tledger_proc() {
	//get input val
	var taxonomi_scode =$('#taxonomi_code').val();
	var ledgerdetails_amount =$('#ledgerdetails_amount').val();
	var value=ledgerdetails_amount.replace(/,/g, "");

	var ledgerdetails_type =$('#ledgerdetails_type').val();
	var ledgerdetails_type_val="Debit";
	var ledgerdetails_amount_debit="-";
	var ledgerdetails_amount_credit="-";
	var ledgerdetails_amount_debit_val=0;
	var ledgerdetails_amount_credit_val=0;
	if(ledgerdetails_type=="K"){
		ledgerdetails_type_val="Kredit";
		ledgerdetails_amount_debit="-";
		ledgerdetails_amount_credit=ledgerdetails_amount;
		ledgerdetails_amount_debit_val=0;
		ledgerdetails_amount_credit_val=value;
		}else{
		ledgerdetails_type_val="Debit";
		ledgerdetails_amount_debit=ledgerdetails_amount;
		ledgerdetails_amount_credit="-";
		ledgerdetails_amount_debit_val=value;
		ledgerdetails_amount_credit_val=0;
		}
	
	var list = $('.dyn_texpense');
	
	var html = '<tr>';
    html +='<td class="listnum_texpense">#</td>';
	html +='<td><a href="#" class="link_table tledger_edit"><div class="taxonomi_scode">'+taxonomi_scode+'</div><input name="taxonomi_scode_hidden[]" type="hidden" value="'+taxonomi_scode+'"/></a></td>';
	html +='<td><a href="#" class="link_table tledger_edit"><div class="ledgerdetails_amount"></div><input name="ledgerdetails_amount_hidden[]" type="hidden" value="'+value+'"/></a></td>';	
	html +='<td><a href="#" class="link_table tledger_edit"><div class="ledgerdetails_type">'+ledgerdetails_type_val+'</div><input name="ledgerdetails_type_hidden[]" type="hidden" value="'+ledgerdetails_type+'"/></a></td>';
	
	html +='<td><a href="#" class="link_table tledger_edit"><div class="ledgerdetails_amount_debit">'+ledgerdetails_amount_debit+'</div><input name="ledgerdetails_amount_debit_hidden[]" type="hidden" value="'+ledgerdetails_amount_debit_val+'"/></a></td>';
	html +='<td><a href="#" class="link_table tledger_edit"><div class="ledgerdetails_amount_credit">'+ledgerdetails_amount_credit+'</div><input name="ledgerdetails_amount_credit_hidden[]" type="hidden" value="'+ledgerdetails_amount_credit_val+'"/></a></td>';
	
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="tledger_remove(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_texpense").append($());
	calc_texpense(1);
	//clear input
	$('.typehead_texpense #taxonomi_code').typeahead('val', '');
	$('.typehead_account #taxonomi_code').typeahead('val', '');
	$('#ledgerdetails_amount').val("");
	$("#taxonomi_code").focus();
}

/* product list edit modal */
$(function () {
$('.dyn_texpense').on('click', 'a.tledger_edit', function () {
    var myModal = $('#myModal');

    // now get the values from the table
	var taxonomi_scode = $(this).closest('tr').find("input[name='taxonomi_scode_hidden[]']").val();
	var ledgerdetails_type = $(this).closest('tr').find("input[name='ledgerdetails_type_hidden[]']").val();
	var inner_id = $(this).closest('tr').attr('id');
	var ledgerdetails_amount = $(this).closest('tr').find("input[name='ledgerdetails_amount_hidden[]']").val();

    // and set them in the modal:
	$('.typehead_texpense #taxonomi_code', myModal).typeahead('val', taxonomi_scode);
	$('.typehead_account #taxonomi_code', myModal).typeahead('val', taxonomi_scode);
	$('#ledgerdetails_type', myModal).val(ledgerdetails_type);
	$('#ledgerdetails_amount', myModal).val(ledgerdetails_amount);
	$('#inner_id_hidden', myModal).val(inner_id);
	
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
$('.tledger_edit_modal', myModal).click(function () {
$('.ajax_loader', myModal).show();
var taxonomi_scode = $('#taxonomi_code', myModal).val();
var ledgerdetails_amount = $('#ledgerdetails_amount', myModal).val();
var value=ledgerdetails_amount.replace(/,/g, "");

var ledgerdetails_type =$('#ledgerdetails_type', myModal).val();
var ledgerdetails_type_val="Debit";
var ledgerdetails_amount_debit="-";
var ledgerdetails_amount_credit="-";
var ledgerdetails_amount_debit_val=0;
var ledgerdetails_amount_credit_val=0;
if(ledgerdetails_type=="K"){
	ledgerdetails_type_val="Kredit";
	ledgerdetails_amount_debit="-";
	ledgerdetails_amount_credit=ledgerdetails_amount;
	ledgerdetails_amount_debit_val=0;
	ledgerdetails_amount_credit_val=value;
	}else{
	ledgerdetails_type_val="Debit";
	ledgerdetails_amount_debit=ledgerdetails_amount;
	ledgerdetails_amount_credit="-";
	ledgerdetails_amount_debit_val=value;
	ledgerdetails_amount_credit_val=0;
	}

var inner_id = $('#inner_id_hidden', myModal).val();
	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	
    var html ='<td class="listnum_texpense">#</td>';
	html +='<td><a href="#" class="link_table tledger_edit"><div class="taxonomi_scode">'+taxonomi_scode+'</div><input name="taxonomi_scode_hidden[]" type="hidden" value="'+taxonomi_scode+'"/></a></td>';
    html +='<td><a href="#" class="link_table tledger_edit"><div class="ledgerdetails_amount"></div><input name="ledgerdetails_amount_hidden[]" type="hidden" value="'+value+'"/></a></td>';
	html +='<td><a href="#" class="link_table tledger_edit"><div class="ledgerdetails_type">'+ledgerdetails_type_val+'</div><input name="ledgerdetails_type_hidden[]" type="hidden" value="'+ledgerdetails_type+'"/></a></td>';
	
	html +='<td><a href="#" class="link_table tledger_edit"><div class="ledgerdetails_amount_debit">'+ledgerdetails_amount_debit+'</div><input name="ledgerdetails_amount_debit_hidden[]" type="hidden" value="'+ledgerdetails_amount_debit_val+'"/></a></td>';
	html +='<td><a href="#" class="link_table tledger_edit"><div class="ledgerdetails_amount_credit">'+ledgerdetails_amount_credit+'</div><input name="ledgerdetails_amount_credit_hidden[]" type="hidden" value="'+ledgerdetails_amount_credit_val+'"/></a></td>';
	
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="tledger_remove(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	
	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_texpense(1);
	$('#myModal').modal('hide');
	});
});

/* product list remove */
function tledger_remove(el) {
	   $(el).closest('tr').remove();
	   $("#taxonomi_code").focus();
	   calc_texpense(1);
   }

/* Sales Edit popup */
$('a.cash_expense_edit_modal').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var ledger_id = $(this).closest('tr').find('td.ledger_id_hidden').html();
	ledger_id = $(ledger_id).text();
    // and set them in the modal:
	$('#ledger_id', myModal).val(ledger_id);
	//cek status
	var edit_link = "location.href='cash-expense-edit.php?ledger_id="+ledger_id+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var pdf_url="pdf/cash-expense-pdf.php?ledger_id="+ledger_id;
	var pdf_link = "window.open('"+pdf_url+"', '_blank');return false;";
	$('button#btn_pdf', myModal).attr('onclick',pdf_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});
