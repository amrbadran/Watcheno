<?php 
	include('functions.php');
	session_start();
	if(!isset($_SESSION['logged_in'])){
		header("Location: index.php");
	}
	$video_key = addslashes($_GET['id']);

	?>
	<input type="hidden" id="video_key22" value='<?php echo $video_key; ?>'>
	<?php
		$stmt = $conn->prepare("SELECT id,video_username,active FROM videos WHERE id='$video_key'");
		$stmt->execute();
		$video_username_org = "";
		$video_active_org = "";
		while($row = $stmt->fetch()){
			$video_username_org = $row['video_username']; 
			$video_active_org = $row['active'];
		}
		if(!isset($video_key) || !$stmt->rowCount() == 1 || $video_username_org != $_SESSION['logged_in'] ):

			echo "<script>window.location.replace('404.php');</script>";

		endif;

		if ($video_active_org == 'none'):

			?>
			<script>
				var video_key22 = document.getElementById('video_key22').value;
				window.location.replace('comvideo.php?id='+video_key22);
			</script>
			<?php


		endif;

		if ($video_active_org == 'publish'):

			?>
			<script>
				var video_key22 = document.getElementById('video_key22').value;
				window.location.replace('watch.php?id='+video_key22);
			</script>
			<?php


		endif;
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
	<body dir='rtl' style="background:#EEE;">
		<div id="myModal" class="modal fade" role="dialog" dir='rtl'>
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		      	<h4>هل انت تؤكد على الغاء هذه العملية </h4>
		        <button type="button" class="close" data-dismiss="modal" style='text-align:left !important;padding:0 !important;margin:0 !important;'>&times;</button>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal" style='margin-left:5px;'>اغلاق</button>
		        <button type='button' class='btn btn-danger delete-video'>تاكيد</button>
		      </div>
		    </div>

		  </div>
		</div>
		<div class='home-addvideo text-center'>
			<img src="images/logo.png" alt='ووتشينو' width='150' height='150'>
			<div class='container text-right' style='margin-top:0;'>
				<div class='row pub-video'>

					<input type="hidden" class='video-key' value="<?php echo $video_key;?>">
					<?php 

						$stmt = $conn->prepare("SELECT * FROM videos WHERE id='$video_key'");
						$stmt->execute();
						while($row = $stmt->fetch()){

							$video_title = $row['video_title'];
							$video_descr = $row['video_descr'];
							$video_thumbnail = $row['video_thumbnail'];
							$video_src = $row['video_src'];

						}

					?>
					<div class='col-md-12'>
						<div class='alert alert-success'>
							مبروك ! تمت اضافة الفيديو الخاص بك الى موقعنا
						</div>
					</div>
					<div class='col-md-12'>
						<div class='bold'>عنوان الفيديو الخاص بك</div>
						<div><?php echo $video_title;?></div>
					</div>
					<div class='col-md-12'>
						<div class='bold'>وصف الفيديو الخاص بك</div>
						<div><?php echo $video_descr;?></div>
					</div>
					<div class='col-md-12'>
						<?php 
							if(!empty($video_thumbnail)):
								?>
								<div class='bold'>الصورة المصغرة </div>
								<img src="<?php echo $video_thumbnail; ?>" alt='' width='250' height='200'/>
								<?php
							endif;
						?>
						
					</div>
					<div class='col-md-12'>
						<video width='300' height='300' controls>
							<div class='bold'>الفيديو</div>
							<source src="<?php echo $video_src; ?>">
						</video>
					</div>
					<div class='col-md-12 text-left'>
						<button type='button' class='btn btn-danger cancel-button' data-toggle="modal" data-target="#myModal">الغاء</button>
						<button type='button' class='btn btn-success publish-video-button'>نشر</button>
					</div>
				</div>	
			</div>
		</div>
		<script src='js/jQuery.js'></script>
		<script src='js/bootstrap.js'></script>
		<script src='js/main.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js'></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
	</body>
</html>