<?php 
include('subs/header.php');
function metakeys()
{
	return ', CrowdFunding campaigns, fundraising campaigns, crowdfunding, angel investors, crowdfunding site, fundraising, fundraisers, efundraising';
}
function metatag()
{
	echo '<title>Crwe World | Fundraising Campaigns</title>';
}
?>

<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->
    <div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
            <div class="content">
                <div class="container">
                    <div class="row">
						<!--ad only for ipad -->
						<div class="ipad-ads col-md-12">
							<?php include('ads/729ad.php')?> 
						</div>
					<!--ad only for ipad end -->
					
                        <div class="col-md-8 col-left col-sm-7">
                            <ul class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li class="active">Fundraising Campaigns</li>                                
                            </ul>
                        </div>
                        <div class="col-md-4 col-right col-sm-5">
                            <div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span
                                    class="description"><?php echo $api_state?> <img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span></div>
                        </div>
                    </div>
                    <!-- LATEST ARTICLES-->
                    <div class="row">
                        <div class="col-md-8 col-left col-sm-7">
                            <div class="latest_articles section-category">
                                <div class="section-name">
								<!-- ad for desktop -->
											<div class="desktop-ads">
												<?php include('ads/729ad.php')?> 
											</div>
										<!--End ad for desktop -->
                                
                                    <div class="pull-left"><br /> <br /> <a href="#" style="text-transform: none;">Fundraising Campaigns By :</a></div>                                    
                                    <div class="clearfix"></div>
                                    
                                </div>
                                <div class="section-content">
                                    <div class="row">
                                      <?php 
											$bd = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM stock WHERE post_status='publish' ORDER BY post_id") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
											while($info = mysqli_fetch_array( $bd )) 
												{ 
													$post_title=$info['post_title']; 
													$post_description=$info['post_description']; 
													$source_url=$info['source_url']; 
													$post_image_loc=$info['post_image_loc']; 																
										?> 
                                        <div class="col-md-4 col-sm-6 col-xs-6">
                                            <div class="thumb">
                                            	<div style="overflow:hidden; max-height:140px">
                                                	<img class="img-responsive" onerror="this.src='/default.jpg'" src="<?php echo $post_image_loc?>" alt="" >
                                                 </div>
                                                 <h3><?php echo $post_title;?></h3>
                                                 <div class="descrip"><?php echo $post_description;?></div>
                                                 <a href="<?php if($source_url==''){echo '#';}echo $source_url?>">
													<div class="info btn btn-primary">I'm Interested</div>
												</a>
                                           </div>
                                        </div>
                                         <?php } ?>
										 
										 <div class="col-xs-12 col-md-12">
											<div class="alert alert-success" role="alert">
											  <h4 class="alert-heading">DISCLAIMER!</h4>
											  <p>The news, reports, views and opinions expressed by the Crowdfunding Platforms that are advertised at crweworld.com are their own and do not necessarily represent the views of CRWE World.</p>
											  <p> CRWE World (crweworld.com) provides advertising services for general information purposes only. Neither CRWE World (Crown Equity Holdings, Inc.) nor its employees and affiliates are registered as investment advisors or broker/dealers in any jurisdiction whatsoever. DO NOT BASE ANY INVESTMENT DECISION UPON ANY INFORMATION FOUND ON THIS WEBSITE. Read Full Disclaimer at <a style="color:#F00" href="http://www.crweworld.com/finance_disclaimer">www.crweworld.com/finance_disclaimer</a></p>
											  </br>
											 <h4 class="alert-heading"><strong>Payments Disclosure</strong></h4>

<p>Crown Equity Holdings Inc. has received $5,000.00 (five thousand dollars) in cash from Nass Valley Gateway Ltd.  (CSE:NVG) (FSE:3NVN) for 30 days of advertisement services </p>
											</div>
										 </div>
                                      
                                       
                                
                                    </div>
                                </div>
                            </div>                           
                        </div>
                        <div class="col-md-4 col-right col-sm-5"><!-- category-->
                         <?php include('subs/sidebar.php'); ?> 
                         <?php include('ads/geo-side-ads.php'); ?>
                        </div>
                    </div>
                </div>
               
               
            </div>
        </div>
    </div>
<?php include('subs/footer.php') ?>