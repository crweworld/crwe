<?php
include( 'header.php' );
include( 'sidebar.php' );
if(isset($_POST['edit_user']))
{
	foreach ($_POST as $key => $value)
	{
		$_SESSION[$key]=$$key=mysqli_real_escape_string($mysql_link, $value);
	} 
	
	$query=mysqli_query($mysql_link, "select * from user where id='{$_GET['id']}'");
	$data=mysqli_fetch_array($query);
	$pic=$data['pic'];
	
	$email_sql=mysqli_query($mysql_link, "SELECT * FROM user WHERE email='$email' and id='{$_GET['id']}'");
	$count1=mysqli_num_rows($email_sql);
	
	
	if($count1 == 1)
	{ $email_count=0;}
	else
	{
		$email_sql=mysqli_query($mysql_link, "SELECT * FROM user WHERE email='$email'");
		$email_count=mysqli_num_rows($email_sql);		
	}
	
	
	$err_sin="";
	if($fname==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> First Name is Empty <br>";}
	if($lname==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Last Name is Empty <br>";}
	
	if($phone==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Phone no. is Empty <br>";}
	if($city==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> City is Empty <br>";}
	if($state==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> State is Empty <br>";}
	if($zipcode==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Zipcode is Empty <br>";}
	if($country==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Country is Empty <br>";}	
	
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ $err_sin .="<i class=\"icon fa fa-info\"></i> Invalid email format<br>";} 
	elseif($email_count >= 1){ $err_sin .="<i class=\"icon fa fa-info\"></i> Email id already exist <br>";}							  
	if($password==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Password is empty <br>";}
	elseif( strlen($password) <= 5){ $err_sin .="<i class=\"icon fa fa-info\"></i> Password should be greater than 5 characters  <br>";}
	
	if(isset($_FILES['pic']) and ($_FILES['pic']['size']>0))
	{ 	
		$pic_name=$_FILES['pic']['name'];					
		$file_name = strtolower($_FILES['pic']['name']);
		$file_size =$_FILES['pic']['size'];
		$file_tmp =$_FILES['pic']['tmp_name'];
		$file_type=$_FILES['pic']['type'];	
		$kaboom = explode(".", $file_name); // Split file name into an array using the dot
		$fileExt = end($kaboom);
		
		if($fileExt!="jpg" and $fileExt!="png")
		{
			$err_sin .="<i class=\"icon fa fa-info\"></i> Profile picture format not accepted, Please Upload only .jpg or .png<br>";					
		}
		else if($file_size > 2097152)
		{
			$err_sin .="<i class=\"icon fa fa-info\"></i> Profile picture file size must be less than 2 MB <br>";
		}
	}
	
	
	if($err_sin=="")
	{
		if(isset($_FILES['pic']) and ($_FILES['pic']['size']>0))
		{ 
			$hash=serialize(bin2hex(random_bytes(9)));
			if($pic!=''){del_pic('..'.$pic);}	
			$dirPath = "../assets/user/{$_GET['id']}/";
			if (!file_exists("$dirPath")) 
			{
				mkdir($dirPath, 0755, true);
			}	
			$target_file = $dirPath."$hash.$fileExt";
			$moveResult = move_uploaded_file($file_tmp, $target_file);	
			img_resize($target_file, $target_file, 200, 200, $fileExt,1);	
			$pic= str_replace("..","",$target_file);	
		} 
		
		$update_ok = mysqli_query($mysql_link, "UPDATE `user` SET `fname`='".ucfirst($fname)."',`lname`='".ucfirst($lname)."', `pic`='$pic', `email`='$email', `phone`='$phone', `post_city`='$city',`post_state`='$state',`post_country`='$country',`post_zipcode`='$zipcode',`password`='$password' where `id`='{$_GET['id']}'")or die(mysqli_error($mysql_link));
		if($update_ok == 1)
		{
			$_SESSION['pub_name']=ucfirst($fname)." ".ucfirst($lname);
			$_SESSION['pub_email']=$email;
			$_SESSION['pub_pic']=$pic;
			echo '<script>
					$(document).ready(function(){	
						$("#myModalLabel").html("Profile updated");
								$("#myModal").modal("show");			
								 setTimeout(function(){
									$("#myModal").modal("hide");
								}, 1000);
						});
					</script>';	
		}	
		
	}
}
?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Dashboard<small>Version 1.0</small></h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
					</li>
					<li><a href="#">Users</a>
					</li>
					<li class="active">View Users</li>
				</ol>
			</section>
				<section class="content">
			  <div class="row">
				<div class="col-md-12">
				  <!-- general form elements -->
				  <div class="box box-primary">
					<div class="box-header">
					  <h3 class="box-title">Update Profile</h3>
					</div><!-- /.box-header -->
					 <?php if(!empty($err_sin)){?> 
								<div style="text-align:left" class="alert alert-danger alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									<h4><i class="icon fa fa-ban"></i> Error</h4>
									<?php echo $err_sin ?>
								</div> 
							  <?php } ?>
					<!-- form start -->
					<?php
					$edit_user = mysqli_query($mysql_link, "SELECT * FROM user where id='{$_GET['id']}' limit 1") or die(mysqli_error($mysql_link)); 
					while($results = mysqli_fetch_array($edit_user))
					{					
					?>
					<form role="form" action="" method="post" enctype="multipart/form-data">

					  <div class="box-body">              
						<div class="form-group">
						  <label>First Name :</label> &nbsp; &nbsp;
						   <input class="form-control" name="fname"  required="required" value="<?php echo $results['fname'] ?>" placeholder="Enter Your First Name" type="text">
						</div>
						<div class="form-group">
						  <label>Last Name :</label> &nbsp; &nbsp;
						   <input class="form-control" name="lname"  required="required" value="<?php echo $results['lname'] ?>" placeholder="Enter Your Last Name" type="text">
						</div>
						<div class="form-group">
						  <label >Email address *</label>
						  <input class="form-control" name="email"  required="required" value="<?php echo $results['email'] ?>" placeholder="Enter email" type="email">
						</div>
						<div class="form-group">
						  <label >Phone *</label>
						  <input class="form-control" name="phone"  required="required" value="<?php echo $results['phone'] ?>" placeholder="Enter Phone no." type="text">
						</div>
						<div class="form-group">
						  <label >City *</label>
						  <input class="form-control" name="city"  required="required" value="<?php echo $results['post_city'] ?>" placeholder="Enter City" type="text">
						</div>
						<div class="form-group">
						  <label >State *</label>
						  <input class="form-control" name="state"  required="required" value="<?php echo $results['post_state'] ?>" placeholder="Enter State" type="text">
						</div>
						<div class="form-group">
						  <label >ZipCode *</label>
						  <input class="form-control" name="zipcode"  required="required" value="<?php echo $results['post_zipcode'] ?>" placeholder="Enter Zipcode" type="text">
						</div>
						<div class="form-group">
						  <label >Country *</label>
						  <select name="country" class="form-control" required ><option class="col-md-12" value="">-- Select Location --</option>
						  <?php $con = mysqli_query($mysql_link, "SELECT * FROM sel_countrydata") or die(mysqli_error($mysql_link)); 
							while($cc = mysqli_fetch_array($con))
							{ $sl='';
							  if($results['post_country']==$cc['country']){ $sl='selected';}?>						
							<option <?php echo $sl.' value="'.$cc['country'].'"';?>><?php echo $cc['country'];?></option>
						  <?php	}?>
						  </select>
						</div>
						<div class="form-group">
						  <label>Password *</label>
						  <input class="form-control" name="password" id="exampleInputPassword1" required="required" value="<?php echo $results['password'] ?>" placeholder="Password" type="password">
						</div>



					  </div><!-- /.box-body -->

					  <div class="box-footer">
						<button type="submit" name="edit_user" class="btn btn-primary">Update Info</button> 

					  </div>
					</form>
					<?php } ?>



				  </div><!-- /.box -->
				</div>
			  </div><!-- /.row -->
        </section>
		</div> 
<?php include( 'footer.php' );?>