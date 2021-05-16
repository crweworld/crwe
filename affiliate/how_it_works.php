<?php
session_start();
include ('subs/connect_me.php');

if(!empty($_SESSION['affi_id']))
{
	header('Location:affiliate/index.php');
}

if(isset($_POST['login']))
{
	$email=mysql_real_escape_string($_POST['email']); 
	$password=mysql_real_escape_string($_POST['password']); 
	$sql="SELECT * FROM affi_user WHERE password='$password' and email='$email' and ( active='1' or active='2')";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	if($count==1)
	{
		$active=mysql_query("select * from affi_user where ( active='1' or active='2') and email='$email' ");
		$row =mysql_fetch_array($active);
		$_SESSION['affi_id']=$row['id'];
		$_SESSION['affi_name']=$row['fname']." ".$row['lname'];
		$_SESSION['affi_username']=$row['username'];
		$_SESSION['affi_doc']=$row['doc'];
		$_SESSION['affi_email']=$row['email'];
		
		
		echo "<script>
		alert('Welcome');
		window.location.href='affiliate/index.php';
		</script>";
	}
	else
	{
		echo "<script>
		alert('Login Failed! Enter Correct Details or Contact Administrator');
		</script>";
		
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crwe World | Affiliate | How It Works</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script src="jquery.js"></script>
	<script src="prism.js"></script>
	<link href="assets/accordion.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">

    <link href="assets/css/colors_2.css" rel="stylesheet">
    <!-- Color stylesheet -->
    <!-- <link href="assets/css/colors.css" rel="stylesheet">
    <link href="assets/css/colors_2.css" rel="stylesheet">
    <link href="assets/css/colors_3.css" rel="stylesheet">
    <link href="assets/css/colors_4.css" rel="stylesheet"> -->


    <!-- Plugin stylesheets -->
    <link href="assets/css/plugins/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/plugins/owl.theme.css" rel="stylesheet">
    <link href="assets/css/plugins/owl.transitions.css" rel="stylesheet">
    <link href="assets/css/plugins/animate.css" rel="stylesheet">
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <link href="assets/css/plugins/jquery.mb.YTPlayer.min.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

   <style>
   li{
	   padding-bottom:11px;
   }
   a {
    color: #197CD9;
   }
   </style>
</head>

<body id="home">
            <!-- Navigation -->
          <nav class="navbar navbar-custom navbar-fixed-top top-nav-collapse" role="navigation">
                <div class="container">
                    <div class="navbar-header pull-left">
                        <a class="navbar-brand page-scroll join" href="#home">
                            <!-- replace with your brand logo/text -->
                            <span class="brand-logo"><img style="margin: -12px 0px;" src="assets/images/logo.png"  class="img-responsive"></span>
                        </a>
                    </div>
                    <div class="main-nav pull-right">
                        <div class="button_container toggle">
                            <span class="top"></span>
                            <span class="middle"></span>
                            <span class="bottom"></span>
                            <div style="margin: 0px 35px;color: #fff;">MENU</div>
                        </div>
                    </div>
                    <form class="form-inline" id="loginForm" name="loginForm" method="post" action="#" style="float: right;padding: 0px 25px;">                   
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">    
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <button type="submit" name="login" class="btn btn-default"  style="padding: 8px 5px; background:none; border:0px">Login</button>    
                    </form>
                    <div class="overlay" id="overlay">
                        <?php include('subs/nav.php'); ?>
                    </div>
                </div><!-- /.container -->
            </nav>




           


            <!-- About Section -->
            <section id="reg" class="about content-section alt-bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                       <h3 class="mb-sm mt-sm">The <span style="COLOR: #000">CRWE</span> <strong style="COLOR: #cc0101">WORLD</strong> Affiliate Business</h3>
<p>More than 3 million people worldwide are already forging their own path to success.</p>
<p>At CRWE WORLD, we are offering a commission based business opportunity that enables you to earn income from selling quality services and helping others that are directly referred by you to become an affiliate, to do the same.</p>
<h3 class="mb-sm mt-sm">Selling</h3>
<p>With CRWE WORLD, you are asked to approach businesses recommending the services we offer. Not only will they save money compared to other companies, but will increase consumer awareness of their business in the process, and make some income for your business.</p>
<p>Commissions for affiliates are earned from services sold, which results in how much income is deposited into your bank account.</p>
<p>CRWE WORLD has various marketing services for affiliates to choose from, ( highlighted in blue at <strong><a href="http://www.crweworld.com/services_rate">http://www.crweworld.com/services_rate</a></strong> ) which includes press releases, banner ads which pay a 50% commission of the retail price.</p>
<p>After registering and being approved as a CRWE WORLD affiliate, you will be provided a business URL and a member ID number. It is recommended that this information is included on your business card to move forward.</p>
<p>The branding and marketing services can be sold to small, medium and large businesses through your CRWE World personalized affiliate URL.</p>
<p>Usually, you can hand out a business card that has your CRWE WORLD - URL site on it, as well as your member ID and go over the services available for their business. Selling services and generating a customer base is the foundation for a successful independent business.</p>
<p>The more you sell the more you earn.</p>
<h3 class="mb-sm mt-sm">Learn About the Services</h3>
<p>After joining the team of CRWE WORLD affiliates, become familiar with the service that your new business has to offers. Go to the services offered URL to obtain a detailed description of the service. Click on the description button " <a href="http://crweworld.com/services_rate"><i style="color: #CC0101;" class="fa fa-info-circle" aria-hidden="true"></i></a> " next to the service offered. By becoming familiar with the various services and ad sizes, you are able to speak confidently about your services. Knowledge of services is the best sales tool. Increasing your knowledge of the services you offer increases your chances of having a successful sale.</p>
<p>Remind the client of their responsibility of providing logos or artwork for ads. (If a client is unable to create artwork for a banner or an advertisement ad, we can help create it for them for a reasonable fee).</p>
<h3 class="mb-sm mt-sm">Referred Affiliates</h3>
<p>To expand your business even further; like most affiliated businesses, there are two aspects to building success. There's the selling of services which is the foundation of your business and expanding of your business by sharing your business opportunity and information with others who may interested.</p>
<p>It's known as our "Referral Program". This program allows us to reward you a 5% income bonus; based on the amount of sells created from the affiliate(s) you directly referred to become an affiliate with CRWE WORLD.</p>
<p>PLEASE NOTE: No part of this bonus percentage is taken from the referred affiliate's commission. It is directly from CRWE WORLD, because we appreciate your assistance in growing our affiliate program.This additional source of income can increase your business financial success!</p>
<p>The more you and your referred affiliate sell – the more income you earn.</p>
<p>Therefore, creating sells and adding other affiliates, can increase your income!</p>
<p>Note: <strong>This program has only one direct downline. This is not a multi-level program</strong></p>
	
                        </div><!-- /.col-md-6 -->
                        
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.section -->

      <!-- Footer -->
            <footer>
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12 segment">
                            <a href="#">
                                <h2>
                                    <!-- replace with your brand logo/text -->
                                    <img src="assets/images/logo.png" class="img-responsive">
                                </h2>
                                
                            </a>
                           
                            <p class="white">We're excited to join hands with you, and look forward to a great partnership going ahead! Check out <a href="agreement.php" target="_blank" style="color:#197cd9">Our Terms</a></p>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->

                    <div class="row text-center">
                    
                        <div class="col-md-12 social segment">
                            <h4>Stay Connected</h4>
                            <a href="#"><i class="fa fa-facebook fa-3x"></i></a>
                            <a href="#"><i class="fa fa-twitter fa-3x"></i></a>
                            <a href="#"><i class="fa fa-linkedin fa-3x"></i></a>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->

                </div><!-- /.container -->

                <div class="copynote">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                &copy; 2016. CRWEWORLD. All rights reserved.
                            </div><!-- /.col-md-12 -->

                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.copynote -->

                <div class="nav pull-right scroll-top">
                    <a href="#home" title="Scroll to top"><i class="fa fa-angle-up"></i></a>
                </div>

            </footer><!-- /.footer -->

	 <script type="text/javascript">
            $(function(){
                
                // Accordion with default settings.
                $("#default_accordion").bwlAccordion();
                
               
                // Accordion with expand all/ collapse all button.
                $("#exp_coll_btn_accordion").bwlAccordion({     
                    ctrl_btn: true,
                    closeall: true,
                   nav_box: 'arrow',
                    theme: 'theme-blue'
                });
                
                // Accordion with toggle section.
                $("#toggle_accordion").bwlAccordion({
                    toggle: true
                });
                
                
            });
            
        </script>

    <!-- jQuery -->
  

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="assets/js/plugins/wow.min.js"></script>
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <script src="assets/js/plugins/jquery.parallax-1.1.3.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.mb.YTPlayer.min.js"></script>
    <script src="assets/js/plugins/jquery.countTo.js"></script>
    <script src="assets/js/plugins/jquery.inview.min.js"></script>
    <script src="assets/js/plugins/pace.min.js"></script>
    <script src="assets/js/plugins/jquery.easing.min.js"></script>
    <script src="assets/js/plugins/jquery.validate.min.js"></script>
    <script src="assets/js/plugins/additional-methods.min.js"></script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoVKfEihX__NdMwdDysA6Vve6PE9Ierj4"></script>

    <!-- Custom JavaScript -->
    <script src="assets/js/custom.js"></script>
</body>

</html>
