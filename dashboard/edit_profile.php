<?php
 include('header.php');
if(isset($_GET['err'])){
	$err_sin="Update your profile to continue";
}

if(isset($_POST['edit_user']))
{
	foreach ($_POST as $key => $value)
	{
		$_SESSION[$key]=$$key=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $value);
	} 
	
	$query=mysqli_query($GLOBALS["___mysqli_ston"], "select * from user where id='{$_SESSION['pub_id']}'");
	$data=mysqli_fetch_array($query);
	$pic=$data['pic'];
	
	$email_sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user WHERE email='$email' and id='{$_SESSION['pub_id']}'");
	$count1=mysqli_num_rows($email_sql);
	
	$user_sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user WHERE username='$username' and id='{$_SESSION['pub_id']}'");
	$count2=mysqli_num_rows($user_sql);
	
	if($count1 == 1)
	{ $email_count=0;}
	else
	{
		$email_sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user WHERE email='$email'");
		$email_count=mysqli_num_rows($email_sql);		
	}
	if($count2 == 1)
	{ $user_count=0;}
	else
	{
		$user_sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user WHERE  username='$username'");
		$user_count=mysqli_num_rows($user_sql);		
	}
	$lastSpace = strrpos($username," ");
	
	$err_sin="";
	if($fname==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> First Name is Empty <br>";}
	if($lname==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Last Name is Empty <br>";}
	
	if($phone==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Phone no. is Empty <br>";}
	if($city==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> City is Empty <br>";}
	if($state==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> State is Empty <br>";}
	if($zipcode==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Zipcode is Empty <br>";}
	if($country==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Country is Empty <br>";}
	
	
	if($username==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Username is Empty <br>";} 
	elseif($lastSpace!=""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Space is not allowed in the Username  <br>";} 
	elseif($user_count >= 1){ $err_sin .="<i class=\"icon fa fa-info\"></i> Username already exist <br>";}
	elseif(strlen($username) <= 4 or strlen($username) > 15){ $err_sin .="<i class=\"icon fa fa-info\"></i> Username should be greater than 4 characters and less than 15 characters <br>";}
	elseif(preg_match_all('/[^\.0-9A-Z_]/i',$username)){ $err_sin .="<i class=\"icon fa fa-info\"></i> Username can only contain alphanumeric characters (letters A-Z, numbers 0-9) with the exception of underscores <br>"; }
	
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
			$hash=(bin2hex(random_bytes(9)));
			if($pic!=''){del_pic('..'.$pic);}	
			$dirPath = "../assets/user/{$_SESSION['pub_id']}/";
			if (!file_exists("$dirPath")) 
			{
				mkdir($dirPath, 0755, true);
			}	
			$target_file = $dirPath."$hash.$fileExt";
			$moveResult = move_uploaded_file($file_tmp, $target_file);	
			img_resize($target_file, $target_file, 200, 200, $fileExt,1);	
			$pic= str_replace("..","",$target_file);	
		} 
		
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `fname`='".ucfirst($fname)."',`lname`='".ucfirst($lname)."', `pic`='$pic', `username`='".strtolower($username)."', `email`='$email', `phone`='$phone', `post_city`='$city',`post_state`='$state',`post_country`='$country',`post_zipcode`='$zipcode',`password`='$password' where `id`='{$_SESSION['pub_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($update_ok == 1)
		{
			$_SESSION['pub_name']=ucfirst($fname)." ".ucfirst($lname);
			$_SESSION['pub_username']=$username;
			$_SESSION['pub_email']=$email;
			$_SESSION['pub_pic']=$pic;
			echo '<script>
					$(document).ready(function(){	
						$("#myModalLabel").html("Profile updated");
								$("#myModal").modal("show");			
								 setTimeout(function(){
									$("#myModal").modal("hide");
									window.location.href="edit_profile.php";
								}, 1000);
						});
					</script>';	
		}	
		
	}
}
elseif(isset($_POST['del_pic']))
{
	del_pic($_POST['del_pic']);
				echo '<script>
					$(document).ready(function(){	
						$("#myModalLabel").html("Profile updated");
								$("#myModal").modal("show");			
								 setTimeout(function(){
									$("#myModal").modal("hide");
									window.location.href="edit_profile.php";
								}, 1000);
						});
					</script>';	
}

function del_pic($info)
{	
	unlink($info);	
	mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `pic`='' where id='{$_SESSION['pub_id']}'");
	$_SESSION['pub_pic']='';
}

 include('sidebar.php');
 ?>
      <style>
.hide_file {
    position: absolute;
    z-index: 1000;
    opacity: 0;
    cursor: pointer;
    right: 0;
    top: 0;
    height: 30px;
    width: 135px;
    font-size: 0px;
}
</style>
<script>
$(function() {
$('#file_input_file').change(function () 
	 {			
		var err='';			
		if (this.files.length > 0) 
		{
			$.each(this.files, function (index, value) {
				var validExtensions = ['jpg','gif','png']; 
				var fileName = value.name;
				$("#file_input_text").html(fileName);
				var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1).toLowerCase();
				if(Math.round((value.size / 1024)) > 2048){ 
					err ='Image size should be less than 2mb';
				}					 
				else if ($.inArray(fileNameExt, validExtensions) == -1){
				   err ='Invalid file type, upload only jpg,gif,png';
				}

			});
		}
		if(err!=''){
			alert(err),$("#file_input_text").html(''),$("#file_input_file").val("");
		}
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
            <li><a href="#">Profile</a></li>
            <li class="active">Update Profile</li>
          </ol>
        </section>

        <!-- Main content -->
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
				$edit_user = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where id='{$_SESSION['pub_id']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_user))
				{					
				?>
                <form role="form" action="" method="post" enctype="multipart/form-data">
                
                  <div class="box-body">  
                   <div class="form-group">
						<label class="col-md-2 col-sm-2 col-xs-12 control-label">Profile Picture</label>
						<div class="col-md-10 col-sm-10 col-xs-12">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<img class="img-circle2" onerror="this.src='/assets/images/comment_avatar_3.jpg'" src="..<?php echo $results['pic'] ?>"></div>
							<div class="col-md-6 col-sm-6 col-xs-6">
							   <?php if($results['pic']!=''){ ?>
								<div class="col-md-offset-2 col-md-10 col-xs-12">
									<button class="btn-primary btn-sm backcolor pull-right" style="margin-bottom: 4px;" value="..<?php echo $results['pic'] ?>" name="del_pic">Remove Picture</button>
								</div>
								<?php } ?>
								<div class="col-md-offset-2 col-md-10 col-xs-12">
									<input type="file" name="pic" class="hide_file" id="file_input_file">
									<label class="btn-primary btn-sm backcolor pull-right">Change Picture</label>
									<label id="file_input_text" class="col-md-6 pull-right text-right" style="word-wrap: break-word;"></label>
								</div>
							</div>
						</div>
					</div>               
                    <div class="form-group">
                      <label>First Name :</label> &nbsp; &nbsp;
                       <input class="form-control" name="fname"  required="required" value="<?php echo $results['fname'] ?>" placeholder="Enter Your First Name" type="text">
                    </div>
                    <div class="form-group">
                      <label>Last Name :</label> &nbsp; &nbsp;
                       <input class="form-control" name="lname"  required="required" value="<?php echo $results['lname'] ?>" placeholder="Enter Your Last Name" type="text">
                    </div>
                    <div class="form-group">
                      <label >Username *</label> <?php if($results['username']!=''){ echo "<p>Your Stock page: https://crweworld.com/user/{$results['username']} <br> Your Podcast Page: https://crweworld.com/podcast/{$results['username']}  </p>"; }?>
                      <input class="form-control" name="username"  required="required" value="<?php echo $results['username'] ?>" placeholder="Enter your username" type="text">
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
                      <?php $con = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM countrydata") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cc = mysqli_fetch_array($con))
						{ $sl='';
						  if($results['post_country']==$cc['country']){ $sl='selected';}?>						
                      	<option <?php echo $sl.' value="'.$cc['country'].'"';?>><?php echo $cc['country'];?></option>
                      <?php	}?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Password *</label>
                      <input class="form-control" name="password" id="exampleInputPassword1" required="required" value="<?php echo $results['password'] ?>" placeholder="Password" type="text">
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
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
