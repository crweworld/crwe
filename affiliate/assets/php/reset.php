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
    
	
    //additional php validation
	include ('../../subs/connect_me.php');
	
	$sql="SELECT * FROM affi_user WHERE email='$email' and (active='1' or active='2')";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
   
   if($count!=1){ //email validation
        $output = json_encode(array('type'=>'error', 'text' => 'We couldn\'t find an account using that email address.Please try again'));
        die($output);
    }
	
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //email validation
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email'));
        die($output);
    }

		$insert_ok = mysql_query($sql) or die(mysql_error());
		while($results = mysql_fetch_array($insert_ok))
			{	
			$id=$results['id'];
			$email=$results['email'];
			$username=$results['username'];
			$affi_id=$results['affi_id'];
			$password=$results['password'];
			}
			
			if($username==""){
				$tracking_id="Please Login to create your tracking_id ";
			}
			else{
				$tracking_id=$affi_id;
			}
 
	
			if(!empty($password))
			{
				 $output = json_encode(array('type'=>'success', 'text' => 'Success!!! Please Check Your Mail For Password.'));
				 $to      = $email; // Send email to our user
				$subject = "CrweWorld Affiliate | Password Reset"; // Give the email a subject 
				$message="<table width=\"675\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"font-family:Arial,Verdana,sans-serif;font-size:11pt\"> <tbody><tr style=\"background-color:#2f88dc;height:100px;vertical-align:middle\"> <td> <a style=\"text-decoration:none\" href=\"#\" target=\"_blank\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/logo.png\" style=\"color:#fff;font-size:25px;padding:10px 0px\" height=\"71\" width=\"309\" border=\"0px\"> </a> </td> <td align=\"right\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/earn.png\" alt=\"EARN\" width=\"82\" height=\"78\" style=\"float:right;margin:3px 10px 0 0\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/link.png\" alt=\"LINK\" width=\"83\" height=\"78\" style=\"float:right;margin:3px 0 0 0\"> </td> </tr> </tbody></table>   </span><table width=\"675\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background-color:#fff;font-family:sans-serif;font-size:11pt;text-align:justify\"> <tbody><tr><td style=\"padding:20px 20px 0 20px;color:#444;line-height:1.5em\"><span class=\"im\"> <p>  
                Dear Affiliate Partner,  
                </p> <p>Greetings from CRWEWORLD Affiliate Team!</p> <p>You have attempted to reset the password for the registered email ID <a href=\"mailto:$email\" target=\"_blank\">$email</a>. </p>
                <p>Please check the tracking id and password for your email account:</p>
                <p> Tracking id: $tracking_id<br>
                  Password: $password</p>
</span><span class=\"im\"><h4><font color=\"red\"><b>Note:</b></font> </h4>
                
                <p style=\"font-size: 10px;\">This email is part of a Closed-Loop Opt-In system and was sent to protect   the privacy of the owner of this email address. Closed-Loop Opt-In confirmation   guarantees that only the owner of an email address can subscribe themselves  to this mailing list.    Furthermore, the following privacy policy is associated with this list: <br>   
                <a href=\"http://www.crweworld.com/terms_conditions\">http://www.crweworld.com/terms_conditions</a> <br> 
                Please read and understand this privacy policy. Other mechanisms may   have been enacted to subscribe email addresses to this list, such as  physical guestbook registrations, verbal agreements, etc.If you did not ask to be subscribed to this particular list, please  do not visit the confirmation URL above. The confirmation for   subscription will not go through and no other action on your part   will be needed.
                </p>
                
                <p>&nbsp;</p> 
                <p>  
                Thanks &amp; Regards,  
                <br>  
                CRWE WORLD Affiliate Team
</p> <br> </span></td> 
                </tr>  <tr style=\"background-color:#2f88dc;vertical-align:middle\"> <td style=\"font-size:11px;font-weight:bold;padding:15px;color:#eee\"> <div style=\"margin-bottom:1em\">&copy; 2016, crweworld.com. All rights reserved.</div> <div>The following physical address is associated with this mailing list: 11226 Pentland Downs St, Las Vegas, NV 89141
                </div> <div>For general inquiries or to request support with your CRWEWORLD Affiliate account: <a href=\"mailto:affiliate@crweworld.com\" target=\"_blank\">affiliate@crweworld.com</a></div> </td> </tr> </tbody></table>";
				
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
				 $output = json_encode(array('type'=>'error', 'text' => 'We couldn\'t find an account using that email address. Try again or create a new account.'));
     			   die($output);
			}

   
}


?>
