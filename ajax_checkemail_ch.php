<?php 
	session_start();
	include('config.php');

	$email = addslashes($_POST['email_change']);
	$username_session = $_SESSION['logged_in'];
	$_SESSION['email_logged'] = $email;

	$sql = "UPDATE users SET active='0' WHERE username='$username_session'";

	$conn->exec($sql);
?>