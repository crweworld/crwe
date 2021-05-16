<?php
include ('connect_me.php');
include ('txtcleaner.php');
header('Content-Type: text/html; charset=utf-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');
require_once 'src/Feed.php';
$rss = Feed::loadRss('http://fullcontentrss.com/feed.php?url=https%3A%2F%2Feuropa.eu%2Fnewsroom%2Fpress-releases.xml_en%3Ffield_press_release_by_topic_tid%3D36&key=413&hash=c7bef969db8e293e732b57d4bb01a170155e1433&max=10&links=preserve&exc=');

foreach ($rss->item as $item)
{
	$post_image_loc="";
	$source_url= htmlSpecialChars($item->link); 
	$post_title= mysqli_real_escape_string($GLOBALS["___mysqli_ston"], htmlspecialchars_decode(htmlSpecialChars($item->title))) ;
	$post_doc= date("Y-m-d", (int) $item->timestamp);
	$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $item->description);
	if (isset($item->{'enclosure'})){
		$post_image_loc= $item->enclosure['url'];
	 }
	 	
	$post_description .="<br> <br> Source: Europa.eu (Copyright European Commission) ";
	$cat_id='24';
	$post_continent='europe';
	/*
	LIST OF CONTINENT NAMES
	------------------------		
	africa
	antarctica
	asia
	europe
	north-america
	oceania
	south-america
	*/

	$post_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where post_title='$post_title'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($post_sql['count(*)'] == 0)
	 {
		mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `posts`(`post_title`, `post_description`, `source_url`, `post_image_loc`, `post_doc`, `cat_id`, `cat_status`, `post_status`,`trend`,`post_continent`) VALUES ('$post_title', '$post_description', '$source_url', '$post_image_loc', '$post_doc','$cat_id', 'publish', 'publish', 'trend_continent', 
		'$post_continent')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$post_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);		

		$cat_sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id' and cat_status='publish' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
		while($cat_result = mysqli_fetch_array($cat_sql))
		{
			$cat_name=$cat_result['cat_name'];
		}
		$post_url=  "/".$post_continent."/trendingnow/".txtcleaner($cat_name)."/".$post_id."/".txtcleaner($post_title);
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