<?php
include( 'subs/header.php' );

?>
<link type="text/css" rel="stylesheet" href="/assets/css/pages/technology_detail.css">
<!-- WRAPPER-->
<div id="wrapper">
	<!-- PAGE WRAPPER-->
	<div id="page-wrapper">
		<!-- MAIN CONTENT-->
		<div class="main-content">
			<!-- CONTENT-->
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-left col-sm-7">
							<ul class="breadcrumb">
								<li><a href="#">Home</a>
								</li>
								<li><a href="#">Videos</a>
								</li>
								<li>
									<a href="#">
										<?php echo $vc_name?>
									</a>
								</li>

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
										<!-- ad for desktop -->
										<div class="desktop-ads">
											<?php include('ads/729ad.php')?>
										</div>
										<!--End ad for desktop -->
										<div class="section-content">
											<h1 class="title-news"><a title="<?php echo $vid_title; ?>"
                                                href="#"><?php echo $vid_title ?></a></h1>

											<div class="info-news">
												<div class="pull-left">
													<div class="info">
														<span class="category">
															<?php echo $vc_name?>
														</span><span class="fa fa-circle"></span>
														<span class="date-created">
															<?php echo $vid_doc ?>
														</span>
														<span class="fa fa-circle"></span>
														<div class="comments"><a href="#people-comment"><i
                                                            class="ion-android-chat mrs"></i>

                                                        <div style="display: inline;"><?php echo $vid_view?> Views</div>
                                                    </a>
														</div>
													</div>
												</div>
												<div class="pull-left">

													<div class="share-link"><span class='st_facebook' displayText='Facebook'></span>
														<span class='st_twitter' displayText='Tweet'></span>
														<span class='st_linkedin' displayText='LinkedIn'></span>
														<span class='st_reddit' displayText='Reddit'></span>
														<span class='st_digg' displayText='Digg'></span>
														<span class='st_vkontakte' displayText='VKontakte'></span>
														<span class='st_stumbleupon' displayText='Stumbleupon'></span>
														<span class='st_email' displayText='Email'></span>
														<span class='st_sharethis' displayText='ShareThis'></span>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="main-news">
												<div class="image-news">

													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="embed-responsive-item" src="<?php echo $src_url?>" frameborder="0" allowfullscreen></iframe>
													</div>

													<!--<div class="info-image"><span
                                                            class="category">Photograph:</span><span class="author">abcde</span>
                                                    </div>-->
												</div>
												<p>
													<?php echo $vid_description?>
												</p>

												<div class="image-news pull-left mrxxl image-two">
													<div class="info-image"></div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
										<div id="people-comment" class="comment-news">
											<div class="comment-info">
											</div>
											<div class="comment-form">

												<div class="comment-write">
													<div class="media">

														<div id="fb-root"></div>
														<script>
															( function ( d, s, id ) {
																var js, fjs = d.getElementsByTagName( s )[ 0 ];
																if ( d.getElementById( id ) ) return;
																js = d.createElement( s );
																js.id = id;
																js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
																fjs.parentNode.insertBefore( js, fjs );
															}( document, 'script', 'facebook-jssdk' ) );
														</script>
														<div class="fb-comments" data-href="<?php echo " http:// ".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']?>?vid_id=<?php echo $mvid_id?>" data-width="100%" data-numposts="10"></div>

														<div class="section-name"><a href="#">Sponsored</a>
														</div>
														<ins class="adsbygoogle" style="display:inline-block;width:100%;" data-ad-format="autorelaxed" data-ad-client="ca-pub-5763758713432929" data-ad-slot="3807424756"></ins>
														<script>
															( adsbygoogle = window.adsbygoogle || [] ).push( {} );
														</script>

													</div>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="also-read section-category">
											<div class="section-name">
												<div class="pull-left"><a href="#">Also Watch</a>
												</div>
												<div class="pull-right"><a href="#also-read-carousel" data-slide="next" class="right carousel-control"><span
                                                        class="fa fa-angle-right"></span></a><a href="#also-read-carousel" data-slide="prev" class="left carousel-control"><span
                                                        class="fa fa-angle-left"></span></a>
												</div>
												<div class="clearfix"></div>
											</div>
											<div id="also-read-carousel" data-interval="false" class="carousel slide">
												<div class="carousel-inner">
													<div class="item active">
														<div class="row man">
															<?php
															$sql_res = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "select * from videos where vid_status='publish' and vid_id!='$mvid_id' ORDER BY `vid_id` DESC LIMIT 4" );
															while ( $row = mysqli_fetch_array( $sql_res ) ) {
																$vid_title = $row[ 'vid_title' ];
																$vid_id = $row[ 'vid_id' ];
																$array[] = $row[ 'vid_id' ];
																$vid_url = $row[ 'vid_url' ];
																if ( $row[ 'vid_type' ] == 0 ) {
																	$img_src2 = 'http://img.youtube.com/vi/' . $vid_url . '/mqdefault.jpg';
																} else {
																	$img_src2 = 'http://www.crwetube.com/image/thumbnail/' . $vid_url . '.jpg';
																}
																?>
															<div class="col-md-3 col-sm-3 col-xs-6">
																<div class="thumb"><a title="<?php echo $vid_title; ?>" href="<?php echo " http:// ".$_SERVER['HTTP_HOST']."/watch/ ".$vid_id."/ ". txtcleaner($vid_title);?>"><img onerror="this.src='/default.jpg'" src="<?php echo $img_src2?>" alt="" class="img-responsive"/></a>

																	<div class="caption">
																		<div class="description">
																			<a title="<?php echo $vid_title; ?>" href="<?php echo " http:// ".$_SERVER['HTTP_HOST']."/watch/ ".$vid_id."/ ". txtcleaner($vid_title);?>">
																				<?php echo substr($vid_title, 0, 45)?>
																			</a>
																		</div>
																	</div>
																</div>
															</div>
															<?php } ?>

														</div>
													</div>
													<div class="item">
														<div class="row man">
															<?php
															$sql_res = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "select * from videos where vid_status='publish' and vid_id!='$mvid_id' and vid_id NOT IN ('" . implode( "','", $array ) . "')ORDER BY `vid_id` DESC LIMIT 4" );
															while ( $row = mysqli_fetch_array( $sql_res ) ) {
																$vid_title = $row[ 'vid_title' ];
																$vid_id = $row[ 'vid_id' ];
																$array2[] = $row[ 'vid_id' ];
																$vid_url = $row[ 'vid_url' ];
																?>
															<div class="col-md-3 col-sm-3 col-xs-6">
																<div class="thumb"><a href="<?php echo " http:// ".$_SERVER['HTTP_HOST']."/watch/ ".$vid_id."/ ". txtcleaner($vid_title);?>"><img onerror="this.src='/default.jpg'"
                                                                        src="https://i.ytimg.com/vi/<?php echo $vid_url?>/mqdefault.jpg"
                                                                        alt="" class="img-responsive"/></a>

																	<div class="caption">
																		<div class="description">
																			<a title="<?php echo $vid_title; ?>" href="<?php echo " http:// ".$_SERVER['HTTP_HOST']."/watch/ ".$vid_id."/ ". txtcleaner($vid_title);?>">
																				<?php echo substr($vid_title, 0, 45)?>
																			</a>
																		</div>
																	</div>
																</div>
															</div>
															<?php } ?>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-right col-sm-5">
							<?php include('subs/sidebar.php'); ?>
							<div class="related-news section-category">
								<div class="section-name">
									<a href="#">Related Videos</a>
								</div>
								<div class="section-content">
									<div class="related-news-list">
										<?php
										$sql_res = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "select * from videos where vid_status='publish' and vid_id!='$mvid_id' and vid_id NOT IN ('" . implode( "','", $array ) . "') and vid_id NOT IN ('" . implode( "','", $array2 ) . "') ORDER BY `vid_id` DESC LIMIT 4" );
										while ( $row = mysqli_fetch_array( $sql_res ) ) {
											$vid_title = $row[ 'vid_title' ];
											$vid_id = $row[ 'vid_id' ];
											$vid_doc = $row[ 'vid_doc' ];
											$vid_url = $row[ 'vid_url' ];
											$vc_id = $row[ 'vc_id' ];
											if ( $row[ 'vid_type' ] == 0 ) {
												$img_src3 = 'http://img.youtube.com/vi/' . $vid_url . '/mqdefault.jpg';
											} else {
												$img_src3 = 'http://www.crwetube.com/image/thumbnail/' . $vid_url . '.jpg';
											}
											$vc_id = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "SELECT * FROM vid_cat where `vc_id`='$vc_id' and vc_status='publish'" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
											while ( $vc_result = mysqli_fetch_array( $vc_id ) ) {
												$vc_name = $vc_result[ 'vc_name' ];
											}

											?>

										<div class="media">
											<div class="media-left"><a title="<?php echo $vid_title; ?>" href="<?php echo " http:// ".$_SERVER['HTTP_HOST']."/watch/ ".$vid_id."/ ". txtcleaner($vid_title);?>"><img onerror="this.src='/default.jpg'" width="98" src="<?php echo $img_src3?>" alt=""
                                                    class="media-object"/></a>
											</div>
											<div class="media-body">
												<div class="media-heading">
													<div class="title">
														<a title="<?php echo $vid_title; ?>" href="<?php echo " http:// ".$_SERVER['HTTP_HOST']."/watch/ ".$vid_id."/ ". txtcleaner($vid_title);?>">
															<?php echo $vid_title?>
														</a>
													</div>
												</div>
												<div class="info">
													<span class="category">
														<?php echo $vc_name?>
													</span><span class="fa fa-circle"></span>
													<span class="date-created">
														<?php echo $vid_doc?>
													</span>
												</div>
											</div>
										</div>

										<?php } ?>


									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<!--side geo ad-->
							<?php include('ads/geo-side-ads.php'); ?>
							<!--side geo ad-->
							<div class="clearfix"></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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