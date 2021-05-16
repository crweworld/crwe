<?php
include('subs/header.php');
function metatag()
	{ 
echo "<title>Crwe World | Services Rate</title>";
	}
	


if(isset($_GET['tracking_id']))
				{
					$sql="SELECT * FROM affi_crweworld.affi_user WHERE username='{$_GET['tracking_id']}' and active='2' ";
					$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
					$count=mysqli_num_rows($result);
					if($count==1)
					{	
						while($t_result = mysqli_fetch_array($result))
						{
						
							$_SESSION['tracking_web_url']=$t_result['web_url'];
							if($t_result['type']=='O')
							{
								$_SESSION['tracking_fname']=$t_result['oname'];
							}
							else
							{
								$_SESSION['tracking_fname']=$t_result['fname'].' '.$t_result['lname'];
							}
							
						}
						$_SESSION['tracking_id']=$_GET['tracking_id'];
						echo "<script>
						window.location.href='http://{$_SERVER['HTTP_HOST']}/services_rate';
						</script>";
					}
					else
					{
					echo "<script>
					alert('Affiliate User is Invalid');
					window.location.href='http://{$_SERVER['HTTP_HOST']}/services_rate';
					</script>";
					}
				}



//Add items
if (isset($_POST['add_item_no'])) {
    $add_item_no = $_POST['add_item_no'];
	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) < 1) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart"] = array(0 => array("serv_id" => $add_item_no));
	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart"] as $each_item) { 
		      $i++; 
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "serv_id" && $value == $add_item_no) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart"], $i-1, 1, array(array("serv_id" => $add_item_no)));
					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		   if ($wasFound == false) {
			   array_push($_SESSION["cart"], array("serv_id" => $add_item_no));			  
		   }
	}
	 echo "<script>alert('Cart Updated');</script>";
}


//Remove items
if (isset($_POST['remove_item_no']) && $_POST['remove_item_no'] != "") {
    // Access the array and run code to remove that array index
 	$remove_item_no = $_POST['remove_item_no'];
	if (count($_SESSION["cart"]) <= 1) {
		unset($_SESSION["cart"]);
	} else {
		$i=0;
		foreach ($_SESSION['cart'] as $val){
			foreach ($val as $key => $final_val)
				{
					if ($final_val ==$remove_item_no)
					{
						unset($_SESSION['cart'][$i]);
					}
				} 
			$i = $i + 1;
		}
		sort($_SESSION["cart"]);
	}
	 echo "<script>alert('Cart Updated');</script>";
}

//Sum items

$serv_id_array="";
$cartTotal = "";

$pp_checkout_btn = '';
if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) < 1) {
   
} else {
	// Start PayPal Checkout Button 
	$pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" style="float:right;" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="CTJK4LYX5YC74">';
	// Start the For Each loop
	$i = 0; 

	foreach ($_SESSION["cart"] as $each_item) 
	{ 
			$serv_id = $each_item['serv_id'];
			if(!empty($serv_id))
			{
				$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM affi_crweworld.service WHERE serv_id='$serv_id' and serv_type='1' LIMIT 1");
				while ($row = mysqli_fetch_array($sql)) 
				{
					$serv_info = $row["serv_info"];
					$serv_id= $row["serv_id"];
					$serv_price = $row["serv_price"];
					$serv_add = $row["serv_add"];
				}
				
				$cartTotal = $serv_price + $cartTotal;
				$cartTotal=number_format((float)$cartTotal, 2, '.', '');
				// Dynamic Checkout Btn Assembly
			$x = $i + 1;
			$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $serv_info . '">
			<input type="hidden" name="amount_' . $x . '" value="' . $serv_price . '">
			<input type="hidden" name="quantity_' . $x . '" value="1">  ';
			// Create the product array variable
			$serv_id_array .= "$serv_id,"; 			
			$i++; 
			}
    } 
	
	$custom='serv_id_array='.$serv_id_array.'&affiliate='.$_SESSION['tracking_id'];
    // Finish the Paypal Checkout Btn
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="'.$custom.'">
	<input type="hidden" name="notify_url" value="http://www.crweworld.com/paypal_notify">
	<input type="hidden" name="return" value="http://www.crweworld.com/thank_you">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="cbt" value="Return to CRWEWORLD">
	<input type="hidden" name="cancel_return" value="http://www.crweworld.com/payment_fail">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="http://'.$_SERVER['HTTP_HOST'].'/assets/images/checkout.png" name="submit" alt="Make payments with PayPal - its fast, free and secure!">
	</form>';
}
	

 ?>

 <!-- <link rel="stylesheet" href="assets/responsive-tables.css">
<script src="assets/responsive-tables.js"></script> -->
		
 <link rel="stylesheet" type="text/css" href="/assets/css/service_rate.css" /> 
<script type="text/javascript" src="/assets/js/pop/modernizr.custom.js"></script>

<style>
	
</style>

  <link type="text/css" rel="stylesheet" href="/assets/css/pages/search_result.css">
<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->
    <div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-left col-sm-7">
                           <h2>Services Rate</h2>
                        </div>
                        <div class="col-md-4 col-right col-sm-5">
                            <div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span
                                    class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21Â° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span>
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-left col-sm-7">
                            <div id="search-result" class="section-category">
                            
                                <div style="border-top: 2px solid rgb(0, 0, 0);"> 
                                <br />
                                  <p><strong>We Reserve The Right To Change Our Prices At Any Time  Without Prior Notice.</strong></p>
                                  <br />
                                  <p><b><span class="star">*</span> Outsourced</b></p> 
								  <p><b>PLEASE NOTE: Click below on "<i class="ion-information-circled"></i>" for Service's Description and Information</b></p>
                                  
                                  <?php if($cartTotal > 0){?>								  
								  
                                  <span>
									  <div class="col-xs-12">
										<p><?php echo $pp_checkout_btn; ?></p>
									  </div>
									  
									  <div class="col-xs-12">
										<b class="t_price"><?php echo $i ?> Services Added, Total Cost: $<?php echo $cartTotal?></b>
									   </div>
										<br></br>
									<br></br>
									<br></br>
                                  </span>
                                  <?php } ?>
								  
                                  
									
								  
								  
                              </div>
                                <div class="section-content">
                                    <div class="row">                                       
                                         <div class="col-md-12">
                                    		<section class="ac-container">
                                            <?php
												$i=0;
												$cs = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM affi_crweworld.service_cat where cs_status='1'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
												while($cs_result = mysqli_fetch_array($cs))
												{
													
													$cs_name=$cs_result['cs_name'];
													$cs_id=$cs_result['cs_id'];
											?>
                                                <div>
                                                    <input id="ac-<?php echo $cs_id?>"  name="accordion-<?php echo $cs_id?>" checked="checked" type="checkbox" />
                                                    <label <?php if($cs_id < 7) {echo 'id="blue"';} else {echo 'id="red"';}  ?> for="ac-<?php echo $cs_id?>"><i class="fa fa-shopping-cart"></i> <?php echo $cs_name?></label>
                                                    <article class="ac-small">
                                                    <form action="#" method="post">
                                                        <table class="table table-striped servicerate-table">
                                                            <thead>
                                                              <tr>
                                                                <th>Service</th>
                                                                <th>Additional Info</th>
                                                                <th>Price (USD)</th>
                                                                <th>Contact</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                             <?php
																
																$servid = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM affi_crweworld.service where `serv_status`='1' and `cs_id`='$cs_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
																while($serv_result = mysqli_fetch_array($servid))
																{
																	$serv_id=$serv_result['serv_id'];
																	$serv_info=$serv_result['serv_info'];
																	$serv_add=$serv_result['serv_add'];
																	$serv_price=$serv_result['serv_price'];
																	$serv_type=$serv_result['serv_type'];	
																	$serv_url=$serv_result['serv_url'];	
																	
																	$remove_btn="0";
																	$serv_info=str_replace("*","<span style='color:#F00;'>*</span>",$serv_info);															
															?>
                                                              <tr  <?php if(isset($_SESSION["cart"])){
																  			foreach ($_SESSION["cart"] as $each_item) {
																				 while (list($key, $value) = each($each_item)) {
				 																	 if ($key == "serv_id" && $value == $serv_id) { 
																				
																				  echo "style='background-color: #8BC34A;'";
																				}}}}?>
                                                                >
																
																	<td><?php echo $serv_info?>  
																	<?php if(!empty($serv_url)){ ?>
																	<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/service_info/".$serv_url?>" onclick="javascript:void window.open('<?php echo "http://".$_SERVER['HTTP_HOST']."/service_info/".$serv_url?>','1458800501114','width=800px,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');return false;"><i class="ion-information-circled"></i></a>
																	<?php } ?>
																	</td>
																	
																	<td><i><?php echo $serv_add?></i></td>
																	
																	<td><b><?php if($serv_price!=0){echo "$".$serv_price;} ?></b></td>
																	
																	<td>
																			<?php /*?><?php if(isset($_SESSION["cart"])){
																				foreach ($_SESSION["cart"] as $each_item) {
																					 while (list($key, $value) = each($each_item)) {
																						 if ($key == "serv_id" && $value == $serv_id) 
																						 { $remove_btn="1";}
																						 }}}
																				if($remove_btn=="1"){ echo "<button type='sumbit' class='remove_cart' name='remove_item_no' value='".$serv_id."'>Remove</button>"; } 
																				else { if($serv_type=="1"){ 
																					echo "<button type='sumbit' class='add_cart' name='add_item_no' value='".$serv_id."'>Add to Cart</button>";
																				} 
																				else {echo "<a style='color: #337ab7;' href='http://crweworld.com/contact'>Contact Us for more Info</a>";}  }?><?php */?>
                                                            <a style='color: #337ab7;' href='http://crweworld.com/contact'>Contact Us for more Info</a>
                                                             </td>
                                                              </tr>
                                                            <?php } ?>
                                                            
                                                             
                                                            </tbody>
                                                          </table>
                                                        </form>
                                                    </article>
                                                </div>
                                                <?php } ?>
                                                <?php /*?><div>
                                                    <input id="ac-11" name="accordion-11" checked="checked" type="checkbox">
                                                    <label id="red" for="ac-11"><i class="fa fa-shopping-cart"></i> Website Hosting (With Unlimited Bandwidth And 1 Gb Each)</label>
                                                    <article class="ac-small">
                                                    <form action="#" method="post">
                                                        <table class="table table-striped servicerate-table">
                                                            <thead>
                                                              <tr>
                                                                <th width="370">Service</th>
                                                                <th>Additional Info</th>
                                                                <th>Price (USD)</th>
                                                                <th>Visit Site</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                              <tr>
                                                                <td>A) 1 Website - 1000 Gb Storage - 100 Email Addresses - 10 mysql Database <span style="color:#F00;">*</span>  
                                                                                                                                </td>
                                                                <td><i>Per Domain</i></td>
                                                                <td><b>$6.99</b></td>
                                                                <td><a href="http://crwedomains.com/" target="_blank" class="add_cart">Visit Site</a></td>
                                                              </tr>
                                                                                                                          <tr>
                                                                <td>B) Unlimited Websites, Storage, 500 Email Addresses - 25 mysql Database <span style="color:#F00;">*</span>  
                                                                                                                                </td>
                                                                <td><i>Per Domain</i></td>
                                                                <td><b>$8.99</b></td>
                                                                <td><a href="http://crwedomains.com/" target="_blank" class="add_cart">Visit Site</a></td>
                                                              </tr>
                                                                                                                          <tr>
                                                                <td>C) Unlimited Websites, Storage, 1,000 Email Address - Unlimited mysql Database<span style="color:#F00;">*</span>  
                                                                                                                                </td>
                                                                <td><i>Per Domain</i></td>
                                                                <td><b>$14.99</b></td>
                                                                <td><a href="http://crwedomains.com/" target="_blank" class="add_cart" >Visit Site</a></td>
                                                              </tr>
                                                                                                                          <tr>
                                                                <td>Website Name Registration<span style="color:#F00;">*</span> (Register At Crwedomains.Com For Actual Cost) Starting From:
  
                                                                                                                                </td>
                                                                <td><i>Per Name</i></td>
                                                                <td><b>$9.95</b></td>
                                                                <td><a href="http://crwedomains.com/" target="_blank" class="add_cart" >Visit Site</a></td>
                                                              </tr>
                                                                                                                         
                                                            </tbody>
                                                          </table>
                                                        </form>
                                                    </article>
                                                </div><?php */?>
                                            </section>
                                    	 </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-4 col-right col-sm-5">
                        <?php include('subs/sidebar.php'); ?>
                            
                            <div class="clearfix"></div>
                            
                            <div class="clearfix"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('subs/footer.php') ?>