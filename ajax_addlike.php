<?php 
	include("config.php");
	session_start();
	if(!isset($_SESSION['logged_in'])){
		echo 0;
	}else{
		$video_id = addslashes($_POST['video_id']);
		$sql_get_username = "SELECT video_username FROM videos WHERE id='$video_id'";
		$stmt = $conn->prepare($sql_get_username);
		$stmt->execute();
		while($row = $stmt->fetch()){
			$username_liked = $row['video_username'];
		}
		if(empty($video_id)){
			header("Location: 404.php");
		}else{

			$username = $_SESSION['logged_in'];

			$sql2 = "UPDATE videos SET likes_count=likes_count+1 WHERE id='$video_id'";
			$conn->exec($sql2);


			$sql = "INSERT INTO likes(video_id,username,username_liked) VALUES('$video_id','$username','$username_liked')";
			if($conn->exec($sql)){

				echo 1;

			}
			
		}
	}

?>