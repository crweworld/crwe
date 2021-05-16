<?php 
if($chk_loc=='India') {
	if($nav=='edit_payment_info.php'){?>
<form role="form" action="" method="post">   
                 <div id="local_banks" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='L'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='L') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply. <br /> <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                        <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{?>
                        <input class="form-control"  name="currency_type" value="<?php echo $rts['currency']?>" disabled>
                       <?php } ?>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required" >
                    </div>          
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your Account Number" type="text" required="required" >
                    </div>
                    <div class="form-group col-md-6">
                      <label>IFSC Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="ifsc_code"   value="<?php if(isset($_SESSION['ifsc_code'])){ echo $_SESSION['ifsc_code']; } else{ echo $results['ifsc_code'];} ?>" placeholder="Enter Your IFSC Code" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required" >
                    </div>
                    <div class="form-group col-md-6">
                      <label>Account Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="account_type" required="required" >
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='C'){echo 'selected';} } else if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='S'){echo 'selected';} } else if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='NE'){echo 'selected';} } else if($results['account_type']=='NE'){echo 'selected';}?> value="NE">NRE</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='NO'){echo 'selected';} } else if($results['account_type']=='NO'){echo 'selected';}?> value="NO">NRO</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='NR'){echo 'selected';} } else if($results['account_type']=='NR'){echo 'selected';}?> value="NR">NRNR</option>
                        </select>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php if(isset($_SESSION['bank_name'])){ echo $_SESSION['bank_name']; } else{ echo $results['bank_name'];} ?>" placeholder="Enter Your Bank Name" type="text" required="required">
                    </div>
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_address"   value="<?php if(isset($_SESSION['bank_address'])){ echo $_SESSION['bank_address'];}else{ echo $results['bank_address'];} ?>" placeholder="Enter Your Bank Address" type="text" required="required">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                    
                   <div class="box-footer col-md-12">
                    <button type="submit" name="local_banks" class="btn btn-primary">Update Payment Info</button> 
                  </div>
                  
                </div>
                 </form>  
               <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='L') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.<br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                        <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{?>
                        <input class="form-control"  name="currency_type" value="<?php echo $rts['currency']?>" disabled>
                       <?php } ?>                    
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled >
                    </div>          
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;}for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your Account Number" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>IFSC Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="ifsc_code"   value="<?php echo $results['ifsc_code']; ?>" placeholder="Enter Your IFSC Code" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php echo $results['swift_code']; ?>" placeholder="Enter Your SWIFT" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Account Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="account_type" disabled>
                        <option value="">Select</option>
                        <option <?php if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        <option <?php if($results['account_type']=='NE'){echo 'selected';}?> value="NE">NRE</option>
                        <option <?php if($results['account_type']=='NO'){echo 'selected';}?> value="NO">NRO</option>
                        <option <?php if($results['account_type']=='NR'){echo 'selected';}?> value="NR">NRNR</option>
                        </select>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php echo $results['bank_name']; ?>" placeholder="Enter Your Bank Name" type="text" disabled>
                    </div>
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_address"   value="<?php echo $results['bank_address'];?>" placeholder="Enter Your Bank Address" type="text" disabled>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                        
				<?php } ?>
		 	<?php } ?>
		<?php } // End of India?>
		
 
 <?php 
if($chk_loc=='Canada') {
	if($nav=='edit_payment_info.php'){?>
<form role="form" action="" method="post">   
                 <div id="local_banks" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='L'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='L') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.  <br /> <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                      <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{?>
                        <input class="form-control"  name="currency_type" value="<?php echo $rts['currency']?>" disabled>
                       <?php } ?>
                       
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required" >
                    </div>     
                    
                     <div class="form-group col-md-6">
                      <label>Institution Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no" value="<?php if(isset($_SESSION['insti_no'])){ echo $_SESSION['insti_no']; } else{ echo $results['insti_no'];} ?>" placeholder="Enter Your Institution Number" type="text" required="required">
                    </div>     
                    <div class="form-group col-md-6">
                      <label>Branch Routing Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no" value="<?php if(isset($_SESSION['routing_no'])){ echo $_SESSION['routing_no']; } else{ echo $results['routing_no'];} ?>" placeholder="Enter Your Branch Routing Number" type="text" required="required">
                    </div>  
                         
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your Account Number" type="text" required="required" >
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required" >
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
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <textarea class="form-control" name="bank_address" required="required"><?php if(isset($_SESSION['bank_address'])){ echo $_SESSION['bank_address']; } else{ echo $results['bank_address'];} ?></textarea>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                   <div class="box-footer col-md-12">
                    <button type="submit" name="local_banks" class="btn btn-primary">Update Payment Info</button> 
                  </div>
                  
                </div>
                 </form>  
               <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='L') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.<br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                      <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{?>
                        <input class="form-control"  name="currency_type" value="<?php echo $rts['currency']?>" disabled>
                       <?php } ?>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled >
                    </div>          
                    
                    <div class="form-group col-md-6">
                      <label>Institution Number  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php echo $results['insti_no']; ?>" placeholder="Enter Your Institution Number" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Branch Routing Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no"   value="<?php echo $results['routing_no']; ?>" placeholder="Enter Your Branch Routing Number" type="text" disabled>
                    </div> 
                    
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;}for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your Account Number" type="text" disabled>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php echo $results['swift_code']; ?>" placeholder="Enter Your SWIFT" type="text" disabled>
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
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                        
				<?php } ?>
		 	<?php } ?>
		<?php } // End of Canada?>      
        
        
 <?php 
if($chk_loc=='Mexico') {
	if($nav=='edit_payment_info.php'){?>
<form role="form" action="" method="post">   
                 <div id="local_banks" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='L'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='L') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.  <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                      <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{?>
                        <input class="form-control"  name="currency_type" value="<?php echo $rts['currency']?>" disabled>
                       <?php } ?>
                       
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required" >
                    </div>     
                    
                     <div class="form-group col-md-6">
                      <label>National ID Number<span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no" value="<?php if(isset($_SESSION['insti_no'])){ echo $_SESSION['insti_no']; } else{ echo $results['insti_no'];} ?>" placeholder="Enter Your National ID Number" type="text" required="required">
                    </div>     
                    
                    <div class="form-group col-md-6">
                      <label>CLABE <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="clabe"   value="<?php if(isset($_SESSION['clabe'])){ echo $_SESSION['clabe']; } else{ echo $results['clabe'];} ?>" placeholder="Enter Your CLABE Number" type="text" required="required" >
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required" >
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
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <textarea class="form-control" name="bank_address" required="required"><?php if(isset($_SESSION['bank_address'])){ echo $_SESSION['bank_address']; } else{ echo $results['bank_address'];} ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Bank Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_code"   value="<?php if(isset($_SESSION['bank_code'])){ echo $_SESSION['bank_code']; } else{ echo $results['bank_code'];} ?>" placeholder="Enter Your Bank Code" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Branch Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <input class="form-control" name="branch_code"   value="<?php if(isset($_SESSION['branch_code'])){ echo $_SESSION['branch_code']; } else{ echo $results['branch_code'];} ?>" placeholder="Enter Your Branch Code" type="text" required="required">
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                   <div class="box-footer col-md-12">
                    <button type="submit" name="local_banks" class="btn btn-primary">Update Payment Info</button> 
                  </div>
                  
                </div>
                 </form>  
               <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='L') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.<br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                      <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{?>
                        <input class="form-control"  name="currency_type" value="<?php echo $rts['currency']?>" disabled>
                       <?php } ?>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled >
                    </div>          
                    
                    
                   
                     <div class="form-group col-md-6">
                      <label>National ID Number<span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no" value="<?php echo $results['insti_no']; ?>" placeholder="Enter Your National ID Number" type="text" disabled>
                    </div>     
                    
                    <div class="form-group col-md-6">
                      <label>CLABE <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="clabe"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['clabe'];} else {$str = $results['clabe']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;}for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your CLABE Number" type="text" disabled >
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php echo $results['swift_code']; ?>" placeholder="Enter Your SWIFT" type="text" disabled>
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
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>Bank Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_code"   value="<?php echo $results['bank_code']; ?>" placeholder="Enter Your Bank Code" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Branch Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <input class="form-control" name="branch_code"   value="<?php echo $results['branch_code']; ?>" placeholder="Enter Your Branch Code" type="text" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                        
				<?php } ?>
		 	<?php } ?>
		<?php } // End of Mexico?>   
        
 
 
 <?php 
if($local_type=='t1') {
	if($nav=='edit_payment_info.php'){?>
<form role="form" action="" method="post">   
                 <div id="local_banks" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='L'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='L') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.  <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                      <input class="form-control" name="currency_type" value="EUR" disabled>
                       
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required" >
                    </div>     
                    
                    <div class="form-group col-md-6">
                      <label>IBAN<span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your IBAN" type="text" required="required" >
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required" >
                    </div>
                   
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php if(isset($_SESSION['bank_name'])){ echo $_SESSION['bank_name']; } else{ echo $results['bank_name'];} ?>" placeholder="Enter Your Bank Name" type="text" required="required">
                    </div>
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <textarea class="form-control" name="bank_address" required="required"><?php if(isset($_SESSION['bank_address'])){ echo $_SESSION['bank_address']; } else{ echo $results['bank_address'];} ?></textarea>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                   <div class="box-footer col-md-12">
                    <button type="submit" name="local_banks" class="btn btn-primary">Update Payment Info</button> 
                  </div>
                  
                </div>
                 </form>  
               <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='L') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.<br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                      <input class="form-control" name="currency_type" value="EUR" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled >
                    </div>          
                   
                    <div class="form-group col-md-6">
                      <label>IBAN <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;}for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your IBAN Number" type="text" disabled>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php echo $results['swift_code']; ?>" placeholder="Enter Your SWIFT" type="text" disabled>
                    </div>
                   
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php echo $results['bank_name']; ?>" placeholder="Enter Your Bank Name" type="text" disabled>
                    </div>
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                        
				<?php } ?>
		 	<?php } ?>
		<?php } // End of Aland?>  
        
        
        
        
<?php 
if($local_type=='t2') {
	if($nav=='edit_payment_info.php'){?>
<form role="form" action="" method="post">   
                 <div id="local_banks" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='L'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='L') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.  <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                      <select class="form-control" name="currency_type" required="required">
                        
                       
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$cur_info){echo 'selected';} } else if($results['currency_type']==$cur_info){echo 'selected';}?> value="<?php echo $cur_info?>"><?php echo $cur_info?></option>
                        <?php if($cur_info2!=''){ ?>
                          <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$cur_info2){echo 'selected';} } else if($results['currency_type']==$cur_info2){echo 'selected';}?> value="<?php echo $cur_info2?>"><?php echo $cur_info2?></option>
                          <?php } ?>
                      </select>
                       
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required" >
                    </div>    
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php if(isset($_SESSION['bank_name'])){ echo $_SESSION['bank_name']; } else{ echo $results['bank_name'];} ?>" placeholder="Enter Your Bank Name" type="text" required="required">
                    </div> 
                    
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required" >
                    </div>
                    <?php if($chk_loc=='Australia'){ ?>
                    <div class="form-group col-md-6">
                      <label>BSB Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php if(isset($_SESSION['insti_no'])){ echo $_SESSION['insti_no']; } else{ echo $results['insti_no'];} ?>" placeholder="Enter Your BSB Code" type="text" required="required" >
                    </div>
                    <?php } else if($chk_loc=='Sweden' or $chk_loc=='United Kingdom'){ ?>
                    <div class="form-group col-md-6">
                      <label>IBAN <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php if(isset($_SESSION['insti_no'])){ echo $_SESSION['insti_no']; } else{ echo $results['insti_no'];} ?>" placeholder="Enter Your IBAN Number" type="text" required="required" >
                    </div>
                    <?php } else { ?>
                    <div class="form-group col-md-6">
                      <label>Bank Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php if(isset($_SESSION['insti_no'])){ echo $_SESSION['insti_no']; } else{ echo $results['insti_no'];} ?>" placeholder="Enter Your Bank Code" type="text" required="required" >
                    </div>
                    <?php } ?>
                    
                   
                     <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your Account Number" type="text" required="required" >
                    </div>
                     
                   
                   
                      <?php if($chk_loc=='Israel') {?>
                       <div class="form-group col-md-6">
                      <label>National ID Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_type"   value="<?php if(isset($_SESSION['account_type'])){ echo $_SESSION['account_type']; } else{ echo $results['account_type'];} ?>" placeholder="Enter Your ANational ID Number" type="text" required="required" >
                    </div>
                    <?php } else { ?>
                     <div class="form-group col-md-6">
                      <label>Account Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="account_type" required="required" >
                        <option value="">Select</option>
                        <option <?php  if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='C'){echo 'selected';} } else if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php  if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='S'){echo 'selected';} } else if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        </select>
                    </div>
                    <?php } ?>
                    <?php if($chk_loc=='Poland') {?>
                       <div class="form-group col-md-6">
                      <label>National ID Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no"   value="<?php if(isset($_SESSION['routing_no'])){ echo $_SESSION['routing_no']; } else{ echo $results['routing_no'];}?>" placeholder="Enter Your National ID Number" type="text" >
                    </div>
                    <?php }?>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                   <div class="box-footer col-md-12">
                    <button type="submit" name="local_banks" class="btn btn-primary">Update Payment Info</button> 
                  </div>
                  
                </div>
                 </form>  
               <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='L') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.<br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                      <input class="form-control" name="currency_type" value="<?php echo $results['currency_type'];?>" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled >
                    </div>   
                    <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php echo $results['bank_name']; ?>" placeholder="Enter Your Bank Name" type="text" disabled>
                    </div>     
                     <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php echo $results['swift_code']; ?>" placeholder="Enter Your SWIFT" type="text" disabled>
                    </div>  
                     <?php if($chk_loc=='Australia'){ ?>
                     <div class="form-group col-md-6">
                      <label>BSB Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php echo $results['insti_no']; ?>" placeholder="Enter Your BSB Code" type="text" disabled>
                    </div>  
                    <?php } else if($chk_loc=='Sweden' or $chk_loc=='United Kingdom'){ ?>
                    <div class="form-group col-md-6">
                      <label>IBAN <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['insti_no'];} else {$str = $results['insti_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;}for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your IBAN Number" type="text" disabled>
                    </div>
                    <?php } else { ?>
                     <div class="form-group col-md-6">
                      <label>Bank Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php echo $results['insti_no']; ?>" placeholder="Enter Your Bank Code" type="text" disabled>
                    </div>
					<?php } ?>
                   
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;}for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your Account Number" type="text" disabled>
                    </div>
                    
                     <?php if($chk_loc=='Israel') {?>
                       <div class="form-group col-md-6">
                      <label>National ID Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_type"   value="<?php echo $results['account_type'];?>" placeholder="Enter Your ANational ID Number" type="text" disabled>
                    </div>
                    <?php } else { ?>
                   <div class="form-group col-md-6">
                      <label>Account Type <span class="red-star">*</span></label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="account_type" disabled>
                        <option value="">Select</option>
                        <option <?php if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        </select>
                    </div>
                   <?php } ?>
                    <?php if($chk_loc=='Poland') {?>
                       <div class="form-group col-md-6">
                      <label>National ID Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no"   value="<?php echo $results['routing_no'];?>" placeholder="Enter Your National ID Number" type="text" disabled>
                    </div>
                    <?php }?>
                     
                     
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
                        
				<?php } ?>
		 	<?php } ?>
		<?php } // End of Australia?>  