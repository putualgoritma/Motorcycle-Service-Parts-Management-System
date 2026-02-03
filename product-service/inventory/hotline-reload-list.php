<? $path="../../"; ?>
<? include ($path."controller/config-lite-inc.php"); ?>
<? //include ($path."controller/login-sessi.php"); ?>
<?php
$result=array();
$product_orderdetails_discount_val_tot=0;
$result="";
$j=0;
$product_order_code=$_REQUEST['product_order_code'];
$product_order_row=$global->db_row_join("product_order,users","product_order.*,users.users_name,users.users_code","product_order_code='".$product_order_code."' AND product_order_type='ht' AND product_order.users_code=users.users_code");
$product_order_id=$product_order_row['product_order_id'];
$product_orderdetails_list=$global->tbl_list("product_orderdetails","*","product_order_id='".$product_order_id."'","",1);
for($i=0;$i<count($product_orderdetails_list);$i++){
//get bcode
$product_row=$global->product_order->db_row("product","*","product_code='".$product_orderdetails_list[$i]['product_code']."'");

$product_shtquantity=$product_row['product_stock_ht'];
$product_spoquantity=$product_row['product_stock_so'];
$product_quantity=$product_row['product_stock'];
$product_bpoquantity=$product_row['product_stock_po'];
$product_bprice=$product_row['product_bprice'];

$product_scode=$product_row['product_code']." - ".$product_row['product_name'];
//get sub total
$product_orderdetails_price_adisc2=$product_orderdetails_list[$i]['product_orderdetails_price']*(1-(($product_orderdetails_list[$i]['product_orderdetails_discount']+$product_orderdetails_list[$i]['product_orderdetails_disc_final'])/100)+(($product_orderdetails_list[$i]['product_orderdetails_discount']*$product_orderdetails_list[$i]['product_orderdetails_disc_final'])/10000));
$product_orderdetails_subtotal=$product_orderdetails_price_adisc2*$product_orderdetails_list[$i]['product_orderdetails_quantity'];
$product_orderdetails_price_format=$global->num_format2($product_orderdetails_list[$i]['product_orderdetails_price']);
$product_orderdetails_subtotal_format=$global->num_format2($product_orderdetails_subtotal);
//get discount val
$product_orderdetails_discount_val=$product_orderdetails_list[$i]['product_orderdetails_price']*($product_orderdetails_list[$i]['product_orderdetails_discount']/100);
$product_orderdetails_discount_val_format=$global->num_format2($product_orderdetails_discount_val);
$product_orderdetails_discount_val_tot +=(($product_orderdetails_list[$i]['product_orderdetails_price']-$product_orderdetails_discount_val)*($product_orderdetails_list[$i]['product_orderdetails_disc_final']/100))*$product_orderdetails_list[$i]['product_orderdetails_quantity'];

$str_addon="";
if($j>0){
	$str_addon=";";
	}else{
	$result.="xx - xx - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 0 - 0".";";
	}
$result.=$str_addon.$product_row['product_code']." - ".$product_row['product_name']." - ".$product_orderdetails_list[$i]['product_orderdetails_price']." - ".$product_orderdetails_list[$i]['product_orderdetails_discount']." - ".$product_orderdetails_list[$i]['product_orderdetails_quantity']." - ".$product_orderdetails_discount_val." - ".$product_shtquantity." - ".$product_spoquantity." - ".$product_quantity." - ".$product_bpoquantity." - ".$product_order_row['users_code']." - ".$product_order_row['users_name']." - ".$product_bprice;
$j++;
}
echo $result;
?>