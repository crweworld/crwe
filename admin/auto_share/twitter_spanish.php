<?php
require_once('oauth/twitteroauth.php');
require_once('oauth/tw_key_spanish.php');

    
	$link='http://crweworld.com'.$post_url;
	$post_title=stripslashes($post_title);
    if(strlen($post_title)>=116)
    {			
            $post_title = substr($post_title,0,116);
    }
	$status=$post_title.' '.$link;
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, '776495625516888064-j8ei0xQLubwYljLBc3BqRkjZPeF1omY', 'hIkNuHosvhBZKi4tpw8ddd9bo8Z2k65SCAdbzeAxhUoL5');
    $connection->post('statuses/update', array('status' => "$status"));
   
?>

