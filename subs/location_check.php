<?php

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
		/*if($post_country=="usa"){include_once ('state2code.php');  $post_state=$state_a;}*/
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