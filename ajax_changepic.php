<?php 

	include('config.php');
	session_start();

	$username = $_SESSION['logged_in'];


	$sql_remove = "SELECT user_pic FROM users WHERE username='$username'";
	$stmt_remove = $conn->prepare($sql_remove);
	$stmt_remove->execute();
	while($row = $stmt_remove->fetch()){
		$user_pic_remove = $row['user_pic'];
	}
	if(!empty($user_pic_remove)){
		unlink($user_pic_remove);
	}


	$img_ch_name = $_FILES['img_ch']['name'];
	$img_ch_tmp = $_FILES['img_ch']['tmp_name'];

	$path = explode('.',$img_ch_name);
	$allowed = array("jpg","jpeg","png");
	if(in_array($path[1], $allowed)){

		$dir = 'images/' .uniqid(rand()).'.'.$path[1];

		$sql = "UPDATE users set user_pic='$dir' WHERE username='$username'";
		if($conn->exec($sql)){
			if(move_uploaded_file($img_ch_tmp, $dir)){

				echo $dir;

			}else{
				echo 0;
			}
		}else{
			echo 0;
		}

	}else{

		echo 11;

	}

	

?>