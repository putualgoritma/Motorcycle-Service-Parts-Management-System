$(function () {
$('a.payable_edit').on('click', function() {
    var myModal = $('#myModal');

    // now get the values from the table
	var payreceivable_id = $(this).closest('tr').find('td.payreceivable_id_hidden').html();
	payreceivable_id = $(payreceivable_id).text();
	var payreceivable_register = $(this).closest('tr').find('td.payreceivable_register').html();
	payreceivable_register = $(payreceivable_register).text();
    var payreceivable_code = $(this).closest('tr').find('td.payreceivable_code').html();
	payreceivable_code = $(payreceivable_code).text();
    var users_name = $(this).closest('tr').find('td.users_name').html();
	users_name = $(users_name).text();
	var payreceivable_description = $(this).closest('tr').find('td.payreceivable_description').html();
	payreceivable_description = $(payreceivable_description).text();
	var payreceivable_amount = $(this).closest('tr').find('td.payreceivable_amount_hidden').html();
	payreceivable_amount = $(payreceivable_amount).text();
	var payreceivable_accountdebit = $(this).closest('tr').find('td.payreceivable_accountdebit_hidden').html();
	payreceivable_accountdebit = $(payreceivable_accountdebit).text();
	var payreceivable_accountcredit = $(this).closest('tr').find('td.payreceivable_accountcredit_norm_hidden').html();
	payreceivable_accountcredit = $(payreceivable_accountcredit).text();
	var payreceivable_status = $(this).closest('tr').find('td.payreceivable_status_hidden').html();
	payreceivable_status = $(payreceivable_status).text();

    // and set them in the modal:
	$('#payreceivable_id', myModal).val(payreceivable_id);
	$('#datepicker3', myModal).val(payreceivable_register);
    $('#payreceivable_code', myModal).val(payreceivable_code);
    $('#users_name', myModal).val(users_name);
	$('#payreceivable_description', myModal).val(payreceivable_description);
	$('#payreceivable_amount', myModal).val(payreceivable_amount);
	$('#payreceivable_accountdebit', myModal).val(payreceivable_accountdebit);
	$('#payreceivable_accountcredit', myModal).val(payreceivable_accountcredit);
	$('#payreceivable_status', myModal).val(payreceivable_status);
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$('#users_code', myModal).closest('div').remove();
	var list = $('.append_div');
	html ='<div class="col-md-8"><input name="users_code" type="text" class="textbox firstin auto_foc" id="users_code"></div>';
	list.append($(html));
	$('#users_code', myModal).closest('div').addClass('typehead_users'+randnum);
	$('#users_code', myModal).val(users_name);
	
	//users
	var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
	var randomUniqueId = randLetter + Date.now();
	var countries = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		limit: 10,
		prefetch: {
		ttl: 1,
		url: '../users/users-list.php?type=',
		filter: function(list) {
		return $.map(list, function(country) { return { name: country }; });
		}}
		});
		
	countries.initialize();
		
	$('.typehead_users'+randnum+' #users_code').typeahead(null, {
		//name: 'countries',
		name: 'typehead_users_' + randomUniqueId,
		displayKey: 'name',
		source: countries.ttAdapter()
		});
	

    // and finally show the modal
    myModal.modal({ show: true });
	
	$(".auto_foc").keydown(function(event) {
    if(event.which == 13) { //Enter
    event.preventDefault();
	$(".auto_foc_trg").focus();
    return false;
    }
	});

    return false;
});

$('a.payable_edit2').on('click', function() {
    var myModal = $('#myModal2');

    // now get the values from the table
	var payreceivable_id = $(this).closest('tr').find('td.payreceivable_id_hidden').html();
	payreceivable_id = $(payreceivable_id).text();
	var payreceivable_register = $(this).closest('tr').find('td.payreceivable_register').html();
	payreceivable_register = $(payreceivable_register).text();
    var payreceivable_code = $(this).closest('tr').find('td.payreceivable_code').html();
	payreceivable_code = $(payreceivable_code).text();
    var users_name = $(this).closest('tr').find('td.users_name').html();
	users_name = $(users_name).text();
	var payreceivable_description = $(this).closest('tr').find('td.payreceivable_description').html();
	payreceivable_description = $(payreceivable_description).text();
	var payreceivable_amount = $(this).closest('tr').find('td.payreceivable_amount_hidden').html();
	payreceivable_amount = $(payreceivable_amount).text();
	var payreceivable_accountdebit = $(this).closest('tr').find('td.payreceivable_accountdebit_norm_hidden').html();
	payreceivable_accountdebit = $(payreceivable_accountdebit).text();
	var payreceivable_accountcredit = $(this).closest('tr').find('td.payreceivable_accountcredit_hidden').html();
	payreceivable_accountcredit = $(payreceivable_accountcredit).text();
	var payreceivable_status = $(this).closest('tr').find('td.payreceivable_status_hidden').html();
	payreceivable_status = $(payreceivable_status).text();

    // and set them in the modal:
	$('#payreceivable_id', myModal).val(payreceivable_id);
	$('#datepicker4', myModal).val(payreceivable_register);
    $('#payreceivable_code', myModal).val(payreceivable_code);
    $('#users_name', myModal).val(users_name);
	$('#payreceivable_description', myModal).val(payreceivable_description);
	$('#payreceivable_amount', myModal).val(payreceivable_amount);
	$('#payreceivable_accountdebit', myModal).val(payreceivable_accountdebit);
	$('#payreceivable_accountcredit', myModal).val(payreceivable_accountcredit);
	$('#payreceivable_status', myModal).val(payreceivable_status);
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$('#users_code', myModal).closest('div').remove();
	var list = $('.append_div');
	html ='<div class="col-md-8"><input name="users_code" type="text" class="textbox firstin auto_foc" id="users_code"></div>';
	list.append($(html));
	$('#users_code', myModal).closest('div').addClass('typehead_users'+randnum);
	$('#users_code', myModal).val(users_name);
	
	//users
	var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
	var randomUniqueId = randLetter + Date.now();
	var countries = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		limit: 10,
		prefetch: {
		ttl: 1,
		url: '../users/users-list.php?type=',
		filter: function(list) {
		return $.map(list, function(country) { return { name: country }; });
		}}
		});
		
	countries.initialize();
		
	$('.typehead_users'+randnum+' #users_code').typeahead(null, {
		//name: 'countries',
		name: 'typehead_users_' + randomUniqueId,
		displayKey: 'name',
		source: countries.ttAdapter()
		});
	

    // and finally show the modal
    myModal.modal({ show: true });
	
	$(".auto_foc").keydown(function(event) {
    if(event.which == 13) { //Enter
    event.preventDefault();
	$(".auto_foc_trg").focus();
    return false;
    }
	});

    return false;
});

$('a.receivable_edit').on('click', function() {
    var myModal = $('#myModal');

    // now get the values from the table
	var payreceivable_id = $(this).closest('tr').find('td.payreceivable_id_hidden').html();
	payreceivable_id = $(payreceivable_id).text();
	var payreceivable_register = $(this).closest('tr').find('td.payreceivable_register').html();
	payreceivable_register = $(payreceivable_register).text();
    var payreceivable_code = $(this).closest('tr').find('td.payreceivable_code').html();
	payreceivable_code = $(payreceivable_code).text();
    var users_name = $(this).closest('tr').find('td.users_name').html();
	users_name = $(users_name).text();
	var payreceivable_description = $(this).closest('tr').find('td.payreceivable_description').html();
	payreceivable_description = $(payreceivable_description).text();
	var payreceivable_amount = $(this).closest('tr').find('td.payreceivable_amount_hidden').html();
	payreceivable_amount = $(payreceivable_amount).text();
	var payreceivable_accountdebit = $(this).closest('tr').find('td.payreceivable_accountdebit_norm_hidden').html();
	payreceivable_accountdebit = $(payreceivable_accountdebit).text();
	var payreceivable_accountcredit = $(this).closest('tr').find('td.payreceivable_accountcredit_hidden').html();
	payreceivable_accountcredit = $(payreceivable_accountcredit).text();
	var payreceivable_status = $(this).closest('tr').find('td.payreceivable_status_hidden').html();
	payreceivable_status = $(payreceivable_status).text();

    // and set them in the modal:
	$('#payreceivable_id', myModal).val(payreceivable_id);
	$('#datepicker3', myModal).val(payreceivable_register);
    $('#payreceivable_code', myModal).val(payreceivable_code);
    $('#users_name', myModal).val(users_name);
	$('#payreceivable_description', myModal).val(payreceivable_description);
	$('#payreceivable_amount', myModal).val(payreceivable_amount);
	$('#payreceivable_accountdebit', myModal).val(payreceivable_accountdebit);
	$('#payreceivable_accountcredit', myModal).val(payreceivable_accountcredit);
	$('#payreceivable_status', myModal).val(payreceivable_status);
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$('#users_code', myModal).closest('div').remove();
	var list = $('.append_div');
	html ='<div class="col-md-8"><input name="users_code" type="text" class="textbox firstin auto_foc" id="users_code"></div>';
	list.append($(html));
	$('#users_code', myModal).closest('div').addClass('typehead_users'+randnum);
	$('#users_code', myModal).val(users_name);
	
	//users
	var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
	var randomUniqueId = randLetter + Date.now();
	var countries = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		limit: 10,
		prefetch: {
		ttl: 1,
		url: '../users/users-list.php?type=',
		filter: function(list) {
		return $.map(list, function(country) { return { name: country }; });
		}}
		});
		
	countries.initialize();
		
	$('.typehead_users'+randnum+' #users_code').typeahead(null, {
		//name: 'countries',
		name: 'typehead_users_' + randomUniqueId,
		displayKey: 'name',
		source: countries.ttAdapter()
		});
	

    // and finally show the modal
    myModal.modal({ show: true });
	
	$(".auto_foc").keydown(function(event) {
    if(event.which == 13) { //Enter
    event.preventDefault();
	$(".auto_foc_trg").focus();
    return false;
    }
	});

    return false;
});

$('a.receivable_edit2').on('click', function() {
    var myModal = $('#myModal2');

    // now get the values from the table
	var payreceivable_id = $(this).closest('tr').find('td.payreceivable_id_hidden').html();
	payreceivable_id = $(payreceivable_id).text();
	var payreceivable_register = $(this).closest('tr').find('td.payreceivable_register').html();
	payreceivable_register = $(payreceivable_register).text();
    var payreceivable_code = $(this).closest('tr').find('td.payreceivable_code').html();
	payreceivable_code = $(payreceivable_code).text();
    var users_name = $(this).closest('tr').find('td.users_name').html();
	users_name = $(users_name).text();
	var payreceivable_description = $(this).closest('tr').find('td.payreceivable_description').html();
	payreceivable_description = $(payreceivable_description).text();
	var payreceivable_amount = $(this).closest('tr').find('td.payreceivable_amount_hidden').html();
	payreceivable_amount = $(payreceivable_amount).text();
	var payreceivable_accountdebit = $(this).closest('tr').find('td.payreceivable_accountdebit_hidden').html();
	payreceivable_accountdebit = $(payreceivable_accountdebit).text();
	var payreceivable_accountcredit = $(this).closest('tr').find('td.payreceivable_accountcredit_norm_hidden').html();
	payreceivable_accountcredit = $(payreceivable_accountcredit).text();
	var payreceivable_status = $(this).closest('tr').find('td.payreceivable_status_hidden').html();
	payreceivable_status = $(payreceivable_status).text();

    // and set them in the modal:
	$('#payreceivable_id', myModal).val(payreceivable_id);
	$('#datepicker4', myModal).val(payreceivable_register);
    $('#payreceivable_code', myModal).val(payreceivable_code);
    $('#users_name', myModal).val(users_name);
	$('#payreceivable_description', myModal).val(payreceivable_description);
	$('#payreceivable_amount', myModal).val(payreceivable_amount);
	$('#payreceivable_accountdebit', myModal).val(payreceivable_accountdebit);
	$('#payreceivable_accountcredit', myModal).val(payreceivable_accountcredit);
	$('#payreceivable_status', myModal).val(payreceivable_status);
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$('#users_code', myModal).closest('div').remove();
	var list = $('.append_div');
	html ='<div class="col-md-8"><input name="users_code" type="text" class="textbox firstin auto_foc" id="users_code"></div>';
	list.append($(html));
	$('#users_code', myModal).closest('div').addClass('typehead_users'+randnum);
	$('#users_code', myModal).val(users_name);
	
	//users
	var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
	var randomUniqueId = randLetter + Date.now();
	var countries = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		limit: 10,
		prefetch: {
		ttl: 1,
		url: '../users/users-list.php?type=',
		filter: function(list) {
		return $.map(list, function(country) { return { name: country }; });
		}}
		});
		
	countries.initialize();
		
	$('.typehead_users'+randnum+' #users_code').typeahead(null, {
		//name: 'countries',
		name: 'typehead_users_' + randomUniqueId,
		displayKey: 'name',
		source: countries.ttAdapter()
		});
	

    // and finally show the modal
    myModal.modal({ show: true });
	
	$(".auto_foc").keydown(function(event) {
    if(event.which == 13) { //Enter
    event.preventDefault();
	$(".auto_foc_trg").focus();
    return false;
    }
	});

    return false;
});

});

//**receivable
//modal open
$(function () {
$('.dyn_receivable_get').on('click', 'a.receivable_get_edit', function () {
    var myModal = $('#myModal');

    // now get the values from the table
	var payreceivable_accountcredit = $(this).closest('tr').find("div.payreceivable_accountcredit").html();
	var inner_id = $(this).closest('tr').attr('id');
	var payreceivable_amount = $(this).closest('tr').find("div.payreceivable_amount").html();

    // and set them in the modal:
	$('#payreceivable_amount', myModal).val(payreceivable_amount);
	$('#inner_id_hidden', myModal).val(inner_id);
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$('#payreceivable_accountcredit', myModal).closest('div').remove();
	var list = $('.append_div', myModal);
	html ='<div class="col-md-8"><input name="payreceivable_accountcredit" type="text" class="textbox firstin auto_foc" id="payreceivable_accountcredit"> <span id="payreceivable_accountcredit_label">&nbsp;</span></div>';
	list.append($(html));
	$('#payreceivable_accountcredit', myModal).closest('div').addClass('typehead_account'+randnum);
	$('#payreceivable_accountcredit', myModal).val(payreceivable_accountcredit);
	
	//account
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
		
	$('.typehead_account'+randnum+' #payreceivable_accountcredit').typeahead(null, {
		//name: 'countries',
		name: 'typehead_account' + randomUniqueId,
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

//modal process
$(function () {
var myModal = $('#myModal');
$('.receivable_details_edit', myModal).click(function () {
$('.ajax_loader', myModal).show();
var payreceivable_accountcredit =$('#payreceivable_accountcredit', myModal).val();
var payreceivable_amount =$('#payreceivable_amount', myModal).val();
var payreceivable_amount_unf=payreceivable_amount.replace(/,/g, "");
var inner_id = $('#inner_id_hidden', myModal).val();
	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	
	var html ='<td class="listnum_receivable_get">#</td>';
	html +='<td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_accountcredit">'+payreceivable_accountcredit+'</div><input class="payreceivable_accountcredit_hidden" name="payreceivable_accountcredit_hidden[]" type="hidden" value="'+payreceivable_accountcredit+'"/></a></td>';
    html +='<td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_amount">'+payreceivable_amount+'</div><input class="payreceivable_amount_hidden" name="payreceivable_amount_hidden[]" type="hidden" value="'+payreceivable_amount_unf+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_receivable_get(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	
	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_receivable_get();
	$('#myModal').modal('hide');
	});
	
});


//dynamic add
function receivable_get() {
	//get input val
	var payreceivable_accountcredit =$('#payreceivable_accountcredit').val();
	var payreceivable_amount =$('#payreceivable_amount').val();
	var payreceivable_amount_unf=payreceivable_amount.replace(/,/g, "");
	
	var list = $('.dyn_receivable_get');
	
	var html = '<tr>';
    html +='<td class="listnum_receivable_get">#</td>';
	html +='<td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_accountcredit">'+payreceivable_accountcredit+'</div><input class="payreceivable_accountcredit_hidden" name="payreceivable_accountcredit_hidden[]" type="hidden" value="'+payreceivable_accountcredit+'"/></a></td>';
    html +='<td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_amount">'+payreceivable_amount+'</div><input class="payreceivable_amount_hidden" name="payreceivable_amount_hidden[]" type="hidden" value="'+payreceivable_amount_unf+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_receivable_get(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_receivable_get").append($());
	calc_receivable_get();
	//clear input
	$('#payreceivable_accountcredit').val("");
	$('#payreceivable_amount').val("");
	$("#payreceivable_accountcredit").focus();
};

function remove_receivable_get(el) {
	   $(el).closest('tr').remove();
	   $("#payreceivable_accountcredit").focus();
	   calc_receivable_get();
   }
   
function calc_receivable_get() {
	   	var grandtotal = 0;
    	$('.payreceivable_amount_hidden').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_receivable_get').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		var value = $(this).closest('tr').find("input[name='payreceivable_amount_hidden[]']").val();
		//grand total
		grandtotal = grandtotal + parseFloat(value);
    	});
		//display
		var grandtotal_format=grandtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#payreceivable_amount_total").html(grandtotal_format);
		$("#payreceivable_amount_total_hidden").val(grandtotal);
   }
   
/* on payreceivable_accountcredit enter */
$('.typehead_payreceivable #payreceivable_accountcredit').on('change', function (e) {
	var scode = $(this).val();
	payreceivable_onchange(scode);
});

/* on product_scode exec */
function payreceivable_onchange(scode) {
	//cek if empty user & payreceivable_accountcredit_def
	var users_code = $('#users_code').val();
	var users_code_arr=users_code.split(" - ");
	var users_code_val = users_code_arr[0];
	var payreceivable_accountcredit_def = $('#payreceivable_accountcredit_def').val();
	$('#myloading').fadeIn(500);
	$.post(
	"payreceivable-getcode.php?scode="+scode, // Use the action from HTML form
	function(data){ // When the form submission is complete, run this function
	if(data == 1){
	alert("Kode Salah");
	$('#myloading').fadeOut(500);
	$('.typehead_payreceivable #payreceivable_accountcredit').typeahead('val', '');
	$("#payreceivable_accountcredit").focus();
	}else{
	var data_arr=data.split(";");
	if(data_arr[0]!=users_code_val || data_arr[1]!=payreceivable_accountcredit_def){
	alert("Kode Tidak Sesuai");
	$('#myloading').fadeOut(500);
	$('.typehead_payreceivable #payreceivable_accountcredit').typeahead('val', '');
	$("#payreceivable_accountcredit").focus();
	}else{
	var payreceivable_amount=data_arr[2]/data_arr[3];
	$("#payreceivable_amount").val(payreceivable_amount.toLocaleString('en-US', {minimumFractionDigits: 2}));
	$('#myloading').fadeOut(500);
	}}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

//dynamic add
function receivable_min_get() {
	//get input val
	var payreceivable_accountcredit =$('#payreceivable_accountcredit').val();
	var payreceivable_amount =$('#payreceivable_amount').val();
	var payreceivable_amount_unf=payreceivable_amount.replace(/,/g, "");
	
	var list = $('.dyn_receivable_get');
	
	var html = '<tr>';
    html +='<td class="listnum_receivable_get">#</td>';
	html +='<td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_accountcredit">'+payreceivable_accountcredit+'</div><input class="payreceivable_accountcredit_hidden" name="payreceivable_accountcredit_hidden[]" type="hidden" value="'+payreceivable_accountcredit+'"/></a></td>';
    html +='<td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_amount">'+payreceivable_amount+'</div><input class="payreceivable_amount_hidden" name="payreceivable_amount_hidden[]" type="hidden" value="'+payreceivable_amount_unf+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_receivable_min_get(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_receivable_get").append($());
	calc_receivable_min_get();
	//clear input
	$('.typehead_payreceivable #payreceivable_accountcredit').typeahead('val', '');
	$('#payreceivable_amount').val("");
	$("#payreceivable_accountcredit").focus();
};

function remove_receivable_min_get(el) {
	   $(el).closest('tr').remove();
	   $("#payreceivable_accountcredit").focus();
	   calc_receivable_min_get();
   }
   
function calc_receivable_min_get() {
	   	var grandtotal = 0;
    	$('.payreceivable_amount_hidden').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_receivable_get').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		var value = $(this).closest('tr').find("input[name='payreceivable_amount_hidden[]']").val();
		//grand total
		grandtotal = grandtotal + parseFloat(value);
    	});
		//display
		var grandtotal_format=grandtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#payreceivable_amount_total").html(grandtotal_format);
		$("#payreceivable_amount_total_hidden").val(grandtotal);
   }

/* on payreceivable_staff_accountcredit enter */
$('#payreceivable_staff_accountcredit').on('change', function (e) {
	var scode = $(this).val();
	payreceivable_staff_onchange(scode);
});

/* on product_scode exec */
function payreceivable_staff_onchange(scode) {
	//cek if empty user & payreceivable_accountcredit_def
	var staff_code = $('#staff_code').val();
	var staff_code_arr=staff_code.split(" - ");
	var staff_code_val = staff_code_arr[0];
	var payreceivable_accountcredit_def = $('#payreceivable_accountcredit_def').val();
	$('#myloading').fadeIn(500);
	$.post(
	"payreceivable-staff-getcode.php?scode="+scode, // Use the action from HTML form
	function(data){ // When the form submission is complete, run this function
	if(data == 1){
	alert("Kode Salah");
	$('#myloading').fadeOut(500);
	$('.typehead_payreceivable #payreceivable_accountcredit').typeahead('val', '');
	$("#payreceivable_accountcredit").focus();
	}else{
	var data_arr=data.split(";");
	if(data_arr[0]!=staff_code_val || data_arr[1]!=payreceivable_accountcredit_def){
	alert("Kode Tidak Sesuai");
	$('#myloading').fadeOut(500);
	$('.typehead_payreceivable #payreceivable_accountcredit').typeahead('val', '');
	$("#payreceivable_accountcredit").focus();
	}else{
	var payreceivable_amount=data_arr[2]/data_arr[3];
	$("#payreceivable_amount").val(payreceivable_amount.toLocaleString('en-US', {minimumFractionDigits: 2}));
	$('#myloading').fadeOut(500);
	}}
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
}

//dynamic add
function receivable_staff_min_get() {
	//get input val
	var payreceivable_accountcredit =$('#payreceivable_staff_accountcredit').val();
	var payreceivable_amount =$('#payreceivable_amount').val();
	var payreceivable_amount_unf=payreceivable_amount.replace(/,/g, "");
	
	var list = $('.dyn_receivable_get');
	
	var html = '<tr>';
    html +='<td class="listnum_receivable_get">#</td>';
	html +='<td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_accountcredit">'+payreceivable_accountcredit+'</div><input class="payreceivable_accountcredit_hidden" name="payreceivable_accountcredit_hidden[]" type="hidden" value="'+payreceivable_accountcredit+'"/></a></td>';
    html +='<td><a href="#" class="link_table receivable_get_edit"><div class="payreceivable_amount">'+payreceivable_amount+'</div><input class="payreceivable_amount_hidden" name="payreceivable_amount_hidden[]" type="hidden" value="'+payreceivable_amount_unf+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_receivable_staff_min_get(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_receivable_get").append($());
	calc_receivable_staff_min_get();
	//clear input
	$('.typehead_payreceivable_staff #payreceivable_staff_accountcredit').typeahead('val', '');
	$('#payreceivable_amount').val("");
	$("#payreceivable_staff_accountcredit").focus();
};

function remove_receivable_staff_min_get(el) {
	   $(el).closest('tr').remove();
	   $("#payreceivable_staff_accountcredit").focus();
	   calc_receivable_staff_min_get();
   }
   
function calc_receivable_staff_min_get() {
	   	var grandtotal = 0;
    	$('.payreceivable_amount_hidden').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_receivable_get').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		var value = $(this).closest('tr').find("input[name='payreceivable_amount_hidden[]']").val();
		//grand total
		grandtotal = grandtotal + parseFloat(value);
    	});
		//display
		var grandtotal_format=grandtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#payreceivable_amount_total").html(grandtotal_format);
		$("#payreceivable_amount_total_hidden").val(grandtotal);
   }
   
//**payable
//modal open
$(function () {
$('.dyn_payable_get').on('click', 'a.payable_get_edit', function () {
    var myModal = $('#myModal');

    // now get the values from the table
	var payreceivable_accountdebit = $(this).closest('tr').find("div.payreceivable_accountdebit").html();
	var inner_id = $(this).closest('tr').attr('id');
	var payreceivable_amount = $(this).closest('tr').find("div.payreceivable_amount").html();

    // and set them in the modal:
	$('#payreceivable_amount', myModal).val(payreceivable_amount);
	$('#inner_id_hidden', myModal).val(inner_id);
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$('#payreceivable_accountdebit', myModal).closest('div').remove();
	var list = $('.append_div', myModal);
	html ='<div class="col-md-8"><input name="payreceivable_accountdebit" type="text" class="textbox firstin auto_foc" id="payreceivable_accountdebit"> <span id="payreceivable_accountdebit_label">&nbsp;</span></div>';
	list.append($(html));
	$('#payreceivable_accountdebit', myModal).closest('div').addClass('typehead_account'+randnum);
	$('#payreceivable_accountdebit', myModal).val(payreceivable_accountdebit);
	
	//account
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
		
	$('.typehead_account'+randnum+' #payreceivable_accountdebit').typeahead(null, {
		//name: 'countries',
		name: 'typehead_account' + randomUniqueId,
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

//modal process
$(function () {
var myModal = $('#myModal');
$('.payable_details_edit', myModal).click(function () {
$('.ajax_loader', myModal).show();
var payreceivable_accountdebit =$('#payreceivable_accountdebit', myModal).val();
var payreceivable_amount =$('#payreceivable_amount', myModal).val();
var payreceivable_amount_unf=payreceivable_amount.replace(/,/g, "");
var inner_id = $('#inner_id_hidden', myModal).val();
	// Add the new barcode entry to the list of barcodes
	var list = $('#'+inner_id);
	
	var html ='<td class="listnum_payable_get">#</td>';
	html +='<td><a href="#" class="link_table payable_get_edit"><div class="payreceivable_accountdebit">'+payreceivable_accountdebit+'</div><input class="payreceivable_accountdebit_hidden" name="payreceivable_accountdebit_hidden[]" type="hidden" value="'+payreceivable_accountdebit+'"/></a></td>';
    html +='<td><a href="#" class="link_table payable_get_edit"><div class="payreceivable_amount">'+payreceivable_amount+'</div><input class="payreceivable_amount_hidden" name="payreceivable_amount_hidden[]" type="hidden" value="'+payreceivable_amount_unf+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_payable_get(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
	
	$('#'+inner_id).html($(html));
	$('.ajax_loader', myModal).hide();
	calc_payable_get();
	$('#myModal').modal('hide');
	});
	
});


//dynamic add
function payable_get() {
	//get input val
	var payreceivable_accountdebit =$('#payreceivable_accountdebit').val();
	var payreceivable_amount =$('#payreceivable_amount').val();
	var payreceivable_amount_unf=payreceivable_amount.replace(/,/g, "");
	
	var list = $('.dyn_payable_get');
	
	var html = '<tr>';
    html +='<td class="listnum_payable_get">#</td>';
	html +='<td><a href="#" class="link_table payable_get_edit"><div class="payreceivable_accountdebit">'+payreceivable_accountdebit+'</div><input class="payreceivable_accountdebit_hidden" name="payreceivable_accountdebit_hidden[]" type="hidden" value="'+payreceivable_accountdebit+'"/></a></td>';
    html +='<td><a href="#" class="link_table payable_get_edit"><div class="payreceivable_amount">'+payreceivable_amount+'</div><input class="payreceivable_amount_hidden" name="payreceivable_amount_hidden[]" type="hidden" value="'+payreceivable_amount_unf+'"/></a></td>';
    html +='<td><a href="javascript:;" class="btn btn-danger" onclick="remove_payable_get(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>';
  	html +='</tr>';
	list.append($(html));
	$(".dyn_payable_get").append($());
	calc_payable_get();
	//clear input
	$('#payreceivable_accountdebit').val("");
	$('#payreceivable_amount').val("");
	$("#payreceivable_accountdebit").focus();
};

function remove_payable_get(el) {
	   $(el).closest('tr').remove();
	   $("#payreceivable_accountdebit").focus();
	   calc_payable_get();
   }
   
function calc_payable_get() {
	   	var grandtotal = 0;
    	$('.payreceivable_amount_hidden').each(function (index, element) {
		//list num
		var num_list=index+1;
		$(this).closest('tr').find('td.listnum_payable_get').html(num_list+".");
		$(this).closest('tr').attr("id","inner"+num_list);
		var value = $(this).closest('tr').find("input[name='payreceivable_amount_hidden[]']").val();
		//grand total
		grandtotal = grandtotal + parseFloat(value);
    	});
		//display
		var grandtotal_format=grandtotal.toLocaleString('en-US', {minimumFractionDigits: 2});
		$("#payreceivable_amount_total").html(grandtotal_format);
		$("#payreceivable_amount_total_hidden").val(grandtotal);
   }
   
//**end product order sale

/* typeahead:selected */
$("input[type='text']").on('typeahead:selected', function (e, datum) {
    var kp=$(this).attr("rel");
	var tval=$(this).val();
	$(this).typeahead('val', tval);
	$("#"+kp+"").focus();
})

/* reset payreceivable input list*/
function reset_payreceivable_input() {
	$('.typehead_account #payreceivable_accountdebit').typeahead('val', '');
	$('#payreceivable_amount').val('');
	$('#payreceivable_accountdebit').focus();
}

/* on product_scode change */
$('#payreceivable_accountdebit').on('change', function (e) {
	var scode = $(this).val();
	payreceivable_onchange(scode);
});

/* pbcode_onchange */
function payreceivable_onchange(scode) {
	$('#myloading').fadeIn(500);		
	$.ajax({
	type: "POST",        
	url: "../book/ajax/taxonomi-exist.php?scode="+scode,
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
	reset_payreceivable_input();
	$('#myloading').fadeOut(500);
	}else{
	$("#payreceivable_amount").focus();
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
	url: "../book/ajax/taxonomi-list.php?search="+keyword,
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
	$('.typehead_account #payreceivable_accountdebit').typeahead('val', taxonomi_scode);
	//$('.typehead_account #taxonomi_code').typeahead('val', taxonomi_scode);
	payreceivable_onchange(taxonomi_scode);

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
