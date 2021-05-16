<?php
include ('connect_me.php');
include ('txtcleaner.php');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: text/html; charset=iso-8859-1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');
$xml=("http://www.media-outreach.com/release.php/RSS/crweworld.com/24537?language=en");
$content = file_get_contents($xml);
$rss = new SimpleXmlElement($content);

foreach ($rss->entry as $item)
{
	$post_image_loc=null;
	$source_url= htmlSpecialChars($item->id); 
	$post_title= mysqli_real_escape_string($GLOBALS["___mysqli_ston"], htmlspecialchars_decode(htmlSpecialChars($item->title))) ;
	$post_doc= date('Y-m-d',strtotime($item->published));
	$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $item->content );
	if (isset($item->image->url)){
		$post_image_loc= $item->image->url;
	 }
	 	
	$post_description .='<br> <br><p><em>&copy; '.date("Y").' Media OutReach Limited. All Rights Reserved.</em></p>';
	$cat_id='45';

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