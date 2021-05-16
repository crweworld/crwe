<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
 if(isset($_POST['delete_bn']))
{
	$delete = $_POST['delete_bn']; 
	$sql = "DELETE FROM breaking_news WHERE bn_id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{
		echo "<script>
		alert('Breaking News Deleted Successfully');
		window.location.href='view_breaking_news.php';
		</script>";
	}
}
 
if(isset($_POST['edit_bn']))
{
	$bn_title = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bn_title']);
	$bn_update = date("Y-m-d");
	$bn_status = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bn_status']);
	$bn_link = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bn_link']);
	$bn_id = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bn_id']);
	
	if($bn_title=="")
	{
		echo "<script>alert('Error!!! Title is Empty');</script>";
	}
	elseif($bn_status=="")
	{
		echo "<script>alert('Error!!! Status is Empty');</script>";
	}
			
	else
	{			
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `breaking_news` SET `bn_title`='$bn_title', `bn_update`='$bn_update', `bn_status`='$bn_status', `bn_link`='$bn_link' where `bn_id`='$bn_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			echo "<script>
			alert('Breaking News Updated Successfully');
			window.location.href='edit_breaking_news.php?bn_id=$bn_id';
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
            <li><a href="#">News Feed</a></li>
            <li class="active">Update Breaking News</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Breaking News</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_user = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM breaking_news where bn_id='{$_GET['bn_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_user))
				{
					$bn_title=$results['bn_title'];
					$bn_link=$results['bn_link'];
					$bn_status=$results['bn_status'];
					$bn_id=$results['bn_id'];
				?>
                <form role="form" action="" method="post"><input type="hidden" name="bn_id" >
                <input type="hidden" value="<?php echo $bn_id ?>" name="bn_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="InputBnews">Title *</label>
                      <input class="form-control" name="bn_title" id="bn_title" required="required" value="<?php echo $bn_title ?>"  placeholder="Enter News Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputBnews">News Url</label>
                      <input class="form-control" name="bn_link" id="bn_link" value="<?php echo $bn_link ?>" placeholder="Enter New Url" type="text">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Status</label>
                      <div class="radio">
                        <label>
                          <input name="bn_status" id="optionsRadios1" value="publish"  <?php if($bn_status=="publish"){echo 'checked=""';}?> type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="bn_status" id="optionsRadios1" value="unpublish"  <?php if($bn_status=="unpublish"){echo 'checked=""';}?> type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_bn" class="btn btn-primary">Update Breaking News</button> 
                    <button type="submit" name="delete_bn" value="<?php echo $bn_id ?>" class="btn btn-danger">Delete Breaking News</button>
                   
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
