<?php
include ('connect_me.php');

if(isset($_GET['verify']))
{
	$sql="SELECT * FROM user WHERE hash='{$_GET['verify']}' and active='0' ";
	$result=mysqli_query($mysql_link, $sql);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		$update_ok = mysqli_query($mysql_link, "UPDATE `user` SET `active`='1' where `hash`='{$_GET['verify']}'")or die(mysqli_error($mysql_link));
		if($update_ok == 1)
		{
			$posts = mysqli_query($mysql_link, "SELECT * FROM user WHERE hash='{$_GET['verify']}'") or die(mysqli_error($mysql_link)); 		
			
			while($results = mysqli_fetch_array($posts))
			{	
			$fname=$results['fname'];
			$lname=$results['lname'];
			$email=$results['email'];
			$phone=$results['phone'];
			$subject1=$results['subject'];
			}
			
			$to      = 'info@crweworld.com'; // Send email to our user
			$subject = "CrweWorld Investment| New User | $fname $lname"; // Give the email a subject 
			$message = "
			<b>New User Contacted</b> <br>
			<b>Name: $fname $lname <br>
			<b>Email:</b> $email <br>
			<b>Phone:</b> $phone <br>
			<b>Subject:</b> $subject1 <br>
			";
			//phpemailer
				 require '/var/www/html/vhosts/phpmail/mail.php';
				 $from_name= $fname." ".$lname;
				 $reply = $email;
				 $reply_name = $fname." ".$lname;
				 $to = $to;
				 $subject = $subject;
				 $message = $message;
				 $send_mail = sendphpmail('crweworld.com',$from_name,$reply,$reply_name,$to,$subject,$message);
				 
			echo "<script>
			alert('Your Account is Verified. You can now log in to CRWE World. Thank you very much');
			window.location.href='http://investment.crweworld.com/dashboard/';
			</script>";
		}
	}
	else
	{
		echo "<script>
			alert('Verification Code is Invalid');
			window.location.href='http://investment.crweworld.com';
			</script>";
	}
}
	?>


