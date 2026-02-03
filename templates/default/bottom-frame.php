</body>
</html>
<!-- ./wrapper -->
		<!-- jQuery 2.0.2 -->
        <script src="<? echo $path; ?>plugins/jquery.min.js"></script>
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
        <script src="<? echo $path; ?>plugins/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<? echo $path; ?>plugins/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<? echo $path; ?>plugins/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<? echo $path; ?>plugins/AdminLTE/app.js" type="text/javascript"></script>
        <script src="<? echo $path; ?>plugins/dyndropbox/dyndrop.js"></script>
        <script src="<? echo $path; ?>plugins/typeahead.bundle.js"></script>
        <script src="<? echo $path; ?>plugins/autocomplete.js"></script>
        <script src="<? echo $path; ?>plugins/masknumber/jquery.masknumber.js"></script>

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
	
$('#myModalnew').on('load', function(){
  	//$('#myloading').fadeOut(500);
	$('#myloading').fadeIn(500);
	});

$("a").click(function() {
	//$('#myloading').fadeIn(500);
	});
	
$(":button").click(function() {
	$('#myloading').fadeIn(500);
	});

$("#myform").submit(function(){
    $('#myloading').fadeIn(500);
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
jQuery( "#datepicker01" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
});
jQuery( "#datepicker02" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
});
jQuery( "#datepicker" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
});
jQuery( "#datepicker2" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
});
jQuery( "#datepicker3" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
});
jQuery( "#datepicker4" ).datepicker({
	defaultDate: "+1w",
	changeMonth: true,
	numberOfMonths: 1,
	showOn: "both",
	buttonImageOnly: true,
	dateFormat: "dd/mm/yy",
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
	$('.masknumber').maskNumber({
	  integer: true,
	  thousands: '.',
	});
	
	$('input').focus(function() {
 // the select() function on the DOM element will do what you want
 this.select();
});
});
</script>
