<?php 
include('subs/header.php'); 
if(isset($_SESSION['pub_id']))
{$pub_id=$_SESSION['pub_id'];$href='javascript:void(0);';
 $user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where id='$pub_id' and active='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
}else{$pub_id=-1;$href='/dashboard/login';}
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
                                <li><a href="#">Symbol</a></li>
                                <li><a href="#"><?php echo $symbolInfo->symbol;?></a></li>
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
											<?php /*?><div class="desktop-ads">
												<?php include('ads/729ad.php')?> 
											</div><?php */?>
										<!--End ad for desktop -->
                                        <div class="section-content">
											<div class="title-news">
												<div class="pull-right"><?php 
													if(!isset($_SESSION['pub_id'])){ 
														echo '<a href="/dashboard/login" class="btn">Watch</a>'; } 
													else{ 
																$watchid=classLiked($symbolInfo->symbol,$user->watchlist);
																if($watchid=='liked'){$watch='Watching';}else{$watch='Watch';}
																echo '<a href="'.$href.'" data-sym="'.$symbolInfo->symbol.'" class="watch btn '.$watchid.'" >'.$watch.'</a>';}
													?></div>
												<?php echo $symbolInfo->name.' ('.$symbolInfo->symbol.')'; ?>	
												<table width="22%" border="0"><tbody><tr><td style="text-align: right;"><b class="openval"></b></td><td><b class="change"><span class="text-success"></span></b></td></tr></tbody></table>	
											</div>
											

                                            <div class="info-news">
                                                <div class="pull-left">
                                                    <div class="info"><span class="category">Symbol</span>
                                                    <span class="fa fa-circle"></span>
                                                    <div class="comments"><a href="#people-comment"><i class="fa fa-users"></i> <div style="display: inline;"><?php echo $symbolInfo->watchers;?> Watchers</div></a></div>
                                                    <span class="fa fa-circle"></span>
                                                    <div class="comments"><a href="#people-comment"><i class="ion-android-chat mrs"></i><div style="display: inline;"><?php echo $symbolInfo->views?> Views</div></a></div>
                                                    </div>
                                                </div>
                                                <div class="pull-left">                                                    
                                                    <div class="share-link"><span class='st_facebook' displayText='Facebook'></span>
													<span class='st_twitter' displayText='Tweet'></span>
													<span class='st_linkedin' displayText='LinkedIn'></span>
													<span class='st_googleplus' displayText='Google +'></span>
													<span class='st_reddit' displayText='Reddit'></span>
													<span class='st_digg' displayText='Digg'></span>
													<span class='st_vkontakte' displayText='VKontakte'></span>
													<span class='st_stumbleupon' displayText='Stumbleupon'></span>
													<span class='st_email' displayText='Email'></span>
													<span class='st_sharethis' displayText='ShareThis'></span></div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="main-news" style="overflow: visible">   
                                               <?php if($symbolInfo->exchange!='ASX' and $symbolInfo->exchange!='TASE' and $symbolInfo->exchange!='EURONEXT'){ ?>                                             
                                                <!-- TradingView Widget BEGIN -->
													<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
													<script type="text/javascript">
													new TradingView.widget({
													  "width": "100%",
													  "height":250,
													  "symbol": "<?php echo $symbolInfo->exchange.':'.$symbolInfo->symbol; ?>",
													  "interval": "1",
													  "timezone": "Etc/UTC",
													  "theme": "Light",
													  "style": "3",
													  "locale": "en",
													  "toolbar_bg": "#f1f3f6",
													  "enable_publishing": false,
													  "hide_top_toolbar": true,
													  "save_image": false,
													  "hideideas": true,
													});
													</script>                              					
                               					<!-- TradingView Widget END -->
                                                <?php } ?>												
                                                <div style="padding-top: 10px;">
                                                <p style="font-size:11px"> Use of this site indicates acceptance of the <a href="/privacy_policy" target="_blank">Privacy&nbsp;Policy</a> and <a href="/terms_conditions" target="_blank">Terms of Use</a>. The information on this Website is not&nbsp;reliable and not intended to provide tax, legal, or investment advice.&nbsp;Nothing contained on the Website shall be considered a recommendation,&nbsp;solicitation, or offer to buy or sell a security to any person in any&nbsp;jurisdiction. CRWEWorld Stocks' members discuss large-cap, mid-cap, small-Cap&nbsp;stocks, and sometimes high-risk penny stocks which can lose their entire&nbsp;value. Only risk what you can afford to lose. The news, reports, views&nbsp;and opinions of CRWEWorld Stocks' members (or source) expressed are&nbsp;their own and do not necessarily represent the views of CRWE World. <!--Crown Equity Holdings Inc. has received $5,000.00 (five thousand dollars) in cash from Nass Valley Gateway Ltd.  (CSE:NVG) (FSE:3NVN) for 30 days of advertisement services.--> <a href="/finance_disclaimer" target="_blank">Disclaimer</a> </p>
                                                
                                                <p>$ should preceed stock symbol. e.g. $ABCD</p>
												  <?php
													if(isset($_SESSION['pub_id'])){
														$symboltag='<a class="pretty-link" href="#"><s>$</s>'.$symbolInfo->link.'</a>&nbsp;';
														cmtform($symboltag);
													} else{
														echo '<h4>You need to be logged in to post a comment in this stock</h4>';
													}
												   ?>
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
													  <!--<div class="err_cmt alert alert-danger" style="display: none">
														<strong>Error!</strong> <span class="err_msg"></span>
													  </div>
													  <div class="success_cmt alert alert-success" style="display: none">
														<strong>Success!</strong> <span>Posted</span>
													  </div>
													<form action="#" class="frmUpload" enctype="multipart/form-data">  
														<div class="panel comment-box">
															<div class="panel-body">
																<div name="comment" id="comment" class="comment plaintext" contenteditable="true" spellcheck="true" role="textbox" aria-multiline="true" placeholder="Share your idea $symbol/@username" dir="ltr"></div>
																<div id="list_sym" style="width: 100%"></div>
															</div>
															<div class="panel-footer clearfix">
																<ul class="nav nav-pills pull-left">
																	<li role="presentation"><input id="stock_image" name="stock_image[]" type="file"  accept="image/jpeg,image/x-png" multiple  /><a href="#"><i class="fa fa-camera"></i></a></li>
																	<div class="imgprv"></div>
																</ul>
																<button id="post_cmt" class="btn btn-primary pull-right">Post</button>
																<div class="pull-right" style="padding: 9px;"><span class="rchars">140</span></div>
															</div>
														</div>
													</form>-->

													<div class="converstation">
													<?php
														$countsql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM `stock_comments` WHERE FIND_IN_SET ('$symbolInfo->link', `symbol_tag`)")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
														$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_comments` WHERE FIND_IN_SET ('$symbolInfo->link', `symbol_tag`) order by `id` DESC limit 2")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
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
								<table class="table table-hover stockTable"></table>
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
	include('subs/visit_counter.php');
	include('subs/footer.php'); ?>