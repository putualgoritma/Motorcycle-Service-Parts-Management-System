<?
/**
* Operation csv import
*/
if(isset($_FILES['file_source']))
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
'motorcycle_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_code'],
'motorcycle_type_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_code'],
'color_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['color_code'],
'motorcycle_manufacture'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_manufacture'],
'motorcycle_frame_no'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_frame_no'],
'motorcycle_machine_no'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_machine_no'],
'motorcycle_buy_register'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_buy_register'],
'motorcycle_book_service_no'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_book_service_no'],
'users_code'=>	$global->users->users_lang['form_label_users_lang']['users_code'],
'users_name'=>	$global->users->users_lang['form_label_users_lang']['users_name'],
'users_address'=>	$global->users->users_lang['form_label_users_lang']['users_address'],
'users_phone'=>	$global->users->users_lang['form_label_users_lang']['users_phone'],
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
		$valid_date=$global->valid_date($data['motorcycle_buy_register']);
		//if users_code empty
		$users_code=$data['users_code'];
		if(trim($data['users_code'])==""){
			$users_code=$data['motorcycle_code'];
			}
		$users_register=date("d/m/Y");
		$users_registernum=date("Y").date("m").date("d");
		//users
		$insert_arr = array(
		'users_register'=>	$users_register,
		'users_registernum'=>	$users_registernum,
		'users_code'=>	$users_code,
		'users_type'=>	'customer',
		'users_name'=>	$data['users_name'],
		'users_address'=>	$data['users_address'],
		'users_phone'=>	$data['users_phone'],
		);
		//$global->db_insert_update('users',$insert_arr,'users_code');
		//motorcycle
		$insert_arr = array(
		'motorcycle_code'=>	$data['motorcycle_code'],
		'motorcycle_type_code'=>	$data['motorcycle_type_code'],
		'color_code'=>	$data['color_code'],
		'users_code'=>	$users_code,
		'motorcycle_manufacture'=>	$data['motorcycle_manufacture'],
		'motorcycle_frame_no'=>	$data['motorcycle_frame_no'],
		'motorcycle_machine_no'=>	$data['motorcycle_machine_no'],
		'motorcycle_buy_register'=>	$valid_date['date_register'],
		'motorcycle_buy_registernum'=>	$valid_date['date_registernum'],
		'motorcycle_book_service_no'=>	$data['motorcycle_book_service_no'],
		);
		$global->db_insert_update('motorcycle',$insert_arr,'motorcycle_code');
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
Header("location: index.php");
exit;
}else{
/**
* Operation csv generate
*/
$file_name="kendaraan.csv";
$csv_source="csv/".$file_name;

//default view
$search_value="";
$sort_value="motorcycle_code ASC";
$pageset_value=0;
$per_page_value=0;

//set search array 
$search_field_arr=array("motorcycle.motorcycle_code","motorcycle_type.motorcycle_type_code");
$def_arr=array(
'pageset'=>$pageset_value,
'per_page'=>$per_page_value,
'keyword'=>$search_value,
'sort'=>$sort_value,
'join_match'=>"",
'join_id'=>"",
'join_tbl'=>array("motorcycle_type","users","color"),
'join_type'=>array("LEFT JOIN","LEFT JOIN","LEFT JOIN"),
'join_key'=>array("motorcycle_type_code","users_code","color_code"),
'join_tbl_field'=>array("motorcycle_type_code","users_code,users_address,users_phone,users_name","color_code"),
'join_tbl_group'=>array(0,0,0),
'join_tbl_id'=>array("","",""),
);
$motorcycle_search_list=$global->tbl_searchjoin_list("motorcycle","motorcycle.*,motorcycle_type.motorcycle_type_code,color.color_code,users.users_code,users.users_address,users.users_phone,users.users_name",$def_arr,$search_field_arr,1,$select_num,$qry_str_sort);

//adjust

//fields_arr
$fields_arr = array(
'motorcycle_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_code'],
'motorcycle_type_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_type_code'],
'color_code'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['color_code'],
'motorcycle_manufacture'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_manufacture'],
'motorcycle_frame_no'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_frame_no'],
'motorcycle_machine_no'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_machine_no'],
'motorcycle_buy_register'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_buy_register'],
'motorcycle_book_service_no'=>	$global->product_order->product_order_lang['form_label_product_order_lang']['motorcycle_book_service_no'],
'users_code'=>	$global->users->users_lang['form_label_users_lang']['users_code'],
'users_name'=>	$global->users->users_lang['form_label_users_lang']['users_name'],
'users_address'=>	$global->users->users_lang['form_label_users_lang']['users_address'],
'users_phone'=>	$global->users->users_lang['form_label_users_lang']['users_phone'],
);

//get out
$out=$global->csv_generate($fields_arr,$motorcycle_search_list);

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