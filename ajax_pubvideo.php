
<?php 
	
	include('config.php');

	$video_key = addslashes($_POST['video_key']);

	$sql = "UPDATE videos SET active='publish' WHERE id='$video_key'";

	if($conn->exec($sql)){

		echo $video_key;
		setcookie("none2",$video_key,time() - 86400,"/");

	}
	
?>