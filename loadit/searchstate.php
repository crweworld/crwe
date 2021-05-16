<?php

include ('../subs/connect_me.php');

if( ($_POST['searchword'] == 'usa') or ($_POST['searchword'] == 'canada') )
{
		
$q=($_POST['searchword']);

$sql_res = "
SELECT loc_id, state
FROM  `location` 
WHERE country =  '$q'
GROUP BY state
ORDER BY state
"; 
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res);
	$count=mysqli_num_rows($result);
	if($count>0)
	{
		echo "<option class=\"col-md-12\" value=\"\">-- Select State or Province --</option>";
	}
$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res) or die(mysqli_error($GLOBALS["___mysqli_ston"]));

while($row=mysqli_fetch_array($sql_res))
{
$post_state=$row['state'];
$loc_id=$row['loc_id'];
include ('../subs/code2state.php');
?>

<option value="<?php echo $loc_id; ?>"><?php echo $post_state; ?></option>
<?php
}
}


else if( isset($_POST) )
{
	 
$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['searchword']);

$sql_res = "
SELECT id, region1 AS state
FROM  `worldzips` 
WHERE country =  '$q'
AND region1 NOT LIKE  ''
GROUP BY state
ORDER BY state
"; 
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res);
	$count=mysqli_num_rows($result);
	if($count>0)
	{
		echo "<option class=\"col-md-12\" value=\"\">-- Select State or Province --</option>";
	}
$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res) or die(mysqli_error($GLOBALS["___mysqli_ston"]));

while($row=mysqli_fetch_array($sql_res))
{
$state=$row['state'];
$id=$row['id'];
?>

<option value="<?php echo $id; ?>"><?php echo $state; ?></option>
<?php
}
}

?>
