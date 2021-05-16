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
                                <li class="breadcrumb-item"><a href="#">Category</a></li>
                                <li class="breadcrumb-item active"><?php if($_GET['cat_id']=='34'){echo '<a target="_blank" href="http://www.prnewswire.com/">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='35'){echo '<a target="_blank" href="https://globenewswire.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='37'){echo '<a target="_blank" href="https://www.accesswire.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='39'){echo '<a target="_blank" href="http://www.businesswire.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='45'){echo '<a target="_blank" href="https://www.media-outreach.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='47'){echo '<a target="_blank" href="https://www.acnnewswire.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='48'){echo '<a target="_blank" href="https://www.jcnnewswire.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='49'){echo '<a target="_blank" href="https://www.newsdirect.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='50'){echo '<a target="_blank" href="http://crwepressrelease.com">'.$cat_name.'</a>';}
else{echo '<a target="_blank" href="#">'.$cat_name.'</a>';}?></li>
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
                                    <?php if($_GET['cat_id']=='34'){echo '<a target="_blank" href="http://www.prnewswire.com/">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='35'){echo '<a target="_blank" href="https://globenewswire.com/">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='37'){echo '<a target="_blank" href="https://www.accesswire.com/">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='39'){echo '<a target="_blank" href="http://www.businesswire.com/">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='45'){echo '<a target="_blank" href="https://www.media-outreach.com/">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='47'){echo '<a target="_blank" href="https://www.acnnewswire.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='48'){echo '<a target="_blank" href="https://www.jcnnewswire.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='49'){echo '<a target="_blank" href="https://www.newsdirect.com">'.$cat_name.'</a>';}
else if($_GET['cat_id']=='50'){echo '<a target="_blank" href="http://crwepressrelease.com">'.$cat_name.'</a>';}
else{echo '<a target="_blank" href="#">'.$cat_name.'</a>';}?>
                               </div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div id="result-list">
												<?php
												$sql_count=mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) as pcount FROM  `posts` where post_status='publish' $sqladd "));
												if($sql_count->pcount != 0){

													$sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `posts` where post_status='publish' $sqladd ORDER BY `post_doc` DESC, `post_id` DESC LIMIT 10") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
													while($post=mysqli_fetch_object($sql))
													{
														$_SESSION['rmv_id'][]=$post->post_id;
														$doc = $post->post_doc;
														if(isset($_GET['cat_type'])){$cat = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$post->cat_id' and cat_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); }
                                          echo  '
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div class="media-heading"><a title="'.htmlspecialchars_decode($post->post_title).'" href="'.$post->post_url.'" class="title">'.htmlspecialchars_decode($post->post_title).'</a></div>
                                                        <div class="info"><span class="category">'.$cat->cat_name.'</span><span class="fa fa-circle"></span><span class="date-created">'.$post->post_doc.'</span>
                                                        </div>
                                                        <div class="description">'.substr(strip_tags(htmlspecialchars_decode($post->post_description)), 0, 300).'....Read more</div>
                                                    </div>
                                                </div>';
													}
												}else { echo "No Content Available Currently";}
												?>
                                            </div>
                                            <?php if($sql_count->pcount >10 ){?>
                                            <a href="#"><div id="load_more"><div id="<?php echo $doc?>" class="more_button btn" style="width:100%;margin-top: 2em;" >Load More</div></div></a>
											<?php } ?>
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
    $(document).on('click','.more_button', function ()
	{
		var getDate = $(this).attr("id");
		if(getDate)
		{
			$("#load_more").html('<img src="/assets/images/load.gif" style="padding:10px 0 0 100px;"/>');
			$.ajax({
			type: "POST",
			url: "/subs/ajax.php",
			data: {catLoad: getDate,
				   <?php if(isset($_GET['cat_type'])){ echo 'sqlnum:"'.$_GET['cat_type'].'"';}else{ echo 'cat_id:"'.$_GET['cat_id'].'"';} ?>},
			cache: false,
			success: function(html){
				$("#load_more").remove();
				$("#result-list").append(html);
				}
			});
		}
		return false;
	});
  });
</script>
<?php include('subs/footer.php') ?>
