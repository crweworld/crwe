		<?php if($nav=='edit_tax_form.php'){?>
        
        <script type='text/javascript'>//<![CDATA[
	
	function showDiv(elem){
   if(elem.value == 'L')
   {
      document.getElementById('us_lim').style.display = "block";
	  document.getElementById('us_other').style.display = "none";
   }
   else  if(elem.value == 'O')
   {
      document.getElementById('us_other').style.display = "block";
	  document.getElementById('us_lim').style.display = "none";
   }
   else
	{
		document.getElementById('us_lim').style.display = "none";
		document.getElementById('us_other').style.display = "none";
	}
   
}
	//]]> 

</script>

        <form role="form" action="" method="post">
                 <div id="us_person" <?php if(isset($_SESSION['person'])){ if($_SESSION['person']=='U'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['person']!='U') { echo 'style="display:none"';}?>>
                 	<b class="col-md-12">
                    	<h4 style="font-weight:bold" class="col-md-4">Substitute Form W9</h4>
                        <h4 style="font-weight:bold" class="col-md-4">Request for Taxpayer Identification Number and Certification</h4>
                        <h4 style="font-weight:bold" class="col-md-4">Rev Dec-14</h4>
                        
                    <div class="col-md-12 box box-primary"></div>
                    
                    <div class="form-group col-md-6">
                      <label>Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_name"   value="<?php if(isset($_SESSION['us_name'])){ echo $_SESSION['us_name']; } else{ echo $results['us_name'];} ?>" placeholder="Enter Your Name (as shown on your income tax return)" type="text" required>
                    </div> 
                    
                    <div class="form-group col-md-6">
                      <label>Business name/disregarded entity name, if different from above </label> &nbsp; &nbsp;
                       <input class="form-control" name="us_bname"   value="<?php if(isset($_SESSION['us_bname'])){ echo $_SESSION['us_bname']; } else{ echo $results['us_bname'];} ?>" placeholder="Enter Your Business name/disregarded entity name, if different from above" type="text">
                    </div> 
					
                    <div class="col-md-12 box box-primary"></div>
                    
                     <div class="form-group col-md-6">
                      <label>Business Type (Select appropriate option)<span class="red-star">*</span></label> &nbsp; &nbsp;
                      	<select class="form-control" name="us_type" onchange="showDiv(this)" required>
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='I'){echo 'selected';} } else if($results['us_type']=='I'){echo 'selected';}?> value="I" >Individual/sole proprietor or single-member LLC</option>
                        <option <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='C'){echo 'selected';} } else if($results['us_type']=='C'){echo 'selected';}?> value="C" >C Corporation</option>
                        <option <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='S'){echo 'selected';} } else if($results['us_type']=='S'){echo 'selected';}?> value="S" >S Corporation</option>
                        <option <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='P'){echo 'selected';} } else if($results['us_type']=='P'){echo 'selected';}?> value="P" >Partnership</option>
                        <option <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='T'){echo 'selected';} } else if($results['us_type']=='T'){echo 'selected';}?> value="T" >Trust/estate</option>
                        <option <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='L'){echo 'selected';} } else if($results['us_type']=='L'){echo 'selected';}?> value="L" >Limited liability company</option>
                        <option <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='O'){echo 'selected';} } else if($results['us_type']=='O'){echo 'selected';}?> value="O" >Other</option>
                                            
                        </select>
                   </div>
                     <div class="col-md-6" id="us_lim" <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='L'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['us_type']!='L') { echo 'style="display:none"';} ?>>
                     <label>Enter the tax classification: <span class="red-star">*</span></label> &nbsp; &nbsp;
                     <select class="form-control" name="us_lim">
                     	<option value="">Select</option>
                        <option <?php if(isset($_SESSION['us_lim'])){ if($_SESSION['us_lim']=='S'){echo 'selected';} } else if($results['us_lim']=='S'){echo 'selected';}?> value="S">S Corporation</option>
                        <option <?php if(isset($_SESSION['us_lim'])){ if($_SESSION['us_lim']=='P'){echo 'selected';} } else if($results['us_lim']=='P'){echo 'selected';}?> value="P">Partnership</option>
                        <option <?php if(isset($_SESSION['us_lim'])){ if($_SESSION['us_lim']=='C'){echo 'selected';} } else if($results['us_lim']=='C'){echo 'selected';}?> value="C">C Corporation</option>                        
                     </select> 
                     </div>
                     
                     <div class="col-md-12">Note. For a single-member LLC that is disregarded, do not select LLC; select the appropriate box in the line above for the tax classification of the single-member owner &nbsp; &nbsp;</div>
                     
                     <div class="col-md-6" id="us_other" <?php if(isset($_SESSION['us_type'])){ if($_SESSION['us_type']=='O'){echo 'style="display:block"';}else{echo 'style="display:none"';} } else if($results['us_type']!='O') { echo 'style="display:none"';} ?>>
                     Other
                      <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">(see instructions)</a> &nbsp; &nbsp; 
                      <input class="form-control" type="text" value="<?php if(isset($_SESSION['us_other'])){ echo $_SESSION['us_other']; } else{ echo $results['us_other'];} ?>" name="us_other" >
                     </div>
                     
                   <span class="h4 col-md-12"> <br>Exemptions (codes apply only to certain entities, not individuals)</span> 
                   <div class="form-group col-md-6">
                      <label>Exempt payee code (if any) </label> &nbsp; &nbsp;
                      	<select class="form-control" name="us_paycode">
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='1'){echo 'selected';} } else if($results['us_paycode']=='1'){echo 'selected';}?> value="1" >1</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='2'){echo 'selected';} } else if($results['us_paycode']=='2'){echo 'selected';}?> value="2" >2</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='3'){echo 'selected';} } else if($results['us_paycode']=='3'){echo 'selected';}?> value="3" >3</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='4'){echo 'selected';} } else if($results['us_paycode']=='4'){echo 'selected';}?> value="4" >4</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='5'){echo 'selected';} } else if($results['us_paycode']=='5'){echo 'selected';}?> value="5" >5</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='6'){echo 'selected';} } else if($results['us_paycode']=='6'){echo 'selected';}?> value="6" >6</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='7'){echo 'selected';} } else if($results['us_paycode']=='7'){echo 'selected';}?> value="7" >7</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='8'){echo 'selected';} } else if($results['us_paycode']=='8'){echo 'selected';}?> value="8" >8</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='9'){echo 'selected';} } else if($results['us_paycode']=='9'){echo 'selected';}?> value="9" >9</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='10'){echo 'selected';} } else if($results['us_paycode']=='10'){echo 'selected';}?> value="10" >10</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='11'){echo 'selected';} } else if($results['us_paycode']=='11'){echo 'selected';}?> value="11" >11</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='12'){echo 'selected';} } else if($results['us_paycode']=='12'){echo 'selected';}?> value="12" >12</option>
                        <option <?php if(isset($_SESSION['us_paycode'])){ if($_SESSION['us_paycode']=='13'){echo 'selected';} } else if($results['us_paycode']=='13'){echo 'selected';}?> value="13" >13</option>                        
                        </select>
                   </div>
                  
                    <div class="form-group col-md-6">
                      <label>Exemption from FATCA reporting code (if any) </label> &nbsp; &nbsp;
                      	<select class="form-control" name="us_fat" >
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='A'){echo 'selected';} } else if($results['us_fat']=='A'){echo 'selected';}?> value="A" >A</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='B'){echo 'selected';} } else if($results['us_fat']=='B'){echo 'selected';}?> value="B" >B</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='C'){echo 'selected';} } else if($results['us_fat']=='C'){echo 'selected';}?> value="C" >C</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='D'){echo 'selected';} } else if($results['us_fat']=='D'){echo 'selected';}?> value="D" >D</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='E'){echo 'selected';} } else if($results['us_fat']=='E'){echo 'selected';}?> value="E" >E</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='F'){echo 'selected';} } else if($results['us_fat']=='F'){echo 'selected';}?> value="F" >F</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='G'){echo 'selected';} } else if($results['us_fat']=='G'){echo 'selected';}?> value="G" >G</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='H'){echo 'selected';} } else if($results['us_fat']=='H'){echo 'selected';}?> value="H" >H</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='I'){echo 'selected';} } else if($results['us_fat']=='I'){echo 'selected';}?> value="I" >I</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='J'){echo 'selected';} } else if($results['us_fat']=='J'){echo 'selected';}?> value="J">J</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='K'){echo 'selected';} } else if($results['us_fat']=='K'){echo 'selected';}?> value="K">K</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='L'){echo 'selected';} } else if($results['us_fat']=='L'){echo 'selected';}?> value="L">L</option>
                        <option <?php if(isset($_SESSION['us_fat'])){ if($_SESSION['us_fat']=='M'){echo 'selected';} } else if($results['us_fat']=='M'){echo 'selected';}?> value="M">M</option>                        
                        </select>
                   </div>
                   	<div class="col-md-12">
                     <i>(Applies to accounts maintained outside the U.S.)</i> 
                     </div>
                   <div class="col-md-12 box box-primary"></div>
                    <div class="form-group col-md-6">
                      <label>State <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_state"   value="<?php if(isset($_SESSION['us_state'])){ echo $_SESSION['us_state']; } else{ echo $results['us_state'];} ?>" placeholder="Enter Your State" type="text" required>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>City <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_city" value="<?php if(isset($_SESSION['us_city'])){ echo $_SESSION['us_city']; } else{ echo $results['us_city'];} ?>" placeholder="Enter Your City" type="text" required>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Street <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_street" value="<?php if(isset($_SESSION['us_street'])){ echo $_SESSION['us_street']; } else{ echo $results['us_street'];} ?>" placeholder="Enter Your Street" type="text" required>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Street Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_stno" value="<?php if(isset($_SESSION['us_stno'])){ echo $_SESSION['us_stno']; } else{ echo $results['us_stno'];} ?>" placeholder="Enter Your Street Number" type="text" required>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Zip <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_zip" value="<?php if(isset($_SESSION['us_zip'])){ echo $_SESSION['us_zip']; } else{ echo $results['us_zip'];} ?>" placeholder="Enter Zipcode" type="text" required>
                    </div>  
                    <div class="form-group col-md-6">
                      <label>Requester's name and address</label> &nbsp; &nbsp;
                      <textarea class="form-control" name="us_req"><?php if(isset($_SESSION['us_req'])){ echo $_SESSION['us_req']; } else{ echo $results['us_req'];} ?></textarea>
                    </div>  
                  
                  <div class="col-md-12 box box-primary"></div>
                  
                  <div class="form-group col-md-12">
                      <label>List account number(s) here</label> &nbsp; &nbsp;
                       <input class="form-control" name="us_list"   value="<?php if(isset($_SESSION['us_list'])){ echo $_SESSION['us_list']; } else{ echo $results['us_list'];} ?>" placeholder="List account number(s) here" type="text">
                    </div>  
                    
                    
                     <div class="form-group col-md-6">
                     <span class="h4 col-md-12"> <br><strong>Part I</strong> Taxpayer Identification Number (TIN)</span>
                     	Enter your TIN in the appropriate box. The TIN provided must match the name given on the &ldquo;Name&rdquo; line to avoid backup withholding. For individuals, this is your social security number (SSN). However, for a resident alien, sole proprietor, or disregarded entity, see the Part I instructions on page 3 (<a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">fw9.pdf</a>). For other entities, it is your employer identification number (EIN). If you do not have a number, see How to get a TIN on page 3 (<a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">fw9.pdf</a>). <br /><br />
<strong>Note.</strong> If the account is in more than one name, see the chart on page 4 of <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">fw9.pdf</a> for guidelines on whose number to enter.
			
            
             <div class="col-md-12 box box-primary"></div>
             
            				<div class="form-group col-md-5">
                      <label>Social security number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_ss" value="<?php if(isset($_SESSION['us_ss'])){ echo $_SESSION['us_ss']; } else{ echo $results['us_ss'];} ?>" placeholder="Enter Your SSN" type="text">
                    </div>  
                   <div class="form-group col-md-2">  OR</div>
                    
                    	<div class="form-group col-md-5">
                      <label>Employer identification number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_id" value="<?php if(isset($_SESSION['us_id'])){ echo $_SESSION['us_id']; } else{ echo $results['us_id'];} ?>" placeholder="Enter Your EIN" type="text">
                    </div>  

				
                     </div>
                     
                     <div class="form-group col-md-6">
                     <span class="h4 col-md-12"> <br><strong>Part II</strong> Certification</span>
                     <p>Under penalties of perjury, I certify that:</p>
                        <ol>
                          <li>The number shown on this form is my correct taxpayer identification number (or I am waiting for a number to be issued to me), and</li>
                          <li>I am not subject to backup withholding because: (a) I am exempt from backup withholding, or (b) I have not been notified by the Internal Revenue Service (IRS) that I am subject to backup withholding as a result of a failure to report all interest or dividends, or (c) the IRS has notified me that I am no longer subject to backup withholding, and</li>
                          <li>I am a U.S. citizen or other U.S. person (defined below), and</li>
                          <li>The FATCA code(s) entered on this form (if any) indicating that I am exempt from FATCA reporting is correct.</li>
                        </ol>
                        <p><strong>Certification instructions</strong>. If you have been notified by the IRS that you are currently subject to backup withholding because you have failed to report all interest and dividends on your tax return please please fill out this W-9 form at <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">http://www.irs.gov/pub/irs-pdf/fw9.pdf</a> or <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw8ben.pdf">http://www.irs.gov/pub/irs-pdf/fw8ben.pdf</a> and fax to (212) 813-3254, following IRS instruction relating to item 2 above.</p>
                     </div>
                  
                  
               <div class="form-group col-md-6">
                      <label>Certify by typing your name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_cert" value="<?php if(isset($_SESSION['us_cert'])){ echo $_SESSION['us_cert']; } else{ echo $results['us_cert'];} ?>" placeholder="Enter Your Name (<?php echo $results['fname']; ?>)" type="text" required>
                    </div>     
                  
                     
                     </b>
                    	<div class="box-footer">
                    		<button type="submit" name="us_person" class="btn btn-primary">Update Tax Info</button> 
                 		 </div>
                 </div>
                 
                  </form>
                <?php } ?>
		
          <?php if($nav=='tax_form.php' or $nav=='edit_affiliate.php' ){?>
         	
            <?php if($results['person']=='U') { ?>
            
            	<b class="col-md-12">
                    	<h4 style="font-weight:bold" class="col-md-4">Substitute Form W9</h4>
                        <h4 style="font-weight:bold" class="col-md-4">Request for Taxpayer Identification Number and Certification</h4>
                        <h4 style="font-weight:bold" class="col-md-4">Rev Dec-14</h4>
                        
                    <div class="col-md-12 box box-primary"></div>
                    
                    <div class="form-group col-md-6">
                      <label>Name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_name"   value="<?php echo $results['us_name']; ?>" placeholder="Enter Your Name (as shown on your income tax return)" type="text" disabled>
                    </div> 
                    
                    <div class="form-group col-md-6">
                      <label>Business name/disregarded entity name, if different from above </label> &nbsp; &nbsp;
                       <input class="form-control" name="us_bname"   value="<?php echo $results['us_bname'];?>" placeholder="Enter Your Business name/disregarded entity name, if different from above" type="text" disabled>
                    </div> 
					
                    <div class="col-md-12 box box-primary"></div>
                    
                     <div class="form-group col-md-6">
                      <label>Business Type (Select appropriate option)<span class="red-star">*</span></label> &nbsp; &nbsp;
                      	<select class="form-control" name="us_type" onchange="showDiv(this)" disabled>
                        <option value="">Select</option>
                        <option <?php if($results['us_type']=='I'){echo 'selected';}?> value="I" >Individual/sole proprietor or single-member LLC</option>
                        <option <?php if($results['us_type']=='C'){echo 'selected';}?> value="C" >C Corporation</option>
                        <option <?php if($results['us_type']=='S'){echo 'selected';}?> value="S" >S Corporation</option>
                        <option <?php if($results['us_type']=='P'){echo 'selected';}?> value="P" >Partnership</option>
                        <option <?php if($results['us_type']=='T'){echo 'selected';}?> value="T" >Trust/estate</option>
                        <option <?php if($results['us_type']=='L'){echo 'selected';}?> value="L" >Limited liability company</option>
                        <option <?php if($results['us_type']=='O'){echo 'selected';}?> value="O" >Other</option>
                                            
                        </select>
                   </div>
                     <div class="col-md-6" id="us_lim" <?php if($results['us_type']!='L') { echo 'style="display:none"';} ?>>
                     <label>Enter the tax classification: <span class="red-star">*</span></label> &nbsp; &nbsp;
                     <select class="form-control" name="us_lim" disabled>
                     	<option value="">Select</option>
                        <option <?php if($results['us_lim']=='S'){echo 'selected';}?> value="S">S Corporation</option>
                        <option <?php if($results['us_lim']=='P'){echo 'selected';}?> value="P">Partnership</option>
                        <option <?php if($results['us_lim']=='C'){echo 'selected';}?> value="C">C Corporation</option>                        
                     </select> 
                     </div>
                     
                     <div class="col-md-12">Note. For a single-member LLC that is disregarded, do not select LLC; select the appropriate box in the line above for the tax classification of the single-member owner &nbsp; &nbsp;</div>
                     
                     <div class="col-md-6" id="us_other" <?php if($results['us_type']!='O') { echo 'style="display:none"';} ?>>
                     Other
                      <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">(see instructions)</a> &nbsp; &nbsp; 
                      <input class="form-control" type="text" value="<?php echo $results['us_other']; ?>" name="us_other" disabled>
                     </div>
                     
                   <span class="h4 col-md-12"> <br>Exemptions (codes apply only to certain entities, not individuals)</span> 
                   <div class="form-group col-md-6">
                      <label>Exempt payee code (if any) </label> &nbsp; &nbsp;
                      	<select class="form-control" name="us_paycode" disabled>
                        <option value=""></option>
                        <option <?php if($results['us_paycode']=='1'){echo 'selected';}?> value="1" >1</option>
                        <option <?php if($results['us_paycode']=='2'){echo 'selected';}?> value="2" >2</option>
                        <option <?php if($results['us_paycode']=='3'){echo 'selected';}?> value="3" >3</option>
                        <option <?php if($results['us_paycode']=='4'){echo 'selected';}?> value="4" >4</option>
                        <option <?php if($results['us_paycode']=='5'){echo 'selected';}?> value="5" >5</option>
                        <option <?php if($results['us_paycode']=='6'){echo 'selected';}?> value="6" >6</option>
                        <option <?php if($results['us_paycode']=='7'){echo 'selected';}?> value="7" >7</option>
                        <option <?php if($results['us_paycode']=='8'){echo 'selected';}?> value="8" >8</option>
                        <option <?php if($results['us_paycode']=='9'){echo 'selected';}?> value="9" >9</option>
                        <option <?php if($results['us_paycode']=='10'){echo 'selected';}?> value="10" >10</option>
                        <option <?php if($results['us_paycode']=='11'){echo 'selected';}?> value="11" >11</option>
                        <option <?php if($results['us_paycode']=='12'){echo 'selected';}?> value="12" >12</option>
                        <option <?php if($results['us_paycode']=='13'){echo 'selected';}?> value="13" >13</option>                        
                        </select>
                   </div>
                  
                    <div class="form-group col-md-6">
                      <label>Exemption from FATCA reporting code (if any) </label> &nbsp; &nbsp;
                      	<select class="form-control" name="us_fat" disabled>
                        <option value=""></option>
                        <option <?php if($results['us_fat']=='A'){echo 'selected';}?> value="A" >A</option>
                        <option <?php if($results['us_fat']=='B'){echo 'selected';}?> value="B" >B</option>
                        <option <?php if($results['us_fat']=='C'){echo 'selected';}?> value="C" >C</option>
                        <option <?php if($results['us_fat']=='D'){echo 'selected';}?> value="D" >D</option>
                        <option <?php if($results['us_fat']=='E'){echo 'selected';}?> value="E" >E</option>
                        <option <?php if($results['us_fat']=='F'){echo 'selected';}?> value="F" >F</option>
                        <option <?php if($results['us_fat']=='G'){echo 'selected';}?> value="G" >G</option>
                        <option <?php if($results['us_fat']=='H'){echo 'selected';}?> value="H" >H</option>
                        <option <?php if($results['us_fat']=='I'){echo 'selected';}?> value="I" >I</option>
                        <option <?php if($results['us_fat']=='J'){echo 'selected';}?> value="J">J</option>
                        <option <?php if($results['us_fat']=='K'){echo 'selected';}?> value="K">K</option>
                        <option <?php if($results['us_fat']=='L'){echo 'selected';}?> value="L">L</option>
                        <option <?php if($results['us_fat']=='M'){echo 'selected';}?> value="M">M</option>                        
                        </select>
                   </div>
                   	<div class="col-md-12">
                     <i>(Applies to accounts maintained outside the U.S.)</i> 
                     </div>
                   <div class="col-md-12 box box-primary"></div>
                    <div class="form-group col-md-6">
                      <label>State <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_state"   value="<?php echo $results['us_state']; ?>" placeholder="Enter Your State" type="text" disabled>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>City <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_city" value="<?php echo $results['us_city'];?>" placeholder="Enter Your City" type="text" disabled>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Street <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_street" value="<?php echo $results['us_street'];?>" placeholder="Enter Your Street" type="text" disabled>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Street Number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_stno" value="<?php echo $results['us_stno']; ?>" placeholder="Enter Your Street Number" type="text" disabled>
                    </div> 
                    <div class="form-group col-md-6">
                      <label>Zip <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_zip" value="<?php echo $results['us_zip']; ?>" placeholder="Enter Zipcode" type="text" disabled>
                    </div>  
                    <div class="form-group col-md-6">
                      <label>Requester's name and address</label> &nbsp; &nbsp;
                      <textarea class="form-control" name="us_req" disabled><?php echo $results['us_req']; ?></textarea>
                    </div>  
                  
                  <div class="col-md-12 box box-primary"></div>
                  
                  <div class="form-group col-md-12">
                      <label>List account number(s) here</label> &nbsp; &nbsp;
                       <input class="form-control" name="us_list"   value="<?php echo $results['us_list']; ?>" placeholder="List account number(s) here" type="text" disabled>
                    </div>  
                    
                    
                     <div class="form-group col-md-6">
                     <span class="h4 col-md-12"> <br><strong>Part I</strong> Taxpayer Identification Number (TIN)</span>
                     	Enter your TIN in the appropriate box. The TIN provided must match the name given on the &ldquo;Name&rdquo; line to avoid backup withholding. For individuals, this is your social security number (SSN). However, for a resident alien, sole proprietor, or disregarded entity, see the Part I instructions on page 3 (<a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">fw9.pdf</a>). For other entities, it is your employer identification number (EIN). If you do not have a number, see How to get a TIN on page 3 (<a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">fw9.pdf</a>). <br /><br />
<strong>Note.</strong> If the account is in more than one name, see the chart on page 4 of <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">fw9.pdf</a> for guidelines on whose number to enter.
			
            
             <div class="col-md-12 box box-primary"></div>
             
            				<div class="form-group col-md-5">
                      <label>Social security number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_ss" value="<?php if($nav=='edit_affiliate.php'){ echo $results['us_ss'];} else { if(!empty($results['us_ss'])){$str = $results['us_ss']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;}for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} }?>" placeholder="Enter Your SSN" type="text" disabled>
                    </div>  
                   <div class="form-group col-md-2">  OR</div>
                    

                    	<div class="form-group col-md-5">
                      <label>Employer identification number <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_id" value="<?php if($nav=='edit_affiliate.php'){ echo $results['us_id'];} else {  if(!empty($results['us_id'])){$str = $results['us_id']; $len= strlen($str); $len=$len-4;if($len<=4){$len=6;}for($i=1; $i <=$len; $i++){ echo 'X'; } echo '-'.substr($str, -4);} }?>" placeholder="Enter Your EIN" type="text" disabled>
                    </div>  

				
                     </div>
                     
                     <div class="form-group col-md-6">
                     <span class="h4 col-md-12"> <br><strong>Part II</strong> Certification</span>
                     <p>Under penalties of perjury, I certify that:</p>
                        <ol>
                          <li>The number shown on this form is my correct taxpayer identification number (or I am waiting for a number to be issued to me), and</li>
                          <li>I am not subject to backup withholding because: (a) I am exempt from backup withholding, or (b) I have not been notified by the Internal Revenue Service (IRS) that I am subject to backup withholding as a result of a failure to report all interest or dividends, or (c) the IRS has notified me that I am no longer subject to backup withholding, and</li>
                          <li>I am a U.S. citizen or other U.S. person (defined below), and</li>
                          <li>The FATCA code(s) entered on this form (if any) indicating that I am exempt from FATCA reporting is correct.</li>
                        </ol>
                        <p><strong>Certification instructions</strong>. If you have been notified by the IRS that you are currently subject to backup withholding because you have failed to report all interest and dividends on your tax return please please fill out this W-9 form at <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">http://www.irs.gov/pub/irs-pdf/fw9.pdf</a> or <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw8ben.pdf">http://www.irs.gov/pub/irs-pdf/fw8ben.pdf</a> and fax to (212) 813-3254, following IRS instruction relating to item 2 above.</p>
                     </div>
                  
                  
               <div class="form-group col-md-6">
                      <label>Certify by typing your name <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input class="form-control" name="us_cert" value="<?php echo $results['us_cert']; ?>" placeholder="Enter Your Name (<?php echo $results['fname']; ?>)" type="text" disabled>
                    </div>     
                  
                     
                     </b>
                     
			 <?php } ?>
             
		 <?php } ?>