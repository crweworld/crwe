<?php
 include('header.php');
 include('sidebar.php');

if($_SESSION['pub_group'] != "opinion")
{
	header('Location:index.php');
}
 
if(isset($_POST['delete_post']))
{
	$delete = $_POST['delete_post']; 
	$sql = "DELETE FROM posts WHERE user_id={$_SESSION['pub_id']} and post_id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{
		echo "<script>
		alert('Post Info Deleted Successfully');
		window.location.href='opinion.php';
		</script>";
	}
}
 
if(isset($_POST['edit_post']))
{  					  
$post_id=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_id']);
$post_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_status']);
$post_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_title']);
$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_description']);


$cat_id2=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_id2']);


	
	if($post_title=="")
	{
		echo "<script>alert('Error!!! Title is Empty');</script>";
	}
	elseif($cat_id2=="")
	{
		echo "<script>alert('Error!!! Category is Empty');</script>";
	}
	elseif($post_description=="")
	{
		echo "<script>alert('Error!!! Description is Empty');</script>";
	}
	
	
	else
	{
		 
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `cat_id`='$cat_id2' , `post_title`='$post_title' , `post_description`='$post_description' ,  `post_status`='publish' where user_id={$_SESSION['pub_id']} and `post_id`='$post_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			echo "<script>
			alert('Post Updated Successfully');
			window.location.href='edit_opinion.php?post_id=$post_id';
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
                <?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where user_id={$_SESSION['pub_id']} and post_id='{$_GET['post_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$post_id=$results['post_id'];
					 	$post_status=$results['post_status'];
						$post_title=$results['post_title'];
						$post_description=$results['post_description'];
						
						
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
                      	<?php $cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_id in (20,21,22,23,38,44)") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
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
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="post_status" value="publish" <?php if($post_status=="publish"){echo 'checked=""';}?> type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <?php /*?><div class="radio">
                        <label>
                          <input name="post_status"  value="unpublish" <?php if($post_status=="unpublish"){echo 'checked=""';}?> type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div><?php */?>
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
      
