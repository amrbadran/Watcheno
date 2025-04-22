<?php 
	include('functions.php');
	session_start();
	if(!isset($_SESSION['logged_in'])){
		header("Location: index.php");
	}
	$username_session = $_SESSION['logged_in'];
	$sql = "SELECT active FROM users WHERE username='$username_session'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	while($row = $stmt->fetch()){
		$active_status = $row['active'];
	}
	if($active_status){
		header("Location: 404.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ووتشينو - اول  منصة  فيديوهات عربية</title>
		<meta charset="utf-8">
		<link rel="icon" href="images/logo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Cairo|El+Messiri|Markazi+Text&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body dir='rtl' style='background:#EEE'>
		<?php include('header_home.php');?>
		<div class='home-active-sender'>
			<div class='container text-right'>
				<div class='form-group text-center'>
					<img src='images/logo.png' width='150' height='150'/>
				</div>
				<div>مرحبا <?php echo $username_session; ?></div>
				<p>
					نحن ووتشينو وانت هنا في صفحة ارسال التفعيل الى بريدك الالاكتروني اذا كنت تريد التفعيل فقط قم بالضغط على زر الارسال
				</p>
				<div class='form-group text-center'>
					<button class='btn btn-primary button-active-sender'>ارسال رسالة التفعيل</button>
				</div>
				<div class='form-group text-center'>
					<div class='alert alert-success' style='display:none;'>
						لقد تم ارسال رسالة التفعيل الى الايميل الخاص بك رجاء تفقد صندوق الspam وصندوق العادي
					</div>
					<div class='alert alert-danger' style='display:none;'>
						عذرا ! حدث خطا ما
					</div>
				</div>
			</div>
		</div>
		<script src='js/jQuery.js'></script>
		<script src='js/bootstrap.js'></script>
		<script src='js/main.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js'></script>
	</body>
</html>