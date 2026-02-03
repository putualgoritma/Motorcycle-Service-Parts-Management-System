<?
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $asset_fixed_id) 
		{
		if(!$global->asset_fixed->delete_asset_fixed($asset_fixed_id)){
			$global->asset_fixed->error_message($global->asset_fixed->err_msg);
			}
		}
	}	
Header("location: asset-fixed.php");
exit;
}
?>
<?
if(!isset($_SESSION['afixed_search_sessi'])){
$_SESSION['afixed_search_sessi']="";
}
if(!isset($_SESSION['afixed_drange1_sessi'])){
$_SESSION['afixed_drange1_sessi']=$date_def_start;
}
if(!isset($_SESSION['afixed_drange2_sessi'])){
$_SESSION['afixed_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['afixed_sort_sessi'])){
$_SESSION['afixed_sort_sessi']="asset_fixed_registernum DESC, asset_fixed_id DESC";
}
if(!isset($_SESSION['afixed_pageset_sessi'])){
$_SESSION['afixed_pageset_sessi']=0;
}
if(!isset($_SESSION['afixed_per_page_sessi'])){
$_SESSION['afixed_per_page_sessi']=50;
}
//default view
$search_value=$_SESSION['afixed_search_sessi'];
$pageset_value=$_SESSION['afixed_pageset_sessi'];
$per_page_value=$_SESSION['afixed_per_page_sessi'];
$sort_value=$_SESSION['afixed_sort_sessi'];
$date_range1_value=$global->date_strtonum($_SESSION['afixed_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['afixed_drange2_sessi']);
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
$_SESSION['afixed_search_sessi']=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
$_SESSION['afixed_per_page_sessi']=$_REQUEST['per_page'];
}
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['afixed_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['afixed_drange2_sessi']=$_REQUEST['date_range2'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
$_SESSION['afixed_sort_sessi']=$_REQUEST['sort'];
}
//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
$_SESSION['afixed_pageset_sessi']=$_REQUEST['pageset'];
}
//query
$search_field_arr=array("asset_fixed_code","asset_fixed_amount","asset_fixed_name","asset_fixed_depreciation_period","asset_fixed_depreciation_type");
//date range match
$date_range_match="(asset_fixed.asset_fixed_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND ".$date_range_match,
'join_id'=>"",
'join_tbl'=>array("users"),
'join_type'=>array("LEFT JOIN"),
'join_key'=>array("users_code"),
'join_tbl_field'=>array("users_name,users_code"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);
$asset_fixed_search_list=$global->tbl_searchjoin_list("asset_fixed","asset_fixed.*,users.users_name,users.users_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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
$asset_fixed_code_generation=$global->asset_fixed->generator_asset_fixed_code();
?>