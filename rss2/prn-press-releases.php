<?php
include ('connect_me.php');
include ('txtcleaner.php');
header('Content-Type: text/html; charset=utf-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');

require_once 'src/Feed.php';
$rss = Feed::loadRss('http://api.prnewswire.com/releases/version01/getFullTextRSS?query=language:en%20AND%20(combinedticker:[A%20TO%20Z])&apikey=da1df99afd133cd3&getRecent=true&timeInterval=30&');
  //http://crweworld.com/rss2/getFullTextRSS.xml
 //http://api.prnewswire.com/releases/version01/getRSS?apikey=da1df99afd133cd3
 foreach ($rss->item as $item): 
	$source_url= htmlSpecialChars($item->link); 
	$post_title= mysqli_real_escape_string($GLOBALS["___mysqli_ston"], htmlspecialchars_decode(htmlSpecialChars($item->title))) ;
	$post_doc= date("Y-m-d", (int) $item->timestamp);	
	$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $item->description); //<p style="text-align: left;margin-bottom: 5px;">View original content: <a href="'.$source_url.'" target="_blank">'.$source_url.'</a></p>
	$post_description .='<br><p><em>&copy; '.date("Y").' PR Newswire. All Rights Reserved.</em></p>';
	
	$post_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where post_title='$post_title'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($post_sql['count(*)'] == 0)
	 {
		 if($source_url!=''){
		mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `posts`(`post_title`, `post_description`, `source_url`, `post_doc`, `cat_id`, `cat_status`, `post_status`) VALUES ('$post_title', '$post_description', '$source_url', '$post_doc','34', 'publish', 'publish')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));		
		$post_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);	
		$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='34' and cat_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
		while($cat_result = mysqli_fetch_array($cat_id))
		{
			$cat_name=$cat_result['cat_name'];
		}
		$post_url=  "/article/".txtcleaner($cat_name)."/".$post_id."/".txtcleaner($post_title);
		
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET  `post_url`='$post_url' where post_id='$post_id'");			
			 //Auto share
			//include('/home/crweworld/public_html/admin/auto_share/twitter.php');			
			//include('/home/crweworld/public_html/admin/auto_share/facebook.php');	 	
		echo '<b>Posted</b> -> '. $post_title. '<br>';
		 }
	} 
	else{
		  echo '<b>Duplicate</b> -> '. $post_title. '<br>';	
	}
  endforeach;   ((is_null($___mysqli_res = mysqli_close($mysql_link))) ? false : $___mysqli_res);?>
