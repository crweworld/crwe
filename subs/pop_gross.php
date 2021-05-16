<?php

if (!strposa($agent, $fliter)) 
{
	/*gross impression*/
	$ad_imp++;									
	mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `pop_loc` SET `ad_imp`='$ad_imp' where pop_id='$pop_id' ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
	
	/*unique gross impression*/
	$pop_geo1="SELECT * FROM pop_stats WHERE hash='$hash_key' and pop_id='$pop_id' and ip_add='{$_SERVER['REMOTE_ADDR']}' and type='view'";
	$g1=mysqli_query($GLOBALS["___mysqli_ston"], $pop_geo1);
	$count=mysqli_num_rows($g1);
	if($count == 0)
	{
		mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `pop_stats`(`ip_add`, `pop_id`, `hash`,`type`,`date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','$pop_id','$hash_key','view',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
		$ad_unq_imp++;									
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `pop_loc` SET `ad_unq_imp`='$ad_unq_imp' where pop_id='$pop_id' ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		
	}

}

									
?>