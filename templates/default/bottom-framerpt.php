    </body>
</html>
<!-- ./wrapper -->
        <!-- Bootstrap -->
        <script src="<? echo $path; ?>plugins/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<? echo $path; ?>plugins/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<? echo $path; ?>plugins/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<? echo $path; ?>plugins/AdminLTE/app.js" type="text/javascript"></script>
        <script src="<? echo $path; ?>plugins/dyndropbox/dyndrop.js"></script>
        <script src="<? echo $path; ?>plugins/typeahead.bundle.js"></script>

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
$(document).ready(function() {
  $('#cbshow').change(function(){
    if($(this).is(":checked"))
    $('#divshow').show();
    else
    $('#divshow').hide();
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