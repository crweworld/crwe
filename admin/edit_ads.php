<?php
session_start();

include ('../subs/connect_me.php');


if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');

 
if(isset($_POST['edit_post']))
{  					  
$post_id=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_id']);
$post_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_status']);
$post_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_title']);
$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_description']);
$source_url=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['source_url']);
$post_image_loc=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_image_loc']);
$post_update=date("Y-m-d") ;

	
	if($post_title=="")
	{
		echo "<script>alert('Error!!! Title is Empty');</script>";
	}
	elseif($post_description=="")
	{
		echo "<script>alert('Error!!! Description is Empty');</script>";
	}
	
	
	else
	{
		 
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `ads` SET `post_title`='$post_title' , `post_description`='$post_description' , `source_url`='$source_url' , `post_image_loc`='$post_image_loc' , `post_update`='$post_update'  , `post_status`='$post_status' where `post_id`='$post_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			echo "<script>
			alert('Ad Updated Successfully');
			window.location.href='edit_ads.php?ad_id=$post_id';
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
    <script src="../assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
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
            <li class="active">Edit Side Ad</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Side Ad</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ads where post_id={$_GET['ad_id']}") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$post_id=$results['post_id'];
					 	$post_status=$results['post_status'];
						$post_title=$results['post_title'];
						$post_description=$results['post_description'];
						$source_url=$results['source_url'];
						$post_image_loc=$results['post_image_loc'];
				?>
                <form role="form" action="" method="post">
                	<input type="hidden" value="<?php echo $post_id ?>" name="post_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="post_title">Title *</label>
                      <input class="form-control" name="post_title" id="post_title" required="required" value="<?php echo $post_title ?>" placeholder="Enter Title" type="text">
                    </div>
                   
                    <div class="form-group">
                      <label for="Description">Description *</label>
                      <textarea class="ckeditor form-control" rows="10" cols="80" required="required" id="editor1" name="post_description" ><?php echo $post_description ?></textarea>
                      
                    </div>
                    <div class="form-group">
                      <label for="source_url">Source Url</label>
                      <input class="form-control" name="source_url" value="<?php echo $source_url ?>" placeholder="Enter Source Url" type="text">
                    </div>
                    <div class="form-group">
                      <label for="post_image_loc">Source Image *</label>
                      <input class="form-control" name="post_image_loc"  required="required" value="<?php echo $post_image_loc ?>" placeholder="Enter Source Image" type="text">
                    </div>
                   
                    <div class="form-group">
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="post_status" value="publish" <?php if($post_status=="publish"){echo 'checked';}?> type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="post_status"  value="unpublish" <?php if($post_status=="unpublish"){echo 'checked';}?> type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->
 					
                  <div class="box-footer">
                    <button type="submit" name="edit_post" class="btn btn-primary">Update Ad</button> 
                  </div>
                </form>
                
               <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include('footer.php'); ?>
      
