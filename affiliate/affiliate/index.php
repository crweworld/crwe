<?php
session_start();

include ('../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:../index.php');
}

 include('header.php');
 include('sidebar.php');


 $affi_no='0';
 $ref_no='0';
$com_amt='0';
$paid_amt='0';
$pending='0';
$clicks='0';
$unq_clicks='0';
 
 $affi_no="SELECT * FROM transactions where affiliate_id='{$_SESSION['affi_id']}' and commision_status='1' and payment_status='Completed'";
$result=mysql_query($affi_no);
$affi_no=mysql_num_rows($result);

 $ref_no="SELECT * FROM commission where affiliate_id='{$_SESSION['affi_id']}' and com_type='referral'";
$result=mysql_query($ref_no);
$ref_no=mysql_num_rows($result);

$comm = mysql_query("SELECT SUM(com_amt) FROM commission where approval='1' and affiliate_id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
$results = mysql_fetch_array($comm);
$com_amt=number_format($results['SUM(com_amt)'],2);

$pa_amt = mysql_query("SELECT SUM(paid_amt) FROM payment where affiliate_id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
$results = mysql_fetch_array($pa_amt);
$paid_amt=number_format($results['SUM(paid_amt)'],2);

$pending = number_format($com_amt-$paid_amt, 2);

$affi_click="SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'";
$result=mysql_query($affi_click);
$results = mysql_fetch_array($result);
		$clicks=$results['clicks'];
		$unq_clicks=$results['unq_clicks'];
		
		

 ?>
      <!-- Left side column. contains the logo and sidebar -->
     

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
            <!--<li class="active">Here</li>-->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        	<div class="row">
          
  <?php
				$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					
					$person=$results['person'];
					$payment_method=$results['payment_method'];
					$active=$results['active'];
					$username=$results['username'];
					$affi_id=$results['affi_id'];
				}
					
					
					if (!$username) {
				?>
          <div class="col-lg-12 col-xs-6">
          	 <div class="alert alert-danger alert-dismissible" style="font-size: 15px;font-weight: 600;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Affiliate Link cannot be created, Your Account is incomplete kindly complete the following. <br />
                <p>(Once you complete your Profile and submit your information, you will be provided with your Id number)</p><br />
                <?php if(!$username){ ?>
                <i class="icon fa fa-times-circle"></i> <a href="edit_profile.php">My Profile</a> <br />
                <?php } ?>
              </div>
           </div>
               <?php  } ?>
               
              <?php  
			  if ($active == 2) 
			  {
				  $state='Congratulations. You have been approved.';
			  }
			  else { $state='Your affiliate url is not generating revenue until our approval. We will respond you within 24 hours.'; }
              ?>      
               
                 
                <?php if(!empty($username)){ ?>
                 <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="fa fa-thumbs-o-up"></i> Success!</h4>
                <p><?php echo $state?> Your Affiliate Link is <a target="_blank" href="http://affiliate.crweworld.com/<?php  echo $username;?>">http://affiliate.crweworld.com/<?php  echo $username;?></a></p>
                
                <?php if($active=='2'){ ?>
                <p>Your Id Number is: <?php  echo $affi_id;?></p>
                <?php } else {?> <p>(Once you complete your Profile and submit your information, you will be provided with your Id number)</p> <?php } ?>
                
                
                 <br />
                <?php if( (!$payment_method) or (!$person)) { ?>
               <p> Kindly complete your information, so we can deliver payment once you've reached the $25 threshold.</p>
               <?php } ?>
              
                <?php if(!$payment_method){ ?>
                <i class="icon fa fa-times-circle"></i> <a href="edit_payment_info.php">Payment Information</a>  <br />
                <?php } ?>
                <?php if(!$person){ ?>
                <i class="icon fa fa-times-circle"></i> <a href="edit_tax_form.php">Tax Information</a>
                <?php } ?>
              </div>
              </div>
              <?php } ?>
               
      <?php if($active != 2){ echo '<p class="col-md-12">Stats cannot be viewed unless the you got approved</p>'; } else{ ?>
            <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3><?php echo $affi_no?></h3>
                          <p>Number of Purchase</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-shopping-cart"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                    
                   <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-orange">
                        <div class="inner">
                         <h3><?php echo $ref_no?></h3>
                          <p>Number of Referral</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-code-fork"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                    
               
               
                     <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-olive">
                        <div class="inner">
                          <h3><?php echo $com_amt?></h3>
                          <p>Commissionable Amount</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-money"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                   
                
                         <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-maroon">
                        <div class="inner">
                          <h3><?php echo $paid_amt?></h3>
                          <p>Paid Amount</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-usd"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                    
                       <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3><?php echo $pending?></h3>
                          <p>Pending Amount</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-usd"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                    
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-purple">
                        <div class="inner">
                          <h3><?php echo $clicks?></h3>
                          <p>No. of Clicks</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-users"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                    
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-gray">
                        <div class="inner">
                          <h3><?php echo $unq_clicks?></h3>
                          <p>No. of Unique Clicks</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
             <?php } ?>
                    
                         
          </div>
          
	 <?php if(empty($username)){ ?>
    <h1>Instructions</h1>
    
    <b>After you complete your profile page, we will begin your approval process</b>
       <?php } ?>      
       
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
     <?php include('footer.php')?>
