<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") die ("No Post Variables");
// Initialize the $req variable and add CMD key value pair
$req = 'cmd=_notify-validate';
// Read the post from PayPal
foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}

$url = "https://www.paypal.com/cgi-bin/webscr";
$curl_result=$curl_err='';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Content-Length: " . strlen($req)));
curl_setopt($ch, CURLOPT_HEADER , 0);   
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$curl_result = @curl_exec($ch);
$curl_err = curl_error($ch);
curl_close($ch);

$req = str_replace("&", "\n", $req);  // Make it a nice list in case we want to email it to ourselves for reporting

// Check that the result verifies
if (strpos($curl_result, "VERIFIED") !== false) {
    $req .= "\n\nPaypal Verified OK";
} else {
	$req .= "\n\nData NOT verified from Paypal!";
	mail("montsezaman@crownequityholdings.com", "IPN interaction not verified", "$req", "From: montsezaman@crownequityholdings.com" );
	exit();
}

/* CHECK THESE 4 THINGS BEFORE PROCESSING THE TRANSACTION, HANDLE THEM AS YOU WISH
1. Make sure that business email returned is your business email
2. Make sure that the transaction's payment status is "completed"
3. Make sure there are no duplicate txn_id
4. Make sure the payment amount matches what you charge for items. (Defeat Price-Jacking) */
 
// Check Number 1 ------------------------------------------------------------------------------------------------------------
$receiver_email = $_POST['receiver_email'];
if ($receiver_email != "montsezaman@crownequityholdings.com") {
	$message = "Investigate why and how receiver email is wrong. Email = " . $_POST['receiver_email'] . "\n\n\n$req";
    mail("montsezaman@crownequityholdings.com", "Receiver Email is incorrect", $message, "From: montsezaman@crownequityholdings.com" );
    exit(); // exit script
}
// Check number 2 ------------------------------------------------------------------------------------------------------------
if ($_POST['payment_status'] != "Completed") {
	// Handle how you think you should if a payment is not complete yet, a few scenarios can cause a transaction to be incomplete
}
// Connect to database ------------------------------------------------------------------------------------------------------
include ('../connect_me.php');
// Check number 3 ------------------------------------------------------------------------------------------------------------
$this_txn = $_POST['txn_id'];
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id FROM affi_crweworld.transactions WHERE txn_id='$this_txn' LIMIT 1");
$numRows = mysqli_num_rows($sql);
if ($numRows > 0) {
    $message = "Duplicate transaction ID occured so we killed the IPN script. \n\n\n$req";
    mail("montsezaman@crownequityholdings.com", "Duplicate txn_id in the IPN system", $message, "From: montsezaman@crownequityholdings.com" );
    exit(); // exit script
} 
// Check number 4 ------------------------------------------------------------------------------------------------------------
 parse_str($_POST['custom'],$_MYVAR);
$_MYVAR['serv_id_array'];
$affiliate=$_MYVAR['affiliate'];


$serv_id_array = $_MYVAR['serv_id_array'];
$serv_id_array = rtrim($serv_id_array, ","); // remove last comma
// Explode the string, make it an array, then query all the prices out, add them up, and make sure they match the payment_gross amount
$id_str_array = explode(",", $serv_id_array); // Uses Comma(,) as delimiter(break point)
$fullAmount = 0;
foreach ($id_str_array as $value) {
    
	 $value;
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT serv_price FROM affi_crweworld.service WHERE serv_id='$value' LIMIT 1");
    while($row = mysqli_fetch_array($sql)){
		$serv_price = $row["serv_price"];
	}	
	$fullAmount = $fullAmount + $serv_price;
}
$fullAmount = number_format($fullAmount, 2);
$grossAmount = $_POST['mc_gross']; 
if ($fullAmount != $grossAmount) {
        $message = "Possible Price Jack: " . $_POST['payment_gross'] . " != $fullAmount \n\n\n$req";
        mail("montsezaman@crownequityholdings.com", "Price Jack or Bad Programming", $message, "From: montsezaman@crownequityholdings.com" );
        exit(); // exit script
} 

// END ALL SECURITY CHECKS NOW IN THE DATABASE IT GOES ------------------------------------
////////////////////////////////////////////////////
// Homework - Examples of assigning local variables from the POST variables


$custom = $_POST['custom'];
$payer_email = $_POST['payer_email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$payment_date = $_POST['payment_date'];
$mc_gross = $_POST['mc_gross'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payment_type = $_POST['payment_type'];
$payment_status = $_POST['payment_status'];
$txn_type = $_POST['txn_type'];
$payer_status = $_POST['payer_status'];
$address_street = $_POST['address_street'];
$address_city = $_POST['address_city'];
$address_state = $_POST['address_state'];
$address_zip = $_POST['address_zip'];
$address_country = $_POST['address_country'];
$address_status = $_POST['address_status'];
$notify_version = $_POST['notify_version'];
$verify_sign = $_POST['verify_sign'];
$payer_id = $_POST['payer_id'];
$mc_currency = $_POST['mc_currency'];
$mc_fee = $_POST['mc_fee'];
// Place the transaction into the database


$affiliate_id="";
$sql1="SELECT * FROM affi_crweworld.affi_user WHERE username='$affiliate' and active='2' ";
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql1) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	$results = mysqli_fetch_array($result);
	$affiliate_id=$results['id'];
		
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO affi_crweworld.transactions (serv_id_array, payer_email, first_name, last_name, payment_date, mc_gross, txn_id, receiver_email, payment_type, payment_status, txn_type, payer_status, address_street, address_city, address_state, address_zip, address_country, address_status, notify_version, verify_sign, payer_id, mc_currency, mc_fee,affiliate_id) 
   VALUES('$custom','$payer_email','$first_name','$last_name','$payment_date','$mc_gross','$txn_id','$receiver_email','$payment_type','$payment_status','$txn_type','$payer_status','$address_street','$address_city','$address_state','$address_zip','$address_country','$address_status','$notify_version','$verify_sign','$payer_id','$mc_currency','$mc_fee','$affiliate_id')") or die (mysqli_error($GLOBALS["___mysqli_ston"]));
	if($sql == 1)
	{
		if(!empty($affiliate_id))
		{
					
			$insert_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
			$app_date=date("Y-m-d");
			
			$based_amt = 0;
			$serv_price=0;
		
			foreach ($id_str_array as $value) 
			{    
				$value;
				$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM affi_crweworld.service WHERE `cs_id` <= '6' and serv_id='$value' LIMIT 1");
				while($row = mysqli_fetch_array($sql))
				{
				$serv_id[] = $row["serv_id"];
				}		
			}
		
		
			foreach ($serv_id as $value) 
			{
				 $value;
				$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT serv_price FROM affi_crweworld.service WHERE serv_id='$value' LIMIT 1");
				while($row = mysqli_fetch_array($sql))
				{
					$serv_price = $row["serv_price"];
				}	
				$based_amt = $based_amt + $serv_price;
			}
		
			$based_amt = number_format($based_amt, 2);			
			$com_amt= number_format($based_amt*(50/100), 2);										
					
			$aff_sql =  mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO affi_crweworld.commission (`trans_id`, `com_amt`, `based_amt`, `gross_amt`, `app_date`, `affiliate_id`, `com_type`) VALUES ('$insert_id', '$com_amt', '$based_amt', '$mc_gross', '$app_date' , '$affiliate_id' , 'affiliate')") or die (mysqli_error($GLOBALS["___mysqli_ston"]));
			
			if($aff_sql == 1)
			{
				$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM affi_crweworld.affi_user WHERE id='$affiliate_id' and active='2' LIMIT 1");
				while($row = mysqli_fetch_array($sql))
				{
					$referral = $row["referral"];
					
					$ref1="SELECT * FROM affi_crweworld.affi_user WHERE username='$referral' and active='2' ";
					$result=mysqli_query($GLOBALS["___mysqli_ston"], $ref1) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
					$results = mysqli_fetch_array($result);
					$referral_id=$results['id'];
				}	
				if(!empty($referral_id))
				{
					$com_amt= number_format($based_amt*(5/100), 2);
					$ref_sql =  mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO affi_crweworld.commission (`trans_id`, `com_amt`, `based_amt`, `gross_amt`, `app_date`, `affiliate_id`, `com_type`) VALUES ('$insert_id', '$com_amt', '$based_amt', '$mc_gross', '$app_date' , '$referral_id' , 'referral')") or die (mysqli_error($GLOBALS["___mysqli_ston"]));
				
				}
				
			}
			
		}
		
	}
 
((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
// Mail yourself the details
mail("montsezaman@crownequityholdings.com", "NORMAL IPN RESULT YAY MONEY!", $req, "From: montsezaman@crownequityholdings.com");
?>