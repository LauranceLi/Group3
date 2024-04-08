<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$picture = $_POST['picture'];
		$product_Id = $_POST['product_Id'];
		$product = $_POST['product'];
		$price = $_POST['price'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$sql = "INSERT INTO products (picture,product_Id, product, price,title,description) VALUES ('$picture','$product_Id', '$product', '$price','$title','$description')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = '新增成功';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member added successfully';
		// }
		//////////////
		
		else{
			$_SESSION['error'] = '沒有新增成功';
		}
	}
	else{
		$_SESSION['error'] = '先填寫表格';
	}


	header('location: products.php');
