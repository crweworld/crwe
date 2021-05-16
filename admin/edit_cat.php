<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['delete_cat']))
{
	$delete = $_POST['delete_cat']; 
	$sql = "DELETE FROM  category WHERE cat_id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{	
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM  posts WHERE cat_id ='$delete'");
		echo "<script>
		alert('Category Deleted Successfully');
		window.location.href='view_cat.php';
		</script>";
	}
}
 
if(isset($_POST['edit_cat']))
{
	$cat_name = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_name']);
	$metakey =mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['metakey']);
	$metadesc =mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['metadesc']);
	$cat_update = date("Y-m-d");
	$cat_status = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_status']);
	$cat_id=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_id']); 
	
	if($cat_name=="")
	{
		echo "<script>alert('Error!!! Category Name is Empty');</script>";
	}
	elseif($cat_status=="")
	{
		echo "<script>alert('Error!!! Category Status is Empty');</script>";
	}
	else
	{			
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `category` SET `cat_name`='$cat_name', `metakey`='$metakey',`metadesc`='$metadesc', `cat_status`='$cat_status', `cat_update`='$cat_update' where `cat_id`='$cat_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `cat_status`='$cat_status' where `cat_id`='$cat_id'");
			echo "<script>
			alert('Category Updated Successfully');
			window.location.href='edit_cat.php?cat_id=$cat_id';
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
            <li><a href="#">Category</a></li>
            <li class="active">Update Category</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_cat = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_id='{$_GET['cat_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_cat))
				{
					$cat_id=$results['cat_id'];
					$cat_name=$results['cat_name'];
					$metakey=$results['metakey'];
					$metadesc=$results['metadesc'];
					$cat_status=$results['cat_status'];
				?>
                <form role="form" action="" method="post">
                	<input type="hidden" value="<?php echo $cat_id ?>" name="cat_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="InputCategory">Category Name *</label>
                      <input class="form-control" name="cat_name" required="required" value="<?php echo $cat_name ?>" placeholder="Enter Category Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputCategory">Category Keywords </label>
                      <textarea class="form-control" name="metakey"  placeholder="Enter Category Keywords"><?php echo $metakey ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="InputCategory">Category Description </label>
                      <textarea class="form-control" name="metadesc" placeholder="Enter Category Description"><?php echo $metadesc ?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Category Status</label>
                      <div class="radio">
                        <label>
                          <input name="cat_status" id="optionsRadios1" value="publish" <?php if($cat_status=="publish"){echo 'checked=""';}?> type="radio">
                          <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="cat_status" id="optionsRadios1" value="unpublish" <?php if($cat_status=="unpublish"){echo 'checked=""';}?> type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_cat" class="btn btn-primary">Update Category</button> 
                    <button type="submit" name="delete_cat" value="<?php echo $cat_id ?>" class="btn btn-danger">Delete Category</button>
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
