<?php 
include('subs/header.php');
function metatag()
	{ 
echo "<title>Crwe World | Jobs</title>";
	}
function metakeys()
	{ 
	
 echo " job search, jobs, search engine for jobs, job search engine, job listings, search jobs, career, employment, work, find jobs, career";
	}
function metadesc()
	{ 
 echo "CRWE World, your source for full and part time jobs and career opportunities. Search jobs in your area";
	}

if(isset($_GET['goto']))
	{
	$goto=$_GET['goto'];
	} 
	else
	{
		$goto=1;
	}


 ?>
<link rel="stylesheet" href="assets/responsive-tables.css">
<script src="assets/responsive-tables.js"></script>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>


  <link type="text/css" rel="stylesheet" href="/assets/css/pages/search_result.css">
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
                           <h2>JOB PORTAL</h2>
                        </div>
                        <div class="col-md-4 col-right col-sm-5">
                            <div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span
                                    class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-left col-sm-7">
                            <div id="search-result" class="section-category">
                                <div class="section-name">
								
									<form class="form-wrapper cf" action="" method="get">
										<input type="text" placeholder="Keyword" name="keyword" value="<?php if(isset($_GET['keyword'])){echo $_GET['keyword'];} ?>" required="ture" class="form-control" style="width:45%;float:left" />
										<input type="text" name="location" placeholder="Location" value="<?php if(isset($_GET['location'])){echo $_GET['location'];} ?>" required="ture" class="form-control" style="width:45%;float:left" />
										<button type="submit"  style="width:10%;height:34px;background-color:#CC0101;border:0;color:#fff;"><i class="ion-android-search"></i></button>
									</form>
								
								
								
								<div class="byline"><p>Powered by <a href="http://www.careerjet.co.uk/">careerjet</a></p></div></div>
								
                                <div class="section-content">
                                    <div class="row">
                                       
                                         <div class="col-md-12">
                                         <?php
											require_once "subs/Careerjet_API.php" ;
											if(isset($_GET['keyword']))
											{
												$keyword=$_GET['keyword'];
												$location=$_GET['location'];
												if(isset($_GET['goto']))
												{
												$goto=$_GET['goto'];
												} 
												else
												{
													$goto=0;
												}
												
											$api = new Careerjet_API('en_GB') ;
											$page = 1+$goto ; # Or from parameters.

											$result = $api->search(array(
											  'keywords' =>$keyword,
											  'location' => $location,
											  'page' => $page ,
											  'affid' => '2ef9a07d2b7d187791af6d24f2ba161e',
											));

											if ( $result->type == 'JOBS' ){
											  echo "Found ".$result->hits." jobs" ;
											  
											  $jobs = $result->jobs ;
											  $page_result=$result->pages;
											  
											  foreach( $jobs as $job ){
												  ?>
    
												<table class="table table-striped responsive">
											   
													<thead>
													<tr>
														<th width="10%">Job Title</th>
														<th width="10%">Company</th>
														<th width="10%">Date</th>
														<th width="10%">Location</th>
														<th width="30%">Description</th>
														<th width="10%">Salary</th>
														<th width="10%"> </th>
													</tr>
													</thead>
													<tbody>
														<tr>
															<td><?php echo $job->title?></td>
															<td><?php echo $job->company?></td>
															<td><?php echo $job->date ?></td>
															<td><?php echo $job->locations?></td>  
															<td><?php echo $job->description?></td>                 
															<td><?php echo $job->salary?></td>
															<td class="text-right">
																<a target="_blank" href="<?php echo $job->url?>" class="btn btn-small blue btn-apply">Apply</a>
															</td>
														</tr> 
														<?php
														}
												}
												
										}
										?>
														 </tbody>
												</table>
 										 <div class="col-md-12 col-sm-9">
											<ul class="pagination mbn mtn">  
											<?php 
											if(isset($page_result))
											{
												
												//last page
												$last=$page_result-1;
												//max range
													$n=$page_result;
													$x=10;
													$max_range=(ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
													$max_range=$max_range-$x;
													
													
												if($last < 1)
												{}
												else
												{
													echo "<li><a href='?keyword=$keyword&location=$location&goto=0'>FIRST</a></li>";
													if(isset($_GET['range']) and ($_GET['range']) > 0 and ($_GET['range']) <= $max_range)
													{
														 $range=$_GET['range'];
													}
													else
													{
														$range=0;
													}
													
													if($range>$max_range)
													{
														$range=$max_range;
													}
													
													
													$i=0;
													if($i != $range)
													{
														echo "<li><a href='?keyword=$keyword&location=$location&goto=".$i."&range=".($range-10)."'>Prev</a></li>";
													}
														
													for ($i=1+$range; $i< $page_result; $i++)
													{
														if($i == $goto)
														{
															$active="active";
															$job_link="#";
														}
														else
														{
															$active="";
															$job_link="?keyword=$keyword&location=$location&goto=$i&range=$range";
														}
														echo "<li class=".$active."><a href='".$job_link."'>".$i."</a></li>";
														
														if($i >=(10+$range))
														{	
															if($i < $last)
															{
																echo "<li><a href='?keyword=$keyword&location=$location&range=".$i."'>Next</a></li>";
															}
															break;
														}
													}
													echo "<li><a href='?keyword=$keyword&location=$location&goto=$last&range=$max_range'>Last</a></li>";
													
												 }
											}
											?>
											</ul>
										</div>
<br></br><p><a href="https://jooble.org/jobs/Nevada-City,-CA" target="_blank"><strong>Jooble jobs&nbsp;in Nevada City, CA</strong></a></p><br></br>
                                    <!-- ad for desktop -->
											<div class="desktop-ads">
												<?php include('ads/729ad.php')?> 
											</div>


										<!--End ad for desktop --> 
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
<?php include('subs/footer.php') ?>