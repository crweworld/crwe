<?php if($nav=='edit_payment_info.php'){?>
<form role="form" action="" method="post">
                 <div id="cheque" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='C'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='C') { echo 'style="display:none"';}?>>
                 	<p class="col-md-12"><strong>Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.</strong><br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b> <br>
Cheques are sent by mail to the address you given. Please allow 15 business days for the cheque to arrive.<br>
Cheques are for deposit only, and cannot be transferred.<br>
The cheques will be drawn in the currency selected below.</p>
					 <div class="form-group col-md-6">
                      <label>Currency</label> &nbsp; &nbsp;
                       <input class="form-control" value="US Dollar" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Name on Cheque <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Cheque" type="text" required="required">
                    </div>
                    
                    	<div class="box-footer col-md-12">
                    		<button type="submit" name="cheque" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                      
                 </div>
                 
                  </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='C') { ?>
						
                        <p class="col-md-12"><strong>Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.</strong> <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b> <br>
Cheques are sent by mail to the address you given. Please allow 15 business days for the cheque to arrive.<br>
Cheques are for deposit only, and cannot be transferred.<br>
The cheques will be drawn in the currency selected below.</p>
					 <div class="form-group col-md-6">
                      <label>Currency</label> &nbsp; &nbsp;
                       <input class="form-control" value="US Dollar" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Name on Cheque <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name'];?>" placeholder="Enter Your Name on Cheque" type="text" disabled>
                    </div>
                
                 <?php } ?>
      <?php } ?>