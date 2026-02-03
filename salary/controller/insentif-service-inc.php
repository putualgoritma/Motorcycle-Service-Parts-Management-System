<?
//cek popup
$link_list="insentif-service.php";
$link_new="insentif-new.php";
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

//staff
$staff_code_value=$_SESSION['insentif_staff_sessi'];
if (isset($_REQUEST['staff_code'])){
$staff_code_value=$_REQUEST['staff_code'];
$_SESSION['insentif_staff_sessi']=$_REQUEST['staff_code'];
}
$staff_code_match="";
if($staff_code_value!=""){
$staff_code_match=" AND staff.staff_code = '".$staff_code_value."'";
}

//service
$service_code_value=$_SESSION['insentif_service_sessi'];
if (isset($_REQUEST['service_code'])){
$service_code_value=$_REQUEST['service_code'];
$_SESSION['insentif_service_sessi']=$_REQUEST['service_code'];
}
$service_code_match="";
if($service_code_value!=""){
$service_code_match=" AND service_orderdetails.service_code = '".$service_code_value."'";
}

//set search array 
$search_field_arr=array("staff.staff_code","staff.staff_name","staff.staff_address");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>$date_range_match.$staff_code_match.$service_code_match." AND service_order.service_order_status='pmn'",
'join_id'=>"",
'join_tbl'=>array("staff","service_orderdetails"),
'join_type'=>array("LEFT JOIN","JOIN"),
'join_key'=>array("staff_code","service_order_id"),
'join_tbl_field'=>array("*","*"),
'join_tbl_group'=>array(0,0),
'join_tbl_id'=>array("",""),
);
$insentif_search_list=$global->tbl_searchjoin_list("service_order","service_order.service_order_code,staff.staff_code,staff.staff_name,service_orderdetails.service_code,service_orderdetails.service_orderdetails_price,service_orderdetails.service_orderdetails_quantity",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
//print_r($insentif_search_list);
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