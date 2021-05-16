<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['add_bn']))
{
	$bn_title = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bn_title']);
	$bn_doc = date("Y-m-d");
	$bn_status = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bn_status']);
	$bn_link = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bn_link']);
	
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
		$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `breaking_news`(`bn_title`, `bn_doc`,`bn_status`,`bn_link`) VALUES ('$bn_title', '$bn_doc','$bn_status','$bn_link')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($insert_ok == 1)
		{
			echo "<script>
			alert('Breaking News Created Successfully');
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
            <li class="active">Create Breaking News</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Breaking News</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="" method="post"><input type="hidden" name="bn_id" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="InputBnews">Title *</label>
                      <input class="form-control" name="bn_title" id="bn_title" required="required"  placeholder="Enter News Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputBnews">News Url</label>
                      <input class="form-control" name="bn_link" id="bn_link" placeholder="Enter New Url" type="url">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Status</label>
                      <div class="radio">
                        <label>
                          <input name="bn_status" id="optionsRadios1" value="publish" checked type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="bn_status" id="optionsRadios1" value="unpublish" type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_bn" class="btn btn-primary">Create Breaking News</button> 
                   
                  </div>
                </form>
               
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
