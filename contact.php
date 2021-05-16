<?php
include('subs/header.php');
if(isset($_POST['sendmsg']))
{ 
	$name=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['name']);
	$email=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email']);
	$message=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['message']);
	$subject=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['subject']);
	$err_feed='';$captcha='';
	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
     }
	 
	if($email==""){ $err_feed .='Please enter your email. \n';} 		
	if($name==""){ $err_feed .='Please enter your name. \n';}
	if($subject==""){ $err_feed .='Please select subject. \n';}
	if($message==""){ $err_feed .='Please enter your feedback. \n';}
	if($captcha==""){$err_feed .='Please check the captcha form.';}
	if($err_feed=="")
	{	 
		$to      = 'contact@crweworld.com'; // Send email to our user
		$subject = "Crwe World | Contact | $subject"; // Give the email a subject 
		$message = "
		<b>You got a new Message from contact</b> <br>
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

function metatag()
{
	echo '<title>Crwe World | Contact</title>';
}
?>

<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->
    <div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
            <div class="content">
                <div class="container">
                    <div class="row">
                    	<div class="col-lg-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3228.4268360569!2d-115.19054000000001!3d35.98543599999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c8c9529523457f%3A0x8b11f43884ef7a0f!2s11226+Pentland+Downs+St%2C+Las+Vegas%2C+NV+89141%2C+USA!5e0!3m2!1sen!2sin!4v1435092850174" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe></div>
						<div class="col-md-6">


							<h2 class="mb-sm mt-sm">Contact <strong style="color: #CC0101">Us</strong></h2>
							<form  id="contactForm" action="#" method="POST">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Your name *</label>
											<input  placeholder="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required="" type="text">
										</div>
										<div class="col-md-6">
											<label>Your email address *</label>
											<input  placeholder="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required="" type="email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Subject</label>
											<input  placeholder="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required="" type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Message *</label>
											<textarea  maxlength="5000" placeholder="Please enter your message." rows="10" class="form-control" name="message" id="message" required></textarea>
										</div>
									</div>
								</div>
                                <div class="row">
									<div class="form-group">
										<div class="col-md-12">
                                        <label>Please verify that you are human *</label>
											<div id="contact_cap"></div> 
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input value="Send Message" name="sendmsg"  style="margin: 10px auto; width: 100%;" class="btn btn-primary btn-lg mb-xlg" data-loading-text="Loading..." type="submit">
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6">

							<h4 class="heading-primary mt-lg">Get in <strong>Touch</strong></h4>
							<p>You may also send us an executive summary or mail us your business plan. We appreciate your assistance so we can serve you better.</p>

							<hr>

							<h4 class="heading-primary">The <strong>Office</strong></h4>
							<ul class="list list-icons list-icons-style-3 mt-xlg">
								<li><i class="fa fa-map-marker"></i> <strong>Address:</strong> 11226 Pentland Downs St, Las Vegas, NV 89141</li>
								<li><i class="fa fa-phone"></i> <strong>Phone:</strong> (702) 683-8946</li>
                                <li><i class="fa fa-phone"></i> <strong>Phone:</strong> (702) 810-0178</li>
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:contact@crweworld.com">contact@crweworld.com</a></li>
							</ul>

							<hr>

							<h4 class="heading-primary">Business <strong>Hours</strong></h4>
							<ul class="list list-icons list-dark mt-xlg">
								<li><i class="fa fa-clock-o"></i> Monday - Friday 9am to 5pm</li>
								<li><i class="fa fa-clock-o"></i> Saturday - 9am to 2pm</li>
								<li><i class="fa fa-clock-o"></i> Sunday - Closed</li>
							</ul>

						</div>

					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('subs/footer.php');?>