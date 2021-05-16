<?php
session_start();

include ('../subs/connect_me.php');
include('../subs/functions.php');
include('../subs/searchloc.php');


if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 $admin_id = $_SESSION['id'];
 include('header.php');
 include('sidebar.php');

 

 
 ?>
  
    <style>
	.small-box .icon
	{
		top:4px;
	}
	</style>
    
    
   

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
             <li class="active">Ad Manager</li>
            <li class="active">Ad Stats</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Ad Stats</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM pop_ads where ad_id={$_GET['ad_id']}") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$ad_imp = $results['ad_imp'];
						$ad_unq_imp = $results['ad_unq_imp'];
						$ad_clicks = $results['ad_clicks'];
						$ad_unq_clicks =$results['ad_unq_clicks'];
				}
				
				 $query = "SELECT SUM(ad_imp),SUM(ad_unq_imp),SUM(ad_clicks),SUM(ad_unq_clicks) FROM pop_loc where ad_id={$_GET['ad_id']}"; 	 
				 $result = mysqli_query($GLOBALS["___mysqli_ston"], $query) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
				 while($row = mysqli_fetch_array($result)){
					$ad_imp2 =  $row['SUM(ad_imp)'];
					$ad_unq_imp2 = $row['SUM(ad_unq_imp)'];
					$ad_clicks2 =$row['SUM(ad_clicks)'];
					$ad_unq_clicks2 =$row['SUM(ad_unq_clicks)'];
					
				}
				if(!isset($ad_imp2))
				{
					$ad_imp2=0;
					$ad_unq_imp2 = 0;
					$ad_clicks2 =0;
					$ad_unq_clicks2 =0;
				}
				?>
                
                  <div class="box-body">
                   
                  
                    <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $ad_imp+$ad_imp2?></h3>
                  <p>Gross Impressions </p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $ad_unq_imp+$ad_unq_imp2?></h3>
                  <p>Unique Impressions</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $ad_clicks+$ad_clicks2?></h3>
                  <p>Gross Clicks</p>
                </div>
                <div class="icon">
                  <i class="fa fa-star-half-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-orange">
                <div class="inner">
                  <h3><?php echo $ad_unq_clicks+$ad_unq_clicks2?></h3>
                  <p>Unique Clicks</p>
                </div>
                <div class="icon">
                  <i class="fa fa-star"></i>
                </div>                
              </div>
            </div><!-- ./col -->
                    
                   
                    
                    
                    
                  </div><!-- /.box-body -->
                 
 				
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include('footer.php'); ?>
      
