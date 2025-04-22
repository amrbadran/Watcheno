<?php 
	include('config.php');
	$email = addslashes($_POST['email']);

	$sql = $conn->prepare("SELECT email FROM users WHERE email='$email'");
	$sql->execute();

	if($sql->rowCount() == 1){
		echo 'false';
	}else{
		echo 'true';
	}

?>