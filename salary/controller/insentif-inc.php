<?
//cek popup
if(isset($popup)){
$link_list="insentif-popup.php";
$link_new="insentif-popup-new.php";
}else{
$link_list="insentif.php";
$link_new="insentif-new.php";
}
//delete
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $insentif_id) 
		{
		if(!$global->users->delete_insentif($insentif_id)){
			$global->users->error_message($global->users->err_msg);
			}
		}
	}	
Header("location: ".$link_list."");
exit;
}
?>
<?
if(!isset($_SESSION['insentif_drange1_sessi'])){
$_SESSION['insentif_drange1_sessi']="01/".date('m')."/".date('Y');
}
if(!isset($_SESSION['insentif_drange2_sessi'])){
$_SESSION['insentif_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}

//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="staff.staff_code ASC";
$group_value="staff.staff_code";
$pageset_value=0;
$per_page_value=0;
$date_range1_value=$global->date_strtonum($_SESSION['insentif_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['insentif_drange2_sessi']);

//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
}

if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
}

//slect order by
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
}

//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
}

if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['insentif_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['insentif_drange2_sessi']=$_REQUEST['date_range2'];
}

//date range match
$date_range_match="AND (service_order.service_order_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

//set search array 
$search_field_arr=array("staff.staff_code","staff.staff_name","staff.staff_address");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'group'=>$group_value,
'join_match'=>$date_range_match." AND service_order.service_order_status='pmn'",
'join_id'=>"",
'join_tbl'=>array("staff","service_orderdetails","product_orderdetails"),
'join_type'=>array("LEFT JOIN","LEFT JOIN","LEFT JOIN"),
'join_key'=>array("staff_code","service_order_id","service_order_id"),
'join_tbl_field'=>array("*","service_order_id,(SUM(service_orderdetails_total)) AS service_orderdetails_total","service_order_id,(SUM(product_orderdetails_total)) AS product_orderdetails_total"),
'join_tbl_group'=>array(0,1,1),
'join_tbl_id'=>array("","",""),
);
$insentif_search_list=$global->tbl_searchjoin_list("service_order","service_order.service_order_code,staff.staff_code,staff.staff_name,COUNT(service_order.service_order_id) AS unit_entry,SUM(service_orderdetails.service_orderdetails_total) AS amount_service,SUM(product_orderdetails.product_orderdetails_total) AS amount_product,(COUNT(service_order.service_order_id)/".$company['company_target_unit_entry'].")*100 AS unit_entry_ratio,(SUM(service_orderdetails.service_orderdetails_total)/".$company['company_target_service'].")*100 AS amount_service_ratio,(SUM(product_orderdetails.product_orderdetails_total)/".$company['company_target_product'].")*100 AS amount_product_ratio,(CASE WHEN ((COUNT(service_order.service_order_id)/".$company['company_target_unit_entry'].")*100) >=100 AND ((SUM(service_orderdetails.service_orderdetails_total)/".$company['company_target_service'].")*100) >=100 AND ((SUM(product_orderdetails.product_orderdetails_total)/".$company['company_target_product'].")*100) >=100 THEN 1 ELSE 0 END) AS target_bonus",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
//next prev
if($per_page_value<=0){
$total_page=1;
$current_page=1;
}else{
$total_page=ceil($select_num/$per_page_value);
$current_page=($pageset_value/$per_page_value)+1;
}
$pageset_prev=$pageset_value-$per_page_value;
$pageset_next=$pageset_value+$per_page_value;
$pageset_last=($total_page-1) * $per_page_value;

//additional init
$inc=1+$pageset_value;
//echo $qry_str_sort;
?>