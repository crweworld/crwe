<?php 
include('subs/header.php');

if(isset($_GET['leg_id']))
{
	 $leg_id =mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['leg_id']);
	 
	 $leg = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM legislators where leg_id='$leg_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	$results = mysqli_num_rows($leg);
	if (!($results > 0))
	{
		echo "<script>window.location = 'http://{$_SERVER['HTTP_HOST']}/legislators'</script>";
	}
	
}

function metatag()
	{ 
	
	$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM legislators where `leg_id`='{$_GET['leg_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	$results = mysqli_fetch_array($posts);
	$full_name=$results['full_name'];
	echo "<title>Crwe World | ".ucfirst($full_name)."</title>";
	}




 ?>
 <style>
 #search-result .form-control
 {
	    box-shadow: none;
    border-radius: 0;
    width: 25%;
    float: left;
    /* padding: 5px; */
    margin: 3px;
    font: normal normal normal 13.3333330154419px/normal Arial;
 }
  #search-result .membpro
 {
	 background-color: #ccc;
	 padding: 2%; float:left;
   
    background: rgba(0,0,0,.2);
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -moz-box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
    box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
 }
	
 #search-result .submit
 {
	      float: left;
    border: 0px;
    background-color: #CC0101;
    color: #fff;
    /* padding: 4px; */
    font: normal normal normal 13.3333330154419px/normal Arial;
    width: 150px;
    height: 32px;
    margin: 4px 2px;
    font-weight: 600;
 }
  .byline p {
    text-align: center;
    font-size: 12px;
    color: #777;
    text-shadow: 0 2px 3px rgba(0,0,0,0.1);
    top: 22px;
    position: relative;
    margin-bottom: 20px;
}
.byline p a {
    color: #CC0101;
    text-decoration: none;
}
.member{padding: 10px;
    background: #ccc;
    border-radius: 5px;}

.member img{margin-bottom: 10px;}

.member p.email{word-wrap: break-word;}
 </style>

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
						
                        <div class="col-md-7 col-left col-sm-7">
                           <h1 style="text-align:center;text-transform: uppercase; font-weight: 600;">Member Information</h1>
                        </div>
                        <div class="col-md-5 col-right col-sm-5">
                            <div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span
                                    class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-left col-sm-7">
                            <div id="search-result" class="section-category">
                                
                                <div class="section-content" style="border-top: 2px solid #000000;">
                                    <div class="row">
                                    
                                    <div class="byline"><p>Source: Sunlight Foundation (API) (sunlightfoundation.com/api), licensed under a Creative Commons Attribution 4.0 International License</p></div>  
                                    
                                      <div class="col-md-12">
                                        <br>
                                          <?php
									if(isset($not_found))
									{
										echo $not_found;
									}
									else 
									{
									$info = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM legislators where `leg_id`='$leg_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
									while($info_result = mysqli_fetch_array($info))
									{
										$photo=$info_result['photo'];
										$full_name=$info_result['full_name'];
										$party=$info_result['party'];
										$district=$info_result['district'];
										$address=$info_result['address'];
										$phone=$info_result['phone_number'];
										$fax=$info_result['fax_number'];
										$email=$info_result['email'];
										$url=$info_result['link'];
										$chamber=$info_result['chamber'];
										$state=$info_result['state'];
										$updated_at=$info_result['updated_at'];
									
									?> 
                                          
										  <div class="member">
											  <div class="row">
												  <div class="col-xs-12 col-sm-12 col-md-12"><h2><?php echo $full_name?></h2></div>											  
											  </div>
										  
											  <div class="row">
											  
												<div class="col-xs-6 col-md-6 pull-left">
													<img  class="img-responsive" src="<?php echo $photo ?>" onerror="this.src='/default.jpg'" alt="<?php echo $full_name ?>" />
												</div>
											  
											
												<div class="col-xs-6 col-md-6 pull-right"><p><b>Party: </b>&nbsp<?php echo $party ?></p></div>
												<div class="col-xs-6 col-md-6 pull-right"><p><b>District: </b>&nbsp<?php echo $district?></p></div>
												<div class="col-xs-6 col-md-6 pull-right"><p><b>Chamber: </b>&nbsp<?php echo ucfirst($chamber) ;?></p></div>
												<div class="col-xs-6 col-md-6 pull-right"><p><b>State: </b>&nbsp<?php echo $state ;?></p></div>
												<div class="col-xs-6 col-md-6 pull-right"><p><b>Address: </b>&nbsp<?php echo $address ;?></p></div>
												<div class="col-xs-6 col-md-6 pull-right"><p><b>Phone: </b>&nbsp<?php echo $phone ;?></p></div>
												<div class="col-xs-6 col-md-6 pull-right"><p><b>Fax: </b>&nbsp<?php echo $fax ;?></p></div>
												<div class="col-xs-6 col-md-6 pull-right"><p class="email"><b>Email: </b>&nbsp<?php echo $email?></p></div>
												<div class="col-xs-6 col-md-6 pull-right"><p></p></div>
												<div class="col-xs-6 col-md-6 pull-right">
													<a target="_new"  class="btn"><b>Read More</b></a>
													</div>												
												
												
												
												</div>
										</div>	
										  
										  <br/>        
                                          <!-- <table class="membpro" width="650" border="0" align="left" cellpadding="0" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td><table width="650" height="0%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                  <tr>
                                                    <td width="16%" height="178" rowspan="5" align="left"><img width="110" height="156" style="display:block; margin: 0px 24px;top: 6px;position: relative;" src="<?php echo $photo ?>" onerror="this.src='/default.jpg'" alt="<?php echo $full_name ?>" /></td>
                                                  </tr>
                                                  <tr> 
                                                    <td height="100%" colspan="2"><div align="center">
                                                      <h2><b><?php echo $full_name?></b></h2>
                                                    </div></td>
                                                    <td width="16%" rowspan="5" align="left" valign="middle">&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td width="35%" height="4%"><div align="left">
                                                      <h5><b><?php echo $party ?></b></h5>
                                                    </div></td>
                                                    <td width="33%"><div align="left">
                                                      <h5><b style="text-transform:capitalize"><?php echo $district?></b></h5>
                                                    </div></td>
                                                  </tr>
                                                  <tr>
                                                    <td width="35%" height="4%"><div align="left">
                                                      <h5><b style="font-style: normal;">Chamber:</b> <?php echo ucfirst($chamber) ;?></h5>
                                                    </div></td>
                                                    <td width="33%"><div align="left">
                                                      <h5><b style="font-style: normal;">State:</b> <?php echo $state ;?></h5>
                                                    </div></td>
                                                  </tr>
                                                  <tr>
                                                    <td height="11%" colspan="2"><div align="left">
                                                      <p style="text-align: left;line-height: 30px;font-style: italic;">
                                                      <b style="font-style: normal;">Office Address: </b> <?php echo $address ;?><br> 
                                                     <b style="font-style: normal;">Phone Number:</b> <?php echo $phone ;?><br>
													<b style="font-style: normal;">Fax Number:</b> <?php echo $fax ;?><br>
                                                     <b style="font-style: normal;">Email Id:</b><?php echo $email?>
                                                      </p>
                                                    </div></td>
                                                  </tr>
                                                  <tr>
                                                    <td height="3%" colspan="2"> </td>
                                                  </tr>
                                                  <?php if($url!=""){ ?>
                                                  <tr>
                                                    <td height="5%" colspan="4"><div align="left">
													<br>
														<a style="float: right;margin: -6px 20px;" target="_new" href="<?php echo $url?>" class="col-md-4 btn1 btn">  <b>Read More</b></a>
														<br><br><br>
													</div></td>
                                                  </tr>
                                                  <?php } ?>
                                                </tbody>
                                              </table></td>
                                            </tr>
                                          </tbody>
                                        </table> -->
                                         <?php } 
									}?>  
                                             
                                         </div>
                                         
                                         <div class="col-md-12" style="margin-top:10px">
											<!-- ad for desktop -->
													<div class="desktop-ads">
														<?php include('ads/729ad.php')?> 
													</div>
												<!--End ad for desktop --> <br />  
                                    </div>
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-right col-sm-5">
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