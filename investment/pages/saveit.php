<?php 
ob_start();
session_start();
if(isset($_POST)){
	include( 'connect_me.php'); 
	$c=mysqli_fetch_array( mysqli_query( $mysql_link, "SELECT count(propid) as q FROM props WHERE userid='{$_SESSION['pub_id']}'" ) )or die( mysqli_error( $mysql_link ) );
	if($c['q']==0){
		 mysqli_query( $mysql_link, "INSERT INTO `props`(`userid`, `propid`) VALUES ('{$_SESSION['pub_id']}','{$_POST['pid']}')" )or die( mysqli_error( $mysql_link ) );
	}else{
		$d = mysqli_fetch_array( mysqli_query( $mysql_link, "SELECT propid FROM props WHERE userid='{$_SESSION['pub_id']}'" ) )or die( mysqli_error( $mysql_link ) );
		$x=explode(',',$d['propid']);array_push($x,$_POST['pid']);$pid=ltrim(implode(',',array_unique($x)),",");
		mysqli_query( $mysql_link, "UPDATE `props` SET `propid`='$pid' where userid='{$_SESSION['pub_id']}' " )or die( mysqli_error( $mysql_link ) );
	}
}

	?>