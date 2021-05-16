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
	$cs_name = mysql_real_escape_string($_POST['cs_name']);
	$cs_name =mysql_real_escape_string($cs_name);
	$cs_doc = date("Y-m-d");
	$cs_status = mysql_real_escape_string($_POST['cs_status']);
	
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
		$cs_chk=mysql_query("SELECT * FROM service_cat WHERE cs_name ='$cs_name'");	
		$count=mysql_num_rows($cs_chk);
		if($count==1)
		{	
			echo "<script>
			alert('Category Already Exists. Please Check Again');
			</script>";	
		}
		else{	
		$update_ok = mysql_query("INSERT INTO `service_cat`(`cs_name`, `cs_doc`,`cs_status`) VALUES ('$cs_name', '$cs_doc','$cs_status')")or die(mysql_error());
		if($update_ok == 1)
		{
			echo "<script>
			alert('Service Rate Category Created Successfully');
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
            <li><a href="#">Service Rate</a></li>
            <li class="active">Create Service Rate Category</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Service Rate Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="" method="post"><input type="hidden" name="cs_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="InputCategory">Category Name *</label>
                      <input class="form-control" name="cs_name" id="cs_name" required="required"  placeholder="Enter Category Name" type="text">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Category Status</label>
                      <div class="radio">
                        <label>
                          <input name="cs_status" id="optionsRadios1" value="1" checked type="radio">
                          <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="cs_status" id="optionsRadios1" value="0" type="radio">
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
