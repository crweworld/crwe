					 <!--local-->
 <?php 
if(!isset($post_city))
{$post_city='';}							
							 $bsql4="SELECT ban_loc.ad_imp, ban_loc.ad_unq_imp, ban_loc.ban_id, banner_ads.hash_key, banner_ads.ad_image, banner_ads.ad_tag, banner_ads.target_url
							 
FROM ban_loc
LEFT JOIN banner_ads
ON ban_loc.ad_id=banner_ads.ad_id

WHERE banner_ads.ad_type='local_view' and ban_loc.post_city='$post_city' and banner_ads.ad_status='1' and (banner_ads.ad_expiry >NOW() or banner_ads.ad_expiry =NOW()) 

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
										 echo '<li><iframe src="/ads/iframe-local-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe></li>
										</ul> 
										</div>';
								}
								else
								{
									 echo '<div id="local-geo"></div>';
								}
								?>
                           
<script>$(window).bind('load', function () {
    $('#local-geo').prepend('<iframe src="/ads/iframe-local-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe>');
});
</script>   
                            