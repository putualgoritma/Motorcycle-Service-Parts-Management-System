<?
if(isset($_REQUEST['service_order_id']))
{
//if play
if($_REQUEST['play']==1){
$service_order_check_in = date('Y-m-d G:i:s');
	//update arr
	$update_arr = array(
	'service_order_status'=>	"process",
	'service_order_check_in'=>	$service_order_check_in,
	'service_order_check_out'=>	"",
	);
}else{
//else if pause
	//get pause check in & out
	$service_order_row=$global->db_row("service_order","service_order_check_in,service_order_check_d,service_order_check_h,service_order_check_m","service_order_id='".$_REQUEST['service_order_id']."'");
	$service_order_check_in=$service_order_row['service_order_check_in'];
	$service_order_check_out = date('Y-m-d G:i:s');
	$start_date = new DateTime($service_order_check_in);
	$service_order_duration = $start_date->diff(new DateTime($service_order_check_out));
	$service_order_check_d=$service_order_row['service_order_check_d']+$service_order_duration->days;
	$service_order_check_h=$service_order_row['service_order_check_h']+$service_order_duration->h;
	$service_order_check_m=$service_order_row['service_order_check_m']+$service_order_duration->i;
	//update arr
	$update_arr = array(
	'service_order_status'=>	"pause",
	'service_order_check_out'=>	$service_order_check_out,
	'service_order_check_d'=>	$service_order_check_d,
	'service_order_check_h'=>	$service_order_check_h,
	'service_order_check_m'=>	$service_order_check_m,
	);
	}
$global->db_update("service_order",$update_arr,"service_order_id='".$_REQUEST['service_order_id']."'");
Header("location: service.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>