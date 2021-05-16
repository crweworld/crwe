		 <?php if($nav=='edit_payment_info.php'){?>
         	
             <form role="form" action="" method="post">  
                 <div id="hold_my_payments" <?php if(isset($_SESSION['payment_method'])){ if($_SESSION['payment_method']=='H'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['payment_method']!='H') { echo 'style="display:none"';}?>>
                 
                 	<p class="col-md-12">When this option is selected, payments will not be executed.<br>When you select a different, valid, payment method, your payments will be released.</p>
                    
                     <div class="box-footer col-md-12">
                    	<button type="submit" name="hold_my_payments" class="btn btn-primary">Update Payment Info</button> 
                 	 </div>    
                 </div>
                 </form>                   
		<?php } ?>
		
          <?php if($nav=='payment_info.php' or $nav=='edit_affiliate.php' ){?>
         	
            <?php if($results['payment_method']=='H') { ?>
            <p class="col-md-12">When this option is selected, payments will not be executed.<br>When you select a different, valid, payment method, your payments will be released.</p>
		 		  <?php } ?>
                  
         <?php } ?>