$(document).ready(function () {
var myModal = $('#myModal');
$('input[type="radio"]', myModal).click(function(){
        if($(this).attr("value")=="cash"){
            $(".payment_type", myModal).not(".cash").hide();
			$(".credit", myModal).hide();
			$.ajax({url: '../book/taxonomi-select.php?svalue=cash_bank',
             success: function(output) {
                //alert(output);
                $('#asset_fixed_accountcredit', myModal).html(output);
            },
          });
        }
        if($(this).attr("value")=="credit"){
            $(".payment_type", myModal).not(".credit").hide();
            $(".credit", myModal).show();
			$.ajax({url: '../book/taxonomi-select.php?svalue=payable_liquid,payable_fixed',
             success: function(output) {
                //alert(output);
                $('#asset_fixed_accountcredit', myModal).html(output);
            },
          });
        }
    });

var myModal2 = $('#myModalnew');
$('input[type="radio"]', myModal2).click(function(){
        if($(this).attr("value")=="cash"){
            $(".payment_type", myModal2).not(".cash").hide();
			$(".credit", myModal2).hide();
			$.ajax({url: '../book/taxonomi-select.php?svalue=cash_bank',
             success: function(output) {
                //alert(output);
                $('#asset_fixed_accountcredit', myModal2).html(output);
            },
          });
        }
        if($(this).attr("value")=="credit"){
            $(".payment_type", myModal2).not(".credit").hide();
            $(".credit", myModal2).show();
			$.ajax({url: '../book/taxonomi-select.php?svalue=payable_liquid,payable_fixed',
             success: function(output) {
                //alert(output);
                $('#asset_fixed_accountcredit', myModal2).html(output);
            },
          });
        }
    });
});

$(function () {
$('a.asset_fixed_edit').on('click', function() {
    var myModal = $('#myModal');

    // now get the values from the table
	var asset_fixed_id = $(this).closest('tr').find('td.asset_fixed_id_hidden').html();
	asset_fixed_id = $(asset_fixed_id).text();
	var asset_fixed_register = $(this).closest('tr').find('td.asset_fixed_register').html();
	asset_fixed_register = $(asset_fixed_register).text();
    var asset_fixed_code = $(this).closest('tr').find('td.asset_fixed_code').html();
	asset_fixed_code = $(asset_fixed_code).text();
    var asset_fixed_name = $(this).closest('tr').find('td.asset_fixed_name').html();
	asset_fixed_name = $(asset_fixed_name).text();
	var asset_fixed_quantity = $(this).closest('tr').find('td.asset_fixed_quantity').html();
	asset_fixed_quantity = $(asset_fixed_quantity).text();
	var asset_fixed_depreciation_period = $(this).closest('tr').find('td.asset_fixed_depreciation_period_hidden').html();
	asset_fixed_depreciation_period = $(asset_fixed_depreciation_period).text();
	var asset_fixed_type = $(this).closest('tr').find('td.asset_fixed_type_hidden').html();
	asset_fixed_type = $(asset_fixed_type).text();
	var asset_fixed_amount = $(this).closest('tr').find('td.asset_fixed_amount_hidden').html();
	asset_fixed_amount = $(asset_fixed_amount).text();
	var asset_fixed_depreciation_type = $(this).closest('tr').find('td.asset_fixed_depreciation_type_hidden').html();
	asset_fixed_depreciation_type = $(asset_fixed_depreciation_type).text();
	var payment_type = $(this).closest('tr').find('td.payment_type_hidden').html();
	payment_type = $(payment_type).text();
	var asset_fixed_accountcredit = $(this).closest('tr').find('td.asset_fixed_accountcredit_hidden').html();
	asset_fixed_accountcredit = $(asset_fixed_accountcredit).text();
	var users_name = $(this).closest('tr').find('td.users_code_hidden').html();
	users_name = $(users_name).text();
	var asset_fixed_description = $(this).closest('tr').find('td.asset_fixed_description_hidden').html();
	asset_fixed_description = $(asset_fixed_description).text();

    // and set them in the modal:
	$('#asset_fixed_id', myModal).val(asset_fixed_id);
	$('#datepicker2', myModal).val(asset_fixed_register);
    $('#asset_fixed_code', myModal).val(asset_fixed_code);
    $('#asset_fixed_name', myModal).val(asset_fixed_name);
	$('#asset_fixed_quantity', myModal).val(asset_fixed_quantity);
	$('#asset_fixed_depreciation_period', myModal).val(asset_fixed_depreciation_period);
	$('#asset_fixed_type', myModal).val(asset_fixed_type);
	$('#asset_fixed_amount', myModal).val(asset_fixed_amount);
	$('#asset_fixed_depreciation_type', myModal).val(asset_fixed_depreciation_type);
	$('#asset_fixed_accountcredit', myModal).val(asset_fixed_accountcredit);
	$('#asset_fixed_description', myModal).val(asset_fixed_description);
	
	if(payment_type=="cash"){
	$( "#cash" , myModal).prop( "checked", true );
	$(".credit", myModal).hide();
	$.ajax({url: '../book/taxonomi-select.php?svalue=cash_bank&selected='+asset_fixed_accountcredit,
             success: function(output) {
                //alert(output);
                $('#asset_fixed_accountcredit', myModal).html(output);
            },
          });
	}
	if(payment_type=="credit"){
	$( "#credit", myModal ).prop( "checked", true );
	$(".credit", myModal).show();
	$.ajax({url: '../book/taxonomi-select.php?svalue=payable_liquid,payable_fixed&selected='+asset_fixed_accountcredit,
             success: function(output) {
                //alert(output);
                $('#asset_fixed_accountcredit', myModal).html(output);
            },
          });
	}
		
	
	var randnum = Math.floor((Math.random() * 100) + 1);
	
	$('#users_code2', myModal).closest('div').remove();
	var list = $('.append_div');
	html ='<div class="col-md-8"><input name="users_code" type="text" class="textbox firstin auto_foc" id="users_code2"></div>';
	list.append($(html));
	$('#users_code2', myModal).closest('div').addClass('typehead_users'+randnum);
	$('#users_code2', myModal).val(users_name);
	
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
		
	$('.typehead_users'+randnum+' #users_code2', myModal).typeahead(null, {
		//name: 'countries',
		name: 'typehead_users_' + randomUniqueId,
		displayKey: 'name',
		source: countries.ttAdapter()
		});

    // and finally show the modal
     myModal.modal({ show: true });

    return false;
});
});
