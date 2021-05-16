  <?php if($nav=='edit_payment_info.php'){?>
  			<form role="form" action="" method="post">  
                 <div id="paypal" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='P'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='P') { echo 'style="display:none"';}?>>
                 	<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                    <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                       <input class="form-control" value="USD" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>PayPal Email Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="paypal_email"   value="<?php if(isset($_SESSION['paypal_email'])){ echo $_SESSION['paypal_email']; } else{ echo $results['paypal_email'];} ?>" placeholder="Enter Your PayPal Email Address" type="email" required="required" >
                    </div>
                    
                    	<div class="box-footer col-md-12">
                    		<button type="submit" name="paypal" class="btn btn-primary">Update Payment Info</button> 
                 		 </div> 
                        
                 </div>
                 </form>
      <?php } ?>
	  
         <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='P') { ?>
                 	<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                    <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                       <input class="form-control" value="USD" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>PayPal Email Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="paypal_email"   value="<?php echo $results['paypal_email'];?>" placeholder="Enter Your PayPal Email Address" type="email" disabled >
                    </div>
                   <?php } ?>
      <?php } ?>