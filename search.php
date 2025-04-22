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
	<body dir='rtl' style='background:#eee;'>
		
<?php include('header_home.php');?>

		<div class='home-search'>
			<div class='container' style='width:65%;'>
				<form class='row text-center' style='margin-top:30px;'>
					<div class="form-group col-sm-9 text-left">
						<input type="search" name="s" class='form-control' placeholder="ادخل  الكلمة المراد البحث عنها">
						
					</div>
					<div class='form-group col-sm-3 text-right'>
						<button type='submit' class='btn'>بحث  <i class="fa fa-search"></i></button>
					</div>
				</form>
			</div>
			<div class='container'>
				<div class='row cards-user'>
					<?php 

						$s = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : "";
						if(!empty($s)){

						
							$sql = "SELECT * FROM videos WHERE video_title like '%$s%' OR video_username like '%$s%' OR video_descr like '%$s%'";
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
					?>
					
					
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