 <?php
if (!strposa($agent, $fliter)) 
{
	if (strposa($agent, $browser)) 
	{
		if(isset($_GET['post_id']))
		{ 
			$view=$posts->post_view+1;	
			
			if(!isset($_SESSION['hashid']))
			{
			$_SESSION['hashid'] = uniqid();	
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `iptable`(`ip_add`, `hash`, `page`,`date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$_SESSION['hashid']}','{$_GET['post_id']}',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `post_view`='$view' where post_id='{$_GET['post_id']}' and post_status='publish' ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			} 
			else
			{
			$result = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) as vis_count FROM iptable where hash='{$_SESSION['hashid']}' and page='{$_GET['post_id']}' and ip_add='{$_SERVER['REMOTE_ADDR']}'"));
				if($result['vis_count']==0)
				{
				mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `iptable`(`ip_add`, `hash`, `page`, `date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$_SESSION['hashid']}','{$_GET['post_id']}',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `post_view`='$view' where post_id='{$_GET['post_id']}' and post_status='publish' ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				}
			}
		}
		
		if(isset($_GET['symbol']))
		{ 
			$view=$symbolInfo->views+1;	
			
			if(!isset($_SESSION['hashid']))
			{
			$_SESSION['hashid'] = uniqid();	
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `iptable`(`ip_add`, `hash`, `page`,`date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$_SESSION['hashid']}','{$_GET['symbol']}',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `symbol_list` SET `views`='$view' where link='{$_GET['symbol']}' ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			} 
			else
			{ 
			$result = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) as vis_count FROM iptable where hash='{$_SESSION['hashid']}' and page='{$_GET['symbol']}' and ip_add='{$_SERVER['REMOTE_ADDR']}'"));
				if($result['vis_count']==0)
				{
				mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `iptable`(`ip_add`, `hash`, `page`, `date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$_SESSION['hashid']}','{$_GET['symbol']}',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `symbol_list` SET `views`='$view' where link='{$_GET['symbol']}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				}
			}
		}
		
		if(isset($_GET['podtitle']))
		{ 
			$view=$pod->view+1;	
			
			if(!isset($_SESSION['hashid']))
			{
			$_SESSION['hashid'] = uniqid();	
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `iptable`(`ip_add`, `hash`, `page`,`date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$_SESSION['hashid']}','{$pod->title}',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `podcast` SET `view`='$view' where id='{$pod->id}' ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			} 
			else
			{
			$result = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) as vis_count FROM iptable where hash='{$_SESSION['hashid']}' and page='{$pod->title}' and ip_add='{$_SERVER['REMOTE_ADDR']}'"));
				if($result['vis_count']==0)
				{
				mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `iptable`(`ip_add`, `hash`, `page`, `date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$_SESSION['hashid']}','{$pod->title}',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `podcast` SET `view`='$view' where id='{$pod->id}'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				}
			}
		}
		
		
		
		if( strpos($server_url, "/watch/") !== false and isset($mvid_id))
		{ 
			
			$view=$vid_view+1;
			if(!isset($_SESSION['hashid']))
			{
			$_SESSION['hashid'] = uniqid();
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `iptable`(`ip_add`, `hash`, `page`, `date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$_SESSION['hashid']}','video$mvid_id',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 	
			 mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `vid_view`='$view' where vid_id='$mvid_id' and vid_status='publish' ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			} 
			else
			{
			$result = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) as vis_count FROM iptable where hash='{$_SESSION['hashid']}' and page='video$mvid_id' and ip_add='{$_SERVER['REMOTE_ADDR']}'"));		
				if($result['vis_count']==0)
				{
				mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `iptable`(`ip_add`, `hash`, `page`, `date`,`bot`) VALUES ('{$_SERVER['REMOTE_ADDR']}','{$_SESSION['hashid']}','video$mvid_id',NOW(),'$agent')") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `vid_view`='$view' where vid_id='$mvid_id' and vid_status='publish' ") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				}
			}
		}
	}
}
 ?>