<?php
require_once('oauth/twitteroauth.php');
require_once('oauth/tw_key.php');

    
	$link='http://crweworld.com'.$post_url;
	$post_title=stripslashes($post_title);
    if(strlen($post_title)>=116)
    {			
            $post_title = substr($post_title,0,116);
    }
	$status=$post_title.' '.$link;
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, '3318510966-04Gh7yekvLv7huk1mjF8RbWHjf9UuBVxqaUdNDw', 'lYGwaYfY6UOHWCxaPLJHS9z9DN5oKFOEpCqovPZavl3cB');
    $connection->post('statuses/update', array('status' => "$status"));
   
?>

