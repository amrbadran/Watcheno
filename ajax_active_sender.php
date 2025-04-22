<?php 
	session_start();
	include('config.php');
	$username_session = $_SESSION['logged_in'];
	$sql = "SELECT active_code,active FROM users WHERE username='$username_session'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	while($row = $stmt->fetch()){

		$active_code = $row['active_code'];
		$active_status = $row['active'];

	}
	$active_link = "localhost/watcheno/active.php?a=".$active_code;	
	$to = $_SESSION['email_logged'];
	$subject = "تفعيل حسابك على منصة ووتشينو";
	$message = "<html><a href='$active_link'>تفعيل الان</a></html>";
	$headers = 'From: Watcheno.com' . "\r\n" .
	'To: '. $to . "\r\n";
	if(mail($to,$subject,$message,$headers)){
		echo 1;
	}else{
		echo 0;
	}
?>