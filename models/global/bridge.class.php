<?php
require_once(SITE_ROOT."models/global/global.class.php");
require_once(SITE_ROOT."payreceivable/models/payreceivable/payreceivable.class.php");
require_once(SITE_ROOT."book/models/book/book.class.php");
require_once(SITE_ROOT."asset-fixed/models/asset-fixed/asset_fixed.class.php");
require_once(SITE_ROOT."csv/models/csv/csv.class.php");
require_once(SITE_ROOT."users/models/users/users.class.php");
require_once(SITE_ROOT."product-service/models/product-service/product_service.class.php");
require_once(SITE_ROOT."salary/models/salary/salary.class.php");

class bridge extends global_class 
{
public $err_msg;
function __construct()
	{
	parent::__construct();
	$this->book = new book();
	$this->asset_fixed = new asset_fixed();
	$this->payreceivable = new payreceivable();
	$this->csv = new csv();
	$this->users = new users();
	$this->product_order = new product_order();
	$this->salary = new salary();
	}	
}
?>
