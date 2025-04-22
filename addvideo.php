<?php 
	include('functions.php');
	session_start();
	if(!isset($_SESSION['logged_in'])){
		header("Location: index.php");
	}
	$status_video_none = isset($_COOKIE['none']) ? $_COOKIE['none'] : null;
	$status_video_none2 = isset($_COOKIE['none2']) ? $_COOKIE['none2'] : null;
	if(isset($status_video_none)){

		$redirect_to_video = "comvideo.php?id=".$status_video_none;
		?>
		<input type="hidden" value='<?php echo $redirect_to_video; ?>' id='none_video'>
		<script type="text/javascript">
			var none_video = document.getElementById('none_video').value;
			window.location.replace(none_video);
		</script>
		<?php

	}
	else if(isset($status_video_none2)){

		$redirect_to_video = "pubvideo.php?id=".$status_video_none2;
		?>
		<input type="hidden" value='<?php echo $redirect_to_video; ?>' id='none_video'>
		<script type="text/javascript">
			var none_video = document.getElementById('none_video').value;
			window.location.replace(none_video);
		</script>
		<?php

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
		<div class='home-addvideo'>
			<div class='container text-right'>
				<?php 
				
					$get_option = isset($_GET['option']) ? $_GET['option'] : null;
				?>
				<h4>اضف فيديو الى <span>ووتشينو</span></h4>
				<?php 

					if(empty($get_option) || !isset($get_option)){ ?>

							<form id='upload_form' action='addvideo.php' method='POST' enctype="multipart/form-data">
								<div class='form-group d-flex align-items-center justify-content-center video1'>
									<input type='file' name='video' title='' class='video-file' id='video'/>
									<span class='span video1'><i class='fa fa-upload'></i></span>
								</div>
								<div id="loader-icon" style="display:none;" class='video1'><img src="images/loader.gif" /></div>
								<div class='a video1'>
									
								</div>
								<div class='form-group text-left video1'>
									<button type='button' class='btn btn-danger cancel-button' data-toggle="modal" data-target="#myModal" style='display:none;'>الغاء</button>
									<button type='button' class='btn btn-success next'  style='display: none;'>التالي</button>

								</div>
								
							</form>

						<?php
					} /*else if(!empty($get_option)){ 

							$username_session = $_SESSION['logged_in'];
							$sql = "SELECT video_username,active FROM videos WHERE id='$get_option'";
							$stmt = $conn->prepare($sql);
							$stmt->execute();
							if($stmt->rowCount() == 1){
								while($row = $stmt->fetch()){
									$username = $row['video_username'];
									$active_video = $row['active'];
								}
								if(!($username_session == $username) || $active_video == 'publish'){
									echo "<script>window.location.replace('404.php');</script>";
								}
							}else{
								echo "<script>window.location.replace('404.php');</script>";
							}*/

						?>

						<!--<form class='complete_video' enctype="multipart/form-data">
							<input name='video_key' type="hidden" value="<?php echo $get_option;?>" id="video_key2">
					<div class='form-group video2'>
						<label for='title-video'>عنوان الفيديو  *</label>
						<input type="text" name="title_video" class='form-control' id='title-video'>
					</div>
					<div class='form-group video2'>
						<label for='descr-video'>وصف الفيديو</label>
						<textarea name='descr_video' class='form-control' id='descr-video'></textarea>
					</div>
					<div class='form-group video2'>
						<label for='thumbnail-video'>الصورة المصغرة</label>
						<input type="file" class='form-control' name="thumbnail_video" id='thumbnail-video'>
					</div>
					
					<div class='aa'></div>
					<div class='form-group video2 text-left upload'>
						<button class='btn btn-success'>تحميل</button>
					</div>
				</form>-->

						<?php
				//	}

				?>
				
				
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