<?php 
include ('connect_me.php');
include('functions.php');
if(empty($_POST['country']))
{
	echo "<script type=\"text/javascript\">
			document.location=\"http://{$_SERVER['HTTP_HOST']}\";
			</script>";
}
if( $_POST['country']=='usa' or $_POST['country']=='canada' )
{	
	if(!empty($_POST['city']))
	{
		$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['city']);
		$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `location` where loc_id ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}
	   else	if(!empty($_POST['state']))
	{
		$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['state']);
		$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `location` where loc_id ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}
	  else	if(!empty($_POST['country']))
	{
		$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['country']);
		$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `location` where country ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}else{
		echo "<script type=\"text/javascript\">
					document.location=\"http://{$_SERVER['HTTP_HOST']}\";
					</script>";			
	}
	
		while($row = mysqli_fetch_array($lookup))
		{	
			
			$state=$row['state'];
			$country=$row['country'];
			$loc_id=$row['loc_id'];
			$city=$row['city'];
			
			
			if($state==''){$state=$country;}
			if($city==''){$city=$country;}
			$str=txtcleaner($country)."/".txtcleaner($state)."/".txtcleaner($city); 
			echo "<script type=\"text/javascript\">
					document.location=\"http://{$_SERVER['HTTP_HOST']}/$str/$loc_id/home\";
					</script>";			
		}
	
	
}
else if(isset($_POST['look_up']))
{
	if(!empty($_POST['city']))
	{
		$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['city']);
		$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `worldzips` where id ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}
	   else	if(!empty($_POST['state']))
	{
		$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['state']);
		$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `worldzips` where id ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}
	  else	if(!empty($_POST['country']))
	{
		$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['country']);
		$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `worldzips` where country ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	}else{
		echo "<script type=\"text/javascript\">
					document.location=\"http://{$_SERVER['HTTP_HOST']}\";
					</script>";			
	}
	
		while($row = mysqli_fetch_array($lookup))
		{	
			
			$state=$row['region1'];
			$country=$row['country'];
			$id=$row['id'];
			
			/*if($row['region2']!="")
			{
				$city=$row['region2'];
			}
			elseif($row['region3']!="")
			{
				$city=$row['region3'];
			}
			else
			{
				$city=$row['locality'];
			}*/
			$city=$row['locality'];
			if($state==''){$state=$country;}
			if($city==''){$city=$country;}
			$str=txtcleaner($country)."/".txtcleaner($state)."/".txtcleaner($city); 
			echo "<script type=\"text/javascript\">
					document.location=\"http://{$_SERVER['HTTP_HOST']}/$str/$id/home\";
					</script>";			
		}
	
	
}
?>