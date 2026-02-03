<?
//cek popup
if(isset($popup)){
$link_list="service-popup.php";
$link_new="service-popup-new.php";
}else{
$link_list="service.php";
$link_new="service-new.php";
}
//delete
if(isset($_REQUEST['delete']))
{
$search=$_REQUEST['search'];
$sort=$_REQUEST['sort'];
$pageset=$_REQUEST['pageset'];
$per_page=$_REQUEST['per_page'];

if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $service_id) 
		{
		if(!$global->product_order->delete_service($service_id)){
			$global->product_order->error_message($global->product_order->err_msg);
			}
		}
	}	
Header("location: ".$link_list."?search=$search&sort=$sort&pageset=$pageset&per_page=$per_page");
exit;
}
?>
<?
//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="service_id DESC";
$pageset_value=0;
$per_page_value=50;

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

//query
$month_year="/".$month_value."/".$year_value;
$search_field_arr=array("service_code","service_name");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>""
);
$service_search_list=$global->tbl_search_list("service","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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