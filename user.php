<?php 
if($_GET['username']=='malonebailey'){header ("location:/stock-track"); exit();}
include('subs/header.php');
if(isset($_SESSION['pub_id'])){$pub_id=$_SESSION['pub_id'];$href='javascript:void(0);';  }
else{$pub_id=-1;$href='/dashboard/login';}
?>
<script src="/assets/js/jquery-1.11.2.min.js"></script>	
<link href="/assets/css/featherlight.min.css" type="text/css" rel="stylesheet" />
<script src="/assets/js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->
<div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
            <div class="content">
                <div class="container">
                    <div class="row">
					<!--ad only for ipad -->
						<div class="ipad-ads col-md-12">
							<?php //include('ads/729ad.php');?> 
						</div>
					<!--ad only for ipad end -->
                        <div class="col-md-8 col-left col-sm-8">
                            <ul class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">User</a></li>
                                <li><a href="#"><?php echo $user->username;?></a></li>
                                <!-- Meta Tags -->

                                <!-- Meta Tags -->
                               
                            </ul>
                        </div>
                         <div class="col-md-4 col-right col-sm-4">
                            <div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span></div>
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
											<div class="title-news">
												
												<div class="pull-right">
												   <?php 
													if(!isset($_SESSION['pub_id'])){ 
														echo '<a href="/dashboard/login" class="btn">Follow</a>'; } 
													else{ 
														if($_SESSION['pub_id']==$user->id){
															echo '<a href="/dashboard/edit_profile.php" class="btn">Edit</a>';} 
														else {
																$follow=classLiked($_SESSION['pub_id'],$user->followers);
																if($follow=='liked'){$follow='Following';}else{$follow='Follow';}
																echo '<button type="submit" name="follow" class="btn '.classLiked($_SESSION['pub_id'],$user->followers).'" id="follow">'.$follow.'</button>';} 
													} ?></div>
												<img class="img-circle" width="100" onerror="this.src='/assets/images/avatar.png'" src="<?php echo $user->pic ?>">
												<?php echo $user->fname.' '.$user->lname .' (@'.$user->username.')'; ?>												
											</div>
											

                                            <div class="info-news">
                                                <div class="pull-left">
                                                    <div class="info"><span class="category" id="<?php echo 'user_'.$user->username.'_'.$user->id;?>">Stock User</span>
                                                    <span class="fa fa-circle"></span><span class="date-created">Member since <?php echo date("jS M, Y", strtotime($user->doc))?></span>
                                                    <span class="fa fa-circle"></span>
                                                    <div class="comments"><a href="#people-comment"><i class="fa fa-users"></i> <div style="display: inline;"><?php echo count($user->followers)?> Followers</div></a></div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="main-news">      
                                               <p>$ should preceed stock symbol. e.g. $ABCD</p>                                            												
                                                <div>
												  <?php
													if(isset($_SESSION['pub_id'])){
														$usertag='';if($_SESSION['pub_id']!=$user->id){$usertag='<a class="pretty-link" href="#"><s>@</s>'.$user->username.'</a>&nbsp;';}
														 cmtform($usertag);
												     }?>	
													<div class="topics-keyword section-category">
														<div class="section-name">
															<form action="/search" class="search-form" method="get">
																<div class="input-icon right">
																	<input style="width:90%; float:left" name="search" placeholder="Stock symbol or Company's name" autocomplete="off" class="form-control searchit" type="text">
																	<input name="searchtype" type="hidden" value="symbol">				
																	<button style="width: 10%;height: 34px;background-color: #CC0101;border: 0;color: #fff;">
																	<i class="ion-android-search"></i>
																	</button>
																</div>
															</form>
															<div id="list_sym2" style="border: 1px solid #c7c7c7; display: none"></div>
														</div>
													</div>
													<table width="100%" border="0">
														<tbody>
															<tr>
																<td><a href="javascript:void(0);" class="profileNav btn1 btn col-md-12 ideasInfo activetab"><span class="txt">Ideas</span></a></td>
																<td><a href="javascript:void(0);" class="profileNav btn1 btn col-md-12 followingInfo"><span class="txt">Following</span></a></td>
																<td><a href="javascript:void(0);" class="profileNav btn1 btn col-md-12 followersInfo"><span class="txt">Followers</span></a></td>
																<td><a href="javascript:void(0);" class="profileNav btn1 btn col-md-12 likedInfo"><span class="txt">Liked</span></a></td>
																<td><a href="javascript:void(0);" class="profileNav btn1 btn col-md-12 watchlistInfo"><span class="txt">Watchlist</span></a></td>
															</tr>
														</tbody>
													</table>

													<div class="converstation">
													<?php
														$countsql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM `stock_comments` WHERE `user_id`='$user->id' or FIND_IN_SET ('$user->username', `user_tag`)")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
														$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_comments` WHERE `user_id`='$user->id' or FIND_IN_SET ('$user->username', `user_tag`) order by `id` DESC limit 2")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
														while($data=mysqli_fetch_array($query))
														{
															$user2 = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE `id`='{$data['user_id']}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
															$stock_image='';
															if($data['stock_image']!= NULL and $data['stock_image']!=''){
																$stock_image='<a data-featherlight="image" href="'.$data['stock_image'].'"><img class="img-responsive" style="margin: 10px 0px;" src="'. $data['stock_image'].'"></a>';}															
															$stock_cmt='';if($data['comment']!= NULL and $data['comment']!=''){ $stock_cmt='<span>'.$data['comment'].'</span>';}
															$refcount=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM `stock_replies` where ref_id='{$data['id']}'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
														?>
															<div class="media" id="media_<?php echo $data['id'];?>">
																<div class="media-left">
																	<a href="/user/<?php echo $user2->username?>">
																		<img class="media-object img-circle" onerror="this.src='/assets/images/avatar.png'" src="<?php echo $user2->pic?>" alt="Avatar">
																	</a>
																</div>
																<div class="media-body">
																	<div class="clearfix">
																		<h4 class="media-heading pull-left">@<?php echo $user2->username; ?></h4>
																		<span class="time pull-right"><?php echo date("jS M, y", strtotime($data['created_on']))?></span>
																	</div>
																	<?php echo $stock_cmt.$stock_image;?>
																	<ul class="nav nav-pills">																		
																		<?php echo '
																		<li><a href="'.$href.'" data-href="/reply/'.$data['id'].'" class="md-more"><i class=" fa fa-comment-o"></i>'.zero($refcount['count(*)']).'</a></li>
																		<li><a href="'.$href.'" class="lik_cmt_'.$data['id'].' '.classLiked($pub_id,$data['liked_by']).' lik_it" id="'.$data['id'].'"><i class="fa fa-thumbs-o-up"></i> <span class="lik_count_'.$data['id'].'">'.zero(count(array_filter((explode(",",$data['liked_by']))))).'</span></a></li>
																		<li><a href="javascript:void(0);" data-href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/user/'.$user2->username.'/message/'.$data['id'].'" class="copy-url"><i class="fa fa-copy"></i></a></li>'; ?>																	
																	</ul>
																	<?php if(isset($_SESSION['id'])){?>
																	<a href="javascript:void(0);" class="del_cmt remove" id="<?php echo $data['id'];?>"><i class="fa fa-times"></i></a>
																	<?php }?>
																</div>
															</div>
													<?php 
															$cmt_id=$data['id'];
														}
														if($countsql['count(*)']>2){
																echo '<a href="#" id="load_more"><div id="'.$cmt_id.'" class="more_button btn" style="width:100%;margin-top: 2em;" >Load More</div></a>';
															}if($countsql['count(*)']==0){
																echo '<a href="'.$href.'">Make your first comment</a>';
															}
													 ?>	

													</div> 
												</div>												
                                                
                                               </div>
                                            <div class="clearfix"></div>
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
 
<?php include('subs/script.php');
	include('subs/footer.php'); ?>