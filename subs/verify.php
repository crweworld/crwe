<?php
include ('connect_me.php');
include('txtcleaner.php');

if(isset($_GET['verify']))
{
	$sql="SELECT * FROM user WHERE hash='{$_GET['verify']}' and active='0' ";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `active`='1' where `hash`='{$_GET['verify']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user WHERE hash='{$_GET['verify']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 		
			
			while($results = mysqli_fetch_array($posts))
			{	
			$fname=$results['fname'];
			$lname=$results['lname'];
			$email=$results['email'];
			$phone=$results['phone'];
			$subject1=$results['subject'];
			}
			
			$to      = 'info@crweworld.com'; // Send email to our user
			$subject = "Crwe World | New User | $fname $lname"; // Give the email a subject 
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
			window.location.href='http://crweworld.com/dashboard/';
			</script>";
		}
	}
	else
	{
		echo "<script>
			alert('Verification Code is Invalid');
			window.location.href='http://{$_SERVER['HTTP_HOST']}';
			</script>";
	}
}
if(isset($_GET['confirmation']))
{
	$sql="SELECT * FROM  subscribers WHERE hash='{$_GET['confirmation']}' and active='0' ";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `subscribers` SET `active`='1' where `hash`='{$_GET['confirmation']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM subscribers WHERE hash='{$_GET['confirmation']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 		
			
			while($results = mysqli_fetch_array($posts))
			{	
			$name=$results['name'];
			$email=$results['email'];
			}
			
			$to      = 'newsletter@crweworld.com'; // Send email to our user
			$subject = "CRWE World | Newsletter"; // Give the email a subject 
					
					$message = "
					<b>You got a new subscriber</b> <br>
					$name
					<b>Subscriber Email: $email <br>
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
					alert('Thanks for subscribing');
					window.location.href='http://{$_SERVER['HTTP_HOST']}';
					</script>";
		}
	}
	else
	{
		echo "<script>
			alert('Verification Code is Invalid');
			window.location.href='http://{$_SERVER['HTTP_HOST']}';
			</script>";
	}
}

if(isset($_GET['chatid']))
{
	$sql="SELECT * FROM record WHERE hash='{$_GET['chatid']}' and status='0' ";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `record` SET `status`='1' where `hash`='{$_GET['chatid']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{	 
			echo "<script>
			alert('Your Account is Verified. You can now log in to CRWE World Chat. Thank you very much');
			window.location.href='http://{$_SERVER['HTTP_HOST']}/chat';
			</script>";
		}
	}
	else
	{
		echo "<script>
			alert('Verification Code is Invalid');
			window.location.href='http://{$_SERVER['HTTP_HOST']}';
			</script>";
	}
}
	?>


