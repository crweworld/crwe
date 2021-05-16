<?php
 include('header.php');
 include('sidebar.php');
$in=mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `user` where `group`='investor' and active='1'")) or die(mysqli_error($mysql_link));
$en=mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `user` where `group`='entrepreneur' and active='1'")) or die(mysqli_error($mysql_link));
$act=mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where status='1'")) or die(mysqli_error($mysql_link));
$iact=mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where status='2'")) or die(mysqli_error($mysql_link));

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
           
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $in['count(*)']?></h3>
                  <p>Investors</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $en['count(*)']?></h3>
                  <p>Entrepreneurs</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $act['count(*)']?></h3>
                  <p>Investments Active</p>
                </div>
                <div class="icon">
                  <i class="fa fa-star"></i>
                </div>                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $iact['count(*)']?></h3>
                  <p>Investments waiting for approval</p>
                </div>
                <div class="icon">
                  <i class="fa fa-star-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
            
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
     <?php include('footer.php')?>
