<?php
class book extends global_class 
{
public $book_lang;
function __construct()
	{
	include(SITE_ROOT."config/global.php");
	include(SITE_ROOT."book/lang/".$glob_config['db_config']['lang']."/lang.php");
	parent::__construct();
	$this->book_lang = $book_lang;
	}
	
function taxonomi_create($id_parent,$level,$selected)
	{
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$id_parent."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$level_child=$level+1;
		$str_add="";
		for ($j=0; $j < $level; $j++)
			{
			$str_add=$str_add."&nbsp;&nbsp;&nbsp;";
			}
		$taxonomi_id=$select_data[$i]['taxonomi_id'];
		$taxonomi_code=$select_data[$i]['taxonomi_code'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		if($taxonomi_postable==1)
			{
			echo"<option value=$taxonomi_code";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$str_add$taxonomi_name</option>";
			$this->taxonomi_create($taxonomi_code,$level_child,$selected);
			}
		if($taxonomi_postable==0)
			{
			echo"<option value=$taxonomi_code";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$str_add$taxonomi_name</option>";
			}
		}
	}
	
function taxonomi_createba($id_parent,$level,$selected)
	{
	//$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$id_parent."'","",0,0);
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$id_parent."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$level_child=$level+1;
		$str_add="";
		for ($j=0; $j < $level; $j++)
			{
			$str_add=$str_add."&nbsp;&nbsp;&nbsp;";
			}
		$taxonomi_id=$select_data[$i]['taxonomi_id'];
		$taxonomi_code=$select_data[$i]['taxonomi_code'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		if($taxonomi_postable==1)
			{
			$this->taxonomi_createba($taxonomi_code,$level_child,$selected);
			}
		if($taxonomi_postable==0)
			{
			echo"<option value=$taxonomi_id";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$taxonomi_name</option>";
			}
		}
	}

function taxonomi_createsmp($id_parent,$level,$selected)
	{
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$id_parent."' AND taxonomi_postable ='1'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$level_child=$level+1;
		$str_add="";
		for ($j=0; $j < $level; $j++)
			{
			$str_add=$str_add."&nbsp;&nbsp;&nbsp;";
			}
		$taxonomi_id=$select_data[$i]['taxonomi_id'];
		$taxonomi_code=$select_data[$i]['taxonomi_code'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		if($taxonomi_postable==1)
			{
			echo"<option value=$taxonomi_code";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$str_add$taxonomi_name</option>";
			$this->taxonomi_createsmp($taxonomi_code,$level_child,$selected);
			}
		if($taxonomi_postable==0)
			{
			echo"<option value=$taxonomi_code";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$str_add$taxonomi_name</option>";
			}
		}
	}

	
function account_create($id_parent,$level,$selected)
	{
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$id_parent."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$level_child=$level+1;
		$str_add="";
		for ($j=0; $j < $level; $j++)
			{
			$str_add=$str_add."&nbsp;&nbsp;&nbsp;";
			}
		$taxonomi_id=$select_data[$i]['taxonomi_id'];
		$taxonomi_code=$select_data[$i]['taxonomi_code'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		if($taxonomi_postable==1)
			{
			echo"<option value=$taxonomi_id";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$str_add$taxonomi_name</option>";
			$this->taxonomi_create($taxonomi_code,$level_child,$selected);
			}
		if($taxonomi_postable==0)
			{
			echo"<option value=$taxonomi_id";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$str_add$taxonomi_name</option>";
			}
		}
	}
	
function account_special_create($taxonomy_special_type_arr,$selected)
	{
	for($j=0;$j<count($taxonomy_special_type_arr);$j++)
		{
		$tax_arr=array($taxonomy_special_type_arr[$j]);
		$taxonomy_special_type = $this->select_arr_infield($tax_arr,"taxonomy_special_type","=");
		$db_select = $this->db_select("taxonomi","*",$taxonomy_special_type." AND taxonomi_postable='0'","",0,0);
		$select_data=$db_select['select_data'];
		//echo $db_select['qry_str'];
		for($i=0;$i<$db_select['select_num'];$i++)
			{
			$str_add="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$taxonomi_id=$select_data[$i]['taxonomi_id'];
			$taxonomi_code=$select_data[$i]['taxonomi_code'];
			$taxonomi_name=$select_data[$i]['taxonomi_name'];
			echo"<option value=$taxonomi_id";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$str_add$taxonomi_name</option>";
			}
		}
	}
	
function account_special_get($taxonomy_special_type)
	{
	$get_details = $this->get_details("taxonomi","taxonomy_special_type='".$taxonomy_special_type."' AND taxonomi_postable='0'");
	return $get_details['taxonomi_id'];
	}
	
function account_special_get_all($taxonomy_special_type)
	{
	$get_details = $this->get_details("taxonomi","taxonomy_special_type='".$taxonomy_special_type."'");
	return $get_details['taxonomi_code'];
	}
	
function account_parent_special_create($taxonomy_special_type_arr,$selected)
	{
	for($j=0;$j<count($taxonomy_special_type_arr);$j++)
		{
		$tax_arr=$taxonomy_special_type_arr[$j];
		$taxonomi_parent=$this->db_fldrow("taxonomi","taxonomi_code","taxonomy_special_type='".$tax_arr."' AND taxonomi_postable='1'");
		$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_parent."' AND taxonomi_postable='0'","",0,0);
		$select_data=$db_select['select_data'];
		//echo $db_select['qry_str'];
		for($i=0;$i<$db_select['select_num'];$i++)
			{
			$str_add="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$taxonomi_id=$select_data[$i]['taxonomi_id'];
			$taxonomi_code=$select_data[$i]['taxonomi_code'];
			$taxonomi_name=$select_data[$i]['taxonomi_name'];
			echo"<option value=$taxonomi_id";
			if($taxonomi_id==$selected)
				{
				echo" selected";
				}
			echo">$str_add$taxonomi_name</option>";
			}
		}
	}
	
function account_parent_special_get($taxonomy_special_type)
	{
	$return_arr=array();
	$taxonomi_parent=$this->db_fldrow("taxonomi","taxonomi_code","taxonomy_special_type='".$taxonomy_special_type."' AND taxonomi_postable='1'");
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_parent."' AND taxonomi_postable='0'","",0,0);
	$select_data=$db_select['select_data'];
	//echo $db_select['qry_str'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$return_arr[]=$select_data[$i]['taxonomi_id'];
		}
	return $return_arr;
	}
	

function taxonomi($taxonomi_id,$level)
	{
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$level_child=$level+1;
		$str_add="";
		for ($j=0; $j < $level_child; $j++)
			{
			$str_add=$str_add."&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$taxonomi_level=$select_data[$i]['taxonomi_level'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_type=$select_data[$i]['taxonomi_type'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		$taxonomi_hidden=$select_data[$i]['taxonomi_hidden'];
		$taxonomi_cash_flow=$select_data[$i]['taxonomi_cash_flow'];
		if($taxonomi_postable==1)
			{
			$taxonomi_postable_value="No";
			}
		else
			{
			$taxonomi_postable_value="Yes";
			}
		
		if($taxonomi_postable==1)
			{
			if($taxonomi_id==0)
				{
				$this->taxonomi($id_child_taxonomi,$level);
				}
			else
				{
				echo"<tr>
				<td align=center bgcolor=#FFFFFF class=text_body>&nbsp;</td>
				<td align=center bgcolor=#FFFFFF><input name=id[] type=checkbox id=id[] value=$id_child_taxonomi></td>
				<td bgcolor=\"#FFFFFF\"><a href=\"#\" class=\"link_table account_list_edit\">$str_add$taxonomi_code</a></td>
				<td bgcolor=\"#FFFFFF\"><a href=\"#\" class=\"link_table account_list_edit\">$str_add$taxonomi_type</a></td>
				<td bgcolor=\"#FFFFFF\"><a href=\"#\" class=\"link_table account_list_edit\">$str_add$taxonomi_name</a></td>
				<td bgcolor=\"#FFFFFF\"><a href=\"#\" class=\"link_table account_list_edit\">$str_add$taxonomi_postable_value</a></td>
				<td class=\"taxonomi_id_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$id_child_taxonomi</a></td>
				<td class=\"taxonomi_parent_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_id</a></td>
				<td class=\"taxonomi_hidden_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_hidden</a></td>
				<td class=\"taxonomi_name_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_name</a></td>
				<td class=\"taxonomi_postable_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_postable</a></td>
				<td class=\"taxonomi_cash_flow_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_cash_flow</a></td>
				</tr>";
				$this->taxonomi($taxonomi_code,$level_child);
				}
			}
		if($taxonomi_postable==0)
			{
			echo"<tr>
			<td align=center bgcolor=#FFFFFF class=text_body>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF><input name=id[] type=checkbox id=id[] value=$id_child_taxonomi></td>
			<td bgcolor=\"#FFFFFF\"><a href=\"#\" class=\"link_table account_list_edit\">$str_add$taxonomi_code</a></td>
			<td bgcolor=\"#FFFFFF\"><a href=\"#\" class=\"link_table account_list_edit\">$str_add$taxonomi_type</a></td>
			<td bgcolor=\"#FFFFFF\"><a href=\"#\" class=\"link_table account_list_edit\">$str_add$taxonomi_name</a></td>
			<td bgcolor=\"#FFFFFF\"><a href=\"#\" class=\"link_table account_list_edit\">$str_add$taxonomi_postable_value</a></td>
			<td class=\"taxonomi_id_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$id_child_taxonomi</a></td>
			<td class=\"taxonomi_parent_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_id</a></td>
			<td class=\"taxonomi_hidden_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_hidden</a></td>
			<td class=\"taxonomi_name_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_name</a></td>
			<td class=\"taxonomi_postable_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_postable</a></td>
			<td class=\"taxonomi_cash_flow_hidden td_hide\"><a href=\"#\" class=\"link_table users_edit\">$taxonomi_cash_flow</a></td>
			</tr>";
			}
		}
	}

function balance_sheet($taxonomi_id,$month_year,$debit)
	{
	$inc=1;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","taxonomi_code ASC",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$taxonomi_level=$select_data[$i]['taxonomi_level'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		$taxonomi_hidden=$select_data[$i]['taxonomi_hidden'];
		$saldo_taxonomi=$this->balance_trial($id_child_taxonomi,$month_year,$debit);
		$saldo_taxonomi=number_format($saldo_taxonomi,2,'.',',');
		
		if($taxonomi_postable==1)
			{
			if($taxonomi_level<=1){
			echo"<tr>";
			echo"<td bgcolor=#FFFFFF><strong><u>$taxonomi_name</u></strong></td>";
			}else{
			echo"<tr>";
			echo"<td bgcolor=#FFFFFF><u>$taxonomi_name</u></td>";
			}
			echo"<td bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			if($taxonomi_hidden==0){
			$this->balance_sheet($taxonomi_code,$month_year,$debit);
			}
			$balance=$this->balance_trial_total($taxonomi_code,$month_year,$debit);
			$balance=number_format($balance,2,'.',',');
			echo"<tr>
			<td align=center bgcolor=#FFFFFF><strong>".$this->book_lang['form_header_book_lang']['total'].$taxonomi_name."</strong></td>
            <td align=center bgcolor=#FFFFFF>".$balance."</td>
            </tr>";
			echo"<tr>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			}
		if($taxonomi_postable==0)
			{
			echo"<tr>
			<td bgcolor=#FFFFFF>$inc. $taxonomi_name</td>
			<td align=center bgcolor=#FFFFFF>$saldo_taxonomi</td>
			</tr>";
			}
		$inc++;
		}
	}
	
function balance_sheet_acc($taxonomi_id,$month_year,$debit)
	{
	$inc=1;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","taxonomi_code ASC",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$taxonomi_level=$select_data[$i]['taxonomi_level'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		$taxonomi_hidden=$select_data[$i]['taxonomi_hidden'];
		$saldo_taxonomi=$this->balance_trial($id_child_taxonomi,$month_year,$debit);
		$saldo_taxonomi=number_format($saldo_taxonomi,2,'.',',');
		
		if($taxonomi_postable==1)
			{
			if($taxonomi_level<=1){
			$return_val.="<tr>";
			$return_val.="<td bgcolor=#FFFFFF><strong><u>$taxonomi_name</u></strong></td>";
			}else{
			$return_val.="<tr>";
			$return_val.="<td bgcolor=#FFFFFF><u>$taxonomi_name</u></td>";
			}
			$return_val.="<td bgcolor=#FFFFFF>&nbsp;</td></tr>";
			if($taxonomi_hidden==0){
			$return_val.=$this->balance_sheet_acc($taxonomi_code,$month_year,$debit);
			}
			$balance=$this->balance_trial_total($taxonomi_code,$month_year,$debit);
			$balance=number_format($balance,2,'.',',');
			$return_val.="<tr>
			<td align=center bgcolor=#FFFFFF><strong>".$this->book_lang['form_header_book_lang']['total'].$taxonomi_name."</strong></td>
            <td align=center bgcolor=#FFFFFF>".$balance."</td>
            </tr>";
			$return_val.="<tr>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			}
		if($taxonomi_postable==0)
			{
			$return_val.="<tr>
			<td bgcolor=#FFFFFF>$inc. $taxonomi_name</td>
			<td align=center bgcolor=#FFFFFF>$saldo_taxonomi</td>
			</tr>";
			}
		$inc++;
		}
	return $return_val;
	}

function profit_loss($taxonomi_id,$month_year,$debit)
	{
	//extract month
	$month_array = explode("/",$month_year);
	$month=$month_array[1];
	$year=$month_array[2];
	$inc=1;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$taxonomi_level=$select_data[$i]['taxonomi_level'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		
		if($taxonomi_postable==1)
			{
			echo"<tr>
			<td bgcolor=#FFFFFF><strong><u>$taxonomi_name</u></strong></td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			$this->profit_loss($taxonomi_code,$month_year,$debit);
			}
		if($taxonomi_postable==0)
			{
			//saldo per month
			$array_month=array("01","02","03","04","05","06","07","08","09","10","11","12");
			for($j=0;$j<12;$j++)
				{
				$balance_sheet[$j]=0;
				$balance_sheet_format[$j]=number_format($balance_sheet[$j],2,'.',',');
				}
			for($j=0;$j<(int)$month;$j++)
				{
				$month_year1="%/".$array_month[$j]."/".$year;
				$balance_sheet[$j]=$this->balance_account($id_child_taxonomi,$month_year1,$debit);
				$balance_sheet_format[$j]=number_format($balance_sheet[$j],2,'.',',');
				}
			//total saldo
			$total_saldo=$this->balance_trial($id_child_taxonomi,$month_year,$debit);
			$total_saldo_format=number_format($total_saldo,2,'.',',');
			
			echo"<tr>
			<td bgcolor=#FFFFFF>$inc. $taxonomi_name</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[0]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[1]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[2]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[3]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[4]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[5]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[6]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[7]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[8]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[9]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[10]</td>
			<td align=center bgcolor=#FFFFFF>$balance_sheet_format[11]</td>
			<td align=center bgcolor=#FFFFFF>$total_saldo_format</td>
			</tr>";
			}
		if($taxonomi_level=='1')
			{
			echo"<tr>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			}
		$inc++;
		}
	}
	
function profit_loss_acc($taxonomi_id,$month_year,$debit)
	{
	//extract month
	$month_array = explode("/",$month_year);
	$month=$month_array[1];
	$year=$month_array[2];
	$inc=1;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$taxonomi_level=$select_data[$i]['taxonomi_level'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		
		if($taxonomi_postable==1)
			{
			$return_val.="<tr>
			<td bgcolor=#FFFFFF><strong><u>$taxonomi_name</u></strong></td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			$return_val.=$this->profit_loss_acc($taxonomi_code,$month_year,$debit,$return_val2);
			}
		if($taxonomi_postable==0)
			{
			//saldo per month
			$array_month=array("01","02","03","04","05","06","07","08","09","10","11","12");
			for($j=0;$j<12;$j++)
				{
				$balance_sheet[$j]=0;
				$balance_sheet_format[$j]=number_format($balance_sheet[$j],2,'.',',');
				}
			for($j=0;$j<(int)$month;$j++)
				{
				$month_year1="%/".$array_month[$j]."/".$year;
				$balance_sheet[$j]=$this->balance_account($id_child_taxonomi,$month_year1,$debit);
				$balance_sheet_format[$j]=number_format($balance_sheet[$j],2,'.',',');
				}
			//total saldo
			$total_saldo=$this->balance_trial($id_child_taxonomi,$month_year,$debit);
			$total_saldo_format=number_format($total_saldo,2,'.',',');
			
			$return_val.="<tr>
			<td bgcolor=#FFFFFF>$inc. $taxonomi_name</td>
			<td align=center bgcolor=#FFFFFF>$total_saldo_format</td>
			</tr>";
			}
		if($taxonomi_level=='1')
			{
			$return_val.="<tr>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			}
		$inc++;
		}
	return $return_val;
	}

function balance_total($taxonomi_id,$month_year,$debit)
	{
	$saldo=0;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$saldo_taxonomi=$this->balance_account($id_child_taxonomi,$month_year,$debit);
		$saldo=$saldo + $saldo_taxonomi + $this->balance_total($taxonomi_code,$month_year,$debit);
		}
	return $saldo;
	}
	
function balance_trial_total($taxonomi_id,$month_year,$debit)
	{
	$saldo=0;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$saldo_taxonomi=$this->balance_trial($id_child_taxonomi,$month_year,$debit);
		$saldo=$saldo + $saldo_taxonomi + $this->balance_trial_total($taxonomi_code,$month_year,$debit);
		}
	return $saldo;
	}
	
function balance_trial_total_month($taxonomi_id,$month_year,$debit)
	{
	$saldo=0;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$saldo_taxonomi=$this->balance_trial_month($id_child_taxonomi,$month_year,$debit);
		$saldo=$saldo + $saldo_taxonomi + $this->balance_trial_total_month($taxonomi_code,$month_year,$debit);
		}
	return $saldo;
	}
	
function balance_trial_total_special($taxonomy_special_type,$month_year,$debit)
	{
	$saldo=0;
	$taxonomi_id=$this->account_special_get_all($taxonomy_special_type);
	$saldo=$this->balance_trial_total($taxonomi_id,$month_year,$debit);
	return $saldo;
	}

function balance_account($taxonomi_id,$month_year,$debit)
	{
	$sub_total_debit=0;
	$sub_total_kredit=0;
	$db_select = $this->db_select("ledgerdetails","*","taxonomi_id='".$taxonomi_id."' AND ledgerdetails_register LIKE '".$month_year."' AND ledgerdetails_status = 'pmn'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$ledgerdetails_id=$select_data[$i]['ledgerdetails_id'];
		$ledgerdetails_type=$select_data[$i]['ledgerdetails_type'];
		$ledgerdetails_amount=$select_data[$i]['ledgerdetails_amount'];
		if($ledgerdetails_type=="D")
			{
			$sub_total_debit=$sub_total_debit + $ledgerdetails_amount;
			}
		else
			{
			$sub_total_kredit=$sub_total_kredit + $ledgerdetails_amount;
			}
		}
		if($debit=="D")
		{
		$saldo=$sub_total_debit-$sub_total_kredit;
		}
		else
		{
		$saldo=$sub_total_kredit-$sub_total_debit;
		}
	return $saldo;
	}
	
function balance_trial($taxonomi_id,$month_year,$debit)
	{
	$reg_min=$this->regnum($month_year,1);
	$reg_max=$this->regnum($month_year,2);
	$sub_total_debit=0;
	$sub_total_kredit=0;
	$db_select = $this->db_select("ledgerdetails","*","taxonomi_id='".$taxonomi_id."' AND ledgerdetails_registernum >= '".$reg_min."' AND ledgerdetails_registernum <= '".$reg_max."' AND ledgerdetails_status = 'pmn'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$ledgerdetails_id=$select_data[$i]['ledgerdetails_id'];
		$ledgerdetails_type=$select_data[$i]['ledgerdetails_type'];
		$ledgerdetails_amount=$select_data[$i]['ledgerdetails_amount'];
		if($ledgerdetails_type=="D")
			{
			$sub_total_debit=$sub_total_debit + $ledgerdetails_amount;
			}
		else
			{
			$sub_total_kredit=$sub_total_kredit + $ledgerdetails_amount;
			}
		}
		if($debit=="D")
		{
		$saldo=$sub_total_debit-$sub_total_kredit;
		}
		else
		{
		$saldo=$sub_total_kredit-$sub_total_debit;
		}
	return $saldo;
	}
	
function balance_trial_month($taxonomi_id,$month_year,$debit)
	{
	$reg_min=$this->regnum($month_year,3);
	$reg_max=$this->regnum($month_year,4);
	$sub_total_debit=0;
	$sub_total_kredit=0;
	$db_select = $this->db_select("ledgerdetails","*","taxonomi_id='".$taxonomi_id."' AND ledgerdetails_registernum >= '".$reg_min."' AND ledgerdetails_registernum <= '".$reg_max."' AND ledgerdetails_status = 'pmn'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$ledgerdetails_id=$select_data[$i]['ledgerdetails_id'];
		$ledgerdetails_type=$select_data[$i]['ledgerdetails_type'];
		$ledgerdetails_amount=$select_data[$i]['ledgerdetails_amount'];
		if($ledgerdetails_type=="D")
			{
			$sub_total_debit=$sub_total_debit + $ledgerdetails_amount;
			}
		else
			{
			$sub_total_kredit=$sub_total_kredit + $ledgerdetails_amount;
			}
		}
		if($debit=="D")
		{
		$saldo=$sub_total_debit-$sub_total_kredit;
		}
		else
		{
		$saldo=$sub_total_kredit-$sub_total_debit;
		}
	return $saldo;
	}
	
function balance_trial_special($taxonomy_special_type,$month_year,$debit)
	{
	$saldo=0;
	$taxonomi_id=$this->account_special_get($taxonomy_special_type);
	$saldo=$this->balance_trial($taxonomi_id,$month_year,$debit);
	return $saldo;
	}
	
function ledger_post($ledger_register,$ledger_uneditable,$ledger_description,$set_taxonomi,$ledger_registernum=0,$project_id=0,$ledger_module="",$users_code="")
	{
	//post ledger
	$dt=date("YmdHis");  
	$sessi_id=  $dt.uniqid();
	if($ledger_registernum==0){
		$ledger_registernum=date("Y").date("m").date("d");
		}
	$ledger_module_val="";
	if($ledger_module!=""){$ledger_module_val=$ledger_module;}
	$insert_arr = array(
	'ledger_register'=>	$ledger_register,
	'ledger_description'=>	$ledger_description,
	'ledger_uneditable'=>	$ledger_uneditable,
	'sessi_id'=>	$sessi_id,
	'ledger_status'=>	'pmn',
	'ledger_registernum'=>	$ledger_registernum,
	'project_id'=>	$project_id?$project_id:0,
	'ledger_module'=>	$ledger_module_val,
	'users_code'=>	$users_code,
	);
	$this->db_insert("ledger",$insert_arr);
	//cari last ID
	$ledger_id=$this->db_lastid("ledger","ledger_id");
		
	$num_ledgerdetails = count($set_taxonomi)/3;
	for ($i = 0; $i < $num_ledgerdetails; $i++)
		{
		$k=$i*3;
		$taxonomi_id=$set_taxonomi[$k];
		$ledgerdetails_type=$set_taxonomi[$k+1];
		$ledgerdetails_amount=$set_taxonomi[$k+2];
		$this->ledgerdetails_post($ledger_id,$taxonomi_id,$ledgerdetails_type,$ledgerdetails_amount,$ledger_register);
		}
	return $ledger_id;
	}

function ledgerdetails_post($ledger_id,$taxonomi_id,$ledgerdetails_type,$ledgerdetails_amount,$ledger_register)
	{
	$register_array = explode("/",$ledger_register);
	$tanggal_registrasi=$register_array[0];
	$month_registrasi=$register_array[1];
	$year_registrasi=$register_array[2];
	$ledgerdetails_registernum=$year_registrasi.$month_registrasi.$tanggal_registrasi;
	$insert_arr = array(
	'ledger_id'=>	$ledger_id,
	'taxonomi_id'=>	$taxonomi_id,
	'ledgerdetails_register'=>	$ledger_register,
	'ledgerdetails_type'=>	$ledgerdetails_type,
	'ledgerdetails_amount'=>	$ledgerdetails_amount,
	'ledgerdetails_registernum'=>	$ledgerdetails_registernum?$ledgerdetails_registernum:0,
	'ledgerdetails_status'=>	'pmn',
	);
	$this->db_insert("ledgerdetails",$insert_arr);
	$this->subsidiary_update($ledger_id);
	}
	
function ledgerdetails_update($ledger_id,$ledger_register,$set_taxonomi)
	{
	$this->db_delete("ledgerdetails","ledger_id='".$ledger_id."'");
	$num_ledgerdetails = count($set_taxonomi)/3;
	for ($i = 0; $i < $num_ledgerdetails; $i++)
		{
		$k=$i*3;
		$taxonomi_id=$set_taxonomi[$k];
		$ledgerdetails_type=$set_taxonomi[$k+1];
		$ledgerdetails_amount=$set_taxonomi[$k+2];
		$this->ledgerdetails_post($ledger_id,$taxonomi_id,$ledgerdetails_type,$ledgerdetails_amount,$ledger_register);
		}
	}
	
function ledgerdesc_update($ledger_id,$ledger_description,$ledger_register=0,$ledger_registernum=0,$project_id=0,$users_code="")
	{
	$update_arr = array(
		'ledger_description'=>	$ledger_description,
		'users_code'=>	$users_code,
		);
	if($ledger_register!=0){
		$update_arr['ledger_register']=$ledger_register;
	}if($ledger_registernum!=0){
		$update_arr['ledger_registernum']=$ledger_registernum;
	}if($project_id!=0){
		$update_arr['project_id']=$project_id;
		}
	$this->db_update("ledger",$update_arr,"ledger_id='".$ledger_id."'");
	}
	
function ledgerdetailsamount_update($ledger_id,$ledgerdetails_amount)
	{
	$db_select = $this->db_select("ledgerdetails","ledgerdetails_id","ledger_id='".$ledger_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$ledgerdetails_id=$select_data[$i]['ledgerdetails_id'];
		$update_arr = array(
		'ledgerdetails_amount'=>	$ledgerdetails_amount,
		);
		$this->db_update("ledgerdetails",$update_arr,"ledgerdetails_id='".$ledgerdetails_id."'");
		}
	}
	
function dividen_percen_alocation($year)
	{
	$db_select = $this->db_select("dividen_percen","*","","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$dividen_percen_id =$select_data[$i]['dividen_percen_id'];
		$dividen_percen_percen =$select_data[$i]['dividen_percen_percen'];
		//Post SHU
		$month_year="%/"."%/".$year;
		$balance_sheet_profit=$this->balance_total(4,$month_year,"K");
		$balance_sheet_loss=$this->balance_total(5,$month_year,"D");
		$dividen_net=$balance_sheet_profit-$balance_sheet_loss;
		$dividen_amount=($dividen_percen_percen/100)*$dividen_net;
		$dividen_register=$year;
		//check if data dividen exist
		if($this->tbldata_exist("dividen","dividen_id","dividen_register='".$year."' AND dividen_percen_id='".$dividen_percen_id."'"))
			{
			$update_arr = array(
			'dividen_amount'=>	$dividen_amount
			);
			$this->db_update("dividen",$update_arr,"dividen_register='".$year."' AND dividen_percen_id='".$dividen_percen_id."'");
			}
		else
			{
			$insert_arr = array(
			'dividen_percen_id'=>	$dividen_percen_id,
			'dividen_register'=>	$dividen_register,
			'dividen_amount'=>	$dividen_amount
			);
			$this->db_insert("dividen",$insert_arr);
			}
		}
	}
	
function dividen_account_get($id_child_taxonomi,$year)
	{
	$dividen_amount =0;
	$db_select = $this->db_select("dividen,dividen_percen","dividen.dividen_amount","dividen.dividen_register='".$year."' AND dividen_percen.taxonomi_id='".$id_child_taxonomi."' AND dividen.dividen_percen_id=dividen_percen.dividen_percen_id","",0,1);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$dividen_amount =$select_data[$i]['dividen_amount'];
		}
	return $dividen_amount;
	}

function book_close($taxonomi_id,$month_year,$debit,$ledger_id,$ledger_register,$year)
	{
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$taxonomi_level=$select_data[$i]['taxonomi_level'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		$saldo_taxonomi=$this->balance_account($id_child_taxonomi,$month_year,$debit);
		
		$saldo_taxonomi+=$this->dividen_account_get($id_child_taxonomi,$year);
		if($taxonomi_postable==1)
			{
			$this->book_close($taxonomi_code,$month_year,$debit,$ledger_id,$ledger_register,$year);
			}
		if($taxonomi_postable==0)
			{
			//post ledger details
			if($saldo_taxonomi>=0)
				{
				if($debit=="D")
					{
					$ledgerdetails_type="D";
					}
				else
					{
					$ledgerdetails_type="K";
					}
				}
			else
				{
				$saldo_taxonomi=abs($saldo_taxonomi);
				if($debit=="D")
					{
					$ledgerdetails_type="K";
					}
				else
					{
					$ledgerdetails_type="D";
					}
				}
			$this->ledgerdetails_post($ledger_id,$id_child_taxonomi,$ledgerdetails_type,$saldo_taxonomi,$ledger_register);
			}
		}
	}
	
function ledger_total_dk($ledger_id,$dk)
	{
	$total_dk=0;
	$db_select = $this->db_select("ledgerdetails","ledgerdetails_amount","ledger_id='".$ledger_id."' AND ledgerdetails_type='".$dk."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$amount_debit=$select_data[$i]['ledgerdetails_amount'];
		$total_dk+=$amount_debit;
		}
	return $total_dk;
	}
	
function ledger_expired($tbt_expired)
	{
	$db_select = $this->db_select("ledger","*","ledger_registernum<='".$tbt_expired."' AND ledger_status='tmp'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++){
		$ledger_id=$select_data[$i]['ledger_id'];
		//delete ledger details
		$db_select2 = $this->db_select("ledgerdetails","*","ledger_id='".$ledger_id."'","",0,0);
		$select_data2=$db_select2['select_data'];
		for($j=0;$j<$db_select2['select_num'];$j++){
			$ledgerdetails_id=$select_data2[$j]['ledgerdetails_id'];
			$this->db_delete("ledgerdetails","ledgerdetails_id='".$ledgerdetails_id."'");
			}
		$this->db_delete("ledger","ledger_id='".$ledger_id."'");
		}
	}
	
function ledgerdetails_balance_sheet_dk(&$balance_sheet_debit,&$balance_sheet_kredit,$sub_total_debit,$sub_total_kredit)
	{
	$balance_sheet_debit=0;
	$balance_sheet_kredit=0;
	if($sub_total_debit>$sub_total_kredit){
		$balance_sheet_debit=$sub_total_debit-$sub_total_kredit;
		}else{
		$balance_sheet_kredit=$sub_total_kredit-$sub_total_debit;
		}
	}
	
function taxonomi_code_gen($taxonomi_level,$taxonomi_parent)
	{
	$code_generator="";
	$code_inc="10";
	$sub_str_val=2 * $taxonomi_level;
	if($taxonomi_level==0){
		$code_inc="1";
		$sub_str_val="1";
		}
	$db_select = $this->db_select("taxonomi","taxonomi_code","taxonomi_parent='".$taxonomi_parent."'","taxonomi_code DESC",0,0);
	$select_data=$db_select['select_data'];
	$taxonomi_code=$select_data[0]['taxonomi_code'];
	$code_inc=substr($taxonomi_code,$sub_str_val) + 1;
	$code_generator=$taxonomi_parent.$code_inc;
	return $code_generator;
	}
	
function balance_trial_project($taxonomi_id,$debit,$project_id)
	{
	$sub_total_debit=0;
	$sub_total_kredit=0;
	$db_select = $this->db_select("ledgerdetails,ledger","ledgerdetails.*","ledgerdetails.taxonomi_id='".$taxonomi_id."' AND ledger.project_id='".$project_id."' AND ledger.ledger_status = 'pmn' AND ledger.ledger_id=ledgerdetails.ledger_id","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$ledgerdetails_id=$select_data[$i]['ledgerdetails_id'];
		$ledgerdetails_type=$select_data[$i]['ledgerdetails_type'];
		$ledgerdetails_amount=$select_data[$i]['ledgerdetails_amount'];
		if($ledgerdetails_type=="D")
			{
			$sub_total_debit=$sub_total_debit + $ledgerdetails_amount;
			}
		else
			{
			$sub_total_kredit=$sub_total_kredit + $ledgerdetails_amount;
			}
		}
		if($debit=="D")
		{
		$saldo=$sub_total_debit-$sub_total_kredit;
		}
		else
		{
		$saldo=$sub_total_kredit-$sub_total_debit;
		}
	return $saldo;
	}
	
function profit_loss_project($taxonomi_id,$debit,$project_id)
	{
	$inc=1;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$taxonomi_level=$select_data[$i]['taxonomi_level'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		
		if($taxonomi_postable==1)
			{
			echo"<tr>
			<td bgcolor=#FFFFFF><strong><u>$taxonomi_name</u></strong></td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			$this->profit_loss_project($taxonomi_code,$debit,$project_id);
			}
		if($taxonomi_postable==0)
			{
			//total saldo
			$total_saldo=$this->balance_trial_project($id_child_taxonomi,$debit,$project_id);
			$total_saldo_format=number_format($total_saldo,2,'.',',');
			
			echo"<tr>
			<td bgcolor=#FFFFFF>$inc. $taxonomi_name</td>
			<td align=center bgcolor=#FFFFFF>$total_saldo_format</td>
			</tr>";
			}
		if($taxonomi_level=='1')
			{
			echo"<tr>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			}
		$inc++;
		}
	}
	
function balance_trial_project_total($taxonomi_id,$debit,$project_id)
	{
	$saldo=0;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$saldo_taxonomi=$this->balance_trial_project($id_child_taxonomi,$debit,$project_id);
		$saldo=$saldo + $saldo_taxonomi + $this->balance_trial_project_total($taxonomi_code,$debit,$project_id);
		}
	return $saldo;
	}
	
function balance_sheet_project($taxonomi_id,$debit,$project_id)
	{
	$inc=1;
	$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_id."'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_child_taxonomi =$select_data[$i]['taxonomi_id'];
		$taxonomi_code =$select_data[$i]['taxonomi_code'];
		$taxonomi_level=$select_data[$i]['taxonomi_level'];
		$taxonomi_name=$select_data[$i]['taxonomi_name'];
		$taxonomi_postable=$select_data[$i]['taxonomi_postable'];
		$saldo_taxonomi=$this->balance_trial_project($id_child_taxonomi,$debit,$project_id);
		$saldo_taxonomi=number_format($saldo_taxonomi,2,'.',',');
		
		if($taxonomi_postable==1)
			{
			echo"<tr>
			<td bgcolor=#FFFFFF><strong><u>$taxonomi_name</u></strong></td>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			$this->balance_sheet_project($taxonomi_code,$debit,$project_id);
			}
		if($taxonomi_postable==0)
			{
			echo"<tr>
			<td bgcolor=#FFFFFF>$inc. $taxonomi_name</td>
			<td align=center bgcolor=#FFFFFF>$saldo_taxonomi</td>
			</tr>";
			}
		if($taxonomi_level=='1')
			{
			echo"<tr>
			<td bgcolor=#FFFFFF>&nbsp;</td>
			<td align=center bgcolor=#FFFFFF>&nbsp;</td>
			</tr>";
			}
		$inc++;
		}
	}
	
function taxonomi_get($taxonomi_id,$field="")
	{
	$select_data =array();
	if($taxonomi_id==0){
		$taxonomi_id=1;
		}
	$db_select = $this->db_select("taxonomi","*","taxonomi_id='".$taxonomi_id."'","",0,1);
	$select_data=$db_select['select_data'];
	if($field==""){
		return $select_data[0];
		}else{
		return $select_data[0][$field];
		}
	}
	
function account_special_arr($taxonomy_special_type_arr)
	{
	$result =array();
	$taxonomy_special_type = $this->select_arr_infield($taxonomy_special_type_arr,"taxonomy_special_type","=");
	$db_select = $this->db_select("taxonomi","*",$taxonomy_special_type." AND taxonomi_postable='0'","",0,0);
	$select_data=$db_select['select_data'];
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$result[]=$select_data[$i]['taxonomi_id'];
		}
	return $result;
	}
	
function account_parent_special_arr($taxonomy_special_type_arr)
	{
	$result="";
	for($j=0;$j<count($taxonomy_special_type_arr);$j++)
		{
		$tax_arr=$taxonomy_special_type_arr[$j];
		$taxonomi_parent=$this->db_fldrow("taxonomi","taxonomi_code","taxonomy_special_type='".$tax_arr."' AND taxonomi_postable='1'");
		$db_select = $this->db_select("taxonomi","*","taxonomi_parent='".$taxonomi_parent."' AND taxonomi_postable='0'","",0,0);
		$select_data=$db_select['select_data'];
		//echo $db_select['qry_str'];
		for($i=0;$i<$db_select['select_num'];$i++)
			{
			$taxonomi_id=$select_data[$i]['taxonomi_id'];
			if($i>0){
				$result.=",".$taxonomi_id;
			}else{
				$result.=$taxonomi_id;
				}
			}
		}
	return $result;
	}
	
function subsidiary_update($ledger_id)
	{
	//get an array parent special
	$account_parent_special_arr=$this->account_parent_special_arr(array("cash_bank"));
	//get if ledgerdetails contain cash_bank
	$query_str="SELECT * FROM ledgerdetails WHERE FIND_IN_SET(taxonomi_id,'".$account_parent_special_arr."') AND ledger_id='".$ledger_id."'";
	$db_select = $this->db_qry_data($query_str);
	$select_data=$db_select['select_data'];
	//if exist
	if($db_select['select_num']==1){
		if($select_data[0]['ledgerdetails_type']=="D"){
			$dk="cash-debit";
			}else{
			$dk="cash-credit";
			}
		$update_arr1 = array(
		'ledger_subsidiary'=>	$dk,
		);
		$update_arr2 = array(
		'ledgerdetails_subsidiary'=>	$dk,
		);
		$this->db_update("ledger",$update_arr1,"ledger_id='".$ledger_id."'");
		$this->db_update("ledgerdetails",$update_arr2,"ledgerdetails_id='".$select_data[0]['ledgerdetails_id']."'");
	}else{
		$update_arr1 = array(
		'ledger_subsidiary'=>	'',
		);
		$update_arr2 = array(
		'ledgerdetails_subsidiary'=>	'',
		);
		$this->db_update("ledger",$update_arr1,"ledger_id='".$ledger_id."'");
		$this->db_update("ledgerdetails",$update_arr2,"ledger_id='".$ledger_id."'");
		}
	//echo $db_select['select_num'];
	}
	
function delete_ledger($ledger_id)
	{
	$this->db_delete("ledgerdetails","ledger_id='".$ledger_id."'");
	$this->db_delete("ledger","ledger_id='".$ledger_id."'");
	}
	
	
function balance_first($drange1,$taxonomi_special)
	{
	$return_arr=array();
	$balance_first_debit=0;
	$balance_first_credit=0;
	$month_first_exp=explode("/",$drange1);
	$month_first=$month_first_exp[0]."/".$month_first_exp[1];
	if($month_first!="01/01"){
		$dmy_first=$this->mktime_next($drange1,-1,0,0);
		$dmy_first=date("d/m/Y",$dmy_first);
		//echo $taxonomi_special."-".$dmy_first;
		$balance_first=$this->balance_trial_total_special($taxonomi_special,$dmy_first,"D");
		if($balance_first>=0){
			$balance_first_debit=$balance_first;
			$balance_first_credit=0;
		}else{
			$balance_first_debit=0;
			$balance_first_credit=abs($balance_first);
			}
		$this->balance_zero($balance_first_debit,$balance_first_credit);
		}
	$return_arr['balance_first_debit']=$balance_first_debit;
	$return_arr['balance_first_credit']=$balance_first_credit;
	return $return_arr;
	}
	
function cash_first_period_get($year)
	{
	$return_arr=array();
	$return_arr['taxonomi_amount_d']=0;
	$return_arr['taxonomi_amount_k']=0;
	//get ledger last closed
	$last_year=$year-1;
	$ledger_id=$this->db_fldrow("book_close","ledger_id","book_close_period='".$last_year."'");
	$cash_bank_list=$this->account_parent_special_get("cash_bank");
	$db_select = $this->db_qry_data("SELECT ledgerdetails.*,taxonomi.* FROM ledgerdetails,taxonomi WHERE ledgerdetails.ledger_id='".$ledger_id."' AND taxonomi.taxonomi_id IN (".implode(',',$cash_bank_list).") AND ledgerdetails.taxonomi_id=taxonomi.taxonomi_id");
	$select_data=$db_select['select_data'];
	for($k=0;$k<$db_select['select_num'];$k++){
		if($select_data[$k]['ledgerdetails_type']=='D'){
			$return_arr['taxonomi_amount_d'] +=$select_data[$k]['ledgerdetails_amount'];
		}else{
			$return_arr['taxonomi_amount_k'] +=$select_data[$k]['ledgerdetails_amount'];
			}
		}
	return $return_arr;
	}
	
function if_cash_couple($ledger_id,$amount,$couple=1)
	{
	$return_out=true;
	if($couple==1){
		$cash_bank_list=$this->account_parent_special_get("cash_bank");
		$db_select = $this->db_qry_data("SELECT ledgerdetails.*,taxonomi.* FROM ledgerdetails,taxonomi WHERE ledgerdetails.ledger_id='".$ledger_id."' AND taxonomi.taxonomi_id IN (".implode(',',$cash_bank_list).") AND ledgerdetails_amount='".$amount."' AND ledgerdetails.taxonomi_id=taxonomi.taxonomi_id");
		if($db_select['select_num']>0){
			$return_out=true;
			}else{
			$return_out=false;
			}
		}
	return $return_out;
	}
	
function cash_flow_amount_dk($taxonomi_id,$date_range_match,$couple=0)
	{
	$return_arr=array();
	$return_arr['taxonomi_amount_d']=0;
	$return_arr['taxonomi_amount_k']=0;
	$cash_bank_list=$this->account_parent_special_get("cash_bank");
	$ledger_subsidiary_qry="ledger.ledger_subsidiary=''";
	$ledger_subsidiary_qry2=" AND ledgerdetails.taxonomi_id IN (".implode(',',$cash_bank_list).")";
	if($couple==0){
		$ledger_subsidiary_qry="(ledger.ledger_subsidiary='cash-debit' || ledger.ledger_subsidiary='cash-credit')";
		$ledger_subsidiary_qry2=" AND ledgerdetails.taxonomi_id ='".$taxonomi_id."'";
		}
	$db_select = $this->db_qry_data("SELECT ledger.ledger_id FROM ledger LEFT JOIN ledgerdetails ON ledger.ledger_id=ledgerdetails.ledger_id WHERE ".$ledger_subsidiary_qry.$ledger_subsidiary_qry2.$date_range_match." GROUP BY ledger.ledger_id");
	$select_data=$db_select['select_data'];
	for($j=0;$j<$db_select['select_num'];$j++){
		//echo "NON Cash in out Ledger Utaama: ".$select_data[$j]['ledger_id']."</br>";
		$db_select2 = $this->db_qry_data("SELECT ledgerdetails.*,taxonomi.taxonomi_name FROM ledgerdetails,taxonomi WHERE ledgerdetails.ledger_id='".$select_data[$j]['ledger_id']."' AND taxonomi.taxonomi_id ='".$taxonomi_id."' AND ledgerdetails.taxonomi_id=taxonomi.taxonomi_id");
		$select_data2=$db_select2['select_data'];
		for($k=0;$k<$db_select2['select_num'];$k++){
			//cek if couple
			if($this->if_cash_couple($select_data[$j]['ledger_id'],$select_data2[$k]['ledgerdetails_amount'],$couple)){
				//echo "Couple: ".$select_data[$j]['ledger_id']."-".$select_data2[$k]['taxonomi_name']."-".$select_data2[$k]['ledgerdetails_amount']."<br>";
				if($select_data2[$k]['ledgerdetails_type']=='D'){
				$return_arr['taxonomi_amount_k'] +=$select_data2[$k]['ledgerdetails_amount'];
				}else{
				$return_arr['taxonomi_amount_d'] +=$select_data2[$k]['ledgerdetails_amount'];
				}
				}
			}//end for k
		}//end for j
	return $return_arr;
	}
	
function cash_flow_amount_dk_special($taxonomi_parent,$date_range_match,$couple=0)
	{
	$return_arr=array();
	$return_arr['taxonomi_amount_d']=0;
	$return_arr['taxonomi_amount_k']=0;
	$cash_bank_list=$this->account_parent_special_get("cash_bank");
	
	$db_select0 = $this->db_qry_data("SELECT * FROM taxonomi WHERE taxonomi_parent ='".$taxonomi_parent."' AND taxonomi_cash_flow=''");
	$select_data0=$db_select0['select_data'];
	for($i=0;$i<$db_select0['select_num'];$i++){
		$taxonomi_code=$select_data0[$i]['taxonomi_code'];
		$taxonomi_id=$select_data0[$i]['taxonomi_id'];
		$ledger_subsidiary_qry="ledger.ledger_subsidiary=''";
		$ledger_subsidiary_qry2=" AND ledgerdetails.taxonomi_id IN (".implode(',',$cash_bank_list).")";
		if($couple==0){
			$ledger_subsidiary_qry="(ledger.ledger_subsidiary='cash-debit' || ledger.ledger_subsidiary='cash-credit')";
			$ledger_subsidiary_qry2=" AND ledgerdetails.taxonomi_id ='".$taxonomi_id."'";
			}
		if($select_data0[$i]['taxonomi_postable']==0){
			$db_select = $this->db_qry_data("SELECT ledger.ledger_id FROM ledger LEFT JOIN ledgerdetails ON ledger.ledger_id=ledgerdetails.ledger_id WHERE ".$ledger_subsidiary_qry.$ledger_subsidiary_qry2.$date_range_match." GROUP BY ledger.ledger_id");
			$select_data=$db_select['select_data'];
			for($j=0;$j<$db_select['select_num'];$j++){
				//echo "NON Cash in out Ledger Utaama: ".$select_data[$j]['ledger_id']."</br>";
				$db_select2 = $this->db_qry_data("SELECT ledgerdetails.*,taxonomi.taxonomi_name FROM ledgerdetails,taxonomi WHERE ledgerdetails.ledger_id='".$select_data[$j]['ledger_id']."' AND taxonomi.taxonomi_id ='".$taxonomi_id."' AND ledgerdetails.taxonomi_id=taxonomi.taxonomi_id");
				$select_data2=$db_select2['select_data'];
				for($k=0;$k<$db_select2['select_num'];$k++){
					//cek if couple
					if($this->if_cash_couple($select_data[$j]['ledger_id'],$select_data2[$k]['ledgerdetails_amount'],$couple)){
						//echo "Couple: ".$select_data[$j]['ledger_id']."-".$select_data2[$k]['taxonomi_name']."-".$select_data2[$k]['ledgerdetails_amount']."<br>";
						if($select_data2[$k]['ledgerdetails_type']=='D'){
							$return_arr['taxonomi_amount_k'] +=$select_data2[$k]['ledgerdetails_amount'];
							}else{
							$return_arr['taxonomi_amount_d'] +=$select_data2[$k]['ledgerdetails_amount'];
							}
						}
					}//end for k
				}//end for j
			}else{
			//end if postable recursive
			$cash_flow_amount_dk_arr=$this->cash_flow_amount_dk_special($taxonomi_code,$date_range_match,$couple);
			$return_arr['taxonomi_amount_k'] +=$cash_flow_amount_dk_arr['taxonomi_amount_k'];
			$return_arr['taxonomi_amount_d'] +=$cash_flow_amount_dk_arr['taxonomi_amount_d'];
			}
	}//end i
	return $return_arr;
	}
	
//func get balance first
function balance_first_get($date_in,$taxonomy_special_type_arr)
	{
	$total=0;
	$dmy_first=$this->mktime_next($date_in,-1,0,0);
	$dmy_first=date("d/m/Y",$dmy_first);
	//loop cash bank
	for($j=0;$j<count($taxonomy_special_type_arr);$j++)
		{
		$tax_arr=$taxonomy_special_type_arr[$j];
		$taxonomi_parent=$this->db_fldrow("taxonomi","taxonomi_code","taxonomy_special_type='".$tax_arr."' AND taxonomi_postable='1'");
		$db_select = $this->db_select("taxonomi","taxonomi_id,taxonomi_name","taxonomi_parent='".$taxonomi_parent."' AND taxonomi_postable='0'","",0,0);
		$select_data=$db_select['select_data'];
		//echo $db_select['qry_str'];
		for($i=0;$i<$db_select['select_num'];$i++)
			{
			$taxonomi_id=$select_data[$i]['taxonomi_id'];
			$balance_first=$this->balance_trial($taxonomi_id,$dmy_first,"D");
			$total +=$balance_first;
			}
		}
	return $total;
	}
	
}
?>
