<?php
include('subs/header.php');

?>
<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->
    <div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
            <div class="content">
                <div class="container">				
                    <div class="row">
                        <div class="col-md-8 col-left col-sm-7">
                            <ul class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li class="active">Videos</li>
                                
                            </ul>
                        </div>
                        <div class="col-md-4 col-right col-sm-4">
							<div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span></div>
						</div>
                    </div>
                    <!-- Video-->						
					<div class="row">
						<div class="col-md-12">
									<div class="top-videos section-category">
										<div class="section-name"><a href="#">Hot Videos</a></div>
											<!--ad only for ipad -->
												<div class="ipad-ads col-md-12">
													<?php include('ads/729ad.php')?> 
												</div>
												<!--ad only for ipad end -->
										<div class="section-content">
                                        <div class="row">
                                        <?php 
													
													$vid = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos where vid_status='publish' and hot_video='hot_video' ORDER BY vid_id DESC limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
													$vidresults = mysqli_fetch_array($vid);
													$vid_title = $vidresults['vid_title'];
													$vid_url = $vidresults['vid_url'];
													$vid_id = $vidresults['vid_id'];
													if($vidresults['vid_type']==0)
													{$img_src3='http://img.youtube.com/vi/'.$vid_url.'/mqdefault.jpg';} 
													else {$img_src3='http://www.crwetube.com/image/thumbnail/'.$vid_url.'.jpg'; }
													
															
											  ?>    
                                            <div class="col-md-6 col-sm-6 col-xs-12">
													<a title="<?php echo $vid_title; ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/watch/".$vid_id."/". txtcleaner($vid_title);?>" class="thumb mbn">
                                                    <img onerror="this.src='/default.jpg'" src="<?php echo $img_src3?>"  width="556" height="324" style="width:556px; height:324px" class="img-responsive"/>

													<div class="img-cate"><i class="fa fa-video-camera"></i></div>
													<div class="caption"><?php echo $vid_title?></div>
												</a>
											</div>
											
											<div class="top-space">&nbsp;</div>
                                           
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="row">
                                                   <?php 
												   $vid = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos where vid_status='publish' and hot_video='hot_video' ORDER BY vid_id DESC limit 4 offset 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
													while($vidresults = mysqli_fetch_array($vid))
													{
													$vid_title = $vidresults['vid_title'];
													$vid_url = $vidresults['vid_url'];
													$vid_id = $vidresults['vid_id'];
													if($vidresults['vid_type']==0)
													{$img_src2='http://img.youtube.com/vi/'.$vid_url.'/mqdefault.jpg';} 
													else {$img_src2='http://www.crwetube.com/image/thumbnail/'.$vid_url.'.jpg'; }
													
															
											  ?> 
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
														<a title="<?php echo $vid_title; ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/watch/".$vid_id."/". txtcleaner($vid_title);?>" class="thumb">
                                                        <img onerror="this.src='/default.jpg'" src="<?php echo $img_src2?>" class="img-responsive"/>
															<div class="img-cate"><i class="fa fa-video-camera"></i></div>
															<div class="caption"><?php echo $vid_title?></div>
														</a>
													</div>
                                                  <?php } ?>
                                                </div>                                                
                                            </div>
											
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
					<!-- End Video -->
					<!-- LATEST ARTICLES-->
                    <div class="row">
                        <div class="col-md-8 col-left col-sm-7">
                            <div class="latest_articles section-category">
                                <div class="section-name">
									<!-- ad for desktop -->
											<div class="desktop-ads">
												<?php include('ads/729ad.php')?> 
											</div>
										<!--End ad for desktop --> <br />
                                    <div class="pull-left"><a href="#">Latest Videos</a></div>                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="section-content">
                                    <div class="row">
                                    <?php 
 														$bd = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos WHERE vid_status='publish' and hot_video!='hot_video' ORDER BY vid_id DESC limit 24") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
														while($info = mysqli_fetch_array( $bd )) 
															{ 
																$vid_title=$info['vid_title']; 
																$vid_id=$info['vid_id']; 																
																$vid_url=$info['vid_url']; 
																$vid_doc=$info['vid_doc']; 
																$vc_id=$info['vc_id'];
																$vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$vc_id' and vc_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
																while($vc_result = mysqli_fetch_array($vc_id))
																{
																$vc_name=$vc_result['vc_name'];
																}
																if($info['vid_type']==0)
																{
																$img_src1='http://img.youtube.com/vi/'.$vid_url.'/mqdefault.jpg';
																} else {$img_src1='http://www.crwetube.com/image/thumbnail/'.$vid_url.'.jpg'; }
											  ?> 
                                        <div class="col-md-4 col-sm-6 col-xs-6">
                                            <div class="thumb">
												<div class="img-cate"><i class="fa fa-video-camera"></i></div>
													<a title="<?php echo $vid_title; ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/watch/".$vid_id."/". txtcleaner($vid_title);?>">
														<img onerror="this.src='/default.jpg'" src="<?php echo $img_src1?>" class="img-responsive"/></a>
													
													<a title="<?php echo $vid_title; ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/watch/".$vid_id."/". txtcleaner($vid_title);?>" class="title"><?php echo substr($vid_title, 0, 45)."...";?>
														<div class="info">
															<span class="category"><?php echo $vc_name?></span>
															<span class="fa fa-circle"></span>
															<span class="date-created"><?php echo $vid_doc?></span>
														</div>
													</a>
											</div>
                                        </div>
                                         <?php } ?>
                                      
                                       
                                    </div>
                                </div>
                            </div>                           
                        </div>
                        <div class="col-md-4 col-right col-sm-5">
							<!-- category-->
                            <div class="categories section-category">
                                <?php include('subs/sidebar.php'); ?> 
                                <div class="section-name">
                                <a href="#">Channels</a></div>
                                <div class="section-content">
                                    <ul class="list-unstyled">
                                    <?php  										
										$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where vc_status='publish' ORDER BY vc_id") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
										while($vid_cat = mysqli_fetch_array($sql))
										{
										$vc_name=$vid_cat['vc_name'];
										$vc_id=$vid_cat['vc_id'];
										$vc_name=$vid_cat['vc_name'];
									 ?> 
                                        <li><a title="<?php echo $vid_title; ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/channel/".$vc_id."/". txtcleaner($vc_name);?>" class="title"><?php echo $vc_name?></a></li>
                                          <?php } ?>
                                    </ul>
                                </div>
                            </div>                            
                             <!--side geo ad-->
                                    <?php include('ads/geo-side-ads.php'); ?>                                    
                            <!--side geo ad-->

                           
                            
                        </div>
                    </div>
                </div>
               
               
            </div>
        </div>
    </div>
<?php include('subs/footer.php') ?>