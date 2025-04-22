<?php 

	
	include("config.php");
	session_start();
	if(!isset($_SESSION['logged_in'])){
		echo 0;
	}else{

		$video_id = addslashes($_POST['video_id']);
		if(empty($video_id)){
			header("Location: 404.php");
		}else{

			$username = $_SESSION['logged_in'];

			$sql2 = "UPDATE videos SET likes_count=likes_count-1 WHERE id='$video_id'";
			$conn->exec($sql2);


			$sql = "DELETE FROM likes WHERE video_id='$video_id' AND username='$username'";
			if($conn->exec($sql)){

				echo 1;

			}
			

		}
		
}	
	
?>