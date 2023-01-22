<?php 
if($_SERVER['HTTP_HOST']=='localhost'){
	$geo_country='United States';
	$geo_region='Nevada';
	$geo_city='Las Vegas';
	$geo_region_code='NV';
	$geo_cont= 'North America';
}
else if($_SERVER['SERVER_ADDR'] == '206.81.6.123'){
	require_once('/var/www/vhosts/crweworld.com/httpdocs/geoip/location.php');
}
else{
	
	require_once('/var/www/html/vhosts/crweworld.com/public_html/geoip/location.php');
}


			
if(isset($_SESSION['post_country']))
{	
	if(isset($_SESSION['post_city']))
	{
		if(($_SESSION['post_city'])=="")
		{$spacer="";}else{ $spacer=",";}
		$api_state="{$_SESSION['post_city']}"."$spacer"." {$_SESSION['post_country']}";
		$api_local=$_SESSION['post_city'];
	}

	/*if(isset($_SESSION['post_local']))
	{
		$api_state="{$_SESSION['post_local']}"."$spacer"." {$_SESSION['post_country']}";
		$api_local=$_SESSION['post_local'];
	}*/
	
	/* header image */
	$headerimg="";
	if($_SESSION['post_country']== "USA" )
	{		
		$region_code=$_SESSION['post_state'];
		include ('usa_states.php');
	}
	elseif($_SESSION['post_country']!="USA")
	{		
		$post_country=$_SESSION['post_country'];
		include ('country.php');
	}
	/* end header image */	
	
}
else
{
	if(($geo_city)=="")
	{	$spacer="";	}
	else
	{$spacer=", "; }
	
	$post_country=$geo_country;
	$post_continent=txtcleaner($geo_cont);
	$api_state=$geo_city.$spacer.strtoupper($geo_country);
	$api_local=$geo_city;
	if($geo_country == 'China'){
	 exit();
	}
	/* header image */
	$headerimg="";
	if($post_country != "United States")
	{
		$post_country=strtoupper($geo_country);	
		include ('country.php');
	}
	elseif($post_country =="United States")
	{		
		$region_code=$geo_region_code;	
		include ('usa_states.php');
	}
	/* end header image */
}

// define country,state,city
	if(isset($_SESSION['post_country']))
	{
		$post_country= txtcleaner($_SESSION['post_country']);
		if(isset($_SESSION['post_continent'])){$post_continent= txtcleaner($_SESSION['post_continent']);}else{$post_continent='';}
		
	}
	else
	{
		if(isset($geo_country))
		{
			$post_country= txtcleaner($geo_country);
			if($post_country=="united-states"){$post_country="usa";}
			$post_continent= txtcleaner($geo_cont);
		}
	}
		

	if(isset($_SESSION['post_state']))
	{
		$post_state= txtcleaner($_SESSION['post_state']);
	}
	else
	{
		if(isset($geo_region))
		{
			$post_state= txtcleaner($geo_region);
		}
		if($post_country=="usa"){include_once ('state2code.php');  $post_state=$state_a;}
	}
	
	if(isset($_SESSION['post_city']))
	{
		$post_city= txtcleaner($_SESSION['post_city']);
	}
	else
	{
		if(isset($geo_city))
		{
			$post_city= txtcleaner($geo_city);
		}
	}
	
	if(empty($post_country))
	{
		/*header("Location:http://{$_SERVER['HTTP_HOST']}/contact");*/
	}

?>