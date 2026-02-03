/** customer modal **/
/* btn_del modal */
$(function () {
var myModal = $('#customer_view_modal');
$('#btn_del', myModal).on('click', function () {
    if (confirm('Are you sure you want to delete this?')) {
	$('#myloading').fadeIn(500);
	var form=$("#form_del", myModal);
	//call ajax update data & return data
	$.ajax({
        type:"POST",
        url:"../../users/ajax/customer-delete.php?delete=true",
        data:form.serialize(),
		complete: function () {
			$('#myloading').fadeOut(500);
			},
		error: function(xhr){
			alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
			$('#myloading').fadeOut(500);
			},
        success: function(response){
		reset_customer_list(myModal);
		gen_customer_list('',myModal);
		$('#myloading').fadeOut(500);
		}
		})
	}
	})
})

/* customer_view_modal show */
$(function () {
$('#customer_view_alink').on('click', function () {
    $('#myloading').fadeIn(500);
	var myModal = $('#customer_view_modal');
	//get list view
	reset_customer_list(myModal);
	gen_customer_list('',myModal);
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
	})
})

/* btn_new click */
$(function () {
var myModal = $('#customer_view_modal');
$('#btn_new', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	$('.modal').modal('hide');
	var search_val=$('#search', myModal).val();
	//customer check if exist
	$.ajax({ 
    type: "POST", 
    url: "../../users/ajax/customer-exist-json.php?customer_code_val=0000", 
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
			$('.typehead_customer #users_code').typeahead('val', data['users_code']);
			users_code_reset();
			$("#users_name").val(search_val);
			$("#users_name").focus();
			if($("#users_clone").is(':checked')){
				users2_clone();
				}
			}
        $('#myloading').fadeOut(500);
    }
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
});
});


/* users_edit open modal */
$(function () {
$('.dyn_list').on('click', 'a.users_edit', function () {
    $('.modal').modal('hide');

    // now get the values from the table
	var users_id = $(this).closest('tr').find('td.users_id_hidden').html();
	users_id = $(users_id).text();
    var users_code = $(this).closest('tr').find('td.users_code').html();
	users_code = $(users_code).text();
    var users_name = $(this).closest('tr').find('td.users_name').html();
	users_name = $(users_name).text();
	var users_address = $(this).closest('tr').find('td.users_address').html();
	users_address = $(users_address).text();
	var users_email = $(this).closest('tr').find('td.users_email_hidden').html();
	users_email = $(users_email).text();
	var users_idnumber = $(this).closest('tr').find('td.users_idnumber_hidden').html();
	users_idnumber = $(users_idnumber).text();
	var users_phone = $(this).closest('tr').find('td.users_phone_hidden').html();
	users_phone = $(users_phone).text();
	var users_status = $(this).closest('tr').find('td.users_status_hidden').html();
	users_status = $(users_status).text();
	var religion_code = $(this).closest('tr').find('td.religion_code_hidden').html();
	religion_code = $(religion_code).text();
	//var city_code = $(this).closest('tr').find('td.city_code_hidden').html();
	//city_code = $(city_code).text();
	var village_code = $(this).closest('tr').find('td.village_code_hidden').html();
	village_code = $(village_code).text();
	var area_code = $(this).closest('tr').find('td.area_code_hidden').html();
	area_code = $(area_code).text();

	// and set them in the modal:
	$('.typehead_customer #users_code').typeahead('val', users_code);
	users_code_exist();
	users_code_set();
	//$("#users_name").focus();
	if($("#users_clone").is(':checked')){
		users2_clone();
		}

    return false;
});
});

/* customer_edit_modal submit modal */
$(function () {
var myModal = $('#customer_edit_modal');
$('#customer_edit_modal_form', myModal).submit(function (e) {
	e.preventDefault();
	var form=$("#customer_edit_modal_form");
	$('.ajax_loader', myModal).show();
	//get input
	var users_code = $('#users_code', myModal).val();
	var users_name = $('#users_name', myModal).val();
	//call ajax update data & return data
	$.ajax({
        type:"POST",
        url:"../../users/ajax/customer-edit.php",
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

/* reset customer_view_modal */
function reset_customer_list(myModal) {
   		$(".dyn_list",myModal).empty();
   }

/* on search modal enter */
$(function () {
var myModal = $('#customer_view_modal');
$('#search', myModal).on('keydown', function (e) {
if(e.which == 13) {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_customer_list(myModal);
	gen_customer_list(keyword,myModal);

    return false;
	}
	})
})

/* btn_search modal click */
$(function () {
var myModal = $('#customer_view_modal');
$('#btn_search', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_customer_list(myModal);
	gen_customer_list(keyword,myModal);

    return false;
	})
})

/* func generate customer list */
function gen_customer_list(keyword,myModal) {
    $.ajax({
	type: "POST",        
	url: "../../users/ajax/customer-list.php?search="+keyword,
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
			var list = $('.dyn_list',myModal);
			var html = "";
			for (i = 0; i < data.length; i++) { 
			var j =i+1;
			
			
			html = '<tr>';
			html +='<td bgcolor="#FFFFFF">'+j+'</td>';
			html +='<td bgcolor="#FFFFFF"><input class="id_set" name="id[]" type="checkbox" id="id[]" value="'+data[i]['users_id']+'" /></td>';
			html +='<td bgcolor="#FFFFFF" class="users_code"><a href="#" class="link_table users_edit">'+data[i]['users_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_name"><a href="#" class="link_table users_edit">'+data[i]['users_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_phone"><a href="#" class="link_table users_edit">'+data[i]['users_phone']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_address"><a href="#" class="link_table users_edit">'+data[i]['users_address']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_id_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['users_id']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_code_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['users_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_name_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['users_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_status_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['users_status']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_address_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['users_address']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_phone_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['users_phone']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_email_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['users_email']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_idnumber_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['users_idnumber']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="religion_code_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['religion_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="village_code_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['village_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="area_code_hidden td_hide"><a href="#" class="link_table users_edit">'+data[i]['area_code']+'</a></td>';
			html +='</tr>';
			list.append($(html));
			}
	$('#myloading').fadeOut(500);
	}
	});
   }
   
/** customer2 modal **/
/* btn_del modal */
$(function () {
var myModal = $('#customer2_view_modal');
$('#btn_del', myModal).on('click', function () {
    if (confirm('Are you sure you want to delete this?')) {
	$('#myloading').fadeIn(500);
	var form=$("#form_del", myModal);
	//call ajax update data & return data
	$.ajax({
        type:"POST",
        url:"../../users/ajax/customer-delete.php?delete=true",
        data:form.serialize(),
		complete: function () {
			$('#myloading').fadeOut(500);
			},
		error: function(xhr){
			alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
			$('#myloading').fadeOut(500);
			},
        success: function(response){
		reset_customer_list(myModal);
		gen_customer2_list('',myModal);
		$('#myloading').fadeOut(500);
		}
		})
	}
	})
})

/* customer_view_modal show */
$(function () {
$('#customer2_view_alink').on('click', function () {
    $('#myloading').fadeIn(500);
	var myModal = $('#customer2_view_modal');
	//get list view
	reset_customer_list(myModal);
	gen_customer2_list('',myModal);
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
	})
})

/* btn_new click */
$(function () {
var myModal = $('#customer2_view_modal');
$('#btn_new', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	$('.modal').modal('hide');
	var search_val=$('#search', myModal).val();
	//customer check if exist
	$.ajax({ 
    type: "POST", 
    url: "../../users/ajax/customer-exist-json.php?customer_code_val=0000", 
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
			$("#users2_name").val(search_val);
			$("#users2_name").focus();
			}
        $('#myloading').fadeOut(500);
    }
	});
	// Return false to prevent the browser from processing the enter keypress
	return false;
});
});


/* users_edit open modal */
$(function () {
$('.dyn_list').on('click', 'a.users2_edit', function () {
    $('.modal').modal('hide');

    // now get the values from the table
	var users_id = $(this).closest('tr').find('td.users_id_hidden').html();
	users_id = $(users_id).text();
    var users_code = $(this).closest('tr').find('td.users_code').html();
	users_code = $(users_code).text();
    var users_name = $(this).closest('tr').find('td.users_name').html();
	users_name = $(users_name).text();
	var users_address = $(this).closest('tr').find('td.users_address').html();
	users_address = $(users_address).text();
	var users_email = $(this).closest('tr').find('td.users_email_hidden').html();
	users_email = $(users_email).text();
	var users_idnumber = $(this).closest('tr').find('td.users_idnumber_hidden').html();
	users_idnumber = $(users_idnumber).text();
	var users_phone = $(this).closest('tr').find('td.users_phone_hidden').html();
	users_phone = $(users_phone).text();
	var users_status = $(this).closest('tr').find('td.users_status_hidden').html();
	users_status = $(users_status).text();
	var religion_code = $(this).closest('tr').find('td.religion_code_hidden').html();
	religion_code = $(religion_code).text();
	//var city_code = $(this).closest('tr').find('td.city_code_hidden').html();
	//city_code = $(city_code).text();
	var village_code = $(this).closest('tr').find('td.village_code_hidden').html();
	village_code = $(village_code).text();
	var area_code = $(this).closest('tr').find('td.area_code_hidden').html();
	area_code = $(area_code).text();

	// and set them in the modal:
	$('.typehead_customer #users2_code').typeahead('val', users_code);
	users2_code_exist();
	users2_code_set();
	//$("#users2_name").focus();

    return false;
});
});

/* on search modal enter */
$(function () {
var myModal = $('#customer2_view_modal');
$('#search', myModal).on('keydown', function (e) {
if(e.which == 13) {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_customer_list(myModal);
	gen_customer2_list(keyword,myModal);

    return false;
	}
	})
})

/* btn_search modal click */
$(function () {
var myModal = $('#customer2_view_modal');
$('#btn_search', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_customer_list(myModal);
	gen_customer2_list(keyword,myModal);

    return false;
	})
})

/* func generate customer list */
function gen_customer2_list(keyword,myModal) {
    $.ajax({
	type: "POST",        
	url: "../../users/ajax/customer-list.php?search="+keyword,
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
			var list = $('.dyn_list',myModal);
			var html = "";
			for (i = 0; i < data.length; i++) { 
			var j =i+1;
			
			html = '<tr>';
			html +='<td bgcolor="#FFFFFF">'+j+'</td>';
			html +='<td bgcolor="#FFFFFF"><input class="id_set" name="id[]" type="checkbox" id="id[]" value="'+data[i]['users_id']+'" /></td>';
			html +='<td bgcolor="#FFFFFF" class="users_code"><a href="#" class="link_table users2_edit">'+data[i]['users_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_name"><a href="#" class="link_table users2_edit">'+data[i]['users_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_phone"><a href="#" class="link_table users2_edit">'+data[i]['users_phone']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_address"><a href="#" class="link_table users2_edit">'+data[i]['users_address']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_id_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['users_id']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_code_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['users_id']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_name_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['users_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_status_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['users_status']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_address_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['users_address']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_phone_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['users_phone']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_email_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['users_email']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_idnumber_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['users_idnumber']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="religion_code_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['religion_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="village_code_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['village_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="area_code_hidden td_hide"><a href="#" class="link_table users2_edit">'+data[i]['area_code']+'</a></td>';
			html +='</tr>';
			list.append($(html));
			}
	$('#myloading').fadeOut(500);
	}
	});
   }

/** motorcycle modal **/
/* btn_del modal */
$(function () {
var myModal = $('#motorcycle_view_modal');
$('#btn_del', myModal).on('click', function () {
    if (confirm('Are you sure you want to delete this?')) {
	$('#myloading').fadeIn(500);
	var form=$("#form_del", myModal);
	//call ajax update data & return data
	$.ajax({
        type:"POST",
        url:"../../users/ajax/motorcycle-delete.php?delete=true",
        data:form.serialize(),
		complete: function () {
			$('#myloading').fadeOut(500);
			},
		error: function(xhr){
			alert("Masalah Koneksi, Tolong Ulangi Kembali: " + xhr.status + " " + xhr.statusText);
			$('#myloading').fadeOut(500);
			},
        success: function(response){
		reset_motorcycle_list(myModal);
		gen_motorcycle_list('',myModal);
		$('#myloading').fadeOut(500);
		}
		})
	}
	})
})

/* motorcycle_view_modal show */
$(function () {
$('#motorcycle_view_alink').on('click', function () {
    $('#myloading').fadeIn(500);
	var myModal = $('#motorcycle_view_modal');
	//get list view
	reset_motorcycle_list(myModal);
	gen_motorcycle_list('',myModal);
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
	})
})

/* btn_new click */
$(function () {
var myModal = $('#motorcycle_view_modal');
$('#btn_new', myModal).on('click', function () {
    var mcode = '';
	$('.modal').modal('hide');
	// and set them in the modal:
	$('.typehead_motorcycle #motorcycle_code').typeahead('val', '');
	$('.typehead_motorcycle_type #motorcycle_type_code').typeahead('val', '');
	$('#color_code').val('');
	$('#motorcycle_manufacture').val('');
	$('#motorcycle_frame_no').val('');
	$('#motorcycle_machine_no').val('');
	$('#motorcycle_buy_register').val('');
	$('#motorcycle_book_service_no').val('');
	$('#motorcycle_description').val('');
	$("#motorcycle_code").focus();
	})
})

/* users_edit open modal */
$(function () {
$('.dyn_list').on('click', 'a.motorcycle_edit', function () {
    $('.modal').modal('hide');

    // now get the values from the table
	var motorcycle_id = $(this).closest('tr').find('td.motorcycle_id_hidden').html();
	motorcycle_id = $(motorcycle_id).text();
    var motorcycle_code = $(this).closest('tr').find('td.motorcycle_code').html();
	motorcycle_code = $(motorcycle_code).text();
    var motorcycle_type_code = $(this).closest('tr').find('td.motorcycle_type_code_hidden').html();
	motorcycle_type_code = $(motorcycle_type_code).text();
	var users_code = $(this).closest('tr').find('td.users_code_hidden').html();
	users_code = $(users_code).text();
	var color_code = $(this).closest('tr').find('td.color_code_hidden').html();
	color_code = $(color_code).text();
	var motorcycle_manufacture = $(this).closest('tr').find('td.motorcycle_manufacture_hidden').html();
	motorcycle_manufacture = $(motorcycle_manufacture).text();
	var motorcycle_frame_no = $(this).closest('tr').find('td.motorcycle_frame_no_hidden').html();
	motorcycle_frame_no = $(motorcycle_frame_no).text();
	var motorcycle_machine_no = $(this).closest('tr').find('td.motorcycle_machine_no_hidden').html();
	motorcycle_machine_no = $(motorcycle_machine_no).text();
	var motorcycle_buy_register = $(this).closest('tr').find('td.motorcycle_buy_register_hidden').html();
	motorcycle_buy_register = $(motorcycle_buy_register).text();
	var motorcycle_book_service_no = $(this).closest('tr').find('td.motorcycle_book_service_no_hidden').html();
	motorcycle_book_service_no = $(motorcycle_book_service_no).text();
	var motorcycle_description = $(this).closest('tr').find('td.motorcycle_description_hidden').html();
	motorcycle_description = $(motorcycle_description).text();

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
	$("#motorcycle_type_code").focus();
    return false;
});
});

/* motorcycle_edit_modal submit modal */
$(function () {
var myModal = $('#motorcycle_edit_modal');
$('#motorcycle_edit_modal_form', myModal).submit(function (e) {
	e.preventDefault();
	var form=$("#motorcycle_edit_modal_form");
	var date_service = $('#date_register').val();
	$('.ajax_loader', myModal).show();
	//call ajax update data & return data
	$.ajax({
        type:"POST",
        url:"../inventory/ajax/motorcycle-edit.php?date_service="+date_service,
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

/* reset motorcycle_view_modal */
function reset_motorcycle_list(myModal) {
		$(".dyn_list",myModal).empty();
   }

/* on search modal enter */
$(function () {
var myModal = $('#motorcycle_view_modal');
$('#search', myModal).on('keydown', function (e) {
if(e.which == 13) {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_motorcycle_list(myModal);
	gen_motorcycle_list(keyword,myModal);

    return false;
	}
	})
})

/* btn_search modal click */
$(function () {
var myModal = $('#motorcycle_view_modal');
$('#btn_search', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_motorcycle_list(myModal);
	gen_motorcycle_list(keyword,myModal);

    return false;
	})
})

/* func generate motorcycle list */
function gen_motorcycle_list(keyword,myModal) {
    $.ajax({
	type: "POST",        
	url: "../inventory/ajax/motorcycle-list.php?search="+keyword,
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
		var list = $('.dyn_list',myModal);
			var html = "";
			for (i = 0; i < data.length; i++) {
			var j =i+1;

			html = '<tr>';
			html +='<td bgcolor="#FFFFFF">'+j+'</td>';
			html +='<td bgcolor="#FFFFFF"><input class="id_set" name="id[]" type="checkbox" id="id[]" value="'+data[i]['motorcycle_id']+'" /></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_code"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_name"><a href="#" class="link_table motorcycle_edit">'+data[i]['users_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_address"><a href="#" class="link_table motorcycle_edit">'+data[i]['users_address']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_id_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_id']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_code_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_type_code_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_type_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="users_code_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['users_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="color_code_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['color_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_manufacture_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_manufacture']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_frame_no_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_frame_no']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_machine_no_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_machine_no']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_buy_register_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_buy_register']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_book_service_no_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_book_service_no']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="motorcycle_description_hidden td_hide"><a href="#" class="link_table motorcycle_edit">'+data[i]['motorcycle_description']+'</a></td>';
			html +='</tr>';
			list.append($(html));
			}
	$('#myloading').fadeOut(500);
	}
	});
   }
   
/* service_view_modal show */
$(function () {
$('#service_view_alink').on('click', function () {
    $('#myloading').fadeIn(500);
	var myModal = $('#service_view_modal');
	//get list view
	reset_service_list(myModal);
	gen_service_list('',myModal);
	// and finally show the modal
    myModal.modal({ show: true });

    return false;
	})
})

/* service_edit open modal */
$(function () {
$('.dyn_list').on('click', 'a.service_edit', function () {
    $('.modal').modal('hide');

    // now get the values from the table
	var service_id = $(this).closest('tr').find('td.service_id_hidden').html();
	service_id = $(service_id).text();
    var service_code = $(this).closest('tr').find('td.service_code').html();
	service_code = $(service_code).text();
    var service_name = $(this).closest('tr').find('td.service_name').html();
	service_name = $(service_name).text();
	var service_sprice = $(this).closest('tr').find('td.service_sprice').html();
	service_sprice = $(service_sprice).text();
	var service_scode=service_code+" - "+service_name;

	// and set them in the modal:
	$('.typehead_service #service_scode').typeahead('val', service_scode);
	service_scode_onchange(service_scode);

    return false;
});
});

/* reset service_view_modal */
function reset_service_list(myModal) {
   		$(".dyn_list",myModal).empty();
   }

/* on search modal enter */
$(function () {
var myModal = $('#service_view_modal');
$('#search', myModal).on('keydown', function (e) {
if(e.which == 13) {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_service_list(myModal);
	gen_service_list(keyword,myModal);

    return false;
	}
	})
})

/* btn_search modal click */
$(function () {
var myModal = $('#service_view_modal');
$('#btn_search', myModal).on('click', function () {
    $('#myloading').fadeIn(500);
	//get input
	var keyword = $('#search', myModal).val();
	//get list view
	reset_service_list(myModal);
	gen_service_list(keyword,myModal);

    return false;
	})
})

/* func generate customer list */
function gen_service_list(keyword,myModal) {
    $.ajax({
	type: "POST",        
	url: "../inventory/ajax/service-sale-list.php?search="+keyword,
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
		var service_code=data['service_code'];
		var list = $('.dyn_list',myModal);
			var html = "";
			for (i = 0; i < data.length; i++) { 
			var j =i+1;
			
			
			html = '<tr>';
			html +='<td bgcolor="#FFFFFF">'+j+'</td>';
			html +='<td bgcolor="#FFFFFF"><input class="id_set" name="id[]" type="checkbox" id="id[]" value="'+data[i]['service_id']+'" /></td>';
			html +='<td bgcolor="#FFFFFF" class="service_code"><a href="#" class="link_table service_edit">'+data[i]['service_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="service_name"><a href="#" class="link_table service_edit">'+data[i]['service_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="service_sprice"><a href="#" class="link_table service_edit">'+data[i]['service_sprice']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="service_id_hidden td_hide"><a href="#" class="link_table service_edit">'+data[i]['service_id']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="service_code_hidden td_hide"><a href="#" class="link_table service_edit">'+data[i]['service_code']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="service_name_hidden td_hide"><a href="#" class="link_table service_edit">'+data[i]['service_name']+'</a></td>';
			html +='<td bgcolor="#FFFFFF" class="service_sprice_hidden td_hide"><a href="#" class="link_table service_edit">'+data[i]['service_sprice']+'</a></td>';
			html +='</tr>';
			list.append($(html));
		}
	$('#myloading').fadeOut(500);
	}
	});
   }
   
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
	pscode_onchange(product_scode);

    return false;
});
});

/* reset product_view_modal */
function reset_product_list(myModal) {
   		$(".dyn_list",myModal).empty();
   }

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

