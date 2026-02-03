$(function () {
$('a.users_edit').on('click', function() {
    var myModal = $('#myModal');

    // now get the values from the table
	var users_id = $(this).closest('tr').find('td.users_id_hidden').html();
	users_id = $(users_id).text();
    var users_code = $(this).closest('tr').find('td.users_code').html();
	users_code = $(users_code).text();
    var users_name = $(this).closest('tr').find('td.users_name').html();
	users_name = $(users_name).text();
	var users_address = $(this).closest('tr').find('td.users_address').html();
	users_address = $(users_address).text();
	var users_email = $(this).closest('tr').find('td.users_email').html();
	users_email = $(users_email).text();
	var users_idnumber = $(this).closest('tr').find('td.users_idnumber').html();
	users_idnumber = $(users_idnumber).text();
	var users_phone = $(this).closest('tr').find('td.users_phone_hidden').html();
	users_phone = $(users_phone).text();
	var users_type = $(this).closest('tr').find('td.users_type_hidden').html();
	users_type = $(users_type).text();
	var users_status = $(this).closest('tr').find('td.users_status_hidden').html();
	users_status = $(users_status).text();

    // and set them in the modal:
	$('#users_id', myModal).val(users_id);
    $('#users_code', myModal).val(users_code);
    $('#users_name', myModal).val(users_name);
	$('#users_address', myModal).val(users_address);
	$('#users_email', myModal).val(users_email);
	$('#users_idnumber', myModal).val(users_idnumber);
	$('#users_phone', myModal).val(users_phone);
	$('#users_type', myModal).val(users_type);
	$('#users_status', myModal).val(users_status);

    // and finally show the modal
    myModal.modal({ show: true });

    return false;
});

});

//**show hide staff_fee_system 
$('input[name=staff_fee_system_type]').click(function () {
    if (this.id == "staff_fee_system_type_0") {
        $("#staff_fee_system_percent").show();
		$("#staff_fee_system_nominal").hide();
    } else {
        $("#staff_fee_system_percent").hide();
		$("#staff_fee_system_nominal").show();
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
    url: "ajax/village-exist-json.php?village_code_val="+village_code_val, 
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
		typehead_modal('typehead_village','village_code','village_code','village-list.php?search=%QUERY','',myModal,'append_div_area');
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
        url:"ajax/village-new.php",
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
