<?php
session_start();

include ('../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
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
            <li class="active">Payment Information</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Payment Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                <?php
				$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					if($results['payment_method']=='L'){$payment_method='eCheque / Local Bank Transfer';}
					else if($results['payment_method']=='W'){$payment_method='Wire Transfer';}
					else if($results['payment_method']=='C'){$payment_method='Cheque';}
					else if($results['payment_method']=='P'){$payment_method='Paypal';}
					else if($results['payment_method']=='H'){$payment_method='Hold My Payments';}
					else{$payment_method='Please Update Your Payment Method';}
					
				?>
                               	
                  <div class="box-body">  
                  	
                    <div class="form-group col-md-12">
                      <label>Payment Method <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input type="text" class="form-control" value="<?php echo $payment_method?>" disabled="disabled" />
                    
                       
                    </div>
                    
                 <?php include('payment_info/local_bank.php');?> 
                 <?php include('payment_info/wire.php');?> 
                 <?php include('payment_info/cheque.php');?> 
                 <?php include('payment_info/paypal.php');?> 
                 <?php include('payment_info/hold_pay.php');?> 
                 
               <div class="box-footer">
                    	<a href="edit_payment_info.php" class="btn btn-primary">Edit Payment Info</a> 
                </div>
                     
                  </div><!-- /.box-body -->

                 
                <?php } ?>
                
                
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     
      <?php include('footer.php')?>
