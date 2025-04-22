<?php 

	include ('config.php');
	$video_key = addslashes($_POST['video_key']);

	setcookie("none",$video_key,time() - 86400,"/");
	setcookie("none2",$video_key,time() - 86400,"/");	


	$sql = "SELECT video_src,video_thumbnail FROM videos WHERE id='$video_key'";

	$stmt = $conn->prepare($sql);

	$stmt->execute();

	$video_thumbnail_delete = "";
	$video_src_delete = "";
	while($row = $stmt->fetch()){

		$video_thumbnail_delete = $row['video_thumbnail'];
		$video_src_delete = $row['video_src'];

	}

	if (file_exists($video_thumbnail_delete)) {
		unlink($video_thumbnail_delete);
	}
		if (file_exists($video_src_delete)) {
			unlink($video_src_delete);
		}

	
	$sql = "DELETE FROM videos WHERE id='$video_key'";

	if($conn->exec($sql)){

		echo 1;

	}

	
?>