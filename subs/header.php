<?php 
ob_start();
session_start();
//delete this line later
if(isset($_GET['post_id']) and $_GET['post_id']=='1006258' )
{
	header( "Location: /home" );
	 exit();
}
//delete this line later
include ('connect_me.php');
$server_url = $_SERVER['REQUEST_URI'];
$nav= basename($_SERVER['PHP_SELF']);
$post_city=$post_state=NULL;
if(isset($_SESSION['rmv_id'])){unset($_SESSION['rmv_id']);}

 if(isset($_SESSION['pub_id'])){
	 if($_SESSION['pub_username']==''){
		header( "Location: /dashboard/edit_profile.php?err=true" );
		 exit(); }	 
 }

//301 redirect
$url_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM local_news_old where post_url='$server_url'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
if($url_sql['count(*)']==1)
{
	$urlsql= mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM local_news_old where post_url='$server_url' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	if(isset($urlsql->post_title)){$newurl= mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where post_title='".mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $urlsql->post_title)."' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));}	
	header("HTTP/1.1 301 Moved Permanently");
	header( "Location:$newurl->post_url" );
	exit();
}

include('functions.php');

//ie redirect
if (strposa($agent, $fliter2)) 
{	header('Location:web');exit();
}
//contribute redirect
if($server_url=='/')
{
	if (strposa($agent, $browser)) 
	{
		if(!isset($_SESSION['landing']))
		{ 
header('Location:/contribute');exit();
}
	}
}

include('change_location.php');
include('header_info.php');

if(isset($_GET['post_id']) )
{
	$post_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where post_id='{$_GET['post_id']}' and post_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($post_sql['count(*)']);
	$posts = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where post_id='{$_GET['post_id']}' and post_status='publish' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 

	$cat_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM category where cat_status='publish' and `cat_id`='$posts->cat_id' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($cat_sql['count(*)']);
	$cat= mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_status='publish' and `cat_id`='$posts->cat_id' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 

	$metakey=$cat->metakey;
	$metadesc=substr(strip_tags($posts->post_description), 0, 240);
	$metatitle=ucfirst(htmlspecialchars_decode($posts->post_title));
	if($posts->post_image_loc===Null){$fb_image='http://crweworld.com/default.jpg';}else{$fb_image=$posts->post_image_loc;}
	$metafb='
	<meta property="article:section" content="'.$cat->cat_name.'" />
	<meta property="article:publisher" content="https://www.facebook.com/crweworld4u" />
	<meta property="og:site_name" content="CRWE World" />
	<meta property="og:url" content="http://crweworld.com'.$posts->post_url.'" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:description" content="'.substr(strip_tags($posts->post_description), 0, 240).'" />
	<link rel="image_src" href="'.$fb_image.'" />
	<meta property="og:title" content="'.$posts->post_title.'" />
	<meta property="og:image" content="'.$fb_image.'" />
	<script>window.history.pushState("", "", "'.$posts->post_url.'");</script>';
}
elseif(isset($_GET['cat_id']))
{
	$cat_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM category where cat_status='publish' and `cat_id`='{$_GET['cat_id']}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($cat_sql['count(*)']);
	$cat = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='{$_GET['cat_id']}' and cat_status='publish'")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	$metakey=$cat->metakey;
	$metadesc=$cat->metadesc;
	$metatitle=ucfirst($cat->cat_name);
	$metafb='<script>window.history.pushState("", "", "'.$cat->cat_url.'");</script>';
	$cat_name=$cat->cat_name;
	$sqladd="AND ((cat_id ='{$_GET['cat_id']}' and trend is null) or ( cat_id ='{$_GET['cat_id']}' and trend='localnews' and post_city='$post_city') or ( cat_id ='{$_GET['cat_id']}' and post_state ='$post_state' AND trend='trend_state') OR ( cat_id ='{$_GET['cat_id']}' and post_country ='$post_country' AND trend='trend_country') OR (cat_id ='{$_GET['cat_id']}' and post_continent='$post_continent' AND trend='trend_continent')) ";
}
elseif(isset($_GET['cat_type']))
{
	$_GET['cat_id']='0';
	if($_GET['cat_type']=="trendingnow")
	{			
		$metatitle=$cat_name="Trending Now";
		$sqladd="AND (( post_state ='$post_state' AND trend='trend_state') OR ( post_country ='$post_country' AND trend='trend_country') OR (post_continent='$post_continent' AND trend='trend_continent'))";
	}
	elseif($_GET['cat_type']=="localnews")
	{
		$metatitle=$cat_name="Local News";
		$sqladd="AND trend='localnews' and post_city='$post_city'";
	}
	
}
elseif(strpos($server_url, "contribute") == true)
{
	$metakey=", ".'Submit News, News Story, Story Submission For Free';
	$metadesc='Submit your news,  news tips, news story for free at CRWE World';
	$metatitle='Contribute';	
}
elseif($nav=="search.php")
{
	$filterweb=$vsql=$psql=$filter=$searchtype='';
	if(isset($_GET['searchtype'])){ $searchtype=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['searchtype']);}
	if($searchtype!='videos' & $searchtype!='user' & $searchtype!='symbol' & $searchtype!='web'){$searchtype='articles';}	
	if(isset($_GET['search'])){ 
		$q=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['search']);
		if (isset($_GET['pageno']) and is_numeric($_GET['pageno']) and $_GET['pageno']>0 ) {
		$pageno = $_GET['pageno'];} else {$pageno = 1; }
		$no_of_records_per_page = 10;	
		$offset = ($pageno-1) * $no_of_records_per_page;
		if(isset($_GET['filter'])){ $filter=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['filter']);}
		if($filter!='hours' & $filter!='week' & $filter!='month' & $filter!='year')
		{$filter='all';$pageurl='/search?searchtype='.$searchtype.'&search='.$_GET['search'];}
		else{ $pageurl='/search?searchtype='.$searchtype.'&search='.$_GET['search'].'&filter='.$filter;
		}
		if($filter=='hours'){$filterweb='&dateRestrict=d'; $psql="and DATE(`post_doc`) < CURRENT_DATE()"; $vsql="and DATE(`vid_doc`) < CURRENT_DATE()";} 
		if($filter=='week') {$filterweb='&dateRestrict=w'; $psql="and `post_doc` < now() - INTERVAL 1 Week"; $vsql="and `vid_doc`< now() - INTERVAL 1 Week";}
		if($filter=='month'){$filterweb='&dateRestrict=m'; $psql="and  MONTH(`post_doc`) < MONTH(now())"; $vsql="and  MONTH(`vid_doc`) < MONTH(now())";}
		if($filter=='year') {$filterweb='&dateRestrict=y'; $psql="and year(`post_doc`) < year(now())"; $vsql="and year(`vid_doc`) < year(now())";}
	 }
	
	
	$metatitle='Search';
}
elseif($nav=="videos.php")
{
	$metatitle='Videos';
}
elseif($nav=="stock-track.php")
{
	$metakey='stock, stock market, stock market trends, stock conversations, stock trends, financial trends, stock ideas, track stocks, financial forum, financial advice, financial conversation';
	$metadesc='CRWE World Stocks - Find out what is happening right now in the markets and stocks you care about';
	$metatitle='Share knowledge and ideas and learn about stocks on CRWE World';
}
elseif($nav=="channel.php")
{
	$vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='{$_GET['vc_id']}' and vc_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	$vc_result = mysqli_fetch_array($vc_id);
	$metatitle=ucfirst($vc_result['vc_name']);
}
if(isset($_GET['vid_id']) )
{
	$mvid_id=txtcleaner($_GET['vid_id']);
	$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos where vid_id='$mvid_id' and vid_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	$results = mysqli_fetch_array($posts);

	$vid_title=$results['vid_title'];
	$vid_view=$results['vid_view'];
	$vc_id=$results['vc_id'];												
	$vc_query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$vc_id' and vc_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	while($cat_result = mysqli_fetch_array($vc_query))
	{	$vc_name=$cat_result['vc_name']; }

	$vid_doc=$results['vid_doc'];
	$vid_description=$results['vid_description'];
	$vid_url =$results['vid_url']; 
	if($results['vid_type']==0)
	{
		$src_url='https://www.youtube.com/embed/'.$vid_url;
		$img_src='http://img.youtube.com/vi/'.$vid_url.'/mqdefault.jpg';
	} else {
		$img_src='http://www.crwetube.com/image/thumbnail/'.$vid_url.'.jpg'; 
		$src_url='http://www.crwetube.com/embed/'.$vid_url;
	}
	$metatitle=ucfirst(htmlspecialchars_decode($vid_title));
	$metafb='
	<meta property="article:section" content="'.$vc_name.'" />
	<meta property="article:publisher" content="https://www.facebook.com/crweworld4u" />
	<meta property="og:site_name" content="CRWE World" />
	<meta property="og:url" content="http://crweworld.com/watch/'.$mvid_id.'/'.txtcleaner($vid_title).'" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:description" content="'.substr(strip_tags($vid_description), 0, 240).'" />
	<link rel="image_src" href="'.$img_src.'" />
	<meta property="og:title" content="'.$vid_title.'" />
	<meta property="og:image" content="'.$img_src.'" />
	<script>window.history.pushState("", "", "/watch/'.$mvid_id.'/'.txtcleaner($vid_title).'");</script>';
}
elseif(isset($_GET['username']) )
{
	$username=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['username']);
	$user_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM user where username='$username' and active='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($user_sql['count(*)']);
	if(isset($_GET['msg_id']) )
	{
		$msg_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM stock_comments where id='{$_GET['msg_id']}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		notfound($msg_sql['count(*)']);
	}
	$user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where username='$username' and active='1' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 

	//$metakey='';
	$metadesc=$user->username.' investing profile on Crweworld.com';
	$metatitle=$user->fname.' '.$user->lname.' (@'.htmlspecialchars_decode($user->username).')';
	$metafb='<script>window.history.pushState("", "", "/user/'.$user->username.'");</script>';
}
elseif(isset($_GET['symbol']) )
{
	$symbol=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['symbol']);
	$symbol_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM symbol_list where `link` ='$symbol' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($symbol_sql['count(*)']);
	$symbolInfo = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM symbol_list where `link` ='$symbol' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 

	$metakey='stock, stock conversations, stock trends,financial trends, stock ideas, track stocks, financial forum, financial advice, financial conversation';
	$metadesc=$symbolInfo->name.' ('.htmlspecialchars_decode($symbolInfo->symbol).') stock market news,discussion, ideas from and for active investors.';
	$metatitle=$symbolInfo->name.' ('.htmlspecialchars_decode($symbolInfo->symbol).') Stock Discussion and Ideas - CRWEWorld Stocks';
	$metafb='<script>window.history.pushState("", "", "/symbol/'.$symbolInfo->link.'");</script>';
}
elseif(isset($_GET['podid']) )
{
	$podid=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['podid']);
	$user_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM podcast where id='$podid' and status='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($user_sql['count(*)']);
	
	$pod = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM podcast where id='$podid' and status='1' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	
	$user_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM user where id='$pod->user_id' and active='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($user_sql['count(*)']);
	
	$user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where id='$pod->user_id' and active='1' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));

	//$metakey='';
	$metadesc='Listen to '.$user->username.' episodes free, on demand.The easiest way to listen to podcasts on your iPhone, iPad, Android, PC, smart speaker – and even in your car.';
	$metatitle='Podcast | '.htmlspecialchars_decode($pod->title);
	//$metafb='<script>window.history.pushState("", "", "/podcast/'.$pod->id.'/'.txtcleaner($pod->title).'?autoplay=true");</script>';
}
elseif(isset($_GET['poduser']) )
{
	$username=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['poduser']);
	$user_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM user where username='$username' and active='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($user_sql['count(*)']);
	
	$user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where username='$username' and active='1' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 

	//$metakey='';
	$metadesc='Listen to '.$user->username.' episodes free, on demand.The easiest way to listen to podcasts on your iPhone, iPad, Android, PC, smart speaker – and even in your car.';
	$metatitle='Podcast | '.strtoupper(htmlspecialchars_decode($user->username));
	//$metafb='<script>window.history.pushState("", "", "/podcast/'.$user->username.'");</script>';
}
elseif($nav=='podcast.php'){
	$metadesc='Listen to CRWEWorld Podcast episodes free, on demand.The easiest way to listen to podcasts on your iPhone, iPad, Android, PC, smart speaker – and even in your car.';
	$metatitle='Podcast';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<?php if(isset($metafb)){ echo $metafb; } 
	if(isset($posts->cat_id) and $posts->cat_id=='39'){ echo '<meta name="robots" content="noindex"> <meta name="googlebot" content="noindex">';}
?>
<meta name="keywords" content="Breaking News, World News,<?php if(isset($api_local)){echo $api_local." ";} if(isset($metakey)){ echo ", ".$metakey; } else{ echo ', Local News, Community, Sports, Politics, Business, Shopping, Restaurants, Travel, Things To Do, Submit News, Submit Your News and Events, Submit your news tips, Submit a news story, submit your story, Submit a News Tip';}?>">
<meta name="Description" content="<?php if(isset($metadesc)){ echo $metadesc; } else { echo 'Local news for every city in the World, thousands of cities throughout the world.'; } ?>">
<title>Crwe World  | <?php  if(isset($metatitle)){ echo $metatitle; }else{ echo 'Local News, Community. Your town. Your news';} ?></title>
<?php if(function_exists('metaclear')) { metaclear(); } ?>  
<meta name="google-site-verification" content="CpL_CdhQUEKvaB6acxSpg3kYp9yVEgD-46iitJRLltI" />  
<link rel="icon" href="//crweworld.com/favicon.ico" sizes="16x16" type="image/x-icon">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400italic,300,700,400|Roboto+Slab:400,700,300">
<link type="text/css" rel="stylesheet" href="/assets/libs/bootstrap/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="/assets/css/core.css">
<link type="text/css" rel="stylesheet" href="/assets/css/fonts.min.css">
<link type="text/css" rel="stylesheet" href="/assets/css/pages/style.css">
<link type="text/css" rel="stylesheet" href="/assets/custom.css"> 
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
<script type="text/javascript">
var CaptchaCallback = function(e){        
        grecaptcha.render('feedback_cap', {'sitekey' : '6LfgyicTAAAAABx0mIQIMBOiqdQv_qVRHFUywPOv'});
		<?php if($nav =="contact.php"){?>
		grecaptcha.render('contact_cap', {'sitekey' : '6LfhIwkUAAAAAPENhSenPsK7YOm-PHnN2Fs_0IFQ'});
		<?php } else if($nav =="chat.php"){?>
		grecaptcha.render('chat_cap', {'sitekey' : '6Le6IA4UAAAAAHWoH15-5sD_k8wJgrdjlSUIr49v'});
		<?php } ?>
    };
</script>

</head> 


<?php include ('autosearch.php'); ?>

<body>

<!-- <?php include('feedback.php') ?> --> 

<!-- HEADER-->
<div id="page-header">
    <div id="header">
        <div class="header-topbar">
            <div class="container">
                <div class="topbar-left col-xs-12 col-sm-5 col-md-5">
                    <div class="topbar-actions">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown mega-menu-dropdown mega-menu-full"><a data-hover="dropdown" href="#">Powered by Crown Equity Holdings Inc.</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <ul class="dropdown-menu show" style="width: 500px;">
                                            <div style="padding-top: 10px; width: 500px;">
                                                <div style="float:left;width: 28%;padding: 2%;">
                                                    <a href="http://crownequityholdings.com/" target="_blank"><img alt="crown-logo" src="/assets/images/crown-logo.png" style="width: 100%;"></a>
                                                </div>
                                                <div style="float:left;width: 340px;font-size: 12px;text-align: justify;">
                                                    <p>Crown Equity Holdings Inc. is publicly traded with the symbol CRWE. The Company primarily provides and offers advertising, branding, marketing solutions and services to boost customer awareness, as well as merchant visibility as a worldwide online multi-media publisher. For list of services offered <a href="http://crweworld.com/contact">click here</a></p>
                                                </div>
                                            </div>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php if(!isset($_SESSION['tracking_id'])) { $_SESSION['tracking_id']=""; } if(!empty($_SESSION['tracking_id'])) { ?>
                    <div class="topbar-left"> <a href="<?php echo $_SESSION['tracking_web_url']?>" target="_blank" class="btn"><i class="ion-network"></i> Presented By <?php echo strtoupper($_SESSION['tracking_fname'])?></a>
                        <a></a>
                    </div>
                    <?php } ?>
                        <div class="topbar-right col-xs-12 col-sm-5 col-md-7">
                            <div class="topbar-search pull-right mrx"> <a href="/contribute" class="btn1 btn"><i class="fa fa-pencil" style="font-size: 20px;"></i> <span class="txt">Post on CRWE World</span></a>
                                <button type="button" class="btn1 btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-map-marker" style="font-size: 20px;"></i> <span class="txt">Change City</span></button>
                                <?php if(isset($_SESSION['pub_username'])){ echo '<a href="/user/'.$_SESSION['pub_username'].'" class="btn1 btn"><i class="fa fa-user" style="font-size: 20px;"></i> <span class="txt">My Wall</span></a>'; } else { echo '<a href="/dashboard" class="btn1 btn"><i class="fa fa-user" style="font-size: 20px;"></i> <span class="txt">Login</span></a>'; } ?> </div>
                            <div class="dropdown pull-right" style="margin: 5px;"></div>
                        </div>
                        <div class="clearfix"></div>
            </div>
        </div>
        <div class="header-logo-banner">
            <div class="container">
                <div class="logo">
                    <a href="/"><img onerror="this.src='/default.jpg'" src="/assets/images/logo.png" width="200" alt="logo" class="img-responsive" /></a>
                    <a class="tag_logo" href="#">
                        <?php if(isset($api_state)){echo $api_state;}?>
                    </a>
                </div>
                <div class="location-link"></div>
                <div class="banner-adv">
                    <?php if(isset($headerimg)){echo $headerimg;} ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="header-menu">
            <?php include('nav.php')?>
        </div>
        <div class="header-background-menu"></div>
    </div>
</div>


 <!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		   <?php include('searchloc.php')?> 
			  <!-- Modal content-->
			<div class="modal-content2">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change City</h4></div>
				<div class="modal-body">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<div class="input-icon right"><i class="ion-ios-location"></i>
									<input style="background-color:#E5E5E5" type="text" autocomplete="off" placeholder="Search Via Zipcode" id="searchbox" class="search form-control" />
									<div id="zips"></div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<br>
								<div align="center">-- OR --</div>
							</td>
						</tr>
						<form method="post" id="myform" action="/subs/lookup.php">
							<tr>
								<td>
									<label>Country: </label>
									<div class="form-group">
										<select name="country" class="country form-control">
											<option class="col-md-12" value="">-- Select Location --</option>
											<?php include ('country_opt.php') ?>
										</select>
									</div>
								</td>
							</tr>
							<tr id="state">
								<td>
									<div class="form-group">
										<label>State or Province</label>
										<div align="center"><img id="img1" alt="load" src="/assets/images/load.gif" /></div>
										<select id="display" name="state" style="width:100%" class="state form-control"></select>
									</div>
								</td>
							</tr>
							<tr id="city">
								<td>
									<div class="form-group">
										<label>City or Municipality</label>
										<div align="center"><img id="img2" alt="load" src="/assets/images/load.gif" /></div>
										<select id="display2" name="city" style="width:100%" class="search2 form-control"></select>
									</div>
								</td>
							</tr>
							<tr id="looky">
								<td>
									<div align="center">
										<input type="submit" class="btn col-md-12" name="look_up" value="Visit Now" />
									</div>
								</td>
							</tr>
						</form>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

 
