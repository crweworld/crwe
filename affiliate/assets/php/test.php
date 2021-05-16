<?php
include ('../../subs/connect_me.php');

$edit_user = mysql_query("SELECT * FROM affi_user") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					$dd=$results['id']+1000;
					mysql_query("UPDATE `affi_user` SET `affi_id`='$dd' where id='{$results['id']}'");
				}

?>