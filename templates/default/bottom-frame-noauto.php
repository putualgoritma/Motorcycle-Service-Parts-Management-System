</body>
</html>
<!-- ./wrapper -->
        <!-- main -->
        <script>
		var company_stock_block=<?php echo $company['company_stock_block']; ?>;
		</script>
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
<script type="text/javascript" src="<? echo $path; ?>plugins/js-custome.js"></script> 