<?
//cek popup
if(isset($popup)){
$link_list="absence-popup.php";
$link_new="absence-popup-new.php";
}else{
$link_list="absence.php";
$link_new="absence-new.php";
}
//delete
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $absence_arr) 
		{
		//get id from array
		$absence_arr_exp=explode(";",$absence_arr);
		$absence_date=$global->date_stridtonum($absence_arr_exp[1]);
		$absence_id=$global->db_fldrow("absence","absence_id","staff_code='".$absence_arr_exp[0]."' AND absence_date LIKE '%".$absence_date."%'");
		if(!$global->salary->delete_absence($absence_id)){
			$global->salary->error_message($global->users->err_msg);
			}
		}
	}	
//Header("location: ".$link_list."");
//exit;
}
?>
<?
$global->salary->generate_absence(date('m')."/".date('Y'));
if(!isset($_SESSION['absence_drange1_sessi'])){
$_SESSION['absence_drange1_sessi']=date('d')."/".date('m')."/".date('Y');
}
if(!isset($_SESSION['absence_drange2_sessi'])){
$_SESSION['absence_drange2_sessi']=date('d')."/".date('m')."/".date('Y');
}

//default view
$search_value="";
$year_value="%";
$month_value="%";
$sort_value="absence.absence_date ASC,staff.staff_code ASC";
$pageset_value=0;
$per_page_value=0;
$date_range1_value=$global->date_stridtonum($_SESSION['absence_drange1_sessi']);
$date_range2_value=$global->date_stridtonum($_SESSION['absence_drange2_sessi']);

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
$date_range1_value=$global->date_stridtonum($valid_date1);
$_SESSION['absence_drange1_sessi']=$valid_date1;
}

if (isset($_REQUEST['date_range2'])){
$valid_date2=$_REQUEST['date_range2'];
$date_range2_value=$global->date_stridtonum($valid_date2);
$_SESSION['absence_drange2_sessi']=$valid_date2;
}

//date range match
$date_range_match="(absence.absence_date BETWEEN '".$date_range1_value."' AND '".$date_range2_value."')";

//get absence_penalty
$absence_penalty_select = $global->db_select("absence_penalty","*","absence_penalty_type='work'","",0,4);
$absence_penalty_data=$absence_penalty_select['select_data'];
//get absence_penalty break
$absence_penalty_select2 = $global->db_select("absence_penalty","*","absence_penalty_type='break'","",0,1);
$absence_penalty_data2=$absence_penalty_select2['select_data'];

//set search array 
$search_field_arr=array("staff.staff_code","staff.staff_name","staff.staff_address");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"AND ".$date_range_match,
'join_id'=>"",
'join_tbl'=>array("staff","position"),
'join_type'=>array("LEFT JOIN","LEFT JOIN"),
'join_key'=>array("staff_code","position_code"),
'join_tbl_field'=>array("*","position_name,position_code"),
'join_tbl_group'=>array(0,0),
'join_tbl_id'=>array("",""),
);
$absence_search_list=$global->tbl_searchjoin_multi_list("absence","absence.absence_date,absence.absence_status,(CASE WHEN absence_status LIKE 'work' THEN 1 END) AS absence_work,(CASE WHEN absence_status LIKE 'permission' THEN 1 END) AS absence_permission,(CASE WHEN absence_status LIKE 'sick' THEN 1 END) AS absence_sick,(CASE WHEN absence_status LIKE 'alfa' THEN 1 END) AS absence_alfa,(CASE WHEN absence_status LIKE 'holiday' THEN 1 END) AS absence_holiday,(CASE WHEN absence_status = 'work' AND absence_work_mlate BETWEEN '5' AND '".$absence_penalty_data[0]['absence_penalty_mlate']."' THEN 1 END) AS absence_work_mlate1,(CASE WHEN absence_status = 'work' AND absence_work_mlate BETWEEN '".$absence_penalty_data[0]['absence_penalty_mlate']."' AND '".$absence_penalty_data[1]['absence_penalty_mlate']."' THEN 1 END) AS absence_work_mlate2,(CASE WHEN absence_status = 'work' AND absence_work_mlate BETWEEN '".$absence_penalty_data[1]['absence_penalty_mlate']."' AND '".$absence_penalty_data[2]['absence_penalty_mlate']."' THEN 1 END) AS absence_work_mlate3,(CASE WHEN absence_status = 'work' AND absence_work_mlate > '".$absence_penalty_data[2]['absence_penalty_mlate']."' THEN 1 END) AS absence_work_mlate4,(CASE WHEN absence_status = 'work' AND absence_break_mlate > '".$absence_penalty_data2[0]['absence_penalty_mlate']."' THEN 1 END) AS absence_break_mlate1, staff.staff_name,staff.staff_code,staff.staff_address,position.position_name,position.position_code",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);
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