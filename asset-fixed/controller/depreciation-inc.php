<?
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $depreciation_id) 
		{ 
		$ledger_id=$global->db_fldrow("depreciation","ledger_id","depreciation_id='".$depreciation_id."'");
		$global->db_delete("ledgerdetails","ledger_id='".$ledger_id."'");
		$global->db_delete("ledger","ledger_id='".$ledger_id."'");
		$global->db_delete("depreciation","depreciation_id='".$depreciation_id."'");
		}
	}	
Header("location: depreciation.php");
exit;
}
?>
<?
if(!isset($_SESSION['depreciation_search_sessi'])){
$_SESSION['depreciation_search_sessi']="";
}
if(!isset($_SESSION['depreciation_drange1_sessi'])){
$_SESSION['depreciation_drange1_sessi']="01/01/".date('Y');
}
if(!isset($_SESSION['depreciation_drange2_sessi'])){
$_SESSION['depreciation_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['depreciation_sort_sessi'])){
$_SESSION['depreciation_sort_sessi']="depreciation.depreciation_id ASC";
}
if(!isset($_SESSION['depreciation_pageset_sessi'])){
$_SESSION['depreciation_pageset_sessi']=0;
}
if(!isset($_SESSION['depreciation_per_page_sessi'])){
$_SESSION['depreciation_per_page_sessi']=50;
}
//default view
$search_value=$_SESSION['depreciation_search_sessi'];
$pageset_value=$_SESSION['depreciation_pageset_sessi'];
$per_page_value=$_SESSION['depreciation_per_page_sessi'];
$sort_value=$_SESSION['depreciation_sort_sessi'];
$date_range1_value=$global->date_strtonum($_SESSION['depreciation_drange1_sessi']);
$date_range2_value=$global->date_strtonum($_SESSION['depreciation_drange2_sessi']);
//if search
if (isset($_REQUEST['search'])){
$search_value=$_REQUEST['search'];
$_SESSION['depreciation_search_sessi']=$_REQUEST['search'];
}
if (isset($_REQUEST['per_page'])){
$per_page_value=$_REQUEST['per_page'];
$_SESSION['depreciation_per_page_sessi']=$_REQUEST['per_page'];
}
if (isset($_REQUEST['date_range1'])){
$valid_date1=$_REQUEST['date_range1'];
$valid_date1_arr=$global->valid_date($valid_date1);
$date_range1_value=$valid_date1_arr['date_registernum'];
$_SESSION['depreciation_drange1_sessi']=$_REQUEST['date_range1'];
}
if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$valid_date2_arr=$global->valid_date($valid_date2);
$date_range2_value=$valid_date2_arr['date_registernum'];
$_SESSION['depreciation_drange2_sessi']=$_REQUEST['date_range2'];
}
//sort
if (isset($_REQUEST['sort'])){
$sort=$_REQUEST['sort'];
$sort_value=$sort;
$_SESSION['depreciation_sort_sessi']=$_REQUEST['sort'];
}
//pageset
if (isset($_REQUEST['pageset'])){
$pageset_value=$_REQUEST['pageset'];
$_SESSION['depreciation_pageset_sessi']=$_REQUEST['pageset'];
}
//date range match
$date_range_match="(depreciation.depreciation_registernum BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

//query
$search_field_arr=array();
$def_arr=array(
'pageset'=>0,
'per_page'=>0,
'keyword'=>"",
'sort'=>$sort_value,
'join_match'=>"depreciation.asset_fixed_id = '$search_value' AND ".$date_range_match,
'join_id'=>" AND depreciation.asset_fixed_id = asset_fixed.asset_fixed_id"
);
$depreciation_search_list=$global->tbl_search_list("depreciation,asset_fixed","depreciation.*,asset_fixed.*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//additional init
$inc=1;
$saldo=0;
$total_angsuran=0;

//echo $qry_str_sort;
?>