<?php 
	include('functions.php');
	session_start();
	if(!isset($_SESSION['logged_in'])){
		header("Location: index.php");
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
	<body dir='rtl' style='background:#EEE;'>
		<?php include('header_home.php');?>
		<div class='home-settings'>
			<div class='container text-right'>
				<h4>اعدادت حسابك على <span>ووتشينو</span></h4>
				<form class='row settings-form'>
					<?php 
						$username_now = $_SESSION['logged_in'];
						$sql = "SELECT * FROM users WHERE username='$username_now'";
						$stmt = $conn->prepare($sql);
						$stmt->execute();

						while($row = $stmt->fetch()){

							$first_name = $row['first_name'];
							$last_name = $row['last_name'];
							$username = $row['username'];
							$email = $row['email'];
							$password = $row['password'];
							$date_signup = $row['date_signup'];
							$active_status = $row['active'];
							$active_code = $row['active_code'];

						}

					?>
					<input type="hidden" class='email-check-input' value='<?php echo $email;?>'>
					<div class='form-group col-md-6'>
						<label for='first_name_settings'>الاسم الاول</label>
						<input type="text" name="first_name_settings" id='first_name_settings' class='form-control' value="<?php echo $first_name;?>">
					</div>
					<div class='form-group col-md-6'>
						<label for='last_name_settings'>الاسم الاخير</label>
						<input type="text" name="last_name_settings" id='last_name_settings' class='form-control' value="<?php echo $last_name;?>">
					</div>
					<div class='form-group col-md-12'>
						<label for='user_name_settings'>اسم المستخدم</label>
						<input type="text" name="user_name_settings" id='user_name_settings' class='form-control' value="<?php echo $username;?>">
					</div>
					<div class='form-group col-md-12'>
						<label for='email_settings'>البريد الالكتروني</label>
						<input type="email" name="email_settings" id='email_settings' class='form-control' value="<?php echo $email;?>">
						<?php 
							if($active_status){
								?>
								<button class='active_button' disabled>
									مفعل 
								</button>
								<?php
							}else{
								?>
								<button class='active_button'>
									تفعيل							
								</button>
								<?php
							}
						?>
						
					</div>
					<div class='form-group col-md-6'>
						<label for='password_settings'>كلمة السر الجديدة</label>
						<input type="password" name="password_settings" id='password_settings' class='form-control'>
					</div>
					<div class='form-group col-md-6'>
						<label for='re_password_settings'>اعادة كتابة كلمة السر الجديدة</label>
						<input type="password" name="re_password_settings" id='re_password_settings' class='form-control'>
					</div>
					<div class='form-group col-md-12 text-left'>
						<button type='button' class='btn white button_submit_settings' style='background:#b6172a;'>
							تحديث
							<i class='fa fa-pencil'></i>
						</button>
					</div>
					<div class='col-md-12'>
						<div class='alert alert-success' style='display:none;'>
							مبروك ! لقد تم تحديث معلومات حسابك
						</div>
						<div class='alert alert-danger' style='display:none;'>
							عذرا ! حدث خطا ما
						</div>
					</div>
					<div class='col-md-12'>
						<label>
							* عضو منذ <?php echo $date_signup; ?>
						</label>
					</div>
				</form>
			</div>
		</div>
		<script src='js/jQuery.js'></script>
		<script src='js/bootstrap.js'></script>
		<script src='js/main.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js'></script>
	</body>
</html>