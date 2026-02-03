<?php
class global_class
{
var $site_lang;
var $msgform_lang;
var $db_config;
var $err_lang;
var $menu_lang;
var $form_header_lang;
var $form_label_lang;
var $form_selectlist_lang;
var $db_con;
var $tmp_con;
var $db_stat;
var $db_name;
var $err_msg;
var $random_num;
public $array_mnt=array("01","02","03","04","05","06","07","08","09","10","11","12");

function __construct()
	{
	//global config & lang
	include(SITE_ROOT."config/global.php");
	include(SITE_ROOT."lang/".$glob_config['db_config']['lang']."/lang.php");
	srand(time());
	$this->random_num=(rand()%10000);
	$this->site_lang=$glob_lang['site_lang'];
	$this->msgform_lang=$glob_lang['msgform_lang'];
	$this->db_config=$glob_config['db_config'];
	$this->err_lang=$glob_lang['err_lang'];
	$this->menu_lang=$glob_lang['menu_lang'];
	$this->form_header_lang=$glob_lang['form_header_lang'];
	$this->form_label_lang=$glob_lang['form_label_lang'];
	$this->form_selectlist_lang=$glob_lang['form_selectlist_lang'];
	$this->db_con= new mysqli($this->db_config['db_host'],$this->db_config['db_user'], $this->db_config['db_password'], $this->db_config['db_name']);
	if (mysqli_connect_errno()) {
		$this->err_get(1);
		}

	}

function form_required($required_arr,&$msg)
	{
	$result = true;
	for($i=0;$i<count($required_arr);$i++)
		{
		if(trim($required_arr[$i][0])=="")
			{
			$msg="<script>alert('".$required_arr[$i][1]."');history.go(-1)</script>";
			$result = false;
			break;
			}
		}
  	return $result;
	}
	
function err_get($err)
	{
	switch($err)
		{
		case 1: //MysSQL Server ..
		$msg = $this->err_lang['err_msg1'];
		break;
		case 2: //Database error..
		$msg = $this->err_lang['err_msg2'];
		break;
		case 3: //Table wasn't found..
		$msg = $this->err_lang['err_msg3'];
		break;
		case 4:
		$msg = $this->err_lang['err_msg4'];
		break;
		}
	$this->err_msg=$msg;
	}

function db_get_defaults($cTable=null) 
	{
	// Returns an array containing default values for each field in the table (key => value array).
	// Be aware that some fields (auto_increment, CURRENT_TIMESTAMP) may need to be set on INSERT.
	// auto_increment fields will be set to 0
	// CURRENT_TIMESTAMP fields will be set to the PHP current timestamp based on the time the function 
	//  call was made
	
	// If cTable was not passed in, return empty array:
	if ($cTable==null ) return array();
	  
	// Set up blank array:
	$aReturn_value = array();
	  
	// Get the fields:
	$cSQL = 'SHOW COLUMNS FROM `'.$cTable.'`';
	$rResult = $this->query_run($cSQL);
	$nResult = $this->num_rows($rResult);
	if (count($nResult)==0) return array();
	
	// Scan through each field and assign defaults:
	for($i=0;$i<$nResult;$i++) 
		{
		$aVals = $this->fetch_assoc($rResult);
		if ($aVals['Default'] AND $aVals['Default']=='CURRENT_TIMESTAMP') 
			{
			$aReturn_value[$aVals['Field']] = date('Y-m-d H:i:s');      
			}
		if ($aVals['Extra'] AND $aVals['Extra']=='auto_increment') 
			{
			$aReturn_value[$aVals['Field']] = 0;      
			}
		if ($aVals['Default'] AND $aVals['Default']!='CURRENT_TIMESTAMP') 
			{
			$aReturn_value[$aVals['Field']] = $aVals['Default'];
			} 
		else 
			{
			if ($aVals['Null']=='YES') 
				{
				$aReturn_value[$aVals['Field']] = NULL;
				} 
			else 
				{
				$cType = $aVals['Type'];
				if (strpos($cType,'(')!==false)
				$cType = substr($cType,0,strpos($cType,'('));
				if (in_array($cType,array('varchar','text','char','tinytext','mediumtext','longtext','set',
				'binary','varbinary','tinyblob','blob','mediumblob','longblob'))) 
					{
					$aReturn_value[$aVals['Field']] = '';
					} 
				elseif ($cType=='datetime') 
					{
					$aReturn_value[$aVals['Field']] = '0000-00-00 00:00:00';
					} 
				elseif ($cType=='date') 
					{
					$aReturn_value[$aVals['Field']] = '0000-00-00';
					} 
				elseif ($cType=='time') 
					{
					$aReturn_value[$aVals['Field']] = '00:00:00';
					} 
				elseif ($cType=='year') 
					{
					$aReturn_value[$aVals['Field']] = '0000';
					} 
				elseif ($cType=='timestamp') 
					{
					$aReturn_value[$aVals['Field']] = date('Y-m-d H:i:s');
					} 
				elseif ($cType=='enum') 
					{
					$aReturn_value[$aVals['Field']] = 1;
					} 
				else 
					{  // Numeric:
					$aReturn_value[$aVals['Field']] = 0;
					}
				}  // end NOT NULL
			}  // end default check
		}  // end foreach loop
	return $aReturn_value;
	}
	
function table_exists($table, $db) 
	{ 
	$qry_str = sprintf("SHOW TABLES FROM %s", $db);
	$qry = $this->query_run($qry_str);
	if (!$qry) 
		{
		$this->err_get(4);
		}
	while ($row = $this->fetch_row($qry)) 
		{
		if ($row[0] == $table)
			{
			return TRUE;
			}
		}
	return FALSE;
	}

function num_format($amt)
	{
	return number_format($amt, 2, ',', '.');
	}
	
function num_format2($amt,$dec=2)
	{
	return number_format($amt, $dec, '.', ',');
	}

function fetch_row($qry)
	{
	//return mysqli_fetch_row($qry);
	return mysqli_fetch_row($qry);
	}

function fetch_assoc($qry)
	{
	return mysqli_fetch_assoc($qry);
	}

function query_run($qry_str)
	{
	//return mysql_query($qry_str,$this->db_con);
	if (!$mysql_qry = mysqli_query($this->db_con,$qry_str)) {
		echo("Error mysql description: " . mysqli_error($this->db_con));
	  }
	//return mysqli_query($this->db_con,$qry_str);
	return $mysql_qry;
	}

function num_rows($qry)
	{
	return mysqli_num_rows($qry);
	}

function close_con()
	{
	mysqli_close($this->db_con);
	}
	
function db_create($tbl,$qry_arr)
	{
	$tbl_fld="";
	$arr_last=count($qry_arr)-1;
	for($i=0;$i<count($qry_arr);$i++)
		{
		if($i==$arr_last)
			{
			$tbl_fld.=$qry_arr[$i];
			}
		else
			{
			$tbl_fld.=$qry_arr[$i].",";
			}
		}
	$qry_str = sprintf("CREATE TEMPORARY TABLE %s ( %s ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1",$tbl,$tbl_fld);
	$this->query_run($qry_str);
	}
	
function db_insert($tbl,$qry_arr,&$qry_str="")
	{
	$tbl_fld="(";
	$tbl_fld_val="(";
	$i=0;
	$arr_last=count($qry_arr)-1;
	foreach($qry_arr as $key => $value)
		{
		if($i==$arr_last)
			{
			$tbl_fld.=$key.")";
			$tbl_fld_val.="'".$value."'".")";
			}
		else
			{
			$tbl_fld.=$key.",";
			$tbl_fld_val.="'".$value."'".",";
			}
		$i++;
		}
	$qry_str = sprintf("INSERT INTO %s %s VALUES %s",$tbl,$tbl_fld,$tbl_fld_val);
	$this->query_run($qry_str);
	//return $qry_str;
	}
	
function db_select($tbl,$tbl_field,$tbl_id,$sort_val,$pageset_val,$page_per)
	{
	$return_arr=array();
	$select_data = array(); 
	$qry_str = sprintf("SELECT %s FROM %s",$tbl_field,$tbl);
	if($tbl_id!="")
		{
		$qry_str .= sprintf(" WHERE %s",$tbl_id);
		}
	if($sort_val!="")
		{
		$qry_str .= sprintf(" ORDER BY %s",$sort_val);
		}
	$qry_str_sort = $qry_str;
	$qry_num=$this->query_run($qry_str);
	$select_num=0;
	if($qry_num){
		$select_num=$this->num_rows($qry_num);
		}
	if($page_per>0)
		{
		$qry_str .= sprintf(" LIMIT %s,%s",$pageset_val,$page_per);
		}
	$select_data=$this->db_get_data($qry_str,$select_num_lmt);
	if(empty($select_data)){
		$tbl_arr=explode(",",$tbl);
		$merge_def=array();
		for($dt=0;$dt<count($tbl_arr);$dt++){
			$merge_def=array_merge($merge_def,$this->db_get_defaults($tbl_arr[$dt]));
			}
		$select_data[0]=$merge_def;
		}
	$return_arr['select_num']=$select_num;
	$return_arr['select_data']=$select_data;
	$return_arr['qry_str']=$qry_str;
	$return_arr['qry_str_sort']=$qry_str_sort;
	$return_arr['select_num_lmt']=$select_num_lmt;
	return $return_arr;
	}
	
function db_selectjoin($tbl,$tbl_field,$tbl_id,$qry_join,$sort_val,$pageset_val,$page_per,$group_val="")
	{
	$return_arr=array();
	$select_data = array(); 
	$qry_str = sprintf("SELECT %s FROM %s",$tbl_field,$tbl);
	for($i=0;$i<count($qry_join);$i++){
		$qry_str .= $qry_join[$i];
		}
	if($tbl_id!="")
		{
		$qry_str .= sprintf(" WHERE %s",$tbl_id);
		}
	if($group_val!="")
		{
		$qry_str .= sprintf(" GROUP BY %s",$group_val);
		}
	if($sort_val!="")
		{
		$qry_str .= sprintf(" ORDER BY %s",$sort_val);
		}
	$qry_str_sort = $qry_str;
	$qry_num=$this->query_run($qry_str);
	$select_num=0;
	if($qry_num){
		$select_num=$this->num_rows($qry_num);
		}
	if($page_per>0)
		{
		$qry_str .= sprintf(" LIMIT %s,%s",$pageset_val,$page_per);
		}
	$select_data=$this->db_get_data($qry_str,$select_num_lmt);
	$return_arr['select_num']=$select_num;
	$return_arr['select_data']=$select_data;
	$return_arr['qry_str']=$qry_str;
	$return_arr['qry_str_sort']=$qry_str_sort;
	$return_arr['select_num_lmt']=$select_num_lmt;
	return $return_arr;
	}
	
function db_row($tbl,$tbl_fld,$tbl_id,$sort="")
	{	
	$sort_val="";
	if($sort!=""){
		$sort_val=$sort;
		}
	$select_data=$this->db_get_defaults($tbl);
	$db_select = $this->db_select($tbl,$tbl_fld,$tbl_id,$sort_val,0,1);
	if(isset($db_select['select_data'][0])){
		$select_data=$db_select['select_data'][0];
		}
	return $select_data;
	}
	
function db_row_return_qry($tbl,$tbl_fld,$tbl_id,$sort="")
	{	
	$sort_val="";
	if($sort!=""){
		$sort_val=$sort;
		}
	$select_data=$this->db_get_defaults($tbl);
	$db_select = $this->db_select($tbl,$tbl_fld,$tbl_id,$sort_val,0,1);
	return $db_select['qry_str'];
	}

function db_fldrow($tbl,$tbl_fld,$tbl_id,$sort="")
	{	
	$return_id=0;
	$sort_val="";
	if($sort!=""){
		$sort_val=$sort;
		}
	$db_select = $this->db_select($tbl,$tbl_fld,$tbl_id,$sort_val,0,1);
	if(isset($db_select['select_data'][0])){
		$select_data=$db_select['select_data'][0];
		$return_id=$select_data[$tbl_fld];
		}
	return $return_id;
	}
	
function db_row_join($tbl,$tbl_fld,$tbl_id)
	{
	$db_select = $this->db_select($tbl,$tbl_fld,$tbl_id,"",0,1);
	$select_data=$db_select['select_data'][0];
	return $select_data;
	}
	
function db_row_qry($qry)
	{	
	$db_select = $this->db_qry_data($qry);
	$select_data=$db_select['select_data'][0];
	return $select_data;
	}
	
function db_lastid($tbl,$tbl_id)
	{	
	$tbl_fld=$tbl_id;
	$tbl_id=str_replace("_code","_id",$tbl_id);
	$db_select = $this->db_select($tbl,"*","",$tbl_id." DESC",0,1);
	$select_data=$db_select['select_data'][0];
	$return_id=$select_data[$tbl_fld];
	return $return_id;
	}
	
function db_lastidfilter($tbl,$tbl_fld,$tbl_id,$sort_val)
	{	
	$db_select = $this->db_select($tbl,$tbl_fld,$tbl_id,$sort_val." DESC",0,1);
	$select_data=$db_select['select_data'][0];
	$return_id=$select_data[$tbl_fld];
	//$qry_str=$select_data=$db_select['qry_str'];
	return $return_id;
	}
	
function db_update($tbl,$qry_arr,$tbl_id)
	{
	$tbl_fld="";
	$i=0;
	$arr_last=count($qry_arr)-1;
	foreach($qry_arr as $key => $value)
		{
		if($i==$arr_last)
			{
			$tbl_fld.=$key."='".$value."'";
			}
		else
			{
			$tbl_fld.=$key."='".$value."',";
			}
		$i++;
		}
	$qry_str = sprintf("UPDATE %s SET %s WHERE %s",$tbl,$tbl_fld,$tbl_id);
	$this->query_run($qry_str);
	}
	
function db_insert_update($tbl,$qry_arr,$unique_key)
	{
	//insert	
	$tbl_fld="(";
	$tbl_fld_val="(";
	$i=0;
	$arr_last=count($qry_arr)-1;
	foreach($qry_arr as $key => $value)
		{
		if($i==$arr_last)
			{
			$tbl_fld.=$key.")";
			$tbl_fld_val.="'".$value."'".")";
			}
		else
			{
			$tbl_fld.=$key.",";
			$tbl_fld_val.="'".$value."'".",";
			}
		$i++;
		}
	$qry_str = sprintf("INSERT INTO %s %s VALUES %s",$tbl,$tbl_fld,$tbl_fld_val);
	//on duplicate update
	$tbl_fld="";
	$i=0;
	$arr_last=count($qry_arr)-1;
	foreach($qry_arr as $key => $value)
		{
		if($i==$arr_last){
			$add_txt="'";
			}
		else{
			$add_txt="',";
			}
		if($key!=$unique_key){
			$tbl_fld.=$key."='".$value.$add_txt;
			}
		$i++;
		}
	$qry_str .= sprintf(" ON DUPLICATE KEY UPDATE %s",$tbl_fld);
	$this->query_run($qry_str);
	//return $qry_str;
	}

function db_delete($tbl,$tbl_id)
	{
	$qry_str = sprintf("DELETE FROM %s WHERE %s",$tbl,$tbl_id);
	$this->query_run($qry_str);
	}
	
function select_arr($search_val,$field_arr)
	{
	$search=ltrim($search_val);
	$search_arr=explode(" ",$search);
	$search_count=count($search_arr)-1;
	$field_count=count($field_arr)-1;
	$select_arr="";
	for($i=0;$i<=$search_count;$i++)
		{
		for($j=0;$j<=$field_count;$j++)
			{
			if($i==0 && $j==0)
				{
				$select_arr.="(".$field_arr[$j]." LIKE '%".$search_arr[$i]."%' OR ";
				}
			else if($i==$search_count && $j==$field_count)
				{
				$select_arr.=$field_arr[$j]." LIKE '%".$search_arr[$i]."%')";
				}
			else
				{
				$select_arr.=$field_arr[$j]." LIKE '%".$search_arr[$i]."%' OR ";
				}
			}
		}
	return $select_arr;
	}
	
function select_arr_full($search_val,$field_arr)
	{
	$search_count=0;
	$field_count=count($field_arr)-1;
	$select_arr="";
	for($i=0;$i<=$search_count;$i++)
		{
		for($j=0;$j<=$field_count;$j++)
			{
			if($i==0 && $j==0)
				{
				$select_arr.="(".$field_arr[$j]." LIKE '%".$search_val."%' OR ";
				}
			else if($i==$search_count && $j==$field_count)
				{
				$select_arr.=$field_arr[$j]." LIKE '%".$search_val."%')";
				}
			else
				{
				$select_arr.=$field_arr[$j]." LIKE '%".$search_val."%' OR ";
				}
			}
		}
	return $select_arr;
	}
	
function select_arr_infield($search_arr,$field,$operator)
	{
	$search_count=count($search_arr)-1;
	$select_arr="";
	for($i=0;$i<=$search_count;$i++)
			{
			if($search_count>0){
			if($i==0)
				{
				$select_arr.="(".$field." ".$operator." '".$search_arr[$i]."' OR ";
				}
			else if($i==$search_count)
				{
				$select_arr.=$field." ".$operator." '".$search_arr[$i]."')";
				}
			else
				{
				$select_arr.=$field." ".$operator." '".$search_arr[$i]."' OR ";
				}
			}else{
			$select_arr.="(".$field." ".$operator." '".$search_arr[$i]."')";
			}
		}
	return $select_arr;
	}
	
function db_get_data($qry_str,&$select_num_lmt)
	{
	$select_data = array();
	$qry=$this->query_run($qry_str);
	$select_num_lmt=0;
	if($qry){
		$select_num_lmt=$this->num_rows($qry);
		}
	for($i=0;$i<$select_num_lmt;$i++)
		{
		$select_data[$i]=$this->fetch_assoc($qry);
		}
	return $select_data;
	}
	
function db_qry_data($qry)
	{
	$return_arr=array();
	$select_data = array(); 
	$qry_num=$this->query_run($qry);
	$select_num=0;
	if($qry_num){
		$select_num=$this->num_rows($qry_num);
		}
	$select_data=$this->db_get_data($qry,$select_num_lmt);
	$return_arr['select_num']=$select_num;
	$return_arr['select_data']=$select_data;
	$return_arr['qry_str']=$qry;
	$return_arr['qry_str_sort']=$qry;
	$return_arr['select_num_lmt']=$select_num_lmt;
	return $return_arr;
	}
	
function data_list($select_data,$select_num,$page_row)
	{
	$return_arr=array();
	$page_num=ceil($select_num/$page_row);
	$k=0;
	for($i=0;$i<$page_num;$i++){
		if($page_row>1){
		for($j=0;$j<$page_row;$j++)	{
				$return_arr[$i][$j]=array();
				if(isset($select_data[$k]))
					{
					$return_arr[$i][$j]=$select_data[$k];
					}
				$k++;
				}
			}else{
			$return_arr[$i]=$select_data[$i];
			}
		}
	return $return_arr;
	}
	
function get_details($tbl,$tbl_id)
	{
	$return_arr=array();
	$db_select = $this->db_select($tbl,"*",$tbl_id,"",0,1);
	$return_arr=$db_select['select_data'][0];
	return $return_arr;
	}
	
function get_option($tbl,$tbl_id,$tbl_sort)
	{
	$return_arr=array();
	$db_select = $this->db_select($tbl,"*",$tbl_id,$tbl_sort,0,0);
	$return_arr=$db_select['select_data'];
	return $return_arr;
	}
	
function get_joinlist($tbl,$id,$def_arr,$search_field_arr,$page_row,&$select_num,&$qry_str_sort)
	{
	$return_arr=array();
	$tbl_id="";
	if(!empty($search_field_arr))
		{
		$tbl_id.=$this->select_arr($def_arr['keyword'],$search_field_arr);
		$tbl_id.=" AND ";
		}
	$tbl_id.=$id."= '".$def_arr['id_itemsdef']."'";
	$db_select = $this->db_select($tbl,"*",$tbl_id,$def_arr['sort'],$def_arr['pageset'],$def_arr['per_page']);
	$select_data=$db_select['select_data'];
	$select_num=$db_select['select_num'];
	$select_num_lmt=$db_select['select_num_lmt'];
	$qry_str=$db_select['qry_str'];
	$qry_str_sort=$db_select['qry_str_sort'];
	$return_arr=$this->data_list($select_data,$select_num_lmt,$page_row);
	return $return_arr;
	}
	
function get_list($tbl,$id,$def_arr,$search_field_arr,$page_row,&$select_num,&$qry_str_sort)
	{
	$return_arr=array();
	$tbl_id="";
	if(!empty($search_field_arr))
		{
		$tbl_id.=$this->select_arr($def_arr['keyword'],$search_field_arr);
		}
	$db_select = $this->db_select($tbl,"*",$tbl_id,$def_arr['sort'],$def_arr['pageset'],$def_arr['per_page']);
	$select_data=$db_select['select_data'];
	$select_num=$db_select['select_num'];
	$select_num_lmt=$db_select['select_num_lmt'];
	$qry_str=$db_select['qry_str'];
	$qry_str_sort=$db_select['qry_str_sort'];
	$return_arr=$this->data_list($select_data,$select_num_lmt,$page_row);
	return $return_arr;
	}
	
function gallery_list($tbl,$tbl_id,$tbl_sort,$page_row)
	{
	$return_arr=array();
	$db_select = $this->db_select($tbl,"*",$tbl_id,$tbl_sort,0,0);
	$select_data=$db_select['select_data'];
	$select_num=$db_select['select_num'];
	$select_num_lmt=$db_select['select_num_lmt'];
	$qry_str=$db_select['qry_str'];
	$qry_str_sort=$db_select['qry_str_sort'];
	$return_arr=$this->data_list($select_data,$select_num_lmt,$page_row);
	return $return_arr;
	}
	
function tbl_list($tbl,$tbl_field,$tbl_id,$sort_val,$page_row)
	{
	$return_arr=array();
	$db_select = $this->db_select($tbl,$tbl_field,$tbl_id,$sort_val,0,0);
	$select_data=$db_select['select_data'];
	$select_num_lmt=$db_select['select_num_lmt'];
	$return_arr=$this->data_list($select_data,$select_num_lmt,$page_row);
	return $return_arr;
	}
	
function tbl_search_list($tbl,$tbl_field,$def_arr,$search_field_arr,$page_row,&$select_num,&$qry_str_sort)
	{
	$return_arr=array();
	$tbl_id=$this->select_arr_full($def_arr['keyword'],$search_field_arr);
	if($def_arr['join_match']!="")
		{
		$tbl_id.=$def_arr['join_match'];
		}
	$tbl_id.=$def_arr['join_id'];
	$db_select = $this->db_select($tbl,$tbl_field,$tbl_id,$def_arr['sort'],$def_arr['pageset'],$def_arr['per_page']);
	$select_data=$db_select['select_data'];
	$select_num=$db_select['select_num'];
	$select_num_lmt=$db_select['select_num_lmt'];
	$qry_str=$db_select['qry_str'];
	$qry_str_sort=$db_select['qry_str_sort'];
	$return_arr=$this->data_list($select_data,$select_num_lmt,$page_row);
	return $return_arr;
	}
	
function tbl_searchjoin_list($tbl,$tbl_field,$def_arr,$search_field_arr,$page_row,&$select_num,&$qry_str_sort)
	{
	$return_arr=array();
	//tbl_id
	$tbl_id=$this->select_arr_full($def_arr['keyword'],$search_field_arr);
	if($def_arr['join_match']!="")
		{
		$tbl_id.=$def_arr['join_match'];
		}
	$tbl_id.=$def_arr['join_id'];
	//query join
	for($i=0;$i<count($def_arr['join_tbl']);$i++){
		$qry_join[$i] = " ".$def_arr['join_type'][$i]." (";
		$qry_join[$i] .= sprintf("SELECT %s FROM %s",$def_arr['join_tbl_field'][$i],$def_arr['join_tbl'][$i]);
		if($def_arr['join_tbl_id'][$i]!="")
			{
			$qry_join[$i] .= sprintf(" WHERE %s",$def_arr['join_tbl_id'][$i]);
			}
		if($def_arr['join_tbl_group'][$i]==1)
			{
			$qry_join[$i] .= sprintf(" GROUP BY %s",$def_arr['join_key'][$i]);
			}
		$qry_join[$i] .= ") ".$def_arr['join_tbl'][$i];
		$qry_join[$i] .= " ON ".$tbl.".".$def_arr['join_key'][$i]." = ".$def_arr['join_tbl'][$i].".".$def_arr['join_key'][$i];
		}
	//if isset group by glob
	$group_val="";
	if(isset($def_arr['group'])) {
		$group_val=$def_arr['group'];
		}
	$db_select = $this->db_selectjoin($tbl,$tbl_field,$tbl_id,$qry_join,$def_arr['sort'],$def_arr['pageset'],$def_arr['per_page'],$group_val);
	$select_data=$db_select['select_data'];
	$select_num=$db_select['select_num'];
	$select_num_lmt=$db_select['select_num_lmt'];
	$qry_str=$db_select['qry_str'];
	$qry_str_sort=$db_select['qry_str_sort'];
	$return_arr=$this->data_list($select_data,$select_num_lmt,$page_row);
	return $return_arr;
	}
	
function tbl_searchjoin_multi_list($tbl,$tbl_field,$def_arr,$search_field_arr,$page_row,&$select_num,&$qry_str_sort)
	{
	$return_arr=array();
	//tbl_id
	$tbl_id=$this->select_arr($def_arr['keyword'],$search_field_arr);
	if($def_arr['join_match']!="")
		{
		$tbl_id.=$def_arr['join_match'];
		}
	$tbl_id.=$def_arr['join_id'];
	//query join
	for($i=0;$i<count($def_arr['join_tbl']);$i++){
		$qry_join[$i] = " ".$def_arr['join_type'][$i]." (";
		$qry_join[$i] .= sprintf("SELECT %s FROM %s",$def_arr['join_tbl_field'][$i],$def_arr['join_tbl'][$i]);
		if($def_arr['join_tbl_id'][$i]!="")
			{
			$qry_join[$i] .= sprintf(" WHERE %s",$def_arr['join_tbl_id'][$i]);
			}
		if($def_arr['join_tbl_group'][$i]==1)
			{
			$qry_join[$i] .= sprintf(" GROUP BY %s",$def_arr['join_key'][$i]);
			}
		$qry_join[$i] .= ") ".$def_arr['join_tbl'][$i];
		if($i==0){
			$qry_join[$i] .= " ON ".$tbl.".".$def_arr['join_key'][$i]." = ".$def_arr['join_tbl'][$i].".".$def_arr['join_key'][$i];
			}else{
			$qry_join[$i] .= " ON ".$def_arr['join_tbl'][$i-1].".".$def_arr['join_key'][$i]." = ".$def_arr['join_tbl'][$i].".".$def_arr['join_key'][$i];
			}
		}
	$db_select = $this->db_selectjoin($tbl,$tbl_field,$tbl_id,$qry_join,$def_arr['sort'],$def_arr['pageset'],$def_arr['per_page']);
	$select_data=$db_select['select_data'];
	$select_num=$db_select['select_num'];
	$select_num_lmt=$db_select['select_num_lmt'];
	$qry_str=$db_select['qry_str'];
	$qry_str_sort=$db_select['qry_str_sort'];
	$return_arr=$this->data_list($select_data,$select_num_lmt,$page_row);
	return $return_arr;
	}

function get_pagination($select_num,$per_page,$pageset_value)
	{
	$return_arr=array();
	$return_arr['total_page']=ceil($select_num/$per_page);
	$return_arr['current_page']=($pageset_value/$per_page)+1;
	$return_arr['pageset_prev']=$pageset_value-$per_page;
	$return_arr['pageset_next']=$pageset_value+$per_page;
	return $return_arr;
	}
	
function data_exist($tbl,$id,$tbl_id)
	{
	$db_select = $this->db_select($tbl,$id,$tbl_id,"",0,1);
	$select_num=$db_select['select_num'];
	if($select_num>0){
		return true;
		}else{
		return false;
		}
	}

function tbldata_exist($tbl,$tbl_field,$tbl_id,&$return_fld=array())
	{
	$db_select = $this->db_select($tbl,$tbl_field,$tbl_id,"",0,1);
	$select_num=$db_select['select_num'];
	if($select_num>0){
		$return_fld=$db_select['select_data'][0];
		return true;
		}else{
		$return_fld=array();
		return false;
		}
	}
	
function tbldata_redundant($tbl,$tbl_field,$tbl_id,$err_msg)
	{
	$db_select = $this->db_select($tbl,$tbl_field,$tbl_id,"",0,1);
	$select_num=$db_select['select_num'];
	if($select_num>0){
		$this->error_message($err_msg);
		}
	}
	
function tblqry_exist($qry_str)
	{
	$qry_num=$this->query_run($qry_str);
	$select_num=0;
	if($qry_num){
		$select_num=$this->num_rows($qry_num);
		}
	if($select_num>0){
		return true;
		}else{
		return false;
		}
	}

//authentication
function admin_login($username,$password,&$id_useradmin,&$users_level_code)
	{
	$db_select = $this->db_select("contact","contact_code,users_level_code","contact_username='".$username."' AND contact_password='".$password."'","",0,1);
	$select_num=$db_select['select_num'];
	if($select_num>0){
		$id_useradmin=$db_select['select_data'][0]['contact_code'];
		$users_level_code=$db_select['select_data'][0]['users_level_code'];
		return true;
		}else{
		return false;
		}
	}


//helper
function start_sessi($name)
	{
	if (!(isset($_SESSION[$name])))
		{
		$remote_address=uniqid();
		$dt=date("YmdHis");  
		$_SESSION[$name]=$dt.$remote_address;
		}
	return $_SESSION[$name];
	}
	
function if_in_array($str,$arr)
	{
	if (in_array($str, $arr)) {
		return true;
		}else{
		return false;
		}
	}
	
function error_message($error)
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}
	
function error_message_noback($error)
	{
	echo "<script>alert(\"$error \");$('#myModal').modal('hide');</script>";
	exit;
	}
	
function image_attach($img,$path_rel,&$format_img)
	{
	//format image name
	$pecah_img=explode("/",$img);
	$jmlpecah=count($pecah_img);
	$pecahakhir=$jmlpecah-1;
	$format_img=$pecah_img[$pecahakhir];
	$file_img=$path_rel.$img; 
	$file_pointer=fopen($file_img, "r"); 
	$filer=fread($file_pointer, filesize ($file_img)); 
	fclose($file_pointer);
	$file=chunk_split(base64_encode($filer));
	return $file;
	}

function get_bg($color1,$color2,$inc)
	{
	if($inc % 2 ==0){
		$bg_color=$color1;
		}else{
		$bg_color=$color2;
		}
	return $bg_color;
	}

function get_yesno($cmp_val,$cmp_arr)
	{
	$return="";
	foreach ($cmp_arr as $k => $v){
		if($k==$cmp_val){
			$return=$v;
			break;
			}
		}
	return $return;
	}
	
function get_selectlist($selectlist_arr,$selected)
	{
	$return="";
	for($list_inc=0;$list_inc<count($selectlist_arr);$list_inc++){
		if($selectlist_arr[$list_inc][0]==$selected){
		$return=$selectlist_arr[$list_inc][1];
		break;
		}
		}
	return $return;
	}
	
function rev_selectlist($selectlist_arr,$selected)
	{
	$return="";
	for($list_inc=0;$list_inc<count($selectlist_arr);$list_inc++){
		if($selectlist_arr[$list_inc][1]==$selected){
		$return=$selectlist_arr[$list_inc][0];
		break;
		}
		}
	return $return;
	}
	
function csv_generate($fields_arr,$qry_list)
	{
	$out = '';
	$i=0;
	foreach($fields_arr as $key => $value)
		{
		$l=$value;
		if($i == 0){
			$out .= $l;
			}else{
			$out .= ','.$l;
			}
		$i++;
		}
	$out .="\n";
	
	// Add all values in the table to $out. 
	$needle=",";
	for($ic=0;$ic<count($qry_list);$ic++){
	$i=0;
	foreach($fields_arr as $key => $value)
		{
		$col_val=$qry_list[$ic][$key];
		$col_val=str_replace('"','""',$col_val);
		$col_val=str_replace("+a-a+","'",$col_val);
		$col_val=trim($col_val);
		$col_val = str_replace(array("\r\n","\n","\r")," ",$col_val);
		if (strlen(strstr($col_val,$needle))>0){
			$col_val='"'.$col_val.'"';
			}
		if($i == 0){
			$out .=$col_val;
			}else{
			$out .=','.$col_val;
			}
		$i++;
		}
	$out .="\n";
	}
	return $out;
	}
		
//date	manipulate
function date_to_usform($dmy)
	{
	$dmy_array = explode("/",$dmy);
	$tanggal=$dmy_array[0];
	$month=$this->nummonth_to_month($dmy_array[1]);
	$year=substr($dmy_array[2], 2);
	$dmy_us=$tanggal."-".$month."-".$year;
	return $dmy_us;
	}

//date	nummonth
function nummonth_to_month($nummonth)
	{
	$month="";
	if($nummonth=="01")
		{
		$month="Jan";
		}
	else if($nummonth=="02")
		{
		$month="Feb";
		}
	else if($nummonth=="03")
		{
		$month="Mar";
		}
	else if($nummonth=="04")
		{
		$month="Apr";
		}
	else if($nummonth=="05")
		{
		$month="May";
		}
	else if($nummonth=="06")
		{
		$month="Jun";
		}
	else if($nummonth=="07")
		{
		$month="Jul";
		}
	else if($nummonth=="08")
		{
		$month="Aug";
		}
	else if($nummonth=="09")
		{
		$month="Sep";
		}
	else if($nummonth=="10")
		{
		$month="Oct";
		}
	else if($nummonth=="11")
		{
		$month="Nov";
		}
	else if($nummonth=="12")
		{
		$month="Dec";
		}
	return $month;
	}

function timezone_date($timezone)
	{
	$time=time();
	$gmttime= gmdate("l, d-m-Y", $time);
	$datenow=date("l, d-m-Y",strtotime("$timezone hours",strtotime($gmttime)));
	$datenow_pecah=explode(",",$datenow);
	$datenow_day=trim($datenow_pecah[0]);
	$datenow_hour=trim($datenow_pecah[1]);
	$date_format=$datenow_day.",".$datenow_hour;
	return $date_format;
	}
	
function monthtohari($awal,$monthnum)
	{
	$hari=0;
	$awal_array = explode("/",$awal);
	$tanggal=$awal_array[0];
	$month=$awal_array[1];
	$year=$awal_array[2];
	$month_target=$awal_array[1]+$monthnum;
	$target = mktime(0,0,0,$month_target,(int)$tanggal,$year);
	$awal = mktime(0,0,0,$month,(int)$tanggal,$year);
	$difference =($target-$awal);
	$hari =ceil(($difference/86400));
	return $hari;
	}

function regnum($month_year,$key)
	{
	//month year
	$register_array = explode("/",$month_year);
	$tanggal_registrasi=$register_array[0];
	$month_registrasi=$register_array[1];
	$year_registrasi=$register_array[2];
	if($tanggal_registrasi=="%")
		{
		$tanggal_registrasi="31";
		}
	if($month_registrasi=="%")
		{
		$month_registrasi="12";
		}
	$reg_min=$year_registrasi."01"."01";
	$reg_max=$year_registrasi.$month_registrasi.$tanggal_registrasi;
	$reg_miny=$year_registrasi.$month_registrasi."01";
	$reg_maxy=$year_registrasi.$month_registrasi."31";
	//key 1 = min januari
	//key 2 = max dec
	//key 3 = min current month
	//key 4 = max current month
	if($key==1)
		{
		return $reg_min;
		}
	else if($key==2)
		{
		return $reg_max;
		}
	else if($key==3)
		{
		return $reg_miny;
		}
	else if($key==4)
		{
		return $reg_maxy;
		}
	}

function regnumsub($month_year,$key)
	{
	//month year
	$register_array = explode("/",$month_year);
	$month_registrasi=$register_array[0];
	$year_registrasi=$register_array[1];
	if($month_registrasi=="%")
		{
		$month_registrasi="12";
		}
	$reg_max=$year_registrasi.$month_registrasi;
	$reg_min=$year_registrasi."01";
	if($key==1)
		{
		return $reg_min;
		}
	else if($key==2)
		{
		return $reg_max;
		}
	}
	
function regextr($month_year)
	{
	$return_arr=false;
	$tanggal_registrasi=date("d");
	$month_registrasi=date("m");
	$year_registrasi=date("Y");
	//month year
	if(trim($month_year)!="")
		{
		$register_array = explode("/",$month_year);
		$tanggal_registrasi=$register_array[0];
		$month_registrasi=$register_array[1];
		$year_registrasi=$register_array[2];
		}
	$return_arr['tanggal_registrasi']=$tanggal_registrasi;
	$return_arr['month_registrasi']=$month_registrasi;
	$return_arr['year_registrasi']=$year_registrasi;
	return $return_arr;
	}
	
function regextrsub($month_year)
	{
	$return_arr=false;
	//month year
	$register_array = explode("/",$month_year);
	$month_registrasi=$register_array[0];
	$year_registrasi=$register_array[1];
	$return_arr['month_registrasi']=$month_registrasi;
	$return_arr['year_registrasi']=$year_registrasi;
	return $return_arr;
	}

function valid_date($date)
	{
	$return_arr=false;
	$date_register=trim($date);
	$a_date = explode('/', $date_register); 
	$date_strtotime="";
	$date_registernum=0;
	$date_monthnum=0;
	if(count($a_date)==3){
		$date_strtotime=$a_date[1]."/".$a_date[0]."/".$a_date[2];
		$date_registernum=$a_date[2].$a_date[1].$a_date[0];
		$date_monthnum=$a_date[2].$a_date[1];
		}
	$is_valid = date('d/m/Y', strtotime($date_strtotime)) == $date_register;
	$return_arr['date_register']=$date_register;
	$return_arr['date_registernum']=$date_registernum;
	$return_arr['date_monthnum']=$date_monthnum;
	$return_arr['is_valid']=$is_valid;
	return $return_arr;
	}
	
function format_field_register($field_register)
	{
	$register_exp = explode('/', $field_register);
	$format=$register_exp[0]."/".$register_exp[1]."/".$register_exp[2];
	return $format;
	}
	
function mktime_next($btime,$date_add,$month_add,$year_add)
	{
	$mktime_out=0;
	$btime_array = explode("/",$btime);
	$date_target=$btime_array[0]+$date_add;
	$month_target=$btime_array[1]+$month_add;
	$year_target=$btime_array[2]+$year_add;
	$mktime_out = mktime(0,0,0,$month_target,(int)$date_target,$year_target);
	return $mktime_out;
	}
	
function mktime_month_year($mktimein)
	{
	//month year
	return date("m/Y",$mktimein);
	}
	
function month_year_next($btime,$date_add,$month_add,$year_add)
	{
	$mktimein=$this->mktime_next($btime,$date_add,$month_add,$year_add);
	return $this->mktime_month_year($mktimein);
	}
	
function date_diff($date_start,$date_end)
	{
	$diff=0;
	$date_start_array = explode("/",$date_start);
	$start = mktime(0,0,0,$date_start_array[1],(int)$date_start_array[0],$date_start_array[2]);
	$date_end_array = explode("/",$date_end);
	$end = mktime(0,0,0,$date_end_array[1],(int)$date_end_array[0],$date_end_array[2]);
	$diff=$end-$start;
	return $diff;
	}
	
function date_diff_get($date_start,$date_end)
	{
	$return_arr=array();
	$diff=$this->date_diff($date_start,$date_end);
	$days =ceil(($diff/86400));
	$months =ceil(($diff/2628000));
	$return_arr['days']=$days;
	$return_arr['months']=$months;
	return $return_arr;
	}
	
function regmonth_due_toplimit($month_year1,$month_year2)
	{
	$return_arr=false;
	$register_array1 = explode("/",$month_year1);
	$month_register1=$register_array1[2].$register_array1[1];
	$register_array2 = explode("/",$month_year2);
	$month_register2=$register_array2[2].$register_array2[1];
	if($month_register1<=$month_register2){
		$return_arr=true;
		}
	return $return_arr;
	}
	
function month_year_exp($month_year)
	{
	$return_arr=array();
	$month_year_arr = explode("/",$month_year);
	$return_arr['date']=$month_year_arr[0];
	$return_arr['month']=$month_year_arr[1];
	$return_arr['year']=$month_year_arr[2];
	return $return_arr;
	}
	
function date_numtostr($month_year)
	{
	$result="";
	$result.=substr($month_year,6,2);
	$result.="/".substr($month_year,4,2);
	$result.="/".substr($month_year,0,4);
	return $result;
	}
	
function date_strtonum($month_year)
	{
	$result="";
	$result_arr=$this->month_year_exp($month_year);
	$result=$result_arr['year'].$result_arr['month'].$result_arr['date'];
	return $result;
	}
	
function date_stridtonum($month_year)
	{
	$date_db = str_replace('/', '-', $month_year);
	$time = strtotime($date_db);
	$result = date('Y-m-d',$time);
	return $result;
	}
	
function month_strtonum($month_year)
	{
	$result="";
	$result_arr=explode("/",$month_year);
	$result=$result_arr[1].$result_arr[0];
	return $result;
	}
	
function month_strtostrip($month_year)
	{
	$result="";
	$result_arr=explode("/",$month_year);
	$result=$result_arr[1]."-".$result_arr[0];
	return $result;
	}
	
function month_fixed_diff($date1,$date2)
	{
	$result=0;
	$date1_arr=explode("/",$date1);
	$date2_arr=explode("/",$date2);
	$month_by_year_diff=($date2_arr[2]-$date1_arr[2])*12;
	$result=($date2_arr[1]+$month_by_year_diff)-$date1_arr[1];
	return $result;
	}

//str unweird
function strunweird($str)
	{
	$str=trim($str);
	$str=strtolower($str);
	$str=str_replace(" ","-",$str);
	$str=str_replace("&","and",$str);
	$str=str_replace("/","",$str);
	$str=str_replace("'","",$str);
	$str=str_replace("?","",$str);
	return $str;
	}
	
//set balance zero
function balance_zero(&$val1,&$val2)
	{
	if($val1>$val2){
		$val1=$val1-$val2;
		$val2=0;
	}else{
		$val2=$val2-$val1;
		$val1=0;
		}
	}
	
//typehead convert
function typehead_cvt($val)
	{
	$return_val_arr=explode(" - ",$val);
	$return_val=$return_val_arr[0];
	return $return_val;
	}
	
//users role
function users_role($users_level_code)
	{
	//loop users_level_module
	$users_level_module_list=$this->tbl_list("users_level_module","*","users_level_code='".$users_level_code."'","users_level_module_id",1);
	//adjust
	$ulm_arr=array();
	for($i=0;$i<count($users_level_module_list);$i++){
		$module_code_list=$users_level_module_list[$i]['module_code'];
		$module_sub_code_list=$users_level_module_list[$i]['module_sub_code'];
		if($module_sub_code_list==""){
			$ulm_arr[$module_code_list]['users_level_module_access_view']=$users_level_module_list[$i]['users_level_module_access_view'];
			}else{
			$ulm_arr[$module_code_list][$module_sub_code_list]['users_level_module_access_view']=$users_level_module_list[$i]['users_level_module_access_view'];
			$ulm_arr[$module_code_list][$module_sub_code_list]['users_level_module_access_add']=$users_level_module_list[$i]['users_level_module_access_add'];
			$ulm_arr[$module_code_list][$module_sub_code_list]['users_level_module_access_edit']=$users_level_module_list[$i]['users_level_module_access_edit'];
			$ulm_arr[$module_code_list][$module_sub_code_list]['users_level_module_access_delete']=$users_level_module_list[$i]['users_level_module_access_delete'];
			$ulm_arr[$module_code_list][$module_sub_code_list]['users_level_module_access_csv']=$users_level_module_list[$i]['users_level_module_access_csv'];
			}
		}
	return $ulm_arr;
	}
	
//module_theme
function module_theme($module_code)
	{
	$return_val=array();
	if($module_code=="product-service/service"){
		$bg_color="bg-blue";
		$fa_icon="fa-motorcycle";
		}
	else if($module_code=="product-service/product-sale"){
		$bg_color="bg-yellow";
		$fa_icon="fa-shopping-cart";
		}
	else if($module_code=="product-service/product-buy"){
		$bg_color="bg-aqua";
		$fa_icon="fa-cart-arrow-down";
		}
	else if($module_code=="warehouse-stock"){
		$bg_color="bg-green";
		$fa_icon="fa-cubes";
		}
	else if($module_code=="salary"){
		$bg_color="bg-red";
		$fa_icon="fa-calendar-check-o";
		}
	else if($module_code=="book"){
		$bg_color="bg-maroon";
		$fa_icon="fa-balance-scale";
		}
	else if($module_code=="product-service/inventory"){
		$bg_color="bg-gray";
		$fa_icon="fa-building";
		}
	else{
		$bg_color="bg-yellow";
		$fa_icon="fa-wrench";
		}
	$return_val['bg_color']=$bg_color;
	$return_val['fa_icon']=$fa_icon;
	return $return_val;
	}
	
// pdf fonts
function pdf_fonts()
	{
	$return_val=array(
		'arial' => [
            'R' => 'arial.ttf'
		],
        'verdana' => [
            'R' => 'verdana.ttf'
		],
        'times' => [
            'R' => 'times.ttf'
        ]
		);
	return $return_val;
	}
}
?>