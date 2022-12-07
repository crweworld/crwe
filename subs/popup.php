<?php
if(isset($_POST['sub_pop']))
{ 
	
	$subscribe=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['subscribe']);
	$code=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['code']);
	$code1=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['code1']);
	$sub_date = date("Y-m-d");
	$hash=(bin2hex(random_bytes(9)));
	
	$sql="SELECT * FROM subscribers WHERE email='$subscribe'";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$count=mysqli_num_rows($result);
	
	if($subscribe==""){ $_SESSION['poopy']=""; echo "<script>alert('Please enter your email id for Newsletter Signup');</script>";} 	
	else if($code!=$code1){ $_SESSION['poopy']=""; echo "<script>alert('Wrong sum entered in Newsletter Signup');</script>";} 	
	else{
	
			if($count==0)
			{			
				$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `subscribers`(`email`,`hash`,`active`, `sub_doc`) VALUES ('$subscribe','$hash','0', '$sub_date')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
				if($insert_ok == 1)
				{
					
					$to      = $subscribe; // Send email to our user
					$subject = "Crwe World | Verification"; // Give the email a subject 
				 $message = '<div dir="ltr">************************************************************************************************************<br />
	</div>
	<div dir="ltr"><br />
	</div>
	<div dir="ltr"><strong>Please verify your email address</strong></div>
	<div dir="ltr"><br />
	</div>
	<div dir="ltr">Hi,</div>
	<div dir="ltr"><br />
	</div>
	<div dir="ltr"><br />
	  Thanks for subscribing CRWEWORLD. Please take a moment to verify the email address by clicking the link below:</div>
	<div dir="ltr"><br />
	</div>
	<div dir="ltr"><a href="http://'.$_SERVER['HTTP_HOST'].'/confirmation/'.$hash.'" target="_blank">http://'.$_SERVER['HTTP_HOST'].'/confirmation/'.$hash.'</a>or <a href="http://'.$_SERVER['HTTP_HOST'].'/confirmation/'.$hash.'" target="_blank">Click Here</a></div>
	<div dir="ltr"><br />
	</div>
	<div dir="ltr"><br />
	</div>
	<pre>This email is part of a Closed-Loop Opt-In system and was sent to protect the privacy of the owner of this email address. Closed-Loop Opt-In confirmation guarantees that only the owner of an email address can subscribe themselves  to this mailing list. Furthermore, the following privacy policy is associated with this list:</pre>
	<div dir="ltr"><a href="http://crweworld.com/privacy_policy" target="_blank">http://crweworld.com/privacy_policy</a></div>
	<pre>Please read and understand this privacy policy. Other mechanisms may have been enacted to subscribe email addresses to this list, such as  physical guestbook registrations, verbal agreements, etc. If you did not ask to be subscribed to this particular list, please  do not visit the confirmation URL above. The confirmation for subscription will not go through and no other action on your part will be needed.</pre>
	<div dir="ltr"> </div>
	<div dir="ltr"><br />
	</div>
	<div dir="ltr">Please do not reply to this email; it was sent from an unmonitored email address. This message is a service email related to your use of CRWEWORLD.<br />
	</div>
	<div dir="ltr"><br />
	</div>
	<div dir="ltr">For general inquiries or to request support with your CRWEWORLD account: <a href="mailto:contact@crweworld.com" target="_blank">contact@crweworld.com</a></div>
	<div dir="ltr"><br />
	</div>
	<pre>The following physical address is associated with this mailing list: 11226 Pentland Downs St, Las Vegas, NV 89141<br /><br /><br />************************************************************************************************************</pre>';
				
				//phpemailer
				 require '/var/www/html/vhosts/phpmail/mail.php';
				 $from_name= 'CrweWorld';
				 $reply = 'info@crweworld.com';
				 $reply_name = 'CrweWorld';
				 $to = $subscribe;
				 $subject = $subject;
				 $message = $message;
				 $send_mail = sendphpmail('crweworld.com',$from_name,$reply,$reply_name,$to,$subject,$message);
			
					echo "<script>
					alert('Thanks for subscribing.Please check your mail for verification');
					window.location.href='#';
					</script>";
				}
			}
	else
	{
		echo "<script>alert('Email id already exsist');</script>";
	}
		}
		
}

?>


 <link rel="stylesheet" type="text/css" href="/assets/css/component.css" />
		<script src="/assets/js/pop/modernizr.custom.js"></script>
       
        <div class="md-modal md-effect-11" id="modal-1">
			<div class="md-content">
				<h3><button class="md-close btn_close">X</button></h3>
				
						<?php $digits = 4; $code_pop=rand(pow(10, $digits-1), pow(10, $digits)-1); ?>
                        	<form name="subsc_pop" method="post" action="#">
                           <div class="container" style="width: 100%; padding: 0px; margin: 0px;"> 
									<div class="col-md-6">
										<?php 
										$bsql1="SELECT * FROM pop_ads WHERE ad_type='global_view' and ad_status='1' and (ad_expiry >NOW() or ad_expiry =NOW())";
										$bd1=mysqli_query($GLOBALS["___mysqli_ston"], $bsql1)or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
										$count1=mysqli_num_rows($bd1);
										
										if($count1 > 0)
										{
											$info=mysqli_fetch_array($bd1);
											
											$hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp']; 
											$pop_id="p".$info['ad_id'];									
										
										
										if (!strposa($agent, $fliter)) 
										{
											/*gross impression*/
											$ad_imp++;									
											mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `pop_ads` SET `ad_imp`='$ad_imp' where hash_key='$hash_key' ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
											
											/*unique gross impression*/
											$pop_geo1="SELECT * FROM pop_stats WHERE hash='$hash_key' and pop_id='$pop_id' and ip_add='{$_SERVER['REMOTE_ADDR']}' and type='view'";
											$g1=mysqli_query($GLOBALS["___mysqli_ston"], $pop_geo1);
											$count=mysqli_num_rows($g1);
											if($count == 0)
											{
												mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `pop_stats`(`ip_add`, `pop_id`, `hash`,`type`,`date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','$pop_id','$hash_key','view',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
												$ad_unq_imp++;									
												mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `pop_ads` SET `ad_unq_imp`='$ad_unq_imp' where hash_key='$hash_key'  ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
												
											}
										}
												
	

											
											 echo "<a class='md-close' target='_blank' href='http://".$_SERVER['HTTP_HOST']."/gp_click_tracker/".$hash_key."/".$pop_id."'><img alt='global' src='http://".$_SERVER['HTTP_HOST']."/uploads/pop/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a>";
										}
										else
										{
											 echo "<a target='_blank' href='http://".$_SERVER['HTTP_HOST']."/contact'><img alt='global' src='/assets/images/pop/global.jpg'></a>";
											 
										}
										?>
										
									</div>
									<div class="col-md-6">
										<?php 
										
										$bsql2="SELECT pop_loc.ad_imp, pop_loc.ad_unq_imp, pop_loc.pop_id, pop_ads.hash_key, pop_ads.ad_image, pop_ads.ad_tag, pop_ads.target_url
							 
FROM pop_loc
LEFT JOIN pop_ads
ON pop_loc.ad_id=pop_ads.ad_id

WHERE pop_ads.ad_type='country_view' and pop_loc.post_country='$post_country' and pop_ads.ad_status='1' and (pop_ads.ad_expiry >NOW() or pop_ads.ad_expiry =NOW())";
										$bd2=mysqli_query($GLOBALS["___mysqli_ston"], $bsql2)or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
										$count2=mysqli_num_rows($bd2);
											if($count2 > 0)
											{
											$info=mysqli_fetch_array($bd2);
											
											$hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp']; 
											$pop_id=$info['pop_id'];
											include('pop_gross.php');

											
											 echo "<a class='md-close' target='_blank' href='http://".$_SERVER['HTTP_HOST']."/p_click_tracker/".$hash_key."/".$pop_id."'><img alt='country' src='http://".$_SERVER['HTTP_HOST']."/uploads/pop/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a>";
										}
										else
										{	
										echo "<a target='_blank' href='http://".$_SERVER['HTTP_HOST']."/contact'><img alt='country' src='/assets/images/pop/country.jpg'></a>";																				
											
										}
										?>
									</div>
									<div class="col-md-6"> 
										<?php 
										
										$bsql3="SELECT pop_loc.ad_imp, pop_loc.ad_unq_imp, pop_loc.pop_id, pop_ads.hash_key, pop_ads.ad_image, pop_ads.ad_tag, pop_ads.target_url
							 
FROM pop_loc
LEFT JOIN pop_ads
ON pop_loc.ad_id=pop_ads.ad_id

WHERE pop_ads.ad_type='state_view' and pop_loc.post_state='$post_state' and pop_ads.ad_status='1' and (pop_ads.ad_expiry >NOW() or pop_ads.ad_expiry =NOW())";

										
										$bd3=mysqli_query($GLOBALS["___mysqli_ston"], $bsql3)or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
										$count3=mysqli_num_rows($bd3);
										if($count3 > 0)
										{
											$info=mysqli_fetch_array($bd3);
											
											$hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp']; 
											$pop_id=$info['pop_id'];
											include('pop_gross.php');

											
											 echo "<a class='md-close' target='_blank' href='http://".$_SERVER['HTTP_HOST']."/p_click_tracker/".$hash_key."/".$pop_id."'><img alt='state' src='http://".$_SERVER['HTTP_HOST']."/uploads/pop/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a>";
										}
										else
										{
												echo "<a target='_blank' href='http://".$_SERVER['HTTP_HOST']."/contact'><img alt='state' src='/assets/images/pop/state.jpg'></a>";	
										
										}
										?>
									</div>
									<div class="col-md-6"> 
										<?php 
										
										$bsql4="SELECT pop_loc.ad_imp, pop_loc.ad_unq_imp, pop_loc.pop_id, pop_ads.hash_key, pop_ads.ad_image, pop_ads.ad_tag, pop_ads.target_url
							 
FROM pop_loc
LEFT JOIN pop_ads
ON pop_loc.ad_id=pop_ads.ad_id

WHERE pop_ads.ad_type='local_view' and pop_loc.post_city='$post_city' and pop_ads.ad_status='1' and (pop_ads.ad_expiry >NOW() or pop_ads.ad_expiry =NOW())";


										$bd4=mysqli_query($GLOBALS["___mysqli_ston"], $bsql4)or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
										$count4=mysqli_num_rows($bd4);
										if($count4 > 0)
										{
											$info=mysqli_fetch_array($bd4);
											
											$hash_key=$info['hash_key'];
                                            $ad_image=$info['ad_image'];
                                            $ad_tag=$info['ad_tag'];
                                            $target_url=$info['target_url'];	
                                            $ad_imp=$info['ad_imp'];
                                            $ad_unq_imp=$info['ad_unq_imp']; 
											$pop_id=$info['pop_id'];
											include('pop_gross.php');

											
											 echo "<a class='md-close' target='_blank' href='http://".$_SERVER['HTTP_HOST']."/p_click_tracker/".$hash_key."/".$pop_id."'><img alt='local' src='http://".$_SERVER['HTTP_HOST']."/uploads/pop/".$hash_key."/thumb/".$ad_image."' alt='".$ad_tag."'></a>";
										}
										else
										{
											echo "<a target='_blank' href='http://".$_SERVER['HTTP_HOST']."/contact'><img alt='local' src='/assets/images/pop/local.jpg'></a>";	
											
										}
										?>
									</div>   
									<div class="col-md-12">
										<div class="col-md-6">
											<p><i>CRWE WORLD's location targeting allows your ads to appear in the geographic locations that you choose: locally, state-wide, nationally and/or internationally.</i></p>
										</div>
										<div class="col-md-6">
										
											<div class="col-md-12">
											<div class="pop-signup">Sign up for free e-mail updates</div>
												<span class="pop-code" >Code:<?php echo $code_pop?></span> 
												<input type="hidden" name="code" value="<?php echo $code_pop?>">
												<input class="pop-code-box" name="code1" placeholder="Enter Code" class="form-control" required="required" type="text">
											</div>
											
											<input name="subscribe" class="form-control pop" placeholder="Enter your email" required="required" type="text">
											
											 <button type="submit" class="sub_pop" name="sub_pop"></button>
											
											
										</div>
									</div>
								</div>    
							                              
                            </form>
			</div>
		</div>
        
        <div class="md-overlay"></div>
        <script src="/assets/js/pop/classie.js"></script>
		<script src="/assets/js/pop/modalEffects.js"></script>
       
        <script>
			// this is important for IEs
			var polyfilter_scriptpath = '/js/';
		</script>
         <script src="/assets/js/pop/css-filters-polyfill.js"></script>
		<script src="/assets/js/pop/cssParser.js"></script>
		

			<script>

			 // open on click
			$("#modal-open").click(function(){
	   		$("#modal-1").addClass("md-show");
			}); 
			
			$("#modal-open2").click(function(){
	   		$("#modal-1").addClass("md-show");
			}); 
				

			 // Close on click
			$(".md-close").click(function(){
				$("#modal-1").removeClass("md-show");
			});
			
			$(".md-overlay").click(function(){
				$("#modal-1").removeClass("md-show");
			});

			</script>


        
<?php  
if(empty($_SESSION['poopy']))
   {
   ?>
<script>
$(document).ready(function(){
// Open after 1 sec
	setTimeout( function(){     
	$("#modal-1").addClass("md-show");
  }  , 5000 );
  
});
//Close after 20 second 
setTimeout( function(){    
	$("#modal-1").removeClass("md-show");
  }  , 60000 );  

/*

  // Do at bottom
$(window).scroll(function () {
   if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
      $("#modal-1").addClass("md-show");
   }
   
});


*/
</script>

<?php $_SESSION['poopy']="pops"; } ?>