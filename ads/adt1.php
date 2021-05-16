

      							<!--Global-->
                            <div class="banner-adv-1 mbxl">
                            
                            <?php 
								include ('../subs/connect_me.php');
								$date=date("Y-m-d");
							$ban_geo1="SELECT * FROM banner_ads WHERE ad_status='1' and (ad_expiry >'$date' or ad_expiry ='$date')";
								$g1=mysqli_query($GLOBALS["___mysqli_ston"], $ban_geo1) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
								echo $count=mysqli_num_rows($g1);
								if($count > 0)
								{
							?>
                            <div id="banner-fade">
                            <ul class="bjqs">
									<?php 
								$ban_geo1="SELECT * FROM banner_ads WHERE ad_status='1' and (ad_expiry >'$date' or ad_expiry ='$date')";
								$g1=mysqli_query($GLOBALS["___mysqli_ston"], $ban_geo1) or die(mysqli_error($GLOBALS["___mysqli_ston"]));

                                    while($info = mysqli_fetch_array($g1))
                                    { 
                                           echo $hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp'];  
                                            include('gross.php');		
											
                                      echo "<li><a target='_blank' href='/click_tracker/".$hash_key."'><img width='300' height='250' style='width: 300px;height: 250px;' src='/uploads/ads/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a></li>";
                                    }
                                      ?>                                   
                              <li><a href="2"><iframe src="/ads/iframe-global-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe></a></li> 
                            </ul>
                            </div>
                            <?php 
							} else {
							?>
                            
                            	<iframe src="/ads/iframe-global-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe>
                                
                                
                            <?php 
								} 
							?>
                            
                             </div>
                           
                            
                           <!--Country-->
                             <div class="banner-adv-1 mbxl">
                              
                                      
                            <iframe src="/ads/iframe-country-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe>
                           
                            </div>
                             
                             
                             <!--state-->
                            <div class="banner-adv-1 mbxl">
                            <?php
								$ban_geo1="SELECT * FROM banner_ads WHERE ad_type='state_view' and post_state='$post_state' and ad_status='1' and (ad_expiry >'$date' or ad_expiry ='$date') ORDER BY rand() limit 1";
								$g1=mysqli_query($GLOBALS["___mysqli_ston"], $ban_geo1);
								$count=mysqli_num_rows($g1);
								if($count == 1)
								{
									$info = mysqli_fetch_array( $g1 ); 
									$hash_key=$info['hash_key'];
									$ad_image=$info['ad_image'];
									$ad_tag=$info['ad_tag'];
									$target_url=$info['target_url'];	
									$ad_imp=$info['ad_imp'];
									$ad_unq_imp=$info['ad_unq_imp'];
									
									
									include('gross.php');		
													 
									echo"<a target='_blank' href='/click_tracker/".$hash_key."'><img width='300' height='250' style='width: 300px;height: 250px;' src='/uploads/ads/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a>";
								}
								else
								{
							?>
                            <iframe src="/ads/iframe-state-geo.php" scrolling="no" frameborder="0" width="300" height="250" style="width: 300px;height: 250px;border: 0px;"></iframe>
                            <?php } ?>
                            </div>