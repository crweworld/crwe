<?php
if ($nav == 'index.php')
{	
	if ( strpos($server_url, "home") !== false and   (strpos($server_url, "usa") or strpos($server_url, "canada"))== false  and isset($_GET['loc_id'])) 
	{ 
		
	$result=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  worldzips WHERE  `id`='{$_GET['loc_id']}' LIMIT 1") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$count=mysqli_num_rows($result);
		if($count > 0) 
		{
			$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  worldzips WHERE  `id`='{$_GET['loc_id']}' LIMIT 1") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			while($row=mysqli_fetch_array($sql_res))
				{
					$post_country=$row['country'];
					$post_state=$row['region1'];
					//$post_local=$row['locality'];

					if($row['region2']!="")
					{
						$post_city=$row['region2'];
					}
					elseif($row['region3']!="")
					{
						$post_city=$row['region3'];
					}
					else
					{
						$post_city=$row['locality'];
					}

					$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  countrydata WHERE  `country`='$post_country' LIMIT 1") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
						while($row=mysqli_fetch_array($sql_res))
						{
							$post_continent=$row['continent'];
						}

					$_SESSION['homepage']= $_SERVER['REQUEST_URI'];
					$_SESSION['post_continent'] = strtoupper(str_replace("-"," ","$post_continent"));
					$_SESSION['post_country'] = strtoupper(str_replace("-"," ","$post_country"));
					$_SESSION['post_state'] = ucwords(str_replace("-"," ","$post_state")); 				
					$_SESSION['post_city'] = ucwords(str_replace("-"," ","$post_city"));
					//$_SESSION['post_local'] = ucwords(str_replace("-"," ","$post_local"));
				}

		}

	}
	else if ( strpos($server_url, "home") !== false and  (strpos($server_url, "usa") or strpos($server_url, "canada")) !== false and isset($_GET['loc_id'])) 
	{ 
	$result=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  location WHERE  `loc_id`='{$_GET['loc_id']}' LIMIT 1") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$count=mysqli_num_rows($result);
		if($count > 0) 
		{
			$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  location WHERE  `loc_id`='{$_GET['loc_id']}' LIMIT 1") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			while($row=mysqli_fetch_array($sql_res))
				{
					$post_country=$row['country'];
					$post_state=$row['state'];
					$post_city=strtolower($row['city']);

					if($post_country=='usa'){$dbcountry='United States';}else{$dbcountry='Canada';}
					$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  countrydata WHERE  `country`='$dbcountry' LIMIT 1") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
						while($row=mysqli_fetch_array($sql_res))
						{
							$post_continent=$row['continent'];
						}



					$_SESSION['homepage']= $_SERVER['REQUEST_URI'];
					$_SESSION['post_continent'] = strtoupper(str_replace("-"," ","$post_continent"));
					$_SESSION['post_country'] = strtoupper(str_replace("-"," ","$post_country"));
					$_SESSION['post_state'] = ucwords(str_replace("-"," ","$post_state")); 				
					$_SESSION['post_city'] = ucwords(str_replace("-"," ","$post_city"));
					//$_SESSION['post_local'] = $_SESSION['post_city'];
				}

		}

	}
	else
	{
		//unset($_SESSION['post_local']);
		unset($_SESSION['post_city']);
		unset($_SESSION['post_state']);
		unset($_SESSION['post_country']);
		unset($_SESSION['post_continent']);
		unset($_SESSION['homepage']);
		
	}
	
}

if(isset($_SESSION['homepage'])){$homepage=$_SESSION['homepage'];}else{$homepage='/';}
?>