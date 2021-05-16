<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['delete_sc']))
{
	$delete = $_POST['delete_sc']; 
	$sql = "DELETE FROM  service_cat WHERE cs_id ='$delete'";
	if (mysql_query($sql))
	{	
		mysql_query("DELETE FROM  videos WHERE cs_id ='$delete'");
		echo "<script>
		alert('Category Deleted Successfully');
		window.location.href='view_sc.php';
		</script>";
	}
}
 
if(isset($_POST['edit_sc']))
{
	$cs_name = mysql_real_escape_string($_POST['cs_name']);
	$cs_update = date("Y-m-d");
	$cs_status = mysql_real_escape_string($_POST['cs_status']);
	$cs_id=mysql_real_escape_string($_POST['cs_id']); 
	
	if($cs_name=="")
	{
		echo "<script>alert('Error!!! Category Name is Empty');</script>";
	}
	elseif($cs_status=="")
	{
		echo "<script>alert('Error!!! Category Status is Empty');</script>";
	}
	else
	{			
		$update_ok = mysql_query("UPDATE `service_cat` SET `cs_name`='$cs_name', `cs_status`='$cs_status', `cs_update`='$cs_update' where `cs_id`='$cs_id'")or die(mysql_error());
		mysql_query("UPDATE `service` SET `cs_status`= '$cs_status' WHERE cs_id=$cs_id");
		
		if($update_ok == 1)
		{
			echo "<script>
			alert('Category Updated Successfully');
			window.location.href='edit_sc.php?cs_id=$cs_id';
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
            <li><a href="#">Service Rate Category</a></li>
            <li class="active">Update Service Rate Category</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Service Rate Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_sc = mysql_query("SELECT * FROM service_cat WHERE cs_id='{$_GET['cs_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_sc))
				{
					$cs_id=$results['cs_id'];
					$cs_name=$results['cs_name'];
					$cs_status=$results['cs_status'];
				?>
                <form role="form" action="" method="post">
                	<input type="hidden" value="<?php echo $cs_id ?>" name="cs_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="InputCategory">Category Name *</label>
                      <input class="form-control" name="cs_name" id="cs_name" required="required" value="<?php echo $cs_name ?>" placeholder="Enter Category Name" type="text">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Category Status</label>
                      <div class="radio">
                        <label>
                          <input name="cs_status" id="optionsRadios1" value="1" <?php if($cs_status=="1"){echo 'checked=""';}?> type="radio">
                          <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="cs_status" id="optionsRadios1" value="0" <?php if($cs_status=="0"){echo 'checked=""';}?> type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_sc" class="btn btn-primary">Update Category</button> 
                    <button type="submit" name="delete_sc" value="<?php echo $cs_id ?>" class="btn btn-danger">Delete Category</button>
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
