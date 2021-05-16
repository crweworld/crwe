<?php 
session_start();
include('../../subs/connect_me.php');
if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
}

$savefile=mysql_query("UPDATE `affi_user` SET `ecard`='{$_POST['data']}' where id='{$_SESSION['affi_id']}'");


if($savefile==1){
	echo 'updated';
}

?>