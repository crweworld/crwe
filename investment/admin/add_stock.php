<?php
session_start();

include ('../subs/connect_me.php');


if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');

 
if(isset($_POST['add_post']))
{  	
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
	elseif($post_image_loc=="")
	{
		echo "<script>alert('Error!!! Source Image is Empty');</script>";
	}
	else
	{
		 
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `stock`(`post_title`, `post_description`, `source_url`, `post_image_loc`, `post_status`) VALUES ('$post_title', '$post_description', '$source_url', '$post_image_loc', '$post_status')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			echo "<script>
			alert('Added Successfully');
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
            <li class="active">Edit Stock Info</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add Stock</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <form role="form" action="" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="post_title">Title *</label>
                      <input class="form-control" name="post_title"  required="required" placeholder="Enter Title" type="text">
                    </div>
                   
                    <div class="form-group">
                      <label for="Description">Description *</label>
                      <textarea class="ckeditor form-control" rows="10" cols="80" required="required" id="editor1" name="post_description" ></textarea>
                      
                    </div>
                    <div class="form-group">
                      <label for="source_url">Source Url</label>
                      <input class="form-control" name="source_url"  placeholder="Enter Source Url" type="text">
                    </div>
                    <div class="form-group">
                      <label for="post_image_loc">Source Image *</label>
                      <input class="form-control" name="post_image_loc"  required="required"  placeholder="Enter Source Image" type="text">
                    </div>
                   
                    <div class="form-group">
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="post_status" value="publish" type="radio" checked="checked"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="post_status"  value="unpublish" type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->
 					
                  <div class="box-footer">
                    <button type="submit" name="add_post" class="btn btn-primary">Add Stock</button> 
                  </div>
                </form>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include('footer.php'); ?>
      
