<?php
session_start();
include ('../pages/connect_me.php');

if(!empty($_SESSION['id']))
{
	header('Location:index.php');
}

if(isset($_POST['login']))
{
	$username=mysqli_real_escape_string($mysql_link, $_POST['username']); 
	$password=mysqli_real_escape_string($mysql_link, $_POST['password']);
	
	$sql="SELECT * FROM admin WHERE username='$username' and password='$password' and active='1'";
	$result=mysqli_query($mysql_link, $sql);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		$active=mysqli_query($mysql_link, $sql);
		$row =mysqli_fetch_array($active);
		$_SESSION['id']=$row['id'];
		$_SESSION['log_doc']=$row['doc'];
		$_SESSION['group']=$row['group'];
		echo "<script>
		alert('Welcome');
		window.location.href='index.php';
		</script>";
	}
	else
	{
		$err = "<p>Login Failed! Enter Correct Details or Contact Administrator</p>";
	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login form</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<link href="/assets/css/login_style.css" rel="stylesheet" type="text/css" media="all" />
<!--script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
</head>
<body>
<div class="login">
<!--start-loginform-->
		<form name="login-form" class="login-form" action="#" method="post">
			<span class="header-top"><img src="/assets/images/login/topimg.png"/></span>
		    <div class="header">
		    <h1>Admin Login</h1>
		   	
		    </div>
		    <div class="content">
			<input type="text" name="username" class="input username" placeholder="Username" required="">
		    <input type="password" name="password" class="input password" placeholder="Password" required="">
           
		    </div>
		    <div class="login_button">
		    <input type="submit" name="login" value="Login" class="button" />
		    </div>
            <?php if(isset($err)){echo $err;} ?>
		</form>
<!--end login form-->
<!--side-icons-->
    <div class="user-icon"> </div>
    <div class="pass-icon"> </div>
    <!--END side-icons-->
    <!--Side-icons-->
	<script type="text/javascript">
	$(document).ready(function() {
		$(".username").focus(function() {
			$(".user-icon").css("left","-69px");
		});
		$(".username").blur(function() {
			$(".user-icon").css("left","0px");
		});
		
		$(".password").focus(function() {
			$(".pass-icon").css("left","-69px");
		});
		$(".password").blur(function() {
			$(".pass-icon").css("left","0px");
		});
	});
	</script>
	<p class="copy_right">Copyright <?php echo date('Y');?> crweworld.com </p>

</div>
</body>
</html>