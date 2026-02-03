</body>
</html>
<!-- ./wrapper -->
        <!-- main -->
        <script src="<? echo $path; ?>plugins/freezeheader/main.js"></script>
        <!-- freezeheader -->
        <script type="text/javascript" src="<? echo $path; ?>plugins/freezeheader/jquery.freezeheader.js"></script>
		<script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $("#table1").freezeHeader({'offset': '44px'});
        })
    	</script>
        <!-- Bootstrap -->
        <script src="<? echo $path; ?>plugins/bootstrap.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<? echo $path; ?>plugins/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<? echo $path; ?>plugins/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<? echo $path; ?>plugins/AdminLTE/app.js" type="text/javascript"></script>
        <script src="<? echo $path; ?>plugins/dyndropbox/dyndrop.js"></script>
        <script src="<? echo $path; ?>plugins/typeahead.bundle.js"></script>
        <script src="<? echo $path; ?>plugins/masknumber/jquery.masknumber.js"></script>
        <!-- Masking -->
        <script type="text/javascript" src="<? echo $path; ?>plugins/inputmask/autoNumeric-1.8.3.js"></script>
		<script type="text/javascript">
            $(function() {
                $("#example1").dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
				$('#example2').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
        </script>
<script type="text/javascript" src="<? echo $path; ?>plugins/plugins/datepicker/jquery-ui.custom.js"></script> 
<script type="text/javascript" src="<? echo $path; ?>plugins/date-input-mask/jquery.mask.js"></script> 
<script type="text/javascript">
  $(function() {
    $('.time').mask('99:99');
	$('.mdate').mask('99/99/9999');
  });
</script>
<script>
jQuery(document).ready(function() {
    jQuery('#myloading').fadeOut(500);
});

window.onpageshow = function(event) {
    jQuery('#myloading').fadeOut(500);
};
</script>

<script>
$(document).ready(function() {
	
$("a").click(function() {
	if($(this).hasClass('dropdown-toggle')){
  	}
	else if($(this).hasClass('link_modal')){
  	}
	else if($(this).hasClass('alink_excp')){
	}
	else if($(this).hasClass('sidebar-toggle')){
  	}
	else if($(this).hasClass('atab')){
  	}
	else{
	//$('#myloading').fadeIn(500);
	}
	});

$("#btn_new").click(function(){
    $('#myloading').fadeIn(500);
    });
	
$(".load_link").click(function(){
    $('#myloading').fadeIn(500);
    });
	
$("button#btn_import").click(function(){
    $('#myloading').fadeIn(500);
	});

$("#form").submit(function(){
    $('#myloading').fadeIn(500);
    });
	
$("#delform").submit(function(){
	if(confirm("Anda sungguh-sungguh mau menghapus data dari Database?")){
        $('#myloading').fadeIn(500);
    }else{
		return false;
	  }
    });
	
$("#delpopform").submit(function(){
	if(confirm("Anda sungguh-sungguh mau menghapus data dari Database?")){
        $('#myloading').fadeIn(500);
    }else{
		return false;
	  }
    });
	
$("#formsearch").submit(function(){
    $('#myloading').fadeIn(500);
    });

$(".skin-blue").keydown(function(event) {
    if(event.which == 112) { //F1
    $('.firstin').focus();
    return false;
    }
	if(event.which == 113) { //F2
    $(".hotkey").focus();
	 $('#btn_new2').click();
    return false;
    }
	if(event.which == 114) { //F3 btn_new
    $('#btn_new').click();
    return false;
    }
	if(event.which == 115) { //F4
    $('#Submitdel').click();
    return false;
    }
	if(event.which == 116) { //F5
    $('#Submit').click();
    return false;
    }
	if(event.which == 117) { //F6
    $('#Submitcancell').click();
    return false;
    }
	if(event.which == 118) { //F7
    $('#Submitpay').click();
    return false;
    }
	});
	
$("#search").keydown(function(event) {
    if(event.which == 13) { //Enter
    $('#formsearch').submit();
    return false;
    }
	});
	
$(".lastin").keydown(function(event) {
    if(event.which == 13) { //Enter
    $('#Submit').click();
	//$(this).closest("button").click();
    return false;
    }
	});
	
$(".lastinnew").keydown(function(event) {
    if(event.which == 13) { //Enter
    $('#Submitnew').click();
	//$(this).closest("button").click();
    return false;
    }
	});
	
$(".lastinnew2").keydown(function(event) {
    if(event.which == 13) { //Enter
    $('#Submitnew2').click();
	//$(this).closest("button").click();
    return false;
    }
	});
	
$(".lastinnew3").keydown(function(event) {
    if(event.which == 13) { //Enter
    $('#Submitnew3').click();
	//$(this).closest("button").click();
    return false;
    }
	});
	
$(".lastinedit").keydown(function(event) {
    if(event.which == 13) { //Enter
    $('#Submitedit').click();
	//$(this).closest("button").click();
    return false;
    }
	});
	
$(".lastinedit2").keydown(function(event) {
    if(event.which == 13) { //Enter
    $('#Submitedit2').click();
	//$(this).closest("button").click();
    return false;
    }
	});
	
$('#cbshow').change(function(){
    if($(this).is(":checked"))
    $('#divshow').show();
    else
    $('#divshow').hide();
    });
	
$(".lastinlist").keydown(function(event) {
    if(event.which == 13) { //Enter
   $(this).closest('table').find('#btn_add_list').click();
   // $(this).closest('#btn_add_list').click();
	//$('#btn_add_list').click();
	event.preventDefault();
    return false;
    }
	});
	
$(".jumptrg").keydown(function(event) {
    if(event.which == 13) { //Enter
    $('.trgjump').focus();
	//$(this).closest("button").click();
    return false;
    }
	});

	
});
</script>	

<script type="text/javascript">
$(document).ready(function () {
$('.firstin').focus();
$('.modal').on('shown.bs.modal', function () {
  lastfocus = $(this);
  $(this).find('input.firstin').focus();
});
});
</script>

<script type="text/javascript">
$(document).ready(function () {
var inputs = $(':input').keypress(function (e) {
var tagName = e.target.tagName.toLowerCase(); 
if (tagName !== "button") {
if (e.which == 13) {
e.preventDefault();
var nextInput = inputs.get(inputs.index(this) + 1);
if (nextInput) {
nextInput.focus();
}}}
});
});
</script>

<script>
jQuery(function() {

jQuery( ".monthpicker" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "mm/yy",
	changeYear: true,
});
jQuery( ".datepicker" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
	changeYear: true,
});
jQuery( "#datepicker01" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
	changeYear: true,
});
jQuery( "#datepicker02" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
	changeYear: true,
});
jQuery( "#datepicker" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
	changeYear: true,
});
jQuery( "#datepicker2" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
	changeYear: true,
});
jQuery( "#datepicker3" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
	changeYear: true,
});
jQuery( "#datepicker4" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
	changeYear: true,
});
});
</script>

<script>
		$(document).ready(function() {
			// Show or hide the sticky footer button
			$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('.go-top').fadeIn(200);
				} else {
					$('.go-top').fadeOut(200);
				}
			});
			
			// Animate the scroll to top
			$('.go-top').click(function(event) {
				event.preventDefault();
				
				$('html, body').animate({scrollTop: 0}, 300);
			})
		});
        </script>
<script>
//input mask
$(document).ready(function() {
	$('.masknumber').autoNumeric('init');
	$('.masknumber_unused').maskNumber({
	  integer: true,
	  thousands: ',',
	});
	
	$('input').focus(function() {
 // the select() function on the DOM element will do what you want
 this.select();
});
});
//input upperc
$(document).ready(function(){
    $('.masktxtup').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
});

//opt area
$(document).ready(function() {
//checked
$('.opt_check').change(function() {
if($(this).is(":checked")) {
	$("div.opt_area").show();
	}else{
	$("div.opt_area").hide();
	}
});
//tr clickable
$(".clickable-row2").click(function() {
        if($(this).data("href")!=""){
		window.location = $(this).data("href");
		}
    });
$(".clickable-row").click(function(e) {
    if (e.target.type == "checkbox") {
        e.stopPropagation();
    } else {
        if($(this).data("href")!=""){
		window.location = $(this).data("href");
		}
    }
	});
});
</script>

<script type="text/javascript">
function selectValue(url){
    // open popup window and pass field id
    window.open(url,'popuppage','width=640,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');
}

function selectValue2(url,pname){
    // open popup window and pass field id
    window.open(url,pname,'width=640,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');
}

function updateValue(id2, value2, typeh){
    // this gets called from the popup window and updates the field with a new value
    var e = jQuery.Event("keydown");
	e.which = 13; // # Some key code value
	//$("input").trigger(e);
	document.getElementById(id2).value = value2;
	document.getElementById(id2).focus();
	//document.getElementById(id2).trigger(e);
	//$("input#"+id2).value = value2;
	//$("input#"+id2).focus();
	$("input#"+id2).trigger(e);
	//$('.typehead_motorcycle #'+id2).typeahead('val', value2);
	if(typeh!=""){
	$('.'+typeh+' #'+id2).typeahead('val', value2);
	}
}

function sendValue(parentId,value2, typeh=""){
    window.opener.updateValue(parentId, value2, typeh);
    window.close();
}
</script>
