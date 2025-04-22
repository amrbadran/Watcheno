<?php

	include("config.php");

	session_start();

	if(!isset($_SESSION['logged_in'])){

		echo 0;

	}else{

		$comment_id = addslashes($_POST['comment_id']);

		if(empty($comment_id)){

			header("Location: 404.php");

		}else{

			$username = $_SESSION['logged_in'];

			$sql2 = "UPDATE comments SET likes_count=likes_count+1 WHERE id='$comment_id'";

			$conn->exec($sql2);


			$sql = "INSERT INTO likes(comment_id,username) VALUES('$comment_id','$username')";

			if($conn->exec($sql)){

				echo 1;

			}
			
		}

	}

?>