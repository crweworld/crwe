<?php
session_start();

include ('../subs/connect_me.php');

if(isset($_SESSION['group']))
{
	if($_SESSION['group']!=("superadmin" or "miniadmin"))
	{
		header('Location:logout.php');
	}
}

 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['delete_post']))
{
	$delete = $_POST['delete_post']; 
	$sql = "DELETE FROM posts WHERE post_id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{
		echo "<script>
		alert('Post Info Deleted Successfully');
		window.location.href='view_posts.php';
		</script>";
	}
}
 
if(isset($_POST['edit_post']))
{  					  
$post_id=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_id']);
$post_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_status']);
$post_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_title']);
$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_description']);
$source_url=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['source_url']);
$post_image_loc=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_image_loc']);
$cat_id2=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_id2']);


$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where `post_title`='$post_title' and post_id!='{$_POST['post_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
$count=mysqli_fetch_array($sql);
	
	$err_sin="";
	if($post_title==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Title is Empty <br>";} 
	if($cat_id2==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Category is Empty <br>";} 
	if($post_description==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Description is Empty <br>";} 
	if($count['count(*)']!=0){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Post Title already exist <br>";} 

	
	if(empty($err_sin))
	{
$post_description=str_replace("textarea","",$post_description);		 
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `cat_id`='$cat_id2' , `post_title`='$post_title' , `post_description`='$post_description' , `source_url`='$source_url' , `post_image_loc`='$post_image_loc' ,  `post_status`='$post_status' where `post_id`='$post_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			$done="Post Updated Successfully";
			echo "<script>
			window.location.href='edit_post.php?post_id=$post_id';
			</script>";	
		}
		
	}
}

 
 ?>
  <!-- CK Editor -->
   <script src="../assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
      $(function () {     
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
            <li><a href="#">Public News</a></li>
            <li class="active">Update Public News</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Public News</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php if(!empty($err_sin)){ ?>
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        <p><?php  echo "$err_sin";?></p>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($done)){ ?>
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="fa fa-thumbs-o-up"></i> Success!</h4>
                        <p><?php  echo "$done";?></p>
                        </div>
                    </div>
                <?php } ?>
                <?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where post_id='{$_GET['post_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$post_id=$results['post_id'];
					 	$post_status=$results['post_status'];
						$post_title=$results['post_title'];
						$post_description=$results['post_description'];
						$source_url=$results['source_url'];
						$post_image_loc=$results['post_image_loc'];
					 	$post_doc=$results['post_doc'];
						$post_update=$results['post_update'];
						$cat_id=$results['cat_id'];
						$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
							$cat_name=$cat_result['cat_name'];
						}
						
				?>
                <form role="form" action="" method="post">
                	<input type="hidden" value="<?php echo $post_id ?>" name="post_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="post_title">Title *</label>
                      <input class="form-control" name="post_title" id="post_title" required="required" value="<?php echo $post_title ?>" placeholder="Enter Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="Category">Category *</label>                      
                      <select class="form-control" name="cat_id2">
                      <option value="">-Change Category-</option>
                      	<?php $cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
							$cat_name2=$cat_result['cat_name'];
							$cat_id2=$cat_result['cat_id'];
						
						?>
                        <option <?php echo "value=\"$cat_id2\""; if($cat_name2==$cat_name){echo "selected";}?>><?php echo $cat_name2 ?></option>
                         <?php }?>
                      </select>
                     </div>
                    <div class="form-group">
                      <label for="Description">Description *</label>
                      <textarea class="ckeditor form-control" rows="10" cols="80" required id="editor1" name="post_description" ><?php echo $post_description ?></textarea>
                      
                    </div>
                    <div class="form-group">
                      <label for="source_url">Source Url</label>
                      <input class="form-control" name="source_url" value="<?php echo $source_url ?>" placeholder="Enter Source Url" type="text">
                    </div>
                    <div class="form-group">
                      <label for="post_image_loc">Source Image</label>
                      <input class="form-control" name="post_image_loc"  value="<?php echo $post_image_loc ?>" placeholder="Enter Source Image" type="text">
                    </div>
                   
                    <div class="form-group">
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="post_status" value="publish" <?php if($post_status=="publish"){echo 'checked=""';}?> type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="post_status"  value="unpublish" <?php if($post_status=="unpublish"){echo 'checked=""';}?> type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_post" class="btn btn-primary">Update Post Info</button> 
                    <button type="submit" name="delete_post" value="<?php echo $post_id ?>" class="btn btn-danger">Delete Post Info</button>
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include('footer.php'); ?>
      
