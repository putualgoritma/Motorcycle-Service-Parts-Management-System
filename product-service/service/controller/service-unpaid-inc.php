<?
if(isset($_REQUEST['service_order_id']))
{
$update_arr = array(
'service_order_status'=>	"unpaid",
);
$global->db_update("service_order",$update_arr,"service_order_id='".$_REQUEST['service_order_id']."'");
Header("location: service.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>