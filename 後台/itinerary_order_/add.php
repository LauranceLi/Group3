<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
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
		$sql = "INSERT INTO order_group (travel_id, amount, deposit, deposit_date, final_payment, final_payment_date, pay, information, member_id, detail_id) VALUES ('$travel_id', '$amount', '$deposit', '$deposit_date', '$final_payment', '$final_payment_date', '$pay', '$information', '$member_id', '$detail_id')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = '新增成功';
		}
		
		else{
			$_SESSION['error'] = 'Something went wrong while adding';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: itinerary_order.php');
?>