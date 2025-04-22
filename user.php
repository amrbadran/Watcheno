<?php 
	include('functions.php');
	session_start();
	
	$username_get = addslashes($_GET['username']);


	if(!isset($_GET['username'])){
		header("Location: 404.php");
	}
	$sql = "SELECT * FROM users WHERE username='$username_get'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	if($stmt->rowCount() == 1){
		while($row = $stmt->fetch()){

			$username = $row['username'];
			$user_pic = $row['user_pic'];
			$user_glaf = $row['user_glaf'];
		}
	}else{
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
	<body dir='rtl' class='user'>
		
<?php include('header_home.php');?>
		<div class='home-user'>
			<div class='container'>
				<?php 
					$img_check = $user_glaf;
					if(empty($user_glaf)){
						$sql_remove = "UPDATE users set user_glaf='' WHERE user_glaf='$user_glaf'";
						$conn->exec($sql_remove);
						
						?>
						<div class='user-profile-pic' style='background-image:url("images/watcheno-about.jpg");'>
						<?php
					}else if(getimagesize($img_check) === false){
						$sql_remove = "UPDATE users set user_glaf='' WHERE user_glaf='$user_glaf'";
						$conn->exec($sql_remove);
						unlink($user_glaf);
					}
					else{
						?>
						<div class='user-profile-pic' style='background-image:url("<?php echo $user_glaf;?>");'>
						<?php
					}
				?>
				
				<?php 

					if($username_get == $_SESSION['logged_in']){
						?>
						<form class='upload_change_glaf'>
								<input name='glaf_change' type='file' id='user-glaf-change-button'/>
						</form>
						<button class='change-user-glaf'><i class='fa fa-camera'></i></button>
						<?php
					}
				?>
				
					<div class='user-pic text-center'>
						<?php

							$sql = "SELECT * FROM users WHERE username='$username'";
							$stmt = $conn->prepare($sql);
							$stmt->execute();
							if($stmt->rowCount() == 1){
								while($row = $stmt->fetch()){

									$username = $row['username'];
									$user_pic = $row['user_pic'];
									$user_glaf = $row['user_glaf'];
								}
							}
							$img_check2 = $user_pic;
							if(empty($user_pic) || getimagesize($img_check2) === false){

								$sql_remove = "UPDATE users set user_pic='' WHERE user_pic='$user_pic'";
								$conn->exec($sql_remove);
								unlink($user_pic);
								?>

								<img src="images/user.png" width='200' height='200'>
								<?php
							}else{

								?>

								<img src="<?php echo $user_pic;?>" width='200' height='200'>
								<?php
							}

						?>
						
						<?php 
							if($username_get == $_SESSION['logged_in']){
								?>
								<div class='change-pic' style='display:none;'>
									<form class='upload_change_pic'>
										<input name='img_change' type='file' id='user-pic-change-button'/>
									</form>
									<i class='fa fa-camera'></i>
								</div>
								<?php
							}
						?>
						
					</div>
				</div>
				<div class='user-name text-center'>
					<h2><?php echo $username;?></h2>
					<?php 
						$username_follower = $_SESSION['logged_in'];
						$username_followed = $username;
						$sql = "SELECT * FROM follow WHERE username_followed='$username_followed' AND username_follower='$username_follower'";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						if($stmt->rowCount() == 1){
							?>
							<input type="hidden" class="video_username" value="<?php echo $username;?>">
							<button class='follow-user-button followed'>الغاء المتابعة</button>
							<?php
							}else{
								?>
								<input type="hidden" class="video_username" value="<?php echo $username;?>">
								<button class='follow-user-button'>متابعة <i class='fa fa-user-plus'></i></button>
								<?php
							}

					?>
				</div>
				<div class='user-stat row'>
					<div class='col-md-4 text-center'>
						<h4>عدد المتابعين</h4>
						<?php
							$sql_followers = "SELECT * FROM follow WHERE username_followed='$username'";
							$stmt_followers = $conn->prepare($sql_followers);
							$stmt_followers->execute();


						?>
						<span><?php echo $stmt_followers->rowCount(); ?></span>	
					</div>
					<div class='col-md-4 text-center'>
						<h4>عدد الفيديوهات</h4>
						<?php
							$sql_videos = "SELECT * FROM videos WHERE video_username='$username'";
							$stmt_videos = $conn->prepare($sql_videos);
							$stmt_videos->execute();


						?>
						<span><?php echo $stmt_videos->rowCount(); ?></span>	
					</div>
					<div class='col-md-4 text-center'>
						<h4>عدد الاعجابات</h4>
						<?php 
							$sql_likes = "SELECT * FROM likes WHERE username_liked='$username'";
							$stmt_likes = $conn->prepare($sql_likes);
							$stmt_likes->execute();
						?>
						<span><?php echo $stmt_likes->rowCount(); ?></span>	
					</div>
				</div>
				<div class='row cards-user'>
					<?php 

						$sql = "SELECT * FROM videos WHERE video_username='$username'";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						while($row = $stmt->fetch()){
							$video_id = $row['id'];
							$video_src = $row['video_src'];
							$video_title = $row['video_title'];
							$video_thumbnail = $row['video_thumbnail'];
							$video_active = $row['active'];
							$video_views = $row['views_count'];
							$video_href = "watch.php?id=" . $video_id;
							if($video_active == 'publish'){
								?>
									<div class='col-md-3'>

										<a href="<?php echo $video_href;?>"><div class='card'>
											<?php 

												if(empty($video_thumbnail)){
													?>
													<video id="video-thumbnail" controls="controls" style='display: none;'>
														<source src="<?php echo $video_src;?>" style='display: none;'>
													</video>
													<img src="" class='card-img ca'>
													<?php
												}else{
													?>
													<img src="<?php echo $video_thumbnail;?>" class='card-img'>
													<?php
												}

											?>
											
											<div class='card-body'>
												<div class='card-title'>
													<a href="<?php echo $video_href;?>"><?php echo $video_title;?></a>
												</div>
												<p class='card-text'><?php echo $video_views;?> مشاهدة</p>
											</div>
										</div></a>
									</div>
								<?php
							}
						}

					?>
					
					
				</div>
			</div>

			</div>
			
		</div>
		

		<script src='js/jQuery.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src='js/bootstrap.js'></script>

		<script src='js/main.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js'></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
	</body>
</html>