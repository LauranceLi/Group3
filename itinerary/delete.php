<?php
	session_start();
	include_once('connection.php');

	if(isset($_GET['travel_id'])){
		$sql = "DELETE FROM travel_ WHERE travel_id = '".$_GET['travel_id']."'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = '刪除成功';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting itinerary';
		}
	}
	else{
		$_SESSION['error'] = 'Select itinerary to delete first';
	}

	header('location: index.php');
?>