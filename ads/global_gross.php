<?php

if (!strposa($agent, $fliter)) 
{
	/*gross impression*/
	$ad_imp++;									
	mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `banner_ads` SET `ad_imp`='$ad_imp' where hash_key='$hash_key' ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
	
	/*unique gross impression*/
	$ban_geo1="SELECT * FROM stats WHERE hash='$hash_key' and ban_id='$ban_id' and ip_add='{$_SERVER['REMOTE_ADDR']}' and type='view'"or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
	$g1=mysqli_query($GLOBALS["___mysqli_ston"], $ban_geo1);
	$count=mysqli_num_rows($g1);
	if($count == 0)
	{
	mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `stats`(`ip_add`, `ban_id`, `hash`,`type`,`date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','$ban_id','$hash_key','view',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
		$ad_unq_imp++;																	
	mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `banner_ads` SET `ad_unq_imp`='$ad_unq_imp' where hash_key='$hash_key' ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	}
}
											
?>
