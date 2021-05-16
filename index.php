<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('subs/header.php');
?>

<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->
    <div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
            <div class="content">
                <div class="container">
                    <div class="row mbxxl">
                        <div class="col-md-8 col-left col-sm-7">
                         <?php //include('ads/729ad.php')?>
                            <div class="breaking-news">
                                <div class="row">
                                    <div class="col-md-2 prn col-sm-3"><label>Stocks:</label></div>
                                    <div class="col-md-10 pln col-sm-9" style="margin: 8px 0px;">
                                        <div class="vticker">
                                            <ul class="list-unstyled">
                                            <?php $breaking_news = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM breaking_news where bn_status='publish' ORDER BY bn_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
													while($results = mysqli_fetch_array($breaking_news))
													{
											  ?>
                                                <li><a title="<?php echo $results['bn_title']?>" href="<?php echo $results['bn_link']?>"><?php echo $results['bn_title']?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                     <?php /*?>       <div class="slider-news">
                                <div id="carousel" data-ride="carousel" class="carousel slide mbs">
                                    <div class="carousel-inner">                                        
                                        <?php
															
											$bd = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE post_status='publish' and slider='slider'  ORDER BY post_id desc limit 4") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
											$counter1 = 0;
											while($info = mysqli_fetch_array( $bd )) 
												{  													
													$rmv_id[]=$info['post_id'];
													$counter1++;
													$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_status='publish' and `cat_id`='{$info['cat_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 													 
													while($cat_result = mysqli_fetch_array($cat_id))
													{
														$cat_name=$cat_result['cat_name'];
													}															
											  ?>               
                                                                      
                                        <div class="item <?php if($counter1==1){echo'active';}?>">
                                        <a href="<?php echo $info['post_url']?>">
                                            <div class="row">
                                                <div class="col-md-4 prn col-sm-4">
                                                    <div class="caption">
                                                        <h1 class="title"><?php echo $info['post_title']?></h1>
                                                        <div class="info"><span class="category"><?php echo $cat_name?></span><span
                                                                class="fa fa-circle"></span><span class="date-created"><?php echo $info['post_doc']?></span>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-8 pln col-sm-8"><img onerror="this.src='/default.jpg'"
                                                        src="<?php echo $info['post_image_loc']?>" alt="<?php echo $info['post_title']?>"
                                                        class="img-responsive"/></div>
                                            </div>
                                            </a>
                                        </div>
                                        
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="thumbcarousel" data-interval="false" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <div class="row man">
                                                
                                                <?php 
 														$bd = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE post_id IN ('" . implode("','",$rmv_id) . "') ORDER BY FIELD(post_id,'" . implode("','",$rmv_id) . "')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
														$counter = -1;
														while($info = mysqli_fetch_array( $bd )) 
															{   
															 $counter++; 
											  ?> 
                                                
                                                <div class="col-md-3 col-sm-3 col-xs-6 box-style-padding">
                                                    <div data-target="#carousel" data-slide-to="<?php echo $counter?>" class="thumb"><img onerror="this.src='/default.jpg'" src="<?php echo $info['post_image_loc']?>" alt="<?php echo $info['post_title']?>"
                                                            class="img-responsive"/>

                                                        <div class="caption">
                                                            <div class="description"><?php echo substr($info['post_title'], 0, 45); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <?php } ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                   </div>
                            </div><?php */?>

                           
                          <!-- Latest News-->
                            <?php 
								$post_city=str_replace("'","''","$post_city");
								$post_state=str_replace("'","''","$post_state");
								$post_country=str_replace("'","''","$post_country");
								$count=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts WHERE post_city='$post_city' and trend='' ")); 
								$count2 =mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts WHERE post_city='$post_city' AND (( post_state ='$post_state' AND trend='trend_state')
								OR ( post_country ='$post_country' AND trend='trend_country')
								OR (post_continent ='$post_continent' AND trend='trend_continent'))")); 
								// Latest News 
								if($count['count(*)'] < 1)
								{	$topic="Latest News"; 
									$topic_sql="and cat_id NOT IN (18,25,34,35,37,39,41,45,47,48,49,50) and trend is NULL"; 		
								 	$topic_url='#';
								}
								// Local News
								else 
								{   $topic="Local News"; 
									$topic_sql="and trend='localnews' and post_city='$post_city'"; 
								 	$topic_url="/localnews";
								}
								include ('subs/home_news.php');
							
								// GLOBENEWSWIRE
								$topic="NEWS PROVIDED BY GLOBENEWSWIRE"; 
								$topic_sql="and cat_id='35'"; 
								$topic_url="/category/35/gbn-press-releases";							
								include ('subs/home_news.php');
							
								// PR NEWSWIRE
								$topic="NEWS PROVIDED BY PR NEWSWIRE"; 
								$topic_sql="and cat_id='34'"; 
								$topic_url="/category/34/prn-press-releases";							
								include ('subs/home_news.php');
							
								// BUSINESS WIRE
								$topic="NEWS PROVIDED BY BUSINESS WIRE"; 
								$topic_sql="and cat_id='39'"; 
								$topic_url="/category/39/news-provided-by-business-wire";							
								include ('subs/home_news.php');
							
								// ACCESSWIRE
								$topic="NEWS PROVIDED BY ACCESSWIRE"; 
								$topic_sql="and cat_id='37'"; 
								$topic_url="/category/37/aw-press-releases";							
								include ('subs/home_news.php');

                                 // NEWS PROVIDED BY CRWE PRESS RELEASE
								$topic="NEWS PROVIDED BY CRWE PRESS RELEASE"; 
								$topic_sql="and cat_id='50'"; 
								$topic_url="/category/50/News-Provided-By-CRWE-PRESS-RELEASE";							
								include ('subs/home_news.php');
  
							
								//  NewsDirect
								$topic="NEWS PROVIDED BY News Direct"; 
								$topic_sql="and cat_id='49'"; 
								$topic_url="/category/49/news-provided-by-news-direct";							
								include ('subs/home_news.php');
							
								//  MEDIA OUTREACH
								$topic="NEWS PROVIDED BY MEDIA OUTREACH"; 
								$topic_sql="and cat_id='45'"; 
								$topic_url="/category/45/media-outreach";							
								include ('subs/home_news.php');
							
								//  ACN
								$topic="NEWS PROVIDED BY ACN Newswire"; 
								$topic_sql="and cat_id='47'"; 
								$topic_url="/category/47/News-Provided-by-ACN-Newswire";							
								include ('subs/home_news.php');

								//  JCN
								$topic="NEWS PROVIDED BY JCN Newswire"; 
								$topic_sql="and cat_id='48'"; 
								$topic_url="/category/48/News-Provided-by-JCN-Newswire";							
								include ('subs/home_news.php');
							
								// Trending
								if($count2 > 1)
								{
									$topic="Trending Now"; 
									$topic_sql="AND (( post_state ='$post_state' AND trend='trend_state') OR ( post_country ='$post_country' AND trend='trend_country') OR (post_continent='$post_continent' AND trend='trend_continent'))"; 
									$topic_url="/trendingnow";
									include ('subs/home_news.php');
								}							 
							?>                                
 						</div>
   
                        <div class="col-md-4 col-right col-sm-5">                       
                            
                         <!-- weather-->
                             <div id="weather-news" class="section-category">
                                <div class="section-name">
                                    <div class="pull-left"><a href="#">Weather</a></div>
                                    <div class="pull-right">
                                        <div class="location-link"><a href="#"><i class="fa fa-location-arrow mrs"></i><?php echo $api_state?></a></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="section-content">
                                    <div class="today-weather">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <img src="https://openweathermap.org/img/w/01d.png" style="width: 100%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" />
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-4">
                                                <div  class="city-weather-description info" id="city-weather-description"><p>sunny</p>
                                                    <small></small>
                                                </div>
                                            </div>
                                        </div>                                       
                                    </div>                                    
                                </div>
                            </div>
                            
                             <?php include('subs/sidebar.php'); ?>                             
                             
                              <!--side geo ad-->
                             <?php include('ads/geo-side-ads.php'); ?>                              
                            <!--side geo ad-->
                           
                        </div>
                    </div>
                </div>
<div id="category-topics">
                    <div class="container">
                      <!--  <div class="row">
                        	 category
                        </div>-->
                      
                        <div class="row">
                            <div class="col-md-12">
                                <div id="video-gallery" class="section-category mbn">
                                    <div class="section-name"><a href="/videos">Video Gallery</a></div>
                                    <div class="section-content">
                                        <div class="row">
                                        <?php 
													
													$vid = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos where vid_status='publish' and hot_video='hot_video' ORDER BY vid_id DESC limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
													$vidresults = mysqli_fetch_array($vid);
													$vid_title = $vidresults['vid_title'];
													$vid_url = $vidresults['vid_url'];
													$vid_id = $vidresults['vid_id'];
													if($vidresults['vid_type']==0)
											{
											$img_src3='https://img.youtube.com/vi/'.$vid_url.'/mqdefault.jpg';
											} else {$img_src3='https://www.crwetube.com/image/thumbnail/'.$vid_url.'.jpg'; }
													
															
											  ?>    
                                            <div class="col-md-6 col-sm-6 col-xs-12 box-video-left"><a title="<?php echo $vid_title; ?>" href="<?php echo "/watch/".$vid_id."/". txtcleaner($vid_title);?>"
                                                                                                       class="thumb mbn"><img onerror="this.src='/default.jpg'" width="556" height="324" style="width:556px; height:324px" src="<?php echo $img_src3?>" alt="youtube"
                                                    class="img-responsive"/>

                                                <div class="img-cate"><i class="fa fa-video-camera"></i></div>
                                                <div class="caption"><?php echo $vid_title?></div>
                                            </a></div>
                                           
                                            <div class="col-md-6 col-sm-6 col-xs-12 box-video-right">
                                                <div class="row">
                                                   <?php 
												   $vid = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos where vid_status='publish' and hot_video='hot_video' ORDER BY vid_id DESC limit 4 offset 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
													while($vidresults = mysqli_fetch_array($vid))
													{
													$vid_title = $vidresults['vid_title'];
													$vid_url = $vidresults['vid_url'];
													$vid_id = $vidresults['vid_id'];
													if($vidresults['vid_type']==0)
											{
											$img_src2='https://img.youtube.com/vi/'.$vid_url.'/mqdefault.jpg';
											} else {$img_src2='https://www.crwetube.com/image/thumbnail/'.$vid_url.'.jpg'; }
													
															
											  ?> 
                                                    <div class="col-md-6 col-sm-6 col-xs-6 box-style-padding"><a title="<?php echo $vid_title; ?>"
                                                            href="<?php echo "/watch/".$vid_id."/".txtcleaner($vid_title);?>" class="thumb"><img onerror="this.src='/default.jpg'"
                                                            src="<?php echo $img_src2?>" alt="youtube"
                                                            class="img-responsive"/>

                                                        <div class="img-cate"><i class="fa fa-video-camera"></i></div>
                                                        <div class="caption"><?php echo $vid_title?></div>
                                                    </a></div>
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
            </div>
        </div>
    </div>
    <!--POP UP-->   

<?php include('subs/footer.php') ?>                          
                            
                      