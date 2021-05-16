<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Crwe World Affiliate | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />   
 
    <link href="dist/css/skins/skin-blue-light.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

  </head>
  <body class="skin-blue-light sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="../assets/images/logo.jpg"></span>
          <!-- logo for regular state and mobile devices -->
          <span style="margin: -4px 0px;" class="logo-lg"><img src="../assets/images/logo.png"></span>
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
                  Welcome <?php echo ucwords($_SESSION['affi_name']);?> <i class="fa fa-chevron-circle-down"></i>

                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                 
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->                 
                  
                  <!-- Menu Footer-->
                  <li class="user-footer"> 
                  <div class="pull-left">
                      <a href="edit_profile.php" class="btn btn-default btn-flat">Edit Account</a>
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