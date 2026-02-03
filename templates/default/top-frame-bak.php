<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><? echo $site_lang['app_name']; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<? echo $path; ?>templates/default/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<? echo $path; ?>templates/default/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<? echo $path; ?>templates/default/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<? echo $path; ?>templates/default/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<? echo $path; ?>templates/default/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />        
        <!-- Theme style -->
        <link href="<? echo $path; ?>templates/default/css/fonts-googleapis.css" rel="stylesheet" type="text/css" />
        <link href="<? echo $path; ?>templates/default/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Style -->
        <link href="<? echo $path; ?>templates/default/css/style.css" rel="stylesheet" type="text/css">
        <!-- Style New-->
        <link href="<? echo $path; ?>templates/default/css/style-new.css" rel="stylesheet" type="text/css">
        <!-- Style icons-->
        <link href="<? echo $path; ?>templates/default/css/css-icons.css" rel="stylesheet" type="text/css">
        <!-- Datepicker -->
        <link href="<? echo $path; ?>templates/default/css/datepicker/jquery-ui.css" rel="stylesheet" type="text/css">        
        <!-- Ui totop -->
		<link href="<? echo $path; ?>templates/default/css/uitotop/ui.totop.css" rel="stylesheet" type="text/css">
        <!-- Freeze -->
        <link href="<? echo $path; ?>templates/default/css/freezeheader/freezeheader.css" rel="stylesheet" type="text/css">
        <!-- Style Tabs -->
        <link href="<? echo $path; ?>templates/default/css/style-tabs.css" rel="stylesheet" type="text/css">
        
        <!-- Master Data Accordion -->        
        <link href="<? echo $path; ?>templates/default/css/accordion/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="<? echo $path; ?>templates/default/css/accordion/jquery-ui-custome.css" rel="stylesheet" type="text/css">
        <!-- jQuery -->
        <script type="text/javascript" src="<? echo $path; ?>plugins/jquery-224.js"></script>
        <!-- Accordion -->
        <script type="text/javascript" src="<? echo $path; ?>plugins/accordion/jquery-ui.js"></script>
        <script>
		  $( function() {
			$( "#accordion" ).accordion({
			  collapsible: true,
			  heightStyle: "content"
			});
		  } );
		  </script>
		<!-- End Master Data Accordion -->
		
		<script type="text/javascript" src="<? echo $path; ?>plugins/form.js"></script>
        <!-- Ui totop -->
		
		

    </head>
    <body class="skin-blue">
    <div id="myloading"></div>
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <? include ($path."templates/default/banner.php"); ?>
            <!-- Header Navbar: style can be found in header.less -->
            <? include ($path."templates/default/top-menu.php"); ?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
        <? include ($path."templates/default/left-menu.php"); ?>