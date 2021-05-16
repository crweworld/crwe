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

    <title>Crwe World | Affiliate | Agreement</title>
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
                        <h1>Agreement</h1>
                          Effective on the date of affiliate&rsquo;s approval, by and between CRWE WORLD, which is located at 11226 Pentland  Downs Street, Las Vegas, Nevada 89141, and YOU hereinafter referred to as &ldquo;Affiliate&rdquo;.  Whereas, CRWE WORLD is in the business of online publishing of Local, State wide, National, and International  news and Information, and has developed online services for sale.  <br /><br />

<h3>Grant</h3>
Company hereby grants to affiliate a non-exclusive right to utilize, market, introduce and sell the services of  CRWE WORLD, as well as other services associated with the CRWE WORLD network to potential clients; or  other parties that may be interested in a using any of the company&rsquo;s services/products. <br /><br />

We may modify any of the terms and conditions within this Agreement at any time and at our sole discretion.  These modifications may include, but not limited to changes in the scope of available referral fees, fee  schedules, payment procedures and Affiliate Program rules. If any of the modifications are UNACCEPTABLE TO  YOU, your only recourse is to terminate this Agreement. If you CONTINUE PARTICIPATION IN THE PROGRAM, it  will be considered as your acceptance of the change. <br /><br />

<h3>Enrollment</h3>
To enroll in the affiliate program, you must submit an affiliate application and be approved. Applications are  processed within 24 hours and applicants will be notified of their acceptance status as soon as possible after  their information is reviewed. <br /><br />

<h3>Affiliate URL</h3>
You will be issued a special URL once you become an approved member of the CRWE WORLD Affiliate  Program which will be unique to you and you only, and will allow you to be paid for affiliate sales. <br /><br />

<h3>Commissions</h3>
Affiliates will receive 50% on selected services ( <strong>highlighted in blue</strong> at <a href="http://www.crweworld.com/services_rate"><b>http://www.crweworld.com/services_rate</b></a> ) of the revenue collected as a commission from orders placed (unless noted otherwise for a particular product). Commissions may change at the discretion of the services provider.  Commissions may increase during limited time special promotions, but they will return thereafter to the  regular commission rate. <br /><br />

For a sale to generate a commission to an Affiliate, the customer must complete order and remit with full  payment for the product ordered through the secure order system. Word of mouth referrals will not result in  an affiliate commission being generated. Commissions will only be paid on sales that are made when the  customer clicks through qualified, correctly structured Affiliate link. Using the properly coded links is the sole  responsibility of the affiliate.  <br /><br />

Please note that CRWE WORLD reserves the right to suspend payment of Commission at any time and  indefinitely, if it suspects fraud or other improper activity or a potential breach of any of the terms in this  Agreement by the Affiliate or a Customer(s). We reserves the right to deduct from Affiliate's current and  future Commission Fees any and all Commission corresponding to any fraudulent, questionable, and cancelled  purchases.<br /> <br>

CRWE WORLD in its sole discretion, reserves the right to withhold indefinitely any Commission, and/or to  reverse, deny or reject any Commission, for the following:  <br> <br>

<li> Commissions generated for accounts that may be fraudulent, including but not limited to the use of  software that generates real and fictitious information.</li>  
<li> If we deem orders to be fraudulent or see a pattern of potentially fraudulent activity, including,  without limitation, where there are multiple accounts from the same customer, or referral of accounts  which do not comply with this Agreement.</li>  
<li> Altering Our Links in any way.</li>
<li> Customers that have been offered or received coupons, refunds, credits or discounts from the Affiliate.</li>
<li> Affiliates whom we believe may be artificially submitting Customers, engaging in the advertisement of  business-opportunity sites (as determined by CRWE WORLD in its sole discretion), using marketing  practices that we deem to be unethical or likely to attract fraudulent signups and/or signups with a  very low likelihood of renewal.</li>
<li> Any attempt by an Affiliate to manipulate, falsify or inflate , purchases or Commission to intentionally  defraud CRWE WORLD or violation of any of the terms of this Agreement constitutes immediate  grounds to terminate this Agreement and will result in forfeiture of any Commission due to you. </li><br /><br />

<h3>Affiliate Referral</h3>
We also offer registered affiliates compensation for direct referrals of others who becomes Affiliate of CRWE  WORLD. This is accomplished by giving you a five percent (5%) commission from the sale(s) of selected services  by the affiliate whom you are directly responsible for introducing him or her to our affiliate program. With this  added streams of income, your earning potential will increased.<br /><br />

 Please note that you will only earn a commission from the person you are directly responsible for referring her or  him to our program. (First Tier Affiliates Only) This does not include any affiliates recruited by the person you  referred.<br /><br />
 
<h3>Payment</h3>
CRWE WORLD pays affiliates via a direct deposit into a bank account, provided to us when a member joins. If  the account changes, it is the responsibility of the affiliate to notify CRWE WORLD to ensure proper payments  of commission. We will not resend payments returned due to incorrect payment bank account information.  We will wait till the new account information is given.<br /><br />

<h3>Order Fulfillment</h3>  
CRWE WORLD will be solely responsible for processing every order placed by a customer via affiliate&rsquo;s URL.  Affiliates are not authorized to collect payments or sell any CRWE WORLD services from other websites as a  &quot;reseller&quot; and no &quot;resale&quot; rights are granted in ANY way. Affiliates are not authorized to sell any of these  products on ebay or other auction sites. CRWE WORLD will also be solely responsible for all customer service  inquires.<br /><br />

Customers who purchase services through the CRWE WORLD Affiliate Program will be deemed to be  customers of CRWE WORLD. Accordingly, all rules, policies, and operating procedures concerning customer  orders and service will apply to those customers. We may change our policies and operating procedures at any  time. Prices and availability of our services may vary from time to time. CRWE WORLD policies will always  determine the price paid by the customer.<br /><br />

<h3>Use Of iframes</h3>
Affiliate shall not iframe in the CRWE WORLD (crweworld.com) website, as well as any of the other websites  networked through CRWE WORLD, for example, CRWE Press Release (crwepressrelease.com), as well as other  Crown Equity Holdings Inc., sites under its umbrella of companies onto your own website in any way shape or  form. This includes making it look like our website is displaying on your domain. This can damage our branding  efforts.<br /><br />

Affiliate shall not misrepresent CRWE WORLD products or services.<br /><br />

Affiliate is solely responsible for insuring that their Affiliate URL is setup properly to qualify for commissions.  You will only get commission on sales through your Affiliate URL link.<br /><br />

Affiliate may not use their own Affiliate Link to order services from CRWE WORLD. Doing so will result in  immediate reversal of any commission.
<br /><br />

<h3>Taxes and Address Changes</h3>
It is YOUR responsibility to provide CRWE WORLD with accurate tax and payment information that is necessary  to issue a commission fee to you. If we do not receive the necessary tax or payment information within 90  days of a purchase of a service(s) which would otherwise trigger a commission Fee or fees, the applicable  commissions shall not accrue and no commission will be owed with respect to such Purchase.  Each Affiliate is required to submit a W8/W9 tax form.<br /><br />

You are responsible for the payment of all taxes related to the commissions you receive under this Agreement.  In compliance with U.S. tax laws, CRWE WORLD will issue a Form 1099 to Affiliates whose earnings meet or  exceed the applicable threshold.<br /><br />

You are responsible for informing CRWE WORLD about changes to postal and e-mail addresses, as well as any  changes to your name, email address, contact information, tax identification number, or other personal  information that will impact our ability to issue a valid commission payment.<br />
Any address changes must be made in the Affiliate profile at least 15 business days prior to the end of the  calendar month in order to receive your commission fees for that month to be sent to the revised address.<br /><br />

<h3>Confidentiality</h3>
Each parties agrees that all information including, without limitation, CRWE WORLD and vendors, and  wholesale pricing and sales information, shall remain strictly confidential and shall not be utilized for any  purpose outside the terms of this Agreement except and solely to the extent that any such information is (a)  already lawfully known to or independently developed by the receiving party, (b) disclosed in published  materials, (c) generally known to the public, or (d) lawfully obtained from any third party.<br /><br />

However, each party is hereby authorized to deliver the copy of any such information (a) to any person  pursuant to a valid subpoena or order issued by any court or administrative agency of competent jurisdiction,  (b) to its accountants, attorneys, or other agents on a confidential basis, and (c) otherwise as required by  applicable law, rule, regulation, or legal process including, without limitation, the Securities Exchange Act of  1933, as amended, and the rules and regulations promulgated thereunder, and the Securities Exchange Act of  1934, as amended, and the rules and regulations promulgated thereunder.<br /><br />

<h3>Unauthorized Use of Affiliate URL</h3>
Affiliates cannot promote advertising, branding and marketing its provided URL to offer CRWE WORLD  services through the following type of sites: <br /><br />
<li> Promote sexually explicit materials</li>  
<li> Promote violence</li> 
<li> Promote discrimination based on race, sex, religion, nationality, disability, sexual orientation, or age</li>  
<li> Promote illegal activities</li>  
<li> Doing so can result in the termination of your affiliate account and withholding of affiliate payments  for violating our affiliate agreement.</li>  
<li> Infringe or otherwise violate any copyright, trademark, or other intellectual property rights of CRWE  WORLD., or any other Crown Equity Holdings Inc. site.</li>

 Violation of the above will terminate agreement between both parties.<br /><br />
 
<h3>Permitted Usage of Brand</h3>
The following are permitted uses of the CRWE WORLD brand and marketing resources. <br /> <br />

<li> Affiliates are permitted to use the graphical banners located at crweworld.com. If a specific size  banner ad is needed, the affiliate may contact the Affiliate Program manager and request a new  banner graphic size.</li><br />

<h3>Prohibited Usage of Brand</h3>
The following cases prohibited and are grounds for immediate termination of the affiliate account.<br /><br />

<li> Affiliates MAY NOT use the CRWE WORLD logo, logo marks or other CRWE WORLD or Crown Equity  Holdings Inc. website/branding imagery in a header graphic or in any way as to indicate they are  officially affiliated or partnered with either company.</li><br />

<h3>Gravity Forms Anti-Spam Policy</h3>
CRWE WORLD strictly prohibits affiliates from using spam e-mail and other forms of Internet abuse (including  spamming forums, blogs, twitter, facebook and other social media outlets) to seek sales. Spam is defined as  including, but not limited to, the following:<br /><br />

<li> Electronic mail messages addressed to a recipient with whom the sender does not have an existing  business or personal relationship or is not sent at the request of, or with the express consent of, the  recipient through an opt in subscription;</li>  
<li> Messages posted to Usenet, forums, Twitter, Facebook and message boards that are off-topic  (unrelated to the topic of discussion), cross-posted to unrelated newsgroups, posted in excessive  volume, or posted against forum/message board rules. Be conscious of forum rules! If a forum owner  or moderator complains that an affiliate has spammed, the affiliate account may be permanently  terminated after investigation. </li>
<li> Content posted on free blog websites for the sole purpose of keyword spamming, or comments posted  to legitimate blogs that violate the comment policy of the blog owner.</li>  
<li> Solicitations posted to chat rooms, or to groups or individuals via Internet Relay Chat or &quot;Instant  Messaging&quot; system;</li>  
<li> Certain off-line activities that, while not considered Spam, are similar in nature, including distributing  flyers or leaflets on private property or where prohibited by applicable rules, regulations, or laws.</li>

  CRWE WORLD, may undertake, at its sole discretion and with or without prior notice, the following  enforcement actions:<br /><br />
<li> Account Termination: Upon the receipt of a credible complaint, the CRWE WORLD Affiliate Program  manager may investigate the complaint, and if necessary, will then terminate the affiliate account of  the individual implicated in the abuse. Termination results in the immediate closure of the member  and affiliate account, the loss of all referrals, and the forfeiture of any unpaid money on account. At  CRWE WORLD discretion, termination will result in being banned from the affiliate program.</li><br />

<h3>Relationship of Parties</h3>
Affiliates are independent contractors, and nothing in this Agreement will create any partnership, joint  venture, agency, franchise, sales representative, or employment relationship between the parties. Affiliates  have no authority to make or accept any offers or representations on our behalf. Affiliates will not make any  statement, whether on their sites or otherwise, that reasonably would contradict this statement.<br /><br />

<h3>Term and Termination</h3>
The term of this Agreement will begin when you accept and will end when terminated by either party. Either  CRWE WORLD or the affiliate may terminate this Agreement at any time, with or without cause. Upon the  termination of this Agreement for any reason, the ability to sell our services hereunder shall immediately   terminate and you will immediately cease use of, and remove from Affiliate's Web Site, and all CRWE WORLD  Forms trademarks and logos, other marks and all other materials provided in connection with this program.<br> <br />

<h3>Limitation of Liability</h3> 
CRWE WORLD and/or its parent company, Crown Equity Holdings Inc. will not be liable for indirect, special, or  consequential damages (or any loss of revenue, profits, expenditures or data) arising in connection with this  Agreement or the Program, even if we have been advised of the possibility of such damages. Further, our  aggregate liability arising with respect to this Agreement and the Program will not exceed the total  commissions paid or payable to the affiliate under to this Agreement.<br /><br />

<h3>Disclaimers</h3>
We make no express or implied warranties or representations with respect to the Affiliate Program or an  affiliate's potential to earn income from the Affiliate Program. In addition, we make no representation that the  operation of any Crown Equity Holdings operated website such as CRWE WORLD and CRWE Press Release  websites will be uninterrupted or error-free, and thereby will not be liable for the consequences of any  interruptions or errors.<br /><br />

<h3>Miscellaneous</h3>
Our failure to enforce your strict performance of any provision of this Agreement will not constitute a waiver  of our right to subsequently enforce such provision or any other provision of this Agreement.<br /><br />

If any of the provisions of this Agreement are determined by a court to be unenforceable, they shall be  severed from this Agreement, and the remaining provisions shall remain in full force and effect.<br /><br />

By signing up with the CRWER WORLD Affiliate Program, you acknowledge that you have read this agreement  and agree to all its terms and conditions. You have independently evaluated this program and are not relying  on any representation, guarantee or statement other than as set forth in this agreement.<br /><br />

<h3>Non-Discrimination Policy:</h3>  
The policy of CRWE WORLD is to provide equal opportunity and equal consideration to all peoples without  regard to race, religion, ancestry, national origin, sexual orientation, color, creed, sex or physical disability.<br /><br />

<h3>Dispute Resolution; Governing Law</h3>
Affiliate and Company agree that no officer, director, employee, agent, or shareholder of either party shall be  subjected to any personal liability whatsoever to any person or entity, nor will any claim for personal liability  or suit be asserted by, or on behalf of, either Affiliate or Company.<br /><br />

Company and Affiliate agree to mediate in Las Vegas, Nevada any controversy, claim, or dispute arising  between the either party. Mediation fees, if any, shall be borne by the losing party.<br /><br />

Both parties hereto irrevocably consents in the event that the parties cannot settle the dispute in mediation,  each party hereto irrevocably consents to the exclusive jurisdiction of the federal and state courts sitting in  Clark County, Nevada for any legal action, suit, or proceeding arising out of or in connection with this  Agreement, any agreement contemplated hereby or thereby, and agrees that any such action, suit, or  proceeding may be brought only in such court, provided that this section shall not prevent a party from  seeking to enforce any judgment of to the exclusive jurisdiction of the federal and state courts sitting in Clark  County, Nevada.<br /><br />

  I INDICATE MY APPROVAL OF THIS AGREEMENT AND DESIRE TO BECOME AN AFFILIATE UNDER THESE TERMS AND  CONDITIONS BY SUBMITTING THE AFFILIATE PROGRAM REGISTRATION FORM, BY SUBMITTING PROPOSED REFERRED  CUSTOMERS OR QUALIFYING PURCHASES TO US UNDER OUR AFFILIATE PROGRAM AND/OR BY COLLECTING AND  COMMISSION FEES FROM US.
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
