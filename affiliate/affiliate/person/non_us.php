		<?php if($nav=='edit_tax_form.php'){?>
        
        <form role="form" action="" method="post">  
                 <div id="non_us" <?php if(isset($_SESSION['person'])){ if($_SESSION['person']=='N'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['person']!='N') { echo 'style="display:none"';}?>>
                 
                    <b class="col-md-12">This page is intended for payees who declare that they are not a "US person" as per IRS definitions.<br>
                    <i>Please fill in the information in this form and click the Update Tax Info button.</i><br><br>
                    <strong>Statement:</strong><br><br>
                    <?php echo $results['fname']; ?> is an Individual or Corporation inside the boundaries of <?php echo $results['post_country']; ?> with principal place of business at <?php echo $results['post_country'] ?>, at: <br><br>
                    <input class="form-control" name="non_address" value="<?php if(isset($_SESSION['non_address'])){ echo $_SESSION['non_address']; } else{ echo $results['non_address'];} ?>" placeholder="Enter Your Address (street, house number and city)" required > <br> <br>
                    <?php echo $results['fname']; ?> states that he/she/it has no United States activities including, but not limited to, owning a web server/hosting service in the United States, or having employees in the United States providing services that are involved in generating revenue in connection with CRWEWORLD.<br>
                    <br><br>
                    I hereby confirm that this statement is truthful:<br><br>
                    <input class="form-control" name="non_name" value="<?php if(isset($_SESSION['non_name'])){ echo $_SESSION['non_name']; } else{ echo $results['non_name'];} ?>" placeholder="Enter Your Name (<?php echo $results['fname']; ?>)"  required>
                    </b>
                   
                    
                    	<div class="box-footer col-md-12">
                    		<button type="submit" name="non_us" class="btn btn-primary">Update Tax Info</button> 
                 		 </div>
                         
                 </div>
                 </form>
		<?php } ?>
		
        
         <?php if($nav=='tax_form.php' or $nav=='edit_affiliate.php' ){?>
         	
            <?php if($results['person']=='N') { ?>
            
            <b class="col-md-12">This page is intended for payees who declare that they are not a "US person" as per IRS definitions.<br>
                   
                    <strong>Statement:</strong><br><br>
                    <?php echo $results['fname']; ?> is an Individual or Corporation inside the boundaries of <?php echo $results['post_country']; ?> with principal place of business at <?php echo $results['post_country'] ?>, at: <br><br>
                    <input class="form-control" name="non_address" value="<?php echo $results['non_address']; ?>" placeholder="Enter Your Address (street, house number and city)" disabled="disabled" > <br> <br>
                    <?php echo $results['fname']; ?> states that he/she/it has no United States activities including, but not limited to, owning a web server/hosting service in the United States, or having employees in the United States providing services that are involved in generating revenue in connection with CRWEWORLD.<br>
                    <br><br>
                    I hereby confirm that this statement is truthful:<br><br>
                    <input class="form-control" name="non_name" value="<?php echo $results['non_name']; ?>" placeholder="Enter Your Name (<?php echo $results['fname']; ?>)"  disabled="disabled">
                    </b>
                    
		 		  <?php } ?>
                  
         <?php } ?>