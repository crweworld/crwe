<?php
if(!isset($post_state))
{$post_state='';}
?>
<style>
/* Basic jQuery Slider essential styles */

ul.bjqs{position:relative; list-style:none;padding:0;margin:0;overflow:hidden; display:none;}
li.bjqs-slide{position:absolute; display:none;}
ul.bjqs-controls{list-style:none;margin:0;padding:0;z-index:9999;}
ul.bjqs-controls.v-centered li a{position:absolute;}
ul.bjqs-controls.v-centered li.bjqs-next a{right:0;}
ul.bjqs-controls.v-centered li.bjqs-prev a{left:0;}
ol.bjqs-markers{list-style: none; padding: 0; margin: 0; width:100%;}
ol.bjqs-markers.h-centered{text-align: center;}
ol.bjqs-markers li{display:inline;}
ol.bjqs-markers li a{display:inline-block;}
p.bjqs-caption{display:block;width:96%;margin:0;padding:2%;position:absolute;bottom:0;}
</style>

 <script src="/ads/bjqs-1.3.min.js"></script>

      							<!--Global-->
                            <div class="banner-adv-1 mbxl">
                             <?php 
								
							$bsql1="SELECT * FROM banner_ads WHERE ad_type='global_view' and ad_status='1' and (ad_expiry >NOW() or ad_expiry =NOW()) ORDER BY ad_order";
	
							
							$bd1=mysqli_query($GLOBALS["___mysqli_ston"], $bsql1);
							$count1=mysqli_num_rows($bd1);
								if($count1 > 0)
								{
									echo '<div id="banner-fade" class="banner-fade1">
                            		<ul class="bjqs">';
									
									while($info=mysqli_fetch_array($bd1))
										{
											$hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp']; 
											$ban_id="b".$info['ad_id'];
											
											include('global_gross.php');

											
											 echo "<li><a target='_blank' href='/g_click_tracker/".$hash_key."/".$ban_id."'><img width='300' height='250' style='width: 300px;height: 250px;' src='/uploads/ads/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a></li>";
											
										}
										 echo '<li><iframe src="/ads/iframe-global-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe></li>
										</ul> 
										</div>';
								}
								else
								{
									 echo "<div id='global-geo'></div>";
								}
								?>
                            </div>
                            
                            <!--Continent-->
                              <div class="banner-adv-1 mbxl">
                             <?php 
								
							$bsql4="SELECT ban_loc.ad_imp, ban_loc.ad_unq_imp, ban_loc.ban_id, banner_ads.hash_key, banner_ads.ad_image, banner_ads.ad_tag, banner_ads.target_url
							 
FROM ban_loc
LEFT JOIN banner_ads
ON ban_loc.ad_id=banner_ads.ad_id

WHERE banner_ads.ad_type='conti_view' and ban_loc.post_continent='$post_continent' and banner_ads.ad_status='1' and (banner_ads.ad_expiry >NOW() or banner_ads.ad_expiry =NOW()) 

ORDER BY banner_ads.ad_order";
	
							
							$bd4=mysqli_query($GLOBALS["___mysqli_ston"], $bsql4);
							$count4=mysqli_num_rows($bd4);
								if($count4 > 0)
								{
									echo '<div id="banner-fade" class="banner-fade4">
                            		<ul class="bjqs">';
									
									
									while($info=mysqli_fetch_array($bd4))
										{
											
											$hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp']; 
											$ban_id=$info['ban_id'];
											
											include('gross.php');
											
											 echo "<li><a target='_blank' href='/click_tracker/".$hash_key."/".$ban_id."'><img width='300' height='250' style='width: 300px;height: 250px;' src='/uploads/ads/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a></li>";
											
										}
										 echo '<li><iframe src="/ads/iframe-continent-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe></li>
										</ul> 
										</div>';
								}
								else
								{
									 echo "<div id='continent-geo'></div>";
								}
								?>
                            </div>
                            
                            <!--Country-->
                              <div class="banner-adv-1 mbxl">
                             <?php 
								
							$bsql2="SELECT ban_loc.ad_imp, ban_loc.ad_unq_imp, ban_loc.ban_id, banner_ads.hash_key, banner_ads.ad_image, banner_ads.ad_tag, banner_ads.target_url
							 
FROM ban_loc
LEFT JOIN banner_ads
ON ban_loc.ad_id=banner_ads.ad_id

WHERE banner_ads.ad_type='country_view' and ban_loc.post_country='$post_country' and banner_ads.ad_status='1' and (banner_ads.ad_expiry >NOW() or banner_ads.ad_expiry =NOW()) 

ORDER BY banner_ads.ad_order";
	
							
							$bd2=mysqli_query($GLOBALS["___mysqli_ston"], $bsql2);
							$count2=mysqli_num_rows($bd2);
								if($count2 > 0)
								{
									echo '<div id="banner-fade" class="banner-fade2">
                            		<ul class="bjqs">';
									
									
									while($info=mysqli_fetch_array($bd2))
										{
											
											$hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp']; 
											$ban_id=$info['ban_id'];
											
											include('gross.php');
											
											 echo "<li><a target='_blank' href='/click_tracker/".$hash_key."/".$ban_id."'><img width='300' height='250' style='width: 300px;height: 250px;' src='/uploads/ads/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a></li>";
											
										}
										 echo '<li><iframe src="/ads/iframe-country-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe></li>
										</ul> 
										</div>';
								}
								else
								{
									 echo "<div id='country-geo'></div>";
								}
								?>
                            </div>
                            
                            
                            
                             
                             
                             <!--state-->
                             <div class="banner-adv-1 mbxl">
                             <?php 
								
							$bsql3="SELECT ban_loc.ad_imp, ban_loc.ad_unq_imp, ban_loc.ban_id, banner_ads.hash_key, banner_ads.ad_image, banner_ads.ad_tag, banner_ads.target_url
							 
FROM ban_loc
LEFT JOIN banner_ads
ON ban_loc.ad_id=banner_ads.ad_id

WHERE banner_ads.ad_type='state_view' and ban_loc.post_state='$post_state' and banner_ads.ad_status='1' and (banner_ads.ad_expiry >NOW() or banner_ads.ad_expiry =NOW()) 

ORDER BY banner_ads.ad_order";
	
							
							$bd3=mysqli_query($GLOBALS["___mysqli_ston"], $bsql3);
							$count3=mysqli_num_rows($bd3);
								if($count3 > 0)
								{
									echo '<div id="banner-fade" class="banner-fade3">
                            		<ul class="bjqs">';
									
									while($info=mysqli_fetch_array($bd3))
										{
											$hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp']; 
											$ban_id=$info['ban_id'];
											
											include('gross.php');
											
											 echo "<li><a target='_blank' href='/click_tracker/".$hash_key."/".$ban_id."'><img width='300' height='250' style='width: 300px;height: 250px;' src='/uploads/ads/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a></li>";
											
										}
										 echo '<li><iframe src="/ads/iframe-state-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe></li>
										</ul> 
										</div>';
								}
								else
								{
									 echo "<div id='state-geo'></div>";
								}
								?>
                            </div>
   
    <script>
        jQuery(document).ready(function($) {

          $('.banner-fade1').bjqs({
            height      : 250,
            width       : 300,
			animduration : 450,
			animtype : 'slide',
            responsive  : true,
			showcontrols : false,
			showmarkers : false,
			animspeed : 6000
          });
		  $('.banner-fade2').bjqs({
            height      : 250,
            width       : 300,
			animduration : 450,
			animtype : 'slide',
            responsive  : true,
			showcontrols : false,
			showmarkers : false,
			animspeed : 6000
          });
		  $('.banner-fade3').bjqs({
            height      : 250,
            width       : 300,
			animduration : 450,
			animtype : 'slide',
            responsive  : true,
			showcontrols : false,
			showmarkers : false,
			animspeed : 6000
          });
		  $('.banner-fade4').bjqs({
            height      : 250,
            width       : 300,
			animduration : 450,
			animtype : 'slide',
            responsive  : true,
			showcontrols : false,
			showmarkers : false,
			animspeed : 6000
          });

        });
      </script>
<script>$(window).bind('load', function () {
    $('#global-geo').prepend('<iframe src="/ads/iframe-global-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe>');
	$('#continent-geo').prepend('<iframe src="/ads/iframe-continent-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe>');
	$('#country-geo').prepend('<iframe src="/ads/iframe-country-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe>');
	$('#state-geo').prepend('<iframe src="/ads/iframe-state-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe>');
});
</script> 
