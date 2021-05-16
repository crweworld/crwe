<?php
include ('../../subs/connect_me.php');
if($_POST and $_POST['searchword'] >= 1000000001)
{
$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['searchword']);

$sql_res = "
SELECT country, region1 
FROM  `worldzips` 
WHERE id =  '$q' 
ORDER BY region1
"; 
$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
while($row=mysqli_fetch_array($sql_res))
{
$region1=str_replace("'","''","{$row['region1']}");
$country=str_replace("'","''","{$row['country']}");
}


$sql_res = "
SELECT id, locality AS city
FROM  `worldzips` 
WHERE country =  '$country'
AND locality NOT LIKE  '' AND region1='$region1'
GROUP BY city

UNION 

SELECT id, locality AS city
FROM  `worldzips` 
WHERE country =  'Iran'
AND locality NOT LIKE  ''   AND region1='$region1'
GROUP BY city

ORDER BY city
"; 
	$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res);
	$count=mysqli_num_rows($result);
	if($count>0)
	{
		echo "<option class=\"col-md-12\" value=\"\">-- Select City or Municipality --</option>";
	}
$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
while($row=mysqli_fetch_array($sql_res))
{
$city=$row['city'];
$id=$row['id'];
?>

<option value="<?php echo $id; ?>"><?php echo $city; ?></option>
<?php
}
}
else if($_POST and $_POST['searchword'] < 1000000001)
{
	$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['searchword']);

$sql_res = "
SELECT country, state 
FROM  `location` 
WHERE loc_id =  '$q' 
ORDER BY state
"; 
$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
while($row=mysqli_fetch_array($sql_res))
{
$state=str_replace("'","''","{$row['state']}");
$country=str_replace("'","''","{$row['country']}");
}


$sql_res = "
SELECT loc_id, city
FROM  `location` 
WHERE country =  '$country'
AND state='$state'
GROUP BY city
ORDER BY city
"; 

$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res);
	$count=mysqli_num_rows($result);
	if($count>0)
	{
		echo "<option class=\"col-md-12\" value=\"\">-- Select City or Municipality --</option>";
	}
$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], $sql_res) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
while($row=mysqli_fetch_array($sql_res))
{
$city=ucwords(strtolower($row['city']));
$loc_id=$row['loc_id'];
?>

<option value="<?php echo $loc_id; ?>"><?php echo $city; ?></option>
<?php
}
}
?>
