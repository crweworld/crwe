<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Crwe World Admin | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="../affiliate/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../affiliate/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../affiliate/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../affiliate/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />   
    <link href="../affiliate/dist/css/skins/skin-blue-light.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="../affiliate/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link href="../affiliate/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../affiliate/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../affiliate/favicon.ico" type="image/x-icon">

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
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="crown-logo.png" class="user-image" alt="User Image"/>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php if($_SESSION['group']=="superadmin"){ echo"Super Admin";}else{echo"Mini Admin";} ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="crown-logo.png" class="img-circle" alt="User Image" />
                    <p>
                     <?php if($_SESSION['group']=="superadmin"){ echo"Super Admin";}else{echo"Mini Admin";} ?>
                      <small>Member since <?php echo $_SESSION['log_doc']?></small>
                    </p>
                  </li>
                  
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="../index.php" class="btn btn-default btn-flat">Visit Site</a>
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