		<?php 
			 	include('header.php'); 
		?>
		<div class='watcheno-about'>
			<div class='container-fluid'>
				<div class='row'>
					<div class='col-md-6'>
						<img src="images/watcheno-about.jpg" alt='' class='img-fluid'>
					</div>
					<div class='col-md-6 text-right'>
						<h1>
							شاهد فيديوهات حول ما تحب
						</h1>
						<p>
							وووتشينو هي اول منصة فيديوهات عربية حيث يمكنك مشاهدة فيديوهات حول ما تحب في جميع المجالات من اي مكان في فالعالم ومجانا .
						</p>
						<a href="signup" class='sign-up-button btn'>سجل الان</a>
					</div>
				</div>
			</div>
		</div>
		<div class='home-search home-trend'>
			<div class='container text-right'>
				<h3 style='padding-top:45px'>الفيديوهات الاكثر تداولا</h3>
				<div class='row cards-user' style='padding-bottom:45px;'>
					<?php 
							$sql = "SELECT * FROM videos WHERE date_video > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY views_count DESC LIMIT 4";
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
												
												<div class='card-body' style='background:#FFF'>
													<div class='card-title'>
														<a href="<?php echo $video_href;?>"><?php echo $video_title;?></a>
													</div>
													<p class='card-text card-user'><i class='fa fa-user'></i> <?php echo $video_author; ?></p>
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
		<?php include('footer.php'); ?>