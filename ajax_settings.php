<?php 
	session_start();
	include('config.php');
	
	$first_name = addslashes($_POST['first_name_settings']);
	$last_name = addslashes($_POST['last_name_settings']);
	$username = addslashes($_POST['user_name_settings']);
	$email = addslashes($_POST['email_settings']);
	$password = addslashes($_POST['password_settings']);
	$username_session = $_SESSION['logged_in'];

	if(empty($first_name)){

		echo '<script>window.location.replace("404.php");</script>';

	}
	if(empty($password)){
		$sql = "UPDATE users SET first_name='$first_name',last_name='$last_name',username='$username',email='$email' WHERE username='$username_session'";
	}else{
		$password2 = md5(addslashes($_POST['password_settings']));
		$sql = "UPDATE users SET first_name='$first_name',last_name='$last_name',username='$username',email='$email',password='$password2' WHERE username='$username_session'";
	}
	

	if($conn->exec($sql)){
		echo 1;
	}
	else{
		echo 0;
	}
?>