<?php
header("Content-type: text/html; charset=utf-8");
require_once('Controller.controller.php');

$dorm = getPost('dorm');
$dormNumber = getPost('dormNumber');
$phonenumber = getPost('phonenumber');
$number = getPost('number');
// $color = getPost('color');
// $size = getPost('size');
$color = 1;
$size = 1;
$isChecked = getPost('isChecked');
$productCode = getPost('productCode');
$price = getPost('totalPrice');

$address = $dorm.'@'.$dormNumber;
$orderID = getRandOrderID();

$m = new controller;
$sellable = checkProductBalance($productCode, $number);

if ($sellable != 1) {
	echo json_encode( array('fine' => 0) );
	exit();
}

$order = array(
	'orderID' => $orderID,
	'productCode' => $productCode,
	'address' => $address,
	'price' => $price,
	'size' => $size,
	'color' => $color,
	'number' => $number,
	'phone' => $phonenumber,
	'isChecked' => $isChecked,
	'info' => 'aaaaaa',
	'orderStatus' => 0,
	'time' => 'now()'
	);

$opening = 1; 
if ($opening == 1) {
	$res = $m->add('fox_order', $order);
	if ($res >= 1) {
		echo json_encode( array('fine' => 1, 'orderID' => $orderID) );
	}else{
		echo json_encode( array('fine' => -1) );
	}
}else{
	echo json_encode( array('fine' => 0) );
}





function getPost($name){
	$res = isset($_POST[$name])? $_POST[$name] : null;
	return $res;
}

function getRandOrderID(){
	$longID = uniqid( rand (), true );
	$shortID = substr($longID, 0, 6);
	return $shortID;
}

function checkProductBalance($code, $number){
	global $m;
	$sql = "select * from fox_productInfo where code = $code;";
	$res = $m->cquery($sql);

	$data = $res->fetch_array();

	if(count($data) == 0){
		return -1;
	}else{
		$oldBalance = $data['balance'];
		$newBalance = $oldBalance - $number;
		if ($newBalance >= 0) {
			$e_row = $m->updateBalance($newBalance, $code);
			if($e_row == 1){
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
}

?>