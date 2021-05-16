<?php
if($chk_loc=='India' or $chk_loc=='China') {
	 if($nav=='edit_payment_info.php'){?>

<form role="form" action="" method="post">   
                  <div id="wire_transfer" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='W') { echo 'style="display:none"';}?>>
                  <?php if($chk_loc=='India'){ ?>
                     <p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply. <br /> <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                  <?php } else {?>
                   <p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.  <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                  <?php } ?>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <?php if($chk_loc=='India') { ?>  
                     <select id="cur_info" class="form-control" name="currency_type" required="required">
                        <option value="">Select</option>
                        
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']=='USD'){echo 'selected';} } else if($results['currency_type']=='USD'){echo 'selected';}?> value="USD">USD</option>
                         <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{$cur_info= $rts['currency'];?>
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$rts['currency']){echo 'selected';} } else if($results['currency_type']==$rts['currency']){echo 'selected';}?> value="<?php echo $rts['currency']?>"><?php echo $rts['currency']?></option>
                       <?php } ?>
                      </select>
                    <?php }  else { $cur_info='';?>
                     <input class="form-control" name="currency_type" value="USD" disabled>
                     <?php } if($cur_info!='USD' and $cur_info!='EUR' and $cur_info!='NOK'){ ?>
                     <div id="added_info" class="col-md-12" style="display:none"><p>Payments in <?php echo $cur_info;?> are available only above USD 1000 (equivalent in <?php echo $cur_info; ?>).</p> </div>
                     <?php } ?>
                      
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required">
                    </div>          
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your Account Number" type="text" required="required">
                    </div>
                     <?php if($chk_loc=='India') { ?>  
                    <div class="form-group col-md-6">
                      <label>IFSC Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="ifsc_code"   value="<?php if(isset($_SESSION['ifsc_code'])){ echo $_SESSION['ifsc_code']; } else{ echo $results['ifsc_code'];} ?>" placeholder="Enter Your IFSC Code" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Bank Branch Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Bank Branch Name" type="text" required="required">
                    </div>
                    <?php } else { ?>
                    <div class="form-group col-md-6">
                      <label>CNAPS <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="ifsc_code"   value="<?php if(isset($_SESSION['ifsc_code'])){ echo $_SESSION['ifsc_code']; } else{ echo $results['ifsc_code'];} ?>" placeholder="Enter CNAPS" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Beneficiary ID <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Beneficiary ID" type="text" required="required">
                    </div>
                    <?php } ?>
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required">
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
                    	<button type="submit" name="wire_transfer" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                    
                </div>
                </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='W') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply. <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                       <input class="form-control" name="currency_type" value="<?php echo $results['currency_type']; ?>" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled>
                    </div>          
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your Account Number" type="text" disabled>
                    </div>
                    <?php if($chk_loc=='India') { ?> 
                    <div class="form-group col-md-6">
                      <label>IFSC Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="ifsc_code"   value="<?php echo $results['ifsc_code']; ?>" placeholder="Enter Your IFSC Code" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Bank Branch Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your Bank Branch Name" type="text" disabled>
                    </div>
                    <?php } else { ?>
                    <div class="form-group col-md-6">
                      <label>CNAPS <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="ifsc_code"   value="<?php echo $results['ifsc_code'];?>" placeholder="Enter CNAPS" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Beneficiary ID <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch'];?>" placeholder="Enter Your Beneficiary ID" type="text" disabled>
                    </div>
                    <?php } ?>
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
                    
				 <?php }?>
			 <?php } ?>
		<?php } // End of India ?>
        
        
        
        
        
        
        

        
 <?php 
 if($chk_loc=='Canada') {
	 
	  if($nav=='edit_payment_info.php'){?>

<form role="form" action="" method="post">   
                  <div id="wire_transfer" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='W') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.  <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <select class="form-control" name="currency_type" required="required">
                        <option value="">Select</option>
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']=='USD'){echo 'selected';} } else if($results['currency_type']=='USD'){echo 'selected';}?> value="USD">USD</option>
                        
                         <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{?>
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$rts['currency']){echo 'selected';} } else if($results['currency_type']==$rts['currency']){echo 'selected';}?> value="<?php echo $rts['currency']?>"><?php echo $rts['currency']?></option>
                       <?php } ?>
                      </select>
                      
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required">
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
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your Account Number" type="text" required="required">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required">
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
                    	<button type="submit" name="wire_transfer" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                    
                </div>
                </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='W') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 25.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply. <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="currency_type" value="<?php echo $results['currency_type']; ?>" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled>
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
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your Account Number" type="text" disabled>
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
                      <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>                     </div>
                      
                    <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
				 <?php } ?>
			 <?php } ?>
         <?php } // Canada?>
         
         
         
         
         
         
         
 <?php 
 if($chk_loc=='Mexico') {
	 
	  if($nav=='edit_payment_info.php'){?>

<form role="form" action="" method="post">   
                  <div id="wire_transfer" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='W') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees.  <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <select class="form-control" name="currency_type" required="required">
                        <option value="">Select</option>
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']=='USD'){echo 'selected';} } else if($results['currency_type']=='USD'){echo 'selected';}?> value="USD">USD</option>
                        
                         <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{?>
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$rts['currency']){echo 'selected';} } else if($results['currency_type']==$rts['currency']){echo 'selected';}?> value="<?php echo $rts['currency']?>"><?php echo $rts['currency']?></option>
                       <?php } ?>
                      </select>
                      
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required">
                    </div>     
                    <div class="form-group col-md-6">
                      <label>CLABE <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="clabe" value="<?php if(isset($_SESSION['clabe'])){ echo $_SESSION['clabe']; } else{ echo $results['clabe'];} ?>" placeholder="Enter Your CLABE Number" type="text" required="required">
                    </div>     
                    
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required">
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
                    	<button type="submit" name="wire_transfer" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                    
                </div>
                </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='W') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees. <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="currency_type" value="<?php echo $results['currency_type']; ?>" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled>
                    </div>       
                      <div class="form-group col-md-6">
                      <label>CLABE <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="clabe" value="<?php if($nav=='edit_affiliate.php'){ echo $results['clabe'];} else {$str = $results['clabe']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your CLABE Number" type="text" disabled>
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
                      <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>                     </div>
                      
                    <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
				 <?php } ?>
			 <?php } ?>
         <?php } // Mexico?>
         
         
     
         
         
         
         
         
         
<?php //iban
if($wire_type=='iban') {
	 if($nav=='edit_payment_info.php'){?>

<form role="form" action="" method="post">   
                  <div id="wire_transfer" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='W') { echo 'style="display:none"';}?>>
                  <p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.   <br /> <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                    
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;                     
                     <?php if($cur_info!='USD') { ?>  
                     <select id="cur_info" class="form-control" name="currency_type" required="required">
                        <option value="">Select</option>
                        
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']=='USD'){echo 'selected';} } else if($results['currency_type']=='USD'){echo 'selected';}?> value="USD">USD</option>
                        
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$cur_info){echo 'selected';} } else if($results['currency_type']==$cur_info){echo 'selected';}?> value="<?php echo $cur_info?>"><?php echo $cur_info?></option>
                        <?php if($cur_info2!=''){ ?>
                          <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$cur_info2){echo 'selected';} } else if($results['currency_type']==$cur_info2){echo 'selected';}?> value="<?php echo $cur_info2?>"><?php echo $cur_info2?></option>
                          <?php } ?>
                      </select>
                    <?php }  else {  $cur_info='';?>
                    
                     <input class="form-control" name="currency_type" value="USD" disabled>
                     <?php } if($cur_info!='USD' and $cur_info!='EUR' and $cur_info!='BHD' and $cur_info!='CZK' and $cur_info!='DKK' and $cur_info!='HUF' and $cur_info!='GBP' and $cur_info!='JOD' and $cur_info!='KWD' and $cur_info!='CHF' and $cur_info!='QAR' and $cur_info!='SAR'and $cur_info!='TRY' and $cur_info!='AED' and $cur_info!='ILS'   ){ ?>
                     <div id="added_info" class="col-md-12" style="display:none"><p>Payments in <?php echo $cur_info;?> are available only above USD 1000 (equivalent in <?php echo $cur_info; ?>).</p> </div>
                     <?php } ?>
                      
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required">
                    </div>          
                    <div class="form-group col-md-6">
                      <label>IBAN <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your IBAN Number" type="text" required="required">
                    </div>
                   <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required">
                    </div>
                   
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php if(isset($_SESSION['bank_name'])){ echo $_SESSION['bank_name']; } else{ echo $results['bank_name'];} ?>" placeholder="Enter Your Bank Name" type="text" required="required">
                    </div>
                   <?php if($chk_loc=='Azerbaijan') {?>
                    <div class="form-group col-md-6">
                      <label>Tax ID <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Tax ID" type="text" required="required">
                    </div>
                    <?php } else if($chk_loc=='Kazakhstan') {?>
                     <div class="form-group col-md-6">
                      <label>IIN , BIN <span class="red-star">*</span></label> &nbsp; &nbsp;
                        <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Passport or Local Id of the Person or the Company" type="text" required="required" >
                    </div>
                    <?php } else if($chk_loc=='Costa Rica') {?>
                    <div class="form-group col-md-6">
                      <label>Beneficiary ID <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Beneficiary ID" type="text" required="required">
                    </div>
                    <?php } else { ?>
                    <div class="form-group col-md-6">
                      <label>Bank Branch Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Bank Branch Name" type="text" required="required">
                    </div>
                     <?php }  ?>
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <textarea class="form-control" name="bank_address" required="required"><?php if(isset($_SESSION['bank_address'])){ echo $_SESSION['bank_address']; } else{ echo $results['bank_address'];} ?></textarea>
                      
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                  
                    	<div class="box-footer col-md-12">
                    	<button type="submit" name="wire_transfer" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                    
                </div>
                </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='W') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.<br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                       <input class="form-control" name="currency_type" value="<?php if($results['currency_type']!=''){echo $results['currency_type'];} else { echo 'USD';} ?>" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled>
                    </div>          
                    <div class="form-group col-md-6">
                      <label>IBAN <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your IBAN Number" type="text" disabled>
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php echo $results['swift_code']; ?>" placeholder="Enter Your SWIFT" type="text" disabled>
                    </div>
                   
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php echo $results['bank_name']; ?>" placeholder="Enter Your Bank Name" type="text" disabled>
                    </div>
                    <?php if($chk_loc=='Azerbaijan') {?>
                    <div class="form-group col-md-6">
                      <label>Tax ID <span class="red-star">*</span></label> &nbsp; &nbsp;
                        <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your Tax ID" type="text" disabled>
                    </div>
                     <?php } else if($chk_loc=='Kazakhstan') {?>
                     <div class="form-group col-md-6">
                      <label>IIN , BIN <span class="red-star">*</span></label> &nbsp; &nbsp;
                        <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Passport or Local Id of the Person or the Company" type="text" disabled>
                    </div>
                     <?php } else if($chk_loc=='Costa Rica') {?>
                     <div class="form-group col-md-6">
                      <label>Beneficiary ID <span class="red-star">*</span></label> &nbsp; &nbsp;
                        <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your Beneficiary ID" type="text" disabled>
                    </div>
                    <?php } else { ?>
                    
                    <div class="form-group col-md-6">
                      <label>Bank Branch Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your Bank Branch Name" type="text" disabled>
                    </div>
                      <?php }?>
                      
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                     
				 <?php }?>
			 <?php } ?>
		<?php } // End of Aland ?>
        
        
        
        
        
        
        
<?php //account,swift,branch

if($wire_type=='swift') {
	 if($nav=='edit_payment_info.php'){?>

<form role="form" action="" method="post">   
                  <div id="wire_transfer" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='W') { echo 'style="display:none"';}?>>
                  <p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.   <br /> <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;                     
                    <?php if($cur_info!='USD') { ?>  
                     <select id="cur_info" class="form-control" name="currency_type" required="required">
                        <option value="">Select</option>
                        
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']=='USD'){echo 'selected';} } else if($results['currency_type']=='USD'){echo 'selected';}?> value="USD">USD</option>
                        
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$cur_info){echo 'selected';} } else if($results['currency_type']==$cur_info){echo 'selected';}?> value="<?php echo $cur_info?>"><?php echo $cur_info?></option>
                        
                         <?php if($cur_info2!=''){ ?>
                          <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$cur_info2){echo 'selected';} } else if($results['currency_type']==$cur_info2){echo 'selected';}?> value="<?php echo $cur_info2?>"><?php echo $cur_info2?></option>
                          <?php } ?>
                          
                      </select>
                    <?php }  else {  $cur_info='';?>
                     <input class="form-control" name="currency_type" value="USD" disabled>
                     <?php } if($cur_info!='USD' and $cur_info!='EUR' and $cur_info!='NOK' and $cur_info!='AUD' and $cur_info!='FJD' and $cur_info!='GBP' and $cur_info!='HKD' and $cur_info!='JPY' and $cur_info!='MAD' and $cur_info!='PGK'  and $chk_loc!='Philippines' and $cur_info!='NZD' and $cur_info!='ZAR' and $cur_info!='XPF' and $cur_info!='TWD' and $cur_info!='THB'){ ?>
                     <div id="added_info" class="col-md-12" style="display:none"><p>Payments in <?php echo $cur_info;?> are available only above USD 1000 (equivalent in <?php echo $cur_info; ?>).</p> </div>
                     <?php } ?>
                      
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required">
                    </div>   
                     <?php if($chk_loc=='Mozambique'){ ?>       
                    <div class="form-group col-md-6">
                      <label>NIB <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your NIB Number" type="text" required="required">
                    </div>
                    <?php } else { ?>
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your Account Number" type="text" required="required">
                    </div>
                    <?php } ?>
                   <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required">
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php if(isset($_SESSION['bank_name'])){ echo $_SESSION['bank_name']; } else{ echo $results['bank_name'];} ?>" placeholder="Enter Your Bank Name" type="text" required="required">
                    </div>
                    
                   <?php if($chk_loc=='Bangladesh' or $chk_loc=='South Korea'){ ?>
                   <div class="form-group col-md-6">
                      <label>Beneficiary ID <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Beneficiary ID" type="text" required="required">
                    </div>
                   <?php } else if($chk_loc=='Cameroon') { ?>
                   <div class="form-group col-md-6">
                      <label>RIB <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your RIB" type="text" required="required">
                    </div>
                    <?php } else if($chk_loc=='Chile') { ?>
                   <div class="form-group col-md-6">
                      <label>RUT  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your RUT" type="text" required="required">
                    </div>
                     <?php } else if($chk_loc=='Colombia' or $chk_loc=='Peru') { ?>
                   <div class="form-group col-md-6">
                      <label>Tax ID  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Tax ID" type="text" required="required">
                    </div>
                     <?php } else if($chk_loc=='Dominican Republic') { ?>
                   <div class="form-group col-md-6">
                      <label>National ID Number  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your National ID Number" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Account Type  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <select class="form-control" name="account_type" required="required" >
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='C'){echo 'selected';} } else if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='S'){echo 'selected';} } else if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        </select>
                    </div>
                    <?php } else if($chk_loc=='Russia') { ?>
                   <div class="form-group col-md-6">
                      <label>BIK code  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch']; } ?>" placeholder="Enter Your BIK code" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Correspondent Account  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_type"   value="<?php if(isset($_SESSION['account_type'])){ echo $_SESSION['account_type']; } else{  echo $results['account_type']; }?>" placeholder="Enter Your Correspondent Account" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>INN,KPP  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no"   value="<?php if(isset($_SESSION['routing_no'])){ echo $_SESSION['routing_no']; } else{ echo $results['routing_no']; }?>" placeholder="Enter Your INN,KPP" type="text" required="required">
                    </div>
                     <?php } else if($chk_loc=='Ukraine') { ?>
                   <div class="form-group col-md-6">
                      <label>Bank Code  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch']; } ?>" placeholder="Enter Your Bank Code" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>National ID Number  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_type"   value="<?php if(isset($_SESSION['account_type'])){ echo $_SESSION['account_type']; } else{  echo $results['account_type']; }?>" placeholder="Enter Your National ID Number" type="text" required="required">
                    </div>
                     <div class="form-group col-md-6">
                      <label>Tax ID  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no"   value="<?php if(isset($_SESSION['routing_no'])){ echo $_SESSION['routing_no']; } else{ echo $results['routing_no']; }?>" placeholder="Enter Your Tax ID" type="text" required="required">
                    </div>
                    <?php } else if($chk_loc=='New Zealand') { ?>
                    <div class="form-group col-md-6">
                      <label>Bank Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Bank Code" type="text" required="required">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Branch Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_type"   value="<?php if(isset($_SESSION['account_type'])){ echo $_SESSION['account_type']; } else{ echo $results['account_type'];} ?>" placeholder="Enter Your Branch Code" type="text" required="required">
                    </div>
                    <?php } else if($chk_loc=='Paraguay') { ?>
                    <div class="form-group col-md-6">
                      <label>National ID Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your National ID Number" type="text" >
                    </div>
                   <?php } else { ?>
                    <div class="form-group col-md-6">
                      <label>Bank Branch Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Bank Branch Name" type="text" required="required">
                    </div>
                    <?php } ?>
                     <?php if($chk_loc=='Jamaica') { ?>
                     <div class="form-group col-md-6">
                      <label>Account Type  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <select class="form-control" name="account_type" required="required">
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='C'){echo 'selected';} } else if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php if(isset($_SESSION['account_type'])){ if($_SESSION['account_type']=='S'){echo 'selected';} } else if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        </select>
                    </div>
                     <?php } ?>
                    
                   
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <textarea class="form-control" name="bank_address" required="required"><?php if(isset($_SESSION['bank_address'])){ echo $_SESSION['bank_address']; } else{ echo $results['bank_address'];} ?></textarea>
                      
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                  
                    	<div class="box-footer col-md-12">
                    	<button type="submit" name="wire_transfer" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                    
                </div>
                </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='W') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply. <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                       <input class="form-control" name="currency_type" value="<?php if($results['currency_type']!=''){echo $results['currency_type'];} else { echo 'USD';} ?>" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled>
                    </div>  
                     <?php if($chk_loc=='Mozambique'){ ?>       
                    <div class="form-group col-md-6">
                      <label>NIB <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your NIB Number" type="text" disabled>
                    </div>
                    <?php } else { ?>        
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your Account Number" type="text" disabled>
                    </div>
                    <?php }?>    
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php echo $results['swift_code']; ?>" placeholder="Enter Your SWIFT" type="text" disabled>
                    </div>
                   
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php echo $results['bank_name']; ?>" placeholder="Enter Your Bank Name" type="text" disabled>
                    </div>
                    <?php if($chk_loc=='Bangladesh'){ ?>
                     <div class="form-group col-md-6">
                      <label>Beneficiary ID <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your Beneficiary ID" type="text" disabled>
                    </div>
                     <?php } else if($chk_loc=='Cameroon') { ?>
                   <div class="form-group col-md-6">
                      <label>RIB <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch'];?>" placeholder="Enter Your RIB" type="text" disabled>
                    </div>
                    <?php } else if($chk_loc=='Chile') { ?>
                   <div class="form-group col-md-6">
                      <label>RUT  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your RUT" type="text" disabled>
                    </div>
                     <?php } else if($chk_loc=='Colombia' or $chk_loc=='Peru') { ?>
                   <div class="form-group col-md-6">
                      <label>Tax ID  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php if(isset($_SESSION['bank_branch'])){ echo $_SESSION['bank_branch']; } else{ echo $results['bank_branch'];} ?>" placeholder="Enter Your Tax ID" type="text" disabled>
                    </div>
                     <?php } else if($chk_loc=='Dominican Republic') { ?>
                   <div class="form-group col-md-6">
                      <label>National ID Number  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your National ID Number" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Account Type  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <select class="form-control" name="account_type" disabled>
                        <option value="">Select</option>
                        <option <?php if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        </select>
                    </div>
                     <?php } else if($chk_loc=='Russia') { ?>
                   <div class="form-group col-md-6">
                      <label>BIK code  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your BIK code" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Correspondent Account  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_type"   value="<?php echo $results['account_type']; ?>" placeholder="Enter Your Correspondent Account" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>INN,KPP  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no"   value="<?php echo $results['routing_no']; ?>" placeholder="Enter Your INN,KPP" type="text" disabled>
                    </div>
                    <?php } else if($chk_loc=='Ukraine') { ?>
                    <div class="form-group col-md-6">
                      <label>Bank Code  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your Bank Code" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>National ID Number  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_type"   value="<?php echo $results['account_type']; ?>" placeholder="Enter Your National ID Number" type="text" disabled>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Tax ID  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="routing_no"   value="<?php echo $results['routing_no']; ?>" placeholder="Enter Your Tax ID" type="text" disabled>
                    </div>
                    <?php } else if($chk_loc=='New Zealand') { ?>
                    <div class="form-group col-md-6">
                      <label>Bank Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your Bank Code" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Branch Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_type"   value="<?php echo $results['account_type']; ?>" placeholder="Enter Your Branch Code" type="text" disabled>
                    </div>
                     <?php } else if($chk_loc=='Paraguay') { ?>
                    <div class="form-group col-md-6">
                      <label>National ID Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your National ID Number" type="text" disabled>
                    </div>
                    <?php } else { ?>
                    <div class="form-group col-md-6">
                      <label>Bank Branch Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_branch"   value="<?php echo $results['bank_branch']; ?>" placeholder="Enter Your Bank Branch Name" type="text" disabled>
                    </div>
                     <?php } ?>
                     
                      <?php if($chk_loc=='Jamaica') { ?>
                     <div class="form-group col-md-6">
                      <label>Account Type  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <select class="form-control" name="account_type" disabled>
                        <option value="">Select</option>
                        <option <?php if($results['account_type']=='C'){echo 'selected';}?> value="C">Checking</option>
                        <option <?php if($results['account_type']=='S'){echo 'selected';}?> value="S">Savings</option>
                        </select>
                    </div>
                     <?php } ?>
                     
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                     
				 <?php }?>
			 <?php } ?>
		<?php } // End of Algeria ?>
        
        
        
        
        
        
        
        
 <?php 
 if($chk_loc=='Argentina' or $chk_loc=='Australia') {
	 
	  if($nav=='edit_payment_info.php'){?>

<form role="form" action="" method="post">   
                  <div id="wire_transfer" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='W') { echo 'style="display:none"';}?>>
                     <p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees   <br /> <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <?php if($chk_loc=='Argentina' or $chk_loc=='Australia') { ?>  
                     <select id="cur_info" class="form-control" name="currency_type" required="required">
                        <option value="">Select</option>
                        
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']=='USD'){echo 'selected';} } else if($results['currency_type']=='USD'){echo 'selected';}?> value="USD">USD</option>
                         <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{$cur_info= $rts['currency'];?>
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$rts['currency']){echo 'selected';} } else if($results['currency_type']==$rts['currency']){echo 'selected';}?> value="<?php echo $rts['currency']?>"><?php echo $rts['currency']?></option>
                       <?php } ?>
                      </select>
                    <?php }  else { $cur_info='';?>
                     <input class="form-control" name="currency_type" value="USD" disabled>
                     <?php } if($cur_info!='USD' and $cur_info!='EUR'  and $cur_info!='AUD'){ ?>
                     <div id="added_info" class="col-md-12" style="display:none"><p>Payments in <?php echo $cur_info;?> are available only above USD 1000 (equivalent in <?php echo $cur_info; ?>).</p> </div>
                     <?php } ?>
                      
                    </div>
                      
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required">
                    </div> 
                    
                    <?php if($chk_loc=='Argentina'){?>    
                    <div class="form-group col-md-6">
                      <label>CBU <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no" value="<?php if(isset($_SESSION['insti_no'])){ echo $_SESSION['insti_no']; } else{ echo $results['insti_no'];} ?>" placeholder="Enter Your CBU Number" type="text" required="required">
                    </div>     
                   
                    <div class="form-group col-md-6">
                      <label>CUIT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your CUIT Number" type="text" required="required">
                    </div>
                    <?php } ?>
                    <?php if($chk_loc=='Australia'){?>    
                    <div class="form-group col-md-6">
                      <label>BSB Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no" value="<?php if(isset($_SESSION['insti_no'])){ echo $_SESSION['insti_no']; } else{ echo $results['insti_no'];} ?>" placeholder="Enter Your BSB Code" type="text" required="required">
                    </div>     
                   
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your Account Number" type="text" required="required">
                    </div>
                    <?php } ?>
                    <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required">
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
                    	<button type="submit" name="wire_transfer" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                    
                </div>
                </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='W') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="currency_type" value="<?php echo $results['currency_type']; ?>" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled>
                    </div> 
                    <?php if($chk_loc=='Argentina'){?>         
                     <div class="form-group col-md-6">
                      <label>CBU  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['insti_no'];} else {$str = $results['insti_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your CBU Number" type="text" disabled>
                    </div>
                     
                    <div class="form-group col-md-6">
                      <label>CUIT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your CUIT Number" type="text" disabled>
                    </div>
                    <?php } ?>
                     <?php if($chk_loc=='Australia'){?>         
                     <div class="form-group col-md-6">
                      <label>BSB Code  <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="insti_no"   value="<?php echo $results['insti_no']; ?>" placeholder="Enter Your BSB Code" type="text" disabled>
                    </div>
                     
                    <div class="form-group col-md-6">
                      <label>Account Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your Account Number" type="text" disabled>
                    </div>
                    <?php } ?>
                    
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
                      <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>                     </div>
                      
                    <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                    
				 <?php } ?>
			 <?php } ?>
         <?php } // Argentina?>
         
         
<?php
if($chk_loc=='Brazil') {
	 if($nav=='edit_payment_info.php'){?>

<form role="form" action="" method="post">   
                  <div id="wire_transfer" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='W'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='W') { echo 'style="display:none"';}?>>
                  <p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply.   <br /> <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                    
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency <span class="red-star">*</span></label> &nbsp; &nbsp;                     
                    <?php if($chk_loc=='Brazil') { ?>  
                     <select id="cur_info" class="form-control" name="currency_type" required="required">
                        <option value="">Select</option>
                        
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']=='USD'){echo 'selected';} } else if($results['currency_type']=='USD'){echo 'selected';}?> value="USD">USD</option>
                         <?php    
						$cdata = mysql_query("SELECT * FROM countrydata where country='{$results['post_country']}'") or die(mysql_error()); 
						while($rts = mysql_fetch_array($cdata))
						{$cur_info= $rts['currency'];?>
                        <option  <?php if(isset($_SESSION['currency_type'])){ if($_SESSION['currency_type']==$rts['currency']){echo 'selected';} } else if($results['currency_type']==$rts['currency']){echo 'selected';}?> value="<?php echo $rts['currency']?>"><?php echo $rts['currency']?></option>
                       <?php } ?>
                      </select>
                    <?php }  else { $cur_info='';?>
                     <input class="form-control" name="currency_type" value="USD" disabled>
                     <?php } if($cur_info!='USD' and $cur_info!='EUR'){ ?>
                     <div id="added_info" class="col-md-12" style="display:none"><p>Payments in <?php echo $cur_info;?> are available only above USD 1000 (equivalent in <?php echo $cur_info; ?>).</p> </div>
                     <?php } ?>
                      
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php if(isset($_SESSION['account_name'])){ echo $_SESSION['account_name']; } else{ echo $results['account_name'];} ?>" placeholder="Enter Your Name on Account" type="text" required="required">
                    </div>          
                    <div class="form-group col-md-6">
                      <label>IBAN <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if(isset($_SESSION['account_no'])){ echo $_SESSION['account_no']; } else{ echo $results['account_no'];} ?>" placeholder="Enter Your IBAN Number" type="text" required="required">
                    </div>
                   <div class="form-group col-md-6">
                      <label>SWIFT <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="swift_code"   value="<?php if(isset($_SESSION['swift_code'])){ echo $_SESSION['swift_code']; } else{ echo $results['swift_code'];} ?>" placeholder="Enter Your SWIFT" type="text" required="required">
                    </div>
                   
                     <div class="form-group col-md-6">
                      <label>Bank Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_name"   value="<?php if(isset($_SESSION['bank_name'])){ echo $_SESSION['bank_name']; } else{ echo $results['bank_name'];} ?>" placeholder="Enter Your Bank Name" type="text" required="required">
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label>CNPJ / CPF <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_code"   value="<?php if(isset($_SESSION['bank_code'])){ echo $_SESSION['bank_code']; } else{ echo $results['bank_code'];} ?>" placeholder="Enter CNPJ / CPF" type="text" required="required">
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label>Agency Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="branch_code"   value="<?php if(isset($_SESSION['branch_code'])){ echo $_SESSION['branch_code']; } else{ echo $results['branch_code'];} ?>" placeholder="Enter Your Agency Code" type="text" required="required">
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
                    	<button type="submit" name="wire_transfer" class="btn btn-primary">Update Payment Info</button> 
                 		 </div>
                    
                </div>
                </form>
             <?php } ?>
			 
             <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
  			
            	<?php if($results['payment_method']=='W') { ?>
                
                		<p class="col-md-12">Payment method minimum threshold: USD 50.00. No transaction fees. Below USD 5000: 2.5%, Over USD 5000: 1.9% Currency conversion fee may apply. <br />  <b>PLEASE NOTE: (If and only) When an expense (third party fees) relating to a payment method of receiving your commission apply, will be subtracted from your balance.</b></p>
                     
                     <div class="form-group col-md-6">
                      <label>Payment Currency:</label> &nbsp; &nbsp;
                       <input class="form-control" name="currency_type" value="<?php if($results['currency_type']!=''){echo $results['currency_type'];} else { echo 'USD';} ?>" disabled>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Name on Account <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_name"   value="<?php echo $results['account_name']; ?>" placeholder="Enter Your Name on Account" type="text" disabled>
                    </div>          
                    <div class="form-group col-md-6">
                      <label>IBAN <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="account_no"   value="<?php if($nav=='edit_affiliate.php'){ echo $results['account_no'];} else {$str = $results['account_no']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;} for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} ?>" placeholder="Enter Your IBAN Number" type="text" disabled>
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
                      <label>CNPJ / CPF <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="bank_code"   value="<?php echo $results['bank_code']; ?>" placeholder="Enter CNPJ / CPF" type="text" disabled>
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label>Agency Code <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="branch_code"   value="<?php echo $results['branch_code'];?>" placeholder="Enter Your Agency Code" type="text" disabled>
                    </div>
                      
                     <div class="form-group col-md-6">
                      <label>Bank Address <span class="red-star">*</span></label> &nbsp; &nbsp;
                      <textarea class="form-control" name="bank_address" disabled><?php echo $results['bank_address']; ?></textarea>
                    </div>
                    
                     <div class="form-group col-md-6">
                      <label>Country <span class="red-star">*</span> </label> &nbsp; &nbsp;
                       <input class="form-control" name="post_country"   value="<?php echo $results['post_country'] ?>" placeholder="Enter Your Country" type="text" disabled="disabled">
                     </div>
                     
				 <?php }?>
			 <?php } ?>
		<?php } // End of Brazil ?>
		