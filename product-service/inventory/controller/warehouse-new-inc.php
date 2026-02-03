<?
//cek popup
if(isset($popup)){
$link_list="warehouse-popup.php";
$link_new="warehouse-popup-new.php";
}else{
$link_list="warehouse.php";
$link_new="warehouse-new.php";
}
//submit
if(isset($_POST['Submit']))
{
//form handling
$warehouse_code=$_POST['warehouse_code'];
$warehouse_name=$_POST['warehouse_name'];
$warehouse_description=$_POST['warehouse_description'];
$warehouse_type=$_POST['warehouse_type'];
//end form handling

//insert items
$create_arr = array(
'warehouse_code'=>	$warehouse_code,
'warehouse_name'=>	$warehouse_name,
'warehouse_description'=>	$warehouse_description,
'warehouse_type'=>	$warehouse_type,
);
//create warehouse
if(!$global->product_order->create_warehouse($create_arr)){
	$global->product_order->error_message($global->product_order->err_msg);
	}
$warehouse_id=$global->db_lastid("warehouse","warehouse_id");
//if type branch
if($warehouse_type=="branch"){
	$taxonomi_parent='1172';
	$taxonomi_postable='0';
	$taxonomi_cash_flow='operational';
	$taxonomi_name="Persediaan Barang ".$warehouse_name;
	$taxonomi_row=$global->db_row("taxonomi","*","taxonomi_code='".$taxonomi_parent."'");
	$taxonomi_type=$taxonomi_row['taxonomi_type'];
	$taxonomi_level=$taxonomi_row['taxonomi_level'];
	$code_generator=$global->book->taxonomi_code_gen($taxonomi_level,$taxonomi_parent);
	$taxonomi_level_child=$taxonomi_level + 1;
	//insert items
	$insert_arr = array(
	'taxonomi_parent'=>	$taxonomi_parent,
	'taxonomi_name'=>	$taxonomi_name,
	'taxonomi_type'=>	$taxonomi_type,
	'taxonomi_code'=>	$code_generator,
	'taxonomi_level'=>	$taxonomi_level_child,
	'taxonomi_postable'=>	$taxonomi_postable,
	'taxonomi_cash_flow'=>	$taxonomi_cash_flow,
	);
	$global->db_insert("taxonomi",$insert_arr);
	$taxonomi_id=$global->db_lastid("taxonomi","taxonomi_id");
	//update warehouse
	$update_arr = array(
	'taxonomi_id'=>	$taxonomi_id,
	);
	$global->db_update("warehouse",$update_arr,"warehouse_id='".$warehouse_id."'");
	}
//if type main
if($warehouse_type=="main"){
	$taxonomi_parent='21';
	$taxonomi_postable='0';
	$taxonomi_cash_flow='operational';
	$taxonomi_name="Pengiriman Barang ".$warehouse_name;
	$taxonomi_row=$global->db_row("taxonomi","*","taxonomi_code='".$taxonomi_parent."'");
	$taxonomi_type=$taxonomi_row['taxonomi_type'];
	$taxonomi_level=$taxonomi_row['taxonomi_level'];
	$code_generator=$global->book->taxonomi_code_gen($taxonomi_level,$taxonomi_parent);
	$taxonomi_level_child=$taxonomi_level + 1;
	//insert items
	$insert_arr = array(
	'taxonomi_parent'=>	$taxonomi_parent,
	'taxonomi_name'=>	$taxonomi_name,
	'taxonomi_type'=>	$taxonomi_type,
	'taxonomi_code'=>	$code_generator,
	'taxonomi_level'=>	$taxonomi_level_child,
	'taxonomi_postable'=>	$taxonomi_postable,
	'taxonomi_cash_flow'=>	$taxonomi_cash_flow,
	);
	$global->db_insert("taxonomi",$insert_arr);
	$taxonomi_id=$global->db_lastid("taxonomi","taxonomi_id");
	//update warehouse
	$update_arr = array(
	'taxonomi_id'=>	$taxonomi_id,
	);
	$global->db_update("warehouse",$update_arr,"warehouse_id='".$warehouse_id."'");
	}
//redirect
//Header("location: warehouse.php");
Header("location: ".$link_list."?confirm=".$form_header_lang['add_new_button']);
exit;
}
?>