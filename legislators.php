<?php 
include('subs/header.php');
function metatag()
	{ 
echo "<title>Crwe World | Legislators</title>";
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

 <style>
	div.table-wrapper div.scrollable {height: 150px; }
 </style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<!-- <link type="text/css" rel="stylesheet" href="/assets/css/pages/search_result.css"> -->
<link rel="stylesheet" href="assets/responsive-tables.css">
<script src="assets/responsive-tables.js"></script>
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
					
                        <div class="col-md-8 col-left col-sm-7 leg-heading">
                           <h2>LEGISLATORS</h2>
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
								
									<form class="form-wrapper" action="<?php echo "http://".$_SERVER['HTTP_HOST']."/legislators";?>" name="test" method="get">
									
										<div class="input-icon right">
											<input style="width:90%;float:left" class="form-control" name="search_leg" placeholder="Search - Name / State / District / Party / Chamber / Address / Phone / Email"  type="text">
											
											<button type="submit" style="width:10%;height:34px;background-color:#CC0101;border:0;color:#fff;"><i class="ion-android-search"></i></button>
										</div>
										
									</form>
								
									
								</div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="byline"><p>Source: Sunlight Foundation (API) (sunlightfoundation.com/api), licensed under a Creative Commons Attribution 4.0 International License</p></div>
                                    
                                    <?php
									if(isset($_GET['search_leg'])){
									
									$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['search_leg']);	
												
									$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM legislators where  full_name like '%$q%' or district like '%$q%' or party like '%$q%' or chamber like '%$q%' or state like '%$q%' or address like '%$q%' or phone_number like '%$q%' or email like '%$q%'") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
									$numrows=mysqli_num_rows($query);
									
														
									 
												
												
									
									$page_result=ceil($numrows/10);
									$page_limit=10;
									if(isset($_GET['goto']) and ($_GET['goto']) > 0)
														{
															$page_start=(($_GET['goto']-1)*10);
														}					
														else{
															$page_start=0;
														}
									?>
                                        <div class="col-md-12 col-xs-12 table-result" style="padding-bottom: 5px;" >
                                        <br>
                                             <?php if($numrows!=0){ echo "Found $numrows Results"; } 
											 
													$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM legislators where  full_name like '%$q%' or district like '%$q%' or party like '%$q%' or chamber like '%$q%' or state like '%$q%' or address like '%$q%' or phone_number like '%$q%' or email like '%$q%' limit $page_start,$page_limit") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
													while($info=mysqli_fetch_array($query))
													{
													
											 ?>
                                                    <table class="table table-striped responsive">
                                                   
                                                        <thead>
                                                        <tr>
                                                            <th width="10%">Photo</th>
                                                            <th width="20%">Full Name</th>
                                                            <th width="10%">State</th>
                                                            <th width="10%">District</th>
                                                            <th width="10%">Chamber</th>
                                                            <th width="10%">Party</th>
                                                            <th width="10%">Member Info</th>
                                                            
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><img src="<?php echo $info['photo'];?>" onerror="this.src='/default.jpg'" class="img-responsive"></td>
                                                                <td><?php echo $info['full_name']; ?></td>
                                                                
                                                                <td style="text-transform: capitalize;"><?php echo  $info['state'];?></td> 
                                                                <td style="text-transform: capitalize;"><?php echo  $info['district'];?></td> 
                                                                <td style="text-transform: capitalize;"><?php echo  $info['chamber'];?></td>                 
                                                                <td><?php echo $info['party'];?></td>
                                                                <td class="text-right">
                                                                    <a target="_blank" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/member_profile/{$info['leg_id']}"; ?>" class="btn btn-small blue btn-apply">View</a>
                                                                </td>
                                                            </tr> 
                                                                
                                                    </tbody></table>
                                             
                                                <?php 	  
														}
														
													
													  if($numrows==0){ echo "No Results Found";}
												 ?>
                                                <?php if( $numrows > 10){ ?>  
                                                 <div class="col-md-12 col-sm-12">
                                                    <ul class="pagination mbn mtn">  
                                                    <?php 
													$q=str_replace(" ","+",$q);
													   //last page
														 $last=$page_result-1;
														//max range
															$n=$page_result;
															$x=10;
															$max_range=(ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
															 $max_range=$max_range-$x;
															 //check
															$check=($numrows-($last*10))/10;
															if($check <= 1) {$last=$last+1;}
															
															
															
															
														if($last < 1)
														{}
														else
														{
															echo "<li><a href=http://".$_SERVER['HTTP_HOST']."/legislators/$q/1/0>FIRST</a></li>";
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
																$prev=$range;
																echo "<li><a href=http://".$_SERVER['HTTP_HOST']."/legislators/$q/$prev/".($range-10).">Prev</a></li>";
															}
																
															for ($i=1+$range; $i<= $page_result; $i++)
															{
																if($i == $goto)
																{
																	$active="active";
																	$job_link="#";
																}
																else
																{
																	$active="";
																	$job_link="?goto=$i&range=$range";
																}
																echo "<li class=".$active."><a href=http://".$_SERVER['HTTP_HOST']."/legislators/$q/$i/$range>$i</a></li>";
																
																if($i >=(10+$range))
																{	
																	if($i < $last)
																	{ 	$next=$i+1;
																		echo "<li><a href=http://".$_SERVER['HTTP_HOST']."/legislators/$q/$next/$i>Next</a></li>";
																	}
																	break;
																}
															}
															echo "<li><a href=http://".$_SERVER['HTTP_HOST']."/legislators/$q/$last/$max_range>Last</a></li>";
															
														 }
													
													?>
                                                    </ul>
													
                                                </div>
                                            	<?php } ?>
                                           </div>
                                        <?php } ?>   
                                        <br />
                                         <!-- ad for desktop -->
											<div class="desktop-ads">
												<?php include('ads/729ad.php')?> 
											</div>
										<!--End ad for desktop -->
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