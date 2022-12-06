<?php
session_start();
include ('connect_me.php');
include ('functions.php');
include('header_info.php');

foreach ($_POST as $key => $value)
	{
		$$key=trim(str_replace('&nbsp;',' ',mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $value))); 
	} 
if(isset($_SESSION['pub_id'])){$pub_id=$_SESSION['pub_id'];$href='javascript:void(0);';}else{$pub_id=-1;$href='/dashboard/login';}

//symbol tag 
if(isset($searchsymbol) or isset($searchitSymbol))
{	
	if(isset($searchsymbol)){ $q=str_replace(" ","%",str_replace("$","",$searchsymbol));}
 	else{$q=str_replace(" ","%",str_replace("$","",$searchitSymbol));}
	//$sql=mysql_query("select * from symbol_list where symbol like '%$q%' or name like '%$q%' or exchange like '%$q%' order by symbol limit 5");
	$countsql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM `symbol_list` WHERE `symbol` LIKE '$q'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($countsql['count(*)']==0){
		$sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM symbol_list WHERE `symbol` LIKE '$q%' or `name` LIKE '$q%' or `exchange` LIKE '$q%' limit 5");
	}else{
		$sql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM symbol_list WHERE `symbol` LIKE '$q' limit 5"); 
	}	
	
	while($row=mysqli_fetch_array($sql))
	{
		if(isset($searchsymbol)){ $href='javascript:void(0);';}else{$href='/symbol/'.$row['link'];}
		echo '<a href="'.$href.'" class="addsymbol" title="'.$row['link'].'" style="all: initial;">
<div class="display_box" align="left" style="height: 55px;">
<b>'.$row['symbol'].'</b> '.$row['name'].'<br>
<span style="font-size:9px; color:#999999; text-transform:uppercase">'.$row['exchange'].'</span></div>
</a>';
	}
}
//user tag
if(isset($searchuser) or isset($searchitUser))
{
	if(isset($searchuser)){$q=str_replace(" ","%",str_replace("@","",$searchuser));}
	else{$q=str_replace(" ","%",str_replace("@","",$searchitUser));}	
	$sql=mysqli_query($GLOBALS["___mysqli_ston"], "select * from user where username like '%$q%' order by username limit 5");
	while($row=mysqli_fetch_array($sql))
	{
		if(isset($searchuser)){$href='javascript:void(0);';}else{$href='/user/'.$row['username'];}		
		echo '<a href="'.$href.'" class="adduser" title="'.$row['username'].'" style="all: initial;">
<div class="display_box" align="left" style="height: 55px;"><b>'.$row['username'].'</b><br>
<span style="font-size:9px; color:#999999; text-transform:uppercase">'.$row['fname'].' '.$row['lname'].'</span></div>
</a>';
	}
}

// post new conversation
if(isset($comment) or isset($comment_md)){
	if(isset($comment_md)){$comt=$comment_md;$db='stock_replies';$dpath='stockreply';$md='-md';$refdb=',`ref_id`';$refval=",'$ref_id'";}
	elseif(isset($comment)){ $comt=$comment;$db='stock_comments';$dpath='stockcmts';$md=$refdb=$refval='';}	
	 
	$comt=stripslashes($comt);
	//url conv
	$url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i'; 
	$comt = preg_replace($url, '<a class="pretty-link" href="$0" target="_blank" title="$0">$0</a>', $comt);
	//tag symbol
	preg_match_all('/<a class="pretty-link" href="\#"><s>\$<\/s>([A-Z-.]+)<\/a>/is', $comt, $match);
	for ($i = 0; $i < count($match[0]); $i++) {
		$comt=stripslashes(preg_replace("/".preg_quote($match[0][$i],'/')."/",'$'.preg_quote($match[1][$i],'/'), $comt));
	}
	preg_match_all('/\$([A-Z-.]+)/is', $comt, $match);
	foreach($match[0] as $val){
	$q=str_replace(" ","%",str_replace("$","",$val));
	$sym_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM symbol_list where `link` ='$q' order by symbol limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($sym_sql['count(*)'] != 0)
		 {
			$sym = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM symbol_list where `link` ='$q' order by symbol limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));		
			$sval= '<a class="pretty-link" href="/symbol/'.$sym->link.'"><s>$</s>'.$sym->link.'</a>';
			$comt=str_replace($val,$sval,$comt);
		 }
	}
	//tag user
	preg_match_all('/<a class="pretty-link" href="\#"><s>@<\/s>(\w+)<\/a>/is', $comt, $match2);
	for ($i = 0; $i < count($match2[0]); $i++) {
		$comt=preg_replace("/".preg_quote($match2[0][$i],'/')."/",'@'.preg_quote($match2[1][$i],'/'), $comt);
	}
	preg_match_all('/@(\w+)/is', $comt, $match2);
	foreach($match2[0] as $val2){
	$q=str_replace(" ","%",str_replace("@","",$val2));
	$user_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM user where username='$q' order by username limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($user_sql['count(*)'] != 0)
		 {
			$sym = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where username='$q' order by username limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));		
			$sval2= '<a class="pretty-link" href="/user/'.$sym->username.'"><s>@</s>'.$sym->username.'</a>';
			$comt=str_replace($val2,$sval2,$comt);
		 }
	}
	$comt=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $comt);
	//symbol_tag
	preg_match_all('/\$<\/s>(.*?)<\/a>/is', $comt, $match);
	$symbol_tag=strtoupper(implode(",",array_unique($match[1])));
	//tag
	preg_match_all('/\@<\/s>(.*?)<\/a>/is', $comt, $match2);
	$user_tag=strtolower(implode(",",array_unique($match2[1])));
	
	$com_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM `$db` where comment='$comt' and user_id='{$_SESSION['pub_id']}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if($com_sql['count(*)'] == 0)
	 {
		 if(isset($_FILES['stock_image']) and ($_FILES['stock_image']['size'][0] > 0))
		{
			$errors= array();		
			foreach($_FILES['stock_image']['tmp_name'] as $key => $tmp_name )
			{
				$file_name = $key.$_FILES['stock_image']['name'][$key];
				$file_size =$_FILES['stock_image']['size'][$key];
				$file_tmp =$_FILES['stock_image']['tmp_name'][$key];
				$file_type=$_FILES['stock_image']['type'][$key];	
				$kaboom = explode(".", $file_name); // Split file name into an array using the dot
				$fileExt = strtolower(end($kaboom));
				$hash=serialize(bin2hex(random_bytes(9)));

				$dirPath = "../assets/images/$dpath/{$_SESSION['pub_id']}";
				if (!file_exists("$dirPath")){mkdir("$dirPath", 0755, true);}	
				$moveResult = move_uploaded_file($file_tmp, "$dirPath/$hash.$fileExt");		
				$pic_url=str_replace('..','',$dirPath).'/'.$hash.'.'.$fileExt;
			}
			$ok=mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `$db` (`comment`, `user_id`, `stock_image`, `symbol_tag`, `user_tag` $refdb) VALUES ('$comt', '{$_SESSION['pub_id']}', '$pic_url', '$symbol_tag','$user_tag' $refval)")or die(mysqli_error($GLOBALS["___mysqli_ston"]));			
		}
		else{ 
			$ok=mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `$db` (`comment`, `user_id`, `symbol_tag`, `user_tag` $refdb) VALUES ('$comt', '{$_SESSION['pub_id']}', '$symbol_tag','$user_tag' $refval)")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		}
	
		if($ok==1){
			$data = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM $db where id='".((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res)." limit 1'"))or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			$user2 = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE `id`='{$data->user_id}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			$stock_image='';$stock_cmt='';
			if($data->stock_image!= NULL and $data->stock_image!=''){$stock_image='<a data-featherlight="image" href="'.$data->stock_image.'"><img class="img-responsive" style="margin: 10px 0px;" src="'.$data->stock_image.'"></a>';}
			if($data->comment!= NULL and $data->comment!=''){ $stock_cmt='<span>'.$data->comment.'</span>';}
			if(isset($comment_md)){
					$li='<li><a href="javascript:void(0);" class="lik_cmt-md_'.$data->id.' '.classLiked($_SESSION['pub_id'],$data->liked_by).' lik_it-md" id="'.$data->id.'"><i class="fa fa-thumbs-o-up"></i> <span class="lik_count-md_'.$data->id.'">'.zero(count(array_filter((explode(",",$data->liked_by))))).'</span></a></li>';
				}elseif(isset($comment)){
					$refcount=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM `stock_replies` where ref_id='$data->id'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
					$li='<li><a href="javascript:void(0);" data-href="/reply/'.$data->id.'" class="md-more"><i class=" fa fa-comment-o"></i>'.zero($refcount['count(*)']).'</a></li>
					<li><a href="javascript:void(0);" class="lik_cmt_'.$data->id.' '.classLiked($_SESSION['pub_id'],$data->liked_by).' lik_it" id="'.$data->id.'"><i class="fa fa-thumbs-o-up"></i> <span class="lik_count_'.$data->id.'">'.zero(count(array_filter((explode(",",$data->liked_by))))).'</span></a></li>
					<li><a href="javascript:void(0);" data-href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/user/'.$user2->username.'/message/'.$data->id.'" class="copy-url"><i class="fa fa-copy"></i></a></li>';
				}		

			echo '<div class="media"  id="media'.$md.'_'.$data->id.'">
						<div class="media-left">
							<a href="/user/'.$user2->username.'">
								<img class="media-object img-circle" onerror="this.src=\'/assets/images/avatar.png\'" src="'.$user2->pic.'" alt="Avatar">
							</a>
						</div>
						<div class="media-body">
							<div class="clearfix">
								<h4 class="media-heading pull-left">@'.$user2->username.'</h4>
								<span class="time pull-right">'. date("jS M, y", strtotime($data->created_on)).'</span>
							</div>
							'.$stock_cmt.$stock_image.'
							<ul class="nav nav-pills">
								'.$li.'							
							</ul>						
						</div>
					</div>';	
			}	
	 }else{
		 echo 'copy';
	 }
	
		
}

//show ideas
if(isset($ideasInfo))
{
	$commentId='100000000000000000';
}

//show liked
if(isset($likedInfo))
{
	$commentId='100000000000000000';
}

// show watchlistInfo
if(isset($watchlistInfo))
{ 
	$user=mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where id = '$watchlistInfo'")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	$user2=mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where id = '{$_SESSION['pub_id']}'")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `symbol_list` WHERE symbol in ('". str_replace(",","','",$user->watchlist)."')");
	while($symbol=mysqli_fetch_object($query))
	{
		$watchid=classLiked($symbol->symbol,$user2->watchlist); if($watchid=='liked'){$watchit='Watching';}else{$watchit='Watch';}
	 echo '<div class="media">				
				<div class="media-body">
					<div class="clearfix">
						<h4 class="media-heading pull-left">'.$symbol->name.'</h4><span class="time pull-right"><a href="'.$href.'" data-sym="'.$symbol->symbol.'" class="'.$watchid.' btn-sm">'.$watchit.'</a></span>
					</div>
					<span><a class="pretty-link" href="/symbol/'.$symbol->symbol.'"><s>$</s>'.$symbol->symbol.'</a></span>        
				</div>
			</div>';						
	}
}
// show followings,followers
if(isset($followingInfo) or isset($followersInfo))
{
	if(isset($followingInfo)){$userId=$followingInfo;}	elseif(isset($followersInfo)){$userId=$followersInfo;}
	$user=mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where id = '$userId'")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	if(isset($followingInfo)){$userIn=$user->following;} elseif(isset($followersInfo)){$userIn=$user->followers;} 
	if($userIn==''){$userIn='Null';}
	$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE id in ($userIn)");
	while($user2=mysqli_fetch_object($query))
	{
	 echo '<div class="media">
				<div class="media-left">
					<a href="/user/'.$user2->username.'"><img class="media-object img-circle" onerror="this.src=\'/assets/images/avatar.png\'" src="'.$user2->pic.'" alt="Avatar"> </a>
				</div>
				<div class="media-body">
					<div class="clearfix">
						<h4 class="media-heading pull-left">'.$user2->username.'</h4><span class="time pull-right">'.count($user2->followers).' Followers</span>
					</div>
					<span><a class="pretty-link" href="/user/'.$user2->username.'"><s>@</s>'.$user2->username.'</a></span>        
				</div>
			</div>';						
	}	
}

// load more conversation, ideas, liked
if(isset($commentId) or isset($commentId_md))
{
	if(isset($commentId_md)){$comId=$commentId_md;$db='stock_replies';$md='-md';} //for modal
	elseif(isset($commentId)){$comId=$commentId;$db='stock_comments';$md='';} //for main
	
	if(isset($symbol_tag)){ $where = "FIND_IN_SET('$symbol_tag', `symbol_tag`)";} //for symbol
	elseif(isset($user_id)){ $where = "(`user_id`='$user_id' or FIND_IN_SET ('$user_tag', `user_tag`))";} //for user
	elseif(isset($ref_id)){ $where = "`ref_id`='$ref_id'";} //for reply
	elseif(isset($likedInfo)){ $where = "FIND_IN_SET ('$likedInfo', `liked_by`)";} // for user liked
	
	$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `$db` WHERE $where and id < '$comId' order by `id` DESC limit 20");
	$count=mysqli_num_rows($query);
	
	if($count>0)
	{
		while($data=mysqli_fetch_array($query))
		{
			$user2 = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE `id`='{$data['user_id']}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			
			if(isset($commentId_md)){
				$li='<li><a href="'.$href.'" class="lik_cmt-md_'.$data['id'].' '.classLiked($pub_id,$data['liked_by']).' lik_it-md" id="'.$data['id'].'"><i class="fa fa-thumbs-o-up"></i> <span class="lik_count-md_'.$data['id'].'">'.zero(count(array_filter((explode(",",$data['liked_by']))))).'</span></a></li>';
			} else if(isset($commentId)){
				$refcount=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM `stock_replies` where ref_id='{$data['id']}'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
				$li='<li><a href="'.$href.'" data-href="/reply/'.$data['id'].'" class="md-more"><i class=" fa fa-comment-o"></i>'.zero($refcount['count(*)']).'</a></li>
				<li><a href="'.$href.'" class="lik_cmt_'.$data['id'].' '.classLiked($pub_id,$data['liked_by']).' lik_it" id="'.$data['id'].'"><i class="fa fa-thumbs-o-up"></i> <span class="lik_count_'.$data['id'].'">'.zero(count(array_filter((explode(",",$data['liked_by']))))).'</span></a></li>
				<li><a href="javascript:void(0);" data-href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/user/'.$user2->username.'/message/'.$data['id'].'" class="copy-url"><i class="fa fa-copy"></i></a></li>';
			}
			
			$stock_image='';$stock_cmt='';
			if($data['stock_image']!= NULL and $data['stock_image']!=''){$stock_image='<a data-featherlight="image" href="'.$data['stock_image'].'"><img class="img-responsive" style="margin: 10px 0px;" src="'. $data['stock_image'].'"></a>';}
			if($data['comment']!= NULL and $data['comment']!=''){ $stock_cmt='<span>'.$data['comment'].'</span>';}
			$cmt_id=$data['id'];
			echo'<div class="media" id="media'.$md.'_'.$data['id'].'">
					<div class="media-left">
						<a href="/user/'.$user2->username.'">
							<img class="media-object img-circle" onerror="this.src=\'/assets/images/avatar.png\'" src="'.$user2->pic.'" alt="Avatar">
						</a>
					</div>
					<div class="media-body">
						<div class="clearfix">
							<h4 class="media-heading pull-left">@'.$user2->username.'</h4>
							<span class="time pull-right">'.date("jS M, y", strtotime($data['created_on'])).'</span>
						</div>
						'.$stock_cmt.$stock_image.'
						<ul class="nav nav-pills">							
							'.$li.'
						</ul>';
						if(isset($_SESSION['id'])){
						echo '<a href="javascript:void(0);" class="del_cmt'.$md.' remove" id="'.$data['id'].'"><i class="fa fa-times"></i></a>';
						}
				echo '</div>
				</div>';			
		}
		if(!isset($likedInfo)){
			echo '<a href="#"><div id="load_more'.$md.'"><div id="'.$cmt_id.'" class="more_button'.$md.' btn" style="width:100%;margin-top: 2em;" >Load More</div></div></a>';
		}				
	}
		
}

// delete the conversation
if(isset($_SESSION['id'])){
	if(isSet($delId) or isSet($delId_md))
	{
		if(isset($delId_md)){ $delId=$delId_md;$db='stock_replies';}
		elseif(isset($delId)){$delId=$delId;$db='stock_comments';}

		$count=mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `$db` WHERE id = '$delId'"));
		if($count==1){		
			$data = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `$db` where id='".$delId." limit 1'"))or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			if($data->stock_image!=NULL){unlink('..'.$data->stock_image);}	
			if($db=='stock_comments'){
				$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_replies` WHERE `ref_id`='".$delId."'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
				while($data2=mysqli_fetch_array($query))
				{
					if($data2['stock_image']!=NULL){unlink('..'.$data2['stock_image']);}				
				}
				$query=mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `stock_replies` where ref_id='".$delId."'");
			}
			$query=mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `$db` WHERE id = '$delId'");	
			RemoveEmptySubFolders('../assets/images/');
		}

	}
}

// liked_by
if(isSet($likId) or isSet($likId_md))
{
	if(isset($likId_md)){ $likId=$likId_md;$db='stock_replies';}
	elseif(isset($likId)){$likId=$likId;$db='stock_comments';}
	
	$user_id = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT liked_by FROM `$db` WHERE `id`='$likId'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	$usr_list = explode(',',$user_id['liked_by'] ); 

	if (in_array($_SESSION['pub_id'], $usr_list))
	  {
		  foreach($usr_list as $list => $key)
			if (($key = array_search($_SESSION['pub_id'], $usr_list)) !== false) {
				unset($usr_list[$key]);
			}
		 $liked_by = ltrim(implode(',',$usr_list), ',');
		 mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `$db` SET `liked_by`='$liked_by' WHERE id = '$likId'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		  
	  }
	else
	  {
	  	array_push($usr_list,$_SESSION['pub_id']); 
		$liked_by = ltrim(implode(',',$usr_list), ',');
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `$db` SET `liked_by`='$liked_by' WHERE id = '$likId'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	  }
}
//watch
if(isSet($watch))
{	
	$user_id = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE `id`='{$_SESSION['pub_id']}'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	$watchlist = explode(',',$user_id['watchlist'] ); 	 	

	if (in_array($watch, $watchlist))
	  {
		  foreach($watchlist as $list => $key)
			if (($key = array_search($watch, $watchlist)) !== false) {
				unset($watchlist[$key]);
			}
		   $watching = ltrim(implode(',',$watchlist), ',');
		  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `watchlist`='$watching' WHERE id = '{$_SESSION['pub_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));		
		  mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `symbol_list` SET `watchers`= `watchers`-1 WHERE `symbol` = '$watch'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
	  }
	else
	  {
	  	array_push($watchlist,$watch);
		$watching = ltrim(implode(',',$watchlist), ',');
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `watchlist`='$watching' WHERE id = '{$_SESSION['pub_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `symbol_list` SET `watchers`=`watchers`+1 WHERE `symbol` = '$watch'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	 
	  }		
	
}
//follow
if(isSet($follow))
{
	if($follow!=$_SESSION['pub_id']){
	$user_id = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE `id`='{$_SESSION['pub_id']}'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	$following_list = explode(',',$user_id['following'] ); 
	$user_id2 = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE `id`='{$follow}'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
	$followers_list = explode(',',$user_id2['followers'] ); 	

	if (in_array($follow, $following_list))
	  {
		  foreach($following_list as $list => $key)
			if (($key = array_search($follow, $following_list)) !== false) {
				unset($following_list[$key]);
			}
		   $following = ltrim(implode(',',$following_list), ',');
		   mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `following`='$following' WHERE id = '{$_SESSION['pub_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		  
		  foreach($followers_list as $list => $key)
			if (($key = array_search($_SESSION['pub_id'], $followers_list)) !== false) {
				unset($followers_list[$key]);
			}
		   $followers = ltrim(implode(',',$followers_list), ',');		 
		    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `followers`='$followers' WHERE id = '$follow'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	  }
	else
	  {
	  	array_push($following_list,$follow);
		$following = ltrim(implode(',',$following_list), ',');
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `following`='$following' WHERE id = '{$_SESSION['pub_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		  
		  array_push($followers_list,$_SESSION['pub_id']);
		$followers = ltrim(implode(',',$followers_list), ',');
		 mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `followers`='$followers' WHERE id = '$follow'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	  }
		
	}else{echo 'You can not follow yourself';}
}

// load category
if(isset($catLoad)){
	if(!isset($sqlnum)){$sqlnum='default';}
	switch ($sqlnum) {
    case "trendingnow":
        $sqladd="AND (( post_state ='$post_state' AND trend='trend_state') OR ( post_country ='$post_country' AND trend='trend_country') OR (post_continent='$post_continent' AND trend='trend_continent'))";
        break;
    case "localnews":
        $sqladd="AND trend='localnews' and post_city='$post_city'";
        break;    
    default:
        //$sqladd="AND ((cat_id ='$cat_id' and trend is null) or (cat_id ='$cat_id' and ( post_state ='$post_state' OR post_country ='$post_country' OR post_continent='$post_continent')))";
		$sqladd="AND ((cat_id ='$cat_id' and trend is null) or ( cat_id ='$cat_id' and trend='localnews' and post_city='$post_city') or ( cat_id ='$cat_id' and post_state ='$post_state' AND trend='trend_state') OR ( cat_id ='$cat_id' and post_country ='$post_country' AND trend='trend_country') OR (cat_id ='$cat_id' and post_continent='$post_continent' AND trend='trend_continent')) ";
	}
	
	$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `posts` where post_status='publish' $sqladd and `post_doc`<='$catLoad' and post_id NOT IN ('" . implode("','",$_SESSION['rmv_id']) . "') ORDER BY `post_doc` DESC, `post_id` DESC LIMIT 20");
	$count=mysqli_num_rows($query);	
	if($count>0)
	{	
		while($post=mysqli_fetch_object($query))
		{	
			$_SESSION['rmv_id'][]=$post->post_id;
			$doc = $post->post_doc;
			$cat = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$post->cat_id' and cat_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			  echo  '
					<div class="media">
						<div class="media-body">
							<div class="media-heading"><a title="'.htmlspecialchars_decode($post->post_title).'" href="'.$post->post_url.'" class="title">'.htmlspecialchars_decode($post->post_title).'</a></div>
							<div class="info"><span class="category">'.$cat->cat_name.'</span><span class="fa fa-circle"></span><span class="date-created">'.$post->post_doc.'</span>
							</div>
							<div class="description">'.substr(strip_tags(htmlspecialchars_decode($post->post_description)), 0, 300).'....Read more</div>
						</div>
					</div>'; 
		}
		echo '<a href="#"><div id="load_more"><div id="'.$doc.'" class="more_button btn" style="width:100%;margin-top: 2em;" >Load More</div></div></a>';
	}	
}
// load pod
if(isset($podId)){ 
	$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `podcast` where status='1' and `id`<'$podId' ORDER BY  `id` DESC LIMIT 20");
	$count=mysqli_num_rows($query);	
	if($count>0)
	{	
		while($pod=mysqli_fetch_object($query))
		{
			$pdid=$pod->id;
			if($pod->description!=''){
				$description='<div class="description">'.substr(strip_tags(htmlspecialchars_decode($pod->description)), 0, 300).'....</div>';
			}else{
				$description='';
			}
			$user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where `id`='$pod->user_id' and active='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 

	  echo  '
			<div class="media">															
				<div class="media-body">
					<div class="media-heading"><a title="'.htmlspecialchars_decode($pod->title).'" href="'.$pod->url.'?autoplay=true" class="title">'.htmlspecialchars_decode($pod->title).'</a></div>
					<div class="info"><span class="category">Podcast- '.ucfirst($user->username).'</span><span class="fa fa-circle"></span><span class="date-created">'.date('Y-m-d', strtotime($pod->created_on)).'</span>
					</div>
					'.$description.'
				</div>
				<div class="media-right"><a href="'.$pod->url.'?autoplay=true"><i class="fa fa-play-circle" aria-hidden="true"></i></a></div>
			</div>';
		}
		echo '<a href="#"><div id="load_more"><div id="'.$pdid.'" class="more_button btn" style="width:100%;margin-top: 2em;" >Load More</div></div></a>';
	}	
}
// load search
if(isset($searchquery)){
	//if(!isset($searchtype)){$searchtype='default';}
	switch ($searchtype) {
    case "videos":
        $sqladd="SELECT * FROM videos where vid_status='publish' and `vid_doc`<='$getDate' and vid_id NOT IN ('" . implode("','",$_SESSION['rmv_id']) . "') and (vid_title like '%$searchquery%' or vid_description like '%$searchquery%') ORDER BY `vid_doc` DESC, `vid_id` DESC LIMIT 20";
        break; 
	case "web":
        include('simple_html_dom.php');
		$html = new simple_html_dom();
		$html->load_file('https://www.bing.com/search?q='.str_replace(' ','+',$searchquery).'&first='.$getDate);
		foreach($html->find('li.b_algo')as $element) 
		{ 
			$gtitle=$element->find('h2 a',0)->plaintext;
			$gurl=str_replace('','',urldecode($element->find('h2 a',0)->href));

			 echo'
				<div class="media">
					<div class="media-body">
						<div class="media-heading"><a title="'.htmlspecialchars_decode($gtitle).'" target="_blank" href="'.$gurl.'" class="title">'.htmlspecialchars_decode($gtitle).'</a></div>';
						if($element->find('div.b_caption > p',0) != null ){
						 echo'<div class="description">'.strip_tags(htmlspecialchars_decode($element->find('div.b_caption > p',0)->plaintext)).'....Read more</div>';
						}
			 echo'</div>
				</div>';
		}	
		 echo'<a href="#"><div id="load_more"><div id="'.($getDate+10).'" class="more_button btn" style="width:100%;margin-top:2em;">Load More</div></div></a>';
        exit(); echo '11';		
    default:
        $sqladd="SELECT * FROM `posts` where post_status='publish' and `post_doc`<='$getDate'  and post_id NOT IN ('" . implode("','",$_SESSION['rmv_id']) . "') and (post_title like '%$searchquery%' or post_description like '%$searchquery%') ORDER BY `post_doc` DESC, `post_id` DESC LIMIT 20";;
	}
	$query=mysqli_query($GLOBALS["___mysqli_ston"], $sqladd);
	$count=mysqli_num_rows($query);	
	if($count>0)
	{	
		while($search=mysqli_fetch_object($query))
		{
			if($searchtype=='videos'){
				$_SESSION['rmv_id'][]=$search->vid_id;
				$doc = $search->vid_doc;
				$cat = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$search->vc_id' and vc_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
				$vid_url="/watch/".$search->vid_id.'/'.txtcleaner($search->vid_title);
			  echo'
				<div class="media">
					<div class="media-body">
						<div class="media-heading"><a title="'.htmlspecialchars_decode($search->vid_title).'" href="'.$vid_url.'" class="title">'.htmlspecialchars_decode($search->vid_title).'</a></div>
						<div class="info"><span class="category">'.$cat->vc_name.'</span><span class="fa fa-circle"></span><span class="date-created">'.$search->vid_doc.'</span>
						</div>
						<div class="description">'.substr(strip_tags(htmlspecialchars_decode($search->vid_description)), 0, 300).'....Read more</div>
					</div>
				</div>';															
			}
			else{															
				$_SESSION['rmv_id'][]=$search->post_id;
				$doc = $search->post_doc;
				$cat = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$search->cat_id' and cat_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			  echo'
				<div class="media">
					<div class="media-body">
						<div class="media-heading"><a title="'.htmlspecialchars_decode($search->post_title).'" href="'.$search->post_url.'" class="title">'.htmlspecialchars_decode($search->post_title).'</a></div>
						<div class="info"><span class="category">'.$cat->cat_name.'</span><span class="fa fa-circle"></span><span class="date-created">'.$search->post_doc.'</span>
						</div>
						<div class="description">'.substr(strip_tags(htmlspecialchars_decode($search->post_description)), 0, 300).'....Read more</div>
					</div>
				</div>';															
			}

		}
		echo '<a href="#"><div id="load_more"><div id="'.$doc.'" class="more_button btn" style="width:100%;margin-top: 2em;" >Load More</div></div></a>';
	}	
}


?>