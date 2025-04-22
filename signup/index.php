<?php 
	include('../functions.php');
	include('../session.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ووتشينو - اول  منصة  فيديوهات عربية</title>
		<meta charset="utf-8">
		<link rel="icon" href="../images/logo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Cairo|El+Messiri|Markazi+Text&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body dir='rtl'>
		<div id="myModal" class="modal fade" role="dialog" dir='rtl'>
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        
		        <h4 class="modal-title">تسجيل الدخول</h4>
		        <button type="button" class="close" data-dismiss="modal" style='text-align:left !important;padding:0 !important;margin:0 !important;'>&times;</button>
		      </div>
		      <div class="modal-body">
		        <form class='signin-form'>
		        	<div class='form-group signin-notfaction'>
		        		حدث خطا ما
		        	</div>
		        	<div class='form-group'>
		        		<input class='form-control username-signin' name='username' type='text' placeholder='اسم المستخدم او البريد الالكتروني' />
		        	</div>
		        	<div class='form-group'>
		        		<input class='form-control password-signin' name='password' type='password' placeholder='كلمة السر' />
		        	</div>
		        	<div class='form-group text-center'>
		        		<input class='form-control btn bg-main-color white submit-signin' type='submit' value='دخول'/>
		        	</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">اغلاق</button>
		      </div>
		    </div>

		  </div>
		</div>
		<header>
			<nav class='navbar navbar-expand-md'>
				<a class='navbar-brand' href="../">
					<img width='90' src='../images/logo.png' alt='Watcheno'/>	
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="fa fa-bars white"></span>
				</button>
				<div class='collapse navbar-collapse text-center' id='navbarcollapse'>
					<ul class='navbar-nav'>
						<li class='nav-item'>
							<a href="" class='nav-link'>الصفحة الرئيسية</a>
						</li>
						<li class='nav-item'>
							<a href="" class='nav-link'>عن ووتشينو </a>
						</li>
						<li class='nav-item'>
							<a href="" class='nav-link'>المحتوى الرائج</a>
						</li>
						<li class='nav-item'>
							<a href="" class='nav-link'>اتصل بنا</a>
						</li>
						<li class='nav-item'>
							<a href="" class='nav-link'>عن صاحب الموقع</a>
						</li>
					</ul>
					<button class='mr-auto' data-toggle="modal" data-target="#myModal">تسجيل الدخول</button>
				</div>
			</nav>
		</header>
		<div class='watcheno-signup'>
			<div class='container' style='width:40%;'>
				<div class='row'>
					<div class='col-md-12'>
						<form class='row signup-form'>
							<div class='col-md-12 text-center'>
								<img src='../images/logo.png' alt='' width='150'/>
								<h3>انشاء حساب جديد</h3>
								<div class='signup_notfication'>
									
								</div>
							</div>
							<div class='form-group col-md-6'>
								<input class='form-control first_name' type='text' placeholder='الاسم الاول' name='first_name'/>
								<i class='fa fa-user'></i>
							</div>
							<div class='form-group col-md-6'>
								<input class='form-control last_name' type='text' placeholder='اسم العائلة' name='last_name'/>
								<i class='fa fa-user'></i>
							</div>
							<div class='form-group col-md-12'>
								<input class='form-control username_signup' type='text' placeholder='اسم المستخدم' name='username'/>
								<i class='fa fa-user'></i>
							</div>
							<div class='form-group col-md-12'>
								<input class='form-control email' type='email' placeholder='البريد الالكتروني'
								 name='email'/>
								<i class='fa fa-envelope'></i>
							</div>
							<div class='form-group col-md-12'>
								<input class='form-control password' id='password' type='password' placeholder='كلمة المرور' name='password'/>
								<i class='fa fa-key'></i>
							</div>
							<div class='form-group col-md-12'>
								<input class='form-control rpassword' type='password' placeholder='اعادة كلمة المرور' name='rpassword'/>
								<i class='fa fa-key'></i>
							</div>
							<div class='form-group col-md-12'>
								<input type='submit' class='btn signup_submit' value='تسجيل'/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<footer class='signup-footer'>
			<div class='container text-center'>
				<div class='row'>
					<div class='col-md-12 text-center copyright'>
						<p dir='ltr' class='text-uppercase'>
							&copy; CopyRight Developed By Amr Badran
						</p>
					</div>
				</div>
			</div>
		</footer>
		<script src='../js/jQuery.js'></script>
		<script src='../js/bootstrap.js'></script>
		<script src='../js/main.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js'></script>
	</body>
</html>