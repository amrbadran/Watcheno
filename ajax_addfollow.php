<?php 
	
	include('config.php');
	session_start();
	$username_followed = addslashes($_POST['username']);
	$username_follower = $_SESSION['logged_in'];
	if(empty($username)){

		header("Location : 404.php");

	}

	
	if(!isset($_SESSION['logged_in'])){

		echo 0;

	}else{
		$sql = "INSERT INTO follow(username_follower,username_followed) VALUES('$username_follower','$username_followed')";
		if($conn->exec($sql)){
			echo 1;
		}
	}
	
?>