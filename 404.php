<?php 
	include('functions.php');
	session_start();
	
		
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
	<body dir='rtl' >
<?php include('header_home.php');?>
	<div class='container'>
	<?php 

		$a = isset($_GET['error_ex']) ? $_GET['error_ex'] : null;

		if(!empty($a)){
			?>	
			<div class='alert alert-danger text-right' style='margin-top:35px;'>
				نأسف ! الملف الذي رفعته لم يكن  بصيغة  المطلوبة
			</div>
			<?php
		}else{
			?>
			<div class='text-center' style='margin-top:50px;'>
				<h1 style='font-size:150px;'>404 </h1>	
			</div>
			<?php
		}

	?>
</div>
		<script src='js/jQuery.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src='js/bootstrap.js'></script>

		<script src='js/main.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js'></script>
	</body>
</html>