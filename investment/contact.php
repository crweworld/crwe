<?php include('pages/connect_me.php'); 
include( 'pages/template.php'); 
if(isset($_POST['submit']))
{ 
	$name=mysqli_real_escape_string($mysql_link, $_POST['name']);
	$email=mysqli_real_escape_string($mysql_link, $_POST['email']);
	$message=mysqli_real_escape_string($mysql_link, $_POST['message']);
	$err_feed='';$captcha='';
	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
     }
	 
	if($email==""){ $err_feed .='Please enter your email. \n';} 		
	if($name==""){ $err_feed .='Please enter your name. \n';}	
	if($message==""){ $err_feed .='Please enter your feedback. \n';}
	if($captcha==""){$err_feed .='Please check the captcha form.';}
	if($err_feed=="")
	{	 
		$to      = 'invest@crweworld.com'; // Send email to our user
		$subject = "Investment | Contact"; // Give the email a subject 
		$message = "
		<b>You got a new Message from Investment contact</b> <br>
		<b>Name: $name <br>
		<b>Email:</b> $email <br>
		<b>Message:</b> $message <br>
		";
		//phpemailer
		 require '/var/www/html/vhosts/phpmail/mail.php';
		 $from_name= $name;
		 $reply = $email;
		 $reply_name = $name;
		 $to = $to;
		 $subject = $subject;
		 $message = $message;
		 $send_mail = sendphpmail('crweworld.com',$from_name,$reply,$reply_name,$to,$subject,$message);
		
		echo "<script>
		alert('Mail Sent Successfully');
		window.location.href='#';
		</script>";
	}
	else
		{
			echo "<script>alert('$err_feed');window.location = '#';</script>";
		}
}
?>
<!doctype html>
<html lang="en">
<?php meta(); ?>
<script src="//www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
<script type="text/javascript">
var CaptchaCallback = function(e){    
		grecaptcha.render('contact_cap', {'sitekey' : '6LfhIwkUAAAAAPENhSenPsK7YOm-PHnN2Fs_0IFQ'});
    };
</script>
<body>
	<?php headr()?>
	<div class="main-wrapper ">
		<section class="page-title bg-1">
		  <div class="container">
			<div class="row">
			  <div class="col-md-12">
				<div class="block text-center">
				  <span class="text-white">Contact Us</span>
				  <h1 class="text-capitalize mb-4 text-lg">Get in Touch</h1>
				</div>
			  </div>
			</div>
		  </div>
		</section>
		<!-- contact form start -->
		<section class="contact-form-wrap section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12">
						 <form class="contact__form" method="post" action="#">
						 <!-- form message -->
							<div class="row">
								<div class="col-12">
									<div class="alert alert-success contact__msg" style="display: none" role="alert">
										Your message was sent successfully.
									</div>
								</div>
							</div>
							<!-- end message -->
							<span class="text-color">Send a message</span>
							<h3 class="text-md mb-4">Contact Form</h3>
							<div class="form-group">
								<input name="name" type="text" class="form-control" placeholder="Your Name" required>
							</div>
							<div class="form-group">
								<input name="email" type="email" class="form-control" placeholder="Email Address" required>
							</div>
							<div class="form-group-2 mb-4">
								<textarea name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
							</div>
							<div class="form-group">
								<div id="contact_cap"></div> 
							</div>
							<button class="btn btn-main" name="submit" type="submit">Send Message</button>
						</form>
					</div>

					<div class="col-lg-5 col-sm-12">
						<div class="contact-content pl-lg-5 mt-5 mt-lg-0">
							<h2 class="mb-5 mt-2">Don’t Hesitate to contact with us for any kind of information</h2>

							<ul class="address-block list-unstyled">
								<li>
									<i class="ti-direction mr-3"></i>11226 Pentland Downs St, Las Vegas, NV 89141
								</li>
								<li>
									<i class="ti-email mr-3"></i>Email: invest@crweworld.com
								</li>
								<li>
									<i class="ti-mobile mr-3"></i>Phone:+(702) 683-8946
								</li>
							</ul>

						</div>
					</div>
				</div>
			</div>
		</section>
		
		<?php footer()?>
	</div>
	<?php script()?>
</body>
</html>