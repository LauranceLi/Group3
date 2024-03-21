<?php
session_start();
include_once('connection.php');


	if (isset($_POST['add'])) {
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
		$sql = "INSERT INTO travel_ (logo, title, introduce, days, price, time, airport, seat, number, sale, sign_up) VALUES ('$logo', '$title', '$introduce', '$days', '$price', '$time', '$airport', '$seat', '$number', '$sale', '$sign_up')";

		//use for MySQLi OOP
		if ($conn->query($sql)) {
			$_SESSION['success'] = '新增成功';
		} else {
			$_SESSION['error'] = '新增失敗';
		}
	} else {
		$_SESSION['error'] = 'Fill up add form first';
	}

 header('location: index.php');
