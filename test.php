<?php
include ('subs/connect_me.php');
$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where `post_description` LIKE '%< rows=\"1\">%' ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
					 $post_description=str_replace("< rows=\"1\">","",$results['post_description']);
					mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET  `post_description`='$post_description' where `post_id`='{$results['post_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
				}
echo 'done'
?>