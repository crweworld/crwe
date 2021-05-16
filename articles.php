<?php
include('subs/header.php'); 
?>
<div id="wrapper"><!-- PAGE WRAPPER-->
    <div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
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
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Articles</a></li>
                            <li><a href="#"><?php echo ucfirst($cat->cat_name)?></a></li>
                            <!-- Meta Tags -->
                            <!-- Meta Tags -->
                        </ul>
                    </div>
                    <div class="col-md-4 col-right col-sm-4">
                        <div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21ьз╕ C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span></div>
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
                                        <h1 class="title-news">
												<a href="#"><?php echo htmlspecialchars_decode($posts->post_title)?></a>
											</h1>

                                        <div class="info-news">
                                            <div class="pull-left">
                                                <div class="info"><span class="category"><?php echo ucfirst($cat->cat_name)?></span>
                                                    <span class="fa fa-circle"></span><span class="date-created"><?php echo $posts->post_doc?></span>
                                                    <span class="fa fa-circle"></span>
                                                    <div class="comments"><a href="#people-comment"><i class="ion-android-chat mrs"></i><div style="display: inline;"><?php echo $posts->post_view?> Views</div></a></div>
                                                </div>
                                            </div>
                                            <div class="pull-left">
												<div class="share-link">
													<span class='st_facebook' displayText='Facebook'></span>
													<span class='st_twitter' displayText='Tweet'></span>
													<span class='st_linkedin' displayText='LinkedIn'></span>													
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
                                            <?php if(!empty($posts->post_image_loc != NULL)){ ?>
                                            <div class="image-news pull-left mrxxl image-one">
                                            	<img onerror="this.src='/default.jpg'" width="100%" src="<?php echo $posts->post_image_loc?>" alt="" class="img-responsive"> 
                                            </div>
                                            <?php } ?> 
                                            <p><?php echo str_replace("\'","'",htmlspecialchars_decode($posts->post_description))?></p>

                                            <div class="image-news pull-left mrxxl image-two">
                                                <?php  if($posts->source_url!== '' and $posts->source_url!== NULL){?>
                                                    <div class="info-image"><a target="_blank" href="<?php echo $posts->source_url?>"><span>Read More..</span></a></div> 
                                               <?php } if($posts->admin_id=="0" and $posts->user_id!="0"){
                                               echo '<span style="font-size:11px"> The Views and Opinions expressed in this article are the author\'s own and do not necessarily reflect those of this Web-Site or its agents, affiliates, officers, directors, staff, or contractors.</span>'; } else { 
                                         	   echo '<span style="font-size:11px"> The news, reports, views and opinions of authors (or source) expressed are their own and do not necessarily represent the views of CRWE World.</span><br></br>
                                         	   '; } ?>                                         	   
                                         	   </br>
                                         	   <!--<h2>Sponsored Post</h2>-->
                                         	   

<p><h2><strong><a title="The best buffet in Las Vegas just got better with a multimillion-dollar refresh featuring all-new design enhancements" href="http://crweworld.com/article/news-provided-by-pr-newswire/1988216/bacchanal-buffet-to-reopen-at-caesars-palace-on-may-20" target="_blank">Bacchanal Buffet to Reopen at Caesars Palace on May 20</a></strong></h2></p>


<p></p>
 
                                <!--<h2>Video</h2>-->
<!--<iframe width="560" height="315" src="https://crwetube.com/embed/1573572100" frameborder="0" allowfullscreen></iframe>-->

                                         	  
                                         	   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
												<!-- 728x90, created 5/20/10 -->
												<ins class="adsbygoogle"
													 style="display:inline-block;width:730px;height:90px"
													 data-ad-client="ca-pub-5763758713432929"
													 data-ad-slot="8409592543"></ins>
												<script>
												(adsbygoogle = window.adsbygoogle || []).push({});
												</script>
												<br></br><a title="Share knowledge about stocks and investing ideas on CRWEWorld Stocks" href="/stock-track" target="_blank"><img alt="/assets/img/cw-stocks.png" src="/assets/img/cw-stocks.png"></a>
												
												<br></br><a title="Wysh Jewels - Authentic Dominican Larimar & Amber Stone Jewelry" href="http://crweworld.com/g_click_tracker/12111fa3fe9c1860a7a68aa73c25b7207607142bf6fd/b116" target="_blank"><img alt="/assets/img/wysh-jewels.png" src="/assets/img/wysh-jewels.png"></a>
												
												<br></br><a title="Hancock Jaffe Laboratories Inc. (Nasdaq:HJLI)" href="http://crweworld.com/g_click_tracker/fcb82ed18fb3f0573ec20537e3ebeea62c7216a55179/b112" target="_blank"><img alt="/assets/img/hjli.png" src="/assets/img/hjli.png"></a>
												
												 <br></br><a title="Mars Parachutes - Fly Safe Drone Parachutes" href="http://crweworld.com/g_click_tracker/dfa9d7670753d2e2f0f21f668e43672093e968a5b8c6/b113" target="_blank"><img alt="/assets/img/Mars-Parachute-2.png" src="/assets/img/Mars-Parachute-2.png"></a>
												<br></br><a title="Submit Your Podcast to CRWEWorld" href="/podcast" target="_blank"><img alt="/assets/img/crweworld-podcast.jpg" src="/assets/img/crweworld-podcast.jpg"></a>
                                            	
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="people-comment" class="comment-news">
                                        <!--<div class="comment-info"></div>-->
                                        <div class="comment-form">

                                            <div class="comment-write">
                                                <div class="media">

                                                    <div class="section-name"><a href="#">Sponsored</a></div>
														<ins class="adsbygoogle"
															 style="display:inline-block;width:100%;"
															 data-ad-format="autorelaxed"
															 data-ad-client="ca-pub-5763758713432929"
															 data-ad-slot="3807424756"></ins>
														<script>
															 (adsbygoogle = window.adsbygoogle || []).push({});
														</script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="amzn-assoc-ad-affb610e-fdf1-4ce3-9177-4b5d2e83bb45"></div>
                                    <div class="also-read section-category">
                                        <div class="section-name">
                                            <div class="pull-left"><a href="#">Also read</a></div>
                                            <div class="pull-right"><a href="#also-read-carousel" data-slide="next" class="right carousel-control"><span class="fa fa-angle-right"></span></a><a href="#also-read-carousel" data-slide="prev" class="left carousel-control"><span class="fa fa-angle-left"></span></a></div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="also-read-carousel" data-interval="false" class="carousel slide">
                                            <div class="carousel-inner">
                                               <?php $loop=1; while($loop<=2){  ?>
                                                <div class="item <?php if($loop==1){ echo 'active';}?>">
                                                    <div class="row man">
                                                       <?php
														$rmv_id[]=$_GET['post_id'];				  
														$sql=mysqli_query($GLOBALS["___mysqli_ston"], "select * from posts where post_status='publish' and user_id=0 and post_id NOT IN ('" . implode("','",$rmv_id) . "') Order by post_id DESC LIMIT 4");
														while($row=mysqli_fetch_array($sql))
														{
														$rmv_id[]=$row['post_id'];
														echo '
														<div class="col-md-3 col-sm-3 col-xs-6">
                                                            <div class="thumb">
                                                                <a title="'.$row['post_title'].'" href="'.$row['post_url'].'"><img onerror="this.src=\'/default.jpg\'" src="'.$row['post_image_loc'].'" alt="" class="img-responsive"></a>
                                                                <div class="caption">
                                                                    <div class="description"><a title="'.$row['post_title'].'" href="'.$row['post_url'].'">'.$row['post_title'].'</a></div>
                                                                </div>
                                                            </div>
                                                        </div>';
															}?>   
                                                    </div>
                                                </div>
                                               <?php $loop++;}?> 
                                            </div>
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
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('subs/visit_counter.php') ?>
<!--Share it-->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "33eb4b24-b7ed-4b8f-9245-385d5515c1bc", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
 <?php include('subs/footer.php') ?>