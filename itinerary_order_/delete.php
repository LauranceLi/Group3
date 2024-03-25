<?php
	session_start();
	include_once('connection.php');

	if(isset($_GET['order_group_id'])){
		$sql = "DELETE FROM order_group WHERE order_group_id = '".$_GET['order_group_id']."'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = '刪除成功';
		}
		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting order';
		}
	}
	else{
		$_SESSION['error'] = 'Select order to delete first';
	}

	header('location: itinerary_order.php');
?>