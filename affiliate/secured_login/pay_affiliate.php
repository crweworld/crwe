<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 

if(isset($_POST['pay_user']))
{
	$doc=date("Y-m-d");
	$username=mysql_real_escape_string(strtolower($_POST['username']));
	$payment_method=mysql_real_escape_string($_POST['payment_method']);
	$paid_on=mysql_real_escape_string($_POST['paid_on']);
	$paid_amt=mysql_real_escape_string($_POST['paid_amt']);
	$ref=mysql_real_escape_string($_POST['ref']);
	
		$user_sql="SELECT * FROM affi_user WHERE username='$username'";
		$result=mysql_query($user_sql);
		$user=mysql_num_rows($result);
	
		$ref1="SELECT * FROM affi_user WHERE username='$username' and active='2' ";
		$result=mysql_query($ref1) or die(mysql_error());
		$results = mysql_fetch_array($result);
		$affiliate_id=$results['id'];
	

	$err_sin="";
	if($username==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Username / Tracking Id is Empty <br>";} 
	else if($user == 0){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Username Not Found <br>";} 
	else if($affiliate_id == 0){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! User is Not Approved, Please Contact Admin<br>";} 
	if($payment_method==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Payment Method is Empty <br>";}
	if($paid_on==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Paid on is Empty <br>";}
	if($paid_amt==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Paid Amount is Empty <br>";}
	
	
	$_SESSION['username']=$_POST['username'];
	$_SESSION['payment_method']=$_POST['payment_method'];
	$_SESSION['paid_on']=$_POST['paid_on'];
	$_SESSION['paid_amt']=$_POST['paid_amt'];
	$_SESSION['ref']=$_POST['ref'];
	
	if($err_sin=="")
	{	
		
		$sql="INSERT INTO `payment`(`affiliate_id`, `payment_method`, `paid_on`, `paid_amt`, `ref`, `updated_on`) VALUES ('$affiliate_id', '$payment_method', '$paid_on', '$paid_amt', '$ref', '$doc')";	
			

			$update_ok = mysql_query($sql)or die(mysql_error());
			if($update_ok == 1)
			{
				
				echo clear();
			
			$done ="<i class=\"icon fa fa-info\"></i> Payment added successfully. <br>";
				
			}
	}
	
}

else
{
	echo clear();
	
}

function clear()
{
	unset($_SESSION['username']);unset($_SESSION['payment_method']);unset($_SESSION['paid_on']);unset($_SESSION['paid_amt']);unset($_SESSION['ref']);
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
            <li class="active">Pay Affiliate</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Pay Affiliate</h3>
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
                  	<span class="h4 col-md-12"><i class="fa fa-book margin-r-5"></i> <strong>ADD PAYMENT INFORMATION</strong></span> 
                    
                     <div class="form-group col-md-6">
                      <label>Username / Tracking Id<span class="red-star">*</span></label> &nbsp; &nbsp;
					 <input class="form-control" name="username"   value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; }?>" placeholder="Enter Your Username / Tracking Id" type="text" required >
                    </div>  
                    
                    <div class="form-group col-md-6">
                      <label>Payment Method <span class="red-star">*</span></label> &nbsp; &nbsp;
                       
                       <select class="form-control" id="payment_method"  name="payment_method" required>
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='L'){echo 'selected';} }?> value="L" >eCheque / Local Bank Transfer</option>
                        <option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'selected';} }?> value="W" >Wire Transfer</option>
                        <option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='C'){echo 'selected';} }?> value="C">Cheque</option>
                        <option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='P'){echo 'selected';} }?> value="P">Paypal</option>
                        <option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='H'){echo 'selected';} }?> value="H">Hold My Payments</option>
                        </select>
                    </div> 
                                     
                    <div class="form-group col-md-6">
                      <label>Paid on<span class="red-star">*</span></label>
                      <input class="form-control" name="paid_on"   value="<?php if(isset($_SESSION['paid_on'])){ echo $_SESSION['paid_on']; } ?>" placeholder="yyyy-mm-dd" type="text" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Paid Amount <span class="red-star">*</span></label>
                      <input class="form-control" name="paid_amt"   value="<?php if(isset($_SESSION['paid_amt'])){ echo $_SESSION['paid_amt']; }?>" placeholder="Enter Paid Amount (ex : 13.49)" step="0.01" type="number" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Reference</label>
                      <input class="form-control" name="ref"   value="<?php if(isset($_SESSION['ref'])){ echo $_SESSION['ref']; }?>" placeholder="Enter Reference Any" type="text" >
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="pay_user" class="btn btn-primary">Add Payment Detail</button> 
                    
                  </div>
                </form>
              
                
                
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
