<?php 
include( 'subs/header.php' );
$result = mysql_query("SHOW FULL PROCESSLIST");
while ($row=mysql_fetch_array($result)) {
  $process_id=$row["Id"];
  if ($row["Time"] > 10 ) {
  echo '<br>'.  $sql="KILL $process_id";
    mysql_query($sql);
  }
}
   /*$result = mysqli_query($GLOBALS["___mysqli_ston"],"SELECT  * FROM `crweworl_us`.`posts` WHERE `post_url` is null");
while ($row=mysqli_fetch_array($result)) {
	
	$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='{$row['cat_id']}' and cat_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($cat_result = mysqli_fetch_array($cat_id))
			{
				$cat_name=$cat_result['cat_name'];
			}
	$post_url= "/article/".txtcleaner($cat_name)."/".$row['post_id']."/".txtcleaner($row['post_title']);	
	//mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `crweworl_us`.`posts` set `post_url`='$post_url' where `post_id`='{$row['post_id']}'");
	
}*/   
?>



