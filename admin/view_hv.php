<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');

if (isset($_GET['del_me']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `hot_video`= '' WHERE vid_id IN ('" . implode("','",$value) . "')");	
	}		
	echo "<script>alert('Unlinked');</script>";	
	
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
            <li><a href="#">Hot Videos</a></li>
            <li class="active">View Hot Videos</li>
          </ol>
        </section>
<form action="#" method="get">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Hot Videos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
                    <div class="col-xs-4"><button type="submit" name="del_me" style="width: 165px;" class="btn btn-block btn-warning">Unlink from Hot Videos</button></div>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th><input type="checkbox" id="selecctall"/></th>
                      	<th>Title</th>
                        <th>Category</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                        <th>Status</th>   
                        <th>Live View</th>                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
					$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos WHERE hot_video='hot_video' ORDER BY vid_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($results = mysqli_fetch_array($posts))
					{	
						$vid_id=$results['vid_id'];
					 	$vid_status=$results['vid_status'];
						$vid_title=$results['vid_title'];
					 	$vid_doc=$results['vid_doc'];
						$vid_update=$results['vid_update'];
						$vc_id=$results['vc_id'];
						$vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$vc_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($vc_result = mysqli_fetch_array($vc_id))
						{
							$vc_name=$vc_result['vc_name'];
						}
												
										 
					?>
                      <tr style="text-transform:capitalize;">
                      <td><input type="checkbox" class="checkbox1" name="check[]" value="<?php echo $vid_id ?>"  /></td>
                        <td><a href="edit_video.php?vid_id=<?php echo $vid_id ?>"><?php echo $vid_title ?></a></td>
                        <td><?php echo $vc_name ?></td>
                        <td><?php echo $vid_doc ?></td>
                        <td><?php echo $vid_update ?></td>
                        <td><span class="label <?php if($vid_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $vid_status ?></span></td>
                        <td><a href="../watch_video.php?vid_id=<?php echo $vid_id ?>" target="_blank"><i class="fa fa-external-link"></i></a></td>
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	 <th></th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                        <th>Status</th> 
                        <th>Live View</th> 
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        </form>
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
