<?php
 include('header.php');
 include('sidebar.php');
if($_SESSION['pub_group'] != "opinion")
{
	header('Location:index.php');
}
 
if(isset($_POST['delete_video']))
{
	$delete = $_POST['delete_video']; 
	$sql = "DELETE FROM videos WHERE vid_id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{
		echo "<script>
		alert('Video Deleted Successfully');
		window.location.href='view_videos.php';
		</script>";
	}
}
 
if(isset($_POST['edit_video']))
{  					  
$vid_id=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_id']);
$vid_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_status']);
$vid_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_title']);
$vid_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_description']);
$vid_url=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_url']);
$vid_url = substr($vid_url, strpos($vid_url, "=") + 1);
$vid_len= strlen($vid_url);
$vc_id2=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vc_id2']);
$vid_update=date("Y-m-d") ;


	
	if($vid_title=="")
	{
		echo "<script>alert('Error!!! Title is Empty');</script>";
	}
	elseif($vc_id2=="")
	{
		echo "<script>alert('Error!!! Category is Empty');</script>";
	}
	elseif($vid_url=="")
	{
		echo "<script>alert('Error!!! Video Url is Empty');</script>";
	}
	elseif($vid_len!="11")
	{
		echo "<script>alert('Please Enter Youtube Link');</script>";
	}
	else
	{
		
			
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `vc_id`='$vc_id2' , `vid_title`='$vid_title' , `vid_description`='$vid_description' , `vid_url`='$vid_url' , `vid_update`='$vid_update'  , `vid_status`='publish' where `vid_id`='$vid_id' and user_id='{$_SESSION['pub_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			echo "<script>
			alert('Video Info Updated Successfully');
			window.location.href='edit_video.php?vid_id=$vid_id';
			</script>";	
		}
		else
		{
			echo "<script>
			alert('Error!!!');
			</script>";	
		}		
		
	}
}

 
 ?>
  <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        
      });
    </script>
    

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
            <li class="active">Update Video Info</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Video Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos where vid_id='{$_GET['vid_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$vid_id=$results['vid_id'];
					 	$vid_status=$results['vid_status'];
						$vid_title=$results['vid_title'];
						$vid_description=$results['vid_description'];
						$vid_url=$results['vid_url'];
					 	$vid_doc=$results['vid_doc'];
						$vid_update=$results['vid_update'];
						
						$vc_id=$results['vc_id'];
						$vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$vc_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($vc_result = mysqli_fetch_array($vc_id))
						{
							$vc_name=$vc_result['vc_name'];
						}
						
				?>
                <form role="form" action="" method="post">
                	<input type="hidden" value="<?php echo $vid_id ?>" name="vid_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="vid_title">Title *</label>
                      <input class="form-control" name="vid_title" id="vid_title" required="required" value="<?php echo $vid_title ?>" placeholder="Enter Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="Category">Category *</label>                      
                      <select class="form-control" name="vc_id2">
                      <option value="">-Change Category-</option>
                      	<?php $vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($vc_result = mysqli_fetch_array($vc_id))
						{
							$vc_name2=$vc_result['vc_name'];
							$vc_id2=$vc_result['vc_id'];
						
						?>
                        <option <?php echo "value=\"$vc_id2\""; if($vc_name2==$vc_name){echo "selected";}?>><?php echo $vc_name2 ?></option>
                         <?php }?>
                      </select>
                     </div>
                    <div class="form-group">
                      <label for="Description">Description *</label>
                      <textarea class="ckeditor form-control" rows="10" cols="80" required id="editor1" name="vid_description" ><?php echo $vid_description ?></textarea>
                      
                    </div>
                    <div class="form-group">
                      <label for="vid_url">Source Url (only youtube video links)</label>
                      <input class="form-control" name="vid_url" value="https://www.youtube.com/watch?v=<?php echo $vid_url ?>" placeholder="Enter Source Url" type="text">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="vid_status" value="publish" <?php if($vid_status=="publish"){echo 'checked=""';}?> type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <?php /*?><div class="radio">
                        <label>
                          <input name="vid_status"  value="unpublish" <?php if($vid_status=="unpublish"){echo 'checked=""';}?> type="radio">
                         <span class="label label-danger">Unpublish</span>
                        </label>
                     </div><?php */?>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_video" class="btn btn-primary">Update Video Info</button> 
                    <button type="submit" name="delete_video" value="<?php echo $vid_id ?>" class="btn btn-danger">Delete Video Info</button>
                    <a class="btn btn-info" href="../watch_video.php?vid_id=<?php echo $vid_id ?>" target="_blank">Live View</a>
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
      
