<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
	exit();
}


 include('header.php');
 include('sidebar.php');


$vid_cat=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM vid_cat where vc_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$vid_cat=$vid_cat['count(*)'];
$videos=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM videos where vid_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$videos=$videos['count(*)'];
$category=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM category where cat_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$category=$category['count(*)'];

$posts=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where post_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$posts=$posts['count(*)'];

$users=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM admin where active='active' and `group`='editor'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$users=$users['count(*)'];
$subscribers=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM subscribers")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$subscribers=$subscribers['count(*)'];
$breaking_news=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM breaking_news where bn_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$breaking_news=$breaking_news['count(*)'];

/*


$breaking_news="SELECT * FROM breaking_news where bn_status='publish'";
$result=mysql_query($breaking_news);
$breaking_news=mysql_num_rows($result);
*/

 
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
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $subscribers?></h3>
                  <p>Subscribers</p>
                </div>
                <div class="icon">
                  <i class="fa fa-thumbs-up"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $breaking_news?></h3>
                  <p>Breaking News</p>
                </div>
                <div class="icon">
                  <i class="fa fa-newspaper-o"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $users?></h3>
                  <p>Editors</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $posts?></h3>
                  <p>Posts</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-text-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-olive">
                <div class="inner">
                  <h3><?php echo $category?></h3>
                  <p>Post Categories</p>
                </div>
                <div class="icon">
                  <i class="fa fa-files-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $videos?></h3>
                  <p>Videos</p>
                </div>
                <div class="icon">
                  <i class="fa fa-youtube"></i>
                </div>                
              </div>
            </div><!-- ./col -->
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h3><?php echo $vid_cat?></h3>
                  <p>Video Categories</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-video-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
                         <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3><?php echo "900309";?></h3>
                  <p>Locations</p>
                </div>
                <div class="icon">
                  <i class="fa fa-globe"></i>
                </div>                
              </div>
            </div><!-- ./col -->
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
     <?php include('footer.php')?>
