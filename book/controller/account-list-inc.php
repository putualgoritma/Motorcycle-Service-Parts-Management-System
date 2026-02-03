<?
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $taxonomi_id) 
		{ 
		$taxonomi_row=$global->db_row("taxonomi","taxonomi_code,taxonomy_special_type","taxonomi_id='".$taxonomi_id."'");
		if(!($global->tbldata_exist("ledgerdetails","*","taxonomi_id='".$taxonomi_id."'")) && ($taxonomi_row['taxonomy_special_type']=='0') && !($global->tbldata_exist("taxonomi","*","taxonomi_parent='".$taxonomi_row['taxonomi_code']."'")))
			{
			$global->db_delete("taxonomi","taxonomi_id='".$taxonomi_id."'");
			}
		}
	}	
Header("location: account-list.php?search=&year=&month=&sort=&pageset=");
exit;
}
?>