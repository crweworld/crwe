<?php 
include('connect_me.php');
/*require_once('geoplugin.class.php');
$geoplugin = new geoplugin();
$geoplugin->locate();*/

/*include('ip2locationlite.class.php'); 
//Load the class
$ipLite = new ip2location_lite;
$ipLite->setKey('cf309407361a7779359fcbe7505369a0035688ec6cb8a2fe788da2f276a4c65a'); 
//Get errors and locations
$geo_locations= $ipLite->getCity($_SERVER['REMOTE_ADDR']);*/


$date=date("Y-m-d");
$hash_key=$_GET['hash_key'];
$ban_id=$_GET['ban_id'];

$ban_geo1="SELECT * FROM ban_loc WHERE ban_id='$ban_id'";
$g1=mysqli_query($GLOBALS["___mysqli_ston"], $ban_geo1)or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
$count=mysqli_num_rows($g1);
if($count == 1)
{
	$info = mysqli_fetch_array( $g1 ); 
	$ad_clicks=$info['ad_clicks'];
	$ad_unq_clicks=$info['ad_unq_clicks'];
	
	
				$info = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM banner_ads where hash_key='$hash_key'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				$results = mysqli_fetch_array($info);
				$target_url = $results['target_url'];
				echo $results['tracking_id'];
	
	$agent =strtolower($_SERVER['HTTP_USER_AGENT']);
	
	
	/*gross click*/
	$ad_clicks++;									
	mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `ban_loc` SET `ad_clicks`='$ad_clicks' where ban_id='$ban_id' ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
	
	/*unique click*/
	$ban_geo1="SELECT * FROM stats WHERE hash='$hash_key' and ban_id='$ban_id' and ip_add='{$_SERVER['REMOTE_ADDR']}' and type='click' ";
	$g1=mysqli_query($GLOBALS["___mysqli_ston"], $ban_geo1);
	$count=mysqli_num_rows($g1);
	if($count == 0)
	{
		mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `stats`(`ip_add`, `ban_id`, `hash`,`type`,`date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','$ban_id','$hash_key','click','$date','$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	    $ad_unq_clicks++;									
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `ban_loc` SET `ad_unq_clicks`='$ad_unq_clicks' where ban_id='$ban_id' ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	}
	
	/*GOTO*/
	header("Location:$target_url");
	
}
else
{
	header("Location:http://{$_SERVER['HTTP_HOST']}");
}

									
?>