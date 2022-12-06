<a id="modal-open2" href="#" style="right:50%;top: 0px;bottom: auto;" class="col-md-12 red button btn">Signup for free email updates</a>
<?php 
if($nav!='contribute.php' and isset($_SESSION['landing']))
{include('subs/popup.php');}

if(isset($_POST['subsc']))
{ 
	
	$subscribe=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['subscribe']);
	$sum11=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['sum11']);
	$sum1=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['sum1']);
	$sub_date = date("Y-m-d");
	$hash=serialize(bin2hex(random_bytes(9)));
	
	$sql="SELECT * FROM subscribers WHERE email='$subscribe'";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$count=mysqli_num_rows($result);
	
	if($subscribe==""){ echo "<script>alert('Please enter your email id for Newsletter Signup');</script>";} 	
	else if($sum1!=$sum11){ echo "<script>alert('Wrong sum entered in Newsletter Signup');</script>";} 	
	else{
	
			if($count==0)
			{			
				$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `subscribers`(`email`,`hash`,`active`, `sub_doc`) VALUES ('$subscribe','$hash','0', '$sub_date')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
				if($insert_ok == 1)
				{
					
					$to      = $subscribe; // Send email to our user
					$subject = "Crwe World | Verification"; // Give the email a subject 
				 $message = "
	<div dir=\"ltr\">************************************************************************************************************<br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><strong>Please verify your email address</strong></div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">Hi,</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><br />
	  Thanks for subscribing CRWEWORLD. Please take a moment to verify the email address by clicking the link below:</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><a href=\"http://{$_SERVER['HTTP_HOST']}/confirmation/$hash\" target=\"_blank\">http://{$_SERVER['HTTP_HOST']}/confirmation/$hash</a> or <a href=\"http://{$_SERVER['HTTP_HOST']}/confirmation/$hash\" target=\"_blank\">Click Here</a></div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<pre>This email is part of a Closed-Loop Opt-In system and was sent to protect   the privacy of the owner of this email address. Closed-Loop Opt-In confirmation   guarantees that only the owner of an email address can subscribe themselves  to this mailing list.    Furthermore, the following privacy policy is associated with this list:     </pre>
	<div dir=\"ltr\"><a href=\"http://crweworld.com/privacy_policy\" target=\"_blank\">http://crweworld.com/privacy_policy</a></div>
	<pre>Please read and understand this privacy policy. Other mechanisms may   have been enacted to subscribe email addresses to this list, such as  physical guestbook registrations, verbal agreements, etc.    If you did not ask to be subscribed to this particular list, please  do not visit the confirmation URL above. The confirmation for   subscription will not go through and no other action on your part   will be needed.</pre>
	<div dir=\"ltr\"> </div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">Please do not reply to this email; it was sent from an unmonitored email address. This message is a service email related to your use of CRWEWORLD. <br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">For general inquiries or to request support with your CRWEWORLD account:   <a href=\"mailto:contact@crweworld.com\" target=\"_blank\">contact@crweworld.com</a></div>
	<div dir=\"ltr\"><br />
	</div>
	<pre>The following physical address is associated with this mailing list:     11226 Pentland Downs St, Las Vegas, NV 89141<br /><br /><br />************************************************************************************************************</pre>";
				
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



<div id="footer">
        <div class="container">
        <center class="desk"><a href="/Hottest-Stocks-Today" target="_blank"><img alt="/assets/img/wall-street-rect2.png" src="/assets/img/wall-street-rect2.png" /></a></center>
         <center class="mobile-ads"><a href="/Hottest-Stocks-Today" target="_blank"><img alt="/assets/img/wall-street-sq.png" src="/assets/img/wall-street-sq.png" /></a></center>
         <br></br></br>
        
            <div class="sub-footer">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 prn1">
					
                        <div id="footer-news" class="section-category mbn">
                            <div class="section-name"><a href="#">Join with us</a></div>
                            <div class="section-content">
                            	<div class="heading"></div>
                                <ul class="list-unstyled list-inline">
                                    <li><a target="_blank" href="https://twitter.com/CrweWorld"><i class="fa fa-twitter-square fa-2x fa-fw"></i></a></li>
                                    <li><a target="_blank" href="https://www.facebook.com/crweworld4u"><i class="fa fa-facebook-square fa-2x fa-fw"></i></a></li>
                                    
                                    
                                </ul>
                                
                                <div class="row mbl">
                                    <div class="col-xs-12">


<a href="http://livetrafficfeed.com" data-num="5" data-width="300" data-responsive="0" data-time="America%2FNew_York" data-bot="0" c_header="2853a8" t_header="ffffff" border="2853a8" background="ffffff" t_normal="000000" t_link="135d9e" data-flag="0" data-counter="0" target="_blank" id="LTF_live_website_visitor">Live Traffic Feed</a><script src="//livetrafficfeed.com/static/v2/live.js?926123975"></script><noscript><a href="http://seomsn.com">seo checker</a></noscript>

								<?php if($nav!='contribute.php' and $nav!='Live-Traffic.php'){?>
                                     <script type="text/javascript" src="http://jj.revolvermaps.com/2/1.js?i=9uui5xdf9c4&amp;s=250&amp;m=0&amp;v=true&amp;r=false&amp;b=000000&amp;n=false&amp;c=ff0000" async="async"></script>
                              	<?php }?>
                                    </div>                                   
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 pan"></div>
                    <div class="col-xs-12 col-sm-6 col-md-3 pan1 latest_news">
                        <div id="footer-news" class="section-category mbn">
                            <div class="section-name"><a href="/about_us">About CrweWorld</a></div>
                            <div class="section-content">
                               <div class="latest-news-list">
                                   <ul class="list-news list-unstyled">
                                            <li><a href="/about_us"><i class="fa fa-caret-right"></i>About Us</a></li>
                                            <li><a href="/privacy_policy"><i class="fa fa-caret-right"></i>Privacy Policy</a></li>
                                            <li><a href="/terms_conditions"><i class="fa fa-caret-right"></i>Terms & Conditions</a></li>
                                            <li><a href="/finance_disclaimer"><i class="fa fa-caret-right"></i>Finance Disclaimer</a></li>
                                            <li><a href="/job"><i class="fa fa-caret-right"></i>Jobs</a></li>
                                        </ul>
                               
                                          <div class="heading footer_sub">Subscribe for newsletter</div>
                                <form action="" method="post" class="footer_sub">
                                	<div style="padding: 10px 0px;" class="col-md-12">
                                            <span class="re2 col-md-1">
                                                <i class="fa fa-refresh"></i>
                                             </span>
                                            <span class="rand12 col-md-1">3</span>
                                            <span class="plus col-md-1">+</span>
                                            <span class="rand22 col-md-1">2</span>
                                            <input type="hidden" id="id2" name="sum1" />
                                            <input class="col-md-3 col-sm-3" required="required" name="sum11" autocomplete="off" placeholder="Sum of No." type="text">
                                        </div>
                                    
                                <div class="input-group input-newsletter input-group-lg"><span
                                        class="input-group-addon"><i class="fa fa-envelope"></i></span><input
                                        type="email" name="subscribe" required="required" placeholder="Mail Id" class="form-control"/><span
                                        class="input-group-addon btn-subscribe">
                                        <button type="submit" name="subsc" class="btn">Subscribe</button></span>
                                </div>
                                </form>
                                    
                                </div>
                            </div>
                        </div>
                </div>
                    <div class="col-md-1 pan"></div>
                    <div class="col-xs-12 col-sm-6 col-md-3 pln1">
                        <div id="footer-contact" class="section-category mbn">
                            <div class="section-name"><a href="/contact">Contact Info</a></div>
                            <div class="section-content">
                                <ul class="list-info list-unstyled">
                                   <li><p><i class="fa fa-envelope-o fa-fw mrl"></i>contact@crweworld.com</p></li>
                                    <li><p><i class="fa fa-phone fa-fw mrl"></i>P: (702) 683-8946</p></li>
                                    <li><p><i class="fa fa-phone fa-fw mrl"></i>P: (702) 810-0178</p></li>
                                    <li><p><i class="fa fa-map-marker fa-fw mrl"></i>11226 Pentland Downs St, Las Vegas, NV 89141</p></li>

                            </ul>
                           <div class="heading">Tweets by CrweWorld</div>
                            <a class="twitter-timeline" href="https://twitter.com/CrweWorld" data-widget-id="684359076654923777">Tweets by @CrweWorld</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        <div class="copyright">
            <div class="container">
                <div class="pull-left">
                    <div class="footer-links">
                        <ul class="list-unstyled list-inline">
                            <li><a href="#">&copy; <?php echo date('Y');?> crweworld.com</a></li>                            
                        </ul>
                    </div>
                </div>
                <div class="pull-right"><a id="totop" href="#"><i class="fa fa-angle-up"></i></a></div>
            </div>
        </div>
    </div>
</div>
<?php
if($nav!='contribute.php' and $nav!='stock-track.php' and !isset($_SESSION['chatban']))
{ $_SESSION['chatban']=true;
?>
<script>
$(document).ready(function(){
    $(".chat2").click(function(){
        $(".chat").hide();
    });
});
</script>
<style>
.chat{
	position: fixed;
    bottom: 50px;
    margin: 0 auto;
    z-index: 1;
    width: 300px;
    right: 3%;
}
.chat2{
	position: relative;
    float: right;
	cursor:pointer;
	font-size:20px;
}
</style>
<div class="chat topbar-left">
<a class="chat2"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
<a href="/stock-track"><img src="/assets/img/cw-stocks-2-dash.png" class="img-responsive"/></a>
</div>
<?php } ?>

<?php include('side-ad.php') ?>





<a href="/services_rate" style="left: 50%;" class="col-md-12 red button btn">CRWE WORLD Advertising Services Rate</a>
<a target="_blank" href="https://affiliate.crweworld.com/" style="right: 50%;" class="col-md-12 red button btn">Join CRWE WORLD Affiliate Program</a>




<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--<script src="/assets/js/jquery-1.11.2.min.js"></script>-->
<script src="/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/libs/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="/assets/js/html5shiv.js"></script>
<script src="/assets/js/respond.min.js"></script>
<!--LOADING SCRIPTS FOR PAGE-->
<script src="/assets/vendors/easy-ticker/jquery.easing.min.js"></script>
<script src="/assets/vendors/easy-ticker/jquery.easy-ticker.min.js"></script>
<script src="/assets/js/pages/header_2.js"></script>
<!--CORE JAVASCRIPT-->
<script src="/assets/js/layout.js"></script>
<script src="/assets/js/menu_opener.js"></script>

<!--Weather-->

<script>
$(document).ready(function () {
    $.ajax({
		 <?php if($post_country=="usa")
			 { ?>
				 url: 'https://api.openweathermap.org/data/2.5/weather?q=<?php if(isset($api_state)){echo $api_state;}?>&units=imperial&APPID=772dced1c6c489ea078b4a3d0c425b5c',
			 <?php } 
			 else
			 { ?>				
				url: 'https://api.openweathermap.org/data/2.5/weather?q=<?php if(isset($api_state)){echo $api_state;}?>&units=Metric&APPID=772dced1c6c489ea078b4a3d0c425b5c',
			 <?php } ?>
			 
       
        dataType: 'json',
        type: 'GET',
        success: function (json) {
			 var temp = Math.round(json.main.temp );
			 <?php if($post_country=="usa")
			 { ?>
				 
				 $('#city-weather-temperature').html(temp + '\xB0 F');
			 <?php } 
			 else
			 { ?>	
			 	// var temp = Math.round(json.main.temp - 273.15);
				 $('#city-weather-temperature').html(temp + '\xB0 C');
			 <?php } ?>
          /*  */
            
            $('#city-weather-description').html(json.weather[0].description);
            $('img#city-weather-icon').attr('src', 'http://openweathermap.org/img/w/' + json.weather[0].icon + '.png');
        },
        error: function (xhr, status, errorThrown) {
        }
    });
    $('nav ul li a').on('click', function () {
        var $this = $(this);
        var target = $this.text().toLowerCase();
        $this.parent().addClass('selected').siblings().removeClass('selected');
        $('#' + target).fadeIn('slow').removeClass('hide').siblings().not('nav').not('.nav-info-behind').hide();
        return false;
    });
});

</script>
<!--Captcha-->
<script type="text/javascript">
function randomnum2(){var n=1,a=3,t=parseInt(a)-parseInt(n)+1,r=Math.floor(Math.random()*t)+parseInt(n),e=Math.floor(Math.random()*t)+parseInt(n),o=parseInt(r)+parseInt(e);$(".rand12").html(r),$(".rand22").html(e),document.getElementById("id2").value=o}$(document).ready(function(){$(".re2").click(function(){randomnum2()}),randomnum2()});
</script>
<!--Google-analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65204143-1', 'auto');
  ga('send', 'pageview');

</script>
<!--Start Cookie Script--> <style>#cookiescript_link { visibility:hidden;}</style> <script type="text/javascript" charset="UTF-8" src="https://cookie-script.com/s/03e19b8986b12051136d97063284ce04.js"></script> <!--End Cookie Script-->

<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-6Uwp0bqbdJ94s"
});
</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-6Uwp0bqbdJ94s.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->
<!-- THEME SETTINGS-->
<?php ((is_null($___mysqli_res = mysqli_close($mysql_link))) ? false : $___mysqli_res);?>
</body>

</html>
