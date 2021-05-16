<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include('subs/connect_me.php');

$q = mysqli_query( $GLOBALS["___mysqli_ston"], "SELECT id FROM `information_schema`.`PROCESSLIST` where `TIME` > 200" )or die( mysqli_error( $GLOBALS["___mysqli_ston"] ) );
		while ( $r = mysqli_fetch_assoc( $q ) ) {
			echo 'killed-'.$r['id'].'<br>';
			mysqli_query( $GLOBALS["___mysqli_ston"], "KILL {$r['id']}");
		}


?>