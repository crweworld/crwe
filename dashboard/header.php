<?php
ob_start();
session_start();
include ('../subs/connect_me.php');
include('../rss2/txtcleaner.php');
include('searchloc.php');

if(!isset($_SESSION['pub_id']))
{
	header('Location: /dashboard/login.php');
	exit();
}

function img_resize($target, $newcopy, $w, $h, $ext , $squ) {

	$img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
	list($w_orig, $h_orig) = getimagesize($target); 

if($squ!=1)
{		
	    $ratio = $w_orig / $h_orig;	
		if($w_orig > $w)
		{ $h = $w / $ratio;}
		else { $w = $h * $ratio;  }	
		imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);	
}else
{
	if ($w_orig > $h_orig) {
	  $y = 0;
	  $x = ($w_orig - $h_orig) / 2;
	  $smallestSide = $h_orig;
	} else {
	  $x = 0;
	  $y = ($h_orig - $w_orig) / 2;
	  $smallestSide = $w_orig;
	}
	imagecopyresampled($tci, $img, 0, 0, $x, $y, $w, $h, $smallestSide, $smallestSide);
}
		
    
	
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagejpeg($tci, $newcopy, 100);
	imagedestroy($img);

}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Crwe World Publishers | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />   
    <link href="dist/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

  </head>
  <body class="skin-red sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">C<b style="color:#CC0101">W</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">CRWE<b style="color:#CC0101">WORLD</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
                <li style="padding: 12px 0px;"> 
                <!-- Google Translate-->
                <div id="google_translate_element"></div><script type="text/javascript">
                function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
                }
                </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                <!-- Google Translate-->
                </li>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img onerror="this.src='crown-logo.png'" src="..<?php echo $_SESSION['pub_pic'];?>" class="user-image" alt="User Image"/>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php if(isset($_SESSION['pub_name'])){ echo ucwords($_SESSION['pub_name']);} ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img onerror="this.src='crown-logo.png'" src="..<?php echo $_SESSION['pub_pic'];?>" class="img-circle" alt="User Image" />
                    <p>
                     <?php if(isset($_SESSION['pub_name'])){ echo ucwords($_SESSION['pub_name']); }?>
                      <small>Member since <?php if(isset($_SESSION['pub_doc'])){ echo $_SESSION['pub_doc']; }?></small>
                    </p>
                  </li>
                  
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a target="_blank" href="/index.php" class="btn btn-default btn-flat">Visit Site</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
             </ul>
          </div>
        </nav>
      </header>