<?php
function alert_mail()
	{	
		$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					$fname=ucfirst(mysql_real_escape_string($results['fname']));
					$lname=ucfirst(mysql_real_escape_string($results['lname']));
					$name=$fname." ".$lname;
					$email=mysql_real_escape_string($results['email']);
				}	
						
		
		$subject = "CrweWorld Affiliate | Contact or payment details have been changed"; // Give the email a subject 
		$message="<table width=\"675\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"font-family:Arial,Verdana,sans-serif;font-size:11pt\"> <tbody><tr style=\"background-color:#2f88dc;height:100px;vertical-align:middle\"> <td> <a style=\"text-decoration:none\" href=\"#\" target=\"_blank\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/logo.png\" style=\"color:#fff;font-size:25px;padding:10px 0px\" height=\"71\" width=\"309\" border=\"0px\"> </a> </td> <td align=\"right\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/earn.png\" alt=\"EARN\" width=\"82\" height=\"78\" style=\"float:right;margin:3px 10px 0 0\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/link.png\" alt=\"LINK\" width=\"83\" height=\"78\" style=\"float:right;margin:3px 0 0 0\"> </td> </tr> </tbody></table>   </span><table width=\"675\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background-color:#fff;font-family:sans-serif;font-size:11pt;text-align:justify\"> <tbody><tr>
  <td style=\"padding:20px 20px 0 20px;color:#444;line-height:1.5em\"><span class=\"im\"> 

		<p>Dear $name,</p> 
        <p>We would like to notify you that your contact and/or payment details were recently updated in our system.   Please note, you may receive multiple emails if you update information on more than one tax & payment forms in the process.</p> 
        <p>If you have not authorized this change, please contact your account manager or our support team immediately at <a href=\"mailto:affiliatesupport@crweworld.com\" target=\"_blank\">affiliatesupport@crweworld.com</a>. </p>
                
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
		 $send_mail = sendphpmail('crweworld.com',$from_name,$reply,$reply_name,$to,$subject,$message);	 
		
	}
	?>