<?php
session_start();

include ('../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
}

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") { 
    $url="https://".$_SERVER['HTTP_HOST'];
} else { 
    $url="http://".$_SERVER['HTTP_HOST'];
}

 include('header.php');
 include('sidebar.php');
 
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
            <li><a href="#">Account</a></li>
            <li class="active">My Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">My Profile</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                <?php
				$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					
				?>
                <form role="form" action="" method="post">                	
                  <div class="box-body">  
                  	<span class="h4 col-md-12"><i class="fa fa-book margin-r-5"></i> <strong>ACCOUNT INFORMATION</strong></span> 
                      
                    <?php if(!empty($results['username'])) { ?>
                     
                    <p class="col-md-12">Please note that your USERNAME is what is displayed in your Affiliate's URL <span class="red-star">*</span></p>
                    <div class="form-group col-md-6">
                    <label>Profile Picture</label>
                      <div class="avatar"><img width="150" src="<?php echo $results['profile_pic']?>" /></div>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Type in your desired USERNAME<span class="red-star">*</span></label> &nbsp; &nbsp;
					 <input class="form-control" name="username"   value="<?php echo ucwords(strtolower($results['username'])); ?>" placeholder="Minimum 4 character required without spaces" type="text" disabled > 
                   
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Your Id Number <span class="red-star">*</span></label> &nbsp; &nbsp;
					 <input class="form-control" value="<?php if($results['active']=='2'){ echo ucwords(strtolower($results['affi_id']));} ?>" type="text" disabled >
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Your Affiliate Link <span class="red-star">*</span></label> &nbsp; &nbsp;
					 <input class="form-control" value="<?php if($results['active']=='2'){ echo $url.'/
'.strtolower($results['username']);} ?>" type="text" disabled >
                    </div> 
                     <div class="form-group col-md-6">
                      <label>(If) Referral Id Number</label> &nbsp; &nbsp;
					 <input class="form-control" name="referral"   value="<?php echo ucwords(strtolower($results['referral'])); ?>" placeholder="Enter the existing affiliate ID, if you were referred to us
" type="text" disabled>
                    </div>  
                                     
                    <div class="form-group col-md-6">
                      <label for="InputEmail1">Email address <span class="red-star">*</span></label>
                      <input class="form-control" name="email"   value="<?php echo $results['email']; ?>" placeholder="Enter email" type="email" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="InputPassword1">Password <span class="red-star">*</span></label>
                      <input class="form-control" name="password"   value="<?php echo $results['password']; ?>" placeholder="Password" type="password" disabled>
                    </div>
                  
                    <div class="form-group col-md-6">
                      <label>First Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="fname"   value="<?php echo $results['fname']; ?>" placeholder="Enter Your First Name" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Last Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="lname"   value="<?php echo $results['lname']; ?>" placeholder="Enter Your Last Name" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Affiliate Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <select class="form-control" name="type" disabled>
                        <option value="">Select</option>
                        <option <?php if($results['type']=='I'){echo 'selected';}?> value="I" >Individual</option>
                        <option <?php if($results['type']=='O'){echo 'selected';}?>value="O">Organisation</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Phone <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="phone"   value="<?php echo $results['phone']; ?>" placeholder="Enter Your Phone no." type="text" disabled>
                    </div>
                  <div class="form-group col-md-6">
                      <label>Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <textarea class="form-control" placeholder="Enter Your Street Address"  name="address" disabled><?php echo $results['address']; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label>City <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_city"   value="<?php echo $results['post_city'];?>" placeholder="Enter Your City" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>State / Province<span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_state"   value="<?php echo $results['post_state'];?>" placeholder="Enter Your State / Provinceate" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'];?>" placeholder="Enter Your Country" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Zip / Postal Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_zipcode"   value="<?php echo $results['post_zipcode']; ?>" placeholder="Enter Your Zip / Postal Code" type="text" disabled>
                    </div>
                   
                  	<span class="h4 col-md-12"><i class="fa fa-sitemap"></i> <strong>AFFILIATE WEBSITE INFORMATION</strong> (Only applies if you plan to use your own personal website for marketing purposes)</span>
                    <div class="form-group col-md-6">
                      <label>Website URL </label> &nbsp; &nbsp;
                       <input class="form-control" name="web_url"   value="<?php echo $results['web_url']; ?>" placeholder="Enter Your URL Address" type="url" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Website Type </label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="web_type" disabled>
                        <option value="">Select</option>
                        <option <?php if($results['web_type']=='C'){echo 'selected';}?> value="C">Coupons / Deals</option>
                        <option <?php if($results['web_type']=='L'){echo 'selected';}?> value="L">Loyalty Program / CashBack</option>
                        <option <?php if($results['web_type']=='B'){echo 'selected';}?> value="B" >Blog</option>
                        <option <?php if($results['web_type']=='P'){echo 'selected';}?> value="P">Price Comparison</option>
                        <option <?php if($results['web_type']=='N'){echo 'selected';}?> value="N">Network</option>
                        <option <?php if($results['web_type']=='O'){echo 'selected';}?> value="O">Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Monthly Visits </label> &nbsp; &nbsp;
                       
                       <select class="form-control"  name="web_visit" disabled>
                        <option value="">Select if known and using your personal website</option>
                        <option <?php if($results['web_visit']=='L'){echo 'selected';}?> value="L" >Less than 1000</option>
                        <option <?php if($results['web_visit']=='M'){echo 'selected';}?> value="M">Between 1000-10000</option>
                        <option <?php if($results['web_visit']=='H'){echo 'selected';}?> value="H">More than 10000</option>
                        </select>
                    </div>
                    
                      <b class="col-md-12">Note: Your affiliate URL uses the affiliate USERNAME you chose upon signup as your unique identifier. This link will allow us to accurately track all of your award affiliate commissions. Your affiliate Id* will allow us to accurately track all of your referrals. <br />
Affiliates cannot change their own USERNAME and/or affiliate Id* but we will be more than happy to change it for you.</b>
                    
                   	<?php } else {?>
                    	<p class="col-md-12">Your profile is incomplete, Please click Edit Profile Info to complete it.</p>
                  	<?php }?>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                   <a href="edit_profile.php" class="btn btn-primary">Edit Profile Info</a> 
                    
                  </div>
                </form>
                <?php } ?>
                
                
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
