<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load Composer's autoloader
	include('config.php');
	$first_name = addslashes($_POST['first_name']);
	$last_name = addslashes($_POST['last_name']);
	$username = addslashes($_POST['username']);
	$email = addslashes($_POST['email']);
	$password = md5(addslashes($_POST['password']));
	$random = uniqid(rand());
	$sql = "INSERT INTO users(first_name,last_name,username,email,password,active_code,date_signup) VALUES('$first_name','$last_name','$username','$email','$password','$random',CURDATE())";
	$active_link = "localhost/watcheno/active.php?a=".$random;
	if(!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email) && !empty($password)){
		if ($conn->exec($sql)) {
			

			$to = $email;
			$subject = "تفعيل حسابك على منصة ووتشينو";
			$message = "<a href='$active_link'>تفعيل الان</a>";
			$headers = 'From: Watcheno.com' . "\r\n" .
					    'To: '. $email . "\r\n";
			mail($to,$subject,$message,$headers);	
			
			


			
    		echo "لقد ارسلنا لك رسالة التفعيل في  الايميل الخاص بك رجاء تفقد صندوق البريد وصندوق ال spam";
		}else{
			echo "عذرا حدث خطا ما";
		}
	}
	
?>	