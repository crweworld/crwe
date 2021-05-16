<?php
 include('header.php');
 include('sidebar.php');
if($_SESSION['pub_group'] != "opinion")
{
	header('Location:index.php');
}

if(isset($_POST['add_video']))
{  					  

$vid_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_status']);
$vid_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_title']);
$vid_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_description']);
$vid_url=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_url']);
$vid_url = substr($vid_url, strpos($vid_url, "=") + 1);
$vid_len= strlen($vid_url);
$vc_id2=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vc_id2']);
$vid_doc=date("Y-m-d") ;
	
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
							
		$vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$vc_id2'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($vc_result = mysqli_fetch_array($vc_id))
						{
							$vc_status1=$vc_result['vc_status'];
						}
		
		$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `videos`(`vc_id`,`vc_status`, `vid_title`, `vid_description`, `vid_url`, `vid_doc`, `vid_status`, `user_id`) VALUES ( '$vc_id2','$vc_status1', '$vid_title', '$vid_description', '$vid_url', '$vid_doc', '$vid_status', '{$_SESSION['pub_id']}')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($insert_ok == 1)
		{
			echo "<script>
			alert('Video Created Successfully');
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
            <li class="active">Create Video</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Video</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="" method="post">
                	
                  <div class="box-body">
                    <div class="form-group">
                      <label for="vid_title">Title *</label>
                      <input class="form-control" name="vid_title" id="vid_title" required="required"  placeholder="Enter Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="Category">Category *</label>                      
                      <select class="form-control" required  name="vc_id2">
                      <option value="">-Change Category-</option>
                      	<?php $vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($vc_result = mysqli_fetch_array($vc_id))
						{
							$vc_name2=$vc_result['vc_name'];
							$vc_id2=$vc_result['vc_id'];
						
						?>
                        <option <?php echo "value=\"$vc_id2\""; ?>><?php echo $vc_name2 ?></option>
                         <?php }?>
                      </select>
                     </div>
                    <div class="form-group">
                      <label for="Description">Description *</label>
                      <textarea class="ckeditor form-control" rows="3" cols="80" required id="editor1" name="vid_description" ></textarea>
                     
                    </div>
                 
                    
                    <div class="form-group">
                      <label for="vid_url">Source Url* (Only Youtube Links)</label>
                      <input class="form-control" required="required" name="vid_url"  placeholder="Enter Source Url" type="url">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="vid_status" checked value="publish" type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="vid_status"  value="unpublish"  type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_video" class="btn btn-primary">Create Video</button> 
                    
                  </div>
                </form>
              
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
