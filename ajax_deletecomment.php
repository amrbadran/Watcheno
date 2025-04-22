<?php 
	session_start();
	include("config.php");
	$username = $_SESSION['logged_in'];
	$comment_id = $_POST['comment_id'];
	if(empty($comment_id)){

		header("Location : 404.php");

	}

	
	if(!isset($_SESSION['logged_in'])){

		echo 0;

	}else{

		$sql = "DELETE FROM comments WHERE id='$comment_id'";
		if($conn->exec($sql)){

			echo 1;

		}else{
			echo 0;
		}

	}
	

?>