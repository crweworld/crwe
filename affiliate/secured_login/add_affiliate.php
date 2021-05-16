<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 

if(isset($_POST['add_user']))
{
	$doc=date("Y-m-d");
	$fname=mysql_real_escape_string($_POST['fname']);
	$lname=mysql_real_escape_string($_POST['lname']);
	$phone=mysql_real_escape_string($_POST['phone']);
	$username=mysql_real_escape_string(strtolower($_POST['username']));
	$referral=mysql_real_escape_string(strtolower($_POST['referral']));
	$password=mysql_real_escape_string($_POST['password']);
	$type=mysql_real_escape_string($_POST['type']);
	$email=mysql_real_escape_string($_POST['email']);
	$web_url=mysql_real_escape_string($_POST['web_url']);
	$web_type=mysql_real_escape_string($_POST['web_type']);
	$web_visit=mysql_real_escape_string($_POST['web_visit']);
	$address=mysql_real_escape_string($_POST['address']);
	$post_city=mysql_real_escape_string($_POST['post_city']);
	$post_state=mysql_real_escape_string($_POST['post_state']);
	$post_country=mysql_real_escape_string($_POST['post_country']);
	$post_zipcode=mysql_real_escape_string($_POST['post_zipcode']);
	
	
		$email_sql="SELECT * FROM affi_user WHERE email='$email'";
		$result=mysql_query($email_sql);
		$count=mysql_num_rows($result);
		
		$user_sql="SELECT * FROM affi_user WHERE username='$username'";
		$result=mysql_query($user_sql);
		$user=mysql_num_rows($result);
		
		$ref_sql="SELECT * FROM affi_user WHERE affi_id='$referral'";
		$result=mysql_query($ref_sql);
		$ref1=mysql_num_rows($result);
							
		$lastSpace = strrpos($username," ");
		
	

	$err_sin="";
	if($username==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Username is Empty <br>";} 
	if($lastSpace!=""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Space is not allowed in the Username  <br>";} 
	if( strlen($username) <= 4){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Username should be greater than 4 characters  <br>";}
	if($user != 0){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Username Already Exist <br>";}
	if($ref1 == 0){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Referral Tracking Id is Invalid <br>";} 
	if($email==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Email is Empty <br>";} 
	if($count >= 1){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Email id Already Exist <br>";}
	if($password==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Password is Empty <br>";}
	if( strlen($password) <= 6){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Password should be greater than 6 characters  <br>";}
	if($fname==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! First Name is Empty <br>";}
	if($lname==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Last Name is Empty <br>";}
	if($type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Affiliate Type is Empty <br>";}
	if($phone==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Phone number is Empty <br>";}
	if($address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Address is Empty <br>";}
	if($post_city==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! City is Empty <br>";}
	if($post_state==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! State is Empty <br>";}
	if($post_country==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Country is Empty <br>";}
	if($post_zipcode==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Zipcode is Empty <br>";}
	
	
	$_SESSION['fname']=$_POST['fname'];
	$_SESSION['lname']=$_POST['lname'];
	$_SESSION['phone']=$_POST['phone'];
	$_SESSION['username']=$_POST['username'];
	$_SESSION['referral']=$_POST['referral'];
	$_SESSION['password']=$_POST['password'];
	$_SESSION['type']=$_POST['type'];
	$_SESSION['email']=$_POST['email'];
	$_SESSION['web_url']=$_POST['web_url'];
	$_SESSION['web_type']=$_POST['web_type'];
	$_SESSION['web_visit']=$_POST['web_visit'];
	$_SESSION['address']=$_POST['address'];
	$_SESSION['post_city']=$_POST['post_city'];
	$_SESSION['post_state']=$_POST['post_state'];
	$_SESSION['post_country']=$_POST['post_country'];
	$_SESSION['post_zipcode']=$_POST['post_zipcode'];
	
	if($err_sin=="")
	{	
		
		$sql="INSERT INTO `affi_user`(`fname`, `lname`, `phone`, `username`, `referral`, `password`, `doc`, `active`, `type`, `email`, `web_url`, `web_type`, `web_visit`, `address`, `post_city`, `post_state`, `post_country`, `post_zipcode`) VALUES ('$fname', '$lname', '$phone', '$username', '$referral', '$password', '$doc', '1', '$type', '$email', '$web_url', '$web_type', '$web_visit', '$address', '$post_city', '$post_state', '$post_country', '$post_zipcode')";	
			

			$update_ok = mysql_query($sql)or die(mysql_error());
			if($update_ok == 1)
			{
				$id=mysql_insert_id();
				$affi_id=$id+1000;
				mysql_query("UPDATE `affi_user` SET `affi_id`='$affi_id' where id='$insert_ok'");
				
				echo clear();
			
			$done ="<i class=\"icon fa fa-info\"></i> Profile added successfully. <br>";
				
			}
		

	}
	
}

else
{
	echo clear();
	
}

function clear()
{
	unset($_SESSION['fname']);unset($_SESSION['lname']);unset($_SESSION['phone']);unset($_SESSION['username']);unset($_SESSION['referral']);unset($_SESSION['password']);unset($_SESSION['type']);unset($_SESSION['email']);unset($_SESSION['web_url']);unset($_SESSION['web_type']);unset($_SESSION['web_visit']);unset($_SESSION['address']);unset($_SESSION['post_zipid']);unset($_SESSION['post_city']);unset($_SESSION['post_state']);unset($_SESSION['post_country']);unset($_SESSION['post_zipcode']);
}
 
 ?>
 <style>
 .red-star{
	 color: rgb(240, 0, 0);
 }
 </style>

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
            <li><a href="#">Affiliate</a></li>
            <li class="active">Create Affiliate </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Affiliate </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php if(!empty($err_sin)){ ?>
                 <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <p><?php  echo "$err_sin";?></p>
              </div>
              </div>
              <?php } ?>
              <?php if(!empty($done)){ ?>
                 <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="fa fa-thumbs-o-up"></i> Success!</h4>
                <p><?php  echo "$done";?></p>
              </div>
              </div>
              <?php } ?>
                
                <form role="form" action="" method="post">                	
                  <div class="box-body">  
                  	<span class="h4 col-md-12"><i class="fa fa-book margin-r-5"></i> <strong>ACCOUNT INFORMATION</strong></span> 
                    
                     <div class="form-group col-md-6">
                      <label>Type in your desired USERNAME<span class="red-star">*</span></label> &nbsp; &nbsp;
					 <input class="form-control" name="username"   value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; }?>" placeholder="Minimun 4 character required without space" type="text" required="required">
                    </div>  
                    
                    <div class="form-group col-md-6">
                      <label>(If) Referral Id Number</label> &nbsp; &nbsp;
					 <input class="form-control" name="referral"   value="<?php if(isset($_SESSION['referral'])){ echo $_SESSION['referral']; }?>" placeholder="If you were referred by an existing affiliate, please enter his/her Id Number" type="text">
                    </div> 
                                     
                    <div class="form-group col-md-6">
                      <label for="InputEmail1">Email address <span class="red-star">*</span></label>
                      <input class="form-control" name="email"   value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email']; } ?>" placeholder="Enter email" type="email" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="InputPassword1">Password <span class="red-star">*</span></label>
                      <input class="form-control" name="password"   value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password']; }?>" placeholder="Password" type="text" required="required">
                    </div>
                  
                    <div class="form-group col-md-6">
                      <label>First Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="fname"   value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname']; }?>" placeholder="Enter Your First Name" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Last Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="lname"   value="<?php if(isset($_SESSION['lname'])){ echo $_SESSION['lname']; }?>" placeholder="Enter Your Last Name" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Affiliate Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <select class="form-control" name="type" required="required">
                        <option value="">Select</option>
                        <option value="I" >Individual</option>
                        <option value="O">Organisation</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Phone <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="phone"   value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone']; }?>" placeholder="Enter Your Phone no." type="text" required="required">
                    </div>
                  <div class="form-group col-md-6">
                      <label>Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <textarea class="form-control" name="address" required="required"><?php if(isset($_SESSION['address'])){ echo $_SESSION['address']; }?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label>City <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_city"   value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname']; }?>" placeholder="Enter Your City" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>State <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_state"   value="<?php if(isset($_SESSION['post_state'])){ echo $_SESSION['post_state']; }?>" placeholder="Enter Your State" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php if(isset($_SESSION['post_country'])){ echo $_SESSION['post_country']; }?>" placeholder="Enter Your Country" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Zipcode <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_zipcode"   value="<?php if(isset($_SESSION['post_zipcode'])){ echo $_SESSION['post_zipcode']; } ?>" placeholder="Enter Your Zipcode" type="text" required="required">
                    </div>
                   
                  	<span class="h4 col-md-12"><i class="fa fa-sitemap"></i> <strong>AFFILIATE WEBSITE INFORMATION</strong></span>
                    <div class="form-group col-md-6">
                      <label>Website URL </label> &nbsp; &nbsp;
                       <input class="form-control" name="web_url"   value="<?php if(isset($_SESSION['web_url'])){ echo $_SESSION['web_url']; } ?>" placeholder="Enter Your First Name" type="url">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Website Type </label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="web_type">
                        <option value="">Select</option>
                        <option value="C">Coupons / Deals</option>
                        <option value="L">Loyalty Program / CashBack</option>
                        <option value="B" >Blog</option>
                        <option value="P">Price Comparison</option>
                        <option value="N">Network</option>
                        <option value="O">Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Monthly Visits </label> &nbsp; &nbsp;
                       
                       <select class="form-control"  name="web_visit">
                        <option value="">Select</option>
                        <option value="L" >Less than 1000</option>
                        <option value="M">Between 1000-10000</option>
                        <option value="H">More than 10000</option>
                        </select>
                    </div>
                    
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_user" class="btn btn-primary">Add Info</button> 
                    
                  </div>
                </form>
              
                
                
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
