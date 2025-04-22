<?php 
	session_start();
	include("config.php");
	$username = $_SESSION['logged_in'];
	$video_id = $_POST['video_id'];
	$comment_text = $_POST['comment_text'];
	$comment_code = uniqid(rand());
	
	if(empty($video_id)){

		header("Location : 404.php");

	}

	
	if(!isset($_SESSION['logged_in'])){

		echo 0;

	}else{

		$sql = "INSERT INTO comments(video_id,username,comment_text,date_comment,comment_code) VALUES('$video_id','$username','$comment_text',NOW(),'$comment_code')";
		$done = 0;
		if($conn->exec($sql)){
			$done = 1;

		}
		$sql_id = "SELECT id FROM comments WHERE comment_code='$comment_code'";
			$stmt_id = $conn->prepare($sql_id);
			$stmt_id->execute();
			$flag = 0;
			while($row = $stmt_id->fetch()){
				$id_comment = $row['id'];
				$flag = 1;
			}

			echo $flag;

	}
	

?>