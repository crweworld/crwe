<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
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

 $affi_no="SELECT * FROM transactions where commision_status='1' and payment_status='Completed'";
$result=mysql_query($affi_no);
$affi_no=mysql_num_rows($result);

 $ref_no="SELECT * FROM commission where com_type='referral'";
$result=mysql_query($ref_no);
$ref_no=mysql_num_rows($result);

$comm = mysql_query("SELECT SUM(com_amt) FROM commission where approval='1'") or die(mysql_error()); 
$results = mysql_fetch_array($comm);
$com_amt=number_format($results['SUM(com_amt)'],2);

$pa_amt = mysql_query("SELECT SUM(paid_amt) FROM payment") or die(mysql_error()); 
$results = mysql_fetch_array($pa_amt);
$paid_amt=number_format($results['SUM(paid_amt)'],2);

$pending = number_format($com_amt-$paid_amt, 2);

$affi_click="SELECT * FROM affi_user";
$result=mysql_query($affi_click);
$results = mysql_fetch_array($result);
		$clicks=$results['clicks'];
		$unq_clicks=$results['unq_clicks'];
		
$result1=mysql_query("SELECT * FROM affi_user where active='0'");
$inactive=mysql_num_rows($result1);

$result2=mysql_query("SELECT * FROM affi_user where active='1' and username!=''");
$active_ap=mysql_num_rows($result2);

$result3=mysql_query("SELECT * FROM affi_user where active='2'");
$approved=mysql_num_rows($result3);

$result4=mysql_query("SELECT * FROM affi_user where active='1' and username=''");
$active_in=mysql_num_rows($result4);
		
 
 
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
                    
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3><?php echo $active_ap?></h3>
                          <p>Active & Waiting for Approval</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                     <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3><?php echo $active_in?></h3>
                          <p>Active & Profile Incomplete</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                    
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3><?php echo $inactive?></h3>
                          <p>Inactive</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
                    
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-orange">
                        <div class="inner">
                          <h3><?php echo $approved?></h3>
                          <p>Approved</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user"></i>
                        </div>                
                      </div>
                    </div><!-- ./col -->
             
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
     <?php include('footer.php')?>
