
		<header class='home-header'>
			<nav class='navbar navbar-expand-md'>
				<a class='navbar-brand' href="dashboard.php">
					<img width='90' src='images/logo.png' alt='Watcheno'/>	
				</a>

				<div class='navbar-toggler mr-auto'>
					<a href="search.php" class='nav-link'>
						<i class='fa fa-search'></i>
					</a>
				    <!--<div class='dropdown'>
				    	<a href="" class='dropdown-toggle' data-toggle="dropdown">
							<i class='fa fa-bell'></i>
						</a>
						<div class='dropdown-menu dropdown-notif'>
								<div class='dropdown-menu-card row'>
									<div class='col-sm-12'>
										<h3>الاشعارات</h3>
									</div>
									<div class="dropdown-divider col-sm-12" style='padding:0;'></div>
									<div class='col-sm-12 row dropdown-menu-card'>
										<div class='dropdown-menu-card-img col-sm-2'>
											<img src='images/user.png' alt='' width='30' height='30'/>
										</div>
										<div class='dropdown-menu-card-title col-sm-10'>تم تحميل فيديو من قبل قناة amrbadran</div>
										<span><i class='fa fa-clock-o'></i> قبل 3 ساعات</span>
									</div>
									<div class="dropdown-divider col-sm-12" style='padding:0;'></div>
									<div class='col-sm-12 row dropdown-menu-card'>
										<div class='dropdown-menu-card-img col-sm-2'>
											<img src='images/user.png' alt='' width='30' height='30'/>
										</div>
										<div class='dropdown-menu-card-title col-sm-10'>تم تحميل فيديو من قبل قناة amrbadran</div>
										<span><i class='fa fa-clock-o'></i> قبل 3 ساعات</span>
									</div>
								</div>
							</div>
				    </div>-->
				</div>
				<?php 

					if(!isset($_SESSION['logged_in'])){
						?>
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
									        <button type="button" class="btn btn-default" data-dismiss="modal" style='background:#EEE;color:#000;'>اغلاق</button>
									      </div>
									    </div>

									  </div>
						</div>
						<button class='a21' data-toggle="modal" data-target="#myModal">تسجيل الدخول</button>
						<?php
					}else{
						?>
						<span class='navbar-toggler fa fa-bars' data-toggle="collapse" data-target="#navbar-collapse">
						</span>
						<?php
					}

				?>
				
				<div class='collapse navbar-collapse' id='navbar-collapse'>
					<ul class='navbar-nav text-center'>
						<li class='nav-item'>
							<a href="user.php?username=<?php echo $_SESSION['logged_in'];?> " class='nav-link'>
								<i class='fa fa-user'></i><?php echo $_SESSION['logged_in'];?> 
							</a>
						</li>
						<?php 
							        $username_session = $_SESSION['logged_in'];
									$sql = "SELECT active FROM users WHERE username='$username_session'";
									$stmt = $conn->prepare($sql);
									$stmt->execute();

									while($row = $stmt->fetch()){
										$active_status = $row['active'];
									}
									if($active_status == 0){
										?>
										<li class='nav-item'>
											<a href="active_sender.php" class='nav-link'>
												<i class='fa fa-cog'></i>فعيل حسابك<
											</a>
										</li>
										<?php
									}
						        ?>
						<li class='nav-item'>
							<a href="addvideo.php" class='nav-link'>
								<i class='fa fa-plus'></i>اضف فيديو
							</a>
						</li>
						<li class='nav-item'>
							<a href="settings.php" class='nav-link'>
								<i class='fa fa-cog'></i>الاعدادات
							</a>
						</li>
						<li class='nav-item'>
							<a href="dashboard.php" class='nav-link'>
								<i class='fa fa-play'></i> الفيديوهات 
							</a>
						</li>
						<li class='nav-item'>
							<a href="trend.php" class='nav-link'>
								<i class='fa fa-arrow-up'></i>المحتوى الرائج
							</a>
						</li>
						<li class='nav-item'>
							<a href="blog.php" class='nav-link'><i class='fa fa-rss'></i>المدونة </a>
						</li>
						<li class='nav-item'>
							<a href="logout.php" class='nav-link'>
								<i class='fa fa-sign-out'></i>تسجيل الخروج
							</a>
						</li>
					</ul>
				</div>
					<ul class='navbar-nav ml-auto navbar-nav2'>
						<li class='nav-item'>
							<a href="dashboard.php" class='nav-link'><i class='fa fa-play'></i>الفيديوهات </a>
						</li>
						<li class='nav-item'>
							<a href="blog.php" class='nav-link'><i class='fa fa-rss'></i>المدونة </a>
						</li>
						<li class='nav-item'>
							<a href="trend.php" class='nav-link'><i class='fa fa-arrow-up'></i>المحتوى الرائج</a>
						</li>
						
					</ul>
					<ul class='navbar-nav mr-auto navbar-nav2'>
						<li class='nav-item d-flex align-items-center'>
							<a href="search.php" class='nav-link'>
								<i class='fa fa-search'></i>
							</a>
						</li>
						<!--<li class='nav-item dropdown d-flex align-items-center'>
							<a href="" class='nav-link dropdown-toggle' data-toggle="dropdown">
								<i class='fa fa-bell'></i>
							</a>
							<div class='dropdown-menu dropdown-notif'>
								<div class='dropdown-menu-card row'>
									<div class='col-sm-12'>
										<h3>الاشعارات</h3>
									</div>
									<div class="dropdown-divider col-sm-12" style='padding:0;'></div>
									<div class='col-sm-12 row dropdown-menu-card'>
										<div class='dropdown-menu-card-img col-sm-2'>
											<img src='images/user.png' alt='' width='30' height='30'/>
										</div>
										<div class='dropdown-menu-card-title col-sm-10'>تم تحميل فيديو من قبل قناة amrbadran</div>
										<span><i class='fa fa-clock-o'></i> قبل 3 ساعات</span>
									</div>
									<div class="dropdown-divider col-sm-12" style='padding:0;'></div>
									<div class='col-sm-12 row dropdown-menu-card'>
										<div class='dropdown-menu-card-img col-sm-2'>
											<img src='images/user.png' alt='' width='30' height='30'/>
										</div>
										<div class='dropdown-menu-card-title col-sm-10'>تم تحميل فيديو من قبل قناة amrbadran</div>
										<span><i class='fa fa-clock-o'></i> قبل 3 ساعات</span>
									</div>
									<div class="dropdown-divider col-sm-12" style='padding:0;'></div>
									<div class='col-sm-12 row dropdown-menu-card'>
										<div class='dropdown-menu-card-img col-sm-2'>
											<img src='images/user.png' alt='' width='30' height='30'/>
										</div>
										<div class='dropdown-menu-card-title col-sm-10'>تم تحميل فيديو من قبل قناة amrbadran</div>
										<span><i class='fa fa-clock-o'></i> قبل 3 ساعات</span>
									</div>
									<div class="dropdown-divider col-sm-12" style='padding:0;'></div>
									<div class='col-sm-12 row dropdown-menu-card'>
										<div class='dropdown-menu-card-img col-sm-2'>
											<img src='images/user.png' alt='' width='30' height='30'/>
										</div>
										<div class='dropdown-menu-card-title col-sm-10'>تم تحميل فيديو من قبل قناة amrbadran</div>
										<span><i class='fa fa-clock-o'></i> قبل 3 ساعات</span>
									</div>
									<div class="dropdown-divider col-sm-12" style='padding:0;'></div>
									<div class='col-sm-12 row dropdown-menu-card'>
										<div class='dropdown-menu-card-img col-sm-2'>
											<img src='images/user.png' alt='' width='30' height='30'/>
										</div>
										<div class='dropdown-menu-card-title col-sm-10'>تم تحميل فيديو من قبل قناة amrbadran</div>
										<span><i class='fa fa-clock-o'></i> قبل 3 ساعات</span>
									</div>
								</div>
							</div>
						</li>-->
						<?php 
							if(!isset($_SESSION['logged_in'])){

								?>
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
									        <button type="button" class="btn btn-default" data-dismiss="modal" style='background:#EEE;color:#000;'>اغلاق</button>
									      </div>
									    </div>

									  </div>
									</div>
									<button class='mr-auto' data-toggle="modal" data-target="#myModal">تسجيل الدخول</button>
								<?php

							}else{

								?>

								<li class='nav-item dropdown'>
									<a href="" class='nav-link dropdown-toggle' data-toggle="dropdown">
									<?php 
										$username_session = $_SESSION['logged_in'];
										$sql = "SELECT user_pic FROM users WHERE username='$username_session'";
										$stmt = $conn->prepare($sql);
										$stmt->execute();
										while($row = $stmt->fetch()){
											$user_pic = $row['user_pic'];
										}
										if(empty($user_pic)){
											?>
											<img src="images/user.png" class='img-fluid img_user_comment' width='45' height='45' alt=''>
											<?php

										}else{
											?>
											<img src="<?php echo $user_pic;?>" class='img-fluid img_user_comment' width='45' height='45' alt='' style='border-radius: 50%;'>
											<?php
										}
									?>

									
									</a>
									<div class="dropdown-menu" dir='rtl' style='text-align: right;'>
										<a class="dropdown-item" href="user.php?username=<?php echo $_SESSION['logged_in'];?> "><i class='fa fa-user'></i><?php echo $_SESSION['logged_in'];?> </a>
										<a class="dropdown-item" href="addvideo.php"><i class='fa fa-plus'></i>اضف فيديو</a>
								        <a class="dropdown-item" href="settings.php"><i class='fa fa-cog'></i>الاعدادات</a>
								        <?php 
									        $username_session = $_SESSION['logged_in'];
											$sql = "SELECT active FROM users WHERE username='$username_session'";
											$stmt = $conn->prepare($sql);
											$stmt->execute();

											while($row = $stmt->fetch()){
												$active_status = $row['active'];
											}
											if($active_status == 0){
												?>
												<a class="dropdown-item" href="active_sender.php"><i class='fa fa-cog'></i>تفعيل حسابك</a>
												<?php
											}
								        ?>
								        <div class="dropdown-divider"></div>
								        <a class="dropdown-item" href="logout.php"><i class='fa fa-sign-out'></i>تسجيل الخروج</a>
								    </div>
								</li>

								<?php
							}
						?>
						
					</ul>
			</nav>
		</header>