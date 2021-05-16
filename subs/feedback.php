<?php
if(isset($_POST['feedback']))
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
			$subject = "CrweWorld | FeedBack | $subject"; // Give the email a subject 
			$message = "
			<b>You got a new feedback</b> <br>
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
			alert('Thanks for your feedback');
			window.location.href='#';
			</script>";
		}
		else
		{
			echo "<script>alert('$err_feed');window.location = '#';</script>";
		}
}

?>
<div id="theme-setting"><a href="#" data-toggle="dropdown" class="btn-theme-setting"><img alt="feed" onerror="this.src='/default.jpg'" style="border: 1px solid rgb(255, 255, 255);" src="/assets/images/feed.png"></a>

<div class="theme-setting-content">
<div id="slideout_inner1">
<form action="#" method="post">
<div class="form-group">
<input class="form-control" placeholder="Name" required="required" type="name" name="name"><br>
<input class="form-control" placeholder="Email" required="required" type="email" name="email"><br>
<select class="form-control" required="required" name="subject">
  <option value="">--Subject--</option>
  <option value="Report a problem">Report a problem</option>
  <option value="Ask a Question">Ask a Question</option>
  <option value="Share Ideas">Share Ideas</option>
  <option value="Give Praise">Give Praise</option>
</select><br />
<textarea class="form-control"  placeholder="Message" required="required" name="message" rows="5"></textarea>
<div id="feedback_cap" style="padding-top: 20px;"></div> 
</div>
<button type="submit" name="feedback" style="font-weight:600" class="btn form-control btn-default">Submit</button>
</form> 
</div>
</div>
</div>