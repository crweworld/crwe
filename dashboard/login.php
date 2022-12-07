<?php
session_start();
$mainserver = 'http://' . str_replace( "dashboard.", "", $_SERVER[ 'HTTP_HOST' ] );
include( '../subs/connect_me.php' );

if ( isset( $_SESSION[ 'pub_id' ] ) ) {
  header( 'Location:/dashboard' );
}

function clear() {
  foreach ( $_SESSION as $key => $val ) {
    if ( ( $key != 'pub_id' )and( $key != 'pub_name' )and( $key != 'pub_doc' )and( $key != 'pub_group' )and( $key != 'pub_email' )and( $key != 'pub_pic' )and( $key != 'pub_username' )and( $key != 'id' )and( $key != 'doc' )and( $key != 'group' ) ) {
      unset( $_SESSION[ $key ] );
    }
  }
}
$err2 = '';

if ( isset( $_POST[ 'login' ] ) ) {
  foreach ( $_POST as $key => $value ) {
    $_SESSION[ $key ] = $$key = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $value );
  }

  $sql = "SELECT * FROM user WHERE password='$password' and (email='$email' or username='$email')";
  $result = mysqli_query( $GLOBALS[ "___mysqli_ston" ], $sql );
  $count = mysqli_num_rows( $result );
  if ( $email == ''
    or $password == '' ) {
    $err1 = "<p class='err'>Please fill all the credentials</p>";
  } elseif ( $count == 1 ) {
    $active = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "select * from user where active='1' and (email='$email' or username='$email')" );
    $row = mysqli_fetch_array( $active );
    $_SESSION[ 'pub_id' ] = $row[ 'id' ];
    $_SESSION[ 'pub_username' ] = $row[ 'username' ];
    $_SESSION[ 'pub_name' ] = $row[ 'fname' ] . " " . $row[ 'lname' ];
    $_SESSION[ 'pub_doc' ] = $row[ 'doc' ];
    $_SESSION[ 'pub_group' ] = $row[ 'group' ];
    $_SESSION[ 'pub_email' ] = $row[ 'email' ];
    $_SESSION[ 'pub_pic' ] = $row[ 'pic' ];

    echo "<script>window.location.href='/dashboard';</script>";
  }
  else {
    $err1 = "<p class='err'>Login Failed! Enter Correct Details or Contact Administrator</p>";
  }
} else if ( isset( $_POST[ 'register' ] ) ) {
  foreach ( $_POST as $key => $value ) {
    $_SESSION[ $key ] = $$key = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $value );
  }
  $hash =(bin2hex(random_bytes(9)));
  $doc = date( "Y-m-d" );

  $sql = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query( $GLOBALS[ "___mysqli_ston" ], $sql );
  $count = mysqli_num_rows( $result );

  if ( isset( $_POST[ 'g-recaptcha-response' ] ) ) {
    $captcha = $_POST[ 'g-recaptcha-response' ];
  }
  if ( $count == 0 ) {
    if ( preg_match( '/\s/', $fname ) or preg_match( '/\s/', $lname ) or strlen($fname)>10 or strlen($lname)>10) {
      $err2 .=  "Oops there was an error, please try again later";
    } else {

      if ( $fname == "" ) {
        $err2 .= "Please enter your Frist Name. <br />";
      }
      if ( $lname == "" ) {
        $err2 .= "Please enter your Last Name. <br />";
      }
      if ( $email == "" ) {
        $err2 .= "Please enter your Email id. <br />";
      } elseif ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        $err2 .= "Please enter a valid email <br />";
      }
      if ( $password == "" ) {
        $err2 .= "Please enter your Password. <br />";
      }
      if ( $cpassword == "" ) {
        $err2 .= "Please enter your Confirm Password. <br />";
      }
      if ( $password != ''
        and $cpassword != '' ) {
        if ( $cpassword != $password ) {
          $err2 .= "Password mismatch. <br />";
        }
      } elseif ( strlen( $password ) <= 5 ) {
          $err2 .= "Password should be greater than 5 characters  <br>";
        }
        //if($subject==""){ $err2 .="Please enter the Subject. <br />";}
      if ( !$captcha ) {
        $err2 .= "Please check the captcha form. <br />";
      }

      if ( $err2 == '' ) {
        $insert_ok = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "INSERT INTO `user`(`fname`, `lname`, `doc`, `active`, `email`, `hash`, `password`,`group`) VALUES ('$fname', '$lname', '$doc','0', '$email', '$hash', '$password','$group')" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
        if ( $insert_ok == 1 ) {
          $subject = "Crwe World | Verification"; // Give the email a subject 
          $message = "<div dir=\"ltr\">************************************************************************************************************<br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><strong>Please verify your email address</strong></div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">Hi, $fname,</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><br />
	  Thanks for signing up for CRWEWORLD. Please take a moment to verify the email address associated with your CRWEWORLD account by clicking the link below:</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><a href=\"$mainserver/verify/$hash\" target=\"_blank\">$mainserver/verify/$hash</a> or <a href=\"$mainserver/verify/$hash\" target=\"_blank\">Click Here</a></div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<pre>This email is part of a Closed-Loop Opt-In system and was sent to protect the privacy of the owner of this email address. Closed-Loop Opt-In confirmation guarantees that only the owner of an email address can subscribe themselves  to this mailing list.Furthermore, the following privacy policy is associated with this list:</pre>
	<div dir=\"ltr\"><a href=\"http://crweworld.com/privacy_policy\" target=\"_blank\">http://crweworld.com/privacy_policy</a></div>
	<pre>Please read and understand this privacy policy. Other mechanisms may have been enacted to subscribe email addresses to this list, such as  physical guestbook registrations, verbal agreements, etc. If you did not ask to be subscribed to this particular list, please do not visit the confirmation URL above. The confirmation for subscription will not go through and no other action on your part will be needed.</pre>
	<div dir=\"ltr\"> </div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">Please do not reply to this email; it was sent from an unmonitored email address. This message is a service email related to your use of CRWEWORLD.<br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">For general inquiries or to request support with your CRWEWORLD account: <a href=\"mailto:contact@crweworld.com\" target=\"_blank\">contact@crweworld.com</a></div>
	<div dir=\"ltr\"><br />
	</div>
	<pre>The following physical address is associated with this mailing list: 11226 Pentland Downs St, Las Vegas, NV 89141<br /><br /><br />************************************************************************************************************</pre>";
          $message = preg_replace( '/Â/', '', $message );
          //phpemailer
          require '/var/www/html/vhosts/phpmail/mail.php';
          $from_name = 'CrweWorld';
          $reply = 'info@crweworld.com';
          $reply_name = 'CrweWorld';
          $to = $email;
          $subject = $subject;
          $message = $message;
          $send_mail = sendphpmail( 'crweworld.com', $from_name, $reply, $reply_name, $to, $subject, $message );

          echo "<script>
				alert('Success!!! Please Check Your Mail For Verification.');
				window.location.href='#';
				</script>";
        }

      }
    }
  } else {
    $err2 .= "Email Id Already Exsist. <br />";
  }

} else if ( isset( $_POST[ 'reset' ] ) ) {
  $email = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $_POST[ 'email' ] );
  $sql = "SELECT * FROM user WHERE email='$email' and active='1'";
  $result = mysqli_query( $GLOBALS[ "___mysqli_ston" ], $sql );
  $count = mysqli_num_rows( $result );
  if ( $count == 1 ) {
    echo "<script>
		alert('Your password has been successfully sent to your email address. Please check it');
		window.location.href='';
		</script>";
    $posts = mysqli_query( $GLOBALS[ "___mysqli_ston" ], $sql )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
    while ( $results = mysqli_fetch_array( $posts ) ) {
      $fname = $results[ 'fname' ];
      $lname = $results[ 'lname' ];
      $email = $results[ 'email' ];
      $password = $results[ 'password' ];
    }


    $subject = "Crwe World | Password reset"; // Give the email a subject 
    $message = "<div dir=\"ltr\">************************************************************************************************************<br />
</div>
<div dir=\"ltr\"><br />
</div>
<div dir=\"ltr\"><br />
</div>
<div dir=\"ltr\">Hi, $fname,</div>
<div dir=\"ltr\"><br />
</div>
<div dir=\"ltr\"><br />
  Thanks for using CRWEWORLD. Please check the credentials for your email account:</div>
<div dir=\"ltr\"><br />
</div>
<strong>Email :</strong> $email <br>
<strong>Password :</strong> $password 
<div dir=\"ltr\"><br />
</div>
<div dir=\"ltr\"><br />
</div>
<pre>This email is part of a Closed-Loop Opt-In system and was sent to protect the privacy of the owner of this email address. Closed-Loop Opt-In confirmation guarantees that only the owner of an email address can subscribe themselves  to this mailing list.Furthermore, the following privacy policy is associated with this list:</pre>
	<div dir=\"ltr\"><a href=\"http://crweworld.com/privacy_policy\" target=\"_blank\">http://crweworld.com/privacy_policy</a></div>
	<pre>Please read and understand this privacy policy. Other mechanisms may have been enacted to subscribe email addresses to this list, such as  physical guestbook registrations, verbal agreements, etc. If you did not ask to be subscribed to this particular list, please do not visit the confirmation URL above. The confirmation for subscription will not go through and no other action on your part will be needed.</pre>
	<div dir=\"ltr\"> </div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">Please do not reply to this email; it was sent from an unmonitored email address. This message is a service email related to your use of CRWEWORLD.<br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">For general inquiries or to request support with your CRWEWORLD account: <a href=\"mailto:contact@crweworld.com\" target=\"_blank\">contact@crweworld.com</a></div>
	<div dir=\"ltr\"><br />
	</div>
	<pre>The following physical address is associated with this mailing list: 11226 Pentland Downs St, Las Vegas, NV 89141<br /><br /><br />************************************************************************************************************</pre>";
    $message = preg_replace( '/Â/', '', $message );
    //phpemailer
    require '/var/www/html/vhosts/phpmail/mail.php';
    $from_name = 'CrweWorld';
    $reply = 'info@crweworld.com';
    $reply_name = 'CrweWorld';
    $to = $email;
    $subject = $subject;
    $message = $message;
    $send_mail = sendphpmail( 'crweworld.com', $from_name, $reply, $reply_name, $to, $subject, $message );
  } else {
    echo "<script>
		alert('We couldn\'t find an active account using that email address. Try again or create a new account.');
		</script>";
  }
} else if ( isset( $_POST[ 'resend' ] ) ) {
  $email = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $_POST[ 'email' ] );
  $sql1 = "SELECT * FROM user WHERE email='$email' and active='0'";
  $result = mysqli_query( $GLOBALS[ "___mysqli_ston" ], $sql1 );
  $count = mysqli_num_rows( $result );
  $sql2 = "SELECT * FROM user WHERE email='$email' and active='1'";
  $result = mysqli_query( $GLOBALS[ "___mysqli_ston" ], $sql2 );
  $count1 = mysqli_num_rows( $result );
  if ( $count == 1 ) {
    echo "<script>
		alert('An activation link is send to your email. Please check your spam folder in case you did not receive it');
		</script>";
    $posts = mysqli_query( $GLOBALS[ "___mysqli_ston" ], $sql1 )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
    while ( $results = mysqli_fetch_array( $posts ) ) {
      $fname = $results[ 'fname' ];
      $lname = $results[ 'lname' ];
      $email = $results[ 'email' ];
      $hash = $results[ 'hash' ];
      $password = $results[ 'password' ];
      $subject1 = $results[ 'subject' ];
    }


    $subject = "Crwe World | Verification"; // Give the email a subject 
    $message = "<div dir=\"ltr\">************************************************************************************************************<br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><strong>Please verify your email address</strong></div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">Hi, $fname,</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><br />
	  Thanks for signing up for CRWEWORLD. Please take a moment to verify the email address associated with your CRWEWORLD account by clicking the link below:</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><a href=\"$mainserver/verify/$hash\" target=\"_blank\">$mainserver/verify/$hash</a> or <a href=\"$mainserver/verify/$hash\" target=\"_blank\">Click Here</a></div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<pre>This email is part of a Closed-Loop Opt-In system and was sent to protect the privacy of the owner of this email address. Closed-Loop Opt-In confirmation guarantees that only the owner of an email address can subscribe themselves  to this mailing list.Furthermore, the following privacy policy is associated with this list:</pre>
	<div dir=\"ltr\"><a href=\"http://crweworld.com/privacy_policy\" target=\"_blank\">http://crweworld.com/privacy_policy</a></div>
	<pre>Please read and understand this privacy policy. Other mechanisms may have been enacted to subscribe email addresses to this list, such as  physical guestbook registrations, verbal agreements, etc. If you did not ask to be subscribed to this particular list, please do not visit the confirmation URL above. The confirmation for subscription will not go through and no other action on your part will be needed.</pre>
	<div dir=\"ltr\"> </div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">Please do not reply to this email; it was sent from an unmonitored email address. This message is a service email related to your use of CRWEWORLD.<br />
	</div>
	<div dir=\"ltr\"><br />
	</div>
	<div dir=\"ltr\">For general inquiries or to request support with your CRWEWORLD account: <a href=\"mailto:contact@crweworld.com\" target=\"_blank\">contact@crweworld.com</a></div>
	<div dir=\"ltr\"><br />
	</div>
	<pre>The following physical address is associated with this mailing list: 11226 Pentland Downs St, Las Vegas, NV 89141<br /><br /><br />************************************************************************************************************</pre>";
    $message = preg_replace( '/Â/', '', $message );
    //phpemailer
    require '/var/www/html/vhosts/phpmail/mail.php';
    $from_name = 'CrweWorld';
    $reply = 'info@crweworld.com';
    $reply_name = 'CrweWorld';
    $to = $email;
    $subject = $subject;
    $message = $message;
    $send_mail = sendphpmail( 'crweworld.com', $from_name, $reply, $reply_name, $to, $subject, $message );

  } elseif ( $count1 == 1 ) {
    echo "<script>
		alert('Your email account is active. Please try to login again');
		</script>";
  }
  else {
    echo "<script>
		alert('We couldn\'t find an active account using that email address. Try again or create a new account.');
		</script>";
  }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Crwe World |  Login</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- //custom-theme -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js --> 
<script src="js/jquery-1.9.1.min.js"></script> 
<!--// js -->
<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
<link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
</head>
<body class="bg agileinfo">
<h1 class="agile_head text-center"> <a href="<?php echo $mainserver?>"><img src='images/logo.png' width="200"></a></h1>
<div class="crwelayouts_main wrap"> 
  <!--Horizontal Tab-->
  <div id="TabLog">
    <ul class="resp-tabs-list hor_1">
      <li id="ss1">LogIn</li>
      <li id="ss2">SignUp</li>
    </ul>
    <div class="resp-tabs-container hor_1">
      <div class="crwe_agile_login">
        <?php if(isset($err1)){echo $err1;} ?>
        <form action="#" method="post" class="agile_form">
          <p>Email</p>
          <input type="text" name="email" required="required" />
          <p>Password</p>
          <input type="password" name="password" required="required" class="password" />
          <?php if(isset($_GET['redirect'])){ echo '<input type="hidden" name="redirect" value="true"/>'; } ?>
          <input type="submit" value="LogIn" name="login" class="agileinfo" />
        </form>
        <div class="login_crwels"> <a class="forgot" href="#forgot">Forgot Password</a><a class="resend" href="#active" style="float: right;"> Resend Activaction Link</a> <br />
        </div>
      </div>
      <script src='https://www.google.com/recaptcha/api.js'></script>
      <div class="agile_its_registration">
        <?php if(!empty($err2)){echo '<p class="err">'.$err2.'</p>';} ?>
        <form action="#" method="post" class="agile_form">
          <p>First Name</p>
          <input type="text" name="fname" value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname'];} ?>" required="required"/>
          <p>Last Name</p>
          <input type="text" name="lname" value="<?php if(isset($_SESSION['lname'])){ echo $_SESSION['lname'];} ?>" required="required"/>
          <p>Email</p>
          <input type="email" name="email"  value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];} ?>" required="required"/>
          <input type="hidden" name="group"  value="affiliate" />
          <?php /*?>
<p>Purpose</p>
<select name="group" required>
  <option value="affiliate">General</option>
  <option value="investment">Investment</option>
</select> <?php */?>
          <p>Password</p>
          <input type="password" name="password" required="required">
          <p>Confirm Password</p>
          <input type="password" name="cpassword" required="required">
          <div class="g-recaptcha" data-sitekey="6Le-zCcTAAAAAM_5Rm1De-l36uJXSkcu9NGpttVl"></div>
          <div class="check crwe_agileits">
            <label class="checkbox crwel">
              <input type="checkbox" name="checkbox" required="required">
              <i> </i>I accept the <a target="_blank" href="<?php echo $mainserver;?>/terms_conditions">terms and conditions *</a></label>
          </div>
          <input type="submit" value="Signup" name="register"/>
          <input type="reset" value="Reset" />
        </form>
      </div>
    </div>
  </div>
  <div class="reset">
    <ul class="resp-tabs-list hor_1">
      <li>Forgot Password</li>
    </ul>
    <div class="resp-tabs-container hor_1">
      <div class="crwe_agile_login">
        <form action="#" method="post" class="agile_form">
          <p>Email</p>
          <input type="email" name="email" required="required" />
          <input type="submit" value="Reset" name="reset" class="agileinfo" />
        </form>
        <div class="login_crwels"> <a class="back" href="#">Back to Login</a> </div>
      </div>
    </div>
  </div>
  <div class="active">
    <ul class="resp-tabs-list hor_1">
      <li>Resend Activaction Link</li>
    </ul>
    <div class="resp-tabs-container hor_1">
      <div class="crwe_agile_login">
        <form action="#" method="post" class="agile_form">
          <p>Email</p>
          <input type="email" name="email" required="required" />
          <input type="submit" value="Resend" name="resend" class="agileinfo" />
        </form>
        <div class="login_crwels"> <a class="back" href="#">Back to Login</a> </div>
      </div>
    </div>
  </div>
  <!-- //Horizontal Tab --> 
</div>
<div class="agileits_crwelayouts_copyright text-center">
  <p>&copy; <?php echo date('Y');?> <a href="http://crweworld.com">crweworld.com</a></p>
</div>
<!--tabs--> 
<script src="js/easyResponsiveTabs.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
	//Horizontal Tab
	$('#TabLog').easyResponsiveTabs({
		type: 'default', //Types: default, vertical, accordion
		width: 'auto', //auto or any width like 600px
		fit: true, // 100% fit in a container
		tabidentify: 'hor_1', // The tab groups identifier
		activate: function(event) { // Callback function if tab is switched
			var $tab = $(this);
			var $info = $('#nested-tabInfo');
			var $name = $('span', $info);
			$name.text($tab.text());
			$info.show();
		}
	});
	
	$(".forgot").click(function(){
		$("#TabLog").hide();
		$(".reset").show();
		$(".active").hide();
	});
	$(".resend").click(function(){
		$("#TabLog").hide();
		$(".reset").hide();
		$(".active").show();
	});
	$(".back").click(function(){
		$("#TabLog").show();
		$(".reset").hide();
		$(".active").hide();
	});
	
	<?php if(!empty($err2)){ ?>
				 $(".agile_its_registration").addClass("resp-tab-content-active");
				 $(".crwe_agile_login").hide();
				 $("#ss2").addClass("resp-tab-active");
				 $("#ss1").removeClass("resp-tab-active");
	<?php } clear(); ?>

});
</script> 

<!--//tabs-->
</body>
</html>