<?php 
include('functions.php'); 
include('session.php');
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
				<a class='navbar-brand' href="">
					<img width='90' src='images/logo.png' alt='Watcheno'/>	
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