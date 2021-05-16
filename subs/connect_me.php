<?php
if($_SERVER['HTTP_HOST']=='localhost'){
	$mysql_link = $GLOBALS["___mysqli_ston"]= mysqli_connect("localhost", "root", "", "crweworl_us");
}else{
	$mysql_link = $GLOBALS["___mysqli_ston"]= mysqli_connect("localhost", "crweworld", "G4JxfJ8z4SgzYa8", "crweworl_us");	
}

?>