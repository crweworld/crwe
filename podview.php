<?php
include( 'subs/header.php' );
$autoplay = '';
if ( isset( $_GET[ 'autoplay' ] ) ) {
	$autoplay = 'autoplay';
}

?>

<link type="text/css" rel="stylesheet" href="/assets/css/player.min.css">
<style>
	#content-news .main-news {
		overflow-x: inherit;
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
								<li><a href="#">Home</a>
								</li>
								<li><a href="#">Podcast</a>
								</li>
								<li>
									<a href="#">
										<?php echo ucfirst($user->username)?>
									</a>
								</li>
								<!-- Meta Tags -->
								<!-- Meta Tags -->
							</ul>
						</div>
						<div class="col-md-4 col-right col-sm-4">
							<div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon"/>
								</span>
							</div>
						</div>
					</div>
					<div class="row mbxxl">
						<div class="col-md-8 col-left col-sm-7">
							<div class="row">
								<div class="col-md-12">
									<div id="content-news" class="section-category">
										<div class="section-name"></div>
										<div class="section-content">
											<h1 class="title-news">
												<a href="#"><?php echo htmlspecialchars_decode($pod->title)?></a>
											</h1>
										

											<div class="info-news">
												<div class="pull-left col-md-12">
													<div class="info"><span class="category">Podcast - <?php echo ucfirst($user->username)?></span>
														<span class="fa fa-circle"></span>
														<span class="date-created">
															<?php echo date('Y-m-d',strtotime($pod->created_on));?>
														</span>
														<span class="fa fa-circle"></span>
                                                    	<div class="comments"><a href="#people-comment"><i class="ion-android-chat mrs"></i><div style="display: inline;"><?php echo $pod->view?> Views</div></a></div>
													</div>
												</div>
												<div class="pull-left">
													<div class="share-link ">
														<span class='st_facebook' displayText='Facebook'></span>
														<span class='st_twitter' displayText='Tweet'></span>
														<span class='st_linkedin' displayText='LinkedIn'></span>
														<span class='st_googleplus' displayText='Google +'></span>
														<span class='st_reddit' displayText='Reddit'></span>
														<span class='st_digg' displayText='Digg'></span>
														<span class='st_vkontakte' displayText='VKontakte'></span>
														<span class='st_flipboard' displayText='Flipboard'></span>
														<span class='st_email' displayText='Email'></span>
														<span class='st_sharethis' displayText='ShareThis'></span>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="main-news">
												
													<div id="audio"></div>
													<?php $audio= '<audio controls '.$autoplay.'><source src="'.$pod->location.'" /></audio>';?>
													<div style="margin: 15px;">
														<a href="javascript:void(0);" class="btn1 btn downfile"><i class="fa fa-cloud-download" style="font-size:20px;"></i> <span class="txt">Download</span></a> &nbsp;
														<a href="javascript:void(0);" data-href='<iframe src="//<?php echo $_SERVER['SERVER_NAME'].'/podplayer/'.$pod->id;?>" width="100%" height="70"  frameborder="0" scrolling="no"></iframe>'  class="btn1 btn copy-url"><i class="fa fa-copy" style="font-size:20px;"></i> <span class="txt">Copy embedded code</span></a>
													</div>
												
												<div class="section-name"><a href="#">Episode Info</a></div>											
													
													<p><?php if($pod->description!=''){echo str_replace("\'","'",htmlspecialchars_decode($pod->description));}else {echo 'N/A';}?>
													</p>
												
												<div class="section-name"><a href="#">Podcaster Info</a>
												</div>
												<div class="converstation">
													<div class="media">
														<div class="media-left"><a href="/podcast/<?php echo $user->username?>"><img class="media-object img-circle" onerror="this.src='/assets/images/avatar.png'" src="<?php echo $user->pic?>" alt="Avatar"> </a>
														</div>
														<div class="media-body">
															<div class="clearfix">
																<h4 class="media-heading pull-left"><?php echo ucfirst($user->username)?></h4> <br>
																<a href="/podcast/<?php echo $user->username?>">Click here for latest episodes</a>
															</div>
														</div>
													</div>
												</div>

											</div>
											<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-right col-sm-5">

							<?php include('subs/sidebar.php'); ?>
							<?php include('ads/geo-side-ads.php'); ?>
							<div class="clearfix"></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal content --> 
	<div id="md-cmt" class="md modal">
	<div class="modal-dialog modal-lg"><div class="modal-content"></div></div>
	</div> 
	<script src='/assets/js/renameDownload.min.js'></script>
	<script src="/assets/js/player.min.js"></script>
	<script src='/assets/js/clipboard.min.js'></script>
	<script>
		$( document ).ready( function () {
			$(".downfile").on('click', function(){	
				var x=new XMLHttpRequest();
				x.open( "GET", "<?php echo $pod->location;?>" , true);
				x.responseType="blob";
				x.onload= function(e){download(e.target.response, "<?php echo txtcleaner($pod->title);?>.mp3", "audio/mp3");};
				x.send();
			});			
			
			setTimeout( function () {
				$( '#audio' ).html( '<?php echo $audio;?>' );
				$( 'audio' ).audioPlayer();
			}, 2000 );
			
			var clipboard = new Clipboard('.copy-url', {
			text: function(trigger) {
			return trigger.getAttribute('data-href');}
		});
		clipboard.on('success', function (e) {
			$(".modal-content").html("Link copied to clipboard");
			$("#md-cmt").show();setTimeout(function(){$("#md-cmt").hide();}, 1000);	
			e.clearSelection();
		});
		//safari
		if (navigator.vendor.indexOf("Apple") == 0 && /\sSafari\//.test(navigator.userAgent)) {
			$('.copy-url').on('click', function () {
				var msg = window.prompt("Copy this link", $(this).attr('data-href'));

			});
		}

		} );
	</script>
	<?php include('subs/visit_counter.php') ?>
	<!--Share it-->
	<script type="text/javascript">
		var switchTo5x = true;
	</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">
		stLight.options( {
			publisher: "33eb4b24-b7ed-4b8f-9245-385d5515c1bc",
			doNotHash: false,
			doNotCopy: false,
			hashAddressBar: false
		} );
	</script>
	<?php include('subs/footer.php') ?>