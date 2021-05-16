<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');

if( !isset($_GET['affiliate_id']) and isset($_GET['tracking_id']))
{
	$edit_user = mysql_query("SELECT * FROM affi_user where affi_id='{$_GET['tracking_id']}'") or die(mysql_error()); 
	$results = mysql_fetch_array($edit_user);
	$_GET['affiliate_id']=$results['id'];
}

 $edit_user = mysql_query("SELECT * FROM affi_user where id='{$_GET['affiliate_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					$chk_loc=mysql_real_escape_string($results['post_country']);
				}
$cdata = mysql_query("SELECT * FROM countrydata where country='$chk_loc'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{ $cur_info= $rts['currency'];
						 $cur_info2= $rts['currency2'];
						 $wire_type= $rts['wire_type'];
						 $local_type= $rts['local_type'];
                        }

if(isset($_POST['edit_user']))
{
	
	$fname=mysql_real_escape_string($_POST['fname']);
	$lname=mysql_real_escape_string($_POST['lname']);
	$oname=mysql_real_escape_string($_POST['oname']);
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
	
	$email_sql="SELECT * FROM affi_user WHERE email='$email' and id='{$_GET['affiliate_id']}'";
	$result=mysql_query($email_sql);
	$count1=mysql_num_rows($result);
	
	if($count1 == 1)
	{
		$count=0;
	}
	else
	{
		$email_sql="SELECT * FROM affi_user WHERE email='$email'";
		$result=mysql_query($email_sql);
		$count=mysql_num_rows($result);
		
	}
	
	
	$user_sql="SELECT * FROM affi_user WHERE username='$username' and id='{$_GET['affiliate_id']}'";
	$result=mysql_query($user_sql);
	$user1=mysql_num_rows($result);
	
	if($user1 == 1)
	{
		$user=0;
	}
	else
	{
		$user_sql="SELECT * FROM affi_user WHERE username='$username'";
		$result=mysql_query($user_sql);
		$user=mysql_num_rows($result);
		
	}
	
	$ref_sql="SELECT * FROM affi_user WHERE affi_id='$referral' and active='2'";
	$result=mysql_query($ref_sql);
	$ref1=mysql_num_rows($result);
	
	if($referral=='')
	{
		$ref1='1';
	}
	
	$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_GET['affiliate_id']}'") or die(mysql_error()); 
	while($results = mysql_fetch_array($edit_user))
	{
		$referral1=$results['affi_id'];
	}
				
	
	if($referral1==$referral) { $ref_chk=1; } else { $ref_chk=0; }
	
	$lastSpace = strrpos($username," ");
	
	
	
	$err_sin="";
	if($username==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Username is Empty <br>";} 
	if($lastSpace!=""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Space is not allowed in the Username  <br>";} 
	if( strlen($username) <= 4){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Username should be greater than 4 characters  <br>";}
	if($user >= 1){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Username Already Exist <br>";}
	if($ref_chk!=0){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Your Referral Id is Referred By You<br>";} 
	if($ref1 == 0){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Referral Tracking Id is Invalid <br>";} 
	if($email==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Email is Empty <br>";} 
	if($count >= 1){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Email id Already Exist <br>";}
	if($password==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Password is Empty <br>";}
	if( strlen($password) <= 6){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Password should be greater than 6 characters  <br>";}
	if($fname==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! First Name is Empty <br>";}
	if($lname==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Last Name is Empty <br>";}
	if($type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Affiliate Type is Empty <br>";}
	if($type=="O" and $oname==''){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Organization Name is Empty <br>";}
	if($phone==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Phone number is Empty <br>";}
	if($address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Address is Empty <br>";}
	if($post_city==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! City is Empty <br>";}
	if($post_state==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! State is Empty <br>";}
	if($post_country==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Country is Empty <br>";}
	if($post_zipcode==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Zipcode is Empty <br>";}
	
	
	$_SESSION['fname']=$_POST['fname'];
	$_SESSION['lname']=$_POST['lname'];
	$_SESSION['oname']=$_POST['oname'];
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
		$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_GET['affiliate_id']}'") or die(mysql_error()); 
				$results = mysql_fetch_array($edit_user);
				if(!empty($results['username']))
				{
					$disabled='1';
				}
				else
				{
					$disabled='0';
				}
				
				if(!empty($results['post_country']))
				{
					if($post_country!=$results['post_country'])
					{
						mysql_query("UPDATE `affi_user` SET `account_name`='', `ifsc_code`='', `swift_code`='', `bank_name`='', `bank_address`='', `bank_branch`='', `bank_code`='', `branch_code`='', `account_no`='', `account_type`='', `paypal_email`='', `insti_no`='', `routing_no`='', `clabe`='', `currency_type`='', `payment_method`='' where `id`='{$_SESSION['affi_id']}'")or die(mysql_error());
						
						$add_info='<br> <p>Note: Changing payment country will erase banking information you entered for accounts in the existing country. Please enter updated payment details after changing the country. </p>';
					}
				}
	
	if($disabled=='1')
		{
			$sql="UPDATE `affi_user` SET `fname`='$fname',`lname`='$lname',`oname`='$oname',`phone`='$phone',`referral`='$referral',`password`='$password',`type`='$type',`email`='$email',`web_url`='$web_url',`web_type`='$web_type',`web_visit`='$web_visit',`address`='$address',`post_city`='$post_city',`post_state`='$post_state',`post_country`='$post_country',`post_zipcode`='$post_zipcode' where `id`='{$_GET['affiliate_id']}'";	
		}
		else
		{
			$sql="UPDATE `affi_user` SET `fname`='$fname',`lname`='$lname',`oname`='$oname',`phone`='$phone',`username`='$username',`referral`='$referral',`password`='$password',`type`='$type',`email`='$email',`web_url`='$web_url',`web_type`='$web_type',`web_visit`='$web_visit',`address`='$address',`post_city`='$post_city',`post_state`='$post_state',`post_country`='$post_country',`post_zipcode`='$post_zipcode' where `id`='{$_GET['affiliate_id']}'";	
		}
		

			$update_ok = mysql_query($sql)or die(mysql_error());
			if($update_ok == 1)
			{						
				echo clear();
			
			$done ="<i class=\"icon fa fa-info\"></i> Profile updated successfully. <br>";
				
			}
		
	}
	
}

else
{
	echo clear();
	
}

function clear()
{
	unset($_SESSION['fname']);unset($_SESSION['lname']);unset($_SESSION['oname']);unset($_SESSION['phone']);unset($_SESSION['username']);unset($_SESSION['referral']);unset($_SESSION['password']);unset($_SESSION['type']);unset($_SESSION['email']);unset($_SESSION['web_url']);unset($_SESSION['web_type']);unset($_SESSION['web_visit']);unset($_SESSION['address']);unset($_SESSION['post_zipid']);unset($_SESSION['post_city']);unset($_SESSION['post_state']);unset($_SESSION['post_country']);unset($_SESSION['post_zipcode']);
}

 
 ?>
 <style>
 .red-star{
	 color: rgb(240, 0, 0);
 }
 </style>
 <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
 <script type='text/javascript'>//<![CDATA[

$(document).ready(function(){
    $('#organization').on('change', function() {
      if ( this.value == 'O')
      {
        $("#oname").show();
      }
      else
      {
        $("#oname").hide();
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
            <li><a href="#">Affiliate</a></li>
            <li class="active">Edit Affiliate </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Affiliate </h3>
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
                <?php
				$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_GET['affiliate_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					if(!empty($results['username']))
					{
						$disabled='disabled';
					}
					else
					{
						$disabled='';
					}
					
					
				?>
                <form role="form" action="" method="post">                	
                  <div class="box-body">  
                  	<span class="h4 col-md-12"><i class="fa fa-book margin-r-5"></i> <strong>ACCOUNT INFORMATION</strong></span> 
                    
                    
                    <?php if($results['profile_pic']!=''){ ?><div class="form-group col-md-6">
                    <label>Profile Picture</label>
                      <div class="avatar"><img width="150" src="<?php echo $results['profile_pic']?>" /></div>
                    </div>
                     <?php } ?>
                    
                     <div class="form-group col-md-6">
                      <label>Type in your desired USERNAME<span class="red-star">*</span></label> &nbsp; &nbsp;
					 <input class="form-control" name="username"   value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; } else{ echo ucwords(strtolower($results['username'])); }?>" placeholder="Minimum 4 character required without spaces" type="text" required="required" <?php echo $disabled; ?>  > 
                     <?php if($disabled=='disabled'){ ?>
                     <input type="hidden" name="username" value="<?php echo ucwords(strtolower($results['username']));?>"  />
					  <?php } ?>
                    </div>   
                    
                     <div class="form-group col-md-6">
                      <label>Your Id Number<span class="red-star">*</span></label> &nbsp; &nbsp;
					 <input class="form-control" value="<?php  if($results['active']=='2'){echo ucwords(strtolower($results['affi_id']));} ?>" type="text" disabled > 
                   
                    </div> 
                    <div class="form-group col-md-6">
                      <label>(If) Referral Id Number</label> &nbsp; &nbsp;
					 <input class="form-control" name="referral"   value="<?php if(isset($_SESSION['referral'])){ echo $_SESSION['referral']; } else{ echo ucwords(strtolower($results['referral'])); }?>" placeholder="Enter the existing affiliate ID, if you were referred to us
" type="text">
                    </div> 
                                     
                    <div class="form-group col-md-6">
                      <label for="InputEmail1">Email address <span class="red-star">*</span></label>
                      <input class="form-control" name="email"   value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email']; } else{ echo $results['email'];} ?>" placeholder="Enter email" type="email" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="InputPassword1">Password <span class="red-star">*</span></label>
                      <input class="form-control" name="password"   value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password']; } else{ echo $results['password'];} ?>" placeholder="Password" type="text" required="required">
                    </div>
                  
                    <div class="form-group col-md-6">
                      <label>First Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="fname"   value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname']; } else{ echo $results['fname'];} ?>" placeholder="Enter Your First Name" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Last Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="lname"   value="<?php if(isset($_SESSION['lname'])){ echo $_SESSION['lname']; } else{ echo $results['lname'];} ?>" placeholder="Enter Your Last Name" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Affiliate Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <select id="organization" class="form-control" name="type" required="required">
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['type'])){ if($_SESSION['type']=='I'){echo 'selected';}} else if($results['type']=='I'){echo 'selected';}?> value="I" >Individual</option>
                        <option <?php if(isset($_SESSION['type'])){ if($_SESSION['type']=='O'){echo 'selected';}} else if($results['type']=='O'){echo 'selected';}?> value="O">Organization</option>
                        </select>
                    </div>
                     <div <?php if(isset($_SESSION['type'])){if($_SESSION['type']!='O' ){ echo 'style="display:none"'; }} elseif($results['type']!='O' ){ echo 'style="display:none"'; }?> id="oname" class="form-group col-md-6">
                      <label>Organization Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="oname"   value="<?php if(isset($_SESSION['oname'])){ echo $_SESSION['oname']; } else{ echo $results['oname'];} ?>" placeholder="Enter Your Organization Name" type="text">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Phone <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="phone"   value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone']; } else{ echo $results['phone'];} ?>" placeholder="Enter Your Phone no." type="text" required="required">
                    </div>
                  <div class="form-group col-md-6">
                      <label>Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <textarea class="form-control" name="address" placeholder="Enter Your Street Address" required="required"><?php if(isset($_SESSION['address'])){ echo $_SESSION['address']; } else{ echo $results['address'];} ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label>City <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_city"   value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname']; } else{ echo $results['post_city'];} ?>" placeholder="Enter Your City" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>State / Province<span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_state"   value="<?php if(isset($_SESSION['post_state'])){ echo $_SESSION['post_state']; } else{ echo $results['post_state']; }?>" placeholder="Enter Your State / Province" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php if(isset($_SESSION['post_country'])){ echo $_SESSION['post_country']; } else{ echo $results['post_country'];} ?>" placeholder="Enter Your Country" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Zip / Postal Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="post_zipcode"   value="<?php if(isset($_SESSION['post_zipcode'])){ echo $_SESSION['post_zipcode']; } else{ echo $results['post_zipcode'];} ?>" placeholder="Enter Your Zip / Postal Code" type="text" required="required">
                    </div>
                   
                   <?php if($results['ecard']!=''){?>
                   <span class="h4 col-md-12"><i class="fa fa-credit-card"></i> <strong>BUSINESS CARD</strong></span>
                              <p class="col-md-12"><img width="600" src="<?php echo $results['ecard'] ?>"></p>
                              <div class="col-md-12"><a href="<?php echo $results['ecard'] ?>" class="btn btn-success" download>Download Ecard</a></div>
                              <?php }?>
                   
                   
                  	<span class="h4 col-md-12"><i class="fa fa-sitemap"></i> <strong>AFFILIATE WEBSITE INFORMATION</strong> (Only applies if you plan to use your own personal website for marketing purposes)</span>
                    <div class="form-group col-md-6">
                      <label>Website URL </label> &nbsp; &nbsp;
                       <input class="form-control" name="web_url"   value="<?php if(isset($_SESSION['web_url'])){ echo $_SESSION['web_url']; } else{ echo $results['web_url'];} ?>" placeholder="Enter Your URL Address" type="url">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Website Type </label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="web_type">
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
                       
                       <select class="form-control"  name="web_visit">
                        <option value="">Select if known and using your personal website</option>
                        <option <?php if($results['web_visit']=='L'){echo 'selected';}?> value="L" >Less than 1000</option>
                        <option <?php if($results['web_visit']=='M'){echo 'selected';}?> value="M">Between 1000-10000</option>
                        <option <?php if($results['web_visit']=='H'){echo 'selected';}?> value="H">More than 10000</option>
                        </select>
                    </div>
                  <span class="h4 col-md-12"><i class="fa fa-university"></i> <strong>AFFILIATE PAYMENT INFORMATION</strong></span>  
                  <?php
                  if($results['payment_method']=='L'){ $method='eCheque / Local Bank Transfer';}
						elseif($results['payment_method']=='W'){ $method='Wire Transfer';}
						elseif($results['payment_method']=='C'){ $method='Cheque';}
						elseif($results['payment_method']=='P'){ $method='Paypal';}
						elseif($results['payment_method']=='H'){ $method='Hold Payments';}
						elseif($results['payment_method']=='D'){ $method='Direct Deposit / ACH';}
						elseif($results['payment_method']==''){ $method='Payment Method Not Provided';}
						else{ $method='Error Contact Admin';}
						
                        ?>
                        <div class="form-group col-md-6">
                      <label>Payment Method </label> &nbsp; &nbsp;
                       <input class="form-control" name="payment_method"   value="<?php echo $method;?>" placeholder="Enter Your Payment Method" type="text" disabled="disabled">
                    </div>
                    
                  <?php include('../affiliate/payment_info/local_bank.php');
				   include('../affiliate/payment_info/wire.php');
				   include('../affiliate/payment_info/cheque.php');
				   include('../affiliate/payment_info/paypal.php');
				    include('../affiliate/payment_info/hold_pay.php');
					include('../affiliate/payment_info/direct.php');
					?> 
                  
                  <span class="h4 col-md-12"><i class="fa fa-usd"></i> <strong>AFFILIATE TAX INFORMATION</strong></span>  
                 <?php if($results['person']==''){ echo '<p class="col-md-12">Tax Information Not Provided</p>';} ?>
                  <?php include('../affiliate/person/non_us.php');?> 
                 <?php include('../affiliate/person/us_person.php');?> 
                   
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
