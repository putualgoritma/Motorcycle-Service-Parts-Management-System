<script>
$(document).ready(function () {
	salary_total();
});

/* on service_order_sale keyup */
$(function () {
	$('.slip_edit').on('keyup', function () {
        salary_total();
	})
})

/* absence_status on change */
$('select[name="absence_status"]').change(function(){
    if ($(this).val() == "work"){
        absence_status_on();
     }  else{
	 	absence_status_off();
	 }
})

/* salary_total */
function salary_total() {
	var income_total=staff_income_cal();
	var cut_total=staff_cut_cal();
	var salary_total=income_total-cut_total;
	$('#salary_total').val(salary_total.toLocaleString('en-US', {minimumFractionDigits: 2}));
}

/* staff_income_cal */
function staff_income_cal() {
	var income_total = parseInt($("#salary_slip_basic").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_position").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_transport").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_food").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_insurance").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_insentif_daily").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_commission_part").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_commission_service").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_insentif_unit_entry").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_insentif_product").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_insentif_service").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_insentif_bonus").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_insentif_no_alfa").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_fee_picket").val().replace(/[^0-9.-]+/g,""));
	$('#income_total').val(income_total.toLocaleString('en-US', {minimumFractionDigits: 2}));
	return income_total;
}

/* staff_cut_cal */
function staff_cut_cal() {
	var cut_total = parseInt($("#salary_slip_cut_late").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_cut_alfa").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_cut_cashbon").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_cut_payable").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_cut_insurance").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_cut_other1").val().replace(/[^0-9.-]+/g,""))+parseInt($("#salary_slip_cut_other2").val().replace(/[^0-9.-]+/g,""));
	$('#cut_total').val(cut_total.toLocaleString('en-US', {minimumFractionDigits: 2}));
	return cut_total;
}

/* absence_status readonly */
function absence_status_off() {
	$('#absence_work_in').prop('readonly', true);
	$('#absence_work_out').prop('readonly', true);
	$('#absence_break_in').prop('readonly', true);
	$('#absence_break_out').prop('readonly', true);
}

/* absence_status enable */
function absence_status_on() {
	$('#absence_work_in').prop('readonly', false);
	$('#absence_work_out').prop('readonly', false);
	$('#absence_break_in').prop('readonly', false);
	$('#absence_break_out').prop('readonly', false);
}

/* salary_total */
function salary_reset() {
	var salary_slip_basic_hidden=$('#salary_slip_basic_hidden').val();
	$('#salary_slip_basic').val(salary_slip_basic_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_position_hidden=$('#salary_slip_position_hidden').val();
	$('#salary_slip_position').val(salary_slip_position_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_insurance_hidden=$('#salary_slip_insurance_hidden').val();
	$('#salary_slip_insurance').val(salary_slip_insurance_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_transport_hidden=$('#salary_slip_transport_hidden').val();
	$('#salary_slip_transport').val(salary_slip_transport_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_food_hidden=$('#salary_slip_food_hidden').val();
	$('#salary_slip_food').val(salary_slip_food_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_insentif_daily_hidden=$('#salary_slip_insentif_daily_hidden').val();
	$('#salary_slip_insentif_daily').val(salary_slip_insentif_daily_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_commission_part_service_hidden=$('#salary_slip_commission_part_service_hidden').val();
	$('#salary_slip_commission_part_service').val(salary_slip_commission_part_service_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));

    var salary_slip_commission_part_hidden=$('#salary_slip_commission_part_hidden').val();
	$('#salary_slip_commission_part').val(salary_slip_commission_part_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
    var salary_slip_commission_service_hidden=$('#salary_slip_commission_service_hidden').val();
	$('#salary_slip_commission_service').val(salary_slip_commission_service_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));

	var salary_slip_insentif_unit_entry_hidden=$('#salary_slip_insentif_unit_entry_hidden').val();
	$('#salary_slip_insentif_unit_entry').val(salary_slip_insentif_unit_entry_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_insentif_product_hidden=$('#salary_slip_insentif_product_hidden').val();
	$('#salary_slip_insentif_product').val(salary_slip_insentif_product_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_insentif_service_hidden=$('#salary_slip_insentif_service_hidden').val();
	$('#salary_slip_insentif_service').val(salary_slip_insentif_service_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_insentif_bonus_hidden=$('#salary_slip_insentif_bonus_hidden').val();
	$('#salary_slip_insentif_bonus').val(salary_slip_insentif_bonus_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_insentif_no_alfa_hidden=$('#salary_slip_insentif_no_alfa_hidden').val();
	$('#salary_slip_insentif_no_alfa').val(salary_slip_insentif_no_alfa_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_fee_picket_hidden=$('#salary_slip_fee_picket_hidden').val();
	$('#salary_slip_fee_picket').val(salary_slip_fee_picket_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_cut_late_hidden=$('#salary_slip_cut_late_hidden').val();
	$('#salary_slip_cut_late').val(salary_slip_cut_late_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_cut_alfa_hidden=$('#salary_slip_cut_alfa_hidden').val();
	$('#salary_slip_cut_alfa').val(salary_slip_cut_alfa_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_cut_cashbon_hidden=$('#salary_slip_cut_cashbon_hidden').val();
	$('#salary_slip_cut_cashbon').val(salary_slip_cut_cashbon_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_cut_payable_hidden=$('#salary_slip_cut_payable_hidden').val();
	$('#salary_slip_cut_payable').val(salary_slip_cut_payable_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_cut_insurance_hidden=$('#salary_slip_cut_insurance_hidden').val();
	$('#salary_slip_cut_insurance').val(salary_slip_cut_insurance_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_cut_other1_hidden=$('#salary_slip_cut_other1_hidden').val();
	$('#salary_slip_cut_other1').val(salary_slip_cut_other1_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
	var salary_slip_cut_other2_hidden=$('#salary_slip_cut_other2_hidden').val();
	$('#salary_slip_cut_other2').val(salary_slip_cut_other2_hidden.toLocaleString('en-US', {minimumFractionDigits: 2}));
}

/* salari slip edit popup */
$('a.salary_slip_edit').on('click', function() {
    var myModal = $('#myModalnew');
    // now get the values from the table
	var staff_code = $(this).closest('tr').find('td.staff_code_hidden').html();
	staff_code = $(staff_code).text();
	var salary_slip_month = $(this).closest('tr').find('td.salary_slip_month_hidden').html();
	salary_slip_month = $(salary_slip_month).text();
    // and set them in the modal:
	var edit_link = "location.href='slip-edit.php?staff_code="+staff_code+"&salary_slip_month="+salary_slip_month+"'";
	$('button#btn_edit', myModal).attr('onclick',edit_link);
	var print_url = "pdf/salary-pdf.php?staff_code="+staff_code+"&salary_slip_month="+salary_slip_month+"";
	var print_link = "window.open('"+print_url+"', '_blank');return false;";
	$('button#btn_print', myModal).attr('onclick',print_link);
	var print_part_url = "pdf/salary-part-pdf.php?staff_code="+staff_code+"&salary_slip_month="+salary_slip_month+"";
	var print_part_link = "window.open('"+print_part_url+"', '_blank');return false;";
	$('button#btn_print_part', myModal).attr('onclick',print_part_link);
    // and finally show the modal
    myModal.modal({ show: true });
    return false;
});
</script>