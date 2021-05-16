<?php
session_start();

include ('../subs/connect_me.php');
include('../subs/functions.php');
include('../subs/searchloc.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}


 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['delete_user']))
{
	$delete = $_POST['delete_user']; 
	$sql = "DELETE FROM user WHERE id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{
		echo "<script>
		alert('User Info Deleted Successfully');
		window.location.href='view_users.php';
		</script>";
	}
}
 
if(isset($_POST['add_user']))
{
	$fname = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['fname']);
	$lname = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['lname']);
	$subject = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['subject']);
	$phone = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['phone']);
	$email = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email']);
	
	
	$password = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['password']);
	$group=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['group']); 
	$active=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['active']); 
	$doc = date("Y-m-d");
	
	$username_sql="SELECT * FROM user WHERE email='$email'";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $username_sql);
	$count1=mysqli_num_rows($result);	
	
	
	
	
	/*zippy*/	
	include('../subs/zippy.php');			
						
		/*zippy*/	
	if($count1 >= 1)
	{
		echo "<script>alert('Email already exists');</script>";
	}
	elseif($email=="")
	{
		echo "<script>alert('Error!!! Email is Empty');</script>";
	}
	elseif($fname=="")
	{
		echo "<script>alert('Error!!! First Name is Empty');</script>";
	}
	elseif($lname=="")
	{
		echo "<script>alert('Error!!! Last Name is Empty');</script>";
	}
	elseif($subject=="")
	{
		echo "<script>alert('Error!!! Purpose is Empty');</script>";
	}
	elseif($phone=="")
	{
		echo "<script>alert('Error!!! Phone is Empty');</script>";
	}
	
	elseif($password=="")
	{
		echo "<script>alert('Error!!! Password is Empty');</script>";
	}
	elseif($active=="")
	{
		echo "<script>alert('Error!!! Status is Empty');</script>";
	}
	elseif($group=="")
	{
		echo "<script>alert('Error!!! Group is Empty');</script>";
	}
	
	else
	{	
		

		$sql="INSERT INTO `user`(`fname`, `lname`, `subject`, `phone`, `password`, `doc`, `active`, `group`, `email`, `post_zipid`, `post_city`, `post_state`, `post_country`, `post_zipcode`) VALUES ('$fname','$lname','$subject','$phone','$password','$doc','$active','$group','$email','$post_zipid','$post_city','$post_state','$post_country','$post_zipcode')";	
			
			
		$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], $sql)or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($insert_ok == 1)
		{
			echo "<script>
			alert('User Info Created Successfully');
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
            <li><a href="#">Users</a></li>
            <li class="active">Create User Info</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create User Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="" method="post">
                <h1>&nbsp; Basic Information </h1>
                  <div class="box-body">
                  <div class="form-group">
                      <label for="InputName">First Name *</label>
                      <input class="form-control" name="fname" required="required"  placeholder="First Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputName">Last Name *</label>
                      <input class="form-control" name="lname" required="required"  placeholder="Last Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputName">Purpose *</label>
                      <input class="form-control" name="subject" required="required"  placeholder="Purpose" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputName">Phone *</label>
                      <input class="form-control" name="phone" required="required"  placeholder="Phone" type="text">
                    </div>
                    
                <h1>&nbsp; Credential Information </h1>    
                    <div class="form-group">
                      <label for="InputEmail1">Email address *</label>
                      <input class="form-control" name="email" id="exampleInputEmail1" required="required" placeholder="Enter email" type="email">
                    </div>
                    <div class="form-group">
                      <label for="InputPassword1">Password *</label>
                      <input class="form-control" name="password" required="required"  placeholder="Password" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputPassword1">Group *</label>
                      <select name="group" required  class="form-control" >
                        <option value="">Select Group</option>
                       
						<option value="global">Global</option>
                        <option value="affiliate">Editor</option>
                        <option value="opinion">Opinion</option>
                        <option value="state">State</option>
                        <option value="country">Country</option>
                        
                        </select>
                    </div>
                  
                <div class="form-group">
                <label for="location">Location *</label> 
                
                <table class="location" width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
                <td><label>Country: </label>
                <div class="form-group">
                <select name="country"  class="country form-control">
                <option class="col-md-12" value="">-- Select Location --</option>
                <?php include ('../subs/country_opt.php') ?>
                </select>
                </div></td>
                </tr>
                <tr id="state">
                <td>
                <div class="form-group">
                <label>State</label> 
                <div align="center"><img id="img1" src="<?php echo "http://".$_SERVER['HTTP_HOST']?>/assets/images/load.gif"/>  </div>        
                <select id="display" name="state"  style="width:100%"  class="state form-control" >
                
                </select>
                </div>
                </td>
                </tr>
                <tr id="city">
                <td>
                <div class="form-group">
                <label>City</label>
                <div align="center"><img id="img2" src="<?php echo "http://".$_SERVER['HTTP_HOST']?>/assets/images/load.gif"/></div>
                <select id="display2" name="city"  style="width:100%"  class="search2 form-control" >
                
                </select>
                </div>
                </td>
                </tr>
                </table>
                
                </div>
                    <div class="form-group">
                      <label for="InputStatus">User Status</label>
                      <div class="radio">
                        <label>
                          <input name="active" id="optionsRadios1" value="1"  type="radio">
                          <span class="label label-success">Active</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="active" id="optionsRadios1" value="0" type="radio">
                          <span class="label label-danger">Inactive</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_user" class="btn btn-primary">Create User Info</button> 
                    
                  </div>
                </form>
             
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
