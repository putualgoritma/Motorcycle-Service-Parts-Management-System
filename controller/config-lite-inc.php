<?
date_default_timezone_set("Asia/Makassar");

//local
//define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']."/Bengkel Ahass/");

//live
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']."/");

//global models
//include($path."models/global/global.class.php");
include($path."models/global/bridge.class.php");
	
//global set
//$global=new global_class();
$global=new bridge();
$site_lang=$global->site_lang;
$err_lang=$global->err_lang;
$msgform_lang=$global->msgform_lang;
$menu_lang=$global->menu_lang;
$form_header_lang=$global->form_header_lang;
$form_label_lang=$global->form_label_lang;
$form_selectlist_lang=$global->form_selectlist_lang;
$company=$global->db_row("company","*","");

//global init
$date_register=date("d/m/Y");
$datenum_register=date("Y").date("m");
$date_tbt=date("Y").date("m").date("d");
$date_def=date('d')."/".date('m')."/".date('Y');
$date_def_start="01/01/".$company['company_birthday'];
$date_expired=$date_tbt-2;
$parent_active="home";
$page_active="home";
?>