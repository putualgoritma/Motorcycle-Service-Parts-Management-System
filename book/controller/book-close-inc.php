<?
if(isset($_REQUEST['delete']))
{
if (isset($_POST["id"]) && is_array($_POST["id"]) && count($_POST["id"]) > 0) 
	{ 
	foreach ($_POST["id"] as $id_book_close) 
		{
		$db_select = $global->db_select("book_close","*","book_close_id='".$id_book_close."'","",0,0);
		$select_data=$db_select['select_data'];
		for($i=0;$i<$db_select['select_num'];$i++)
			{
			$ledger_id=$select_data[$i]['ledger_id'];
			//check if taxonomi in used
			$ledger_uneditable=$global->db_fldrow("ledger","ledger_uneditable","ledger_id='".$ledger_id."'");
			if($ledger_uneditable !=1)
				{ 
				$db_select2 = $global->db_select("ledgerdetails","*","ledger_id='".$ledger_id."'","",0,0);
				$select_data2=$db_select2['select_data'];
				for($j=0;$j<$db_select2['select_num'];$j++)
					{
					$ledgerdetails_id=$select_data2[$j]['ledgerdetails_id'];
					$global->db_delete("ledgerdetails","ledgerdetails_id='".$ledgerdetails_id."'");
					}
				$global->db_delete("ledger","ledger_id='".$ledger_id."'");
				}
			}
		$global->db_delete("book_close","book_close_id='".$id_book_close."'");
		}
	}	
Header("location: book-close.php");
exit;
}
?>
<?
if(isset($_POST['Submit']))
{
//form handling
$year=$_REQUEST['year'];
$next_year=$year + 1;
$month_year="%/"."%/".$year;
$month_next_year="01/"."01/".$next_year;
$month_next_year_num=$next_year."01"."01";
//end form handling

//check if already exist
$db_select = $global->db_select("book_close","*","book_close_period='".$year."'","",0,0);
$select_data=$db_select['select_data'];
if($db_select['select_num'] > 0)
	{
	$global->book->dividen_percen_alocation($year);
	for($i=0;$i<$db_select['select_num'];$i++)
		{
		$id_book_close=$db_select[$i]['book_close_id'];
		$ledger_id=$db_select[$i]['ledger_id'];
		}
	//select ledger
	$ledger_register=$global->db_fldrow("ledger","ledger_register","ledger_id='".$ledger_id."'");
	$global->db_delete("ledgerdetails","ledger_id='".$ledger_id."'");
	
	//tutup buku
	$global->book->book_close(1,$month_year,"D",$ledger_id,$ledger_register,$year);
	$global->book->book_close(2,$month_year,"K",$ledger_id,$ledger_register,$year);
	$global->book->book_close(3,$month_year,"K",$ledger_id,$ledger_register,$year);
	//redirect
	Header("location: ../confirm.php?redirect=book/book-close.php&confirm=".$form_header_lang['book_close_button']);
	exit;
	}
else
	{
	$global->book->dividen_percen_alocation($year);
	//post ledger
	$dt=date("YmdHis");  
	$tbt=date("Y").date("m").date("d");
	$sessi_id=  $dt.uniqid();
	$ledger_register=$month_next_year;
	$ledger_description="Saldo Awal Rekening Periode Akutansi: $next_year";
	$ledger_uneditable=0;
	$insert_arr = array(
	'ledger_register'=>	$ledger_register,
	'ledger_description'=>	$ledger_description,
	'ledger_uneditable'=>	$ledger_uneditable,
	'sessi_id'=>	$sessi_id,
	'ledger_status'=>	'pmn',
	'ledger_registernum'=>	$month_next_year_num,
	);
	$global->db_insert("ledger",$insert_arr);
	//cari last ID
	$ledger_id=$global->db_lastid("ledger","ledger_id");
	//tutup buku
	$global->book->book_close(1,$month_year,"D",$ledger_id,$ledger_register,$year);
	$global->book->book_close(2,$month_year,"K",$ledger_id,$ledger_register,$year);
	$global->book->book_close(3,$month_year,"K",$ledger_id,$ledger_register,$year);
	
	//insert history tutup buku
	$register_book_close=date("d/m/Y");
	$insert_arr = array(
	'book_close_register'=>	$register_book_close,
	'book_close_period'=>	$year,
	'ledger_id'=>	$ledger_id
	);
	$global->db_insert("book_close",$insert_arr);
	//redirect
	Header("location: ../confirm.php?redirect=book/book-close.php&confirm=".$form_header_lang['book_close_button']);
	exit;
	}
}

//init
$inc=1;
$year_value=date("Y");
?>