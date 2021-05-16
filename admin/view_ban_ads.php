<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
   if (isset($_GET['unpub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 
		 mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `banner_ads` SET `ad_status`= '0' WHERE ad_id IN ('" . implode("','",$value) . "')");	
		
	}	
	echo "<script>alert('Unpublished');</script>";	
	
}
if (isset($_GET['pub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `banner_ads` SET `ad_status`= '1' WHERE ad_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Published');</script>";		
	
}
if (isset($_GET['del_me'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		  $info = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM banner_ads WHERE ad_id IN ('" . implode("','",$value) . "')")or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
		  while($results = mysqli_fetch_array($info))
		  {
		 	 $hash_key=$results['hash_key'];
			$ad_image=$results['ad_image'];
			 
			unlink("../uploads/ads/$hash_key/$ad_image");
			 unlink("../uploads/ads/$hash_key/thumb/$ad_image");
			 
			 rmdir("../uploads/ads/$hash_key/thumb");
			 	$del_fol= (scandir("../uploads/ads"));							
				foreach ( $del_fol as $key => $value )
				{
					if(count(scandir("../uploads/ads/$value")) == 2)
					 {
						rmdir("../uploads/ads/$value");
					 }
				}
		
		  }
	}
		  
	foreach ( $array as $key => $value )
	{					
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `banner_ads` WHERE ad_id IN ('" . implode("','",$value) . "')");
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `ban_loc` WHERE ad_id IN ('" . implode("','",$value) . "')");
	}
		
		
	echo "<script>alert('Deleted');
	</script>";		
	
}
 
 ?>

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
            <li class="active">View Banner Ad</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><span class="active">View Banner Ad</span></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action="" method="get">
                <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
                  <div class="col-xs-4"><button type="submit" name="pub" class="btn btn-block btn-success">Publish</button></div>
                  <div class="col-xs-4"><button type="submit" name="unpub" class="btn btn-block btn-warning">Unpublish</button></div>
                  <div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>
                 </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Title</th>
                        <th>Updated On</th>
                        <th>Expire On</th>
                        <th>Ad Type</th>
                        <th>Status</th>  
                      
                        <th>Ad Stats</th>                      
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$vid_cat = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM banner_ads ORDER BY ad_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($results = mysqli_fetch_array($vid_cat))
					{	
						$ad_id=$results['ad_id'];
					 	$ad_status=$results['ad_status'];
						$ad_type=$results['ad_type'];
						$ad_title=$results['ad_title'];
						
						$ad_doc=$results['ad_doc'];
						$ad_expiry=$results['ad_expiry'];	
						
						if($ad_type=="global_view")
						{ $type="Rectangle Ad (Global View)"; }
						elseif($ad_type=="country_view")
						{ $type="Rectangle Ad (Country View)"; }
						elseif($ad_type=="conti_view")
						{ $type="Rectangle Ad (Continent View)"; }
						elseif($ad_type=="state_view")
						{ $type="Rectangle Ad (State View)"; }
						elseif($ad_type=="local_view")
						{ $type="Rectangle Ad (Local View)"; }
						elseif($ad_type=="big_ad")
						{ $type="Big Rectangle Ad (Home Page)"; }
						elseif($ad_type=="bottom_ad")
						{ $type="Bottom Rectangle Ad (Article Page)"; }
					?>
                      <tr style="text-transform:capitalize;">
                      	<td><input  class="checkbox1" type="checkbox" name="check[]" value="<?php echo $ad_id ?>"  /></td>
                        <td><a href="edit_ban_ads.php?ad_id=<?php echo $ad_id ?>"><?php echo $ad_title ?></a></td>
                        <td><?php echo $ad_doc ?></td>
                        <td><?php echo $ad_expiry ?></td>
                        <td><?php echo $type ?></td>
                        <td><span class="label <?php if($ad_status=="1"){echo "label-success"; $post_status="Active";} else{echo "label-warning"; $post_status="In Active";} ?>"><?php echo $post_status ?></span></td>
                         
                          <td><a href="ad_stats.php?ad_id=<?php echo $ad_id ?>"><i class="fa fa-line-chart"></i></a></td>
                       
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Title</th>
                        <th>Updated On</th>
                        <th>Expire On</th>
                        <th>Ad Type</th>
                        <th>Status</th>  
                        
                        <th>Ad Stats</th>  
                      </tr>
                    </tfoot>
                  </table>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
