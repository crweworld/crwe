<?php
if($_SERVER['HTTP_HOST']=='localhost'){
	$mysql_link = mysqli_connect("localhost", "root", "", "crwe_invest");
}else{
	$mysql_link = mysqli_connect("localhost", "root", "900:v429R", "crwe_invest");	
}
$mainserver= 'http://'.$_SERVER['HTTP_HOST'];
$nav= basename($_SERVER['PHP_SELF']);
?>