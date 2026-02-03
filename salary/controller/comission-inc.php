<?
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
//cek popup
if(isset($popup)){
$link_list="slip-popup.php";
$link_new="slip-popup-new.php";
}else{
$link_list="comission.php";
$link_new="slip-new.php";
}

?>
<?
if(!isset($_SESSION['comission_drange1_sessi'])){
$_SESSION['comission_drange1_sessi']="01/".date('m')."/".date('Y');
$_SESSION['comission_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}

//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="staff.staff_code ASC";
$pageset_value=0;
$per_page_value=0;
$date_range1_value=$global->month_strtonum($_SESSION['comission_drange1_sessi']);
$date_range2_value=$global->month_strtonum($_SESSION['comission_drange2_sessi']);

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
$date_range1_value=$global->month_strtonum($valid_date1);
$_SESSION['comission_drange1_sessi']=$valid_date1;
$valid_date2=$_REQUEST['date_range2'];
$date_range2_value=$global->month_strtonum($valid_date2);
$_SESSION['comission_drange2_sessi']=$valid_date2;
}

//date range match
$date_range_match="(salary_slip.salary_slip_monthnum = '".$date_range1_value."')";

//set search array 
$search_field_arr=array("staff.staff_code","staff.staff_name","staff.staff_address");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>"",
'join_tbl'=>array("position","salary_slip"),
'join_type'=>array("LEFT JOIN","LEFT JOIN"),
'join_key'=>array("position_code","staff_code"),
'join_tbl_field'=>array("position_name,position_code","staff_code,salary_slip_amount"),
'join_tbl_group'=>array(0,1),
'join_tbl_id'=>array("",$date_range_match),
);
$slip_search_list=$global->tbl_searchjoin_list("staff","staff.staff_name,staff.staff_code,position.position_name,position.position_code,salary_slip.salary_slip_amount",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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