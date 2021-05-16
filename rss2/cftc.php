<?php
include ('connect_me.php');
include ('txtcleaner.php');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: text/html; charset=iso-8859-1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');
require_once 'src/Feed.php';
$rss = Feed::loadRss('http://fullcontentrss.com/feed.php?url=https%3A%2F%2Fwww.cftc.gov%2FRSS%2FRSSGP%2Frssgp.xml&key=413&hash=2e339eab46ac15ef199b6aba158239f90bf19bbf&max=10&links=preserve&exc=');

foreach ($rss->item as $item)
{
	$post_image_loc=null;
	$source_url= htmlSpecialChars($item->link); 
	$post_title= mysqli_real_escape_string($GLOBALS["___mysqli_ston"], htmlspecialchars_decode(htmlSpecialChars($item->title))) ;
	$post_doc= date("Y-m-d", (int) $item->timestamp);
	$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $item->description);
	if (isset($item->{'enclosure'})){
		$post_image_loc= $item->enclosure['url'];
	 }
	 	
	$post_description .="<br> <br> Source: CFTC.gov";
	$cat_id='24';

	$post_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where post_title='$post_title'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($post_sql['count(*)'] == 0)
	 {
		mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `posts`(`post_title`, `post_description`, `source_url`, `post_image_loc`, `post_doc`, `cat_id`, `cat_status`, `post_status`) VALUES ('$post_title', '$post_description', '$source_url', '$post_image_loc', '$post_doc','$cat_id', 'publish', 'publish')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$post_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);		

		$cat_sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id' and cat_status='publish' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
		while($cat_result = mysqli_fetch_array($cat_sql))
		{
			$cat_name=$cat_result['cat_name'];
		}
		$post_url=  "/article/".txtcleaner($cat_name)."/".$post_id."/".txtcleaner($post_title);
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `post_url`='$post_url' where post_id='$post_id'");
		 //Auto share
		include('/home/crweworld/public_html/admin/auto_share/twitter.php');			
		//include('/home/crweworld/public_html/admin/auto_share/facebook.php');
		echo '<b>Posted</b> -> '. $post_title. '<br>';
	} 
	else{ echo '<b>Duplicate</b> -> '. $post_title. '<br>';}
	
}
((is_null($___mysqli_res = mysqli_close($mysql_link))) ? false : $___mysqli_res);
?>