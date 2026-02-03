<?

if(isset($_REQUEST['delete']))

{

if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 

	{ 

	foreach ($_POST["id"] as $service_order_id) 

		{ 

		if(!$global->product_order->delete_service_order($service_order_id)){

			$global->product_order->error_message($global->product_order->err_msg);

			}

		}

	}	

Header("location: service-vendor.php");

exit;

}

?>

<?

if(!isset($_SESSION['service_vendor_drange1_sessi'])){

$_SESSION['service_vendor_drange1_sessi']="01/".date('m')."/".date('Y');

}

if(!isset($_SESSION['service_vendor_drange2_sessi'])){

$_SESSION['service_vendor_drange2_sessi']=date('d')."/".date('m')."/".date('Y');

}



//default view

$search_value="";

$pageset_value=0;

$per_page_value=0;

$sort_value="service_order.service_order_registernum DESC, service_order.service_order_id DESC";

$users_code_value="";

$date_range1_value=$global->date_strtonum($_SESSION['service_vendor_drange1_sessi']);

$date_range2_value=$global->date_strtonum($_SESSION['service_vendor_drange2_sessi']);



//if search

if (isset($_REQUEST['search'])){

$search_value=$_REQUEST['search'];

}

if (isset($_REQUEST['per_page'])){

$per_page_value=$_REQUEST['per_page'];

}

//users

if (isset($_REQUEST['users_code'])){

$users_code_value=$_REQUEST['users_code'];

}

//sort

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

$_SESSION['service_vendor_drange1_sessi']=$_REQUEST['date_range1'];

}

if (isset($_REQUEST['date_range2'])){

$valid_date2=$_REQUEST['date_range2'];

$valid_date2_arr=$global->valid_date($valid_date2);

$date_range2_value=$valid_date2_arr['date_registernum'];

$_SESSION['service_vendor_drange2_sessi']=$_REQUEST['date_range2'];

}

//array set

$search_field_arr=array("service_order.service_order_description","service_order.service_order_code","users.users_name");

//date range match

$date_range_match="AND (service_order.service_order_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

//users

$users_code_match="";

if($users_code_value!=""){

$users_code_match=" AND users.users_code = '".$users_code_value."'";

}

$def_arr=array(

'pageset'=>$pageset_value,

'per_page'=>$per_page_value,

'keyword'=>$search_value,

'sort'=>$sort_value,

'join_match'=>$date_range_match." AND service_order.service_order_type='pi' AND service_order.service_order_status = 'pmn'".$users_code_match." GROUP BY service_order.service_order_id",

'join_id'=>"",

'join_tbl'=>array("users","service_orderdetails"),

'join_type'=>array("LEFT JOIN","LEFT JOIN"),

'join_key'=>array("users_code","service_order_id"),

'join_tbl_field'=>array("users_code,users_name","service_order_id,(SUM(service_orderdetails_total)) AS service_orderdetails_price_total"),

'join_tbl_group'=>array(0,1),

'join_tbl_id'=>array("","service_orderdetails.service_orderdetails_status = 'pmn'"),

);

$service_order_search_list=$global->tbl_searchjoin_list("service_order","service_order.*,case when service_order_type = 'si' then service_order_accountdebit else service_order_accountcredit end AS service_order_accountpay,case when service_order_type = 'pi' then service_orderdetails.service_orderdetails_price_total end AS service_order_amount_buy,case when service_order_type = 'si' then service_orderdetails.service_orderdetails_price_total end AS service_order_amount_sale,users.users_name,service_orderdetails.service_orderdetails_price_total+service_order_tax_val+service_order_cost AS service_orderdetails_price_total",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

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

$total_debit=0;

$total_kredit=0;

//echo $qry_str_sort;

?>