
<?php
	include('config.php');
	session_start();
	$username_session2 = $_SESSION['logged_in'];
	$tmp_name = $_FILES['video']['tmp_name'];
	$ext = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
	$dest = "videos/" . uniqid(rand()) .'.'. $ext;
	$ext_sec = explode('.',$_FILES['video']['name']);

	$ext_allowed = array('mp4','avi');
	if(!in_array($ext_sec[1],$ext_allowed))
	{
		echo 11;
	}else{



	if(move_uploaded_file($tmp_name, $dest)){

		$sql = "INSERT INTO videos(video_src,video_username,active,date_video) VALUES('$dest','$username_session2','none',CURDATE())";
		$conn->exec($sql);

		?>
		<video width="320" height="240" controls>

			<?php 
				if ($ext == 'mp4'){
					?>
					 <source src="<?php echo $dest;?>" type="video/mp4">
					<?php
				} else if($ext == 'avi'){ ?>
					<source src="<?php echo $dest;?>" type="video/avi">

					<?php	
				}
			?>
			 
			  Your browser does not support the video tag.
			</video>
			<img src="" class='card-img ca ca2'>
			<?php 
				$sql = "SELECT id FROM videos WHERE video_src = '$dest'";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				while($row = $stmt->fetch()){
					$id = $row['id'];
				}
				setcookie("none",$id,time() + 86400,"/");
			?>
			<input id='video_key' type="hidden" value='<?php echo $id; ?>'>
			<input class='video-key' type="hidden" value='<?php echo $id; ?>'>
			<?php
	}

}

?>