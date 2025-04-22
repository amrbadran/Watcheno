<?php 
	include('config.php');
	session_start();
	$username = addslashes($_POST['username']);
	$password = md5(addslashes($_POST['password']));
	$sql = $conn->prepare("SELECT username,email,password FROM users WHERE username='$username' OR email='$username'");
	$sql->execute();
	$username_after = "";
	$email_after = "";
	$password_after = "";
	while($row = $sql->fetch()){
		$username_after = $row['username'];
		$email_after = $row['email'];
		$password_after = $row['password'];
	}

	if(($username == $username_after || $username == $email_after) && $password == $password_after){
		$_SESSION['logged_in'] = $username_after;
		$_SESSION['email_logged'] = $email_after;
		echo 1;
	}else{
		echo 0;
	}
	
?>