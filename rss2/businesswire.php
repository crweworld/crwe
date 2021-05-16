<?php
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: text/html; charset=iso-8859-1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');

include ('connect_me.php');
include ('txtcleaner.php');
$post_doc= date("Y-m-d");

{ $dir = $_SERVER['DOCUMENT_ROOT']."/businesswire";}


 $files = array_diff(scandir($dir), array('..', '.'));
$replace=array('<title>','</title>','<body>','</body>',"chr(194)");
/*$pattern = array("/h1 {(.*?)}/",'/h2 {(.*?)}/','/p {(.*?)}/' ,'/body {(.*?)}/' ,'/a:link {(.*?)}/' ,'/a:visited {(.*?)}/' ,'/a:active, a:hover {(.*?)}/' ,'/a img {(.*?)}/', '/<\/style>/');
$style="#content-news .main-news{color:#737373;font-size:14px;line-height:inherit;text-align:inherit}#bwNews{overflow-x:scroll}</style>";*/

foreach($files as $file)
{
	$fileExt = end(explode(".", $file)); 
	if($fileExt=='html')
	{		
		$myfile = fopen($dir.'/'.$file, "r") or die("Unable to open file!");
		$html= fread($myfile,filesize($dir.'/'.$file));
		
		$config = array(
				   'indent'         => true,
				   'output-xhtml'   => true,
				   'wrap'           => 200);		
		$tidy = new tidy;
		$tidy->parseString($html, $config, 'utf8');
		$html=$tidy->cleanRepair();
		$html=$tidy;
		
		preg_match("/<title[^>]*>(.*?)<\/title>/is", $html, $matches2);   
		 $post_title= mysqli_real_escape_string($GLOBALS["___mysqli_ston"], htmlspecialchars_decode(htmlSpecialChars(trim (str_replace($replace,"",$matches2[0]))))) ;
		
		preg_match("/<body[^>]*>(.*?)<\/body>/is", $html, $matches);
		//$post_description = mysql_real_escape_string(preg_replace("/<div class=\"bwStorySubheadline\"[^>]*>(.*?)<\/div>/is", "", (str_replace($replace,"",$matches[0]))));
		$post_description = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], str_replace($replace,"",$matches[0]));
		
		/*preg_match("/<style[^>]*>(.*?)<\/style>/is", $html, $matches3); 
		$post_description .= preg_replace($pattern, " ", $matches3[0]);
		
		$post_description .= $style;*/
		
		$post_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where post_title='$post_title'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($post_sql['count(*)'] == 0)
		 {
			 //, '{$file}'
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `posts`(`post_title`, `post_description`, `post_doc`, `cat_id`, `cat_status`, `post_status`) VALUES ('$post_title', '$post_description', '$post_doc',39, 'publish', 'publish')") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			$post_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);	
			$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='39' and cat_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($cat_result = mysqli_fetch_array($cat_id))
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
		else{
			  echo '<b>Duplicate</b> -> '. $post_title. '<br>';	
		}
	}
	unlink($dir.'/'.$file);
	fclose($myfile);
}
$deldate = date('Y-m-d', strtotime("-85 days"));
mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `posts` WHERE cat_id = '39' and  `post_doc` <= '$deldate' ");
((is_null($___mysqli_res = mysqli_close($mysql_link))) ? false : $___mysqli_res);
?> 
