<?php
require('connection.inc.php');
require('functions.inc.php');
require('addToCart.inc.php');

$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);

$obj=new addToCart();

if($type=='add'){
	$obj->addProduct($pid,$qty);
}

if($type=='remove'){
	$obj->removeProduct($pid);
}

if($type=='update'){
	$obj->updateProduct($pid,$qty);
}

echo $obj->totalProduct();
?>