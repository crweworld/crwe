<?php
include('header.php');
 include('sidebar.php');


	 $cx= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM user where post_city is NULL and active='1' and id='{$_SESSION['pub_id']}'"));
	 if($cx['count(*)']=='1'){
		header( "Location: /dashboard/profile?err=true" );
		 exit(); }	 


	$inv= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `user` where `group`='investor' and active='1'"));
	$en= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM investment where status='1'"));

 
 ?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Version 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <!--<li class="active">Here</li>-->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        	<div class="row">
           
           <?php if($_SESSION['pub_group']=='investor'){?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $en['count(*)']?></h3>
                  <p>Proposals Available</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-text-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
             <?php } 
				if($_SESSION['pub_group']=='entrepreneur'){?>
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $inv['count(*)']?></h3>
                  <p>Investors Available</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-text-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
            <?php } ?>
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
     <?php include('footer.php')?>
