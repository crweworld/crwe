<style>
a{
	text-decoration:none;
	color:#000;
}
</style>
<?php
include ('../subs/connect_me.php');
if($_POST)
{

$q=strtoupper($_POST['searchword']);

$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], "select DISTINCT city from location where city like '%$q%' order by loc_id LIMIT 10");
while($row=mysqli_fetch_array($sql_res))
{

$city=$row['city'];


$re_city='<b>'.$q.'</b>';

$final_city = str_ireplace($q, $re_city, $city);


?>


<div class="display_box" align="left">
<?php echo $final_city; ?><br/>
</div>




<?php
}

}
else
{

}


?>
