<?php
session_start();

include ('../../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
}

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") { 
    $url="https://".$_SERVER['HTTP_HOST'];
} else { 
    $url="http://".$_SERVER['HTTP_HOST'];
}
 
 ?>
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    
<style type="text/css">
	html, body{ margin-top: 0px !important; padding-top: 0px !important; }
	body{ background-color:#FFFFFF; margin-top: 0px !important; padding-top: 0px !important; font-family:sans-serif; }
	table{ margin-top: 0px !important; padding-top: 0px !important; }
</style>


<style type="text/css">
		a img{ color:#000001 !important; }

.wysiwyg-text-align-right{ text-align: right; }
.wysiwyg-text-align-center { text-align: center; }
.wysiwyg-text-align-left{ text-align: left; }
.wysiwyg-text-align-justify{ text-align: justify; }

body{ text-shadow:none; padding-top:0; padding-right:0; padding-bottom:0; padding-left:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0; color:#000000!important; font-style:normal; font-family:Arial; font-size:14px; line-height:24px; }

h1, #email-375286 h1{ text-shadow:none; padding-top:0; padding-right:0; padding-bottom:0; padding-left:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0; color:#000000!important; font-weight:400; font-style:normal; font-family:Arial; font-size:36px; line-height:44px; }

h2, #email-375286 h2{ text-shadow:none; padding-top:0; padding-right:0; padding-bottom:0; padding-left:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0; color:#000000!important; font-weight:400; font-style:normal; font-family:Arial; font-size:24px; line-height:32px; }

h3, #email-375286 h3{ text-shadow:none; padding-top:0; padding-right:0; padding-bottom:0; padding-left:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0; color:#000000!important; font-weight:400; font-style:normal; font-family:Arial; font-size:15px; line-height:21px; }



a, #email-375286 a{ text-shadow:none; padding-top:0; padding-right:0; padding-bottom:0; padding-left:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0; color:#000!important; text-decoration:underline; }


.h1_color_span_wrapper{ color: #000000; }
.h2_color_span_wrapper{ color: #000000; }
.h3_color_span_wrapper{ color: #000000; }
.p_color_span_wrapper{ color: #000000; }
.a_color_span_wrapper{ color: #1122CC; }


		.mi-all{ display: block; }
		.mi-desktop{ display: block; }

	.mi-mobile{
		display: none;
		font-size: 0; 
		max-height: 0; 
		line-height: 0; 
		padding: 0;
		float: left;
		overflow: hidden;
		mso-hide: all; /* hide elements in Outlook 2007-2013 */
	}


</style>

<style type="text/css" >

	div, p, a, li, td { -webkit-text-size-adjust:none; }
	
	@media only screen and (max-device-width: 480px), screen and (max-width: 480px), screen and (orientation: landscape) and (max-width: 630px) {
		
		/* very important! all except 'all' and this current type get a display:none; */
		.mi-desktop{ display: none !important; }

		/* then show the mobile one */
		.mi-mobile{ 
			display: block !important;
			font-size: 12px !important;
			max-height: none !important;
			line-height: 1.5 !important;
			float: none !important;
			overflow: visible !important;
		}
	}

</style>
</head>

<body >
 <?php
	$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}' and active=2") or die(mysql_error()); 
	while($results = mysql_fetch_array($edit_user))
	{
	
?>

<table id="canvas" width="100" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    
    
    <table align="center" cellpadding="0" cellspacing="0" width="100%" style="background: #FFFFFF; border: 0; border-collapse: collapse; border-spacing: 0; margin: 0px 0 0; padding: 0px 0 0" bgcolor="#FFFFFF"><tr align="center" style="border: 0; border-collapse: collapse; border-spacing: 0">
						<td align="center" valign="top" style="border: 0; border-collapse: collapse; border-spacing: 0">
									
<div class="mi-all" style="display: block"><table width="461" class="mi-all" align="center" cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; display: block; margin: 0px 0 0; min-width: 461px; padding: 0px 0 0"><tbody><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 461px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p1.jpg" style="border: 0; display: block; height: 73px; line-height: 0px; max-height: 73px; max-width: 461px; min-height: 73px; min-width: 461px; width: 461px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 461px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #34A1FE;"><div style="border: 0; display: block; height: 211px; line-height: 0px; max-height: 211px; max-width: 134px; min-height: 211px; min-width: 134px; width: 134px"></div></td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly">

<?php if($results['pic_show']=='Y'){ ?>
<div style="overflow: hidden;max-width: 211px;max-height: 211px;"><img border="0" src="<?php echo $results['profile_pic']?>"  style="border: 0;display: block;/* height: 211px; */line-height: 0px;/* max-height: 211px; */max-width: 211px;min-height: 211px;min-width: 211px;width: 100%;" /></div>
<?php } else { ?>
<img border="0" src="../../assets/images/card/pic.jpg" style="border: 0; display: block; height: 211px; line-height: 0px; max-height: 211px; max-width: 211px; min-height: 211px; min-width: 211px; width: 211px" />
<?php } ?>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p2.jpg" style="border: 0; display: block; height: 211px; line-height: 0px; max-height: 211px; max-width: 116px; min-height: 211px; min-width: 116px; width: 116px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 461px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #34A1FE;"><div style="border: 0; display: block; height: 155px; line-height: 0px; max-height: 155px; max-width: 46px; min-height: 155px; min-width: 46px; width: 46px"></div></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly;background-color:#34A1FE">

<p style="max-width: 385px;min-width: 385px;width: 385px;text-align: center;color: #fff;font-weight: bold;font-size: 2em;">
<?php echo ucwords(strtolower($results['fname']." ".$results['lname'])); ?> 
</p>

<p style="max-width: 385px; min-width: 385px; width: 385px; text-align: center; color: #fff; font-size: 20px;">
Independent Sales Affiliate
</p>

<p style="max-width: 385px;min-width: 385px;width: 385px;text-align: center;color: #fff;font-size: 18px;line-height: 10px;">
ID #<?php echo $results['affi_id']; ?>
</p>



</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #34A1FE;"><div style="border: 0; display: block; height: 155px; line-height: 0px; max-height: 155px; max-width: 30px; min-height: 155px; min-width: 30px; width: 30px"></div></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 461px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p3.jpg" style="border: 0; display: block; height: 236px; line-height: 0px; max-height: 236px; max-width: 461px; min-height: 236px; min-width: 461px; width: 461px" /></td></tr></tbody></table></td></tr></tbody></table></div>


						</td>
					</tr>
			</table>
    
    
    
    </td>
    <td>
    
    
    <table align="center" cellpadding="0" cellspacing="0" width="100%" style="background: #FFFFFF; border: 0; border-collapse: collapse; border-spacing: 0; margin: 0px 0 0; padding: 0px 0 0" bgcolor="#FFFFFF"><tr align="center" style="border: 0; border-collapse: collapse; border-spacing: 0">
						<td align="center" valign="top" style="border: 0; border-collapse: collapse; border-spacing: 0">
									
<div class="mi-all" style="display: block"><table width="664" class="mi-all" align="center" cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; display: block; margin: 0px 0 0; min-width: 664px; padding: 0px 0 0"><tbody><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 664px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p4.jpg" style="border: 0; display: block; height: 66px; line-height: 0px; max-height: 66px; max-width: 664px; min-height: 66px; min-width: 664px; width: 664px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 664px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p5.jpg" style="border: 0; display: block; height: 170px; line-height: 0px; max-height: 170px; max-width: 47px; min-height: 170px; min-width: 47px; width: 47px" /></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly">

<a href="https://affiliate.crweworld.com/<?php echo strtolower($results['username']); ?>" style="line-height: 0px;max-width: 580px;min-width: 580px;width: 580px;text-align: center;font-size: 24px;font-weight: bold;line-height: 1em;word-break: break-word;text-decoration:none;">https://affiliate.crweworld.com/<?php echo strtolower($results['username']); ?></a>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly; background-color:#fff"><div style="border: 0; display: block; height: 170px; line-height: 0px; max-height: 170px; max-width: 37px; min-height: 170px; min-width: 37px; width: 37px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 664px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p6.jpg" style="border: 0; display: block; height: 100px; line-height: 0px; max-height: 100px; max-width: 180px; min-height: 100px; min-width: 180px; width: 180px" /></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #EAF2F4;">

<p style="text-align: left; line-height: 20px; max-width: 443px; overflow: hidden; min-width: 443px; width: 443px; max-height: 100px;font-size: 19px;"><?php echo $results['address'].', '.$results['post_city'].', '.$results['post_state'].', '.$results['post_zipcode']; ?></p>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly; background-color:#fff"><div style="border: 0; display: block; height: 100px; line-height: 0px; max-height: 100px; max-width: 39px; min-height: 100px; min-width: 39px; width: 39px"></div></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 664px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p11.jpg" style="border: 0; display: block; height: 32px; line-height: 0px; max-height: 32px; max-width: 664px; min-height: 32px; min-width: 664px; width: 664px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 664px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p7.jpg" style="border: 0; display: block; height: 100px; line-height: 0px; max-height: 100px; max-width: 211px; min-height: 100px; min-width: 211px; width: 211px" /></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #EAF2F4;">

<p style="text-align: left; line-height: 20px; max-width: 410px; overflow: hidden; min-width: 410px; width: 410px; max-height: 100px;font-size: 19px;"><?php echo $results['phone']; ?></p>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly; background-color:#fff;"><div style="border: 0; display: block; height: 100px; line-height: 0px; max-height: 100px; max-width: 40px; min-height: 100px; min-width: 40px; width: 40px"></div></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 664px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p10.jpg" style="border: 0; display: block; height: 31px; line-height: 0px; max-height: 31px; max-width: 664px; min-height: 31px; min-width: 664px; width: 664px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 664px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p8.jpg" style="border: 0; display: block; height: 100px; line-height: 0px; max-height: 100px; max-width: 247px; min-height: 100px; min-width: 247px; width: 247px" /></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #EAF2F4;">

<p style="text-align: left; line-height: 20px; max-width: 380px; overflow: hidden; min-width: 380px; width: 380px; max-height: 100px;font-size: 19px;"><?php echo $results['email']; ?></p>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly; background-color:#fff"><div style="border: 0; display: block; height: 100px; line-height: 0px; max-height: 100px; max-width: 37px; min-height: 100px; min-width: 37px; width: 37px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 664px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="<?php echo $url ?>/assets/images/card/p9.jpg" style="border: 0; display: block; height: 76px; line-height: 0px; max-height: 76px; max-width: 664px; min-height: 76px; min-width: 664px; width: 664px" /></td></tr></tbody></table></td></tr></tbody></table></div>


						</td>
					</tr>
			</table>
            
    
    </td>
  </tr>
</table>

 
 <script type="text/javascript" src="html2canvas.js"></script>
  <script src="../../assets/js/jquery.min.js"></script>
    
	<script type="text/javascript">
		div_content = document.querySelector("#canvas")
        html2canvas(div_content).then(function(canvas) {
			 $("#canvas").hide();
           // document.body.appendChild(canvas);
			data = canvas.toDataURL('image/jpeg');
			
			$.post('save_jpg.php', {data: data}, function(res){
				//if the file saved properly, trigger a popup to the user.
				if(res != ''){
					yes = alert('Business Card created, click ok to see it!');
					window.location.href = "../ecard.php";
				}
				else{
					alert('something wrong');
				}
			});
        });
		
		
    </script>

<?php  } ?>



</body>
</html>
