<?php
include ('../../subs/connect_me.php');


if(isset($_GET['verify']))
{
	

	$sql="SELECT * FROM affi_user WHERE hash='{$_GET['verify']}' and active='0' ";
	$result=mysql_query($sql);
	$count=mysql_num_rows($result);
	
	$sql="SELECT * FROM affi_user WHERE id='{$_GET['id']}' and (active='1' or active='2' ) ";
	$result=mysql_query($sql);
	$count2=mysql_num_rows($result);
	
	if($count2==1)
	{
		echo "<script>
			alert('Your Account is Verified Already. Now You Can Log In.');
			window.location.href='http://{$_SERVER['HTTP_HOST']}';
			</script>";
	}
	else if($count==1)
	{
		$hash=serialize(bin2hex(random_bytes(9)));
		
		$update_ok = mysql_query("UPDATE `affi_user` SET `active`='1' , `hash`='$hash' where `hash`='{$_GET['verify']}'")or die(mysql_error());
		if($update_ok == 1)
		{			
			
			echo "<script>
			alert('Your Account is Verified. Now You Can Log In. Thank you very much.');
			window.location.href='http://{$_SERVER['HTTP_HOST']}';
			</script>";
		}
	}
	
	else
	{
		echo "<script>
			alert('Verification Code is Invalid');
			window.location.href='http://{$_SERVER['HTTP_HOST']}';
			</script>";
	}
}
?>