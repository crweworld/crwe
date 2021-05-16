<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
 if(isset($_POST['delete_sub']))
{
	$delete = $_POST['delete_sub']; 
	$sql = "DELETE FROM subscribers WHERE sub_id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{
		echo "<script>
		alert('Subscriber Info Deleted Successfully');
		window.location.href='subscribers.php';
		</script>";
	}
}
 
if(isset($_POST['edit_sub']))
{
	$email  = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email']);
	$sub_id = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['sub_id']);
	
	if($email=="")
	{
		echo "<script>alert('Error!!! Email is Empty');</script>";
	}
				
	else
	{			
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `subscribers` SET `email`='$email' where `sub_id`='$sub_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			echo "<script>
			alert('Subscriber Info Updated Successfully');
			window.location.href='edit_subscriber.php?sub_id=$sub_id';
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
            <li><a href="#">Subscribers</a></li>
            <li class="active">Update Subscriber Info</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Subscriber Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_user = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM subscribers where sub_id='{$_GET['sub_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_user))
				{
					$email=$results['email'];					
					$sub_id=$results['sub_id'];
				?>
                <form role="form" action="" method="post"><input type="hidden" name="sub_id" >
                <input type="hidden" value="<?php echo $sub_id ?>" name="sub_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="Inputemail">Subscriber Email *</label>
                      <input class="form-control" name="email" id="email" required="required" value="<?php echo $email ?>"  placeholder="Enter Subscriber Email" type="text">
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_sub" class="btn btn-primary">Update Subscriber Info</button> 
                    <button type="submit" name="delete_sub" value="<?php echo $sub_id ?>" class="btn btn-danger">Delete Subscriber Info</button>
                   
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
