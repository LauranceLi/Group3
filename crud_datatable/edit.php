<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$picture= $_POST['picture'];
		$product_Id = $_POST['product_Id'];
		$product = $_POST['product'];
		$price = $_POST['price'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$sql = "UPDATE the_travel_project SET picture = '$picture', product_Id = '$product_Id', product = '$product', price = '$price', title = '$title', description = '$description' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = '資料編輯成功';
		}
		else{
			$_SESSION['error'] = '資料沒有編輯成功';
		}
	}
	else{
		$_SESSION['error'] = 'Select member to edit first';
	}

	header('location: index.php');

