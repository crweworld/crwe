<?php
header('Content-type: application/json');


if($_POST)
{
   
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
       
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }

    //Sanitize input data using PHP filter_var().
    $email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password        = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
	$password_confirm        = filter_var($_POST["password_confirm"], FILTER_SANITIZE_STRING);
	$tnc        = filter_var($_POST["tnc"], FILTER_SANITIZE_STRING);
	
	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
     }

    //additional php validation
	include ('../../subs/connect_me.php');
	
	$sql="SELECT * FROM affi_user WHERE email='$email'";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
   
   if($count!=0){ //email validation
        $output = json_encode(array('type'=>'error', 'text' => 'Email Id already exsist'));
        die($output);
    }
	
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //email validation
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email'));
        die($output);
    }

    if($password!=$password_confirm){ //check emtpy message
        $output = json_encode(array('type'=>'error', 'text' => 'Password mismatch'));
        die($output);
    }
	
	 if(!$captcha){ // If length is less than 4 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'Please check the captcha form'));
        die($output);
    }
	 if($tnc!='1'){ // If length is less than 4 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'Please Agree to Our Term and Conditions'));
        die($output);
    }
	
	$hash=(bin2hex(random_bytes(9)));
	$doc = date("Y-m-d");

	$insert_ok = mysql_query("INSERT INTO `affi_user`(`doc`, `active`, `email`,`hash`, `password`) VALUES ('$doc','0', '$email','$hash', '$password')")or die(mysql_error());
	
			if($insert_ok == 1)
			{
				$id=mysql_insert_id();
				$affi_id=$id+1000;
				mysql_query("UPDATE `affi_user` SET `affi_id`='$affi_id' where id='$id'");
				
				 $output = json_encode(array('type'=>'success', 'text' => 'Success!!! Please Check Your Mail For Verification.'));
				 $to      = $email; // Send email to our user
				$subject = "Welcome to CRWE World Affiliate Program! | Verification"; // Give the email a subject 
				$message="<table width=\"675\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"font-family:Arial,Verdana,sans-serif;font-size:11pt\"> <tbody><tr style=\"background-color:#2f88dc;height:100px;vertical-align:middle\"> <td> <a style=\"text-decoration:none\" href=\"#\" target=\"_blank\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/logo.png\" style=\"color:#fff;font-size:25px;padding:10px 0px\" height=\"71\" width=\"309\" border=\"0px\"> </a> </td> <td align=\"right\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/earn.png\" alt=\"EARN\" width=\"82\" height=\"78\" style=\"float:right;margin:3px 10px 0 0\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/link.png\" alt=\"LINK\" width=\"83\" height=\"78\" style=\"float:right;margin:3px 0 0 0\"> </td> </tr> </tbody></table>   </span><table width=\"675\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background-color:#fff;font-family:sans-serif;font-size:11pt;text-align:justify\"> <tbody><tr><td style=\"padding:20px 20px 0 20px;color:#444;line-height:1.5em\">
		 <p>Congratulations on your decision to become an independent CRWE WORLD Affiliate!</p>
          <p>It certainly won't go unappreciated.</p>
          <p>To continue the process in reference to becoming an affiliate; please complete your profile page for us to start your approval process through your dashboard by logging in (using the below link) with your email address and password. If you were referred to us by an existing affiliate, remember to place affiliate ID number on your profile page where requested.</p>
               
        <p><a href=\"http://affiliate.crweworld.com/verify/$id/$hash\" target=\"_blank\">http://affiliate.crweworld.com/verify/$id/$hash</a></p><span class=\"im\">
        <h4><font color=\"red\"><b>Note:</b></font> </h4>
                
        <p style=\"font-size: 10px;line-height: 13px;\">This email is part of a Closed-Loop Opt-In system and was sent to protect the privacy of the owner of this email address. Closed-Loop Opt-In confirmation guarantees that only  the owner of an email address can subscribe themselves to this mailing list. Furthermore, the following privacy policy is associated with this list: <br>
<a href=\"http://www.crweworld.com/terms_conditions\">http://www.crweworld.com/terms_conditions </a><br>
Please read and understand this privacy policy. Other mechanisms may have been enacted to subscribe email addresses to this list, such as physical guestbook registrations,  verbal agreements, etc.If you did not ask to be subscribed to this particular list, please do not visit the confirmation URL above. The confirmation for subscription will not go  through and no other action on your part will be needed. </p>
                
        <p>&nbsp;</p> 
        <p>  
          Thank You,</p>
        <p>Your partner in business <br> CRWE WORLD </p> 
        <br> </span></td> 
                </tr>  <tr style=\"background-color:#2f88dc;vertical-align:middle\"> <td style=\"font-size:11px;font-weight:bold;padding:15px;color:#eee\"> <div style=\"margin-bottom:1em\">&copy; 2016, crweworld.com. All rights reserved.</div> <div>The following physical address is associated with this mailing list: 11226 Pentland Downs St, Las Vegas, NV 89141
                </div> <div>For general inquiries or to request support with your CRWEWORLD Affiliate account: <a href=\"mailto:affiliate@crweworld.com\" target=\"_blank\" style=\"color: white;\">affiliate@crweworld.com</a></div> </td> </tr> </tbody></table>";
				$headers = 'MIME-Version: 1.0' . "\r\n";  
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
				
				//phpemailer
				 require '/var/www/html/vhosts/phpmail/mail.php';
				 $from_name= 'CrweWorld Affiliate';
				 $reply = 'affiliate@crweworld.com';
				 $reply_name = 'CrweWorld Affiliate';
				 $to = $email;
				 $subject = $subject;
				 $message = $message;
				 $send_mail = sendphpmail('crweworld.com',$from_name,$reply,$reply_name,$to,$subject,$message);die($output);
			}
			else
			{
				 $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail!'));
     			   die($output);
			}

   
}


?>
