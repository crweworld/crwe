 <?php
 
 if($chk_loc=='United States') {
	 
	  if($nav=='edit_payment_info.php'){?>

<form role="form" action="" method="post">   
                  <div id="direct_deposist" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='D'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='D') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees.<br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required">
                    </div>    
                    <div class="form-group col-md-6">
                      <label>Routing Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no" value="<?php if(isset($_SESSION['routing_no'])){ echo $_SESSION['routing_no']; } else{ echo $results['routing_no'];} ?>" placeholder="Enter Your Routing Number" type="text" required="required">
                    </div>  
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your Account Number" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Account Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="account_type" required="required" >
                        <option value="">Select</option>
                        <option <?php  if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='C'){echo 'selected';} } else if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php  if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='S'){echo 'selected';} } else if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        </select>
                    </div>
                    
                   
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php if(isset($_SESSION['bank_name'])){ echo $_SESSION['bank_name']; } else{ echo $results['bank_name'];} ?>" placeholder="Enter Your Bank Name" type="text" required="required">
                    </div>
                    
                     
                    
                  
                    	<div class="box-footer col-md-12">
                    	<button type="submit" name="direct_deposist" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                    
                </div>
                </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='D') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees.<br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled>
                    </div>       
                    
                     <div class="form-group col-md-6">
                      <label>Routing Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no"   value="<?php echo $results['routing_no']; ?>" placeholder="Enter Your Routing Number" type="text" disabled>
                    </div>   
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your Account Number" type="text" disabled>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>Account Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="account_type" disabled>
                        <option value="">Select</option>
                        <option <?php if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        </select>
                    </div>
                   
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php echo $results['bank_name']; ?>" placeholder="Enter Your Bank Name" type="text" disabled>
                    </div>
                    
                    
                    
				 <?php } ?>
			 <?php } ?>
         <?php } // USA?>