<?php
include( 'subs/header.php' );
?>
<link type="text/css" rel="stylesheet" href="/assets/css/pages/search_result.css">
<style>
	.media-right .fa{
		font-size: 50px;
    color: #cc0101;
	}
</style>
<div id="wrapper">
	<!-- PAGE WRAPPER-->
	<div id="page-wrapper">
		<!-- MAIN CONTENT-->
		<div class="main-content">
			<!-- CONTENT-->
			<div class="content">
				<div class="container">
					<div class="row">
						<!--ad only for ipad -->
						<div class="ipad-ads col-md-12">
							<?php include('ads/729ad.php');?>
						</div>
						<!--ad only for ipad end -->

						<div class="col-md-8 col-left col-sm-8">
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Podcast</a>
								</li>
								<li class="breadcrumb-item active"><?php echo ucfirst($user->username)?></li>
							</ul>
						</div>
						<div class="col-md-4 col-right col-sm-4">
							<div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon"/>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-left col-sm-7">
							<div id="search-result" class="section-category">
								<div class="section-name">
									<!-- ad for desktop -->
									<div class="desktop-ads">
										<?php include('ads/729ad.php')?>
									</div>
									<!--End ad for desktop -->
									<br>
									<div class="title-news"><img class="img-circle" width="100" onerror="this.src='/assets/images/avatar.png'" src="/assets/images/avatar.png"><a href="#">Podacast from @<?php echo $user->username?></a></div>
								</div>
								<div class="section-content">
									<div class="row">
										<div class="col-md-12">

											<div id="result-list">													
													<?php  
														$sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `podcast` where status='1' and user_id='$user->id' order by `id` DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
														while($post=mysqli_fetch_object($sql))
													{
														if($post->description!=''){
															$description='<div class="description">'.substr(strip_tags(htmlspecialchars_decode($post->description)), 0, 300).'....</div>';
														}else{
															$description='';
														}
														
													echo  '
														<div class="media">															
															<div class="media-body">
																<div class="media-heading"><a title="'.htmlspecialchars_decode($post->title).'" href="'.$post->url.'" class="title">'.htmlspecialchars_decode($post->title).'</a></div>
																<div class="info"><span class="category">Podcast- '.ucfirst($user->username).'</span><span class="fa fa-circle"></span><span class="date-created">'.date('Y-m-d', strtotime($post->created_on)).'</span>
																</div>
																'.$description.'
															</div>
															<div class="media-right"><a href="'.$post->url.'"><i class="fa fa-play-circle" aria-hidden="true"></i></a></div>
														</div>';
													}?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-right col-sm-5">
							<?php include('subs/sidebar.php'); ?>
							<?php include('ads/geo-side-ads.php'); ?>
							<div class="clearfix"></div>

							<div class="clearfix"></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include('subs/footer.php') ?>