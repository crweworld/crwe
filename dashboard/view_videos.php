<?php
 include('header.php');
 include('sidebar.php');
if($_SESSION['pub_group'] != "opinion")
{
	header('Location:index.php');
}
 
  if (isset($_GET['unpub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	$date = $_GET['date'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `vid_status`= 'unpublish' WHERE vid_id IN ('" . implode("','",$value) . "')");
	}		
	echo "<script>alert('Unpublished');
	window.location.href='?date=$date&find=$date';
	</script>";	
	
}
if (isset($_GET['pub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	$date = $_GET['date'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `vid_status`= 'publish' WHERE vid_id IN ('" . implode("','",$value) . "')");
	}		
	echo "<script>alert('Published');
	window.location.href='?date=$date&find=$date';
	</script>";
	
}
if (isset($_GET['del_me']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	$date = $_GET['date'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `videos` WHERE vid_id IN ('" . implode("','",$value) . "')");
	}		
	echo "<script>alert('Deleted');
	window.location.href='?date=$date&find=$date';
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
            <li><a href="#">Video</a></li>
            <li class="active">View Videos</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Videos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action="#" method="get">       
                <div class="form-group col-xs-4">
                    <label>Date range: <?php if(isset($_GET['date'])){echo $_GET['date'];}?></label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="date" class="form-control col-xs-4 pull-left active" id="reservation">
                    </div><!-- /.input group -->                    
                  </div>
                  <div class=" form-group col-xs-2"  style="margin-top: 23px;"><button type="submit" name="find" class="btn btn-block btn-primary">View Now</button></div>
                  </form>
               <form action="#" method="get">
                   <?php if (isset($_GET['find'])and isset($_GET['date']) and ($_GET['date'])!="" ){ ?>  
                   <div class="form-group col-xs-12">
                <div class="col-xs-8" style="position: absolute; left: 15%; z-index:10">
                  <div class="col-xs-3"><button type="submit" name="pub" class="btn btn-block btn-success">Publish</button></div>
                  <div class="col-xs-3"><button type="submit" name="unpub" class="btn btn-block btn-warning">Unpublish</button></div>
                  <div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>
                  
                  </div></div>
                  <table id="example1" class="table table-bordered table-striped">
                  <input type="text" name="date" style="visibility:hidden" value="<?php $date= $_GET['date']; echo $date?>">
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
					list($date1, $date2) = explode('-', $_GET['date']);
					$date1= str_replace("/","-","$date1");
					$date2= str_replace("/","-","$date2");
					
					$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos where vid_doc BETWEEN CAST('$date1' AS DATE) AND CAST('$date2' AS DATE) ORDER BY vid_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($results = mysqli_fetch_array($posts))
					{	
						$vid_id=$results['vid_id'];
					 	$vid_status=$results['vid_status'];
						$vid_title=$results['vid_title'];
					 	$vid_doc=$results['vid_doc'];
						$vid_update=$results['vid_update'];
						$hot_video=$results['hot_video'];
						$vc_id=$results['vc_id'];
						$vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$vc_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($vc_result = mysqli_fetch_array($vc_id))
						{
							$vc_name=$vc_result['vc_name'];
							$vc_status=$vc_result['vc_status'];
						}
												
										 
					?>
                      <tr style="text-transform:capitalize;">
                      <td><input  class="checkbox1" type="checkbox" name="check[]" value="<?php echo $vid_id ?>"  /></td>
                        <td><?php if($hot_video=="hot_video"){echo "<i class='fa fa-video-camera'></i>";}?> <a href="edit_video.php?vid_id=<?php echo $vid_id ?>"><?php echo $vid_title ?></a></td>
                        <td><span class="label <?php if($vc_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $vc_name ?></span></td>
                        <td><?php echo $vid_doc ?></td>
                        <td><?php echo $vid_update ?></td>
                        <td><span class="label <?php if($vid_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $vid_status ?></span></td>
                        <td><a href="<?php echo $mainserver.$results['post_url'] ?>" target="_blank"><i class="fa fa-external-link"></i></a></td>
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
                   <?php  } ?>
               </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
 
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
