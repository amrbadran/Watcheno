<?php 
	session_start();
	include('config.php');

	$username = addslashes($_POST['user_name_settings']);
	$username_session = $_SESSION['logged_in'];
	$sql = "SELECT username FROM users WHERE username='$username'";

	$stmt = $conn->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch()){

		$username_after = $row['username'];

	}

	if($username_session != $username_after){
		if($stmt->rowCount() == 1){

			echo 'false';

		}else{
			 echo 'true';
		}
	}

?>