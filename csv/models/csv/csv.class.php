<?php
require_once(SITE_ROOT."payreceivable/models/payreceivable/payreceivable.class.php");
require_once(SITE_ROOT."book/models/book/book.class.php");
require_once(SITE_ROOT."asset-fixed/models/asset-fixed/asset_fixed.class.php");
require_once(SITE_ROOT."users/models/users/users.class.php");
class csv extends global_class 
{
public $err_msg;
public $csv_lang;
function __construct()
	{
	include(SITE_ROOT."config/global.php");
	include(SITE_ROOT."csv/lang/".$glob_config['db_config']['lang']."/lang.php");
	parent::__construct();
	$this->book = new book();
	$this->asset_fixed = new asset_fixed();
	$this->payreceivable = new payreceivable();
	$this->users = new users();
	$this->csv_lang = $csv_lang;
	}	
}
?>
