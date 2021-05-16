<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

$vid_cat = mysql_query("SELECT * FROM transactions where id='{$_GET['transaction_id']}'") or die(mysql_error()); 
					while($results = mysql_fetch_array($vid_cat))
					{	
						$payment_date=urldecode($results['payment_date']);
						$txn_id=$results['txn_id'];
						$mc_gross=$results['mc_gross'];
						$payer_email=urldecode($results['payer_email']);
						$address_street=urldecode($results['address_street']);
						$address_city=$results['address_city'];
						$address_state=$results['address_state'];
						$address_zip=$results['address_zip'];
						$address_country=$results['address_country'];
						$payment_status=$results['payment_status'];
					 	$first_name=$results['first_name'];
						$last_name=$results['last_name'];
						$serv_id_array=$results['serv_id_array'];
						
						 parse_str($serv_id_array,$_MYVAR);
						$serv_id_array=$_MYVAR['serv_id_array'];
					$serv_id_array = rtrim($serv_id_array, ",");
					$serv_id_array = explode(",", $serv_id_array); 
					}
				
	if(!isset($txn_id))
		{
			die ();
		}				

 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><META http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body><div><div>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" width="600"><tr valign="top"><td width="100%"><table align="center" border="0" cellpadding="0" cellspacing="0" width="600"><tr valign="top"><td><img style="display: block;" src="../assets/images/logo_paypal.png" width="186" height="24"><img src="http://images.paypal.com/en_US/i/logo/paypal_logo.gif" border="0" alt="PayPal logo"></td><td style="font-size:11px;font-family:arial,helvetica,sans-serif;color:#333333" valign="middle" align="right"><?php echo $payment_date; ?><br>Transaction ID: <a style="color:#084482" href="https://www.paypal.com/us/cgi-bin/webscr?cmd=_view-a-trans&amp;id=<?php echo $txn_id; ?>" target="_blank"><?php echo $txn_id; ?></a></td></tr></table><div><div style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333333;padding-top:11px;padding-bottom:10px"><span style="font-size:14px;font-family:arial,helvetica,sans-serif;color:#c88039;font-weight:bold;text-decoration:none">You received a payment of $<?php echo $mc_gross; ?> USD from (<a href="mailto:<?php echo $payer_email; ?>" target="_blank"><?php echo $payer_email; ?></a>).</span><span style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333333"><br>To see all the transaction details, please log into your PayPal account. It may take a few moments for this transaction to appear in your account.</span></div><table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333333;border-top:1px solid #cccccc;clear:both" width="100%" align="left"><tr><td valign="top" width="50%" style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333333;word-wrap:break-word;width:285px;padding:10px 15px 5px 0" align="left"><span style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333333"><strong>Buyer information</strong><br><?php echo $first_name." ".$last_name; ?><br><a href="mailto:<?php echo $payer_email; ?>" target="_blank"><?php echo $payer_email; ?></a><br></span></td><td style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333333;padding:10px 0 5px 0" valign="top"><span style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333333"><strong>Payment Status</strong><br><?php echo $payment_status?></span></td></tr></table><div><table border="0" cellpadding="0" cellspacing="0" style="clear:both" width="100%" align="left"><tr><td style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333333;padding:10px 0 7px 0" valign="top" width="50%" align="left"><span style="font-weight:bold">Buyer address:</span> <br><?php echo $first_name." ".$last_name; ?><br><?php echo $address_street?><br><?php echo $address_city?>,<br> <?php echo $address_state?>,<?php echo $address_zip?><br><?php echo $address_country?><br></td></tr></table></div><div><table align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;margin-top:10px;clear:both" width="100%"><tr><td style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;border:1px solid #ccc;border-right:none;border-left:none;padding:5px 10px 5px 10px!important" width="350" align="left">Description</td>


<td style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;border:1px solid #ccc;border-right:none;border-left:none;padding:5px 10px 5px 10px!important" width="80" align="right">Amount</td></tr>

<?php
foreach ($serv_id_array as $value) 
			{    
				$value;
$serv = mysql_query("SELECT * FROM `service` where serv_id in ('$value')") or die(mysql_error());
					while($results = mysql_fetch_array($serv))
					{	
						$serv_info=$results['serv_info'];
						$serv_price=$results['serv_price'];
?>
<tr>
	<td style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;padding:12px 10px 0 10px;vertical-align:top" align="left">
    	<span><?php echo $serv_info?></span><br>
     </td>
    
     <td style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;padding:12px 10px 0 10px;vertical-align:top" align="right">$<?php echo $serv_price?> USD</td>
</tr>

<?php } }?>

<tr><td colspan="4" style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;border-bottom:1px solid #ccc;padding:12px 10px 0 10px;vertical-align:top"><img alt="" border="0" height="1" src="http://images.paypal.com/en_US/i/scr/pixel.gif" width="1"></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;clear:both;border-top:1px solid #ccc;color:#333!important;margin-bottom:10px" width="100%"><tr><td width="100%"><table border="0" cellpadding="0" cellspacing="0" style="margin-top:12px;width:100%" align="right"><tr><td style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;width:390px;padding:0 5px 0 0;text-align:right"><span style="font-weight:bold">Total: </span></td><td style="font-size:12px;font-family:arial,helvetica,sans-serif;color:#333;width:90px;padding:0 10px 0 0;text-align:right">$<?php echo $mc_gross; ?> USD</td></tr></table></td></tr></table></div></div></td></tr></table></div></div></body></html>