<?
if(isset($_REQUEST['delete']))
{
$search=$_REQUEST['search'];
$sort=$_REQUEST['sort'];
$pageset=$_REQUEST['pageset'];
$per_page=$_REQUEST['per_page'];

if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $module_sub_id) 
		{
		if(!$global->users->delete_module_sub($module_sub_id)){
			$global->users->error_message($global->users->err_msg);
			}
		}
	}	
Header("location: module-sub.php?search=$search&sort=$sort&pageset=$pageset&per_page=$per_page");
exit;
}
?>
<?
//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="module.module_rank ASC,module_sub.module_sub_rank ASC";
$pageset_value=0;
$per_page_value=0;

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

//set search array 
$month_year="/".$month_value."/".$year_value;
$search_field_arr=array("module_sub.module_sub_code","module_sub.module_sub_name","module.module_name");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>"",
'join_tbl'=>array("module"),
'join_type'=>array("JOIN"),
'join_key'=>array("module_code"),
'join_tbl_field'=>array("module_name,module_code,module_rank"),
'join_tbl_group'=>array(0),
'join_tbl_id'=>array(""),
);
$module_sub_search_list=$global->tbl_searchjoin_list("module_sub","module_sub.*,module.module_name,module.module_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

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