<?php

	$servername = "localhost";
	$db_name = "amrbadra_watcheno";
	$username = "root";
	$password = "12345678";
	$conn;
	try{
		$conn = new PDO("mysql:host=$servername;dbname=$db_name",$username,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		 echo "Connection failed: " . $e->getMessage();
	}