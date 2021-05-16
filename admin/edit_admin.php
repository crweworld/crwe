<?php
session_start();

include ('../subs/connect_me.php');
include('../subs/functions.php');
include('../subs/searchloc.php');

if($_SESSION['group']!=("superadmin"))
{
	header('Location:logout.php');
}


 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['delete_user']))
{
	$delete = $_POST['delete_user']; 
	$sql = "DELETE FROM admin WHERE id ='$delete'";
	if (mysqli_query($GLOBALS["___mysqli_ston"], $sql))
	{
		echo "<script>
		alert('Mini Admin Deleted Successfully');
		window.location.href='view_users.php';
		</script>";
	}
}
 
if(isset($_POST['edit_user']))
{
	$fname = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['fname']);
	$lname = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['lname']);
	$subject = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['subject']);
	$phone = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['phone']);
	$email = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email']);
	
	
	$password = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['password']);
	$id=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['id']); 
	$active=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['active']); 
	
	$username_sql="SELECT * FROM admin WHERE email='$email' and id='$id'";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $username_sql);
	$count1=mysqli_num_rows($result);
	if($count1 == 1)
	{
		$count=0;
	}
	else
	{
		$username_sql="SELECT * FROM admin WHERE email='$email'";
		$result=mysqli_query($GLOBALS["___mysqli_ston"], $username_sql);
		$count=mysqli_num_rows($result);
	}
	
	
	/*zippy*/	
		include('../subs/zippy.php');			
						
		/*zippy*/	
	if($count >= 1)
	{
		echo "<script>alert('Email id already exists');</script>";
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
	
	else
	{	
		if(isset($post_state) or isset($post_city))
		{ $sql="UPDATE `admin` SET  `post_zipid`='$post_zipid',`post_city`='$post_city',`post_state`='$post_state',`post_country`='$post_country',`post_zipcode`='$post_zipcode' where `id`='$id'";
		mysqli_query($GLOBALS["___mysqli_ston"], $sql)or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		}

		$sql="UPDATE `admin` SET `fname`='$fname',`lname`='$lname',`subject`='$subject',`phone`='$phone', `password`='$password',`active`='$active',`email`='$email' where `id`='$id'";	
			
			
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], $sql)or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			echo "<script>
			alert('Mini Admin Updated Successfully');
		    window.location.href='edit_admin.php?id=$id';
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
 <style>
 .location{
	 display:none
 }
 </style>
<script type="text/javascript">
$(document).ready(function(){
$(".set_country").click(function() 
{
$(".location").show();
});
});$(document).ready(function(){
$(".unset_country").click(function() 
{
$(".location").hide();
});
});
</script>
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
            <li><a href="#">Mini Admin</a></li>
            <li class="active">Update Mini Admin</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Update Mini Admin</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_user = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM admin where id='{$_GET['id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_user))
				{
					$id=$results['id'];
					$fname=$results['fname'];
					$lname=$results['lname'];
					$subject=$results['subject'];
					$phone=$results['phone'];
					$username=$results['username'];
					$email=$results['email'];
					$password=$results['password'];
					$group=$results['group'];
					$location=ucfirst($results['post_state']).", ".ucfirst($results['post_country']);
					$active=$results['active'];
				?>
                <form role="form" action="" method="post">
                <h1>&nbsp; Basic Information </h1>
                	<input type="hidden" value="<?php echo $id ?>" name="id" >
                  <div class="box-body">
                  <div class="form-group">
                      <label for="InputName">First Name *</label>
                      <input class="form-control" name="fname" required="required" value="<?php echo $fname ?>" placeholder="First Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputName">Last Name *</label>
                      <input class="form-control" name="lname" required="required" value="<?php echo $lname ?>" placeholder="Last Name" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputName">Purpose *</label>
                      <input class="form-control" name="subject" required="required" value="<?php echo $subject ?>" placeholder="Purpose" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputName">Phone *</label>
                      <input class="form-control" name="phone" required="required" value="<?php echo $phone ?>" placeholder="Phone" type="text">
                    </div>
                    <div class="form-group">
                      <label for="InputEmail1">Email address *</label>
                      <input class="form-control" name="email" id="exampleInputEmail1" required="required" value="<?php echo $email ?>" placeholder="Enter email" type="email">
                    </div>
                <h1>&nbsp; Credential Information </h1>    
                    <div class="form-group">
                      <label for="InputName">User Name *</label>
                     <?php echo $username ?>
                    </div>
                    <div class="form-group">
                      <label for="InputPassword1">Password *</label>
                      <input class="form-control" name="password" required="required" value="<?php echo $password ?>" placeholder="Password" type="text">
                    </div>
                   
                  
                <div class="form-group">
                <label for="location">Location *</label> &nbsp;&nbsp;
                <?php if($results['post_country']!=''){?>
                 <input name="location" value="<?php echo $location;?>" id="optionsRadios1" class="unset_country" checked type="radio"><?php echo $location; }?> 
                 
                  <input name="location" class="set_country" id="optionsRadios1"  type="radio"> Set Location
                
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
                          <input name="active" id="optionsRadios1" value="1" <?php if($active=="1"){echo 'checked=""';}?> type="radio">
                          <span class="label label-success">Active</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="active" id="optionsRadios1" value="0" <?php if($active=="0"){echo 'checked=""';}?> type="radio">
                          <span class="label label-danger">Inactive</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_user" class="btn btn-primary">Update Mini Admin Info</button> 
                    <button type="submit" name="delete_user" value="<?php echo $id ?>" class="btn btn-danger">Delete Mini Admin Info</button>
                  </div>
                </form>
                <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
