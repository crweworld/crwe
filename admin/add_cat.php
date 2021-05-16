<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}
 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['add_cat']))
{
	$cat_name = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_name']);
	$cat_name =strtolower($cat_name);
	$metakey =mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['metakey']);
	$metadesc =mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['metadesc']);
	$cat_doc = date("Y-m-d");
	$cat_status = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_status']);
	
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
		$cat_chk=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category WHERE cat_name ='$cat_name'");	
		$count=mysqli_num_rows($cat_chk);
		if($count==1)
		{	
			echo "<script>
			alert('Category Already Exists. Please Check Again');
			</script>";	
		}
		else{	
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `category`(`cat_name`, `metakey`, `metadesc`, `cat_doc`,`cat_status`) VALUES ('$cat_name', '$metakey', '$metadesc','$cat_doc','$cat_status')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
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
            <li><a href="#">Category</a></li>
            <li class="active">Create Category</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="" method="post"><input type="hidden" name="cat_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="InputCategory">Category Name *</label>
                      <input class="form-control" name="cat_name" required="required"  placeholder="Enter Category Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputCategory">Category Keywords </label>
                      <textarea class="form-control" name="metakey"  placeholder="Enter Category Keywords"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="InputCategory">Category Description </label>
                      <textarea class="form-control" name="metadesc" placeholder="Enter Category Description"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="InputStatus">Category Status</label>
                      <div class="radio">
                        <label>
                          <input name="cat_status" id="optionsRadios1" value="publish" checked type="radio">
                          <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="cat_status" id="optionsRadios1" value="unpublish" type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_cat" class="btn btn-primary">Create Category</button> 
                   
                  </div>
                </form>
               
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
