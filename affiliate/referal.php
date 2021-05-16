<?php


include ('subs/connect_me.php');
$date=date("Y-m-d");


if(isset($_GET['username']))
{
	$sql="SELECT * FROM affi_user WHERE username='{$_GET['username']}' and active='2' ";
	$result=mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($result);
	if($count==1)
	{
		$results = mysql_fetch_array($result);
		$clicks=$results['clicks'];
		$unq_clicks=$results['unq_clicks'];
		$affi_id=$results['id'];
		
		/*gross click*/
		$clicks++;									
		mysql_query("UPDATE `affi_user` SET `clicks`='$clicks' where username='{$_GET['username']}' ")or die(mysql_error());	
		
		/*unique click*/
		$ban_geo1="SELECT * FROM affi_stats WHERE affi_id='$affi_id' and ip_add='{$_SERVER['REMOTE_ADDR']}'";
		$g1=mysql_query($ban_geo1);
		$count=mysql_num_rows($g1);
		if($count == 0)
		{
			mysql_query("INSERT INTO `affi_stats`(`ip_add`,`affi_id`,`date`) VALUES ('{$_SERVER['REMOTE_ADDR']}','$affi_id','$date')") or die(mysql_error()); 
			$unq_clicks++;																	
			mysql_query("UPDATE `affi_user` SET `unq_clicks`='$unq_clicks' where username='{$_GET['username']}' ")or die(mysql_error());
		}
	
	
		
			echo "<script>
			
			window.location.href='http://www.crweworld.com/services_rate?tracking_id={$_GET['username']}';
			</script>";
		
	}
	else
	{
		echo "<script>
			alert('Affiliate User is Invalid');
			window.location.href='http://{$_SERVER['HTTP_HOST']}';
			</script>";
	}
}
?>