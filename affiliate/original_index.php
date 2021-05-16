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
	$sql="SELECT * FROM affi_user WHERE password='$password' and email='$email'";
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

    <title>Crwe World | Affiliate</title>
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <script>
        document.createElement('video');
      </script>
    <![endif]-->
<script src='https://www.google.com/recaptcha/api.js'></script>
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
                        <nav class="overlay-menu">
                            <ul>
                                <li><a href="#reg">Register</a></li>
                                <li><a href="#services">How It Works</a></li>
                                <li><a href="#crwe">What is CRWE WORLD?</a></li>
                                <li><a href="#mm">Making Money?</a></li>
                                <li><a href="#products">Why we are awesome?</a></li>
                                <li><a href="#faq">FAQ's</a></li>
                                <li><a href="#portfolio">Our other works</a></li>
                                <li><a href="#contact">Contact us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div><!-- /.container -->
            </nav>




            <!-- Intro Header -->
            <!-- Full Page Image Background Carousel Header -->
            <header id="intro-carousel" class="carousel slide">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item html5-video-container active">
                        <!-- HTML5 Video -->
                        <video muted autoplay loop poster="assets/images/typing-on-mac.jpg" id="html5-video" class="fill">
                            <source src="assets/videos/typing-on-mac.webm" type="video/webm">
                                <source src="assets/videos/typing-on-mac.mp4" type="video/mp4">
                        </video>
                        <div class="carousel-caption">
                            <h1 class="animated slideInDown"><span style="color: #197CD9;">Earn Money</span> by becoming a CRWE WORLD Affiliate <span style="color: #197CD9;">BE YOUR OWN BOSS</span></h1>
                           
                            <a href="#reg" class="register-btn join btn btn-default btn-lg">Easy & Free to Join</a>
                        </div>
                        <div class="html5-video-controls">                           
                            <a id="html5-video-play" class="fa fa-pause fa-lg" href="#"></a>
                        </div>
                        <div class="overlay-detail"></div>
                    </div><!-- /.item -->

                </div><!-- /.carousel-inner -->
                <div class="mouse"></div>
            </header>



            <!-- About Section -->
            <section id="reg" class="about content-section alt-bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>JOIN and EARN</h2>
                            <h3 class="caption gray">CRWE WORLD provides a non-risk opportunity for anyone to start their own business.</h3>
                            
                            <blockquote>
                                The CRWE WORLD experience can lead to more financial opportunity, flexibility and the freedom to determine your own path.
                            </blockquote>
                            
                            
                            <h3 class="gray light">If you are willing to put in the time, effort and work.</h3>

                        </div><!-- /.col-md-6 -->
                        
                       <div class="register-form col-xs-6">
                       		<h2>Register</h2>
                           
                           <form class="ajax-form" id="registerForm" method="post" action="assets/php/register.php">
                               
                                <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                             	</div>
                                <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                                
                                <div class="form-group">
                                		 <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password" required>
                                </div>
                               	<div class="form-group">                                    
                                            <div class="g-recaptcha" data-sitekey="6LcgQgsTAAAAAGewG0MPeR76OLu-ViO_fuNvygsu"></div>
                                 </div>
                                <div class="form-group">
                                            <label>
                                                <input id="tnc"  name="tnc" value="1" type="checkbox" required> I agree to the Crweworld Affiliate Program <a style="color: #197cd9;" href="#">Term and Conditions</a>
                                            </label>
                                </div>
                                <div class="form-group">
                                <button type="submit" name="register" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> REGISTER ME</button>
                                </div>
                                   
                                <div class="form-group mt10">
                                   Forgot Password? Click <a id="forgot-btn" style="color: #197cd9;" href="#reg">here</a> to reset.
                                </div>
                              
                            </form>
                        </div><!-- /.col-md-6 -->
                        
                         <div class="forgot-form col-xs-6">
                       		<h2>Forgot Password</h2>
                           
                           <form class="ajax-form" id="resetForm" method="post" action="assets/php/reset.php">
                               
                                <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                             	</div>
                                                               
                                <div class="form-group">
                                <button type="submit" name="reset" class="btn btn-default"><i class="fa fa-check-square-o fa-fw"></i> Send My Password</button>
                                </div>
                                   
                                <div class="form-group mt10">
                                   Don't have an account? Click <a class="register-btn" style="color: #197cd9;" href="#reg">here</a> to register.
                                </div>
                              
                            </form>
                        </div><!-- /.col-md-6 -->
                        
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.section -->



            <!-- Services Section -->
            <section id="services" class="services content-section">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h2>How It Works</h2>
                            
                        </div><!-- /.col-md-12 -->

                        <div class="container">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="row services-item sans-shadow text-center">
                                        <i class="fa fa-desktop fa-3x"></i>
                                        <h4>JOIN</h4>
                                        <p>Complete Affiliate Application</p>
                                    </div><!-- /.row -->
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-3">
                                    <div class="row services-item sans-shadow text-center">
                                        <i class="fa fa-line-chart fa-3x"></i>
                                        <h4>PROMOTE</h4>
                                        <p>Promote Your Services</p>
                                    </div><!-- /.row -->
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-3">
                                    <div class="row services-item sans-shadow text-center">
                                        <i class="fa fa-usd fa-3x"></i>
                                        <h4>SELL</h4>
                                        <p>Sell CRWE WORLD Services</p>
                                    </div><!-- /.row -->
                                </div><!-- /.col-md-4 -->

                                <div class="col-md-3">
                                    <div class="row services-item sans-shadow text-center">
                                        <i class="fa fa-thumbs-o-up fa-3x"></i>
                                        <h4>COMMISSION</h4>
                                        <p>Receive Your Commission</p>
                                    </div><!-- /.row -->
                                </div><!-- /.col-md-4 -->

                               
                               <p>Apply through our secured online form. Approval in 24 hours.</p>

                            </div><!-- /.row -->
                        </div><!-- /.container -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.section -->
            
            <!-- Call to action - one section -->
            <section id="crwe" class="cta-one-section content-section alt-bg-light">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <h2>What is CRWE WORLD?</h2>
                                <p style="text-align: justify;">An online global news and information publication offering advertising, branding, and marketing solutions to boost awareness of a business to an audience on a community, city, state-wide, regional, national on internationally basis. Soon to become a one-stop shop for the various needs of the online consumers ,ranging from Real Estate, Coupons & Deals, Business Directory and much more, while maintaining our commitment in providing community news and information.</p>

                        </div><!-- /.col-md-6 -->

                        <div class="col-md-6">
                             <blockquote>
                               THIS IS NOT A GET RICH SCHEME WITH TIME, EFFORT & WORK, YOU CREATE THE INCOME AMOUNT YOU DESERVE
                            </blockquote>
                            <p style="text-align: justify;">CRWE WORLD provides an opportunity for people to earn extra income. (And that is what the selling industry is about.) Where you can work from wherever you want. (From your kitchen to your bedroom.) Sure; starting a business takes work.But it is also a way to earn extra income around your schedule.</p>
                            
                            <a href="#faq" class="join btn btn-default btn-lg">Questions?</a>
                            <a href="#contact" class="join btn btn-outlined btn-lg">Contact us</a>
                        </div><!-- /.col-md-6 -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.cta-one-section -->



			<section id="mm" class="testimonials content-section">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h2>Making Money</h2>
                            
                        </div><!-- /.col-md-12 -->
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="client-testimonials owl-carousel owl-theme">

                                        <div class="item">
                                            <p class="speech">Emma just started a business with CRWE WORLD. And now she's ready to start making money. As an independent business owner She sells high quality online branding & awareness services. Like banner ads and press release distribution services. She gets to keep 50% of the customer's cost. That's the first way she earns income.</p>
                                            <table width="184" height="43" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="144">CUSTOMER COST - 50%</td>
  </tr>
  <tr>
    <td style="border-top:#000 1px solid; text-align:center">HER PROFIT</td>
  </tr>
</table>
                                            <div class="client-info">
                                                <img src="assets/images/gina_stone-client_pic.jpg" />
                                            </div>
                                        </div><!-- /.item -->

                                        <div class="item">
                                            <p class="speech">Now Emma has a friend (Mike) interested in doing what she does. He becomes an affiliate. He now earns money from selling services. Now Emma earns an additional 5% of the amount each product and service Mike sold. The more they all sell, the more they all can earn. This is the second way Emma earns income. Giving her and many others more than one (1) opportunity to earn.</p>
                                            <div class="client-info">
                                                <img src="assets/images/john_doe-client_pic.jpg" />
                                            </div>
                                        </div><!-- /.item -->
                                       

                                    </div><!-- /.client-testimonials -->
                                </div><!-- /.col-md-8 -->

                            </div><!-- /.row -->
                        </div><!-- /.container -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section>


            <!-- Products Section -->
            <section id="products" class="products content-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="assets/images/crwe_affiliate_template-iphone_white.png" class="center-block img-responsive">
                        </div><!-- /.col-md-4 -->

                        <div class="col-md-8">
                            <div class="products-container">

                                <div class="col-md-12">
                                    <h2>Why we are awesome?</h2>
                                    <h3 class="caption white">You take a commission on the sale of service(s) from CRWE WORLD that has been sold or referred by you.</h3>
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-6 product-item">
                                    <div class="media-left">
                                        <span class="icon"><i class="fa fa-usd fa-3x"></i></span>
                                    </div><!-- /.media-left -->
                                    <div class="media-body">
                                        <h3 class="media-heading">Cost effective</h3>
                                        <p>You don't have to worry about the production cost as the product is already developed.</p>
                                    </div><!-- /.media-body -->
                                </div><!-- /.col-md-6 -->

                                <div class="col-md-6 product-item">
                                    <div class="media-left">
                                        <span class="icon"><i class="fa fa-globe fa-3x"></i></span>
                                    </div><!-- /.media-left -->
                                    <div class="media-body">
                                        <h3 class="media-heading">Global market</h3>
                                        <p>You have the opportunity to reach people all over the world.</p>
                                    </div><!-- /.media-body -->
                                </div><!-- /.col-md-6 -->

                                <div class="col-md-6 product-item">
                                    <div class="media-left">
                                        <span class="icon"><i class="fa fa-money fa-3x"></i></span>
                                    </div><!-- /.media-left -->
                                    <div class="media-body">
                                        <h3 class="media-heading">No fee to join</h3>
                                        <p>You don't need to pay anything to join affiliate program.</p>
                                    </div><!-- /.media-body -->
                                </div><!-- /.col-md-6 -->

                                <div class="col-md-6 product-item">
                                    <div class="media-left">
                                        <span class="icon"><i class="fa fa-home fa-3x"></i></span>
                                    </div><!-- /.media-left -->
                                    <div class="media-body">
                                        <h3 class="media-heading">Work from home</h3>
                                        <p>You can work in the comfort of your own home.</p>
                                    </div><!-- /.media-body -->
                                </div><!-- /.col-md-6 -->

                               

                            </div><!-- /.products-container -->
                        </div><!-- /.col-md-8 -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.products -->



            <!-- Our team Section -->
            <section id="faq" class="team content-section">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h2>FAQ's</h2>
                            
                        </div><!-- /.col-md-12 -->

                        <div class="container">
                            <div class="row">
                            <h3 class="caption gray">Being an CRWE WORLD affiliate means you are your own boss, so you can benefit from setting your own marketing goals and income targets.</h3>
                            	<div class="bwl_acc_container" id="exp_coll_btn_accordion">
                                    <section>
                                        <h2 class="acc_title_bar theme-blue-title-bar nav_arrow"><a href="#">Why should I become an official affiliate?</a></h2>
                                        <div style="" class="acc_container">
                                            <div style="opacity: 1;" class="block animated fadeInDown">
                                                                 
                                                <p style="padding: 10px 5px; font-size: 16px;">Affiliate marketing is probably one of the quickest and cheapest ways to start making money, as you don't have to create any services yourself.<br>
Affiliate marketing is considered to be one of the world's fastest growing and best marketing techniques to earn money on and off line.
                                                </p>
                                            </div>
                                        </div>
                                    </section>
                                    
                                    <section>
                                        <h2 class="acc_title_bar theme-blue-title-bar nav_arrow"><a href="#">Pay?</a></h2>
                                        <div style="" class="acc_container">
                                            <div style="opacity: 1;" class="block animated fadeInDown">
                                                                 
                                                <p style="padding: 10px 5px; font-size: 16px;">All affiliate payments are made within 30 days from the end of each month you earned a commission.<br>
There is no limit to how much you can make.<br>
Affiliates will be paid a 50% commission fee for each service generated through a Crown Equity Holdings Inc. Other 3rd party services will have a different pay out.
                                                </p>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <h2 class="acc_title_bar theme-blue-title-bar nav_arrow"><a href="#">What does it cost to become an affiliate?</a></h2>
                                        <div style="" class="acc_container">
                                            <div style="opacity: 1;" class="block animated fadeInDown">
                                                                 
                                                <p style="padding: 10px 5px; font-size: 16px;">All you have to do is <a style="color: #337ab7;" href="#reg" class="join">Sign Up Here</a>. You'll get instant approval.
                                                </p>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <h2 class="acc_title_bar theme-blue-title-bar nav_arrow"><a href="#">What if I have more questions?</a></h2>
                                        <div style="" class="acc_container">
                                            <div style="opacity: 1;" class="block animated fadeInDown">
                                                                 
                                                <p style="padding: 10px 5px; font-size: 16px;">If you have any more questions regarding our affiliate program, <a style="color: #337ab7;" href="#contact" class="join">Click Here</a> to fill out our affiliate support request. </p>
                                            </div>
                                        </div>
                                    </section>
                        
                                    
                        
                                </div>
                            
                            	

                            </div><!-- /.row -->
                        </div><!-- /.container -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.our-team -->



            <!-- Portfolio/Gallery Section -->
            <section id="portfolio" class="portfolio content-section parallax">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h2>Our other works</h2>
                            <h3 class="caption white">Designed with passion and coded to perfection with tons of features yet is so easy to use. </h3>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->

                <div class="container project-container text-center">
                    <div class="recent-project-carousel owl-carousel owl-theme popup-gallery">
                        <div class="item recent-project">
                            <img src="assets/images/gallery/crwepress.jpg" alt="">
                            <div class="project-info">
                                <h3>crwepressrelease.com</h3>
                                <ul class="project-meta">
                                    <li><a class="join" href="#portfolio">Press Release</a></li>
                                </ul>
                            </div><!-- /.project-info -->
                            <div class="full-project">
                                <a target="_blank" href="http://www.crwepressrelease.com/" >Visit Site <i class="fa fa-chevron-right"></i></a>
                            </div><!-- /.full-project -->
                        </div><!-- /.item -->

                        <div class="item recent-project">
                            <img src="assets/images/gallery/crownequityholdings.jpg" alt="">
                            <div class="project-info">
                                <h3>crownequityholdings.com</h3>
                                <ul class="project-meta">
                                    <li><a class="join" href="#portfolio">Publicly Trade</a></li>
                                </ul>
                            </div><!-- /.project-info -->
                            <div class="full-project">
                                <a target="_blank" href="http://www.crownequityholdings.com/" >Visit Site <i class="fa fa-chevron-right"></i></a>
                            </div><!-- /.full-project -->
                        </div><!-- /.item -->

                        <div class="item recent-project">
                            <img src="assets/images/gallery/crwedomains.jpg" alt="">
                            <div class="project-info">
                                <h3>crwedomains.com</h3>
                                <ul class="project-meta">
                                    <li><a class="join" href="#portfolio">Web Hosting</a></li>
                                </ul>
                            </div><!-- /.project-info -->
                            <div class="full-project">
                                <a target="_blank" href="http://crwedomains.com/" >Visit Site <i class="fa fa-chevron-right"></i></a>
                            </div><!-- /.full-project -->
                        </div><!-- /.item -->

                        <div class="item recent-project">
                            <img src="assets/images/gallery/crwetube.jpg" alt="">
                            <div class="project-info">
                                <h3>crwetube.com</h3>
                                <ul class="project-meta">
                                    <li><a class="join" href="#portfolio">Video Portal</a></li>
                                </ul>
                            </div><!-- /.project-info -->
                            <div class="full-project">
                                <a  class="join" href="#portfolio" >Site Under Construction <i class="fa fa-chevron-right"></i></a>
                            </div><!-- /.full-project -->
                        </div><!-- /.item -->

                    </div><!-- /.recent-project-carousel -->

                    <div class="customNavigation project-navigation text-center">
                        <a class="btn-prev"><i class="fa fa-angle-left fa-2x"></i></a>
                        <a class="btn-next"><i class="fa fa-angle-right fa-2x"></i></a>
                    </div><!-- /.project-navigation -->

                </div><!-- /.container -->
            </section><!-- /.portfolio -->


            

            <!-- Call to action - two section -->
            <section class="cta-two-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3>Have an idea?</h3>
                            <p>We're here to help you manage your work</p>
                        </div>
                        <div class="col-sm-3">
                            <a href="#contact" class="join btn btn-overcolor">Get in touch</a>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.cta-two-section -->



            <!-- Contact section -->
            <section id="contact" class="contact content-section no-bottom-pad">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h2>Contact</h2>
                            <h3 class="caption gray">Feel free to get in touch with us if you have any questions, need any suggestions, or would simply like to know more.</h3>
                        </div><!-- /.col-md-12 -->

                    </div><!-- /.row -->
                </div><!-- /.container -->

                <div class="container">
                    <div class="row form-container">

                        <div class="col-md-8 contact-form">
                            <h3>Drop us a line</h3>
                            <form class="ajax-form" id="contactForm" method="post" action="assets/php/contact.php">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name..." value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email..." value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Your phone..." value="" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="4" name="message" placeholder="Your message..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-default"><i class="fa fa-paper-plane fa-fw"></i> Send</button>
                                </div>
                            </form>
                        </div><!-- /.contact-form -->

                        <div class="col-md-4 contact-address">
                            <h3>Our address</h3>
                            <p>11226 Pentland Downs St,<br>Las Vegas,<br> NV 89141</p>
                            <ul>
                                <li><span>Email:</span>affiliate@crweworld.com</li>
                                <li><span>Phone:</span>(702) 683-8946, (702) 810-0178</li>
                               
                            </ul>
                        </div><!-- /.contact-address -->

                    </div><!-- /.row -->
                </div><!-- /.container -->

                <div class="container-fluid buffer-forty-top">
                    <div class="row">
                        <section id="cd-google-map no-bottom-pad">
                            <div id="google-container"></div>
                            <div id="cd-zoom-in"></div>
                            <div id="cd-zoom-out"></div>
                        </section>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->


            
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
                            <p class="white">We're excited to join hands with you, and look forward to a great partnership going ahead!</p>
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
