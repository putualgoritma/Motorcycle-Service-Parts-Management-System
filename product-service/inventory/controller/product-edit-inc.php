<?
if (isset($_REQUEST['product_id'])){
$product_id=$_REQUEST['product_id'];
}else{
$product_id=0;
}
$product_row=$global->product_order->db_row("product","*","product_id='".$product_id."'");
$category_row=$global->product_order->db_row("category","*","category_code='".$product_row['category_code']."'");
$category_code=$category_row['category_code']." - ".$category_row['category_name'];
$categorysub_row=$global->product_order->db_row("categorysub","*","categorysub_code='".$product_row['categorysub_code']."'");
$categorysub_code=$categorysub_row['categorysub_code']." - ".$categorysub_row['categorysub_name'];
$unit_row=$global->product_order->db_row("unit","*","unit_code='".$product_row['unit_code']."'");
$unit_code=$unit_row['unit_code']." - ".$unit_row['unit_name'];
$rack_row=$global->product_order->db_row("rack","*","rack_code='".$product_row['rack_code']."'");
$rack_code=$rack_row['rack_code']." - ".$rack_row['rack_description'];
//if cancell
if(isset($_REQUEST['Submitcancell']))
{
Header("location: product.php");
exit;
}
//if Submit edit
if(isset($_POST['Submit']))
{
//form handling
$product_id=$_POST['product_id'];
$product_code=$_POST['product_code'];
$product_name=$_POST['product_name'];
$product_sprice=str_replace(",","",$_POST['product_sprice']);
$product_commission_type=$_POST['product_commission_type'];
$product_commission_percent=$_POST['product_commission_percent'];
$product_commission_percent_type=$_POST['product_commission_percent_type'];
$product_commission_nominal=$_POST['product_commission_nominal'];
$product_description=$_POST['product_description'];
$product_bprice=str_replace(",","",$_POST['product_bprice']);
$product_disc=str_replace(",","",$_POST['product_disc']);
//cek if current stock 0
$product_row=$global->db_row("product","*","product_id='".$product_id."'");
$product_kpb_disc=str_replace(",","",$_POST['product_kpb_disc']);
$product_kpb_bprice=$product_sprice-(($product_kpb_disc/100)*$product_sprice);
//addon
$product_min_stock=$_POST['product_min_stock'];
$product_max_stock=$_POST['product_max_stock'];
$product_fast_moving=0;
if(isset($_POST['product_fast_moving'])){
$product_fast_moving=1;
}
$product_sim_part=0;
if(isset($_POST['product_sim_part'])){
$product_sim_part=1;
}
//get category code
$category_code_arr=explode(" - ",$_REQUEST['category_code']);
$category_code=$category_code_arr[0];
//get categorysub code
$categorysub_code_arr=explode(" - ",$_REQUEST['categorysub_code']);
$categorysub_code=$categorysub_code_arr[0];
//get unit code
$unit_code_arr=explode(" - ",$_REQUEST['unit_code']);
$unit_code=$unit_code_arr[0];
//get rack code
$rack_code_arr=explode(" - ",$_REQUEST['rack_code']);
$rack_code=$rack_code_arr[0];
//thumbnail
//upload images
$img_target = "thumbnail/";
$product_thumbnail=$product_row['product_thumbnail'];
if(is_uploaded_file($_FILES['product_thumbnail']['tmp_name'])) 
     {
     //unlink old
	 $product_thumbnail_unlink=SITE_ROOT.$product_thumbnail;
	 unlink($product_thumbnail_unlink);
	 move_uploaded_file($_FILES['product_thumbnail']['tmp_name'], SITE_ROOT.$img_target.$_FILES['product_thumbnail']['name']);
	 $product_thumbnail=$img_target.$_FILES['product_thumbnail']['name'];
     }
//end form handling
//insert items
$create_arr = array(
'product_code'=>	$product_code,
'product_name'=>	$product_name,
'product_bprice'=>	$product_bprice,
'product_sprice'=>	$product_sprice,
'category_code'=>	$category_code,
'categorysub_code'=>	$categorysub_code,
'unit_code'=>	$unit_code,
'rack_code'=>	$rack_code,
'product_commission_type'=>	$product_commission_type,
'product_commission_percent'=>	$product_commission_percent,
'product_commission_percent_type'=>	$product_commission_percent_type,
'product_commission_nominal'=>	$product_commission_nominal,
'product_description'=>	$product_description,
'product_thumbnail'=>	$product_thumbnail,
'product_min_stock'=>	$product_min_stock,
'product_max_stock'=>	$product_max_stock,
'product_fast_moving'=>	$product_fast_moving,
'product_kpb_bprice'=>	$product_kpb_bprice,
'product_disc'=>	$product_disc,
'product_kpb_disc'=>	$product_kpb_disc,
'product_sim_part'=>	$product_sim_part,
);
//update product
if(!$global->product_order->update_product($create_arr,$product_id)){
	$global->product_order->error_message($global->product_order->err_msg);
	}

//update product_sprice_range
//clear current
$global->db_delete("product_sprice_range","product_id='".$product_id."'");
$product_sprice_range_min = $_POST['product_sprice_range_min_hidden'];
$product_sprice_range_price = $_POST['product_sprice_range_price_hidden'];
foreach( $product_sprice_range_min as $key => $product_sprice_range_min_val ) {
	$create_arr = array(
	'product_id'=>	$product_id,
	'product_sprice_range_min'=>	$product_sprice_range_min_val,
	'product_sprice_range_price'=>	$product_sprice_range_price[$key],
	);
	//create product_sprice_range
	if(!$global->product_order->create_product_sprice_range($create_arr)){
		$global->product_order->error_message($global->product_order->err_msg);
		}
}

//update product_sprice_level
//clear current
$global->db_delete("product_sprice_level","product_code='".$product_code."'");
$customer_level_code = $_POST['customer_level_code_hidden'];
$product_sprice_level_price = $_POST['product_sprice_level_price_hidden'];
foreach( $customer_level_code as $key => $customer_level_code_val ) {
	$create_arr = array(
	'product_code'=>	$product_code,
	'customer_level_code'=>	$customer_level_code_val,
	'product_sprice_level_price'=>	$product_sprice_level_price[$key],
	);
	//create product_sprice_level
	if(!$global->product_order->create_product_sprice_level($create_arr)){
		$global->product_order->error_message($global->product_order->err_msg);
		}
}

Header("location: product.php?confirm=".$form_header_lang['edit_button']);
exit;
}
?>