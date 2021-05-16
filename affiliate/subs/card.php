<?php
session_start();

include ('../../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
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
									
<div class="mi-all" style="display: block"><table width="246" class="mi-all" align="center" cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; display: block; margin: 0px 0 0; min-width: 246px; padding: 0px 0 0"><tbody><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 246px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/h1.jpg" style="border: 0; display: block; height: 39px; line-height: 0px; max-height: 39px; max-width: 246px; min-height: 39px; min-width: 246px; width: 246px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 246px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><div style="background-color: #34A1FE;border: 0; display: block; height: 113px; line-height: 0px; max-height: 113px; max-width: 71px; min-height: 113px; min-width: 71px; width: 71px" /></td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #34A1FE;">

<?php if($results['pic_show']=='Y'){ ?>
<div style="max-width: 113px;max-height: 113px;overflow: hidden;"><img border="0" src="<?php echo $results['profile_pic']?>" style="border: 0;display: block;/* height: 113px; */line-height: 0px;/* max-height: 113px; */max-width: 113px;min-height: 113px;min-width: 113px;width: 113px;" /></div>
<?php } else { ?>
<img border="0" src="https://affiliate.crweworld.com/assets/images/crwe_world_2.jpg" style="border: 0; display: block; height: 113px; line-height: 0px; max-height: 113px; max-width: 113px; min-height: 113px; min-width: 113px; width: 113px" />
<?php } ?>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/s1.jpg" style="border: 0; display: block; height: 113px; line-height: 0px; max-height: 113px; max-width: 62px; min-height: 113px; min-width: 62px; width: 62px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 246px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly;background-color:#34A1FE"">

<p style="max-width: 260px;min-width: 260px;width: 260px;text-align: center;color: #fff;font-weight: bold;font-size: 20px;height: 15px;line-height: 17px; text-transform:capitalize">
<?php echo ucwords(strtolower($results['fname']." ".$results['lname'])); ?> 
</p>

<p style="max-width: 260px; min-width: 260px; width: 260px; text-align: center; color: #fff; font-size: 14px;">
Independent Sales Affiliate
</p>

<p style="max-width: 260px;min-width: 260px;width: 260px;text-align: center;color: #fff;font-size: 12px;line-height: 10px;">
ID #<?php echo $results['affi_id']; ?>
</p>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><div style="background-color: #34A1FE;border: 0; display: block; height: 91px; line-height: 0px; max-height: 91px; max-width: 20px; min-height: 91px; min-width: 20px; width: 20px"></div></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 246px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/f1.jpg" style="border: 0; display: block; height: 117px; line-height: 0px; max-height: 117px; max-width: 246px; min-height: 117px; min-width: 246px; width: 246px" /></td></tr></tbody></table></td></tr></tbody></table></div>


						</td>
					</tr>
			</table>
    
    
    </td>
    <td>
    
    <table align="center" cellpadding="0" cellspacing="0" width="100%" style="background: #FFFFFF; border: 0; border-collapse: collapse; border-spacing: 0; margin: 0px 0 0; padding: 0px 0 0" bgcolor="#FFFFFF"><tr align="center" style="border: 0; border-collapse: collapse; border-spacing: 0">
						<td align="center" valign="top" style="border: 0; border-collapse: collapse; border-spacing: 0">
									
<div class="mi-all" style="display: block"><table width="354" class="mi-all" align="center" cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; display: block; margin: 0px 0 0; min-width: 354px; padding: 0px 0 0"><tbody><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/h2.jpg" style="border: 0; display: block; height: 31px; line-height: 0px; max-height: 31px; max-width: 354px; min-height: 31px; min-width: 354px; width: 354px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top"><table align="center" cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin: 0px 0 0; min-width: 354px; padding: 0px 0 0"><tbody><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/s2.jpg" style="border: 0; display: block; height: 94px; line-height: 0px; max-height: 94px; max-width: 22px; min-height: 94px; min-width: 22px; width: 22px" /></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly">

<a href="https://affiliate.crweworld.com/<?php echo strtolower($results['username']); ?>" style="line-height: 0px;max-width: 312px;min-width: 312px;width: 312px;text-align: center;font-size: 15px;font-weight: bold;line-height: 1em;word-break: break-word; text-decoration:none; ">https://affiliate.crweworld.com/<?php echo strtolower($results['username']); ?></a>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><div style="border: 0; display: block; height: 94px; line-height: 0px; max-height: 94px; max-width: 20px; min-height: 94px; min-width: 20px; width: 20px"></div></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/s3.jpg" style="border: 0; display: block; height: 54px; line-height: 0px; max-height: 54px; max-width: 96px; min-height: 54px; min-width: 96px; width: 96px" /></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #EAF2F4;">

<p style="text-align: left; line-height: 10px; max-width: 240px; overflow: hidden; min-width: 240px; width: 240px;height: 32px;font-size: 11px;"><?php echo $results['address']; ?></p>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><div style="border: 0; display: block; height: 54px; line-height: 0px; max-height: 54px; max-width: 20px; min-height: 54px; min-width: 20px; width: 20px"></div></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/l1.jpg" style="border: 0; display: block; height: 17px; line-height: 0px; max-height: 17px; max-width: 354px; min-height: 17px; min-width: 354px; width: 354px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/s4.jpg" style="border: 0; display: block; height: 52px; line-height: 0px; max-height: 52px; max-width: 112px; min-height: 52px; min-width: 112px; width: 112px" /></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #EAF2F4;">

<p style="text-align: left; line-height: 12px; max-width: 220px; overflow: hidden; min-width: 220px; width: 220px; height: 30px;font-size: 11px;"><?php echo $results['phone']; ?></p>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><div style="border: 0; display: block; height: 52px; line-height: 0px; max-height: 52px; max-width: 20px; min-height: 52px; min-width: 20px; width: 20px"></div></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/l2.jpg" style="border: 0; display: block; height: 17px; line-height: 0px; max-height: 17px; max-width: 354px; min-height: 17px; min-width: 354px; width: 354px" /></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/s5.jpg" style="border: 0; display: block; height: 54px; line-height: 0px; max-height: 54px; max-width: 133px; min-height: 54px; min-width: 133px; width: 133px" /></td><td align="left" valign="middle" style="line-height: 0px; mso-line-height-rule: exactly;background-color: #EAF2F4;">

<p style="text-align: left; line-height: 12px; max-width: 201px; overflow: hidden; min-width: 201px; width: 201px; height: 30px;font-size: 11px;"><?php echo $results['web_url']; ?></p>

</td><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><div style="border: 0; display: block; height: 54px; line-height: 0px; max-height: 54px; max-width: 20px; min-height: 54px; min-width: 20px; width: 20px"></div></td></tr></tbody></table></td></tr><tr align="left" style="border: 0; border-collapse: collapse; border-spacing: 0"><td><table cellspacing="0" cellpadding="0" border="0" style="border: 0; border-collapse: collapse; border-spacing: 0; margin-top: 0px !important; min-width: 354px; padding-top: 0px !important"><tbody><tr style="border: 0; border-collapse: collapse; border-spacing: 0"><td align="left" valign="top" style="line-height: 0px; mso-line-height-rule: exactly"><img border="0" src="https://affiliate.crweworld.com/assets/images/ecard/f2.jpg" style="border: 0; display: block; height: 41px; line-height: 0px; max-height: 41px; max-width: 354px; min-height: 41px; min-width: 354px; width: 354px" /></td></tr></tbody></table></td></tr></tbody></table></div>


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
