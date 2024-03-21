<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$travel_id = $_POST['travel_id'];
		$logo = $_POST['logo'];
		$title = $_POST['title'];
		$introduce = $_POST['introduce'];
		$days = $_POST['days'];
		$price = $_POST['price'];
		$time = $_POST['time'];
		$airport = $_POST['airport'];
		$seat = $_POST['seat'];
		$number = $_POST['number'];
		$sale = $_POST['sale'];
		$sign_up = $_POST['sign_up'];
		$sql = "UPDATE travel_ SET logo = '$logo', title = '$title', introduce = '$introduce', days = '$days', price = '$price', time = '$time', airport = '$airport', seat = '$seat', number = '$number', sale = '$sale', sign_up = '$sign_up' WHERE travel_id = '$travel_id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = '編輯成功';
		}
		
		else{
			$_SESSION['error'] = 'Something went wrong in updating itinerary';
		}
	}
	else{
		$_SESSION['error'] = 'Select item to edit first';
	}

	header('location: index.php');

?>