<?php 
include('subs/header.php');
?>
<link type="text/css" rel="stylesheet" href="/assets/css/pages/search_result.css">

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
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="active">Search</li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-right col-sm-4">
                            <div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span></div>
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
                                    <a target="_blank" href="#">Search</a>
                               </div>
                                <div class="section-content">                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="" method="get" class="form-search">  
												<div class="col-md-12">
													<input type="radio" value="articles" <?php if($searchtype=='articles'){ echo 'checked="checked"';} ?> name="searchtype" onChange="this.form.submit()"/> Article
													<input type="radio" value="web" <?php if($searchtype=='web'){ echo 'checked="checked"';} ?> name="searchtype" onChange="this.form.submit()"/> Web
													<input type="radio" value="videos" <?php if($searchtype=='videos'){ echo 'checked="checked"';} ?> name="searchtype" onChange="this.form.submit()"/> Video
													<input type="radio" value="user" <?php if($searchtype=='user'){ echo 'checked="checked"';} ?> name="searchtype" onChange="this.form.submit()"/> User
													<input type="radio" value="symbol" <?php if($searchtype=='symbol'){ echo 'checked="checked"';} ?> name="searchtype" onChange="this.form.submit()"/> Symbol
										    		<div class="flt pull-right"></div>
											    </div>		
												   <br />
												   <br />
												<div class="input-group input-group-lg">
													<input name="search" type="text" autocomplete="off" placeholder="Search for..." <?php if(isset($_GET['search'])){ echo 'value="'.stripslashes($q).'"'; }?> class="form-control" />
													<span class="input-group-btn"><button type="submit" class="btn btn-default">Search </button></span>
												</div>
											</form> 
											<br />
											<?php if(isset($q))
											{
												if($q != '')
												{ 														
												 if($searchtype=='web'){
													 	include('subs/simple_html_dom.php');
														$html = new simple_html_dom();	
													 	$sql_count=new stdClass();
														 if($pageno!=1){
															 $html->load_file('https://www.bing.com/search?q='.str_replace(' ','+',$_GET['search']).$filterweb.'&first='.$pageno.'1');
															 $sql_count->pcount=(int) str_replace(',','',str_replace(" results",'',explode("of ",$html->find('.sb_count',0)->plaintext)[1]));
														 }else{
															 $html->load_file('https://www.bing.com/search?q='.str_replace(' ','+',$_GET['search']).$filterweb);
															 $sql_count->pcount=(int) str_replace(',','',str_replace(" results",'',$html->find('.sb_count',0)->plaintext));
														 }
													 
													 
													 	echo '<div class="show-results"> <strong>'.$sql_count->pcount.'</strong> Results Found </div>
														<br>
														<div id="result-list">';
														foreach($html->find('li.b_algo')as $element) 
														{ 
															$gtitle=$element->find('h2 a',0)->plaintext;
															$gurl=urldecode($element->find('h2 a',0)->href);

															 echo'
																<div class="media">
																	<div class="media-body">
																		<div class="media-heading"><a title="'.htmlspecialchars_decode($gtitle).'" target="_blank" href="'.$gurl.'" class="title">'.htmlspecialchars_decode($gtitle).'</a></div>';
																		if($element->find('div.b_caption > p',0) != null ){
																		 echo'<div class="description">'.strip_tags(htmlspecialchars_decode($element->find('div.b_caption > p',0)->plaintext)).'....Read more</div>';
																		}
															 echo'</div>
																</div>';
														}	
														 echo'</div>';
													// <a href="#"><div id="load_more"><div id="21" class="more_button btn" style="width:100%;margin-top:2em;">Load More</div></div></a>
													  
												 }
												else{													
													if($searchtype=='videos'){
													$query="FROM videos where vid_status='publish' and (vid_title like '%$q%' or vid_description like '%$q%') $vsql ORDER BY `vid_doc` DESC, `vid_id` DESC"; 
													}													
													elseif($searchtype=='user'){
													$query="FROM `user` where active='1' and username!='' and MATCH(username, fname, lname, email, phone) AGAINST('%$q%' IN BOOLEAN MODE)";
													}
													elseif($searchtype=='symbol'){
													$query="FROM symbol_list WHERE `symbol` LIKE '$q%' or `name` LIKE '$q%' or `exchange` LIKE '$q%'";
													}
													else{
													 $query="FROM `posts` where post_status='publish' and (post_title like '%$q%' or post_description like '%$q%') $psql ORDER BY `post_doc` DESC, `post_id` DESC";
													}

													$sql_count=mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) as pcount $query")); 

													echo '<div class="show-results"> <strong>'.$sql_count->pcount.'</strong> Results Found</div>';
												?>
												<div id="result-list">
													<?php 													 
													if($sql_count->pcount != 0)
													{ 
														$sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * $query LIMIT $offset, $no_of_records_per_page") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
														while($search=mysqli_fetch_object($sql))
														{
															if($searchtype=='videos'){
																$_SESSION['rmv_id'][]=$search->vid_id;
																$doc = $search->vid_doc;
																$cat = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$search->vc_id' and vc_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
																$vid_url="/watch/".$search->vid_id.'/'.txtcleaner($search->vid_title);
															  echo'
																<div class="media">
																	<div class="media-body">
																		<div class="media-heading"><a title="'.htmlspecialchars_decode($search->vid_title).'" href="'.$vid_url.'" class="title">'.htmlspecialchars_decode($search->vid_title).'</a></div>
																		<div class="info"><span class="category">'.$cat->vc_name.'</span><span class="fa fa-circle"></span><span class="date-created">'.$search->vid_doc.'</span>
																		</div>
																		<div class="description">'.substr(strip_tags(htmlspecialchars_decode($search->vid_description)), 0, 300).'....Read more</div>
																	</div>
																</div>';															
															}
															elseif($searchtype=='user'){
															  echo'
																<div class="media">
																	<div class="media-left">
																		<a href="/user/'.$search->username.'">
																			<img width="60" class="media-object" onerror="this.src=\'/assets/images/avatar.png\'" src="'.$search->pic.'" alt="Avatar">
																		</a>
																	</div>
																	<div class="media-body">
																		<div class="media-heading"><a href="/user/'.$search->username.'" class="title">'.$search->fname.' '.$search->lname.'</a> (<a href="/user/'.$search->username.'" class="pretty-link">@'.$search->username.'</a>) </div>
																		<div class="info"><span class="category">Stock User</span><span class="fa fa-circle"></span><span class="date-created">Member since '.date("jS M, Y", strtotime($search->doc)).'</span>
																		</div>
																		<!--<div class="description">....Read more</div>-->
																	</div>
																</div>';															
															}
															elseif($searchtype=='symbol'){
															  echo'
																<div class="media">
																	<div class="media-body">
																		<div class="media-heading"><a href="/symbol/'.$search->link.'" class="title">'.$search->name.'</a> (<a href="/symbol/'.$search->link.'" class="pretty-link">$'.$search->link.'</a>) </div>
																		<div class="info"><span class="category">Symbol</span><span class="fa fa-circle"></span><span class="date-created">'.$search->watchers.' Watchers</span>
																		</div>
																		<!--<div class="description">....Read more</div>-->
																	</div>
																</div>';															
															}
															else{															
																$_SESSION['rmv_id'][]=$search->post_id;
																$doc = $search->post_doc;
																$cat = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$search->cat_id' and cat_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
															  echo'
																<div class="media">
																	<div class="media-body">
																		<div class="media-heading"><a title="'.htmlspecialchars_decode($search->post_title).'" href="'.$search->post_url.'" class="title">'.htmlspecialchars_decode($search->post_title).'</a></div>
																		<div class="info"><span class="category">'.$cat->cat_name.'</span><span class="fa fa-circle"></span><span class="date-created">'.$search->post_doc.'</span>
																		</div>
																		<div class="description">'.substr(strip_tags(htmlspecialchars_decode($search->post_description)), 0, 300).'....Read more</div>
																	</div>
																</div>';															
															}

														}
													}
													else { echo "No Content Available";}
													?>
												</div>
												<?php
												 	}
											   if($sql_count->pcount > 10){ 
												/*echo '<a href="#"><div id="load_more"><div id="'.$doc.'" class="more_button btn" style="width:100%;margin-top: 2em;" >Load More</div></div></a>';*/
												
													$total_rows=$sql_count->pcount;																		
													$total_pages = ceil($total_rows / $no_of_records_per_page);																			
													//last page
													$last=$total_rows-1; 
												   if($pageno > $total_pages){  
													   header("Location:/search?searchtype=".$_GET['searchtype']."&search=".$q);	
													   exit();
												   }
											  ?>
													
												<div class="col-md-12 col-sm-9">
													<ul class="pagination mbn mtn">  													
														<?php
														echo '<li><a href="'.$pageurl.'&pageno=1">First</a></li>';
														?>
														<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
															<a href="<?php if($pageno <= 1){ echo '#'; } else { echo $pageurl.'&pageno='.($pageno - 1); } ?>">Prev</a>
														</li>
														<?php

														for ($i=1+$pageno; $i<= $total_pages; $i++)
															{
																/*$active='';if($i == $pageno){$active="active";}*/
																echo '<li><a href="'.$pageurl.'&pageno='.$i.'">'.$i.'</a></li>';
																if($i >=(10+$pageno))
																{	
																	if($i < $last)
																	{
																		?>
																		<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
																			<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo $pageurl.'&pageno='.($pageno + 1); } ?>">Next</a>
																		</li>
																		<?php
																	}
																	break;
																}


															}
														if($total_pages!=$pageno and $searchtype!='web'){
															echo '<li><a href="'.$pageurl.'&pageno='.$total_pages.'">Last</a></li>';
														}
														
														?>														
													</ul>
												</div>
												<?php } 
												}
											}											
											?>
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

<script type="text/javascript">	

	$(function() {
	<?php if($q != '' and $searchtype!='symbol' and $searchtype!='user'){?>
	$('.flt').html('Filter by date: <select name="filter" class="filter"><option value="all">All</option><option value="hours">Past 24 hours</option><option value="week">Past week</option><option value="month">Past month</option><option value="year">Past year</option></select>');
	$('.filter').on('change', function() {
		window.location.href = "//<?php echo $_SERVER['HTTP_HOST'].'/search?searchtype='.$_GET['searchtype'].'&search='.$_GET['search'].'&filter=';?>"+this.value;
	});	
	<?php if($filter=="year"){ echo "$('.filter').val('year');";}
		  if($filter=="month"){ echo "$('.filter').val('month');";}
		  if($filter=="week"){ echo "$('.filter').val('week');";}
		  if($filter=="hours"){ echo "$('.filter').val('hours');";}
	} ?>
	
    /*$(document).on('click','.more_button', function () 					   
	{
		var getDate = $(this).attr("id");
		if(getDate)
		{
			$("#load_more").html('<img src="/assets/images/load.gif" style="padding:10px 0 0 100px;"/>'); 
			$.ajax({
			type: "POST",
			url: "/subs/ajax.php",
			data: {getDate: getDate, searchtype:'<?php echo $searchtype ?>',<?php if(isset($q)){echo "searchquery:'$q'";} ?>},
			cache: false,
			success: function(html){
				$("#load_more").remove();
				$("#result-list").append(html);		
				}
			});
		}	
		return false;
	});*/ 	 
  });
</script>    
<?php include('subs/footer.php') ?>