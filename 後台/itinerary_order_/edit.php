<?php
session_start();
include_once('connection.php');

if (isset($_POST['edit'])) {
	$order_group_id = $_POST['order_group_id'];
	$travel_id = $_POST['travel_id'];
	$amount = $_POST['amount'];
	$deposit = $_POST['deposit'];
	$deposit_date = $_POST['deposit_date'];
	$final_payment = $_POST['final_payment'];
	$final_payment_date = $_POST['final_payment_date'];
	$pay = $_POST['pay'];
	$information = $_POST['information'];
	$member_id = $_POST['member_id'];
	$detail_id = $_POST['detail_id'];
	$sql = "UPDATE order_group SET travel_id = '$travel_id', amount = '$amount', deposit = '$deposit', deposit_date = '$deposit_date', final_payment = '$final_payment', final_payment_date = '$final_payment_date', pay = '$pay', information = '$information', member_id = '$member_id', detail_id = '$detail_id' WHERE order_group_id = '$order_group_id'";

	//use for MySQLi OOP
	if ($conn->query($sql)) {
		$_SESSION['success'] = '編輯成功';
	}

	else {
		$_SESSION['error'] = 'Something went wrong in updating travel';
	}
} else {
	$_SESSION['error'] = 'Select item to edit first';
}

header('location: itinerary_order.php');

?>