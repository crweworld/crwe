 <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<style>
a{
	text-decoration:none;
	color:#000;
}
</style>
<?php

include ('../subs/connect_me.php');
include('../subs/functions.php');
if($_POST)
{

$q=strtoupper(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['searchword']));

$sql_res="select id,country ,region1 as state, locality as city,postcode from worldzips where MATCH (postcode) AGAINST ('%$q%') and country!='UNITED STATES'  and country!='Canada'
 UNION
select `loc_id` as id, `country`,`state`,`city`, `zipcode` as postcode FROM `location` where MATCH (zipcode) AGAINST ('%$q%') 

ORDER BY city
LIMIT 5
";

$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], "$sql_res") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$count=mysqli_num_rows($sql_res);

if($count == '0')
{
	$sql_res="select `loc_id` as id, `country`,`state`,`city`, `zipcode` as postcode FROM `location` where zipcode= '$q'
ORDER BY city

";
}
else{
	$sql_res="select id,country ,region1 as state, locality  as city,postcode from worldzips where MATCH (postcode) AGAINST ('%$q%') and country!='UNITED STATES'  and country!='Canada' 
 UNION
select `loc_id` as id, `country`,`state`,`city`, `zipcode` as postcode FROM `location` where MATCH (zipcode) AGAINST ('%$q%') 

ORDER BY city

";
}
$sql_res=mysqli_query($GLOBALS["___mysqli_ston"], "$sql_res") or die(mysqli_error($GLOBALS["___mysqli_ston"]));

while($row=mysqli_fetch_array($sql_res))
{
$postcode=$row['postcode'];
$state=$row['state'];
$country=$row['country'];
$id=$row['id'];

	$city=$row['city'];



if($state==''){$state=$country;}
if($city==''){$city=$country;}




$re_postcode='<b>'.$q.'</b>';
$re_city='<b>'.$q.'</b>';

$final_postcode = str_ireplace($q, $re_postcode, $postcode);
$final_city = str_ireplace($q, $re_city, $city);
$str=txtcleaner($country)."/".txtcleaner($state)."/".txtcleaner($city); 


$len=strlen($final_postcode.$final_city.$state);

?>

<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/".$str."/".$id?>/home">
<div class="display_box" align="left" <?php if($len >= 38){echo "style=\"height: 55px;\"";}?> >
<?php echo $final_postcode; ?>&nbsp;<?php echo $final_city; ?>&nbsp;|&nbsp;<?php echo $state; ?> <br/>
<span style="font-size:9px; color:#999999; text-transform:uppercase"><?php echo $country; ?></span></div>
</a>



<?php
}

}
else
{

}


