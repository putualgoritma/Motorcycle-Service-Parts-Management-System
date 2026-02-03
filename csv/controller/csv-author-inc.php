<?
/**
* Operation csv import
*/
if(isset($_POST['btn_import']))
{
//upload csv
$namacsv="csv/".$_FILES['file_source']['name'];
if(!($_FILES['file_source']['size']==0))
	{
	if(is_uploaded_file($_FILES['file_source']['tmp_name']))
		{
		$destination=$namacsv;
		move_uploaded_file($_FILES['file_source']['tmp_name'], $destination);
		}
	else 
		{
		$error=$global->csv->csv_lang['msgform_csv_lang']['csv_up_err'];
		echo "<script>alert(\"$error \");history.go(-1)</script>";
		exit;
		}
	}

//fields_arr
$fields_arr = array(
'contact_code'=>	$global->users->users_lang['form_label_users_lang']['contact_code'],
'contact_name'=>	$global->users->users_lang['form_label_users_lang']['contact_name'],
);

//loop data
$i=0;
$error=$global->csv->csv_lang['msgform_csv_lang']['csv_header_err'];
$handle = fopen($namacsv, "r");
while (($data_csv = fgetcsv($handle, 0, ",",'"')) !== FALSE)
	{
	//convert
	$ic=0;
	foreach($fields_arr as $key => $value)
		{
		$data_csv_val=str_replace("-coma-",",",@$data_csv[$ic]);
		$data_csv_val=str_replace("'","+a-a+",$data_csv_val);
		$data[$key]=$data_csv_val;
		$ic++;
		}
	//if header csv
	if($i==0)
		{
		$penanda=0;
		$eclo="";
		foreach($fields_arr as $key => $value)
			{
			if($value!=$data[$key])
				{
				$penanda=1;
				}
			}
		if($penanda==1)
			{
			break;
			}
		}
	else
		{
		//insert items
		$insert_arr = array(
		'contact_code'=>	$data['contact_code'],
		'contact_name'=>	$data['contact_name'],
		'contact_type'=>	'author',
		);
		$global->db_insert_update('contact',$insert_arr,'contact_code');
		}
	$i++;
	}
//check if break
if($penanda=="1")
	{
	echo "<script>alert(\"$error \");history.go(-1)</script>";
	exit;
	}

//redirect to confirm
Header("location: ../".$_POST['redirect_import']);
exit;
}else{
/**
* Operation csv generate
*/
$file_name="otorisasi.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$sort_value="contact_code ASC";
$pageset_value=0;
$per_page_value=0;

//query
$search_field_arr=array("contact_code","contact_name");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>" AND contact_type='author'",
'join_id'=>""
);
$contact_search_list=$global->tbl_search_list("contact","*",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust

//fields_arr
$fields_arr = array(
'contact_code'=>	$global->users->users_lang['form_label_users_lang']['contact_code'],
'contact_name'=>	$global->users->users_lang['form_label_users_lang']['contact_name'],
);

//get out
$out=$global->csv_generate($fields_arr,$contact_search_list);

//print_r($loan_search_list);
//echo $qry_str_sort;

//unlink if exist csv
unlink($csv_source);
// Open file export.csv.
$f = fopen ($csv_source,'w+');

// Put all values from $out to export.csv. 
fputs($f, $out);
fclose($f);

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="'.$file_name.'"');
readfile($csv_source);
}
?>