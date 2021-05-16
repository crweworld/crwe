<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['add_vc']))
{
	$vc_name = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vc_name']);
	$vc_name =strtolower($vc_name);
	$vc_doc = date("Y-m-d");
	$vc_status = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vc_status']);
	
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
		$vc_chk=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat WHERE vc_name ='$vc_name'");	
		echo $count=mysqli_num_rows($vc_chk);
		if($count==1)
		{	
			echo "<script>
			alert('Category Already Exists. Please Check Again');
			</script>";	
		}
		else{	
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `vid_cat`(`vc_name`, `vc_doc`,`vc_status`) VALUES ('$vc_name', '$vc_doc','$vc_status')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			echo "<script>
			alert('Category Created Successfully');
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
            <li class="active">Add Video Category</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add Video Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="" method="post"><input type="hidden" name="vc_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="InputCategory">Category Name *</label>
                      <input class="form-control" name="vc_name" id="vc_name" required="required"  placeholder="Enter Category Name" type="text">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Category Status</label>
                      <div class="radio">
                        <label>
                          <input name="vc_status" id="optionsRadios1" value="publish" checked type="radio">
                          <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="vc_status" id="optionsRadios1" value="unpublish" type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_vc" class="btn btn-primary">Create Category</button> 
                   
                  </div>
                </form>
               
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
