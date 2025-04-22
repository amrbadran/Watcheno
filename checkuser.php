<?php 
	include('config.php');
	$username = addslashes($_POST['username']);

	$sql = $conn->prepare("SELECT username FROM users WHERE username='$username'");
	$sql->execute();

	if($sql->rowCount() == 1){
		echo 'false';
	}else{
		echo 'true';
	}

?>