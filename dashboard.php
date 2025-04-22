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
	<body dir='rtl' class='body-spinner'>
		<!--<div class='spinner-loading d-flex align-items-center justify-content-center'>
			<img src="images/logo.png" width='150' height='150'>
		</div>-->
<?php include('header_home.php');?>
		<div class='home-body' style='text-align:right'>
			<div class='container' >
				<?php
					if(isset($_SESSION['logged_in'])){
						
					
					$username_session = $_SESSION['logged_in'];
					$sql = "SELECT active FROM users WHERE username='$username_session'";
					$stmt = $conn->prepare($sql);
					$stmt->execute();

					while($row = $stmt->fetch()){
						$active_status = $row['active'];
					}
					if($active_status == 0){ ?>
					 <div class='form-group text-center' style='margin-top:15px'>
					 	<div class='alert alert-danger'>
					 		حسابك غير مفعل على ووتشينو ! <a href="active_sender.php" style='color:inherit;text-decoration: underline;'>تفعيل الان</a>
					 	</div>
					 </div>
					 <?php
					}
				}
				?>
				<h5 style='padding-top:36px;padding-bottom:10px'>الفيديوهات المقترحة</h5>
				<div class='row cards-user'>
					<?php 
							$sql_follow = "SELECT * FROM follow WHERE username_follower = '$username_session'";
							$stmt_follow = $conn->prepare($sql_follow);
							$stmt_follow->execute();
							if($stmt_follow->rowCount() == 0){
								$sql = "SELECT * FROM videos WHERE date_video > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY views_count DESC LIMIT 8";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								while($row = $stmt->fetch()){
											$video_id = $row['id'];
											$video_src = $row['video_src'];
											$video_title = $row['video_title'];
											$video_author = $row['video_username'];
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
																<p class='card-text card-user'><a href='user.php?username=<?php echo $video_author; ?>' style='color:#000;text-decoration: none;'><i class='fa fa-user'></i> <?php echo $video_author; ?></a></p>
																<p class='card-text'><?php echo $video_views;?> مشاهدة</p>
															</div>
														</div></a>
													</div>
												<?php
											}
								}

							}else{
								$array_rand = array();
								$count22 = 0;
								while($row = $stmt_follow->fetch()){

									$username_followed = $row['username_followed'];
									array_push($array_rand,$username_followed);
									$count22++;
								}
								$random_index = array_rand($array_rand,$count22);
								
								for($i = 0;$i<$count22;$i++){

									$b = $array_rand[$i];
									$sql = "SELECT * FROM videos WHERE video_username='$b' AND active='publish' ORDER BY date_video LIMIT 1";
									$stmt = $conn->prepare($sql);
									$stmt->execute();
									while($row = $stmt->fetch()){
											$video_id = $row['id'];
											$video_src = $row['video_src'];
											$video_title = $row['video_title'];
											$video_author = $row['video_username'];
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
																<p class='card-text card-user'><a href='user.php?username=<?php echo $video_author; ?>' style='color:#000;text-decoration: none;'><i class='fa fa-user'></i> <?php echo $video_author; ?></a></p>
																<p class='card-text'><?php echo $video_views;?> مشاهدة</p>
															</div>
														</div></a>
													</div>
												<?php
											}
									}
								}
							}
							
					?>
					
					
				</div>
				<?php 

					$sql = "SELECT * FROM follow WHERE username_follower='$username_session' ORDER BY rand() LIMIT 5";
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					while($row = $stmt->fetch()){

						$username_followed = $row['username_followed'];

						$sql_user = "SELECT username,user_pic FROM users WHERE username='$username_followed'";

						$stmt_user = $conn->prepare($sql_user);
						$stmt_user->execute();

						while($row = $stmt_user->fetch()){
							$username = $row['username'];
							$user_pic = $row['user_pic'];
						}
						$sql_ch = "SELECT * FROM videos WHERE video_username='$username_followed' AND active='publish'";
						$stmt_ch = $conn->prepare($sql_ch);
						$stmt_ch->execute();
						if($stmt_ch->rowCount() > 0){


						?>
						<hr>
						<div class='row'>
							<div class='col-md-12 row user-channel'>
								<div class='col-sm-6 col-6 d-flex align-items-center'>
									<?php

										if(empty($user_pic)){
											?>

											<a href="user.php?username=<?php echo $username;?>" style='color:#000;text-decoration: none;'><img src="images/user.png" alt='' width="30" height="30" style='border-radius:50%;'></a>
											<?php
										}else{
											?>
											<a href="user.php?username=<?php echo $username;?>" style='color:#000;text-decoration: none;'><img src="<?php echo $user_pic;?>" width='30' height='30' alt='' style='border-radius:50%;'></a>
											<?php
										}

									?>
									
									<a href="user.php?username=<?php echo $username;?>" style='color:#000;text-decoration: none;'><span><?php echo $username; ?></span></a>
								</div>
								<div class='col-sm-6 col-6 text-left'>
									
									
								</div>
							</div>
							<?php 

								$sql_video = "SELECT * FROM videos WHERE video_username='$username_followed' ORDER BY rand() LIMIT 4";
								$stmt_video = $conn->prepare($sql_video);
								$stmt_video->execute();
								while($row = $stmt_video->fetch()){
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
						<?php
						}
					}

				?>
			</div>
		</div>
		<script src='js/jQuery.js'></script>
		<script src='js/bootstrap.js'></script>
		<script src='js/main.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js'></script>
	</body>
</html>