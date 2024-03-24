<?php
	//for MySQLi OOP
	$conn = new mysqli('localhost', 'the_travel_project', '', 'the_travel_project');
	if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
	}
	////////////////

	//for MySQLi Procedural
	// $conn = mysqli_connect('localhost', 'root', '', 'mydatabase');
	// if(!$conn){
	//     die("Connection failed: " . mysqli_connect_error());
	// }
	////////////////
?>