<?php
session_start();

include ('../subs/connect_me.php');

if(empty($_SESSION['id']) or $_SESSION['group']!="superadmin")
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
  if (isset($_GET['active']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		$value; 	
		mysql_query("UPDATE `affi_user` SET `active`= '1' WHERE id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Active');</script>";	
	
}

  if (isset($_GET['approved']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		$value; 	
		mysql_query("UPDATE `affi_user` SET `active`= '2' WHERE id IN ('" . implode("','",$value) . "')");
		$admin = mysql_query("SELECT * FROM affi_user WHERE id IN ('" . implode("','",$value) . "')") or die(mysql_error()); 
					while($results = mysql_fetch_array($admin))
					{	
						$email=$results['email'];
						if($email != '')
							{				
								$to      = $email; // Send email to our user
								$subject = "CrweWorld Affiliate Program | Approved"; // Give the email a subject 
								$message="<table width=\"675\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"font-family:Arial,Verdana,sans-serif;font-size:11pt\"> <tbody><tr style=\"background-color:#2f88dc;height:100px;vertical-align:middle\"> <td> <a style=\"text-decoration:none\" href=\"#\" target=\"_blank\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/logo.png\" style=\"color:#fff;font-size:25px;padding:10px 0px\" height=\"71\" width=\"309\" border=\"0px\"> </a> </td> <td align=\"right\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/earn.png\" alt=\"EARN\" width=\"82\" height=\"78\" style=\"float:right;margin:3px 10px 0 0\"> <img src=\"http://affiliate.crweworld.com/assets/images/mail/link.png\" alt=\"LINK\" width=\"83\" height=\"78\" style=\"float:right;margin:3px 0 0 0\"> </td> </tr> </tbody></table>   </span><table width=\"675\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"background-color:#fff;font-family:sans-serif;font-size:11pt;text-align:justify\"> <tbody><tr><td style=\"padding:20px 20px 0 20px;color:#444;line-height:1.5em\"><span class=\"im\"> <p>Dear Affiliate Partner,</p> 
				  <p>Congratulations!!</p> 
				  <p>First, we would like to say, &ldquo;Thank You&rdquo; for becoming a (CRWE WORLD) affiliate. It certainly will not go unappreciated.</p>
								<p>Please log into your affiliate account at: <a href=\"https://affiliate.crweworld.com/\" target=\"_blank\">https://affiliate.crweworld.com</a> to find your affiliate URL.                </p>
								</span>
								<p>It is very important that you complete the following information:<br>
								&bull; Payment Information <br>
								&bull; Tax Information <br>
								<br>
								Once again, congratulations. We at CRWE WORLD look forward to working with you!</p>
								
								<span class=\"im\"><h4><font color=\"red\"><b>Note:</b></font> </h4>
								
								<p style=\"font-size: 10px;\">This email is part of a Closed-Loop Opt-In system and was sent to protect the privacy of the owner of this email address. Closed-Loop Opt-In confirmation guarantees that only the owner of an email address can subscribe themselves to this mailing list. Furthermore, the following privacy policy is associated with this list: <br>
				<a href=\"http://www.crweworld.com/terms_conditions\">http://www.crweworld.com/terms_conditions </a><br>
				Please read and understand this privacy policy. Other mechanisms may have been enacted to subscribe email addresses to this list, such as physical guestbook registrations, verbal agreements, etc.If you did not ask to be subscribed to this particular list, please do not visit the confirmation URL above. The confirmation for subscription will not go through and no other action on your part will be needed. 
				
								</p>
								
								<p>&nbsp;</p> 
								<p>  
								Thanks &amp; Regards,  
								<br>  
								CRWE WORLD Affiliate Team
				</p> <br> </span></td> 
								</tr>  <tr style=\"background-color:#2f88dc;vertical-align:middle\"> <td style=\"font-size:11px;font-weight:bold;padding:15px;color:#eee\"> <div style=\"margin-bottom:1em\">&copy; 2016, crweworld.com. All rights reserved.</div> <div>The following physical address is associated with this mailing list: 11226 Pentland Downs St, Las Vegas, NV 89141
								</div> <div>For general inquiries or to request support with your CRWEWORLD Affiliate account: <a href=\"mailto:affiliate@crweworld.com\" target=\"_blank\">affiliate@crweworld.com</a></div> </td> </tr> </tbody></table>";
								
								//phpemailer
								 require '/var/www/html/vhosts/phpmail/mail.php';
								 $from_name= 'CrweWorld Affiliate';
								 $reply = 'affiliate@crweworld.com';
								 $reply_name = 'CrweWorld Affiliate';
								 $to = $email;
								 $subject = $subject;
								 $message = $message;
								 $send_mail = sendphpmail('crweworld.com',$from_name,$reply,$reply_name,$to,$subject,$message);}
					}
	}	
	echo "<script>alert('Approved');</script>";	
	
}

if (isset($_GET['inactive']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		$value; 	
		mysql_query("UPDATE `affi_user` SET `active`= '0' WHERE id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Inactive');</script>";	
	
}
if (isset($_GET['del_me']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
	   $value; 	
		mysql_query("DELETE FROM `affi_user` WHERE id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Deleted');</script>";	
	
}
 
 ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard 
            <small>Version 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Affiliate </a></li>
            <li class="active">View Affiliate </li>
          </ol>
        </section>
<form action="#" method="get">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Affiliate Information</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
               
                  <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
                  <div class="col-xs-3"><button type="submit" name="approved" class="btn btn-block btn-primary">Approved</button></div>
                  <div class="col-xs-3"><button type="submit" name="active" class="btn btn-block btn-success">Active</button></div>
                  <div class="col-xs-3"><button type="submit" name="inactive" class="btn btn-block btn-warning">Inactive</button></div>
                  <div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                      	
                        <th>Name</th>
                         <th>Referral Id</th>
                        <th>Email</th>
                        <th>Commission</th>
                        <th>Paid Amount</th>
                        <th>Pending Amount</th>
                        <th>Created On</th>
                        <th>Status</th> 
                        <th>Stats</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$admin = mysql_query("SELECT * FROM affi_user ORDER BY id DESC") or die(mysql_error()); 
					while($results = mysql_fetch_array($admin))
					{	
						$id=$results['id'];
					 	$username=$results['username'];
						$name=$results['fname']." ".$results['lname'];
						$email=$results['email'];
					 	$doc=$results['doc'];
						$active=$results['active'];	
						$referral=$results['referral'];	
						
						if(!empty($username)){
							$wait="Waiting for Approval";
						}
						else
						{
							$wait="Profile Incomplete";
						}
						
						$com_amt='';
						$comm = mysql_query("SELECT SUM(com_amt) FROM commission where approval='1' and affiliate_id='$id'") or die(mysql_error()); 
						$results = mysql_fetch_array($comm);
						$com_amt=number_format($results['SUM(com_amt)'],2);
						
						$paid_amt='';
						$pa_amt = mysql_query("SELECT SUM(paid_amt) FROM payment where affiliate_id='$id'") or die(mysql_error()); 
						$results = mysql_fetch_array($pa_amt);
						$paid_amt=number_format($results['SUM(paid_amt)'],2);
						
						$pending = number_format($com_amt-$paid_amt, 2);
					?>
                      <tr style="text-transform:capitalize;">
                      	 <td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $id ?>"  /></td>
                      
                        <td><?php echo $name ?></td>                        
                         <td><a href="edit_affiliate.php?tracking_id=<?php echo $referral ?>"><?php echo $referral ?></a></td>  
                        <td><a href="edit_affiliate.php?affiliate_id=<?php echo $id ?>"><?php echo $email ?></a></td>     
                        
                        <td><?php if($com_amt!=0){ echo '$'.$com_amt;} ?></td>
                        <td><?php if($paid_amt!=0){echo '$'.$paid_amt;} ?></td>
                         <td><?php if($pending!=0){echo '$'.$pending;} ?></td>
                                            
                        <td><?php echo $doc ?></td>
                        <td><span class="label <?php if($active=="1"){echo "label-success"; $active1=$wait;} elseif($active=="2"){echo "label-primary"; $active1='Approved';} else{echo "label-warning"; $active1='Inactive';} ?>"><?php echo $active1 ?></span></td>
                        <td><a href="affiliate_stats.php?affiliate_id=<?php echo $id?>" target="_blank">
                        <i class="fa fa-external-link"></i></a></td>
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      <th></th>
                       <th>Name</th>
                        <th>Referral Id</th>
                        <th>Email</th>
                        <th>Commission</th>
                        <th>Paid Amount</th>
                        <th>Pending Amount</th>
                        <th>Created On</th>
                        <th>Status</th>  
                        <th>Stats</th>      
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        </form>
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
