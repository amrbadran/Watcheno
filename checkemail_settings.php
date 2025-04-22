<?php 
	session_start();
	include('config.php');

	$email = addslashes($_POST['email_settings']);
	$email_session = $_SESSION['email_logged'];
	$sql = "SELECT email FROM users WHERE email='$email'";

	$stmt = $conn->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch()){

		$email_after = $row['email'];

	}

	if($email_session != $email_after){
		if($stmt->rowCount() == 1){

			echo 'false';

		}else{
			 echo 'true';
		}
	}

?>