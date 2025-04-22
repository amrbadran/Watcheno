<?php 
	include('functions.php');
	session_start();
	
	$id = addslashes($_GET['id']);
	if(!isset($_GET['id'])){
		header("Location: 404.php");
	}
	$sql = "SELECT * FROM videos WHERE id='$id'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	if($stmt->rowCount() == 0){
		header("Location: 404.php");
	}
	if($_COOKIE['WA_W0'] != md5("11")){
		$sql = "UPDATE videos SET views_count=views_count+1 WHERE id='$id'";
		$conn->exec($sql);
		setcookie('WA_W0',md5("11"),time() + (86400 * 30),'/');
	}
	while($row = $stmt->fetch()){
		$id_video = $row['id'];
		$title_video = $row['video_title'];
		$video_descr = $row['video_descr'];
		$video_src  = $row['video_src'];
		$video_username = $row['video_username'];
		$active = $row['active'];
		$views_count = $row['views_count'];
		$likes_count = $row['likes_count'];

		
		$comments_count = $row['comments_count'];
	}
	if($active != 'publish'){
		header("Location: 404.php");
	}


	if(isset($_SESSION['logged_in'])){

		$username_viewer = $_SESSION['logged_in'];
		$sql_select = "SELECT * FROM views WHERE username_viewer='$username_viewer' AND video_viewed='$id'";

		$stmt_select = $conn->prepare($sql_select);
		$stmt_select->execute();

		if(!$stmt_select->rowCount() == 1){

			$sql = "INSERT INTO views(username_viewer,video_viewed) VALUES('$username_viewer','$id')";
			$conn->exec($sql);

			$sql_update = "UPDATE videos SET views_count=views_count+1 WHERE id='$id'";
			$conn->exec($sql_update);

		}
		
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
	<body dir='rtl' >
<?php include('header_home.php');?>
		<div class='home-watch'>

			<div class='overlay'></div>
			<div class='video-watch'>
				<div class='container-fluid'>
					<div class='row'>
						<div class='col-md-7'>
							<video width='100%' height="100%" controls>
								<source src="<?php echo $video_src;?>" type="" height="100%">
							</video>
							<img src='' class='ca' style='display: none;'/>
						</div> 
						<div class='col-md-5 text-right'>
							<h3><?php echo $title_video;?></h3>
							<div class='row person-follow'>
								<span class='col-sm-6'>
									<?php 

										$sql = "SELECT user_pic FROM users WHERE username='$video_username'";
										$stmt = $conn->prepare($sql);
										$stmt->execute();
										while($row = $stmt->fetch()){
											$user_pic = $row['user_pic'];
										}

										if(empty($user_pic)){
											?>
											<a href="user.php?username=<?php echo $video_username; ?>"><img style='border-radius:50%;' src='images/logo.png' alt='' width='40' height='40'/></a>
											<?php
										}else{
											?>
											<a href="user.php?username=<?php echo $video_username; ?>"><img style='border-radius:50%;' src='<?php echo $user_pic;?>' alt='' width='40' height='40'/></a>
											<?php
										}

									?>
									
									<a style='color:#FFF;text-decoration: none;margin-right:5px;' href="user.php?username=<?php echo $video_username; ?>"><?php echo $video_username;?></a>
								</span>
								<span class='col-sm-6'>
									<?php 
										$username_follower = $_SESSION['logged_in'];
										$username_followed = $video_username;
										$sql = "SELECT * FROM follow WHERE username_followed='$username_followed' AND username_follower='$username_follower'";
										$stmt = $conn->prepare($sql);
										$stmt->execute();
										if($stmt->rowCount() == 1){
											?>
											<input type="hidden" class="video_username" value="<?php echo $video_username;?>">
											<button class='follow-user-button followed'>الغاء المتابعة</button>
											<?php
										}else{
											?>
											<input type="hidden" class="video_username" value="<?php echo $video_username;?>">
											<button class='follow-user-button'>متابعة <i class='fa fa-user-plus'></i></button>
											<?php
										}

									?>
									
								</span>
							</div>
							
							<p style='word-break: break-word;'>
								<?php echo $video_descr; ?>
							</p>
							<div class='video-stats row'>
								<div class='col-sm-6'>
									<span><?php echo $views_count;?> مشاهدة</span>
								</div>
								<div class='col-sm-6'>
									<span>
										<span class='likes-count'><?php echo $likes_count;?></span> اعجاب  . <span class='comments-count'><?php echo $comments_count;?> تعليق </span> </span>
								</div>
							</div>
							<input class='video_id_addlike' type='hidden' value='<?php echo $id;?>'/>
							<div class='like-comment-share row' style='margin-right:2px;'>
								<?php 
									$username = $_SESSION['logged_in'];
									$sql = "SELECT * FROM likes WHERE username='$username' AND video_id ='$id'";
									$stmt = $conn->prepare($sql);
									$stmt->execute();
									if($stmt->rowCount() == 1){
										?>
										<i class='fa fa-heart red-heart'></i>
										<?php
									}else{
										?>
										<i class='fa fa-heart'></i>
										<?php
									}

								?>
								
								<i class='fa fa-comment'></i>
								<div class="dropdown">
										<button class="dropdown-toggle" type="button" data-toggle="dropdown" style='border:none;background:transparent;outline:none;'>
											<i class='fa fa-ellipsis-h'></i>
										</button>
										<ul class="dropdown-menu text-right">
										<?php 

											$username_session = $_SESSION['logged_in'];
											$sql2 = "SELECT * FROM videos WHERE video_username='$username_session' AND id='$id'";
											$stmt2 = $conn->prepare($sql2);
											$stmt2->execute();
											if($stmt2->rowCount() == 1){
											?>
											<input type='hidden' class='video-key' value='<?php echo $id; ?>'/>
											<li class='delete-video delete-video22'><a href="#" style='color:#000;text-decoration: none;'><i class='fa fa-trash' style='font-size: 18px;margin: 0 10px;color: #DDD;'></i>حذف</a></li>
											<?php
											}else{
											?>

											<input type='hidden' class='id-report' value='<?php echo $id; ?>'/>
											<input type="hidden" class="report-type" value='video'>
											<input type="hidden" class="report-link" value='watch.php?id=<?php echo $id;?>'>
											<li class='report-comment-button delete-video22'><a href="#" style='color:#000;text-decoration: none;'><i class='fa fa-bug' style='font-size: 18px;margin: 0 10px;color: #DDD;'></i>ابلاغ</a></li>
											<?php
										}

									?>
														    
														   
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='home-watch-comments text-right'>
			<div class='container-fluid'>
				<div class='row row1'>
					<div class='col-md-8' style='background:#EEE;'>
						<h3 style='padding:30px 0'>التعليقات </h3>
						<div class='add-comment'>
							<form class='row'>

								<div class='form-group col-sm-10'>
									<textarea class='form-control textarea-comment' name='textarea_comment' placeholder="اكتب تعليق.." ></textarea>
									
								</div>
								<div class='form-group col-sm-2 ' style='padding:0;'>
									<input type="hidden" value="<?php echo $id;?>" class='video_id_addcomment'>
									<input type="hidden" class="comment_author" value='<?php echo $_SESSION['logged_in']; ?>'>
									<button class='btn add-comment-button' style='margin-top:10px;'>تعليق</button>
								</div>
							</form>
						</div>
						<input type='hidden' value="<?php echo $_SESSION['logged_in']; ?>" class='username-session'>
						<div class='comments row'>
							<?php 
								$username_session = $_SESSION['logged_in'];
								$sql = "SELECT * FROM comments WHERE video_id='$id' AND username='$username_session'";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								
								
								if($stmt->rowCount() > 0){
									while($row = $stmt->fetch()){
									$id_comment = $row['id'];
									$username_comment = $row['username'];
									$comment_text = $row['comment_text'];
									$date_comment = $row['date_comment'];
									$likes_count = $row['likes_count'];
									$replies_count = $row['replies_count'];
									?>
										<div class='col-md-12 row comment'>
											<input type="hidden" class="comment_id" value="<?php echo $id_comment;?>">
											<div class='col-6' style='color:#777;'>
												<?php 

													$sql_pic = "SELECT user_pic FROM users WHERE username='$username_comment'";
													$stmt_pic = $conn->prepare($sql_pic);
													$stmt_pic->execute();
													while($row = $stmt_pic->fetch()){
														$user_pic = $row['user_pic'];
													}
													if(empty($user_pic)){
														?>
														<a href="user.php?username=<?php echo $username_comment;?>"><img src='images/user.png' alt='' width='50' height='50' style='border-radius: 50%;margin-left:5px;'/></a>
														<?php
													}else{
														?>
														<a href="user.php?username=<?php echo $username_comment;?>"><img src='<?php echo $user_pic;?>' alt='' width='50' height='50' style='border-radius: 50%;margin-left:5px;'/></a>
														<?php
													}
												?>
												<span style='color:#000;margin-left:5px;font-size:17px' class='text-right'>
													<?php echo $username_comment; ?>
												</span>
												<span class='text-left'><?php echo $date_comment;?></span>
											</div>
											<div class='col-6 d-flex align-items-center' style='justify-content: flex-end;'>
													<div class="dropdown">
													  	<button class="dropdown-toggle" type="button" data-toggle="dropdown" style='border:none;background:transparent;outline:none;'>
													  		<i class='fa fa-ellipsis-v'></i>
													  	</button>
														  <ul class="dropdown-menu text-right">
														  	<?php 
														  		$username_session = $_SESSION['logged_in'];
														  		$sql2 = "SELECT * FROM comments WHERE username='$username_session' AND id='$id_comment'";
														  		$stmt2 = $conn->prepare($sql2);
														  		$stmt2->execute();
														  		if($stmt2->rowCount() == 1){
														  			?>
														  			<input type='hidden' class='comment-id' value='<?php echo $id_comment; ?>'/>
														  			<li class='delete-comment-button dc-<?php echo $id_comment;?>'><a href="#"><i class='fa fa-trash'></i>حذف</a></li>
														  			<?php
														  		}else{
														  			?>

														  			<input type='hidden' class='id-report' value='<?php echo $id_comment; ?>'/>
														  			<input type="hidden" class="report-type" value='comment'>
														  			<li class='report-comment-button'><a href="#"><i class='fa fa-bug'></i>ابلاغ</a></li>
														  			<?php
														  		}

														  	?>
														    
														   
														  </ul>
													</div>
											</div>
											<div class='col-md-12'>
												<p style='padding-top:5px;padding-right:50px;'>
													<?php echo htmlspecialchars($comment_text);?>
												</p>
											</div>
										
										</div>
									<?php
									}
									
								
								}
							?>
							<?php 
								$username_session = $_SESSION['logged_in'];
								$sql = "SELECT * FROM comments WHERE video_id='$id' AND username !='$username_session' ORDER BY date_comment";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								
								
								if($stmt->rowCount() > 0){
									while($row = $stmt->fetch()){
									$id_comment = $row['id'];
									$username_comment = $row['username'];
									$comment_text = $row['comment_text'];
									$date_comment = $row['date_comment'];
									$likes_count = $row['likes_count'];
									$replies_count = $row['replies_count'];
									?>
										<div class='col-md-12 row comment'>
											<input type="hidden" class="comment_id" value="<?php echo $id_comment;?>">
											<div class='col-6' style='color:#777;'>
												<?php 

													$sql_pic = "SELECT user_pic FROM users WHERE username='$username_comment'";
													$stmt_pic = $conn->prepare($sql_pic);
													$stmt_pic->execute();
													while($row = $stmt_pic->fetch()){
														$user_pic = $row['user_pic'];
													}
													if(empty($user_pic)){
														?>
														<a href="user.php?username=<?php echo $username_comment;?>"><img src='images/user.png' alt='' width='50' height='50' style='border-radius: 50%;margin-left:5px;'/></a>
														<?php
													}else{
														?>
														<a href="user.php?username=<?php echo $username_comment;?>"><img src='<?php echo $user_pic;?>' alt='' width='50' height='50' style='border-radius: 50%;margin-left:5px;'/></a>
														<?php
													}
												?>
												<span style='color:#000;margin-left:5px;font-size:17px' class='text-right'>
													<?php echo $username_comment; ?>
												</span>
												<span class='text-left'><?php echo $date_comment;?></span>
											</div>
											<div class='col-6 d-flex align-items-center' style='justify-content: flex-end;'>
													<div class="dropdown">
													  	<button class="dropdown-toggle" type="button" data-toggle="dropdown" style='border:none;background:transparent;outline:none;'>
													  		<i class='fa fa-ellipsis-v'></i>
													  	</button>
														  <ul class="dropdown-menu text-right">
														  	<?php 
														  		$username_session = $_SESSION['logged_in'];

														  		$sql_video_au = "SELECT video_username FROM videos WHERE id='$id'";

														  		$stmt_video_au = $conn->prepare($sql_video_au);

														  		$stmt_video_au->execute();
														  		while($row = $stmt_video_au->fetch()){
														  			$username_video_author = $row['video_username'];
														  		}


														  		$sql2 = "SELECT * FROM comments WHERE username='$username_session' AND id='$id_comment'";
														  		$stmt2 = $conn->prepare($sql2);
														  		$stmt2->execute();
														  		if($stmt2->rowCount() == 1 || $username_video_author == $_SESSION['logged_in']){
														  			?>
														  			<input type='hidden' class='comment-id' value='<?php echo $id_comment; ?>'/>
														  			<li class='delete-comment-button dc-<?php echo $id_comment;?>'><a href="#"><i class='fa fa-trash'></i>حذف</a></li>
														  			<?php
														  		}else{
														  			?>

														  			<input type='hidden' class='id-report' value='<?php echo $id_comment; ?>'/>
														  			<input type="hidden" class="report-type" value='comment'>
														  			<li class='report-comment-button'><a href="#"><i class='fa fa-bug'></i>ابلاغ</a></li>
														  			<?php
														  		}

														  	?>
														    
														   
														  </ul>
													</div>
											</div>
											<div class='col-md-12'>
												<p style='padding-top:5px'>
													<?php echo htmlspecialchars($comment_text);?>
												</p>
											</div>
										
										</div>
									<?php
									}
									
								
								}
							?>
							
							
						</div>
					</div>
					<div class='col-md-4'>
						<h3 style='padding:30px 0'>الفيديوهات المقترحة</h3>
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
													<div class='liked-video row'>

														
															<?php 

																if(empty($video_thumbnail)){
																	?>
																	<video id="video-thumbnail" controls="controls" style='display: none;'>
																		<source src="<?php echo $video_src;?>" style='display: none;'>
																	</video>
																	<div class='col-md-5' style='padding-left:0;'>
																		
																		<img src="" class='card-img ca' width='100%' height='100%' alt=''>
																	</div>
																	
																	<?php
																}else{
																	?>
																	<div class='col-md-5' style='padding-left:0;'>
																		
																		<img src="<?php echo $video_thumbnail;?>" class='card-img ca' width='100%' height='100%' alt=''>
																	</div>
																	
																	<?php
																}

															?>
															
															<div class='col-md-7'>
																<a href="<?php echo $video_href;?>"><?php echo $video_title;?></a>

																<p style='margin-bottom:0;padding:5px 0;' class='user-own-video'>

																	<a href='user.php?username=<?php echo $video_author; ?>' style='color:#000;text-decoration: none;'><i class='fa fa-user'></i> <?php echo $video_author; ?></a>

																</p>

																<p style='color:#888;margin-bottom:0'><?php echo $video_views;?> مشاهدة</p>
																
															</div>
														
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
									$sql = "SELECT * FROM videos WHERE video_username='$b' ORDER BY rand() LIMIT 1";
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
													<div class='liked-video row'>

														
															<?php 

																if(empty($video_thumbnail)){
																	?>
																	<video id="video-thumbnail" controls="controls" style='display: none;'>
																		<source src="<?php echo $video_src;?>" style='display: none;'>
																	</video>
																	<div class='col-md-5' style='padding-left:0;'>
																		
																		<img src="" class='card-img ca' width='100%' height='100%' alt=''>
																	</div>
																	
																	<?php
																}else{
																	?>
																	<div class='col-md-5' style='padding-left:0;'>
																		
																		<img src="<?php echo $video_thumbnail;?>" class='card-img' width='100%' height='100%' alt=''>
																	</div>
																	
																	<?php
																}

															?>
															
															<div class='col-md-7'>
																<a href="<?php echo $video_href;?>"><?php echo $video_title;?></a>

																<p style='margin-bottom:0;padding:5px 0;' class='user-own-video'>

																	<a href='user.php?username=<?php echo $video_author; ?>' style='color:#000;text-decoration: none;'><i class='fa fa-user'></i> <?php echo $video_author; ?></a>

																</p>

																<p style='color:#888;margin-bottom:0'><?php echo $video_views;?> مشاهدة</p>
																
															</div>
														
													</div>
												<?php
											}
									}
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
	</body>
</html>