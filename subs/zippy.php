<?php 
if(!empty($_POST['city']))
	{
		if($_POST['city'] < 1000000001)
		{
			$q=$_POST['city'];
			$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `location` where loc_id ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($row = mysqli_fetch_array($lookup))
			{	
				$post_city=txtcleaner($row['city']);
				$post_state=txtcleaner($row['state']);
				$post_country=txtcleaner($row['country']);
				$post_zipcode=txtcleaner($row['zipcode']);
				$post_zipid=txtcleaner($row['loc_id']);
				$post_local=$post_city;
								
				if($post_state==''){$post_state=$post_country;}
				if($post_city==''){$post_city=$post_country;}
				if($post_local==''){$post_local=$post_country;}			
			}
			
			
		}
		
		if($_POST['city'] > 1000000001)
		{
			$q=$_POST['city'];
			$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `worldzips` where id ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($row = mysqli_fetch_array($lookup))
			{				
				$post_state=txtcleaner($row['region1']);
				$post_country=txtcleaner($row['country']);
				$post_zipcode=txtcleaner($row['postcode']);
				$post_zipid=txtcleaner($row['id']);
				
				if($row['region2']!="")
				{
					$post_city=txtcleaner($row['region2']);
				}
				else
				{
					$post_city=txtcleaner($row['region3']);
				}
				
				$post_local=$post_city;
				
				
				if($post_state==''){$post_state=$post_country;}
				if($post_city==''){$post_city=$post_country;}
				if($post_local==''){$post_local=$post_country;}		
			}
		
		
		}
			
	}	
	elseif(!empty($_POST['state']))
	{
		if($_POST['state'] < 1000000001)
		{
			$q=$_POST['state'];
			$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `location` where loc_id ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($row = mysqli_fetch_array($lookup))
			{	
				$post_city=txtcleaner($row['city']);
				$post_state=txtcleaner($row['state']);
				$post_country=txtcleaner($row['country']);
				$post_zipcode=txtcleaner($row['zipcode']);
				$post_zipid=txtcleaner($row['loc_id']);
				$post_local=$post_city;
								
				if($post_state==''){$post_state=$post_country;}
				if($post_city==''){$post_city=$post_country;}	
				if($post_local==''){$post_local=$post_country;}				
			}
			
			
		}
		
		if($_POST['state'] > 1000000001)
		{
			$q=$_POST['state'];
			$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `worldzips` where id ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($row = mysqli_fetch_array($lookup))
			{				
				$post_state=txtcleaner($row['region1']);
				$post_country=txtcleaner($row['country']);
				$post_zipcode=txtcleaner($row['postcode']);
				$post_zipid=txtcleaner($row['id']);
				
				if($row['region2']!="")
				{
					$post_city=txtcleaner($row['region2']);
				}
				else
				{
					$post_city=txtcleaner($row['region3']);
				}
				
				$post_local=$post_city;
				
				
				if($post_state==''){$post_state=$post_country;}
				if($post_city==''){$post_city=$post_country;}
				if($post_local==''){$post_local=$post_country;}		
			}
		
		
		}
			
	}
	elseif(!empty($_POST['country']))
	{
		if($_POST['country']=='usa' or $_POST['country']=='canada' )
		{		
			$q=$_POST['country'];
			$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `location` where country ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
		
			while($row = mysqli_fetch_array($lookup))
			{
			
				$post_city=txtcleaner($row['city']);
				$post_state=txtcleaner($row['state']);
				$post_country=txtcleaner($row['country']);
				$post_zipcode=txtcleaner($row['zipcode']);
				$post_zipid=txtcleaner($row['loc_id']);
				
				$post_local=$post_city;
				if($post_state==''){$post_state=$post_country;}
				if($post_city==''){$post_city=$post_country;}	
				if($post_local==''){$post_local=$post_country;}				
			}	
			
			
		
		}
		else
		{
			$q=$_POST['country'];
			$lookup = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `worldzips` where country ='$q' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($row = mysqli_fetch_array($lookup))
			{	
				
				$post_state=txtcleaner($row['region1']);
				$post_country=txtcleaner($row['country']);
				$post_zipcode=txtcleaner($row['postcode']);
				$post_zipid=txtcleaner($row['id']);
				
				if($row['region2']!="")
				{
					$post_city=txtcleaner($row['region2']);
				}
				else
				{
					$post_city=txtcleaner($row['region3']);
				}
				
				$post_local=$post_city;
				if($post_state==''){$post_state=$post_country;}
				if($post_city==''){$post_city=$post_country;}
				if($post_local==''){$post_local=$post_country;}		
			}
			
			
		}
	}	
    ?>