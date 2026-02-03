<? $path="../../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $motorcycle_id) 
		{
		if(!$global->product_order->delete_motorcycle($motorcycle_id)){
			$global->product_order->error_message($global->product_order->err_msg);
			}
		}
	}	
}
?>