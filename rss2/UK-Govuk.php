<?php
include ('connect_me.php');
include ('txtcleaner.php');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: text/html; charset=iso-8859-1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');
require_once 'src/Feed.php';
$rss = Feed::loadRss('http://fullcontentrss.com/feed.php?url=https%3A%2F%2Fwww.gov.uk%2Fsearch%2Fnews-and-communications.atom%3Fkeywords%3D%2522Press%2BRelease%2522%26order%3Drelevance&key=413&hash=84a9322faed833bc63a4eb448d5ad96e3368807b&max=10&links=preserve&exc=');

foreach ($rss->item as $item)
{
	$post_image_loc="";
	$source_url= htmlSpecialChars($item->link); 
	$post_title= mysqli_real_escape_string($GLOBALS["___mysqli_ston"], htmlspecialchars_decode(htmlSpecialChars(str_replace('Press release:','',$item->title)))) ;
	$post_doc= date("Y-m-d", (int) $item->timestamp);
	$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $item->description);
	if (isset($item->{'enclosure'})){
		$post_image_loc= $item->enclosure['url'];
	 }
	 	
	$post_description .="<br> <br> Source: Gov.uk (Contains public sector information licensed under the Open Government Licence v3.0.)";
	$cat_id='1';
	$post_country='united-kingdom';
	$post_state='british-forces';
	$post_city='united-kingdom';
	$post_zipid='bf1-4at';

	$post_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where post_title='$post_title'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($post_sql['count(*)'] == 0)
	 {
		mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `posts`(`post_title`, `post_description`, `source_url`, `post_image_loc`, `post_doc`, `cat_id`, `cat_status`, `post_status`,`trend`, `post_state`, `post_city`, `post_country`, `zip_id`) VALUES ('$post_title', '$post_description', '$source_url', '$post_image_loc', '$post_doc','$cat_id', 'publish', 'publish', 'trend_country', 
		'$post_state', '$post_city', '$post_country', '$post_zipid')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$post_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);		

		$cat_sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id' and cat_status='publish' limit 1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
		while($cat_result = mysqli_fetch_array($cat_sql))
		{
			$cat_name=$cat_result['cat_name'];
		}
		$post_url=  "/".$post_country."/trendingnow/".txtcleaner($cat_name)."/".$post_id."/".txtcleaner($post_title);
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