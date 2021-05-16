<?php
include('subs/header.php');
?>
<link type="text/css" rel="stylesheet" href="/assets/css/pages/search_result.css">
<style>
	.media-right .fa{
		font-size: 50px;
    color: #cc0101;
	}
</style>
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
                                <li class="breadcrumb-item"><a href="#">Podcast</a></li>                                
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
                                    <br><a href="#">Podcast</a>
                               </div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div id="result-list">
												<?php
												$sql_count=mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) as pcount FROM `podcast` where status='1'"));
												if($sql_count->pcount != 0){

													$sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `podcast` where status='1' ORDER BY `id` DESC ") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
													while($pod=mysqli_fetch_object($sql))
													{
														 $pdid=$pod->id;
														if($pod->description!=''){
															$description='<div class="description">'.substr(strip_tags(htmlspecialchars_decode($pod->description)), 0, 300).'....</div>';
														}else{
															$description='';
														}
														$user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where `id`='$pod->user_id' and active='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
														
												  echo  '
														<div class="media">															
															<div class="media-body">
																<div class="media-heading"><a title="'.htmlspecialchars_decode($pod->title).'" href="'.$pod->url.'" class="title">'.htmlspecialchars_decode($pod->title).'</a></div>
																<div class="info"><span class="category">Podcast- '.ucfirst($user->username).'</span><span class="fa fa-circle"></span><span class="date-created">'.date('Y-m-d', strtotime($pod->created_on)).'</span>
																</div>
																'.$description.'
															</div>
															<div class="media-right"><a href="'.$pod->url.'"><i class="fa fa-play-circle" aria-hidden="true"></i></a></div>
														</div>';
													}
												}else { echo "No Podcast Available Currently";}
												?>
                                            </div>
                                            <?php if($sql_count->pcount > 20 ){?>
                                            <a href="#"><div id="load_more"><div id="<?php echo $pdid?>" class="more_button btn" style="width:100%;margin-top: 2em;" >Load More</div></div></a>
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
		var podId = $(this).attr("id");
		if(podId)
		{
			$("#load_more").html('<img src="/assets/images/load.gif" style="padding:10px 0 0 100px;"/>');
			$.ajax({
			type: "POST",
			url: "/subs/ajax.php",
			data: {podId: podId},
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
