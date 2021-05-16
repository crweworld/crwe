<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['delete_vc']))
{
	$delete = $_POST['delete_vc']; 
	$sql = "DELETE FROM  vid_cat WHERE vc_id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{	
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM  videos WHERE vc_id ='$delete'");
		echo "<script>
		alert('Category Deleted Successfully');
		window.location.href='view_vc.php';
		</script>";
	}
}
 
if(isset($_POST['edit_vc']))
{
	$vc_name = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vc_name']);
	$vc_update = date("Y-m-d");
	$vc_status = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vc_status']);
	$vc_id=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vc_id']); 
	
	if($vc_name=="")
	{
		echo "<script>alert('Error!!! Category Name is Empty');</script>";
	}
	elseif($vc_status=="")
	{
		echo "<script>alert('Error!!! Category Status is Empty');</script>";
	}
	else
	{			
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `vid_cat` SET `vc_name`='$vc_name', `vc_status`='$vc_status', `vc_update`='$vc_update' where `vc_id`='$vc_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `vc_status`= '$vc_status' WHERE vc_id=$vc_id");
		
		if($update_ok == 1)
		{
			echo "<script>
			alert('Category Updated Successfully');
			window.location.href='edit_vc.php?vc_id=$vc_id';
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
            <li><a href="#">Video Category</a></li>
            <li class="active">Update Video Category</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Video Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_vc = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat WHERE vc_id='{$_GET['vc_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_vc))
				{
					$vc_id=$results['vc_id'];
					$vc_name=$results['vc_name'];
					$vc_status=$results['vc_status'];
				?>
                <form role="form" action="" method="post">
                	<input type="hidden" value="<?php echo $vc_id ?>" name="vc_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="InputCategory">Category Name *</label>
                      <input class="form-control" name="vc_name" id="vc_name" required="required" value="<?php echo $vc_name ?>" placeholder="Enter Category Name" type="text">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Category Status</label>
                      <div class="radio">
                        <label>
                          <input name="vc_status" id="optionsRadios1" value="publish" <?php if($vc_status=="publish"){echo 'checked=""';}?> type="radio">
                          <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="vc_status" id="optionsRadios1" value="unpublish" <?php if($vc_status=="unpublish"){echo 'checked=""';}?> type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_vc" class="btn btn-primary">Update Category</button> 
                    <button type="submit" name="delete_vc" value="<?php echo $vc_id ?>" class="btn btn-danger">Delete Category</button>
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
