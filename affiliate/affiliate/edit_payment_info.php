<?php
session_start();

include ('../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
}

$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					$chk_loc=mysql_real_escape_string($results['post_country']);
					if($chk_loc==''){ header('Location:profile.php'); }
					
				}
$cdata = mysql_query("SELECT * FROM countrydata where country='$chk_loc'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{ $cur_info= $rts['currency'];
						  $cur_info2= $rts['currency2'];
						 $wire_type= $rts['wire_type'];
						 $local_type= $rts['local_type'];
                        }
	
							
 include('../subs/alert_mail.php');							
 include('header.php');
 include('sidebar.php');
 

if(isset($_POST['hold_my_payments']))
{
	
	$sql="UPDATE `affi_user` SET `payment_method`='H' where `id`='{$_SESSION['affi_id']}'";
	$update_ok = mysql_query($sql)or die(mysql_error());
	
	if($update_ok == 1)
	{
		echo alert_mail();
	$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
		
	}
}
else if(isset($_POST['paypal']))
{
	$paypal_email=mysql_real_escape_string(strtolower($_POST['paypal_email']));
	
	$err_sin="";
	if($paypal_email==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Paypal Email Id is Empty <br>";} 
	
	$_SESSION['payment_method']='P';
	$_SESSION['paypal_email']=$paypal_email;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='P', `paypal_email`='$paypal_email' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
			echo alert_mail();
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}
else if(isset($_POST['cheque']))
{
	$account_name=mysql_real_escape_string($_POST['account_name']);
	
	$err_sin="";
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Cheque is Empty <br>";} 
	
	$_SESSION['payment_method']='C';
	$_SESSION['account_name']=$account_name;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='C', `account_name`='$account_name' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
			echo alert_mail();
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}
else if(isset($_POST['wire_transfer']))
{
	include('payment_info/functions/wire_transfer_f.php');
	
}
else if(isset($_POST['local_banks']))
{
	include('payment_info/functions/local_bank_f.php');
}
else if(isset($_POST['direct_deposist']))
{
	include('payment_info/functions/direct_f.php');
	
}
else
{
	echo clear();
}

function clear()
{
	unset($_SESSION['account_name']);unset($_SESSION['paypal_email']);unset($_SESSION['payment_method']);
	unset($_SESSION['account_no']);unset($_SESSION['ifsc_code']);unset($_SESSION['swift_code']);unset($_SESSION['bank_name']);unset($_SESSION['bank_branch']);unset($_SESSION['bank_address']);unset($_SESSION['account_type']);unset($_SESSION['currency_type']);unset($_SESSION['insti_no']); unset($_SESSION['routing_no']);unset($_SESSION['clabe']);;unset($_SESSION['bank_code']);;unset($_SESSION['branch_code']);
}
 ?>
 <style>
 .red-star{
	 color: rgb(240, 0, 0);
 }
 </style>
  <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
   <script type='text/javascript'>//<![CDATA[
		$(window).load(function(){
		$(document).ready(function(){
			$('#cur_info').on('change', function() {
			  if ( this.value != 'USD')
			  {
				$("#added_info").show();
			  }
			  else 
			  {
				$("#added_info").hide();
			  }
			  });
		});
		});//]]> 		
	  </script>

  <script type='text/javascript'>//<![CDATA[
		$(window).load(function(){
		$(document).ready(function(){
			$('#payment_method').on('change', function() {
			  if ( this.value == 'D')
			  {
				$("#direct_deposist").show();
				$("#local_banks").hide();
				$("#hold_my_payments").hide();
				$("#paypal").hide();
				$("#cheque").hide();
				$("#wire_transfer").hide();
				
			  }
			  else if ( this.value == 'L')
			  {
				$("#local_banks").show();
				$("#hold_my_payments").hide();
				$("#paypal").hide();
				$("#cheque").hide();
				$("#wire_transfer").hide();
				$("#direct_deposist").hide();
			  }
			   else if ( this.value == 'W')
			  {
				$("#wire_transfer").show();
				$("#local_banks").hide();
				$("#hold_my_payments").hide();
				$("#paypal").hide();
				$("#cheque").hide();
				$("#direct_deposist").hide();
			  }
			  else if ( this.value == 'C')
			  {
			  	$("#cheque").show();
				$("#paypal").hide();
				$("#hold_my_payments").hide();
				$("#local_banks").hide();
				$("#wire_transfer").hide();
				$("#direct_deposist").hide();
			  }
			  else if ( this.value == 'P')
			  {
				$("#paypal").show();
				$("#hold_my_payments").hide();
				$("#local_banks").hide();
				$("#cheque").hide();
				$("#wire_transfer").hide();
				$("#direct_deposist").hide();
			  }
			  else if ( this.value == 'H')
			  {
				$("#hold_my_payments").show();
				$("#local_banks").hide();
				$("#paypal").hide();
				$("#cheque").hide();
				$("#wire_transfer").hide();
				$("#direct_deposist").hide();
			  }
			  else
			  {
				$("#direct_deposist").hide();
				$("#local_banks").hide();
				$("#hold_my_payments").hide();
				$("#paypal").hide();
				$("#cheque").hide();
				$("#wire_transfer").hide();
			  }
			});
		});
		});//]]> 		
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
            <li><a href="#">Account</a></li>
            <li class="active">Edit Payment Information</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Payment Information</h3>
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
				$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					
				?>
                               	
                  <div class="box-body">  
                  	
                    <div class="form-group col-md-12">
                      <label>Payment Method <span class="red-star">*</span></label> &nbsp; &nbsp;
                       
                       <select class="form-control" id="payment_method"  name="payment_method" required="required">
                        <option value="">Select</option>
                        <?php
						$serv = mysql_query("SELECT * FROM `countrydata` where country='$chk_loc'") or die(mysql_error());
								while($info = mysql_fetch_array($serv))
								{	
									$pay_type=$info['pay_type'];
									$pay_type = explode(",", $pay_type);
								}
						foreach ($pay_type as $value) 
							{    
								$value;
								if($value=='D'){?><option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='D'){echo 'selected';} } else if($results['payment_method']=='D'){echo 'selected';}?> value="D" >Direct Deposit / ACH</option> <?php }
								
								if($value=='L'){?><option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='L'){echo 'selected';} } else if($results['payment_method']=='L'){echo 'selected';}?> value="L" >eCheque / Local Bank Transfer</option> <?php }
								
								if($value=='W'){?><option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'selected';} } else if($results['payment_method']=='W'){echo 'selected';}?> value="W" >Wire Transfer</option> <?php }
								
								if($value=='C'){?><option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='C'){echo 'selected';} } else if($results['payment_method']=='C'){echo 'selected';}?> value="C" >Cheque</option> <?php }
								
								if($value=='P'){?><option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='P'){echo 'selected';} } else if($results['payment_method']=='P'){echo 'selected';}?> value="P" >Paypal</option> <?php }
								
								if($value=='H'){?><option <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='H'){echo 'selected';} } else if($results['payment_method']=='H'){echo 'selected';}?> value="H" >Hold My Payments</option> <?php }
							}
						?>
                       
                        </select>
                    </div>
                    
                 <?php 
				 foreach ($pay_type as $value) 
							{    
								$value;
								if($value=='D'){include('payment_info/direct.php');	}
								if($value=='L'){include('payment_info/local_bank.php');	}
								if($value=='W'){include('payment_info/wire.php');	}
								if($value=='C'){include('payment_info/cheque.php');	}
								if($value=='P'){include('payment_info/paypal.php');	}
								if($value=='H'){include('payment_info/hold_pay.php');}
							}
				  ?> 
                 
              
                  </div><!-- /.box-body -->

                 
                <?php } ?>
                
                
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     
      <?php include('footer.php')?>
